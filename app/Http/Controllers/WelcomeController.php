<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment; // Добавляем импорт
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        // Получаем популярные и обычные товары
        $popularProducts = Product::where('is_popular', true)->get();
        $regularProducts = Product::where('is_popular', false)->get();

        $products = Product::all();
        // Получаем все бренды
        $brands = Brand::with('products')->get();

        // Получаем только одобренные комментарии с информацией о пользователях
        $comments = Comment::with('user')
            ->where('status', 'approved')
            ->latest()
            ->get();

        $cartItems = Auth::check() ? Auth::user()->carts()->with('product')->get()->keyBy('product_id') : collect();

        // Передаем все переменные в шаблон
        return view('welcome', compact(
            'popularProducts',
            'regularProducts',
            'products',
            'brands',
            'comments', // Добавляем комментарии
            'cartItems'

        ));
    }

}
