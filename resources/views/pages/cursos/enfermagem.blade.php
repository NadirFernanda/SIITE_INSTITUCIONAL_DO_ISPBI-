@extends('layouts.site')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-[#2563eb] mb-6">Enfermagem Geral</h1>

    <!-- Perfis de saída -->
    <div class="flex gap-4 mb-6 flex-wrap">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#16A34A]/20 flex items-center justify-center">❤</div>
            <div>
                <div class="font-semibold">Enfermagem Hospitalar</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#16A34A]/20 flex items-center justify-center">👥</div>
            <div>
                <div class="font-semibold">Saúde Pública</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#16A34A]/20 flex items-center justify-center">📋</div>
            <div>
                <div class="font-semibold">Gestão em Saúde</div>
            </div>
        </div>
    </div>

    <p class="text-gray-700">Forma profissionais aptos a atuar na promoção, prevenção, recuperação e reabilitação da saúde, com foco no cuidado humanizado e na gestão em saúde.</p>

</div>

@endsection
