@extends('layouts.admin')

@section('content')
<div class="flex items-center gap-6">
	<div>
		<h1 class="text-3xl font-bold">Painel Administrativo</h1>
		<p class="text-gray-600">Bem-vindo ao painel administrativo!</p>
	</div>

	<div class="ml-auto">
		<a href="{{ route('admin.revistas') }}" class="inline-flex items-center gap-3 bg-white border p-3 rounded shadow">
			<div class="text-sm text-gray-500">Submissões pendentes</div>
			<div class="text-xl font-semibold text-blue-600">{{ $pending ?? 0 }}</div>
		</a>
	</div>
</div>
@endsection
