<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amv extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'video', 'tags', 'liks', 'dislikes', 'user_id', 'comments'];


    protected $casts = [
        'tags' => 'json',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'post_tags_relations');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
