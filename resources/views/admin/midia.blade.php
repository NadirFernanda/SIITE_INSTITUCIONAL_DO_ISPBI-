@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
	<h1>Mídia</h1>
	<form action="/admin/midia" method="POST" enctype="multipart/form-data" style="display:inline-block;">
		@csrf
		<input type="file" name="arquivo" required style="margin-right:10px;">
		<button type="submit" style="background:#343a40;color:#fff;padding:8px 18px;border:none;border-radius:4px;font-weight:bold;">Nova Mídia</button>
	</form>
</div>

<table style="width:100%; border-collapse:collapse; margin-top:24px;">
	<thead>
		<tr style="background:#f3f3f3;">
			<th style="padding:8px; border:1px solid #ddd;">ID</th>
			<th style="padding:8px; border:1px solid #ddd;">Arquivo</th>
			<th style="padding:8px; border:1px solid #ddd;">Nome</th>
			<th style="padding:8px; border:1px solid #ddd;">Ações</th>
		</tr>
	</thead>
	<tbody>
		@forelse($midias as $midia)
			<tr>
				<td style="padding:8px; border:1px solid #ddd;">{{ $midia->id }}</td>
				<td style="padding:8px; border:1px solid #ddd;">
					@if(Str::startsWith($midia->caminho, ['jpg','jpeg','png','gif','webp','bmp','svg']))
						<img src="{{ asset('storage/' . $midia->caminho) }}" alt="{{ $midia->nome }}" style="max-width:80px; max-height:60px;">
					@else
						<a href="{{ asset('storage/' . $midia->caminho) }}" target="_blank">Ver arquivo</a>
					@endif
				</td>
				<td style="padding:8px; border:1px solid #ddd;">{{ $midia->nome }}</td>
				<td style="padding:8px; border:1px solid #ddd;">
					<form action="/admin/midia/{{ $midia->id }}" method="POST" style="display:inline-block;">
						@csrf
						@method('DELETE')
						<button type="submit" style="color:#fff;background:#e3342f;border:none;padding:6px 12px;border-radius:4px;">Excluir</button>
					</form>
				</td>
			</tr>
		@empty
			<tr>
				<td colspan="4" style="padding:8px; border:1px solid #ddd;">Nenhum arquivo de mídia cadastrado.</td>
			</tr>
		@endforelse
	</tbody>
</table>
@endsection
