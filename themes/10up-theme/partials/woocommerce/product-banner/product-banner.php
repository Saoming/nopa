<?php
/**
 * Product Banner
 *
 * @package TenUpTheme
 */

		if ( function_exists( 'get_field' ) ) {
	$args['product_banner_title'] 															= get_field( 'product_banner_title', 'option' );
	$args['product_banner_description'] 									= get_field( 'product_banner_description', 'option' );
	$args['product_banner_video'] 															= get_field( 'product_banner_video', 'option' );
	$args['product_banner_cta'] 																	= get_field( 'product_banner_cta', 'option' );
	$args['product_banner_icon_text'] 											= get_field( 'product_banner_icon_text', 'option' );
}


get_template_part( 'partials/woocommerce/product-banner/product', 'view', $args );


