import jQuery from 'jquery';

(function ($) {
	// open mini-cart
	const openMiniCart = () => {
		$('#cart-drawer').addClass('open');
		$('body').addClass('cart-drawer-open');
	};

	// Ajax add to cart on the product page
	const $warp_fragment_refresh = {
		// eslint-disable-next-line no-undef
		url: wc_cart_fragments_params.wc_ajax_url
			.toString()
			.replace('%%endpoint%%', 'get_refreshed_fragments'),
		type: 'POST',
		success(data) {
			if (data && data.fragments) {
				$.each(data.fragments, function (key, value) {
					$(key).replaceWith(value);
				});

				$(document.body).trigger('wc_fragments_refreshed');
			}
		},
	};

	$('.entry-summary form.cart').on('submit', function (e) {
		e.preventDefault();

		$('.entry-summary').block({
			message: null,
			overlayCSS: {
				cursor: 'none',
			},
		});

		const product_url = window.location;
		const form = $(this);

		$.post(
			product_url,
			`${form.serialize()}&_wp_http_referer=${product_url}`,
			function (result) {
				const cart_dropdown = $('.widget_shopping_cart', result);

				// update dropdown cart
				$('.widget_shopping_cart').replaceWith(cart_dropdown);

				// update fragments
				$.ajax($warp_fragment_refresh);

				$('.entry-summary').unblock();

				// open mini-cart
				setTimeout(function () {
					openMiniCart();
				}, 300);
			},
		);
	});
})(jQuery);
