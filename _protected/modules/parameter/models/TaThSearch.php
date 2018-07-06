<?php

namespace app\modules\parameter\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaTh;

/**
 * TaThSearch represents the model behind the search form about `app\models\TaTh`.
 */
class TaThSearch extends TaTh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'nama_pemda', 'image_name', 'saved_image'], 'safe'],
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
        $query = TaTh::find();

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
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'nama_pemda', $this->nama_pemda])
            ->andFilterWhere(['like', 'image_name', $this->image_name])
            ->andFilterWhere(['like', 'saved_image', $this->saved_image]);

        return $dataProvider;
    }
}
