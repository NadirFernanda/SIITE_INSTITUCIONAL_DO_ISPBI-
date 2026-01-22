@extends('layouts.admin')

@section('content')
<h1>Usuários</h1>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nome</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		@forelse($usuarios as $usuario)
			<tr>
				<td>{{ $usuario->id }}</td>
				<td>{{ $usuario->name }}</td>
				<td>{{ $usuario->email }}</td>
			</tr>
		@empty
			<tr>
				<td colspan="3">Nenhum usuário cadastrado.</td>
			</tr>
		@endforelse
	</tbody>
</table>
@endsection
