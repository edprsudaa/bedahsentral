<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\TtvPostAnestesi;

/**
 * TtvPostAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\TtvPostAnestesi`.
 */
class TtvPostAnestesiSearch extends TtvPostAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ttvp_id', 'ttvp_post_anestesi_mpa_id', 'ttvp_tek_darah_sistole', 'ttvp_tek_darah_diastole', 'ttvp_nadi', 'ttvp_created_by', 'ttvp_updated_by', 'ttvp_deleted_by'], 'integer'],
            [['ttvp_nyeri_metode', 'ttvp_nyeri_skor', 'ttvp_waktu', 'ttvp_created_at', 'ttvp_updated_at', 'ttvp_deleted_at'], 'safe'],
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
        $query = TtvPostAnestesi::find();

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
            'ttvp_id' => $this->ttvp_id,
            'ttvp_post_anestesi_mpa_id' => $this->ttvp_post_anestesi_mpa_id,
            'ttvp_tek_darah_sistole' => $this->ttvp_tek_darah_sistole,
            'ttvp_tek_darah_diastole' => $this->ttvp_tek_darah_diastole,
            'ttvp_nadi' => $this->ttvp_nadi,
            'ttvp_waktu' => $this->ttvp_waktu,
            'ttvp_created_at' => $this->ttvp_created_at,
            'ttvp_created_by' => $this->ttvp_created_by,
            'ttvp_updated_at' => $this->ttvp_updated_at,
            'ttvp_updated_by' => $this->ttvp_updated_by,
            'ttvp_deleted_at' => $this->ttvp_deleted_at,
            'ttvp_deleted_by' => $this->ttvp_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'ttvp_nyeri_metode', $this->ttvp_nyeri_metode])
            ->andFilterWhere(['ilike', 'ttvp_nyeri_skor', $this->ttvp_nyeri_skor]);

        return $dataProvider;
    }
}
