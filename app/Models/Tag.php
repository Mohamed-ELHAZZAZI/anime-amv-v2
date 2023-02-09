<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function amvs()
    {
        return $this->belongsToMany(Amv::class, 'post_tags_relations');
    }
}
