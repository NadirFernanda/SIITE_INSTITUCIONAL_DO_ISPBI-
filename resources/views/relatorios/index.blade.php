@extends($layout)
@section('content')
@php
    $efLabels = ['maximo'=>'Máximo','medio'=>'Médio','minimo'=>'Mínimo'];
    $routePrefix = str_contains($layout, 'admin') ? 'admin' : (str_contains($layout, 'tecnico') ? 'tecnico' : 'daac');
@endphp
<div style="max-width:1200px;margin:0 auto;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Relatórios de Candidaturas</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Filtre e exporte dados de candidaturas</p>
        </div>
        <a href="{{ route($routePrefix.'.relatorios.export') }}{{ request()->getQueryString() ? '?'.request()->getQueryString() : '' }}"
           style="display:inline-flex;align-items:center;gap:7px;background:#22c55e;color:#fff;padding:10px 20px;border-radius:10px;font-weight:700;font-size:0.88rem;text-decoration:none;">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            Exportar CSV
        </a>
    </div>

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(130px,1fr));gap:10px;margin-bottom:20px;">
        @foreach([
            ['Total',       $stats['total'],   '#1565c0','#e3f2fd'],
            ['Masculino',   $stats['masc'],    '#0369a1','#e0f2fe'],
            ['Feminino',    $stats['fem'],     '#7c3aed','#ede9fe'],
            ['Regular',     $stats['regular'], '#15803d','#dcfce7'],
            ['Pós-Laboral', $stats['posLab'],  '#b45309','#fef3c7'],
        ] as [$lbl,$val,$cor,$bg])
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px 16px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:{{ $cor }};line-height:1;">{{ $val }}</div>
            <div style="font-size:0.75rem;color:#64748b;margin-top:4px;font-weight:600;">{{ $lbl }}</div>
        </div>
        @endforeach
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route($routePrefix.'.relatorios') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:20px 24px;margin-bottom:20px;">

        {{-- Pesquisa principal --}}
        <div style="display:flex;gap:10px;margin-bottom:14px;">
            <div style="flex:1;position:relative;">
                <svg style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Nome, n.º ficha, BI, email, escola, província, município..."
                       style="width:100%;border:1.5px solid {{ request('q') ? '#2563eb':'#e2e8f0' }};border-radius:10px;padding:10px 14px 10px 36px;font-size:0.9rem;box-sizing:border-box;">
            </div>
            <button type="submit"
                    style="background:#1565c0;color:#fff;border:none;border-radius:10px;padding:10px 22px;font-weight:700;cursor:pointer;font-size:0.9rem;white-space:nowrap;">
                Filtrar
            </button>
            @if(request()->hasAny(['q','status','periodo','sexo','curso','estado_financeiro','trabalhador','naturalidade_provincia','data_inicio','data_fim']))
            <a href="{{ route($routePrefix.'.relatorios') }}"
               style="background:#f1f5f9;color:#64748b;border-radius:10px;padding:10px 16px;font-weight:600;font-size:0.88rem;text-decoration:none;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Limpar
            </a>
            @endif
        </div>

        {{-- Filtros secundários --}}
        <div style="display:flex;flex-wrap:wrap;gap:10px;">
            {{-- Período --}}
            <div style="min-width:130px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Período</label>
                <select name="periodo" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    <option value="regular"     {{ request('periodo')==='regular'     ? 'selected':'' }}>Regular</option>
                    <option value="pos-laboral" {{ request('periodo')==='pos-laboral' ? 'selected':'' }}>Pós-Laboral</option>
                </select>
            </div>
            {{-- Sexo --}}
            <div style="min-width:120px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Sexo</label>
                <select name="sexo" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    <option value="masculino" {{ request('sexo')==='masculino' ? 'selected':'' }}>Masculino</option>
                    <option value="feminino"  {{ request('sexo')==='feminino'  ? 'selected':'' }}>Feminino</option>
                </select>
            </div>
            {{-- Curso --}}
            <div style="min-width:200px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Curso</label>
                <select name="curso" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$cursos as $c)
                        <option value="{{ $c }}" {{ request('curso')===$c ? 'selected':'' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Status --}}
            <div style="min-width:130px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Estado</label>
                <select name="status" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::$statusLabels as $val => $lbl)
                        <option value="{{ $val }}" {{ request('status')===$val ? 'selected':'' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Província --}}
            <div style="min-width:160px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Província</label>
                <select name="naturalidade_provincia" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todas</option>
                    @foreach($provincias as $p)
                        <option value="{{ $p }}" {{ request('naturalidade_provincia')===$p ? 'selected':'' }}>{{ $p }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Necessidade de Educação Especial --}}
            <div style="min-width:240px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Necessidade de Ed. Especial</label>
                <select name="necessidade_especial" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todas</option>
                    <option value="Nenhuma" {{ request('necessidade_especial')==='Nenhuma' ? 'selected':'' }}>Nenhuma</option>
                    <option value="Filhos de antigos combatentes" {{ request('necessidade_especial')==='Filhos de antigos combatentes' ? 'selected':'' }}>Filhos de antigos combatentes</option>
                    <option value="Áreas Steam" {{ request('necessidade_especial')==='Áreas Steam' ? 'selected':'' }}>Áreas Steam</option>
                    <option value="Portadores de deficiência" {{ request('necessidade_especial')==='Portadores de deficiência' ? 'selected':'' }}>Portadores de deficiência</option>
                </select>
            </div>
            {{-- Est. Financeiro --}}
            <div style="min-width:130px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Est. Financeiro</label>
                <select name="estado_financeiro" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach($efLabels as $val => $lbl)
                        <option value="{{ $val }}" {{ request('estado_financeiro')===$val ? 'selected':'' }}>{{ $lbl }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Trabalhador --}}
            <div style="min-width:120px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Trabalhador</label>
                <select name="trabalhador" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    <option value="sim" {{ request('trabalhador')==='sim' ? 'selected':'' }}>Sim</option>
                    <option value="nao" {{ request('trabalhador')==='nao' ? 'selected':'' }}>Não</option>
                </select>
            </div>
            {{-- Datas --}}
            <div style="min-width:140px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Data Início</label>
                <input type="date" name="data_inicio" value="{{ request('data_inicio') }}"
                       style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;box-sizing:border-box;">
            </div>
            <div style="min-width:140px;">
                <label style="display:block;font-size:0.72rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:3px;">Data Fim</label>
                <input type="date" name="data_fim" value="{{ request('data_fim') }}"
                       style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.87rem;box-sizing:border-box;">
            </div>
        </div>
    </form>

    <div id="resultados-candidaturas">
        @include('relatorios._resultados')
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

    form.querySelectorAll('select, input[type="date"]').forEach(function (campo) {
        campo.addEventListener('change', pesquisarAoVivo);
    });
})();
</script>
@endsection
