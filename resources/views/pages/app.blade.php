<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App ISP-Bié - Instituto Superior Politécnico do Bié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('partials.navbar')

    <div class="bg-gradient-to-r from-[#2563eb] to-[#3B82F6] text-white py-16 scroll-reveal">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl font-bold mb-4">App ISP-Bié</h1>
            <p class="text-xl text-purple-100">Aplicativo móvel oficial</p>
        </div>
    </div>

    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">App ISP-Bié</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12 scroll-reveal">
        <div class="text-center mb-16">
            <div class="w-32 h-32 bg-gradient-to-br from-[#2563eb] to-[#3B82F6] rounded-3xl mx-auto mb-6 flex items-center justify-center">
                <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Baixe o App Oficial</h2>
            <p class="text-gray-600 mb-8">Acesse todos os serviços do ISP-Bié na palma da sua mão</p>
            <div class="flex justify-center gap-4">
                <button class="bg-black text-white px-6 py-3 rounded-lg flex items-center hover:bg-gray-800">
                    <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                    </svg>
                    <div class="text-left">
                        <div class="text-xs">Download na</div>
                        <div class="text-sm font-semibold">App Store</div>
                    </div>
                </button>
                <button class="bg-black text-white px-6 py-3 rounded-lg flex items-center hover:bg-gray-800">
                    <svg class="w-8 h-8 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 20.5v-17c0-.59.34-1.11.84-1.35L13.69 12l-9.85 9.85c-.5-.24-.84-.76-.84-1.35zm13.81-5.38L6.05 21.34l8.49-8.49 2.27 2.27zm2.35-1.48l-2.35 1.36-2.58-2.58 2.58-2.58 2.35 1.36c.63.36.63 1.26 0 1.62zM6.05 2.66l10.76 6.22-2.27 2.27L6.05 2.66z"/>
                    </svg>
                    <div class="text-left">
                        <div class="text-xs">Disponível no</div>
                        <div class="text-sm font-semibold">Google Play</div>
                    </div>
                </button>
            </div>
        </div>

        <section class="mb-16 scroll-reveal">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Funcionalidades</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Consulta de Notas</h3>
                    <p class="text-gray-600">Acesse suas notas em tempo real</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card">
                    <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-8 h-8 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Horários</h3>
                    <p class="text-gray-600">Consulte seus horários de aulas</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md text-center interactive-card">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Notificações</h3>
                    <p class="text-gray-600">Receba avisos importantes</p>
                </div>
            </div>
        </section>
    </div>


</body>
</html>

