<div id="cart-drawer" class="woocommerce-cart-drawer">
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
		<!-- Use WooCommerce mini cart - this handles all the cart logic for you -->
		<div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>


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

				<div class="cart-subtotal">
					<span><?php esc_html_e('Subtotal:', 'your-textdomain'); ?></span>
					<strong><?php echo WC()->cart->get_cart_subtotal(); ?></strong>
				</div>
				<a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-btn">
					<?php esc_html_e('CHECK OUT', 'your-textdomain'); ?>
				</a>
			</div>
		</div>
	</div>
</div>
