<div class="post-header container">
	<div class="post-header__meta">
		<h1 class="post-title"><?php the_title(); ?></h1>
		<div class="post-excerpt">
			<?php echo wp_trim_words(get_the_excerpt(), 15); ?>
		</div>
	</div>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'large' ); ?>
		</div>
	<?php else : ?>
		<div class="post-thumbnail post-thumbnail--no-image"> </div>
	<?php endif; ?>
</div>

<div class="container container--narrow post-date">
	<time><?php echo get_the_date('F j, Y'); ?></time>
</div>

<section class="post-content container container--narrow">
	<?php the_content(); ?>
</section>
