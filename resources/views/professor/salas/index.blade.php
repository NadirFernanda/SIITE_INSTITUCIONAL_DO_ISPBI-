@extends('layouts.professor')

@section('content')
<div style="max-width:1200px;margin:0 auto;">

    <div style="margin-bottom:24px;">
        <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Lançamento de Notas por Sala</h1>
        <p style="color:#64748b;font-size:0.92rem;margin:0;">Selecione uma sala para visualizar os candidatos e lançar notas. Apenas o código de exame é exibido (anonimato garantido).</p>
    </div>

    {{-- Indicador de salas disponíveis --}}
    @if($salas->isEmpty())
    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:40px;text-align:center;color:#64748b;">
        <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 12px;opacity:0.5;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
        </svg>
        <p style="font-size:1rem;margin:0;">Nenhuma sala com candidatos disponível.</p>
    </div>
    @else

    {{-- Grid de Salas --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:16px;margin-bottom:24px;">
        @foreach($salas as $sala)
        <a href="{{ route('professor.salas.show', $sala) }}"
           style="background:#fff;border:2px solid #e2e8f0;border-radius:14px;padding:20px;text-decoration:none;transition:all 0.3s ease;display:flex;flex-direction:column;justify-content:space-between;"
           onmouseover="this.style.borderColor='#1e3a5f';this.style.boxShadow='0 4px 12px rgba(124,58,237,0.15)';this.style.transform='translateY(-2px)'"
           onmouseout="this.style.borderColor='#e2e8f0';this.style.boxShadow='none';this.style.transform='translateY(0)'">

            <div>
                <h2 style="font-size:1.1rem;font-weight:700;color:#1a2332;margin:0 0 8px;">{{ $sala->nome }}</h2>
                <p style="color:#64748b;font-size:0.85rem;margin:0;">
                    📅 {{ $sala->data_exame?->format('d/m/Y') }} • ⏰ {{ $sala->horario }}
                </p>
            </div>

            {{-- Progresso e estatísticas --}}
            <div style="margin-top:16px;padding-top:16px;border-top:1px solid #f1f5f9;">
                <div style="display:flex;gap:12px;margin-bottom:10px;">
                    <div style="flex:1;">
                        <div style="font-size:0.72rem;font-weight:600;color:#94a3b8;text-transform:uppercase;margin-bottom:3px;">Total</div>
                        <div style="font-size:1.4rem;font-weight:900;color:#475569;">{{ $sala->total_candidatos }}</div>
                    </div>
                    <div style="flex:1;">
                        <div style="font-size:0.72rem;font-weight:600;color:#22c55e;text-transform:uppercase;margin-bottom:3px;">Com Nota</div>
                        <div style="font-size:1.4rem;font-weight:900;color:#22c55e;">{{ $sala->com_nota }}</div>
                    </div>
                    <div style="flex:1;">
                        <div style="font-size:0.72rem;font-weight:600;color:#dc2626;text-transform:uppercase;margin-bottom:3px;">Sem Nota</div>
                        <div style="font-size:1.4rem;font-weight:900;color:#dc2626;">{{ $sala->sem_nota }}</div>
                    </div>
                </div>

                {{-- Barra de progresso --}}
                <div style="width:100%;height:6px;background:#f1f5f9;border-radius:3px;overflow:hidden;">
                    <div style="width:{{ $sala->percentual_conclusao }}%;height:100%;background:linear-gradient(90deg, #1e3a5f, #0f1f3d);transition:width 0.3s ease;"></div>
                </div>
                <p style="font-size:0.72rem;color:#94a3b8;margin:6px 0 0;text-align:right;">{{ $sala->percentual_conclusao }}% concluído</p>
            </div>

            {{-- Botão de ação --}}
            <div style="margin-top:14px;padding-top:14px;border-top:1px solid #f1f5f9;">
                <span style="display:inline-flex;align-items:center;gap:6px;background:#eaeff5;color:#0f1f3d;border:1px solid #a8c4e0;border-radius:8px;padding:8px 14px;font-size:0.85rem;font-weight:700;">
                    Abrir Pauta
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </span>
            </div>
        </a>
        @endforeach
    </div>

    @endif

</div>
@endsection
