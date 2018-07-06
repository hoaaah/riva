<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_sub_unsur_level".
 *
 * @property int $id
 * @property string $kode
 * @property int $sub_unsur_id
 * @property string $parameter
 *
 * @property RefSubUnsur $subUnsur
 */
class RefSubUnsurLevel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_sub_unsur_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kode', 'parameter'], 'required'],
            [['id', 'sub_unsur_id'], 'integer'],
            [['parameter'], 'string'],
            [['kode'], 'string', 'max' => 50],
            [['kode'], 'unique'],
            [['id'], 'unique'],
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
            'kode' => 'Kode',
            'sub_unsur_id' => 'Sub Unsur ID',
            'parameter' => 'Parameter',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubUnsur()
    {
        return $this->hasOne(RefSubUnsur::className(), ['id' => 'sub_unsur_id']);
    }
}
