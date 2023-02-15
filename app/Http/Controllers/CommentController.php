<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function comment(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'text' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response([
                'error' => true,
                'data' => $validator->errors()
            ]);
        }
        $commnet  = Comment::create([
            'amv_id' => $request->post_id,
            'user_id' => auth('sanctum')->user()->id,
            'parent_id' => $request->parent_id ? $request->parent_id : null,
            'body' => $request->text
        ]);
        return response([
            'error' => false,
            'comment' => $commnet,
            'user' => auth('sanctum')->user()
        ]);
    }

    public function get($post_id)
    {
        $get = Comment::with('user', 'replies.user')->with('replies')->where('amv_id', $post_id)->where('parent_id', null)->orderBy('created_at', 'DESC')->get();
        return response([
            'comments' => $get
        ]);
    }
}
