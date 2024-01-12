<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\InformConcentTindakanDokter;

/**
 * InformConcentTindakanDokter represents the model behind the search form of `app\models\medis\InformConcentTindakanDokter`.
 */
class InformConcentTindakanDokterSearch extends InformConcentTindakanDokter
{
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['incon_id', 'incon_pl_id', 'incon_dokter_pgw_id', 'incon_setuju', 'incon_final', 'incon_batal', 'incon_mdcp_id', 'incon_created_by', 'incon_updated_by', 'incon_deleted_by'], 'integer'],
      [['incon_tindakan_inform_consent', 'incon_informasi_diagnosis', 'incon_informasi_dasar_diagnosis', 'incon_informasi_tindakan_operasi', 'incon_informasi_tindakan_pembiusan', 'incon_informasi_indikasi_tindakan', 'incon_informasi_tata_cara', 'incon_informasi_tujuan', 'incon_informasi_resiko', 'incon_informasi_komplikasi', 'incon_informasi_prognosis', 'incon_informasi_alternatif_dan_resiko', 'incon_informasi_pemberian_analgetik_pasca_anestesi', 'incon_keluarga_nama', 'incon_keluarga_umur', 'incon_keluarga_jenis_kelamin', 'incon_keluarga_alamat', 'incon_pasien_nama', 'incon_pasien_tanggal_lahir', 'incon_pasien_jenis_kelamin', 'incon_pasien_alamat', 'incon_tgl_final', 'incon_tgl_batal', 'incon_created_at', 'incon_updated_at', 'incon_deleted_at'], 'safe'],
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
    $query = InformConcentTindakanDokter::find();

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
      'incon_id' => $this->incon_id,
      'incon_pl_id' => $this->incon_pl_id,
      'incon_dokter_pgw_id' => $this->incon_dokter_pgw_id,
      'incon_pasien_tanggal_lahir' => $this->incon_pasien_tanggal_lahir,
      'incon_setuju' => $this->incon_setuju,
      'incon_final' => $this->incon_final,
      'incon_tgl_final' => $this->incon_tgl_final,
      'incon_batal' => $this->incon_batal,
      'incon_tgl_batal' => $this->incon_tgl_batal,
      'incon_mdcp_id' => $this->incon_mdcp_id,
      'incon_created_at' => $this->incon_created_at,
      'incon_created_by' => $this->incon_created_by,
      'incon_updated_at' => $this->incon_updated_at,
      'incon_updated_by' => $this->incon_updated_by,
      'incon_deleted_at' => $this->incon_deleted_at,
      'incon_deleted_by' => $this->incon_deleted_by,
    ]);

    $query->andFilterWhere(['ilike', 'incon_tindakan_inform_consent', $this->incon_tindakan_inform_consent])
      ->andFilterWhere(['ilike', 'incon_informasi_diagnosis', $this->incon_informasi_diagnosis])
      ->andFilterWhere(['ilike', 'incon_informasi_dasar_diagnosis', $this->incon_informasi_dasar_diagnosis])
      ->andFilterWhere(['ilike', 'incon_informasi_tindakan_operasi', $this->incon_informasi_tindakan_operasi])
      ->andFilterWhere(['ilike', 'incon_informasi_tindakan_pembiusan', $this->incon_informasi_tindakan_pembiusan])
      ->andFilterWhere(['ilike', 'incon_informasi_indikasi_tindakan', $this->incon_informasi_indikasi_tindakan])
      ->andFilterWhere(['ilike', 'incon_informasi_tata_cara', $this->incon_informasi_tata_cara])
      ->andFilterWhere(['ilike', 'incon_informasi_tujuan', $this->incon_informasi_tujuan])
      ->andFilterWhere(['ilike', 'incon_informasi_resiko', $this->incon_informasi_resiko])
      ->andFilterWhere(['ilike', 'incon_informasi_komplikasi', $this->incon_informasi_komplikasi])
      ->andFilterWhere(['ilike', 'incon_informasi_prognosis', $this->incon_informasi_prognosis])
      ->andFilterWhere(['ilike', 'incon_informasi_alternatif_dan_resiko', $this->incon_informasi_alternatif_dan_resiko])
      ->andFilterWhere(['ilike', 'incon_informasi_pemberian_analgetik_pasca_anestesi', $this->incon_informasi_pemberian_analgetik_pasca_anestesi])
      ->andFilterWhere(['ilike', 'incon_keluarga_nama', $this->incon_keluarga_nama])
      ->andFilterWhere(['ilike', 'incon_keluarga_umur', $this->incon_keluarga_umur])
      ->andFilterWhere(['ilike', 'incon_keluarga_jenis_kelamin', $this->incon_keluarga_jenis_kelamin])
      ->andFilterWhere(['ilike', 'incon_keluarga_alamat', $this->incon_keluarga_alamat])
      ->andFilterWhere(['ilike', 'incon_pasien_nama', $this->incon_pasien_nama])
      ->andFilterWhere(['ilike', 'incon_pasien_jenis_kelamin', $this->incon_pasien_jenis_kelamin])
      ->andFilterWhere(['ilike', 'incon_pasien_alamat', $this->incon_pasien_alamat]);

    return $dataProvider;
  }
}
