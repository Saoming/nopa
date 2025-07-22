<?php
/**
 * Template Tags
 *
 * @package TenUpTheme
 *
 * This file contains **only** pure functions that relate to templating.
 *
 * Rules:
 * - Functions in this file **must be pure** (i.e., they must not cause side effects).
 * - No hooks, filters, or global state modifications should be added here.
 * - If a function has side effects (e.g., enqueuing scripts, modifying post data, adding filters),
 *   it should be encapsulated within a class in the `src/` directory.
 *
 * A pure function:
 * - Given the same input, it always returns the same output.
 * - Does not modify external state (no global variables, no database writes, etc.).
 * - Does not rely on WordPress hooks or filters.
 *
 * Example of an allowed function:
 * ```php
 * function get_custom_excerpt( string $content, int $length = 50 ): string {
 *     return wp_trim_words( $content, $length );
 * }
 * ```
 *
 * Example of a function **that does not belong here**:
 * ```php
 * function modify_post_title( string $title ): string {
 *     return 'My Great ' . $title;
 * }
 * add_filter( 'the_title', 'modify_post_title' );
 * ```
 *
 * Keeping this file limited to pure functions ensures maintainability and a clear separation of concerns.
 */

namespace TenupTheme;

/**
 * Adjust the brightness of a color (HEX)
 *
 * @param string $hex The hex code for the color
 * @param number $steps amount you want to change the brightness
 * @return string new color with brightness adjusted
 */
function adjust_brightness( $hex, $steps ) {

	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max( -255, min( 255, $steps ) );

	// Normalize into a six character long hex string
	$hex = str_replace( '#', '', $hex );
	if ( 3 === strlen( $hex ) ) {
		$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}

	// Split into three parts: R, G and B
	$color_parts = str_split( $hex, 2 );
	$return      = '#';

	foreach ( $color_parts as $color ) {
		$color   = hexdec( $color ); // Convert to decimal
		$color   = max( 0, min( 255, $color + $steps ) ); // Adjust color
		$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
	}

	return $return;
}

/**
 * Extract colors from a CSS or Sass file
 *
 * @param string $path the path to your CSS variables file
 */
function get_colors( $theme = null ) {

	// Load theme.json from active theme or a specified one
	$theme_dir = $theme ? get_theme_root( $theme ) . '/' . $theme : get_stylesheet_directory();
	$theme_json_path = $theme_dir . '/theme.json';

	if ( ! file_exists( $theme_json_path ) ) {
					return [];
	}

	$theme_json = json_decode( file_get_contents( $theme_json_path ), true );
	$colors = [];

	// 1. From settings.color.palette
	if ( isset( $theme_json['settings']['color']['palette'] ) ) {
					foreach ( $theme_json['settings']['color']['palette'] as $color ) {
									if ( isset( $color['color'] ) ) {
													$colors[] = $color['color'];
									}
					}
	}

	// 2. From styles.color and any nested style properties
	function extract_colors_recursive( $array, &$colors ) {
					foreach ( $array as $key => $value ) {
									if ( is_string( $value ) && preg_match( '/^#[0-9A-Fa-f]{3,6}$/', $value ) ) {
													$colors[] = $value;
									} elseif ( is_array( $value ) ) {
													extract_colors_recursive( $value, $colors );
									}
					}
	}

	if ( isset( $theme_json['styles']['color'] ) ) {
					extract_colors_recursive( $theme_json['styles']['color'], $colors );
	}

	// Optional: remove duplicates
	$colors = array_unique( $colors );

	return $colors;
}

/**
 * @return int
 */
function nopa_get_shop_page_id() {

	static $id;

	if ( isset( $id ) ) {
		return $id;
	}

	$id = \function_exists( 'wc_get_page_id' ) ? (int) \wc_get_page_id( 'shop' ) : 0;

	if ( \get_post( $id ) ) {
		return $id;
	}

	return $id = 0;
}

/**
 * @return bool
 */
function nopa_is_shop( $post = null ) {

	if ( isset( $post ) ) {
		$id = is_int( $post )
			? $post
			: ( get_post( $post )->ID ?? 0 );

		// phpcs:ignore, TSF.Performance.Opcodes -- local funcs
		$is_shop = $id && nopa_get_shop_page_id() === $id;
	} else {
		// phpcs:ignore, TSF.Performance.Opcodes -- local funcs
		$is_shop = ! is_admin() && \function_exists( 'is_shop' ) && is_shop();
	}

	return $is_shop;
}
