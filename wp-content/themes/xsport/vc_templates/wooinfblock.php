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

$out = $title != '' ? '<h3 class="pageSectionTitle text-center text-uppercase ralewayBold clear blackTxtColor" >'.wp_kses_post($title).'</h3>' : '';
$out .= '<div class="' . $css_class . '">';
$out .= '	
			
			<div class="recommendedAppsItems">
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
						$thumbnail = get_the_post_thumbnail($post->ID, 'shop_catalog', array('class' => 'cover'));
						
						$attach_ids = $product->get_gallery_attachment_ids();
						$attachment_count = count( $product->get_gallery_attachment_ids() );
						if($attachment_count > 0){
							$image_link = wp_get_attachment_url( $attach_ids[0] ); 
							$default_attr = array(
								'class'	=> "slider_img",
								'alt'   => get_the_title($product->id),
							);
							$image = wp_get_attachment_image( $attach_ids[0], 'shop_catalog', false, $default_attr);
							
						}
						
$out .= '
				
            			<div class="app-product-item center-block">
							<div class="app-product-item_header">
								<div class="preview-item_header">
									'.$thumbnail.'
								</div>
								<div class="app-product-item_body clearfix">';
if ( !empty($icon) && !empty($bgcolor) ) {
	$out .= '
									<span class="colorIcon smallIcon" style="background-color:'.esc_attr($bgcolor).'">
										<i class="fa '.esc_attr($icon).' whiteTxtColor"></i>
									</span>
			';
}
$out .= '
									<h4 class="app-product-item_body_title">
										<a href="'.esc_url($link).'" class="ralewaySemiBold blackTxtColor">'.wp_kses_post(get_the_title($product->id)).'</a>
									</h4>';
if ( $price_html = $product->get_price_html() ) {
	$out .= '
									<div class="app-product-item_body_price robotoCondensed pull-left">'. wp_kses_post($price_html).'</div>
			';
}
if ( get_option( 'woocommerce_enable_review_rating' ) !== 'no' ) {
	$out .= '  						<div class="rating pull-right">';
		if ( $rating_html = $product->get_rating_html() ) { 
			$out .= wp_kses_post($rating_html); 
		}
    $out .= '  						</div>';
}


				
$out .= '      						<div class="app-product-item_body_btnbox"> ';

$out .= apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="ellipseLink addToCartBtn robotoMedium text-uppercase %s product_type_%s"><i class="fa fa-shopping-cart customColor"></i>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $product->product_type ),
		esc_html( $product->add_to_cart_text() )
	),
$product );
 
$out .= '
									</div>
								</div>
							</div>
						</div>
						
        ';
	
		endwhile;
	endif;
 
$out .= '            
			</div>
	';

$out .= '</div>';
endif;	
echo $out;