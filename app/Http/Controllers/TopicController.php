<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostTopic;
use App\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller {

    //专题详情页
    public function show(Topic $topic) {
        //带文章数的专题
//        $topic = Topic::withCount('postTopics')->find($topic->id);

        //专题的文章列表，按照创建时间倒序排序
        $posts = $topic->posts()->orderBy('created_at', 'desc')->paginate(10);

        //属于我的文章，但是未投稿
        $myposts = Post::authorBy(Auth::id())->topicNotBy($topic->id)->get();

        return view('topic/show',compact('topic','posts','myposts'));
    }

    //投稿
    public function submit(Topic $topic) {
        $this->validate(request(), [
            'post_ids' => 'required|array',
        ]);

        $post_ids = request('post_ids');
        $topic_id = $topic->id;
        foreach ($post_ids as $post_id) {
            PostTopic::firstOrCreate(compact('topic_id', 'post_id'));
        }
        return back();
    }
}
