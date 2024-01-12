<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\LembarEdukasiTindakanAnestesi;

/**
 * LembarEdukasiTindakanAnestesiSearch represents the model behind the search form of `app\models\bedahsentral\LembarEdukasiTindakanAnestesi`.
 */
class LembarEdukasiTindakanAnestesiSearch extends LembarEdukasiTindakanAnestesi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['leta_id', 'leta_to_id', 'leta_dokter_yg_mejelaskan', 'leta_kelebihan_anestesi_umum', 'leta_kekurangan_anestesi_umum', 'leta_komplikasi_anestesi_umum', 'leta_kelebihan_anestesi_regional', 'leta_kekurangan_anestesi_regional', 'leta_komplikasi_anestesi_regional', 'leta_kelebihan_anestesi_lokal', 'leta_kekurangan_anestesi_lokal', 'leta_komplikasi_anestesi_lokal', 'leta_kelebihan_sedasi', 'leta_kekurangan_sedasi', 'leta_komplikasi_sedasi', 'leta_setuju', 'leta_final', 'leta_batal', 'leta_created_by', 'leta_updated_by', 'leta_deleted_by'], 'integer'],
            [['leta_keluarga_nama', 'leta_keluarga_umur', 'leta_keluarga_jenis_kelamin', 'leta_keluarga_alamat', 'leta_keluarga_no_identitas', 'leta_keluarga_hubunga_dgn_pasien', 'leta_pasien_nama', 'leta_pasien_tgl_lahir', 'leta_pasien_no_rekam_medis', 'leta_pasien_diagnosa', 'leta_pasien_rencana_tindakan', 'leta_pasien_jenis_anestesi', 'leta_pasien_analgesi_pasca_anestesi', 'leta_tanggal_persetujuan', 'leta_tgl_final', 'leta_tgl_batal', 'leta_created_at', 'leta_updated_at', 'leta_deleted_at'], 'safe'],
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
        $query = LembarEdukasiTindakanAnestesi::find();

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
            'leta_id' => $this->leta_id,
            'leta_to_id' => $this->leta_to_id,
            'leta_dokter_yg_mejelaskan' => $this->leta_dokter_yg_mejelaskan,
            'leta_kelebihan_anestesi_umum' => $this->leta_kelebihan_anestesi_umum,
            'leta_kekurangan_anestesi_umum' => $this->leta_kekurangan_anestesi_umum,
            'leta_komplikasi_anestesi_umum' => $this->leta_komplikasi_anestesi_umum,
            'leta_kelebihan_anestesi_regional' => $this->leta_kelebihan_anestesi_regional,
            'leta_kekurangan_anestesi_regional' => $this->leta_kekurangan_anestesi_regional,
            'leta_komplikasi_anestesi_regional' => $this->leta_komplikasi_anestesi_regional,
            'leta_kelebihan_anestesi_lokal' => $this->leta_kelebihan_anestesi_lokal,
            'leta_kekurangan_anestesi_lokal' => $this->leta_kekurangan_anestesi_lokal,
            'leta_komplikasi_anestesi_lokal' => $this->leta_komplikasi_anestesi_lokal,
            'leta_kelebihan_sedasi' => $this->leta_kelebihan_sedasi,
            'leta_kekurangan_sedasi' => $this->leta_kekurangan_sedasi,
            'leta_komplikasi_sedasi' => $this->leta_komplikasi_sedasi,
            'leta_pasien_tgl_lahir' => $this->leta_pasien_tgl_lahir,
            'leta_tanggal_persetujuan' => $this->leta_tanggal_persetujuan,
            'leta_setuju' => $this->leta_setuju,
            'leta_final' => $this->leta_final,
            'leta_tgl_final' => $this->leta_tgl_final,
            'leta_batal' => $this->leta_batal,
            'leta_tgl_batal' => $this->leta_tgl_batal,
            'leta_created_at' => $this->leta_created_at,
            'leta_created_by' => $this->leta_created_by,
            'leta_updated_at' => $this->leta_updated_at,
            'leta_updated_by' => $this->leta_updated_by,
            'leta_deleted_at' => $this->leta_deleted_at,
            'leta_deleted_by' => $this->leta_deleted_by,
        ]);

        $query->andFilterWhere(['ilike', 'leta_keluarga_nama', $this->leta_keluarga_nama])
            ->andFilterWhere(['ilike', 'leta_keluarga_umur', $this->leta_keluarga_umur])
            ->andFilterWhere(['ilike', 'leta_keluarga_jenis_kelamin', $this->leta_keluarga_jenis_kelamin])
            ->andFilterWhere(['ilike', 'leta_keluarga_alamat', $this->leta_keluarga_alamat])
            ->andFilterWhere(['ilike', 'leta_keluarga_no_identitas', $this->leta_keluarga_no_identitas])
            ->andFilterWhere(['ilike', 'leta_keluarga_hubunga_dgn_pasien', $this->leta_keluarga_hubunga_dgn_pasien])
            ->andFilterWhere(['ilike', 'leta_pasien_nama', $this->leta_pasien_nama])
            ->andFilterWhere(['ilike', 'leta_pasien_no_rekam_medis', $this->leta_pasien_no_rekam_medis])
            ->andFilterWhere(['ilike', 'leta_pasien_diagnosa', $this->leta_pasien_diagnosa])
            ->andFilterWhere(['ilike', 'leta_pasien_rencana_tindakan', $this->leta_pasien_rencana_tindakan])
            ->andFilterWhere(['ilike', 'leta_pasien_jenis_anestesi', $this->leta_pasien_jenis_anestesi])
            ->andFilterWhere(['ilike', 'leta_pasien_analgesi_pasca_anestesi', $this->leta_pasien_analgesi_pasca_anestesi]);

        return $dataProvider;
    }
}
