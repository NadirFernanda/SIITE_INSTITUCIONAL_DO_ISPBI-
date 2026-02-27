@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 scroll-reveal">
        <nav class="text-sm opacity-75 mb-8">
            <a href="/" class="hover:underline">Início</a> \ <a href="{{ route('revista') }}" class="hover:underline">Revista Científica</a> \ Submeter Artigo
        </nav>

        <div class="bg-white rounded-lg shadow-md p-8 mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-[#2563eb] mb-2">Submeter Artigo</h1>
            <p class="text-gray-700">Preencha o formulário abaixo e anexe o ficheiro do artigo em formato PDF ou DOC/DOCX (até 10MB).</p>
        </div>

        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow">
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            <form action="{{ route('revista.submeter.post') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <label class="block">
                        <span class="text-gray-700">Autor</span>
                        <input type="text" name="author" value="{{ old('author') }}" required class="mt-1 block w-full rounded border-gray-300" />
                    </label>

                    <label class="block">
                        <span class="text-gray-700">Email de contacto</span>
                        <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded border-gray-300" />
                    </label>

                    <label class="block">
                        <span class="text-gray-700">Filiação (Instituição)</span>
                        <input type="text" name="affiliation" value="{{ old('affiliation') }}" class="mt-1 block w-full rounded border-gray-300" />
                    </label>

                    <label class="block">
                        <span class="text-gray-700">Categoria</span>
                        <input type="text" name="category" value="{{ old('category') }}" class="mt-1 block w-full rounded border-gray-300" />
                    </label>

                    <label class="block">
                        <span class="text-gray-700">Título</span>
                        <input type="text" name="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded border-gray-300" />
                    </label>

                    <label class="block">
                        <span class="text-gray-700">Descrição</span>
                        <textarea name="description" rows="4" required class="mt-1 block w-full rounded border-gray-300">{{ old('description') }}</textarea>
                    </label>

                    <label class="block">
                        <span class="text-gray-700">Link (URL)</span>
                        <input type="url" name="link" value="{{ old('link') }}" required class="mt-1 block w-full rounded border-gray-300" />
                    </label>

                    <label class="block">
                        <span class="text-gray-700">Observações (opcional)</span>
                        <textarea name="notes" rows="3" class="mt-1 block w-full rounded border-gray-300">{{ old('notes') }}</textarea>
                    </label>

                    <div class="flex justify-end">
                        <a href="{{ route('revista') }}" class="mr-3 px-4 py-2 border rounded">Cancelar</a>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">Enviar Submissão</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
