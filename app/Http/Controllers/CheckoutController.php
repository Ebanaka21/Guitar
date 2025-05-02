<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\CartItem;

class CheckoutController extends Controller
{
    public function index()
    {
        // Перенаправляем на дашборд — можно здесь показать страницу оформления, если нужно
        return redirect()->route('dashboard');
    }

    public function store(Request $request)
    {
        // 1. Получаем данные из сессии или корзины
        $cartItems = session('cart', []);  // Получаем товары из сессии (или из базы данных)

        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        // 2. Создаем заказ
        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total' => $this->calculateTotal($cartItems),
        ]);

        // 3. Сохраняем товары в заказе
        foreach ($cartItems as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'price' => $cartItem['price'],
            ]);
        }

        // 4. Очищаем корзину
        session()->forget('cart');

        // 5. Редиректим в личный кабинет с новым заказом
        return redirect()->route('dashboard.orders')->with('success', 'Заказ оформлен успешно!');
    }
}
