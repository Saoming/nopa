<?php
global $product;
$product_id                   = $product->get_id();
$enable_customization_options = get_field( 'enable_customization_options', $product_id );
if ( ! $enable_customization_options ) {
	return;
}

$product_colors = get_field( 'product_colors', 'option' );
?>
<div id="personalize-product-modal" class="modal micromodal-slide" aria-hidden="true">
	<div class="modal__overlay" tabindex="-1" data-micromodal-close>
		<div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="personalize-product-modal-title" >

			<button class="modal__close" aria-label="Close modal" data-micromodal-close></button>

			<div class="personalize-product">
				<h2><?php echo get_the_title( $product_id ); ?></h2>

				<?php
				// get woocommerce product price
				$price = $product->get_price_html();
				?>
				<p class="product-price"><?php echo $price; ?></p>

				<div class="personalize-product-container">

					<div class="personalize-product-image">
						<?php echo get_the_post_thumbnail( $product_id, 'full' ); ?>
					</div>

					<div class="personalize-product-options">
						<div class="personalize-product-tabs-wrapper">
							<div class="personalize-product-tabs-header">
								<h3 data-tab="color" class="active"><?php _e( 'Color', 'tenup-theme' ); ?></h3>
								<h3 data-tab="text-engraving"><?php _e( 'Text Engraving', 'tenup-theme' ); ?></h3>
							</div>

							<div class="personalize-product-tabs-content personalize-product-tabs-content-color active">

								<?php
								$parts = [ 'top_lid', 'sip_lid', 'base' ];

								foreach ( $parts as $part ) {
									$colors  = get_field( "{$part}_colors", $product_id );
									$default = get_field( "{$part}_default", $product_id ) ? get_field( "{$part}_default", $product_id ) : $colors[0]['value'];

									if ( $colors ) {
										echo '<div class="personalize-product-tabs-content-color-item"><div class="personalize-product-tabs-content-color-item-label">' . esc_html( ucwords( str_replace( '_', ' ', $part ) ) ) . ' ' . esc_html__( 'Color', 'tenup-theme' ) . ': <span>' . esc_html( $default['label'] ) . '</span></div>';
										echo '<div class="personalize-product-tabs-content-color-item-options">';
										foreach ( $colors as $color ) {
											$checked = ( $color['value'] === $default['value'] ) ? 'checked' : '';

											// find $color['value'] in $product_colors[] to match with 'the_color' key.
											$product_color = null;
											foreach ($product_colors as $pc) {
												if ($pc['color_value'] === $color['value']) {
													$product_color = $pc['the_color'];
													break;
												}
											}

											echo '<label class="personalize-product-tabs-content-color-item-option">
													<input type="radio" name="' . esc_attr( $part ) . '_color" value="' . esc_attr( $color['value'] ) . '" ' . esc_attr( $checked ) . ' aria-label="' . esc_attr( $color['label'] ) . '">
													<span class="color-swatch" style="background-color: ' . esc_attr( $product_color ) . '"></span>
												</label>';
										}
										echo '</div>';
										echo '</div>';
									}
								}
								?>

							</div><!-- .personalize-product-tabs-content-color -->

							<div class="personalize-product-tabs-content personalize-product-tabs-content-text-engraving">

								<div class="personalize-product-tabs-content-text-engraving-wrapper">
									<label for="engraving_text"><?php _e( 'Write Text (Optional):', 'tenup-theme' ); ?></label>
									<input type="text" name="engraving_text" id="engraving_text" maxlength="30" placeholder="<?php _e('Enter', 'tenup-theme'); ?>">
									<div class="characters-left"><?php _e('0/30 characters', 'tenup-theme'); ?></div>
								</div>

							</div><!-- .personalize-product-tabs-content-text-engraving -->

							<div class="personalize-product-done-button-wrapper">
								<button class="personalize-product-done-button button" type="button" data-micromodal-close>
									<?php _e( 'Done', 'tenup-theme' ); ?>
								</button>
							</div>

						</div><!-- .personalize-product-tabs-wrapper -->
					</div><!-- .personalize-product-options -->

				</div><!-- .personalize-product-container -->

			</div><!-- .personalize-product -->


		</div>
	</div>
</div>
