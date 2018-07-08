<?php

use yii\db\Migration;

class m180708_153830_create_table_ta_analisis_tl extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_analisis_tl}}', [
            'id' => $this->primaryKey(),
            'tahun' => $this->date()->notNull(),
            'rencana_tindak_id' => $this->integer()->notNull(),
            'level_akhir' => $this->integer()->notNull(),
            'bobot' => $this->decimal(),
            'skor' => $this->decimal(),
        ], $tableOptions);

        $this->createIndex('rencana_tindak_id', '{{%ta_analisis_tl}}', 'rencana_tindak_id');
        $this->addForeignKey('ta_analisis_tl_ibfk_1', '{{%ta_analisis_tl}}', 'rencana_tindak_id', '{{%ta_rencana_tindak}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%ta_analisis_tl}}');
    }
}
