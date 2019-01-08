<?php
/**
 * User: andrewtse
 * Date: 2019-01-08
 * Time: 13:14
 */

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller {

    //文章列表页
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view("post/index", compact('posts'));
    }

    //文章详情页
    public function show(Post $post) {
        return view("post/show", compact('post'));
    }

    //创建文章
    public function create() {
        return view("post/create");
    }

    //创建逻辑
    public function store() {

    }

    //编辑文章
    public function edit() {
        return view("post/edit");
    }

    //编辑逻辑
    public function update() {

    }

    //删除文章
    public function delete() {

    }
}