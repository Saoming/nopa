self["webpackHotUpdatetenup_theme"]("frontend",{

/***/ "./assets/js/frontend/frontend.js":
/*!****************************************!*\
  !*** ./assets/js/frontend/frontend.js ***!
  \****************************************/
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
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
/* harmony import */ var _woocommerce_quantity_input__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./woocommerce/quantity-input */ "./assets/js/frontend/woocommerce/quantity-input.js");
/* harmony import */ var _woocommerce_quantity_input__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(_woocommerce_quantity_input__WEBPACK_IMPORTED_MODULE_9__);
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

/***/ }),

/***/ "./assets/js/frontend/woocommerce/quantity-input.js":
/*!**********************************************************!*\
  !*** ./assets/js/frontend/woocommerce/quantity-input.js ***!
  \**********************************************************/
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

/* provided dependency */ var __react_refresh_utils__ = __webpack_require__(/*! ../../node_modules/@pmmmwh/react-refresh-webpack-plugin/lib/runtime/RefreshUtils.js */ "../../node_modules/@pmmmwh/react-refresh-webpack-plugin/lib/runtime/RefreshUtils.js");
/* provided dependency */ var __react_refresh_error_overlay__ = __webpack_require__(/*! ../../node_modules/@pmmmwh/react-refresh-webpack-plugin/overlay/index.js */ "../../node_modules/@pmmmwh/react-refresh-webpack-plugin/overlay/index.js");
__webpack_require__.$Refresh$.runtime = __webpack_require__(/*! ../../node_modules/react-refresh/runtime.js */ "react-refresh/runtime");

/**
 * Quantity Input with + and - buttons for WooCommerce cart
 */

document.addEventListener('DOMContentLoaded', function () {
  const quantityContainers = document.querySelectorAll('.quantity-input-container');
  quantityContainers.forEach(function (container) {
    const minusBtn = container.querySelector('.quantity-minus');
    const plusBtn = container.querySelector('.quantity-plus');
    const input = container.querySelector('.quantity-input');
    if (!minusBtn || !plusBtn || !input) return;
    const minValue = parseInt(input.getAttribute('min')) || 0;
    const maxValue = parseInt(input.getAttribute('max')) || 999;

    // Handle minus button click
    minusBtn.addEventListener('click', function (e) {
      e.preventDefault();
      const currentValue = parseInt(input.value) || 0;
      if (currentValue > minValue) {
        input.value = currentValue - 1;

        // Trigger change event to update cart automatically if needed
        input.dispatchEvent(new Event('change', {
          bubbles: true
        }));
      }
      updateButtonStates(container, input.value);
    });

    // Handle plus button click
    plusBtn.addEventListener('click', function (e) {
      e.preventDefault();
      const currentValue = parseInt(input.value) || 0;
      if (maxValue === -1 || currentValue < maxValue) {
        input.value = currentValue + 1;

        // Trigger change event to update cart automatically if needed
        input.dispatchEvent(new Event('change', {
          bubbles: true
        }));
      }
      updateButtonStates(container, input.value);
    });

    // Handle direct input changes
    input.addEventListener('input', function () {
      let value = parseInt(this.value) || 0;

      // Enforce min/max limits
      if (value < minValue) {
        this.value = minValue;
        value = minValue;
      }
      if (maxValue !== -1 && value > maxValue) {
        this.value = maxValue;
        value = maxValue;
      }
      updateButtonStates(container, value);
    });

    // Initial button state update
    updateButtonStates(container, input.value);
  });

  /**
   * Update the disabled state of + and - buttons based on current value
   */
  function updateButtonStates(container, currentValue) {
    const minusBtn = container.querySelector('.quantity-minus');
    const plusBtn = container.querySelector('.quantity-plus');
    const input = container.querySelector('.quantity-input');
    const minValue = parseInt(input.getAttribute('min')) || 0;
    const maxValue = parseInt(input.getAttribute('max')) || 999;
    const value = parseInt(currentValue) || 0;

    // Update minus button state
    if (value <= minValue) {
      minusBtn.disabled = true;
      minusBtn.classList.add('disabled');
    } else {
      minusBtn.disabled = false;
      minusBtn.classList.remove('disabled');
    }

    // Update plus button state
    if (maxValue !== -1 && value >= maxValue) {
      plusBtn.disabled = true;
      plusBtn.classList.add('disabled');
    } else {
      plusBtn.disabled = false;
      plusBtn.classList.remove('disabled');
    }
  }
});

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
//# sourceMappingURL=frontend.dcd4aa7ce113549149ac.hot-update.js.map