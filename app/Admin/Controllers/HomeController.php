<?php
/**
 * User: andrewtse
 * Date: 2019-01-23
 * Time: 10:34
 */

namespace App\Admin\Controllers;


class HomeController extends Controller {

    //首页
    public function index() {
        return view('admin.home.index');
    }
}