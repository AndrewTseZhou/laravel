<?php
/**
 * User: andrewtse
 * Date: 2019-01-08
 * Time: 19:58
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{

    protected $guarded = []; //不可以注入的字段 []代表所有的字段都可以注入
}