<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Просмотр корзины
    public function index()
    {
        if (Auth::check()) {
            $cartItems = Auth::user()->carts()->with('product')->get();
        } else {
            $cartItems = collect(); // Пустая коллекция, если пользователь не авторизован
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $discount = 0;
        $promo = session('promo');

        if ($promo) {
            $discount = $promo['type'] === 'percent'
                ? $subtotal * $promo['value'] / 100
                : $promo['value'];
        }

        $total = $subtotal - $discount;

        return view('cart.index', compact('cartItems', 'subtotal', 'discount', 'total'));
    }

    // Добавление товара в корзину
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $user = Auth::user();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $existingCartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->increment('quantity', $quantity);
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Товар добавлен в корзину!');
    }

    // Оформление заказa
    public function store(Request $request)
{
    // Валидация
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'nullable|integer|min:1',
    ]);

    $user = Auth::user();
    $productId = $request->input('product_id');
    $quantity = $request->input('quantity', 1);

    // Проверяем, есть ли товар в корзине
    $existingCartItem = Cart::where('user_id', $user->id)
        ->where('product_id', $productId)
        ->first();

    if ($existingCartItem) {
        // Если товар уже есть — увеличиваем количество
        $existingCartItem->increment('quantity', $quantity);
    } else {
        // Иначе создаём новый товар в корзине
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    // Редиректим на страницу корзины с успешным сообщением
    return redirect()->route('cart.index')->with('success', 'Товар добавлен в корзину!');
}


    // Очистка корзины
    public function clear()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Пожалуйста, войдите в систему, чтобы очистить корзину.'
            ], 401);
        }

        try {
            Auth::user()->carts()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Корзина успешно очищена!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Произошла ошибка при очистке корзины.'
            ], 500);
        }
    }

    // Обновление количества товара
    public function update(Request $request, Cart $cart)
    {
        if (!Auth::check() || $cart->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Нет доступа.');
        }

        $quantity = $request->input('quantity');

        if ($quantity < 1) {
            $cart->delete();
        } else {
            $cart->update(['quantity' => $quantity]);
        }

        return redirect()->route('cart.index')->with('success', 'Количество товара обновлено!');
    }

    // Удаление товара из корзины
    public function destroy(Cart $cart)
    {
        if (!Auth::check() || $cart->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Нет доступа.');
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Товар удален из корзины!');
    }

    // Уменьшение количества на 1
    public function decrement(Cart $cart)
    {
        if (!Auth::check() || $cart->user_id !== Auth::id()) {
            return redirect()->route('cart.index')->with('error', 'Нет доступа.');
        }

        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        } else {
            $cart->delete();
        }

        return redirect()->back()->with('success', 'Количество товара уменьшено.');
    }

    // Применение промокода
    public function applyPromo(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $promo = PromoCode::where('code', $request->input('code'))->first();

        if (!$promo) {
            return back()->withErrors(['promo' => 'Неверный промокод.']);
        }

        if ($promo->expires_at && $promo->expires_at < now()) {
            return back()->withErrors(['promo' => 'Промокод истёк.']);
        }

        session(['promo' => [
            'code' => $promo->code,
            'value' => $promo->value,
            'type' => $promo->type,
        ]]);

        return back()->with('success', 'Промокод успешно применён!');
    }

    // Вспомогательный метод: расчёт общей суммы
    private function calculateTotal($cartItems)
    {
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $discount = 0;
        $promo = session('promo');

        if ($promo) {
            $discount = $promo['type'] === 'percent'
                ? $subtotal * $promo['value'] / 100
                : $promo['value'];
        }

        return $subtotal - $discount;
    }
}
