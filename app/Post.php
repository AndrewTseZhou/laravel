<?php

namespace App;

//表=>Posts
use Laravel\Scout\Searchable;

class Post extends BaseModel {

//    protected $fillable = ['title', 'content'];//可以注入的数据字段

    use Searchable;

    //定义索引里面的type
    public function searchableAs() {
        return "post";
    }

    //定义有哪些字段需要索引
    public function toSearchableArray() {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    //关联用户
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    //关联评论模型
    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    //关联赞和用户
    public function zan($user_id) {
        return $this->hasOne('App\Zan')->where('user_id', $user_id);
    }

    //文章的所有赞
    public function zans() {
        return $this->hasMany('App\Zan');
    }
}
