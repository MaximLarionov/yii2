<?php

namespace app\repository;

use app\entity\Cart;
use app\entity\Users;

class CartRepository
{
    public static function getUsers(){
        return Cart::find()->joinWith("users")->all();
    }
}