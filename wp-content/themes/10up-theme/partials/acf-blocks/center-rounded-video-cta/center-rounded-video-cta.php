<?php
/**
 * Center Rounded Video CTA Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'center-rounded-video-cta-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Load value and assign values
$center_video_rounded_cta_title 			= get_field( 'center_video_rounded_cta_title' );
$center_video_rounded_cta_video				= get_field( 'center_video_rounded_cta_video' );
$center_video_rounded_cta_button   = get_field( 'center_video_rounded_cta_button' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'center-rounded-video-cta';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

?>
<section
	id="<?php echo esc_attr( $id ); ?>"
	class="nopa-block container--relative <?php echo esc_attr( $class_name ); ?>"
	>
	<div class="center-rounded-video-cta__inner container">
		<?php if ( ! empty( $center_video_rounded_cta_title ) ) : ?>
			<h2 class="center-rounded-video-cta__title">
				<?php echo esc_html( $center_video_rounded_cta_title ); ?>
			</h2>
		<?php endif; ?>

		<?php if ( ! empty( $center_video_rounded_cta_video ) ) : ?>
			<div class="center-rounded-video-cta__video-wrapper embed-container">
				<video autoplay muted loop playsinline class="center-rounded-video-cta__video">
					<source src="<?php echo esc_url( $center_video_rounded_cta_video ); ?>" type="video/mp4">
					Your browser does not support the video tag.
				</video>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $center_video_rounded_cta_button ) ) : ?>
			<div class="center-rounded-video-cta__button-wrapper">
				<a href="<?php echo esc_url( $center_video_rounded_cta_button['url'] ); ?>" class="button-primary">
					<?php echo esc_html( $center_video_rounded_cta_button['title'] ); ?>
				</a>
			</div>
		<?php endif; ?>
	</section>
