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

    {{-- Estado actual --}}
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 mb-6 flex items-start gap-4">
        <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="font-bold text-amber-800 mb-1">Estado Actual: <span class="bg-amber-200 text-amber-900 px-2 py-0.5 rounded-full text-sm">PENDENTE</span></p>
            <p class="text-sm text-amber-700">O comprovativo gerado nesta fase é apenas um <strong>comprovativo provisório de submissão</strong>. A candidatura ainda não está concluída.</p>
        </div>
    </div>

    {{-- Próximos passos --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6 shadow-sm">
        <h2 class="text-sm font-bold text-[#2563eb] uppercase tracking-wider mb-4">Próximos Passos para Concluir a Candidatura</h2>
        <div class="space-y-3">
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-[#2563eb] text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">1</div>
                <p class="text-sm text-gray-700">Descarregue e imprima o comprovativo provisório abaixo.</p>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-[#2563eb] text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">2</div>
                <p class="text-sm text-gray-700">Apresente-se à instituição com a <strong>documentação física exigida</strong> e o <strong>comprovativo de pagamento</strong>.</p>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-[#2563eb] text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">3</div>
                <p class="text-sm text-gray-700">O DAAC (Departamento dos Assuntos Académicos) irá validar os documentos e <strong>assinar digitalmente</strong> o comprovativo.</p>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0 mt-0.5">✓</div>
                <p class="text-sm text-gray-700">Após a assinatura, receberá o comprovativo definitivo <strong>por email e WhatsApp</strong> e o estado mudará para <strong>CONCLUÍDA</strong>.</p>
            </div>
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
