<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="/favicon.png" />
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center px-4 py-10" style="background:linear-gradient(135deg,#eef2f7 0%,#e2e8f0 50%,#eaeff5 100%);">
            <div class="flex flex-col items-center mb-6">
                <a href="/">
                    <img src="/images/logo.png" alt="Instituto Superior Politécnico do Bié" class="w-20 h-20 object-contain">
                </a>
                <div class="text-xl font-bold text-[#1e3a5f] mt-3 text-center">Painel administrativo do site</div>
            </div>

            <div class="w-full sm:max-w-md bg-white shadow-xl rounded-2xl px-8 py-8 border border-gray-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
