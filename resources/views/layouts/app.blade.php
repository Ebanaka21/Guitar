<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <header></header>

    <div>
        <!-- Основной контент -->
        <main>
            @yield('content')

            <!-- Кнопка "Наверх" -->
            <button id="scrollToTopBtn" class="fixed bottom-10 right-8 p-10 bg-yellow-300 text-white rounded-full shadow-lg hover:bg-indigo-700 transition-opacity opacity-0 invisible z-50">
                <i class="fas fa-arrow-up"></i>
            </button>
        </main>

        <!-- Футер -->
        <footer>
            @include('partials.footer')
        </footer>
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>

</html>
