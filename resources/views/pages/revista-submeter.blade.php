@extends('layouts.site')


@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <nav class="text-sm text-gray-500 mb-6">
            <a href="/" class="hover:underline">Início</a>
            <span class="mx-2">/</span>
            <a href="{{ route('revista') }}" class="hover:underline">Revista Científica</a>
            <span class="mx-2">/</span>
            <span class="font-medium text-gray-700">Submeter Artigo</span>
        </nav>

        <header class="bg-gradient-to-r from-white via-sky-50 to-white rounded-lg p-6 mb-8 shadow-sm border">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 flex items-center justify-center bg-blue-600 text-white rounded-md shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2v4h6v-4c0-1.105-1.343-2-3-2z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Submeter Artigo</h1>
                    <p class="text-gray-600 mt-1">Preencha o formulário e anexe o ficheiro do artigo em PDF ou DOC/DOCX (até 10MB).</p>
                </div>
            </div>
        </header>

        <main class="max-w-4xl mx-auto">
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

            <form id="revista-form" action="{{ route('revista.submeter.post') }}" method="POST" enctype="multipart/form-data" novalidate class="bg-white shadow-lg rounded-xl p-8 ring-1 ring-gray-100">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Autor</label>
                        <input type="text" name="author" value="{{ old('author') }}" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email de contacto</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Filiação (Instituição)</label>
                        <input type="text" name="affiliation" value="{{ old('affiliation') }}" class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Categoria</label>
                        <input type="text" name="category" value="{{ old('category') }}" class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Título</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Descrição</label>
                        <textarea name="description" rows="4" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Link (URL)</label>
                        <input type="url" name="link" value="{{ old('link') }}" required class="mt-1 block w-full rounded-lg border-gray-200 shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent px-3 py-2" />
                    </div>

                    {{-- notes field removed per request (optional observations) --}}

                    {{-- file upload removed: articles already include a PDF link, so file input is unnecessary --}}

                    <div class="flex justify-end items-center gap-3 mt-4">
                        <a href="{{ route('revista') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 rounded-md text-sm text-gray-700 hover:bg-gray-50">Cancelar</a>
                        <button type="submit" class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-md shadow hover:from-blue-700 hover:to-indigo-700 transition">Enviar Submissão</button>
                    </div>
                </div>
            </form>
        </main>
    </div>

        <script src="{{ asset('js/locale-revista.js') }}"></script>
    <script>
        (function(){
            const form = document.getElementById('revista-form');
            if (!form) return;

            const locale = window.RevistaLocale || {};
            const labels = locale.labels || {
                author: 'Autor', email: 'Email de contacto', affiliation: 'Filiação', category: 'Categoria',
                title: 'Título', description: 'Descrição', link: 'Link', notes: 'Observações'
            };
            const msgs = (locale.messages || {});

            function isValidEmail(email) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
            }

            function isValidURL(url) {
                try { new URL(url); return true; } catch(e) { return false; }
            }

            Object.keys(labels).forEach(function(name){
                const el = form.elements[name];
                if (!el) return;
                el.addEventListener('input', function(){ el.setCustomValidity(''); });
                el.addEventListener('change', function(){ el.setCustomValidity(''); });
            });

            form.addEventListener('submit', function(e){
                const errors = [];
                let firstField = null;
                let firstMessage = null;

                Object.keys(labels).forEach(function(name){
                    const el = form.elements[name];
                    if (!el) return;
                    const val = (el.value || '').trim();

                    if (['author','email','title','description','link'].includes(name)) {
                        if (!val) {
                            const msg = (msgs.required ? msgs.required(labels[name]) : `Por favor, preencha o campo "${labels[name]}".`);
                            errors.push(msg);
                            if (!firstField) { firstField = el; firstMessage = msg; }
                            return;
                        }
                    }

                    if (val) {
                        if (name === 'email' && !isValidEmail(val)) {
                            const msg = (msgs.invalidEmail || 'Por favor, introduza um endereço de email válido.');
                            errors.push(msg);
                            if (!firstField) { firstField = el; firstMessage = msg; }
                        }
                        if (name === 'link' && !isValidURL(val)) {
                            const msg = (msgs.invalidURL || 'Por favor, introduza um URL válido.');
                            errors.push(msg);
                            if (!firstField) { firstField = el; firstMessage = msg; }
                        }
                    }
                });

                const clientErrors = document.getElementById('client-errors');
                if (errors.length) {
                    e.preventDefault();
                    clientErrors.innerHTML = '<strong>' + (msgs.occurred || 'Ocorreram erros:') + '</strong><ul class="mt-2 list-disc list-inside">' + errors.map(function(i){ return '<li>'+i+'</li>'; }).join('') + '</ul>';
                    clientErrors.classList.remove('hidden');
                    if (firstField && firstMessage && typeof firstField.reportValidity === 'function') {
                        firstField.setCustomValidity(firstMessage);
                        firstField.reportValidity();
                        firstField.focus();
                    }
                    clientErrors.scrollIntoView({behavior:'smooth', block:'center'});
                    return false;
                } else {
                    if (clientErrors) clientErrors.classList.add('hidden');
                    Object.keys(labels).forEach(function(name){
                        const el = form.elements[name]; if (el) el.setCustomValidity('');
                    });
                }
            });
        })();
    </script>
@endsection
