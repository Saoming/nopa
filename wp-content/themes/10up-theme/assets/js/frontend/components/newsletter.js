class Newsletter {
	constructor(element) {
		this.element = element;

		this.newsletter = document.querySelector('.newsletter__modal');
		if (!this.newsletter) return;

		this.newsletterClose = this.newsletter.querySelector('.newsletter__close-button');
		this.newsletterOverlay = this.newsletter.querySelector('.newsletter__overlay');
	}

	showNewsletter() {
		if (!this.newsletter) return;

		setTimeout(
			() => {
				this.newsletter.classList.remove('hidden');
				if (this.newsletterOverlay) {
					this.newsletterOverlay.setAttribute('aria-hidden', 'false');
				}
			},
			Math.random() * 5000 + 15000, // random delay between 15 and 20 seconds
		);
	}

	closeNewsletter() {
		if (!this.newsletterClose) return;

		this.newsletterClose.addEventListener('click', () => {
			if (this.newsletter) {
				this.newsletter.classList.add('hidden');
			}
			if (this.newsletterOverlay) {
				this.newsletterOverlay.setAttribute('aria-hidden', 'true');
			}
		});
	}

	fireWhenReady(func) {
		// call method when DOM is loaded
		return document.addEventListener('DOMContentLoaded', func.bind(this));
	}

	init() {
		this.fireWhenReady(this.showNewsletter);
		this.fireWhenReady(this.closeNewsletter);
	}
}

export default Newsletter;
