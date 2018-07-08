<?php

use yii\db\Migration;

class m180708_153825_create_table_ref_sub_unsur extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ref_sub_unsur}}', [
            'id' => $this->primaryKey(),
            'kd_unsur' => $this->integer()->notNull(),
            'kd_sub_unsur' => $this->integer()->notNull(),
            'name' => $this->string(),
        ], $tableOptions);

        $this->createIndex('kd_unsur', '{{%ref_sub_unsur}}', 'kd_unsur');
        $this->addForeignKey('ref_sub_unsur_ibfk_1', '{{%ref_sub_unsur}}', 'kd_unsur', '{{%ref_unsur}}', 'kd_unsur', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%ref_sub_unsur}}');
    }
}
