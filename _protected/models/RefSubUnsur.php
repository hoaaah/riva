<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_sub_unsur".
 *
 * @property int $id
 * @property int $kd_unsur
 * @property int $kd_sub_unsur
 * @property string $name
 *
 * @property RefBobotSubUnsur $refBobotSubUnsur
 * @property RefUnsur $kdUnsur
 * @property RefSubUnsurLevel[] $refSubUnsurLevels
 * @property RefSurvaiAwal[] $refSurvaiAwals
 * @property TaRencanaTindak[] $taRencanaTindaks
 */
class RefSubUnsur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_sub_unsur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kd_unsur', 'kd_sub_unsur'], 'required'],
            [['kd_unsur', 'kd_sub_unsur'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['kd_unsur'], 'exist', 'skipOnError' => true, 'targetClass' => RefUnsur::className(), 'targetAttribute' => ['kd_unsur' => 'kd_unsur']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kd_unsur' => 'Kd Unsur',
            'kd_sub_unsur' => 'Kd Sub Unsur',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBobotSubUnsur()
    {
        return $this->hasOne(RefBobotSubUnsur::className(), ['sub_unsur_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUnsur()
    {
        return $this->hasOne(RefUnsur::className(), ['kd_unsur' => 'kd_unsur']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSubUnsurLevels()
    {
        return $this->hasMany(RefSubUnsurLevel::className(), ['sub_unsur_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSurvaiAwals()
    {
        return $this->hasMany(RefSurvaiAwal::className(), ['sub_unsur_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRencanaTindaks()
    {
        return $this->hasMany(TaRencanaTindak::className(), ['sub_unsur_id' => 'id']);
    }

    public function getTaRencanaTindak()
    {
        return $this->hasOne(TaRencanaTindak::className(), ['sub_unsur_id' => 'id']);
    }
}
