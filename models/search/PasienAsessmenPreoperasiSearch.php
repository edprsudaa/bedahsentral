<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\penunjang\AsessmenPreoperasi;
use app\models\pendaftaran\Layanan;
use app\components\HelperSpesial;
/**
 * PasienAsessmenPreoperasiSearch represents the model behind the search form of `app\models\penunjang\AsessmenPreoperasi`.
 */
class PasienAsessmenPreoperasiSearch extends AsessmenPreoperasi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_preoperasi', 'layanan_id_ruangan', 'layanan_id_ok', 'layanan_id_anestesi', 'dokter_operator_id', 'dokter_anestesi_id', 'gcs_e', 'gcs_m', 'gcs_v', 'gcs_total', 'pernapasan_jumlah', 'ro_tahun', 'berat_badan', 'perawat_ruangan_id', 'perawat_kamaroperasi_id', 'perawat_anastesi_id', 'ruangan_ok_id', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['diagnosa_medis', 'tindakan_operasi', 'hari_pre', 'tanggal_pre', 'tk_pre', 'pernapasan', 'riwayat_operasi', 'ro_jenisopreasi', 'ro_rs', 'status_emosional', 'sio_ruangan', 'sio_kamaroperasi', 'sio_anestesi', 'sio_ket1', 'sio_ket2', 'sio_ket3', 'pp_ruangan', 'pp_kamaroperasi', 'pp_anestesi', 'pp_ket1', 'pp_ket2', 'pp_ket3', 'pd_ruangan', 'pd_kamaroperasi', 'pd_anastesi', 'pd_ket1', 'pd_ket2', 'pd_ket3', 'pl_ruangan', 'pl_kamaroperasi', 'pl_anastesi', 'pl_ket1', 'pl_ket2', 'pl_ket3', 'cdo_ruangan', 'cdo_kamaroperasi', 'cdo_anastesi', 'cdo_ket1', 'cdo_ket2', 'cdo_ket3', 'tlo_ruangan', 'tlo_kamaroperasi', 'tlo_anastesi', 'tlo_ket1', 'tlo_ket2', 'tlo_ket3', 'hg_ruangan', 'hg_kamaroperasi', 'hg_anastesi', 'hg_ket1', 'hg_ket2', 'hg_ket3', 'fk_ruangan', 'fk_kamaroperasi', 'fk_anastesi', 'fk_ket1', 'fk_ket2', 'fk_ket3', 'hl_ruangan', 'hl_kamaroperasi', 'hl_anastesi', 'hl_ket1', 'hl_ket2', 'hl_ket3', 'rontgen_ruangan', 'rontgen_kamaroperasi', 'rontgen_anastesi', 'rontgen_ket1', 'rontgen_ket2', 'rontgen_ket3', 'usg_ruangan', 'usg_kamaroperasi', 'usg_anastesi', 'usg_ket1', 'usg_ket2', 'usg_ket3', 'ct_scan_ruangan', 'ct_scan_kamaroperasi', 'ct_scan_anestesi', 'ct_scan_ket1', 'ct_scan_ket2', 'ct_scan_ket3', 'ekg_ruangan', 'ekg_kamaroperasi', 'ekg_anastesi', 'ekg_ket1', 'ekg_ket2', 'ekg_ket3', 'echo_ruangan', 'echo_kamaroperasi', 'echo_anastesi', 'echo_ket1', 'echo_ket2', 'echo_ket3', 'pda_ruangan', 'pda_kamaroperasi', 'pda_anastesi', 'pda_ket1', 'pda_ket2', 'pda_ket3', 't4_ruangan', 't4_kamaroperasi', 't4_anastesi', 't4_ket1', 't4_ket2', 't4_ket3', 'propilaksis_ruangan', 'propilaksis_kamaroperasi', 'propilaksis_anastesi', 'propilaksis_ket1', 'propilaksis_ket2', 'propilaksis_ket3', 'alergi_obat_ruangan', 'alergi_obat_kamaroperasi', 'alergi_obat_anastesi', 'alergi_obat_ket1', 'alergi_obat_ket2', 'alergi_obat_ket3', 'tekanan_darah_ruangan', 'tekanan_darah_kamaroperasi', 'tekanan_darah_anastesi', 'tekanan_darah_ket1', 'tekanan_darah_ket2', 'tekanan_darah_ket3', 'nadi_ruangan', 'nadi_kamaroperasi', 'nadi_anastesi', 'nadi_ket1', 'nadi_ket2', 'nadi_ket3', 'suhu_ruangan', 'suhu_kamaroperasi', 'suhu_anastesi', 'suhu_ket1', 'suhu_ket2', 'suhu_ket3', 'pernapasan_ruangan', 'pernapasan_kamaroperasi', 'pernapasan_anastesi', 'pernapasan_ket1', 'pernapasan_ket2', 'pernapasan_ket3', 'pendidikan_kesehatan_diberikan', 'obat', 'tanggal_operasi', 'created_at', 'updated_at', 'log_data'], 'safe'],
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
    public function search($params,$layanan,$user)
    {
        $query = AsessmenPreoperasi::find();
        $query->joinWith([
            'perawatRuangan',
            'layananRuangan'=>
                function($query) use($layanan){
                    if($layanan['jenis_layanan']===Layanan::RI){
                        $query->andWhere([Layanan::tableName().'.jenis_layanan'=>Layanan::RI,Layanan::tableName().'.registrasi_kode'=>$layanan['registrasi_kode']]);
                    }else{
                        //RJ/IGD/PENUNJANG
                        $query->andWhere([Layanan::tableName().'.id'=>$layanan['id']]);
                    }
                }
            ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        return $dataProvider;
    }
}
