<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        Comment::create([
            'amv_id' => 1,
            'user_id' => 1,
            'parent_id' => 1,
            'body' => $request->body
        ]);
        return response([
            'ee' => true
        ]);
    }

    public function get($post_id)
    {
        $get = Comment::with('user')->with('replies')->where('parent_id', null)->get();
        return response([
            'comments' => $get
        ]);
    }
}
