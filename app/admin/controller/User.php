<?php


namespace app\admin\controller;

use app\admin\controller\Base;
//use think\facade\Session;
use think\facade\Session;
use think\facade\View;


class User extends Base
{
//    public function initialize() {
//        // 用户若已经登录，则重定向到首页
//        if(Session::has('username')){
//            return $this->redirectTo(url('userlist'));
//        }
//    }
    public function index()
    {
        $power = Session::get('power');
//        View::assign('power', $power);
        return View::fetch('index',['power' => $power]);
    }
}