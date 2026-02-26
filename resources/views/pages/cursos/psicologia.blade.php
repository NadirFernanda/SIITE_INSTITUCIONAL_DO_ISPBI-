@extends('layouts.site')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-[#C62828] mb-6">Psicologia Clínica</h1>

    <!-- Perfis de saída -->
    <div class="flex gap-4 mb-6 flex-wrap">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#C62828]/20 flex items-center justify-center">💓</div>
            <div>
                <div class="font-semibold">Psicologia Clínica</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#C62828]/20 flex items-center justify-center">👥</div>
            <div>
                <div class="font-semibold">Saúde Mental Comunitária</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#C62828]/20 flex items-center justify-center">💬</div>
            <div>
                <div class="font-semibold">Psicoterapia</div>
            </div>
        </div>
    </div>

    <p class="text-gray-700">Forma psicólogos aptos a atuar na promoção da saúde mental, diagnóstico, intervenção terapêutica e acompanhamento psicológico em diversos contextos.</p>

</div>

@endsection
