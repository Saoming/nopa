<?php
/**
 * Banner Below Product List
 *
 * @package TenUpTheme
 */

if ( function_exists( 'get_field' ) ) {
	$banner_below_products_list = get_field( 'banner_below_products_list', 'option' );
}

if ( ! empty( $banner_below_products_list ) ) : ?>
	<section class="container--relative banner-below-product-list">
		<div class="banner-below-product-list__content">
			<?php echo wp_get_attachment_image( $banner_below_products_list['id'], 'full', false, array( 'alt' => $banner_below_products_list['alt'] ) ); ?>
		</div>
	</section>
<?php endif; ?>
