@extends('layouts.admin')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;flex-wrap:wrap;gap:16px;">
    <h1 style="font-size:2.6rem;color:#1e3a5f;font-weight:800;letter-spacing:-1px;margin:0;">Configurações</h1>
</div>

@if(session('success'))
    <div role="status" style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

<section style="max-width:760px;background:#fff;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(21,101,192,0.06);">
    <h2 style="font-size:1.25rem;color:#1e3a5f;font-weight:700;margin:0 0 8px;">Formulário de candidaturas</h2>
    <p style="color:#475569;margin:0 0 20px;">
        {{ $formularioAtivo
            ? 'O formulário está activo e os candidatos podem submeter candidaturas online.'
            : 'O formulário está desactivado; a página pública informa que as inscrições estão encerradas.' }}
    </p>

    <form method="POST" action="{{ route('admin.configuracoes.update') }}" style="display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
        @csrf
        @method('PATCH')
        <input type="hidden" name="candidaturas_ativas" value="0">
        <label for="candidaturas_ativas" style="display:flex;align-items:center;gap:10px;font-weight:600;color:#1e293b;cursor:pointer;">
            <input
                id="candidaturas_ativas"
                type="checkbox"
                name="candidaturas_ativas"
                value="1"
                @checked($formularioAtivo)
                style="width:18px;height:18px;accent-color:#2563eb;"
            >
            Activar formulário de candidaturas
        </label>
        <button type="submit" style="background:#1e3a5f;color:#fff;font-weight:700;padding:10px 18px;border:0;border-radius:8px;cursor:pointer;">
            Guardar
        </button>
    </form>
    @error('candidaturas_ativas')
        <p role="alert" style="color:#b91c1c;margin:12px 0 0;">{{ $message }}</p>
    @enderror
</div>
@endsection
