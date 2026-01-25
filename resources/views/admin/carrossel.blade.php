@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px;">
    <h1 style="font-size: 2.6rem; color: #1565c0; font-weight: 800; letter-spacing: -1px; margin: 0;">Carrossel</h1>
    <form action="/admin/carrossel" method="POST" enctype="multipart/form-data" style="display: flex; align-items: center; gap: 10px;">
        @csrf
        <input type="file" name="imagem" required style="padding: 7px 8px; border-radius: 6px; border: 1px solid #b0bec5; background: #f8fafc; font-size: 1rem;">
        <input type="text" name="titulo" placeholder="Título (opcional)" style="padding: 7px 12px; border-radius: 6px; border: 1px solid #b0bec5; background: #f8fafc; font-size: 1rem;">
        <input type="text" name="link" placeholder="Link (opcional)" style="padding: 7px 12px; border-radius: 6px; border: 1px solid #b0bec5; background: #f8fafc; font-size: 1rem;">
        <input type="number" name="ordem" placeholder="Ordem" style="width:80px; padding: 7px 12px; border-radius: 6px; border: 1px solid #b0bec5; background: #f8fafc; font-size: 1rem;">
        <button type="submit" style="background: #1565c0; color: #fff; padding: 12px 28px; border: none; border-radius: 8px; font-weight: 700; font-size: 1.1rem; box-shadow: 0 2px 8px rgba(21,101,192,0.10); transition: background 0.2s; outline: none;">Adicionar</button>
    </form>
</div>
<div style="overflow-x:auto;">
<table style="width:100%; border-collapse:separate; border-spacing:0; background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(21,101,192,0.06); margin-top: 0;">
    <thead>
        <tr style="background:#e3f0fb; color:#1565c0; font-size:1.08rem;">
            <th style="padding:14px 18px; text-align:left; border-top-left-radius:12px;">Imagem</th>
            <th style="padding:14px 18px; text-align:left;">Título</th>
            <th style="padding:14px 18px; text-align:left;">Subtítulo</th>
            <th style="padding:14px 18px; text-align:left;">Texto do Botão</th>
            <th style="padding:14px 18px; text-align:left;">Link</th>
            <th style="padding:14px 18px; text-align:left;">Ordem</th>
            <th style="padding:14px 18px; text-align:left;">Publicado</th>
            <th style="padding:14px 18px; text-align:left; border-top-right-radius:12px;">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($carrosseis as $item)
        <tr style="border-bottom:1px solid #f0f4f8;">
            <td style="padding:12px 18px;"><img src="{{ asset('storage/' . $item->imagem) }}" style="max-width:120px;max-height:80px; border-radius: 6px; box-shadow: 0 1px 4px rgba(21,101,192,0.08);"></td>
            <td style="padding:12px 18px;">{{ $item->titulo }}</td>
            <td style="padding:12px 18px;">{{ $item->subtitulo }}</td>
            <td style="padding:12px 18px;">{{ $item->texto_botao }}</td>
            <td style="padding:12px 18px;">{{ $item->link }}</td>
            <td style="padding:12px 18px;">{{ $item->ordem }}</td>
            <td style="padding:12px 18px;">
                <form action="{{ route('admin.carrossel.toggle-publicar', $item->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button type="submit" style="padding:6px 16px; border-radius:6px; font-weight:600; border:none; {{ $item->publicado ? 'background:#38a169;color:#fff;' : 'background:#e2e8f0;color:#222;' }}">
                        {{ $item->publicado ? 'Publicado' : 'Rascunho' }}
                    </button>
                </form>
            </td>
            <td style="padding:12px 18px;">
                <a href="{{ route('admin.carrossel.edit', $item->id) }}" style="color:#1565c0;font-weight:600;margin-right:10px;">Editar</a>
                <form action="/admin/carrossel/{{ $item->id }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color:#fff;background:#e3342f;border:none;padding:8px 18px;border-radius:6px;font-weight:600;">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="padding:18px; color:#888; text-align:center;">Nenhuma imagem no carrossel.</td></tr>
        @endforelse
    </tbody>
</table>
</div>
@endsection
