@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Alumni Cadastrados</h1>
    <div class="bg-white rounded shadow p-6">
        @if($alumni->isEmpty())
            <div class="text-gray-500 mt-4">Nenhum cadastro de alumni ainda.</div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-3">Nome</th>
                        <th class="py-2 px-3">Curso</th>
                        <th class="py-2 px-3">Ano</th>
                        <th class="py-2 px-3">Contacto</th>
                        <th class="py-2 px-3">Trabalha?</th>
                        <th class="py-2 px-3">Empresa</th>
                        <th class="py-2 px-3">Cargo</th>
                        <th class="py-2 px-3">Publicado</th>
                        <th class="py-2 px-3">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumni as $alumnus)
                        <tr class="border-b">
                            <td class="py-2 px-3">{{ $alumnus->nome }}</td>
                            <td class="py-2 px-3">{{ $alumnus->curso }}</td>
                            <td class="py-2 px-3">{{ $alumnus->ano }}</td>
                            <td class="py-2 px-3">{{ $alumnus->contacto }}</td>
                            <td class="py-2 px-3">{{ $alumnus->trabalha ? 'Sim' : 'Não' }}</td>
                            <td class="py-2 px-3">{{ $alumnus->empresa }}</td>
                            <td class="py-2 px-3">{{ $alumnus->cargo }}</td>
                            <td class="py-2 px-3">
                                @if($alumnus->publicado)
                                    <span class="inline-block px-2 py-1 bg-green-200 text-green-800 rounded text-xs">Sim</span>
                                @else
                                    <span class="inline-block px-2 py-1 bg-gray-200 text-gray-800 rounded text-xs">Não</span>
                                @endif
                            </td>
                            <td class="py-2 px-3 space-y-1">
                                <form method="POST" action="{{ route('admin.alumni.toggle-publicar', $alumnus->id) }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 {{ $alumnus->publicado ? 'bg-yellow-400 text-yellow-900 hover:bg-yellow-500' : 'bg-blue-600 text-white hover:bg-blue-700' }}">
                                        {{ $alumnus->publicado ? 'Despublicar' : 'Publicar' }}
                                    </button>
                                </form>
                                @if($alumnus->trabalha)
                                    <form method="POST" action="{{ route('admin.alumni.toggle-testemunho', $alumnus->id) }}">
                                        @csrf
                                        <button type="submit" class="px-4 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 {{ $alumnus->testemunho ? 'bg-green-500 text-white hover:bg-green-600' : 'bg-blue-600 text-white hover:bg-blue-700' }}">
                                            {{ $alumnus->testemunho ? 'Remover de Testemunhos' : 'Publicar em Testemunhos' }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
