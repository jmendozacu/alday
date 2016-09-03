<?php
/**
* Header Template
*
* Here we setup all logic and XHTML that is required for the header section of all screens.
*
* @package WooFramework
* @subpackage Template
*/

global $woocommerce,$post,$wp_query;


?>
<?php  $pix_options = get_option('pix_general_settings'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="utf-8" />
<?php if(isset($pix_options['pix_responsive']) && $pix_options['pix_responsive']):?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php endif ?>
<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if(!empty($pix_options['pix_favicon'])):?>
<link rel="shortcut icon" href="<?php echo esc_url($pix_options['pix_favicon']) ?>" />
<?php endif?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body  <?php body_class(); ?>   >




<?php 
	if (isset($wp_query->queried_object->ID)){
		$GLOBALS['pix_footer_type_page'] = get_post_meta($wp_query->queried_object->ID, 'pix_page_footer_staticblock', true);		
	}else{
		$GLOBALS['pix_footer_type_page'] = get_post_meta(get_the_ID(), 'pix_page_footer_staticblock', true);		
	}

	
	
	
	
	if ( isset($_GET['htype']) ) {
		$_header_type = esc_attr($_GET['htype']);
	}else{
		$pix_header_type_page = get_post_meta(get_the_ID(), 'pix_page_header_type', true);
		if ($pix_header_type_page && $pix_header_type_page != 'global'){
			$_header_type = $pix_header_type_page;
		}else{
			$_header_type = pixtheme_get_option('pix_header_type','pix-header1');
		}
	
	}
	
?>
<div class="animated-all  sidebar-menu-wrap  <?php if (is_page_template('template-home.php')):?>layout-theme <?php echo esc_attr($_header_type);?><?php endif;?>">
<?php if (pixtheme_get_option('pix_show_menu_sidebar',false)):?>
<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
  <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Menu sidebar')) : ?>
  <?php endif; ?>
</nav>
<!-- /#sidebar-wrapper -->
<?php endif;?>
<!-- Page Content -->
<div id="page-content-wrapper">
<?php if (pixtheme_get_option('pix_show_color_selector',false)):?>
<!-- Start Switcher -->
<div class="demo_changer">
  <div class="demo-icon"> <i class="fa fa-cog fa-spin fa-2x"></i> </div>
  <!-- end opener icon -->
  <div class="form_holder">
    <h3 class="title-option">
      <?php _e('THEME OPTIONS', 'PixTheme')?>
    </h3>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="predefined_styles">
          <h4>
            <?php _e('Color schemes', 'PixTheme')?>
          </h4>
          <div class="color_box"> 
          <a href="" rel="color1" class="styleswitch" > </a> 
          <a href="" rel="color2" class="styleswitch"> </a> 
          <a href="" rel="color3" class="styleswitch" > </a> 
     
          </div>
          <div class="color_box">     <a href="" rel="color4" class="styleswitch"> </a>   <a href="" rel="color5" class="styleswitch" > </a> <a href="" rel="color6" class="styleswitch"> </a> </div>
          
          
          
          
        </div>
        
        
        <!-- end predefined_styles --> 
      </div>
      <!-- end col --> 
      
      <!-- end col --> 
    </div>
    <!-- end row --> 
  </div>
  <!-- end form_holder --> 
</div>
<!-- end demo_changer --> 
<!-- End Switcher -->
<?php endif;?>
<div class="<?php if (is_front_page()){?>home-page<?php } else { ?> not-front<?php } ?>">
<?php 
	if( ($pix_options['pix_loader'] == 1 && is_front_page()) || $pix_options['pix_loader'] == 2){
?>

<div id="page-preloader" ><span class="spinner"></span></div>


<!-- Loader -->

<?php 
	}
?>

<!-- Loader end -->

<div class="header shop-header">
  <div class="container">
    <div class="row">
      <div class="top-header">
        <div class="info-top col-md-6 text-left"> <i class="fa fa-phone"></i> <?php echo pixtheme_get_option('pix_header_text_1','24/7 SUPPORT');?> &nbsp; &nbsp; <a href="<?php echo pixtheme_get_option('pix_header_phone_link','#');?>"><?php echo pixtheme_get_option('pix_header_phone','0800 123 4567');?></a> </div>
        <div class="info-top col-md-6 text-right">
          <?php
                    wp_nav_menu(array( 
                        'theme_location' => 'top_nav',
                        'menu' =>'top_nav', 
                        'container'=>'', 
                        'depth' => 1, 
                        'menu_class' => ''
                        ));
                    ?>
        </div>
      </div>
    </div>
  </div>
  <section class="shop-section ">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-md-12 col-xs-12 mobile-center">
          <div class="blog-logo text-left"> <a title="pixtheme" href="<?php echo home_url() ?>" id="logo" class="logo ">
            <?php if (pixtheme_get_option('pix_header2_logo',false) && $_header_type == 'pix-header2' && is_page_template('template-home.php')):?>
            <img src="<?php echo esc_url(pixtheme_get_option('pix_header2_logo')) ?>" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" />
            <?php else:?>
            <?php if(!empty($pix_options['pix_logo'])):?>
            <img src="<?php echo esc_url($pix_options['pix_logo']) ?>" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" id="logo-image" />
            <?php elseif ( get_header_image() ):?>
            <img src="<?php header_image(); ?>" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" id="logo-image" />
            <div class="logo-desc"> <?php echo isset($pix_options['pix_logotext']) ? wp_kses( $pix_options['pix_logotext'], 'default' ) : '' ?></div>
            <?php else:?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo.jpg" alt="<?php echo esc_attr($pix_options['pix_logotext'])?>" id="logo-image" />
            <div class="logo-desc"> <?php echo isset($pix_options['pix_logotext']) ? wp_kses( $pix_options['pix_logotext'], 'default' ) : '' ?></div>
            <?php endif?>
            <?php endif?>
            </a> </div>
        </div>
        <div class="col-md-6  col-xs-12 mobile-center">
          <form action="<?php echo site_url() ?>" method="get" id="search-global-form">
            <div class="input-group top-search">
              <?php if (pixtheme_get_option('pix_header_catsearch') && isset($woocommerce)):?>
              <div class="input-group-btn search-panel">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span id="search_concept">
                <?php _e('Filter by','PixTheme')?>
                </span> <span class="caret"></span> </button>
                <?php echo pixtheme_get_theme_generator('pixtheme_category_header_search');?> </div>
              <?php endif;?>
              <input type="text" class="form-control" value="<?php the_search_query(); ?>" name="s" placeholder="<?php _e('Press Enter to search', 'PixTheme');?>">
              <span class="input-group-btn">
              <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
              </span> </div>
          </form>
        </div>
        <div class="col-md-3 col-xs-12 text-right mobile-center">
          <?php if (pixtheme_get_option('pix_header_minicart')):?>
          <?php if (isset($woocommerce)):?>
          <div class="popover-shorty"> <a  href="<?php echo esc_url($woocommerce->cart->get_cart_url());?>"> <span class="qty-top-cart-active"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'Butterfly'), $woocommerce->cart->cart_contents_count);?></span> <i class="fa fa-shopping-cart"></i> </a>
            <?php woocommerce_mini_cart()?>
          </div>
          <?php endif?>
          <?php endif;?>
          <?php if (pixtheme_get_option('pix_header_ilt_1_icon','fa-truck')):?>
          <div class="popover-shorty"> <a  href="<?php echo pixtheme_get_option('pix_header_ilt_1_link','/') ?>"><i class="fa <?php echo pixtheme_get_option('pix_header_ilt_1_icon','fa-truck')?>"></i> </a>
            <?php if ( pixtheme_get_option('pix_header_ilt_1_title') || pixtheme_get_option('pix_header_ilt_1_text')):?>
            <div class="popover bottom">
              <div class="arrow"></div>
              <?php if ( pixtheme_get_option('pix_header_ilt_1_title') ):?>
              <h3 class="popover-title"><?php echo pixtheme_get_option('pix_header_ilt_1_title','Reliable delivery')?></h3>
              <?php endif;?>
              <?php if ( pixtheme_get_option('pix_header_ilt_1_text') ):?>
              <div class="popover-content"><?php echo pixtheme_get_option('pix_header_ilt_1_text','Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.')?></div>
              <?php endif;?>
            </div>
            <?php endif;?>
          </div>
          <?php endif;?>
          <?php if (pixtheme_get_option('pix_header_ilt_2_icon','fa-thumbs-o-up')):?>
          <div class="popover-shorty"> <a  href="<?php echo pixtheme_get_option('pix_header_ilt_2_link','/') ?>"><i class="fa <?php echo pixtheme_get_option('pix_header_ilt_2_icon','fa-thumbs-o-up')?>"></i> </a>
            <?php if ( pixtheme_get_option('pix_header_ilt_2_title') || pixtheme_get_option('pix_header_ilt_2_text')):?>
            <div class="popover bottom">
              <div class="arrow"></div>
              <?php if ( pixtheme_get_option('pix_header_ilt_2_title') ):?>
              <h3 class="popover-title"><?php echo pixtheme_get_option('pix_header_ilt_2_title','Quality guarantee')?></h3>
              <?php endif;?>
              <?php if ( pixtheme_get_option('pix_header_ilt_2_text') ):?>
              <div class="popover-content"><?php echo pixtheme_get_option('pix_header_ilt_2_text','Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.')?></div>
              <?php endif;?>
            </div>
            <?php endif;?>
          </div>
          <?php endif;?>
          <?php if (pixtheme_get_option('pix_header_ilt_3_icon','fa-facebook')):?>
          <div class="popover-shorty"> <a  href="<?php echo pixtheme_get_option('pix_header_ilt_3_link','/') ?>"><i class="fa <?php echo pixtheme_get_option('pix_header_ilt_3_icon','fa-facebook')?>"></i> </a>
            <?php if ( pixtheme_get_option('pix_header_ilt_3_title') || pixtheme_get_option('pix_header_ilt_3_text')):?>
            <div class="popover bottom">
              <div class="arrow"></div>
              <?php if ( pixtheme_get_option('pix_header_ilt_3_title') ):?>
              <h3 class="popover-title"><?php echo pixtheme_get_option('pix_header_ilt_3_title','Facebook follow')?></h3>
              <?php endif;?>
              <?php if ( pixtheme_get_option('pix_header_ilt_3_text') ):?>
              <div class="popover-content"><?php echo pixtheme_get_option('pix_header_ilt_3_text','Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.')?></div>
              <?php endif;?>
            </div>
            <?php endif;?>
          </div>
          <?php endif;?>
        </div>
      </div>
    </div>
  </section>
  <div class="navbar  navbar-default ">
  
  <div class="mobile-menu"><?php _e('MENU', 'PixTheme');?></div>
  
  
    <div class="navbar yamm navbar-default ">
      <div class="container">
      
      
        <nav id="navbar-collapse-1" class="navbar-collapse collapse">
          <?php if (pixtheme_get_option('pix_show_menu_sidebar',false)):?>
          <button type="button" class="hamburger is-closed" data-toggle="offcanvas"> <span class="hamb-top"></span> <span class="hamb-middle"></span> <span class="hamb-bottom"></span> </button>
          <?php endif;?>
          <?php echo pixtheme_get_theme_generator('pixtheme_site_menu', 'nav navbar-nav'); ?> </nav>
      </div>
    </div>
  </div>
</div>

<!--- END TOP NAV --> 

<!--#content-->
<div class="content" id="content">
<?php if ( class_exists( 'WooCommerce' ) && !is_page_template( 'template-home.php' )) woocommerce_breadcrumb(); ?>

<!-- HEADER -->
<?php if (!is_page_template('under-construction.php')):?>
<?php endif; ?>
