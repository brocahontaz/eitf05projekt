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