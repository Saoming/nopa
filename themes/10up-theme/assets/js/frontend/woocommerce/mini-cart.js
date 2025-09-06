import jQuery from 'jquery';

(function ($) {
	// close mini-cart
	const closeMiniCart = () => {
		$('body').removeClass('cart-drawer-open');
	};

	// Plus button
	$(document).on('click', '.quantity-controls .qty-increase', function () {
		const $input = $(this).closest('.quantity-controls').find('input.qty');
		const val = parseInt($input.val(), 10);
		const max = parseInt($input.attr('max'), 10);

		if (!Number.isNaN(val)) {
			if (!max || val < max) {
				$input.val(val + 1);
				$input.trigger('change');
			}
		}
	});

	// Minus button
	$(document).on('click', '.quantity-controls .qty-decrease', function () {
		const $input = $(this).closest('.quantity-controls').find('input.qty');
		const val = parseInt($input.val(), 10);
		const min = parseInt($input.attr('min'), 10) || 1;

		if (!Number.isNaN(val) && val > min) {
			$input.val(val - 1);
			$input.trigger('change');
		}
	});

	// Trigger mini-cart refresh on qty change
	$(document).on('change', '.quantity-controls input.qty', function () {
		const cart_item_key = $(this).closest('.quantity-controls').attr('data-cart-item-key');
		const quantity = $(this).val();
		$('#cart-drawer').block();

		// If your mini-cart doesn't use a form, fallback to updating cart fragments
		$.ajax({
			type: 'POST',
			url: wc_add_to_cart_params.wc_ajax_url // eslint-disable-line no-undef
				.toString()
				.replace('%%endpoint%%', 'update_mini_cart_quantity'),
			data: {
				cart_item_key,
				quantity,
			},
			success(response) {
				// Refresh mini cart fragments
				if (response.success) {
					// update cart total
					const { cart_total, cart_contents_count } = response.data;
					$('.woocommerce-mini-cart__total .amount').html(cart_total);
					$('.header__cart-count').text(`(${cart_contents_count})`);

					// unblock
					$('#cart-drawer').unblock();
				}
			},
		});
	});

	// close drawer
	$(document).on('click', '.close-drawer', function () {
		closeMiniCart();
	});
})(jQuery);
