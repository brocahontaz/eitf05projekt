<?php 
	require_once("includes/database.php");
	require_once("includes/mysql_connect_data.php");
	require_once("includes/user.php");
	require_once("includes/setup.php");
	$db = new Database($host, $userName, $password, $database);
	$isLogedIn = isset($_SESSION['username']);
	if ($isLogedIn) {
		$user = $_SESSION['user'];
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
			<div id="frontpage_big_pic">
				<div id="frontpage_big_pic_container">
					<div id="frontpage_big_pic_content">
						<div id="frontpage_header_box">
							<span class="header1">
								FRESH FRUIT
							</span>
							<br />
							<span class="header2">
								DIRECTLY TO
								<br />
								YOUR DOOR
							</span>
						</div>
						<div id="frontpage_header_text">
							We have carefully handpicked the best fruit from <br />
							local markets and gardens all around the world, <br />
							for you to enjoy. Without ever having to leave <br />
							your cosy home, the delights of the world are <br />
							yours to claim - just a click away!
						</div>
						<a href="store.php">
						<div id="frontpage_header_button">
							BROWSE NOW!
						</div>
						</a>
					</div>
				</div>
			</div>
			<div id="color_box_wrapper">
				<div id="color_box_left">
					<div class="color_box_content left">
						<div class="color_box_image">
							<img src="./images/norweiganbanana.png" class="c_b_image" />
						</div>
						<div class="color_box_text_container">
							<p class="color_box_header1">
								NEW IN STOCK
							</p>
							<p class="color_box_header2">
								NORWEIGAN BANANAS
							</p>
							<p class="color_box_text">
							Straight from the plantations in Trondheim, we bring you this delicious treat for the family to enjoy. <br />
							SPECIAL SALE - NOW ONLY 9.99$ PER PIECE
							</p>
							<a href="">
							<div class="color_box_button">
								GET NOW
							</div>
							</a>
						</div>
					</div>
				</div>
				<div id="color_box_right">
					<div class="color_box_content right">
						<div class="color_box_text_container">
							<p class="color_box_header1">
								FAN FAVORITE
							</p>
							<p class="color_box_header2">
								WALKING PUMPKIN
							</p>
							<p class="color_box_text">
							This magical sensation will tickle your taste buds once again, as it is finally returning by popular demand. 
							Be sure to claim yours today, before they run away forever.
							</p>
							<a href="">
							<div class="color_box_button">
								GET NOW
							</div>
							</a>
						</div>
						<div class="color_box_image">
							<img src="./images/walkingpumpkin.png" class="c_b_image" />
						</div>
					</div>
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
							<a href="http://www.rooter.se" class="white_to_green" target="_blank">Johan</a> <br />
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