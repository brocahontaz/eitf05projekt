<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "thefruitbasket";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	$password = password_hash("password", PASSWORD_DEFAULT);

	$sql = "INSERT INTO users (userName, passWord, address, email) VALUES ('superuser', '".$password."', 'testgatan 23, 12345 teststaden, sverige', 'test@test.se')";

	if ($conn->query($sql) === TRUE) {
		echo "New superuser created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>