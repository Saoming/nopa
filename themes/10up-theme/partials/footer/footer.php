<?php
/**
 * Site Footer
 *
 * @package TenUpTheme
 */

	$args['footer_nav'] = wp_nav_menu(
	array(
		'container'       => 'nav',
		'container_class' => 'footer__menu-container container page-container',
		'echo'            => false,
		'menu_class'      => 'footer__menu',
		'theme_location'  => 'footer',
		'link_before'     => '<span class="footer-menu-item-text">',
		'link_after'      => '</span>',
		'items_wrap'      => '<ul id="%1$s" class="%2$s" role="navigation">%3$s</ul>',
	)
);

$args['privacy_nav'] = wp_nav_menu(
	array(
		'container'       => 'nav',
		'container_class' => 'privacy__menu-container page-container',
		'echo'            => false,
		'menu_class'      => 'privacy__menu',
		'theme_location'  => 'privacy',
		'link_before'     => '<span class="privacy-menu-item-text">',
		'link_after'      => '</span>',
		'items_wrap'      => '<ul id="%1$s" class="%2$s" role="navigation">%3$s</ul>',
	)
);

if ( function_exists( 'get_field' ) ) {
	$args['brand_footer_logo'] 							= get_field( 'brand_footer_logo', 'option' );
	$args['copyright_text'] 										= get_field( 'copyright_text', 'option' );
}

get_template_part( 'partials/footer/footer', 'view', $args );
