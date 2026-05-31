<div style="font-family:Arial,sans-serif;max-width:600px;margin:0 auto;color:#1a1a2e;">
    <div style="background:#2563eb;padding:24px 32px;border-radius:8px 8px 0 0;">
        <h2 style="color:#fff;margin:0;font-size:1.2rem;">Candidatura Concluída — ISP-Bié</h2>
        <p style="color:#bfdbfe;margin:6px 0 0;font-size:0.9rem;">Ficha n.º {{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</p>
    </div>

    <div style="background:#f8fafc;padding:28px 32px;border:1px solid #e2e8f0;border-top:none;border-radius:0 0 8px 8px;">
        <p>Caro(a) <strong>{{ $candidatura->nome }}</strong>,</p>
        <p style="margin:14px 0;">A sua candidatura ao <strong>{{ $candidatura->curso }}</strong> (período <strong>{{ $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}</strong>) foi <strong style="color:#7c3aed;">concluída e assinada digitalmente</strong> pelo DAAC — Departamento dos Assuntos Académicos do ISP-Bié.</p>

        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;padding:16px 20px;margin:18px 0;">
            <table style="width:100%;border-collapse:collapse;">
                <tr><td style="padding:4px 0;color:#64748b;font-size:0.85rem;width:160px;">N.º de Ficha</td><td style="font-weight:700;">{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</td></tr>
                <tr><td style="padding:4px 0;color:#64748b;font-size:0.85rem;">Assinado em</td><td style="font-weight:700;">{{ $candidatura->assinado_em?->format('d/m/Y \à\s H:i') }}</td></tr>
                <tr><td style="padding:4px 0;color:#64748b;font-size:0.85rem;">Código de Assinatura</td><td style="font-weight:700;font-family:monospace;color:#7c3aed;">{{ $candidatura->assinatura_codigo }}</td></tr>
            </table>
        </div>

        <p style="background:#fef3c7;border:1px solid #f6c344;border-radius:6px;padding:12px 16px;font-size:0.88rem;">
            <strong>Importante:</strong> Guarde o código de assinatura <strong>{{ $candidatura->assinatura_codigo }}</strong>. Apresente este comprovativo (impresso ou digital) no dia do exame de acesso.
        </p>

        <p style="margin-top:20px;font-size:0.85rem;color:#64748b;text-align:center;">
            Instituto Superior Politécnico do Bié &mdash; DAAC<br>
            Este é um email automático, não responda a esta mensagem.
        </p>
    </div>
</div>
