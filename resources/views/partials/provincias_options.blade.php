@php
$ANGOLA = [
    'Bengo'=>['Ambriz','Bula Atumba','Dande','Dembos','Nambuangongo','Pango Aluquém'],
    'Benguela'=>['Baía Farta','Balombo','Benguela','Bocoio','Chongoroi','Cubal','Ganda','Lobito','Nharea'],
    'Bié'=>['Andulo','Camacupa','Catabola','Chinguar','Chitembo','Cuemba','Cunhinga','Kuito','Nharea'],
    'Cabinda'=>['Belize','Buco-Zau','Cabinda','Cacongo'],
    'Cuando Cubango'=>['Calai','Cuangar','Cuchi','Cuito Cuanavale','Dirico','Longa','Mavinga','Menongue','Nancova','Rivungo'],
    'Cuanza Norte'=>['Ambaca','Banga','Bolongongo','Cambambe','Cazengo','Golungo Alto','Gonguembo','Lucala','Quiculungo','Samba Caju'],
    'Cuanza Sul'=>['Amboim','Cassongue','Cela','Conda','Ebo','Kibala','Kilenda','Libolo','Mussende','Porto Amboim','Quibala','Quilenda','Seles','Sumbe'],
    'Cunene'=>['Cahama','Camucuio','Cuanhama','Cuvelai','Curoca','Namacunde','Ombadja'],
    'Huambo'=>['Bailundo','Caála','Catchiungo','Chicala-Cholohanga','Chinhama','Ecunha','Huambo','Longonjo','Mungo','Ucuma'],
    'Huíla'=>['Caconda','Cacula','Caluquembe','Chibia','Chicomba','Chipindo','Cuvango','Gambos','Humpata','Jamba','Lubango','Matala','Quilengues','Quipungo'],
    'Luanda'=>['Belas','Cacuaco','Cazenga','Ícolo e Bengo','Luanda','Quissama','Viana'],
    'Lunda Norte'=>['Cambulo','Capenda-Camulemba','Caungula','Chitato','Cuango','Cuilo','Lubalo','Lunge','Xá-Muteba'],
    'Lunda Sul'=>['Cacolo','Dala','Lovua','Muconda','Saurimo'],
    'Malanje'=>['Cacuso','Calandula','Cambundi-Catembo','Cangandala','Caombo','Cuaba Nzoji','Cunda-Dia-Baze','Luquembo','Malanje','Marimba','Massango','Mazozo','Mucari','Quela','Quirima'],
    'Moxico'=>['Alto Zambeze','Bundas','Camanongue','Cameia','Léua','Lovua','Luacano','Luena','Luchazes','Moxico'],
    'Namibe'=>['Bibala','Camucuio','Moçâmedes','Tômbua','Virei'],
    'Uíge'=>['Alto Cauale','Bembe','Buengas','Bungo','Damba','Maquela do Zombo','Milunga','Mucaba','Negage','Puri','Quimbele','Quitexe','Sanza Pombo','Songo','Uíge','Zombo'],
    'Zaire'=>['Cuimba','M\'banza Kongo','Nóqui','Nzeto','Soio','Tomboco']
];

$selectedProvince = $selectedProvince ?? null;
$selectedMunicipio = $selectedMunicipio ?? null;

asort($ANGOLA, SORT_STRING);
@endphp
<option value="">Seleccione a província</option>
@foreach($ANGOLA as $prov => $muns)
    <option value="{{ $prov }}" {{ $selectedProvince && $selectedProvince === $prov ? 'selected' : '' }}>{{ $prov }}</option>
@endforeach
