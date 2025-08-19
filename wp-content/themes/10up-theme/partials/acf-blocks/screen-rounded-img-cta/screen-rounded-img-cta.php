<?php
/**
 * Screen Rounded Image CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'screen-rounded-img-cta-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Load value and assign values
$screen_img_rounded_cta_title = get_field( 'screen_img_rounded_cta_title' );
$screen_img_rounded_cta_img = get_field( 'screen_img_rounded_cta_img' );
$screen_img_rounded_cta_button = get_field( 'screen_img_rounded_cta_button' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'screen-rounded-img-cta';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

?>
<section
	id="<?php echo esc_attr( $id ); ?>"
	class="container container--relative <?php echo esc_attr( $class_name ); ?>"
	>
	<div class="screen-rounded-img-cta__inner">

		<?php if ( ! empty( $screen_img_rounded_cta_img ) ) : ?>
			<div class="screen-rounded-img-cta__img-wrapper">
				<?php echo wp_get_attachment_image( $screen_img_rounded_cta_img['id'], 'full', false, array( 'class' => 'screen-rounded-img-cta__img', 'alt' => esc_attr( $screen_img_rounded_cta_img['alt'] ) ) ); ?>
			</div>
		<?php endif; ?>

		<div class="screen-rounded-img-cta__content-wrapper">
			<?php if ( ! empty( $screen_img_rounded_cta_title ) ) : ?>
				<h2 class="screen-rounded-img-cta__title">
					<?php echo esc_html( $screen_img_rounded_cta_title ); ?>
				</h2>
			<?php endif; ?>
			<?php if ( ! empty( $screen_img_rounded_cta_button ) ) : ?>
				<div class="screen-rounded-img-cta__button-wrapper">
					<a href="<?php echo esc_url( $screen_img_rounded_cta_button['url'] ); ?>" class="button-primary">
						<?php echo esc_html( $screen_img_rounded_cta_button['title'] ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
