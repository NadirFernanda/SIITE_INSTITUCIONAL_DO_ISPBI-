@extends('layouts.professor')
@section('content')
<div style="max-width:600px;margin:0 auto;">

    <a href="{{ route('professor.notas.index') }}"
       style="display:inline-flex;align-items:center;gap:5px;color:#0e7490;font-weight:600;font-size:0.88rem;text-decoration:none;margin-bottom:22px;">
        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
        Voltar à lista
    </a>

    {{-- Cabeçalho anónimo --}}
    <div style="background:#0e7490;color:#fff;border-radius:14px 14px 0 0;padding:22px 26px;">
        <div style="font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#a5f3fc;margin-bottom:6px;">Código de Exame</div>
        <div style="font-family:monospace;font-size:2rem;font-weight:900;letter-spacing:0.1em;">{{ $candidatura->codigo_exame }}</div>
        <div style="margin-top:10px;font-size:0.9rem;color:#cffafe;">
            {{ $candidatura->curso }} &nbsp;·&nbsp;
            {{ $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}
        </div>
    </div>

    {{-- Aviso de avaliação cega --}}
    <div style="background:#fef9c3;border:1px solid #fde047;border-top:none;padding:10px 20px;font-size:0.8rem;color:#713f12;">
        <strong>Avaliação cega:</strong> A identidade do candidato não é conhecida. Avalie com base nos dados do exame físico correspondentes a este código.
    </div>

    {{-- Nota existente (por outro professor) — só leitura --}}
    @if($nota && $nota->professor_id !== auth()->id())
    <div style="background:#fff;border:1px solid #e2e8f0;border-top:none;border-radius:0 0 14px 14px;padding:26px;">
        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:18px 20px;text-align:center;">
            <div style="font-size:0.78rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:6px;">Nota já lançada</div>
            <div style="font-size:2.5rem;font-weight:900;color:{{ $nota->nota >= 10 ? '#15803d' : '#dc2626' }};">
                {{ number_format($nota->nota, 1) }}<span style="font-size:1rem;color:#94a3b8;">/20</span>
            </div>
            @if($nota->observacoes)
            <div style="margin-top:8px;font-size:0.85rem;color:#475569;">{{ $nota->observacoes }}</div>
            @endif
            <div style="margin-top:6px;font-size:0.75rem;color:#94a3b8;">Lançada em {{ $nota->lancada_em->format('d/m/Y H:i') }}</div>
        </div>
    </div>

    {{-- Formulário de lançamento / correcção --}}
    @else
    <div style="background:#fff;border:1px solid #e2e8f0;border-top:none;border-radius:0 0 14px 14px;padding:26px;">

        @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;padding:10px 14px;border-radius:8px;margin-bottom:16px;">
            {{ session('error') }}
        </div>
        @endif

        @if($nota)
        <div style="background:#e0f2fe;border:1px solid #7dd3fc;border-radius:8px;padding:10px 14px;margin-bottom:18px;font-size:0.85rem;color:#0369a1;">
            Já lançou uma nota de <strong>{{ number_format($nota->nota, 1) }}</strong> para este código. Pode corrigir abaixo.
        </div>
        @endif

        <form method="POST" action="{{ route('professor.notas.store', $candidatura) }}">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:0.82rem;font-weight:700;color:#1a2332;margin-bottom:8px;">
                    Nota de Exame <span style="color:#ef4444;">*</span>
                    <span style="font-weight:400;color:#94a3b8;">(escala 0 – 20, uma casa decimal)</span>
                </label>
                <div style="display:flex;align-items:center;gap:10px;">
                    <input type="number" name="nota" id="nota-input"
                           value="{{ old('nota', $nota?->nota) }}"
                           min="0" max="20" step="0.1" required
                           style="border:2px solid {{ $errors->has('nota') ? '#f87171' : '#bae6fd' }};border-radius:10px;padding:12px 16px;font-size:1.5rem;font-weight:800;color:#0e7490;width:130px;text-align:center;"
                           oninput="updateColor(this)">
                    <span style="font-size:1.2rem;color:#94a3b8;font-weight:600;">/ 20</span>
                    <span id="nota-badge" style="padding:4px 14px;border-radius:20px;font-size:0.85rem;font-weight:700;display:none;"></span>
                </div>
                @error('nota')
                <p style="font-size:0.78rem;color:#dc2626;margin-top:5px;">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:22px;">
                <label style="display:block;font-size:0.82rem;font-weight:700;color:#1a2332;margin-bottom:6px;">
                    Observações <span style="font-weight:400;color:#94a3b8;">(opcional)</span>
                </label>
                <textarea name="observacoes" rows="3" maxlength="500"
                          style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:10px 12px;font-size:0.88rem;resize:vertical;box-sizing:border-box;"
                          placeholder="Observações internas sobre o desempenho no exame...">{{ old('observacoes', $nota?->observacoes) }}</textarea>
            </div>

            <button type="submit"
                    style="background:#0e7490;color:#fff;border:none;border-radius:10px;padding:12px 28px;font-weight:700;font-size:0.95rem;cursor:pointer;display:inline-flex;align-items:center;gap:8px;"
                    onmouseover="this.style.background='#0891b2'" onmouseout="this.style.background='#0e7490'">
                <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $nota ? 'Corrigir Nota' : 'Lançar Nota' }}
            </button>
        </form>
    </div>
    @endif

</div>

<script>
function updateColor(input) {
    var val = parseFloat(input.value);
    var badge = document.getElementById('nota-badge');
    if (isNaN(val)) { badge.style.display='none'; return; }
    badge.style.display = 'inline-block';
    if (val >= 14) {
        badge.textContent = 'Aprovado'; badge.style.background='#dcfce7'; badge.style.color='#15803d';
        input.style.borderColor='#86efac';
    } else if (val >= 10) {
        badge.textContent = 'Aprovado'; badge.style.background='#d1fae5'; badge.style.color='#065f46';
        input.style.borderColor='#6ee7b7';
    } else {
        badge.textContent = 'Reprovado'; badge.style.background='#fee2e2'; badge.style.color='#b91c1c';
        input.style.borderColor='#fca5a5';
    }
}
// Inicializar ao carregar
(function(){ var i=document.getElementById('nota-input'); if(i&&i.value) updateColor(i); })();
</script>
@endsection
