<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\PreOperasiPerawat;

/**
 * PreOperasiPerawatSearch represents the model behind the search form of `app\models\bedahsentral\PreOperasiPerawat`.
 */
class PreOperasiPerawatSearch extends PreOperasiPerawat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pop_id', 'pop_to_id', 'pop_pl_id', 'pop_pgw_id_ruangan', 'pop_pgw_id_anestesi', 'pop_pgw_id_ok', 'pop_final_ruangan', 'pop_batal', 'pop_mdcp_id', 'pop_created_by', 'pop_updated_by', 'pop_deleted_by', 'pop_final_anestesi', 'pop_final_ok', 'pop_batal_ok', 'pop_batal_anestesi', 'pop_batal_ruangan'], 'integer'],
            [['pop_tingkat_kesadaran', 'pop_e', 'pop_m', 'pop_v', 'pop_total_gcs', 'pop_pernapasan', 'pop_riwayat_operasi', 'pop_jenis_operasi', 'pop_rumah_sakit', 'pop_tahun', 'pop_status_emosional', 'pop_berat_badan', 'pop_tinggi_badan', 'pop_sio_ruangan', 'pop_sio_ruangan_ket', 'pop_sio_ok', 'pop_sio_ok_ket', 'pop_sio_anestesi', 'pop_sio_anestesi_ket', 'pop_puasa_ruangan', 'pop_puasa_ruangan_ket', 'pop_puasa_ok', 'pop_puasa_ok_ket', 'pop_puasa_anestesi', 'pop_puasa_anestesi_ket', 'pop_protesa_ruangan', 'pop_protesa_ruangan_ket', 'pop_protesa_ok', 'pop_protesa_ok_ket', 'pop_protesa_anestesi', 'pop_protesa_anestesi_ket', 'pop_perhiasan_ruangan', 'pop_perhiasan_ruangan_ket', 'pop_perhiasan_ok', 'pop_perhiasan_ok_ket', 'pop_perhiasan_anestesi', 'pop_perhiasan_anestesi_ket', 'pop_pdo_ruangan', 'pop_pdo_ruangan_ket', 'pop_pdo_ok', 'pop_pdo_ok_ket', 'pop_pdo_anestesi', 'pop_pdo_anestesi_ket', 'pop_plo_ruangan', 'pop_plo_ruangan_ket', 'pop_plo_ok', 'pop_plo_ok_ket', 'pop_plo_anestesi', 'pop_plo_anestesi_ket', 'pop_huknah_ruangan', 'pop_huknah_ruangan_ket', 'pop_huknah_ok', 'pop_huknah_ok_ket', 'pop_huknah_anestesi', 'pop_huknah_anestesi_ket', 'pop_fkateter_ruangan', 'pop_fkateter_ruangan_ket', 'pop_fkateter_ok', 'pop_fkateter_ok_ket', 'pop_fkateter_anestesi', 'pop_fkateter_anestesi_ket', 'pop_h_lab_ruangan', 'pop_h_lab_ruangan_ket', 'pop_h_lab_ok', 'pop_h_lab_ok_ket', 'pop_h_lab_anestesi', 'pop_h_lab_anestesi_ket', 'pop_rontgen_ruangan', 'pop_rontgen_ruangan_ket', 'pop_rontgen_ok', 'pop_rontgen_ok_ket', 'pop_rontgen_anestesi', 'pop_rontgen_anestesi_ket', 'pop_usg_ruangan', 'pop_usg_ruangan_ket', 'pop_usg_ok', 'pop_usg_ok_ket', 'pop_usg_anestesi', 'pop_usg_anestesi_ket', 'pop_ctscan_ruangan', 'pop_ctscan_ruangan_ket', 'pop_ctscan_ok', 'pop_ctscan_ok_ket', 'pop_ctscan_anestesi', 'pop_ctscan_anestesi_ket', 'pop_ekg_ruangan', 'pop_ekg_ruangan_ket', 'pop_ekg_ok', 'pop_ekg_ok_ket', 'pop_ekg_anestesi', 'pop_ekg_anestesi_ket', 'pop_echo_ruangan', 'pop_echo_ruangan_ket', 'pop_echo_ok', 'pop_echo_ok_ket', 'pop_echo_anestesi', 'pop_echo_anestesi_ket', 'pop_persediaan_darah_ruangan', 'pop_persediaan_darah_ruangan_ket', 'pop_persediaan_darah_ok', 'pop_persediaan_darah_ok_ket', 'pop_persediaan_darah_anestesi', 'pop_persediaan_darah_anestesi_ket', 'pop_ivline_ruangan', 'pop_ivline_ruangan_ket', 'pop_ivline_ok', 'pop_ivline_ok_ket', 'pop_ivline_anestesi', 'pop_ivline_anestesi_ket', 'pop_propilaksis_ruangan', 'pop_propilaksis_ruangan_ket', 'pop_propilaksis_ok', 'pop_propilaksis_ok_ket', 'pop_propilaksis_anestesi', 'pop_propilaksis_anestesi_ket', 'pop_alergi_obat_ruangan', 'pop_alergi_obat_ruangan_ket', 'pop_alergi_obat_ok', 'pop_alergi_obat_ok_ket', 'pop_alergi_obat_anestesi', 'pop_alergi_obat_anestesi_ket', 'pop_tkn_darah_ruangan', 'pop_tkn_darah_ruangan_ket', 'pop_tkn_darah_ok', 'pop_tkn_darah_ok_ket', 'pop_tkn_darah_anestesi', 'pop_tkn_darah_anestesi_ket', 'pop_nadi_ruangan', 'pop_nadi_ruangan_ket', 'pop_nadi_ok', 'pop_nadi_ok_ket', 'pop_nadi_anestesi', 'pop_nadi_anestesi_ket', 'pop_suhu_ruangan', 'pop_suhu_ruangan_ket', 'pop_suhu_ok', 'pop_suhu_ok_ket', 'pop_suhu_anestesi', 'pop_suhu_anestesi_ket', 'pop_pernapasan_ruangan', 'pop_pernapasan_ruangan_ket', 'pop_pernapasan_ok', 'pop_pernapasan_ok_ket', 'pop_pernapasan_anestesi', 'pop_pernapasan_anestesi_ket', 'pop_pendidikan', 'pop_obatan', 'pop_integritas_kulit', 'pop_tulang', 'pop_masalah', 'pop_tindakan', 'pop_implementasi', 'pop_evaluasi', 'pop_tgl_final', 'pop_tgl_batal', 'pop_created_at', 'pop_updated_at', 'pop_deleted_at'], 'safe'],
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
        $query = PreOperasiPerawat::find();

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
            'pop_id' => $this->pop_id,
            'pop_to_id' => $this->pop_to_id,
            'pop_pl_id' => $this->pop_pl_id,
            'pop_pgw_id_ruangan' => $this->pop_pgw_id_ruangan,
            'pop_pgw_id_anestesi' => $this->pop_pgw_id_anestesi,
            'pop_pgw_id_ok' => $this->pop_pgw_id_ok,
            'pop_final_ruangan' => $this->pop_final_ruangan,
            'pop_tgl_final' => $this->pop_tgl_final,
            'pop_batal' => $this->pop_batal,
            'pop_tgl_batal' => $this->pop_tgl_batal,
            'pop_mdcp_id' => $this->pop_mdcp_id,
            'pop_created_at' => $this->pop_created_at,
            'pop_created_by' => $this->pop_created_by,
            'pop_updated_at' => $this->pop_updated_at,
            'pop_updated_by' => $this->pop_updated_by,
            'pop_deleted_at' => $this->pop_deleted_at,
            'pop_deleted_by' => $this->pop_deleted_by,
            'pop_final_anestesi' => $this->pop_final_anestesi,
            'pop_final_ok' => $this->pop_final_ok,
            'pop_batal_ok' => $this->pop_batal_ok,
            'pop_batal_anestesi' => $this->pop_batal_anestesi,
            'pop_batal_ruangan' => $this->pop_batal_ruangan,
        ]);

        $query->andFilterWhere(['ilike', 'pop_tingkat_kesadaran', $this->pop_tingkat_kesadaran])
            ->andFilterWhere(['ilike', 'pop_e', $this->pop_e])
            ->andFilterWhere(['ilike', 'pop_m', $this->pop_m])
            ->andFilterWhere(['ilike', 'pop_v', $this->pop_v])
            ->andFilterWhere(['ilike', 'pop_total_gcs', $this->pop_total_gcs])
            ->andFilterWhere(['ilike', 'pop_pernapasan', $this->pop_pernapasan])
            ->andFilterWhere(['ilike', 'pop_riwayat_operasi', $this->pop_riwayat_operasi])
            ->andFilterWhere(['ilike', 'pop_jenis_operasi', $this->pop_jenis_operasi])
            ->andFilterWhere(['ilike', 'pop_rumah_sakit', $this->pop_rumah_sakit])
            ->andFilterWhere(['ilike', 'pop_tahun', $this->pop_tahun])
            ->andFilterWhere(['ilike', 'pop_status_emosional', $this->pop_status_emosional])
            ->andFilterWhere(['ilike', 'pop_berat_badan', $this->pop_berat_badan])
            ->andFilterWhere(['ilike', 'pop_tinggi_badan', $this->pop_tinggi_badan])
            ->andFilterWhere(['ilike', 'pop_sio_ruangan', $this->pop_sio_ruangan])
            ->andFilterWhere(['ilike', 'pop_sio_ruangan_ket', $this->pop_sio_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_sio_ok', $this->pop_sio_ok])
            ->andFilterWhere(['ilike', 'pop_sio_ok_ket', $this->pop_sio_ok_ket])
            ->andFilterWhere(['ilike', 'pop_sio_anestesi', $this->pop_sio_anestesi])
            ->andFilterWhere(['ilike', 'pop_sio_anestesi_ket', $this->pop_sio_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_puasa_ruangan', $this->pop_puasa_ruangan])
            ->andFilterWhere(['ilike', 'pop_puasa_ruangan_ket', $this->pop_puasa_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_puasa_ok', $this->pop_puasa_ok])
            ->andFilterWhere(['ilike', 'pop_puasa_ok_ket', $this->pop_puasa_ok_ket])
            ->andFilterWhere(['ilike', 'pop_puasa_anestesi', $this->pop_puasa_anestesi])
            ->andFilterWhere(['ilike', 'pop_puasa_anestesi_ket', $this->pop_puasa_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_protesa_ruangan', $this->pop_protesa_ruangan])
            ->andFilterWhere(['ilike', 'pop_protesa_ruangan_ket', $this->pop_protesa_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_protesa_ok', $this->pop_protesa_ok])
            ->andFilterWhere(['ilike', 'pop_protesa_ok_ket', $this->pop_protesa_ok_ket])
            ->andFilterWhere(['ilike', 'pop_protesa_anestesi', $this->pop_protesa_anestesi])
            ->andFilterWhere(['ilike', 'pop_protesa_anestesi_ket', $this->pop_protesa_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_perhiasan_ruangan', $this->pop_perhiasan_ruangan])
            ->andFilterWhere(['ilike', 'pop_perhiasan_ruangan_ket', $this->pop_perhiasan_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_perhiasan_ok', $this->pop_perhiasan_ok])
            ->andFilterWhere(['ilike', 'pop_perhiasan_ok_ket', $this->pop_perhiasan_ok_ket])
            ->andFilterWhere(['ilike', 'pop_perhiasan_anestesi', $this->pop_perhiasan_anestesi])
            ->andFilterWhere(['ilike', 'pop_perhiasan_anestesi_ket', $this->pop_perhiasan_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_pdo_ruangan', $this->pop_pdo_ruangan])
            ->andFilterWhere(['ilike', 'pop_pdo_ruangan_ket', $this->pop_pdo_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_pdo_ok', $this->pop_pdo_ok])
            ->andFilterWhere(['ilike', 'pop_pdo_ok_ket', $this->pop_pdo_ok_ket])
            ->andFilterWhere(['ilike', 'pop_pdo_anestesi', $this->pop_pdo_anestesi])
            ->andFilterWhere(['ilike', 'pop_pdo_anestesi_ket', $this->pop_pdo_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_plo_ruangan', $this->pop_plo_ruangan])
            ->andFilterWhere(['ilike', 'pop_plo_ruangan_ket', $this->pop_plo_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_plo_ok', $this->pop_plo_ok])
            ->andFilterWhere(['ilike', 'pop_plo_ok_ket', $this->pop_plo_ok_ket])
            ->andFilterWhere(['ilike', 'pop_plo_anestesi', $this->pop_plo_anestesi])
            ->andFilterWhere(['ilike', 'pop_plo_anestesi_ket', $this->pop_plo_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_huknah_ruangan', $this->pop_huknah_ruangan])
            ->andFilterWhere(['ilike', 'pop_huknah_ruangan_ket', $this->pop_huknah_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_huknah_ok', $this->pop_huknah_ok])
            ->andFilterWhere(['ilike', 'pop_huknah_ok_ket', $this->pop_huknah_ok_ket])
            ->andFilterWhere(['ilike', 'pop_huknah_anestesi', $this->pop_huknah_anestesi])
            ->andFilterWhere(['ilike', 'pop_huknah_anestesi_ket', $this->pop_huknah_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_fkateter_ruangan', $this->pop_fkateter_ruangan])
            ->andFilterWhere(['ilike', 'pop_fkateter_ruangan_ket', $this->pop_fkateter_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_fkateter_ok', $this->pop_fkateter_ok])
            ->andFilterWhere(['ilike', 'pop_fkateter_ok_ket', $this->pop_fkateter_ok_ket])
            ->andFilterWhere(['ilike', 'pop_fkateter_anestesi', $this->pop_fkateter_anestesi])
            ->andFilterWhere(['ilike', 'pop_fkateter_anestesi_ket', $this->pop_fkateter_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_h_lab_ruangan', $this->pop_h_lab_ruangan])
            ->andFilterWhere(['ilike', 'pop_h_lab_ruangan_ket', $this->pop_h_lab_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_h_lab_ok', $this->pop_h_lab_ok])
            ->andFilterWhere(['ilike', 'pop_h_lab_ok_ket', $this->pop_h_lab_ok_ket])
            ->andFilterWhere(['ilike', 'pop_h_lab_anestesi', $this->pop_h_lab_anestesi])
            ->andFilterWhere(['ilike', 'pop_h_lab_anestesi_ket', $this->pop_h_lab_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_rontgen_ruangan', $this->pop_rontgen_ruangan])
            ->andFilterWhere(['ilike', 'pop_rontgen_ruangan_ket', $this->pop_rontgen_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_rontgen_ok', $this->pop_rontgen_ok])
            ->andFilterWhere(['ilike', 'pop_rontgen_ok_ket', $this->pop_rontgen_ok_ket])
            ->andFilterWhere(['ilike', 'pop_rontgen_anestesi', $this->pop_rontgen_anestesi])
            ->andFilterWhere(['ilike', 'pop_rontgen_anestesi_ket', $this->pop_rontgen_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_usg_ruangan', $this->pop_usg_ruangan])
            ->andFilterWhere(['ilike', 'pop_usg_ruangan_ket', $this->pop_usg_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_usg_ok', $this->pop_usg_ok])
            ->andFilterWhere(['ilike', 'pop_usg_ok_ket', $this->pop_usg_ok_ket])
            ->andFilterWhere(['ilike', 'pop_usg_anestesi', $this->pop_usg_anestesi])
            ->andFilterWhere(['ilike', 'pop_usg_anestesi_ket', $this->pop_usg_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_ctscan_ruangan', $this->pop_ctscan_ruangan])
            ->andFilterWhere(['ilike', 'pop_ctscan_ruangan_ket', $this->pop_ctscan_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_ctscan_ok', $this->pop_ctscan_ok])
            ->andFilterWhere(['ilike', 'pop_ctscan_ok_ket', $this->pop_ctscan_ok_ket])
            ->andFilterWhere(['ilike', 'pop_ctscan_anestesi', $this->pop_ctscan_anestesi])
            ->andFilterWhere(['ilike', 'pop_ctscan_anestesi_ket', $this->pop_ctscan_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_ekg_ruangan', $this->pop_ekg_ruangan])
            ->andFilterWhere(['ilike', 'pop_ekg_ruangan_ket', $this->pop_ekg_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_ekg_ok', $this->pop_ekg_ok])
            ->andFilterWhere(['ilike', 'pop_ekg_ok_ket', $this->pop_ekg_ok_ket])
            ->andFilterWhere(['ilike', 'pop_ekg_anestesi', $this->pop_ekg_anestesi])
            ->andFilterWhere(['ilike', 'pop_ekg_anestesi_ket', $this->pop_ekg_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_echo_ruangan', $this->pop_echo_ruangan])
            ->andFilterWhere(['ilike', 'pop_echo_ruangan_ket', $this->pop_echo_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_echo_ok', $this->pop_echo_ok])
            ->andFilterWhere(['ilike', 'pop_echo_ok_ket', $this->pop_echo_ok_ket])
            ->andFilterWhere(['ilike', 'pop_echo_anestesi', $this->pop_echo_anestesi])
            ->andFilterWhere(['ilike', 'pop_echo_anestesi_ket', $this->pop_echo_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_persediaan_darah_ruangan', $this->pop_persediaan_darah_ruangan])
            ->andFilterWhere(['ilike', 'pop_persediaan_darah_ruangan_ket', $this->pop_persediaan_darah_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_persediaan_darah_ok', $this->pop_persediaan_darah_ok])
            ->andFilterWhere(['ilike', 'pop_persediaan_darah_ok_ket', $this->pop_persediaan_darah_ok_ket])
            ->andFilterWhere(['ilike', 'pop_persediaan_darah_anestesi', $this->pop_persediaan_darah_anestesi])
            ->andFilterWhere(['ilike', 'pop_persediaan_darah_anestesi_ket', $this->pop_persediaan_darah_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_ivline_ruangan', $this->pop_ivline_ruangan])
            ->andFilterWhere(['ilike', 'pop_ivline_ruangan_ket', $this->pop_ivline_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_ivline_ok', $this->pop_ivline_ok])
            ->andFilterWhere(['ilike', 'pop_ivline_ok_ket', $this->pop_ivline_ok_ket])
            ->andFilterWhere(['ilike', 'pop_ivline_anestesi', $this->pop_ivline_anestesi])
            ->andFilterWhere(['ilike', 'pop_ivline_anestesi_ket', $this->pop_ivline_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_propilaksis_ruangan', $this->pop_propilaksis_ruangan])
            ->andFilterWhere(['ilike', 'pop_propilaksis_ruangan_ket', $this->pop_propilaksis_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_propilaksis_ok', $this->pop_propilaksis_ok])
            ->andFilterWhere(['ilike', 'pop_propilaksis_ok_ket', $this->pop_propilaksis_ok_ket])
            ->andFilterWhere(['ilike', 'pop_propilaksis_anestesi', $this->pop_propilaksis_anestesi])
            ->andFilterWhere(['ilike', 'pop_propilaksis_anestesi_ket', $this->pop_propilaksis_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_alergi_obat_ruangan', $this->pop_alergi_obat_ruangan])
            ->andFilterWhere(['ilike', 'pop_alergi_obat_ruangan_ket', $this->pop_alergi_obat_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_alergi_obat_ok', $this->pop_alergi_obat_ok])
            ->andFilterWhere(['ilike', 'pop_alergi_obat_ok_ket', $this->pop_alergi_obat_ok_ket])
            ->andFilterWhere(['ilike', 'pop_alergi_obat_anestesi', $this->pop_alergi_obat_anestesi])
            ->andFilterWhere(['ilike', 'pop_alergi_obat_anestesi_ket', $this->pop_alergi_obat_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_tkn_darah_ruangan', $this->pop_tkn_darah_ruangan])
            ->andFilterWhere(['ilike', 'pop_tkn_darah_ruangan_ket', $this->pop_tkn_darah_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_tkn_darah_ok', $this->pop_tkn_darah_ok])
            ->andFilterWhere(['ilike', 'pop_tkn_darah_ok_ket', $this->pop_tkn_darah_ok_ket])
            ->andFilterWhere(['ilike', 'pop_tkn_darah_anestesi', $this->pop_tkn_darah_anestesi])
            ->andFilterWhere(['ilike', 'pop_tkn_darah_anestesi_ket', $this->pop_tkn_darah_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_nadi_ruangan', $this->pop_nadi_ruangan])
            ->andFilterWhere(['ilike', 'pop_nadi_ruangan_ket', $this->pop_nadi_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_nadi_ok', $this->pop_nadi_ok])
            ->andFilterWhere(['ilike', 'pop_nadi_ok_ket', $this->pop_nadi_ok_ket])
            ->andFilterWhere(['ilike', 'pop_nadi_anestesi', $this->pop_nadi_anestesi])
            ->andFilterWhere(['ilike', 'pop_nadi_anestesi_ket', $this->pop_nadi_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_suhu_ruangan', $this->pop_suhu_ruangan])
            ->andFilterWhere(['ilike', 'pop_suhu_ruangan_ket', $this->pop_suhu_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_suhu_ok', $this->pop_suhu_ok])
            ->andFilterWhere(['ilike', 'pop_suhu_ok_ket', $this->pop_suhu_ok_ket])
            ->andFilterWhere(['ilike', 'pop_suhu_anestesi', $this->pop_suhu_anestesi])
            ->andFilterWhere(['ilike', 'pop_suhu_anestesi_ket', $this->pop_suhu_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_pernapasan_ruangan', $this->pop_pernapasan_ruangan])
            ->andFilterWhere(['ilike', 'pop_pernapasan_ruangan_ket', $this->pop_pernapasan_ruangan_ket])
            ->andFilterWhere(['ilike', 'pop_pernapasan_ok', $this->pop_pernapasan_ok])
            ->andFilterWhere(['ilike', 'pop_pernapasan_ok_ket', $this->pop_pernapasan_ok_ket])
            ->andFilterWhere(['ilike', 'pop_pernapasan_anestesi', $this->pop_pernapasan_anestesi])
            ->andFilterWhere(['ilike', 'pop_pernapasan_anestesi_ket', $this->pop_pernapasan_anestesi_ket])
            ->andFilterWhere(['ilike', 'pop_pendidikan', $this->pop_pendidikan])
            ->andFilterWhere(['ilike', 'pop_obatan', $this->pop_obatan])
            ->andFilterWhere(['ilike', 'pop_integritas_kulit', $this->pop_integritas_kulit])
            ->andFilterWhere(['ilike', 'pop_tulang', $this->pop_tulang])
            ->andFilterWhere(['ilike', 'pop_masalah', $this->pop_masalah])
            ->andFilterWhere(['ilike', 'pop_tindakan', $this->pop_tindakan])
            ->andFilterWhere(['ilike', 'pop_implementasi', $this->pop_implementasi])
            ->andFilterWhere(['ilike', 'pop_evaluasi', $this->pop_evaluasi]);

        return $dataProvider;
    }
}
