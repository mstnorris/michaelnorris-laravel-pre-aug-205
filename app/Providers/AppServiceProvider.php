<?php

namespace App\Providers;

use ColorExtractor;
use Illuminate\Support\ServiceProvider;
use App\Article;
use Vinkla\Hashids\Facades\Hashids;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Article::created(function ($article) {
            $article->article_id = Hashids::connection('article_id')->encode($article->id);

            $geopattern = new \RedeyeVentures\GeoPattern\GeoPattern();
            $geopattern->setString($article->article_id);
            $dataURL = $geopattern->toDataURL();
            $article->header_image_path = $dataURL;
            //$image = ColorExtractor::loadPng(public_path() . '/images/ArticleHeader.png');
            //$article->color = $image->extract();
            $article->save();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
