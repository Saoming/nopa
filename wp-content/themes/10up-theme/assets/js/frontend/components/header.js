class Header {
	constructor(element) {
		this.element = element;

		this.Hamburger = document.querySelector('#mobile-navigation-button');
		this.CloseBtn = document.querySelector('#mobile-nav__close');
		this.nav = document.querySelector('#mobile-navigation');
		this.MobileNavInner = document.querySelector('.mobile-nav_inner');
		this.MobileOverlay = document.querySelector('.mobile-nav__overlay');
	}

	toggleMobileNav() {
		this.Hamburger.addEventListener('click', () => {
			const isHidden = this.nav.classList.contains('v-hidden'); // make sure to check if the class is present

			this.Hamburger.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
			this.nav.setAttribute('aria-hidden', isHidden ? 'true' : 'false');

			this.nav.classList.toggle('v-hidden');
			this.MobileOverlay.classList.toggle('open');
			this.MobileNavInner.classList.toggle('open');
		});
		this.CloseBtn.addEventListener('click', () => {
			const isHidden = this.nav.classList.contains('v-hidden'); // make sure to check if the class is present
			this.Hamburger.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
			this.nav.setAttribute('aria-hidden', isHidden ? 'true' : 'false');

			this.nav.classList.toggle('v-hidden');
			this.MobileOverlay.classList.toggle('open');
			this.MobileNavInner.classList.toggle('open');
		});
	}

	fireWhenReady(func) {
		// call method when DOM is loaded
		return document.addEventListener('DOMContentLoaded', func.bind(this));
	}

	init() {
		this.fireWhenReady(this.toggleMobileNav);
	}
}

export default Header;
