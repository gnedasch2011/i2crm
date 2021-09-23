<?php

use yii\db\Migration;

/**
 * Class m210923_144505_user_department
 */
class m210923_144505_user_department extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_department', [
            'id_user' => $this->integer(),
            'id_departmen' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210923_144505_user_department cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210923_144505_user_department cannot be reverted.\n";

        return false;
    }
    */
}
