<?php

namespace App\Http\Controllers;

use App\Models\Amv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AmvsController extends Controller
{
    public function post(Request $request)
    {
        $request->validate([
            'text' => 'string|nullable',
            'tags' => 'array|max:5|nullable',
            'tags.*' => 'string|distinct',
            'file' => 'file|mimetypes:video/mp4,video/ogg,video/webm|max:102400'
        ], [
            'file.file' => 'Choosing the appropriate file is crucial.',
            'file.mimetypes' => 'The file format is not recognized or supported by the system.',
            'file.max' => 'The maximum allowable file size is 100 megabytes.',
            'tags.max' => 'The maximum number of tags allowed is 5.',
            'tags.*.distinct' => 'The tags can not be duplicated'
        ]);

        $fileName = uniqid('amv_video_') . '.' . File::extension($request->file->getClientOriginalName());
        $filePath = 'uploads/amvs/' . $fileName;
        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->file));
        $url = Storage::disk('public')->url($filePath);

        if ($isFileUploaded) {

            $amv = new Amv();
            $amv->text = $request->text;
            $amv->user_id = $request->user_id;
            $amv->video = $filePath;
            $amv->tags = $request->tags;
            $amv->save();
        }

        return response([
            'status' => 200,
        ]);
    }

    public function get()
    {
        return response([
            'posts' => Amv::with('user')->limit(10)->get(),
        ]);
    }
}
