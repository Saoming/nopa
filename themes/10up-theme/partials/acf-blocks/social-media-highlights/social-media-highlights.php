<?php
/**
 * Social Media Highlights Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'social-media-highlights-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Load value and assign values
$social_media_highlights_title =	get_field( 'social_media_highlights_title' );
$social_media_follow_us_text	= get_field( 'social_media_follow_us_text' );
$social_media_highlights_facebook	= get_field( 'social_media_highlights_facebook' );
$social_media_highlights_instagram	= get_field( 'social_media_highlights_instagram' );
$social_media_highlights_linkedin	= get_field( 'social_media_highlights_linkedin' );
$social_media_highlights_repeater = get_field( 'social_media_highlights_repeater' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'social-media-highlights';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

?>
<section
	id="<?php echo esc_attr( $id ); ?>"
	class="nopa-full-block container--relative <?php echo esc_attr( $class_name ); ?>"
>
	<div class="social-media-highlights__inner">

	<div class="social-media-highlights__header container container--relative">
		<?php if ( ! empty( $social_media_highlights_title ) ) : ?>
			<h2 class="social-media-highlights__title">
				<?php echo esc_html( $social_media_highlights_title ); ?>
			</h2>
		<?php endif; ?>

		<div class="social-media-highlights__follow-us">
		<?php if ( ! empty( $social_media_follow_us_text ) ) : ?>
			<p class="social-media-highlights__follow-us-text">
				<?php echo esc_html( $social_media_follow_us_text ); ?>
			</p>

			<div class="social-media-highlights__links">
				<?php if ( ! empty( $social_media_highlights_facebook ) ) : ?>
					<a href="<?php echo esc_url( $social_media_highlights_facebook['url'] ); ?>" class="social-media-highlights__link social-media-highlights__link--facebook" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $social_media_highlights_facebook['title'] ? $social_media_highlights_facebook['title'] : 'Follow us on Facebook' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M21.8182 0H2.18182C0.976364 0 0 0.976364 0 2.18182V21.8182C0 23.0236 0.976364 24 2.18182 24H13.0909V14.1818H9.81818V10.9091H13.0909V9.15164C13.0909 5.82436 14.712 4.36364 17.4775 4.36364C18.8018 4.36364 19.5022 4.46182 19.8338 4.50655V7.63636H17.9476C16.7738 7.63636 16.3636 8.256 16.3636 9.51055V10.9091H19.8044L19.3375 14.1818H16.3636V24H21.8182C23.0236 24 24 23.0236 24 21.8182V2.18182C24 0.976364 23.0225 0 21.8182 0Z" fill="currentColor"/>
						</svg>
					</a>
				<?php endif; ?>

				<?php if ( ! empty( $social_media_highlights_instagram ) ) : ?>
					<a href="<?php echo esc_url( $social_media_highlights_instagram['url'] ); ?>" class="social-media-highlights__link social-media-highlights__link--instagram" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $social_media_highlights_instagram['title'] ? $social_media_highlights_instagram['title'] : 'Follow us on Instagram' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M12 0C8.7435 0 8.334 0.015 7.0545 0.072C5.775 0.132 4.9035 0.333 4.14 0.63C3.33914 0.931229 2.61374 1.40374 2.0145 2.0145C1.40411 2.61404 0.931661 3.33936 0.63 4.14C0.333 4.902 0.1305 5.775 0.072 7.05C0.015 8.3325 0 8.7405 0 12.0015C0 15.2595 0.015 15.6675 0.072 16.947C0.132 18.225 0.333 19.0965 0.63 19.86C0.9375 20.649 1.347 21.318 2.0145 21.9855C2.6805 22.653 3.3495 23.064 4.1385 23.37C4.9035 23.667 5.7735 23.8695 7.0515 23.928C8.3325 23.985 8.7405 24 12 24C15.2595 24 15.666 23.985 16.947 23.928C18.2235 23.868 19.098 23.667 19.8615 23.37C20.6618 23.0686 21.3867 22.5961 21.9855 21.9855C22.653 21.318 23.0625 20.649 23.37 19.86C23.6655 19.0965 23.868 18.225 23.928 16.947C23.985 15.6675 24 15.2595 24 12C24 8.7405 23.985 8.3325 23.928 7.0515C23.868 5.775 23.6655 4.902 23.37 4.14C23.0684 3.33934 22.5959 2.61401 21.9855 2.0145C21.3864 1.40351 20.661 0.930968 19.86 0.63C19.095 0.333 18.222 0.1305 16.9455 0.072C15.6645 0.015 15.258 0 11.997 0H12.0015H12ZM10.9245 2.163H12.0015C15.2055 2.163 15.585 2.1735 16.8495 2.232C18.0195 2.2845 18.6555 2.481 19.0785 2.6445C19.638 2.862 20.0385 3.123 20.4585 3.543C20.8785 3.963 21.138 4.362 21.3555 4.923C21.5205 5.3445 21.7155 5.9805 21.768 7.1505C21.8265 8.415 21.8385 8.7945 21.8385 11.997C21.8385 15.1995 21.8265 15.5805 21.768 16.845C21.7155 18.015 21.519 18.6495 21.3555 19.0725C21.1631 19.5935 20.856 20.0647 20.457 20.451C20.037 20.871 19.638 21.1305 19.077 21.348C18.657 21.513 18.021 21.708 16.8495 21.762C15.585 21.819 15.2055 21.8325 12.0015 21.8325C8.7975 21.8325 8.4165 21.819 7.152 21.762C5.982 21.708 5.3475 21.513 4.9245 21.348C4.40325 21.1559 3.93169 20.8494 3.5445 20.451C3.14513 20.0641 2.83758 19.5925 2.6445 19.071C2.481 18.6495 2.2845 18.0135 2.232 16.8435C2.175 15.579 2.163 15.1995 2.163 11.994C2.163 8.79 2.175 8.412 2.232 7.1475C2.286 5.9775 2.481 5.3415 2.646 4.9185C2.8635 4.359 3.1245 3.9585 3.5445 3.5385C3.9645 3.1185 4.3635 2.859 4.9245 2.6415C5.3475 2.4765 5.982 2.2815 7.152 2.2275C8.259 2.1765 8.688 2.1615 10.9245 2.16V2.163ZM18.4065 4.155C18.2174 4.155 18.0301 4.19225 17.8554 4.26461C17.6807 4.33698 17.522 4.44305 17.3883 4.57677C17.2545 4.71048 17.1485 4.86923 17.0761 5.04394C17.0037 5.21864 16.9665 5.4059 16.9665 5.595C16.9665 5.7841 17.0037 5.97135 17.0761 6.14606C17.1485 6.32077 17.2545 6.47952 17.3883 6.61323C17.522 6.74695 17.6807 6.85302 17.8554 6.92539C18.0301 6.99775 18.2174 7.035 18.4065 7.035C18.7884 7.035 19.1547 6.88329 19.4247 6.61323C19.6948 6.34318 19.8465 5.97691 19.8465 5.595C19.8465 5.21309 19.6948 4.84682 19.4247 4.57677C19.1547 4.30671 18.7884 4.155 18.4065 4.155ZM12.0015 5.838C11.1841 5.82525 10.3723 5.97523 9.61347 6.27921C8.85459 6.58319 8.16377 7.03511 7.58123 7.60863C6.99868 8.18216 6.53605 8.86585 6.22026 9.61989C5.90448 10.3739 5.74185 11.1833 5.74185 12.0007C5.74185 12.8182 5.90448 13.6276 6.22026 14.3816C6.53605 15.1356 6.99868 15.8193 7.58123 16.3929C8.16377 16.9664 8.85459 17.4183 9.61347 17.7223C10.3723 18.0263 11.1841 18.1763 12.0015 18.1635C13.6193 18.1383 15.1623 17.4779 16.2975 16.3249C17.4326 15.1719 18.0689 13.6188 18.0689 12.0007C18.0689 10.3827 17.4326 8.82962 16.2975 7.67662C15.1623 6.52363 13.6193 5.86324 12.0015 5.838ZM12.0015 7.9995C13.0625 7.9995 14.08 8.42098 14.8303 9.17122C15.5805 9.92146 16.002 10.939 16.002 12C16.002 13.061 15.5805 14.0785 14.8303 14.8288C14.08 15.579 13.0625 16.0005 12.0015 16.0005C10.9405 16.0005 9.92296 15.579 9.17272 14.8288C8.42248 14.0785 8.001 13.061 8.001 12C8.001 10.939 8.42248 9.92146 9.17272 9.17122C9.92296 8.42098 10.9405 7.9995 12.0015 7.9995Z" fill="currentColor"/>
						</svg>
					</a>
				<?php endif; ?>

				<?php if ( ! empty( $social_media_highlights_linkedin ) ) : ?>
					<a href="<?php echo esc_url( $social_media_highlights_linkedin['url'] ); ?>" class="social-media-highlights__link social-media-highlights__link--linkedin" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $social_media_highlights_linkedin['title'] ? $social_media_highlights_linkedin['title'] : 'Follow us on LinkedIn' ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M4.98292 7.19729C6.19132 7.19729 7.17092 6.21769 7.17092 5.00929C7.17092 3.80089 6.19132 2.82129 4.98292 2.82129C3.77452 2.82129 2.79492 3.80089 2.79492 5.00929C2.79492 6.21769 3.77452 7.19729 4.98292 7.19729Z" fill="currentColor"/>
							<path d="M9.23722 8.85469V20.9937H13.0062V14.9907C13.0062 13.4067 13.3042 11.8727 15.2682 11.8727C17.2052 11.8727 17.2292 13.6837 17.2292 15.0907V20.9947H21.0002V14.3377C21.0002 11.0677 20.2962 8.55469 16.4742 8.55469C14.6392 8.55469 13.4092 9.56169 12.9062 10.5147H12.8552V8.85469H9.23722ZM3.09521 8.85469H6.87021V20.9937H3.09521V8.85469Z" fill="currentColor"/>
						</svg>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		</div>
	</div>

		<div class="social-media-highlights__repeater">
			<?php if ( $social_media_highlights_repeater ) : ?>
				<section
					id="socialMediaHighlightsCarousel"
					class="benefits-card-container splide"
					role="group"
					aria-label="Check our Social Media Highlights Slider"
					data-splide='{"type":"loop","arrows":false,"autoplay":false,"pagination":false,"focus":"center","drag":false,"pauseOnHover":false,"perPage":8,"gap":"15px","autoScroll":{"autoStart":true,"speed":0.3},"breakpoints":{"640":{"perPage":3},"1440":{"perPage":6}}}'
					>
					<div class="splide__track">
						<ul class="splide__list">
							<?php foreach ( $social_media_highlights_repeater as $social_media_highlights_item ) : ?>
								<li class="splide__slide social-media-highlights__item">
									<div class="social-media-highlights__item-inner">
										<?php if ( ! empty( $social_media_highlights_item['social_media_highlights_image'] ) ) : ?>
											<div class="social-media-highlights__image">
												<img src="<?php echo esc_url( $social_media_highlights_item['social_media_highlights_image']['url'] ); ?>" alt="<?php echo esc_attr( $social_media_highlights_item['social_media_highlights_image']['alt'] ); ?>">
											</div>
										<?php endif; ?>
									</div>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</section>
			<?php endif; ?>
		</div>
	</div>
</section>
