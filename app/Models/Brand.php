<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'category_id',
        'is_active',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class); // Связь с категорией
    }

    // Связь с продуктами
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Метод для получения URL логотипа
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/brands/' . $this->logo);
        }
        return asset('storage/brands/default.png'); // Дефолтное изображение
    }
}
