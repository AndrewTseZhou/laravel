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
}
