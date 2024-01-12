<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\PascaLokalAnestesi;

/**
 * PascaLokalAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\PascaLokalAnestesi`.
 */
class PascaLokalAnestesiSearch extends PascaLokalAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pla_id', 'pla_to_id', 'pla_skor_tools', 'pla_final', 'pla_batal', 'pla_mdcp_id', 'pla_created_by', 'pla_updated_by', 'pla_deleted_by'], 'integer'],
            [['pla_jam_tiba_diruang_pemulihan', 'pla_keluar_jam', 'pla_jenis_tools_digunakan', 'pla_catatan', 'pla_tgl_final', 'pla_tgl_batal', 'pla_created_at', 'pla_updated_at', 'pla_deleted_at'], 'safe'],
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
        $query = PascaLokalAnestesi::find();

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
            'pla_id' => $this->pla_id,
            'pla_to_id' => $this->pla_to_id,
            'pla_jam_tiba_diruang_pemulihan' => $this->pla_jam_tiba_diruang_pemulihan,
            'pla_keluar_jam' => $this->pla_keluar_jam,
            'pla_skor_tools' => $this->pla_skor_tools,
            'pla_final' => $this->pla_final,
            'pla_tgl_final' => $this->pla_tgl_final,
            'pla_batal' => $this->pla_batal,
            'pla_tgl_batal' => $this->pla_tgl_batal,
            'pla_mdcp_id' => $this->pla_mdcp_id,
            'pla_created_at' => $this->pla_created_at,
            'pla_created_by' => $this->pla_created_by,
            'pla_updated_at' => $this->pla_updated_at,
            'pla_updated_by' => $this->pla_updated_by,
            'pla_deleted_at' => $this->pla_deleted_at,
            'pla_deleted_by' => $this->pla_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'pla_jenis_tools_digunakan', $this->pla_jenis_tools_digunakan])
            ->andFilterWhere(['ilike', 'pla_catatan', $this->pla_catatan]);

        return $dataProvider;
    }
}
