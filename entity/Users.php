<?php


namespace app\entity;

use app\repository\UsersRepository;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
* Users
 * @property integer id Идентификатор
 * @property string email Email
 * @property string password Пароль
 * @property string name Имя
 * @property integer age Возраст
 * @property boolean is_admin Флаг админа
 */
class Users extends ActiveRecord implements IdentityInterface
{
    public function getCarts(){
        return $this->hasMany(Cart::class, ["id" => "user_id"]);
    }

    public static function findIdentity($id)
    {
        return new static(UsersRepository::getUserById($id));
    }

    public function findUserByEmail($email)
    {
        return new static(UsersRepository::getUserByEmail($email));
    }

    public function validatePassword($password){
        return password_verify($password, $this->password);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
    }

    public function validateAuthKey($authKey)
    {

    }
}