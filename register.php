<?php 
	require_once("includes/database.php");
	require_once("includes/mysql_connect_data.php");
	require_once("includes/user.php");
	require_once("includes/setup.php");
	$db = new Database($host, $userName, $password, $database);
	$isLogedIn = isset($_SESSION['username']);
	if ($isLogedIn) {
		$user = $_SESSION['user'];
		header("Location: index.php");
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>
			thefruitbasket
		</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" />
		<link rel="icon" type="image/png" href="./images/favicon.png" />
	</head>
	<body>
		<div id="main_wrapper">
			<div id="topbar_wrapper">
				<div id="topbar_content">
					<div id="logo_box">
						<img src="./images/thefruitbasketlogo.png" />
					</div>
					<div id="account_box">
						<div class="account_content">
							<div id="signed_in_as_box">
								<?php if ($isLogedIn) { ?>
								SIGNED IN AS <span class="black"><?php echo $user->getUserName(); ?></span>
								
								<?php } else { ?>
								
								<form name="loginform" id="loginform" method="POST" action="includes/login_parse.php">
									<input type="text" class="input_field_login" name="tfb_name" placeholder="USERNAME"/>
									<input type="password" class="input_field_login" name="tfb_password" placeholder="PASSWORD"/>
									<input type="submit" class="login_button" name="submit" value="SIGN IN" />
								</form>
								<?php } ?>
							</div>
							<div id="account_menu">
								<?php if ($isLogedIn) { ?>
								<a href="account.php?user=<?php echo $user->getUserName(); ?>" class="lgreen_to_dgreen">MY ACCOUNT</a> - 
								<a href="orders.php?user=<?php echo $user->getUserName(); ?>" class="lgreen_to_dgreen">ORDERS</a> - 
								<a href="settings.php?user=<?php echo $user->getUserName(); ?>" class="lgreen_to_dgreen">SETTINGS</a>
								<?php } else { ?>
								NOT YET A MEMBER?
								<a href="register.php" class="lgreen_to_dgreen">
									<b>REGISTER</b> TODAY!
								</a>
								<?php } ?>
							</div>
						</div>
						<div class="account_content">
							<?php if ($isLogedIn) { ?>
							<a href="shoppingcart.php?user=<?php echo $user->getUserName(); ?>">
							<?php } else { ?>
							<a href="register.php">
							<?php } ?>
								<img src="./images/shoppingcart.png" />
							</a>
						</div>
					</div>
				</div>
			</div>
			<div id="menu_wrapper">
				<div id="menu_container">
					<!--<div id="menu_object_container">-->
						<a href="index.php" class="menu_object_active">
							HOME
						</a>
						<a href="index.php" class="menu_object">
							STORE
						</a>
						<a href="index.php" class="menu_object">
							ABOUT
						</a>
						<a href="index.php" class="menu_object">
							HELP
						</a>
						<?php if($isLogedIn) { ?>
						<a href="includes/logout_parse.php" class="menu_object" style="float: right;">
							SIGN OUT
						</a>
						<?php } ?>
					<!--</div>-->
				</div>
			</div>
			<div id="content_wrapper">
				<div id="content">
				<p class="breadtext">
					<h1>Fill in your credentials to create Your TFB account today.</h1>
				</p>
<?php
	if(isset($_GET['empty'])) {
?>
					<p class ="breadtext" style="color: red";>
						Some field/s were left empty. Please try again.
					</p>
<?php
	} else if(isset($_GET['falsepass'])) {
?>
					<p class ="breadtext" style="color: red";>
						The passwords does not correspond. Try again, please.
					</p>
<?php
	} else if(isset($_GET['falsemail'])) {
?>
					<p class ="breadtext" style="color: red";>
						The emails does not correspond. Try again, please.
					</p>
<?php
	} else if(isset($_GET['success'])) {
?>
					<p class ="breadtext" style="color: green";>
						The account were successfully created! :) Login to start using it.
					</p>
<?php
	}
?>				
					<form name="createuser "id="createuser" method="POST" action="includes/createuser_parse.php">
						<input type="text" class="input_field_login" name="tfb_name" placeholder="USERNAME"/><br /><br />
						<input type="text" class="input_field_login" name="address" placeholder="ADDRESS"/><br /><br />
						<input type="text" class="input_field_login" name="tfb_email1" placeholder="EMAIL"/><br /><br />
						<input type="text" class="input_field_login" name="tfb_email2" placeholder="REPEAT EMAIL"/><br /><br />
						<input type="password" class="input_field_login" name="tfb_password1" placeholder="PASSWORD"/><br /><br />
						<input type="password" class="input_field_login" name="tfb_password2" placeholder="REPEAT PASSWORD"/><br /><br />
						<input type="submit" class="submit_button_login" name="submit" value="CREATE ACCOUNT" />
					</form>
				</div>
			</div>
			<div id="footer_wrapper">
				<div id="footer_content">
					<div class="footer_object">
						<span class="footer_header1">
							BRINGING FRESHNESS TO THE WORLD
						</span>
						
						<p class="footer_text1">
							Ever since 2015, we have delivered top notch products to <br />
							delighted costumers all around the world (mainly Norway).
							<br /><br />
							We specialize in the freshest of fruits - a gourmets dream.
						</p>
						<p class="copyright">
							©2015 the<span class="green">fruit</span>basket. ALL RIGHTS RESERVED.
						</p>
						<p class="terms">
							<a href="" class="white_to_green">Privacy policy</a> | <a href="" class="white_to_green">Terms & Conditions</a>
						</p>
					</div>
					<div class="footer_object">
						<span class="footer_header1">
							TEAM
						</span>
						<p class="footer_text1">
							<a href="" class="white_to_green">Amanda</a> <br />
							<a href="" class="white_to_green">Johan</a> <br />
							<a href="" class="white_to_green">Michael</a> <br />
							<a href="" class="white_to_green">Therese</a>
						</p>
					</div>
					<div class="footer_object">
						<span class="footer_header1">
							CONTACT
						</span>
						<p class="footer_text1">
							E-huset <br />
							LTH, Lund University <br />
							Ole Römers Väg 3G <br />
							223 63 Lund
						</p>
					</div>
					<div class="footer_object">
						<span class="footer_header1">
							GET STARTED
						</span>
						<p class="footer_text1">
							Create your thefruitbasket account today,<br /> 
							and browse our vast line of products.
						</p>
						<div id="get_started">
							<div id="learn_more">
								LEARN MORE
							</div>
							<a href="register.php">
							<div id="get_started_button">
								GET STARTED
							</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>