<?php
/**
 * WooCommerce Product Customizer
 *
 * @package TenUpTheme
 */

namespace TenUpTheme;

use TenupFramework\Assets\GetAssetInfo;
use TenupFramework\Module;
use TenupFramework\ModuleInterface;

class ProductCustomizer implements ModuleInterface {

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
		// add a static button "Personalize your own" above add to cart
		add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'render_personalize_button_and_elements' ] );

		// populate product color fields
		add_filter( 'acf/load_field/name=top_lid_colors', [ $this, 'populate_from_options_page' ] );
		add_filter( 'acf/load_field/name=sip_lid_colors', [ $this, 'populate_from_options_page' ] );
		add_filter( 'acf/load_field/name=base_colors', [ $this, 'populate_from_options_page' ] );

		// populate product default fields
		add_filter( 'acf/load_field/name=top_lid_default', [ $this, 'populate_from_options_page' ] );
		add_filter( 'acf/load_field/name=sip_lid_default', [ $this, 'populate_from_options_page' ] );
		add_filter( 'acf/load_field/name=base_default', [ $this, 'populate_from_options_page' ] );

		// populate product color fields under color combos
		add_filter( 'acf/load_field/name=top_lid_color', [ $this, 'populate_from_options_page' ] );
		add_filter( 'acf/load_field/name=sip_lid_color', [ $this, 'populate_from_options_page' ] );
		add_filter( 'acf/load_field/name=base_color', [ $this, 'populate_from_options_page' ] );

		// populate color field under personalization cost
		add_filter( 'acf/load_field/name=item_color', [ $this, 'populate_from_options_page' ] );

		// Add Frontend Fields on Product Page
		add_action( 'woocommerce_before_add_to_cart_button', [ $this, 'render_customization_fields_from_acf' ] );

		// Save Selected Values to Cart
		add_filter( 'woocommerce_add_cart_item_data', [ $this, 'acf_customization_cart_data' ], 10, 2 );

		// Display Custom Fields in Cart & Checkout
		add_filter( 'woocommerce_get_item_data', [ $this, 'acf_display_customization_cart' ], 10, 2 );

		// Save to Order Meta
		add_action( 'woocommerce_add_order_item_meta', [ $this, 'acf_save_customization_order_meta' ], 10, 2 );

		// Add Custom Price to Product in Cart
		add_filter( 'woocommerce_before_calculate_totals', [ $this, 'add_custom_price_to_product_in_cart' ], 10, 3 );
	}


	/**
	 * Render the "Personalize your own" button and other elements
	 *
	 * @return void
	 */
	public function render_personalize_button_and_elements() {
		get_template_part( 'partials/woocommerce/product/personalize-product-combos' );
	}


	/**
	 * Populate colors from an product colors options page
	 *
	 * @param array $field The field array
	 * @return array The modified field array
	 */
	public function populate_from_options_page( $field ) {
		$field['choices'] = array();

		$product_colors = get_field( 'product_colors', 'option' );

		if ( $product_colors ) {
			foreach ( $product_colors as $color ) {
				if ( ! empty( $color['color_name'] ) && ! empty( $color['color_value'] ) ) {
					$field['choices'][ $color['color_value'] ] = $color['color_name'];
				}
			}
		}

		return $field;
	}


	/**
	 * Render the customization fields from ACF
	 *
	 * @return void
	 */
	public function render_customization_fields_from_acf() {
		get_template_part( 'partials/woocommerce/product/personalize-product' );
	}


	/**
	 * Save Selected Values to Cart
	 *
	 * @param array $cart_item_data The cart item data
	 * @param int   $product_id The product ID
	 * @return array The modified cart item data
	 */
	public function acf_customization_cart_data( $cart_item_data, $product_id ) {
		$parts = [
			'top_lid' => [],
			'sip_lid' => [],
			'base'    => [],
		];

		// get all customization costs for this product
		$customization_costs = get_field( 'customization_costs', $product_id );

		if ( $customization_costs ) {
			foreach ( $customization_costs as $cost ) {
				$parts[ $cost['item']['value'] ][ $cost['item_color']['value'] ] = $cost['price'];
			}
		}

		foreach ( $parts as $part => $options ) {
			if ( ! empty( $_POST[ "{$part}_color" ] ) ) {
				$color                             = sanitize_text_field( $_POST[ "{$part}_color" ] );
				$cart_item_data[ "{$part}_color" ] = $color;

				// Add price if exists in options array
				if ( isset( $options[ $color ] ) ) {
					$cart_item_data['custom_price'] = isset( $cart_item_data['custom_price'] )
						? $cart_item_data['custom_price'] + $options[ $color ]
						: $options[ $color ];
				}
			}
		}

		if ( ! empty( $_POST['engraving_text'] ) ) {
			$cart_item_data['engraving_text'] = sanitize_textarea_field( $_POST['engraving_text'] );
		}

		return $cart_item_data;
	}


	/**
	 * Display Custom Fields in Cart & Checkout
	 *
	 * @param array $item_data The cart item data
	 * @param array $cart_item The cart item
	 * @return array The modified cart item data
	 */
	public function acf_display_customization_cart( $item_data, $cart_item ) {
		$labels = [
			'top_lid_color'  => 'Top Lid Color',
			'sip_lid_color'  => 'Sip Lid Color',
			'base_color'     => 'Base Color',
			'engraving_text' => 'Text Engraving',
		];

		foreach ( $labels as $key => $label ) {
			if ( ! empty( $cart_item[ $key ] ) ) {
				$item_data[] = [
					'name'  => $label,
					'value' => $cart_item[ $key ],
				];
			}
		}

		if ( ! empty( $cart_item['custom_price'] ) ) {
			$item_data[] = [
				'name'  => __( 'Personalization Cost', 'tenup-theme' ),
				'value' => wc_price( $cart_item['custom_price'] ),
			];
		}

		return $item_data;
	}


	/**
	 * Save to Order Meta
	 *
	 * @param int   $item_id The order item ID
	 * @param array $values The cart item data
	 * @return void
	 */
	public function acf_save_customization_order_meta( $item_id, $values ) {
		$fields = [ 'top_lid_color', 'sip_lid_color', 'base_color', 'engraving_text' ];
		foreach ( $fields as $field ) {
			if ( ! empty( $values[ $field ] ) ) {
				wc_add_order_item_meta( $item_id, ucwords( str_replace( '_', ' ', $field ) ), $values[ $field ] );
			}
		}
	}


	/**
	 * Add Custom Price to Product in Cart
	 *
	 * @param object $cart The cart object
	 * @return void
	 */
	public function add_custom_price_to_product_in_cart( $cart ) {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) { return;
		}

		foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
			if ( isset( $cart_item['custom_price'] ) && $cart_item['custom_price'] > 0 ) {
				// Store the original price in cart item data to prevent multiple additions
				if ( ! isset( $cart_item['original_base_price'] ) ) {
					// Get the original product price and store it in the cart item
					$original_product = wc_get_product( $cart_item['product_id'] );
					$cart_item['original_base_price'] = $original_product->get_price();

					// Update the cart item with the original price stored
					WC()->cart->cart_contents[ $cart_item_key ]['original_base_price'] = $cart_item['original_base_price'];
				}

				// Calculate new price from original price to prevent compounding
				$new_price = $cart_item['original_base_price'] + $cart_item['custom_price'];
				$cart_item['data']->set_price( $new_price );
			}
		}
	}
}
