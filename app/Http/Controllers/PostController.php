<?php
/**
 * User: andrewtse
 * Date: 2019-01-08
 * Time: 13:14
 */

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

    //文章列表页
    public function index() {
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments', 'zans'])->paginate(6);
        return view("post/index", compact('posts'));
    }

    //文章详情页
    public function show(Post $post) {
        $post->load('comments');
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
        $user_id = Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));
        $post = Post::create($params);
        //dd: dump and die
        //dd(request());//打印语句
        //渲染
        return redirect("/posts");
    }

    //编辑文章
    public function edit(Post $post) {
        return view("post/edit", compact('post'));
    }

    //编辑逻辑
    public function update(Post $post) {
        //验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:5',
            'content' => 'required|string|min:10',
        ]);

        try {
            $this->authorize('update', 'post');
        } catch (AuthorizationException $e) {
        }
        //逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();
        //渲染
        return redirect("/posts/{$post->id}");
    }

    //删除文章
    public function delete(Post $post) {
        try {
            $this->authorize('delete', 'post');
        } catch (AuthorizationException $e) {
        }
        $post->delete();
        return redirect("/posts");
    }

    //上传图片
    public function imageUpload(Request $request) {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }

    //提交评论
    public function comment(Post $post) {
        //验证
        $this->validate(request(), [
            'content' => 'required|min:3',
        ]);

        //逻辑
        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);

        //渲染
        return back();
    }

    //赞
    public function zan(Post $post) {
        $param = [
            'user_id' => Auth::id(),
            'post_id' => $post->id,
        ];
        Zan::firstOrCreate($param);
        return back();
    }

    //取消赞
    public function unzan(Post $post) {
        $post->zan(Auth::id())->delete();
        return back();
    }
}