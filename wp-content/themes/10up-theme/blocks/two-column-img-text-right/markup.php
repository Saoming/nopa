<?php
/**
 * Example block markup
 *
 * @package TenUpTheme\Blocks\Example
 *
 * @var array    $attributes         Block attributes.
 * @var string   $content            Block content.
 * @var WP_Block $block              Block instance.
 * @var array    $context            Block context.
 */
$id = 'two-column-img-text-right-' . $attributes['blockId'];
?>
<section <?php echo get_block_wrapper_attributes( [
	'id'    => esc_attr( $id ),
	'class' => 'container',
	] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<div class="wp-block-tenup-image">
		<?php
		if ( ! empty( $attributes['image'] ) ) {
			echo wp_get_attachment_image( $attributes['image'], 'full' );
		} else {
			echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/placeholder.png' ) . '" alt="' . esc_attr__( 'Placeholder image', 'tenup-theme' ) . '" />';
		}
		?>
	</div>
	<div class="wp-block-tenup-content">
		 <h2 class="wp-block-tenup-title">
				<?php echo wp_kses_post( $attributes['title'] ); ?>
			</h2>
			<p	class="wp-block-tenup-description">
				<?php echo wp_kses_post( $attributes['description'] ); ?>
			</p>
			<?php if ( ! empty( $attributes['buttonText'] ) && ! empty( $attributes['buttonUrl'] ) ) : ?>
				<a href="<?php echo esc_url( $attributes['buttonUrl'] ); ?>" class="button-primary">
					<?php echo esc_html( $attributes['buttonText'] ); ?>
				</a>
			<?php endif; ?>
	</div>
</section>
