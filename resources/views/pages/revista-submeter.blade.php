@extends('layouts.site')


@section('content')
    <div class="institutional-page">
        @include('partials.page-hero', [
            'title' => 'Submeter Artigo',
            'subtitle' => 'Preencha o formulário, submeta os dados correctos e aguarde aprovação do administrador do site.',
            'breadcrumb' => 'Submeter Artigo',
            'parentUrl' => route('revista'),
            'parentLabel' => 'Revista Científica',
        ])

        <section class="max-w-4xl mx-auto">
            @if(session('status'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded">{{ session('status') }}</div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-50 text-red-800 rounded" id="server-errors">
                    <strong>Ocorreram erros:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="client-errors" class="mb-4 hidden p-4 bg-red-50 text-red-800 rounded"></div>

            <form id="revista-form" action="{{ route('revista.submeter.post') }}" method="POST" enctype="multipart/form-data" novalidate class="institutional-card">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label for="revista_author" class="block text-sm font-medium text-gray-700">Autor</label>
                        <input id="revista_author" type="text" name="author" value="{{ old('author') }}" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    <div>
                        <label for="revista_email" class="block text-sm font-medium text-gray-700">Email de contacto</label>
                        <input id="revista_email" type="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    <div>
                        <label for="revista_affiliation" class="block text-sm font-medium text-gray-700">Filiação (Instituição)</label>
                        <input id="revista_affiliation" type="text" name="affiliation" value="{{ old('affiliation') }}" class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    <div>
                        <label for="revista_category" class="block text-sm font-medium text-gray-700">Área de Conhecimento</label>
                        <select id="revista_category" name="category" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2">
                            <option value="" disabled {{ old('category') ? '' : 'selected' }}>-- Selecionar área de conhecimento --</option>
                            <option value="Engenharias e Tecnologia" {{ old('category') === 'Engenharias e Tecnologia' ? 'selected' : '' }}>Engenharias e Tecnologia</option>
                            <option value="Ciências da Saúde" {{ old('category') === 'Ciências da Saúde' ? 'selected' : '' }}>Ciências da Saúde</option>
                            <option value="Ciências Sociais e Humanas" {{ old('category') === 'Ciências Sociais e Humanas' ? 'selected' : '' }}>Ciências Sociais e Humanas</option>
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="revista_title" class="block text-sm font-medium text-gray-700">Título</label>
                        <input id="revista_title" type="text" name="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    <div class="col-span-1">
                        <label for="revista_description" class="block text-sm font-medium text-gray-700">Descrição</label>
                        <textarea id="revista_description" name="description" rows="4" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="revista_link" class="block text-sm font-medium text-gray-700">Link (URL)</label>
                        <input id="revista_link" type="url" name="link" value="{{ old('link') }}" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    {{-- notes field removed per request (optional observations) --}}

                    {{-- file upload removed: articles already include a PDF link, so file input is unnecessary --}}

                    <div class="flex justify-end items-center gap-3 mt-4">
                        <a href="{{ route('revista') }}" class="inline-flex items-center rounded-xl border border-gray-200 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Cancelar</a>
                        <button type="submit" class="institutional-button">Enviar Submissão</button>
                    </div>
                </div>
            </form>
        </section>
    </div>

        <script src="{{ asset('js/locale-revista.js') }}"></script>
@endsection
