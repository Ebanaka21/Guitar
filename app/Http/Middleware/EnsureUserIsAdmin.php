<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Если это обычный пользователь, показать 404
        if ((int)$user->role === 1) {
            abort(404,'ОШибка'); // <-- вместо редиректа
        }

        // Модераторы и админы проходят дальше
        if (in_array($user->role, [2, 3])) {
            return $next($request);
        }

        // Все остальные — ошибка 403
        abort(404, 'бедная ошибка');
    }
}
