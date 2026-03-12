@extends('layouts.site')

@section('title', 'Estatísticas Institucionais - ISP-Bié')

@section('content')

    <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white py-16 scroll-reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-5xl font-bold mb-4">Estatísticas Institucionais</h1>
            <p class="text-xl text-blue-100">Dados e indicadores do ISP-Bié</p>
        </div>
    </div>

    <div class="bg-white border-b scroll-reveal">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Estatísticas</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <section class="mb-16 scroll-reveal">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Dados Gerais 2024</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md text-center stat-card">
                    <div class="text-4xl font-bold text-teal-600 mb-2">1,247</div>
                    <div class="text-gray-600">Estudantes</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center stat-card">
                    <div class="text-4xl font-bold text-blue-600 mb-2">89</div>
                    <div class="text-gray-600">Docentes</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center stat-card">
                    <div class="text-4xl font-bold text-green-600 mb-2">6</div>
                    <div class="text-gray-600">Cursos</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center stat-card">
                    <div class="text-4xl font-bold text-orange-600 mb-2">245</div>
                    <div class="text-gray-600">Diplomados</div>
                </div>
            </div>
        </section>

        <section class="mb-16 scroll-reveal">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Evolução de Matrículas</h2>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="h-64 flex items-end justify-around">
                    <div class="flex flex-col items-center">
                        <div class="w-20 bg-teal-600 rounded-t" style="height: 45%"></div>
                        <span class="mt-2 text-sm text-gray-600">2021</span>
                        <span class="text-xs text-gray-500">856</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-20 bg-teal-600 rounded-t" style="height: 60%"></div>
                        <span class="mt-2 text-sm text-gray-600">2022</span>
                        <span class="text-xs text-gray-500">1,024</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-20 bg-teal-600 rounded-t" style="height: 80%"></div>
                        <span class="mt-2 text-sm text-gray-600">2023</span>
                        <span class="text-xs text-gray-500">1,156</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <div class="w-20 bg-teal-600 rounded-t" style="height: 100%"></div>
                        <span class="mt-2 text-sm text-gray-600">2024</span>
                        <span class="text-xs text-gray-500">1,247</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="scroll-reveal">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Distribuição por Curso</h2>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Contabilidade e Administração</span>
                            <span class="font-semibold text-gray-900">285 (22.9%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-teal-600 h-3 rounded-full" style="width: 22.9%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Engenharia Informática</span>
                            <span class="font-semibold text-gray-900">245 (19.6%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-blue-600 h-3 rounded-full" style="width: 19.6%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Eng. Recursos Hídricos</span>
                            <span class="font-semibold text-gray-900">198 (15.9%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-green-600 h-3 rounded-full" style="width: 15.9%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Comunicação Social</span>
                            <span class="font-semibold text-gray-900">212 (17.0%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-orange-600 h-3 rounded-full" style="width: 17%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Psicologia Clínica</span>
                            <span class="font-semibold text-gray-900">178 (14.3%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-purple-600 h-3 rounded-full" style="width: 14.3%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Engenharia Civil</span>
                            <span class="font-semibold text-gray-900">129 (10.3%)</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-red-600 h-3 rounded-full" style="width: 10.3%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection

