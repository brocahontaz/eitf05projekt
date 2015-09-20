$(document).ready(function() {
	$('.menu_object').hover(function() {
		$(this).toggleClass('menu_object_hover', 500);
	});
	$('.menu_object_active').hover(function() {
		$(this).toggleClass('menu_object_hover', 500);
	});
});