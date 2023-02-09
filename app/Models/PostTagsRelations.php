<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTagsRelations extends Model
{
    use HasFactory;
    protected $fillable = ['amv_id', 'tag_id'];
}
