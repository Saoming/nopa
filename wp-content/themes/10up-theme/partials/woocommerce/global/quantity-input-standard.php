<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>
<input
	type="<?php echo esc_attr( $type ); ?>"
	<?php echo $readonly ? 'readonly="readonly"' : ''; ?>
	id="<?php echo esc_attr( $input_id ); ?>"
	class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
	name="<?php echo esc_attr( $input_name ); ?>"
	value="<?php echo esc_attr( $input_value ); ?>"
	aria-label="<?php esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
	size="4"
	min="<?php echo esc_attr( $min_value ); ?>"
	max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
	<?php if ( ! $readonly ) : ?>
		step="<?php echo esc_attr( $step ); ?>"
		placeholder="<?php echo esc_attr( $placeholder ); ?>"
		inputmode="<?php echo esc_attr( $inputmode ); ?>"
		autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
	<?php endif; ?>
/>
