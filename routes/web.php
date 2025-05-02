<?php

use App\Filament\Resources\ContactMessageResource;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\UserController;
use App\Livewire\ContactForm;

// Главная страница
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Продукты
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// Бренды
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/brands/{brand}', [BrandController::class, 'show'])->name('brands.show');

// Комментарии пользователей
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

Route::get('/contact', ContactForm::class);
Route::view('/contact', 'contact');
// Пользовательские маршруты
Route::middleware(['auth', 'verified'])->group(function () {
    // Личный кабинет
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/orders', [OrderController::class, 'index'])->name('dashboard.orders');

    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Корзина
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/{cart}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/apply-promo', [CartController::class, 'applyPromo'])->name('cart.apply_promo');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');


    // Заказы
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/dashboard/orders', [OrderController::class, 'userOrders'])->name('dashboard.orders');
});
Route::get('/booking/{product}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');
// Админ-панель



Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/dashboard/my-orders', [OrderController::class, 'index'])->name('dashboard.my_orders');

    Route::get('/dashboard/orders', [DashboardController::class, 'showOrders'])->name('dashboard.orders');
    Route::get('/dashboard/orders', [UserController::class, 'orders'])->name('dashboard.orders');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Группа маршрутов для администраторов
Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('contact-messages', ContactMessageResource::class);
    // Админская панель
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.index');
    // Ресурсы админки Filament (например, для сообщений)
});

// Аутентификация
require __DIR__.'/auth.php';
