<?php

use yii\db\Migration;

class m180708_153827_create_table_ref_bobot_sub_unsur extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ref_bobot_sub_unsur}}', [
            'sub_unsur_id' => $this->primaryKey(),
            'bobot' => $this->decimal(5,4)->notNull(),
        ], $tableOptions);

        $this->addForeignKey('ref_bobot_sub_unsur_ibfk_1', '{{%ref_bobot_sub_unsur}}', 'sub_unsur_id', '{{%ref_sub_unsur}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%ref_bobot_sub_unsur}}');
    }
}
