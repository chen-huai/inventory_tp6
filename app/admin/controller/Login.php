<?php


namespace app\admin\controller;


use think\facade\View;

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
        $approver = false;
        $ini = false;

        // 用户密码验证
        $val = new UserInfo();

        $user = array(
            'username' => $data['username'],
            'password' => $data['password'],
        );

        //验证是否符合规则
        if (!$val->check($user)) {
            $msg = $val->getError();
            return array(
                'ini' => $ini,
                'flag' => $flag,
                'msg' => $msg,
            );
        };

        // 查询结果判断
        // $username = '林美玲';
        // $username = "杨娟";
        $userInfo = Db::query("select t0.使用人GUID as id,t0.用户名称 as userName,t0.psw as password,t1.ApproveDep from [dbo].[Sys_User] t0
                            left join L_ProEmploy_Approver t1 on t0.使用人GUID=t1.RefID
                            where t0.用户名称='".$data['username']."'");

        // 如果密码为null 则要求修改密码
        // if($userInfo[0]['password'] == null ) {
        //     $msg = '您第一次使用哦，还请设置您的密码';
        //     $ini = true;
        //     return array(
        //         'ini' => $ini,
        //         'flag' => $flag,
        //         'msg' => $msg,
        //     );
        // };

        // 条件 $userInfo[0]['password'] == '' 待删除
        // 如果用户名正确，将结果存储在session中
        if(!empty($userInfo) && ( $userInfo[0]['password'] == md5($data['password']) || $userInfo[0]['password'] == '' )) {
            // session_start();
            // $_SESSION['username'] = $username;
            // $_SESSION['approver'] = !empty($userInfo['ApproveDep']);
            session('username', $data['username']);
            session('id', $userInfo['0']['id']);
            session('approver', $userInfo[0]['ApproveDep']);
            session('toggle', true);
            $flag = true;
            $approver = $userInfo[0]['ApproveDep'];
        } else {
            $msg = '用户名或密码错误';
        }

        // 返回验证结果
        return array(
            'ini' => $ini,
            'flag' => $flag,
            'msg' => $msg,
            'approver' => $approver,
        );
    }

    /**
     * [initial_password 密码修改页面]
     * @return [弹出层页面]
     */
    public function initial_password() {

        $username = '';

        if(input('?get.username')) {
            $username = input('get.username');
        }

        $this->assign([
            'username' => $username,
        ]);

        return $this->fetch();
    }

    /**
     * [change_password 修改用户密码]
     * @return [数组 flag | msg] [用户修改结果]
     */
    public function change_password() {
        $user = input('post.');

        $flag = false;
        $msg = '';

        //TODO: 修改用户密码
        //
        $msg = '修改成功';

        return array([
            'flag' => $flag,
            'msg' => $msg,
        ]);

    }

    //用户退出登录的方法
    public function logout()
    {
        session(null);
        $this->success('退出登录成功', '/login');
    }
}