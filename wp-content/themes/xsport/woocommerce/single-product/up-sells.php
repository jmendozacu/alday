<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) {
	return;
}

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="upsells products">
    
    <div class="row">
      <div class="col-lg-12 text-center">
        <div data-animation="flipInX" class="heading-wrap animated animation-done flipInX">
          <?php if (pixtheme_get_option('pix_pelated_products_logo',false)):?>
	          <div class="small-logo">
	          	<img width="106" height="36" src="<?php echo pixtheme_get_option('pix_pelated_products_logo',false)?>" alt="logo">
	          </div>
          <?php endif;?>
          <h2 class="section-heading "><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>
        </div>
      </div>
    </div>
    



		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
