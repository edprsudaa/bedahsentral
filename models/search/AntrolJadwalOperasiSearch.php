<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bpjskes\AntrolJadwalOperasi;

/**
 * AntrolJadwalOperasiSearch represents the model behind the search form of `app\models\bpjskes\AntrolJadwalOperasi`.
 */
class AntrolJadwalOperasiSearch extends AntrolJadwalOperasi
{
  public $norm;
  public $kartubpjs;
  public $pasien;
  public $kdbooking;
  public $jenistindakan;
  public $tgloperasi;
  public $laksana;

  public function rules()
  {
    return [
      [['id', 'terlaksana', 'dokter_operator_id', 'unit_asal_kode', 'unit_ok_kode', 'tipe', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
      [['laksana', 'tgloperasi', 'jenistindakan', 'kode_booking', 'kdbooking', 'pasien', 'kartubpjs', 'norm', 'tgl_operasi', 'jenis_tindakan', 'debitur_detail_kode', 'no_kartu_bpjs', 'pasien_kode', 'no_hp', 'diagnosa', 'no_ruang_ok', 'tgl_lapor', 'tgl_rawat', 'kelas_inap_kode', 'keterangan', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
    ];
  }

  public function scenarios()
  {
    // bypass scenarios() implementation in the parent class
    return Model::scenarios();
  }

  public function search($params)
  {
    $query = AntrolJadwalOperasi::find();
    $query->joinWith(["pasien"])
      ->where(['antrol_jadwal_operasi.deleted_at' => null, 'pasien.deleted_at' => null])
      ->orderBy(['antrol_jadwal_operasi.tgl_operasi' => SORT_DESC]);

    // add conditions that should always apply here

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => [
        'pageSize' => 10
      ]
    ]);

    $this->load($params);

    if (!$this->validate()) {
      // uncomment the following line if you do not want to return any records when validation fails
      // $query->where('0=1');
      return $dataProvider;
    }

    // grid filtering conditions
    $query->andFilterWhere([
      'tgl_operasi' => $this->tgloperasi,
      'terlaksana' => $this->laksana,
      'no_kartu_bpjs' => $this->kartubpjs,
    ]);

    $query->andFilterWhere(['ilike', 'kode_booking', $this->kdbooking])
      ->andFilterWhere(['ilike', 'pasien.nama', $this->pasien])
      ->andFilterWhere(['ilike', 'pasien_kode', $this->norm])
      // ->andFilterWhere(['ilike', 'terlaksana', $this->laksana])
      ->andFilterWhere(['ilike', 'jenis_tindakan', $this->jenistindakan]);

    return $dataProvider;
  }
}
