<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    const TYPE_QUIZ = 2;
    const TYPE_POST = 1;

    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'tag_posts');
    }
}
