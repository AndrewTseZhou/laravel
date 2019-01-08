<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//注意有绑定模型的路由，同路径的路由需要放在没绑定路由的后面
//文章列表页
Route::get('/posts', '\App\Http\Controllers\PostController@index');
//创建文章
Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
Route::post('/posts', '\App\Http\Controllers\PostController@store');
//删除文章
Route::get('/posts/delete', '\App\Http\Controllers\PostController@delete');
//文章详情页 模型绑定方式
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
//编辑文章
Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');