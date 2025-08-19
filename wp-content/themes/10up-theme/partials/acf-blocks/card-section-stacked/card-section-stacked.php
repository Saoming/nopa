<?php
/**
 * Card Section Stacked Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// load value and assign values
$card_section_stacked_repeater = get_field( 'card_section_stacked_repeater' );

// Create id attribute allowing for custom "anchor" value.
$id = 'card-section-stacked-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'card-section-stacked';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

?>
<?php if ( $card_section_stacked_repeater ) : ?>
<section
	id="<?php echo esc_attr( $id ); ?>"
	class="<?php echo esc_attr( $class_name ); ?>">
	<div class="card-section-stacked__inner">
		<?php foreach ( $card_section_stacked_repeater as $card_section_stacked_item ) : ?>
			<div class="card-section-stacked__item"<?php if ( ! empty( $card_section_stacked_item['card_section_background_color'] ) ) : ?> style="background-color: <?php echo esc_attr( $card_section_stacked_item['card_section_background_color'] ); ?>;"<?php endif; ?>>
				<div class="card-section-stacked__item-inner">
					<?php if ( ! empty( $card_section_stacked_item['card_section_left_image'] ) ) : ?>
						<div class="card-section-stacked__image">
							<img src="<?php echo esc_url( $card_section_stacked_item['card_section_left_image']['url'] ); ?>" alt="<?php echo esc_attr( $card_section_stacked_item['card_section_left_image']['alt'] ); ?>">
						</div>
					<?php endif; ?>
					<div class="card-section-stacked__content">
						<h3 class="card-section-stacked__title" <?php if ( ! empty( $card_section_stacked_item['card_section_title_color'] ) ) : ?> style="color: <?php echo esc_attr( $card_section_stacked_item['card_section_title_color'] ); ?>;"<?php endif; ?>><?php echo esc_html( $card_section_stacked_item['card_section_title'] ); ?></h3>
						<div class="card-section-stacked__desc"><?php echo wp_kses_post( $card_section_stacked_item['card_section_description'] ); ?></div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>

