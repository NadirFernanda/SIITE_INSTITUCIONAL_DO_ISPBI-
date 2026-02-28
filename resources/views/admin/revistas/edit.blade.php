@extends('layouts.site')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
        <h1 class="text-2xl font-bold mb-4">Editar Submissão #{{ $s->id }}</h1>

        <form action="{{ route('admin.revistas.update', $s->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-4 bg-white p-6 rounded shadow">
                <label>
                    <span class="text-gray-700">Autor</span>
                    <input type="text" name="author" value="{{ old('author', $s->author) }}" class="mt-1 block w-full rounded border-gray-300" required />
                </label>

                <label>
                    <span class="text-gray-700">Email</span>
                    <input type="email" name="email" value="{{ old('email', $s->email) }}" class="mt-1 block w-full rounded border-gray-300" required />
                </label>

                <label>
                    <span class="text-gray-700">Título</span>
                    <input type="text" name="title" value="{{ old('title', $s->title) }}" class="mt-1 block w-full rounded border-gray-300" required />
                </label>

                <label>
                    <span class="text-gray-700">Descrição</span>
                    <textarea name="description" rows="4" class="mt-1 block w-full rounded border-gray-300" required>{{ old('description', $s->description) }}</textarea>
                </label>

                <label>
                    <span class="text-gray-700">Link</span>
                    <input type="url" name="link" value="{{ old('link', $s->link) }}" class="mt-1 block w-full rounded border-gray-300" required />
                </label>

                <label>
                    <span class="text-gray-700">Área de Conhecimento</span>
                    <select name="category" class="mt-1 block w-full rounded border-gray-300">
                        <option value="" {{ old('category', $s->category) ? '' : 'selected' }}>-- Selecionar área --</option>
                        <option value="Engenharias e Tecnologia" {{ old('category', $s->category)=='Engenharias e Tecnologia' ? 'selected' : '' }}>Engenharias e Tecnologia</option>
                        <option value="Ciências da Saúde" {{ old('category', $s->category)=='Ciências da Saúde' ? 'selected' : '' }}>Ciências da Saúde</option>
                        <option value="Ciências Sociais e Humanas" {{ old('category', $s->category)=='Ciências Sociais e Humanas' ? 'selected' : '' }}>Ciências Sociais e Humanas</option>
                    </select>
                </label>

                <label>
                    <span class="text-gray-700">Observações</span>
                    <textarea name="notes" rows="3" class="mt-1 block w-full rounded border-gray-300">{{ old('notes', $s->notes) }}</textarea>
                </label>

                <label>
                    <span class="text-gray-700">Estado</span>
                    <select name="status" class="mt-1 block w-full rounded border-gray-300">
                        <option value="pending" {{ old('status', $s->status)=='pending' ? 'selected' : '' }}>Pendente</option>
                        <option value="published" {{ old('status', $s->status)=='published' ? 'selected' : '' }}>Publicado</option>
                    </select>
                </label>

                <div class="flex justify-end">
                    <a href="{{ route('admin.revistas') }}" class="mr-3 px-4 py-2 border rounded">Cancelar</a>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
