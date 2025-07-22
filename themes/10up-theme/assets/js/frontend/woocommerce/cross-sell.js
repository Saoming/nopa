jQuery(document).ready(function ($) {
	// Load cross-sells
	function loadCrossSells() {
		$.ajax({
			url: wc_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'get_cart_cross_sells',
			},
			success(response) {
				if (response.success && response.data.html) {
					$('#cross-sell-items').html(response.data.html);
					$('.cart-cross-sells').show();
				} else {
					$('.cart-cross-sells').hide();
				}
			},
		});
	}

	// Add cross-sell to cart
	$(document).on('click', '.add-cross-sell', function () {
		const productId = $(this).data('product-id');
		const button = $(this);

		button.text('Adding...');

		$.ajax({
			url: wc_add_to_cart_params.ajax_url,
			type: 'POST',
			data: {
				action: 'woocommerce_add_to_cart',
				product_id: productId,
				quantity: 1,
			},
			success() {
				button.text('Added!');
				$(document.body).trigger('wc_fragment_refresh');

				setTimeout(function () {
					button.closest('.cross-sell-item').fadeOut();
				}, 1000);
			},
		});
	});

	// Load when drawer opens
	$(document).on('cart_drawer_opened', loadCrossSells);

	// Reload when cart updates
	$(document.body).on('wc_fragments_refreshed', loadCrossSells);
});
