<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webmail - Instituto Superior Politécnico do Bié</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    @include('partials.navbar')

    <!-- Cabeçalho em card -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-6">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <h1 class="text-3xl font-bold text-[#2563eb] mb-2">Webmail ISP-Bié</h1>
            <p class="text-gray-600">Email institucional para estudantes, docentes e funcionários.</p>
        </div>
    </div>

    <div class="bg-white border-b">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center text-sm text-gray-600">
                <a href="/" class="hover:text-teal-600">Início</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900">Webmail</span>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-12">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md text-center">
            <svg class="w-24 h-24 mx-auto mb-6 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
            </svg>
            <h2 class="text-3xl font-bold text-gray-900 mb-4 text-center">Acesso ao Email Institucional</h2>
            <p class="text-gray-600 mb-8 text-center">Acesse seu email @ispbie.ao através do webmail</p>
            <a href="https://isp-bie.ao/webmail" target="_blank" rel="noopener" class="bg-teal-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors inline-block">
                Acessar Webmail
            </a>
            <script>
                // Atualiza o link para o padrão do cPanel
                document.addEventListener('DOMContentLoaded', function() {
                    var btn = document.querySelector('a.bg-teal-600');
                    if(btn) btn.href = 'https://isp-bie.ao/webmail';
                });
            </script>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>

