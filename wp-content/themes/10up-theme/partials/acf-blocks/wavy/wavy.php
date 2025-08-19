<?php
/**
 * Wavy Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'wavy-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Load value and assign values
$wavy_image_repeater = get_field( 'wavy_block_repeater' );

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'wavy-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

?>
<section
    id="<?php echo esc_attr( $id ); ?>"
    class="container--relative <?php echo esc_attr( $class_name ); ?>"
>
    <div class="wavy-block__inner">
        <svg class="wavy-svg" viewBox="0 0 1800 400" preserveAspectRatio="xMidYMid meet">
            <defs>
                <!-- More pronounced wavy path matching your screenshot -->
                <path id="wavyPath" d="M-200,250 C100,250 150,150 300,150 C450,150 500,250 650,250 C800,250 850,150 1000,150 C1150,150 1200,250 1350,250 C1500,250 1550,150 1700,150 C1850,150 1900,250 2050,250" />
            </defs>

            <!-- Debug path -->
            <path d="M-200,250 C100,250 150,150 300,150 C450,150 500,250 650,250 C800,250 850,150 1000,150 C1150,150 1200,250 1350,250 C1500,250 1550,150 1700,150 C1850,150 1900,250 2050,250"
                  fill="none"
                  stroke="rgba(255,107,53,0.1)"
                  stroke-width="2"
                  stroke-dasharray="5,5"
                  class="debug-path" />

            <?php if ( ! empty( $wavy_image_repeater ) ) : ?>
                <?php
                // Create multiple sets for continuous loop
                $sets = 3; // Number of sets to ensure continuous flow
                for ($set = 0; $set < $sets; $set++) :
                    foreach ($wavy_image_repeater as $index => $item) :
                        $global_index = $set * count($wavy_image_repeater) + $index;
                ?>
                    <!-- Text element that curves along path -->
                    <text class="curved-text">
                        <textPath
                            href="#wavyPath"
                            startOffset="0%"
                            class="text-path-element"
                            data-index="<?php echo $global_index; ?>"
                            data-text="<?php echo esc_attr( $item['wavy_block_tagline'] ); ?>"
                        >
                            <?php echo esc_html( $item['wavy_block_tagline'] ); ?>
                        </textPath>
                    </text>

                    <!-- Bottle image -->
                    <?php
                    $image_url = wp_get_attachment_image_url( $item['wavy_block_image']['id'], 'full' );
                    if ( $image_url ) : ?>
                        <image
                            class="bottle-svg"
                            href="<?php echo esc_url( $image_url ); ?>"
                            width="80"
                            height="100"
                            x="0"
                            y="0"
                            data-index="<?php echo $global_index; ?>"
                            data-text-index="<?php echo $global_index; ?>"
                        />
                    <?php endif; ?>
                <?php
                    endforeach;
                endfor;
                ?>
            <?php endif; ?>
        </svg>
    </div>
</section>
