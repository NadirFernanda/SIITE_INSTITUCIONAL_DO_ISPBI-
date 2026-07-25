@extends('layouts.portal')

@section('page-title', 'Documentos')

@section('content')

<div style="margin-bottom:24px;">
    <h1 style="font-size:1.4rem;font-weight:700;color:#1e3a5f;margin:0 0 4px;">Documentos</h1>
    <p style="color:#64748b;font-size:0.9rem;margin:0;">Documentos e recursos exclusivos para alumni.</p>
</div>

@if($documentos->isEmpty())
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:64px 48px;text-align:center;">
        <svg width="52" height="52" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 16px;display:block;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
        </svg>
        <p style="color:#94a3b8;font-size:1rem;margin:0;">Sem documentos disponiveis de momento.</p>
    </div>
@else
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <table class="responsive-table" style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                    <th style="padding:14px 20px;text-align:left;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Documento</th>
                    <th style="padding:14px 20px;text-align:left;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Descricao</th>
                    <th style="padding:14px 20px;text-align:left;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Tamanho</th>
                    <th style="padding:14px 20px;text-align:left;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Data</th>
                    <th style="padding:14px 20px;text-align:right;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Accao</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documentos as $doc)
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:14px 20px;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:36px;height:36px;background:#e8f0fe;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="18" height="18" fill="none" stroke="#1e3a5f" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <span style="font-weight:600;color:#1a2332;font-size:0.9rem;">{{ $doc->titulo }}</span>
                            </div>
                        </td>
                        <td style="padding:14px 20px;font-size:0.84rem;color:#64748b;max-width:240px;">
                            {{ $doc->descricao ? Str::limit($doc->descricao, 80) : '—' }}
                        </td>
                        <td style="padding:14px 20px;font-size:0.84rem;color:#94a3b8;">
                            {{ $doc->tamanho ?? '—' }}
                        </td>
                        <td style="padding:14px 20px;font-size:0.82rem;color:#94a3b8;white-space:nowrap;">
                            {{ $doc->created_at->format('d/m/Y') }}
                        </td>
                        <td style="padding:14px 20px;text-align:right;">
                            <a href="{{ route('portal.documentos.download', $doc->id) }}"
                                style="display:inline-flex;align-items:center;gap:6px;background:#1e3a5f;color:#fff;padding:7px 16px;border-radius:7px;font-size:0.8rem;font-weight:600;text-decoration:none;"
                                onmouseover="this.style.background='#162d4a'" onmouseout="this.style.background='#1e3a5f'">
                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Baixar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection
