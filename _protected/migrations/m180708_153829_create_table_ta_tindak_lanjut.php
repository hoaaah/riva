<?php

use yii\db\Migration;

class m180708_153829_create_table_ta_tindak_lanjut extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_tindak_lanjut}}', [
            'id' => $this->primaryKey(),
            'tahun' => $this->date()->notNull(),
            'rencana_tindak_id' => $this->integer()->notNull(),
            'no_urut' => $this->integer()->notNull(),
            'file_name' => $this->string(),
            'saved_file' => $this->string(),
            'uraian' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('rencana_tindak_id', '{{%ta_tindak_lanjut}}', 'rencana_tindak_id');
        $this->addForeignKey('ta_tindak_lanjut_ibfk_1', '{{%ta_tindak_lanjut}}', 'rencana_tindak_id', '{{%ta_rencana_tindak}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%ta_tindak_lanjut}}');
    }
}
