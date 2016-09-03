<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

	echo wp_kses_post( $wrap_before);


	$_shopBreadcrumbExist = false;
	
	foreach ( $breadcrumb as $key => $crumb ) {

		if( (is_product() || is_product_category() || is_product_tag() || is_cart() || is_checkout()) && $key==1){
			$_shopBreadcrumbExist = true;
			echo wp_kses_post( $before );
			echo '<a href="' . esc_url(get_permalink( woocommerce_get_page_id( 'shop' ) )) . '">' . esc_html( get_the_title( woocommerce_get_page_id( 'shop' ) ) ) . '</a>';
			echo wp_kses_post( $after );
			echo wp_kses_post( $delimiter );
		}
		
		if (isset($crumb[0])){
			if ($_shopBreadcrumbExist == true && strtolower($crumb[0]) == 'shop'){
				continue;
			}
			
		}
		
		
		if( ( is_singular( 'post' ) || is_category() || is_tag() ) && $key==1){
			echo wp_kses_post( $before );
			echo '<a href="' . esc_url(get_permalink( get_option('page_for_posts') )) . '">' . esc_html( get_the_title( get_option('page_for_posts') ) ) . '</a>';
			echo wp_kses_post( $after );
			echo wp_kses_post( $delimiter );
		}
		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo wp_kses_post( $before );
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo wp_kses_post( str_replace('>', ' class="active">', $before) ); 
			echo esc_html( $crumb[0] );
		}

		echo wp_kses_post( $after );

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo wp_kses_post( $delimiter );
		}

	}

	echo wp_kses_post( $wrap_after );

}