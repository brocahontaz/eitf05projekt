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
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="script/jquery.js" type="text/javascript"></script>
		<script src="script/jquery-ui.js" type="text/javascript"></script>
		<script src="script/menu.js" type="text/javascript"></script>
		<script>
			$(document).ready(function(){
				function toggleSlidesB(){
					$('.store_menu_object').click(function(e){
						var id = $(this).attr('id');
						
						// If this isn't already active
						if (!$(this).hasClass("active")) {
						// Remove the class from anything that is active
						$(".store_menu_object").removeClass("active");
						// And make this active
						$(this).addClass("active");
						}
						
						var widgetId = id.substring(id.indexOf('-') + 1, id.length);
						$('#' + widgetId).siblings('.sliderB').slideUp(600);
						$('#' + widgetId).delay(500).slideToggle();
						$(this).toggleClass('sliderExpandedB');
						$('.closeSliderB').click(function(){
							$(this).parent().hide('slow');
							var relatedToggler='togglerB-'+$(this).parent().attr('id');
							$('#'+relatedToggler).removeClass('sliderExpandedB');
						});
					});
				};
				$(function(){
					toggleSlidesB();
				});
			});
		</script>
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
						<a href="about.php" class="menu_object_active">
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
					<div id="store_menu">
					<a class="store_menu_object active" style="cursor: pointer" id="toggler-slideDescription">
					PROJECT DESCRIPTION
					</a>
					
					<a class="store_menu_object" style="cursor: pointer" id="toggler-slideReport">
					REPORT
					</a>
					
					<a class="store_menu_object" style="cursor: pointer" id="toggler-slideTeam">
					TEAM
					</a>
					
					<a class="store_menu_object" style="cursor: pointer" id="toggler-slideSource">
					SOURCE CODE
					</a>
					</div>
					<div id="slide_content">
					<div class="sliderB" id="slideDescription" style="display:inline">
					<h1>Web Shop Under Attack</h1>
					<p class="breadtext">
					AN EITF05 WEB SECURITY PROJECT
					</p>
					<p class="breadtext italic">
					The course includes one project assignment. This is a programming project in which you will create a small but (almost) fully functional web shop. 
					You will secure your web shop against some common web threats, and you will demonstrate how some of these attacks work and how to mitigate them.
					</p>
					</div>
					
					<div class="sliderB" id="slideReport">
					<h1>Report</h1>
					</div>
					
					<div class="sliderB" id="slideTeam">
					<h1>Team</h1>
					</div>
					
					<div class="sliderB" id="slideSource">
					<h1>Source Code</h1>
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