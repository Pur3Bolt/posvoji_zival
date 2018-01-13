<?php
$servername ="gator4243.hostgator.com";
		$username = "arnel_db";
		$password = "danpobjede";
		$dbname = "arnel_zavetisce";
	
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		mysqli_query($conn,"set names 'utf8'"); 

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
?>