<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
	

	
?>

<li <?php post_class( $classes ); ?>>


<div class="spinner">
  <div class="spinner-container container1">
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="circle3"></div>
    <div class="circle4"></div>
  </div>
  <div class="spinner-container container2">
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="circle3"></div>
    <div class="circle4"></div>
  </div>
  <div class="spinner-container container3">
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="circle3"></div>
    <div class="circle4"></div>
  </div>
</div>

  <div class="product-container <?php if ( !$product->is_in_stock() ) : ?>label-not-available-active<?php endif;?>">
    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
    <div class="product-image"><a href="<?php the_permalink(); ?>">
      <?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
      </a>
	  <?php
	  	$attach_ids = $product->get_gallery_attachment_ids();
		$attachment_count = count( $product->get_gallery_attachment_ids() );
		if($attachment_count > 0){
			$image_link = wp_get_attachment_url( esc_attr($attach_ids[0]) ); 
			$image = wp_get_attachment_image(  esc_attr($attach_ids[0]), 'shop_catalog');
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a class="slider_img" href="%s">%s</a>', get_the_permalink(), $image ), esc_attr($product->ID) );
		}
	  ?>
      <div class="btn-action-item"> 
      	<?php do_action('woocommerce_after_shop_loop_item')?>
      	<a href="<?php echo esc_url( add_query_arg( 'add_to_wishlist',  esc_attr($product->id) ) )?>"> <i class="icomoon-heart"></i></a>
      	<a  href="<?php the_permalink(); ?>" class="magnific quickview-list" data-toggle="modal" data-target="#quick-view-id47" > <i class="icomoon-search"></i></a>
      	<a href="<?php the_permalink(); ?>" > <i class="icomoon-eye-open"></i></a> 
      </div>
    </div>
    <div class="product-bottom">
      <h3 class="product-name x-hover"><span class="x-hover-text">
        <?php the_title(); ?>
        </span></h3>
      <div class="price-box">
        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
      </div>
      <div class="only-list-view">
        <div class="product-desc">
          <p><?php echo the_excerpt();?></p>
        </div>
       <!-- <div class="btn-group">
          <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
        <div class="btn-group"> <a class="btn "  href="<?php the_permalink(); ?>"><?php echo __('View more','PixTheme')?></a> </div>-->
      </div>
    </div>
  </div>
</li>
