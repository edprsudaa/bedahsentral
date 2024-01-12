<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\TtvIntraAnestesi;

/**
 * TtvIntraAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\TtvIntraAnestesi`.
 */
class TtvIntraAnestesiSearch extends TtvIntraAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ttva_id', 'ttva_intra_operasi_mia_id', 'ttva_nadi', 'ttva_pernafasan', 'ttva_tek_darah_sistole', 'ttva_tek_darah_diastole', 'ttva_created_by', 'ttva_updated_by', 'ttva_deleted_by'], 'integer'],
            [['ttva_waktu', 'ttva_created_at', 'ttva_updated_at', 'ttva_deleted_at'], 'safe'],
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
        $query = TtvIntraAnestesi::find();

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
            'ttva_id' => $this->ttva_id,
            'ttva_intra_operasi_mia_id' => $this->ttva_intra_operasi_mia_id,
            'ttva_nadi' => $this->ttva_nadi,
            'ttva_pernafasan' => $this->ttva_pernafasan,
            'ttva_tek_darah_sistole' => $this->ttva_tek_darah_sistole,
            'ttva_tek_darah_diastole' => $this->ttva_tek_darah_diastole,
            'ttva_waktu' => $this->ttva_waktu,
            'ttva_created_at' => $this->ttva_created_at,
            'ttva_created_by' => $this->ttva_created_by,
            'ttva_updated_at' => $this->ttva_updated_at,
            'ttva_updated_by' => $this->ttva_updated_by,
            'ttva_deleted_at' => $this->ttva_deleted_at,
            'ttva_deleted_by' => $this->ttva_deleted_by,
        ]);

        return $dataProvider;
    }
}
