
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница не найдена</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-700 flex items-center justify-center min-h-screen">

    <div class="text-center">
        <h1 class="text-6xl font-bold text-white mb-4">404</h1>
        <p class="text-2xl text-gray-100 mb-6">Упс! Страница не найдена или у вас нет доступа.</p>

        <button id="playVideoButton"
            class="inline-block px-6 py-3 text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-lg transition">
            На главную
        </button>

        <!-- Скрытый контейнер с видео -->
        <div id="videoContainer" class="mt-6 hidden">
            <iframe src="https://ok.ru/videoembed/2303014210122" width="600" height="400" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>

        <p id="redirectMessage" class="text-gray-100 mt-4 hidden">
            Перенаправляем на главную страницу...
        </p>
    </div>

    <script>
        const button = document.getElementById('playVideoButton');
        const videoContainer = document.getElementById('videoContainer');
        const video = document.getElementById('errorVideo');
        const redirectMessage = document.getElementById('redirectMessage');

        button.addEventListener('click', function() {
            videoContainer.classList.remove('hidden');
            button.disabled = true;
            button.classList.add('opacity-50', 'cursor-not-allowed');

            // Через 1.5 секунды запускаем видео
            setTimeout(() => {
                video.play();
            }, 1500);
        });

        video.addEventListener('ended', function() {
            redirectMessage.classList.remove('hidden');
            setTimeout(function() {
                window.location.href = "{{ route('welcome') }}"; // маршрут на главную
            }, 2000); // через 2 секунды после окончания видео
        });
    </script>


</body>
</html>
