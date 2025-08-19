<?php
/**
 * The template for displaying the footer.
 *
 * @package TenUpTheme
 */

?>
		</main>
		<?php get_template_part( 'partials/footer/footer' ); ?>
		<?php get_template_part( 'partials/newsletter/newsletter' ); ?>
		<?php //get_template_part( 'partials/woocommerce/cart/drawer' ); ?>

		<!-- Use WooCommerce mini cart - this handles all the cart logic for you -->
		<div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>

		<?php wp_footer(); ?>
	</body>
</html>
