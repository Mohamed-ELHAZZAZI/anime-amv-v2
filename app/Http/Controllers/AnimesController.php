<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class AnimesController extends Controller
{
    public function getTop()
    {
        $anime = Anime::where('rank', '<', 100)->get();
        return response([
            'rr' => $anime
        ]);
    }
}
