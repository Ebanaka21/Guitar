<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    /**
     * Поля, которые можно массово назначать.
     *
     * @var array
     */
    protected $fillable = [
        'code',         // Код промокода
        'type',         // Тип промокода (percent, fixed)
        'value',        // Значение (процент или фиксированная сумма)
        'valid_from',   // Дата начала действия
        'valid_to',     // Дата окончания действия
        'max_uses',     // Максимальное количество использований
        'used_count',   // Количество использований
        'is_active',
    ];

    /**
     * Поля, которые должны быть приведены к определенным типам.
     *
     * @var array
     */
    protected $casts = [
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];
    public function getIsActiveAttribute()
{
    $currentDate = now();
    return $this->valid_from <= $currentDate && $this->valid_to >= $currentDate;
}

}
