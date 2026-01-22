@extends('layouts.site')

@section('hero')
    @include('partials.hero', [
        'title' => 'Carta de Serviços',
        'subtitle' => 'Compromissos e prazos dos serviços institucionais'
    ])
@endsection

@section('content')
    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Carta de Serviços</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <section class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Serviços Acadêmicos</h2>
            <div class="space-y-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Emissão de Declaração</h3>
                            <p class="text-gray-600 mb-2">Declaração de matrícula, frequência ou conclusão de curso</p>
                            <span class="inline-block bg-teal-100 text-teal-800 text-sm px-3 py-1 rounded-full">Prazo: 2 dias úteis</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Emissão de Certificado</h3>
                            <p class="text-gray-600 mb-2">Certificado de conclusão de curso</p>
                            <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">Prazo: 15 dias úteis</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Solicitação de Histórico Escolar</h3>
                            <p class="text-gray-600 mb-2">Histórico completo ou parcial</p>
                            <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">Prazo: 5 dias úteis</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Serviços Administrativos</h2>
            <div class="space-y-4">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Matrícula</h3>
                    <p class="text-gray-600 mb-2">Processo de matrícula para novos alunos</p>
                    <span class="inline-block bg-orange-100 text-orange-800 text-sm px-3 py-1 rounded-full">Prazo: Conforme calendário</span>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Renovação de Matrícula</h3>
                    <p class="text-gray-600 mb-2">Renovação para estudantes veteranos</p>
                    <span class="inline-block bg-purple-100 text-purple-800 text-sm px-3 py-1 rounded-full">Prazo: Conforme calendário</span>
                </div>
            </div>
        </section>
    </div>


</body>
</html>

