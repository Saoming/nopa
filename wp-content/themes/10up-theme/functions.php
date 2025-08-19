<?php
/**
 * WP Theme constants and setup functions
 *
 * @package TenUpTheme
 */

// Useful global constants.
define( 'TENUP_THEME_VERSION', '0.1.0' );
define( 'TENUP_THEME_TEMPLATE_URL', get_template_directory_uri() );
define( 'TENUP_THEME_PATH', get_template_directory() . '/' );
define( 'TENUP_THEME_DIST_PATH', TENUP_THEME_PATH . 'dist/' );
define( 'TENUP_THEME_DIST_URL', TENUP_THEME_TEMPLATE_URL . '/dist/' );
define( 'TENUP_THEME_INC', TENUP_THEME_PATH . 'src/' );
define( 'TENUP_THEME_BLOCK_DIR', TENUP_THEME_PATH . 'blocks/' );
define( 'TENUP_THEME_BLOCK_DIST_DIR', TENUP_THEME_PATH . 'dist/blocks/' );

$is_local_env = in_array( wp_get_environment_type(), [ 'local', 'development' ], true );
$is_local_url = strpos( home_url(), '.test' ) || strpos( home_url(), '.local' );
$is_local     = $is_local_env || $is_local_url;

if ( $is_local && file_exists( __DIR__ . '/dist/fast-refresh.php' ) ) {
	require_once __DIR__ . '/dist/fast-refresh.php';

	if ( function_exists( 'TenUpToolkit\set_dist_url_path' ) ) {
		TenUpToolkit\set_dist_url_path( basename( __DIR__ ), TENUP_THEME_DIST_URL, TENUP_THEME_DIST_PATH );
	}
}

// Require Composer autoloader if it exists.
if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	throw new Exception( 'Please run `composer install` in your theme directory.' );
}

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/template-tags.php';

$theme_core = new \TenUpTheme\ThemeCore();
$theme_core->setup();


/**
 * Debug version - Get cross-sells based on cart items
 */
function get_cart_based_cross_sells($limit = 4) {
    $cross_sells = array();
    $cart_product_ids = array();

    // Get all product IDs from cart
    foreach (WC()->cart->get_cart() as $cart_item) {
        $cart_product_ids[] = $cart_item['product_id'];
    }

    // Debug: Log cart products
    error_log('Cart product IDs: ' . print_r($cart_product_ids, true));

    if (empty($cart_product_ids)) {
        error_log('No products in cart');
        return $cross_sells;
    }

    // Method 1: Get cross-sells from each cart product
    foreach ($cart_product_ids as $product_id) {
        $product = wc_get_product($product_id);
        if ($product && $product->exists()) {
            $product_cross_sells = $product->get_cross_sell_ids();
            error_log('Product ' . $product_id . ' cross-sells: ' . print_r($product_cross_sells, true));
            $cross_sells = array_merge($cross_sells, $product_cross_sells);
        }
    }

    // Method 2: Get products from same categories if not enough cross-sells
    if (count($cross_sells) < $limit) {
        error_log('Not enough cross-sells, trying category method');
        $category_products = get_cross_sells_by_category($cart_product_ids, $limit);
        error_log('Category products: ' . print_r($category_products, true));
        $cross_sells = array_merge($cross_sells, $category_products);
    }

    // Remove duplicates and cart items
    $cross_sells = array_unique($cross_sells);
    $cross_sells = array_diff($cross_sells, $cart_product_ids);

    // Limit results
    $cross_sells = array_slice($cross_sells, 0, $limit);

    error_log('Final cross-sells: ' . print_r($cross_sells, true));
    return $cross_sells;
}

/**
 * Debug version - Get products from same categories
 */
function get_cross_sells_by_category($cart_product_ids, $limit = 4) {
    $category_ids = array();

    // Get categories from cart products
    foreach ($cart_product_ids as $product_id) {
        $product_categories = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'ids'));
        error_log('Product ' . $product_id . ' categories: ' . print_r($product_categories, true));
        $category_ids = array_merge($category_ids, $product_categories);
    }

    if (empty($category_ids)) {
        error_log('No categories found');
        return array();
    }

    $category_ids = array_unique($category_ids);
    error_log('All category IDs: ' . print_r($category_ids, true));

    // Query products from same categories
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $limit * 2,
        'post_status' => 'publish',
        'post__not_in' => $cart_product_ids,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $category_ids,
                'operator' => 'IN'
            )
        ),
        'orderby' => 'rand'
    );

    $products = get_posts($args);
    error_log('Found ' . count($products) . ' category products');

    $product_ids = array();
    foreach ($products as $product) {
        $product_ids[] = $product->ID;
    }

    return $product_ids;
}
