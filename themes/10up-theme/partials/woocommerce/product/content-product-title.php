<div class="woo-product-link__container">
	<?php
	global $product;
	echo woocommerce_get_product_thumbnail();
	echo '<div class="woo-product-link__hover">';
	foreach ( $product->get_gallery_image_ids() as $index => $image_id ) {
		if ( 0 == $index ) {
			printf( '<img class="woo-product-img__hover" src="%s">', esc_url( wp_get_attachment_url( $image_id ) ) );
		}
		break;
	}
	echo woocommerce_template_loop_add_to_cart( array( 'class' => 'woo-product-button--primary' ) );
	echo '</div>';
	?>
</div>
