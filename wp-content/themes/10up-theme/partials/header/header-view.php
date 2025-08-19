<?php
/**
 * Site Header Default HTML
 *
 * @package TenUpTheme
 */
?>
<header class="site-header container" role="banner">
	<div class="site-desktop-header__inner">

		<div class="header__brand">
			<?php if ( $args['brand_logo_header'] ) : ?>
			<a href="<?php echo home_url(); ?>" class="header__brand-link">
				<img src="<?php echo esc_url( $args['brand_logo_header']['url'] ); ?>" alt="SayNopa Logo" class="header__brand-image">
			</a>
			<?php endif; ?>
		</div>

		<?php if ( $args['menu_header'] ) : ?>
		<?php echo wp_kses( $args['menu_header'], $args['allowed_html'] ); ?>
		<?php endif; ?>

		<div class="header__right-container">
			<div class="header__mobile-navigation-container">
				<button
					id="mobile-navigation-button"
					type="button"
					class="header__menu-mobile-button"
					aria-expanded="false"
					aria-controls="mobile-navigation"
					aria-label="Navigation Menu"
				>
					<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M2.625 10H18.375" stroke="#111121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M2.625 5H18.375" stroke="#111121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M2.625 15H18.375" stroke="#111121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</button>
			</div>

			<div class="header__woo">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" class="header__account-link">
					<?php if ( $args['mobile_sign_in_image'] ) : ?>
					<img class="account-mobile" src="<?php echo esc_url( $args['mobile_sign_in_image']['url'] ); ?>" alt="Account">
					<?php endif; ?>
					<span class="account-desktop">Account</span>
				</a>

				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header__cart-link">
					<?php if ( $args['mobile_cart_image'] ) : ?>
					<img class="cart-mobile" src="<?php echo esc_url( $args['mobile_cart_image']['url'] ); ?>" alt="Cart">
					<?php endif; ?>
					<span class="cart-desktop">
						Cart
						<span class="header__cart-count">(<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>)</span>
					</span>
				</a>
			</div>
		</div>
	</div>
</header>
