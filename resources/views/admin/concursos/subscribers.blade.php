@extends('layouts.admin')

@section('content')
<style>
  .sbk-back-btn:hover { background: #e2e8f0 !important; }
  .sbk-export-btn:hover { background: #15803d !important; }
  .sbk-search-input:focus { border-color: #1565c0 !important; box-shadow: 0 0 0 3px rgba(21,101,192,0.1) !important; outline: none; }
  .sbk-search-btn:hover { background: #0d47a1 !important; }
  .sbk-row:hover { background: #f8fafc !important; }
</style>
<div style="max-width:1000px;margin:0 auto;padding:36px 24px 48px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;flex-wrap:wrap;gap:16px;">
        <div style="display:flex;align-items:center;gap:14px;">
            <a href="{{ route('admin.concursos.index') }}"
               class="sbk-back-btn"
               style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:#f1f5f9;border:1px solid #e2e8f0;color:#475569;text-decoration:none;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            </a>
            <div>
                <h1 style="font-size:1.6rem;font-weight:800;color:#1a202c;margin:0 0 4px;">Assinantes do Concurso</h1>
                <p style="color:#64748b;font-size:0.9rem;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:480px;">{{ $concurso->title }}</p>
            </div>
        </div>
        <a href="{{ route('admin.concursos.subscribers.export', $concurso) }}?{{ http_build_query(request()->only('all','q')) }}"
           class="sbk-export-btn"
           style="display:inline-flex;align-items:center;gap:8px;background:#16a34a;color:#fff;font-weight:700;font-size:0.9rem;padding:10px 20px;border-radius:10px;text-decoration:none;">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Exportar CSV
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" style="margin-bottom:20px;">
        <div style="display:flex;align-items:center;gap:10px;">
            <div style="position:relative;flex:1;max-width:400px;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);pointer-events:none;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por nome ou email"
                       class="sbk-search-input"
                       style="width:100%;box-sizing:border-box;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px 10px 38px;font-size:0.9rem;color:#1a202c;">
            </div>
            <button type="submit" class="sbk-search-btn"
                    style="padding:10px 20px;border-radius:8px;background:#1565c0;color:#fff;font-weight:600;font-size:0.9rem;border:none;cursor:pointer;">Buscar</button>
        </div>
    </form>

    @if($subscribers->isEmpty())
    <div style="background:#fff;border-radius:16px;box-shadow:0 1px 8px rgba(0,0,0,0.07);padding:64px 32px;text-align:center;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin:0 auto 16px;display:block;"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        <p style="color:#94a3b8;font-size:1.05rem;margin:0;">Nenhum assinante encontrado para este concurso.</p>
    </div>
    @else
    <div style="background:#fff;border-radius:14px;border:1px solid #e2e8f0;box-shadow:0 1px 6px rgba(0,0,0,0.06);overflow:hidden;">
        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:1px solid #e2e8f0;">
                        <th style="padding:12px 18px;text-align:left;font-size:0.78rem;font-weight:700;color:#64748b;letter-spacing:0.05em;text-transform:uppercase;">#</th>
                        <th style="padding:12px 18px;text-align:left;font-size:0.78rem;font-weight:700;color:#64748b;letter-spacing:0.05em;text-transform:uppercase;">Nome</th>
                        <th style="padding:12px 18px;text-align:left;font-size:0.78rem;font-weight:700;color:#64748b;letter-spacing:0.05em;text-transform:uppercase;">Email</th>
                        <th style="padding:12px 18px;text-align:left;font-size:0.78rem;font-weight:700;color:#64748b;letter-spacing:0.05em;text-transform:uppercase;">Telefone</th>
                        <th style="padding:12px 18px;text-align:left;font-size:0.78rem;font-weight:700;color:#64748b;letter-spacing:0.05em;text-transform:uppercase;">Interesses</th>
                        <th style="padding:12px 18px;text-align:left;font-size:0.78rem;font-weight:700;color:#64748b;letter-spacing:0.05em;text-transform:uppercase;">Consentimento</th>
                        <th style="padding:12px 18px;text-align:left;font-size:0.78rem;font-weight:700;color:#64748b;letter-spacing:0.05em;text-transform:uppercase;">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscribers as $a)
                    <tr class="sbk-row" style="border-bottom:1px solid #f1f5f9;">
                        <td style="padding:12px 18px;font-size:0.83rem;color:#94a3b8;">{{ $a->id }}</td>
                        <td style="padding:12px 18px;font-size:0.9rem;color:#1a202c;font-weight:500;">{{ $a->name }}</td>
                        <td style="padding:12px 18px;font-size:0.88rem;color:#374151;">{{ $a->email }}</td>
                        <td style="padding:12px 18px;font-size:0.88rem;color:#374151;">{{ $a->phone ?? '—' }}</td>
                        <td style="padding:12px 18px;font-size:0.83rem;color:#64748b;">{{ is_array($a->interests) ? implode(', ', $a->interests) : ($a->interests ?? '—') }}</td>
                        <td style="padding:12px 18px;">
                            @if($a->consent)
                            <span style="background:#f0fdf4;color:#166534;border:1px solid #86efac;border-radius:6px;padding:2px 8px;font-size:0.78rem;font-weight:700;">Sim</span>
                            @else
                            <span style="background:#fff5f5;color:#dc2626;border:1px solid #fecaca;border-radius:6px;padding:2px 8px;font-size:0.78rem;font-weight:700;">Não</span>
                            @endif
                        </td>
                        <td style="padding:12px 18px;font-size:0.83rem;color:#94a3b8;white-space:nowrap;">{{ optional($a->created_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div style="margin-top:24px;">{{ $subscribers->links() }}</div>
    @endif
</div>
@endsection
