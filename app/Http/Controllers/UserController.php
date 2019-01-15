<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    //个人设置页面
    public function setting() {
        return view('user.setting');
    }

    //个人设置行为
    public function settingStore() {

    }

    //个人中心页面
    public function show(User $user) {
        //个人的信息，包含文章数，粉丝数，关注数
        $user = User::withCount(['stars', 'fans', 'posts'])->find($user->id);

        //文章列表
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(10);

        //关注的用户，包含关注用户的 关注/粉丝/文章数
        $stars = $user->stars();
        $susers = User::whereIn('id', $stars->pluck('star_id'))->withCount(['stars', 'fans', 'posts'])->get();

        //粉丝用户，包含粉丝用户的 关注/粉丝/文章数
        $fans = $user->fans();
        $fusers = User::whereIn('id', $fans->pluck('fan_id'))->withCount(['stars', 'fans', 'posts'])->get();

        return view("user/show", compact('user', 'posts', 'susers', 'fusers'));
    }

    //关注用户
    public function fan(User $user) {
        $me = Auth::user();
        $me->doFan($user->id);

        return [
            'error' => 0,
            'msg' => '',
        ];
    }

    //取消关注
    public function unfan(User $user) {
        $me = Auth::user();
        $me->doUnfan($user->id);

        return [
            'error' => 0,
            'msg' => '',
        ];
    }
}
