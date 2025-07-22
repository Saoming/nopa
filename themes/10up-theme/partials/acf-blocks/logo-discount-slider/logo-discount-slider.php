<?php
/**
 * Logo Discount Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'logo-discount-slider-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Load value and assign values
$logo_discount_slider_repeater = get_field( 'logo_discount_slider_repeater' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'logo-discount-slider';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

?>

<section
	id="<?php echo esc_attr( $id ); ?>"
	class="nopa-full-block container--relative <?php echo esc_attr( $class_name ); ?>"
>
	<div class="logo-discount-slider__inner">
		<div class="logo-discount-slider__repeater">
			<?php if ( $logo_discount_slider_repeater ) : ?>
				<section
					id="logoDiscountCarousel"
					class="benefits-card-container splide"
					role="group"
					aria-label="Check our Location Partner Slider"
					data-splide='{"type":"loop","arrows":false,"autoplay":false,"pagination":false,"focus":"center","drag":true,"pauseOnHover":false,"perPage":7,"autoScroll":{"speed":0.5},"breakpoints":{"640":{"perPage":3}}}'
				>
					<div class="splide__track">
						<ul class="splide__list">
							<?php foreach ( $logo_discount_slider_repeater as $logo_discount_slider_item ) : ?>
								<li class="splide__slide logo-discount-slider__item">
									<div class="logo-discount-slider__item-inner">
										<?php if ( ! empty( $logo_discount_slider_item['logo_discount_slider_location_logo'] ) ) : ?>
											<div class="logo-discount-slider__logo">
												<img src="<?php echo esc_url( $logo_discount_slider_item['logo_discount_slider_location_logo']['url'] ); ?>" alt="<?php echo esc_attr( $logo_discount_slider_item['logo_discount_slider_location_logo']['alt'] ); ?>">
											</div>
										<?php endif; ?>
										<?php if ( ! empty( $logo_discount_slider_item['logo_discount_slider_location_discount_promotion'] ) ) : ?>
											<div class="logo-discount-slider__promotion">
												<p><?php echo esc_html( $logo_discount_slider_item['logo_discount_slider_location_discount_promotion'] ); ?></p>
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
	</div>
</section>
