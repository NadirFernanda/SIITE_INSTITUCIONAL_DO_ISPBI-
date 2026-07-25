@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px;">
	<h1 style="font-size: 2.6rem; color: #1565c0; font-weight: 800; letter-spacing: -1px; margin: 0;">Mídia</h1>
	<form action="/admin/midia" method="POST" enctype="multipart/form-data" style="display: flex; align-items: center; gap: 10px;">
		@csrf
		<input type="file" name="arquivo" required style="padding: 7px 8px; border-radius: 6px; border: 1px solid #b0bec5; background: #f8fafc; font-size: 1rem;">
		<button type="submit" style="background: #1565c0; color: #fff; padding: 12px 28px; border: none; border-radius: 8px; font-weight: 700; font-size: 1.1rem; box-shadow: 0 2px 8px rgba(21,101,192,0.10); transition: background 0.2s; outline: none;">Nova Mídia</button>
	</form>
</div>
<div style="overflow-x:auto;">
<table class="responsive-table" style="width:100%; border-collapse:separate; border-spacing:0; background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(21,101,192,0.06); margin-top: 0;">
	<thead>
		<tr style="background:#e3f0fb; color:#1565c0; font-size:1.08rem;">
			<th style="padding:14px 18px; text-align:left; border-top-left-radius:12px;">ID</th>
			<th style="padding:14px 18px; text-align:left;">Arquivo</th>
			<th style="padding:14px 18px; text-align:left;">Nome</th>
			<th style="padding:14px 18px; text-align:left; border-top-right-radius:12px;">Ações</th>
		</tr>
	</thead>
	<tbody>
		@forelse($midias as $midia)
			<tr style="border-bottom:1px solid #f0f4f8;">
				<td style="padding:12px 18px;">{{ $midia->id }}</td>
				<td style="padding:12px 18px;">
					@if(Str::startsWith($midia->caminho, ['jpg','jpeg','png','gif','webp','bmp','svg']))
						<img src="{{ asset('storage/' . $midia->caminho) }}" alt="{{ $midia->nome }}" style="max-width:80px; max-height:60px; border-radius: 6px; box-shadow: 0 1px 4px rgba(21,101,192,0.08);">
					@else
						<a href="{{ asset('storage/' . $midia->caminho) }}" target="_blank" style="color:#1565c0; font-weight:500; text-decoration:underline;">Ver arquivo</a>
					@endif
				</td>
				<td style="padding:12px 18px;">{{ $midia->nome }}</td>
				<td style="padding:12px 18px;">
					<form action="/admin/midia/{{ $midia->id }}" method="POST" style="display:inline-block;">
						@csrf
						@method('DELETE')
						<button type="submit" style="color:#fff;background:#e3342f;border:none;padding:8px 18px;border-radius:6px;font-weight:600;">Excluir</button>
					</form>
				</td>
			</tr>
		@empty
			<tr>
				<td colspan="4" style="padding:18px; color:#888; text-align:center;">Nenhum arquivo de mídia cadastrado.</td>
			</tr>
		@endforelse
	</tbody>
</table>
</div>
@endsection
