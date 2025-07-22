const Wavy = () => {
	window.addEventListener('load', function () {
		console.log('Wavy animation initializing...');

		// Check if GSAP is loaded
		if (typeof gsap === 'undefined') {
			console.error('GSAP not loaded!');
			return;
		}

		// Get elements
		const mainPath = document.querySelector('#wavyPath');
		const textPaths = document.querySelectorAll('.text-path-element');

		if (!mainPath || textPaths.length === 0) {
			console.error('Required elements not found!');
			return;
		}

		const bottles = document.querySelectorAll('.bottle-svg');

		console.log(`Found ${textPaths.length} text elements to animate`);

		// Get path length and viewport width
		const pathLength = mainPath.getTotalLength();
		const svg = document.querySelector('.wavy-svg');
		const viewportWidth = svg.viewBox.baseVal.width;
		console.log('Path length:', pathLength, 'Viewport:', viewportWidth);

		// Calculate item spacing
		const uniqueItems = textPaths.length / 3; // We have 3 sets
		const itemSpacing = 25; // Percentage spacing between items

		// Position and animate each text/bottle pair
		textPaths.forEach((textPath, index) => {
			const bottle = bottles[index];

			// Calculate initial offset for even distribution
			const initialOffset = index * itemSpacing - 50; // Start some items off-screen

			// Set initial position
			gsap.set(textPath, {
				attr: { startOffset: `${initialOffset}%` },
			});

			// Show bottle
			if (bottle) {
				bottle.classList.add('active');
			}

			// Create continuous animation
			gsap.to(textPath, {
				attr: {
					startOffset: `${initialOffset + 150}%`, // Move beyond viewport
				},
				duration: 25, // Adjust speed
				repeat: -1,
				ease: 'none',
				onUpdate() {
					if (!bottle) return;

					// Get current text position
					const currentOffset = parseFloat(textPath.getAttribute('startOffset'));

					// Hide elements that are too far off screen
					if (currentOffset < -50 || currentOffset > 120) {
						gsap.set(textPath.parentElement, { opacity: 0 });
						gsap.set(bottle, { opacity: 0 });
						return;
					}
					gsap.set(textPath.parentElement, { opacity: 1 });
					gsap.set(bottle, { opacity: 1 });

					// Calculate text metrics
					const textElement = textPath.parentElement;
					const bbox = textElement.getBBox();
					const textLength = textElement.getComputedTextLength();

					// Position bottle after text with small gap
					const gap = 20;
					const bottleOffsetPercent =
						currentOffset + ((textLength + gap) / pathLength) * 100;
					const bottlePosition = (bottleOffsetPercent / 100) * pathLength;

					// Get point on path for bottle
					if (bottlePosition >= 0 && bottlePosition <= pathLength) {
						const point = mainPath.getPointAtLength(bottlePosition);

						// Calculate angle for natural rotation
						const angleOffset = 5;
						const p1 = mainPath.getPointAtLength(
							Math.max(0, bottlePosition - angleOffset),
						);
						const p2 = mainPath.getPointAtLength(
							Math.min(pathLength, bottlePosition + angleOffset),
						);
						const angle = (Math.atan2(p2.y - p1.y, p2.x - p1.x) * 180) / Math.PI;

						// Position bottle
						gsap.set(bottle, {
							attr: {
								x: point.x - 40, // Center horizontally
								y: point.y - 60, // Adjust vertical position
							},
							rotation: angle - 90, // Adjust for bottle orientation
							transformOrigin: 'center center',
						});
					}
				},
			});

			// Add subtle bottle animation
			if (bottle) {
				gsap.to(bottle, {
					rotation: '+=5',
					scale: 1.05,
					duration: 2,
					repeat: -1,
					yoyo: true,
					ease: 'power1.inOut',
					transformOrigin: 'center bottom',
					delay: index * 0.2,
				});
			}
		});

		console.log('Animation setup complete');
	});
};

export default Wavy;
