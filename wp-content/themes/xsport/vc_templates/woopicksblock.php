<?php
global $post;
$out = $css_class = '';

extract(shortcode_atts(array(
	'title'=>'',
	'count'=>'',
	'cats'=>'',
	'css_animation' => '',				
), $atts));

$css_class .= $this->getCSSAnimation($css_animation);

if( $cats == '' ):
	$out .= '<p>'.__('No categories selected. To fix this, please login to your WP Admin area and set the categories you want to show by editing this shortcode and setting one or more categories in the multi checkbox field "Categories".', 'PixTheme');
else: 

$out = $title != '' ? '<h3 class="pageSectionTitle bigTxt text-center text-uppercase ralewayBold clear blackTxtColor" >'.wp_kses_post($title).'</h3>' : '';
$out .= '<div class="' . $css_class . '">';
$out .= '	
			
			<ul class="staff-picks-list">
			';	
		

	$product_cat_to_query = get_objects_in_term( explode( ",", $cats ), 'product_cat');
	$args = array(
				'post_type' => 'product', 
				'orderby' => 'menu_order',	
				'post__in' => $product_cat_to_query,		 
				'order' => 'ASC',
			);
	if( is_numeric($count) )
		$args['showposts'] = $count;
	else
		$args['numberposts'] = -1;
$wp_query = new WP_Query( $args );
				 					
	if ($wp_query->have_posts()): 
		while ($wp_query->have_posts()) : 							
						$wp_query->the_post();
						global $product;
						$custom = get_post_custom($post->ID);					
						$icon = rwmb_meta( 'product_icon');
						$bgcolor = rwmb_meta( 'product_icon_bgcolor');
		
						$cats = wp_get_object_terms($post->ID, 'product_cat');											   
												
						if ($cats){
							$cat_slugs = '';
							$cat_names = '';
							foreach( $cats as $cat ){
								$cat_slugs .= $cat->slug . " ";
								$cat_names .= $cat->name . ", ";
							}
							$cat_names = substr($cat_names, 0, -2);
						}
						
						$link = get_the_permalink($product->id); 
						
						
$out .= '
            		<li>
						<div class="staff-picks_item">
							<div class="preview-item center-block">
								<a href="'.esc_url($link).'" class="ralewaySemiBold blackTxtColor">
									<span class="staff-picks_item_icon" style="background-color:'.esc_attr($bgcolor).'">
										<i class="fa '.esc_attr($icon).' whiteTxtColor"></i>
									</span>
								</a>
								
								<span class="staff-picks_item_name ralewayBold blackTxtColor">
									<a href="'.esc_url($link).'" class="ralewaySemiBold blackTxtColor">'.wp_kses_post(get_the_title($product->id)).'</a>
								</span>';
if ( $price_html = $product->get_price_html() ) {
	$out .= '
								<span class="staff-picks_item_price robotoCondensed text-uppercase">'. wp_kses_post($price_html).'</span> 
			';
}
 
$out .= '
							</div>
						</div>
					</li>						
        ';
	
		endwhile;
	endif;
 
$out .= '            
			</ul>
	';

$out .= '</div>';
endif;	
echo $out;