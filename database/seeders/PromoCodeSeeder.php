<?php

use App\Models\PromoCode;
use Illuminate\Database\Seeder;

class PromoCodeSeeder extends Seeder
{
    public function run()
    {
        PromoCode::create([
            'code' => 'DISCOUNT10',
            'type' => 'percent',
            'value' => 10,
            'valid_from' => now(),
            'valid_to' => now()->addMonth(),
            'max_uses' => 100,
        ]);

        PromoCode::create([
            'code' => 'DISCOUNT50',
            'type' => 'fixed',
            'value' => 50,
            'valid_from' => now(),
            'valid_to' => now()->addMonth(),
            'max_uses' => 50,
        ]);
    }
}
