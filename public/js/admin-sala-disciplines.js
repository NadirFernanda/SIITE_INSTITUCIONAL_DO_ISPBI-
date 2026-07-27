document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-disc');
    const list = document.getElementById('disciplines-list');

    function makeRow(name = '', weight = '0') {
        const row = document.createElement('div');
        row.className = 'disc-row';
        row.style = 'display:flex;gap:8px;align-items:center;';

        const inputName = document.createElement('input');
        inputName.type = 'text';
        inputName.name = 'disciplines[][discipline]';
        inputName.placeholder = 'Nome da disciplina';
        inputName.value = name;
        inputName.style = 'flex:1;padding:8px;border-radius:6px;border:1px solid #e5e7eb;';

        const inputWeight = document.createElement('input');
        inputWeight.type = 'number';
        inputWeight.name = 'disciplines[][weight]';
        inputWeight.min = 0;
        inputWeight.max = 100;
        inputWeight.value = weight;
        inputWeight.style = 'width:110px;padding:8px;border-radius:6px;border:1px solid #e5e7eb;text-align:center;';

        const remove = document.createElement('button');
        remove.type = 'button';
        remove.className = 'remove-disc';
        remove.innerText = 'Remover';
        remove.style = 'background:#fee2e2;border:none;padding:8px 10px;border-radius:6px;color:#b91c1c;cursor:pointer;';
        remove.addEventListener('click', () => row.remove());

        row.appendChild(inputName);
        row.appendChild(inputWeight);
        row.appendChild(remove);

        return row;
    }

    if (addBtn) {
        addBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const r = makeRow('', '0');
            list.appendChild(r);
            // scroll into view
            r.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    }

    // wire existing remove buttons
    document.querySelectorAll('.remove-disc').forEach(b => b.addEventListener('click', function () {
        const row = this.closest('.disc-row');
        if (row) row.remove();
    }));
});
