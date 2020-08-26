<?php


namespace app\admin\controller;


use think\facade\Session;
use think\facade\View;
use app\admin\controller\Base;

class User extends Base
{

    public function index()
    {
        $power = Session::get('power');
//        View::assign('power', $power);
        return View::fetch('index',['power' => $power]);
    }
}