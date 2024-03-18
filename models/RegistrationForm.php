<?php

namespace app\models;

use app\repository\UsersRepository;
use yii\base\Model;

class RegistrationForm extends Model
{
    public $email;
    public $password;
    public $passwordRepeat;
    public $name;
    public $age;
    public $is_admin = false;


    public function rules()
    {
        return [
            [["email", "password", "passwordRepeat", "name", "age"], "required"],
            ["email", "email"],
            ["passwordRepeat", "compare", "compareAttribute" => "password"],
            ["email", "validateEmail"]
        ];
    }


    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = UsersRepository::getUserByEmail($this->email);

            if ($user) {
                $this->addError($attribute, 'Пользователь уже существует');
            }
        }
    }
}