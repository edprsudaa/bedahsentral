<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\PembatalanOperasi;

/**
 * PembatalanOperasiSearch represents the model behind the search form of `app\models\bedahsentral\PembatalanOperasi`.
 */
class PembatalanOperasiSearch extends PembatalanOperasi
{
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['bat_id', 'bat_to_id', 'bat_dpjp_anestesi', 'bat_dpjp_bedah', 'bat_karu', 'bat_created_by', 'bat_updated_by', 'bat_deleted_by', 'bat_final', 'bat_batal'], 'integer'],
      [['bat_diagnosa', 'bat_tindakan', 'bat_tanggal_tunda', 'bat_alasan_pasien', 'bat_alasan_pasien_lain', 'bat_alasan_operator', 'bat_alasan_operator_lain', 'bat_alasan_faskamop', 'bat_alasan_faskamop_lain', 'bat_alasan_ruang_perawatan', 'bat_alasan_ruang_perawatan_lain', 'bat_created_at', 'bat_updated_at', 'bat_deleted_at', 'bat_tgl_final', 'bat_tgl_batal'], 'safe'],
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
    $query = PembatalanOperasi::find();

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
      'bat_id' => $this->bat_id,
      'bat_to_id' => $this->bat_to_id,
      'bat_tanggal_tunda' => $this->bat_tanggal_tunda,
      'bat_created_at' => $this->bat_created_at,
      'bat_created_by' => $this->bat_created_by,
      'bat_updated_at' => $this->bat_updated_at,
      'bat_updated_by' => $this->bat_updated_by,
      'bat_deleted_at' => $this->bat_deleted_at,
      'bat_deleted_by' => $this->bat_deleted_by,
    ]);

    $query->andFilterWhere(['ilike', 'bat_alasan_pasien', $this->bat_alasan_pasien])
      ->andFilterWhere(['ilike', 'bat_alasan_pasien_lain', $this->bat_alasan_pasien_lain])
      ->andFilterWhere(['ilike', 'bat_alasan_operator', $this->bat_alasan_operator])
      ->andFilterWhere(['ilike', 'bat_alasan_operator_lain', $this->bat_alasan_operator_lain])
      ->andFilterWhere(['ilike', 'bat_alasan_faskamop', $this->bat_alasan_faskamop])
      ->andFilterWhere(['ilike', 'bat_alasan_faskamop_lain', $this->bat_alasan_faskamop_lain])
      ->andFilterWhere(['ilike', 'bat_alasan_ruang_perawatan', $this->bat_alasan_ruang_perawatan])
      ->andFilterWhere(['ilike', 'bat_alasan_ruang_perawatan_lain', $this->bat_alasan_ruang_perawatan_lain]);

    return $dataProvider;
  }
}
