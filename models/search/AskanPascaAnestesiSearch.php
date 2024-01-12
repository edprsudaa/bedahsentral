<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\AskanPascaAnestesi;

/**
 * AskanPascaAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\AskanPascaAnestesi`.
 */
class AskanPascaAnestesiSearch extends AskanPascaAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pas_id', 'pas_to_id', 'pas_final', 'pas_batal', 'pas_created_by', 'pas_updated_by', 'pas_deleted_by'], 'integer'],
            [['pas_jam_masuk', 'pas_jam_keluar', 'pas_pernafasan', 'pas_pernafasan1', 'pas_pola_nafas', 'pas_spo2', 'pas_sirkulasi', 'pas_td', 'pas_nadi', 'pas_masalah_kesehatan', 'pas_intervensi', 'pas_implementasi', 'pas_evaluasi', 'pas_suhu', 'pas_tgl_final', 'pas_tgl_batal', 'pas_created_at', 'pas_updated_at', 'pas_deleted_at'], 'safe'],
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
        $query = AskanPascaAnestesi::find();

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
            'pas_id' => $this->pas_id,
            'pas_to_id' => $this->pas_to_id,
            'pas_jam_masuk' => $this->pas_jam_masuk,
            'pas_jam_keluar' => $this->pas_jam_keluar,
            'pas_final' => $this->pas_final,
            'pas_tgl_final' => $this->pas_tgl_final,
            'pas_batal' => $this->pas_batal,
            'pas_tgl_batal' => $this->pas_tgl_batal,
            'pas_created_at' => $this->pas_created_at,
            'pas_created_by' => $this->pas_created_by,
            'pas_updated_at' => $this->pas_updated_at,
            'pas_updated_by' => $this->pas_updated_by,
            'pas_deleted_at' => $this->pas_deleted_at,
            'pas_deleted_by' => $this->pas_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'pas_pernafasan', $this->pas_pernafasan])
            ->andFilterWhere(['ilike', 'pas_pernafasan1', $this->pas_pernafasan1])
            ->andFilterWhere(['ilike', 'pas_pola_nafas', $this->pas_pola_nafas])
            ->andFilterWhere(['ilike', 'pas_spo2', $this->pas_spo2])
            ->andFilterWhere(['ilike', 'pas_sirkulasi', $this->pas_sirkulasi])
            ->andFilterWhere(['ilike', 'pas_td', $this->pas_td])
            ->andFilterWhere(['ilike', 'pas_nadi', $this->pas_nadi])
            ->andFilterWhere(['ilike', 'pas_masalah_kesehatan', $this->pas_masalah_kesehatan])
            ->andFilterWhere(['ilike', 'pas_intervensi', $this->pas_intervensi])
            ->andFilterWhere(['ilike', 'pas_implementasi', $this->pas_implementasi])
            ->andFilterWhere(['ilike', 'pas_evaluasi', $this->pas_evaluasi])
            ->andFilterWhere(['ilike', 'pas_suhu', $this->pas_suhu]);

        return $dataProvider;
    }
}
