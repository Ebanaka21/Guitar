<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name' => 'Администратор',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 3,
        ]);

        User::create([
            'name' => 'Модератор',
            'email' => 'moderator@example.com',
            'password' => Hash::make('password'),
            'role' => 2,
        ]);

        User::create([
            'name' => 'Пользователь',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 1,
        ]);
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('123'),
            'role' => 3,
        ]);
    }
}
