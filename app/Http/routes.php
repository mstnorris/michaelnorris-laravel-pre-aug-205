<?php

get('/', ['as' => 'home_path', 'uses' => 'ArticlesController@index']);

get('write', ['as' => 'write_article_path', 'uses' => 'ArticlesController@create', 'middleware' => 'auth']);



Route::get('articles/tag/{tag?}', ['as' => 'individual_tag_path', 'uses' => 'ArticlesController@index']);
Route::resource('articles', 'ArticlesController');

Route::group(['prefix' => 'api', 'namespace' => 'API'], function()
{
    Route::resource('articles', 'ArticlesController');
    Route::resource('tags', 'TagsController');
    Route::get('articles/{id}/tags', 'TagsController@index');

    //
    //get('articles', 'API\ArticlesController@index');
    //get('articles/{id}', 'API\ArticlesController@show');
    //get('articles/{id}/tags', 'API\ArticlesController@show');
    //get('tags', 'API\ArticlesController@show');
    //get('tags/{name}', 'API\ArticlesController@show');
});


Route::get('login', ['as' => 'login_path', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'login_path', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout_path', 'uses' => 'Auth\AuthController@getLogout']);

get('{article_id}', ['as' => 'individual_article_path', 'uses' => 'ArticlesController@show']);