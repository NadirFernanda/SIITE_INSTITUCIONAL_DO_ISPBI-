import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Fechar dropdowns do navbar ao clicar fora (independente da versão do Alpine)
document.addEventListener('click', function (e) {
    if (e.target.closest('[data-dd]')) return; // clique dentro de um dropdown — ignorar
    const header = document.querySelector('header[x-data]');
    if (!header || !window.Alpine) return;
    try {
        const d = window.Alpine.$data(header);
        d.openInfra = false;
        d.openInst  = false;
        d.openExt   = false;
    } catch (_) {}
});

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
			const suffix = el.getAttribute('data-suffix') || '';

			const step = (now) => {
				const progress = Math.min((now - startTime) / duration, 1);
				const value = Math.floor(start + (target - start) * progress);
				el.textContent = value.toLocaleString('pt-PT') + suffix;

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
