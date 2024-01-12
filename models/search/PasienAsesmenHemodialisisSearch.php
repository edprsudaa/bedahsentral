<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\AsesmenHemodialisis;

/**
 * PasienAsesmenHemodialisisSearch represents the model behind the search form of `app\models\medis\AsesmenHemodialisis`.
 */
class PasienAsesmenHemodialisisSearch extends AsesmenHemodialisis
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id', 'perawat_id', 'ps_berat_badan_prehd', 'ps_berat_badan_bbkering', 'ps_berat_badan_bbhd', 'ps_berat_badan_posthd', 'im_dokter_id', 'akses_vaskuler_dokter_id', 'batal', 'draf', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['anamnesis_sumber', 'anamnesis_keluhan', 'riwayat_penyakit_sekarang', 'riwayat_penyakit_dahulu', 'riwayat_operasi', 'riwayat_pengobatan_tb', 'riwayat_pengobatan_lain', 'riwayat_penyakit_keluarga', 'alergi', 'status_sosial', 'ekonomi', 'imunisasi', 'status_psikologi', 'status_mental', 'riwayat_perilaku_kekerasan', 'ketergantungan_obat', 'ketergantungan_alkohol', 'permintaan_informasi', 'ps_keadaan_umum', 'ps_tekanan_darah', 'ps_nadi', 'ps_fnadi', 'ps_respirasi', 'ps_frespirasi', 'ps_konjungtiva', 'ps_ekstrimitas', 'ps_akses_vaskular', 'pp_penunjang', 'pp_gizi_tanggal', 'pp_gizi_mis_skor', 'pp_gizi_sga_skor', 'pp_gizi_kesimpulan', 'im_model', 'im_dializer', 'im_dialisat', 'im_rh_td', 'im_rh_qb', 'im_rh_qd', 'im_rh_uf_goal', 'im_pp_bicarbonat', 'im_pp_conductivity', 'im_pp_temperatur', 'h_dosis_sirkulasi', 'h_dosis_awal', 'h_dosis_m_continue', 'h_dosis_m_intermitten', 'h_dosis_m_total', 'h_lmwh', 'h_tanpa_heparin_penyebab', 'im_catatan_lain', 'ik_pre_hd_qb', 'ik_pre_hd_uf_rate', 'ik_pre_hd_tek_drh', 'ik_pre_hd_nadi', 'ik_pre_hd_suhu', 'ik_pre_hd_resp', 'ik_pre_hd_intake_nacl', 'ik_pre_hd_intake_dextro', 'ik_pre_hd_intake_makan_minum', 'ik_pre_hd_intake_lain_lain', 'ik_pre_hd_intake_output_uf_volume', 'ik_pre_hd_intake_keterangan_lain', 'ik_intra_hd_qb_1', 'ik_intra_hd_uf_rate_1', 'ik_intra_hd_tek_drh_1', 'ik_intra_hd_nadi_1', 'ik_intra_hd_suhu_1', 'ik_intra_hd_resp_1', 'ik_intra_hd_intake_nacl_1', 'ik_intra_hd_intake_dextro_1', 'ik_intra_hd_intake_makan_minum_1', 'ik_intra_hd_intake_lain_lain_1', 'ik_intra_hd_intake_output_uf_volume_1', 'ik_intra_hd_intake_keterangan_lain_1', 'ik_intra_hd_qb_2', 'ik_intra_hd_uf_rate_2', 'ik_intra_hd_tek_drh_2', 'ik_intra_hd_nadi_2', 'ik_intra_hd_suhu_2', 'ik_intra_hd_resp_2', 'ik_intra_hd_intake_nacl_2', 'ik_intra_hd_intake_dextro_2', 'ik_intra_hd_intake_makan_minum_2', 'ik_intra_hd_intake_lain_lain_2', 'ik_intra_hd_intake_output_uf_volume_2', 'ik_intra_hd_intake_keterangan_lain_2', 'ik_intra_hd_qb_3', 'ik_intra_hd_uf_rate_3', 'ik_intra_hd_tek_drh_3', 'ik_intra_hd_nadi_3', 'ik_intra_hd_suhu_3', 'ik_intra_hd_resp_3', 'ik_intra_hd_intake_nacl_3', 'ik_intra_hd_intake_dextro_3', 'ik_intra_hd_intake_makan_minum_3', 'ik_intra_hd_intake_lain_lain_3', 'ik_intra_hd_intake_output_uf_volume_3', 'ik_intra_hd_intake_keterangan_lain_3', 'ik_intra_hd_qb_4', 'ik_intra_hd_uf_rate_4', 'ik_intra_hd_tek_drh_4', 'ik_intra_hd_nadi_4', 'ik_intra_hd_suhu_4', 'ik_intra_hd_resp_4', 'ik_intra_hd_intake_nacl_4', 'ik_intra_hd_intake_dextro_4', 'ik_intra_hd_intake_makan_minum_4', 'ik_intra_hd_intake_lain_lain_4', 'ik_intra_hd_intake_output_uf_volume_4', 'ik_intra_hd_intake_keterangan_lain_4', 'ik_intra_hd_qb_5', 'ik_intra_hd_uf_rate_5', 'ik_intra_hd_tek_drh_5', 'ik_intra_hd_nadi_5', 'ik_intra_hd_suhu_5', 'ik_intra_hd_resp_5', 'ik_intra_hd_intake_nacl_5', 'ik_intra_hd_intake_dextro_5', 'ik_intra_hd_intake_makan_minum_5', 'ik_intra_hd_intake_lain_lain_5', 'ik_intra_hd_intake_output_uf_volume_5', 'ik_intra_hd_intake_keterangan_lain_5', 'ik_intra_hd_qb_6', 'ik_intra_hd_uf_rate_6', 'ik_intra_hd_tek_drh_6', 'ik_intra_hd_nadi_6', 'ik_intra_hd_suhu_6', 'ik_intra_hd_resp_6', 'ik_intra_hd_intake_nacl_6', 'ik_intra_hd_intake_dextro_6', 'ik_intra_hd_intake_makan_minum_6', 'ik_intra_hd_intake_lain_lain_6', 'ik_intra_hd_intake_output_uf_volume_6', 'ik_intra_hd_intake_keterangan_lain_6', 'ik_intra_hd_qb_7', 'ik_intra_hd_uf_rate_7', 'ik_intra_hd_tek_drh_7', 'ik_intra_hd_nadi_7', 'ik_intra_hd_suhu_7', 'ik_intra_hd_resp_7', 'ik_intra_hd_intake_nacl_7', 'ik_intra_hd_intake_dextro_7', 'ik_intra_hd_intake_makan_minum_7', 'ik_intra_hd_intake_lain_lain_7', 'ik_intra_hd_intake_output_uf_volume_7', 'ik_intra_hd_intake_keterangan_lain_7', 'ik_post_hd_qb', 'ik_post_hd_uf_rate', 'ik_post_hd_tek_drh', 'ik_post_hd_nadi', 'ik_post_hd_suhu', 'ik_post_hd_resp', 'ik_post_hd_intake_nacl', 'ik_post_hd_intake_dextro', 'ik_post_hd_intake_makan_minum', 'ik_post_hd_intake_lain_lain', 'ik_post_hd_intake_output_uf_volume', 'ik_post_hd_intake_keterangan_lain', 'ik_komplikasi_selama_hd', 'hambatan_dalam_pembelajaran', 'dibutuhkan_penerjamah', 'bahasa_isyarat', 'kebutuhan_edukasi', 'perencanaan_pasien_pulang', 'ek_obat', 'ek_catatan_medis', 'tanggal_batal', 'tanggal_final', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
        $query = AsesmenHemodialisis::find();

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
            'layanan_id' => $this->layanan_id,
            'perawat_id' => $this->perawat_id,
            'ps_berat_badan_prehd' => $this->ps_berat_badan_prehd,
            'ps_berat_badan_bbkering' => $this->ps_berat_badan_bbkering,
            'ps_berat_badan_bbhd' => $this->ps_berat_badan_bbhd,
            'ps_berat_badan_posthd' => $this->ps_berat_badan_posthd,
            'im_dokter_id' => $this->im_dokter_id,
            'akses_vaskuler_dokter_id' => $this->akses_vaskuler_dokter_id,
            'batal' => $this->batal,
            'tanggal_batal' => $this->tanggal_batal,
            'draf' => $this->draf,
            'tanggal_final' => $this->tanggal_final,
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
            ->andFilterWhere(['ilike', 'riwayat_operasi', $this->riwayat_operasi])
            ->andFilterWhere(['ilike', 'riwayat_pengobatan_tb', $this->riwayat_pengobatan_tb])
            ->andFilterWhere(['ilike', 'riwayat_pengobatan_lain', $this->riwayat_pengobatan_lain])
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
            ->andFilterWhere(['ilike', 'ps_keadaan_umum', $this->ps_keadaan_umum])
            ->andFilterWhere(['ilike', 'ps_tekanan_darah', $this->ps_tekanan_darah])
            ->andFilterWhere(['ilike', 'ps_nadi', $this->ps_nadi])
            ->andFilterWhere(['ilike', 'ps_fnadi', $this->ps_fnadi])
            ->andFilterWhere(['ilike', 'ps_respirasi', $this->ps_respirasi])
            ->andFilterWhere(['ilike', 'ps_frespirasi', $this->ps_frespirasi])
            ->andFilterWhere(['ilike', 'ps_konjungtiva', $this->ps_konjungtiva])
            ->andFilterWhere(['ilike', 'ps_ekstrimitas', $this->ps_ekstrimitas])
            ->andFilterWhere(['ilike', 'ps_akses_vaskular', $this->ps_akses_vaskular])
            ->andFilterWhere(['ilike', 'pp_penunjang', $this->pp_penunjang])
            ->andFilterWhere(['ilike', 'pp_gizi_tanggal', $this->pp_gizi_tanggal])
            ->andFilterWhere(['ilike', 'pp_gizi_mis_skor', $this->pp_gizi_mis_skor])
            ->andFilterWhere(['ilike', 'pp_gizi_sga_skor', $this->pp_gizi_sga_skor])
            ->andFilterWhere(['ilike', 'pp_gizi_kesimpulan', $this->pp_gizi_kesimpulan])
            ->andFilterWhere(['ilike', 'im_model', $this->im_model])
            ->andFilterWhere(['ilike', 'im_dializer', $this->im_dializer])
            ->andFilterWhere(['ilike', 'im_dialisat', $this->im_dialisat])
            ->andFilterWhere(['ilike', 'im_rh_td', $this->im_rh_td])
            ->andFilterWhere(['ilike', 'im_rh_qb', $this->im_rh_qb])
            ->andFilterWhere(['ilike', 'im_rh_qd', $this->im_rh_qd])
            ->andFilterWhere(['ilike', 'im_rh_uf_goal', $this->im_rh_uf_goal])
            ->andFilterWhere(['ilike', 'im_pp_bicarbonat', $this->im_pp_bicarbonat])
            ->andFilterWhere(['ilike', 'im_pp_conductivity', $this->im_pp_conductivity])
            ->andFilterWhere(['ilike', 'im_pp_temperatur', $this->im_pp_temperatur])
            ->andFilterWhere(['ilike', 'h_dosis_sirkulasi', $this->h_dosis_sirkulasi])
            ->andFilterWhere(['ilike', 'h_dosis_awal', $this->h_dosis_awal])
            ->andFilterWhere(['ilike', 'h_dosis_m_continue', $this->h_dosis_m_continue])
            ->andFilterWhere(['ilike', 'h_dosis_m_intermitten', $this->h_dosis_m_intermitten])
            ->andFilterWhere(['ilike', 'h_dosis_m_total', $this->h_dosis_m_total])
            ->andFilterWhere(['ilike', 'h_lmwh', $this->h_lmwh])
            ->andFilterWhere(['ilike', 'h_tanpa_heparin_penyebab', $this->h_tanpa_heparin_penyebab])
            ->andFilterWhere(['ilike', 'im_catatan_lain', $this->im_catatan_lain])
            ->andFilterWhere(['ilike', 'ik_pre_hd_qb', $this->ik_pre_hd_qb])
            ->andFilterWhere(['ilike', 'ik_pre_hd_uf_rate', $this->ik_pre_hd_uf_rate])
            ->andFilterWhere(['ilike', 'ik_pre_hd_tek_drh', $this->ik_pre_hd_tek_drh])
            ->andFilterWhere(['ilike', 'ik_pre_hd_nadi', $this->ik_pre_hd_nadi])
            ->andFilterWhere(['ilike', 'ik_pre_hd_suhu', $this->ik_pre_hd_suhu])
            ->andFilterWhere(['ilike', 'ik_pre_hd_resp', $this->ik_pre_hd_resp])
            ->andFilterWhere(['ilike', 'ik_pre_hd_intake_nacl', $this->ik_pre_hd_intake_nacl])
            ->andFilterWhere(['ilike', 'ik_pre_hd_intake_dextro', $this->ik_pre_hd_intake_dextro])
            ->andFilterWhere(['ilike', 'ik_pre_hd_intake_makan_minum', $this->ik_pre_hd_intake_makan_minum])
            ->andFilterWhere(['ilike', 'ik_pre_hd_intake_lain_lain', $this->ik_pre_hd_intake_lain_lain])
            ->andFilterWhere(['ilike', 'ik_pre_hd_intake_output_uf_volume', $this->ik_pre_hd_intake_output_uf_volume])
            ->andFilterWhere(['ilike', 'ik_pre_hd_intake_keterangan_lain', $this->ik_pre_hd_intake_keterangan_lain])
            ->andFilterWhere(['ilike', 'ik_intra_hd_qb_1', $this->ik_intra_hd_qb_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_uf_rate_1', $this->ik_intra_hd_uf_rate_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_tek_drh_1', $this->ik_intra_hd_tek_drh_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_nadi_1', $this->ik_intra_hd_nadi_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_suhu_1', $this->ik_intra_hd_suhu_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_resp_1', $this->ik_intra_hd_resp_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_nacl_1', $this->ik_intra_hd_intake_nacl_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_dextro_1', $this->ik_intra_hd_intake_dextro_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_makan_minum_1', $this->ik_intra_hd_intake_makan_minum_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_lain_lain_1', $this->ik_intra_hd_intake_lain_lain_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_output_uf_volume_1', $this->ik_intra_hd_intake_output_uf_volume_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_keterangan_lain_1', $this->ik_intra_hd_intake_keterangan_lain_1])
            ->andFilterWhere(['ilike', 'ik_intra_hd_qb_2', $this->ik_intra_hd_qb_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_uf_rate_2', $this->ik_intra_hd_uf_rate_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_tek_drh_2', $this->ik_intra_hd_tek_drh_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_nadi_2', $this->ik_intra_hd_nadi_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_suhu_2', $this->ik_intra_hd_suhu_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_resp_2', $this->ik_intra_hd_resp_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_nacl_2', $this->ik_intra_hd_intake_nacl_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_dextro_2', $this->ik_intra_hd_intake_dextro_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_makan_minum_2', $this->ik_intra_hd_intake_makan_minum_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_lain_lain_2', $this->ik_intra_hd_intake_lain_lain_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_output_uf_volume_2', $this->ik_intra_hd_intake_output_uf_volume_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_keterangan_lain_2', $this->ik_intra_hd_intake_keterangan_lain_2])
            ->andFilterWhere(['ilike', 'ik_intra_hd_qb_3', $this->ik_intra_hd_qb_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_uf_rate_3', $this->ik_intra_hd_uf_rate_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_tek_drh_3', $this->ik_intra_hd_tek_drh_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_nadi_3', $this->ik_intra_hd_nadi_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_suhu_3', $this->ik_intra_hd_suhu_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_resp_3', $this->ik_intra_hd_resp_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_nacl_3', $this->ik_intra_hd_intake_nacl_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_dextro_3', $this->ik_intra_hd_intake_dextro_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_makan_minum_3', $this->ik_intra_hd_intake_makan_minum_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_lain_lain_3', $this->ik_intra_hd_intake_lain_lain_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_output_uf_volume_3', $this->ik_intra_hd_intake_output_uf_volume_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_keterangan_lain_3', $this->ik_intra_hd_intake_keterangan_lain_3])
            ->andFilterWhere(['ilike', 'ik_intra_hd_qb_4', $this->ik_intra_hd_qb_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_uf_rate_4', $this->ik_intra_hd_uf_rate_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_tek_drh_4', $this->ik_intra_hd_tek_drh_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_nadi_4', $this->ik_intra_hd_nadi_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_suhu_4', $this->ik_intra_hd_suhu_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_resp_4', $this->ik_intra_hd_resp_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_nacl_4', $this->ik_intra_hd_intake_nacl_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_dextro_4', $this->ik_intra_hd_intake_dextro_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_makan_minum_4', $this->ik_intra_hd_intake_makan_minum_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_lain_lain_4', $this->ik_intra_hd_intake_lain_lain_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_output_uf_volume_4', $this->ik_intra_hd_intake_output_uf_volume_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_keterangan_lain_4', $this->ik_intra_hd_intake_keterangan_lain_4])
            ->andFilterWhere(['ilike', 'ik_intra_hd_qb_5', $this->ik_intra_hd_qb_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_uf_rate_5', $this->ik_intra_hd_uf_rate_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_tek_drh_5', $this->ik_intra_hd_tek_drh_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_nadi_5', $this->ik_intra_hd_nadi_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_suhu_5', $this->ik_intra_hd_suhu_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_resp_5', $this->ik_intra_hd_resp_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_nacl_5', $this->ik_intra_hd_intake_nacl_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_dextro_5', $this->ik_intra_hd_intake_dextro_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_makan_minum_5', $this->ik_intra_hd_intake_makan_minum_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_lain_lain_5', $this->ik_intra_hd_intake_lain_lain_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_output_uf_volume_5', $this->ik_intra_hd_intake_output_uf_volume_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_keterangan_lain_5', $this->ik_intra_hd_intake_keterangan_lain_5])
            ->andFilterWhere(['ilike', 'ik_intra_hd_qb_6', $this->ik_intra_hd_qb_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_uf_rate_6', $this->ik_intra_hd_uf_rate_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_tek_drh_6', $this->ik_intra_hd_tek_drh_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_nadi_6', $this->ik_intra_hd_nadi_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_suhu_6', $this->ik_intra_hd_suhu_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_resp_6', $this->ik_intra_hd_resp_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_nacl_6', $this->ik_intra_hd_intake_nacl_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_dextro_6', $this->ik_intra_hd_intake_dextro_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_makan_minum_6', $this->ik_intra_hd_intake_makan_minum_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_lain_lain_6', $this->ik_intra_hd_intake_lain_lain_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_output_uf_volume_6', $this->ik_intra_hd_intake_output_uf_volume_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_keterangan_lain_6', $this->ik_intra_hd_intake_keterangan_lain_6])
            ->andFilterWhere(['ilike', 'ik_intra_hd_qb_7', $this->ik_intra_hd_qb_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_uf_rate_7', $this->ik_intra_hd_uf_rate_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_tek_drh_7', $this->ik_intra_hd_tek_drh_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_nadi_7', $this->ik_intra_hd_nadi_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_suhu_7', $this->ik_intra_hd_suhu_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_resp_7', $this->ik_intra_hd_resp_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_nacl_7', $this->ik_intra_hd_intake_nacl_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_dextro_7', $this->ik_intra_hd_intake_dextro_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_makan_minum_7', $this->ik_intra_hd_intake_makan_minum_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_lain_lain_7', $this->ik_intra_hd_intake_lain_lain_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_output_uf_volume_7', $this->ik_intra_hd_intake_output_uf_volume_7])
            ->andFilterWhere(['ilike', 'ik_intra_hd_intake_keterangan_lain_7', $this->ik_intra_hd_intake_keterangan_lain_7])
            ->andFilterWhere(['ilike', 'ik_post_hd_qb', $this->ik_post_hd_qb])
            ->andFilterWhere(['ilike', 'ik_post_hd_uf_rate', $this->ik_post_hd_uf_rate])
            ->andFilterWhere(['ilike', 'ik_post_hd_tek_drh', $this->ik_post_hd_tek_drh])
            ->andFilterWhere(['ilike', 'ik_post_hd_nadi', $this->ik_post_hd_nadi])
            ->andFilterWhere(['ilike', 'ik_post_hd_suhu', $this->ik_post_hd_suhu])
            ->andFilterWhere(['ilike', 'ik_post_hd_resp', $this->ik_post_hd_resp])
            ->andFilterWhere(['ilike', 'ik_post_hd_intake_nacl', $this->ik_post_hd_intake_nacl])
            ->andFilterWhere(['ilike', 'ik_post_hd_intake_dextro', $this->ik_post_hd_intake_dextro])
            ->andFilterWhere(['ilike', 'ik_post_hd_intake_makan_minum', $this->ik_post_hd_intake_makan_minum])
            ->andFilterWhere(['ilike', 'ik_post_hd_intake_lain_lain', $this->ik_post_hd_intake_lain_lain])
            ->andFilterWhere(['ilike', 'ik_post_hd_intake_output_uf_volume', $this->ik_post_hd_intake_output_uf_volume])
            ->andFilterWhere(['ilike', 'ik_post_hd_intake_keterangan_lain', $this->ik_post_hd_intake_keterangan_lain])
            ->andFilterWhere(['ilike', 'ik_komplikasi_selama_hd', $this->ik_komplikasi_selama_hd])
            ->andFilterWhere(['ilike', 'hambatan_dalam_pembelajaran', $this->hambatan_dalam_pembelajaran])
            ->andFilterWhere(['ilike', 'dibutuhkan_penerjamah', $this->dibutuhkan_penerjamah])
            ->andFilterWhere(['ilike', 'bahasa_isyarat', $this->bahasa_isyarat])
            ->andFilterWhere(['ilike', 'kebutuhan_edukasi', $this->kebutuhan_edukasi])
            ->andFilterWhere(['ilike', 'perencanaan_pasien_pulang', $this->perencanaan_pasien_pulang])
            ->andFilterWhere(['ilike', 'ek_obat', $this->ek_obat])
            ->andFilterWhere(['ilike', 'ek_catatan_medis', $this->ek_catatan_medis])
            ->andFilterWhere(['ilike', 'log_data', $this->log_data]);

        return $dataProvider;
    }
}
