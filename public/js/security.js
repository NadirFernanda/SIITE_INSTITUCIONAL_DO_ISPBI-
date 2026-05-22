(function () {
    // 1. Bloquear menu de contexto (botão direito)
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault(); e.stopImmediatePropagation(); return false;
    }, true);

    // 2. Bloquear atalhos de teclado (fase de captura)
    var BLOCKED_KEYS    = ['F12'];
    var BLOCKED_CTRL    = ['u','s','p','i','j','k'];
    var BLOCKED_CTRLSH  = ['i','j','c','k'];

    function blockKeys(e) {
        var ctrlKey = e.ctrlKey || e.metaKey;
        var key = (e.key || '').toLowerCase();
        if (BLOCKED_KEYS.indexOf(e.key) !== -1) {
            e.preventDefault(); e.stopImmediatePropagation(); return false;
        }
        if (ctrlKey && BLOCKED_CTRL.indexOf(key) !== -1) {
            e.preventDefault(); e.stopImmediatePropagation(); return false;
        }
        if (ctrlKey && e.shiftKey && BLOCKED_CTRLSH.indexOf(key) !== -1) {
            e.preventDefault(); e.stopImmediatePropagation(); return false;
        }
    }

    document.addEventListener('keydown', blockKeys, true);
    document.addEventListener('keyup',   blockKeys, true);

    // 3. Detectar DevTools via console getter (Image id trick)
    var devOpen = false;
    var img = new Image();
    Object.defineProperty(img, 'id', {
        get: function () { devOpen = true; }
    });

    // 4. Detectar DevTools via tamanho da janela
    function checkSize() {
        var widthDiff  = window.outerWidth  - window.innerWidth;
        var heightDiff = window.outerHeight - window.innerHeight;
        if (widthDiff > 200 || heightDiff > 200) {
            document.documentElement.innerHTML = '';
            window.location.replace('/');
        }
    }

    setInterval(function () {
        devOpen = false;
        console.log('%c', img);
        console.clear();
        if (devOpen) {
            document.documentElement.innerHTML = '';
            window.location.replace('/');
        }
        checkSize();
    }, 800);

    // 5. Desactivar selecção de texto e arrastamento
    document.addEventListener('selectstart', function (e) { e.preventDefault(); }, true);
    document.addEventListener('dragstart',   function (e) { e.preventDefault(); }, true);
})();
