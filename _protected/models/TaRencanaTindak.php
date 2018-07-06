<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ta_rencana_tindak".
 *
 * @property int $id
 * @property string $tahun
 * @property int $sub_unsur_id
 * @property int $level_awal
 * @property string $rencana_tindak
 * @property string $output
 * @property string $penanggung_jawab
 * @property string $batas_waktu_tl
 * @property int $level_target
 *
 * @property TaAnalisisTl[] $taAnalisisTls
 * @property RefSubUnsur $subUnsur
 * @property TaTindakLanjut[] $taTindakLanjuts
 */
class TaRencanaTindak extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ta_rencana_tindak';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun', 'sub_unsur_id'], 'required'],
            [['tahun', 'batas_waktu_tl'], 'safe'],
            [['sub_unsur_id', 'level_awal', 'level_target'], 'integer'],
            [['rencana_tindak', 'output'], 'string', 'max' => 255],
            [['penanggung_jawab'], 'string', 'max' => 100],
            [['tahun', 'sub_unsur_id'], 'unique', 'targetAttribute' => ['tahun', 'sub_unsur_id']],
            [['sub_unsur_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefSubUnsur::className(), 'targetAttribute' => ['sub_unsur_id' => 'id']],
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
            'sub_unsur_id' => 'Sub Unsur ID',
            'level_awal' => 'Level Awal',
            'rencana_tindak' => 'Rencana Tindak',
            'output' => 'Output',
            'penanggung_jawab' => 'Penanggung Jawab',
            'batas_waktu_tl' => 'Batas Waktu Tl',
            'level_target' => 'Level Target',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaAnalisisTls()
    {
        return $this->hasMany(TaAnalisisTl::className(), ['rencana_tindak_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubUnsur()
    {
        return $this->hasOne(RefSubUnsur::className(), ['id' => 'sub_unsur_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaTindakLanjuts()
    {
        return $this->hasMany(TaTindakLanjut::className(), ['rencana_tindak_id' => 'id']);
    }
}
