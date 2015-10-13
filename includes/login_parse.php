<?php 
require_once("database.php");
require_once("mysql_connect_data.php");
require_once("user.php");
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);
session_start(); 
$db = new Database($host, $userName, $password, $database);

if(!empty($_POST)){

	// CSRF token protection
	if($_POST['token'] === $_SESSION['token']){

		$db = new Database($host, $userName, $password, $database);
		
		$user = str_replace(' ', '_', sanitize($_POST['tfb_name']));
		$userPassword = sanitize($_POST['tfb_password']);
		
		if (empty($user) || empty($userPassword)) {
			$error = true;
			header("Location: ../index.php?login_error=empty");
		} else if(!validateText($user, 2, 20)) {
			$error = true;
			header("Location: ../index.php?login_error=user");
		} else if(!validateText($userPassword, 10, 50)) {
			$error = true;
			header("Location: ../index.php?login_error=pw");
		} else if(!$db->userExists($user)) {
			$error = true;
			header("Location: ../index.php?login_error=nonexistent");
		} else if(!($db->checkPassword($user, $userPassword))) {
			$error = true;
			header("Location: ../index.php?login_error=wrongpw");
		}
		
		if(!$error){
		
			$_SESSION['username'] = $user;
			$_SESSION['db'] = $db;
			$_SESSION['user'] = new User($user);
		
			// success!
			header("Location: ../index.php");
		
		}
	
	}
	
	

}
?>