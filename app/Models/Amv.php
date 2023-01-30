<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amv extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'video', 'tags', 'liks', 'dislikes', 'user_id', 'comments'];


    protected $casts = [
        'tags' => 'json',
    ];
}
