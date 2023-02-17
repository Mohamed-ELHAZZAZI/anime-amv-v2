<?php

namespace App\Http\Controllers;

use App\Models\Amv;
use App\Models\AmvReaction;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\PostTagsRelations;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Rule;

class AmvsController extends Controller
{
    public function post(Request $request)
    {

        $request->validate([
            'text' => 'string|nullable',
            'tags' => 'array|nullable',
            'tags.*' => 'string',
            'file' => 'file|mimetypes:video/mp4,video/ogg,video/webm|max:102400'
        ], [
            'file.file' => 'Choosing the appropriate file is crucial.',
            'file.mimetypes' => 'The file format is not recognized or supported by the system.',
            'file.max' => 'The maximum allowable file size is 100 megabytes.',
        ]);

        $fileName = uniqid('amv_video_') . '.' . File::extension($request->file->getClientOriginalName());
        $filePath = 'uploads/amvs/' . $fileName;
        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->file));
        $url = Storage::disk('public')->url($filePath);

        if ($isFileUploaded) {

            $amv = new Amv();
            $amv->text = $request->text;
            $amv->user_id = $request->user()->id;
            $amv->video = $filePath;
            $amv->save();
            if ($request->has('tags')) {
                foreach ($request->tags as $key => $tag) {
                    $tag_info = Tag::firstOrCreate(['name' => $tag]);
                    $tag_amv = new PostTagsRelations();
                    $tag_amv->tag_id = $tag_info->id;
                    $tag_amv->amv_id = $amv->id;
                    $tag_amv->save();
                }
            }
        }

        return response([
            'status' => 200,
            'post' => $amv
        ]);
    }

    public function get(Request $request)
    {
        $userId = auth('sanctum')->user()?->id;
        $ownerId = $request->owner_id;
        $posts = Amv::with('user')->leftJoinSub(function ($query) use ($userId) {
            $query->select('amv_id', 'type')
                ->from('amv_reactions')
                ->where('user_id', $userId);
        }, 'user_reaction', function ($join) {
            $join->on('amvs.id', '=', 'user_reaction.amv_id');
        })
            ->select('amvs.*', 'user_reaction.type as user_reaction')
            ->when($ownerId, function ($query, $ownerId) use ($userId) {
                $query->where(function ($query) use ($ownerId, $userId) {
                    $query->where('user_id', $ownerId)
                        ->where('user_id', $userId);
                });
            })
            ->offset($request->start ? $request->start : 0)->limit($request->end ? $request->end : 0)->orderBy('created_at', 'DESC')
            ->get();
        return response([
            'posts' => $posts
        ]);
    }

    public function delete(Request $request)
    {
        $post = Amv::find($request->id);

        if ($post->user_id === $request->user()->id) {
            if (File::exists(public_path('storage/' . $post->video))) {
                File::delete(public_path('storage/' . $post->video));
            }
            $post->delete();
            return response([
                'error' => false,
            ]);
        }
        return response([
            'error' => true
        ]);
    }

    public function getSingleAmv(Request $request, $id)
    {
        $post = Amv::where('id', $id)->where('user_id', $request->user()->id)->first();
        return response([
            'post' => $post
        ]);
    }


    public function modify(Request $request)
    {
        $isFileUploaded = true;
        $post = Amv::where('id', $request->post_id)->where('user_id', $request->user()->id)->first();
        if (!$post) {
            return response([
                'status' => 400
            ]);
        }
        $filePath = $post->video;
        $request->validate([
            'text' => 'nullable',
            'tags' => 'array|nullable',
            'tags.*' => 'string',

        ], [
            'tags.max' => 'The maximum number of tags allowed is 5.',
            'tags.*.distinct' => 'The tags can not be duplicated'
        ]);
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'file|mimetypes:video/mp4,video/ogg,video/webm|max:102400'
            ], [
                'file.file' => 'Choosing the appropriate file is crucial.',
                'file.mimetypes' => 'The file format is not recognized or supported by the system.',
                'file.max' => 'The maximum allowable file size is 100 megabytes.',
            ]);
            if (File::exists(public_path('storage/' . $filePath))) {
                File::delete(public_path('storage/' . $filePath));
            }
            $fileName = uniqid('amv_video_') . '.' . File::extension($request->file->getClientOriginalName());
            $filePath = 'uploads/amvs/' . $fileName;
            $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->file));
            $url = Storage::disk('public')->url($filePath);
        }

        if ($isFileUploaded) {
            $post->text = $request->text;
            $post->video = $filePath;
            $post->updated = 1;
            $post->save();
            $post_tags = PostTagsRelations::where('amv_id', $post->id)->get(['id']);
            if (!empty($post_tags)) {
                PostTagsRelations::destroy($post_tags->toArray());
            }
            if ($request->has('tags')) {
                foreach ($request->tags as $key => $tag) {
                    $tag_info = Tag::firstOrCreate(['name' => $tag]);
                    $tag_amv = new PostTagsRelations();
                    $tag_amv->tag_id = $tag_info->id;
                    $tag_amv->amv_id = $post->id;
                    $tag_amv->save();
                }
            }
            return response([
                'status' => 200,
                'post' => $post
            ]);
        } else {
            return response([
                'status' => 400
            ]);
        }
    }

    public function reactToAmv(Request $request)
    {
        $post = Amv::find($request->post_id);
        if ($post) {
            if ($request->action == "add") {
                $react = new AmvReaction();
                $react->user_id = auth('sanctum')->user()->id;
                $react->amv_id =  $request->post_id;
                $react->type = $request->type;
                $react->save();
                return response([
                    'data' => $react
                ]);
            } elseif ($request->action == "remove") {
                $react = AmvReaction::where('user_id', auth('sanctum')->user()->id)->where('amv_id', $request->post_id)->first();
                $react->delete();
                return response([
                    'deleted' => true
                ]);
            } elseif ($request->action == "change") {
                $react = AmvReaction::where('user_id', auth('sanctum')->user()->id)->where('amv_id', $request->post_id)->first();
                $react->type = $request->type;
                $react->save();
                return response([
                    'updated' => true
                ]);
            }
        }
        return response([
            'data' => $post
        ]);
    }
}
