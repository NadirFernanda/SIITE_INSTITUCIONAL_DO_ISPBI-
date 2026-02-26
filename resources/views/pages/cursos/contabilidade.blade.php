@extends('layouts.site')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-[#B8860B] mb-6">Contabilidade e Administração</h1>

    <!-- Perfis de saída -->
    <div class="flex gap-4 mb-6 flex-wrap">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#B8860B]/20 flex items-center justify-center">🧾</div>
            <div>
                <div class="font-semibold">Contabilidade e Auditoria</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#B8860B]/20 flex items-center justify-center">💼</div>
            <div>
                <div class="font-semibold">Gestão Empresarial</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#B8860B]/20 flex items-center justify-center">📊</div>
            <div>
                <div class="font-semibold">Consultoria Financeira</div>
            </div>
        </div>
    </div>

    <p class="text-gray-700">Forma profissionais capacitados para atuar nas áreas de contabilidade, gestão empresarial, auditoria, finanças e administração.</p>

</div>

@endsection
