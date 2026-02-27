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
    <script src="{{ asset('js/locale-revista.js') }}"></script>
    <script>
        (function(){
            const form = document.getElementById('revista-form');
            if (!form) return;

            // Load labels/messages from centralized locale if available
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

            // Clear custom validity on input/change so browser tooltips disappear
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

                    // Required fields
                    if (['author','email','title','description','link'].includes(name)) {
                        if (!val) {
                            const msg = (msgs.required ? msgs.required(labels[name]) : `Por favor, preencha o campo "${labels[name]}".`);
                            errors.push(msg);
                            if (!firstField) { firstField = el; firstMessage = msg; }
                            return;
                        }
                    }

                    // Type-specific checks
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
                    // show aggregated errors
                    clientErrors.innerHTML = '<strong>' + (msgs.occurred || 'Ocorreram erros:') + '</strong><ul class="mt-2 list-disc list-inside">' + errors.map(function(i){ return '<li>'+i+'</li>'; }).join('') + '</ul>';
                    clientErrors.classList.remove('hidden');
                    // show native browser tooltip on first invalid field in Portuguese
                    if (firstField && firstMessage && typeof firstField.reportValidity === 'function') {
                        firstField.setCustomValidity(firstMessage);
                        firstField.reportValidity();
                        firstField.focus();
                    }
                    clientErrors.scrollIntoView({behavior:'smooth', block:'center'});
                    return false;
                } else {
                    if (clientErrors) clientErrors.classList.add('hidden');
                    // Ensure no lingering custom validity
                    Object.keys(labels).forEach(function(name){
                        const el = form.elements[name]; if (el) el.setCustomValidity('');
                    });
                }
            });
        })();
    </script>
@endsection
