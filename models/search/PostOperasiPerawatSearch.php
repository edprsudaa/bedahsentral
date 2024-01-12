<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\PostOperasiPerawat;

/**
 * PostOperasiPerawatSearch represents the model behind the search form of `app\models\bedahsentral\PostOperasiPerawat`.
 */
class PostOperasiPerawatSearch extends PostOperasiPerawat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['psop_id', 'psop_to_id', 'psop_iop_id', 'psop_final', 'psop_batal', 'psop_mdcp_id', 'psop_created_by', 'psop_updated_by', 'psop_deleted_by'], 'integer'],
            [['psop_ruang_pemulihan', 'psop_masuk_rr', 'psop_keluar_rr', 'psop_keadaan_umum', 'psop_tingkat_kesadaran', 'psop_status_emosi', 'psop_e', 'psop_m', 'psop_v', 'psop_total_gcs', 'psop_tekanan_darah_sistole', 'psop_tekanan_darah_diastole', 'psop_nadi', 'psop_suhu', 'psop_pernapasan', 'psop_sirkulasi', 'psop_turgor_kulit', 'psop_posisi_klien', 'psop_pasang_drain', 'psop_jaringan_pa_form', 'psop_serah_keluarga', 'psop_resep', 'psop_jam_panggil_perawat_ruangan', 'psop_jam_perawat_datang', 'psop_barang_diserahkan_via_prwt_rgn', 'psop_pesan_khusus', 'psop_bedrest', 'psop_puasa', 'psop_head_up', 'psop_resep_obat_post_operasi', 'psop_penilaian_nyeri', 'psop_integritas_kulit', 'psop_tulang', 'psop_masalah', 'psop_tindakan', 'psop_implementasi', 'psop_evaluasi', 'psop_tgl_final', 'psop_tgl_batal', 'psop_created_at', 'psop_updated_at', 'psop_deleted_at'], 'safe'],
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
        $query = PostOperasiPerawat::find();

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
            'psop_id' => $this->psop_id,
            'psop_to_id' => $this->psop_to_id,
            'psop_iop_id' => $this->psop_iop_id,
            'psop_masuk_rr' => $this->psop_masuk_rr,
            'psop_keluar_rr' => $this->psop_keluar_rr,
            'psop_jam_panggil_perawat_ruangan' => $this->psop_jam_panggil_perawat_ruangan,
            'psop_jam_perawat_datang' => $this->psop_jam_perawat_datang,
            'psop_final' => $this->psop_final,
            'psop_tgl_final' => $this->psop_tgl_final,
            'psop_batal' => $this->psop_batal,
            'psop_tgl_batal' => $this->psop_tgl_batal,
            'psop_mdcp_id' => $this->psop_mdcp_id,
            'psop_created_at' => $this->psop_created_at,
            'psop_created_by' => $this->psop_created_by,
            'psop_updated_at' => $this->psop_updated_at,
            'psop_updated_by' => $this->psop_updated_by,
            'psop_deleted_at' => $this->psop_deleted_at,
            'psop_deleted_by' => $this->psop_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'psop_ruang_pemulihan', $this->psop_ruang_pemulihan])
            ->andFilterWhere(['ilike', 'psop_keadaan_umum', $this->psop_keadaan_umum])
            ->andFilterWhere(['ilike', 'psop_tingkat_kesadaran', $this->psop_tingkat_kesadaran])
            ->andFilterWhere(['ilike', 'psop_status_emosi', $this->psop_status_emosi])
            ->andFilterWhere(['ilike', 'psop_e', $this->psop_e])
            ->andFilterWhere(['ilike', 'psop_m', $this->psop_m])
            ->andFilterWhere(['ilike', 'psop_v', $this->psop_v])
            ->andFilterWhere(['ilike', 'psop_total_gcs', $this->psop_total_gcs])
            ->andFilterWhere(['ilike', 'psop_tekanan_darah_sistole', $this->psop_tekanan_darah_sistole])
            ->andFilterWhere(['ilike', 'psop_tekanan_darah_diastole', $this->psop_tekanan_darah_diastole])
            ->andFilterWhere(['ilike', 'psop_nadi', $this->psop_nadi])
            ->andFilterWhere(['ilike', 'psop_suhu', $this->psop_suhu])
            ->andFilterWhere(['ilike', 'psop_pernapasan', $this->psop_pernapasan])
            ->andFilterWhere(['ilike', 'psop_sirkulasi', $this->psop_sirkulasi])
            ->andFilterWhere(['ilike', 'psop_turgor_kulit', $this->psop_turgor_kulit])
            ->andFilterWhere(['ilike', 'psop_posisi_klien', $this->psop_posisi_klien])
            ->andFilterWhere(['ilike', 'psop_pasang_drain', $this->psop_pasang_drain])
            ->andFilterWhere(['ilike', 'psop_jaringan_pa_form', $this->psop_jaringan_pa_form])
            ->andFilterWhere(['ilike', 'psop_serah_keluarga', $this->psop_serah_keluarga])
            ->andFilterWhere(['ilike', 'psop_resep', $this->psop_resep])
            ->andFilterWhere(['ilike', 'psop_barang_diserahkan_via_prwt_rgn', $this->psop_barang_diserahkan_via_prwt_rgn])
            ->andFilterWhere(['ilike', 'psop_pesan_khusus', $this->psop_pesan_khusus])
            ->andFilterWhere(['ilike', 'psop_bedrest', $this->psop_bedrest])
            ->andFilterWhere(['ilike', 'psop_puasa', $this->psop_puasa])
            ->andFilterWhere(['ilike', 'psop_head_up', $this->psop_head_up])
            ->andFilterWhere(['ilike', 'psop_resep_obat_post_operasi', $this->psop_resep_obat_post_operasi])
            ->andFilterWhere(['ilike', 'psop_penilaian_nyeri', $this->psop_penilaian_nyeri])
            ->andFilterWhere(['ilike', 'psop_integritas_kulit', $this->psop_integritas_kulit])
            ->andFilterWhere(['ilike', 'psop_tulang', $this->psop_tulang])
            ->andFilterWhere(['ilike', 'psop_masalah', $this->psop_masalah])
            ->andFilterWhere(['ilike', 'psop_tindakan', $this->psop_tindakan])
            ->andFilterWhere(['ilike', 'psop_implementasi', $this->psop_implementasi])
            ->andFilterWhere(['ilike', 'psop_evaluasi', $this->psop_evaluasi]);

        return $dataProvider;
    }
}
