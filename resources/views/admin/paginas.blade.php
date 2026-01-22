@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
	<h1>Páginas</h1>
	<a href="/admin/paginas/create" style="background: #343a40; color: #fff; padding: 8px 18px; border-radius: 4px; text-decoration: none; font-weight: bold;">Nova Página</a>
</div>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Título</th>
			<th>Conteúdo</th>
		</tr>
	</thead>
	<tbody>
		@forelse($paginas as $pagina)
			<tr>
				<td>{{ $pagina->id }}</td>
				<td>{{ $pagina->titulo }}</td>
				<td>{{ $pagina->conteudo }}</td>
			</tr>
		@empty
			<tr>
				<td colspan="3">Nenhuma página cadastrada.</td>
			</tr>
		@endforelse
	</tbody>
</table>
@endsection
