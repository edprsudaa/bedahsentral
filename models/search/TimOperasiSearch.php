<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\TimOperasi;

/**
 * TimOperasiSearch represents the model behind the search form of `app\models\bedahsentral\TimOperasi`.
 */
class TimOperasiSearch extends TimOperasi
{
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['to_id', 'to_pl_id', 'to_ok_pl_id', 'to_ruang_asal_pl_id', 'to_ok_unt_id', 'to_jenis_operasi_cito'], 'integer'],
      [['to_diagnosa_medis_pra_bedah', 'to_diagnosa_medis_pasca_bedah', 'to_tindakan_operasi', 'to_tanggal_operasi', 'created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'safe'],
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
    $query = TimOperasi::find();

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
      'to_id' => $this->to_id,
      'to_pl_id' => $this->to_pl_id,
      'to_ok_pl_id' => $this->to_ok_pl_id,
      'to_ruang_asal_pl_id' => $this->to_ruang_asal_pl_id,
      'to_ok_unt_id' => $this->to_ok_unt_id,
      'to_jenis_operasi_cito' => $this->to_jenis_operasi_cito,
      'to_tanggal_operasi' => $this->to_tanggal_operasi,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ]);

    $query->andFilterWhere(['ilike', 'to_diagnosa_medis_pra_bedah', $this->to_diagnosa_medis_pra_bedah])
      ->andFilterWhere(['ilike', 'to_diagnosa_medis_pasca_bedah', $this->to_diagnosa_medis_pasca_bedah])
      ->andFilterWhere(['ilike', 'to_tindakan_operasi', $this->to_tindakan_operasi])
      ->andFilterWhere(['ilike', 'created_by', $this->created_by])
      ->andFilterWhere(['ilike', 'updated_by', $this->updated_by])
      ->andFilterWhere(['ilike', 'deleted_by', $this->deleted_by]);

    return $dataProvider;
  }
}
