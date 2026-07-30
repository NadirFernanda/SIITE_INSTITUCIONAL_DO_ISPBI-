@extends('layouts.admin')

@section('content')
<div style="max-width:980px;margin:0 auto;">
    <a href="{{ route('admin.salas.index') }}" style="display:inline-block;margin-bottom:12px;color:#6b7280;">&larr; Voltar às Salas</a>

    <h1 style="font-size:1.25rem;font-weight:700;margin-bottom:8px;">Disciplinas — Sala: {{ $sala->nome }}</h1>

    @if(isset($disciplines) && $disciplines->isNotEmpty())
    <div style="background:#fff;border:1px solid #e6f6f6;border-radius:10px;padding:12px;margin-bottom:12px;">
        <div style="font-size:0.9rem;font-weight:700;color:#0f172a;margin-bottom:8px;">Disciplinas vinculadas</div>
        <div style="display:flex;flex-wrap:wrap;gap:10px;">
            @foreach($disciplines as $ld)
                <div style="background:#f8fafc;border:1px solid #e2e8f0;padding:8px 12px;border-radius:8px;font-weight:700;color:#111827;">{{ $ld->discipline }} — {{ $ld->weight_percent }}%</div>
            @endforeach
        </div>
    </div>
    @endif

    @if(session('success'))
        <div style="background:#ecfdf5;border:1px solid #bbf7d0;padding:10px;border-radius:8px;margin-bottom:12px;color:#065f46;">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div style="background:#fff5f5;border:1px solid #fecaca;padding:10px;border-radius:8px;margin-bottom:12px;color:#b91c1c;">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div style="background:#fff8f0;border:1px solid #fde3c7;padding:10px;border-radius:8px;margin-bottom:12px;color:#92400e;">
            <strong>Erros ao guardar:</strong>
            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.salas.disciplines.update', $sala) }}" id="sala-disciplines-form">
        @csrf @method('POST')

        <div id="disciplines-list" style="display:grid;gap:10px;">
            @forelse($disciplines as $d)
            <div class="disc-row" style="display:flex;gap:8px;align-items:center;">
                @if(isset($courseDisciplines) && $courseDisciplines->isNotEmpty())
                    <select name="disciplines[][discipline]" style="flex:1;padding:8px;border-radius:6px;border:1px solid #e5e7eb;">
                        <option value="">— Seleccione disciplina —</option>
                        @foreach($courseDisciplines as $cd)
                            <option value="{{ $cd->discipline }}" {{ $cd->discipline === $d->discipline ? 'selected' : '' }}>{{ $cd->discipline }} — {{ $cd->weight_percent }}%</option>
                        @endforeach
                    </select>
                @else
                    <input type="text" name="disciplines[][discipline]" value="{{ $d->discipline }}" placeholder="Nome da disciplina" style="flex:1;padding:8px;border-radius:6px;border:1px solid #e5e7eb;">
                @endif

                <input type="number" name="disciplines[][weight]" value="{{ $d->weight_percent }}" min="0" max="100" style="width:110px;padding:8px;border-radius:6px;border:1px solid #e5e7eb;text-align:center;">
                <button type="button" class="remove-disc" style="background:#fee2e2;border:none;padding:8px 10px;border-radius:6px;color:#b91c1c;cursor:pointer;">Remover</button>
            </div>
            @empty
            <div class="disc-row" style="display:flex;gap:8px;align-items:center;">
                @if(isset($courseDisciplines) && $courseDisciplines->isNotEmpty())
                    <select name="disciplines[][discipline]" style="flex:1;padding:8px;border-radius:6px;border:1px solid #e5e7eb;">
                        <option value="">— Seleccione disciplina —</option>
                        @foreach($courseDisciplines as $cd)
                            <option value="{{ $cd->discipline }}">{{ $cd->discipline }} — {{ $cd->weight_percent }}%</option>
                        @endforeach
                    </select>
                @else
                    <input type="text" name="disciplines[][discipline]" value="" placeholder="Nome da disciplina" style="flex:1;padding:8px;border-radius:6px;border:1px solid #e5e7eb;">
                @endif

                <input type="number" name="disciplines[][weight]" value="0" min="0" max="100" style="width:110px;padding:8px;border-radius:6px;border:1px solid #e5e7eb;text-align:center;">
                <button type="button" class="remove-disc" style="background:#fee2e2;border:none;padding:8px 10px;border-radius:6px;color:#b91c1c;cursor:pointer;">Remover</button>
            </div>
            @endforelse
        </div>

        <div style="margin-top:12px;display:flex;gap:8px;align-items:center;">
            <button type="button" id="add-disc" style="background:#7c3aed;color:#fff;padding:10px 14px;border-radius:8px;border:none;cursor:pointer;">Adicionar Disciplina</button>
            <div id="all-linked-msg" style="display:none;color:#065f46;font-weight:700;margin-left:6px;">Todas as disciplinas dessa sala já foram vinculadas.</div>
            <div style="color:#6b7280;font-size:0.9rem;">Defina o peso (%) de cada disciplina. A soma total não precisa de ser 100, mas será usada para cálculo ponderado.</div>
        </div>

        <div style="margin-top:16px;">
            <button type="submit" style="background:#0ea5a4;color:#fff;padding:10px 16px;border-radius:8px;border:none;cursor:pointer;font-weight:700;">Guardar Disciplinas</button>
        </div>
    </form>
</div>

@if(isset($courseDisciplines) || isset($disciplines))
<script>
    window.COURSE_DISCIPLINES = {!! json_encode(isset($courseDisciplines) ? $courseDisciplines->map(function($c){ return ['discipline' => $c->discipline, 'weight' => (int) $c->weight_percent]; }) : collect()) !!};
    window.EXISTING_DISCIPLINES = {!! json_encode(isset($disciplines) ? $disciplines->pluck('discipline')->map(function($s){ return trim($s); })->values() : collect()) !!};
</script>
@else
<script>
    window.COURSE_DISCIPLINES = [];
    window.EXISTING_DISCIPLINES = [];
</script>
@endif
<script src="{{ asset('js/admin-sala-disciplines.js') }}"></script>
@endsection
