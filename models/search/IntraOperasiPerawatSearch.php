<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\IntraOperasiPerawat;

/**
 * IntraOperasiPerawatSearch represents the model behind the search form of `app\models\bedahsentral\IntraOperasiPerawat`.
 */
class IntraOperasiPerawatSearch extends IntraOperasiPerawat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['iop_id', 'iop_to_id', 'iop_final', 'iop_batal', 'iop_mdcp_id', 'iop_created_by', 'iop_updated_by', 'iop_deleted_by'], 'integer'],
            [['iop_jam_masuk_ok', 'iop_jam_keluar_ok', 'iop_jam_mulai_anestesi', 'iop_jam_selesai_anestesi', 'iop_jam_mulai_bedah', 'iop_jam_selesai_bedah', 'iop_jenis_pembiusan', 'iop_type_operasi', 'iop_posisi_kanul_intravena', 'iop_posisi_operasi', 'iop_jenis_operasi', 'iop_posisi_tangan', 'iop_kateter_urin', 'iop_ku_dipasang_oleh', 'iop_disenfeksi_kulit', 'iop_insisi_kulit', 'iop_esu', 'iop_esu_dipasang_oleh', 'iop_lok_ntrl_elektroda', 'iop_pemeriksaan_kulit_pra_bedah', 'iop_pemeriksaan_kulit_pasca_bedah', 'iop_unit_penghangat', 'iop_unit_penghangat_jam_mulai', 'iop_unit_penghangat_temperatur', 'iop_unit_penghangat_jam_selesai', 'iop_tourniquet', 'iop_implant', 'iop_drainage', 'iop_irigasi_luka', 'iop_tamplon', 'iop_pemeriksaan_jaringan', 'iop_pernapasan', 'iop_tekanan_darah_sistole', 'iop_tekanan_darah_diastole', 'iop_nadi', 'iop_suhu', 'iop_kesadaran', 'iop_status_emosi', 'iop_bowel', 'iop_integritas_kulit', 'iop_tulang', 'iop_masalah', 'iop_tindakan', 'iop_implementasi', 'iop_evaluasi', 'iop_tgl_final', 'iop_tgl_batal', 'iop_created_at', 'iop_updated_at', 'iop_deleted_at'], 'safe'],
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
        $query = IntraOperasiPerawat::find();

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
            'iop_id' => $this->iop_id,
            'iop_to_id' => $this->iop_to_id,
            'iop_jam_masuk_ok' => $this->iop_jam_masuk_ok,
            'iop_jam_keluar_ok' => $this->iop_jam_keluar_ok,
            'iop_jam_mulai_anestesi' => $this->iop_jam_mulai_anestesi,
            'iop_jam_selesai_anestesi' => $this->iop_jam_selesai_anestesi,
            'iop_jam_mulai_bedah' => $this->iop_jam_mulai_bedah,
            'iop_jam_selesai_bedah' => $this->iop_jam_selesai_bedah,
            'iop_unit_penghangat_jam_mulai' => $this->iop_unit_penghangat_jam_mulai,
            'iop_unit_penghangat_jam_selesai' => $this->iop_unit_penghangat_jam_selesai,
            'iop_final' => $this->iop_final,
            'iop_tgl_final' => $this->iop_tgl_final,
            'iop_batal' => $this->iop_batal,
            'iop_tgl_batal' => $this->iop_tgl_batal,
            'iop_mdcp_id' => $this->iop_mdcp_id,
            'iop_created_at' => $this->iop_created_at,
            'iop_created_by' => $this->iop_created_by,
            'iop_updated_at' => $this->iop_updated_at,
            'iop_updated_by' => $this->iop_updated_by,
            'iop_deleted_at' => $this->iop_deleted_at,
            'iop_deleted_by' => $this->iop_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'iop_jenis_pembiusan', $this->iop_jenis_pembiusan])
            ->andFilterWhere(['ilike', 'iop_type_operasi', $this->iop_type_operasi])
            ->andFilterWhere(['ilike', 'iop_posisi_kanul_intravena', $this->iop_posisi_kanul_intravena])
            ->andFilterWhere(['ilike', 'iop_posisi_operasi', $this->iop_posisi_operasi])
            ->andFilterWhere(['ilike', 'iop_jenis_operasi', $this->iop_jenis_operasi])
            ->andFilterWhere(['ilike', 'iop_posisi_tangan', $this->iop_posisi_tangan])
            ->andFilterWhere(['ilike', 'iop_kateter_urin', $this->iop_kateter_urin])
            ->andFilterWhere(['ilike', 'iop_ku_dipasang_oleh', $this->iop_ku_dipasang_oleh])
            ->andFilterWhere(['ilike', 'iop_disenfeksi_kulit', $this->iop_disenfeksi_kulit])
            ->andFilterWhere(['ilike', 'iop_insisi_kulit', $this->iop_insisi_kulit])
            ->andFilterWhere(['ilike', 'iop_esu', $this->iop_esu])
            ->andFilterWhere(['ilike', 'iop_esu_dipasang_oleh', $this->iop_esu_dipasang_oleh])
            ->andFilterWhere(['ilike', 'iop_lok_ntrl_elektroda', $this->iop_lok_ntrl_elektroda])
            ->andFilterWhere(['ilike', 'iop_pemeriksaan_kulit_pra_bedah', $this->iop_pemeriksaan_kulit_pra_bedah])
            ->andFilterWhere(['ilike', 'iop_pemeriksaan_kulit_pasca_bedah', $this->iop_pemeriksaan_kulit_pasca_bedah])
            ->andFilterWhere(['ilike', 'iop_unit_penghangat', $this->iop_unit_penghangat])
            ->andFilterWhere(['ilike', 'iop_unit_penghangat_temperatur', $this->iop_unit_penghangat_temperatur])
            ->andFilterWhere(['ilike', 'iop_tourniquet', $this->iop_tourniquet])
            ->andFilterWhere(['ilike', 'iop_implant', $this->iop_implant])
            ->andFilterWhere(['ilike', 'iop_drainage', $this->iop_drainage])
            ->andFilterWhere(['ilike', 'iop_irigasi_luka', $this->iop_irigasi_luka])
            ->andFilterWhere(['ilike', 'iop_tamplon', $this->iop_tamplon])
            ->andFilterWhere(['ilike', 'iop_pemeriksaan_jaringan', $this->iop_pemeriksaan_jaringan])
            ->andFilterWhere(['ilike', 'iop_pernapasan', $this->iop_pernapasan])
            ->andFilterWhere(['ilike', 'iop_tekanan_darah_sistole', $this->iop_tekanan_darah_sistole])
            ->andFilterWhere(['ilike', 'iop_tekanan_darah_diastole', $this->iop_tekanan_darah_diastole])
            ->andFilterWhere(['ilike', 'iop_nadi', $this->iop_nadi])
            ->andFilterWhere(['ilike', 'iop_suhu', $this->iop_suhu])
            ->andFilterWhere(['ilike', 'iop_kesadaran', $this->iop_kesadaran])
            ->andFilterWhere(['ilike', 'iop_status_emosi', $this->iop_status_emosi])
            ->andFilterWhere(['ilike', 'iop_bowel', $this->iop_bowel])
            ->andFilterWhere(['ilike', 'iop_integritas_kulit', $this->iop_integritas_kulit])
            ->andFilterWhere(['ilike', 'iop_tulang', $this->iop_tulang])
            ->andFilterWhere(['ilike', 'iop_masalah', $this->iop_masalah])
            ->andFilterWhere(['ilike', 'iop_tindakan', $this->iop_tindakan])
            ->andFilterWhere(['ilike', 'iop_implementasi', $this->iop_implementasi])
            ->andFilterWhere(['ilike', 'iop_evaluasi', $this->iop_evaluasi]);

        return $dataProvider;
    }
}
