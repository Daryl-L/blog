<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMay(Article::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
