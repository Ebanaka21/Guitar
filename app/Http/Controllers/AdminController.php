<?php

namespace App\Http\Controllers;

use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class AdminController extends Controller
{
    public function __construct()
    {
        // Применяем middleware ко всем методам контроллера
        $this->middleware(EnsureUserIsAdmin::class);
    }

    public function index()
    {
        return view('admin-dashboard'); // Панель администратора
    }
}
