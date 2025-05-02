<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = auth()->user()->orders; // Или

        if (!$user) {
            abort(403, 'Нет доступа');
        }

        // Предполагается, что связь Order → Product и → Brand уже настроена
        $activePurchases = Order::with(['product', 'brand'])
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->latest()
            ->get();

        $completedPurchases = Order::with(['product', 'brand'])
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->latest()
            ->get();

        return view('dashboard', compact('activePurchases', 'completedPurchases'));
    }
    // DashboardController.php

}
