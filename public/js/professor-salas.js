(function(){
function updateFeedback() {
    const input = document.getElementById('notaInput');
    const feedback = document.getElementById('notaFeedback');
    if (!feedback || !input) return;

    const nota = parseFloat(input.value);
    if (isNaN(nota)) {
        feedback.style.display = 'none';
        return;
    }

    feedback.style.display = 'block';
    if (nota >= 10) {
        feedback.style.background = '#f0fdf4';
        feedback.style.color = '#15803d';
        feedback.style.borderLeft = '4px solid #22c55e';
        feedback.textContent = `✓ APROVADO (${nota.toFixed(1)}/20)`;
    } else {
        feedback.style.background = '#fff5f5';
        feedback.style.color = '#dc2626';
        feedback.style.borderLeft = '4px solid #ef4444';
        feedback.textContent = `✗ REPROVADO (${nota.toFixed(1)}/20)`;
    }
}

window.openModal = function(candidaturaId, codigoExame, notaAtual) {
    const codigoElem = document.getElementById('codigoExame');
    const notaInput = document.getElementById('notaInput');
    const notaForm = document.getElementById('notaForm');
    const notaModal = document.getElementById('notaModal');

    if (codigoElem) codigoElem.textContent = codigoExame;
    if (notaInput) notaInput.value = notaAtual || '';
    if (notaForm) {
        notaForm.action = '/professor/candidaturas/' + candidaturaId + '/nota';
        // populate redirect input with sala id (if present)
        const redirectInput = document.getElementById('redirectInput');
        if (redirectInput && notaModal && notaModal.dataset && notaModal.dataset.salaId) {
            redirectInput.value = notaModal.dataset.salaId;
        }
    }
    if (notaModal) notaModal.style.display = 'flex';
    if (notaInput) notaInput.focus();
    updateFeedback();
};

window.closeModal = function() {
    const notaModal = document.getElementById('notaModal');
    const notaForm = document.getElementById('notaForm');
    if (notaModal) notaModal.style.display = 'none';
    if (notaForm) notaForm.reset();
};

// DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

function init() {
    const notaInput = document.getElementById('notaInput');
    if (notaInput) notaInput.addEventListener('input', updateFeedback);

    // Attach to buttons that open the modal (data attributes used to avoid inline handlers)
    document.querySelectorAll('.openNotaBtn').forEach(function(btn){
        btn.addEventListener('click', function(){
            const id = this.dataset.candidaturaId;
            const codigo = this.dataset.codigoExame;
            const nota = this.dataset.nota === '' ? null : this.dataset.nota;
            window.openModal(id, codigo, nota);
        });
    });

    // Cancel button inside modal
    const notaCancel = document.getElementById('notaCancel');
    if (notaCancel) notaCancel.addEventListener('click', function(e){ e.preventDefault(); closeModal(); });

    const notaModal = document.getElementById('notaModal');
    if (notaModal) {
        notaModal.addEventListener('click', function(event){
            if (event.target === this) closeModal();
        });
    }

    document.addEventListener('keydown', function(event){
        if (event.key === 'Escape') closeModal();
    });
}

})();
