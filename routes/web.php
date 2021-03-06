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

//用户模块
//注册页面
Route::get('/register', '\App\Http\Controllers\RegisterController@index');
//注册行为
Route::post('/register', '\App\Http\Controllers\RegisterController@register');
//登录页面
Route::get('/login', '\App\Http\Controllers\LoginController@index');
//登录行为
Route::post('/login', '\App\Http\Controllers\LoginController@login');
//登出行为
Route::get('/logout', '\App\Http\Controllers\LoginController@logout');
//个人设置页面
Route::get('/user/me/setting', '\App\Http\Controllers\UserController@setting');
//个人设置行为
Route::post('/user/me/setting', '\App\Http\Controllers\UserController@settingStore');
//个人中心
Route::get('/user/{user}', '\App\Http\Controllers\UserController@show');
Route::post('/user/{user}/fan', '\App\Http\Controllers\UserController@fan');
Route::post('/user/{user}/unfan', '\App\Http\Controllers\UserController@unfan');


//注意有绑定模型的路由，同路径的路由需要放在没绑定路由的后面
//文章列表页
Route::get('/posts', '\App\Http\Controllers\PostController@index');
//创建文章
Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
Route::post('/posts', '\App\Http\Controllers\PostController@store');
//搜索
Route::get('/posts/search', '\App\Http\Controllers\PostController@search');
//删除文章
Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');
//文章详情页 模型绑定方式
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
//编辑文章
Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
//图片上传
Route::post('/posts/image/upload', '\App\Http\Controllers\PostController@imageUpload');
//提交评论
Route::post('/posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
//赞
Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
//取消赞
Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');

//专题详情页
Route::get('/topic/{topic}', '\App\Http\Controllers\TopicController@show');
Route::get('/topic/{topic}/submit', '\App\Http\Controllers\TopicController@submit');

//管理后台
include_once('admin.php');
