<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );


$posts_per_page = pixtheme_get_option('pix_pelated_products',6);

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => (int)$posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related products">
    
    <div class="row">
      <div class="col-lg-12 text-center">
        <div data-animation="flipInX" class="heading-wrap animated animation-done flipInX">
          <?php if (pixtheme_get_option('pix_pelated_products_logo',false)):?>
	          <div class="small-logo">
	          	<img width="106" height="36" src="<?php echo pixtheme_get_option('pix_pelated_products_logo',false)?>" alt="logo">
	          </div>
          <?php endif;?>
          <h2 class="section-heading "><?php _e( 'Related Products', 'woocommerce' ); ?></h2>
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
