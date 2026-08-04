@extends('layouts.daac')
@section('content')
<div style="max-width:1100px;margin:0 auto;">

    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:24px;">
        <div>
            <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 3px;">Candidaturas para Assinatura</h1>
            <p style="color:#64748b;font-size:0.92rem;margin:0;">Apenas candidaturas com pagamento confirmado pela Secretaria</p>
        </div>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:18px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- KPIs --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(140px,1fr));gap:12px;margin-bottom:22px;">
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#f59e0b;line-height:1;">{{ $totais['por_assinar'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Por assinar</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#1e3a5f;line-height:1;">{{ $totais['concluida'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Concluídas</div>
        </div>
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 18px;text-align:center;">
            <div style="font-size:1.8rem;font-weight:800;color:#1e3a5f;line-height:1;">{{ $totais['total'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Total</div>
        </div>
        <a href="{{ route('daac.candidaturas.index', array_merge(request()->except('sem_comprovativo'), ['sem_comprovativo' => 1])) }}"
           style="background:#fff;border:1px solid {{ request()->boolean('sem_comprovativo') ? '#dc2626' : '#e2e8f0' }};border-radius:14px;padding:16px 18px;text-align:center;text-decoration:none;display:block;">
            <div style="font-size:1.8rem;font-weight:800;color:#dc2626;line-height:1;">{{ $totais['sem_comprovativo'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Comprovativo não gerado</div>
        </a>
        <a href="{{ route('daac.candidaturas.index', array_merge(request()->except('whatsapp_falhou'), ['whatsapp_falhou' => 1])) }}"
           style="background:#fff;border:1px solid {{ request()->boolean('whatsapp_falhou') ? '#F05A28' : '#e2e8f0' }};border-radius:14px;padding:16px 18px;text-align:center;text-decoration:none;display:block;">
            <div style="font-size:1.8rem;font-weight:800;color:#F05A28;line-height:1;">{{ $totais['whatsapp_falhou'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Comprovativo não enviado</div>
        </a>
        <a href="{{ route('daac.candidaturas.index', array_merge(request()->except('whatsapp_enviado'), ['whatsapp_enviado' => 1])) }}"
           style="background:#fff;border:1px solid {{ request()->boolean('whatsapp_enviado') ? '#15803d' : '#e2e8f0' }};border-radius:14px;padding:16px 18px;text-align:center;text-decoration:none;display:block;">
            <div style="font-size:1.8rem;font-weight:800;color:#15803d;line-height:1;">{{ $totais['whatsapp_enviado'] }}</div>
            <div style="font-size:0.78rem;color:#64748b;margin-top:5px;font-weight:600;">Comprovativo enviado</div>
        </a>
    </div>

    @if(request()->boolean('sem_comprovativo'))
    <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:10px 18px;border-radius:10px;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;gap:10px;">
        <span>A mostrar apenas candidatos cujo comprovativo ainda não foi gerado/descarregado por ninguém.</span>
        <a href="{{ route('daac.candidaturas.index', request()->except('sem_comprovativo')) }}" style="color:#b91c1c;font-weight:700;text-decoration:underline;white-space:nowrap;">Limpar filtro</a>
    </div>
    @endif

    @if(request()->boolean('whatsapp_falhou'))
    <div style="background:#fff1ec;border:1px solid #F05A28;color:#c2410c;padding:10px 18px;border-radius:10px;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;gap:10px;">
        <span>A mostrar candidatos já assinados cujo comprovativo ainda não foi enviado por WhatsApp (tentativa falhada ou nunca tentada). Use "Enviar" na tabela para tentar agora.</span>
        <a href="{{ route('daac.candidaturas.index', request()->except('whatsapp_falhou')) }}" style="color:#c2410c;font-weight:700;text-decoration:underline;white-space:nowrap;">Limpar filtro</a>
    </div>
    @endif

    @if(request()->boolean('whatsapp_enviado'))
    <div style="background:#f0fdf4;border:1px solid #86efac;color:#15803d;padding:10px 18px;border-radius:10px;margin-bottom:16px;display:flex;align-items:center;justify-content:space-between;gap:10px;">
        <span>A mostrar apenas candidatos que já receberam o comprovativo assinado por WhatsApp.</span>
        <a href="{{ route('daac.candidaturas.index', request()->except('whatsapp_enviado')) }}" style="color:#15803d;font-weight:700;text-decoration:underline;white-space:nowrap;">Limpar filtro</a>
    </div>
    @endif

    {{-- Painel de Impressão em Lote --}}
    <div style="background:linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);border:1.5pt solid #f87171;border-radius:14px;padding:16px 20px;margin-bottom:22px;">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:12px;">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:#dc2626;flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2z"/>
            </svg>
            <div>
                <strong style="color:#dc2626;">Imprimir Folhas de Prova em Lote</strong>
                <p style="color:#991b1b;font-size:0.85rem;margin:2px 0 0;">Gere folhas de prova para um grupo de candidatos em uma única ação</p>
            </div>
        </div>
        <form method="GET" action="{{ route('daac.candidaturas.folhas-prova-lote') }}" style="display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
            <div style="flex:1;min-width:180px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#92400e;margin-bottom:5px;">Horário (opcional)</label>
                <select name="horario" style="width:100%;border:1px solid #fca5a5;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#fff;box-sizing:border-box;">
                    <option value="">Todos os horários</option>
                    @foreach(\App\Models\Sala::$horarios as $h)
                    <option value="{{ $h }}" {{ request('horario') === $h ? 'selected' : '' }}>{{ $h }}</option>
                    @endforeach
                </select>
                <p style="font-size:0.72rem;color:#991b1b;margin-top:4px;">Gera as folhas de todas as salas desse horário de uma vez.</p>
            </div>
            <div style="flex:1;min-width:180px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#92400e;margin-bottom:5px;">Sala (opcional)</label>
                <select name="sala_id" style="width:100%;border:1px solid #fca5a5;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#fff;box-sizing:border-box;">
                    <option value="">Todas as salas</option>
                    @foreach(\App\Models\Sala::ordenadaPorHorario()->get() as $sala)
                    <option value="{{ $sala->id }}">{{ $sala->nome }}{{ $sala->horario ? ' — ' . $sala->horario : '' }}</option>
                    @endforeach
                </select>
            </div>
            <div style="flex:1;min-width:180px;">
                <label style="display:block;font-size:0.8rem;font-weight:600;color:#92400e;margin-bottom:5px;">Curso (opcional)</label>
                <select name="curso" style="width:100%;border:1px solid #fca5a5;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#fff;box-sizing:border-box;">
                    <option value="">Todos os cursos</option>
                    @foreach(\App\Models\Candidatura::$cursos as $c)
                    <option value="{{ $c }}">{{ $c }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="background:#dc2626;color:#fff;border:none;border-radius:8px;padding:8px 20px;font-weight:700;cursor:pointer;font-size:0.88rem;white-space:nowrap;" onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                📄 Gerar PDF
            </button>
        </form>
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('daac.candidaturas.index') }}"
          style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;flex-wrap:wrap;gap:10px;align-items:flex-end;">
        @if(request()->boolean('sem_comprovativo'))
        <input type="hidden" name="sem_comprovativo" value="1">
        @endif
        @if(request()->boolean('whatsapp_falhou'))
        <input type="hidden" name="whatsapp_falhou" value="1">
        @endif
        @if(request()->boolean('whatsapp_enviado'))
        <input type="hidden" name="whatsapp_enviado" value="1">
        @endif
        <div style="flex:1;min-width:200px;position:relative;">
            <svg style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#94a3b8;" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Nome, BI ou n.º ficha..."
                   style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px 8px 32px;font-size:0.88rem;box-sizing:border-box;">
        </div>
        <div>
            <select name="status" style="border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#f8fafc;">
                <option value="">Todas</option>
                <option value="pendente"   {{ request('status') === 'pendente'   ? 'selected' : '' }}>Pendentes</option>
                <option value="em_analise" {{ request('status') === 'em_analise' ? 'selected' : '' }}>Em Análise</option>
                <option value="aprovada"   {{ request('status') === 'aprovada'   ? 'selected' : '' }}>Aprovadas</option>
                <option value="concluida"  {{ request('status') === 'concluida'  ? 'selected' : '' }}>Concluídas</option>
                <option value="rejeitada"  {{ request('status') === 'rejeitada'  ? 'selected' : '' }}>Rejeitadas</option>
            </select>
        </div>
        <div>
            <select name="curso" style="border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:0.88rem;background:#f8fafc;">
                <option value="">Todos os cursos</option>
                @foreach(\App\Models\Candidatura::$cursos as $c)
                <option value="{{ $c }}" {{ request('curso') === $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:8px 18px;font-weight:600;cursor:pointer;font-size:0.88rem;">Filtrar</button>
        @if(request()->hasAny(['q','status','curso']))
        <a href="{{ route('daac.candidaturas.index') }}" style="background:#f1f5f9;color:#475569;border-radius:8px;padding:8px 14px;font-weight:600;font-size:0.88rem;text-decoration:none;">Limpar</a>
        @endif
    </form>

    <div id="resultados-candidaturas">
        @include('daac.candidaturas._resultados')
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
