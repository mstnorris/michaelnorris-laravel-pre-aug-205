<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ArticlesController extends Controller
{
    protected $articleTransformer;

    function __construct(ArticleTransformer $articleTransformer)
    {
        $this->articleTransformer = $articleTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($tag = null)
    {
        $limit = (int)Input::get('limit', 9);

        $limit > 15 ? $limit = 15 : null;
        
        if ( $tag )
        {
            $articles = Article::with('tags')->whereHas('tags', function ($q) use ($tag) {
                $q->where('name', 'like', $tag);
            })->public()->published()->latest('published_at')->paginate($limit);
            return view('articles.index', compact('articles'));
        }

        $articles = Article::with('tags')->public()->published()->latest('published_at')->paginate($limit);

        return view('articles.index', compact('articles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $tags = Tag::all('name', 'id');

        return view('articles.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($article_id)
    {
        $articles = Article::whereArticleId($article_id)->paginate(1);

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
