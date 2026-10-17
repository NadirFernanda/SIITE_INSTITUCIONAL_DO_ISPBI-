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

@if($errors->has('organigrama'))
    <div role="alert" style="background:#fef2f2;border:1px solid #fca5a5;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
        {{ $errors->first('organigrama') }}
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

<section style="max-width:760px;background:#fff;padding:24px;border-radius:12px;box-shadow:0 2px 8px rgba(21,101,192,0.06);margin-top:24px;">
    <h2 style="font-size:1.25rem;color:#1e3a5f;font-weight:700;margin:0 0 8px;">Organigrama Institucional</h2>
    <p style="color:#475569;margin:0 0 20px;">A imagem publicada aparece na página <a href="{{ route('presidencia') }}" target="_blank" rel="noopener" style="color:#1e3a5f;text-decoration:underline;">Órgãos de Gestão</a>.</p>

    @if($organigramaUrl)
        <div style="border:1px solid #e2e8f0;border-radius:10px;padding:12px;margin-bottom:20px;text-align:center;">
            <img src="{{ $organigramaUrl }}" alt="Organigrama institucional actualmente publicado" style="display:block;max-width:100%;max-height:340px;width:auto;height:auto;margin:auto;object-fit:contain;">
            <a href="{{ $organigramaUrl }}" target="_blank" rel="noopener" style="display:inline-block;margin-top:10px;color:#1e3a5f;text-decoration:underline;">Ver imagem ampliada</a>
        </div>
    @else
        <p style="background:#f1f5f9;color:#475569;padding:16px;border-radius:8px;margin-bottom:20px;">Não existe um organigrama publicado.</p>
    @endif

    <form method="POST" action="{{ route('admin.configuracoes.organigrama.upload') }}" enctype="multipart/form-data" style="display:grid;gap:14px;">
        @csrf
        <label for="organigrama" style="font-weight:600;color:#1e293b;">{{ $organigramaUrl ? 'Substituir imagem' : 'Carregar imagem' }}</label>
        <input id="organigrama" type="file" name="organigrama" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required style="max-width:100%;color:#334155;">
        <p style="color:#64748b;font-size:.875rem;margin:0;">JPG, PNG ou WebP; tamanho máximo de 5 MB. A imagem actual mantém-se se a publicação falhar.</p>
        <button type="submit" style="justify-self:start;background:#1e3a5f;color:#fff;font-weight:700;padding:10px 18px;border:0;border-radius:8px;cursor:pointer;">Guardar organigrama</button>
    </form>

    @if($organigramaUrl)
        <form method="POST" action="{{ route('admin.configuracoes.organigrama.remove') }}" style="border-top:1px solid #e2e8f0;margin-top:24px;padding-top:20px;display:grid;gap:12px;">
            @csrf
            @method('DELETE')
            <label style="display:flex;align-items:flex-start;gap:10px;color:#334155;">
                <input type="checkbox" name="confirmar_remocao" value="1" required style="margin-top:4px;">
                Confirmo que pretendo retirar o organigrama da página pública.
            </label>
            @error('confirmar_remocao')
                <p role="alert" style="color:#b91c1c;margin:0;">{{ $message }}</p>
            @enderror
            <button type="submit" style="justify-self:start;background:#fff;color:#b91c1c;font-weight:700;padding:10px 18px;border:1px solid #b91c1c;border-radius:8px;cursor:pointer;">Remover imagem</button>
        </form>
    @endif
</section>
@endsection
