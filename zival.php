<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Posvoji žival</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"> <!-- for responsive design -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script defer src="js/fontawesome-all.js"></script> <!-- FontAwesome icons -->
</head>
<body>

	<!-- Navbar -->
	<?php include $_SERVER['DOCUMENT_ROOT'].'/incl/nav.php';?>

	<!-- MAIN CONTENT -->
	<?php
	include 'dbcon.php';
	session_start();
	$id=$_GET['Id_Animals'];

	//povp. ocena
		$sqlmark = mysqli_query($conn,"select AVG(r.Grade)as grade from Reviews r inner join Shelters sh on (r.Id_Shelters=sh.Id_Shelters) inner join Animals a on (a.Id_Shelters=sh.Id_Shelters) where a.Id_Animals ='$id' ;");
		
	$sql = mysqli_query($conn,"select a.Name as ime,a.Age,a.Gender,a.Picture,s.Description,s.Name,sh.Name as shelter,sh.Street,sh.Id_Post,p.Town,sh.House_no,sh.Phone,sh.Email from Animals a inner join Species s on(a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) inner join Post p on (sh.Id_Post=p.Id_Post) where a.Id_Animals = '$id';");
	$mark=round(mysqli_fetch_assoc($sqlmark)['grade'],2);
	if(is_array($mark))
		$mark="Ni še ocenjen";

	$arr=mysqli_fetch_all($sql,MYSQLI_ASSOC);
	
	echo'
	<div class="w3-container w3-center" style="margin-top: 65px;">
		<div class="w3-row-padding">
			<div class="w3-container w3-third">
				<div class="w3-container w3-deep-orange">
					<h3>'.$arr[0]['shelter'].'</h3>
				</div>
				<div class="w3-container">
					<div class="zavetisce">
						<img src="img/zavetisca/ljubljana.png"><br/>
						<a href="#">Ocena: '.$mark.' / 10</a>
					</div>
					<p>'.$arr[0]['Street'].' '.$arr[0]['House_no'].', '.$arr[0]['Id_Post']. ' '.$arr[0]['Town'].'</p>
					<p>'.$arr[0]['Phone'].', <a href="mailto:'.$arr[0]['Email'].'">'.$arr[0]['Email'].'</a></p>
					<hr class="zavetisce-hr">
				</div>
				<div class="w3-container">
					<img src='.$arr[0]['Picture'].' style="width:100%;">
				</div>
			</div>
			<div class="w3-container w3-rest">
				<div class="w3-container w3-deep-orange">
					<h3 class="w3-center">'.$arr[0]['ime'].'</h3>
				</div>
				<div class="w3-container">
					<div class="w3-container">
						<div class="w3-left" style="width: 30%;">
							<h3>Lastnosti živali</h3>
							<p>Pasma: '.$arr[0]['Name'].'</p>
							<p>Starost: '.$arr[0]['Age'].' let</p>
							<p>Spol: '.$arr[0]['Gender'].'</p>
						</div>
						<div class="w3-right" style="width: 70%;">
							<h3>Opis</h3>
							<p>'.$arr[0]['Description'].'</p>
						</div>
					</div>';
					
					if(isset($_SESSION['Id_Users'])){
						$user=$_SESSION['Id_Users'];
						$sql = mysqli_query($conn,"select Id_Animals from Favorites where Id_Users='$user';");
						
						echo'
						<form method="post">';
						
						$flag=false;
						while ($row_fav = mysqli_fetch_assoc($sql)){
							if($row_fav['Id_Animals']==$id)
								$flag=true;
						}

						if(!$flag){
						echo'
						<button name=addfav class="w3-button w3-center w3-green">
							<i class="far fa-heart"></i> Dodaj med priljubljene
						</button>';}
						
						else{
							echo'
						<button name=removefav class="w3-button w3-center w3-red">
							<i class="fas fa-heart"></i> Odstrani iz priljubljenih
					</button>';}
					
					echo '</form>';
					}
			echo'		
				</div>
			</div>
		</div>
	</div>
';

if(isset($_POST['addfav'])){
	$sql="Insert into Favorites values('$user','$id');";
	$conn->query($sql);
	header("Refresh:0");

}
if(isset($_POST['removefav'])){
	$sql="delete from Favorites where Id_Users='$user' and Id_Animals='$id';";
	$conn->query($sql);
	header("Refresh:0");

}

$conn->close();
?>
	<!-- FOOTER -->
	<?php include $_SERVER['DOCUMENT_ROOT'].'/incl/footer.html';?>
</body>
</html>