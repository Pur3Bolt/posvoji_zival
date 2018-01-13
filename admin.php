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
	<script type="text/javascript">
		Element.prototype.remove = function() {
			this.parentElement.removeChild(this);
		}
		NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
			for(var i = this.length - 1; i >= 0; i--) {
				if(this[i] && this[i].parentElement) {
					this[i].parentElement.removeChild(this[i]);
				}
			}
		}
		function remove(zival){
			document.getElementById(zival).remove();
		}
	</script>
</head>
<body>

	<!-- Navbar -->
	<?php 
	include $_SERVER['DOCUMENT_ROOT'].'/incl/nav.php';
	include 'dbcon.php';

	//<!-- MAIN CONTENT -->
	
	
	if(isset($_SESSION['Id_Users'])){
		$user=$_SESSION['Id_Users'];
		include $_SERVER['DOCUMENT_ROOT'].'/incl/regular.php';
	}
	else if(isset($_SESSION['Id_Shelters'])){
		$shelter=$_SESSION['Id_Shelters'];
		include $_SERVER['DOCUMENT_ROOT'].'/incl/shelter.php';
	}
	else
		header('Location: index.php');
	
	echo'
	<div class="w3-center w3-container w3-col l9 s12 novo" style="padding-top: 16px;">
		<h1>';
			if(isset($_SESSION['Id_Users'])){
				echo "Vaše priljubljene";
			}
			else{
				echo "Vaše objavljene živali";
			}
			echo'
		</h1>
		';
		if(isset($_SESSION['Id_Users']))
			$sql = mysqli_query($conn,"select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Favorites f on (f.Id_Animals=a.Id_Animals) where f.Id_Users='$user' group by Id_Animals;");
		else
			$sql = mysqli_query($conn,"select a.Id_Animals, s.Name, a.Age, a.Picture from Animals a inner join Species s on (a.Id_Species=s.Id_Species) inner join Shelters sh on (sh.Id_Shelters=a.Id_Shelters) where sh.Id_Shelters='$shelter' group by Id_Animals;");
			
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
						<div class="w3-display-topright" style="margin-right:8px;">
							<button class="w3-white w3-btn" style="border-top-right-radius: 4px;">
								<i class="far fa-times"></i>
							</button>
						</div>
						
						<a href="/zival.php?Id_Animals='.$Id_Animals.'">
							<img width="300" height="200" src='.$row_animal['Picture'].'>
							<div class="w3-container w3-center w3-khaki bottom-round">
								<p>'.$row_animal['Name'].' | '.$row_animal['Age'].' let </p>
							</div>
						</a>
					</div>
				';
		}
		
		//Hendlanje polj
		//admin
		if(isset($_POST['submit'])){
		if(isset($_SESSION['Id_Shelters'])){
			
			if($_POST['name']!=null && $_POST['address']!=null && $_POST['houseno']!=null && $_POST['postno']!=null && $_POST['tel']!=null && $_POST['email']!=null && $_POST['submit']=='shrani'){
				$name=$_POST['name'];
				$address=$_POST['address'];
				$houseno=$_POST['houseno'];
				$postna=$_POST['postno'];
				$phone=$_POST['tel'];
				$email=$_POST['email'];
				$sql="Update Shelters set Name='$name', Street='$address',House_no='$houseno',Id_Post='$postna',Phone='$phone', Email='$email' where Id_Shelters='$shelter'";
				$conn->query($sql);
		}}
			
		else if	(isset($_SESSION['Id_Users'])){
			
				if($_POST['email']!=null && $_POST['name']!=null && $_POST['surname']!=null && $_POST['tel']!=null && $_POST['submit']=='Shrani'){
				$fname=$_POST['name'];
				$email=$_POST['email'];
				$lname=$_POST['surname'];
				$phone=$_POST['tel'];
				$sql="Update Users set Fname='$fname', Lname='$lname',Email='$email',Phone='$phone' where Id_Users='$user'";
				$conn->query($sql);
		}}
		}
		echo '</div></div>';
	include $_SERVER['DOCUMENT_ROOT'].'/incl/footer.html';
	$conn->close();
	echo '
</body>
</html>';