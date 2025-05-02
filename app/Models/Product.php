<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        "name",
        "description",
        "price",
        "specs", // Характеристики (можно использовать для программы курса)
        "is_popular",
        'is_active',
        "image",
        "type",
        "brand_id", // Можно использовать для связи с преподавателем
        "created_at",
        "updated_at",
        "level", // Уровень сложности (начальный, средний, продвинутый)
        "rating", // Рейтинг курса
        "materials", // Материалы курса (PDF, видео, аудио)
        'is_active',
        'category_id'
    ];

    protected $casts = [
        'specs' => 'array', // Характеристики курса
        'materials' => 'array', // Материалы курса
    ];

    public function category()
    {
        return $this->belongsTo(Category::class); // Связь с категорией
    }
    // Связь с брендом (можно использовать для преподавателя)
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    // Получение URL изображения курса
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('storage/products/default.png');
    }

    // Метод для проверки, популярный ли курс
    public function getIsPopularAttribute($value)
    {
        return (bool) $value;
    }

}
