<?php
global $post;
$out = $cat = $date ='';
$pix_options = get_option('pix_general_settings');

extract(shortcode_atts(array(
	'count'=>6,
	'max_slides' => '',
	'min_slides' => '',
	'width_slides' => '',
	'margin_slides' => '',
	'disable_carousel' => '',				
), $atts));

$max_slides = $max_slides == '' ? 2 : $max_slides;
$min_slides = $min_slides == '' ? 1 : $min_slides;
$width_slides = $width_slides == '' ? 370 : $width_slides;
$margin_slides = $margin_slides == '' ? 30 : $margin_slides;
$disable_carousel = $disable_carousel != '0' ? 'bxslider' : 'carousel-disable';
	   
$out = ' 
			<ul class="carousel-3 '.$disable_carousel.'" 
				data-max-slides="'.$max_slides.'" 
				data-min-slides="'.$min_slides.'" 
				data-width-slides="'.$width_slides.'" 
				data-margin-slides="'.$margin_slides.'" >';

$args = array( 
			'orderby' => 'menu_order',			 
			'order' => 'ASC', 
			'showposts' => $count
		);
if( is_numeric($count) )
	$args['showposts'] = $count;
else
	$args['numberposts'] = -1;
	
$wp_query = new WP_Query( $args );
			 					
	if ($wp_query->have_posts()): 
		while ($wp_query->have_posts()) : 							
			$wp_query->the_post();
			$custom = get_post_custom($post->ID);
			if(!empty($pix_options['pix_blog_show_category']) && $pix_options['pix_blog_show_category'] == 1){
				$categories = get_the_category($post->ID);
				if($categories){
					$cat = '<span class="meta-i">'.__('In: ', 'PixTheme');						
					foreach($categories as $category) {
						$cat .= '<a href="'.esc_url(get_category_link( $category->term_id )).'" >'.wp_kses_post($category->cat_name).'</a> ';
					}
					$cat .= '</span>';						
				}
			}
			if(!empty($pix_options['pix_blog_show_tag']) && $pix_options['pix_blog_show_tag'] == 1){	
				$posttags = get_the_tags($post->ID);
				if ($posttags) {
					$output = '<span class="meta-i">'.__('Tags: ', 'PixTheme');
					foreach($posttags as $tag) {
						$output .= '<a href="'.esc_url(get_tag_link( $tag->term_id )).'" >'.wp_kses_post($tag->name).'</a> ';
					}
					$output .= '</span>';
					//echo wp_kses_post($output);
				}
			}
			if($pix_options['pix_blog_show_date']){
				$date = '<span class="meta-i"> '.__('On: ', 'PixTheme').' <a href="#">'.wp_kses_post(get_the_time('M j, Y')).'</a></span>';                    
			}
			$thumbnail = get_the_post_thumbnail( $post->ID ) != '' ? get_the_post_thumbnail( $post->ID, 'full' ) : '<img src="'.esc_url(get_template_directory_uri()).'/images/noimage.jpg">';
						
$out .= '
				<li>
				  <div class="media"> 
				  	<a href="'.esc_url(get_the_permalink()).'">'.$thumbnail.'</a>
				  </div>
				  <div class="carousel-item-content">
					<div class="meta">
						'.wp_kses_post($cat).'
						'.wp_kses_post($date).'
					</div>
					<a href="'.esc_url(get_the_permalink()).'" class="carousel-title">Ut tellus cum socis natoque </a>
					<div class="carousel-text">
					  '.get_the_excerpt().'
					 	</div> <a href="'.esc_url(get_the_permalink()).'" class="btn btn-primary btn-lg btn-icon-right">'.__('READ MORE', 'PixTheme').'
					  <div class="btn-icon"><i class="fa fa-long-arrow-right"></i></div>
					  </a> 
				
				  </div>
				</li>
            	';	
	
		 endwhile;
		 endif;
	 
$out .= '            
            	<!--end-->
			</ul>
 
	';
	
echo $out;