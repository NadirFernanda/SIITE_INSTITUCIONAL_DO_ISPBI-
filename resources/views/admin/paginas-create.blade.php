@extends('layouts.admin')

@section('content')
<h1>Nova Página</h1>
<form action="/admin/paginas" method="POST" style="max-width: 500px;">
    @csrf
    <div style="margin-bottom: 16px;">
        <label for="titulo" style="display:block; font-weight:bold;">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" required style="width:100%;padding:8px;">
    </div>
    <div style="margin-bottom: 16px;">
        <label for="conteudo" style="display:block; font-weight:bold;">Conteúdo</label>
        <textarea name="conteudo" id="conteudo" class="form-control" rows="5" style="width:100%;padding:8px;"></textarea>
    </div>
    <button type="submit" style="background:#343a40;color:#fff;padding:10px 20px;border:none;border-radius:4px;font-weight:bold;">Salvar</button>
    <a href="/admin/paginas" style="margin-left:10px;">Cancelar</a>
</form>
@endsection
