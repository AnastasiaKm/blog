<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/admin', function(){
  return view('admin.index');
});
Route::get('/author', function(){
  return view('author.index');
});


Route::group(['middleware' => 'admin'], function(){
  Route::resource('admin/users', 'AdminUsersController');
  Route::resource('admin/posts', 'AdminPostsController');
  Route::resource('admin/categories', 'AdminCategoriesController');
  Route::resource('admin/tags', 'AdminTagsController');
  Route::resource('admin/media', 'AdminMediasController');
  Route::post('admin/comments/{post_id}', ['uses' => 'AdminCommentsController@store',
                                   'as' => 'admin.comments.store']);
  Route::get('admin/comments/{id}/edit', ['uses' => 'AdminCommentsController@edit',
                                    'as' => 'admin.comments.edit']);
  Route::put('admin/comments/{id}', ['uses' => 'AdminCommentsController@update',
                        'as' => 'admin.comments.update']);
  Route::delete('admin/comments/{id}', ['uses' => 'AdminCommentsController@destroy',
                                    'as' => 'admin.comments.destroy']);
  Route::get('admin/comments/{id}/delete', ['uses'=> 'AdminCommentsController@delete',
                                  'as' => 'admin.comments.delete']);

});

Route::group(['middleware' => 'author'], function(){
  Route::resource('author/posts', 'AuthorPostsController');
  Route::resource('author/categories', 'AuthorCategoriesController');
});
