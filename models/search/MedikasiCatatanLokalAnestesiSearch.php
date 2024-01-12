<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\MedikasiCatatanLokalAnestesi;

/**
 * MedikasiCatatanLokalAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\MedikasiCatatanLokalAnestesi`.
 */
class MedikasiCatatanLokalAnestesiSearch extends MedikasiCatatanLokalAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mcl_id', 'mcl_cla_id', 'mcl_created_by', 'mcl_updated_by', 'mcl_deleted_by'], 'integer'],
            [['mcl_nama_obat', 'mcl_waktu', 'mcl_created_at', 'mcl_updated_at', 'mcl_deleted_at'], 'safe'],
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
        $query = MedikasiCatatanLokalAnestesi::find();

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
            'mcl_id' => $this->mcl_id,
            'mcl_cla_id' => $this->mcl_cla_id,
            'mcl_waktu' => $this->mcl_waktu,
            'mcl_created_at' => $this->mcl_created_at,
            'mcl_created_by' => $this->mcl_created_by,
            'mcl_updated_at' => $this->mcl_updated_at,
            'mcl_updated_by' => $this->mcl_updated_by,
            'mcl_deleted_at' => $this->mcl_deleted_at,
            'mcl_deleted_by' => $this->mcl_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'mcl_nama_obat', $this->mcl_nama_obat]);

        return $dataProvider;
    }
}
