<?php
/**
 * How It Works Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'how-it-works-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Load value and assign values
$how_it_works_background_color = get_field( 'how_it_works_background_color' );
$how_it_works_repeater									= get_field( 'how_it_work', 'option' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'how-it-works';
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
	<?php if ( ! empty( $how_it_works_background_color ) ) : ?>
		style="background-color: <?php echo esc_attr( $how_it_works_background_color ); ?>;"
	<?php endif; ?>
>
<div class="how-it-works_inner">
	<h2	class="how-it-works__section-title">
		<?php echo esc_html( get_field( 'how_it_works_section_title', 'option' ) ); ?>
	</h2>
 <?php	if ( $how_it_works_repeater ) : ?>
		<div class="how-it-works__items">
		<?php foreach( $how_it_works_repeater as $single_hiw ): ?>
			<div class="how-it-works__item">
				<?php if ( ! empty( $single_hiw['hiw_image'] ) ) : ?>
					<div class="how-it-works__icon">
						<img src="<?php echo esc_url( $single_hiw['hiw_image']['url'] ); ?>" alt="<?php echo esc_attr( $single_hiw['hiw_image']['alt'] ); ?>">
					</div>
				<?php endif; ?>
				<?php if ( ! empty( $single_hiw['hiw_title'] ) ) : ?>
					<h3 class="how-it-works__title"><?php echo esc_html( $single_hiw['hiw_title'] ); ?></h3>
				<?php endif; ?>
				<?php if ( ! empty( $single_hiw['hiw_description'] ) ) : ?>
					<p class="how-it-works__description"><?php echo esc_html( $single_hiw['hiw_description'] ); ?></p>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
</div>
</section>
