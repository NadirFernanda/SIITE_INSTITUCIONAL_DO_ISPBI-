
@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:860px;margin:0 auto;">

    {{-- Header --}}
    <div style="margin-bottom:28px;">
        <a href="{{ route('admin.alumni') }}"
           style="display:inline-flex;align-items:center;gap:6px;color:#64748b;font-size:0.88rem;text-decoration:none;margin-bottom:12px;"
           onmouseover="this.style.color='#1565c0'" onmouseout="this.style.color='#64748b'">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Voltar à lista
        </a>
        <h1 style="font-size:1.6rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Indicadores Alumni</h1>
        <p style="color:#64748b;font-size:0.95rem;margin:0;">Estatísticas apresentadas na secção "Alumni em Números"</p>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Form card --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
        <div style="background:#f8fafc;border-bottom:1px solid #e2e8f0;padding:16px 24px;">
            <span style="font-size:0.75rem;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.08em;">Números a apresentar</span>
        </div>
        <div style="padding:28px 24px;">
            <form method="POST" action="{{ route('admin.alumni.stats.update') }}">
                @csrf
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

                    <div>
                        <label style="display:block;font-size:0.85rem;font-weight:600;color:#374151;margin-bottom:6px;">Alumni Formados</label>
                        <input type="number" name="alumni_count"
                               value="{{ old('alumni_count', $stats->alumni_count ?? 0) }}"
                               min="0" required
                               style="width:100%;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;box-sizing:border-box;outline:none;"
                               onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label style="display:block;font-size:0.85rem;font-weight:600;color:#374151;margin-bottom:6px;">Taxa de Empregabilidade (%)</label>
                        <input type="number" name="employability_percentage"
                               value="{{ old('employability_percentage', $stats->employability_percentage ?? 0) }}"
                               min="0" max="100" required
                               style="width:100%;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;box-sizing:border-box;outline:none;"
                               onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label style="display:block;font-size:0.85rem;font-weight:600;color:#374151;margin-bottom:6px;">Países onde trabalham</label>
                        <input type="number" name="countries_count"
                               value="{{ old('countries_count', $stats->countries_count ?? 0) }}"
                               min="0" required
                               style="width:100%;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;box-sizing:border-box;outline:none;"
                               onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label style="display:block;font-size:0.85rem;font-weight:600;color:#374151;margin-bottom:6px;">Empresas fundadas</label>
                        <input type="number" name="companies_founded"
                               value="{{ old('companies_founded', $stats->companies_founded ?? 0) }}"
                               min="0" required
                               style="width:100%;border:1px solid #d1d5db;border-radius:8px;padding:10px 14px;font-size:0.95rem;box-sizing:border-box;outline:none;"
                               onfocus="this.style.borderColor='#1565c0';this.style.boxShadow='0 0 0 3px rgba(21,101,192,0.1)'"
                               onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'">
                    </div>

                </div>

                <div style="margin-top:28px;padding-top:20px;border-top:1px solid #f1f5f9;">
                    <button type="submit"
                        style="background:#1565c0;color:#fff;padding:11px 28px;border-radius:10px;font-weight:600;font-size:0.95rem;border:none;cursor:pointer;"
                        onmouseover="this.style.background='#0d47a1'" onmouseout="this.style.background='#1565c0'">
                        Salvar Indicadores
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
