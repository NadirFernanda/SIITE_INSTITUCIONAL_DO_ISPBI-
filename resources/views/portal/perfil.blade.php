@extends('layouts.portal')

@section('page-title', 'Meu Perfil')

@section('content')

<div style="max-width:680px;">
    <div style="margin-bottom:24px;">
        <h1 style="font-size:1.4rem;font-weight:700;color:#1e3a5f;margin:0 0 4px;">Meu Perfil</h1>
        <p style="color:#64748b;font-size:0.9rem;margin:0;">Actualize os seus dados profissionais e de contacto.</p>
    </div>

    @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid #a5d6a7;color:#2e7d32;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:0.88rem;display:flex;align-items:center;gap:8px;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#fff3e0;border:1px solid #ffcc80;color:#e65100;padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:0.85rem;">
            <strong style="display:block;margin-bottom:6px;">Por favor corrija os seguintes erros:</strong>
            <ul style="margin:0;padding-left:18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Info card (read-only) --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:24px;">
        <div style="display:flex;align-items:center;gap:14px;margin-bottom:18px;">
            <div style="width:52px;height:52px;background:#1e3a5f;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:1.3rem;flex-shrink:0;">
                {{ strtoupper(substr($alumnus->nome, 0, 1)) }}
            </div>
            <div>
                <div style="font-weight:700;font-size:1.05rem;color:#1a2332;">{{ $alumnus->nome }}</div>
                <div style="font-size:0.84rem;color:#64748b;">{{ $alumnus->curso }}</div>
            </div>
        </div>
        <div style="display:flex;gap:24px;font-size:0.84rem;color:#64748b;flex-wrap:wrap;">
            <span><strong style="color:#374151;">Curso:</strong> {{ $alumnus->curso }}</span>
            <span><strong style="color:#374151;">Ano:</strong> {{ $alumnus->ano }}</span>
        </div>
    </div>

    {{-- Edit form --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;">
        <h2 style="font-size:1rem;font-weight:700;color:#1e3a5f;margin:0 0 22px;">Actualizar Dados</h2>

        <form method="POST" action="{{ route('portal.perfil.update') }}">
            @csrf
            @method('PUT')

            <div style="margin-bottom:18px;">
                <label for="contacto" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Telefone / Contacto</label>
                <input type="text" id="contacto" name="contacto" value="{{ old('contacto', $alumnus->contacto) }}"
                    style="width:100%;padding:10px 13px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;outline:none;"
                    onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">
            </div>

            <div style="margin-bottom:18px;">
                <label style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:8px;">Esta Empregado?</label>
                <div style="display:flex;gap:20px;">
                    <label style="display:flex;align-items:center;gap:7px;cursor:pointer;font-size:0.88rem;">
                        <input type="radio" name="trabalha" value="sim" {{ old('trabalha', $alumnus->trabalha ? 'sim' : 'nao') === 'sim' ? 'checked' : '' }}
                            style="accent-color:#1e3a5f;">
                        Sim
                    </label>
                    <label style="display:flex;align-items:center;gap:7px;cursor:pointer;font-size:0.88rem;">
                        <input type="radio" name="trabalha" value="nao" {{ old('trabalha', $alumnus->trabalha ? 'sim' : 'nao') === 'nao' ? 'checked' : '' }}
                            style="accent-color:#1e3a5f;">
                        Nao
                    </label>
                </div>
            </div>

            <div style="margin-bottom:18px;">
                <label for="empresa" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Nome da Empresa</label>
                <input type="text" id="empresa" name="empresa" value="{{ old('empresa', $alumnus->empresa) }}"
                    style="width:100%;padding:10px 13px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;outline:none;"
                    onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">
            </div>

            <div style="margin-bottom:18px;">
                <label for="cargo" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Cargo / Funcao</label>
                <input type="text" id="cargo" name="cargo" value="{{ old('cargo', $alumnus->cargo) }}"
                    style="width:100%;padding:10px 13px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;outline:none;"
                    onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">
            </div>

            <div style="margin-bottom:18px;">
                <label for="pais" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Pais de Residencia</label>
                <input type="text" id="pais" name="pais" value="{{ old('pais', $alumnus->pais) }}"
                    style="width:100%;padding:10px 13px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;outline:none;"
                    onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">
            </div>

            <div style="margin-bottom:24px;">
                <label for="satisfacao" style="display:block;font-size:0.84rem;font-weight:600;color:#374151;margin-bottom:5px;">Testemunho / Comentario sobre o ISP-Bie <span style="font-weight:400;color:#9ca3af;">(opcional)</span></label>
                <textarea id="satisfacao" name="satisfacao" rows="4"
                    style="width:100%;padding:10px 13px;border:1px solid #d1d5db;border-radius:8px;font-size:0.9rem;outline:none;resize:vertical;"
                    onfocus="this.style.borderColor='#1e3a5f'" onblur="this.style.borderColor='#d1d5db'">{{ old('satisfacao', $alumnus->satisfacao) }}</textarea>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit"
                    style="background:#1e3a5f;color:#fff;padding:11px 28px;border:none;border-radius:9px;font-size:0.9rem;font-weight:700;cursor:pointer;transition:background 0.15s;"
                    onmouseover="this.style.background='#162d4a'" onmouseout="this.style.background='#1e3a5f'">
                    Guardar Alteracoes
                </button>
                <a href="{{ route('portal.dashboard') }}"
                    style="display:inline-flex;align-items:center;background:#f1f5f9;color:#1e3a5f;padding:11px 22px;border-radius:9px;font-size:0.9rem;font-weight:600;text-decoration:none;"
                    onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
