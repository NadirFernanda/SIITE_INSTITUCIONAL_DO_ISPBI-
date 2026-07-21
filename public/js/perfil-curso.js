(function () {
    'use strict';

    var configs = [
        { perfilId: 'perfil-select', cursoId: 'curso-select', infoId: 'perfil-select-info' },
        { perfilId: 'tc-perfil',     cursoId: 'tc-curso',     infoId: 'tc-perfil-info'     },
        { perfilId: 'edit-perfil',   cursoId: 'edit-curso',   infoId: 'edit-perfil-info'   },
    ];

    function initConfig(cfg) {
        var perfilEl = document.getElementById(cfg.perfilId);
        var cursoEl  = document.getElementById(cfg.cursoId);
        if (!perfilEl || !cursoEl) return;

        var infoEl = cfg.infoId ? document.getElementById(cfg.infoId) : null;

        var perfisCurso = JSON.parse(perfilEl.getAttribute('data-perfis-curso') || '{}');
        var allCursos   = JSON.parse(perfilEl.getAttribute('data-todos-cursos')  || '[]');
        var oldCurso    = cursoEl.getAttribute('data-old-value') || '';

        // Mapa inverso: perfil → [cursos elegíveis]
        var cursoPorPerfil = {};
        for (var curso in perfisCurso) {
            if (Object.prototype.hasOwnProperty.call(perfisCurso, curso)) {
                (perfisCurso[curso] || []).forEach(function (p) {
                    if (!cursoPorPerfil[p]) cursoPorPerfil[p] = [];
                    cursoPorPerfil[p].push(curso);
                });
            }
        }

        function updateCursos() {
            var perfil  = perfilEl.value;
            var current = cursoEl.value;

            // Cursos elegíveis para este perfil
            var eligible = (cursoPorPerfil[perfil] || []).slice();

            // Mensagem informativa
            if (infoEl) {
                if (perfil && perfil === 'Outro') {
                    infoEl.innerHTML = '<strong>Atenção:</strong> o seu perfil não está listado. Deve dirigir-se à instituição para confirmação do processo de candidatura.';
                    infoEl.style.display = 'block';
                } else if (perfil && eligible.length > 0) {
                    var lista = eligible.join(', ');
                    infoEl.innerHTML = '<strong>O seu perfil permite candidatar-se ao(s) curso(s):</strong> ' + lista + '.';
                    infoEl.style.display = 'block';
                } else if (perfil && eligible.length === 0) {
                    infoEl.innerHTML = '<strong>Atenção:</strong> não foram encontrados cursos compatíveis com este perfil. Se o seu curso não aparecer nesta lista, deve dirigir-se à instituição para confirmação do processo de candidatura.';
                    infoEl.style.display = 'block';
                } else {
                    infoEl.style.display = 'none';
                }
            }

            // Actualiza o select de cursos
            cursoEl.innerHTML = '';
            var ph = document.createElement('option');
            ph.value = '';

            if (!perfil) {
                ph.textContent = '— Seleccione primeiro o seu perfil acima —';
                cursoEl.appendChild(ph);
                return;
            }

            // Se o perfil for 'Outro', permitir a opção 'Outro' no curso para submissão
            if (perfil === 'Outro') {
                ph.textContent = '— O seu perfil não está listado — seleccione "Outro" abaixo —';
                cursoEl.appendChild(ph);
                var outroOption = document.createElement('option');
                outroOption.value = 'Outro';
                outroOption.textContent = 'Outro — Perfil não listado';
                if ((current || oldCurso) === 'Outro') outroOption.selected = true;
                cursoEl.appendChild(outroOption);
                // Actualizar observações
                setObservacoesVal();
                return;
            }

            ph.textContent = eligible.length === 0
                ? '— O seu curso não está aqui? Dirija-se à instituição —'
                : (eligible.length === 1 ? '— Confirme o curso abaixo —' : '— Seleccione o curso —');
            cursoEl.appendChild(ph);

            allCursos.forEach(function (c) {
                if (eligible.indexOf(c) !== -1) {
                    var o = document.createElement('option');
                    o.value = c;
                    o.textContent = c;
                    if (c === (current || oldCurso)) o.selected = true;
                    cursoEl.appendChild(o);
                }
            });

            // Se não houver cursos elegíveis, adicionar opção "Outro" para permitir submissão
            if (eligible.length === 0) {
                var outroOption = document.createElement('option');
                outroOption.value = 'Outro';
                outroOption.textContent = 'Outro — Dirija-se à instituição para confirmação';
                if ((current || oldCurso) === 'Outro') outroOption.selected = true;
                cursoEl.appendChild(outroOption);
            }

            // Se só há um curso elegível, seleccioná-lo automaticamente
            if (eligible.length === 1 && cursoEl.options.length === 2) {
                cursoEl.options[1].selected = true;
            }

            // Actualizar campo de observações se existir
            setObservacoesVal();
        }

        // Campo de observações (oculto) — preenchido automaticamente quando curso === 'Outro'
        var obsEl = document.getElementById('observacoes-input');
        function setObservacoesVal() {
            if (!obsEl) return;
            // Se o perfil for Outro, preencher observações sobre perfil; se o curso for Outro, preencher sobre curso
            if (perfilEl.value === 'Outro') {
                obsEl.value = 'Perfil não listado; candidato orientado a dirigir-se à instituição';
                return;
            }
            if (cursoEl.value === 'Outro') {
                obsEl.value = 'Curso não listado; candidato orientado a dirigir-se à instituição';
                return;
            }
            // Não sobrepor observações manualmente preenchidas; limpar apenas se foi preenchido pela regra
            if (obsEl.value && (obsEl.value.indexOf('Curso não listado') === 0 || obsEl.value.indexOf('Perfil não listado') === 0)) {
                obsEl.value = '';
            }
        }

        perfilEl.addEventListener('change', updateCursos);
        updateCursos();
        // Also ensure observacoes updates when the curso select changes (user may pick 'Outro')
        cursoEl.addEventListener && cursoEl.addEventListener('change', function () {
            try { setObservacoesVal(); } catch (e) { /* ignore */ }
        });
    }

    function init() {
        configs.forEach(initConfig);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
