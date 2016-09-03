<?php

/********************* ADMIN LOGO ********************/



add_filter('login_headerurl', create_function('', 'return get_home_url();'));
add_filter('login_headertitle', create_function('', 'return false;'));

$envato['themeforest'] = array(
    "site-templates" => "HTML",
    "wordpress" => "Wordpress",
    "psd-templates" => "PSD",
    "ecommerce" => "eCommerce",
    "plugins" => "Plugins"
);
$envato['codecanyon']  = array(
    "plugins" => "Plugins"
);
/********************* DEFINE MAIN PATHS ********************/

define('PixTheme_PLUGINS', get_template_directory() . '/addons'); // Shortcut to the /addons/ directory
define('funcPATH', get_template_directory() . '/library/functions/');
$adminPath = get_template_directory() . '/library/admin/';
$funcPath  = get_template_directory() . '/library/functions/';
$incPath   = get_template_directory() . '/library/includes/';

global $pix_options;
$pix_options = isset($_POST['options']) ? $_POST['options'] : get_option('pix_general_settings');

/************************************************************/

/* include rwmb metabox */
if (!defined('RWMB_URL') && !defined('RWMB_DIR')) {
    define('RWMB_URL', trailingslashit(get_template_directory_uri() . "/library/functions/meta-box"));
    define('RWMB_DIR', trailingslashit(get_template_directory() . "/library/functions/meta-box"));
}

require_once RWMB_DIR . "meta-box.php";

/************* LOAD REQUIRED SCRIPTS AND STYLES *************/
function pixtheme_loadscripts()
{
    global $post;
    $pix_options = isset($_POST['options']) ? $_POST['options'] : get_option('pix_general_settings');
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
		
		
		        
        /* composer css*/

        wp_dequeue_style('js_composer_front');
        wp_deregister_style('js_composer_front');
        wp_enqueue_style('pix_composer-css', get_template_directory_uri() . '/css/js_composer.css');
        
		
		
        /* MAIN CSS */
        wp_enqueue_style('style', get_stylesheet_uri());
        wp_enqueue_style('pixtheme-woocommerce', get_template_directory_uri() . '/woocommerce/assets/css/woocommerce.css');
		   wp_enqueue_style('pixtheme-woocommerce-layout', get_template_directory_uri() . '/woocommerce/assets/css/woocommerce-layout.css');
		   
		   
		   
		if (!isset($pix_options['pix_responsive']) || (int)$pix_options['pix_responsive']) {
            wp_enqueue_style('pixtheme-responsive', get_template_directory_uri() . '/css/responsive.css');
        } else {
            wp_enqueue_style('pixtheme-no-responsive', get_template_directory_uri() . '/css/no-responsive.css');
        }

		  
	   /* PRIMARY CSS */
		wp_enqueue_style('pixtheme-bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_style('pixtheme-shop', get_template_directory_uri() . '/css/shop.css');
		wp_enqueue_style('pixtheme-theme', get_template_directory_uri() . '/css/theme.css');
		wp_enqueue_style('pixtheme-blog', get_template_directory_uri() . '/css/blog.css');
		wp_enqueue_style('pixtheme-animate', get_template_directory_uri() . '/css/animate.css');
	

 
        /* PLUGIN CSS */
		wp_enqueue_style('pixtheme-flexslider', get_template_directory_uri() . '/assets/flexslider/flexslider.css');
		wp_enqueue_style('pixtheme-yamm/', get_template_directory_uri() . '/assets/yamm3/yamm/yamm.css');
		wp_enqueue_style('pixtheme-isotope', get_template_directory_uri() . '/assets/isotope/isotope.css');
		wp_enqueue_style('pixtheme-prettyPhoto', get_template_directory_uri() . '/assets/prettyphoto/css/prettyPhoto.css');
		wp_enqueue_style('pixtheme-bxslider', get_template_directory_uri() . '/assets/bxslider/jquery.bxslider.css');
		wp_enqueue_style('pixtheme-selectbox', get_template_directory_uri() . '/assets/selectbox/jquery.selectbox.css');
			wp_enqueue_style('pixtheme-fancybox', get_template_directory_uri() . '/assets/fancybox/jquery.fancybox.css');

        if ((!empty($post) && has_shortcode($post->post_content, 'caurusel_content')) || is_page_template('template-home.php')) {
            wp_enqueue_style('pixtheme-bio', get_template_directory_uri() . '/assets/bio/css/bio.css');
        }
   
        wp_enqueue_style('pixtheme-mmenu', get_template_directory_uri() . '/assets/menu/css/addons/jquery.mmenu.dragopen.css');
        
        wp_enqueue_style('dynamic-styles', get_template_directory_uri() . '/css/dynamic-styles.php');
        

        
        
        // jQuery
                
        wp_enqueue_script('pixtheme-migrate', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.min.js', array(), '3.3', true);
        wp_enqueue_script('pixtheme-jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array(), '3.3', true);
        
        // Bootstrap Core JavaScript 
        
        wp_enqueue_script('pixtheme-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3', true);
        wp_enqueue_script('pixtheme-modernizr', get_template_directory_uri() . '/js/modernizr.js');
        
        // User agent 
        wp_enqueue_script('pixtheme-cssua', get_template_directory_uri() . '/js/cssua.min.js', array(), '3.3', true);

        // Waypoint
        wp_enqueue_script('pixtheme-waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array(), '3.3', true);
        
        // Ios Fix
        wp_enqueue_script('ios-orientationchange-fix', get_template_directory_uri() . '/js/ios-orientationchange-fix.js', array(), '3.3', true);
        
        //Bx Slider
        wp_enqueue_script('pixtheme-bxslider', get_template_directory_uri() . '/assets/bxslider/jquery.bxslider.min.js', array(), '3.3', true);
        
        // Flex Slider
        wp_enqueue_script('pixtheme-flexslider', get_template_directory_uri() . '/assets/flexslider/jquery.flexslider-min.js', array(), '3.3', true);
        
        
        // Pretty Photo 
        wp_enqueue_script('pixtheme-prettyphoto', get_template_directory_uri() . '/assets/prettyphoto/js/jquery.prettyPhoto.js', array(), '3.3', true);
		
		
		// flickrfeed
		 wp_enqueue_script('pixtheme-flickrfeed', get_template_directory_uri() . '/assets/jflickrfeed/jflickrfeed.min.js', array(), '3.3', true);
		 
		// fancybox
		 wp_enqueue_script('pixtheme-fancybox', get_template_directory_uri() . '/assets/fancybox/jquery.fancybox.pack.js', array(), '3.3', true);
		
		
		
        
        //Isotope filter
      
            wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/isotope/jquery.isotope.min.js', array(), '3.3', true);
        
		
		  //Element form Styled
         wp_enqueue_script('pixtheme-selectbox', get_template_directory_uri() . '/assets/selectbox/jquery.selectbox-0.2.js', array(), '0.2', true);

        
        //Sly Slider
        wp_enqueue_script('pixtheme-sly', get_template_directory_uri() . '/assets/sly/sly.min.js', array(), '3.3', true);
        // Events 
        if ((!empty($post) && has_shortcode($post->post_content, 'eventsblock')) || is_page_template('events-template.php') || is_page_template('template-home.php')) {
        	
        	if (isset($_GET['vc_action']) && $_GET['vc_action'] == 'vc_inline'){
	        	
        	}else{
	            wp_enqueue_script('pixtheme-events', get_template_directory_uri() . '/assets/events/events.js', array(), '3.3', true);
            
	            wp_enqueue_script('masonry', get_template_directory_uri() . '/assets/events/masonry.pkgd.min.js', array(), '3.3', true);
	        	
        	}
            
        }
        // Bio 
        if ((!empty($post) && has_shortcode($post->post_content, 'caurusel_content')) || is_page_template('template-home.php')) {
            wp_enqueue_script('pixtheme-bio', get_template_directory_uri() . '/assets/bio/js/bio.js', array(), '3.3', true);
        }
        
    wp_enqueue_script('masonry', get_template_directory_uri() . '/assets/events/masonry.pkgd.min.js', array(), '3.3', true);
        
        wp_enqueue_script('pixtheme-jquery-easing-min', get_template_directory_uri() . '/js/jquery.easing.min.js', array(), '3.3', true);
        wp_enqueue_script('pixtheme-jquery-easypiechart', get_template_directory_uri() . '/js/jquery.easypiechart.js', array(), '3.3', true);
        

      
		
		
		
		
        
        
        //Color switcher 
        
		if (pixtheme_get_option('pix_color_theme',false)){
			wp_enqueue_style('css-switcher-' . pixtheme_get_option('pix_color_theme','color1'), get_template_directory_uri() . '/assets/switcher/css/'. pixtheme_get_option('pix_color_theme','red') .'.css');
		}
		
        if (pixtheme_get_option('pix_show_color_selector',false)){
        		wp_enqueue_script('bootstrap-select', get_template_directory_uri() . '/assets/switcher/js/bootstrap-select.js', array(), '3.3', true);
        	wp_enqueue_script('colorpicker-evol', get_template_directory_uri() . '/assets/switcher/js/evol.colorpicker.min.js', array(), '3.3', true);
        	wp_enqueue_script('dmss-js', get_template_directory_uri() . '/assets/switcher/js/dmss.js', array(), '3.3', true);
        	wp_enqueue_style('css-switcher', get_template_directory_uri() . '/assets/switcher/css/switcher.css');

			
        	wp_enqueue_style('color1', get_template_directory_uri() . '/assets/switcher/css/color1.css');
          	wp_enqueue_style('color2', get_template_directory_uri() . '/assets/switcher/css/color2.css');
			wp_enqueue_style('color3', get_template_directory_uri() . '/assets/switcher/css/color3.css');
			wp_enqueue_style('color4', get_template_directory_uri() . '/assets/switcher/css/color4.css');
			wp_enqueue_style('color5', get_template_directory_uri() . '/assets/switcher/css/color5.css');
			wp_enqueue_style('color6', get_template_directory_uri() . '/assets/switcher/css/color6.css');
			wp_enqueue_style('color7', get_template_directory_uri() . '/assets/switcher/css/color7.css');
			wp_enqueue_style('color8', get_template_directory_uri() . '/assets/switcher/css/color8.css');
			wp_enqueue_style('color9', get_template_directory_uri() . '/assets/switcher/css/color9.css');


				        	        	        	
			global $wp_styles;
			$wp_styles->add_data( 'color1', 'rel', 'alternate' );
			$wp_styles->add_data( 'color2', 'rel', 'alternate' );
			$wp_styles->add_data( 'color3', 'rel', 'alternate' );	
			$wp_styles->add_data( 'color4', 'rel', 'alternate' );
			$wp_styles->add_data( 'color5', 'rel', 'alternate' );
			$wp_styles->add_data( 'color6', 'rel', 'alternate' );
			$wp_styles->add_data( 'color7', 'rel', 'alternate' );
			$wp_styles->add_data( 'color8', 'rel', 'alternate' );
			$wp_styles->add_data( 'color9', 'rel', 'alternate' );


		

			$wp_styles->add_data( 'color1', 'title', 'color1' );
			$wp_styles->add_data( 'color2', 'title', 'color2' );
			$wp_styles->add_data( 'color3', 'title', 'color3' );	
			$wp_styles->add_data( 'color4', 'title', 'color4' );
			$wp_styles->add_data( 'color5', 'title', 'color5' );
			$wp_styles->add_data( 'color6', 'title', 'color6' );
			$wp_styles->add_data( 'color7', 'title', 'color7' );
			$wp_styles->add_data( 'color8', 'title', 'color8' );
			$wp_styles->add_data( 'color9', 'title', 'color9' );


        }
        
        

		
		
			// Footer
		
		wp_enqueue_script('footer', get_template_directory_uri() . '/js/scripts.js', array() , '3.3', true);
		
		wp_dequeue_style('tribe-events-calendar-style');
		wp_deregister_style('tribe-events-calendar-style');
		
		wp_dequeue_style('tribe-events-full-calendar-style');
		wp_deregister_style('tribe-events-full-calendar-style');
		
		wp_enqueue_style('pix_tribe-events-calendar-style', get_template_directory_uri() . '/css/tribe-events-calendar-style.css');
		
		
		$useDefaultHeaderImg = true;
		
		if (get_queried_object()){
					
			if (isset(get_queried_object()->taxonomy) && get_queried_object()->taxonomy == 'product_cat'){
				
				$thumbnail_id = get_woocommerce_term_meta( get_queried_object()->term_id, 'thumbnail_id', true );
				
			    $image = wp_get_attachment_url( $thumbnail_id );
			    
			    if ( $image ) {
			    	
				    $page_bg = "#hs_".get_queried_object()->term_id." {background-image:url(".$image.")}";
				    wp_add_inline_style( 'pixtheme-shop', $page_bg );
					$useDefaultHeaderImg = false;
				}
			}else{
				
				if (isset(get_queried_object()->post_type) && get_queried_object()->post_type == 'product'){
					
					$product_cat_id = false;
					$terms = get_the_terms( get_queried_object()->ID, 'product_cat' );
					if ($terms){
						foreach ($terms as $term) {
							$product_cat_id = $term->term_id;					
							break;
						}
					}
					if ($product_cat_id){
						$thumbnail_id = get_woocommerce_term_meta( $product_cat_id, 'thumbnail_id', true );
					
						$image = wp_get_attachment_url( $thumbnail_id );
						
						if ( $image ) {
							$page_bg = "#hs_".get_queried_object()->ID." {background-image:url(".$image.")}";
							wp_add_inline_style( 'pixtheme-shop', $page_bg );
							$useDefaultHeaderImg = false;
						}
					}
					
					$page_desc = '';				
				}
			
			}
		}
		
		if (function_exists('is_shop') && is_shop()){		
			$_page = get_post(wc_get_page_id( 'shop' ));
			$thumbnail_id = get_post_thumbnail_id( $_page->ID);
			
		    $image = wp_get_attachment_url( $thumbnail_id );
		    
		    if ( $image ) {
			    $page_bg = "#hs_".$_page->ID." {background-image:url(".$image.")}";
				wp_add_inline_style( 'pixtheme-shop', $page_bg );
				$useDefaultHeaderImg = false;
			}
		}
		
		if ($useDefaultHeaderImg == true){
			//if ($post && $post->ID){
				$headerImg = pixtheme_get_option('pix_header_img');
				if ($headerImg){
					$page_bg = ".page-header-shop {background-image:url(".$headerImg.") !important}";
					wp_add_inline_style( 'pixtheme-shop', $page_bg );	
					
				}
			//}
			
		}
		
		
        
    }
}
add_action('wp_enqueue_scripts', 'pixtheme_loadscripts'); //Load All Scripts




function pixtheme_fonts()
{
    $pix_customize = get_option('pix_customize_options');
    $bodyFont      = isset($pix_customize['font_family']) ? $pix_customize['font_family'] : '';
    $bodyWeight    = isset($pix_customize['font_weight']) ? $pix_customize['font_weight'] : '';
    $titleFont     = isset($pix_customize['font_title_family']) ? $pix_customize['font_title_family'] : '';
    $titleWeight   = isset($pix_customize['font_title_weight']) ? $pix_customize['font_title_weight'] : '';
    
    if (($bodyFont != '' || $titleFont != '') && ($bodyFont == $titleFont)) {
        $api_font = str_replace(" ", '+', $bodyFont);
        if ($bodyWeight != '' || $titleWeight != '') {
            $api_font .= ':';
            if ($bodyWeight == $titleWeight) {
                $api_font .= $bodyWeight;
            } elseif ($bodyWeight != '' && $titleWeight != '') {
                $api_font .= $bodyWeight < $titleWeight ? $bodyWeight . ',' . $titleWeight : $titleWeight . ',' . $bodyWeight;
            }
        }
        $font_name = str_replace(" ", '-', $bodyFont);
        wp_enqueue_style('pixtheme-font-' . $font_name, "//fonts.googleapis.com/css?family=" . $api_font);
    } else {
        if ($bodyFont != '') {
            $api_font = str_replace(" ", '+', $bodyFont);
            $api_font .= $bodyWeight != '' ? ':' . $bodyWeight : '';
            $font_name = str_replace(" ", '-', $bodyFont);
            wp_enqueue_style('pixtheme-font-' . $font_name, "//fonts.googleapis.com/css?family=" . $api_font);
        }
        if ($titleFont != '') {
            $api_font = str_replace(" ", '+', $titleFont);
            $api_font .= $titleWeight != '' ? ':' . $titleWeight : '';
            $font_name = str_replace(" ", '-', $titleFont);
            wp_enqueue_style('pixtheme-font-' . $font_name, "//fonts.googleapis.com/css?family=" . $api_font);
        }
    }
}
add_action('wp_enqueue_scripts', 'pixtheme_fonts');

/************************************************************/


/********************* DEFINE MAIN PATHS ********************/

require_once($incPath . 'menu_walker.php');
require_once($funcPath . 'helper.php');
require_once($funcPath . 'options.php');
require_once($incPath . 'portfolio_walker.php');
require_once($funcPath . 'post-types.php');
require_once($funcPath . 'widgets.php');
require_once($funcPath . '/shortcodes/shortcode.php');
require_once($adminPath . 'custom-fields.php');
require_once($adminPath . 'scripts.php');
require_once($adminPath . 'admin-panel/admin-panel.php');
require_once($adminPath . 'admin-panel/class-tgm-plugin-activation.php');
require_once($funcPath . 'functions.php');
require_once($funcPath . 'filters.php');
require_once($funcPath . 'common.php');
require_once($funcPath . 'events.php');

// Redirect To Theme Options Page on Activation
if (is_admin() && isset($_GET['activated'])) {
    wp_redirect(admin_url('admin.php?page=adminpanel'));
    unregister_sidebar('header-sidebar');
}

add_action('admin_enqueue_scripts', 'pixtheme_load_custom_wp_admin_style');
function pixtheme_load_custom_wp_admin_style()
{
    wp_register_script('custom_wp_admin_script', get_template_directory_uri() . '/js/custom-admin.js', false, '1.0.0');
    wp_enqueue_script('custom_wp_admin_script');
}
/************************************************************/


/*************** AFTER THEME SETUP FUNCTIONS ****************/

add_action('after_setup_theme', 'pixtheme_setup');
function pixtheme_setup()
{
    global $pix_options;
    // Language support 
    load_theme_textdomain('PixTheme', get_template_directory() . '/languages');
    $locale      = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if (is_readable($locale_file)) {
        require_once($locale_file);
    }
    
    // ADD SUPPORT FOR POST THUMBS 
    add_theme_support('post-thumbnails');
    // Define various thumbnail sizes
    $width  = (!empty($pix_options['pix_portfolio_width'])) ? $pix_options['pix_portfolio_width'] : 340;
    $height = (!empty($pix_options['pix_portfolio_height'])) ? $pix_options['pix_portfolio_height'] : 250;
    add_image_size('portfolio-thumb', $width, $height, true);
    add_image_size('portfolio-thumb-2x', $width * 2, $height, true);
    add_image_size('preview-thumb', 100, 100, true);
    add_image_size('event-thumb', 320, 170, true);
    add_theme_support("title-tag");
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', array(
        'gallery',
        'quote',
        'video'
    ));
    //ADD SUPPORT FOR WORDPRESS 3 MENUS ************/
    
    add_theme_support('menus');
    //Register Navigations
    add_action('init', 'pix_custom_menus');
	
	
	
	
    function pix_custom_menus()
    {		
		
		////// SET COOKIE FOR GRID / LIST /////
		if (!isset($_COOKIE['pix_cat_view_type'])) {
			setcookie("pix_cat_view_type", pixtheme_get_option('pix_category_view'), strtotime('+1 day'));
		}
		
		
		
        register_nav_menus(array(
            'primary_nav' => __('Primary Navigation', 'PixTheme'),
            'top_nav' => __('Top Navigation', 'PixTheme'),
            'footer_nav' => __('Footer Navigation', 'PixTheme')
        ));
    }
    
}

$args = array(
    'flex-width' => true,
    'width' => 350,
    'flex-height' => true,
    'height' => 'auto',
    'default-image' => get_template_directory_uri() . '/images/logo.jpg'
);
add_theme_support('custom-header', $args);

$args = array(
    'default-color' => 'FFFFFF'
);
add_theme_support('custom-background', $args);
add_theme_support('woocommerce');
/************************************************************/

/******* TGM Plugin ********/
add_action('tgmpa_register', 'pix_theme_register_required_plugins');

function pix_theme_register_required_plugins()
{
    
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        
       array(
			'name' => 'WooCommerce', // The plugin name
			'slug' => 'woocommerce', // The plugin slug (typically the folder name)
			'source' => 'http://downloads.wordpress.org/plugin/woocommerce.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''

			// If set, overrides default API URL and points to an external URL

		) ,
		array(
			'name' => 'Contact Form 7', // The plugin name
			'slug' => 'contact-form-7', // The plugin slug (typically the folder name)
			'source' => 'http://envato.templines.com/plugins/contact-form-7.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''

			// If set, overrides default API URL and points to an external URL

		) ,
        
     array(
			'name' => 'Revolution Slider', // The plugin name
			'slug' => 'revslider', // The plugin slug (typically the folder name)
			'source' => 'http://envato.templines.com/plugins/revslider.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''

			// If set, overrides default API URL and points to an external URL

		) ,
        
   array(
			'name' => 'WPBakery Visual Composer', // The plugin name
			'slug' => 'js_composer', // The plugin slug (typically the folder name)
			'source' => 'http://envato.templines.com/plugins/js_composer.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''

			// If set, overrides default API URL and points to an external URL

		) ,
   array(
			'name' => 'Regenerate Thumbnails', // The plugin name
			'slug' => 'regenerate-thumbnails', // The plugin slug (typically the folder name)
			'source' => 'http://envato.templines.com/plugins/regenerate-thumbnails.zip', // The plugin source
			'required' => false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''

			// If set, overrides default API URL and points to an external URL

		) ,
        
      array(
			'name' => 'PixthemeCustom', // The plugin name
			'slug' => 'pixtheme-custom', // The plugin slug (typically the folder name)
			'source' => get_stylesheet_directory() . '/library/includes/plugins/pixtheme-custom.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''

			// If set, overrides default API URL and points to an external URL

		) ,
		array(
			'name' => 'YITH Woocommerce Wishlist', // The plugin name
			'slug' => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
			'source' => 'http://envato.templines.com/plugins/yith-woocommerce-wishlist.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''

			// If set, overrides default API URL and points to an external URL

		) ,
		 array(
            'name' => 'Mailchimp', // The plugin name
            'slug' => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/library/includes/plugins/mailchimp-for-wp.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required 
            'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '' // If set, overrides default API URL and points to an external URL
        ),
		
		
		
		
		array(
            'name' => 'Wordpress Importer', // The plugin name
            'slug' => 'wordpress-importer', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/library/includes/plugins/wordpress-importer.0.6.1.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required 
            'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '' // If set, overrides default API URL and points to an external URL
        ),
        
        array(
            'name' => 'The Events Calendar', // The plugin name
            'slug' => 'the-events-calendar', // The plugin slug (typically the folder name)
            'source' => get_stylesheet_directory() . '/library/includes/plugins/the-events-calendar.zip', // The plugin source
            'required' => true, // If false, the plugin is only 'recommended' instead of required 
            'force_activation' => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' => '' // If set, overrides default API URL and points to an external URL
        ),
        
        array(
			'name' => 'Visual CSS Style Editor', // The plugin name
			'slug' => 'waspthemes-yellow-pencil', // The plugin slug (typically the folder name)
			'source' =>  'http://envato.templines.com/plugins/waspthemes-yellow-pencil.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_activation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''

			// If set, overrides default API URL and points to an external URL

		) ,
        
        
   	array(
			'name' => 'Envato WordPress Toolkit', // The plugin name
			'slug' => 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
			'source' => 'http://envato.templines.com/plugins/envato-wordpress-toolkit-master.zip', // The plugin source
			'required' => true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' => ''

			// If set, overrides default API URL and points to an external URL

		) ,
        
        
        
        
        
		
		
		
        
    );
    
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to pre-packaged plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'tgmpa'),
            'menu_title' => __('Install Plugins', 'tgmpa'),
            'installing' => __('Installing Plugin: %s', 'tgmpa'), // %s = plugin name.
            'oops' => __('Something went wrong with the plugin API.', 'tgmpa'),
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa'), // %1$s = plugin name(s).
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'tgmpa'),
            'activate_link' => _n_noop('Begin activating plugin', 'Begin activating plugins', 'tgmpa'),
            'return' => __('Return to Required Plugins Installer', 'tgmpa'),
            'plugin_activated' => __('Plugin activated successfully.', 'tgmpa'),
            'complete' => __('All plugins installed and activated successfully. %s', 'tgmpa'), // %s = dashboard link.
            'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    
    tgmpa($plugins, $config);
    
}





add_action('vc_before_init', 'pixtheme_vcSetAsTheme');
function pixtheme_vcSetAsTheme()
{
    vc_set_as_theme();
    require_once(funcPATH . 'shortcodes/vc_shortcode.php');
    

    
    
   // $dir = get_stylesheet_directory() . '/library/functions/shortcodes/vc_extends';
   // vc_set_shortcodes_templates_dir($dir);
    
}

/*****WOOCOMERCE**********/



add_theme_support('woocommerce');
add_filter('woocommerce_enqueue_styles', '__return_false');
/*
// Remove each style one by one
function wp_enqueue_woocommerce_style(){
wp_register_style( 'mytheme-woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );

if ( class_exists( 'woocommerce' ) ) {
wp_enqueue_style( 'mytheme-woocommerce' );
}
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );
*/

add_action( 'wp_head', 'pix_after_front_plugins_loaded' );
function pix_after_front_plugins_loaded(){

	$hook_name = 'woocommerce_single_product_summary';
	global $wp_filter;
	if (isset($wp_filter[$hook_name][31])){
		unset($wp_filter[$hook_name][31]);		
	}
	
	
}

add_action( 'admin_head', 'pix_after_plugins_loaded' );
function pix_after_plugins_loaded(){
	pixContentImporter();
}


add_action( 'wp_footer', 'pix_add_to_footer', 100);
function pix_add_to_footer(){

	$output = "<style>";
	
	
	$output .= "@import url(".esc_url(get_template_directory_uri()) . "/webfontkit/stylesheet.css); "; 
	$output .= "@import url(".esc_url(get_template_directory_uri()) . "/assets/icomoon/style.css); ";
	$output .= "@import url(".esc_url(get_template_directory_uri()) . "/assets/simple/simple-line-icons.css); ";
	$output .= "@import url(".esc_url(get_template_directory_uri()) . "/assets/font-awesome/css/font-awesome.min.css); ";
	$output .= "@import url(".esc_url(get_template_directory_uri()) . "/assets/flaticon/flaticon.css); ";
	
	$output .= "</style>";
	
	echo $output;

}


/******* FIX THE PORTFOLIO CATEGORY PAGINATION ISSUE ********/

$option_posts_per_page = get_option('posts_per_page');
add_action('init', 'pix_modify_posts_per_page', 0);
function pix_modify_posts_per_page()
{
    add_filter('option_posts_per_page', 'pix_option_posts_per_page');
}
function pix_option_posts_per_page($value)
{
    global $option_posts_per_page;
    if (is_tax('portfolio_category')) {
        $pageId = pixtheme_get_page_ID_by_page_template('portfolio-template3.php');
        if ($pageId) {
            $custom         = get_post_custom($pageId);
            $items_per_page = isset($custom['_page_portfolio_num_items_page']) ? $custom['_page_portfolio_num_items_page'][0] : '777';
            return $items_per_page;
        } else {
            return 4;
        }
    } else {
        return $option_posts_per_page;
    }
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_archive_description','woocommerce_taxonomy_archive_description',10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 30);
add_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20);

remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
//remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 15);



add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 11);



function pixtheme_override_vc_get_inline_url($base_url){
	$_url = $base_url;
	if (get_queried_object() && isset(get_queried_object()->ID)){
		if (get_queried_object()->post_type == "page"){
			$the_ID = get_queried_object()->ID;
			$_url = admin_url() . 'post.php?vc_action=vc_inline&post_id=' .
                               $the_ID . '&post_type=' . get_post_type( $the_ID );
                               
		}
	}
	return $_url;
}
add_filter('vc_get_inline_url','pixtheme_override_vc_get_inline_url');



function pixtheme_override_page_title()
{
    return false;
}
add_filter('woocommerce_show_page_title', 'pixtheme_override_page_title');


function is_realy_woocommerce_page () {
        if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
                return true;
        }
        
        
        if (!get_the_ID ())
        	return false;
        
        
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
}


function pixtheme_woocommerce_breadcrumbs()
{	
	$page_title = '';
	$page_desc = '';
	$page_bg = "";$hsID = "";
	
	global $post;

	if (get_queried_object() && isset(get_queried_object()->post_title)){
		$page_title = get_queried_object()->post_title;
	}
	
	
	if (get_queried_object()){
		if (isset(get_queried_object()->taxonomy) && get_queried_object()->taxonomy == 'product_cat'){
			
			$thumbnail_id = get_woocommerce_term_meta( get_queried_object()->term_id, 'thumbnail_id', true );
			
		    $image = wp_get_attachment_url( $thumbnail_id );
		    
		    if ( $image ) {
			    $page_bg = "background-image:url(".$image.")";
			    $hsID = "hs_".get_queried_object()->term_id;
			}
			$page_desc = get_queried_object()->description;
			
			$page_title  = get_queried_object()->name;
		}
		else{		

			if (isset(get_queried_object()->post_type) && get_queried_object()->post_type == 'product'){
				
				$product_cat_id = false;
				$terms = get_the_terms( get_queried_object()->ID, 'product_cat' );
				foreach ($terms as $term) {
					$product_cat_id = $term->term_id;					
					break;
				}
				
				if ($product_cat_id){
					$thumbnail_id = get_woocommerce_term_meta( $product_cat_id, 'thumbnail_id', true );
				
					$image = wp_get_attachment_url( $thumbnail_id );
					
					if ( $image ) {
						$page_bg = "background-image:url(".$image.")";
						$hsID = "hs_".get_queried_object()->ID;
					}
				}
				
				$page_desc = '';				
			}else{
			
			
				if (isset(get_queried_object()->post_excerpt))
					$page_desc = get_queried_object()->post_excerpt;
				
			}
		}
			
	}
	
	
	

	if (function_exists('is_shop') && is_shop()){		
		$page_title = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
		$_page = get_post(wc_get_page_id( 'shop' ));
		
		
		$thumbnail_id = get_post_thumbnail_id( $_page->ID);
			
	    $image = wp_get_attachment_url( $thumbnail_id );
	    
	    if ( $image ) {
		    $page_bg = "background-image:url(".$image.")";
		    $hsID = "hs_".$_page->ID;
		}
		
		$page_desc = $_page->post_content;
		//@$page_desc = wc_get_page_id( 'shop' ) ? get_the_excerpt(wc_get_page_id( 'shop' )) : '';
		
	}
	
	
	global $wp;
	$evtPageSlug = tribe_get_option('eventsSlug'); 
	if ($wp->request == $evtPageSlug){
		$page_title = pixtheme_get_option('pix_evtpagetitle');
	}

	
	if ($page_title == '')
		$page_title = get_the_title();
	


	


	$is_woopage = is_realy_woocommerce_page();
	


	

	if (!$is_woopage){
		$wbefore = '<div style="" class="page-header">
			<div class="page-header-bg-1"></div>
			<div class="page-header-bg-2"></div>
	  <div class="container">
	   <div class="float-left">
	   
	    <h1 class="page-title">'.$page_title.'</h1>
		<div class="header-desc">
		<p>'.$page_desc.'</p></div></div>
	    <ol class="breadcrumb float-right">';
	}else{
		$wbefore = '<div id="'.$hsID.'" class="page-header page-header-shop">
			<div class="page-header-bg-1"></div>
			<div class="page-header-bg-2"></div>
	  <div class="container">
	   <div class="float-left">
	   
	    <h1 class="page-title">'.$page_title.'</h1>
		<div class="header-desc">
		<p>'.$page_desc.'</p></div></div>
	    <ol class="breadcrumb float-right">';
	}
	
	

    
    return array(
        'delimiter' => '',
        'wrap_before' => $wbefore,
        'wrap_after' => '</ol>
  </div>
</div>',
        'before' => '<li>',
        'after' => '</li>',
        'home' => _x('Home', 'breadcrumb', 'woocommerce')
    );
}
add_filter('woocommerce_breadcrumb_defaults', 'pixtheme_woocommerce_breadcrumbs');

add_filter('woocommerce_output_related_products_args', 'pix_related_products_args');
function pix_related_products_args($args)
{
    global $pix_options;
    $args['posts_per_page'] = $pix_options['pix_pelated_products']; // 4 related products
    return $args;
}

//add_filter('wp_title', 'pixtheme_filter_pagetitle');
function pixtheme_filter_pagetitle($title)
{
    //check if its a blog post
    if (!is_single())
        return get_bloginfo('name') . ' > ' . $title;
    
    //if you get here then its a blog post so change the title
    global $wp_query;
    if (isset($wp_query->post->post_title)) {
        return get_bloginfo('name') . ' > ' . $wp_query->post->post_title;
    }
    
    //if wordpress can't find the title return the default
    return get_bloginfo('name') . ' > ' . $title;
}


/********************* Customize *********************/

add_action('customize_register', 'pix_remove_customize_sections');
function pix_remove_customize_sections($wp_customize)
{
    $wp_customize->remove_section('header_image');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('nav');
    $wp_customize->remove_panel('widgets');
    
    /// Global Colors ///
    $wp_customize->add_section('pix_colors', array(
        'title' => __('Global Colors', 'PixCustomize'),
        'priority' => 20
    ));
    
    $wp_customize->add_setting('pix_customize_options[first_color]', array(
        'default' => '',
        'transport' => 'postMessage',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('pix_customize_options[second_color]', array(
        'default' => '',
        'transport' => 'postMessage',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'first_color', array(
        'label' => __('First Color', 'PixCustomize'),
        'section' => 'pix_colors',
        'settings' => 'pix_customize_options[first_color]',    
    )));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'second_color', array(
        'label' => __('Second Color', 'PixCustomize'),
        'section' => 'pix_colors',
        'settings' => 'pix_customize_options[second_color]',       
    )));
    //////////////////////////////////////////////////////////
    
    
    /// Global Font ///
    $wp_customize->add_section('pix_font', array(
        'title' => __('Global Font', 'PixCustomize'),
        'priority' => 25,
        'description' => 'Add new <a href="http://www.google.com/fonts/" target="_blank">Google Web Fonts</a>',     
    ));
    
    $wp_customize->add_setting('pix_customize_options[font_family]', array(
        'default' => '',
        'transport' => 'postMessage',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field',	
    ));
    
    $wp_customize->add_setting('pix_customize_options[font_weight]', array(
        'default' => '',
        'transport' => 'postMessage',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('pix_font_family_control', array(
        'label' => __('Font Family', 'PixCustomize'),
        'section' => 'pix_font',
        'settings' => 'pix_customize_options[font_family]',
        'description' => 'Example: Oswald',      
    ));
    
    $wp_customize->add_control('pix_font_weight_control', array(
        'label' => __('Font Weight', 'PixCustomize'),
        'section' => 'pix_font',
        'settings' => 'pix_customize_options[font_weight]',
        'description' => 'Example: 300'
    ));
    //////////////////////////////////////////////////////////
    
    
    /// Title Font ///
    $wp_customize->add_section('pix_font_title', array(
        'title' => __('Title Font', 'PixCustomize'),
        'priority' => 30,
        'description' => 'Add new <a href="http://www.google.com/fonts/" target="_blank">Google Web Fonts</a>'
    ));
    
    $wp_customize->add_setting('pix_customize_options[font_title_family]', array(
        'default' => '',
        'transport' => 'postMessage',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_setting('pix_customize_options[font_title_weight]', array(
        'default' => '',
        'transport' => 'postMessage',
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('pix_font_title_family_control', array(
        'label' => __('Font Family', 'PixCustomize'),
        'section' => 'pix_font_title',
        'settings' => 'pix_customize_options[font_title_family]',
        'description' => 'Example: Oswald'
    ));
    
    $wp_customize->add_control('pix_font_title_weight_control', array(
        'label' => __('Font Weight', 'PixCustomize'),
        'section' => 'pix_font_title',
        'settings' => 'pix_customize_options[font_title_weight]',
        'description' => 'Example: 700'
    ));
    //////////////////////////////////////////////////////////
    
}


add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 9;' ), 20 ) ;



?>