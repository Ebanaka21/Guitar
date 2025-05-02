<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;


class BrandSeeder extends Seeder
{
    public function run()
    {
        // Пример данных для преподавателей
        Brand::create([
            'name' => 'Сагаев Антон Максимович',
            'description' => 'Описание преподавателя 1',
            'logo' => 'logo1.png', // Путь к изображению логотипа
            'category_id' => 1, // ID категории, к которой относится преподаватель
            'is_active' => true, // Активен ли преподаватель
        ]);

        Brand::create([
            'name' => 'Зеленский Владимир Грегорьевич',
            'description' => 'Описание преподавателя 2',
            'logo' => 'logo2.png',
            'category_id' => 2,
            'is_active' => true,
        ]);

        Brand::create([
            'name' => 'Полянский Никита Андреевтч',
            'description' => 'Описание преподавателя 3',
            'logo' => 'logo3.png',
            'category_id' => 3,
            'is_active' => false, // Преподаватель не активен
        ]);

        // Добавь другие преподаватели, если нужно
    }
}
