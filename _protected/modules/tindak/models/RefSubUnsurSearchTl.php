<?php

namespace app\modules\tindak\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefSubUnsur;

/**
 * RefSubUnsurSearch represents the model behind the search form about `app\models\RefSubUnsur`.
 */
class RefSubUnsurSearchTl extends RefSubUnsur
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kd_unsur', 'kd_sub_unsur'], 'integer'],
            [['name'], 'safe'],
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
        $query = RefSubUnsur::find()
            ->joinWith('taRencanaTindak', true, 'LEFT JOIN')
            ->joinWith('taRencanaTindak.taTindakLanjuts', true, 'LEFT JOIN')
        ;

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
            'id' => $this->id,
            'kd_unsur' => $this->kd_unsur,
            'kd_sub_unsur' => $this->kd_sub_unsur,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
