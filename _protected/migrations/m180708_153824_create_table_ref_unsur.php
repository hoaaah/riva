<?php

use yii\db\Migration;

class m180708_153824_create_table_ref_unsur extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ref_unsur}}', [
            'kd_unsur' => $this->primaryKey(),
            'name' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ref_unsur}}');
    }
}
