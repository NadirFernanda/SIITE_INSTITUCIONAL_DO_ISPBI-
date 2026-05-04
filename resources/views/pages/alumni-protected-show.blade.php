@extends('layouts.site')

@section('title', 'Alumni — ISP-Bié')

@section('content')
<section class="relative bg-gradient-to-r from-[#1e3a5f] to-[#2563eb] text-white py-16">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center space-x-4 mb-4">
      <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
      </svg>
      <div>
        <h1 class="text-3xl md:text-4xl font-bold">Dados protegidos de Alumni</h1>
        <p class="text-lg mt-1 opacity-90">Acesso apenas para utilizadores autenticados</p>
      </div>
    </div>
  </div>
</section>

<section class="py-16 bg-gray-50">
  <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-10 border border-gray-100">
      <h2 class="text-2xl font-bold text-gray-900 mb-6">Informações de Alumni</h2>
      <div class="grid gap-4 sm:grid-cols-2">
        <div class="rounded-2xl p-5 bg-gray-50 border border-gray-200">
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Nome</p>
          <p class="mt-2 text-gray-800">{{ $alumnus->nome }}</p>
        </div>
        <div class="rounded-2xl p-5 bg-gray-50 border border-gray-200">
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Curso</p>
          <p class="mt-2 text-gray-800">{{ $alumnus->curso }}</p>
        </div>
        <div class="rounded-2xl p-5 bg-gray-50 border border-gray-200">
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Contacto</p>
          <p class="mt-2 text-gray-800">{{ $alumnus->contacto }}</p>
        </div>
        <div class="rounded-2xl p-5 bg-gray-50 border border-gray-200">
          <p class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Empresa / Cargo</p>
          <p class="mt-2 text-gray-800">
            @if($alumnus->empresa)
              {{ $alumnus->empresa }} @if($alumnus->cargo) — {{ $alumnus->cargo }}@endif
            @else
              Não disponível
            @endif
          </p>
        </div>
      </div>

      <div class="mt-8">
        <h3 class="text-lg font-semibold text-gray-900">Mensagem</h3>
        <p class="mt-3 text-gray-700">{{ $alumnus->satisfacao ?? 'Sem mensagem disponível.' }}</p>
      </div>

      <div class="mt-8">
        <a href="{{ route('alumni') }}" class="inline-flex items-center px-4 py-2 bg-[#2563eb] text-white rounded-xl hover:bg-[#1d4ed8] transition">Voltar para Alumni</a>
      </div>
    </div>
  </div>
</section>
@endsection
