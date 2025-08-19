<?php
/**
 * Two Column Slider Text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */


	// Create id attribute allowing for custom "anchor" value.
$id = 'two-column-slider-text-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

//	Load value and assign values
$two_column_slider_text_repeater = get_field( 'two_column_slider_text_repeater' );
$two_column_slider_text_description =	get_field( 'two_column_slider_text_description' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'two-column-slider-text';
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
	<div class="two-column-slider-text__inner">
		<div class="two-column-slider__repeater">
		<?php if ( $two_column_slider_text_repeater ) : ?>
			<section
			id="twoColumnSliderTextCarousel"
			class="benefits-card-container splide"
			role="group"
			aria-label="Check our Location Partner Slider"
			data-splide='{"type":"loop","arrows":false,"autoplay":true,"pagination":true}'
		>
			<div class="splide__track">
				<ul class="splide__list">
				<?php foreach ( $two_column_slider_text_repeater as $two_column_slider_text_item ) : ?>
					<li class="splide__slide two-column-slider-text__item">
						<div class="two-column-slider-text__item-inner">
							<?php if ( ! empty( $two_column_slider_text_item['two_column_slider_text_location_image'] ) ) : ?>
								<div class="two-column-slider-text__location-image">
									<img src="<?php echo esc_url( $two_column_slider_text_item['two_column_slider_text_location_image']['url'] ); ?>" alt="<?php echo esc_attr( $two_column_slider_text_item['two_column_slider_text_location_image']['alt'] ); ?>">
								</div>
							<?php endif; ?>
							<?php if( !empty( $two_column_slider_text_item['two_column_slider_text_partner_location_logo'])) : ?>
								<div class="two-column-slider-text__partner-logo">
									<img src="<?php echo esc_url( $two_column_slider_text_item['two_column_slider_text_partner_location_logo']['url'] ); ?>" alt="<?php echo esc_attr( $two_column_slider_text_item['two_column_slider_text_partner_location_logo']['alt'] ); ?>">
								</div>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>
		</div>

		<div class="two-column-slider-text__content">
			<?php if ( $two_column_slider_text_description ) : ?>
				<div class="two-column-slider-text__description">
					<?php echo wp_kses_post( $two_column_slider_text_description ); ?>
				</div>
			<?php endif; ?>
		</div>

	</div>
</section>
