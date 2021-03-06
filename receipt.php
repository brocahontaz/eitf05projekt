<?php 
	require_once("includes/setup.php");
	$isLogedIn = isset($_SESSION['username']);
	
	if (isset($_SESSION["cart"]) && $_GET['token'] == $_SESSION['token']) { 
		$cart  = $_SESSION["cart"]; 
	} else { 
		header("location: index.php"); 
	} 
	if ($isLogedIn) {
		$user = $_SESSION['user'];
		$username = $user->getUserName();
	} else {
		header("location: index.php");
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
	
					<div class="store_header_box">
						ORDER RECEIPT
					</div>
					<?php $products = $_SESSION['cart']; 
					unset($_SESSION['cart']);	
					$db->deleteCart($user->getUserName());	
					?>
					<div class="product">
						<div class="product name"><b>Id</b></div>
						<div class="product name"><b>Product</b></div>
						<div class="product name"><b>Price</b></div>
					</div>
					<?php foreach($products as $product) { ?>
						<?php $productinfo = $db->getProductInfo($product['productId']); ?>
						<div class="product">
							<?php foreach($productinfo as $pinfo) { 
								$cartproducts[] = $pinfo;
							?>	
							
								<div class="product price"><?php echo $pinfo['productId']; ?></div>
								<div class="product name"><?php echo $pinfo['productName']; ?></div>
								<div class="product price"><?php echo $pinfo['price']; ?> SEK</div>
								
								
							<?php } ?>
						</div>
					<?php } ?>
					<div class="product">
						<div class="product name"><b></b></div>
						<div class="product name"><b>Total sum</b></div>
					</div>
					<?php 
					$pricesum = $_SESSION['sum'];
					unset($_SESSION['sum']);
					?>
					<?php foreach($pricesum as $psum) { ?>
					<div class="product">
						<div class="product name"><b></b></div>
						<div class="product name"><b></b></div>
						<div class="product price"><?php echo round($psum[0]); ?> SEK</div>
					</div>
					<?php } ?>
					
				</div>
			</div>
<?php 
	require_once("includes/footer.php");
?>