<?php


namespace app\admin\controller;


use app\admin\modle\Permissions;
use app\admin\modle\User;
use app\admin\modle\UserPermissionsRelationship;

class Index
{
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
       return json(User::hasWhere('permissions',['user_id'=>1])->select());
    }

}