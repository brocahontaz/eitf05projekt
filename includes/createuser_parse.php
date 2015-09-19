<?php
	require_once("database.php");
	require_once("user.php");
	require_once("setup.php");
	require_once("mysql_connect_data.php");
	$db = new Database($host, $userName, $password, $database);

	if (isset($_SESSION['username'])) {
		header("Location: ../index.php");
		exit();
	}

	$user = str_replace(' ', '_', $_POST['tfb_name']);
	$tfbpass1 = $_POST['tfb_password1'];
	$tfbpass2 = $_POST['tfb_password2'];
	$tfbemail1 = $_POST['tfb_email1'];
	$tfbemail2 = $_POST['tfb_email2'];
	$address = $_POST['address'];
	
	if(empty($user) || empty($tfbpass1) || empty($tfbpass2) || empty($tfbemail1) || empty($tfbemail2) || empty($address)) {
		header("Location: ../register.php?empty");
		exit();
	}
	
	if($tfbpass1 != $tfbpass2)  {
		header("Location: ../register.php?falsepass");
		exit();
	}
	if($tfbemail1 != $tfbemail2)  {
		header("Location: ../register.php?falsemail");
		exit();
	}
	$password = password_hash($tfbpass1, PASSWORD_DEFAULT);
	$db->createUser($user, $password, $address, $address, $email);
	header("Location: ../register.php?success");
?>