<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	

	<span class="posted_in"><?php echo wp_kses($product->get_categories( ' ', '' . _n( 'Category:', 'Categories:', esc_attr($cat_count), 'woocommerce' ) . ' ', '' ),'default'); ?></span>

	<span class="tagged_as"><?php echo wp_kses($product->get_tags( ' ', '' . _n( 'Tag:', 'Tags:', esc_attr($tag_count), 'woocommerce' ) . ' ', '' ),'default'); ?></span>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
