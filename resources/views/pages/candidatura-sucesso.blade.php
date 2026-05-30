@extends('layouts.site')

@section('title', 'Candidatura Submetida — ISP-Bié')

@section('content')
@php use Illuminate\Support\Facades\URL; @endphp
<div class="max-w-2xl mx-auto px-4 py-16 text-center">

    {{-- Ícone de sucesso --}}
    <div class="flex justify-center mb-6">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
            <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
    </div>

    <h1 class="text-3xl font-bold text-gray-900 mb-3">Candidatura Submetida!</h1>
    <p class="text-gray-500 mb-2">Ficha n.º <strong class="text-[#2563eb]">{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
    <p class="text-gray-600 mb-8">
        A sua candidatura foi registada com sucesso.<br>
        Faça o download do comprovativo, imprima-o ou guarde em formato digital para apresentar no dia da prova.
    </p>

    {{-- Resumo --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 text-left mb-8 shadow-sm">
        <h2 class="text-sm font-bold text-[#2563eb] uppercase tracking-wider mb-4">Resumo da Candidatura</h2>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div>
                <p class="text-gray-400 text-xs uppercase font-semibold mb-0.5">Nome</p>
                <p class="font-semibold text-gray-900">{{ $candidatura->nome }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase font-semibold mb-0.5">BI</p>
                <p class="font-semibold text-gray-900">{{ $candidatura->bi }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase font-semibold mb-0.5">Curso</p>
                <p class="font-semibold text-gray-900">{{ $candidatura->curso }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs uppercase font-semibold mb-0.5">Período</p>
                <p class="font-semibold text-gray-900">{{ $candidatura->periodo === 'pos-laboral' ? 'Pós-Laboral' : 'Regular' }}</p>
            </div>
        </div>
    </div>

    {{-- Botões --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ URL::temporarySignedRoute('candidaturas.pdf', now()->addHours(72), ['candidatura' => $candidatura->id]) }}"
           class="inline-flex items-center justify-center gap-3 bg-[#2563eb] hover:bg-[#174ea6] text-white font-bold px-8 py-4 rounded-xl transition-colors text-sm shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Descarregar Comprovativo (PDF)
        </a>
        <a href="{{ route('candidaturas') }}"
           class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-4 rounded-xl transition-colors text-sm">
            Voltar ao início
        </a>
    </div>

    <p class="text-xs text-gray-400 mt-8">
        Guarde o número da sua ficha: <strong>{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</strong>.<br>
        Apresente o comprovativo impresso ou em formato digital no dia do exame de acesso.
    </p>

</div>
@endsection
