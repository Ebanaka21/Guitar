<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // Указываем, какие поля можно массово заполнять
    protected $fillable = ['name', 'is_active'];

    protected static function booted()
    {
        // Когда категория обновляется
        static::updating(function ($category) {
            // Если поле 'is_active' изменилось
            if ($category->isDirty('is_active')) {
                // Обновляем активность всех брендов и продуктов, связанных с этой категорией
                $category->brands()->update(['is_active' => $category->is_active]);
                $category->products()->update(['is_active' => $category->is_active]);
            }
        });


        // Когда категория удаляется
        static::deleting(function ($category) {
            // Удаляем все бренды и продукты, связанные с этой категорией
            $category->brands()->delete();
            $category->products()->delete();
        });
    }

    // Отношение с брендами (one-to-many)
    public function brands()
    {
        return $this->hasMany(Brand::class);
    }

    // Отношение с продуктами (one-to-many)
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
