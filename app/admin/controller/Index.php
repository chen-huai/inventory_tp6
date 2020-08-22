<?php


namespace app\admin\controller;


use app\admin\modle\Permissions;
use app\admin\modle\User;
use app\admin\modle\UserPermissionsRelationship;
use app\validate\User as loginVi;
use \think\facade\View;
//测试用
class Index
{
    public function index()
    {
        return View::fetch();
    }
    public function userData()
    {
        $user = new User();
        $user->save([
            'username' => '李白',
            'password' => '123456',

        ]);
    }
    public function permissionsData()
    {
        $user = new Permissions();
        $user->save([
            'permissionsName'=> '管理员',
        ]);
    }
    public function userPermissionsRelationship()
    {
        $user = new UserPermissionsRelationship();
        $user->save([
            'user_id'=> '2',
            'permissions_id'=> '2',
        ]);
    }
    public function search()
    {

       return json(User::find(1)->UserPermissionsRelationship);
    }
    public function searchMany()
    {
//       return json(User::find(1)->permissions);
//       return json(User::find(1)->permissions()->select());


        $user = User::find(1);
        $role = $user -> permissions;
        return json($role);
//        $user = User::alias('u')->field(['username','password'])->select();
//        return json($user);
//        return json(User::count());

    }
    public function verify()
    {
        $user = array(
            'username' => '',
            'password' => '123456',
        );
        try {
            validate(loginVi::class)->batch(true)->check(
                $user
            );
        } catch (ValidateException $e) {
            dump($e->getError());
        }
    }

}