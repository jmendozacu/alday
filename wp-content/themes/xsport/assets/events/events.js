jQuery(document).ready(function($){
	//create the slider
	
	
	
	$('.cd-events-wrapper').flexslider({
		selector: ".cd-events > li",
		animation: "slide",
		auto: true,
		controlNav: false,
		slideshow: false,
		smoothHeight: true,
		start: function(){
			$('.cd-events').children('li').css({
				'opacity': 1,
				'position': 'relative'
			});
		}
	});
	
	

	//open the events modal page
	$('.cd-see-all').on('click', function(){
		$('.cd-events-all').addClass('is-visible');
	});

	//close the events modal page
	$('.cd-events-all .close-btn').on('click', function(){
		$('.cd-events-all').removeClass('is-visible');
	});
	$(document).keyup(function(event){
		//check if user has pressed 'Esc'
    	if(event.which=='27'){
    		$('.cd-events-all').removeClass('is-visible');	
	    }
    });
    
	//build the grid for the events modal page
	$('.cd-events-all-wrapper').children('ul').masonry({
  		itemSelector: '.cd-events-item'
	});
});