<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'date',
        'time',
        'is_booked',
    ];

    protected $casts = [
        'date' => 'date',
        'is_booked' => 'boolean',
    ];

    // Отношение к пользователю (записавшийся)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Отношение к курсу
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
