<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['content' => 'required|string|max:1000']);

        // Автоматически одобряем комментарии админов
        $status = auth()->user()->is_admin ? 'approved' : 'pending';

        auth()->user()->comments()->create([
            'content' => $request->content,
            'status' => $status
        ]);

        $message = $status === 'approved'
            ? 'Ваш отзыв опубликован!'
            : 'Комментарий отправлен на модерацию!';

        return back()->with('success', $message);
    }
}
