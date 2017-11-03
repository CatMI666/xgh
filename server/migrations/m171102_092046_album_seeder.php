<?php

use yii\db\Migration;

class m171102_092046_album_seeder extends Migration
{
    public function safeUp()
    {
        $this->batchInsert("album",['name','created_at','updated_at'],[
            ['龙门石窟',time(),time()],
            ['十一国庆北京游',time(),time()],
            ['牡丹广场',time(),time()],
            ['王城公园看牡丹',time(),time()]
        ]);
    }

    public function safeDown()
    {
        echo "m171102_092046_album_seeder cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171102_092046_album_seeder cannot be reverted.\n";

        return false;
    }
    */
}
