@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:1100px;margin:0 auto;">

    <a href="{{ route('admin.salas.index') }}" style="display:inline-block;margin-bottom:12px;color:#6b7280;text-decoration:none;">&larr; Voltar às Salas</a>

    <div style="margin-bottom:22px;">
        <h1 style="font-size:1.5rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Candidatos Sem Sala</h1>
        <p style="color:#64748b;font-size:0.92rem;margin:0;">
            A distribuição automática não conseguiu encaixar estes candidatos por falta de vaga no bloco (data/horário)
            do curso deles. Atribua manualmente a uma sala à sua escolha — esta é a única situação em que se pode
            colocar um candidato numa sala já reservada para outro curso ou já cheia, por decisão consciente do admin.
        </p>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div style="background:#fff5f5;border:1px solid #fecaca;color:#b91c1c;padding:12px 18px;border-radius:10px;margin-bottom:20px;">
            {{ $errors->first() }}
        </div>
    @endif

    @if($candidaturas->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:56px;text-align:center;">
            <p style="color:#15803d;font-weight:700;font-size:1rem;margin:0;">✓ Todos os candidatos têm sala atribuída.</p>
        </div>
    @else
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
            <table class="responsive-table" style="width:100%;border-collapse:collapse;font-size:0.88rem;">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#475569;">#</th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#475569;">Nome</th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#475569;">Curso</th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#475569;">Período</th>
                        <th style="padding:12px 16px;text-align:left;font-weight:700;color:#475569;">Atribuir a</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($candidaturas as $c)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:12px 16px;color:#94a3b8;font-size:0.8rem;">{{ str_pad($c->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td style="padding:12px 16px;font-weight:600;color:#1a2332;">{{ mb_strtoupper($c->nome, 'UTF-8') }}</td>
                        <td style="padding:12px 16px;color:#334155;">{{ $c->curso }}</td>
                        <td style="padding:12px 16px;color:#64748b;">{{ $c->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}</td>
                        <td style="padding:12px 16px;">
                            <form method="POST" action="{{ route('admin.candidaturas.atribuir-sala', $c) }}" style="display:flex;gap:6px;align-items:center;">
                                @csrf
                                <select name="sala_id" required style="border:1px solid #e2e8f0;border-radius:8px;padding:7px 10px;font-size:0.85rem;background:#f8fafc;min-width:260px;">
                                    <option value="">— Seleccione uma sala —</option>
                                    @foreach($salas as $s)
                                        <option value="{{ $s->id }}">
                                            {{ $s->nome }}
                                            @if($s->data_exame) — {{ $s->data_exame->format('d/m/Y') }} {{ $s->horario }} @endif
                                            ({{ $s->candidaturas_count }}/{{ $s->capacidade }})
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                        onclick="return confirm('Atribuir {{ addslashes($c->nome) }} a esta sala, mesmo que já tenha outro curso ou esteja cheia?')"
                                        style="background:#1e3a5f;color:#fff;border:none;border-radius:8px;padding:7px 14px;font-size:0.85rem;font-weight:600;cursor:pointer;white-space:nowrap;">
                                    Atribuir
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
