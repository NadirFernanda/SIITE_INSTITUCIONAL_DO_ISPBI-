@extends('layouts.secretaria')
@section('content')
<div style="max-width:1100px;margin:0 auto;">

    <div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Confirmação de Pagamentos</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Pesquise o candidato e confirme o pagamento da RUP</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:22px;">
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#1a2332;line-height:1;">{{ $totais['total'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Total</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#16a34a;line-height:1;">{{ $totais['confirmados'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Pagamentos confirmados</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#f59e0b;line-height:1;">{{ $totais['pendentes'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Aguardando pagamento</div>
        </div>
    </div>

    {{-- Separação rápida: confirmadas vs. não confirmadas --}}
    <div style="display:flex;gap:8px;margin-bottom:16px;border-bottom:2px solid #e2e8f0;">
        @php
            $abaAtiva = request('pagamento', '');
            $abaEstilo = fn($ativa) => $ativa
                ? 'color:#1e3a5f;border-bottom:2px solid #1e3a5f;margin-bottom:-2px;'
                : 'color:#64748b;border-bottom:2px solid transparent;margin-bottom:-2px;';
        @endphp
        <a href="{{ route('secretaria.candidaturas.index', array_filter(['q' => request('q'), 'curso' => request('curso')])) }}"
           style="padding:10px 16px;font-weight:700;font-size:0.9rem;text-decoration:none;{{ $abaEstilo($abaAtiva === '') }}">
            Todas ({{ $totais['total'] }})
        </a>
        <a href="{{ route('secretaria.candidaturas.index', array_filter(['q' => request('q'), 'curso' => request('curso'), 'pagamento' => 'nao'])) }}"
           style="padding:10px 16px;font-weight:700;font-size:0.9rem;text-decoration:none;{{ $abaEstilo($abaAtiva === 'nao') }}">
            Não confirmadas ({{ $totais['pendentes'] }})
        </a>
        <a href="{{ route('secretaria.candidaturas.index', array_filter(['q' => request('q'), 'curso' => request('curso'), 'pagamento' => 'sim'])) }}"
           style="padding:10px 16px;font-weight:700;font-size:0.9rem;text-decoration:none;{{ $abaEstilo($abaAtiva === 'sim') }}">
            Confirmadas ({{ $totais['confirmados'] }})
        </a>
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('secretaria.candidaturas.index') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
        <div style="flex:1;min-width:240px;position:relative;">
            <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="N.º ficha, nome, BI, email, telefone..."
                   style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px 9px 34px;font-size:0.9rem;box-sizing:border-box;">
        </div>
        <div>
            <select name="pagamento" style="border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.88rem;background:#f8fafc;">
                <option value="">Todos os pagamentos</option>
                <option value="nao" {{ request('pagamento') === 'nao' ? 'selected' : '' }}>Sem pagamento confirmado</option>
                <option value="sim" {{ request('pagamento') === 'sim' ? 'selected' : '' }}>Pagamento confirmado</option>
            </select>
        </div>
        <div>
            <select name="curso" style="border:1px solid #e2e8f0;border-radius:8px;padding:9px 12px;font-size:0.88rem;background:#f8fafc;">
                <option value="">Todos os cursos</option>
                @foreach(\App\Models\Candidatura::$cursos as $c)
                    <option value="{{ $c }}" {{ request('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:9px 20px;font-weight:700;cursor:pointer;font-size:0.9rem;">Pesquisar</button>
        @if(request()->hasAny(['q','pagamento','curso']))
        <a href="{{ route('secretaria.candidaturas.index') }}" style="background:#f1f5f9;color:#64748b;border-radius:8px;padding:9px 14px;font-weight:600;font-size:0.88rem;text-decoration:none;">Limpar</a>
        @endif
    </form>

    <div id="resultados-candidaturas">
        @include('secretaria.candidaturas._resultados')
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

    form.querySelectorAll('select').forEach(function (select) {
        select.addEventListener('change', pesquisarAoVivo);
    });
})();
</script>
@endsection
