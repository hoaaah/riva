<?php

use yii\db\Migration;

class m180708_153818_create_table_ta_th extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ta_th}}', [
            'tahun' => $this->date()->notNull()->append('PRIMARY KEY'),
            'nama_pemda' => $this->string(),
            'image_name' => $this->string(),
            'saved_image' => $this->string(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%ta_th}}');
    }
}
