<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>


<div class="popover popover-cart bottom">
    <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				
				
				
				
				
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					
					
					?>
					
			 <div class="media">
					<a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>" class="media-left"><?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ) ?> </a>
                <div class="media-body">
                  <div class="entry-header">
                    <h5 class="entry-title"><a href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', esc_attr($_product->get_title()), $_product ); ?></a></h5>
                  </div>
                  <div class="entry-meta">
                    <div class="price-box"> <span class="price-regular-single"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key )?></span> </div>
                    <div class="qty-cart"><?php echo __('Quantity','PixTheme')?>: <?php echo esc_attr($cart_item['quantity'])?></div>
                  </div>
                  <div  class="del-cart-item"> <?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="" title="%s"> <i class="fa fa-times"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
						?> </div>
                </div>
              </div>

					<?php
				}
			}
		?>

              <div class="panel-footer">
                <div class="row text-center">
                  <div class="col-xs-7 text-left"> <?php _e( 'Subtotal', 'woocommerce' ); ?>: </div>
                  <div class="col-xs-5 text-right"> <?php echo WC()->cart->get_cart_subtotal(); ?> </div>
                </div>
              </div>
              <div class="panel-footer">
                <div class="row text-center"> <a class=" btn btn-cart" href="<?php echo WC()->cart->get_checkout_url(); ?>"> <?php _e( 'Checkout', 'woocommerce' ); ?></a>
                  <button class=" btn btn-danger" type="button" onclick="location.href='<?php echo WC()->cart->get_cart_url(); ?>'"> <?php _e( 'View Cart', 'woocommerce' ); ?> </button>
                </div>
              </div>
	<?php else : ?>

		<div class="empty-cart"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></div>

	<?php endif; ?>
             
</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?> 

