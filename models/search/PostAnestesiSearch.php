<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\PostAnestesi;

/**
 * PostAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\PostAnestesi`.
 */
class PostAnestesiSearch extends PostAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mpa_id', 'mpa_to_id', 'mpa_intra_anestesi_mpa_id', 'mpa_penata_anestesi_pgw_id', 'mpa_dokter_anestesi_pgw_id', 'mpa_skor_tools', 'mpa_final', 'mpa_batal', 'mpa_mdcp_id', 'mpa_created_by', 'mpa_updated_by', 'mpa_deleted_by'], 'integer'],
            [['mpa_jam_tiba_diruang_pemulihan', 'mpa_keluar_jam', 'mpa_jenis_tools_digunakan', 'mpa_instruksi_awasi', 'mpa_instruksi_posisi', 'mpa_instruksi_makan_minum', 'mpa_instruksi_infus', 'mpa_instruksi_transfusi', 'mpa_instruksi_program_analgetik', 'mpa_instruksi_program_mual_muntah', 'mpa_instruksi_lain_lain', 'mpa_tgl_final', 'mpa_tgl_batal', 'mpa_created_at', 'mpa_updated_at', 'mpa_deleted_at'], 'safe'],
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
        $query = PostAnestesi::find();

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
            'mpa_id' => $this->mpa_id,
            'mpa_to_id' => $this->mpa_to_id,
            'mpa_intra_anestesi_mpa_id' => $this->mpa_intra_anestesi_mpa_id,
            'mpa_penata_anestesi_pgw_id' => $this->mpa_penata_anestesi_pgw_id,
            'mpa_dokter_anestesi_pgw_id' => $this->mpa_dokter_anestesi_pgw_id,
            'mpa_jam_tiba_diruang_pemulihan' => $this->mpa_jam_tiba_diruang_pemulihan,
            'mpa_keluar_jam' => $this->mpa_keluar_jam,
            'mpa_skor_tools' => $this->mpa_skor_tools,
            'mpa_final' => $this->mpa_final,
            'mpa_tgl_final' => $this->mpa_tgl_final,
            'mpa_batal' => $this->mpa_batal,
            'mpa_tgl_batal' => $this->mpa_tgl_batal,
            'mpa_mdcp_id' => $this->mpa_mdcp_id,
            'mpa_created_at' => $this->mpa_created_at,
            'mpa_created_by' => $this->mpa_created_by,
            'mpa_updated_at' => $this->mpa_updated_at,
            'mpa_updated_by' => $this->mpa_updated_by,
            'mpa_deleted_at' => $this->mpa_deleted_at,
            'mpa_deleted_by' => $this->mpa_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'mpa_jenis_tools_digunakan', $this->mpa_jenis_tools_digunakan])
            ->andFilterWhere(['ilike', 'mpa_instruksi_awasi', $this->mpa_instruksi_awasi])
            ->andFilterWhere(['ilike', 'mpa_instruksi_posisi', $this->mpa_instruksi_posisi])
            ->andFilterWhere(['ilike', 'mpa_instruksi_makan_minum', $this->mpa_instruksi_makan_minum])
            ->andFilterWhere(['ilike', 'mpa_instruksi_infus', $this->mpa_instruksi_infus])
            ->andFilterWhere(['ilike', 'mpa_instruksi_transfusi', $this->mpa_instruksi_transfusi])
            ->andFilterWhere(['ilike', 'mpa_instruksi_program_analgetik', $this->mpa_instruksi_program_analgetik])
            ->andFilterWhere(['ilike', 'mpa_instruksi_program_mual_muntah', $this->mpa_instruksi_program_mual_muntah])
            ->andFilterWhere(['ilike', 'mpa_instruksi_lain_lain', $this->mpa_instruksi_lain_lain]);

        return $dataProvider;
    }
}
