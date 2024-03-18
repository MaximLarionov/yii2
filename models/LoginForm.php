<?php

namespace app\models;

use app\repository\UsersRepository;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


class LoginForm extends Model
{
    public $email;

    public $password;
    public $rememberMe = true;

    private $_user = false;

    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ["email", "email"],
        ];
    }


    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();


            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * @return  ActiveRecord|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = UsersRepository::getUserByEmail($this->email);
        }

        return $this->_user;
    }
}
