<?php

use yii\db\Migration;

class m180708_153828_create_table_ta_rencana_tindak extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_rencana_tindak}}', [
            'id' => $this->primaryKey(),
            'tahun' => $this->date()->notNull(),
            'sub_unsur_id' => $this->integer()->notNull(),
            'level_awal' => $this->integer(),
            'rencana_tindak' => $this->string(),
            'output' => $this->string(),
            'penanggung_jawab' => $this->string(),
            'batas_waktu_tl' => $this->date(),
            'level_target' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('sub_unsur_id', '{{%ta_rencana_tindak}}', 'sub_unsur_id');
        $this->createIndex('tahun', '{{%ta_rencana_tindak}}', ['tahun', 'sub_unsur_id'], true);
        $this->addForeignKey('ta_rencana_tindak_ibfk_1', '{{%ta_rencana_tindak}}', 'sub_unsur_id', '{{%ref_sub_unsur}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%ta_rencana_tindak}}');
    }
}
