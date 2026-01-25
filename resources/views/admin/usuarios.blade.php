@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; flex-wrap: wrap; gap: 16px;">
	<h1 style="font-size: 2.6rem; color: #1565c0; font-weight: 800; letter-spacing: -1px; margin: 0;">Usuários</h1>
</div>
<div style="overflow-x:auto;">
<table style="width:100%; border-collapse:separate; border-spacing:0; background:#fff; border-radius:12px; box-shadow:0 2px 8px rgba(21,101,192,0.06);">
	<thead>
		<tr style="background:#e3f0fb; color:#1565c0; font-size:1.08rem;">
			<th style="padding:14px 18px; text-align:left; border-top-left-radius:12px;">ID</th>
			<th style="padding:14px 18px; text-align:left;">Nome</th>
			<th style="padding:14px 18px; text-align:left; border-top-right-radius:12px;">Email</th>
		</tr>
	</thead>
	<tbody>
		@forelse($usuarios as $usuario)
			<tr style="border-bottom:1px solid #f0f4f8;">
				<td style="padding:12px 18px;">{{ $usuario->id }}</td>
				<td style="padding:12px 18px;">{{ $usuario->name }}</td>
				<td style="padding:12px 18px;">{{ $usuario->email }}</td>
			</tr>
		@empty
			<tr>
				<td colspan="3" style="padding:18px; color:#888; text-align:center;">Nenhum usuário cadastrado.</td>
			</tr>
		@endforelse
	</tbody>
</table>
</div>
@endsection
