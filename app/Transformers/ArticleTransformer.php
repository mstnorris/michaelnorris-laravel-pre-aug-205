<?php

namespace App\Transformers;


class ArticleTransformer extends Transformer
{
    
    public function transform($article)
    {
        return [
            'id' => $article['article_id'],
            'title' => $article['title'],
            'body' => $article['body'],
            'private' => $article['is_private'],
            'published' => $article['published_at']
        ];
    }
}