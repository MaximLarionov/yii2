<?php

namespace app\models;

use yii\base\Model;

class UserForm extends Model
{
    public $firstName;
    public $lastName;
    public $patronymic;
    public $email;
    public $password;
    public $passwordRepeat;

    public function rules(){
        return [
            [["firstName", "lastName", "email", "password", "passwordRepeat"], "required"],
            [["firstName", "lastName", "patronymic"], "string"],
            [["email"], "email"],
            [["patronymic"], "default", "value"=> "Нет отчества"],
            ["passwordRepeat", "compare", "compareAttribute" => "password"],
            [["password"], "string","length"=> [8, 16]]
        ];
    }
}