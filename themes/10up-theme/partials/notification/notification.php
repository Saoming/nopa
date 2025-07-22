<?php
/**
 * Store Notification / Top Banner
 *
 * @package TenUpTheme
 */

	if ( function_exists( 'get_field' ) ) {
	$args['store_notifications'] 	= get_field( 'store_notifications', 'option' );
}

get_template_part( 'partials/notification/notification', 'view', $args );
