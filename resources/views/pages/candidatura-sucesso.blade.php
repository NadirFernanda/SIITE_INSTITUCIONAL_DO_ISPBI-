@extends('layouts.site')

@section('title', 'Candidatura Submetida — ISP-Bié')

@section('content')
@php use Illuminate\Support\Facades\URL; @endphp
<div class="max-w-2xl mx-auto px-4 py-12">

    {{-- Ícone + título --}}
    <div class="text-center mb-8">
        <div class="flex justify-center mb-5">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Candidatura Submetida com Sucesso!</h1>
        <p class="text-gray-500">Ficha n.º <strong class="text-[#2563eb] text-lg">{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
    </div>

    {{-- Próximos passos --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6 shadow-sm">
        <h2 class="text-sm font-bold text-[#2563eb] uppercase tracking-wider mb-4">Próximos Passos para Concluir a Candidatura</h2>
        <p class="text-sm text-gray-600 mb-4">Para que a sua candidatura seja considerada <strong>CONCLUÍDA</strong>, deverá:</p>
        <ul class="space-y-2 mb-5">
            <li class="flex items-start gap-2 text-sm text-gray-700">
                <span class="text-[#2563eb] font-bold mt-0.5">—</span>
                Apresentar a documentação física exigida pela instituição;
            </li>
            <li class="flex items-start gap-2 text-sm text-gray-700">
                <span class="text-[#2563eb] font-bold mt-0.5">—</span>
                Apresentar o comprovativo de pagamento da candidatura;
            </li>
            <li class="flex items-start gap-2 text-sm text-gray-700">
                <span class="text-[#2563eb] font-bold mt-0.5">—</span>
                Aguardar a validação do Departamento dos Assuntos Académicos (DAAC).
            </li>
        </ul>
        <p class="text-sm text-gray-600 mb-2">
            Após a validação dos documentos e assinatura digital do comprovativo pelo DAAC, o estado da candidatura será alterado para <strong>CONCLUÍDA</strong>.
        </p>
        <p class="text-sm text-gray-600 mb-2">
            O comprovativo definitivo será enviado automaticamente para o seu <strong>email</strong> e <strong>WhatsApp</strong>.
        </p>
        <p class="text-sm text-gray-600">
            Caso necessário, poderá também levantar o comprovativo assinado <strong>presencialmente na instituição</strong>.
        </p>
    </div>

    {{-- Estado actual --}}
    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5 mb-6 flex items-start gap-3">
        <div class="text-amber-500 mt-0.5 text-lg flex-shrink-0">⏳</div>
        <div>
            <p class="font-bold text-gray-800 mb-1">Estado Actual da Candidatura</p>
            <p class="text-sm text-gray-700 mb-1">Status: <span class="bg-amber-200 text-amber-900 font-bold px-2 py-0.5 rounded-full text-xs">PENDENTE ⏳</span></p>
            <p class="text-sm text-amber-700 mt-2">A candidatura apenas será considerada concluída após a validação documental e assinatura digital do DAAC.</p>
        </div>
    </div>

    {{-- Resumo --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6 shadow-sm">
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
            Descarregar Comprovativo Provisório
        </a>
        <a href="{{ route('candidaturas') }}"
           class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-4 rounded-xl transition-colors text-sm">
            Voltar
        </a>
    </div>

    <p class="text-xs text-gray-400 mt-6 text-center">
        Guarde o n.º da sua ficha: <strong>{{ str_pad($candidatura->id, 5, '0', STR_PAD_LEFT) }}</strong>.
        O comprovativo definitivo será enviado por email e WhatsApp após a validação do DAAC.
    </p>

</div>
@endsection
