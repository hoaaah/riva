<?php

namespace app\modules\parameter\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefBobotSubUnsur;

/**
 * RefBobotSubUnsurSearch represents the model behind the search form about `app\models\RefBobotSubUnsur`.
 */
class RefBobotSubUnsurSearch extends RefBobotSubUnsur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sub_unsur_id'], 'integer'],
            [['bobot'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RefBobotSubUnsur::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'sub_unsur_id' => $this->sub_unsur_id,
            'bobot' => $this->bobot,
        ]);

        return $dataProvider;
    }
}
