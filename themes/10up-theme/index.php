<?php
/**
	* The main template file
	*
	* @package TenUpTheme
	*/

get_header();

if ( have_posts() ) :
	if ( ( is_single() || is_home() || is_archive() ) && ! is_product() ) : ?>
		<div class="container">
			<?php echo do_shortcode( '[tsf_breadcrumb class="post-breadcrumbs"]' ); ?>
		</div>
		<?php
		// Load appropriate template part
		if ( is_single() ) {
			get_template_part( 'partials/posts/single' );
		} else {
			get_template_part( 'partials/posts/archive' );
		}

		// Include global reuse club CTA if available
		if ( locate_template( 'partials/acf-blocks/global-reuse-club-cta/global-reuse-club-cta.php' ) ) {
			get_template_part( 'partials/acf-blocks/global-reuse-club-cta/global-reuse-club-cta' );
		}
		?>
	<?php else : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; ?>
			<?php
			// If no posts found, display a message
			if ( ! have_posts() ) {
				echo '<p>' . esc_html__( 'No posts found.', 'tenup-theme' ) . '</p>';
			}
			?>
	<?php endif;
endif;

get_footer();
