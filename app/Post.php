<?php

namespace App;

//表=>Posts
class Post extends BaseModel {

//    protected $fillable = ['title', 'content'];//可以注入的数据字段

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
