<?php

Route::get('/', 'ArticlesController@index');

Route::resource('articles', 'ArticlesController');

Route::get('tags/{id}', ['as' => 'individual_tag_path', 'uses' => 'TagsController@show']);

get('api/articles', 'API\ArticlesController@index');

Route::get('login', ['as' => 'login_path', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'login_path', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout_path', 'uses' => 'Auth\AuthController@getLogout']);