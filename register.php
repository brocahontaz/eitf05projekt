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

if(isset($_POST['submit'])){
	$user = str_replace(' ', '_', sanitize($_POST['tfb_name']));
	$tfbpass1 = sanitize($_POST['tfb_password1']);
	$tfbpass2 =  sanitize($_POST['tfb_password2']);
	$tfbemail1 =  sanitize($_POST['tfb_email1']);
	$tfbemail2 =  sanitize($_POST['tfb_email2']);
	$address =  sanitize($_POST['address']);
	if(empty($user) || empty($tfbpass1) || empty($tfbpass2) || empty($tfbemail1) || empty($tfbemail2) || empty($address)) {
		$feedback = "All fields must be filled.";
	} else{
		if(!validateText($user, 2, 20)){ $feedback = "The username must be a string of 2-20 characters."; }
		if(!validateText($address, 2, 50)){ $feedback = "The address must be a string of 2-50 characters."; }
		if(!validateText($tfbemail1, 6, 50)){ $feedback = "The email must be a string of 6-50 characters."; }
		if(!$feedback){
			if($tfbemail1 != $tfbemail2)  {
				$feedback = "The email was not correctly repeated.";
			} else{
				$pattern = '/^(?=.*\d)(?=.*?[a-zA-Z])(?=.*?[\W_]).{10,}$/';
				if(preg_match($pattern, $tfbpass1) != 1){
					$feedback = "The password does not meet the requirements.";
				} else{
					if($tfbpass1 != $tfbpass2)  {
						$feedback = "The password was not correctly repeated.";
					} else{
						$password = password_hash($tfbpass1, PASSWORD_DEFAULT);
						$db->createUser($user, $password, $address, $address, $email);
						header("Location: register.php?success");
					}
				}
			}
		}
	}
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
		<script src="script/jquery.js" type="text/javascript"></script>
		<script src="script/jquery-ui.js" type="text/javascript"></script>
		<script src="script/menu.js" type="text/javascript"></script>
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
						<a href="index.php" class="menu_object">
							HOME
						</a>
						<a href="store.php?browseall" class="menu_object">
							STORE
						</a>
						<a href="about.php" class="menu_object">
							ABOUT
						</a>
						<a href="help.php" class="menu_object">
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
				<?php if(!empty($feedback)){ ?><p class ="breadtext" style="color: red";><?php echo $feedback; ?></p><?php } ?>			
					<form name="createuser "id="createuser" method="POST" action="register.php">
						<input type="text" class="input_field_login" name="tfb_name" placeholder="USERNAME" value="<?php if(isset($feedback)){ echo $user; } ?>" /><br /><br />
						<input type="text" class="input_field_login" name="address" placeholder="ADDRESS" value="<?php if(isset($feedback)){ echo $address; } ?>" /><br /><br />
						<input type="text" class="input_field_login" name="tfb_email1" placeholder="EMAIL" value="<?php if(isset($feedback)){ echo $tfbemail1; } ?>"/><br /><br />
						<input type="text" class="input_field_login" name="tfb_email2" placeholder="REPEAT EMAIL" value="<?php if(isset($feedback)){ echo $tfbemail2; } ?>"/><br /><br />
						<p>The password must be at least 10 characters long, contain one special character and one number.</p>
						<input type="password" class="input_field_login" name="tfb_password1" placeholder="PASSWORD" value="<?php if(isset($feedback)){ echo $tfbpass1; } ?>"/><br /><br />
						<input type="password" class="input_field_login" name="tfb_password2" placeholder="REPEAT PASSWORD" value="<?php if(isset($feedback)){ echo $tfbpass2; } ?>"/><br /><br />
						<input type="submit" class="submit_button_login" name="submit" value="CREATE ACCOUNT" />
					</form>
					<?php if(isset($_GET['success'])){ ?><p class ="breadtext" style="color: green";>Account succesfully created!</p><?php } ?>
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
							<a href="" class="white_to_green">Privacy policy</a> | <a href="" class="white_to_green">Terms & Conditions</a> | 
							<a href="http://www.rooter.se" class="white_to_green" target="_blank">rooter.se</a> 
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