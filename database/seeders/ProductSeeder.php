<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    public function run()
    {
        // Пример данных для курсов
        Product::create([
            'name' => 'Курс по игре на Балалайке',
            'description' => 'Описание курса 1',
            'price' => 1000,
            'is_popular' => true,
            'is_active' => true,
            'image' => 'product1.jpg', // Путь к изображению курса
            'brand_id' => 1, // ID преподавателя (связан с таблицей Brand)
            'category_id' => 1, // ID категории курса
        ]);

        Product::create([
            'name' => 'Курс по игре на Акулеле',
            'description' => 'Описание курса 2',
            'price' => 1500,
            'is_popular' => false,
            'is_active' => true,
            'image' => 'product2.jpg',
            'brand_id' => 2,
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Курс по игре на Домбре',
            'description' => 'Описание курса 3',
            'price' => 2000,
            'is_popular' => true,
            'is_active' => false, // Курс не активен
            'image' => 'product3.jpg',
            'brand_id' => 3,
            'category_id' => 3,
        ]);

        // Добавь другие курсы, если нужно
    }
}
