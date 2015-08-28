<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ArticlesController extends APIController
{

    /*
     * @var App\Transformers\ArticleTransformer
     */
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
        $articles = Article::paginate($limit);
        //dd(get_class_methods($articles));
        return $this->respondWithPagination($articles, [
            'data'      => $this->articleTransformer->transformCollection($articles->all()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
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
    public function show($id)
    {
        $article = Article::whereArticleId($id)->first();

        if ( ! $article )
        {
            return $this->respondNotFound('Article not found.');
        }

        return $this->respond([
            'data' => $this->articleTransformer->transform($article)
        ]);
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
