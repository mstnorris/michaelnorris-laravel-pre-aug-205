<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'article_id',
        'title',
        'body',
        'published_at'
    ];

    protected $dates = [
        'published_at'
    ];
}
