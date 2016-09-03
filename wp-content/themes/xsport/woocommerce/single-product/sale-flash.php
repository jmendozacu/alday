<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post, $product;
$products_sold = get_post_meta( esc_attr($product->id), 'total_sales', true );
$published = esc_attr($product->post->post_date);
$toNewDate = date("Y-m-d h:i:s", strtotime($published) + 3600 * 24 * (int)pixtheme_get_option('pix_how_new',5));

?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="label-sale">' . __( 'sale', 'woocommerce' ) . '</span>', $post, $product ); ?>
	
<?php endif; ?>
	
<?php if ( !$product->is_in_stock() && pixtheme_get_option('pix_show_oos_label',false)):?>
	
	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="label-not-available">' . __( 'not available', 'woocommerce' ) . '</span>', $post, $product ); ?>

<?php endif; ?>


<?php if ( $products_sold > pixtheme_get_option('pix_min_best_sales',5) && pixtheme_get_option('pix_show_best_label',false)):?>
	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="label-best">' . __( 'bestseller', 'woocommerce' ) . '</span>', $post, $product ); ?>
<?php endif?>


<?php if ( $toNewDate > current_time('mysql') && pixtheme_get_option('pix_show_new_label',false)):?>
	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="label-hot">' . __( 'hot', 'woocommerce' ) . '</span>', $post, $product ); ?>

<?php endif?>

