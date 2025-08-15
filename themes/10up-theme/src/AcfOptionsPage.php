<?php
/**
 * ACF Options Page setup
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
 * Class that created Option page and sub-menus
 *
 * @return void
 */
class AcfOptionsPage implements ModuleInterface {

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

		// Check if ACF is active before adding the hook
		if ( function_exists( 'acf_add_options_page' ) ) {
			add_action( 'init', [ $this, 'register_options_page' ] );
			// add_action( 'admin_notices', [ $this, 'display_admin_notice' ] );
		}
	}

/**
* Display admin notice
*
* @return void
*/
public function display_admin_notice() {
	echo '<div class="notice notice-success is-dismissible">';
	echo '<p>' . esc_html__('ACF Options pages have been registered successfully.', 'tenup-theme') . '</p>';
	echo '</div>';
}

/**
 * Create ACF Options Page and sub-pages
 */
	public function register_options_page() {
		// No need to check function_exists here as we already did in register()
		$parent = acf_add_options_page(
			array(
				'page_title' => __( 'Nopa Theme Settings', 'tenup-theme' ),
				'menu_title' => __( 'Nopa Theme Settings', 'tenup-theme' ),
				'menu_slug'  => 'theme-general-settings',
				'capability' => 'edit_theme_options',
				'redirect'   => false,
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'  => __( 'Site Header', 'tenup-theme' ),
				'menu_title'  => __( 'Site Header', 'tenup-theme' ),
				'parent_slug' => $parent['menu_slug'],
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'  => __( 'Newsletter', 'tenup-theme' ),
				'menu_title'  => __( 'Newsletter', 'tenup-theme' ),
				'parent_slug' => $parent['menu_slug'],
			)
		);

		acf_add_options_sub_page(
			array(
				'page_title'  => __( 'Site Footer', 'tenup-theme' ),
				'menu_title'  => __( 'Site Footer', 'tenup-theme' ),
				'parent_slug' => $parent['menu_slug'],
			)
		);
	}
}
