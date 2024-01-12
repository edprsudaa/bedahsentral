<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\AsesmenAwalMedis;

/**
 * PasienAsesmenAwalMedisSearch represents the model behind the search form of `app\models\medis\AsesmenAwalMedis`.
 */
class PasienAsesmenAwalMedisSearch extends AsesmenAwalMedis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pjp_id', 'gcs_e', 'gcs_m', 'gcs_v', 'suhu', 'sato2', 'berat_badan', 'tinggi_badan', 'batal', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['anamnesis_sumber', 'anamnesis_keluhan', 'riwayat_penyakit_sekarang', 'riwayat_penyakit_dahulu', 'riwayat_pemakaian_obat', 'riwayat_penyakit_keluarga', 'alergi', 'status_sosial', 'ekonomi', 'imunisasi', 'status_psikologi', 'status_mental', 'riwayat_perilaku_kekerasan', 'ketergantungan_obat', 'ketergantungan_alkohol', 'permintaan_informasi', 'tingkat_kesadaran', 'nadi', 'darah', 'pernapasan', 'keadaan_gizi', 'keadaan_umum', 'kepala', 'mata', 'mulut', 'leher', 'jantung', 'paru', 'hati', 'abdomen', 'ginjal_kemih', 'anus', 'ektremitas', 'status_lokalis', 'pemeriksaan_penunjang', 'masalah', 'penatalaksanaan', 'pemeriksaan_ulang', 'status_keluar', 'keterangan_keluar', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
        $query = AsesmenAwalMedis::find();

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
            'gcs_e' => $this->gcs_e,
            'gcs_m' => $this->gcs_m,
            'gcs_v' => $this->gcs_v,
            'suhu' => $this->suhu,
            'sato2' => $this->sato2,
            'berat_badan' => $this->berat_badan,
            'tinggi_badan' => $this->tinggi_badan,
            'batal' => $this->batal,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['ilike', 'anamnesis_sumber', $this->anamnesis_sumber])
            ->andFilterWhere(['ilike', 'anamnesis_keluhan', $this->anamnesis_keluhan])
            ->andFilterWhere(['ilike', 'riwayat_penyakit_sekarang', $this->riwayat_penyakit_sekarang])
            ->andFilterWhere(['ilike', 'riwayat_penyakit_dahulu', $this->riwayat_penyakit_dahulu])
            ->andFilterWhere(['ilike', 'riwayat_pemakaian_obat', $this->riwayat_pemakaian_obat])
            ->andFilterWhere(['ilike', 'riwayat_penyakit_keluarga', $this->riwayat_penyakit_keluarga])
            ->andFilterWhere(['ilike', 'alergi', $this->alergi])
            ->andFilterWhere(['ilike', 'status_sosial', $this->status_sosial])
            ->andFilterWhere(['ilike', 'ekonomi', $this->ekonomi])
            ->andFilterWhere(['ilike', 'imunisasi', $this->imunisasi])
            ->andFilterWhere(['ilike', 'status_psikologi', $this->status_psikologi])
            ->andFilterWhere(['ilike', 'status_mental', $this->status_mental])
            ->andFilterWhere(['ilike', 'riwayat_perilaku_kekerasan', $this->riwayat_perilaku_kekerasan])
            ->andFilterWhere(['ilike', 'ketergantungan_obat', $this->ketergantungan_obat])
            ->andFilterWhere(['ilike', 'ketergantungan_alkohol', $this->ketergantungan_alkohol])
            ->andFilterWhere(['ilike', 'permintaan_informasi', $this->permintaan_informasi])
            ->andFilterWhere(['ilike', 'tingkat_kesadaran', $this->tingkat_kesadaran])
            ->andFilterWhere(['ilike', 'nadi', $this->nadi])
            ->andFilterWhere(['ilike', 'darah', $this->darah])
            ->andFilterWhere(['ilike', 'pernapasan', $this->pernapasan])
            ->andFilterWhere(['ilike', 'keadaan_gizi', $this->keadaan_gizi])
            ->andFilterWhere(['ilike', 'keadaan_umum', $this->keadaan_umum])
            ->andFilterWhere(['ilike', 'kepala', $this->kepala])
            ->andFilterWhere(['ilike', 'mata', $this->mata])
            ->andFilterWhere(['ilike', 'mulut', $this->mulut])
            ->andFilterWhere(['ilike', 'leher', $this->leher])
            ->andFilterWhere(['ilike', 'jantung', $this->jantung])
            ->andFilterWhere(['ilike', 'paru', $this->paru])
            ->andFilterWhere(['ilike', 'hati', $this->hati])
            ->andFilterWhere(['ilike', 'abdomen', $this->abdomen])
            ->andFilterWhere(['ilike', 'ginjal_kemih', $this->ginjal_kemih])
            ->andFilterWhere(['ilike', 'anus', $this->anus])
            ->andFilterWhere(['ilike', 'ektremitas', $this->ektremitas])
            ->andFilterWhere(['ilike', 'status_lokalis', $this->status_lokalis])
            ->andFilterWhere(['ilike', 'pemeriksaan_penunjang', $this->pemeriksaan_penunjang])
            ->andFilterWhere(['ilike', 'masalah', $this->masalah])
            ->andFilterWhere(['ilike', 'penatalaksanaan', $this->penatalaksanaan])
            ->andFilterWhere(['ilike', 'pemeriksaan_ulang', $this->pemeriksaan_ulang])
            ->andFilterWhere(['ilike', 'status_keluar', $this->status_keluar])
            ->andFilterWhere(['ilike', 'keterangan_keluar', $this->keterangan_keluar])
            ->andFilterWhere(['ilike', 'log_data', $this->log_data]);

        return $dataProvider;
    }
}
