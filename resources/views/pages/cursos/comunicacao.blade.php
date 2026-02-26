@extends('layouts.site')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-[#F59E42] mb-6">Comunicação Social</h1>

    <!-- Perfis de saída -->
    <div class="flex gap-4 mb-6 flex-wrap">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#F59E42]/20 flex items-center justify-center">📰</div>
            <div>
                <div class="font-semibold">Jornalismo</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#F59E42]/20 flex items-center justify-center">👥</div>
            <div>
                <div class="font-semibold">Relações Públicas</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#F59E42]/20 flex items-center justify-center">💻</div>
            <div>
                <div class="font-semibold">Comunicação Digital</div>
            </div>
        </div>
    </div>

    <p class="text-gray-700">Capacita profissionais para atuar em jornalismo, relações públicas, publicidade, comunicação organizacional e produção de conteúdo digital.</p>

</div>

@endsection
