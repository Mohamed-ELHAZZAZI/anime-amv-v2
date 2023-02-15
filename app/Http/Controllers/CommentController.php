<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(Request $request)
    {

        $request->validate([
            'text' => 'required|string',
        ]);

        Comment::create([
            'amv_id' => $request->post_id,
            'user_id' => auth('sanctum')->user()->id,
            'parent_id' => $request->parent_id ? $request->parent_id : null,
            'body' => $request->text
        ]);
        return response([
            'ee' => true
        ]);
    }

    public function get($post_id)
    {
        $get = Comment::with('user', 'replies.user')->with('replies')->where('amv_id', $post_id)->where('parent_id', null)->get();
        return response([
            'comments' => $get
        ]);
    }
}
