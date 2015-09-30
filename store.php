<?php 
	require_once("includes/header.php");
?>

<?php 
	if ($isLogedIn) {
		$user = $_SESSION['user'];
	}
	
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
	$num_per_page = 12;
	if(isset($_GET["addid"])) {
		$productId = $_GET["addid"];
		$pagecart = $_GET["page"];
		$db->addProductToCart($user->getUserName(), $productId);
		header("Location: store.php?page=$page");
	}
	
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
							<a href="store.php?page=<?php echo $page ?>&addid=<?php echo $promotedproduct['productId']; ?>" class="lgreen_to_dgreen">BUY NOW</a>
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
							<a href="store.php?page=<?php echo $page ?>&addid=<?php echo $product['productId']; ?>" class="lgreen_to_dgreen">BUY NOW</a>
						</div>
					</div>
					<?php } ?>
					<?php } ?>
				</div>
			</div>			
<?php 
	require_once("includes/footer.php");
?>