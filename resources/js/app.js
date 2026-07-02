import './bootstrap';

import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
window.Chart = Chart;

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

	// ── Smooth scroll for implementation-phase cards on cursos-online page ──
	const faseCards = document.querySelectorAll('.fase-card');
	faseCards.forEach(card => {
		card.addEventListener('click', () => card.scrollIntoView({ behavior: 'smooth', block: 'start' }));
		card.addEventListener('keypress', e => {
			if (e.key === 'Enter' || e.key === ' ') card.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});
	});

	// ── Alerts subscription form (trabalhe-conosco page) ──
	const alertsForm = document.getElementById('alerts-form');
	const alertsMessages = document.getElementById('alerts-messages');
	if (alertsForm && alertsMessages) {
		function showAlertMsg(text, isError = false) {
			alertsMessages.textContent = text;
			alertsMessages.classList.remove('hidden');
			alertsMessages.classList.toggle('text-red-600', isError);
			alertsMessages.classList.toggle('text-green-600', !isError);
		}
		alertsForm.addEventListener('submit', function (e) {
			if (!window.fetch) return;
			e.preventDefault();
			const submitBtn = document.getElementById('alerts-submit');
			if (submitBtn) { submitBtn.disabled = true; submitBtn.classList.add('opacity-60'); }
			const formData = new FormData(alertsForm);
			const tokenInput = alertsForm.querySelector('input[name="_token"]');
			const headers = { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' };
			if (tokenInput) headers['X-CSRF-TOKEN'] = tokenInput.value;

			function clearFieldErrors() {
				alertsForm.querySelectorAll('.field-error-msg').forEach(el => el.remove());
				alertsForm.querySelectorAll('.field-error').forEach(el => {
					el.classList.remove('field-error', 'border-red-600');
				});
			}
			function showFieldErrors(errors) {
				let firstInput = null;
				Object.keys(errors).forEach(function (field) {
					const msgs = errors[field];
					let input = alertsForm.querySelector('[name="' + field + '"]') || alertsForm.querySelector('[name="' + field + '[]"]');
					if (!input) {
						const els = alertsForm.querySelectorAll('[name^="' + field.replace(/\[\]$/, '') + '"]');
						if (els.length) input = els[0];
					}
					if (input) {
						if (!firstInput) firstInput = input;
						input.classList.add('border-red-600', 'field-error');
						const msg = document.createElement('p');
						msg.className = 'field-error-msg text-sm text-red-600 mt-1';
						msg.innerText = msgs.join(' ');
						(input.closest('div') || input.parentNode).appendChild(msg);
					}
				});
				if (firstInput) {
					try { firstInput.focus({ preventScroll: true }); } catch (_) { try { firstInput.focus(); } catch (_) {} }
					try { firstInput.scrollIntoView({ behavior: 'smooth', block: 'center' }); } catch (_) {}
				}
			}

			clearFieldErrors();
			fetch(alertsForm.action, { method: 'POST', headers, body: formData, credentials: 'same-origin' })
				.then(res => { if (!res.ok) throw res; return res.json(); })
				.then(() => { clearFieldErrors(); showAlertMsg('Inscrição recebida. Obrigado por subscrever os alertas.'); alertsForm.reset(); })
				.catch(err => {
					if (err.json) {
						err.json().then(j => {
							clearFieldErrors();
							if (j.errors) { showFieldErrors(j.errors); showAlertMsg(j.message || 'Por favor verifique os campos destacados.', true); }
							else showAlertMsg(j.message || 'Erro ao enviar. Tente novamente.', true);
						}).catch(() => showAlertMsg('Erro ao enviar. Tente novamente.', true));
					} else showAlertMsg('Erro ao enviar. Tente novamente.', true);
				})
				.finally(() => { if (submitBtn) { submitBtn.disabled = false; submitBtn.classList.remove('opacity-60'); } });
		});
	}

	// ── Revista submission form client-side validation ──
	const revistaForm = document.getElementById('revista-form');
	if (revistaForm) {
		const labels = { author: 'Autor', email: 'Email de contacto', affiliation: 'Filiação', category: 'Categoria', title: 'Título', description: 'Descrição', link: 'Link', notes: 'Observações' };
		const locale = (window.RevistaLocale || {});
		const msgs = locale.messages || {};

		Object.keys(labels).forEach(name => {
			const el = revistaForm.elements[name];
			if (!el) return;
			el.addEventListener('input', () => el.setCustomValidity(''));
			el.addEventListener('change', () => el.setCustomValidity(''));
		});

		revistaForm.addEventListener('submit', function (e) {
			const errors = [];
			let firstField = null, firstMessage = null;
			Object.keys(labels).forEach(name => {
				const el = revistaForm.elements[name];
				if (!el) return;
				const val = (el.value || '').trim();
				if (['author', 'email', 'title', 'description', 'link'].includes(name) && !val) {
					const msg = msgs.required ? msgs.required(labels[name]) : `Por favor, preencha o campo "${labels[name]}".`;
					errors.push(msg);
					if (!firstField) { firstField = el; firstMessage = msg; }
					return;
				}
				if (val) {
					if (name === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val)) {
						const msg = msgs.invalidEmail || 'Por favor, introduza um endereço de email válido.';
						errors.push(msg);
						if (!firstField) { firstField = el; firstMessage = msg; }
					}
					if (name === 'link') {
						try { new URL(val); } catch (_) {
							const msg = msgs.invalidURL || 'Por favor, introduza um URL válido.';
							errors.push(msg);
							if (!firstField) { firstField = el; firstMessage = msg; }
						}
					}
				}
			});
			const clientErrors = document.getElementById('client-errors');
			if (errors.length) {
				e.preventDefault();
				if (clientErrors) {
					clientErrors.innerHTML = '<strong>' + (msgs.occurred || 'Ocorreram erros:') + '</strong><ul class="mt-2 list-disc list-inside">' + errors.map(i => '<li>' + i + '</li>').join('') + '</ul>';
					clientErrors.classList.remove('hidden');
				}
				if (firstField && firstMessage && typeof firstField.reportValidity === 'function') {
					firstField.setCustomValidity(firstMessage);
					firstField.reportValidity();
					firstField.focus();
				}
				if (clientErrors) clientErrors.scrollIntoView({ behavior: 'smooth', block: 'center' });
			} else {
				if (clientErrors) clientErrors.classList.add('hidden');
				Object.keys(labels).forEach(name => { const el = revistaForm.elements[name]; if (el) el.setCustomValidity(''); });
			}
		});
	}
});
