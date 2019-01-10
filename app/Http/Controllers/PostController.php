<?php
/**
 * User: andrewtse
 * Date: 2019-01-08
 * Time: 13:14
 */

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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
        //表单提交分以下3步
        //验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);
        //具体的逻辑
        $post = Post::create(request(['title', 'content']));
        //dd: dump and die
        //dd(request());//打印语句
        //渲染
        return redirect("/posts");
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

    //上传图片
    public function imageUpload(Request $request) {
        $path=$request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }
}