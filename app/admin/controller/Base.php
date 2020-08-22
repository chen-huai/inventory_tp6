<?php


namespace app\admin\controller;


class Base
{
    public function _initialize()
    {
        if (!session('username')) {
            $this->error('请先登录系统', 'Index/login');
        }else{
            $userInfo = array(
                'username' => session('username'),
                'power' => session('power')
            );
            $this->assign('userInfo', $userInfo);
        }
    }
}