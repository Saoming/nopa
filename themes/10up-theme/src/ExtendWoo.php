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

class ExtendWoo implements ModuleInterface {

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

		add_action( 'init', [ $this, 'remove_woocommerce_breadcrumbs' ] );
		add_action( 'init', [ $this, 'setup_variation_swatches' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_woocommerce_cart_scripts' ] );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'change_single_product_content' ), 1 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_woocommerce_assets' ) );
		// localize the custom variables
		add_action( 'wp_enqueue_scripts', [ $this, 'localize_custom_variables' ] );
		add_filter( 'woocommerce_demo_store', [ $this, 'modify_woocommerce_demo_store' ], 10, 2 );
		add_action( 'woocommerce_product_query', [ $this, 'custom_pre_get_posts_query' ] );
		add_action( 'woocommerce_after_single_product', [ $this, 'render_the_additional_content' ], 5 );
		add_action( 'woocommerce_before_main_content', [ $this, 'show_product_banner' ], 9 );
		add_action( 'woocommerce_before_main_content', [ $this, 'show_product_breadcrumb' ], 9 );
		add_action( 'wp_footer', [ $this, 'no_ajax_view_cart_button' ] );

		// add theme support for product image gallery and lightbo
		add_theme_support( 'wc-product-gallery-slider' );
		add_theme_support( 'wc-product-gallery-lightbox' );

		// remove related products
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

		// remove upsell products
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

		// remove cross-sells
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_cross_sell_display', 15 );

		// remove sidebar
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

		// remove reviews
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

		// remove categories from single product
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

		// remove variation availability from single product
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_availability', 10 );

		// Register AJAX handler for cross-sells
		add_action( 'wp_ajax_get_cart_cross_sells', [ $this, 'handle_get_cart_cross_sells' ] );
		add_action( 'wp_ajax_nopriv_get_cart_cross_sells', [ $this, 'handle_get_cart_cross_sells' ] );

		// ajax update cart info
		add_action( 'woocommerce_add_to_cart_fragments', [ $this, 'handle_woocommerce_add_to_cart_fragments' ] );

		// ajax update mini cart
		add_action( 'wc_ajax_update_mini_cart_quantity', [ $this, 'handle_update_mini_cart_quantity' ] );
	}


	/**
	 * Handle AJAX request for cart cross-sells
	 *
	 * @return void
	 */
	public function handle_woocommerce_add_to_cart_fragments( $fragments ) {
		$fragments['.header__cart-count'] = '<span class="header__cart-count">(' . WC()->cart->get_cart_contents_count() . ')</span>';
		return $fragments;
	}

	/**
	 *  Enqueue WooCommerce cart scripts
	 */
	function enqueue_woocommerce_cart_scripts() {
		if ( is_admin() ) { return;
		}

		// Ensure WooCommerce cart fragments script is loaded
		wp_enqueue_script( 'wc-cart-fragments' );

		// Your custom cart drawer script
		wp_enqueue_script( 'cross-sell', TENUP_THEME_TEMPLATE_URL . '/assets/js/frontend/woocommerce/cross-sell.js', array( 'jquery', 'wc-cart-fragments' ), '1.0.0', true );
	}

	/**
	 * Localize the custom variables
	 */
	public function localize_custom_variables() {
		wp_localize_script( 'wc-cart-fragments', 'tenup_theme_woocommerce', array(
			'template_url' => get_bloginfo( 'template_url' ),
		) );
	}

	/**
	 * AJAX handler to get cross-sells based on cart items
	 */
	public function handle_get_cart_cross_sells() {
		error_log( 'Cross-sell AJAX called' );

		$cross_sell_ids   = get_cart_based_cross_sells( 4 );
		$cross_sells_html = '';

		error_log( 'Cross-sell IDs returned: ' . print_r( $cross_sell_ids, true ) );

		if ( ! empty( $cross_sell_ids ) ) {
			ob_start();
			foreach ( $cross_sell_ids as $product_id ) {
				$product = wc_get_product( $product_id );
				if ( $product && $product->exists() ) {
					error_log( 'Rendering product: ' . $product_id . ' - ' . $product->get_name() );
					?>
				<div class="cross-sell-item" data-product-id="<?php echo esc_attr( $product_id ); ?>">
					<div class="cross-sell-image">
						<?php echo $product->get_image( 'thumbnail' ); ?>
					</div>
					<div class="cross-sell-details">
						<h5><?php echo esc_html( $product->get_name() ); ?></h5>
						<span class="price"><?php echo $product->get_price_html(); ?></span>
						<button class="add-cross-sell" data-product-id="<?php echo esc_attr( $product_id ); ?>">
							Add to Cart
						</button>
					</div>
				</div>
					<?php
				} else {
					error_log( 'Product not found or invalid: ' . $product_id );
				}
			}
			$cross_sells_html = ob_get_clean();
		} else {
			error_log( 'No cross-sell products found' );
		}

		wp_send_json_success(
			array(
				'html'      => $cross_sells_html,
				'count'     => count( $cross_sell_ids ),
				'debug_ids' => $cross_sell_ids,
			)
		);
	}

	/**
	 *  Disable WooCommerce Breadcrumbs
	 */
	public function remove_woocommerce_breadcrumbs() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	}

	/**
	 *  Disable Default Header Store Notice
	 */
	function modify_woocommerce_demo_store() {
		return null;
	}

	/**
	 *  Remove the "View Cart" button after adding a product to the cart
	 */
	function no_ajax_view_cart_button() {
		wc_enqueue_js(
			"$( document.body ).on('wc_cart_button_updated', function(){
				$('.added_to_cart.wc-forward').remove();
			});"
		);
	}

	/**
	 *  Remove Nopa Move Plus ( Remove Selected 'removed' Categories ) from the default Shop Query
	 */
	function custom_pre_get_posts_query( $q ) {

		// Only modify the shop's main query.
		if ( ! nopa_is_shop() || ! $q->is_main_query() ) {
			return;
		}

		// Get all WooCommerce product categories
		$terms = get_terms(
			array(
				'taxonomy'   => 'product_cat',
				'hide_empty' => false,
			)
		);

		// Filter the terms to get the IDs of the excluded categories
		$excluded_cats    = array_filter( $terms, fn( $term ) => in_array( $term->slug, array( 'removed' ), true ) );
		$excluded_cat_ids = array_map( fn( $term ) => $term->term_id, $excluded_cats );

		// Exclude the categories from the query
		$tax_query = $q->get( 'tax_query' );

		// Set to 'AND' if not set.
		$tax_query['relation'] ??= 'AND';

		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'term_id',
			'terms'    => $excluded_cat_ids,
			'operator' => 'NOT IN',
		);

		$q->set( 'tax_query', $tax_query );
	}

	/**
	 * Renders the content from the additonal content CPT
	 *
	 * @return void
	 */
	public function render_the_additional_content() {

		if ( ! is_product() ) {
			return;
		}

		global $product;
		$product_id = $product->get_id();

		$cpt_product_block_id = get_field( 'product_block_additional_content_id', $product_id );

		if ( ! $cpt_product_block_id ) {
			return;
		}
		echo '<div class="clear-both full-bleed-section">';
		echo apply_filters( 'the_content', get_post_field( 'post_content', $cpt_product_block_id[0] ) );
		echo '</div>';
	}

	/**
	 * Show product banner on WooCommerce product taxonomy archive header
	 *
	 * @return void
	 */
	public function show_product_banner() {
		// Check if it's any WooCommerce archive page
		if ( ! ( is_shop() || is_product_category() || is_product_tag() ) ) {
			return;
		}
		// Ensure the product banner is only shown on WooCommerce archive pages
		echo do_shortcode( '[tsf_breadcrumb class="post-breadcrumbs"]' );

		get_template_part( 'partials/woocommerce/product-banner/product', 'banner' );
	}

	/**
	 * Show product breadcrumb
	 *
	 * @return void
	 */
	public function show_product_breadcrumb() {
		// Check if it's any WooCommerce product page
		if ( ! ( is_product() ) ) {
			return;
		}
		// Ensure the product banner is only shown on WooCommerce product pages
		echo do_shortcode( '[tsf_breadcrumb class="post-breadcrumbs"]' );
	}

	/**
	 * Enqueue WooCommerce assets
	 *
	 * @return void
	 */
	public function enqueue_woocommerce_assets() {
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() && ! is_account_page() ) {
			return;
		}

		$asset_info = $this->get_asset_info( 'woocommerce' );

		wp_enqueue_style(
			'tenup-theme-woocommerce',
			TENUP_THEME_TEMPLATE_URL . '/assets/css/frontend/woocommerce/index.css',
			[],
			$asset_info['version']
		);
	}

	/**
	 * Setup variation swatches directly with class existence check
	 *
	 * @return void
	 */
	public function setup_variation_swatches() {
		if ( class_exists( 'Woo_Variation_Swatches_Pro_Archive_Page' ) ) {
			// The plugin has already loaded, so get the existing instance directly
			$wvs_pro_archive = \Woo_Variation_Swatches_Pro_Archive_Page::instance();
			if ( $wvs_pro_archive ) {
				$this->get_woocommerce_variation_swatches_pro( $wvs_pro_archive );
			}
		}
	}

	/**
	 * Change the position of the single product content
	 *
	 * @return void
	 */
	public function change_single_product_content() {
		if ( is_product() ) {
			return;
		}

		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

		include TENUP_THEME_PATH . 'partials/woocommerce/product/content-product-title.php';
	}


	/**
	 * Modify WooCommerce Variation Swatches Pro archive behavior
	 *
	 * @param object $wvs_pro_archive The WooCommerce Variation Swatches Pro Archive instance
	 * @return void
	 */
	public function get_woocommerce_variation_swatches_pro( $wvs_pro_archive ) {
		if ( ! class_exists( 'Woo_Variation_Swatches_Pro_Archive_Page' ) ) {
			return;
		}

		// Remove the existing hooks that the plugin already registered
		remove_action( 'woocommerce_after_shop_loop_item', array( $wvs_pro_archive, 'after_shop_loop_item' ), 30 );
		remove_action( 'woocommerce_after_shop_loop_item', array( $wvs_pro_archive, 'after_shop_loop_item' ), 7 );

		// Add swatches to our preferred position - before the title
		add_action( 'woocommerce_shop_loop_item_title', array( $wvs_pro_archive, 'after_shop_loop_item' ), 7 );
	}

	/**
	 * AJAX handler to update mini cart
	 */
	public function handle_update_mini_cart_quantity() {
		$cart_item_key = isset( $_POST['cart_item_key'] ) ? sanitize_text_field( $_POST['cart_item_key'] ) : '';
		$quantity      = isset( $_POST['quantity'] ) ? intval( $_POST['quantity'] ) : 0;

		if ( empty( $cart_item_key ) || $quantity <= 0 ) {
			wp_send_json_error( 'Invalid request' );
		}

		WC()->cart->set_quantity( $cart_item_key, $quantity );

		// also return cart total
		$cart_total = WC()->cart->get_cart_total();

		wp_send_json_success(
			array(
				'cart_contents_count' => WC()->cart->get_cart_contents_count(),
				'cart_total' => $cart_total,
			)
		);
	}
}
