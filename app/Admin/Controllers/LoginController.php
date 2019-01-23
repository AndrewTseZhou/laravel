<?php
/**
 * User: andrewtse
 * Date: 2019-01-23
 * Time: 10:09
 */

namespace App\Admin\Controllers;


class LoginController extends Controller {

    //登录展示页面
    public function index() {
        return view('admin.login.index');
    }

    //登录行为
    public function login() {

    }

    //登出行为
    public function logout() {

    }
}