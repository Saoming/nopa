<?php
/**
 * Full Width Image Banner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'full-width-image-banner-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Load value and assign values
$full_width_image_banner_image = get_field( 'full_width_image_banner' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'full-width-image-banner';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

?>
<section
	id="<?php echo esc_attr( $id ); ?>"
	class="container--relative <?php echo esc_attr( $class_name ); ?>"
	>
	<div class="full-width-image-banner__inner">
		<?php if ( ! empty( $full_width_image_banner_image ) ) : ?>
			<div class="full-width-image-banner__image-wrapper">
				<?php echo wp_get_attachment_image( $full_width_image_banner_image['id'], 'full', false, array( 'alt' => $full_width_image_banner_image['alt'] ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
