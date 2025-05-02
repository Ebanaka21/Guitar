<?php

// app/Models/Order.php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'items',
        'status',
        'payment_method',
    ];

    protected $casts = [
        'items' => 'array', // Автоматически преобразуем JSON в массив
    ];

    // Отношение к пользователю
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
