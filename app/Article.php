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
        'is_private',
        'published_at'
    ];

    protected $dates = [
        'published_at'
    ];

    protected $casts = [
        'is_private' => 'boolean',
    ];

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopePrivate($query)
    {
        $query->where('is_private', true);
    }

    public function scopePublic($query)
    {
        $query->where('is_private', false);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
