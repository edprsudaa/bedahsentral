<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\medis\AsesmenAwalKeperawatanNeonatus;

/**
 * PasienAsesmenAwalKeperawatanNeonatusSearch represents the model behind the search form of `app\models\medis\AsesmenAwalKeperawatanNeonatus`.
 */
class PasienAsesmenAwalKeperawatanNeonatusSearch extends AsesmenAwalKeperawatanNeonatus
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'layanan_id', 'perawat_id', 'rb_apgar_score_1', 'rb_apgar_score_5', 'rb_anak_ke', 'rb_bb', 'rb_pb', 'rb_lk', 'rb_ld', 'rb_ll', 'kbm_ipn_bb', 'kbm_ipn_suhu', 'ri_usia', 'ri_g', 'ri_p', 'ri_a', 'pfn_kl_kepala_lingkar_kepala', 'rk_anc_jumlah', 'rk_tb', 'rk_bb_hamil', 'rk_sebelum_hamil', 'ku_berat_badan_masuk', 'batal', 'draf', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['rb_usia_gestasi', 'rb_aspirasi_meconium', 'rb_prolaps_tali_pusar', 'rb_ketuban_pecah_dini', 'kbm_ipn_tgl_jam', 'kbm_ipn_kesadaran', 'kbm_ipn_rujukan', 'kbm_ipn_keluhan', 'ri_jenis_persalinan_spontan', 'ri_jenis_persalinan_sectio_caesarea', 'ri_pervaginam_forceps', 'ri_pervaginam_ve', 'ri_komplikasi_kehamilan', 'pfn_refleks_moro', 'pfn_refleks_menggenggam', 'pfn_refleks_rooting_menghisap', 'pfn_refleks_tonus_aktifitas', 'pfn_refleks_menangis', 'pfn_kl_fontanel_anterior', 'pfn_kl_gambaran_wajah', 'pfn_kl_kepala_trauma', 'pfn_kl_mata', 'pfn_kl_mata_kelainan', 'pfn_kl_telinga', 'pfn_kl_hidung', 'rk_anc_tempat', 'rk_merokok', 'rk_alkohol', 'rk_minum_jamu', 'rk_obat_obatan', 'rk_pd_diabetes', 'rk_pd_hipertensi', 'rk_pd_tiroid', 'rk_pd_hiv', 'rk_pd_hepatitis', 'rk_pd_penyakit_lain', 'ku_abn_nasal', 'ku_abn_bcpap', 'ku_abn_ventilator', 'ku_abn_neopuff', 'ku_sisper_nafas_cuping_hidung', 'ku_sisper_sianosis', 'ku_sisper_retraksi_dada', 'ku_sisper_bunyi_paru', 'ku_sisper_bunyi_jantung', 'ku_sisper_periode_apnne', 'ku_sisper_crt', 'ku_sispen_refleks_isap', 'ku_sispen_refleks_menelan', 'ku_sispen_bentuk_mulut', 'ku_sispen_kelainan_mulut', 'ku_sispen_abdomen', 'ku_sispen_bising_usus', 'ku_sispen_keluar_meconium', 'ku_sispen_warna_residu', 'ku_sispen_muntah', 'ku_kc_fontanel', 'ku_kc_mata', 'ku_kc_mukosa', 'ku_kc_cubitis_perut', 'ku_kc_urinasi', 'ku_kc_nadi', 'ku_kc_lain', 'ku_su_keadaan', 'ku_su_bentuk', 'ku_su_meatus_urinarius', 'ku_su_anus', 'ku_su_lain', 'ku_su_genitalia_wanita', 'ku_su_genitalia_pria', 'ku_st_perabaan', 'ku_st_bantuan_inkubator', 'ku_st_bantuan_blue_light', 'ku_st_bantuan_penghangat_radiant', 'ku_st_kondisi_ruangan', 'ku_st_suhu_ruangan', 'ku_st_treatmen_perawatan', 'ku_st_kelainan_lain', 'ku_bs_jarak_pandang', 'ku_bs_keterlibatan_ibu_ayah', 'ku_bs_pekerjaan_ayah', 'ku_bs_pekerjaan_ibu', 'ku_bs_lingkungan_rumah', 'ku_bs_agama_yg_dianut', 'ku_bs_kepercayaan_terhadap_adat_istiadat', 'tanggal_batal', 'tanggal_final', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
        $query = AsesmenAwalKeperawatanNeonatus::find();

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
            'rb_apgar_score_1' => $this->rb_apgar_score_1,
            'rb_apgar_score_5' => $this->rb_apgar_score_5,
            'rb_anak_ke' => $this->rb_anak_ke,
            'rb_bb' => $this->rb_bb,
            'rb_pb' => $this->rb_pb,
            'rb_lk' => $this->rb_lk,
            'rb_ld' => $this->rb_ld,
            'rb_ll' => $this->rb_ll,
            'kbm_ipn_tgl_jam' => $this->kbm_ipn_tgl_jam,
            'kbm_ipn_bb' => $this->kbm_ipn_bb,
            'kbm_ipn_suhu' => $this->kbm_ipn_suhu,
            'ri_usia' => $this->ri_usia,
            'ri_g' => $this->ri_g,
            'ri_p' => $this->ri_p,
            'ri_a' => $this->ri_a,
            'pfn_kl_kepala_lingkar_kepala' => $this->pfn_kl_kepala_lingkar_kepala,
            'rk_anc_jumlah' => $this->rk_anc_jumlah,
            'rk_tb' => $this->rk_tb,
            'rk_bb_hamil' => $this->rk_bb_hamil,
            'rk_sebelum_hamil' => $this->rk_sebelum_hamil,
            'ku_berat_badan_masuk' => $this->ku_berat_badan_masuk,
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

        $query->andFilterWhere(['ilike', 'rb_usia_gestasi', $this->rb_usia_gestasi])
            ->andFilterWhere(['ilike', 'rb_aspirasi_meconium', $this->rb_aspirasi_meconium])
            ->andFilterWhere(['ilike', 'rb_prolaps_tali_pusar', $this->rb_prolaps_tali_pusar])
            ->andFilterWhere(['ilike', 'rb_ketuban_pecah_dini', $this->rb_ketuban_pecah_dini])
            ->andFilterWhere(['ilike', 'kbm_ipn_kesadaran', $this->kbm_ipn_kesadaran])
            ->andFilterWhere(['ilike', 'kbm_ipn_rujukan', $this->kbm_ipn_rujukan])
            ->andFilterWhere(['ilike', 'kbm_ipn_keluhan', $this->kbm_ipn_keluhan])
            ->andFilterWhere(['ilike', 'ri_jenis_persalinan_spontan', $this->ri_jenis_persalinan_spontan])
            ->andFilterWhere(['ilike', 'ri_jenis_persalinan_sectio_caesarea', $this->ri_jenis_persalinan_sectio_caesarea])
            ->andFilterWhere(['ilike', 'ri_pervaginam_forceps', $this->ri_pervaginam_forceps])
            ->andFilterWhere(['ilike', 'ri_pervaginam_ve', $this->ri_pervaginam_ve])
            ->andFilterWhere(['ilike', 'ri_komplikasi_kehamilan', $this->ri_komplikasi_kehamilan])
            ->andFilterWhere(['ilike', 'pfn_refleks_moro', $this->pfn_refleks_moro])
            ->andFilterWhere(['ilike', 'pfn_refleks_menggenggam', $this->pfn_refleks_menggenggam])
            ->andFilterWhere(['ilike', 'pfn_refleks_rooting_menghisap', $this->pfn_refleks_rooting_menghisap])
            ->andFilterWhere(['ilike', 'pfn_refleks_tonus_aktifitas', $this->pfn_refleks_tonus_aktifitas])
            ->andFilterWhere(['ilike', 'pfn_refleks_menangis', $this->pfn_refleks_menangis])
            ->andFilterWhere(['ilike', 'pfn_kl_fontanel_anterior', $this->pfn_kl_fontanel_anterior])
            ->andFilterWhere(['ilike', 'pfn_kl_gambaran_wajah', $this->pfn_kl_gambaran_wajah])
            ->andFilterWhere(['ilike', 'pfn_kl_kepala_trauma', $this->pfn_kl_kepala_trauma])
            ->andFilterWhere(['ilike', 'pfn_kl_mata', $this->pfn_kl_mata])
            ->andFilterWhere(['ilike', 'pfn_kl_mata_kelainan', $this->pfn_kl_mata_kelainan])
            ->andFilterWhere(['ilike', 'pfn_kl_telinga', $this->pfn_kl_telinga])
            ->andFilterWhere(['ilike', 'pfn_kl_hidung', $this->pfn_kl_hidung])
            ->andFilterWhere(['ilike', 'rk_anc_tempat', $this->rk_anc_tempat])
            ->andFilterWhere(['ilike', 'rk_merokok', $this->rk_merokok])
            ->andFilterWhere(['ilike', 'rk_alkohol', $this->rk_alkohol])
            ->andFilterWhere(['ilike', 'rk_minum_jamu', $this->rk_minum_jamu])
            ->andFilterWhere(['ilike', 'rk_obat_obatan', $this->rk_obat_obatan])
            ->andFilterWhere(['ilike', 'rk_pd_diabetes', $this->rk_pd_diabetes])
            ->andFilterWhere(['ilike', 'rk_pd_hipertensi', $this->rk_pd_hipertensi])
            ->andFilterWhere(['ilike', 'rk_pd_tiroid', $this->rk_pd_tiroid])
            ->andFilterWhere(['ilike', 'rk_pd_hiv', $this->rk_pd_hiv])
            ->andFilterWhere(['ilike', 'rk_pd_hepatitis', $this->rk_pd_hepatitis])
            ->andFilterWhere(['ilike', 'rk_pd_penyakit_lain', $this->rk_pd_penyakit_lain])
            ->andFilterWhere(['ilike', 'ku_abn_nasal', $this->ku_abn_nasal])
            ->andFilterWhere(['ilike', 'ku_abn_bcpap', $this->ku_abn_bcpap])
            ->andFilterWhere(['ilike', 'ku_abn_ventilator', $this->ku_abn_ventilator])
            ->andFilterWhere(['ilike', 'ku_abn_neopuff', $this->ku_abn_neopuff])
            ->andFilterWhere(['ilike', 'ku_sisper_nafas_cuping_hidung', $this->ku_sisper_nafas_cuping_hidung])
            ->andFilterWhere(['ilike', 'ku_sisper_sianosis', $this->ku_sisper_sianosis])
            ->andFilterWhere(['ilike', 'ku_sisper_retraksi_dada', $this->ku_sisper_retraksi_dada])
            ->andFilterWhere(['ilike', 'ku_sisper_bunyi_paru', $this->ku_sisper_bunyi_paru])
            ->andFilterWhere(['ilike', 'ku_sisper_bunyi_jantung', $this->ku_sisper_bunyi_jantung])
            ->andFilterWhere(['ilike', 'ku_sisper_periode_apnne', $this->ku_sisper_periode_apnne])
            ->andFilterWhere(['ilike', 'ku_sisper_crt', $this->ku_sisper_crt])
            ->andFilterWhere(['ilike', 'ku_sispen_refleks_isap', $this->ku_sispen_refleks_isap])
            ->andFilterWhere(['ilike', 'ku_sispen_refleks_menelan', $this->ku_sispen_refleks_menelan])
            ->andFilterWhere(['ilike', 'ku_sispen_bentuk_mulut', $this->ku_sispen_bentuk_mulut])
            ->andFilterWhere(['ilike', 'ku_sispen_kelainan_mulut', $this->ku_sispen_kelainan_mulut])
            ->andFilterWhere(['ilike', 'ku_sispen_abdomen', $this->ku_sispen_abdomen])
            ->andFilterWhere(['ilike', 'ku_sispen_bising_usus', $this->ku_sispen_bising_usus])
            ->andFilterWhere(['ilike', 'ku_sispen_keluar_meconium', $this->ku_sispen_keluar_meconium])
            ->andFilterWhere(['ilike', 'ku_sispen_warna_residu', $this->ku_sispen_warna_residu])
            ->andFilterWhere(['ilike', 'ku_sispen_muntah', $this->ku_sispen_muntah])
            ->andFilterWhere(['ilike', 'ku_kc_fontanel', $this->ku_kc_fontanel])
            ->andFilterWhere(['ilike', 'ku_kc_mata', $this->ku_kc_mata])
            ->andFilterWhere(['ilike', 'ku_kc_mukosa', $this->ku_kc_mukosa])
            ->andFilterWhere(['ilike', 'ku_kc_cubitis_perut', $this->ku_kc_cubitis_perut])
            ->andFilterWhere(['ilike', 'ku_kc_urinasi', $this->ku_kc_urinasi])
            ->andFilterWhere(['ilike', 'ku_kc_nadi', $this->ku_kc_nadi])
            ->andFilterWhere(['ilike', 'ku_kc_lain', $this->ku_kc_lain])
            ->andFilterWhere(['ilike', 'ku_su_keadaan', $this->ku_su_keadaan])
            ->andFilterWhere(['ilike', 'ku_su_bentuk', $this->ku_su_bentuk])
            ->andFilterWhere(['ilike', 'ku_su_meatus_urinarius', $this->ku_su_meatus_urinarius])
            ->andFilterWhere(['ilike', 'ku_su_anus', $this->ku_su_anus])
            ->andFilterWhere(['ilike', 'ku_su_lain', $this->ku_su_lain])
            ->andFilterWhere(['ilike', 'ku_su_genitalia_wanita', $this->ku_su_genitalia_wanita])
            ->andFilterWhere(['ilike', 'ku_su_genitalia_pria', $this->ku_su_genitalia_pria])
            ->andFilterWhere(['ilike', 'ku_st_perabaan', $this->ku_st_perabaan])
            ->andFilterWhere(['ilike', 'ku_st_bantuan_inkubator', $this->ku_st_bantuan_inkubator])
            ->andFilterWhere(['ilike', 'ku_st_bantuan_blue_light', $this->ku_st_bantuan_blue_light])
            ->andFilterWhere(['ilike', 'ku_st_bantuan_penghangat_radiant', $this->ku_st_bantuan_penghangat_radiant])
            ->andFilterWhere(['ilike', 'ku_st_kondisi_ruangan', $this->ku_st_kondisi_ruangan])
            ->andFilterWhere(['ilike', 'ku_st_suhu_ruangan', $this->ku_st_suhu_ruangan])
            ->andFilterWhere(['ilike', 'ku_st_treatmen_perawatan', $this->ku_st_treatmen_perawatan])
            ->andFilterWhere(['ilike', 'ku_st_kelainan_lain', $this->ku_st_kelainan_lain])
            ->andFilterWhere(['ilike', 'ku_bs_jarak_pandang', $this->ku_bs_jarak_pandang])
            ->andFilterWhere(['ilike', 'ku_bs_keterlibatan_ibu_ayah', $this->ku_bs_keterlibatan_ibu_ayah])
            ->andFilterWhere(['ilike', 'ku_bs_pekerjaan_ayah', $this->ku_bs_pekerjaan_ayah])
            ->andFilterWhere(['ilike', 'ku_bs_pekerjaan_ibu', $this->ku_bs_pekerjaan_ibu])
            ->andFilterWhere(['ilike', 'ku_bs_lingkungan_rumah', $this->ku_bs_lingkungan_rumah])
            ->andFilterWhere(['ilike', 'ku_bs_agama_yg_dianut', $this->ku_bs_agama_yg_dianut])
            ->andFilterWhere(['ilike', 'ku_bs_kepercayaan_terhadap_adat_istiadat', $this->ku_bs_kepercayaan_terhadap_adat_istiadat])
            ->andFilterWhere(['ilike', 'log_data', $this->log_data]);

        return $dataProvider;
    }
}
