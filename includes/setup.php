<?php 
require_once("includes/database.php");
require_once("includes/mysql_connect_data.php");
require_once("includes/user.php");
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set("display_errors", 1);
session_start(); 
$db = new Database($host, $userName, $password, $database);
$isLogedIn = isset($_SESSION['username']);
if ($isLogedIn) {
	$user = $_SESSION['user'];
	$userName = $user->getUserName();
}
if(isset($_GET['login_error'])){
	$login_error = sanitize($_GET['login_error']);
}
?>