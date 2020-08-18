<?php


namespace app\admin\modle;


use think\Model;

class User extends Model
{
    public function UserPermissionsRelationship()
    {
        //hasOne 表示一对一关联，参数一表示附表，参数二外键，默认 user_id
        return $this->hasOne(UserPermissionsRelationship::class,'user_id');
    }
    public function permissions()
    {
        //hasOne 表示一对一关联，参数一表示附表，参数二外键，默认 user_id
        return $this->belongsToMany (Permissions::class,UserPermissionsRelationship::class);
    }
}