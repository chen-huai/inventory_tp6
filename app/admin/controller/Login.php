<?php


namespace app\admin\controller;


use think\facade\View;
use app\validate\User as loginVi;
use app\admin\modle\User;

class Login
{
    public function login()
    {
        return View::fetch();
    }
    /**
     * [verify 用户信息验证]
     * @return [boolean]
     */
    public function verify() {

        $data = input('post.');

        $flag = false;
        $msg = '';
        $ini = false;

        // 用户密码验证


        $user = array(
            'username' => $data['username'],
            'password' => $data['password'],
        );
        $val = new loginVi();


        //验证是否符合规则
        if (!$val->check($user)) {
            $msg = $val->getError();
            return json(array(
                'flag' => $flag,
                'msg' => $msg
            ));
        };
        //验证是否符合规则
//        try {
//            validate(loginVi::class)->check(
//                $user
//            );
//        } catch (ValidateException $e) {
//             return json(array(
//                 'flag' => $flag,
//                 'msg' => $msg = $e->getError()
//             ));
//        }

        // 查询结果判断
        $userInfo = User::where('username',$data['username'])->select();
        $power = User::find($userInfo['0']['id'])->permissions;

        if(!empty($userInfo) && ( $userInfo[0]['password'] == $data['password'])) {
            // session_start();
            // $_SESSION['username'] = $username;
            // $_SESSION['approver'] = !empty($userInfo['ApproveDep']);
            session('username', $data['username']);
            session('id', $userInfo['0']['id']);
            session('power',$power);
            session('toggle', true);
            $flag = true;
        } else {
            $msg = '用户名或密码错误';
        }

        // 返回验证结果
        return json(array(
            'ini' => $ini,
            'flag' => $flag,
            'msg' => $msg,
        ));
    }

    //用户退出登录的方法
    public function logout()
    {
        session(null);
        $this->success('退出登录成功', '/login');
    }
}