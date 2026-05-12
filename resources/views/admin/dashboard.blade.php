@extends('layouts.admin')

@section('content')
<div class="flex items-center gap-6 flex-wrap">
	<div>
		<h1 class="text-3xl font-bold">Painel Administrativo</h1>
		<p class="text-gray-600">Bem-vindo ao painel administrativo!</p>
	</div>

	<div class="ml-auto flex items-center gap-4 flex-wrap">
		<a href="{{ route('admin.revistas') }}" class="inline-flex items-center gap-3 bg-white border p-3 rounded shadow hover:shadow-md transition-shadow">
			<div class="text-sm text-gray-500">Revista — submissões pendentes</div>
			<div class="text-xl font-semibold text-blue-600">{{ $pending ?? 0 }}</div>
		</a>
		<a href="{{ route('admin.candidaturas.index') }}?status=pendente" class="inline-flex items-center gap-3 bg-white border p-3 rounded shadow hover:shadow-md transition-shadow">
			<div class="text-sm text-gray-500">Candidaturas pendentes</div>
			<div class="text-xl font-semibold text-amber-600">{{ $pendingCandidaturas ?? 0 }}</div>
		</a>
	</div>
</div>
@endsection
