<?php
/**
 * Store Newsletter ( Popup Banner )
 *
 * @package TenUpTheme
 */

	if ( function_exists( 'get_field' ) ) {
	$args['enable_newsletter'] 						= get_field( 'enable_newsletter', 'option' );
	$args['newsletter_title'] 							= get_field( 'newsletter_title', 'option' );
	$args['newsletter_description'] 	= get_field( 'newsletter_description', 'option' );
	$args['newsletter_image'] 							= get_field( 'newsletter_image', 'option' );
	$args['newsletter_shortcode'] 			= get_field( 'newsletter_shortcode', 'option' );
}

if( isset( $args['enable_newsletter'] ) && $args['enable_newsletter'] ) {
	if ( is_home() || is_front_page() ) {
		get_template_part( 'partials/newsletter/newsletter', 'view', $args );
	}
}

