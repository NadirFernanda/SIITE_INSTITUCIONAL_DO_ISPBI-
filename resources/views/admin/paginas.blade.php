@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px;">
	<h1 style="font-size: 2.6rem; color: #1e3a5f; font-weight: 800; letter-spacing: -1px; margin: 0;">Páginas</h1>
	<a href="/admin/paginas/create" style="background: #1e3a5f; color: #fff; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 1.1rem; box-shadow: 0 2px 8px rgba(21,101,192,0.10); transition: background 0.2s; border: none; outline: none;">Nova Página</a>
</div>
<div style="overflow-x:auto;">
<table class="responsive-table" style="width:100%; border-collapse:separate; border-spacing:0; background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(21,101,192,0.06);">
	<thead>
		<tr style="background:#eaeff5; color:#1e3a5f; font-size:1.08rem;">
			<th style="padding:14px 18px; text-align:left; border-top-left-radius:12px;">ID</th>
			<th style="padding:14px 18px; text-align:left;">Título</th>
			<th style="padding:14px 18px; text-align:left; border-top-right-radius:12px;">Conteúdo</th>
		</tr>
	</thead>
	<tbody>
		@forelse($paginas as $pagina)
			<tr style="border-bottom:1px solid #eaeff5;">
				<td style="padding:12px 18px;">{{ $pagina->id }}</td>
				<td style="padding:12px 18px;">{{ $pagina->titulo }}</td>
				<td style="padding:12px 18px;">{{ $pagina->conteudo }}</td>
			</tr>
		@empty
			<tr>
				<td colspan="3" style="padding:18px; color:#888; text-align:center;">Nenhuma página cadastrada.</td>
			</tr>
		@endforelse
	</tbody>
</table>
</div>
@endsection
