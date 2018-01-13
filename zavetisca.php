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
	
	echo '<div class="w3-container w3-center" style="margin-top: 55px;">
		<h1>Zavetišča</h1>';
		
		
		$sql=mysqli_query($conn,"select sh.Id_Shelters,sh.Name,sh.Street,sh.House_no,sh.Id_Post,p.Town,sh.Phone,sh.Email from Shelters sh inner join Post p on (sh.Id_Post=p.Id_Post);");
		$i=-1;
		while ($row_shelter = mysqli_fetch_assoc($sql)){
			$Id_Shelter=$row_shelter['Id_Shelters'];
			
		$sqlmark = mysqli_query($conn,"select AVG(r.Grade)as grade from Reviews r inner join Shelters sh on (r.Id_Shelters=sh.Id_Shelters) where sh.Id_Shelters = '$Id_Shelter' ;");
		$mark=round(mysqli_fetch_assoc($sqlmark)['grade'],2);

		$i++;
		if($i%4==0){
			if($i>0)
				echo '</div>';
			
			echo '<div class="w3-row-padding">';
		}
			echo '					
			
				<div class="w3-container w3-col l3 m6 s12">
					<div class="w3-container w3-deep-orange">

					<h3>'.$row_shelter['Name'].'</h3>
				</div>
				<div class="w3-container">
					<div class="zavetisce">
						<img src="img/zavetisca/ljubljana.png"><br/>
						<a href="#">Ocena: '.$mark.' / 10</a>
					</div>
					<p>'.$row_shelter['Street'].' '.$row_shelter['House_no'].',<br>'.$row_shelter['Id_Post'].'  '.$row_shelter['Town'].'</p>
					<p>'.$row_shelter['Phone'].', <a href="mailto:'.$row_shelter['Email'].'">'.$row_shelter['Email'].'</a></p>
					<hr class="zavetisce-hr">
				</div>
			</div>
			';
	}
		
	echo '</div></div>';
	$conn->close();
?>
	<!-- FOOTER -->
	<?php include $_SERVER['DOCUMENT_ROOT'].'/incl/footer.html';?>
</body>
</html>