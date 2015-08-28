<?php

get('/', ['as' => 'home_path', 'uses' => 'ArticlesController@index']);

get('write', ['as' => 'write_article_path', 'uses' => 'ArticlesController@create', 'middleware' => 'auth']);



Route::get('articles/tag/{tag?}', ['as' => 'individual_tag_path', 'uses' => 'ArticlesController@index']);
Route::resource('articles', 'ArticlesController');

get('api/articles', 'API\ArticlesController@index');
get('api/articles/{id}', 'API\ArticlesController@show');

Route::get('login', ['as' => 'login_path', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'login_path', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout_path', 'uses' => 'Auth\AuthController@getLogout']);

get('{article_id}', ['as' => 'individual_article_path', 'uses' => 'ArticlesController@show']);