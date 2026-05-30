(function () {
    var ANGOLA = {
        'Bengo':           ['Ambriz','Bula Atumba','Dande','Dembos','Nambuangongo','Pango Aluquém'],
        'Benguela':        ['Baía Farta','Balombo','Benguela','Bocoio','Chongoroi','Cubal','Ganda','Lobito','Nharea'],
        'Bié':             ['Andulo','Camacupa','Catabola','Chinguar','Chitembo','Cuemba','Cunhinga','Kuito','Nharea'],
        'Cabinda':         ['Belize','Buco-Zau','Cabinda','Cacongo'],
        'Cuando Cubango':  ['Calai','Cuangar','Cuchi','Cuito Cuanavale','Dirico','Longa','Mavinga','Menongue','Nancova','Rivungo'],
        'Cuanza Norte':    ['Ambaca','Banga','Bolongongo','Cambambe','Cazengo','Golungo Alto','Gonguembo','Lucala','Quiculungo','Samba Caju'],
        'Cuanza Sul':      ['Amboim','Cassongue','Cela','Conda','Ebo','Kibala','Kilenda','Libolo','Mussende','Porto Amboim','Quibala','Quilenda','Seles','Sumbe'],
        'Cunene':          ['Cahama','Camucuio','Cuanhama','Cuvelai','Curoca','Namacunde','Ombadja'],
        'Huambo':          ['Bailundo','Caála','Catchiungo','Chicala-Cholohanga','Chinhama','Ecunha','Huambo','Longonjo','Mungo','Ucuma'],
        'Huíla':           ['Caconda','Cacula','Caluquembe','Chibia','Chicomba','Chipindo','Cuvango','Gambos','Humpata','Jamba','Lubango','Matala','Quilengues','Quipungo'],
        'Luanda':          ['Belas','Cacuaco','Cazenga','Ícolo e Bengo','Luanda','Quissama','Viana'],
        'Lunda Norte':     ['Cambulo','Capenda-Camulemba','Caungula','Chitato','Cuango','Cuilo','Lubalo','Lunge','Xá-Muteba'],
        'Lunda Sul':       ['Cacolo','Dala','Lovua','Muconda','Saurimo'],
        'Malanje':         ['Cacuso','Calandula','Cambundi-Catembo','Cangandala','Caombo','Cuaba Nzoji','Cunda-Dia-Baze','Luquembo','Malanje','Marimba','Massango','Mazozo','Mucari','Quela','Quirima'],
        'Moxico':          ['Alto Zambeze','Bundas','Camanongue','Cameia','Léua','Lovua','Luacano','Luena','Luchazes','Moxico'],
        'Namibe':          ['Bibala','Camucuio','Moçâmedes','Tômbua','Virei'],
        'Uíge':            ['Alto Cauale','Bembe','Buengas','Bungo','Damba','Maquela do Zombo','Milunga','Mucaba','Negage','Puri','Quimbele','Quitexe','Sanza Pombo','Songo','Uíge','Zombo'],
        'Zaire':           ['Cuimba','M\'banza Kongo','Nóqui','Nzeto','Soio','Tomboco']
    };

    var selProv = document.getElementById('select-provincia');
    var selMun  = document.getElementById('select-municipio');

    if (!selProv || !selMun) return;

    // Preencher províncias (ordenadas, Bié primeiro por ser a do ISP)
    var provincias = Object.keys(ANGOLA).sort();
    provincias.forEach(function (p) {
        var opt = document.createElement('option');
        opt.value = p;
        opt.textContent = p;
        selProv.appendChild(opt);
    });

    function preencherMunicipios(provincia) {
        selMun.innerHTML = '';
        if (!provincia || !ANGOLA[provincia]) {
            var placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = 'Seleccione primeiro a província';
            selMun.appendChild(placeholder);
            selMun.disabled = true;
            return;
        }
        var primeiro = document.createElement('option');
        primeiro.value = '';
        primeiro.textContent = 'Seleccione o município';
        selMun.appendChild(primeiro);
        ANGOLA[provincia].forEach(function (m) {
            var opt = document.createElement('option');
            opt.value = m;
            opt.textContent = m;
            selMun.appendChild(opt);
        });
        selMun.disabled = false;
    }

    // Restaurar valores após erro de validação (via data-old no HTML)
    var oldProv = selProv.dataset.old || '';
    var oldMun  = selMun.dataset.old  || '';

    if (oldProv) {
        selProv.value = oldProv;
        preencherMunicipios(oldProv);
        if (oldMun) selMun.value = oldMun;
    } else {
        selMun.disabled = true;
    }

    selProv.addEventListener('change', function () {
        preencherMunicipios(this.value);
    });
})();
