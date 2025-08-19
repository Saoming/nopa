<?php
/**
 * WooCommerce Customizations
 *
 * @package TenUpTheme
 */

namespace TenUpTheme;

use TenupFramework\Assets\GetAssetInfo;
use TenupFramework\Module;
use TenupFramework\ModuleInterface;

class RegisterPostTypes implements ModuleInterface {

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

		add_action( 'init', [ $this, 'register_product_block_cpt' ] );
	}

	/**
	 * Registers the Product Blocks CPT
	 *
	 * @return void
	 */
	public function register_product_block_cpt() {
		$labels = array(
			'name'                  => _x( 'Products Blocks', 'Post Type General Name', 'tenup-theme' ),
			'singular_name'         => _x( 'Product Blocks', 'Post Type Singular Name', 'tenup-theme' ),
			'menu_name'             => __( 'Products Blocks', 'tenup-theme' ),
			'name_admin_bar'        => __( 'Products Blocks', 'tenup-theme' ),
			'archives'              => __( 'Products Blocks Archives', 'tenup-theme' ),
			'attributes'            => __( 'Product Blocks Attributes', 'tenup-theme' ),
			'parent_item_colon'     => __( 'Parent result:', 'tenup-theme' ),
			'all_items'             => __( 'All results', 'tenup-theme' ),
			'add_new_item'          => __( 'Add New Product Blocks', 'tenup-theme' ),
			'add_new'               => __( 'Add New', 'tenup-theme' ),
			'new_item'              => __( 'New Product Blocks', 'tenup-theme' ),
			'edit_item'             => __( 'Edit Product Blocks', 'tenup-theme' ),
			'update_item'           => __( 'Update Product Blocks', 'tenup-theme' ),
			'view_item'             => __( 'View Product Blocks', 'tenup-theme' ),
			'view_items'            => __( 'View Products Blocks', 'tenup-theme' ),
			'search_items'          => __( 'Search Product Blocks', 'tenup-theme' ),
			'not_found'             => __( 'Not found', 'tenup-theme' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'tenup-theme' ),
			'featured_image'        => __( 'Featured Image', 'tenup-theme' ),
			'set_featured_image'    => __( 'Set featured image', 'tenup-theme' ),
			'remove_featured_image' => __( 'Remove featured image', 'tenup-theme' ),
			'use_featured_image'    => __( 'Use as featured image', 'tenup-theme' ),
			'insert_into_item'      => __( 'Insert into product blocks', 'tenup-theme' ),
			'uploaded_to_this_item' => __( 'Uploaded to this product blocks', 'tenup-theme' ),
			'items_list'            => __( 'Product Blocks list', 'tenup-theme' ),
			'items_list_navigation' => __( 'Product Blocks list navigation', 'tenup-theme' ),
			'filter_items_list'     => __( 'Filter product description list', 'tenup-theme' ),
		);
		$args   = array(
			'label'               => __( 'Product Blocks', 'tenup-theme' ),
			'description'         => __( 'Product Blocks for Product', 'tenup-theme' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'revisions', 'excerpt' ),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 9,
			'menu_icon'           => 'dashicons-format-aside',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
		);
		register_post_type( 'nopa_product_blocks', $args );
	}
}
