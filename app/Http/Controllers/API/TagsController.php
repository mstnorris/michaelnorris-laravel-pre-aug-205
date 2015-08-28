<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\Tag;
use App\Transformers\TagTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagsController extends APIController
{

    protected $tagTransformer;

    function __construct(TagTransformer $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($articleId = null)
    {
        $tags = $this->getTags($articleId);

        return $this->respond([
            'data' => $this->tagTransformer->transformCollection($tags->all())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $articleId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTags($articleId)
    {
        return $articleId ? Article::whereArticleId($articleId)->firstOrFail()->tags : Tag::all();
    }
}
