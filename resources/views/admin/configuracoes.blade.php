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

    <form method="POST" action="{{ route('admin.configuracoes.update') }}">
        @csrf
        @method('PATCH')
        <fieldset style="border:0;padding:0;margin:0 0 20px;display:grid;gap:12px;">
            <legend style="font-weight:600;color:#1e293b;margin-bottom:12px;">Estado das candidaturas</legend>
            <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                <input type="radio" name="candidaturas_ativas" value="1" @checked(old('candidaturas_ativas', (int) $formularioAtivo) == 1)>
                Candidaturas abertas
            </label>
            <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                <input type="radio" name="candidaturas_ativas" value="0" @checked(old('candidaturas_ativas', (int) $formularioAtivo) == 0)>
                Candidaturas encerradas
            </label>
        </fieldset>
        <button type="submit" style="background:#1e3a5f;color:#fff;font-weight:700;padding:10px 18px;border:0;border-radius:8px;cursor:pointer;">
            Guardar
        </button>
    </form>
    @error('candidaturas_ativas')
        <p role="alert" style="color:#b91c1c;margin:12px 0 0;">{{ $message }}</p>
    @enderror
</section>
@endsection
