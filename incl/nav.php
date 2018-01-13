<div class="w3-top">
	<div class="w3-bar w3-khaki w3-wide w3-padding w3-card">
		<a href="/index.php" class="w3-bar-item w3-button">Posvoji žival</a>
		<!-- Prijava -->
		<div class="w3-right">
			<?php
			include 'dbcon.php';
				//session_start();
				
				if(isset($_POST['submit'])&& $_POST['submit']=="Prijava"){
					$email = $_POST['email'];
					$pass = md5($_POST['pwd']);
					$CorrectUserDataUser=(int) mysqli_num_rows (mysqli_query($conn,"SELECT Id_Users FROM Users WHERE Email = '$email' AND Password = '$pass';"));
					$CorrectUserDataShelter=(int) mysqli_num_rows (mysqli_query($conn,"SELECT Id_Shelters FROM Shelters WHERE Email = '$email' AND Password = '$pass';"));

					
					if($CorrectUserDataUser > 0){
						$UserID = (int) mysqli_fetch_assoc (mysqli_query($conn,"SELECT Id_Users as User FROM Users WHERE Email = '$email' AND Password = '$pass';"))['User'] ;
						$UserName = mysqli_fetch_assoc (mysqli_query($conn,"SELECT CONCAT(Fname,' ',Lname) as Name FROM Users WHERE Email = '$email' AND Password = '$pass';"))['Name'] ;
						$_SESSION['Id_Users']=$UserID;
						$_SESSION['name']=$UserName;
					}
					else if($CorrectUserDataShelter > 0){
						$ShelterID = (int) mysqli_fetch_assoc (mysqli_query($conn,"SELECT Id_Shelters as Shelter FROM Shelters WHERE Email = '$email' AND Password = '$pass';"))['Shelter'] ;
						$ShelterName = mysqli_fetch_assoc (mysqli_query($conn,"SELECT Name FROM Shelters WHERE Email = '$email' AND Password = '$pass';"))['Name'] ;
						$_SESSION['Id_Shelters']=$ShelterID;
						$_SESSION['name']=$ShelterName;
					}					
				}

				if (isset($_POST['submit'])&& $_POST['submit']=="Ustvari račun"){


						$fname = $_POST['name'];
						$lname = $_POST['surname'];
						$email = $_POST['email'];
						$phone = $_POST['tel'];
						$pass = md5($_POST['pwd']);
								
						$sql="INSERT into Users (Fname,Lname,Email,Password,Phone) values('$fname','$lname','$email','$pass','$phone');";
						$conn->query($sql);
						}
						
				//logged in already
				if(isset($_SESSION['Id_Users'])&&isset($_SESSION['name'])){
					echo '<p>Pozdravljeni, <a href="/admin.php">'.$_SESSION['name'].'</a>. <a href="?logout=true">Odjavi se.</a></p>';
				}
				else if(isset($_SESSION['Id_Shelters'])&&isset($_SESSION['name'])){
					echo '<p>Pozdravljeni, <a href="/admin.php">'.$_SESSION['name'].'</a>. <a href="?logout=true">Odjavi se.</a></p>';
				}
				

				//must login - show form
				else {
					include $_SERVER['DOCUMENT_ROOT'].'/incl/login.php';
				}
				
				if(!empty($_GET['logout'])&&$_GET['logout']){
					session_destroy();
					//header("Location: /index.php");
					echo'<meta http-equiv="refresh" content="0; url=./index.php" />';
					exit();
				}
				
				
				
				
				
			$conn->close();

			?>
		</div>
	</div>
</div>