<?php 
	require_once("includes/setup.php");
	$isLogedIn = isset($_SESSION['username']);
	$page = setPage($_GET['page']);
	if (isset($_GET["user"])) { $getuser  = $_GET["user"]; } else { header("location: index.php"); }; 
	$num_per_page = 12;
	
	if ($isLogedIn) {
		$user = $_SESSION['user'];
		$username = $user->getUserName();
		if(!($getuser == $user->getUserName())) {
			header("location: shoppingcart.php?user=$username");
		}
		$cartproducts = $db->getCart($username);
		if(!isset($cartproducts)) { header("location: index.php"); }
		$_SESSION['cart'] = $cartproducts;
		$_SESSION['sum'] = $db->getSum($username);
	} else {
		header("location: index.php");
	}
	
	$token = md5(uniqid(rand(), TRUE));
	$_SESSION['token'] = $token;
	include("includes/header.php");
?>
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
						SHOPPING CART
					</div>
					<?php $products = $db->getCart($username); ?>
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
					<?php $pricesum = $db->getSum($username); ?>
					<?php foreach($pricesum as $psum) { ?>
					<div class="product">
						<div class="product name"><b></b></div>
						<div class="product name"><b></b></div>
						<div class="product price"><?php echo round($psum[0]); ?> SEK</div>
					</div>
					<?php } ?>
					<div class="product pay">
						<div class="product name"><b></b></div>
						<a href="receipt.php?token=<?php echo $token; ?>">
						<div id="pay_button"><b>Checkout</b></div>
						</a>
					</div>
				</div>
			</div>
<?php 
	require_once("includes/footer.php");
?>