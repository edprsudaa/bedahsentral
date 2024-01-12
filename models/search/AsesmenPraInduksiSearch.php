<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\AsesmenPraInduksi;

/**
 * AsesmenPraInduksiSearch represents the model behind the search form of `app\models\bedahsentral\AsesmenPraInduksi`.
 */
class AsesmenPraInduksiSearch extends AsesmenPraInduksi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['api_id', 'api_to_id', 'api_final', 'api_batal', 'api_mdcp_id', 'api_created_by', 'api_updated_by', 'api_deleted_by'], 'integer'],
            [['api_waktu', 'api_riwayat_anestesi', 'api_riwayat_merokok', 'api_alkoholic', 'api_riwayat_alergi', 'api_persiapan_transfusi', 'api_puasa', 'api_pvs_sens', 'api_pvs_td_sistole', 'api_pvs_td_diastole', 'api_pvs_nadi', 'api_pvs_rr', 'api_pvs_suhu', 'api_klasifikasi_asa', 'api_rencana_anestesi', 'api_rencana_pemulihan_pasca_anestesi', 'api_rencana_manajemen_nyeri', 'api_obat_premedikasi_nama', 'api_obat_premedikasi_dosis', 'api_obat_premedikasi_jam', 'api_obat_premedikasi_pelaksana', 'api_tgl_final', 'api_tgl_batal', 'api_created_at', 'api_updated_at', 'api_deleted_at'], 'safe'],
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
        $query = AsesmenPraInduksi::find();

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
            'api_id' => $this->api_id,
            'api_to_id' => $this->api_to_id,
            'api_waktu' => $this->api_waktu,
            'api_obat_premedikasi_jam' => $this->api_obat_premedikasi_jam,
            'api_final' => $this->api_final,
            'api_tgl_final' => $this->api_tgl_final,
            'api_batal' => $this->api_batal,
            'api_tgl_batal' => $this->api_tgl_batal,
            'api_mdcp_id' => $this->api_mdcp_id,
            'api_created_at' => $this->api_created_at,
            'api_created_by' => $this->api_created_by,
            'api_updated_at' => $this->api_updated_at,
            'api_updated_by' => $this->api_updated_by,
            'api_deleted_at' => $this->api_deleted_at,
            'api_deleted_by' => $this->api_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'api_riwayat_anestesi', $this->api_riwayat_anestesi])
            ->andFilterWhere(['ilike', 'api_riwayat_merokok', $this->api_riwayat_merokok])
            ->andFilterWhere(['ilike', 'api_alkoholic', $this->api_alkoholic])
            ->andFilterWhere(['ilike', 'api_riwayat_alergi', $this->api_riwayat_alergi])
            ->andFilterWhere(['ilike', 'api_persiapan_transfusi', $this->api_persiapan_transfusi])
            ->andFilterWhere(['ilike', 'api_puasa', $this->api_puasa])
            ->andFilterWhere(['ilike', 'api_pvs_sens', $this->api_pvs_sens])
            ->andFilterWhere(['ilike', 'api_pvs_td_sistole', $this->api_pvs_td_sistole])
            ->andFilterWhere(['ilike', 'api_pvs_td_diastole', $this->api_pvs_td_diastole])
            ->andFilterWhere(['ilike', 'api_pvs_nadi', $this->api_pvs_nadi])
            ->andFilterWhere(['ilike', 'api_pvs_rr', $this->api_pvs_rr])
            ->andFilterWhere(['ilike', 'api_pvs_suhu', $this->api_pvs_suhu])
            ->andFilterWhere(['ilike', 'api_klasifikasi_asa', $this->api_klasifikasi_asa])
            ->andFilterWhere(['ilike', 'api_rencana_anestesi', $this->api_rencana_anestesi])
            ->andFilterWhere(['ilike', 'api_rencana_pemulihan_pasca_anestesi', $this->api_rencana_pemulihan_pasca_anestesi])
            ->andFilterWhere(['ilike', 'api_rencana_manajemen_nyeri', $this->api_rencana_manajemen_nyeri])
            ->andFilterWhere(['ilike', 'api_obat_premedikasi_nama', $this->api_obat_premedikasi_nama])
            ->andFilterWhere(['ilike', 'api_obat_premedikasi_dosis', $this->api_obat_premedikasi_dosis])
            ->andFilterWhere(['ilike', 'api_obat_premedikasi_pelaksana', $this->api_obat_premedikasi_pelaksana]);

        return $dataProvider;
    }
}
