<?php
/**
 * Assets module.
 *
 * @package TenUpTheme
 */

namespace TenUpTheme;

use TenupFramework\Assets\GetAssetInfo;
use TenupFramework\Module;
use TenupFramework\ModuleInterface;

/**
 * Assets module.
 *
 * @package TenUpTheme
 */
class Assets implements ModuleInterface {

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
		add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_block_editor_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_3rd_party_scripts' ] );
		add_action( 'wp_head', [ $this, 'js_detection' ], 0 );
	}

	/**
		* Enqueue 3rd party scripts for front-end.
		*
		* @return void
		*/
	public function enqueue_3rd_party_scripts() {
		// Only load GSAP if the card-section-stacked block exists on the page
		if ( has_block( 'acf/card-section-stacked-block' ) ) {
			wp_enqueue_script(
				'gsap-js',
				TENUP_THEME_TEMPLATE_URL . '/3rd-party/gsap/gsap.min.js',
				[],
				false,
				true
			);

			wp_enqueue_script(
				'gsap-st',
				TENUP_THEME_TEMPLATE_URL . '/3rd-party/gsap/ScrollTrigger.min.js',
				['gsap-js'],
				false,
				true
			);

			if( has_block( 'acf/wavy-block' ) ) {
				wp_enqueue_script(
					'gsap-mp',
					TENUP_THEME_TEMPLATE_URL . '/3rd-party/gsap/MotionPathPlugin.min.js',
					['gsap-js'],
					false,
					true
				);
			}
		}
		// Only load Splide if the logo-discount-slider or two-column-slider-text blocks exist on the page
		if ( has_block( 'acf/logo-discount-slider-block' ) || has_block( 'acf/two-column-slider-text-block' ) || is_archive() || is_home()	|| is_single() ) {
			wp_enqueue_style(
				'splide-css',
				TENUP_THEME_TEMPLATE_URL . '/3rd-party/splide/splide-core.min.css',
				"4.1.3",
				false
			);
			wp_enqueue_script(
				'splide-js',
				TENUP_THEME_TEMPLATE_URL . '/3rd-party/splide/splide.min.js',
				[],
				"4.1.3",
				array(
						'strategy'  => 'defer',
						'in_footer' => true,
				)
			);
			wp_enqueue_script(
				'splide-autoscroll',
				TENUP_THEME_TEMPLATE_URL . '/3rd-party/splide/splide-extension-auto-scroll.min.js',
				['splide-js'],
				"0.5",
				true
			);
		}
	}

	/**
	 * Enqueue scripts for front-end.
	 *
	 * @return void
	 */
	public function scripts() {
		/**
		 * Enqueuing frontend.js is required to get css hot reloading working in the frontend
		 * If you're not shipping any front-end js wrap this enqueue in a SCRIPT_DEBUG check.
		 */
		wp_enqueue_script(
			'frontend',
			TENUP_THEME_TEMPLATE_URL . '/dist/js/frontend.js',
			$this->get_asset_info( 'frontend', 'dependencies' ),
			$this->get_asset_info( 'frontend', 'version' ),
			true
		);

			// Enqueue the script only if the page is the styleguide page.
		if ( is_page_template( 'templates/page-styleguide.php' ) ) {
			wp_enqueue_script(
				'styleguide',
				TENUP_THEME_TEMPLATE_URL . '/dist/js/styleguide.js',
				$this->get_asset_info( 'frontend', 'dependencies' ),
				$this->get_asset_info( 'frontend', 'version' ),
				true
			);
		}
	}

	/**
	 * Enqueue core block filters, styles and variations.
	 *
	 * @return void
	 */
	public function enqueue_block_editor_scripts() {
		wp_enqueue_script(
			'block-editor-script',
			TENUP_THEME_DIST_URL . 'js/block-editor-script.js',
			$this->get_asset_info( 'block-editor-script', 'dependencies' ),
			$this->get_asset_info( 'block-editor-script', 'version' ),
			true
		);
	}

	/**
	 * Enqueue styles for front-end.
	 *
	 * @return void
	 */
	public function styles() {
		wp_enqueue_style(
			'styles',
			TENUP_THEME_TEMPLATE_URL . '/dist/css/frontend.css',
			[],
			$this->get_asset_info( 'frontend', 'version' )
		);
					// Enqueue the script only if the page is the styleguide page.
		if ( is_page_template( 'templates/page-styleguide.php' ) ) {
			wp_enqueue_style(
				'styleguide-styles',
				TENUP_THEME_TEMPLATE_URL . '/dist/css/styleguide-style.css',
				[],
				$this->get_asset_info( 'frontend', 'version' )
			);
		}
	}

	/**
	 * Handles JavaScript detection.
	 *
	 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
	 *
	 * @return void
	 */
	public function js_detection() {
		echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
	}
}
