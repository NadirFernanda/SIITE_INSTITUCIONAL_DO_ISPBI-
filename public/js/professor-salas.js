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

    // Read sala disciplines from JSON script element (avoids inline script CSP issues)
    let salaDisc = null;
    try {
        const sdElem = document.getElementById('sala-disciplines');
        const sdJson = sdElem ? sdElem.textContent : null;
        const sdArr = sdJson ? JSON.parse(sdJson) : [];
        salaDisc = Array.isArray(sdArr) && sdArr.length > 0 ? sdArr : null;
    } catch (e) {
        console.error('Failed to parse sala-disciplines JSON', e);
        salaDisc = null;
    }
    if (salaDisc) {
        // hide single nota input
        const single = document.getElementById('singleNotaContainer');
        const discCont = document.getElementById('disciplinasContainer');
        const discList = document.getElementById('disciplinasList');
        if (single) single.style.display = 'none';
        if (discCont) discCont.style.display = '';
        if (discList) {
            discList.innerHTML = '';
            salaDisc.forEach(d => {
                const wrapper = document.createElement('div');
                wrapper.style = 'border:1px solid #e6f6f6;border-radius:8px;padding:8px;';
                const label = document.createElement('div');
                label.style = 'font-size:0.78rem;font-weight:700;color:#0f172a;margin-bottom:6px;';
                label.innerText = d.discipline + ' — ' + d.weight + '%';
                const input = document.createElement('input');
                input.type = 'number';
                input.name = 'notas[' + d.discipline + ']';
                input.min = 0; input.max = 20; input.step = '0.01';
                input.style = 'width:100%;padding:8px;border-radius:6px;border:1px solid #e2fdfa;font-weight:700;text-align:center;';
                input.value = '';
                wrapper.appendChild(label);
                wrapper.appendChild(input);
                discList.appendChild(wrapper);
            });
        }
        // set form action to notas-disciplinas route
        if (notaForm) notaForm.action = '/professor/candidaturas/' + candidaturaId + '/notas-disciplinas';
    } else {
        if (notaInput) notaInput.value = notaAtual || '';
        if (notaForm) {
            notaForm.action = '/professor/candidaturas/' + candidaturaId + '/nota';
            // populate redirect input with sala id (if present)
            const redirectInput = document.getElementById('redirectInput');
            if (redirectInput && notaModal && notaModal.dataset && notaModal.dataset.salaId) {
                redirectInput.value = notaModal.dataset.salaId;
            }
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
