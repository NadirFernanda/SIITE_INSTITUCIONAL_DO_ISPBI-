@extends('layouts.site')

@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
      <div class="flex">
        <nav class="text-sm opacity-75 mb-8 text-left">
          <a href="/" class="hover:underline">Início</a> \ Busca
        </nav>
      </div>

      <div class="bg-white rounded-lg shadow-md p-8 mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Busca no site</h1>
        <p class="text-lg text-gray-700">Funcionalidade de busca global em desenvolvimento.</p>
      </div>

      @if(request('q'))
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-2xl font-bold text-[#2563eb] mb-3">Termo pesquisado</h2>
          <p class="text-gray-700">Você pesquisou por: <span class="font-semibold">{{ request('q') }}</span></p>
          <p class="text-gray-600 mt-4 text-sm">Em breve, a busca exibirá resultados de notícias, cursos e páginas institucionais relacionados a este termo.</p>
        </div>
      @endif
  </div>
@endsection
