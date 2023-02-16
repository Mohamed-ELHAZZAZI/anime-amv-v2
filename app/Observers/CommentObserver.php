<?php

namespace App\Observers;

use App\Models\Amv;
use App\Models\Comment;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $nbr = count(Comment::where('amv_id', $comment->amv_id)->get());
        $post = Amv::find($comment->amv_id);
        $post->comments = $nbr;
        $post->save();
    }

    /**
     * Handle the Comment "updated" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function updated(Comment $comment)
    {
    }

    /**
     * Handle the Comment "deleted" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function deleted(Comment $comment)
    {
        $nbr = count(Comment::where('amv_id', $comment->amv_id)->get());
        $post = Amv::find($comment->amv_id);
        $post->comments = $nbr;
        $post->save();
    }

    /**
     * Handle the Comment "restored" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function restored(Comment $comment)
    {
        //
    }

    /**
     * Handle the Comment "force deleted" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function forceDeleted(Comment $comment)
    {
        //
    }
}
