<!DOCTYPE HTML>
<html>
	<head>
		<title>
			thefruitbasket
		</title>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" />
		<link rel="icon" type="image/png" href="./images/favicon.png" />
		
		<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>-->
		<script src="script/jquery.js" type="text/javascript"></script>
		<script src="script/jquery-ui.js" type="text/javascript"></script>
		<script src="script/menu.js" type="text/javascript"></script>
		<script src="script/about.js" type="text/javascript"></script>
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
									<input type="hidden" name="token" value="<?php echo $token; ?>" />
									<input type="submit" class="login_button" name="submit" value="SIGN IN" />
								</form>
								
								<?php 
								if(!empty($login_error)){
									if($login_error == "empty"){ $error = "All fields must be filled."; }
									if($login_error == "user"){ $error = "Username is of wrong format."; }
									if($login_error == "pw"){ $error = "Password is of wrong format."; }
									if($login_error == "nonexistent"){ $error = "Username not found."; }
									if($login_error == "wrongpw"){ $error = "Wrong password."; }
									if(isset($error)){
										echo "<p class='error'>" . $error . "</p>";
									}
								} 	
								?>
								
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