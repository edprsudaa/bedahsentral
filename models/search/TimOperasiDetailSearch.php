<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\TimOperasiDetail;

/**
 * TimOperasiDetailSearch represents the model behind the search form of `app\models\bedahsentral\TimOperasiDetail`.
 */
class TimOperasiDetailSearch extends TimOperasiDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tod_id', 'tod_to_id', 'tod_jo_id', 'tod_pgw_id'], 'integer'],
            [['tod_created_at', 'tod_created_by', 'tod_updated_at', 'tod_updated_by', 'tod_deleted_at', 'tod_deleted_by'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = TimOperasiDetail::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tod_id' => $this->tod_id,
            'tod_to_id' => $this->tod_to_id,
            'tod_jo_id' => $this->tod_jo_id,
            'tod_pgw_id' => $this->tod_pgw_id,
            'tod_created_at' => $this->tod_created_at,
            'tod_updated_at' => $this->tod_updated_at,
            'tod_deleted_at' => $this->tod_deleted_at,
        ]);

        $query->andFilterWhere(['ilike', 'tod_created_by', $this->tod_created_by])
            ->andFilterWhere(['ilike', 'tod_updated_by', $this->tod_updated_by])
            ->andFilterWhere(['ilike', 'tod_deleted_by', $this->tod_deleted_by]);

        return $dataProvider;
    }
}
