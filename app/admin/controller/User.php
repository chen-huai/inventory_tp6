<?php


namespace app\admin\controller;


use think\facade\View;

class User
{
    public function index()
    {
        return View::fetch();
    }
}