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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-ispbie-orange via-white to-ispbie-blue">
            <div class="flex flex-col items-center mb-0 gap-0">
                <a href="/">
                    <img src="/images/logo.png" alt="Instituto Superior Politécnico do Bié" class="w-24 h-24 object-contain mb-0" style="background:none;border:none;box-shadow:none;padding:0;" />
                </a>
                <div class="text-2xl font-bold text-ispbie-orange mt-0 mb-1 text-center">Painel administrativo do site</div>
            </div>

            <div class="w-full sm:max-w-md mt-0 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg" style="margin-top:0 !important;">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
