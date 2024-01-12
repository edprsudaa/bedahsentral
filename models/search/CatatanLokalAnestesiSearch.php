<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\CatatanLokalAnestesi;

/**
 * CatatanLokalAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\CatatanLokalAnestesi`.
 */
class CatatanLokalAnestesiSearch extends CatatanLokalAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cla_id', 'cla_to_id', 'cla_final', 'cla_batal', 'cla_created_by', 'cla_updated_by', 'cla_deleted_by'], 'integer'],
            [['cla_jam_mulai_operasi', 'cla_jam_akhir_operasi', 'cla_lama_operasi', 'cla_posisi_operasi', 'cla_tgl_final', 'cla_tgl_batal', 'cla_created_at', 'cla_updated_at', 'cla_deleted_at'], 'safe'],
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
        $query = CatatanLokalAnestesi::find();

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
            'cla_id' => $this->cla_id,
            'cla_to_id' => $this->cla_to_id,
            'cla_jam_mulai_operasi' => $this->cla_jam_mulai_operasi,
            'cla_jam_akhir_operasi' => $this->cla_jam_akhir_operasi,
            'cla_final' => $this->cla_final,
            'cla_tgl_final' => $this->cla_tgl_final,
            'cla_batal' => $this->cla_batal,
            'cla_tgl_batal' => $this->cla_tgl_batal,
            'cla_created_at' => $this->cla_created_at,
            'cla_created_by' => $this->cla_created_by,
            'cla_updated_at' => $this->cla_updated_at,
            'cla_updated_by' => $this->cla_updated_by,
            'cla_deleted_at' => $this->cla_deleted_at,
            'cla_deleted_by' => $this->cla_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'cla_lama_operasi', $this->cla_lama_operasi])
            ->andFilterWhere(['ilike', 'cla_posisi_operasi', $this->cla_posisi_operasi]);

        return $dataProvider;
    }
}
