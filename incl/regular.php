<?php
include 'dbcon.php';
$user1=$_SESSION['Id_Users'];
$sql=mysqli_query($conn,"select Id_Users,Fname,Lname,Email,Phone from Users where Id_Users='$user1';");
	$arr=mysqli_fetch_all($sql,MYSQLI_ASSOC);

echo'
<div class="w3-container w3-deep-orange" style="margin-top: 55px;">
	<div class="w3-row-padding">
		<!-- podatki -->
		<form method="post">
		<div class="w3-col l4 m6 s12 user-left">
			<h2 class="w3-center">Vaši podatki</h2>
			<label>Elektronski naslov</label>
			<input class="w3-input" type="email" name="email" value='.$arr[0]['Email'].'>
			<label>Ime</label>
			<input class="w3-input" type="text" name="name" value='.$arr[0]['Fname'].'>
			<label>Priimek</label>
			<input class="w3-input" type="text" name="surname" value='.$arr[0]['Lname'].'>
			<label>Telefonska številka</label>
			<input class="w3-input" type="tel" name="tel" value='.$arr[0]['Phone'].'>
			<div class="w3-center">
				<input class="w3-button w3-green" style="margin-top: 16px; margin-bottom: 16px;" name="submit" type="submit" value="Shrani">
			</div>
		</div>
		<!-- geslo -->
		<div class="w3-col l4 m6 s12 user-mid">
			<h2 class="w3-center">Sprememba gesla</h2>
			<label>Staro geslo</label>
			<input class="w3-input" type="password" name="old">
			<label>Novo geslo</label>
			<input class="w3-input" type="password" name="new">
			<label>Ponovi novo geslo</label>
			<input class="w3-input" type="password" name="newrepeat">
			<div class="w3-center" style="clear: both;">
				<input class="w3-button w3-green" style="margin-top: 16px; margin-bottom: 16px;" name="submit" type="submit" value="Spremeni">
			</div>
		</div>
		</form>
	</div>
</div>';
?>