
@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Editar Indicadores - Alumni em Números</h1>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-300">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded shadow p-6 max-w-3xl">
        <form method="POST" action="{{ route('admin.alumni.stats.update') }}">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <label class="block">
                    <span class="text-sm font-semibold">Alumni Formados</span>
                    <input type="number" name="alumni_count" value="{{ old('alumni_count', $stats->alumni_count ?? 0) }}" min="0" required class="mt-1 block w-full border rounded px-3 py-2">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold">Taxa de Empregabilidade (%)</span>
                    <input type="number" name="employability_percentage" value="{{ old('employability_percentage', $stats->employability_percentage ?? 0) }}" min="0" max="100" required class="mt-1 block w-full border rounded px-3 py-2">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold">Países onde trabalham</span>
                    <input type="number" name="countries_count" value="{{ old('countries_count', $stats->countries_count ?? 0) }}" min="0" required class="mt-1 block w-full border rounded px-3 py-2">
                </label>

                <label class="block">
                    <span class="text-sm font-semibold">Empresas fundadas</span>
                    <input type="number" name="companies_founded" value="{{ old('companies_founded', $stats->companies_founded ?? 0) }}" min="0" required class="mt-1 block w-full border rounded px-3 py-2">
                </label>

                <div class="pt-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar Indicadores</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
