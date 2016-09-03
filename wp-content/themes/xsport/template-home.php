<?php 
/**
 * The template for displaying page blocks.
 *
 * @package PixTheme
 * @since 1.0
 *
 * Template Name: Home
 */
get_header();
global $post;




	// get the slider
	$pixtheme_slider = get_post_meta(get_the_ID(), 'homepage_slider', true);
	
		
?>

<div class="home-section-content  home-section ">
	 <?php  the_post(); ?>

            
                <?php echo the_content(); ?>

  </div>
  
<?php get_footer(); ?>
