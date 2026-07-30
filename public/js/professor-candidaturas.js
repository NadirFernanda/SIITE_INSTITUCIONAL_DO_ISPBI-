(function(){

function fmt(n){ return Number.isFinite(n) ? n.toFixed(2) : '0.00'; }

function computeWeights(){
    const inputs = Array.from(document.querySelectorAll('.disc-nota-input'));
    if (!inputs.length) return;

    let sum = 0.0;
    let totalWeight = 0;
    inputs.forEach(inp => {
        const w = parseInt(inp.dataset.weight || '0', 10) || 0;
        totalWeight += w;
        const val = parseFloat(inp.value);
        if (!isNaN(val)) {
            sum += val;
        }
    });

    const totalWeightEl = document.getElementById('totalWeight');
    const weightWarning = document.getElementById('weightWarning');
    if (totalWeightEl) totalWeightEl.textContent = totalWeight + '%';
    if (weightWarning) weightWarning.style.display = (totalWeight !== 100) ? 'inline' : 'none';

    const computedValueEl = document.getElementById('computedWeightedValue');
    const computedStatusEl = document.getElementById('computedWeightedStatus');
    const computedBox = document.getElementById('computedWeightedBox');
    if (computedValueEl) computedValueEl.innerHTML = fmt(sum) + '<span style="font-size:0.9rem;color:#94a3b8;">/20</span>';
    if (computedStatusEl) {
        computedStatusEl.textContent = sum >= 10 ? 'APROVADO (pela soma ponderada)' : 'REPROVADO (pela soma ponderada)';
        computedStatusEl.style.color = sum >= 10 ? '#15803d' : '#dc2626';
    }
    if (computedBox) {
        computedBox.style.background = sum >= 10 ? '#f0fdf4' : '#fff5f5';
        computedBox.style.border = '1px solid ' + (sum >= 10 ? '#86efac' : '#fca5a5');
    }
}

function init(){
    const inputs = Array.from(document.querySelectorAll('.disc-nota-input'));
    inputs.forEach(inp => inp.addEventListener('input', computeWeights));
    computeWeights();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}

})();