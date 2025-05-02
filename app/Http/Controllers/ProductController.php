<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Показать список продуктов.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])
            ->where('is_active', true)
            ->whereHas('category', fn ($q) => $q->where('is_active', true))
            ->whereHas('brand', fn ($q) => $q->where('is_active', true))
            ->orderByDesc('is_popular')
            ->paginate(12);

        $popularProducts = Product::with(['category', 'brand'])
            ->where('is_active', true)
            ->where('is_popular', true)
            ->whereHas('category', fn ($q) => $q->where('is_active', true))
            ->whereHas('brand', fn ($q) => $q->where('is_active', true))
            ->take(6)
            ->get();

        // Передаём ОБЕ переменные в представление
        return view('products.index', compact('products', 'popularProducts'));
    }

    /**
     * Показать конкретный продукт.
     */
    public function show(Product $product)
    {
        if (
            !$product->is_active ||
            !$product->category?->is_active ||
            !$product->brand?->is_active
        ) {
            abort(404);
        }

        return view('products.show', compact('product'));
    }
}
