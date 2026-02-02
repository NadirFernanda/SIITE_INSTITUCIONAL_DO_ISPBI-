import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Animações leves de entrada no scroll para elementos marcados com a classe .scroll-reveal
document.addEventListener('DOMContentLoaded', () => {
	const revealEls = document.querySelectorAll('.scroll-reveal');
	if (!revealEls.length || typeof window.IntersectionObserver === 'undefined') {
		return;
	}

	const observer = new IntersectionObserver((entries, obs) => {
		entries.forEach(entry => {
			if (entry.isIntersecting) {
				entry.target.classList.add('is-visible');
				obs.unobserve(entry.target);
			}
		});
	}, {
		threshold: 0.12,
		rootMargin: '0px 0px -10% 0px',
	});

	revealEls.forEach(el => observer.observe(el));
});
