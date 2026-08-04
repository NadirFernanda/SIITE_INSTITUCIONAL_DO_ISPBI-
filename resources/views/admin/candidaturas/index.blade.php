@extends('layouts.admin')

@section('content')
<div class="compact" style="padding:32px 24px;max-width:1200px;margin:0 auto;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:28px;">
        <div>
            <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Candidaturas Online</h1>
            <p style="color:#64748b;font-size:0.95rem;margin:0;">Gestão das candidaturas recebidas</p>
        </div>
        <a href="{{ route('admin.candidaturas.export') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}"
           style="display:inline-flex;align-items:center;gap:8px;background:#22c55e;color:#fff;padding:10px 20px;border-radius:10px;font-weight:600;font-size:0.9rem;text-decoration:none;"
           onmouseover="this.style.background='#16a34a'" onmouseout="this.style.background='#22c55e'">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            Exportar CSV
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- KPI cards --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:28px;">
        @php
        $kpis = [
            ['label'=>'Total','value'=>$totais['total'],'color'=>'#1e3a5f','bg'=>'#eaeff5'],
            ['label'=>'Pendentes','value'=>$totais['pendente'],'color'=>'#b45309','bg'=>'#fef3c7'],
            ['label'=>'Em Análise','value'=>$totais['em_analise'],'color'=>'#0f1f3d','bg'=>'#eaeff5'],
            ['label'=>'Aprovadas','value'=>$totais['aprovada'],'color'=>'#15803d','bg'=>'#dcfce7'],
            ['label'=>'Rejeitadas','value'=>$totais['rejeitada'],'color'=>'#b91c1c','bg'=>'#fee2e2'],
        ];
        @endphp
        @foreach($kpis as $k)
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px 22px;text-align:center;">
            <div class="kpi-value" style="font-weight:800;color:{{ $k['color'] }};line-height:1;">{{ $k['value'] }}</div>
            <div style="font-size:0.8rem;color:#64748b;margin-top:6px;font-weight:600;">{{ $k['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- KPIs de notificações WhatsApp --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px;margin-bottom:20px;">
        <a href="{{ route('admin.candidaturas.index', array_merge(request()->except('sem_recebida'), ['sem_recebida' => 1])) }}"
           style="background:#fff;border:1px solid {{ request()->boolean('sem_recebida') ? '#F05A28' : '#e2e8f0' }};border-radius:14px;padding:14px 18px;text-align:center;text-decoration:none;display:block;">
            <div style="font-size:1.5rem;font-weight:800;color:#F05A28;line-height:1;">{{ $totais['sem_recebida'] }}</div>
            <div style="font-size:0.76rem;color:#64748b;margin-top:4px;font-weight:600;">Msg. 1 (Recebida) não enviada</div>
        </a>
        <a href="{{ route('admin.candidaturas.index', array_merge(request()->except('sem_pagamento_whatsapp'), ['sem_pagamento_whatsapp' => 1])) }}"
           style="background:#fff;border:1px solid {{ request()->boolean('sem_pagamento_whatsapp') ? '#F05A28' : '#e2e8f0' }};border-radius:14px;padding:14px 18px;text-align:center;text-decoration:none;display:block;">
            <div style="font-size:1.5rem;font-weight:800;color:#F05A28;line-height:1;">{{ $totais['sem_pagamento_whatsapp'] }}</div>
            <div style="font-size:0.76rem;color:#64748b;margin-top:4px;font-weight:600;">Msg. 2 (Pagamento) não enviada</div>
        </a>
    </div>

    @if(request()->boolean('sem_recebida'))
    <div style="background:#fff1ec;border:1px solid #F05A28;color:#c2410c;padding:10px 18px;border-radius:10px;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;gap:10px;">
        <span>A mostrar candidatos que ainda não receberam a mensagem de WhatsApp "candidatura recebida".</span>
        <a href="{{ route('admin.candidaturas.index', request()->except('sem_recebida')) }}" style="color:#c2410c;font-weight:700;text-decoration:underline;white-space:nowrap;">Limpar filtro</a>
    </div>
    @endif

    @if(request()->boolean('sem_pagamento_whatsapp'))
    <div style="background:#fff1ec;border:1px solid #F05A28;color:#c2410c;padding:10px 18px;border-radius:10px;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;gap:10px;">
        <span>A mostrar candidatos com pagamento confirmado que ainda não receberam a mensagem de WhatsApp "pagamento confirmado".</span>
        <a href="{{ route('admin.candidaturas.index', request()->except('sem_pagamento_whatsapp')) }}" style="color:#c2410c;font-weight:700;text-decoration:underline;white-space:nowrap;">Limpar filtro</a>
    </div>
    @endif

    {{-- Pesquisa avançada --}}
    <form method="GET" action="{{ route('admin.candidaturas.index') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:20px 24px;margin-bottom:22px;box-shadow:0 1px 4px rgba(0,0,0,0.04);">
        @if(request()->boolean('sem_recebida'))
        <input type="hidden" name="sem_recebida" value="1">
        @endif
        @if(request()->boolean('sem_pagamento_whatsapp'))
        <input type="hidden" name="sem_pagamento_whatsapp" value="1">
        @endif

        {{-- Barra principal de pesquisa --}}
        <div style="display:flex;gap:10px;align-items:center;margin-bottom:14px;">
            <div style="flex:1;position:relative;">
                <svg style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35"/></svg>
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Pesquisar por nome, nº ficha, BI, email, telefone, escola, município, bairro, pai, mãe..."
                       style="width:100%;border:1.5px solid {{ request('q') ? '#1e3a5f' : '#e2e8f0' }};border-radius:10px;padding:10px 14px 10px 38px;font-size:0.92rem;box-sizing:border-box;outline:none;transition:border 0.2s;"
                       onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor=this.value?'#1e3a5f':'#e2e8f0'">
            </div>
            <button type="submit"
                    style="background:#1e3a5f;color:#fff;border:none;border-radius:10px;padding:10px 22px;font-weight:700;cursor:pointer;font-size:0.9rem;white-space:nowrap;display:flex;align-items:center;gap:6px;">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
                Pesquisar
            </button>
            @if(request()->hasAny(['q','status','curso','periodo','local_inscricao']))
            <a href="{{ route('admin.candidaturas.index') }}"
               style="background:#f1f5f9;color:#64748b;border-radius:10px;padding:10px 16px;font-weight:600;font-size:0.88rem;text-decoration:none;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                Limpar
            </a>
            @endif
        </div>

        {{-- Filtros secundários --}}
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
                    <option value="Outro" {{ request('curso') === 'Outro' ? 'selected' : '' }}>Outro — Curso não listado</option>
                </select>
            </div>

            <div style="min-width:200px;">
                <label style="display:block;font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:4px;">Perfil</label>
                <select name="perfil" style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.88rem;background:#f8fafc;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Candidatura::todosOsPerfis() as $p)
                        <option value="{{ $p }}" {{ request('perfil') === $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                    <option value="Outro" {{ request('perfil') === 'Outro' ? 'selected' : '' }}>Outro — Perfil não listado</option>
                </select>
            </div>

            <div style="align-self:flex-end;">
                <a href="{{ route('admin.candidaturas.index', array_merge(request()->except('page'), ['curso' => 'Outro'])) }}"
                   style="display:inline-block;background:#F05A28;color:#fff;padding:8px 12px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;margin-left:8px;">
                    Mostrar "Outro"
                </a>
                <a href="{{ route('admin.candidaturas.index', array_merge(request()->except('page'), ['perfil' => 'Outro'])) }}"
                   style="display:inline-block;background:#0f1f3d;color:#fff;padding:8px 12px;border-radius:10px;font-weight:700;font-size:0.85rem;text-decoration:none;margin-left:8px;">
                    Mostrar perfil "Outro"
                </a>
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
        @include('admin.candidaturas._resultados')
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

    // Pesquisa/Limpar continuam a fazer um pedido normal (a pesquisa ao vivo só
    // substitui a necessidade de clicar Pesquisar depois de escrever).
})();
</script>
@endsection
