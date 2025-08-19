<section class="container--relative product-banner">
		<?php if ( ! empty( $args['product_banner_video'] ) ) : ?>
			<div class="product-banner__video">
				<video loop muted autoplay playsinline>
					<source src="<?php echo esc_url( $args['product_banner_video'] ); ?>" type="video/mp4">
					Your browser does not support the video tag.
				</video>
			</div>
		<?php endif; ?>
		<div class="product-banner__content">
			<?php if ( ! empty( $args['product_banner_title'] ) ) : ?>
				<h1 class="product-banner__title"><?php echo esc_html( $args['product_banner_title'] ); ?></h1>
			<?php endif; ?>

			<?php if ( ! empty( $args['product_banner_description'] ) ) : ?>
				<div class="product-banner__description"><?php echo wp_kses_post( $args['product_banner_description'] ); ?></div>
			<?php endif; ?>

			<?php if ( ! empty( $args['product_banner_cta'] ) ) : ?>
				<a href="<?php echo esc_url( $args['product_banner_cta']['url'] ); ?>" class="button-primary product-banner__cta">
					<?php echo esc_html( $args['product_banner_cta']['title'] ); ?>
				</a>
		<?php endif; ?>
	</div>
			<?php if ( ! empty( $args['product_banner_icon_text'] ) ) : ?>
			<div class="product-banner__icon-text">
				<span><?php echo esc_html( $args['product_banner_icon_text'] ); ?></span>
			</div>
		<?php endif; ?>
</section>
