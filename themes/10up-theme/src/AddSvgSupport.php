<?php
/**
 * Adds support for SVG files in the theme.
 *
 * @package TenUpTheme
 * @author  Samuel Tirtawidjaja
 *
 */

namespace TenUpTheme;

use TenupFramework\Assets\GetAssetInfo;
use TenupFramework\Module;
use TenupFramework\ModuleInterface;

/**
 * AddSVGSupport module.
 *
 * @return void
 */
class AddSVGSupport implements ModuleInterface {

	use Module;
	use GetAssetInfo;

		/**
	 * Can this module be registered?
	 *
	 * @return bool
	 */
	public function can_register() {
		return true;
	}

	/**
	 * Register any hooks and filters.
	 *
	 * @return void
	 */
	public function register() {
		$this->setup_asset_vars(
			dist_path: TENUP_THEME_DIST_PATH,
			fallback_version: TENUP_THEME_VERSION
		);

		add_filter( 'wp_check_filetype_and_ext', [ $this, 'add_svg_support_to_filetype' ], 10, 4 );
		add_filter( 'upload_mimes', [ $this, 'add_svg_to_mime_types' ] );
		add_filter( 'admin_head', [ $this, 'fix_svg_admin_styling' ] );
		add_filter( 'image_downsize', [ $this, 'fix_svg_size_attributes' ], 10, 2 );
	}

	/**
	 * Adds Svg Support to the filetype check
	 */
	public function add_svg_support_to_filetype( $data, $file, $filename, $mimes ) {

		global $wp_version;
		if ( '4.7.1' !== $wp_version ) {
			return $data;
		}

		$filetype = wp_check_filetype( $filename, $mimes );

		return [
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename'],
		];
	}

	/**
	 * Adds Svg Support to the mime type check
	 */
	public function add_svg_to_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Adds Fixes a display issue
	 */
	public function fix_svg_admin_styling() {
		echo '<style type="text/css">
        .thumbnail img[src$=".svg"] {
			width: 100%;
			height: auto;
        }
        </style>';
	}

	/**
	 * Fixes image attributes for SVG files
	 */
	public function fix_svg_size_attributes( $out, $id ) {
		$image_url = wp_get_attachment_url( $id );
		$file_ext  = pathinfo( $image_url, PATHINFO_EXTENSION );

		if ( is_admin() || 'svg' !== $file_ext ) {
			return false;
		}

		return array( $image_url, null, null, false );
	}
}
