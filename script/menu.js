//hover function for menu. changes background- & font-color, with a fade effect.
$(document).ready(function() {
	//add hover class when active
	$('.menu_object').hover(function() {
		$(this).toggleClass('menu_object_hover', 400);
	});
	//remove hover class when unactive
	$('.menu_object_active').hover(function() {
		$(this).toggleClass('menu_object_hover', 400);
	});
});