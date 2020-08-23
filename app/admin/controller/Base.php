<?php


namespace app\admin\controller;


use app\BaseController;
use think\App;
use think\exception\HttpResponseException;
use think\facade\Session;
use think\facade\View;

class Base extends BaseController
{
    public function initialize()
    {
        parent::initialize();

        if (!Session::has('username')) {
            return $this->redirectTo(url('admin/index/sessionTest'));
        }
        else{
//            $power = Session::get('power');
//            View::fetch('admin@user/index',['power' => $power]);
            $userInfo = array(
                'username' => Session::get('username'),
                'power' => Session::get('power')
            );
            View::assign('userInfo', $userInfo);
            return $this->redirectTo(url('admin@user/index'));
        }
    }

    public function redirectTo(...$args)
    {
        // 此处 throw new HttpResponseException 这个异常一定要写
        throw new HttpResponseException(redirect(...$args));
    }

}