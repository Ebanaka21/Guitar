<?php

// app/Models/Booking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'product_id',
        'brand_id',
        'date',
        'time',
        'is_booked',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class); // Преподаватель
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class); // Курс
    }
}

