<?php
/**
 * Global Reuse Club CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'global-reuse-club-cta';
if ( ! empty( $block ) ) {
	$id = 'global-reuse-club-cta-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$id = $block['anchor'];
	}
}

// Load value and assign values
$cta_title = get_field( 'cta_title', 'option' );
$cta_description = get_field( 'cta_description', 'option' );
$cta_form_shortcode	= get_field( 'cta_form_shortcode', 'option' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'global-reuse-club-cta';
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
<div class="global-reuse-club-cta__inner container">
	<div class="global-reuse-club-cta__box">
		<?php if ( $cta_title ) : ?>
		<h2	class="global-reuse-club-cta__section-title">
			<?php echo esc_html( $cta_title ); ?>
		</h2>
	<?php endif; ?>

	<?php if ( $cta_description ) : ?>
		<p class="global-reuse-club-cta__description">
			<?php echo esc_html( $cta_description ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $cta_form_shortcode ) : ?>
		<div class="global-reuse-club-cta__form">
			<?php echo do_shortcode( $cta_form_shortcode ); ?>
		</div>
	<?php endif; ?>
	</div>
</div>
</section>
