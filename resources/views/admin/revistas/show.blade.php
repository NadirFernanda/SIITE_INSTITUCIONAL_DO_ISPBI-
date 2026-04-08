@extends('layouts.site')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <h1 class="text-2xl font-bold mb-2">{{ $s->title }}</h1>
        <p class="text-sm text-gray-600">Autor: {{ $s->author }} — Categoria: {{ $s->category ?? '—' }}</p>
        <div class="mt-4 bg-white p-4 rounded shadow">
            <p class="mb-4">{{ $s->description }}</p>
            <p class="text-sm">Link: @if($s->link && preg_match('/^https?:\/\//i', $s->link))<a href="{{ $s->link }}" target="_blank" class="underline">Abrir</a>@else<span class="text-gray-400">—</span>@endif</p>
            <p class="text-sm mt-2">Email: {{ $s->email }}</p>
            <p class="text-sm">Filiação: {{ $s->affiliation }}</p>
            <p class="text-sm">Observações: {{ $s->notes }}</p>
            <div class="mt-4">
                <a href="{{ route('admin.revistas.edit', $s->id) }}" class="px-3 py-2 bg-yellow-500 text-white rounded">Editar</a>
                <a href="{{ route('admin.revistas') }}" class="ml-2 px-3 py-2 border rounded">Voltar</a>
            </div>
        </div>
    </div>
@endsection
