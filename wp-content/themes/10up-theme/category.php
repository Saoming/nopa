<?php
/**
	* The template for displaying category archive pages
	*
	* @package TenUpTheme
	*/

get_header(); ?>

<section class="container">

	<?php echo do_shortcode('[tsf_breadcrumb class="post-breadcrumbs"]'); ?>

	<div class="page-header">
		<h1 class="page-title">
			<?php
			printf( esc_html__( '%s', 'tenup-theme' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			?>
		</h1>
	</div>

	<div class="category-posts" aria-labelledby="page-title">
		<?php if ( have_posts() ) : ?>
			<div class="posts-grid" role="list">
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="listitem">
						<?php if ( has_post_thumbnail() ) : ?>
								<a class="category-thumbnail container--relative" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'tenup-theme' ), get_the_title() ) ); ?>">
									<div class="post-thumbnail">
										<?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
									</div>
								</a>
						<?php else : ?>
								<a class="category-thumbnail container--relative" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'tenup-theme' ), get_the_title() ) ); ?>">
									<div class="post-thumbnail post-thumbnail--no-image"> </div>
								</a>
						<?php endif; ?>

						<div class="post-content">
								<h2 class="entry-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<time class="entry-time" datetime="<?php echo get_the_date( 'c' ); ?>">
									<?php echo get_the_date(); ?>
								</time>
						</div>
					</article>
				<?php endwhile; ?>
			</div>


		<?php else : ?>
			<p><?php esc_html_e( 'Sorry, no posts were found in this category.', 'tenup-theme' ); ?></p>
		<?php endif; ?>
		</div>
</section>

<?php
// Check if the global reuse club CTA block is available and include it.
if ( locate_template( 'partials/acf-blocks/global-reuse-club-cta/global-reuse-club-cta.php' ) ) {
	get_template_part( 'partials/acf-blocks/global-reuse-club-cta/global-reuse-club-cta' );
}
?>


<?php get_footer(); ?>
