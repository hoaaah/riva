<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ta_analisis_tl".
 *
 * @property int $id
 * @property string $tahun
 * @property int $rencana_tindak_id
 * @property int $level_akhir
 * @property string $bobot
 * @property string $skor
 *
 * @property TaRencanaTindak $rencanaTindak
 */
class TaAnalisisTl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_analisis_tl';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun', 'rencana_tindak_id', 'level_akhir'], 'required'],
            [['tahun'], 'safe'],
            [['rencana_tindak_id', 'level_akhir'], 'integer'],
            [['bobot', 'skor'], 'number'],
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
            'level_akhir' => 'Level Akhir',
            'bobot' => 'Bobot',
            'skor' => 'Skor',
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
