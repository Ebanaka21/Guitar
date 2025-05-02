<!-- resources/views/components/dashboard-layout.blade.php -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Навигация -->
        @include('layouts.navigation')

        <!-- Основной контент -->
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>

        <!-- Футер -->
    </div>
</body>
</html>
