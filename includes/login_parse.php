<?php 
require_once("database.php");
require_once("mysql_connect_data.php");
require_once("user.php");
require_once("setup.php");

if(!empty($_POST)){

	$db = new Database($host, $userName, $password, $database);
	
	$user = str_replace(' ', '_', $_POST['tfb_name']);
	$userPassword = $_POST['tfb_password'];
	
	if (empty($user) || empty($userPassword)) {
		$error = 'empty';
		header("Location: ../index.php");
	} else if(!$db->userExists($user)) {
		$error = 'nonexistent';
		header("Location: ../index.php");
	} else if(!($db->checkPassword($user, $userPassword))) {
		$error = 'error';
		header("Location: ../index.php");
	}
	
	if(!$error){
	
		$_SESSION['username'] = $user;
		$_SESSION['db'] = $db;
		$_SESSION['user'] = new User($user);
	
		// success!
		header("Location: ../index.php");
	
	}

}
?>