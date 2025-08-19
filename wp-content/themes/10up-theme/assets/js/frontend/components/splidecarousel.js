class SplideCarousel {
	constructor(element) {
		this.element = element;
		this.elms = document.getElementsByClassName('splide');
	}

	splideSettings() {
		const { elms } = this;

		if (elms && typeof Splide !== 'undefined') {
			for (let i = 0; i < elms.length; i++) {
				const splide = new Splide(elms[i]);
				const carouselID = splide.root.id;
				const { AutoScroll } = window.splide.Extensions;

				switch (carouselID) {
					case 'logoDiscountCarousel':
					case 'socialMediaHighlightsCarousel':
						splide.on('mounted', () => {
							// Force resume on hover
							splide.root.addEventListener('mouseenter', () => {
								splide.Components.AutoScroll.play();
							});
							splide.root.addEventListener('mouseleave', () => {
								splide.Components.AutoScroll.play();
							});
						});
						splide.mount({ AutoScroll });
						break;
					default:
						splide.mount();
						break;
				}
			}
		}
	}

	fireWhenReady(func) {
		// call method when DOM is loaded
		return document.addEventListener('DOMContentLoaded', func.bind(this));
	}

	init() {
		this.fireWhenReady(this.splideSettings);
	}
}

export default SplideCarousel;
