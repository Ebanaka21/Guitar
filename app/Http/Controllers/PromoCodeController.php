<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function applyPromo(Request $request)
{
    // Валидация входящего запроса
    $request->validate([
        'code' => 'required|string',
    ]);

    // Поиск промокода в базе данных
    $promo = PromoCode::where('code', $request->code)
        ->where('valid_from', '<=', now())
        ->where(function ($query) {
            $query->where('valid_to', '>=', now())
                  ->orWhereNull('valid_to');
        })
        ->first();

    // Если промокод не найден или истёк срок действия
    if (!$promo) {
        return back()->withErrors(['promo' => 'Неверный или истёкший промокод.']);
    }

    // Если промокод исчерпал максимальное количество использований
    if ($promo->max_uses && $promo->used_count >= $promo->max_uses) {
        return back()->withErrors(['promo' => 'Промокод больше не доступен для использования.']);
    }

    // Сохраняем промокод в сессии
    session()->put('promo', [
        'id' => $promo->id,
        'code' => $promo->code,
        'type' => $promo->type,
        'value' => $promo->value,
    ]);

    // Увеличиваем счетчик использований
    $promo->increment('used_count');

    // Возвращаемся на страницу корзины с сообщением об успехе
    return back()->with('success', 'Промокод успешно применён!');
}

}
