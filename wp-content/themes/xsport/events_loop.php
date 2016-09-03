<?php 
/**
 * The template for displaying portfolio.
 *
 * @package Pix-Theme
 * @since 1.0
 *

 */
$pageId = $post->ID;
$_SESSION['PixTheme_page_id'] = $pageId;

$get_meta = get_post_custom($post->ID);
$portfolio_type = get_post_meta($post->ID, "_portfolio_type", $single = false);
$page_template_name = get_post_meta($post->ID,'_wp_page_template',true);

	$itemsize = 'column-three';	
	$itemlayout = 'span4';
	$thumbsize = 'portfolio-3-col';
	

if( get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = true) != '' ){ 
	$items_per_page = get_post_meta($post->ID, "_page_portfolio_num_items_page", $single = false);
} 
else{ 
// else don't paginate
	$items_per_page[0] = 777;
}

?>
<section class="main-section">
<?php the_content( )?>

<div class="container">  
<div class="cd-events-all-wrapper">
  <ul>
    <?php if( 1 != 1 ): ?>
    <p>
      <?php _e('No categories selected. To fix this, please login to your WP Admin area and set
					the categories you want to show by editing this page and setting one or more categories 
					in the multi checkbox field "Portfolio Categories".', 'Straight')?>
    </p>
    <?php else: ?>
    <?php 	
					// If the user hasn't set a number of items per page, then use JavaScript filtering
					if( $items_per_page == 777 ) : endif; 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					//  query the posts in selected terms
					//$portfolio_posts_to_query = get_objects_in_term( explode( ",", $cats ), 'event_category');
				 ?>
    <?php //if (!empty($portfolio_posts_to_query)):
					$wp_query = new WP_Query( array( 'post_type' => 'event', 'orderby' => 'menu_order', 'order' => 'ASC', 'paged' => $paged, 'showposts' => $items_per_page[0] ) );
			 					
					if ($wp_query->have_posts()):  ?>
    <?php while ($wp_query->have_posts()) : 							
						$wp_query->the_post();
						$custom = get_post_custom($post->ID);						
						$link = !empty($custom['event-link'][0]) ? $custom['event-link'][0] : '';
						// Get the portfolio item categories
						$image_link = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
						$magnific = $link == '' ? 'magnific' : '';
						$link = $link == '' ? $image_link : $link;
						$cats = wp_get_object_terms($post->ID, 'event_category');
						if($custom['event-start-date'][0]>=current_time('timestamp',0))
							$event_time = $custom['event-start-date'][0];
						else
							$event_time = $custom['event-end-date'][0];
						$cat_names = '';							
						if ($cats){
							$cat_slugs = '';							
							foreach( $cats as $cat ){
								$cat_slugs .= $cat->slug . " ";
								$cat_names .= $cat->name . ", ";
							}
							$cat_names = substr($cat_names, 0, -2);
						}
						?>
    <li class="cd-events-item <?php echo esc_attr($custom['event-img-size'][0]); ?> <?php echo esc_attr($custom['event-img-position'][0]); ?>">
      <article class="post media-image   format-image animated  animation-done bounceInUp" data-animation="bounceInUp">
        <div class="entry-media">
          <div class="entry-thumbnail">
            <?php if(!empty($cat_names)) {?><div class="post-type-media type-image"><?php echo wp_kses_post($cat_names); ?></div><?php } ?>
            <div class="img-overlay "> <a href="<?php echo esc_url($link) ?>" class="link-view-more <?php echo esc_attr($magnific); ?>"></a> </div>
            <div class="img-post "> <a href="<?php echo esc_url($link) ?>"><?php the_post_thumbnail(); ?></a></div>
          </div>
        </div>
        <div class="entry-main">
          <h3 class="entry-title"> <a href="<?php echo esc_url($link) ?>"><?php the_title(); ?></a> </h3>
          <div class="entry-content">
            <p><?php the_excerpt(); ?></p>
          </div>
          <div class="footer-panel footer-panel-list">
            <div class="date-info"> <i class="fa fa-clock-o"></i> <?php echo date( 'F d, Y', $event_time ); ?></div>
          </div>
        </div>
      </article>
    </li>
    <?php endwhile?>
    <?php endif?>
    <?php endif?>
    
  </ul>
</div>
</div>
</section>
