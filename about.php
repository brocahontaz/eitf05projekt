<?php 
	require_once("includes/header.php");
?>
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
			<?php 
	require_once("includes/footer.php");
?>