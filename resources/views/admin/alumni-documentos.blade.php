@extends('layouts.admin')

@section('content')
<div style="padding:32px 24px;max-width:1100px;margin:0 auto;">

    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
        <div>
            <h1 style="font-size:1.55rem;font-weight:700;color:#1a2332;margin:0 0 4px;">Documentos Alumni</h1>
            <p style="color:#64748b;font-size:0.95rem;margin:0;">Gestao de documentos exclusivos para alumni.</p>
        </div>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 18px;border-radius:10px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#fff3e0;border:1px solid #ffcc80;color:#F05A28;padding:12px 18px;border-radius:10px;margin-bottom:20px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Upload form --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;margin-bottom:28px;">
        <h2 style="font-size:1rem;font-weight:700;color:#1e3a5f;margin:0 0 20px;">Carregar Novo Documento</h2>

        @if($errors->any())
            <div style="background:#fff3e0;border:1px solid #ffcc80;color:#F05A28;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:0.85rem;">
                <strong>Erros:</strong>
                <ul style="margin:6px 0 0;padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.alumni-documentos.store') }}" enctype="multipart/form-data">
            @csrf

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                <div>
                    <label for="titulo" style="display:block;font-size:0.83rem;font-weight:600;color:#374151;margin-bottom:4px;">Titulo</label>
                    <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required
                        style="width:100%;padding:9px 12px;border:1px solid {{ $errors->has('titulo') ? '#f87171' : '#d1d5db' }};border-radius:8px;font-size:0.88rem;outline:none;"
                        onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">
                </div>
                <div>
                    <label for="ficheiro" style="display:block;font-size:0.83rem;font-weight:600;color:#374151;margin-bottom:4px;">Ficheiro (PDF, DOC, DOCX — max 10 MB)</label>
                    <input type="file" id="ficheiro" name="ficheiro" required accept=".pdf,.doc,.docx"
                        style="width:100%;padding:8px 12px;border:1px solid {{ $errors->has('ficheiro') ? '#f87171' : '#d1d5db' }};border-radius:8px;font-size:0.85rem;outline:none;background:#fff;">
                </div>
            </div>

            <div style="margin-bottom:18px;">
                <label for="descricao" style="display:block;font-size:0.83rem;font-weight:600;color:#374151;margin-bottom:4px;">Descricao <span style="font-weight:400;color:#9ca3af;">(opcional)</span></label>
                <textarea id="descricao" name="descricao" rows="3"
                    style="width:100%;padding:9px 12px;border:1px solid #d1d5db;border-radius:8px;font-size:0.88rem;outline:none;resize:vertical;"
                    onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">{{ old('descricao') }}</textarea>
            </div>

            <button type="submit"
                style="background:#1e3a5f;color:#fff;padding:10px 24px;border:none;border-radius:9px;font-size:0.88rem;font-weight:700;cursor:pointer;"
                onmouseover="this.style.background='#0f1f3d'" onmouseout="this.style.background='#1e3a5f'">
                Carregar Documento
            </button>
        </form>
    </div>

    {{-- Documents list --}}
    @if($documentos->isEmpty())
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:48px;text-align:center;">
            <svg width="48" height="48" fill="none" stroke="#cbd5e1" stroke-width="1.5" viewBox="0 0 24 24" style="margin:0 auto 12px;display:block;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            <p style="color:#94a3b8;margin:0;">Ainda nao existem documentos carregados.</p>
        </div>
    @else
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
            <table class="responsive-table" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr style="background:#f8fafc;border-bottom:2px solid #e2e8f0;">
                        <th style="padding:14px 20px;text-align:left;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Titulo</th>
                        <th style="padding:14px 20px;text-align:left;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Descricao</th>
                        <th style="padding:14px 20px;text-align:left;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Tamanho</th>
                        <th style="padding:14px 20px;text-align:left;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Data</th>
                        <th style="padding:14px 20px;text-align:right;font-size:0.75rem;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.06em;">Accoes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documentos as $doc)
                        <tr style="border-bottom:1px solid #f1f5f9;">
                            <td style="padding:14px 20px;font-weight:600;color:#1a2332;font-size:0.88rem;">{{ $doc->titulo }}</td>
                            <td style="padding:14px 20px;font-size:0.84rem;color:#64748b;max-width:220px;">
                                {{ $doc->descricao ? Str::limit($doc->descricao, 70) : '—' }}
                            </td>
                            <td style="padding:14px 20px;font-size:0.83rem;color:#94a3b8;">{{ $doc->tamanho ?? '—' }}</td>
                            <td style="padding:14px 20px;font-size:0.82rem;color:#94a3b8;white-space:nowrap;">{{ $doc->created_at->format('d/m/Y') }}</td>
                            <td style="padding:14px 20px;text-align:right;">
                                <form method="POST" action="{{ route('admin.alumni-documentos.destroy', $doc->id) }}"
                                    onsubmit="return confirm('Tem a certeza que pretende eliminar este documento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background:#fff3e0;color:#F05A28;padding:6px 14px;border:none;border-radius:7px;font-size:0.8rem;font-weight:600;cursor:pointer;"
                                        onmouseover="this.style.background='#ffdcc4'" onmouseout="this.style.background='#fff3e0'">
                                        Eliminar
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
