<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bedahsentral\PenggunaanJumlahKasaDanInstrumen;

/**
 * PenggunaanJumlahKasaDanInstrumenSearch represents the model behind the search form of `app\models\bedahsentral\PenggunaanJumlahKasaDanInstrumen`.
 */
class PenggunaanJumlahKasaDanInstrumenSearch extends PenggunaanJumlahKasaDanInstrumen
{
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['pjki_id', 'pjki_to_id', 'pjki_final', 'pjki_batal', 'pjki_mdcp_id', 'pjki_created_by', 'pjki_updated_by', 'pjki_deleted_by'], 'integer'],
      [['pjki_tangkai_pisau_hitungan_pertama', 'pjki_tangkai_pisau_tambahan_slma_operasi', 'pjki_tangkai_pisau_jumlah', 'pjki_tangkai_pisau_dipakai', 'pjki_tangkai_pisau_sisa', 'pjki_pinset_anatomis_hitungan_pertama', 'pjki_pinset_anatomis_tambahan_slma_operasi', 'pjki_pinset_anatomis_jumlah', 'pjki_pinset_anatomis_dipakai', 'pjki_pinset_anatomis_sisa', 'pjki_pinset_chrirurgis_hitungan_pertama', 'pjki_pinset_chrirurgis_tambahan_slma_operasi', 'pjki_pinset_chrirurgis_jumlah', 'pjki_pinset_chrirurgis_dipakai', 'pjki_pinset_chrirurgis_sisa', 'pjki_gunting_benang_hitungan_pertama', 'pjki_gunting_benang_tambahan_slma_operasi', 'pjki_gunting_benang_jumlah', 'pjki_gunting_benang_dipakai', 'pjki_gunting_benang_sisa', 'pjki_gunting_jaringan_hitungan_pertama', 'pjki_gunting_jaringan_tambahan_slma_operasi', 'pjki_gunting_jaringan_jumlah', 'pjki_gunting_jaringan_dipakai', 'pjki_gunting_jaringan_sisa', 'pjki_mosquito_pean_hitungan_pertama', 'pjki_mosquito_pean_tambahan_slma_operasi', 'pjki_mosquito_pean_jumlah', 'pjki_mosquito_pean_dipakai', 'pjki_mosquito_pean_sisa', 'pjki_pean_lurus_hitungan_pertama', 'pjki_pean_lurus_tambahan_slma_operasi', 'pjki_pean_lurus_jumlah', 'pjki_pean_lurus_dipakai', 'pjki_pean_lurus_sisa', 'pjki_pean_bengkok_hitungan_pertama', 'pjki_pean_bengkok_tambahan_slma_operasi', 'pjki_pean_bengkok_jumlah', 'pjki_pean_bengkok_dipakai', 'pjki_pean_bengkok_sisa', 'pjki_duk_klem_hitungan_pertama', 'pjki_duk_klem_tambahan_slma_operasi', 'pjki_duk_klem_jumlah', 'pjki_duk_klem_dipakai', 'pjki_duk_klem_sisa', 'pjki_needle_holder_hitungan_pertama', 'pjki_needle_holder_tambahan_slma_operasi', 'pjki_needle_holder_jumlah', 'pjki_needle_holder_dipakai', 'pjki_needle_holder_sisa', 'pjki_kocher_hitungan_pertama', 'pjki_kocher_tambahan_slma_operasi', 'pjki_kocher_jumlah', 'pjki_kocher_dipakai', 'pjki_kocher_sisa', 'pjki_needle_atrumatic_hitungan_pertama', 'pjki_needle_atrumatic_tambahan_slma_operasi', 'pjki_needle_atrumatic_jumlah', 'pjki_needle_atrumatic_dipakai', 'pjki_needle_atrumatic_sisa', 'pjki_kassa_hitungan_pertama', 'pjki_kassa_tambahan_slma_operasi', 'pjki_kassa_jumlah', 'pjki_kassa_dipakai', 'pjki_kassa_sisa', 'pjki_roll_kassa_hitungan_pertama', 'pjki_roll_kassa_tambahan_slma_operasi', 'pjki_roll_kassa_jumlah', 'pjki_roll_kassa_dipakai', 'pjki_roll_kassa_sisa', 'pjki_depper_hitungan_pertama', 'pjki_depper_tambahan_slma_operasi', 'pjki_depper_jumlah', 'pjki_depper_dipakai', 'pjki_depper_sisa', 'pjki_kacang_hitungan_pertama', 'pjki_kacang_tambahan_slma_operasi', 'pjki_kacang_jumlah', 'pjki_kacang_dipakai', 'pjki_kacang_sisa', 'pjki_lidi_waten_hitungan_pertama', 'pjki_lidi_waten_tambahan_slma_operasi', 'pjki_lidi_waten_jumlah', 'pjki_lidi_waten_dipakai', 'pjki_lidi_waten_sisa', 'pjki_tgl_final', 'pjki_pasien_keluar_kamar_operasi', 'pjki_tgl_batal', 'pjki_created_at', 'pjki_updated_at', 'pjki_deleted_at'], 'safe'],
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
    $query = PenggunaanJumlahKasaDanInstrumen::find();

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
      'pjki_id' => $this->pjki_id,
      'pjki_to_id' => $this->pjki_to_id,
      'pjki_final' => $this->pjki_final,
      'pjki_tgl_final' => $this->pjki_tgl_final,
      'pjki_batal' => $this->pjki_batal,
      'pjki_tgl_batal' => $this->pjki_tgl_batal,
      'pjki_mdcp_id' => $this->pjki_mdcp_id,
      'pjki_pasien_keluar_kamar_operasi' => $this->pjki_pasien_keluar_kamar_operasi,
      'pjki_created_at' => $this->pjki_created_at,
      'pjki_created_by' => $this->pjki_created_by,
      'pjki_updated_at' => $this->pjki_updated_at,
      'pjki_updated_by' => $this->pjki_updated_by,
      'pjki_deleted_at' => $this->pjki_deleted_at,
      'pjki_deleted_by' => $this->pjki_deleted_by,
    ]);

    $query->andFilterWhere(['ilike', 'pjki_tangkai_pisau_hitungan_pertama', $this->pjki_tangkai_pisau_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_tangkai_pisau_tambahan_slma_operasi', $this->pjki_tangkai_pisau_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_tangkai_pisau_jumlah', $this->pjki_tangkai_pisau_jumlah])
      ->andFilterWhere(['ilike', 'pjki_tangkai_pisau_dipakai', $this->pjki_tangkai_pisau_dipakai])
      ->andFilterWhere(['ilike', 'pjki_tangkai_pisau_sisa', $this->pjki_tangkai_pisau_sisa])
      ->andFilterWhere(['ilike', 'pjki_pinset_anatomis_hitungan_pertama', $this->pjki_pinset_anatomis_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_pinset_anatomis_tambahan_slma_operasi', $this->pjki_pinset_anatomis_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_pinset_anatomis_jumlah', $this->pjki_pinset_anatomis_jumlah])
      ->andFilterWhere(['ilike', 'pjki_pinset_anatomis_dipakai', $this->pjki_pinset_anatomis_dipakai])
      ->andFilterWhere(['ilike', 'pjki_pinset_anatomis_sisa', $this->pjki_pinset_anatomis_sisa])
      ->andFilterWhere(['ilike', 'pjki_pinset_chrirurgis_hitungan_pertama', $this->pjki_pinset_chrirurgis_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_pinset_chrirurgis_tambahan_slma_operasi', $this->pjki_pinset_chrirurgis_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_pinset_chrirurgis_jumlah', $this->pjki_pinset_chrirurgis_jumlah])
      ->andFilterWhere(['ilike', 'pjki_pinset_chrirurgis_dipakai', $this->pjki_pinset_chrirurgis_dipakai])
      ->andFilterWhere(['ilike', 'pjki_pinset_chrirurgis_sisa', $this->pjki_pinset_chrirurgis_sisa])
      ->andFilterWhere(['ilike', 'pjki_gunting_benang_hitungan_pertama', $this->pjki_gunting_benang_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_gunting_benang_tambahan_slma_operasi', $this->pjki_gunting_benang_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_gunting_benang_jumlah', $this->pjki_gunting_benang_jumlah])
      ->andFilterWhere(['ilike', 'pjki_gunting_benang_dipakai', $this->pjki_gunting_benang_dipakai])
      ->andFilterWhere(['ilike', 'pjki_gunting_benang_sisa', $this->pjki_gunting_benang_sisa])
      ->andFilterWhere(['ilike', 'pjki_gunting_jaringan_hitungan_pertama', $this->pjki_gunting_jaringan_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_gunting_jaringan_tambahan_slma_operasi', $this->pjki_gunting_jaringan_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_gunting_jaringan_jumlah', $this->pjki_gunting_jaringan_jumlah])
      ->andFilterWhere(['ilike', 'pjki_gunting_jaringan_dipakai', $this->pjki_gunting_jaringan_dipakai])
      ->andFilterWhere(['ilike', 'pjki_gunting_jaringan_sisa', $this->pjki_gunting_jaringan_sisa])
      ->andFilterWhere(['ilike', 'pjki_mosquito_pean_hitungan_pertama', $this->pjki_mosquito_pean_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_mosquito_pean_tambahan_slma_operasi', $this->pjki_mosquito_pean_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_mosquito_pean_jumlah', $this->pjki_mosquito_pean_jumlah])
      ->andFilterWhere(['ilike', 'pjki_mosquito_pean_dipakai', $this->pjki_mosquito_pean_dipakai])
      ->andFilterWhere(['ilike', 'pjki_mosquito_pean_sisa', $this->pjki_mosquito_pean_sisa])
      ->andFilterWhere(['ilike', 'pjki_pean_lurus_hitungan_pertama', $this->pjki_pean_lurus_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_pean_lurus_tambahan_slma_operasi', $this->pjki_pean_lurus_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_pean_lurus_jumlah', $this->pjki_pean_lurus_jumlah])
      ->andFilterWhere(['ilike', 'pjki_pean_lurus_dipakai', $this->pjki_pean_lurus_dipakai])
      ->andFilterWhere(['ilike', 'pjki_pean_lurus_sisa', $this->pjki_pean_lurus_sisa])
      ->andFilterWhere(['ilike', 'pjki_pean_bengkok_hitungan_pertama', $this->pjki_pean_bengkok_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_pean_bengkok_tambahan_slma_operasi', $this->pjki_pean_bengkok_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_pean_bengkok_jumlah', $this->pjki_pean_bengkok_jumlah])
      ->andFilterWhere(['ilike', 'pjki_pean_bengkok_dipakai', $this->pjki_pean_bengkok_dipakai])
      ->andFilterWhere(['ilike', 'pjki_pean_bengkok_sisa', $this->pjki_pean_bengkok_sisa])
      ->andFilterWhere(['ilike', 'pjki_duk_klem_hitungan_pertama', $this->pjki_duk_klem_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_duk_klem_tambahan_slma_operasi', $this->pjki_duk_klem_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_duk_klem_jumlah', $this->pjki_duk_klem_jumlah])
      ->andFilterWhere(['ilike', 'pjki_duk_klem_dipakai', $this->pjki_duk_klem_dipakai])
      ->andFilterWhere(['ilike', 'pjki_duk_klem_sisa', $this->pjki_duk_klem_sisa])
      ->andFilterWhere(['ilike', 'pjki_needle_holder_hitungan_pertama', $this->pjki_needle_holder_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_needle_holder_tambahan_slma_operasi', $this->pjki_needle_holder_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_needle_holder_jumlah', $this->pjki_needle_holder_jumlah])
      ->andFilterWhere(['ilike', 'pjki_needle_holder_dipakai', $this->pjki_needle_holder_dipakai])
      ->andFilterWhere(['ilike', 'pjki_needle_holder_sisa', $this->pjki_needle_holder_sisa])
      ->andFilterWhere(['ilike', 'pjki_kocher_hitungan_pertama', $this->pjki_kocher_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_kocher_tambahan_slma_operasi', $this->pjki_kocher_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_kocher_jumlah', $this->pjki_kocher_jumlah])
      ->andFilterWhere(['ilike', 'pjki_kocher_dipakai', $this->pjki_kocher_dipakai])
      ->andFilterWhere(['ilike', 'pjki_kocher_sisa', $this->pjki_kocher_sisa])
      ->andFilterWhere(['ilike', 'pjki_needle_atrumatic_hitungan_pertama', $this->pjki_needle_atrumatic_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_needle_atrumatic_tambahan_slma_operasi', $this->pjki_needle_atrumatic_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_needle_atrumatic_jumlah', $this->pjki_needle_atrumatic_jumlah])
      ->andFilterWhere(['ilike', 'pjki_needle_atrumatic_dipakai', $this->pjki_needle_atrumatic_dipakai])
      ->andFilterWhere(['ilike', 'pjki_needle_atrumatic_sisa', $this->pjki_needle_atrumatic_sisa])
      ->andFilterWhere(['ilike', 'pjki_kassa_hitungan_pertama', $this->pjki_kassa_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_kassa_tambahan_slma_operasi', $this->pjki_kassa_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_kassa_jumlah', $this->pjki_kassa_jumlah])
      ->andFilterWhere(['ilike', 'pjki_kassa_dipakai', $this->pjki_kassa_dipakai])
      ->andFilterWhere(['ilike', 'pjki_kassa_sisa', $this->pjki_kassa_sisa])
      ->andFilterWhere(['ilike', 'pjki_roll_kassa_hitungan_pertama', $this->pjki_roll_kassa_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_roll_kassa_tambahan_slma_operasi', $this->pjki_roll_kassa_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_roll_kassa_jumlah', $this->pjki_roll_kassa_jumlah])
      ->andFilterWhere(['ilike', 'pjki_roll_kassa_dipakai', $this->pjki_roll_kassa_dipakai])
      ->andFilterWhere(['ilike', 'pjki_roll_kassa_sisa', $this->pjki_roll_kassa_sisa])
      ->andFilterWhere(['ilike', 'pjki_depper_hitungan_pertama', $this->pjki_depper_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_depper_tambahan_slma_operasi', $this->pjki_depper_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_depper_jumlah', $this->pjki_depper_jumlah])
      ->andFilterWhere(['ilike', 'pjki_depper_dipakai', $this->pjki_depper_dipakai])
      ->andFilterWhere(['ilike', 'pjki_depper_sisa', $this->pjki_depper_sisa])
      ->andFilterWhere(['ilike', 'pjki_kacang_hitungan_pertama', $this->pjki_kacang_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_kacang_tambahan_slma_operasi', $this->pjki_kacang_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_kacang_jumlah', $this->pjki_kacang_jumlah])
      ->andFilterWhere(['ilike', 'pjki_kacang_dipakai', $this->pjki_kacang_dipakai])
      ->andFilterWhere(['ilike', 'pjki_kacang_sisa', $this->pjki_kacang_sisa])
      ->andFilterWhere(['ilike', 'pjki_lidi_waten_hitungan_pertama', $this->pjki_lidi_waten_hitungan_pertama])
      ->andFilterWhere(['ilike', 'pjki_lidi_waten_tambahan_slma_operasi', $this->pjki_lidi_waten_tambahan_slma_operasi])
      ->andFilterWhere(['ilike', 'pjki_lidi_waten_jumlah', $this->pjki_lidi_waten_jumlah])
      ->andFilterWhere(['ilike', 'pjki_lidi_waten_dipakai', $this->pjki_lidi_waten_dipakai])
      ->andFilterWhere(['ilike', 'pjki_lidi_waten_sisa', $this->pjki_lidi_waten_sisa]);

    return $dataProvider;
  }
}
