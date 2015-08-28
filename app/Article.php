<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'article_id',
        'title',
        'body',
        'private',
        'published_at'
    ];

    protected $dates = [
        'published_at'
    ];

    protected $casts = [
        'private' => 'boolean',
    ];

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopePrivate($query)
    {
        $query->where('private', true);
    }

    public function scopePublic($query)
    {
        $query->where('private', false);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
