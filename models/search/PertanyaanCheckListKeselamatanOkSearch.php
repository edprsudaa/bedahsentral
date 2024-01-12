<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\PertanyaanCheckListKeselamatanOk;

/**
 * PertanyaanCheckListKeselamatanOkSearch represents the model behind the search form of `app\models\bedahsentral\PertanyaanCheckListKeselamatanOk`.
 */
class PertanyaanCheckListKeselamatanOkSearch extends PertanyaanCheckListKeselamatanOk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pcok_id', 'pcok_to_id', 'pcok_final', 'pcok_batal', 'pcok_mdcp_id', 'pcok_created_by', 'pcok_updated_by', 'pcok_deleted_by'], 'integer'],
            [['pcok_si_pertanyaan1', 'pcok_si_pertanyaan2', 'pcok_si_pertanyaan3', 'pcok_si_pertanyaan4', 'pcok_si_pertanyaan5', 'pcok_si_pertanyaan6', 'pcok_si_pertanyaan7', 'pcok_to_pertanyaan1', 'pcok_to_pertanyaan2', 'pcok_to_pertanyaan3', 'pcok_to_pertanyaan4', 'pcok_to_pertanyaan5', 'pcok_to_pertanyaan6', 'pcok_to_pertanyaan7', 'pcok_to_pertanyaan8', 'pcok_to_pertanyaan9', 'pcok_to_pertanyaan10', 'pcok_so_pertanyaan1', 'pcok_so_pertanyaan2', 'pcok_so_pertanyaan3', 'pcok_so_pertanyaan4', 'pcok_so_pertanyaan5', 'pcok_tgl_final', 'pcok_tgl_batal', 'pcok_created_at', 'pcok_updated_at', 'pcok_deleted_at'], 'safe'],
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
        $query = PertanyaanCheckListKeselamatanOk::find();

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
            'pcok_id' => $this->pcok_id,
            'pcok_to_id' => $this->pcok_to_id,
            'pcok_final' => $this->pcok_final,
            'pcok_tgl_final' => $this->pcok_tgl_final,
            'pcok_batal' => $this->pcok_batal,
            'pcok_tgl_batal' => $this->pcok_tgl_batal,
            'pcok_mdcp_id' => $this->pcok_mdcp_id,
            'pcok_created_at' => $this->pcok_created_at,
            'pcok_created_by' => $this->pcok_created_by,
            'pcok_updated_at' => $this->pcok_updated_at,
            'pcok_updated_by' => $this->pcok_updated_by,
            'pcok_deleted_at' => $this->pcok_deleted_at,
            'pcok_deleted_by' => $this->pcok_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'pcok_si_pertanyaan1', $this->pcok_si_pertanyaan1])
            ->andFilterWhere(['ilike', 'pcok_si_pertanyaan2', $this->pcok_si_pertanyaan2])
            ->andFilterWhere(['ilike', 'pcok_si_pertanyaan3', $this->pcok_si_pertanyaan3])
            ->andFilterWhere(['ilike', 'pcok_si_pertanyaan4', $this->pcok_si_pertanyaan4])
            ->andFilterWhere(['ilike', 'pcok_si_pertanyaan5', $this->pcok_si_pertanyaan5])
            ->andFilterWhere(['ilike', 'pcok_si_pertanyaan6', $this->pcok_si_pertanyaan6])
            ->andFilterWhere(['ilike', 'pcok_si_pertanyaan7', $this->pcok_si_pertanyaan7])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan1', $this->pcok_to_pertanyaan1])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan2', $this->pcok_to_pertanyaan2])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan3', $this->pcok_to_pertanyaan3])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan4', $this->pcok_to_pertanyaan4])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan5', $this->pcok_to_pertanyaan5])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan6', $this->pcok_to_pertanyaan6])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan7', $this->pcok_to_pertanyaan7])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan8', $this->pcok_to_pertanyaan8])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan9', $this->pcok_to_pertanyaan9])
            ->andFilterWhere(['ilike', 'pcok_to_pertanyaan10', $this->pcok_to_pertanyaan10])
            ->andFilterWhere(['ilike', 'pcok_so_pertanyaan1', $this->pcok_so_pertanyaan1])
            ->andFilterWhere(['ilike', 'pcok_so_pertanyaan2', $this->pcok_so_pertanyaan2])
            ->andFilterWhere(['ilike', 'pcok_so_pertanyaan3', $this->pcok_so_pertanyaan3])
            ->andFilterWhere(['ilike', 'pcok_so_pertanyaan4', $this->pcok_so_pertanyaan4])
            ->andFilterWhere(['ilike', 'pcok_so_pertanyaan5', $this->pcok_so_pertanyaan5]);

        return $dataProvider;
    }
}
