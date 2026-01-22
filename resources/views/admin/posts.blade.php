@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
	<h1>Posts</h1>
	<a href="/admin/posts/create" style="background: #343a40; color: #fff; padding: 8px 18px; border-radius: 4px; text-decoration: none; font-weight: bold;">Novo Post</a>
</div>
<table style="width:100%; border-collapse:collapse; margin-top:24px;">
	<thead>
		<tr style="background:#f3f3f3;">
			<th style="padding:8px; border:1px solid #ddd;">ID</th>
			<th style="padding:8px; border:1px solid #ddd;">Imagem</th>
			<th style="padding:8px; border:1px solid #ddd;">Título</th>
			<th style="padding:8px; border:1px solid #ddd;">Conteúdo</th>
			<th style="padding:8px; border:1px solid #ddd;">Ações</th>
		</tr>
	</thead>
	<tbody>
		@forelse($posts as $post)
			<tr>
				<td style="padding:8px; border:1px solid #ddd;">{{ $post->id }}</td>
				<td style="padding:8px; border:1px solid #ddd;">
					@if($post->imagem)
						<img src="{{ asset('storage/' . $post->imagem) }}" alt="Imagem" style="max-width:80px; max-height:60px;">
					@endif
				</td>
				<td style="padding:8px; border:1px solid #ddd;">{{ $post->titulo }}</td>
				<td style="padding:8px; border:1px solid #ddd;">{{ $post->conteudo }}</td>
				<td style="padding:8px; border:1px solid #ddd;">
					<a href="/admin/posts/{{ $post->id }}/edit" style="background:#2563eb;color:#fff;padding:6px 12px;border-radius:4px;text-decoration:none;margin-right:6px;">Editar</a>
					<form action="/admin/posts/{{ $post->id }}" method="POST" style="display:inline-block;">
						@csrf
						@method('DELETE')
						<button type="submit" style="background:#e3342f;color:#fff;padding:6px 12px;border:none;border-radius:4px;">Excluir</button>
					</form>
				</td>
			</tr>
		@empty
			<tr>
				<td colspan="4" style="padding:8px; border:1px solid #ddd;">Nenhum post cadastrado.</td>
			</tr>
		@endforelse
	</tbody>
</table>
@endsection
