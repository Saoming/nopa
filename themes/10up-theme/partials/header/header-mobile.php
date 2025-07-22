<?php
/**
 * Site Header Menu Mobile Default HTML
 *
 * @package TenUpTheme
 */

?>

<section
	id="mobile-navigation"
	class="v-hidden mobile-navigation__container"
	aria-expanded="false"
	tabindex="-1"
	role="dialog"
	aria-labelledby="mobile-menu">
	<div class="mobile-nav_inner">
		<div class="mobile-nav__header">
			<button
				id="mobile-nav__close"
				type="button"
				class="mobile-nav__close"
				aria-controls="mobile-navigation"
				aria-label="Close Navigation Menu"
			>
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M1 1L15 15L1 1ZM1 15L15 1L1 15Z" fill="currentColor"/>
					<path d="M1 1L15 15M1 15L15 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
		</div>

		<?php echo wp_kses( $args['menu_header_mobile'], $args['allowed_html'] ); ?>

		<div	class="mobile-nav__footer">
			<div class="mobile-nav__woo">
					<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>" class="header__account-link">
					SIGN IN
				</a>
			</div>
		</div>

	</div>
	<div class="mobile-nav__overlay"></div>
</section>
