<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ta_th".
 *
 * @property string $tahun
 * @property string $nama_pemda
 * @property string $image_name
 * @property string $saved_image
 */
class TaTh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_th';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun'], 'required'],
            [['tahun'], 'safe'],
            [['nama_pemda'], 'string', 'max' => 50],
            [['image_name', 'saved_image'], 'string', 'max' => 255],
            [['tahun'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tahun' => 'Tahun',
            'nama_pemda' => 'Nama Pemda',
            'image_name' => 'Image Name',
            'saved_image' => 'Saved Image',
        ];
    }
}
