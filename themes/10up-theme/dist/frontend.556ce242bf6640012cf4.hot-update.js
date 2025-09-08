"use strict";
self["webpackHotUpdatetenup_theme"]("frontend",{

/***/ "./assets/js/frontend/woocommerce/mini-cart.js":
/*!*****************************************************!*\
  !*** ./assets/js/frontend/woocommerce/mini-cart.js ***!
  \*****************************************************/
/***/ (function(module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jquery */ "jquery");
/* harmony import */ var jquery__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(jquery__WEBPACK_IMPORTED_MODULE_0__);
/* provided dependency */ var __react_refresh_utils__ = __webpack_require__(/*! ../../node_modules/@pmmmwh/react-refresh-webpack-plugin/lib/runtime/RefreshUtils.js */ "../../node_modules/@pmmmwh/react-refresh-webpack-plugin/lib/runtime/RefreshUtils.js");
/* provided dependency */ var __react_refresh_error_overlay__ = __webpack_require__(/*! ../../node_modules/@pmmmwh/react-refresh-webpack-plugin/overlay/index.js */ "../../node_modules/@pmmmwh/react-refresh-webpack-plugin/overlay/index.js");
__webpack_require__.$Refresh$.runtime = __webpack_require__(/*! ../../node_modules/react-refresh/runtime.js */ "react-refresh/runtime");


(function ($) {
  // open mini-cart
  const openMiniCart = () => {
    $('body').addClass('cart-drawer-open');
  };

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
      .toString().replace('%%endpoint%%', 'update_mini_cart_quantity'),
      data: {
        cart_item_key,
        quantity
      },
      success(response) {
        // Refresh mini cart fragments
        if (response.success) {
          // update cart total
          const {
            cart_total,
            cart_contents_count
          } = response.data;
          $('.woocommerce-mini-cart__total .amount').html(cart_total);
          $('.header__cart-count').text(`(${cart_contents_count})`);

          // unblock
          $('#cart-drawer').unblock();
        }
      }
    });
  });

  // close drawer
  $(document).on('click', '.close-drawer', function () {
    closeMiniCart();
  });
})((jquery__WEBPACK_IMPORTED_MODULE_0___default()));

var $ReactRefreshModuleId$ = __webpack_require__.$Refresh$.moduleId;
var $ReactRefreshCurrentExports$ = __react_refresh_utils__.getModuleExports(
	$ReactRefreshModuleId$
);

function $ReactRefreshModuleRuntime$(exports) {
	if (true) {
		var errorOverlay;
		if (typeof __react_refresh_error_overlay__ !== 'undefined') {
			errorOverlay = __react_refresh_error_overlay__;
		}
		var testMode;
		if (typeof __react_refresh_test__ !== 'undefined') {
			testMode = __react_refresh_test__;
		}
		return __react_refresh_utils__.executeRuntime(
			exports,
			$ReactRefreshModuleId$,
			module.hot,
			errorOverlay,
			testMode
		);
	}
}

if (typeof Promise !== 'undefined' && $ReactRefreshCurrentExports$ instanceof Promise) {
	$ReactRefreshCurrentExports$.then($ReactRefreshModuleRuntime$);
} else {
	$ReactRefreshModuleRuntime$($ReactRefreshCurrentExports$);
}

/***/ })

});
//# sourceMappingURL=frontend.556ce242bf6640012cf4.hot-update.js.map