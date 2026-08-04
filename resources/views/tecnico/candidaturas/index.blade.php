@extends('layouts.tecnico')

@section('content')
<div style="max-width:1100px;margin:0 auto;">

    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:26px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Candidaturas Online</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Gestão e acompanhamento das candidaturas recebidas</p>
        </div>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="{{ route('tecnico.candidaturas.create') }}"
               style="display:inline-flex;align-items:center;gap:7px;background:#1e3a5f;color:#fff;padding:9px 18px;border-radius:10px;font-weight:700;font-size:0.88rem;text-decoration:none;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Nova Candidatura
            </a>
            <a href="{{ route('tecnico.candidaturas.export') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
               style="display:inline-flex;align-items:center;gap:7px;background:#22c55e;color:#fff;padding:9px 18px;border-radius:10px;font-weight:600;font-size:0.88rem;text-decoration:none;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                Exportar CSV
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:11px 16px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:9px;">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(120px,1fr));gap:10px;margin-bottom:22px;">
        @php
        $kpis = [
            ['label'=>'Total',       'value'=>$totais['total'],      'color'=>'#1e3a5f','bg'=>'#eaeff5'],
            ['label'=>'Pendentes',   'value'=>$totais['pendente'],   'color'=>'#b45309','bg'=>'#fef3c7'],
            ['label'=>'Em Análise',  'value'=>$totais['em_analise'], 'color'=>'#0f1f3d','bg'=>'#eaeff5'],
            ['label'=>'Aprovadas',   'value'=>$totais['aprovada'],   'color'=>'#15803d','bg'=>'#dcfce7'],
            ['label'=>'Rejeitadas',  'value'=>$totais['rejeitada'],  'color'=>'#b91c1c','bg'=>'#fee2e2'],
        ];
        @endphp
        @foreach($kpis as $k)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:{{ $k['color'] }};line-height:1;">{{ $k['value'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">{{ $k['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Pesquisa avançada --}}
    <form method="GET" action="{{ route('tecnico.candidaturas.index') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:20px 24px;margin-bottom:20px;box-shadow:0 1px 4px rgba(0,0,0,0.04);">

        <div style="display:flex;gap:10px;align-items:center;margin-bottom:14px;">
            <div style="flex:1;position:relative;">
                <svg style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Pesquisar por nome, nº ficha, BI, email, telefone, escola, município, bairro..."
                       style="width:100%;border:1.5px solid {{ request('q') ? '#1e3a5f' : '#e2e8f0' }};border-radius:10px;padding:10px 14px 10px 38px;font-size:0.92rem;box-sizing:border-box;"
                       onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor=this.value?'#1e3a5f':'#e2e8f0'">
            </div>
            <button type="submit"
                    style="background:#1e3a5f;color:#fff;border:none;border-radius:10px;padding:10px 22px;font-weight:700;cursor:pointer;font-size:0.9rem;white-space:nowrap;display:flex;align-items:center;gap:6px;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
                Pesquisar
            </button>
            @if(request()->hasAny(['q','status','curso','periodo','local_inscricao']))
            <a href="{{ route('tecnico.candidaturas.index') }}"
               style="background:#f1f5f9;color:#64748b;border-radius:10px;padding:10px 16px;font-weight:600;font-size:0.88rem;text-decoration:none;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Limpar
            </a>
            @endif
        </div>

        <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
            <div style="min-width:130px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Estado</label>
                <select name="status" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$statusLabels as $val => $label)
                        <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:200px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Curso</label>
                <select name="curso" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$cursos as $c)
                        <option value="{{ $c }}" {{ request('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <div style="min-width:140px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Período</label>
                <select name="periodo" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    <option value="regular"    {{ request('periodo') === 'regular'    ? 'selected' : '' }}>Regular</option>
                    <option value="pos-laboral"{{ request('periodo') === 'pos-laboral'? 'selected' : '' }}>Pós-Laboral</option>
                </select>
            </div>
            <div style="min-width:160px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Local</label>
                <select name="local_inscricao" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$locaisInscricao as $val => $label)
                        <option value="{{ $val }}" {{ request('local_inscricao') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            @if(request()->hasAny(['q','status','curso','periodo','local_inscricao']))
            <div style="padding-bottom:2px;">
                <span style="font-size:0.8rem;color:#64748b;background:#f1f5f9;padding:4px 10px;border-radius:20px;">
                    {{ $candidaturas->total() }} resultado{{ $candidaturas->total() !== 1 ? 's' : '' }}
                </span>
            </div>
            @endif
        </div>
    </form>

    <div id="resultados-candidaturas">
        @include('tecnico.candidaturas._resultados')
    </div>

</div>

<script>
(function () {
    var form = document.querySelector('input[name="q"]')?.closest('form');
    var input = document.querySelector('input[name="q"]');
    var container = document.getElementById('resultados-candidaturas');
    if (!form || !input || !container) return;

    var timer = null;
    var controller = null;

    function pesquisarAoVivo() {
        if (controller) controller.abort();
        controller = new AbortController();

        var params = new URLSearchParams(new FormData(form));
        var url = form.action + '?' + params.toString();

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            signal: controller.signal,
        })
            .then(function (r) { return r.text(); })
            .then(function (html) {
                container.innerHTML = html;
                window.history.replaceState(null, '', url);
            })
            .catch(function (e) {
                if (e.name !== 'AbortError') console.error(e);
            });
    }

    input.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(pesquisarAoVivo, 450);
    });
})();
</script>
@endsection
