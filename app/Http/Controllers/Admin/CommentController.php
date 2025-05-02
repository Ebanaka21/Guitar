<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return view('admin.comments.index', [
            'comments' => Comment::with('user')
                ->pending()
                ->latest()
                ->paginate(10)
        ]);
    }

    public function approve(Comment $comment)
    {
        $comment->update(['status' => Comment::STATUS_APPROVED]);
        return back()->with('success', 'Комментарий одобрен');
    }

    public function reject(Comment $comment)
    {
        $comment->update(['status' => Comment::STATUS_REJECTED]);
        return back()->with('success', 'Комментарий отклонен');
    }
}
