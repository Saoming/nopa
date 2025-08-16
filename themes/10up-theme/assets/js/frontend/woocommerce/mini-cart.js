import jQuery from 'jquery';

(function ($) {
	// Quantity "plus" and "minus" buttons
	$(document.body).on('click', '.qty-increase, .qty-decrease', function () {
		const $qty = $(this).closest('.quantity-controls').find('.qty-amount');
		let currentVal = parseFloat($qty.text());

		// increase decrease value
		if ($(this).is('.qty-increase') && currentVal < 10) {
			currentVal++;
		} else if ($(this).is('.qty-decrease') && currentVal > 1) {
			currentVal--;
		}

		// update the value
		$qty.text(currentVal);

		// update minicart content
		$.ajax({
			// eslint-disable-next-line no-undef
			url: wc_add_to_cart_params.ajax_url
				.toString()
				.replace('%%endpoint%%', 'update_mini_cart'),
			type: 'POST',
			data: {
				action: 'update_mini_cart',
				quantity: currentVal,
				cart_item_key: $(this).data('cart-item-key'),
			},
			success(response) {
				if (response.success) {
					// update minicart total
					$('.cart-totals .cart-subtotal').find('strong').html(response.data.cart_total);

					// update cart count
					$('.header__cart-count').text(`(${response.data.cart_contents_count})`);
				}
			},
		});
	});
})(jQuery);
