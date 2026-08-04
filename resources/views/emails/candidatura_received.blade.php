<div style="font-family: Arial, Helvetica, sans-serif; color: #333; max-width: 600px; margin: 0 auto;">
    <div style="background: #1565c0; padding: 24px 32px; border-radius: 8px 8px 0 0;">
        <h2 style="color: #fff; margin: 0; font-size: 1.3rem;">Nova Candidatura Recebida</h2>
        <p style="color: #bbdefb; margin: 6px 0 0; font-size: 0.9rem;">ISP-Bié — Candidaturas Online</p>
    </div>

    <div style="background: #f8fafc; padding: 28px 32px; border: 1px solid #e2e8f0; border-top: none; border-radius: 0 0 8px 8px;">

        <h3 style="color: #1565c0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 16px;">Dados Pessoais</h3>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px;">
            <tr><td style="padding: 6px 0; color: #64748b; font-size: 0.88rem; width: 160px;">Nome</td><td style="padding: 6px 0; font-weight: 600; color: #1a2332;">{{ $candidatura->nome }}</td></tr>
            <tr><td style="padding: 6px 0; color: #64748b; font-size: 0.88rem;">Email</td><td style="padding: 6px 0; font-weight: 600; color: #1a2332;">{{ $candidatura->email }}</td></tr>
            <tr><td style="padding: 6px 0; color: #64748b; font-size: 0.88rem;">Telefone</td><td style="padding: 6px 0; font-weight: 600; color: #1a2332;">{{ $candidatura->telefone }}</td></tr>
            <tr><td style="padding: 6px 0; color: #64748b; font-size: 0.88rem;">BI</td><td style="padding: 6px 0; font-weight: 600; color: #1a2332;">{{ $candidatura->bi ?? '—' }}</td></tr>
            <tr><td style="padding: 6px 0; color: #64748b; font-size: 0.88rem;">Data de Nascimento</td><td style="padding: 6px 0; font-weight: 600; color: #1a2332;">{{ $candidatura->data_nascimento ? $candidatura->data_nascimento->format('d/m/Y') : '—' }}</td></tr>
        </table>

        <h3 style="color: #1565c0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 16px;">Dados Académicos</h3>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 24px;">
            <tr><td style="padding: 6px 0; color: #64748b; font-size: 0.88rem; width: 160px;">Curso Pretendido</td><td style="padding: 6px 0; font-weight: 600; color: #1a2332;">{{ $candidatura->curso }}</td></tr>
            <tr><td style="padding: 6px 0; color: #64748b; font-size: 0.88rem;">Escola de Origem</td><td style="padding: 6px 0; font-weight: 600; color: #1a2332;">{{ $candidatura->escola_origem ?? '—' }}</td></tr>
            <tr><td style="padding: 6px 0; color: #64748b; font-size: 0.88rem;">Ano de Conclusão</td><td style="padding: 6px 0; font-weight: 600; color: #1a2332;">{{ $candidatura->ano_conclusao ?? '—' }}</td></tr>
        </table>

        @if($candidatura->observacoes)
        <h3 style="color: #1565c0; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 10px;">Observações</h3>
        <p style="background: #fff; border: 1px solid #e2e8f0; border-radius: 6px; padding: 12px 16px; font-size: 0.9rem; color: #334155; line-height: 1.6; margin: 0 0 24px;">{{ $candidatura->observacoes }}</p>
        @endif

        <div style="text-align: center; margin-top: 8px;">
            <a href="{{ url('/admin/candidaturas/' . $candidatura->id) }}"
               style="display: inline-block; background: #1565c0; color: #fff; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 0.9rem;">
                Ver candidatura no painel
            </a>
        </div>

        <p style="margin-top: 28px; font-size: 0.82rem; color: #94a3b8; text-align: center;">
            Candidatura recebida em {{ $candidatura->created_at?->format('d/m/Y \à\s H:i') ?? '—' }}<br>
            Instituto Superior Politécnico do Bié
        </p>
    </div>
</div>
