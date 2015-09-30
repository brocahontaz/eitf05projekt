<?php 
	require_once("includes/header.php");
?>
	
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
<?php 
	require_once("includes/footer.php");
?>