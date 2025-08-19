const CardSectionStacked = () => {
	document.addEventListener('DOMContentLoaded', () => {
		if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
			console.warn('GSAP or ScrollTrigger not loaded.');
			return;
		}

		gsap.registerPlugin(ScrollTrigger);

		const container = document.querySelector('.card-section-stacked__inner');
		const cards = container
			? Array.from(container.querySelectorAll('.card-section-stacked__item'))
			: [];

		if (!container || cards.length < 2) return;

		// Check if mobile (you can adjust the breakpoint as needed)
		const isMobile = window.innerWidth <= 768;

		if (isMobile) {
			// Reset any existing styles and animations on mobile
			container.style.position = '';
			container.style.height = '';
			container.style.overflow = '';

			cards.forEach((card) => {
				card.style.position = '';
				card.style.top = '';
				card.style.left = '';
				card.style.width = '';
				card.style.zIndex = '';
				gsap.set(card, { clearProps: 'transform, opacity' });
			});
			return;
		}

		// Ensure container is set up
		container.style.position = 'relative';
		container.style.height = '100vh';
		container.style.overflow = 'hidden';

		// Position all cards absolutely
		cards.forEach((card, index) => {
			Object.assign(card.style, {
				position: 'absolute',
				top: 0,
				left: 0,
				width: '100%',
				zIndex: index + 1,
			});
			gsap.set(card, {
				yPercent: index === 0 ? 0 : 100, // First card is visible; others below
			});
		});

		// ScrollTrigger timeline
		const tl = gsap.timeline({
			scrollTrigger: {
				trigger: container,
				start: 'top top',
				end: `+=${(cards.length - 1) * window.innerHeight * 0.9}`, // control scroll length
				pin: true,
				scrub: 1.2,
				invalidateOnRefresh: true,
				// markers: true,
			},
		});

		// Animate each card from 2nd onwards
		cards.slice(1).forEach((card, i) => {
			tl.to(
				card,
				{
					yPercent: 0,
					duration: 1,
					ease: 'none',
				},
				i,
			); // delay by index to make them stack one after another
		});

		window.addEventListener('resize', () => {
			ScrollTrigger.refresh();
			// Re-initialize if switching between mobile and desktop
			if (window.innerWidth <= 768 !== isMobile) {
				location.reload();
			}
		});
	});
};

export default CardSectionStacked;
