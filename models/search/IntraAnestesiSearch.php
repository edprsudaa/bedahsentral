<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\IntraAnestesi;

/**
 * IntraAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\IntraAnestesi`.
 */
class IntraAnestesiSearch extends IntraAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mia_id', 'mia_to_id', 'mia_pra_anestesi_mia_id', 'mia_penata_anestesi_pgw_id', 'mia_dokter_anestesi_pgw_id', 'mia_preinduksi_api_id', 'mia_iso_flurane', 'mia_sevo_flurane', 'mia_oksigen', 'mia_air', 'mia_n20', 'mia_final', 'mia_batal', 'mia_mdcp_id', 'mia_created_by', 'mia_updated_by', 'mia_deleted_by'], 'integer'],
            [['mia_premedikasi', 'mia_jam', 'mia_jam_mulai_anestesi', 'mia_jam_mulai_operasi', 'mia_jam_berakhir_operasi', 'mia_jam_berakhir_anestesi', 'mia_posisi_operasi', 'mia_teknik_anestesi', 'mia_jalan_nafas', 'mia_pengaturan_nafas', 'mia_induksi', 'mia_ventilator_tidal_volume', 'mia_ventilator_rr', 'mia_ventilator_peep', 'mia_teknik_khusus', 'mia_komplikasi_anestesi', 'mia_tgl_final', 'mia_tgl_batal', 'mia_created_at', 'mia_updated_at', 'mia_deleted_at'], 'safe'],
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
        $query = IntraAnestesi::find();

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
            'mia_id' => $this->mia_id,
            'mia_to_id' => $this->mia_to_id,
            'mia_pra_anestesi_mia_id' => $this->mia_pra_anestesi_mia_id,
            'mia_penata_anestesi_pgw_id' => $this->mia_penata_anestesi_pgw_id,
            'mia_dokter_anestesi_pgw_id' => $this->mia_dokter_anestesi_pgw_id,
            'mia_preinduksi_api_id' => $this->mia_preinduksi_api_id,
            'mia_jam' => $this->mia_jam,
            'mia_jam_mulai_anestesi' => $this->mia_jam_mulai_anestesi,
            'mia_jam_mulai_operasi' => $this->mia_jam_mulai_operasi,
            'mia_jam_berakhir_operasi' => $this->mia_jam_berakhir_operasi,
            'mia_jam_berakhir_anestesi' => $this->mia_jam_berakhir_anestesi,
            'mia_iso_flurane' => $this->mia_iso_flurane,
            'mia_sevo_flurane' => $this->mia_sevo_flurane,
            'mia_oksigen' => $this->mia_oksigen,
            'mia_air' => $this->mia_air,
            'mia_n20' => $this->mia_n20,
            'mia_final' => $this->mia_final,
            'mia_tgl_final' => $this->mia_tgl_final,
            'mia_batal' => $this->mia_batal,
            'mia_tgl_batal' => $this->mia_tgl_batal,
            'mia_mdcp_id' => $this->mia_mdcp_id,
            'mia_created_at' => $this->mia_created_at,
            'mia_created_by' => $this->mia_created_by,
            'mia_updated_at' => $this->mia_updated_at,
            'mia_updated_by' => $this->mia_updated_by,
            'mia_deleted_at' => $this->mia_deleted_at,
            'mia_deleted_by' => $this->mia_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'mia_premedikasi', $this->mia_premedikasi])
            ->andFilterWhere(['ilike', 'mia_posisi_operasi', $this->mia_posisi_operasi])
            ->andFilterWhere(['ilike', 'mia_teknik_anestesi', $this->mia_teknik_anestesi])
            ->andFilterWhere(['ilike', 'mia_jalan_nafas', $this->mia_jalan_nafas])
            ->andFilterWhere(['ilike', 'mia_pengaturan_nafas', $this->mia_pengaturan_nafas])
            ->andFilterWhere(['ilike', 'mia_induksi', $this->mia_induksi])
            ->andFilterWhere(['ilike', 'mia_ventilator_tidal_volume', $this->mia_ventilator_tidal_volume])
            ->andFilterWhere(['ilike', 'mia_ventilator_rr', $this->mia_ventilator_rr])
            ->andFilterWhere(['ilike', 'mia_ventilator_peep', $this->mia_ventilator_peep])
            ->andFilterWhere(['ilike', 'mia_teknik_khusus', $this->mia_teknik_khusus])
            ->andFilterWhere(['ilike', 'mia_komplikasi_anestesi', $this->mia_komplikasi_anestesi]);

        return $dataProvider;
    }
}
