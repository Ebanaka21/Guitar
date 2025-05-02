<?php

// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    // Оформление заказа
    public function checkout(Request $request)
    {
        // Получаем текущего пользователя
        $user = Auth::user();

        // Получаем товары из корзины
        $cartItems = Cart::where('user_id', $user->id)->get();

        // Рассчитываем общую стоимость
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Применяем промокод
        $promo = session('promo');
        $discount = 0;

        if ($promo) {
            if ($promo['type'] === 'percent') {
                $discount = $subtotal * $promo['value'] / 100;
            } else {
                $discount = $promo['value'];
            }
        }

        $totalAmount = $subtotal - $discount;

        // Формируем данные о товарах
        $items = $cartItems->map(function ($item) {
            return [
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ];
        })->toArray();

        // Создаем заказ
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(uniqid()), // Генерация уникального номера заказа
            'total_amount' => $totalAmount,
            'items' => $items,
            'status' => 'В обработке',
            'payment_method' => $request->payment_method, // Способ оплаты из формы
        ]);

        // Очищаем корзину после оформления заказа
        Cart::where('user_id', $user->id)->delete();

        // Перенаправляем в Dashboard
        return redirect()->route('dashboard')->with('success', 'Заказ успешно оформлен!');
    }
    // app/Http/Controllers/OrderController.php

public function userOrders()
{
    $user = Auth::user();

    // Получаем все заказы пользователя
    $orders = Order::with(['items.product'])
        ->where('user_id', $user->id)
        ->latest()
        ->get();

    return view('dashboard', compact('orders'));
}

}
