@extends('layouts.admin')

@section('content')
<div style="max-width:900px;margin:0 auto;">
    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:24px;">
        <div>
            <h1 style="font-size:2rem;line-height:1.2;color:#1e3a5f;font-weight:800;margin:0;">PDI 2026–2031</h1>
            <p style="color:#475569;margin:8px 0 0;">Fotografia e documento oficial do Plano de Desenvolvimento Institucional.</p>
        </div>
        <a href="{{ route('pdi') }}" target="_blank" rel="noopener" style="color:#1e3a5f;font-weight:700;text-decoration:underline;">Ver página pública</a>
    </div>

    @if(session('success'))
        <p role="status" style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px 16px;border-radius:8px;">{{ session('success') }}</p>
    @endif
    @if($errors->any())
        <div role="alert" style="background:#fef2f2;border:1px solid #fca5a5;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="margin:3px 0;">{{ $error }}</p>@endforeach
        </div>
    @endif

    <section style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:clamp(18px,4vw,28px);box-shadow:0 2px 8px rgba(21,101,192,.06);margin-bottom:24px;">
        <h2 style="font-size:1.3rem;color:#1e3a5f;margin:0 0 8px;">Fotografia dos sete pilares</h2>
        <p style="color:#475569;margin:0 0 18px;">A fotografia original aparece na página do PDI. Uma nova imagem substitui a fotografia actualmente apresentada.</p>

        @if($photoUrl)
            <div style="border:1px solid #e2e8f0;border-radius:12px;padding:12px;margin-bottom:18px;text-align:center;">
                <img src="{{ $photoUrl }}" alt="Fotografia do PDI actualmente publicada" style="display:block;max-width:100%;max-height:350px;width:auto;height:auto;object-fit:contain;margin:auto;">
                <a href="{{ $photoUrl }}" target="_blank" rel="noopener" style="display:inline-block;margin-top:10px;color:#1e3a5f;text-decoration:underline;">Ampliar fotografia</a>
            </div>
        @else
            <p style="background:#f1f5f9;color:#475569;padding:16px;border-radius:8px;">A fotografia original ainda não está disponível no portal.</p>
        @endif

        <form method="POST" action="{{ route('admin.pdi.fotografia.upload') }}" enctype="multipart/form-data" style="display:grid;gap:12px;">
            @csrf
            <label for="fotografia" style="font-weight:700;color:#1e293b;">Carregar ou substituir fotografia</label>
            <input id="fotografia" type="file" name="fotografia" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" required style="max-width:100%;">
            <p style="font-size:.875rem;color:#64748b;margin:0;">JPG, PNG ou WebP; máximo 10 MB. O ficheiro anterior mantém-se se a actualização falhar.</p>
            <button type="submit" style="justify-self:start;background:#1e3a5f;color:#fff;font-weight:700;border:0;border-radius:8px;padding:11px 18px;cursor:pointer;">Guardar fotografia</button>
        </form>

        @if($hasPhotoOverride)
            <form method="POST" action="{{ route('admin.pdi.fotografia.remove') }}" style="border-top:1px solid #e2e8f0;margin-top:22px;padding-top:18px;display:grid;gap:12px;">
                @csrf
                @method('DELETE')
                <label style="display:flex;align-items:flex-start;gap:10px;color:#334155;"><input type="checkbox" name="confirmar_remocao" value="1" required style="margin-top:4px;"> Confirmo que quero retirar a fotografia substituta. Se a fotografia original estiver no portal, voltará a ser apresentada.</label>
                <button type="submit" style="justify-self:start;background:#fff;color:#b91c1c;font-weight:700;border:1px solid #b91c1c;border-radius:8px;padding:10px 18px;cursor:pointer;">Remover substituição</button>
            </form>
        @endif
    </section>

    <section style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:clamp(18px,4vw,28px);box-shadow:0 2px 8px rgba(21,101,192,.06);">
        <h2 style="font-size:1.3rem;color:#1e3a5f;margin:0 0 8px;">Documento oficial em PDF</h2>
        <p style="color:#475569;margin:0 0 18px;">O botão de consulta só aparece na página pública depois de o PDF ser carregado e aprovado para publicação.</p>

        <p role="status" style="display:inline-block;border-radius:999px;padding:7px 13px;font-weight:700;font-size:.875rem;margin:0 0 20px;background:{{ $pdfDisponivel && $pdfPublicado ? '#dcfce7' : '#f1f5f9' }};color:{{ $pdfDisponivel && $pdfPublicado ? '#166534' : '#475569' }};">
            {{ $pdfDisponivel ? ($pdfPublicado ? 'PDF publicado' : 'PDF carregado, não publicado') : 'Nenhum PDF carregado' }}
        </p>

        <form method="POST" action="{{ route('admin.pdi.documento.upload') }}" enctype="multipart/form-data" style="display:grid;gap:12px;">
            @csrf
            <label for="documento" style="font-weight:700;color:#1e293b;">Carregar ou substituir PDF oficial</label>
            <input id="documento" type="file" name="documento" accept=".pdf,application/pdf" required style="max-width:100%;">
            <p style="font-size:.875rem;color:#64748b;margin:0;">PDF até 25 MB. Sem aprovação, o documento fica privado como rascunho.</p>
            <label style="display:flex;align-items:flex-start;gap:10px;color:#334155;"><input type="checkbox" name="aprovar_publicacao" value="1" style="margin-top:4px;"> Confirmo que este é o documento oficial aprovado para publicação.</label>
            <button type="submit" style="justify-self:start;background:#1e3a5f;color:#fff;font-weight:700;border:0;border-radius:8px;padding:11px 18px;cursor:pointer;">Guardar PDF</button>
        </form>

        @if($pdfDisponivel)
            <div style="border-top:1px solid #e2e8f0;margin-top:22px;padding-top:18px;display:grid;gap:16px;">
                <a href="{{ route('admin.pdi.documento.preview') }}" target="_blank" rel="noopener" style="color:#1e3a5f;font-weight:700;text-decoration:underline;">Pré-visualizar o PDF carregado</a>
                @if($pdfPublicado)
                    <form method="POST" action="{{ route('admin.pdi.documento.publicacao') }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="publicar" value="0">
                        <button type="submit" style="background:#fff;color:#1e3a5f;font-weight:700;border:1px solid #1e3a5f;border-radius:8px;padding:10px 18px;cursor:pointer;">Retirar PDF da página pública</button>
                    </form>
                @else
                    <form method="POST" action="{{ route('admin.pdi.documento.publicacao') }}" style="display:grid;gap:12px;">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="publicar" value="1">
                        <label style="display:flex;align-items:flex-start;gap:10px;color:#334155;"><input type="checkbox" name="confirmar_aprovacao" value="1" required style="margin-top:4px;"> Confirmo a aprovação institucional deste PDF para publicação.</label>
                        <button type="submit" style="justify-self:start;background:#166534;color:#fff;font-weight:700;border:0;border-radius:8px;padding:10px 18px;cursor:pointer;">Publicar PDF</button>
                    </form>
                @endif
                <form method="POST" action="{{ route('admin.pdi.documento.remove') }}" style="display:grid;gap:12px;">
                    @csrf
                    @method('DELETE')
                    <label style="display:flex;align-items:flex-start;gap:10px;color:#334155;"><input type="checkbox" name="confirmar_remocao" value="1" required style="margin-top:4px;"> Confirmo que quero remover o PDF carregado.</label>
                    <button type="submit" style="justify-self:start;background:#fff;color:#b91c1c;font-weight:700;border:1px solid #b91c1c;border-radius:8px;padding:10px 18px;cursor:pointer;">Remover PDF</button>
                </form>
            </div>
        @endif
    </section>
</div>
@endsection
