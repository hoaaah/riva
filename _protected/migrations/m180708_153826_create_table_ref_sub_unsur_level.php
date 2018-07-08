<?php

use yii\db\Migration;

class m180708_153826_create_table_ref_sub_unsur_level extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ref_sub_unsur_level}}', [
            'id' => $this->primaryKey(),
            'kode' => $this->string()->notNull(),
            'sub_unsur_id' => $this->integer(),
            'parameter' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('sub_unsur_id', '{{%ref_sub_unsur_level}}', 'sub_unsur_id');
        $this->createIndex('p_id', '{{%ref_sub_unsur_level}}', 'kode', true);
        $this->addForeignKey('ref_sub_unsur_level_ibfk_1', '{{%ref_sub_unsur_level}}', 'sub_unsur_id', '{{%ref_sub_unsur}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%ref_sub_unsur_level}}');
    }
}
