<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ref_bobot_sub_unsur".
 *
 * @property int $sub_unsur_id
 * @property string $bobot
 *
 * @property RefSubUnsur $subUnsur
 */
class RefBobotSubUnsur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ref_bobot_sub_unsur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_unsur_id', 'bobot'], 'required'],
            [['sub_unsur_id'], 'integer'],
            [['bobot'], 'number'],
            [['sub_unsur_id'], 'unique'],
            [['sub_unsur_id'], 'exist', 'skipOnError' => true, 'targetClass' => RefSubUnsur::className(), 'targetAttribute' => ['sub_unsur_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sub_unsur_id' => 'Sub Unsur ID',
            'bobot' => 'Bobot',
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
