<?php
/**
 * User: andrewtse
 * Date: 2019-01-08
 * Time: 13:14
 */

namespace App\Http\Controllers;


class PostController extends Controller {

    //文章列表页
    public function index() {
        $posts = [
            ['title' => "this is title1"],
            ['title' => "this is title2"],
            ['title' => "this is title3"],
        ];
//        return view("post/index", ['posts' => $posts]);
        return view("post/index", compact('posts'));
    }

    //文章详情页
    public function show() {
        return view("post/show", ['title' => 'this is title', 'isShow' => false]);
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