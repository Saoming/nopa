<div class="archive-header container">
	<div class="archive-header__meta">
		<h1 class="archive-title">
			<?php
			// Check for ACF posts_page_title first
			if (get_field('posts_page_title', get_option('page_for_posts'))) {
				the_field('posts_page_title', get_option('page_for_posts'));
			} elseif ( is_category() ) {
				single_cat_title();
			} elseif ( is_tag() ) {
				single_tag_title();
			} elseif ( is_author() ) {
				echo esc_html__( 'Author: ', 'tenup-theme' ) . get_the_author();
			} elseif ( is_post_type_archive() ) {
				post_type_archive_title();
			} elseif ( is_tax() ) {
				single_term_title();
			} else {
				the_archive_title();
			}
			?>
		</h1>
		<?php
		// Check for ACF posts_page_description first
		if (get_field('posts_page_description', get_option('page_for_posts'))) : ?>
			<div class="archive-description">
				<?php the_field('posts_page_description', get_option('page_for_posts')); ?>
			</div>
		<?php elseif ( get_the_archive_description() ) : ?>
			<div class="archive-description">
				<?php the_archive_description(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
// Get the most recent 5 posts for the featured carousel
$featured_args = array(
	'posts_per_page' => 5,
	'post_status'    => 'publish',
	'order'          => 'DESC',
	'orderby'        => 'date',
	'category_name'  => 'nopa-news',
);
$featured_query = new WP_Query( $featured_args );
?>

<?php if ( $featured_query->have_posts() ) : ?>
	<section
    id="nopaNewsCarousel"
    class="featured-posts-carousel splide"
    aria-label="<?php echo esc_attr__( 'Featured Posts', 'tenup-theme' ); ?>"
    data-splide='{
        "type": "loop",
        "perPage": 1,
        "perMove": 1,
        "arrows": false,
        "pagination": true,
        "autoplay": true,
        "interval": 5000,
        "pauseOnHover": true,
        "pauseOnFocus": true,
        "resetProgress": false,
        "lazyLoad": "nearby",
        "keyboard": true,
        "drag": true,
        "speed": 600,
        "easing": "cubic-bezier(0.25, 0.46, 0.45, 0.94)",
        "gap": 0,
        "padding": 0,
        "focus": "center",
        "trimSpace": true
    }'
>
<div class="splide__track">
	<ul class="splide__list">
		<?php while ( $featured_query->have_posts() ) : $featured_query->the_post(); ?>
			<li class="splide__slide featured-post">
				<a href="<?php the_permalink(); ?>" class="featured-post__link container--relative" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'tenup-theme' ), get_the_title() ) ); ?>">
					<div class="featured-post__image">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'large', ['class' => 'featured-post__thumbnail'] ); ?>
						<?php else : ?>
							<div class="featured-post__no-thumbnail"></div>
						<?php endif; ?>
					</div>
					<div class="featured-post__content">
						<h2 class="featured-post__title"><?php the_title(); ?></h2>
						<div class="featured-post__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
						<span class="featured-post__read-more"><?php _e( 'Read More', 'tenup-theme' ); ?></span>
					</div>
				</a>
			</li>
		<?php endwhile; ?>
	</ul>
</div>
</section>
<?php
wp_reset_postdata();
endif;
?>

<!-- Series Behind The Beans -->
<?php
// Get the most recent 3 posts for the featured carousel
$behind_the_beans_query = array(
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'order'          => 'DESC',
	'orderby'        => 'date',
	'category_name'  => 'behind-the-beans',
);
$behind_the_beans_query = new WP_Query( $behind_the_beans_query );
?>

<?php if ( $behind_the_beans_query->have_posts() ) : ?>
<section id="behind-the-beans" class="post-section container">
		<div class="post-section__header">
			<h2 class="post-section__title"><?php _e( 'Behind The Beans', 'tenup-theme' ); ?></h2>
			<a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Behind The Beans' ) ) ); ?>" class="post-section__view-all">
				<?php _e( 'View All', 'tenup-theme' ); ?>
			</a>
		</div>
		<div class="post-section__grid">
			<?php while ( $behind_the_beans_query->have_posts() ) : $behind_the_beans_query->the_post(); ?>
				<article class="post-section__post">
					<a href="<?php the_permalink(); ?>" class="post-section__link" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'tenup-theme' ), get_the_title() ) ); ?>">
						<div class="post-section__image">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium', ['class' => 'post-section__thumbnail'] ); ?>
							<?php else : ?>
								<div class="post-section__no-thumbnail"></div>
							<?php endif; ?>
						</div>
						<div class="post-section__content">
							<h3 class="post-section__post-title"><?php the_title(); ?></h3>
							<div class="post-section__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></div>
							<span class="post-section__read-more"><?php _e( 'Read More', 'tenup-theme' ); ?></span>
						</div>
					</a>
				</article>
			<?php endwhile; ?>
		</div>
	</section>
<?php
wp_reset_postdata();
endif;
?>

<!-- Series Sustainability Talks -->
<?php
// Get the most recent 3 posts for the sustainability talks
$sustainability_talks_query = array(
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'order'          => 'DESC',
	'orderby'        => 'date',
	'category_name'  => 'sustainability-talks',
);
$sustainability_talks_query = new WP_Query( $sustainability_talks_query );
?>

<?php if ( $sustainability_talks_query->have_posts() ) : ?>
<section id="sustainability-talks" class="post-section container">
		<div class="post-section__header">
			<h2 class="post-section__title"><?php _e( 'Sustainability Talks', 'tenup-theme' ); ?></h2>
			<a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Sustainability Talks' ) ) ); ?>" class="post-section__view-all">
				<?php _e( 'View All', 'tenup-theme' ); ?>
			</a>
		</div>
		<div class="post-section__grid">
			<?php while ( $sustainability_talks_query->have_posts() ) : $sustainability_talks_query->the_post(); ?>
				<article class="post-section__post">
					<a href="<?php the_permalink(); ?>" class="post-section__link" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'tenup-theme' ), get_the_title() ) ); ?>">
						<div class="post-section__image">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium', ['class' => 'post-section__thumbnail'] ); ?>
							<?php else : ?>
								<div class="post-section__no-thumbnail"></div>
							<?php endif; ?>
						</div>
						<div class="post-section__content">
							<h3 class="post-section__post-title"><?php the_title(); ?></h3>
							<div class="post-section__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></div>
							<span class="post-section__read-more"><?php _e( 'Read More', 'tenup-theme' ); ?></span>
						</div>
					</a>
				</article>
			<?php endwhile; ?>
		</div>
	</section>
<?php
wp_reset_postdata();
endif;
?>

<!-- Series NOPA Help -->
<?php
// Get the most recent 3 posts for the NOPA help
$nopa_help_query = array(
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'order'          => 'DESC',
	'orderby'        => 'date',
	'category_name'  => 'nopa-help',
);
$nopa_help_query = new WP_Query( $nopa_help_query );
?>

<?php if ( $nopa_help_query->have_posts() ) : ?>
<section id="nopa-help" class="post-section container">
		<div class="post-section__header">
			<h2 class="post-section__title"><?php _e( 'NOPA Help', 'tenup-theme' ); ?></h2>
			<a href="<?php echo esc_url( get_category_link( get_cat_ID( 'NOPA Help' ) ) ); ?>" class="post-section__view-all">
				<?php _e( 'View All', 'tenup-theme' ); ?>
			</a>
		</div>
		<div class="post-section__grid">
			<?php while ( $nopa_help_query->have_posts() ) : $nopa_help_query->the_post(); ?>
				<article class="post-section__post">
					<a href="<?php the_permalink(); ?>" class="post-section__link" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'tenup-theme' ), get_the_title() ) ); ?>">
						<div class="post-section__image">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium', ['class' => 'post-section__thumbnail'] ); ?>
							<?php else : ?>
								<div class="post-section__no-thumbnail"></div>
							<?php endif; ?>
						</div>
						<div class="post-section__content">
							<h3 class="post-section__post-title"><?php the_title(); ?></h3>
							<div class="post-section__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></div>
							<span class="post-section__read-more"><?php _e( 'Read More', 'tenup-theme' ); ?></span>
						</div>
					</a>
				</article>
			<?php endwhile; ?>
		</div>
	</section>
<?php
wp_reset_postdata();
endif;
?>

<!-- Series Nopa Introductions -->
<?php
// Get the most recent 3 posts for the Nopa introductions
$nopa_introductions_query = array(
	'posts_per_page' => 3,
	'post_status'    => 'publish',
	'order'          => 'DESC',
	'orderby'        => 'date',
	'category_name'  => 'nopa-introductions',
);
$nopa_introductions_query = new WP_Query( $nopa_introductions_query );
?>

<?php if ( $nopa_introductions_query->have_posts() ) : ?>
<section id="nopa-introductions" class="post-section container">
		<div class="post-section__header">
			<h2 class="post-section__title"><?php _e( 'Nopa Introductions', 'tenup-theme' ); ?></h2>
			<a href="<?php echo esc_url( get_category_link( get_cat_ID( 'Nopa Introductions' ) ) ); ?>" class="post-section__view-all">
				<?php _e( 'View All', 'tenup-theme' ); ?>
			</a>
		</div>
		<div class="post-section__grid">
			<?php while ( $nopa_introductions_query->have_posts() ) : $nopa_introductions_query->the_post(); ?>
				<article class="post-section__post">
					<a href="<?php the_permalink(); ?>" class="post-section__link" aria-label="<?php echo esc_attr( sprintf( __( 'Read more about %s', 'tenup-theme' ), get_the_title() ) ); ?>">
						<div class="post-section__image">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium', ['class' => 'post-section__thumbnail'] ); ?>
							<?php else : ?>
								<div class="post-section__no-thumbnail"></div>
							<?php endif; ?>
						</div>
						<div class="post-section__content">
							<h3 class="post-section__post-title"><?php the_title(); ?></h3>
							<div class="post-section__excerpt"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></div>
							<span class="post-section__read-more"><?php _e( 'Read More', 'tenup-theme' ); ?></span>
						</div>
					</a>
				</article>
			<?php endwhile; ?>
		</div>
	</section>
<?php
wp_reset_postdata();
endif;
?>
