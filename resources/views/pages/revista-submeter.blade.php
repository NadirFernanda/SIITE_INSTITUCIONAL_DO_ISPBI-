 bn @extends('layouts.site')


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

            <form id="revista-form" action="{{ route('revista.submeter.post') }}" method="POST" novalidate>
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
    <script>
        (function(){
            const form = document.getElementById('revista-form');
            if (!form) return;

            const labels = {
                author: 'Autor',
                email: 'Email de contacto',
                affiliation: 'Filiação',
                category: 'Categoria',
                title: 'Título',
                description: 'Descrição',
                link: 'Link',
                notes: 'Observações'
            };

            function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }

            function isValidURL(url) {
                try { new URL(url); return true; } catch(e) { return false; }
            }

            form.addEventListener('submit', function(e){
                const errors = [];
                const firstInvalid = null;

                Object.keys(labels).forEach(function(name){
                    const el = form.elements[name];
                    if (!el) return;
                    const val = (el.value || '').trim();

                    // Required fields
                    if (['author','email','title','description','link'].includes(name)) {
                        if (!val) {
                            errors.push(`O campo "${labels[name]}" é obrigatório.`);
                            return;
                        }
                    }

                    // Type-specific checks
                    if (val) {
                        if (name === 'email' && !isValidEmail(val)) {
                            errors.push('O email informado não é válido.');
                        }
                        if (name === 'link' && !isValidURL(val)) {
                            errors.push('O link informado não é um URL válido.');
                        }
                    }
                });

                const clientErrors = document.getElementById('client-errors');
                if (errors.length) {
                    e.preventDefault();
                    clientErrors.innerHTML = '<strong>Ocorreram erros:</strong><ul class="mt-2 list-disc list-inside">' + errors.map(function(i){ return '<li>'+i+'</li>'; }).join('') + '</ul>';
                    clientErrors.classList.remove('hidden');
                    clientErrors.scrollIntoView({behavior:'smooth', block:'center'});
                    return false;
                } else {
                    // allow submit; hide client errors
                    if (clientErrors) clientErrors.classList.add('hidden');
                }
            });
        })();
    </script>
@endsection
