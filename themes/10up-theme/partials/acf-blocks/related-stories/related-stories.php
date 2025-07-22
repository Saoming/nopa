<?php
/**
 * Related Stories Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'related-stories-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Load value and assign values
$related_stories_relationship = get_field( 'related_stories_relationship' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'related-stories';
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
	<div class="related-stories__inner container">
		<?php if ( $related_stories_relationship ) : ?>
			<div class="related-stories__repeater">
				<h2 class="related-stories__title"><?php esc_html_e( 'Related Stories', 'tenup-theme' ); ?></h2>
				<ul class="related-stories__list">
					<?php foreach ( $related_stories_relationship as $related_post ) : ?>
						<li class="related-stories__item">
							<a href="<?php echo esc_url( get_permalink( $related_post->ID ) ); ?>" class="related-stories__link" aria-label="<?php echo esc_attr( 'Read more about: ' . get_the_title( $related_post->ID ) ); ?>">
								<div class="related-stories__image">
									<?php if ( has_post_thumbnail( $related_post->ID ) ) : ?>
										<?php
										$thumbnail_id = get_post_thumbnail_id( $related_post->ID );
										$thumbnail_url = wp_get_attachment_image_url( $thumbnail_id, 'medium' );
										$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
										?>
										<img class="related-stories__thumbnail" src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php echo esc_attr( $thumbnail_alt ?: get_the_title( $related_post->ID ) ); ?>">
									<?php else : ?>
										<div class="related-stories__no-thumbnail"></div>
									<?php endif; ?>
								</div>
								<h3 class="related-stories__title"><?php echo esc_html( get_the_title( $related_post->ID ) ); ?></h3>
								<time class="related-stories__post-time"><?php echo esc_html( get_the_date( 'F j, Y', $related_post->ID ) ); ?></time>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	</div>
</section>
