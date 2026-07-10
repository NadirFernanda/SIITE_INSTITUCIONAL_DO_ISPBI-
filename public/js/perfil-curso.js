(function () {
    'use strict';

    var configs = [
        { perfilId: 'perfil-select', cursoId: 'curso-select' },
        { perfilId: 'tc-perfil',     cursoId: 'tc-curso'     },
        { perfilId: 'edit-perfil',   cursoId: 'edit-curso'   },
    ];

    function initConfig(cfg) {
        var perfilEl = document.getElementById(cfg.perfilId);
        var cursoEl  = document.getElementById(cfg.cursoId);
        if (!perfilEl || !cursoEl) return;

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

        // Cursos sem restrição de perfil (Engenharia Civil, etc.)
        var cursosLivres = allCursos.filter(function (c) {
            return !perfisCurso[c] || perfisCurso[c].length === 0;
        });

        function updateCursos() {
            var perfil  = perfilEl.value;
            var current = cursoEl.value;

            cursoEl.innerHTML = '';
            var ph = document.createElement('option');
            ph.value = '';

            if (!perfil) {
                ph.textContent = '— Seleccione primeiro o seu perfil acima —';
                cursoEl.appendChild(ph);
                return;
            }

            ph.textContent = '— Seleccione o curso —';
            cursoEl.appendChild(ph);

            var eligible = cursosLivres.slice();
            (cursoPorPerfil[perfil] || []).forEach(function (c) {
                if (eligible.indexOf(c) === -1) eligible.push(c);
            });

            allCursos.forEach(function (c) {
                if (eligible.indexOf(c) !== -1) {
                    var o = document.createElement('option');
                    o.value = c;
                    o.textContent = c;
                    if (c === (current || oldCurso)) o.selected = true;
                    cursoEl.appendChild(o);
                }
            });
        }

        perfilEl.addEventListener('change', updateCursos);
        updateCursos();
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
