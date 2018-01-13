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

	<!-- HEADER -->
	<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;">
		<img class="w3-image" src="img/header.jpg" alt="Posvajanje živali" width="1500" height="800">
		<div class="w3-display-middle w3-margin-top w3-center">
			<h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min">Posvoji svojo najljubšo žival</span></h1>
		</div>
	</header>

	<!-- MAIN CONTENT -->
	<?php
	include 'dbcon.php';
	echo'
	<div class="w3-container w3-center w3-deep-orange">
		<h1>Najdi in POSVOJI me!</h1>
		<form name="iskalnik" method="post">
			<div class="w3-row">
				<div class="w3-col l2 m6 s12 levi-iskalnik">
					<select class="w3-select" method="post" name="pasma_select">
						<option value="0" disabled selected hidden>Pasma</option>
						<option value="0" >Katerakoli</option>';
						
						$tip=$_POST['vrsta'];
						$sql = mysqli_query($conn,"select CONCAT('[',t.Name,'] - ',s.Name) as pasma, s.Id_Species from Species s inner join Types t on(s.Id_Types=t.Id_Types);");
						while ($row_pasma = mysqli_fetch_assoc($sql)){
							echo '<option value='.$row_pasma['Id_Species'].'> '.$row_pasma['pasma'].'</option>';
					}
						echo'
					</select>
				</div>
				<div class="w3-col l2 m6 s12">
					<select class="w3-select" method="post" name="leto_select">
						<option value="0" disabled selected hidden>Starost</option>
						<option value="0">Katerakoli</option>
						<option value="1">manj kot 5 let</option>
						<option value="2">od 5 do 10 let</option>
						<option value="3">nad 10 let</option>
					</select>
				</div>
				<div class="w3-col l2 m6 s12">
					<select class="w3-select" method="post" name="zavetisce_select">
						<option value="0" disabled selected hidden>Zavetišče</option>
						<option value="0">Katerokoli</option>';

						$tip=$_POST['vrsta'];
						$sql = mysqli_query($conn,"select CONCAT('[',p.Town,'] - ',sh.Name) as zavet, sh.Id_Shelters from Shelters sh inner join Post p on (sh.Id_Post=p.Id_Post);") ;
						while ($row_shelter = mysqli_fetch_assoc($sql)){
							echo '<option value='.$row_shelter['Id_Shelters'].'> '.$row_shelter['zavet'].'</option>';
					}
						echo'
					</select>
				</div>
			</div>
			<button class="w3-button w3-green" style="margin-top: 16px; margin-bottom: 16px;" method="post" name="search">IŠČI</button>
		</form>
	</div>';
	$conn->close();
?>
	<div class="w3-center w3-container w3-col l9 s12 novo">
	
<?php
include 'dbcon.php';
if(isset($_POST['search']) && isset($_POST['pasma_select'])&&isset($_POST['leto_select'])&&isset($_POST['zavetisce_select'])){

	echo'	<h1>Rezultati iskanja</h1>';
	
	$IdSpecies=$_POST['pasma_select'];
	$Age=$_POST['leto_select'];
	$IdShelter=$_POST['zavetisce_select'];

	
	
	switch($_POST['leto_select']){
		case 1:
	
		if($_POST['zavetisce_select']!=0 && $_POST['pasma_select']!=0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where s.Id_Species='$IdSpecies' and sh.Id_Shelters='$IdShelter' and a.Age < 5 group by Id_Animals;";
		else if($_POST['zavetisce_select']==0 && $_POST['pasma_select']!=0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where s.Id_Species='$IdSpecies' and a.Age < 5 group by Id_Animals;";
		else if($_POST['zavetisce_select']!=0 && $_POST['pasma_select']==0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where sh.Id_Shelters='$IdShelter' and a.Age < 5 group by Id_Animals;";
		else 
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where a.Age < 5 group by Id_Animals;";	
		break;
		
		
		case 2:		
		if($_POST['zavetisce_select']!=0 && $_POST['pasma_select']!=0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where s.Id_Species='$IdSpecies' and sh.Id_Shelters='$IdShelter' and a.Age >= 5 and a.Age<=10 group by Id_Animals;";
		else if($_POST['zavetisce_select']==0 && $_POST['pasma_select']!=0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where s.Id_Species='$IdSpecies' and a.Age >= 5 and a.Age<=10 group by Id_Animals;";
		else if($_POST['zavetisce_select']!=0 && $_POST['pasma_select']==0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where sh.Id_Shelters='$IdShelter' and a.Age >= 5 and a.Age<=10 group by Id_Animals;";
		else 
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where a.Age >= 5 and a.Age<=10 group by Id_Animals;";	
		break;
		
		case 3: 		
		if($_POST['zavetisce_select']!=0 && $_POST['pasma_select']!=0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where s.Id_Species='$IdSpecies' and sh.Id_Shelters='$IdShelter' and a.Age > 10 group by Id_Animals;";
		else if($_POST['zavetisce_select']==0 && $_POST['pasma_select']!=0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where s.Id_Species='$IdSpecies' and a.Age > 10 group by Id_Animals;";
		else if($_POST['zavetisce_select']!=0 && $_POST['pasma_select']==0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where sh.Id_Shelters='$IdShelter' and a.Age > 10 group by Id_Animals;";
		else 
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where a.Age > 10 group by Id_Animals;";	
		break;
		
		case 0: 		
		if($_POST['zavetisce_select']!=0 && $_POST['pasma_select']!=0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where s.Id_Species='$IdSpecies' and sh.Id_Shelters='$IdShelter' group by Id_Animals;";
		else if($_POST['zavetisce_select']==0 && $_POST['pasma_select']!=0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where s.Id_Species='$IdSpecies' group by Id_Animals;";
		else if($_POST['zavetisce_select']!=0 && $_POST['pasma_select']==0)
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) where sh.Id_Shelters='$IdShelter' group by Id_Animals;";
		else 
			$sql="select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (a.Id_Shelters=sh.Id_Shelters) group by Id_Animals;";	
		break;
	}
	$query=mysqli_query($conn,$sql);
$i=-1;
while ($row_animal = mysqli_fetch_assoc($query)){
		$Id_Animals=$row_animal['Id_Animals'];

	
	$i++;
	if($i%3==0){
		if($i>0)
			echo '</div>';
		
		echo '<div class="w3-row-padding">';
	}
		echo '					
		
			<div class="w3-third w3-container w3-margin-bottom zival">
				<a href="/zival.php?Id_Animals='.$Id_Animals.'">
					<img width="300" height="200" src='.$row_animal['Picture'].'>
					<div class="w3-container w3-center w3-khaki bottom-round">
						<p>'.$row_animal['Name'].' | '.$row_animal['Age'].' let </p>
					</div>
				</a>
			</div>
		';
}}
	
	
else{
	
	echo'	<h1>Najnovejše živali na portalu</h1>';

		include 'dbcon.php';
		
//		<!-- STRUKTURA PO VRSTICAH (do 3 elementi na eno)
$sql = mysqli_query($conn,"select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) where Id_Animals > ((select MAX(Id_Animals) from Animals)-6) group by Id_Animals;");
$i=-1;
while ($row_animal = mysqli_fetch_assoc($sql)){
	$Id_Animals=$row_animal['Id_Animals'];
	$i++;
	if($i%3==0){
		if($i>0)
			echo '</div>';
		
		echo '<div class="w3-row-padding">';
	}
		echo '					
		
			<div class="w3-third w3-container w3-margin-bottom zival">
				<a href="/zival.php?Id_Animals='.$Id_Animals.'">
					<img width="300" height="200" src='.$row_animal['Picture'].'>
					<div class="w3-container w3-center w3-khaki bottom-round">
						<p>'.$row_animal['Name'].' | '.$row_animal['Age'].' let </p>
					</div>
				</a>
			</div>
		';
}}
$conn->close();
		echo '</div></div>';
		?>
	<!-- FOOTER -->
	<?php include $_SERVER['DOCUMENT_ROOT'].'/incl/footer.html';?>
</body>
</html>