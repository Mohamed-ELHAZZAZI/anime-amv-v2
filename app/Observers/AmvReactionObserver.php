<?php

namespace App\Observers;

use App\Models\Amv;
use App\Models\AmvReaction;

class AmvReactionObserver
{
    /**
     * Handle the AmvReaction "created" event.
     *
     * @param  \App\Models\AmvReaction  $amvReaction
     * @return void
     */
    public function created(AmvReaction $amvReaction)
    {
        $post = Amv::find($amvReaction->amv_id);
        if ($amvReaction->type == 'like') {
            $post->likes++;
        } else {
            $post->dislikes++;
        }
        $post->save();
    }

    /**
     * Handle the AmvReaction "updated" event.
     *
     * @param  \App\Models\AmvReaction  $amvReaction
     * @return void
     */
    public function updated(AmvReaction $amvReaction)
    {
        $post = Amv::find($amvReaction->amv_id);
        if ($amvReaction->getDirty()['type'] == 'like') {
            $post->likes++;
            $post->dislikes--;
        } else {
            $post->dislikes++;
            $post->likes--;
        }

        $post->save();
    }

    /**
     * Handle the AmvReaction "deleted" event.
     *
     * @param  \App\Models\AmvReaction  $amvReaction
     * @return void
     */
    public function deleted(AmvReaction $amvReaction)
    {
        $post = Amv::find($amvReaction->amv_id);
        if ($amvReaction->type == 'like') {
            $post->likes--;
        } else {
            $post->dislikes--;
        }
        $post->save();
    }

    /**
     * Handle the AmvReaction "restored" event.
     *
     * @param  \App\Models\AmvReaction  $amvReaction
     * @return void
     */
    public function restored(AmvReaction $amvReaction)
    {
        //
    }

    /**
     * Handle the AmvReaction "force deleted" event.
     *
     * @param  \App\Models\AmvReaction  $amvReaction
     * @return void
     */
    public function forceDeleted(AmvReaction $amvReaction)
    {
        //
    }
}
