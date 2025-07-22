<footer role="contentinfo" class="footer_container">
	<div class="footer__header-container">
		<?php echo wp_kses_post( $args['footer_nav'] ); ?>
	</div>

	<div class="footer__bottom-container nopa-full-block page-container">
			<?php if ( ! empty( $args['brand_footer_logo'] ) ) : ?>
				<div class="footer__brand-container">
					<img src="<?php echo esc_url( $args['brand_footer_logo']['url'] ); ?>" alt="<?php echo esc_attr( $args['brand_footer_logo']['alt'] ); ?>" class="footer__logo-image" />
				</div>
			<?php endif; ?>

		<div class="footer__privacy-container">
			<?php echo wp_kses_post( $args['privacy_nav'] ); ?>
			<div class="footer__copyright">
				<?php if ( ! empty( $args['copyright_text'] ) ) : ?>
					<?php echo $args['copyright_text']; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</footer>
