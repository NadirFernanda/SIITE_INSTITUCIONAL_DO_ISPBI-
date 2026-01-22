@extends('layouts.admin')

@section('content')
<h1>Configurações</h1>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Chave</th>
			<th>Valor</th>
		</tr>
	</thead>
	<tbody>
		@forelse($configuracoes as $config)
			<tr>
				<td>{{ $config['chave'] }}</td>
				<td>{{ $config['valor'] }}</td>
			</tr>
		@empty
			<tr>
				<td colspan="2">Nenhuma configuração cadastrada.</td>
			</tr>
		@endforelse
	</tbody>
</table>
@endsection
