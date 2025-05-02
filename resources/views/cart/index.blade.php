@include('partials.header')
@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-container>
    <section class="mt-20 mb-32 top-20 z-10 after:contents-[''] after:z-0 after:h-full xl:after:w-1/3 after:top-0 after:right-0 after:bg-gray-100">
        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto relative z-10 mt-100">
            <div class="grid grid-cols-12">
                <!-- Основная часть корзины -->
                <div class="col-span-12 xl:col-span-8 lg:pr-8 pt-14 pb-8 lg:w-full max-xl:max-w-3xl max-xl:mx-auto">
                    <!-- Заголовок корзины -->
                    <div class="flex items-center justify-between pb-8 border-b border-gray-300">
                        <h2 class="font-manrope font-bold text-3xl leading-10 text-black">Корзина</h2>
                        <h2 class="font-manrope font-bold text-xl leading-8 text-gray-600">{{ $cartItems->count() }} Товаров</h2>
                    </div>

                    <!-- Список товаров -->
                    @if($cartItems->isEmpty())
                        <div class="text-center py-12 bg-yellow-50 rounded-xl">
                            <svg class="w-16 h-16 mx-auto text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-gray-600 text-lg mt-4">Ваша корзина пуста</p>
                            <a href="/" class="mt-6 inline-block px-6 py-3 bg-yellow-400 text-gray-900 font-medium rounded-lg hover:bg-yellow-500 transition-colors duration-300 shadow-md hover:shadow-lg">
                                Вернуться к покупкам
                            </a>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($cartItems as $item)
                                <div class="flex flex-col sm:flex-row gap-6 p-6 bg-white rounded-xl border border-yellow-100 hover:shadow-lg transition-all duration-300">
                                    <!-- Изображение товара -->
                                    <div class="w-full sm:w-32 flex-shrink-0">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-32 object-contain rounded-lg bg-yellow-50 p-2">
                                    </div>

                                    <!-- Информация о товаре -->
                                    <div class="flex-1">
                                        <div class="flex flex-col md:flex-row md:justify-between gap-4">
                                            <div>
                                                <h3 class="text-lg font-bold text-gray-800">{{ $item->product->name }}</h3>
                                                <p class="text-gray-500 mt-1">{{ $item->product->type }}</p>

                                                @if($item->product->category)
                                                    <p class="text-sm text-gray-400 mt-1">
                                                        Категория: {{ $item->product->category->name }}
                                                    </p>
                                                @endif

                                                <p class="text-yellow-600 font-bold mt-2">{{ number_format($item->product->price, 0, ',', ' ') }} ₽</p>
                                            </div>

                                            <!-- Управление количеством -->
                                            <div class="flex items-center">
                                                <!-- Уменьшение -->
                                                <form action="{{ route('cart.update', $item) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                                    <button type="submit" class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-l-lg hover:bg-yellow-200 transition-colors duration-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>

                                                <span class="px-4 py-2 bg-yellow-50 text-gray-800 font-medium border-t border-b border-yellow-200">
                                                    {{ $item->quantity }}
                                                </span>

                                                <!-- Увеличение -->
                                                <form action="{{ route('cart.update', $item) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                                    <button type="submit" class="px-4 py-2 bg-yellow-100 text-yellow-800 rounded-r-lg hover:bg-yellow-200 transition-colors duration-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Общая сумма -->
                        <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-200 mt-8">
                            <div class="flex justify-between items-center">
                                <h3 class="text-xl font-bold text-gray-800">Общая сумма:</h3>
                                <p class="text-2xl font-bold text-yellow-600">
                                    {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', ' ') }} ₽
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Правое меню (итоговый заказ) -->
                <div class="z-0 col-span-12 xl:col-span-4 bg-gray-50 w-full max-xl:px-6 max-w-3xl xl:max-w-lg mx-auto lg:pl-8">
                    <h2 class="font-manrope font-bold text-3xl leading-10 text-black pb-8 border-b border-gray-300">Итоговый заказ</h2>
                    <div class="mt-8">
                        <!-- Количество товаров и общая стоимость -->
                        <div class="flex items-center justify-between pb-6">
                            <p class="font-normal text-lg leading-8 text-black">{{ $cartItems->count() }} Товаров</p>
                            <p class="font-medium text-lg leading-8 text-black">{{ $total }} ₽</p>
                        </div>

                        <!-- Промокод -->
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->has('promo'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                {{ $errors->first('promo') }}
                            </div>
                        @endif

                        <form action="{{ route('cart.apply_promo') }}" method="POST">
                            @csrf
                            <div class="flex pb-4 w-full">
                                <input
                                    type="text"
                                    name="code"
                                    placeholder="Введите промокод"
                                    class="block w-full h-11 pr-11 pl-5 py-2.5 text-base font-normal shadow-xs text-gray-900 bg-white border border-gray-300 rounded-lg placeholder-gray-500 focus:outline-gray-400"
                                >
                                <button type="submit" class="ml-2 px-4 bg-yellow-300 hover:bg-orange-600 text-white rounded">Применить</button>
                            </div>
                        </form>

                        <!-- Итоговая сумма -->
                        <div class="flex items-center justify-between py-8">
                            <p class="font-medium text-xl leading-8 text-black">Итого</p>
                            <p class="font-semibold text-xl leading-8 text-yellow-300">{{ $total }} ₽</p>
                        </div>

                        <!-- Кнопки оформления и очистки -->
                        <div class="flex flex-col sm:flex-row gap-4 mt-6">
                            <form action="{{ route('cart.clear') }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="w-full px-6 py-3 bg-white text-gray-800 font-medium rounded-lg border border-yellow-300 hover:bg-yellow-100 transition-colors duration-300 shadow-sm">
                                    Очистить корзину
                                </button>
                            </form>

                            <a href="{{ route('checkout') }}" class="flex-1">
                                <button class="w-full px-6 py-3 bg-yellow-400 text-gray-900 font-medium rounded-lg hover:bg-yellow-500 transition-colors duration-300 shadow-md hover:shadow-lg">
                                    Оформить заказ
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@include('partials.footer')

    <script>
        document.getElementById('orderForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const form = e.target;
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            try {
                submitBtn.innerHTML = 'Обработка...';
                submitBtn.disabled = true;

                // Проверка выбранного способа оплаты
                const paymentMethod = form.querySelector('input[name="payment_method"]:checked');
                if (!paymentMethod) {
                    throw new Error('Выберите способ оплаты!');
                }

                // Сбор данных
                const formData = new FormData(form);

                // Отправка запроса
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                // Обработка ответа
                const result = await response.json();
                if (response.ok) {
                    window.location.href = result.redirect; // Перенаправление
                } else {
                    alert(result.errors ? Object.values(result.errors).join(', ') : result.message);
                }
            } catch (error) {
                alert(error.message);
                console.error('Ошибка:', error);
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });w
    </script>
<script>
    function togglePaymentMenu(event) {
        event.stopPropagation(); // Блокируем всплытие события
        const menu = document.getElementById('paymentMenu');
        menu.classList.toggle('hidden');
    }

    // Закрытие меню при клике вне его области
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('paymentMenu');
        const container = document.getElementById('paymentContainer');
        if (!container.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
<style>
/* Гарантия, что меню будет поверх всего */
.z-50 {
    z-index: 9999;
}

/* Анимация для кнопки */
button[type="submit"] {
    transition: all 0.3s ease;
}

button[type="submit"]:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}
</style>
</x-container>
