@extends('layouts.admin')

@section('content')
<style>
    .cal-wrap{max-width:1040px;margin:auto;color:#334155}
    .cal-head{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin-bottom:24px}
    .cal-head h1{font-size:2rem;line-height:1.2;color:#1e3a5f;margin:0}
    .cal-head p{margin:8px 0 0;color:#64748b}
    .cal-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:clamp(18px,4vw,28px);box-shadow:0 2px 8px rgba(21,101,192,.06);margin-bottom:22px}
    .cal-card h2{font-size:1.3rem;color:#1e3a5f;margin:0 0 8px}
    .cal-muted{color:#64748b;line-height:1.55}
    .cal-form{display:grid;gap:14px}
    .cal-field{display:grid;gap:5px;font-weight:700;color:#334155}
    .cal-field input{box-sizing:border-box;width:100%;padding:10px 12px;border:1px solid #cbd5e1;border-radius:8px;font:inherit;color:#1e293b;background:#fff}
    .cal-button{justify-self:start;border:0;border-radius:8px;background:#1e3a5f;color:#fff;font:inherit;font-weight:700;padding:11px 18px;cursor:pointer}
    .cal-button-danger{background:#fff;border:1px solid #b91c1c;color:#b91c1c}
    .cal-link{color:#1e3a5f;font-weight:700;text-decoration:underline}
    .cal-check{display:flex;align-items:flex-start;gap:9px;line-height:1.4}
    .cal-check input{margin-top:3px}
    .cal-status{display:inline-block;border-radius:999px;background:#eff6ff;color:#1e3a5f;font-size:.88rem;font-weight:700;padding:6px 12px}
    .cal-document-frame{margin:18px 0;overflow:hidden;border:1px solid #e2e8f0;border-radius:12px;background:#f8fafc;padding:12px}
    .cal-document{display:block;width:100%;height:min(70vh,620px);min-height:420px;border:0;background:#fff}
    .cal-document[hidden]{display:none}
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
            <p>Indique o ano académico e publique o PDF oficial do calendário.</p>
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
        <h2 id="cal-publicado">PDF publicado</h2>
        @if($published)
            <p class="cal-status">Ano académico {{ $published['ano'] }}</p>
            <div class="cal-document-frame">
                <iframe class="cal-document" src="{{ route('calendario-academico.visualizar') }}"
                    title="Calendário Académico {{ $published['ano'] }} actualmente publicado em PDF" loading="lazy"></iframe>
            </div>
            <p><a class="cal-link" href="{{ route('calendario-academico.visualizar') }}" target="_blank" rel="noopener noreferrer">Consultar PDF publicado</a></p>
            <form method="POST" action="{{ route('admin.calendario-academico.despublicar') }}" class="cal-form" style="border-top:1px solid #e2e8f0;padding-top:16px;">
                @csrf
                <label class="cal-check"><input type="checkbox" name="confirmar_retirada" value="1" required> Confirmo que quero retirar este PDF da página pública. O ficheiro permanecerá guardado.</label>
                <button class="cal-button cal-button-danger" type="submit">Retirar de publicação</button>
            </form>
        @else
            <p class="cal-muted">Ainda não há um PDF do calendário académico publicado.</p>
        @endif
    </section>

    <section class="cal-card" aria-labelledby="cal-publicar">
        <h2 id="cal-publicar">{{ $published ? 'Substituir PDF' : 'Publicar calendário' }}</h2>
        <p class="cal-muted">O documento anterior mantém-se publicado se o carregamento falhar. PDF, até 25 MB.</p>
        <form method="POST" action="{{ route('admin.calendario-academico.publicar') }}" enctype="multipart/form-data" class="cal-form">
            @csrf
            <label class="cal-field" for="cal-ano">Ano académico
                <input id="cal-ano" name="ano" type="text" inputmode="numeric" pattern="20[0-9]{2}/20[0-9]{2}"
                    placeholder="2026/2027" maxlength="9" required value="{{ old('ano', $published['ano'] ?? '') }}">
            </label>
            <label class="cal-field" for="cal-documento">PDF oficial do calendário
                <input id="cal-documento" type="file" name="documento" accept=".pdf,application/pdf" required>
            </label>
            <div id="cal-preview" class="cal-document-frame" hidden>
                <p class="cal-muted">Pré-visualização local do PDF seleccionado</p>
                <iframe id="cal-preview-document" class="cal-document" title="Pré-visualização do novo PDF do calendário" hidden></iframe>
            </div>
            <button class="cal-button" type="submit">{{ $published ? 'Substituir PDF publicado' : 'Publicar PDF' }}</button>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
(() => {
    const input = document.getElementById('cal-documento');
    const frame = document.getElementById('cal-preview');
    const documentFrame = document.getElementById('cal-preview-document');
    if (!input || !frame || !documentFrame) return;
    let url;
    input.addEventListener('change', () => {
        if (url) URL.revokeObjectURL(url);
        const file = input.files[0];
        if (!file || file.type !== 'application/pdf') {
            documentFrame.removeAttribute('src');
            documentFrame.hidden = frame.hidden = true;
            return;
        }
        url = URL.createObjectURL(file);
        documentFrame.src = url;
        documentFrame.hidden = frame.hidden = false;
    });
})();
</script>
@endpush
