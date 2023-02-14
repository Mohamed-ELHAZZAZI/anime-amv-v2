<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmvReaction extends Model
{
    use HasFactory;

    public function amv()
    {
        return $this->belongsTo(Amv::class);
    }
}
