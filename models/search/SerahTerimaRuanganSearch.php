<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\SerahTerimaRuangan;

/**
 * SerahTerimaRuanganSearch represents the model behind the search form of `app\models\bedahsentral\SerahTerimaRuangan`.
 */
class SerahTerimaRuanganSearch extends SerahTerimaRuangan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mstr_id', 'mstr_pl_id', 'mstr_dpjp1_pgw_id', 'mstr_dpjp2_pgw_id', 'mstr_dpjp3_pgw_id', 'mstr_dpjp4_pgw_id', 'mstr_perawat_menyerahkan_pgw_id', 'mstr_perawat_penerima_pgw_id', 'mstr_nyeri_skor', 'mstr_final', 'mstr_batal', 'mstr_mdcp_id', 'mstr_created_by', 'mstr_updated_by', 'mstr_deleted_by'], 'integer'],
            [['mstr_tgl_masuk_ruangan', 'mstr_ruangan_asal', 'mstr_pindah_keruangan', 'mstr_diagnosis_sekarang', 'mstr_alat_transfer_pasien', 'mstr_keadaan_umum', 'mstr_tekanan_darah_sistole', 'mstr_tekanan_darah_diastole', 'mstr_suhu', 'mstr_nadi', 'mstr_pernafasan', 'mstr_tingkat_kesadaran', 'mstr_gcs_e', 'mstr_gcs_m', 'mstr_gcs_v', 'mstr_penggunaan_o2', 'mstr_penggunaan_o2_via', 'mstr_nyeri_penyebab', 'mstr_nyeri_hal_memperburuk', 'mstr_nyeri_hal_memperingan', 'mstr_nyeri_kualitas', 'mstr_nyeri_lokasi', 'mstr_nyeri_penjalaran', 'mstr_nyeri_kategori', 'mstr_nyeri_metode', 'mstr_nyeri_lama', 'mstr_nyeri_frekuensi', 'mstr_resiko_jatuh_skor', 'mstr_resiko_jatuh_kategori', 'mstr_resiko_jatuh_metode', 'mstr_resiko_jatuh_langkah_pencegahan', 'mstr_dekubitus', 'mstr_diet', 'mstr_mobilisasi', 'mstr_ambulasi', 'mstr_obat_oral', 'mstr_ivyd', 'mstr_obat_injeksi', 'mstr_amp_iv_catch_no', 'mstr_amp_iv_catch_tgl_pasang', 'mstr_ngt_ogt_no', 'mstr_ngt_ogt_tgl_pasang', 'mstr_catheter_no', 'mstr_catheter_tgl_pasang', 'mstr_tindakan_medis_yg_sudah_dilakukan', 'mstr_tindakan_keperawatan_yg_sudah_dilakukan', 'mstr_pemeriksaan_diagnosis_yg_sudah_dilakukan', 'mstr_hal_yg_diperhatikan_dan_dokumen', 'mstr_tgl_final', 'mstr_tgl_batal', 'mstr_created_at', 'mstr_updated_at', 'mstr_deleted_at'], 'safe'],
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
        $query = SerahTerimaRuangan::find();

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
            'mstr_id' => $this->mstr_id,
            'mstr_pl_id' => $this->mstr_pl_id,
            'mstr_dpjp1_pgw_id' => $this->mstr_dpjp1_pgw_id,
            'mstr_dpjp2_pgw_id' => $this->mstr_dpjp2_pgw_id,
            'mstr_dpjp3_pgw_id' => $this->mstr_dpjp3_pgw_id,
            'mstr_dpjp4_pgw_id' => $this->mstr_dpjp4_pgw_id,
            'mstr_perawat_menyerahkan_pgw_id' => $this->mstr_perawat_menyerahkan_pgw_id,
            'mstr_perawat_penerima_pgw_id' => $this->mstr_perawat_penerima_pgw_id,
            'mstr_tgl_masuk_ruangan' => $this->mstr_tgl_masuk_ruangan,
            'mstr_nyeri_skor' => $this->mstr_nyeri_skor,
            'mstr_amp_iv_catch_tgl_pasang' => $this->mstr_amp_iv_catch_tgl_pasang,
            'mstr_ngt_ogt_tgl_pasang' => $this->mstr_ngt_ogt_tgl_pasang,
            'mstr_catheter_tgl_pasang' => $this->mstr_catheter_tgl_pasang,
            'mstr_final' => $this->mstr_final,
            'mstr_tgl_final' => $this->mstr_tgl_final,
            'mstr_batal' => $this->mstr_batal,
            'mstr_tgl_batal' => $this->mstr_tgl_batal,
            'mstr_mdcp_id' => $this->mstr_mdcp_id,
            'mstr_created_at' => $this->mstr_created_at,
            'mstr_created_by' => $this->mstr_created_by,
            'mstr_updated_at' => $this->mstr_updated_at,
            'mstr_updated_by' => $this->mstr_updated_by,
            'mstr_deleted_at' => $this->mstr_deleted_at,
            'mstr_deleted_by' => $this->mstr_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'mstr_ruangan_asal', $this->mstr_ruangan_asal])
            ->andFilterWhere(['ilike', 'mstr_pindah_keruangan', $this->mstr_pindah_keruangan])
            ->andFilterWhere(['ilike', 'mstr_diagnosis_sekarang', $this->mstr_diagnosis_sekarang])
            ->andFilterWhere(['ilike', 'mstr_alat_transfer_pasien', $this->mstr_alat_transfer_pasien])
            ->andFilterWhere(['ilike', 'mstr_keadaan_umum', $this->mstr_keadaan_umum])
            ->andFilterWhere(['ilike', 'mstr_tekanan_darah_sistole', $this->mstr_tekanan_darah_sistole])
            ->andFilterWhere(['ilike', 'mstr_tekanan_darah_diastole', $this->mstr_tekanan_darah_diastole])
            ->andFilterWhere(['ilike', 'mstr_suhu', $this->mstr_suhu])
            ->andFilterWhere(['ilike', 'mstr_nadi', $this->mstr_nadi])
            ->andFilterWhere(['ilike', 'mstr_pernafasan', $this->mstr_pernafasan])
            ->andFilterWhere(['ilike', 'mstr_tingkat_kesadaran', $this->mstr_tingkat_kesadaran])
            ->andFilterWhere(['ilike', 'mstr_gcs_e', $this->mstr_gcs_e])
            ->andFilterWhere(['ilike', 'mstr_gcs_m', $this->mstr_gcs_m])
            ->andFilterWhere(['ilike', 'mstr_gcs_v', $this->mstr_gcs_v])
            ->andFilterWhere(['ilike', 'mstr_penggunaan_o2', $this->mstr_penggunaan_o2])
            ->andFilterWhere(['ilike', 'mstr_penggunaan_o2_via', $this->mstr_penggunaan_o2_via])
            ->andFilterWhere(['ilike', 'mstr_nyeri_penyebab', $this->mstr_nyeri_penyebab])
            ->andFilterWhere(['ilike', 'mstr_nyeri_hal_memperburuk', $this->mstr_nyeri_hal_memperburuk])
            ->andFilterWhere(['ilike', 'mstr_nyeri_hal_memperingan', $this->mstr_nyeri_hal_memperingan])
            ->andFilterWhere(['ilike', 'mstr_nyeri_kualitas', $this->mstr_nyeri_kualitas])
            ->andFilterWhere(['ilike', 'mstr_nyeri_lokasi', $this->mstr_nyeri_lokasi])
            ->andFilterWhere(['ilike', 'mstr_nyeri_penjalaran', $this->mstr_nyeri_penjalaran])
            ->andFilterWhere(['ilike', 'mstr_nyeri_kategori', $this->mstr_nyeri_kategori])
            ->andFilterWhere(['ilike', 'mstr_nyeri_metode', $this->mstr_nyeri_metode])
            ->andFilterWhere(['ilike', 'mstr_nyeri_lama', $this->mstr_nyeri_lama])
            ->andFilterWhere(['ilike', 'mstr_nyeri_frekuensi', $this->mstr_nyeri_frekuensi])
            ->andFilterWhere(['ilike', 'mstr_resiko_jatuh_skor', $this->mstr_resiko_jatuh_skor])
            ->andFilterWhere(['ilike', 'mstr_resiko_jatuh_kategori', $this->mstr_resiko_jatuh_kategori])
            ->andFilterWhere(['ilike', 'mstr_resiko_jatuh_metode', $this->mstr_resiko_jatuh_metode])
            ->andFilterWhere(['ilike', 'mstr_resiko_jatuh_langkah_pencegahan', $this->mstr_resiko_jatuh_langkah_pencegahan])
            ->andFilterWhere(['ilike', 'mstr_dekubitus', $this->mstr_dekubitus])
            ->andFilterWhere(['ilike', 'mstr_diet', $this->mstr_diet])
            ->andFilterWhere(['ilike', 'mstr_mobilisasi', $this->mstr_mobilisasi])
            ->andFilterWhere(['ilike', 'mstr_ambulasi', $this->mstr_ambulasi])
            ->andFilterWhere(['ilike', 'mstr_obat_oral', $this->mstr_obat_oral])
            ->andFilterWhere(['ilike', 'mstr_ivyd', $this->mstr_ivyd])
            ->andFilterWhere(['ilike', 'mstr_obat_injeksi', $this->mstr_obat_injeksi])
            ->andFilterWhere(['ilike', 'mstr_amp_iv_catch_no', $this->mstr_amp_iv_catch_no])
            ->andFilterWhere(['ilike', 'mstr_ngt_ogt_no', $this->mstr_ngt_ogt_no])
            ->andFilterWhere(['ilike', 'mstr_catheter_no', $this->mstr_catheter_no])
            ->andFilterWhere(['ilike', 'mstr_tindakan_medis_yg_sudah_dilakukan', $this->mstr_tindakan_medis_yg_sudah_dilakukan])
            ->andFilterWhere(['ilike', 'mstr_tindakan_keperawatan_yg_sudah_dilakukan', $this->mstr_tindakan_keperawatan_yg_sudah_dilakukan])
            ->andFilterWhere(['ilike', 'mstr_pemeriksaan_diagnosis_yg_sudah_dilakukan', $this->mstr_pemeriksaan_diagnosis_yg_sudah_dilakukan])
            ->andFilterWhere(['ilike', 'mstr_hal_yg_diperhatikan_dan_dokumen', $this->mstr_hal_yg_diperhatikan_dan_dokumen]);

        return $dataProvider;
    }
}
