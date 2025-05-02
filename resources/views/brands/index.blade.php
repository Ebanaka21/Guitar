@extends('layouts.app')

@include('partials.header')

@section('content')
    <x-container>
        <h2 class="text-3xl font-bold mb-10 mt-10 text-center w-full">Все Преподаватели</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($brands as $brand)
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="w-32 h-32 mx-auto object-cover rounded-sm">
                    <h2 class="text-xl font-bold mt-4 text-center">{{ $brand->name }}</h2>
                    <p class="text-gray-600 mt-2 text-center">{{ $brand->description }}</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('brands.show', $brand) }}" class="inline-block text-yellow-500 hover:text-yellow-600 font-medium">
                            Смотреть Курсы
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </x-container>
@endsection
