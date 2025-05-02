@extends('layouts.app')
@include('partials.header')

@section('head')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Фа-Диез - инновационная музыкальная школа нового поколения">
        <title>Фа-Диез | Современная музыкальная школа</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('storage/img/favicon.ico') }}" type="image/x-icon">
        @livewireStyles
       @livewireScripts
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Playfair+Display:wght@700&display=swap');

            :root {
                --primary: #6C63FF;
                --secondary: #FF6584;
                --dark: #2D3748;
                --light: #F7FAFC;
                --accent: #00C9A7;
            }

            body {
                font-family: 'Montserrat', sans-serif;
            }

            h1, h2, h3 {
                font-family: 'Playfair Display', serif;
            }

            .hero-gradient {
                background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            }

            .card-hover {
                transition: all 0.3s ease;
                transform-style: preserve-3d;
            }

            .card-hover:hover {
                transform: translateY(-8px) rotateX(5deg);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .teacher-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, var(--primary), var(--secondary));
            }

            .pulse-animation {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
        </style>
    </head>
@endsection

@section('content')
    <x-container class="px-0">
        <!-- Hero Section -->
        <section class="hero-gradient text-white py-24 relative overflow-hidden">
            <div class="max-w-7xl mx-auto relative z-10 text-center">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight text-black">
                    Раскрой свой <span class="text-yellow-300">музыкальный</span> потенциал
                </h1>
                <p class="text-xl text-black md:text-2xl mb-10 max-w-3xl mx-auto">
                    Современное обучение музыке для всех возрастов с индивидуальным подходом
                </p>
                <div class="space-x-4">
                    <a href="{{ route('products.index') }}" class="inline-block bg-white text-gray-900 px-8 py-4 rounded-full text-lg font-bold hover:bg-opacity-90 transition-all transform hover:scale-105 shadow-lg">
                        Начать обучение
                    </a>
                    <a href="#courses" class="inline-block border-2 border-white text-black px-8 py-4 rounded-full text-lg font-bold hover:bg-white hover:bg-opacity-10 transition-all">
                        Наши курсы
                    </a>
                </div>
            </div>
            <div class="relative h-32">
                <!-- Левая наклонная линия -->
                <div class="absolute bottom-0 left-0 right-0 h-32 bg-yellow-300 transform -skew-y-12 -skew-x-12 origin-bottom"></div>

                <!-- Правая наклонная линия -->
                <div class="absolute bottom-0 left-0 right-0 h-32 bg-yellow-300 transform skew-y-12 origin-bottom "></div>
              </div>

        </section>

        <!-- Features Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <span class="text-sm font-semibold tracking-wider text-yellow-200">Почему мы</span>
                    <h2 class="text-4xl font-bold mt-2 mb-6">Фа-Диез — это новый стандарт</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="bg-gray-50 p-8 rounded-xl card-hover">
                        <div class="w-16 h-16 bg-primary bg-opacity-10 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Современные методики</h3>
                        <p class="text-gray-600">Используем инновационные подходы к обучению музыке, сочетая классику и современные техники</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-xl card-hover">
                        <div class="w-16 h-16 bg-secondary bg-opacity-10 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Гибкий график</h3>
                        <p class="text-gray-600">Занимайтесь когда удобно - утром, днем или вечером, в студии или онлайн</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-xl card-hover">
                        <div class="w-16 h-16 bg-accent bg-opacity-10 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Гарантия результата</h3>
                        <p class="text-gray-600">98% наших студентов достигают поставленных целей в оговоренные сроки</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Courses Section -->
        <section id="courses" class="py-20 bg-gray-300">
            <div class="max-w-7xl mx-auto px-6">
                <div class="text-center mb-16">
                    <span class="text-sm font-semibold tracking-wider text-yellow-300">Обучение</span>
                    <h2 class="text-4xl font-bold mt-2 mb-6">Наши направления</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Выберите инструмент или вокальное направление, которое вам по душе</p>
                </div>

                {{-- В представлении welcome.blade.php --}}
{{-- В представлении welcome.blade.php --}}
        <div class="popular-products mb-16">
            <div class="flex justify-between items-center mb-8">
                <a href="{{ route('products.index') }}" class="text-yellow-500 hover:text-yellow-600 font-medium flex items-center">
                    Все курсы
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
        </div>

<div class="items-start grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($products as $product)
        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-yellow-100 mb-14">
            <a href="{{ route('products.show', $product) }}">
                <!-- Исправленный путь к изображению -->
                <div class="relative">
                    <img class="p-8 rounded-t-lg w-full h-48 object-contain bg-yellow-50" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @if($product->is_popular)
                        <span class="absolute top-4 right-4 bg-yellow-300 text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow-md flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            Популярно
                        </span>
                    @endif
                </div>
            </a>

            <!-- Блок преподавателя -->
            @if($product->brand)
            <div class="flex items-center mt-4 p-3 bg-yellow-50 rounded-lg border border-yellow-100">
                <div class="flex-shrink-0 mr-3">
                    @if($product->brand->image)
                        <img src="{{ asset('storage/' . $product->brand->image) }}" alt="{{ $product->brand->name }}" class="w-10 h-10 rounded-full object-cover border-2 border-yellow-300">
                    @else
                        <div class="w-10 h-10 rounded-full bg-yellow-200 flex items-center justify-center text-yellow-700 font-bold border-2 border-yellow-300">
                            {{ substr($product->brand->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <div>
                    <p class="text-sm text-gray-500">Преподаватель</p>
                    <p class="font-medium text-gray-800">{{ $product->brand->name }}</p>
                </div>
            </div>
            @endif

            <h2 class="text-xl font-bold mt-4">{{ $product->name }}</h2>
            <p class="text-gray-600 my-2">{{ Str::limit($product->description, 80) }}</p>

            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('products.show', $product) }}" class="text-yellow-600 hover:text-yellow-700 font-medium inline-flex items-center">
                    Подробнее
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
                <span class="text-2xl font-bold text-yellow-600">{{ number_format($product->price, 0, ',', ' ') }} ₽</span>
            </div>

            <!-- Форма для добавления в корзину -->
            <form action="{{ route('cart.store') }}" method="POST" class="flex items-center gap-2 mt-4">
                @csrf
                <!-- Поле для ввода количества -->
                <input type="number" name="quantity" value="1" min="1" class="w-16 text-center border border-yellow-200 rounded-lg py-2 px-3 focus:ring-yellow-300 focus:border-yellow-300">
                <!-- Скрытое поле для передачи product_id -->
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <!-- Кнопка добавления в корзину -->
                <button type="submit" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors duration-300">
                    Добавить в корзину
                </button>
            </form>



            <!-- Отображение количества добавленных товаров -->
            @if(isset($cartItems) && $cartItems->has($product->id))
                <div class="mt-3 text-green-600">
                    В корзине: {{ $cartItems[$product->id]->quantity }} шт.
                </div>
            @endif

        </div>
    @endforeach
</div>
                <div class="text-center mt-12">
                    <a href="{{ route('products.index') }}" class="inline-block bg-yellow-300 text-white px-8 py-3 rounded-full font-bold hover:bg-primary-dark transition-all transform hover:scale-105 shadow-md">
                        Все направления →
                    </a>
                </div>
            </div>
        </section>

        <!-- Teachers Section -->
                    <section class="py-20 bg-white">
                        <div class="max-w-7xl mx-auto px-6">
                            <div class="text-center mb-16">
                                <span class="text-sm font-semibold tracking-wider text-yellow-300">Команда</span>
                                <h2 class="text-4xl font-bold mt-2 mb-6">Наши преподаватели</h2>
                                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Профессиональные музыканты с педагогическим образованием</p>
                            </div>
                            <div class="popular-products mb-16">
                                <div class="flex justify-between items-center mb-8">
                                    <a href="{{ route('brands.index') }}" class="text-yellow-500 hover:text-yellow-600 font-medium flex items-center">
                                        Все преподаватели
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                </div>

                                <div class="items-start grid grid-cols-1 md:grid-cols-3 gap-6">
                                    @foreach($brands as $brand)
                                        <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-yellow-100 mb-14">
                                            <a href="{{ route('products.show', $brand) }}">
                                                <!-- Исправленный путь к изображению -->
                                                <div class="relative">
                                                    <img class="p-8 rounded-t-lg w-full h-48 object-contain bg-yellow-50" src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->logo }}">
                                                    @if($brand->is_popular)
                                                        <span class="absolute top-4 right-4 bg-yellow-300 text-gray-900 text-xs font-bold px-3 py-1 rounded-full shadow-md flex items-center">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                            </svg>
                                                            Популярно
                                                        </span>
                                                    @endif
                                                </div>
                                            </a>

                                            <!-- Блок преподавателя -->
                                            <h2 class="text-xl font-bold mt-4">{{ $brand->name }}</h2>
                                            <p class="text-gray-600 my-2">{{ Str::limit($brand->description, 80) }}</p>

                                            <div class="flex items-center justify-between mt-4">
                                                <a href="{{ route('brands.show', $brand) }}" class="text-yellow-600 hover:text-yellow-700 font-medium inline-flex items-center">
                                                    Подробнее
                                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                                    </svg>
                                                </a>
                                                <span class="text-2xl font-bold text-yellow-600">{{ number_format($product->price, 0, ',', ' ') }} ₽</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-primary to-accent text-white">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Готовы начать свое музыкальное путешествие?</h2>
                <p class="text-xl mb-10 max-w-2xl mx-auto">Запишитесь на бесплатный пробный урок и почувствуйте наш подход</p>
                <div class="space-x-4">
                    <a href="#" class="inline-block bg-white text-yellow-300 px-8 py-4 rounded-full text-lg font-bold hover:bg-opacity-90 transition-all transform hover:scale-105 shadow-lg pulse-animation">
                        Записаться на пробный урок
                    </a>
                </div>
            </div>
        </section>

        <!-- Contact Form -->
            <livewire:contact-form />
        @livewireScripts
    </x-container>
@endsection
