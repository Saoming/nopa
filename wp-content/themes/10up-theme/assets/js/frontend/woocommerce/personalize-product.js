// eslint-disable-next-line
import MicroModal from 'micromodal';
// eslint-disable-next-line
import jQuery from 'jquery';

MicroModal.init();

(function ($) {
	// Constants for color types
	const COLOR_TYPES = ['top_lid_color', 'sip_lid_color', 'base_color'];

	// Helper function to get selected colors
	function getSelectedColors() {
		return COLOR_TYPES.reduce((colors, colorType) => {
			colors[colorType] = $(
				`.pp-tabs-content-color-item-option input[name="${colorType}"]:checked`,
			).val();
			return colors;
		}, {});
	}

	// show/hide tabs content/tabs header
	$('.pp-tabs-header h3').on('click', function (e) {
		e.preventDefault();
		$(this).siblings().removeClass('active');
		const tab = $(this).data('tab');
		$('.pp-tabs-content').removeClass('active');
		$(`.pp-tabs-content-${tab}`).addClass('active');
		$(this).addClass('active');
	});

	// change '.pp-tabs-content-color-item-label span' text to the value of radio button is changed
	$('.pp-tabs-content-color-item-option input').on('change', function () {
		// get aria-label of the input
		const ariaLabel = $(this).attr('aria-label');

		const label = $(this)
			.parent()
			.parent()
			.parent()
			.find('.pp-tabs-content-color-item-label span');
		label.text(ariaLabel);
	});

	// update characters left text
	$('#engraving_text').on('input', function () {
		const value = $(this).val();
		const maxlength = $(this).attr('maxlength');
		const charactersLeft = maxlength - value.length;
		$('.characters-left').text(`${charactersLeft}/${maxlength} characters`);
	});

	// when clicked "done" button, add items to "your designs" section
	$('.pp-done-button').on('click', function () {
		// only append 5 items
		const combo_items = $('.pp-combos-designs.combo-designs .pp-combos-designs-list').find(
			'.pp-combos-designs-item input[type="radio"]',
		);

		const custom_items = $('.pp-combos-designs.custom-designs .pp-combos-designs-list').find(
			'.pp-combos-designs-item input[type="radio"]',
		);

		const count_start = combo_items.length + custom_items.length;

		if (count_start >= 10) {
			return;
		}

		// get selected colors using helper function
		const selectedColors = getSelectedColors();
		const { top_lid_color, sip_lid_color, base_color } = selectedColors;

		// get selected combo
		const selected_combo = $(
			'.pp-combos-designs .pp-combos-designs-item input[name="selected_color_combo"]:checked',
		);

		if (selected_combo.length > 0) {
			// get selected combo colors
			const selected_combo_top_lid = selected_combo.data('top-lid');
			const selected_combo_sip_lid = selected_combo.data('sip-lid');
			const selected_combo_base = selected_combo.data('base');

			// check if colors were not changed
			if (
				selected_combo_top_lid === top_lid_color &&
				selected_combo_sip_lid === sip_lid_color &&
				selected_combo_base === base_color
			) {
				return;
			}
		}

		// create image file name
		const image_file_name = `${top_lid_color}-${sip_lid_color}-${base_color}.png`;

		// append new item
		$('.pp-combos-designs .pp-combos-designs-item')
			.eq(count_start)
			.html(
				`
				<input
					type="radio"
					id="color_combo_${count_start}"
					name="selected_color_combo"
					value="${count_start}"
					data-top-lid="${top_lid_color}"
					data-sip-lid="${sip_lid_color}"
					data-base="${base_color}"
					data-image="490"
					checked
				/>
				<label for="color_combo_${count_start}" class="pp-combos-designs-item-image">
					<img width="100" height="100"
						src="${window.tenup_theme_woocommerce.template_url}/assets/images/personalize-product/product-${image_file_name}"
						onerror="this.onerror=null; this.src='${window.tenup_theme_woocommerce.template_url}/assets/images/personalize-product/nopa-product-placeholder.png';"
						/>
				</label>
			`,
			);
	});

	// on changing radio button under '.pp-combos-designs .pp-combos-designs-item', change the values of related input fields under ".personalize-product-modal"
	$(document).on(
		'change',
		'.pp-combos-designs .pp-combos-designs-item input[type="radio"]',
		function () {
			// get the data-top-lid, data-sip-lid, data-base, data-image values
			const top_lid = $(this).data('top-lid');
			const sip_lid = $(this).data('sip-lid');
			const base = $(this).data('base');

			// get the related input fields under ".personalize-product-modal"
			if (top_lid) {
				$(
					`#personalize-product-modal input[name="top_lid_color"][value="${top_lid}"]`,
				).prop('checked', true);
			}

			if (sip_lid) {
				$(
					`#personalize-product-modal input[name="sip_lid_color"][value="${sip_lid}"]`,
				).prop('checked', true);
			}

			if (base) {
				$(`#personalize-product-modal input[name="base_color"][value="${base}"]`).prop(
					'checked',
					true,
				);
			}
		},
	);
})(jQuery);
