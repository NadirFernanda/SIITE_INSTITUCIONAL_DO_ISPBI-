@extends('layouts.site')

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-[#2563EB] mb-6">Engenharia Informática</h1>

    <!-- Perfis de saída -->
    <div class="flex gap-4 mb-6 flex-wrap">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#2563EB]/20 flex items-center justify-center">💻</div>
            <div>
                <div class="font-semibold">Desenvolvimento de Software</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#2563EB]/20 flex items-center justify-center">🖧</div>
            <div>
                <div class="font-semibold">Redes e Sistemas</div>
            </div>
        </div>
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 rounded-full bg-[#2563EB]/20 flex items-center justify-center">🔒</div>
            <div>
                <div class="font-semibold">Segurança da Informação</div>
            </div>
        </div>
    </div>

    <p class="text-gray-700">Prepara profissionais para desenvolver soluções tecnológicas inovadoras, sistemas de informação, redes de computadores e infraestrutura de TI.</p>

</div>

@endsection
