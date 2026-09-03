(function () {
    'use strict';

    function actualizar(select) {
        var sexo = document.querySelector('input[name="sexo"]:checked');
        var curso = document.querySelector('select[name="curso"]');
        var steam = Array.prototype.find.call(select.options, function (option) {
            return option.value.toLowerCase().trim() === 'áreas steam';
        });
        if (!steam) return;

        var cursoValido = curso && [
            'engenharia informática',
            'engenharia em recursos hídricos'
        ].indexOf(curso.value.toLowerCase().trim()) !== -1;
        var permitido = sexo && sexo.value === 'feminino' && cursoValido;

        steam.disabled = !permitido;
        if (!permitido && select.value === steam.value) {
            select.value = 'Nenhuma';
        }
    }

    function iniciar() {
        var select = document.querySelector('select[name="necessidade_especial"]');
        if (!select) return;

        document.querySelectorAll('input[name="sexo"], select[name="curso"]')
            .forEach(function (element) {
                element.addEventListener('change', function () {
                    actualizar(select);
                });
            });
        actualizar(select);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', iniciar);
    } else {
        iniciar();
    }
})();
