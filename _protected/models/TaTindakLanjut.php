<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ta_tindak_lanjut".
 *
 * @property int $id
 * @property string $tahun
 * @property int $rencana_tindak_id
 * @property int $no_urut
 * @property string $file_name
 * @property string $saved_file
 * @property string $uraian
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property TaRencanaTindak $rencanaTindak
 */
class TaTindakLanjut extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_tindak_lanjut';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun', 'rencana_tindak_id', 'no_urut'], 'required'],
            [['tahun'], 'safe'],
            [['rencana_tindak_id', 'no_urut', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['file_name', 'saved_file', 'uraian'], 'string', 'max' => 255],
            [['rencana_tindak_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaRencanaTindak::className(), 'targetAttribute' => ['rencana_tindak_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tahun' => 'Tahun',
            'rencana_tindak_id' => 'Rencana Tindak ID',
            'no_urut' => 'No Urut',
            'file_name' => 'File Name',
            'saved_file' => 'Saved File',
            'uraian' => 'Uraian',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRencanaTindak()
    {
        return $this->hasOne(TaRencanaTindak::className(), ['id' => 'rencana_tindak_id']);
    }
}
