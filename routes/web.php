<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;


// Rotas do painel administrativo protegidas por autenticação E papel de administrador
// throttle:1000,1 — máximo 1000 pedidos/minuto por utilizador no painel (ajustado para operações internas durante candidaturas)
Route::middleware(['auth', 'admin', 'throttle:30,1'])->group(function () {
    Route::resource('/admin/estatisticas', App\Http\Controllers\Admin\EstatisticaController::class)->names('admin.estatisticas');
            Route::get('/admin/noticias/{id}/edit', [App\Http\Controllers\AdminNoticiaController::class, 'edit'])->name('admin.noticias.edit');
            Route::put('/admin/noticias/{id}', [App\Http\Controllers\AdminNoticiaController::class, 'update'])->name('admin.noticias.update');
            Route::delete('/admin/noticias/{id}', [App\Http\Controllers\AdminNoticiaController::class, 'destroy'])->name('admin.noticias.destroy');
        Route::delete('/admin/noticias/documento/{documento}', [App\Http\Controllers\AdminNoticiaController::class, 'destroyDocumento'])->name('admin.noticias.documento.destroy');
        Route::post('/admin/noticias/{id}/toggle-publicar', [App\Http\Controllers\AdminNoticiaController::class, 'togglePublicar'])->name('admin.noticias.toggle-publicar');
        Route::get('/admin/noticias', [App\Http\Controllers\AdminNoticiaController::class, 'index'])->name('admin.noticias');
        Route::get('/admin/noticias/create', [App\Http\Controllers\AdminNoticiaController::class, 'create'])->name('admin.noticias.create');
        Route::post('/admin/noticias', [App\Http\Controllers\AdminNoticiaController::class, 'store'])->name('admin.noticias.store');
    Route::get('/admin', function () {
        $pending = 0;
        try {
            $pending = \App\Models\RevistaSubmission::where('status', 'pending')->count();
        } catch (\Throwable $e) {}
        $pendingCandidaturas = 0;
        try {
            $pendingCandidaturas = \App\Models\Candidatura::where('status', 'pendente')->count();
        } catch (\Throwable $e) {}
        return view('admin.dashboard', compact('pending', 'pendingCandidaturas'));
    })->name('admin');
    Route::get('/admin/paginas', [App\Http\Controllers\Admin\PaginaController::class, 'index'])->name('admin.paginas');
    Route::get('/admin/paginas/create', [App\Http\Controllers\Admin\PaginaController::class, 'create'])->name('admin.paginas.create');
    Route::post('/admin/paginas', [App\Http\Controllers\Admin\PaginaController::class, 'store'])->name('admin.paginas.store');
    Route::get('/admin/midia', [App\Http\Controllers\Admin\MidiaController::class, 'index'])->name('admin.midia');
    Route::post('/admin/midia', [App\Http\Controllers\Admin\MidiaController::class, 'store'])->name('admin.midia.store');
    Route::delete('/admin/midia/{id}', [App\Http\Controllers\Admin\MidiaController::class, 'destroy'])->name('admin.midia.destroy');
    Route::resource('/admin/carrossel', App\Http\Controllers\Admin\CarrosselController::class)->names('admin.carrossel');
    Route::post('/admin/carrossel/{id}/toggle-publicar', [App\Http\Controllers\Admin\CarrosselController::class, 'togglePublicar'])->name('admin.carrossel.toggle-publicar');
    Route::get('/admin/alumni', [App\Http\Controllers\AdminAlumniController::class, 'index'])->name('admin.alumni');
    Route::get('/admin/alumni/stats', [App\Http\Controllers\Admin\AlumniStatsController::class, 'edit'])->name('admin.alumni.stats');
    Route::post('/admin/alumni/stats', [App\Http\Controllers\Admin\AlumniStatsController::class, 'update'])->name('admin.alumni.stats.update');
    Route::post('/admin/alumni/{id}/toggle-publicar', [App\Http\Controllers\AdminAlumniController::class, 'togglePublicar'])->name('admin.alumni.toggle-publicar');
    Route::post('/admin/alumni/{id}/toggle-testemunho', [App\Http\Controllers\AdminAlumniController::class, 'toggleTestemunho'])->name('admin.alumni.toggle-testemunho');
    Route::get('/admin/usuarios', [App\Http\Controllers\Admin\UsuarioController::class, 'index'])->name('admin.usuarios');
    Route::get('/admin/usuarios/{usuario}', [App\Http\Controllers\Admin\UsuarioController::class, 'show'])->name('admin.usuarios.show');
    Route::post('/admin/usuarios', [App\Http\Controllers\Admin\UsuarioController::class, 'store'])->name('admin.usuarios.store');
    Route::patch('/admin/usuarios/{usuario}/password', [App\Http\Controllers\Admin\UsuarioController::class, 'resetPassword'])->name('admin.usuarios.password');
    Route::post('/admin/usuarios/{usuario}/assinatura', [App\Http\Controllers\Admin\UsuarioController::class, 'uploadSignature'])->name('admin.usuarios.assinatura');
    Route::delete('/admin/usuarios/{usuario}/assinatura', [App\Http\Controllers\Admin\UsuarioController::class, 'removeSignature'])->name('admin.usuarios.assinatura.remove');
    Route::delete('/admin/usuarios/{usuario}', [App\Http\Controllers\Admin\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');
    Route::get('/admin/configuracoes', function () {
        $configuracoes = [];
        return view('admin.configuracoes', compact('configuracoes'));
    })->name('admin.configuracoes');
});


// Rotas individuais para páginas de cursos (otimizado)

$cursos = ['informatica', 'hidricos', 'psicologia', 'comunicacao', 'contabilidade'];
foreach ($cursos as $curso) {
    Route::view("/cursos/{$curso}", "pages.cursos.{$curso}")->name("cursos.{$curso}");
}

// Rota de enfermagem com closure para evitar erro 500
Route::get('/cursos/enfermagem', function () {
    // Passe variáveis necessárias para o layout aqui, se houver
    return view('pages.cursos.enfermagem');
})->name('cursos.enfermagem');


use App\Models\Alumnus;


Route::get('/busca', function () {
    return view('pages.busca');
})->name('busca');

Route::get('/', function () {
    $testemunhos = Alumnus::where('publicado', true)
        ->where('testemunho', true)
        ->orderByDesc('created_at')
        ->take(6)
        ->get();
    $carrosseis = \App\Models\Carrossel::where('publicado', 1)->orderBy('ordem')->take(5)->get();
    $totalSlides = $carrosseis->count();
    $hero = $carrosseis->first();

    // Estatísticas de visitas
    $totalVisitas = 0;
    $visitasPorPais = collect();
    try {
        $totalVisitas = \App\Models\SiteVisita::count();

        // Código ISO → nome em português (lista abrangente)
        $codePt = [
            // África
            'AO'=>'Angola','MZ'=>'Moçambique','CV'=>'Cabo Verde','ST'=>'São Tomé e Príncipe',
            'GW'=>'Guiné-Bissau','GQ'=>'Guiné Equatorial','TL'=>'Timor-Leste',
            'ZA'=>'África do Sul','NG'=>'Nigéria','KE'=>'Quénia','GH'=>'Gana',
            'CM'=>'Camarões','CD'=>'RD Congo','CG'=>'Congo','NA'=>'Namíbia',
            'ZM'=>'Zâmbia','ZW'=>'Zimbabué','BW'=>'Botswana','TZ'=>'Tanzânia',
            'SN'=>'Senegal','ET'=>'Etiópia','UG'=>'Uganda','CI'=>'Costa do Marfim',
            'TN'=>'Tunísia','DZ'=>'Argélia','LY'=>'Líbia','SD'=>'Sudão',
            'RW'=>'Ruanda','ML'=>'Mali','BF'=>'Burquina Faso','MG'=>'Madagáscar',
            'ZA'=>'África do Sul','EG'=>'Egipto','MA'=>'Marrocos','ZA'=>'África do Sul',
            // Europa
            'PT'=>'Portugal','ES'=>'Espanha','FR'=>'França','DE'=>'Alemanha',
            'IT'=>'Itália','GB'=>'Reino Unido','NL'=>'Países Baixos','BE'=>'Bélgica',
            'CH'=>'Suíça','SE'=>'Suécia','NO'=>'Noruega','DK'=>'Dinamarca',
            'FI'=>'Finlândia','PL'=>'Polónia','RO'=>'Roménia','AT'=>'Áustria',
            'UA'=>'Ucrânia','CZ'=>'Rep. Checa','HU'=>'Hungria','GR'=>'Grécia',
            'HR'=>'Croácia','SK'=>'Eslováquia','BG'=>'Bulgária','RS'=>'Sérvia',
            'IE'=>'Irlanda','LU'=>'Luxemburgo','LT'=>'Lituânia','LV'=>'Letónia',
            'EE'=>'Estónia','SI'=>'Eslovénia','MT'=>'Malta','CY'=>'Chipre',
            'IS'=>'Islândia','AL'=>'Albânia','BA'=>'Bósnia','MK'=>'Macedónia',
            'RU'=>'Rússia',
            // Américas
            'BR'=>'Brasil','US'=>'Estados Unidos','CA'=>'Canadá','MX'=>'México',
            'AR'=>'Argentina','CO'=>'Colômbia','CL'=>'Chile','PE'=>'Peru',
            'VE'=>'Venezuela','EC'=>'Equador','BO'=>'Bolívia','UY'=>'Uruguai',
            'PY'=>'Paraguai','GT'=>'Guatemala','CR'=>'Costa Rica','PA'=>'Panamá',
            'CU'=>'Cuba','DO'=>'Rep. Dominicana','HN'=>'Honduras','SV'=>'El Salvador',
            'JM'=>'Jamaica','TT'=>'Trinidad e Tobago',
            // Ásia
            'CN'=>'China','JP'=>'Japão','IN'=>'Índia','KR'=>'Coreia do Sul',
            'KP'=>'Coreia do Norte','ID'=>'Indonésia','MY'=>'Malásia','SG'=>'Singapura',
            'TH'=>'Tailândia','VN'=>'Vietname','PH'=>'Filipinas','BD'=>'Bangladesh',
            'PK'=>'Paquistão','LK'=>'Sri Lanka','NP'=>'Nepal','MM'=>'Mianmar',
            'KH'=>'Camboja','LA'=>'Laos','TW'=>'Taiwan','HK'=>'Hong Kong',
            'MO'=>'Macau','MN'=>'Mongólia','KZ'=>'Cazaquistão','UZ'=>'Usbequistão',
            'SA'=>'Arábia Saudita','AE'=>'Emirados Árabes','TR'=>'Turquia',
            'IL'=>'Israel','IR'=>'Irão','IQ'=>'Iraque','JO'=>'Jordânia',
            'LB'=>'Líbano','SY'=>'Síria','YE'=>'Iémen','KW'=>'Kuwait',
            'QA'=>'Qatar','BH'=>'Bahrain','OM'=>'Omã','AF'=>'Afeganistão',
            // Oceânia & outros
            'AU'=>'Austrália','NZ'=>'Nova Zelândia','FJ'=>'Fiji',
        ];

        // Nome inglês → nome em português (para registos antigos com pais_code='??')
        $engPt = [
            'South Africa'=>'África do Sul','South Korea'=>'Coreia do Sul',
            'North Korea'=>'Coreia do Norte','United States'=>'Estados Unidos',
            'United Kingdom'=>'Reino Unido','France'=>'França','Germany'=>'Alemanha',
            'Spain'=>'Espanha','Italy'=>'Itália','Netherlands'=>'Países Baixos',
            'Belgium'=>'Bélgica','Switzerland'=>'Suíça','Canada'=>'Canadá',
            'Australia'=>'Austrália','Japan'=>'Japão','Singapore'=>'Singapura',
            'India'=>'Índia','Russia'=>'Rússia','Nigeria'=>'Nigéria',
            'Kenya'=>'Quénia','Ghana'=>'Gana','Cameroon'=>'Camarões',
            'Mozambique'=>'Moçambique','Cape Verde'=>'Cabo Verde',
            'Turkey'=>'Turquia','Mexico'=>'México','Colombia'=>'Colômbia',
            'Poland'=>'Polónia','Sweden'=>'Suécia','Norway'=>'Noruega',
            'Indonesia'=>'Indonésia','Malaysia'=>'Malásia','Vietnam'=>'Vietname',
            'Thailand'=>'Tailândia','Philippines'=>'Filipinas','Bangladesh'=>'Bangladesh',
            'Pakistan'=>'Paquistão','Taiwan'=>'Taiwan','Hong Kong'=>'Hong Kong',
            'China'=>'China','Argentina'=>'Argentina','Chile'=>'Chile','Peru'=>'Peru',
            'Venezuela'=>'Venezuela','Ecuador'=>'Equador','Bolivia'=>'Bolívia',
            'Uruguay'=>'Uruguai','Paraguay'=>'Paraguai','Romania'=>'Roménia',
            'Ukraine'=>'Ucrânia','Czech Republic'=>'Rep. Checa','Hungary'=>'Hungria',
            'Greece'=>'Grécia','Croatia'=>'Croácia','Slovakia'=>'Eslováquia',
            'Bulgaria'=>'Bulgária','Serbia'=>'Sérvia','Ireland'=>'Irlanda',
            'Denmark'=>'Dinamarca','Finland'=>'Finlândia','Austria'=>'Áustria',
            'Israel'=>'Israel','Iran'=>'Irão','Iraq'=>'Iraque','Jordan'=>'Jordânia',
            'Lebanon'=>'Líbano','Qatar'=>'Qatar','Kuwait'=>'Kuwait',
            'Saudi Arabia'=>'Arábia Saudita','United Arab Emirates'=>'Emirados Árabes',
            'New Zealand'=>'Nova Zelândia','Egypt'=>'Egipto','Morocco'=>'Marrocos',
            'Tunisia'=>'Tunísia','Algeria'=>'Argélia','Ethiopia'=>'Etiópia',
            'Tanzania'=>'Tanzânia','Senegal'=>'Senegal','Ivory Coast'=>'Costa do Marfim',
            "Côte d'Ivoire"=>'Costa do Marfim','Kazakhstan'=>'Cazaquistão',
        ];

        // Busca todos os grupos (pais + pais_code) ignorando apenas "Desconhecido"
        $rawGrupos = \App\Models\SiteVisita::selectRaw('pais_code, pais, COUNT(*) as subtotal')
            ->where('pais', '!=', 'Desconhecido')
            ->groupBy('pais_code', 'pais')
            ->get();

        // Mapa reverso: nome português → código ISO (para unificar entradas sem código)
        $ptCode = array_flip($codePt); // ex: 'África do Sul' => 'ZA'

        // Agrega em PHP: usa código ISO como chave universal
        // Entradas sem código (pais_code='??') são normalizadas pelo nome → código
        $agregado = [];
        foreach ($rawGrupos as $g) {
            $code = strtoupper(trim($g->pais_code ?? '??'));
            if ($code !== '??') {
                // Código conhecido → chave = código ISO
                $key = $code;
            } else {
                // Sem código: normalizar nome inglês → português → código ISO
                $nomePt = $engPt[$g->pais] ?? $g->pais;
                $key    = $ptCode[$nomePt] ?? $nomePt; // código se mapeável, senão nome PT
            }
            $agregado[$key] = ($agregado[$key] ?? 0) + (int) $g->subtotal;
        }

        // Ordena por total desc — todos os países sem limite
        arsort($agregado);
        $visitasPorPais = collect($agregado)
            ->map(fn($total, $key) => (object)[
                'pais'  => $codePt[$key] ?? $key, // código → nome PT; ou nome literal se desconhecido
                'total' => $total,
            ])->values();
    } catch (\Throwable) {}

    return view('welcome', compact('testemunhos', 'carrosseis', 'totalSlides', 'hero', 'totalVisitas', 'visitasPorPais'));
})->name('welcome');

// Investigação (public) - use closure to guarantee controller is executed and view data provided
Route::get('/investigacao', function () {
    return app(App\Http\Controllers\ProjectController::class)->index();
})->name('investigacao');

// Admin CRUD for projects
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'throttle:1000,1'])->group(function () {
    Route::resource('projects', AdminProjectController::class)->parameters(['projects' => 'project']);

    // Explicit admin routes for concursos that must be registered BEFORE the
    // resource route to avoid collisions with the implicit `{concurso}` binding
    // (e.g. '/admin/concursos/alerts' would otherwise be interpreted as an id).
    // Global subscribers list + export
    Route::get('concursos/alerts', [App\Http\Controllers\Admin\ConcursoController::class, 'alerts'])->name('concursos.alerts');
    Route::get('concursos/alerts/export', [App\Http\Controllers\Admin\ConcursoController::class, 'alertsExport'])->name('concursos.alerts.export');

    // Per-concurso subscribers (filtered by concurso.area) and export
    Route::get('concursos/{concurso}/subscribers', [App\Http\Controllers\Admin\ConcursoController::class, 'subscribers'])->name('concursos.subscribers');
    Route::get('concursos/{concurso}/subscribers/export', [App\Http\Controllers\Admin\ConcursoController::class, 'subscribersExport'])->name('concursos.subscribers.export');

    // Manual resend action for a specific concurso
    Route::post('concursos/{concurso}/resend-alerts', [App\Http\Controllers\Admin\ConcursoController::class, 'resendAlerts'])->name('concursos.resend-alerts');
    // Manual resend to ALL subscribers (ignore consent/area)
    Route::post('concursos/{concurso}/resend-alerts-all', [App\Http\Controllers\Admin\ConcursoController::class, 'resendAlertsAll'])->name('concursos.resend-alerts-all');

    // Delete attachment route for concursos (named under admin. prefix)
    Route::delete('concursos/attachments/{id}', [App\Http\Controllers\Admin\ConcursoController::class, 'destroyAttachment'])->name('concursos.attachments.destroy');

    // Now register the resource routes for concursos (will not intercept the
    // explicit routes defined above)
    Route::resource('concursos', App\Http\Controllers\Admin\ConcursoController::class);

    // Revista submissions moderation
    Route::get('revistas/submissions', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'index'])->name('revistas');
    Route::post('revistas/{id}/publish', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'publish'])->name('revistas.publish');
    Route::get('revistas/{id}', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'show'])->name('revistas.show');
    Route::get('revistas/{id}/edit', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'edit'])->name('revistas.edit');
    Route::put('revistas/{id}', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'update'])->name('revistas.update');
    Route::delete('revistas/{id}', [App\Http\Controllers\Admin\RevistaSubmissionController::class, 'destroy'])->name('revistas.destroy');

    // Salas de exame (rotas fixas ANTES das rotas com {sala})
    Route::get('salas', [App\Http\Controllers\Admin\SalaController::class, 'index'])->name('salas.index');
    Route::post('salas', [App\Http\Controllers\Admin\SalaController::class, 'store'])->name('salas.store');
    Route::post('salas/distribuir', [App\Http\Controllers\Admin\SalaController::class, 'distribuir'])->name('salas.distribuir');
    Route::post('salas/limpar', [App\Http\Controllers\Admin\SalaController::class, 'limpar'])->name('salas.limpar');
    Route::get('salas/lote/pdf', [App\Http\Controllers\Admin\SalaController::class, 'pdfLote'])->name('salas.pdf-lote');
    Route::get('salas/lote/pdf-exame', [App\Http\Controllers\Admin\SalaController::class, 'pdfExameLote'])->name('salas.pdf-exame-lote');
    Route::get('salas/lote/excel-exame', [App\Http\Controllers\Admin\SalaController::class, 'excelExameLote'])->name('salas.excel-exame-lote');
    Route::get('salas/{sala}/pdf', [App\Http\Controllers\Admin\SalaController::class, 'pdf'])->name('salas.pdf');
    Route::get('salas/{sala}/pdf-exame', [App\Http\Controllers\Admin\SalaController::class, 'pdfExame'])->name('salas.pdf-exame');
    Route::get('salas/{sala}/excel-exame', [App\Http\Controllers\Admin\SalaController::class, 'excelExame'])->name('salas.excel-exame');
    Route::get('salas/{sala}', [App\Http\Controllers\Admin\SalaController::class, 'show'])->name('salas.show');
    Route::patch('salas/{sala}', [App\Http\Controllers\Admin\SalaController::class, 'update'])->name('salas.update');
    Route::delete('salas/{sala}', [App\Http\Controllers\Admin\SalaController::class, 'destroy'])->name('salas.destroy');

    // Relatórios
    Route::get('relatorios', function (\Illuminate\Http\Request $r) {
        return app(\App\Http\Controllers\RelatorioController::class)->index($r, 'layouts.admin');
    })->name('relatorios');
    Route::get('relatorios/export', [\App\Http\Controllers\RelatorioController::class, 'export'])->name('relatorios.export');

    // Candidaturas admin
    Route::get('candidaturas/export', [App\Http\Controllers\Admin\CandidaturaController::class, 'export'])->name('candidaturas.export');
    Route::get('candidaturas', [App\Http\Controllers\Admin\CandidaturaController::class, 'index'])->name('candidaturas.index');
    Route::get('candidaturas/{candidatura}/comprovativo', [App\Http\Controllers\Admin\CandidaturaController::class, 'downloadComprovativo'])->name('candidaturas.comprovativo');
    Route::post('candidaturas/{candidatura}/reenviar-recebida', [App\Http\Controllers\Admin\CandidaturaController::class, 'reenviarRecebida'])->name('candidaturas.reenviar-recebida');
    Route::post('candidaturas/{candidatura}/reenviar-pagamento', [App\Http\Controllers\Admin\CandidaturaController::class, 'reenviarPagamento'])->name('candidaturas.reenviar-pagamento');
    Route::post('candidaturas/{candidatura}/reenviar-comprovativo', [App\Http\Controllers\Admin\CandidaturaController::class, 'reenviarComprovativo'])->name('candidaturas.reenviar-comprovativo');
    Route::get('candidaturas/{candidatura}/folha-prova', [App\Http\Controllers\Admin\CandidaturaController::class, 'downloadFolhaProva'])->name('candidaturas.folha-prova');
    Route::get('candidaturas/lote/folhas-prova', [App\Http\Controllers\Admin\CandidaturaController::class, 'downloadFolhasProvaLote'])->name('candidaturas.folhas-prova-lote');
    Route::get('candidaturas/{candidatura}/edit', [App\Http\Controllers\Admin\CandidaturaController::class, 'edit'])->name('candidaturas.edit');
    Route::put('candidaturas/{candidatura}', [App\Http\Controllers\Admin\CandidaturaController::class, 'update'])->name('candidaturas.update');
    Route::get('candidaturas/{candidatura}', [App\Http\Controllers\Admin\CandidaturaController::class, 'show'])->name('candidaturas.show');
    Route::patch('candidaturas/{candidatura}/status', [App\Http\Controllers\Admin\CandidaturaController::class, 'updateStatus'])->name('candidaturas.status');
    Route::delete('candidaturas/{candidatura}', [App\Http\Controllers\Admin\CandidaturaController::class, 'destroy'])->name('candidaturas.destroy');

    // Auditoria
    Route::get('auditoria', [App\Http\Controllers\Admin\AuditLogController::class, 'index'])->name('auditoria');

    // Alumni documentos (portal)
    Route::get('alumni-documentos', [App\Http\Controllers\Admin\AlumniDocumentoController::class, 'index'])->name('alumni-documentos.index');
    Route::post('alumni-documentos', [App\Http\Controllers\Admin\AlumniDocumentoController::class, 'store'])->name('alumni-documentos.store');
    Route::delete('alumni-documentos/{documento}', [App\Http\Controllers\Admin\AlumniDocumentoController::class, 'destroy'])->name('alumni-documentos.destroy');

    // Alumni portal approval / revocation
    Route::post('alumni/{id}/aprovar', [App\Http\Controllers\AdminAlumniController::class, 'aprovar'])->name('alumni.aprovar');
    Route::post('alumni/{id}/revogar', [App\Http\Controllers\AdminAlumniController::class, 'revogar'])->name('alumni.revogar');
});

// Painel Secretaria — confirmação de pagamentos
Route::prefix('secretaria')->name('secretaria.')->middleware(['auth', 'secretaria', 'throttle:1000,1'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('secretaria.candidaturas.index');
    })->name('dashboard');
    Route::get('candidaturas', [App\Http\Controllers\Secretaria\CandidaturaController::class, 'index'])->name('candidaturas.index');
    Route::get('candidaturas/{candidatura}', [App\Http\Controllers\Secretaria\CandidaturaController::class, 'show'])->name('candidaturas.show');
    Route::post('candidaturas/{candidatura}/confirmar-pagamento', [App\Http\Controllers\Secretaria\CandidaturaController::class, 'confirmarPagamento'])->name('candidaturas.confirmar-pagamento');
    Route::post('candidaturas/{candidatura}/cancelar-pagamento', [App\Http\Controllers\Secretaria\CandidaturaController::class, 'cancelarPagamento'])->name('candidaturas.cancelar-pagamento');
});

// Painel DAAC — assinar candidaturas digitalmente
Route::prefix('daac')->name('daac.')->middleware(['auth', 'daac', 'throttle:1000,1'])->group(function () {
    // Candidaturas
    Route::get('candidaturas', [App\Http\Controllers\Daac\CandidaturaController::class, 'index'])->name('candidaturas.index');
    Route::get('candidaturas/{candidatura}/comprovativo', [App\Http\Controllers\Daac\CandidaturaController::class, 'downloadComprovativo'])->name('candidaturas.comprovativo');
    Route::post('candidaturas/{candidatura}/reenviar-comprovativo', [App\Http\Controllers\Daac\CandidaturaController::class, 'reenviarComprovativo'])->name('candidaturas.reenviar-comprovativo');
    Route::get('candidaturas/{candidatura}/imprimir-presencial', [App\Http\Controllers\Daac\CandidaturaController::class, 'imprimirPresencialComprovativo'])->name('candidaturas.imprimir-presencial');
    Route::get('candidaturas/{candidatura}/folha-prova', [App\Http\Controllers\Daac\CandidaturaController::class, 'downloadFolhaProva'])->name('candidaturas.folha-prova');
    Route::get('candidaturas/lote/folhas-prova', [App\Http\Controllers\Daac\CandidaturaController::class, 'downloadFolhasProvaLote'])->name('candidaturas.folhas-prova-lote');
    Route::get('candidaturas/{candidatura}', [App\Http\Controllers\Daac\CandidaturaController::class, 'show'])->name('candidaturas.show');
    Route::post('candidaturas/{candidatura}/assinar', [App\Http\Controllers\Daac\CandidaturaController::class, 'assinar'])->name('candidaturas.assinar');
    Route::post('candidaturas/{candidatura}/rejeitar', [App\Http\Controllers\Daac\CandidaturaController::class, 'rejeitar'])->name('candidaturas.rejeitar');

    // Relatórios DAAC
    Route::get('relatorios', function (\Illuminate\Http\Request $r) {
        return app(\App\Http\Controllers\RelatorioController::class)->index($r, 'layouts.daac');
    })->name('relatorios');
    Route::get('relatorios/export', [\App\Http\Controllers\RelatorioController::class, 'export'])->name('relatorios.export');

    // Salas
    Route::get('salas', [App\Http\Controllers\Daac\SalaController::class, 'index'])->name('salas.index');
    Route::get('salas/lote/pdf', [App\Http\Controllers\Daac\SalaController::class, 'pdfLote'])->name('salas.pdf-lote');
    Route::get('salas/lote/excel-exame', [App\Http\Controllers\Daac\SalaController::class, 'excelExameLote'])->name('salas.excel-exame-lote');
    Route::get('salas/{sala}/pdf', [App\Http\Controllers\Daac\SalaController::class, 'pdf'])->name('salas.pdf');
    Route::get('salas/{sala}/excel-exame', [App\Http\Controllers\Daac\SalaController::class, 'excelExame'])->name('salas.excel-exame');
    Route::get('salas/{sala}', [App\Http\Controllers\Daac\SalaController::class, 'show'])->name('salas.show');
});

Route::prefix('tecnico')->name('tecnico.')->middleware(['auth', 'tecnico', 'throttle:1000,1'])->group(function () {
    // Relatórios
    Route::get('relatorios', function (\Illuminate\Http\Request $r) {
        return app(\App\Http\Controllers\RelatorioController::class)->index($r, 'layouts.tecnico');
    })->name('relatorios');
    Route::get('relatorios/export', [\App\Http\Controllers\RelatorioController::class, 'export'])->name('relatorios.export');

    // Candidaturas
    Route::get('candidaturas/export', [App\Http\Controllers\Tecnico\CandidaturaController::class, 'export'])->name('candidaturas.export');
    Route::get('candidaturas/create', [App\Http\Controllers\Tecnico\CandidaturaController::class, 'create'])->name('candidaturas.create');
    Route::post('candidaturas', [App\Http\Controllers\Tecnico\CandidaturaController::class, 'store'])->name('candidaturas.store');
    Route::get('candidaturas', [App\Http\Controllers\Tecnico\CandidaturaController::class, 'index'])->name('candidaturas.index');
    Route::get('candidaturas/{candidatura}/comprovativo', [App\Http\Controllers\Tecnico\CandidaturaController::class, 'downloadComprovativo'])->name('candidaturas.comprovativo');
    Route::get('candidaturas/{candidatura}/edit', [App\Http\Controllers\Tecnico\CandidaturaController::class, 'edit'])->name('candidaturas.edit');
    Route::put('candidaturas/{candidatura}', [App\Http\Controllers\Tecnico\CandidaturaController::class, 'update'])->name('candidaturas.update');
    Route::get('candidaturas/{candidatura}', [App\Http\Controllers\Tecnico\CandidaturaController::class, 'show'])->name('candidaturas.show');
    Route::patch('candidaturas/{candidatura}/status', [App\Http\Controllers\Tecnico\CandidaturaController::class, 'updateStatus'])->name('candidaturas.status');

    // Salas de exame
    Route::get('salas', [App\Http\Controllers\Tecnico\SalaController::class, 'index'])->name('salas.index');
    Route::post('salas', [App\Http\Controllers\Tecnico\SalaController::class, 'store'])->name('salas.store');
    Route::post('salas/distribuir', [App\Http\Controllers\Tecnico\SalaController::class, 'distribuir'])->name('salas.distribuir');
    Route::post('salas/limpar', [App\Http\Controllers\Tecnico\SalaController::class, 'limpar'])->name('salas.limpar');
    Route::get('salas/lote/pdf', [App\Http\Controllers\Tecnico\SalaController::class, 'pdfLote'])->name('salas.pdf-lote');
    Route::get('salas/lote/pdf-exame', [App\Http\Controllers\Tecnico\SalaController::class, 'pdfExameLote'])->name('salas.pdf-exame-lote');
    Route::get('salas/lote/excel-exame', [App\Http\Controllers\Tecnico\SalaController::class, 'excelExameLote'])->name('salas.excel-exame-lote');
    Route::get('salas/{sala}/pdf', [App\Http\Controllers\Tecnico\SalaController::class, 'pdf'])->name('salas.pdf');
    Route::get('salas/{sala}/pdf-exame', [App\Http\Controllers\Tecnico\SalaController::class, 'pdfExame'])->name('salas.pdf-exame');
    Route::get('salas/{sala}/excel-exame', [App\Http\Controllers\Tecnico\SalaController::class, 'excelExame'])->name('salas.excel-exame');
    Route::get('salas/{sala}', [App\Http\Controllers\Tecnico\SalaController::class, 'show'])->name('salas.show');
    Route::patch('salas/{sala}', [App\Http\Controllers\Tecnico\SalaController::class, 'update'])->name('salas.update');
    Route::delete('salas/{sala}', [App\Http\Controllers\Tecnico\SalaController::class, 'destroy'])->name('salas.destroy');
});

Route::prefix('lancamento')->name('lancamento.')->middleware(['auth', 'subcomissao_lancamento', 'throttle:1000,1'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('lancamento.salas.index');
    })->name('dashboard');

    Route::get('salas', [App\Http\Controllers\Lancamento\SalaController::class, 'index'])->name('salas.index');
    Route::post('salas/distribuir', [App\Http\Controllers\Lancamento\SalaController::class, 'distribuir'])->name('salas.distribuir');
    Route::post('salas/limpar', [App\Http\Controllers\Lancamento\SalaController::class, 'limpar'])->name('salas.limpar');
    Route::get('salas/lote/pdf', [App\Http\Controllers\Lancamento\SalaController::class, 'pdfLote'])->name('salas.pdf-lote');
    Route::get('salas/lote/pdf-exame', [App\Http\Controllers\Lancamento\SalaController::class, 'pdfExameLote'])->name('salas.pdf-exame-lote');
    Route::get('salas/lote/excel-exame', [App\Http\Controllers\Lancamento\SalaController::class, 'excelExameLote'])->name('salas.excel-exame-lote');
    Route::get('salas/{sala}/pdf', [App\Http\Controllers\Lancamento\SalaController::class, 'pdf'])->name('salas.pdf');
    Route::get('salas/{sala}/pdf-exame', [App\Http\Controllers\Lancamento\SalaController::class, 'pdfExame'])->name('salas.pdf-exame');
    Route::get('salas/{sala}/excel-exame', [App\Http\Controllers\Lancamento\SalaController::class, 'excelExame'])->name('salas.excel-exame');
    Route::post('salas/{sala}/codigos', [App\Http\Controllers\Lancamento\SalaController::class, 'gerarCodigos'])->name('salas.codigos');
    Route::get('salas/{sala}', [App\Http\Controllers\Lancamento\SalaController::class, 'show'])->name('salas.show');
    Route::patch('salas/{sala}', [App\Http\Controllers\Lancamento\SalaController::class, 'update'])->name('salas.update');
    Route::delete('salas/{sala}', [App\Http\Controllers\Lancamento\SalaController::class, 'destroy'])->name('salas.destroy');

    // Permitir que a Subcomissão de Lançamento altere/edite a nota de um candidato
    Route::patch('candidaturas/{candidatura}/nota', [App\Http\Controllers\Lancamento\CandidaturaController::class, 'updateNota'])->name('candidaturas.nota');
});

// Painel Professor (Subcomissão de Correcção) — lançamento de notas
Route::prefix('professor')->name('professor.')->middleware(['auth', 'subcomissao_correcao', 'throttle:1000,1'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('professor.candidaturas.index');
    })->name('dashboard');
    Route::get('salas', [App\Http\Controllers\Professor\SalaController::class, 'index'])->name('salas.index');
    Route::get('salas/{sala}', [App\Http\Controllers\Professor\SalaController::class, 'show'])->name('salas.show');
    Route::get('candidaturas', [App\Http\Controllers\Professor\CandidaturaController::class, 'index'])->name('candidaturas.index');
    Route::get('candidaturas/{candidatura}', [App\Http\Controllers\Professor\CandidaturaController::class, 'show'])->name('candidaturas.show');
    Route::match(['patch','post'], 'candidaturas/{candidatura}/nota', [App\Http\Controllers\Professor\CandidaturaController::class, 'updateNota'])->name('candidaturas.nota');

    // Notas por disciplina (correcção por disciplina) — formulário na view de candidatura
    Route::match(['post','patch'], 'candidaturas/{candidatura}/notas-disciplinas', [App\Http\Controllers\Professor\CandidaturaController::class, 'updateNotasDisciplinas'])->name('candidaturas.notas-disciplinas');
});

// Painel Presidência — impressão de pautas
Route::prefix('presidencia')->name('presidencia.')->middleware(['auth', 'presidencia', 'throttle:1000,1'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('presidencia.salas.index');
    })->name('dashboard');

    Route::get('salas', [App\Http\Controllers\Presidencia\SalaController::class, 'index'])->name('salas.index');
    Route::get('salas/lote/pdf', [App\Http\Controllers\Presidencia\SalaController::class, 'pdfLote'])->name('salas.pdf-lote');
    Route::get('salas/lote/pdf-exame', [App\Http\Controllers\Presidencia\SalaController::class, 'pdfExameLote'])->name('salas.pdf-exame-lote');
    Route::get('salas/lote/excel-exame', [App\Http\Controllers\Presidencia\SalaController::class, 'excelExameLote'])->name('salas.excel-exame-lote');
    Route::get('salas/lote/excel-notas', [App\Http\Controllers\Presidencia\SalaController::class, 'excelNotasLote'])->name('salas.excel-notas-lote');
    Route::get('salas/{sala}/pdf', [App\Http\Controllers\Presidencia\SalaController::class, 'pdf'])->name('salas.pdf');
    Route::get('salas/{sala}/pdf-exame', [App\Http\Controllers\Presidencia\SalaController::class, 'pdfExame'])->name('salas.pdf-exame');
    Route::get('salas/{sala}/excel-exame', [App\Http\Controllers\Presidencia\SalaController::class, 'excelExame'])->name('salas.excel-exame');
    Route::get('salas/{sala}/excel-notas', [App\Http\Controllers\Presidencia\SalaController::class, 'excelNotas'])->name('salas.excel-notas');
    Route::get('salas/{sala}', [App\Http\Controllers\Presidencia\SalaController::class, 'show'])->name('salas.show');
});

// Placeholder routes for later scaffolding
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/cursos', 'pages.cursos')->name('cursos');
Route::view('/pos-graduacao', 'pages.pos-graduacao')->name('pos-graduacao');
Route::view('/vida-academica', 'pages.vida')->name('vida');
Route::get('/noticias', [App\Http\Controllers\NoticiaController::class, 'index'])->name('noticias');
Route::view('/contactos', 'pages.contactos')->name('contactos');

// Rota para envio do formulário de contactos
use App\Http\Controllers\ContactController;
Route::post('/contactos/send', [ContactController::class, 'send'])->name('contact.send')->middleware('throttle:5,1');

// Alerts for concursos (subscribe)
use App\Http\Controllers\ConcursoAlertController;
Route::post('/alerts/subscribe', [ConcursoAlertController::class, 'store'])->name('alerts.subscribe')->middleware('throttle:5,1');
Route::view('/valores', 'pages.valores')->name('valores');
Route::view('/visao', 'pages.visao')->name('visao');
Route::redirect('/concursos', '/trabalhe-conosco', 301);

Route::get('/trabalhe-conosco', function () {
    $concursos = \App\Models\Concurso::where('status', 'published')
        ->orderByDesc('publish_at')
        ->get()
        ->map(function ($c) {
            if ($c->publish_at && ! $c->publish_at instanceof \Carbon\Carbon) {
                try { $c->publish_at = \Carbon\Carbon::parse($c->publish_at); }
                catch (\Throwable $e) { $c->publish_at = null; }
            }
            return $c;
        });
    $allCount = \App\Models\Concurso::count();
    $publishedCount = \App\Models\Concurso::where('status', 'published')->count();
    return view('pages.trabalhe-conosco', compact('concursos', 'allCount', 'publishedCount'));
})->name('trabalhe-conosco');
Route::view('/sistemas', 'pages.sistemas')->name('sistemas');
Route::view('/resultados', 'pages.resultados')->name('resultados');
Route::view('/presidencia', 'pages.presidencia')->name('presidencia');
Route::view('/pilares', 'pages.pilares')->name('pilares');
Route::view('/pesquisa', 'pages.pesquisa')->name('pesquisa');
Route::view('/missao', 'pages.missao')->name('missao');
Route::view('/mestrado', 'pages.mestrado')->name('mestrado');
Route::view('/linguas', 'pages.linguas')->name('linguas');
Route::view('/jornadas', 'pages.jornadas')->name('jornadas');
Route::get('/sobre-ispbie', [App\Http\Controllers\InstitucionalController::class, 'index'])->name('institucional');
Route::view('/inclusao', 'pages.inclusao')->name('inclusao');
Route::view('/guia-estudante', 'pages.guia-estudante')->name('guia-estudante');
Route::view('/gestao', 'pages.gestao')->name('gestao');
Route::view('/eventos', 'pages.eventos')->name('eventos');
Route::view('/estagios', 'pages.estagios')->name('estagios');
Route::view('/cursos-online', 'pages.cursos-online')->name('cursos-online');
Route::view('/cultura', 'pages.cultura')->name('cultura');
Route::view('/calendario-academico', 'pages.calendario-academico')->name('calendario-academico');

Route::view('/candidaturas', 'pages.candidaturas')->name('candidaturas');
// Limite bem mais alto do que o costume: muitos candidatos partilham o mesmo IP
// (redes de escola/universidade, Wi-Fi de campus, CGNAT de operadoras móveis),
// e com 3000+ pessoas em simultâneo em horário de pico, mesmo 30/min por IP
// esgotava-se rapidamente e bloqueava candidatos legítimos atrás do mesmo IP
// (erro 429, obrigando a várias tentativas). A submissão já está protegida
// contra duplicados a sério pela restrição única de BI+curso+período.
Route::post('/candidaturas', [App\Http\Controllers\CandidaturaController::class, 'store'])->name('candidaturas.store')->middleware('throttle:300,1');
Route::get('/candidaturas/{candidatura}/comprovativo', [App\Http\Controllers\CandidaturaController::class, 'comprovativo'])->name('candidaturas.comprovativo');
Route::get('/candidaturas/{candidatura}/pdf', [App\Http\Controllers\CandidaturaController::class, 'downloadPdf'])->name('candidaturas.pdf');

// Rotas públicas de Alumni - sem dados sensíveis

// Admin: gestão de disciplinas por sala (UI para configurar disciplinas e pesos)
Route::middleware(['auth', 'admin', 'throttle:1000,1'])->group(function () {
    Route::get('admin/salas/{sala}/disciplinas', [App\Http\Controllers\Admin\SalaDisciplineController::class, 'edit'])->name('admin.salas.disciplines.edit');
    Route::post('admin/salas/{sala}/disciplinas', [App\Http\Controllers\Admin\SalaDisciplineController::class, 'update'])->name('admin.salas.disciplines.update');
});

Route::get('/alumni', function () {
    $alumni = App\Models\Alumnus::where('publicado', true)->orderByDesc('created_at')->get();
    return view('pages.alumni', compact('alumni'));
})->name('alumni');
Route::post('/alumni', [App\Http\Controllers\AlumniController::class, 'store'])->name('alumni.store')->middleware('throttle:3,1');

// Rotas protegidas de Alumni - dados sensíveis apenas com autenticação
Route::middleware('auth')->group(function () {
    Route::get('/alumni/{id}/completo', [App\Http\Controllers\AlumniProtectedController::class, 'show'])->name('alumni.show.protected');
});

// Fallback: rota pública /alumni/{id} sem dados sensíveis (redirecionada ou minificada)
Route::get('/alumni/{id}', function ($id) {
    $alumnus = App\Models\Alumnus::where('id', $id)
        ->where('publicado', true)
        ->where('testemunho', true)
        ->firstOrFail();
    return view('pages.alumni-show', compact('alumnus'));
})->name('alumni.show');

// Rotas para Acesso Rápido
// Rota '/portal' removida (página externa usada em vez da view interna)
// Public listing of published revista articles
Route::get('/revista', [App\Http\Controllers\RevistaController::class, 'index'])->name('revista');
Route::get('/revista/{id}', [App\Http\Controllers\RevistaController::class, 'show'])->whereNumber('id')->name('revista.show');

// Revista: página de submissão (GET form + POST handler)
Route::get('/revista/submeter', function () {
    return view('pages.revista-submeter');
})->name('revista.submeter');

Route::post('/revista/submeter', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'required|string|max:10000',
        'link' => ['required','url','starts_with:http://,https://','max:2083'],
        'email' => 'required|email|max:255',
        'affiliation' => 'nullable|string|max:255',
        'category' => ['required','string','in:Engenharias e Tecnologia,Ciências da Saúde,Ciências Sociais e Humanas'],
        'notes' => 'nullable|string|max:5000',
    ]);

    // Save submission for moderation
    $submission = App\Models\RevistaSubmission::create([
        'title' => $request->input('title'),
        'author' => $request->input('author'),
        'description' => $request->input('description'),
        'link' => $request->input('link'),
        'email' => $request->input('email'),
        'affiliation' => $request->input('affiliation'),
        'category' => $request->input('category'),
        'notes' => $request->input('notes'),
        'status' => 'pending',
    ]);

    try {
        \Illuminate\Support\Facades\Mail::to('geral@isp-bie.ao')
            ->send(new App\Mail\RevistaSubmissionReceived($submission));
    } catch (\Throwable $e) {
        \Log::error('Falha ao enviar email de submissão da revista: '.$e->getMessage());
    }

    // Redirect to the submission page so user sees immediate feedback
    // (do NOT include old input on success so the form fields are cleared)
    return redirect()->route('revista.submeter')->with('status', 'Submissão recebida e pendente para  avaliação.');
})->name('revista.submeter.post')->middleware('throttle:3,1');
Route::view('/biblioteca', 'pages.biblioteca')->name('biblioteca');
Route::view('/repositorio', 'pages.repositorio')->name('repositorio');

Route::view('/busca-pessoas', 'pages.pesquisa-pessoas')->name('busca-pessoas');
Route::view('/busca-biblioteca', 'pages.busca-biblioteca')->name('busca-biblioteca');
// Rota para exibir notícia individual
Route::get('/noticias/{id}', [App\Http\Controllers\NoticiaController::class, 'show'])->name('noticias.show');
Route::view('/servicos', 'pages.servicos')->name('servicos');
Route::view('/parcerias', 'pages.parcerias')->name('parcerias');

// ─── Portal Alumni — Publico ──────────────────────────────────────────────────
Route::get('/portal/login', [App\Http\Controllers\Portal\AuthController::class, 'showLogin'])->name('portal.login');
Route::post('/portal/login', [App\Http\Controllers\Portal\AuthController::class, 'login'])->name('portal.login.post')->middleware('throttle:5,1');
Route::get('/portal/register', [App\Http\Controllers\Portal\AuthController::class, 'showRegister'])->name('portal.register');
Route::post('/portal/register', [App\Http\Controllers\Portal\AuthController::class, 'register'])->name('portal.register.post')->middleware('throttle:5,1');
Route::get('/portal/pendente', fn () => view('portal.pendente'))->name('portal.pendente');
Route::post('/portal/logout', [App\Http\Controllers\Portal\AuthController::class, 'logout'])->name('portal.logout');

// ─── Portal Alumni — Protegido ────────────────────────────────────────────────
Route::prefix('portal')->name('portal.')->middleware(['auth', 'alumni', 'throttle:60,1'])->group(function () {
    Route::get('/', [App\Http\Controllers\Portal\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/perfil', [App\Http\Controllers\Portal\PerfilController::class, 'edit'])->name('perfil');
    Route::put('/perfil', [App\Http\Controllers\Portal\PerfilController::class, 'update'])->name('perfil.update');
    Route::get('/noticias', [App\Http\Controllers\Portal\NoticiaController::class, 'index'])->name('noticias');
    Route::get('/noticias/{id}', [App\Http\Controllers\Portal\NoticiaController::class, 'show'])->name('noticias.show');
    Route::get('/diretorio', [App\Http\Controllers\Portal\DiretorioController::class, 'index'])->name('diretorio');
    Route::get('/documentos', [App\Http\Controllers\Portal\DocumentoController::class, 'index'])->name('documentos');
    Route::get('/documentos/{documento}/download', [App\Http\Controllers\Portal\DocumentoController::class, 'download'])->name('documentos.download');
});

require __DIR__.'/auth.php';
