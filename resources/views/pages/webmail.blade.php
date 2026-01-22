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

    <div class="bg-gradient-to-r from-[#2563eb] to-[#2563eb] text-white py-16">
        <div class="container mx-auto px-6">
            <h1 class="text-5xl font-bold mb-4">Webmail ISP-Bié</h1>
            <p class="text-xl text-blue-100">Email institucional para estudantes, docentes e funcionários</p>
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
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Acesso ao Email Institucional</h2>
            <p class="text-gray-600 mb-8">Acesse seu email @ispbie.ao através do webmail</p>
            <button class="bg-teal-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors">
                Acessar Webmail
            </button>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>

