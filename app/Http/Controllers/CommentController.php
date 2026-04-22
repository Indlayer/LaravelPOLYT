<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|min:3|max:1000',
        ]);

        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        Comment::create([
            'content' => $request->input('content'),
            'user_id' => $user->id,
            'post_id' => $post->id,
            'is_approved' => false,
        ]);

        return back()->with('success', 'Комментарий отправлен на модерацию.');
    }

    public function approve(Comment $comment)
    {
        $user = Auth::user();

        if (!$user || !$user->role || $user->role->name !== 'admin') {
            abort(403);
        }

        $comment->update([
            'is_approved' => true,
        ]);

        return back()->with('success', 'Комментарий одобрен.');
    }

    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        if (!$user || !$user->role || $user->role->name !== 'admin') {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Комментарий удален.');
    }
}