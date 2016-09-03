<?php /* Template Name: Single Post */ 

$custom = isset ($wp_query) ? get_post_custom($wp_query->get_queried_object_id()) : '';
$layout = isset ($custom['pix_page_layout']) ? $custom['pix_page_layout'][0] : '2';
$sidebar = isset ($custom['pix_selected_sidebar'][0]) ? $custom['pix_selected_sidebar'][0] : 'sidebar-1';

if (!is_active_sidebar($sidebar))
	$layout = '1';
	
$pix_options = get_option('pix_general_settings');
$blogLayout =  isset ($pix_options['pix_blog_layout']) ? $pix_options['pix_blog_layout'][0] : '0';

?>

<?php get_header();?>



<main class="section" id="main">
  <div class="container">
    <div class="row"> 
    
    
    
     <?php if ($layout == '3'):?>
   <div class="col-xs-12 col-sm-12 col-md-3">
        <aside class="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?> <?php   endif;?>
        </aside></div>
      <?php endif?>
      
      
    
       <div class="col-xs-12 col-sm-7 <?php if ($layout == 1):?>col-md-12<?php else:?>col-md-9<?php endif;?>  <?php if ($layout == '3'):?>  col2-left  <?php endif?>   <?php if ($layout == '2'):?>  col2-right  <?php endif?>">  
        <section role="main" class="main-content">
        
          <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

            
                <?php the_content(); ?>
       
          
        <?php endwhile; ?>	
        
        </section></div>
        
        
        
        	 
      
      
        <?php if ($layout == '2'):?>
	   <div class="col-xs-12 col-sm-12 col-md-3">
        <aside class="sidebar">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?> <?php   endif;?>
        </aside></div>
	  <?php endif?>
      
      
      
      
    
    </div>
    </div>
    </main>
    
    
    

  

  
  <?php get_footer();?>
