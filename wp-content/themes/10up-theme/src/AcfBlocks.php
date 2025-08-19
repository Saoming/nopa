<?php
/**
 * Adds ACF Blocks to the theme.
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
 * ACFBLocks module.
 *
 * @return void
 */
class AcfBlocks implements ModuleInterface {

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
		add_action( 'init', [ $this, 'nopa_register_acf_blocks' ] );
	}

	/**
		* We use WordPress's init hook to make sure
		* our blocks are registered early in the loading
		* process.
		*
		* @link https://developer.wordpress.org/reference/hooks/init/
		*/
	function nopa_register_acf_blocks() {
		/**
			* We register our block's with WordPress's handy
			* register_block_type(); wp_register_block_types_from_metadata_collection();
			*
			* @link https://developer.wordpress.org/reference/functions/register_block_type/
			* @link https://developer.wordpress.org/reference/functions/wp_register_block_types_from_metadata_collection/
			*/
			if ( function_exists( 'register_block_type'	) ) {
				// Register multiple block.
				$block_types = array(
					'svg-divider',
					'card-section-stacked',
					'two-column-slider-text',
					'logo-discount-slider',
					'how-it-works',
					'center-rounded-video-cta',
					'full-width-image-banner',
					'screen-rounded-img-cta',
					'wavy',
					'social-media-highlights',
					'global-reuse-club-cta',
					'related-stories',
				);
				foreach ( $block_types as $block_type ) {
					register_block_type( TENUP_THEME_PATH . "/partials/acf-blocks/{$block_type}" );
				}
			}
	}
}
