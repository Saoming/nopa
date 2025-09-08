"use strict";
self["webpackHotUpdatetenup_theme"]("frontend",{

/***/ "./assets/js/frontend/woocommerce/ajax-add-to-cart.js":
/*!************************************************************!*\
  !*** ./assets/js/frontend/woocommerce/ajax-add-to-cart.js ***!
  \************************************************************/
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

  // Ajax add to cart on the product page
  const $warp_fragment_refresh = {
    // eslint-disable-next-line no-undef
    url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
    type: 'POST',
    success(data) {
      if (data && data.fragments) {
        $.each(data.fragments, function (key, value) {
          $(key).replaceWith(value);
        });
        $(document.body).trigger('wc_fragments_refreshed');
        openMiniCart();
      }
    }
  };
  $('.entry-summary form.cart').on('submit', function (e) {
    e.preventDefault();
    $('.entry-summary').block({
      message: null,
      overlayCSS: {
        cursor: 'none'
      }
    });
    const product_url = window.location;
    const form = $(this);
    $.post(product_url, `${form.serialize()}&_wp_http_referer=${product_url}`, function (result) {
      const cart_dropdown = $('.widget_shopping_cart', result);

      // update dropdown cart
      $('.widget_shopping_cart').replaceWith(cart_dropdown);

      // update fragments
      $.ajax($warp_fragment_refresh);
      $('.entry-summary').unblock();
    });
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
//# sourceMappingURL=frontend.e6b8af01ae25c2dfba32.hot-update.js.map