<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

?>
<div class="clearfix  images" id="image-block">
	<div id="slider-product" class="flexslider">
    	<ul class="slides">     
       
       <?php
		if ( has_post_thumbnail() ) {

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );
				
			$attachment_ids = $product->get_gallery_attachment_ids();
			
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a rel="prettyPhoto[gallery1]" href="%s">%s</a></li>', $image_link, $image ), $post->ID );			
			foreach ( $attachment_ids as $attachment_id ) {

				$image_link = wp_get_attachment_url( $attachment_id );
	
				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
				$image_class = '';
				$image_title = esc_attr( get_the_title( $attachment_id ) );
	
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><a rel="prettyPhoto[gallery1]" href="%s" title="%s" >%s</a></li>', $image_link, $image_title, $image ), $attachment_id, $post->ID, $image_class );
	
			}
		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a rel="prettyPhoto" href="%s"><img src="%s" alt="Placeholder" /></a></li>', woocommerce_placeholder_img_src() ,woocommerce_placeholder_img_src()), $post->ID );

		}
	?>
    	</ul>
	</div>

	
	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
    
</div>
