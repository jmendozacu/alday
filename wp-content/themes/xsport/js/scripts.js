/*
| ----------------------------------------------------------------------------------
| TABLE OF CONTENT
| ----------------------------------------------------------------------------------
|	
|	01.Lazy Background non Mobile         
|	02.Disable Mobile Animated   
|	03.Home slider And Sticky Header   
|	04.HOME SLIDER   
|	05.PARALAX SECTION            
|	06.SCROLL TOP          
|	07.HOVER TABS         
|	08.SLY   SCROLL            
|	09.POST SLIDER              
|	10.CATEGORY SLIDER  
|	11.Advanced Search              
|	12.SLIDER PRODUCTS         
|	13.ISOTOPE FILTER           
|	14.Qty product
|	15.Zoom Images                 
|	16.PRICE RANGE           
|	17.SELECT BOX              
|	18.SWITCHER GRID          
|	19.Animate anchor         
|	20.Flickr Feed          
|	21.STAR RATING   
|	22.SEarch By Category
|   23.Grid/List selector
*/


jQuery(".la-anim-1").addClass("la-animate");


  jQuery(document).ready(function($) {


    "use strict";


    var windowHeight = $(window).height();
    var windowWidth = $(window).width();
	
	
	
		 /////////////////////////////////////
    //  iframe
    /////////////////////////////////////


		$('.wpb_map_wraper').click(function () {
			$('iframe').css("pointer-events", "auto");
		});


	
	  /////////////////////////////////////////////////////////////////
    // LOADER
    /////////////////////////////////////////////////////////////////


	var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner-loader');
    $spinner.fadeOut();
    $preloader.delay(50).fadeOut('slow');



    /////////////////////////////////////
    //  Animated
    /////////////////////////////////////


    if (windowWidth < 1140) {

        $(".layout-theme").removeClass("animated-all");



    }



    $('.animated-all .animated:not(.animation-done)').waypoint(function() {



        var animation = $(this).data('animation');

        $(this).addClass('animation-done').addClass(animation);

    }, {
        triggerOnce: true,
        offset: '90%'
    });




    /////////////////////////////////////////////////////////////////
    //   Dropdown Menu Fade 
    /////////////////////////////////////////////////////////////////
	
	
var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('.sidebar-menu-wrap ').toggleClass('toggled');
  });  
  
  
   
  $('.mobile-menu').click(function () {
        $('.yamm ').toggle();
  });  
	 



	
	

	

    $(".yamm  .dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('#main-menu .dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );


    $(".yamm .navbar-nav > li").hover(
        function() { $('.dropdown-menu', this).fadeIn("fast");
        },
        function() { $('.dropdown-menu', this).fadeOut("fast");
    });




        window.prettyPrint && prettyPrint()
        $(document).on('click', '.yamm .dropdown-menu', function(e) {
          e.stopPropagation()
        })





   
    /////////////////////////////////////
    //  Home slider And Sticky Header
    /////////////////////////////////////

    function sliderAutoHeight() {


      
	    if (windowWidth > 770) {
			
			
			  if ($('body').length) {
            $(window).on('scroll', function() {
                var winH = $(window).scrollTop();
                var $pageHeader = $('.yamm');
				 var $sidenav = $('.sidebar-menu-wrap');
                if (winH > windowHeight - 420) {
                    $pageHeader.addClass('navbar-fixed-top');
					$sidenav.addClass('navbar-fixed-sidebar');
                } else {
                    $pageHeader.removeClass('navbar-fixed-top');
					$sidenav.removeClass('navbar-fixed-sidebar');
                }
            });
        }

}

        var slider = $("#iview");




        if (windowHeight > 450) {

            slider.css("max-height", windowHeight - 45);




        };




    };


    sliderAutoHeight();


    $(window).resize(function() {
        sliderAutoHeight();
    });


    ////////////////////////////////////////////  
    // HOME SLIDER
    ///////////////////////////////////////////  

    if ($('#iview').length > 0) {


        $('#iview').iView({
            pauseTime: 6000,
            pauseOnHover: false,
            directionNavHoverOpacity: 0,
            timer: "Bar",
            timerDiameter: "50%",
            timerPadding: 0,
            timerStroke: 7,
            timerBarStroke: 0,
            timerColor: "#FFF",
            timerPosition: "bottom-right",
            nextLabel: "",
            previousLabel: "",
        });


    }



    ////////////////////////////////////////////  
    // PARALAX SECTION
    ///////////////////////////////////////////  




    $(window).scroll(function(e) {
        parallax();
    });



    function parallax() {
        var scrolled = $(window).scrollTop();
        $('.animated-all .parallax-bg').css('top', -(scrolled * 0.9) + 'px' - 40);
    }





/*  var x = 0;
	        var y = 0;
			//cache a reference to the banner
	        var banner = $(".parallax-bg");

			// set initial banner background position
	        banner.css('backgroundPosition', x + 'px' + ' ' + y + 'px');

	 		// scroll up background position every 90 milliseconds
	        window.setInterval(function() {
	        	banner.css("backgroundPosition", x + 'px' + ' ' + y + 'px');
	            y--;
	            //x--;

	            //if you need to scroll image horizontally -
	            // uncomment x and comment y

	        }, 90);
			*/
			

    ////////////////////////////////////////////  
    // SCROLL TOP
    ///////////////////////////////////////////



    $('.scroll-top').click(function(event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: 0
        }, 300);
    });



    ////////////////////////////////////////////  
    // HOVER TABS
    ///////////////////////////////////////////  



    $('.about-tabs a').hover(function(e) {
        e.preventDefault()
        $(this).tab('show')
    });





	    /////////////////////////////////////
        //  BX CAROUSELS
        /////////////////////////////////////
		
		
		function carouselReload (){
	

													
$(".x-frame").each(function (i) {
	

   
   
  var prevArrow =  $(this).next().children(".prev-page");
  var nextArrow =  $(this).next().children(".next-page");
   
   
    $(this).sly(

        {
            horizontal: 1,
            itemNav: 'basic',
            smart: 1,
            activateOn: 'click',
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,

            activatePageOn: 'click',
            speed: 300,
            elasticBounds: 1,
            easing: 'easeOutExpo',
            dragHandle: 1,
            dynamicHandle: 1,
            clickBar: 1,

            // Buttons
            prevPage: prevArrow,
            nextPage: nextArrow
        }

    );
			   
    
			
});

		}



  carouselReload ();




    /////////////////////////////////////
    // POST SLIDER
    /////////////////////////////////////


    $('.carousel-post').bxSlider({
        minSlides: 1, // item 5
        maxSlides: 1, // item 4
        slideWidth: 870,
        infiniteLoop: true,
        auto: true,
        nextText: '',
        prevText: '',
        pagerSelector: '1'
    });




    /////////////////////////////////////
    // CATEGORY SLIDER
    /////////////////////////////////////


    $('.category-slider').bxSlider({
        minSlides: 1, // item 5
        maxSlides: 1, // item 4
        slideWidth: 1250,
        infiniteLoop: true,
        auto: false,
        nextText: '',
        prevText: ''

    });

    $('.product_list_widget').bxSlider({
        minSlides: 3, // item 5
        maxSlides: 3, // item 4
        slideWidth: 350,
        infiniteLoop: true,
        slideMargin: 5,
        auto: true,
        mode: 'vertical',
        nextText: '',
        prevText: '',
        pagerSelector: '1'
    });




    $('.bx-next').html(' <i class="icomoon-arrow-right"></i>');
    $('.bx-prev').html(' <i class="icomoon-arrow-left"></i>');

    $('.flex-next').html(' <i class="icomoon-arrow-right"></i>');
    $('.flex-prev').html(' <i class="icomoon-arrow-left"></i>');




    ////////////////////////////////////////////  
    // Advanced Search
    ///////////////////////////////////////////  



    $('.search-panel .dropdown-menu').find('a').click(function(e) {
        e.preventDefault();
        var param = $(this).attr("href").replace("#", "");
        var concept = $(this).text();
        $('.search-panel span#search_concept').text(concept);
        $('.input-group #search_param').val(param);
    });




    ////////////////////////////////////////////  
    // SLIDER PRODUCTS
    ///////////////////////////////////////////  
	
	
	



    if ($('#slider-product').length > 0) {


        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 105,
            itemMargin: 4,
            asNavFor: '#slider-product'
        });

        $('#slider-product').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });


    }



    ////////////////////////////////////////////  
    // ISOTOPE FILTER
    ///////////////////////////////////////////	 
	
	
	if ($('#pix-portfolio  .isotope-filter').length > 0) {		
		
		
			// or with jQuery
var $container = $('.isotope-filter');
// initialize Masonry after all images have loaded  
$container.imagesLoaded( function() {
  $container.masonry();
});


    $('#pix-portfolio .isotope-filter').isotope({
        itemSelector: '.isotope-item',
		resizesContainer: true
    });
	
	

    $('#pix-portfolio #filter a').click(function() {

        $('#pix-portfolio #filter a').removeClass('current');
        $(this).addClass('current');
        var selector = $(this).attr('data-filter');

        $('#pix-portfolio .isotope-filter').isotope({
            filter: selector,
            animationOptions: {
                duration: 1000,
                easing: 'easeOutQuart',
                queue: false
            }
        });
        return false;

    });

   
   
   
		}
		
		




	if ($('#pix-shop  .isotope-filter').length > 0) {		
		
		
			// or with jQuery
var $container = $('.isotope-filter');
// initialize Masonry after all images have loaded  
$container.imagesLoaded( function() {
  $container.masonry();
});


    $('#pix-shop .isotope-filter').isotope({
        itemSelector: '.isotope-item',
		resizesContainer: true,
		filter: ':nth-child(-n+'+maxIsoItems+')'
    });
	
	

    $('#pix-shop #filter a').click(function() {

        $('#pix-shop  #filter a').removeClass('current');
        $(this).addClass('current');
        var selector = $(this).attr('data-filter');

        if (selector == "*") selector = '.isotope-item';

console.log(selector + ':nth-child(-n+'+maxIsoItems+')');


        $('#pix-shop  .isotope-filter').isotope({
            filter: selector + ':nth-child(-n+'+maxIsoItems+')',
            resizesContainer: true,
            animationOptions: {
                duration: 1000,
                easing: 'easeOutQuart',
                queue: false
            }
        });
        return false;

    });

   
   
   
		}
		

    /////////////////////////////////////
    // Qty
    /////////////////////////////////////



     $(".minus_btn").click(function() {
		 
		
        var inputEl =  $(this).parent().children().next('.qty').children();
        var qty = inputEl.val();
        if ( $(this).parent().hasClass("minus_btn"))
            qty++;
        else
            qty--;
        if (qty < 0)
            qty = 0;
            
            
            
        inputEl.val(qty);
    })


     $(".plus_btn").click(function() {
        var inputEl =  $(this).parent().children().next('.qty').children();
        var qty = inputEl.val();
        if ( $(this).hasClass("plus_btn"))
            qty++;
        else
            qty--;
        if (qty < 0)
            qty = 0;
        inputEl.val(qty);
    })



    /////////////////////////////////////
    //  Zoom Images
    /////////////////////////////////////

/*    $("a.magnific").magnificPopup({
        type: 'image'
    });
*/

/*    $("#slider-product .slides > li a").magnificPopup({
        type: 'image'
    });

*/


    /////////////////////////////////////
    //  Zoom Images
    /////////////////////////////////////

    $("a[rel^='prettyPhoto']").prettyPhoto();



    $(".video-popab").prettyPhoto({
        theme: 'dark_square'
    });




    $(".product-grid li").hover(
        function() {
			
				
				
            $(this).addClass('x-hovered-active');
        },
        function() {
            $(this).removeClass('x-hovered-active');
        }
    );

    $("#cd-team li").hover(
        function() {
            $(this).addClass('x-hovered-active');
        },
        function() {
            $(this).removeClass('x-hovered-active');
        }
    );





    /////////////////////////////////////
    // SELECT BOX
    /////////////////////////////////////


    if ($('.widget select').length > 0) {

        $(".widget select").selectbox();

    }

    if ($('.widget-filter').length > 0) {

        $(".widget-filter select").selectbox();

    }

/*    if ($('.form-group select').length > 0) {

        $(".form-group select").selectbox();


    }*/

    /////////////////////////////////////
    // SWITCHER GRID
    /////////////////////////////////////
	
	


	$(".catalog-grid").css("display", "none");
    $(".catalog-grid").fadeIn(200);





    $('.filter-panel #list').click(function(event) {
        event.preventDefault();
			$(".catalog-grid").css("display", "none");
        $('.catalog-grid .product-grid').removeClass('grid-view');
        $('.catalog-grid .product-grid').addClass('list-view');
		$.cookie("pix_cat_view_type", 1);
		    $(".catalog-grid").fadeIn(200);
    });
    $('.filter-panel #grid').click(function(event) {
        event.preventDefault();
				$(".catalog-grid").css("display", "none");
        $('.catalog-grid .product-grid').removeClass('list-view');
        $('.catalog-grid .product-grid').addClass('grid-view');
		$.cookie("pix_cat_view_type", 0);
		   $(".catalog-grid").fadeIn(200);
    });

    $('.filter-panel #list').click(function() {
			$(".catalog-grid").css("display", "none");
        $('#grid').removeClass("active-btn");
        $(this).addClass("active-btn");
		   $(".catalog-grid").fadeIn(200);
    });
    $('.filter-panel #grid').click(function() {
			$(".catalog-grid").css("display", "none");
        $('#list').removeClass("active-btn");
        $(this).addClass("active-btn");
		   $(".catalog-grid").fadeIn(200);
    });

	
	if ($.cookie("pix_cat_view_type") == 0){
		$('.filter-panel #grid').click();
	}else{
		$('.filter-panel #list').click();
	}

    $('.toggle_sidebar').click(



        function() {

            $(this).toggleClass("active-btn");


            $(".col-resize").toggleClass("col-resize-full-width");

            $(".sidebar-resize").toggle();

        }



    )
	


    ////////////////////////////////////////////  
    // Animate anchor
    ///////////////////////////////////////////  



    $(function() {
        $('.toggle_sidebar[href^="#"]').click(function() {
            var target = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1400);
            return false;
        });
    });

    $(function() {
        $('.add-rev-link[href^="#"]').click(function() {
            var target = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1400);
            return false;
        });
    });


    $(function() {
        $('.iview-caption .btn[href^="#"]').click(function() {
            var target = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(target).offset().top
            }, 1400);
            return false;
        });
    });





    $(document).ready(function() {

        
        
        //////////// SEARCH BY CATEGORY /////////////
        
        
        $("#search_filter_header a").on("click",function(){
        	var _href=jQuery(this).attr("href");
        	_href=_href.replace("#","");
        	if (_href != 'blog'){
	        	$('#search_filter_header_input').val(_href);
				$('#search_filter_header_type').val("product");
				
        	}else{
				$('#search_filter_header_input').val("");
				$('#search_filter_header_type').val("post");
			}
        });
		
		
		//////////// GRID/LIST Selector /////////////
        
        
        ///////////////// QUICKVIEW ////////////////////
        
        $('a.quickview-list').on('click',function(event){
	        event.stopPropagation();
        	event.preventDefault();
        	showAjaxLoader();
        	var _href = jQuery(this).attr('href');
        	
        	$.ajax({
	            url: jQuery(this).attr('href'),
	            type: "GET",
	            success: function( response ){        
		        	hideAjaxLoader();	                   
		        	parseQuickViewResponse(response,_href);
		        }
		    });
        	
        });
		
		
		    if ($('#pix-shop .isotope-filter').length > 0) {

            
        if ($('#pix-shop .isotope-filter')){
	        setTimeout(function(){
		       $('#pix-shop .isotope-filter').isotope({
		        itemSelector: '.isotope-item',
				resizesContainer: true,
				filter: ':nth-child(-n+'+maxIsoItems+')'
		    }); 
	        }, 500)
	        

	        
        }

    }
	
	

        
        function parseQuickViewResponse(response,href){
        
        	var _content = $(response).find('.row .product:first > .row').html();
        	
        	//console.log(_content);
        
	        $.fancybox({
	        	'content': _content,
	        	'width': 750,
	        	'autoDimensions': false,
	        	'autoSize':false
	        });
	        
	        $('#carousel').flexslider({
	            animation: "slide",
	            controlNav: false,
	            animationLoop: false,
	            slideshow: false,
	            itemWidth: 105,
	            itemMargin: 4,
	            asNavFor: '#slider-product'
	        });
			
			
	
	        $('#slider-product').flexslider({
	            animation: "slide",
	            controlNav: false,
	            animationLoop: false,
	            slideshow: false,
	            sync: "#carousel"
	        });
	        
	        $.fancybox.update();
	        
	       $(".minus_btn").click(function() {
		 
		
		        var inputEl =  $(this).parent().children().next('.qty').children();
		        var qty = inputEl.val();
		        if ( $(this).parent().hasClass("minus_btn"))
		            qty++;
		        else
		            qty--;
		        if (qty < 0)
		            qty = 0;
		            
		            
		            
		        inputEl.val(qty);
		    });
		
		
		     $(".plus_btn").click(function() {
		        var inputEl =  $(this).parent().children().next('.qty').children();
		        var qty = inputEl.val();
		        if ( $(this).hasClass("plus_btn"))
		            qty++;
		        else
		            qty--;
		        if (qty < 0)
		            qty = 0;
		        inputEl.val(qty);
		    });
		    
		    
		    jQuery('.single_add_to_cart_button').attr('onClick','addFromQuickView("'+href+'?add-to-cart='+jQuery('input[name=add-to-cart]').val()+'")')
		    

	        
        }
        
        
        
        
        
        
        
        //////////////// QUICKVIEW END ///////////////////
        
        
        
        /*
	    | ----------------------------------------------------------------------------------
	    |	Ajax Filters
	    | ----------------------------------------------------------------------------------
	    */
	
	    function updateProductGrid(response) {
	    
	        //Grid.clearItems();
	        jQuery('.product-grid').html($(response).find('.product-grid').html());
	        
	        
	        if (typeof($(response).find('.widget_layered_nav').html()) == 'undefined') {
	            jQuery('.widget_layered_nav').html("");
	        } else {
	        	
	        	$(response).find('.widget_layered_nav').each(function(){
		        	var _blockId = $(this).attr('id');
		        	console.log(_blockId);
		        	$("#" + _blockId).html($(this).html());
	        	});
	        	
	        	
	        	
//	            jQuery('.widget_layered_nav').html($(response).find('.woocommerce-pagination').html());
	        }
	
	        if (typeof($(response).find('.woocommerce-pagination').html()) == 'undefined') {
	            jQuery('.woocommerce-pagination').html("");
	        } else {
	            jQuery('.woocommerce-pagination').html($(response).find('.woocommerce-pagination').html());
	        }
	
	        //Grid.addItems(jQuery('#og-grid').children('li'));
	        //Grid.init();

			 $(".product-grid li").hover(
		        function() {
					
						
						
		            $(this).addClass('x-hovered-active');
		        },
		        function() {
		            $(this).removeClass('x-hovered-active');
		        }
		    );	 
		    
		    
		    if ($('.widget select').length > 0) {

		        $(".widget select").selectbox();
		
		    }
		
		    if ($('.widget-filter').length > 0) {
		
		        $(".widget-filter select").selectbox();
		
		    }
		
		    if ($('.form-group select').length > 0) {
		
		        $(".form-group select").selectbox();
		
		
		    }
		    
		    
		    $('a.quickview-list').on('click',function(event){
		        event.stopPropagation();
	        	event.preventDefault();
	        	showAjaxLoader();
	        	$.ajax({
		            url: jQuery(this).attr('href'),
		            type: "GET",
		            success: function( response ){               
			        	parseQuickViewResponse(response);
			        	hideAjaxLoader();
			        }
			    });
	        	
	        });
		    
		           

	    }
	
	/*
	    function addtoProductGrid(response) {
	        jQuery('#og-grid').append($(response).find('#og-grid').html());
	        Grid.init();
	    }*/
	
	
	    function hideAjaxLoader() {
	        jQuery('.catalog-grid').removeClass('ajax-loading');
	    }
	
	    function showAjaxLoader() {
	        jQuery('.catalog-grid').addClass('ajax-loading');
	    }
	
	    $(document).on('submit', '.widget_price_filter form', function(e) {
	        e.preventDefault();
	
	        var form = jQuery('.widget_price_filter form');
	
	        var href = form.attr('action');
	        var parentNavBlock = $(this).closest(".widget-content");
	        showAjaxLoader();
	        $.ajax({
	            url: href,
	            type: "GET",
	            data: form.serialize(),
	            success: function(response) {
	
	
	                //parentNavBlock.html($(response).find('#' + parentNavBlock.parent().attr('id') + ' .widget-content').html());
	
	                //update browser history (IE doesn't support it)
	                if (!navigator.userAgent.match(/msie/i)) {
	                    window.history.pushState({
	                        "pageTitle": response.pageTitle
	                    }, "", href);
	                }
	
	
	
	                updateProductGrid(response);
	
	
	
	                $(document).trigger("ready");
	                $(document).trigger("pix_activate_ajax_filters");
	                hideAjaxLoader();
	            }
	
	        });
	
	    });
	
	
	    $(document).on('submit', 'form.woo-ordering', function(e) {
	        e.preventDefault();
	
	        var form = jQuery('.woo-ordering');
	
	        var href = form.attr('action');
	        var parentNavBlock = $(this).closest(".widget-content");
	        showAjaxLoader();
	        $.ajax({
	            url: href,
	            type: "GET",
	            data: form.serialize(),
	            success: function(response) {
	
	
	                //parentNavBlock.html($(response).find('#' + parentNavBlock.parent().attr('id') + ' .widget-content').html());
	
	                //update browser history (IE doesn't support it)
	                if (!navigator.userAgent.match(/msie/i)) {
	                    window.history.pushState({
	                        "pageTitle": response.pageTitle
	                    }, "", href);
	                }
	
	
	
	                updateProductGrid(response);
	
	
	
	                $(document).trigger("ready");
	                $(document).trigger("pix_activate_ajax_filters");

	                hideAjaxLoader();
	            }
	
	        });
	    });
	
	
	    $(document).on('click', '.widget_layered_nav a', function(e) {
		    
		    if ($(this).hasClass('sbSelector'))
		    	return false;
		    
		    
	        showAjaxLoader();
	        var parentNavBlock = $(this).closest(".widget-content");
	
	
	        e.preventDefault();
	        var href = this.href;
	
	        $.ajax({
	            url: href,
	            success: function(response) {
	
	
	                parentNavBlock.html($(response).find('#' + parentNavBlock.parent().attr('id') + ' .widget-content').html());
	
	                //update browser history (IE doesn't support it)
	                if (!navigator.userAgent.match(/msie/i)) {
	                    window.history.pushState({
	                        "pageTitle": response.pageTitle
	                    }, "", href);
	                }
	
	
	
	                updateProductGrid(response);
	                $(document).trigger("ready");
	                $(document).trigger("pix_activate_ajax_filters");
	              /*  Grid.init();*/
	                hideAjaxLoader();
	            }
	
	        });
	
	    });
	
	
	
	    function pix_activate_ajax_filters() {
	
	        /*
				| ----------------------------------------------------------------------------------
				| Filter
				| ----------------------------------------------------------------------------------
				*/
	
	
	        $('.shop-sidebar  h3').on('click', function() {
	
	            $(this).parent().toggleClass('block-item-show');
	
	        });
	
	        $('.shop-sidear h3').on('click', function() {
	
	            $(this).parent().toggleClass('block-item-show');
	
	        });
	
	
	  /*      Grid.init();*/
	
	    }
        
        
        
        
    });
    
    
    
    


});

function addFromQuickView(baseUrl){
	        location.href=baseUrl+'&quantity='+jQuery('.qty input').val();
	        
        }

