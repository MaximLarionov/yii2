<?php

namespace app\repository;


use app\entity\Users;

class UsersRepository
{
//    public static function getUsers(){
//        return Users::find()->all();
//    }

    public static function getUserById($id){
        return Users::find()->where(["id"=>$id])->one();
    }

    public static function createUser($email, $password, $name, $age, $is_admin = false)
    {
        $user = new Users();
        $user->email = $email;
        $user->name = $name;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->age = $age;
        $user->is_admin = $is_admin;

        $user->save();
        return $user->id;
    }

    public static function editUser($id, $name, $age)
    {
        $user = self::getUserById($id);
        $user->name = $name;
        $user->age = $age;
        $user->save();
        return true;
    }

    public static function getUserByEmail($email){
        return Users::find()->where(["email"=> $email])->one();
    }
}