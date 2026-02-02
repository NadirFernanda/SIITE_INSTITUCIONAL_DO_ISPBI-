import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Animações leves de entrada no scroll para elementos marcados com a classe .scroll-reveal
document.addEventListener('DOMContentLoaded', () => {
	// Scroll reveal
	const revealEls = document.querySelectorAll('.scroll-reveal');
	if (revealEls.length && typeof window.IntersectionObserver !== 'undefined') {
		const revealObserver = new IntersectionObserver((entries, obs) => {
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

		revealEls.forEach(el => revealObserver.observe(el));
	}

	// Animação de contagem para estatísticas (ISP-Bié em números)
	const counters = document.querySelectorAll('[data-counter][data-target]');
	if (counters.length && typeof window.IntersectionObserver !== 'undefined') {
		const animateCounter = (el, target, duration = 1500) => {
			const start = 0;
			const startTime = performance.now();

			const step = (now) => {
				const progress = Math.min((now - startTime) / duration, 1);
				const value = Math.floor(start + (target - start) * progress);
				el.textContent = value.toLocaleString('pt-PT');

				if (progress < 1) {
					requestAnimationFrame(step);
				}
			};

			requestAnimationFrame(step);
		};

		const counterObserver = new IntersectionObserver((entries, obs) => {
			entries.forEach(entry => {
				if (!entry.isIntersecting) return;

				const el = entry.target;
				const rawTarget = el.getAttribute('data-target');
				if (!rawTarget) {
					obs.unobserve(el);
					return;
				}

				const numeric = parseFloat(
					rawTarget
						.replace(/\s+/g, '') // remove espaços
						.replace(',', '.')   // vírgula para decimal
				);

				if (!Number.isFinite(numeric)) {
					obs.unobserve(el);
					return;
				}

				const durationAttr = parseInt(el.getAttribute('data-duration') || '1500', 10);
				const duration = Number.isFinite(durationAttr) ? durationAttr : 1500;

				animateCounter(el, numeric, duration);
				obs.unobserve(el);
			});
		}, {
			threshold: 0.4,
			rootMargin: '0px 0px -10% 0px',
		});

		counters.forEach(el => counterObserver.observe(el));
	}
});
