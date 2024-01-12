<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\ResumeMedisRi;

/**
 * PasienResumeMedisRiSearch represents the model behind the search form of `app\models\medis\ResumeMedisRi`.
 */
class PasienResumeMedisRiSearch extends ResumeMedisRi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pjp_id', 'diagnosa_masuk_id', 'diagnosa_utama_id', 'diagnosa_tambahan1_id', 'diagnosa_tambahan2_id', 'diagnosa_tambahan3_id', 'diagnosa_tambahan4_id', 'diagnosa_tambahan5_id', 'diagnosa_tambahan6_id', 'tindakan_utama_id', 'tindakan_tambahan1_id', 'tindakan_tambahan2_id', 'tindakan_tambahan3_id', 'tindakan_tambahan4_id', 'tindakan_tambahan5_id', 'tindakan_tambahan6_id', 'gcs_e', 'gcs_m', 'gcs_v', 'suhu', 'sato2', 'berat_badan', 'tinggi_badan', 'batal', 'draf', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['ringkasan_riwayat_penyakit', 'hasil_pemeriksaan_fisik', 'indikasi_rawat_inap', 'diagnosa_masuk_kode', 'diagnosa_masuk_deskripsi', 'diagnosa_utama_kode', 'diagnosa_utama_deskripsi', 'diagnosa_tambahan1_kode', 'diagnosa_tambahan1_deskripsi', 'diagnosa_tambahan2_kode', 'diagnosa_tambahan2_deskripsi', 'diagnosa_tambahan3_kode', 'diagnosa_tambahan3_deskripsi', 'diagnosa_tambahan4_kode', 'diagnosa_tambahan4_deskripsi', 'diagnosa_tambahan5_kode', 'diagnosa_tambahan5_deskripsi', 'diagnosa_tambahan6_kode', 'diagnosa_tambahan6_deskripsi', 'tindakan_utama_kode', 'tindakan_utama_deskripsi', 'tindakan_tambahan1_kode', 'tindakan_tambahan1_deskripsi', 'tindakan_tambahan2_kode', 'tindakan_tambahan2_deskripsi', 'tindakan_tambahan3_kode', 'tindakan_tambahan3_deskripsi', 'tindakan_tambahan4_kode', 'tindakan_tambahan4_deskripsi', 'tindakan_tambahan5_kode', 'tindakan_tambahan5_deskripsi', 'tindakan_tambahan6_kode', 'tindakan_tambahan6_deskripsi', 'alergi', 'diet', 'alasan_pulang', 'kondisi_pulang', 'cara_pulang', 'tingkat_kesadaran', 'nadi', 'darah', 'pernapasan', 'keadaan_gizi', 'keadaan_umum', 'terapi_perawatan', 'obat_rumah', 'terapi_pulang', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
        $query = ResumeMedisRi::find();

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
            'id' => $this->id,
            'pjp_id' => $this->pjp_id,
            'diagnosa_masuk_id' => $this->diagnosa_masuk_id,
            'diagnosa_utama_id' => $this->diagnosa_utama_id,
            'diagnosa_tambahan1_id' => $this->diagnosa_tambahan1_id,
            'diagnosa_tambahan2_id' => $this->diagnosa_tambahan2_id,
            'diagnosa_tambahan3_id' => $this->diagnosa_tambahan3_id,
            'diagnosa_tambahan4_id' => $this->diagnosa_tambahan4_id,
            'diagnosa_tambahan5_id' => $this->diagnosa_tambahan5_id,
            'diagnosa_tambahan6_id' => $this->diagnosa_tambahan6_id,
            'tindakan_utama_id' => $this->tindakan_utama_id,
            'tindakan_tambahan1_id' => $this->tindakan_tambahan1_id,
            'tindakan_tambahan2_id' => $this->tindakan_tambahan2_id,
            'tindakan_tambahan3_id' => $this->tindakan_tambahan3_id,
            'tindakan_tambahan4_id' => $this->tindakan_tambahan4_id,
            'tindakan_tambahan5_id' => $this->tindakan_tambahan5_id,
            'tindakan_tambahan6_id' => $this->tindakan_tambahan6_id,
            'gcs_e' => $this->gcs_e,
            'gcs_m' => $this->gcs_m,
            'gcs_v' => $this->gcs_v,
            'suhu' => $this->suhu,
            'sato2' => $this->sato2,
            'berat_badan' => $this->berat_badan,
            'tinggi_badan' => $this->tinggi_badan,
            'batal' => $this->batal,
            'draf' => $this->draf,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['ilike', 'ringkasan_riwayat_penyakit', $this->ringkasan_riwayat_penyakit])
            ->andFilterWhere(['ilike', 'hasil_pemeriksaan_fisik', $this->hasil_pemeriksaan_fisik])
            ->andFilterWhere(['ilike', 'indikasi_rawat_inap', $this->indikasi_rawat_inap])
            ->andFilterWhere(['ilike', 'diagnosa_masuk_kode', $this->diagnosa_masuk_kode])
            ->andFilterWhere(['ilike', 'diagnosa_masuk_deskripsi', $this->diagnosa_masuk_deskripsi])
            ->andFilterWhere(['ilike', 'diagnosa_utama_kode', $this->diagnosa_utama_kode])
            ->andFilterWhere(['ilike', 'diagnosa_utama_deskripsi', $this->diagnosa_utama_deskripsi])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan1_kode', $this->diagnosa_tambahan1_kode])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan1_deskripsi', $this->diagnosa_tambahan1_deskripsi])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan2_kode', $this->diagnosa_tambahan2_kode])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan2_deskripsi', $this->diagnosa_tambahan2_deskripsi])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan3_kode', $this->diagnosa_tambahan3_kode])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan3_deskripsi', $this->diagnosa_tambahan3_deskripsi])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan4_kode', $this->diagnosa_tambahan4_kode])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan4_deskripsi', $this->diagnosa_tambahan4_deskripsi])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan5_kode', $this->diagnosa_tambahan5_kode])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan5_deskripsi', $this->diagnosa_tambahan5_deskripsi])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan6_kode', $this->diagnosa_tambahan6_kode])
            ->andFilterWhere(['ilike', 'diagnosa_tambahan6_deskripsi', $this->diagnosa_tambahan6_deskripsi])
            ->andFilterWhere(['ilike', 'tindakan_utama_kode', $this->tindakan_utama_kode])
            ->andFilterWhere(['ilike', 'tindakan_utama_deskripsi', $this->tindakan_utama_deskripsi])
            ->andFilterWhere(['ilike', 'tindakan_tambahan1_kode', $this->tindakan_tambahan1_kode])
            ->andFilterWhere(['ilike', 'tindakan_tambahan1_deskripsi', $this->tindakan_tambahan1_deskripsi])
            ->andFilterWhere(['ilike', 'tindakan_tambahan2_kode', $this->tindakan_tambahan2_kode])
            ->andFilterWhere(['ilike', 'tindakan_tambahan2_deskripsi', $this->tindakan_tambahan2_deskripsi])
            ->andFilterWhere(['ilike', 'tindakan_tambahan3_kode', $this->tindakan_tambahan3_kode])
            ->andFilterWhere(['ilike', 'tindakan_tambahan3_deskripsi', $this->tindakan_tambahan3_deskripsi])
            ->andFilterWhere(['ilike', 'tindakan_tambahan4_kode', $this->tindakan_tambahan4_kode])
            ->andFilterWhere(['ilike', 'tindakan_tambahan4_deskripsi', $this->tindakan_tambahan4_deskripsi])
            ->andFilterWhere(['ilike', 'tindakan_tambahan5_kode', $this->tindakan_tambahan5_kode])
            ->andFilterWhere(['ilike', 'tindakan_tambahan5_deskripsi', $this->tindakan_tambahan5_deskripsi])
            ->andFilterWhere(['ilike', 'tindakan_tambahan6_kode', $this->tindakan_tambahan6_kode])
            ->andFilterWhere(['ilike', 'tindakan_tambahan6_deskripsi', $this->tindakan_tambahan6_deskripsi])
            ->andFilterWhere(['ilike', 'alergi', $this->alergi])
            ->andFilterWhere(['ilike', 'diet', $this->diet])
            ->andFilterWhere(['ilike', 'alasan_pulang', $this->alasan_pulang])
            ->andFilterWhere(['ilike', 'kondisi_pulang', $this->kondisi_pulang])
            ->andFilterWhere(['ilike', 'cara_pulang', $this->cara_pulang])
            ->andFilterWhere(['ilike', 'tingkat_kesadaran', $this->tingkat_kesadaran])
            ->andFilterWhere(['ilike', 'nadi', $this->nadi])
            ->andFilterWhere(['ilike', 'darah', $this->darah])
            ->andFilterWhere(['ilike', 'pernapasan', $this->pernapasan])
            ->andFilterWhere(['ilike', 'keadaan_gizi', $this->keadaan_gizi])
            ->andFilterWhere(['ilike', 'keadaan_umum', $this->keadaan_umum])
            ->andFilterWhere(['ilike', 'terapi_perawatan', $this->terapi_perawatan])
            ->andFilterWhere(['ilike', 'obat_rumah', $this->obat_rumah])
            ->andFilterWhere(['ilike', 'terapi_pulang', $this->terapi_pulang])
            ->andFilterWhere(['ilike', 'log_data', $this->log_data]);

        return $dataProvider;
    }
}
