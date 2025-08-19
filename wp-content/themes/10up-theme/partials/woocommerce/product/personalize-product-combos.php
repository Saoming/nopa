<?php
global $product;
$product_id                   = $product->get_id();
$enable_customization_options = get_field( 'enable_customization_options', $product_id );
if ( ! $enable_customization_options ) {
	return;
}

// get default selected colors
$top_lid_default = get_field( 'top_lid_default', $product_id );
$sip_lid_default = get_field( 'sip_lid_default', $product_id );
$base_default    = get_field( 'base_default', $product_id );
?>

<?php
if ( have_rows( 'color_combos', $product_id ) ) :
	$color_combos_title = get_field( 'color_combos_title', $product_id );
	?>
<div class="pp-combos-designs combo-designs">
	<?php if ( $color_combos_title ) : ?>
		<div class="pp-combos-designs-title"><?php echo esc_html( $color_combos_title ); ?></div>
	<?php endif; ?>

	<div class="pp-combos-designs-list">
		<?php
		$combo_index = 0; // Add counter for unique IDs
		while ( have_rows( 'color_combos', $product_id ) ) : the_row();
			$top_lid_color = get_sub_field( 'top_lid_color', $product_id );
			$sip_lid_color = get_sub_field( 'sip_lid_color', $product_id );
			$base_color    = get_sub_field( 'base_color', $product_id );
			$product_image = get_sub_field( 'product_image', $product_id );
			$combo_id = 'color_combo_' . $combo_index; // Create unique ID
			?>
			<div class="pp-combos-designs-item">
				<input
					type="radio"
					id="<?php echo esc_attr( $combo_id ); ?>"
					name="selected_color_combo"
					value="<?php echo esc_attr( $combo_index ); ?>"
					data-top-lid="<?php echo esc_attr( $top_lid_color ); ?>"
					data-sip-lid="<?php echo esc_attr( $sip_lid_color ); ?>"
					data-base="<?php echo esc_attr( $base_color ); ?>"
					data-image="<?php echo esc_attr( $product_image['ID'] ); ?>"
					<?php if ( $top_lid_color === $top_lid_default['value'] && $sip_lid_color === $sip_lid_default['value'] && $base_color === $base_default['value'] ) : ?>
						checked
					<?php endif; ?>
				/>
				<label for="<?php echo esc_attr( $combo_id ); ?>" class="pp-combos-designs-item-image">
					<?php echo wp_get_attachment_image( $product_image['ID'], 'full' ); ?>
				</label>
			</div>
		<?php
		$combo_index++; // Increment counter
		endwhile;
		?>
	</div><!-- .pp-combos-designs-list -->
</div><!-- .pp-combos-designs -->
	<?php
endif;
?>

<div class="pp-combos-designs custom-designs">
	<div class="pp-combos-designs-title"><?php esc_html_e( 'Your Designs:', 'tenup-theme' ); ?></div>
	<div class="pp-combos-designs-list">
		<div class="pp-combos-designs-item">
			<div class="customization-placeholder">
				<span>?</span>
			</div>
		</div>
		<?php
		for ($i = 0; $i < 4; $i++) :?>
		<div class="pp-combos-designs-item">
			<div class="customization-placeholder">
				<span>?</span>
			</div>
		</div>
		<?php
		endfor
		?>
	</div>
</div><!-- #personalize-product-custom-designs -->

<button type="button" data-micromodal-trigger="personalize-product-modal" class="button-secondary personalize-your-own-button"><?php esc_html_e( 'Personalize your own', 'tenup-theme' ); ?></button>
<?php
