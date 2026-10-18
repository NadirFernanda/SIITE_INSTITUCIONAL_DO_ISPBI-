@extends('layouts.admin')

@section('content')
<style>
    .cal-wrap{max-width:1040px;margin:auto;color:#334155}
    .cal-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin-bottom:24px}
    .cal-head h1{font-size:2rem;line-height:1.2;color:#1e3a5f;margin:0}
    .cal-head p{margin:8px 0 0;color:#475569}
    .cal-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:clamp(18px,4vw,28px);box-shadow:0 2px 8px rgba(21,101,192,.06);margin-bottom:22px}
    .cal-card h2{font-size:1.3rem;color:#1e3a5f;margin:0 0 8px}
    .cal-muted{color:#475569;line-height:1.55}
    .cal-form{display:grid;gap:14px}
    .cal-field{display:grid;gap:5px;font-weight:700;color:#334155}
    .cal-field input{box-sizing:border-box;width:100%;padding:10px 12px;border:1px solid #cbd5e1;border-radius:8px;font:inherit;color:#1e293b;background:#fff}
    .cal-button{justify-self:start;border:0;border-radius:8px;background:#1e3a5f;color:#fff;font:inherit;font-weight:700;padding:11px 18px;cursor:pointer}
    .cal-button-danger{background:#fff;border:1px solid #b91c1c;color:#b91c1c}
    .cal-link{color:#1e3a5f;font-weight:700;text-decoration:underline}
    .cal-check{display:flex;align-items:flex-start;gap:9px;line-height:1.4}
    .cal-check input{margin-top:3px}
    .cal-status{display:inline-block;border-radius:999px;background:#eff6ff;color:#1e3a5f;font-size:.88rem;font-weight:700;padding:6px 12px}
    .cal-actions{display:flex;flex-wrap:wrap;gap:16px;align-items:center;margin:16px 0}
    .cal-note{border-left:4px solid #F05A28;background:#fff7ed;padding:12px 15px;border-radius:8px;color:#7c2d12}
    .cal-link:focus-visible,.cal-button:focus-visible,.cal-field input:focus-visible,.cal-check input:focus-visible{outline:2px solid #F05A28;outline-offset:3px}
    @media(max-width:900px){
        .sidebar[style]{height:auto!important;min-height:64px;flex-direction:row!important;align-items:center;overflow:hidden}
        .sidebar>div:first-of-type{flex:1 1 auto!important;min-width:0;flex-direction:row!important;overflow-x:auto!important;overflow-y:hidden!important;white-space:nowrap}
        .sidebar>div:first-of-type a{flex:0 0 auto}
        .sidebar>div:last-of-type{margin:0 8px!important;padding:0!important;border:0!important}
    }
    @media(max-width:680px){.cal-wrap{min-width:0}.cal-card{padding:18px}}
</style>

<div class="cal-wrap">
    <header class="cal-head">
        <div>
            <h1>Calendário Académico</h1>
            <p>Prepare o PDF oficial em privado, pré-visualize e publique após aprovação institucional.</p>
        </div>
        <a class="cal-link" href="{{ route('calendario-academico') }}" target="_blank" rel="noopener">Ver página pública</a>
    </header>

    @if(session('success'))
        <p role="status" style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px 16px;border-radius:8px;">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <div role="alert" style="background:#fef2f2;border:1px solid #fca5a5;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="margin:3px 0;">{{ $error }}</p>@endforeach
        </div>
    @endif

    <section class="cal-card" aria-labelledby="cal-publicado">
        <h2 id="cal-publicado">Documento publicado</h2>
        @if(\App\Support\AcademicCalendar::hasPdf($published))
            <p class="cal-status">Ano académico {{ $published['ano'] }}</p>
            <div class="cal-actions">
                <a class="cal-link" href="{{ route('calendario-academico.visualizar') }}" target="_blank" rel="noopener">Consultar PDF publicado</a>
                <a class="cal-link" href="{{ route('calendario-academico.documento') }}">Descarregar PDF publicado</a>
            </div>
        @elseif($published)
            <p class="cal-muted">Existe uma versão anterior sem PDF. Ela não é apresentada na página pública.</p>
        @else
            <p class="cal-muted">Ainda não há um PDF oficial do calendário académico publicado.</p>
        @endif
        @if($published)
            <form method="POST" action="{{ route('admin.calendario-academico.despublicar') }}" class="cal-form" style="border-top:1px solid #e2e8f0;padding-top:16px;">
                @csrf
                <label class="cal-check"><input type="checkbox" name="confirmar_retirada" value="1" required> Confirmo que quero retirar esta versão da página pública. O rascunho e os ficheiros permanecem guardados.</label>
                <button class="cal-button cal-button-danger" type="submit">Retirar de publicação</button>
            </form>
        @endif
    </section>

    <section class="cal-card" aria-labelledby="cal-rascunho">
        <h2 id="cal-rascunho">Rascunho e ano académico</h2>
        @if($draft)
            <p class="cal-status">Rascunho: {{ $draft['ano'] }}</p>
            <p class="cal-muted">{{ \App\Support\AcademicCalendar::hasPdf($draft) ? 'PDF carregado.' : 'PDF ainda não carregado.' }} As alterações no rascunho não modificam o documento publicado.</p>
            <div class="cal-actions">
                <a class="cal-link" href="{{ route('admin.calendario-academico.preview') }}" target="_blank" rel="noopener">Pré-visualizar página privada</a>
                @if(\App\Support\AcademicCalendar::hasPdf($draft))
                    <a class="cal-link" href="{{ route('admin.calendario-academico.documento.preview') }}" target="_blank" rel="noopener">Pré-visualizar PDF privado</a>
                @endif
            </div>
        @else
            <p class="cal-muted">Indique o ano académico do documento oficial a preparar.</p>
        @endif

        <form method="POST" action="{{ route('admin.calendario-academico.rascunho') }}" class="cal-form">
            @csrf
            <label class="cal-field" for="cal-ano">Ano académico
                <input id="cal-ano" name="ano" type="text" inputmode="numeric" pattern="20[0-9]{2}/20[0-9]{2}" maxlength="9" required value="{{ old('ano') }}">
            </label>
            @if($draft)
                <label class="cal-check"><input type="checkbox" name="confirmar_substituicao" value="1" required> Confirmo que quero iniciar outro rascunho. O rascunho actual será substituído; o documento publicado mantém-se.</label>
            @endif
            <button class="cal-button" type="submit">{{ $draft ? 'Iniciar outro rascunho' : 'Criar rascunho' }}</button>
        </form>
    </section>

    @if($draft)
        <section class="cal-card" aria-labelledby="cal-pdf">
            <h2 id="cal-pdf">PDF oficial do rascunho</h2>
            <p class="cal-muted">O ficheiro fica em armazenamento privado até à publicação deste rascunho.</p>
            <form method="POST" action="{{ route('admin.calendario-academico.documento.upload') }}" enctype="multipart/form-data" class="cal-form">
                @csrf
                <label class="cal-field" for="cal-documento">Carregar ou substituir PDF
                    <input id="cal-documento" type="file" name="documento" accept=".pdf,application/pdf" required>
                </label>
                <p class="cal-muted" style="margin:0;font-size:.9rem;">PDF válido, até 25 MB. Uma falha de carregamento não altera a versão publicada.</p>
                <button class="cal-button" type="submit">Guardar PDF no rascunho</button>
            </form>
            @if(\App\Support\AcademicCalendar::hasPdf($draft))
                <form method="POST" action="{{ route('admin.calendario-academico.documento.remove') }}" class="cal-form" style="border-top:1px solid #e2e8f0;margin-top:22px;padding-top:18px;">
                    @csrf
                    @method('DELETE')
                    <label class="cal-check"><input type="checkbox" name="confirmar_remocao" value="1" required> Confirmo que quero retirar o PDF deste rascunho. O documento publicado mantém-se.</label>
                    <button class="cal-button cal-button-danger" type="submit">Retirar PDF do rascunho</button>
                </form>
            @endif
        </section>

        <section class="cal-card" aria-labelledby="cal-publicar">
            <h2 id="cal-publicar">Publicação</h2>
            <p class="cal-note">Confirme o ano académico e o PDF na pré-visualização privada antes de publicar. O documento actualmente publicado mantém-se disponível até à aprovação do novo rascunho.</p>
            @if(\App\Support\AcademicCalendar::hasPdf($draft))
                <div class="cal-actions"><a class="cal-link" href="{{ route('admin.calendario-academico.preview') }}" target="_blank" rel="noopener">Abrir pré-visualização privada</a></div>
                <form method="POST" action="{{ route('admin.calendario-academico.publicar') }}" class="cal-form">
                    @csrf
                    <input type="hidden" name="revisao" value="{{ $draftRevision }}">
                    <label class="cal-check"><input type="checkbox" name="confirmar_publicacao" value="1" required> Confirmo que o PDF do calendário académico {{ $draft['ano'] }} foi aprovado para publicação institucional.</label>
                    <button class="cal-button" type="submit">Publicar PDF oficial</button>
                </form>
            @else
                <p class="cal-muted">Carregue um PDF válido para activar a publicação.</p>
            @endif
        </section>
    @endif
</div>
@endsection
