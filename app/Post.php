<?php

namespace App;

//表=>Posts
class Post extends BaseModel {

    protected $fillable = ['title', 'content'];//可以注入的数据字段
}
