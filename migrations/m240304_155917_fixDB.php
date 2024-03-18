<?php

use yii\db\Migration;


class m240304_155917_fixDB extends Migration
{

    public function safeUp()
    {
        $this->addColumn("users", "age", $this->integer());

    }

    public function safeDown()
    {
        return true;

    }

}
