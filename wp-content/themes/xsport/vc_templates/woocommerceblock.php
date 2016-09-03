<?php
global $post;
$out = $css_class = '';



extract(shortcode_atts(array(
	'count'=>'',
	'css_animation' => '',	
	'cats' => ''			
), $atts));

$baseCount = $count;
$catsfilter = array();

$css_class .= $this->getCSSAnimation($css_animation);

$out = $css_animation != '' ? '<div class="" data-animation="' . esc_attr($css_animation) . '">' : '';

$out .= '	
       
		  <div id="pix-shop"  class="shop-view "  >	
			<div class="container">
				<div class="row text-center ">			
					<ul id="filter" class="clearfix non-paginated">
						<li><a href="#" class="active " data-filter="*">'.__('All Sport', 'PixTheme').'</a></li>';																		
							$MyWalker = new IsotopeCategoryWalker();
							$args = array( 'taxonomy' => 'product_cat', 'hide_empty' => '1', 'include' => $cats, 'title_li'=> '', 'walker' => $MyWalker, 'show_count' => '0', 'echo' => 0);
							$categories = wp_list_categories ($args);
$out .= '
						'.$categories.'
					</ul>
				</div>
		  
			
			
			    
        
			  <div class="isotope-frame animated" data-animation="bounceInUp">';
			  $count = $count * count(explode(",",$cats)); 
			  $out.='<script type="text/javascript">var maxIsoItems = '.$baseCount.'</script>';
      $out .='<ul class="isotope-filter product-grid  product-grid">';
      
    
  
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
			 					$r = 0;
	if ($wp_query->have_posts()): 
		while ($wp_query->have_posts()) : 							
						$wp_query->the_post();
						$custom = get_post_custom($post->ID);
						$woo_product = new WC_Product($post->ID);	
						
					  	$attach_ids = $woo_product->get_gallery_attachment_ids();
						$attachment_count = count( $woo_product->get_gallery_attachment_ids() );
						if($attachment_count > 0){
							$image_link = wp_get_attachment_url( esc_attr($attach_ids[0]) ); 
							$image = wp_get_attachment_image(  esc_attr($attach_ids[0]), 'shop_catalog');
							$slideImageHtml = apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a class="slider_img" href="%s">%s</a>', get_the_permalink(), $image ), esc_attr($woo_product->ID) );
						}
	  
										
						$demo_link = get_post_meta($woo_product->id, 'demo_link', true);
						$review = !empty($demo_link) ? '<a href="'.esc_url($demo_link).'" rel="nofollow" class="btn btn-link"><i class="fa fa-search-plus"></i>'.__('Preview', 'PixTheme').'</a>' : '';
						$cats = wp_get_object_terms($post->ID, 'product_cat');											   
												
						if ($cats){
							if ($r > $baseCount){
								$cat_slugs = 'isotope-item  ';								
							}else{
								$cat_slugs = 'isotope-item  ';								
							}

							$cat_names = '';
							foreach( $cats as $cat ){
								if (isset($catsfilter[$cat->slug]))
									$catsfilter[$cat->slug]++;
								else	
									$catsfilter[$cat->slug] = 0;
								if ($catsfilter[$cat->slug] < $baseCount)
									$cat_slugs .= $cat->slug . " ";
								$cat_names .= $cat->name . ", ";
							}
							$cat_names = substr($cat_names, 0, -2);
						}
						
						
						
						$link = ''; 
						$thumbnail = get_the_post_thumbnail($post->ID, 'shop_catalog', array('class' => 'cover'));
						
						$products_sold = get_post_meta( esc_attr($woo_product->id), 'total_sales', true );
						$published = esc_attr($woo_product->post->post_date);
						$toNewDate = date("Y-m-d h:i:s", strtotime($published) + 3600 * 24 * (int)pixtheme_get_option('pix_how_new',5));
						
						$label  = '';
						
						
						if ( $woo_product->is_on_sale() ) :
							$label = apply_filters( 'woocommerce_sale_flash', '<span class="label-sale">' . __( 'sale', 'woocommerce' ) . '</span>', $post, $woo_product );	
						endif;
						
						if ( $products_sold > pixtheme_get_option('pix_min_best_sales',5) && pixtheme_get_option('pix_show_best_label',false)):
							$label = apply_filters( 'woocommerce_sale_flash', '<span class="label-best">' . __( 'bestseller', 'woocommerce' ) . '</span>', $post, $woo_product ); 
						endif;
						
						
						if ( $toNewDate > current_time('mysql') && pixtheme_get_option('pix_show_new_label',false)):
							$label = apply_filters( 'woocommerce_sale_flash', '<span class="label-hot">' . __( 'hot', 'woocommerce' ) . '</span>', $post, $woo_product ); 
						
						endif;
						
						if ( !$woo_product->is_in_stock() && pixtheme_get_option('pix_show_oos_label',false)):
							
							$label = apply_filters( 'woocommerce_sale_flash', '<span class="label-not-available">' . __( 'not available', 'woocommerce' ) . '</span>', $post, $woo_product );
						
						endif;
						
						
						$average = (int)$woo_product->get_average_rating();
						
						$priceHtml = ( $woo_product->get_price_html() ) ? $woo_product->get_price_html() : '';
						
						$ratingHtml = '';
						if ($average){
							$rating = (esc_attr($average)/5)*100;
							$ratingHtml = '<span class="label-star">
							  <div class="star-rating" title="">
								<span style="width:'.$rating.'%">
								</span></div></span>';
						}

						
						
$out .= '
            		
            		<li class="'.esc_attr($cat_slugs).' " > 
					<div class="product-container label-hot-active">
            <div class="product-image woocommerce"> '.$label.' 			
			'.$ratingHtml.'
			  <div class="btn-action-item"> <a class="btn-cart  x-hover" href="'.esc_url( add_query_arg( 'add-to-cart', $woo_product->id, get_permalink( $woo_product->id ) ) ).'"> <i class="fa fa-shopping-cart"></i></a> <a href="'.esc_url( add_query_arg( 'add_to_wishlist',  esc_attr($woo_product->id) ) ).'"> <i class="icomoon-heart"></i></a> <a class="magnific  quickview-list" data-target="#quick-view-id47" data-toggle="modal" href="'.get_permalink( $woo_product->id ).'"> <i class="icomoon-search"></i></a> <a  href="'.get_permalink( $woo_product->id ).'"> <i class="icomoon-eye-open"></i></a> </div>
             '.$thumbnail.' '.$slideImageHtml.' </div>
            <div class="product-bottom">
              <h3 class="product-name x-hover"><span class="x-hover-text">'.get_the_title($woo_product->id).'</span></h3>
              <div class="price-box"><span class="price">'.$priceHtml.'</span></div> 
              <div class="only-list-view">
                <div class="product-desc">
                  '.apply_filters( 'woocommerce_short_description', $post->post_excerpt ).'
                </div>
                <div class="btn-group">
                  <button class="btn btn-danger" type="button" > Add to cart </button>
                </div>
                <div class="btn-group"> <a href="'.get_permalink( $woo_product->id ).'" class="btn ">View more</a> </div>
              </div>
            </div>
          </div>
		                         
                     
					</li>';	
	$r++;
		 endwhile;
		 endif;
	 
$out .= '            
            	</div>	<!--end-->
			</ul>
		</div>
 
	';
$out .= '</div>';	
$out .= $css_animation != '' ? '</div>' : '';	
echo $out;