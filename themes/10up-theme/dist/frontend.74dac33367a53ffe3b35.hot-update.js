"use strict";
self["webpackHotUpdatetenup_theme"]("frontend",{

/***/ "./assets/js/frontend/frontend.js":
/*!****************************************!*\
  !*** ./assets/js/frontend/frontend.js ***!
  \****************************************/
/***/ (function(module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _css_frontend_style_css__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../css/frontend/style.css */ "./assets/css/frontend/style.css");
/* harmony import */ var _components_header__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./components/header */ "./assets/js/frontend/components/header.js");
/* harmony import */ var _components_newsletter__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./components/newsletter */ "./assets/js/frontend/components/newsletter.js");
/* harmony import */ var _components_splidecarousel__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/splidecarousel */ "./assets/js/frontend/components/splidecarousel.js");
/* harmony import */ var _blocks_card_section_stacked__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./blocks/card-section-stacked */ "./assets/js/frontend/blocks/card-section-stacked.js");
/* harmony import */ var _blocks_wavy__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./blocks/wavy */ "./assets/js/frontend/blocks/wavy.js");
/* harmony import */ var _woocommerce_ajax_add_to_cart__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./woocommerce/ajax-add-to-cart */ "./assets/js/frontend/woocommerce/ajax-add-to-cart.js");
/* harmony import */ var _woocommerce_personalize_product__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./woocommerce/personalize-product */ "./assets/js/frontend/woocommerce/personalize-product.js");
/* harmony import */ var _woocommerce_mini_cart__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./woocommerce/mini-cart */ "./assets/js/frontend/woocommerce/mini-cart.js");
/* provided dependency */ var __react_refresh_utils__ = __webpack_require__(/*! ../../node_modules/@pmmmwh/react-refresh-webpack-plugin/lib/runtime/RefreshUtils.js */ "../../node_modules/@pmmmwh/react-refresh-webpack-plugin/lib/runtime/RefreshUtils.js");
/* provided dependency */ var __react_refresh_error_overlay__ = __webpack_require__(/*! ../../node_modules/@pmmmwh/react-refresh-webpack-plugin/overlay/index.js */ "../../node_modules/@pmmmwh/react-refresh-webpack-plugin/overlay/index.js");
__webpack_require__.$Refresh$.runtime = __webpack_require__(/*! ../../node_modules/react-refresh/runtime.js */ "react-refresh/runtime");







// import './woocommerce/cross-sell';




// Class Components
const header = new _components_header__WEBPACK_IMPORTED_MODULE_1__["default"]();
header.init();
const newsletter = new _components_newsletter__WEBPACK_IMPORTED_MODULE_2__["default"]();
newsletter.init();
const splideCarousel = new _components_splidecarousel__WEBPACK_IMPORTED_MODULE_3__["default"]();
splideCarousel.init();

// Blocks Components
(0,_blocks_card_section_stacked__WEBPACK_IMPORTED_MODULE_4__["default"])();
(0,_blocks_wavy__WEBPACK_IMPORTED_MODULE_5__["default"])();

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
//# sourceMappingURL=frontend.74dac33367a53ffe3b35.hot-update.js.map