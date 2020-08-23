<?php


namespace app\admin\controller;


use think\facade\View;
use app\validate\User as loginVi;
use app\admin\modle\User;
use think\facade\Session;

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
            Session::set('username', $data['username']);
            Session::set('id', $userInfo['0']['id']);
            Session::set('power',$power);
            Session::set('toggle', true);
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
        Session::clear('');
        $judge = Session::has('username');
//        dump($judge);
//        die;
        if($judge){
            $res['flag'] = false;
            $res['msg'] = '退出用户失败';
        }else{
            $res['flag'] = true;
            $res['msg'] = '退出用户成功';
        }
        return json($res);
    }
}