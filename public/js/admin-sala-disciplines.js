document.addEventListener('DOMContentLoaded', function () {
    const addBtn = document.getElementById('add-disc');
    const list = document.getElementById('disciplines-list');
    const form = document.getElementById('sala-disciplines-form');
    const allMsg = document.getElementById('all-linked-msg');

    const course = Array.isArray(window.COURSE_DISCIPLINES) ? window.COURSE_DISCIPLINES : [];
    const existing = Array.isArray(window.EXISTING_DISCIPLINES) ? window.EXISTING_DISCIPLINES.map(s => (s||'').trim()) : [];

    function getCurrentSelected() {
        const rows = Array.from(document.querySelectorAll('.disc-row'));
        const used = new Set();
        rows.forEach(r => {
            const sel = r.querySelector('select[name="disciplines[][discipline]"]');
            const inp = r.querySelector('input[name="disciplines[][discipline]"]');
            const val = sel ? sel.value.trim() : (inp ? inp.value.trim() : '');
            if (val) used.add(val);
        });
        return used;
    }

    function updateUIState() {
        if (course.length === 0) return; // nothing to do for free-text
        const used = getCurrentSelected();
        const available = course.map(c => c.discipline).filter(d => !used.has(d));
        if (available.length === 0) {
            if (addBtn) addBtn.style.display = 'none';
            if (allMsg) allMsg.style.display = 'inline-block';
        } else {
            if (addBtn) addBtn.style.display = '';
            if (allMsg) allMsg.style.display = 'none';
        }
        // disable options already used in all selects
        document.querySelectorAll('select[name="disciplines[][discipline]"]').forEach(sel => {
            Array.from(sel.options).forEach(opt => {
                if (!opt.value) return;
                opt.disabled = used.has(opt.value) && sel.value !== opt.value; // allow selected option
            });
        });
    }

    function makeRow(name = '', weight = '0') {
        const row = document.createElement('div');
        row.className = 'disc-row';
        row.style = 'display:flex;gap:8px;align-items:center;';

        let inputName;
        if (course.length > 0) {
            inputName = document.createElement('select');
            inputName.name = 'disciplines[][discipline]';
            inputName.style = 'flex:1;padding:8px;border-radius:6px;border:1px solid #e5e7eb;';

            const emptyOpt = document.createElement('option');
            emptyOpt.value = '';
            emptyOpt.innerText = '— Seleccione disciplina —';
            inputName.appendChild(emptyOpt);

            const used = getCurrentSelected();

            course.forEach(cd => {
                // include option if not used OR if it's the current name (for editing existing rows)
                if (!used.has(cd.discipline) || cd.discipline === name) {
                    const opt = document.createElement('option');
                    opt.value = cd.discipline;
                    opt.innerText = cd.discipline + ' — ' + cd.weight + '%';
                    if (cd.discipline === name) opt.selected = true;
                    inputName.appendChild(opt);
                }
            });

            inputName.addEventListener('change', function () {
                updateUIState();
            });
        } else {
            inputName = document.createElement('input');
            inputName.type = 'text';
            inputName.name = 'disciplines[][discipline]';
            inputName.placeholder = 'Nome da disciplina';
            inputName.value = name;
            inputName.style = 'flex:1;padding:8px;border-radius:6px;border:1px solid #e5e7eb;';
        }

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
        remove.addEventListener('click', function () {
            row.remove();
            updateUIState();
        });

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
            r.scrollIntoView({ behavior: 'smooth', block: 'center' });
            updateUIState();
        });
    }

    // wire existing rows: for selects attach change listeners and ensure remove works
    document.querySelectorAll('.disc-row').forEach(row => {
        const sel = row.querySelector('select[name="disciplines[][discipline]"]');
        const remove = row.querySelector('.remove-disc');
        if (sel) {
            sel.addEventListener('change', updateUIState);
        }
        if (remove) {
            remove.addEventListener('click', function () { row.remove(); updateUIState(); });
        }
    });

    // initial populate: if there are no rows and course disciplines exist, add one empty select
    if (document.querySelectorAll('.disc-row').length === 0) {
        const r = makeRow('', '0');
        list.appendChild(r);
    }

    // mark existing from server-provided list: if existing items present but not rendered, add them
    existing.forEach(name => {
        // if a rendered row already has this name, skip
        const found = Array.from(document.querySelectorAll('.disc-row')).some(r => {
            const sel = r.querySelector('select[name="disciplines[][discipline]"]');
            const inp = r.querySelector('input[name="disciplines[][discipline]"]');
            const val = sel ? sel.value.trim() : (inp ? inp.value.trim() : '');
            return val === name;
        });
        if (!found) {
            // find weight from course list if available
            const cd = course.find(c => c.discipline === name);
            const w = cd ? cd.weight : '0';
            const r = makeRow(name, w);
            list.appendChild(r);
        }
    });

    updateUIState();

    // validate duplicates before submit
    if (form) {
        form.addEventListener('submit', function (e) {
            const rows = Array.from(document.querySelectorAll('.disc-row'));
            const vals = rows.map(r => {
                const sel = r.querySelector('select[name="disciplines[][discipline]"]');
                const inp = r.querySelector('input[name="disciplines[][discipline]"]');
                return (sel ? sel.value : (inp ? inp.value : '')).trim();
            }).filter(Boolean);
            const set = new Set(vals);
            if (set.size !== vals.length) {
                e.preventDefault();
                alert('Existem disciplinas repetidas. Remova duplicados antes de gravar.');
                return false;
            }
        });
    }

});
