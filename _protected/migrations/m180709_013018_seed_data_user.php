<?php

use yii\db\Migration;
use app\models\User;

/**
 * Class m180709_013018_seed_data_user
 */
class m180709_013018_seed_data_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => 1,
            'username' => 'administrator',
            'email' => 'admin@admin.com',
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('administrator'),
            'auth_key' => Yii::$app->getSecurity()->generateRandomString(),
            'status' => User::STATUS_ACTIVE,
            'created_at' => time(),
            'updated_at' => time()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180709_013018_seed_data_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180709_013018_seed_data_user cannot be reverted.\n";

        return false;
    }
    */
}
