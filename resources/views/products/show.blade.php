@vite(['resources/css/app.css', 'resources/js/app.js'])
@include('partials.header')

<x-container>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Карточка товара -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden dark:bg-gray-800">
            <div class="flex flex-col md:flex-row">
                <!-- Изображение товара -->
                <div class="md:w-1/2 bg-gray-50 dark:bg-gray-700 p-8 flex items-center justify-center">
                    <div class="relative w-full h-96">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-contain transition-transform duration-300 hover:scale-105">
                        @if($product->is_popular)
                            <div class="absolute top-4 right-4 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-bold flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Популярный
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Информация о товаре -->
                <div class="md:w-1/2 p-8">
                    <!-- Категория -->
                    <div class="mb-4">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800">
                            {{ $product->category->name ?? 'Без категории' }}
                        </span>
                    </div>

                    <!-- Название -->
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        {{ $product->name }}
                    </h1>

                    <!-- Рейтинг -->
                    <div class="flex items-center mb-6">
                        <div class="flex mr-2">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 {{ $i < floor($product->rating) ? 'text-amber-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ number_format($product->rating, 1) }} ({{ $product->reviews_count ?? 0 }} отзывов)
                        </span>
                    </div>

                    <!-- Описание -->
                    <div class="prose max-w-none text-gray-600 dark:text-gray-300 mb-8">
                        {{ $product->description }}
                    </div>

                    <!-- Цена -->
                    <div class="mb-8">
                        <div class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ number_format($product->price, 0, ',', ' ') }} ₽
                        </div>
                        @if($product->old_price)
                            <div class="text-sm text-gray-500 dark:text-gray-400 line-through">
                                {{ number_format($product->old_price, 0, ',', ' ') }} ₽
                            </div>
                        @endif
                    </div>

                    <!-- Управление корзиной -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        @auth
                            @php
                                $cartItem = Auth::user()->carts()->where('product_id', $product->id)->first();
                            @endphp

                            <div class="flex items-center">
                                @if($cartItem)
                                    <!-- Форма уменьшения количества -->
                                    <form action="{{ route('cart.decrement', $cartItem) }}" method="POST" class="mr-4">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                                class="w-10 h-10 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors dark:bg-gray-700 dark:hover:bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                    </form>

                                    <span class="text-xl font-medium w-8 text-center">
                                        {{ $cartItem->quantity }}
                                    </span>

                                    <!-- Форма увеличения количества -->
                                    <form action="{{ route('cart.update', $cartItem) }}" method="POST" class="ml-4">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="quantity" value="{{ $cartItem->quantity + 1 }}">
                                        <button type="submit"
                                                class="w-10 h-10 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors dark:bg-gray-700 dark:hover:bg-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </button>
                                    </form>

                                    <!-- Удалить из корзины -->
                                    <form action="{{ route('cart.destroy', $cartItem) }}" method="POST" class="ml-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-4 py-2 bg-yellow-300 hover:bg-red-600 text-white rounded-lg transition-colors flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Удалить
                                        </button>
                                    </form>
                                @else
                                    <!-- Форма добавления в корзину -->
                                    <form action="{{ route('cart.store', $product) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit"
                                                class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Добавить в корзину
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-4">
                                <p class="text-gray-500 dark:text-gray-400 mb-3">
                                    Для добавления в корзину необходимо авторизоваться
                                </p>
                                <a href="{{ route('login') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                                    Войти в аккаунт
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-container>

@include('partials.footer')
