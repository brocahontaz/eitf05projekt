<?php 
	require_once("includes/database.php");
	require_once("includes/mysql_connect_data.php");
	require_once("includes/user.php");
	require_once("includes/setup.php");
	$db = new Database($host, $userName, $password, $database);
	$isLogedIn = isset($_SESSION['username']);
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
	$num_per_page = 12;
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
						<a href="store.php?browseall" class="menu_object_active">
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
					<div id="store_menu">
					<?php if(isset($_GET['browseall']) || !isset($_GET['browsecategory'])) { ?>
					<a href="store.php?browseall" class="store_menu_object active">
					BROWSING ALL
					<?php } else { ?>
					<a href="store.php?browseall" class="store_menu_object">
					BROWSE ALL
					<?php } ?>
					</a>
					<?php if(isset($_GET['browsecategory'])) { ?>
					<a href="store.php?browsecategory" class="store_menu_object active">
					BROWSING BY CATEGORY
					<?php } else { ?>
					<a href="store.php?browsecategory" class="store_menu_object" id="cat">
					BROWSE BY CATEGORY
					<?php } ?>
					</a>
					</div>
					<?php if(isset($_GET['browseall']) || !isset($_GET['browsecategory'])) { ?>
					<div class="store_header_box">
						PROMOTED
					</div>
					<?php $promoted = $db->listPromotedProducts(); ?>
					<?php foreach($promoted as $promotedproduct) { ?>
					<div class="promoted_store_object">
						<div class="promoted_category">
							<?php echo strtoupper($promotedproduct['categoryName']); ?>
						</div>
						<div class="promoted_picture" style="background-image:url('images/products/<?php echo $promotedproduct['productName']; ?>.png')">
							<img src="" class="image_promoted" />
						</div>
						<div class="promoted_name">
							<?php echo strtoupper($promotedproduct['productName']); ?>
						</div>
						<div class="promoted_info">
							Anno 1961 <br/>
							<?php echo $promotedproduct['price']; ?> SEK
						</div>
						<div class="buy_now">
							<a href="product.php?id=<?php echo $promotedproduct['productId']; ?>" class="lgreen_to_dgreen">BUY NOW</a>
						</div>
					</div>
					<?php } ?>
					
					<div class="store_header_box">
						PRODUCTS
						<div id="paginate">
							<?php
								$total_pages = $db->getPages($num_per_page);
								echo "<a href='store.php?browseall&page=1' class='lgreen_to_dgreen'>".'|<'."</a> ";
								for ($i=1; $i<=$total_pages; $i++) { 
								echo "<a href='store.php?browseall&page=".$i."' class='lgreen_to_dgreen'>".$i."</a> "; 
								}; 
								echo "<a href='store.php?browseall&page=$total_pages' class='lgreen_to_dgreen'>".'>|'."</a> ";
							?>
						</div>
					</div>
					<?php $products = $db->getProductsPaginate($page, $num_per_page); ?>
					<?php foreach($products as $product) { ?>
					<div class="store_object">
						<div class="product_category">
							<?php echo strtoupper($product['categoryName']); ?>
						</div>
						<div class="product_picture" style="background-image:url('images/products/<?php echo $product['productName']; ?>.png')">
							<img src="" class="image_promoted" />
						</div>
						<div class="product_name">
							<?php echo strtoupper($product['productName']); ?>
						</div>
						<div class="product_info">
							<?php echo $product['price']; ?> SEK
						</div>
						<div class="buy_now small">
							<a href="product.php?id=<?php echo $product['productId']; ?>" class="lgreen_to_dgreen">BUY NOW</a>
						</div>
					</div>
					<?php } ?>
					<?php } ?>
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