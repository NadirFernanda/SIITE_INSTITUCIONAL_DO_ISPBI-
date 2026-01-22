@extends('layouts.admin')

@section('content')
<h1>Carrossel</h1>
<form action="/admin/carrossel" method="POST" enctype="multipart/form-data" style="margin-bottom:24px;">
    @csrf
    <input type="file" name="imagem" required>
    <input type="text" name="titulo" placeholder="Título (opcional)">
    <input type="text" name="link" placeholder="Link (opcional)">
    <input type="number" name="ordem" placeholder="Ordem" style="width:80px;">
    <button type="submit" style="background:#343a40;color:#fff;padding:8px 18px;border:none;border-radius:4px;font-weight:bold;">Adicionar</button>
</form>
<table style="width:100%; border-collapse:collapse;">
    <thead>
        <tr style="background:#f3f3f3;">
            <th style="padding:8px; border:1px solid #ddd;">Imagem</th>
            <th style="padding:8px; border:1px solid #ddd;">Título</th>
            <th style="padding:8px; border:1px solid #ddd;">Link</th>
            <th style="padding:8px; border:1px solid #ddd;">Ordem</th>
            <th style="padding:8px; border:1px solid #ddd;">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($carrosseis as $item)
        <tr>
            <td style="padding:8px; border:1px solid #ddd;"><img src="{{ asset('storage/' . $item->imagem) }}" style="max-width:120px;max-height:80px;"></td>
            <td style="padding:8px; border:1px solid #ddd;">{{ $item->titulo }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ $item->link }}</td>
            <td style="padding:8px; border:1px solid #ddd;">{{ $item->ordem }}</td>
            <td style="padding:8px; border:1px solid #ddd;">
                <form action="/admin/carrossel/{{ $item->id }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="color:#fff;background:#e3342f;border:none;padding:6px 12px;border-radius:4px;">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="padding:8px; border:1px solid #ddd;">Nenhuma imagem no carrossel.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
