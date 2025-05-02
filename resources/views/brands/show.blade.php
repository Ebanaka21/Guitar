@extends('layouts.app')
@include('partials.header')
@section('content')
<x-container>

    <h1 class="w-full text-center mt-28 text-3xl font-bold mb-6">Курсы Преподавателя <br> {{ $brand->name }}</h1>
    @if($brand->logo)
    <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="w-64 h-64 mx-auto object-cover">
@else
    <div class="w-32 h-32 mx-auto flex items-center justify-center bg-gray-100 rounded-lg">
        <span class="text-gray-500">Нет логотипа</span>
    </div>
@endif
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
                <form action="{{ route('cart.store', $product) }}" method="POST" class="flex items-center gap-2 mt-4">
                    @csrf
                    <!-- Поле для ввода количества -->
                    <input type="number" name="quantity" value="1" min="1" class="w-16 text-center border border-yellow-200 rounded-lg py-2 px-3 focus:ring-yellow-300 focus:border-yellow-300">
                    <!-- Кнопка добавления в корзину -->
                    <button type="submit" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors duration-300">
                        Добавить
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
</x-container>
@endsection
