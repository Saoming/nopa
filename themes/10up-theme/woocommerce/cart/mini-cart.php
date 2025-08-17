<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */
defined( 'ABSPATH' ) || exit;

use TenUpTheme\ProductCustomizer;
?>
<div id="cart-drawer">

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="woocommerce-cart-drawer">
	<div class="cart-drawer-header">
		<h2>
			<?php esc_html_e('CART', 'your-textdomain'); ?>
			<span class="header__cart-count">(<?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>)</span>
		</h2>
		<button class="close-drawer" aria-label="<?php esc_attr_e('Close', 'your-textdomain'); ?>">×</button>
	</div>

	<!-- Free shipping banner like in Figma -->
	<div class="cart-shipping-banner">
		<p>
			<?php esc_html_e('Free shipping with order over 800.000 VND!', 'your-textdomain'); ?>
			<span class="shipping-progress-bar">
				<span class="shipping-progress-bar-fill"></span>
			</span>
		</p>
	</div>

	<div class="cart-drawer-content">

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
			<?php
			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					/**
					 * This filter is documented in woocommerce/templates/cart/cart.php.
					 *
					 * @since 2.1.0
					 */
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">

						<div class="cart-item-wrapper">
							<div class="item-image">
								<?php if ( empty( $product_permalink ) ) : ?>
									<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php else : ?>
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</a>
								<?php endif; ?>
							</div>

							<div class="item-details">
								<div class="item-name">
									<?php if ( empty( $product_permalink ) ) : ?>
										<?php echo wp_kses_post( $product_name ); ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo wp_kses_post( $product_name ); ?>
										</a>
									<?php endif; ?>
								</div>

								<?php if ( $_product->get_sku() ) : ?>
									<div class="item-variant"><?php echo esc_html( $_product->get_sku() ); ?></div>
								<?php endif; ?>

								<!-- Show customization details -->
								<?php
								$enable_customization_options = get_field( 'enable_customization_options', $product_id );
								if ( $enable_customization_options ) :
									$product_customizer = new ProductCustomizer();
									$customization_details = $product_customizer->acf_display_customization_cart( [], $cart_item );
									if ( ! empty( $customization_details ) ) : ?>
										<div class="item-customization">
											<?php foreach ( $customization_details as $detail ) : ?>
												<div class="customization-detail">
													<span class="detail-label"><?php echo esc_html( $detail['name'] ); ?>:</span>
													<span class="detail-value"><?php echo wp_kses_post( $detail['value'] ); ?></span>
												</div>
											<?php endforeach; ?>
										</div>
									<?php endif;
								endif; ?>

								<div class="item-price">
									<?php echo $product_price; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
							</div>

							<div class="item-actions">
								<?php
								$product = $cart_item['data'];
								if ( $product->is_sold_individually() ) {
									return $product_quantity; // No qty for sold individually products
								}

								$input_name  = "cart[{$cart_item_key}][qty]";
								$input_value = $cart_item['quantity'];

								$product_quantity  = '<div class="quantity-controls" data-cart-item-key="' . esc_attr( $cart_item_key ) . '">';
								$product_quantity .= '<button type="button" class="qty-decrease"><span class="icon-minus">-</span></button>';
								$product_quantity .= woocommerce_quantity_input( array(
									'input_name'  => $input_name,
									'input_value' => $input_value,
									'max_value'   => $product->get_max_purchase_quantity(),
									'min_value'   => 1,
									'classes'     => array( 'input-text', 'qty', 'text', 'qty-amount' ),
								), $product, false );
								$product_quantity .= '<button type="button" class="qty-increase"><span class="icon-plug">+</span></button>';
								$product_quantity .= '</div>';
								echo $product_quantity;
								?>

								<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"></a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										/* translators: %s is the product name */
										esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
										esc_attr( $product_id ),
										esc_attr( $cart_item_key ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
								?>
							</div>
						</div>
					</li>
					<?php
				}
			}

			do_action( 'woocommerce_mini_cart_contents' );
			?>
		</ul>


		<div class="cart-drawer-footer">
			<?php if (! WC()->cart->is_empty()) : ?>
				<!-- Cross-sell section like "Other Nopers also bought" -->
				<?php
				$cross_sell_ids = get_cart_based_cross_sells(4);
				if (!empty($cross_sell_ids)) : ?>
					<div class="cart-cross-sells">
						<h4><?php esc_html_e('Other Nopers also bought', 'your-textdomain'); ?></h4>
						<div class="cross-sell-items">
							<?php foreach ($cross_sell_ids as $product_id) : ?>
								<?php
								$product = wc_get_product($product_id);
								if ($product && $product->exists()) : ?>
									<div class="cross-sell-item">
										<a href="<?php echo esc_url($product->get_permalink()); ?>" class="cross-sell-image">
											<?php echo $product->get_image('thumbnail'); ?>
										</a>
										<div class="cross-sell-details">
											<h5><?php echo esc_html($product->get_name()); ?></h5>
										</div>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>


			<div class="cart-totals">
				<p class="woocommerce-mini-cart__total total">
					<?php
					/**
					 * Hook: woocommerce_widget_shopping_cart_total.
					 *
					 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
					 */
					do_action( 'woocommerce_widget_shopping_cart_total' );
					?>
				</p>

				<a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-btn">
					<?php esc_html_e('CHECK OUT', 'your-textdomain'); ?>
				</a>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

	<?php endif; ?>

	</div>
</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>

</div>
