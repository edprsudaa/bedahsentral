<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\pendaftaran\Pasien;
use app\models\pendaftaran\Layanan;
use app\models\bedahsentral\TimOperasiDetail;
use app\components\Akun;
use app\components\HelperSpesial;
use app\models\bedahsentral\LaporanOperasi;
use app\models\bedahsentral\TimOperasi;
use app\models\pegawai\DmUnitPenempatan;

class LayananOperasiSearch extends Layanan
{
  const KAMAR_OK_GROUND = 288;
  const KAMAR_OK_IRD = 139;
  const KAMAR_OK_IBS = 138;
  //  ruang lainnya
  const RUANG_ICU = 130;
  const RUANG_PICU = 132;
  const RUANG_RICU = 215;

  public $pasien;
  public $tindakan_operasi;
  public $unit_tujuan;
  public $unit_awal;
  public $tgl_operasi;
  public $norm;
  public $status;
  public $dibuat;

  public function rules()
  {
    return [
      [['id', 'jenis_layanan', 'unit_kode', 'nomor_urut', 'panggil_perawat', 'dipanggil_perawat', 'kamar_id', 'unit_asal_kode', 'unit_tujuan_kode', 'created_by', 'updated_by', 'deleted_by', 'panggil_dokter', 'dipanggil_dokter'], 'integer'],
      [['dibuat', 'status', 'norm', 'registrasi_kode', 'unit_tujuan', 'unit_awal', 'pasien', 'tindakan_operasi', 'tgl_masuk', 'tgl_keluar', 'tgl_operasi', 'kelas_rawat_kode', 'cara_masuk_unit_kode', 'cara_keluar_kode', 'status_keluar_kode', 'keterangan', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
    ];
  }

  public function scenarios()
  {
    // bypass scenarios() implementation in the parent class
    return Model::scenarios();
  }

  public function search($params, $pulang = NULL)
  {
    $user_id = Akun::user()->id;
    $role = HelperSpesial::getUserLogin();
    $id_pegawai = Akun::user()->id_pegawai;
    // echo "<pre>";
    // print_r($user_akses_unit_id);die;
    $query = Layanan::find();
    $query->joinWith([
      'registrasi.pasien',
      'timOperasi.timOperasiDetail',
      'timOperasi.laporanOperasi',
      'unit',
      'unitAsal'
    ])->where(['layanan.jenis_layanan' => parent::OK])
      ->andWhere('tim_operasi.to_deleted_at is null')
      ->groupBy(['tim_operasi.to_id', 'layanan.id'])
      ->orderBy(['tim_operasi.to_id' => SORT_DESC]);

    //Pasien Pulang
    if ($pulang == 1) {
      $query->andWhere([
        'laporan_operasi.lap_op_final' => 1
      ]);
      $query->andWhere(['laporan_operasi.lap_op_batal' => 0]);
    } elseif (($pulang == 288) || ($pulang == 139) || ($pulang == 138)) {
      $query->andWhere(['tim_operasi.to_ok_unt_id' => $pulang]);
      // $query->andWhere([
      //   'or', ['laporan_operasi.lap_op_final' => 0],
      //   'laporan_operasi.lap_op_final is null',
      // ]);
      // } else {
      //   $query->andWhere([
      //     'or', ['laporan_operasi.lap_op_final' => 0],
      //     'laporan_operasi.lap_op_final is null'
      //   ]);
    }

    if (($role['akses_level'] == 'DOKTER')) {
      $query->andWhere([
        'tim_operasi_detail.tod_pgw_id' => $id_pegawai
      ]);
    }

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => [
        'pageSize' => 10
      ]
    ]);
    $dataProvider->sort->attributes['tgl_masuk'] = [
      'asc' => ['layanan.tgl_masuk' => SORT_ASC],
      'desc' => ['layanan.tgl_masuk' => SORT_DESC],
    ];

    $this->load($params);

    if (!$this->validate()) {
      // $query->where('0=1');
      return $dataProvider;
    }

    // if (!$this->tgl_operasi) {
    //   $this->tgl_operasi = date('d-m-Y');
    // }

    $query->andFilterWhere([
      'or',
      // ['ilike', Pasien::tableName() . '.kode', $this->pasien],
      ['ilike', 'pasien.nama', $this->pasien],
      // ['ilike', parent::tableName() . '.registrasi_kode', $this->pasien],
    ]);
    if ($this->status) {
      $this->dibuat = Akun::user()->id;
    }
    $query->andFilterWhere([
      'or',
      ['=', 'tim_operasi.to_created_by', $this->dibuat],
      ['=', 'tim_operasi_detail.tod_pgw_id', $this->status],
    ]);

    $query->andFilterWhere(['ilike', 'tim_operasi.to_tindakan_operasi', $this->tindakan_operasi])
      ->andFilterWhere(['ilike', 'pasien.kode', $this->norm,])
      ->andFilterWhere(['=', 'tim_operasi.to_ok_unt_id', $this->unit_tujuan])
      ->andFilterWhere(['=', 'layanan.unit_asal_kode', $this->unit_awal,])
      ->andFilterWhere(['=', new \yii\db\Expression("to_char(tim_operasi.to_tanggal_operasi, 'dd-mm-yyyy')"), $this->tgl_operasi]);
    return $dataProvider;
  }

  public function search2($params)
  {
    $user_id = Akun::user()->id;
    $role = HelperSpesial::getUserLogin();
    $id_pegawai = Akun::user()->id_pegawai;

    $query = TimOperasi::find();
    // $query->innerJoinWith([
    //   'layanan.registrasi.pasien',
    //   'timOperasiDetail',
    //   'layanan.unit'
    // ]);
    $query->joinWith([
      'laporanOperasi',
      'layanan.registrasi.pasien',
      'timOperasiDetail',
      'layanan.unit'
    ])->where([
      'and',
      ['!=', 'tim_operasi.to_ok_unt_id', self::KAMAR_OK_GROUND],
      ['!=', 'tim_operasi.to_ok_unt_id', self::KAMAR_OK_IRD],
      ['!=', 'tim_operasi.to_ok_unt_id', self::KAMAR_OK_IBS],
    ])
      ->andWhere('tim_operasi.to_deleted_at is null')
      ->groupBy(['tim_operasi.to_id', 'layanan.id'])
      ->orderBy(['tim_operasi.to_id' => SORT_DESC]);

    if (($role['akses_level'] == 'DOKTER')) {
      $query->andWhere([
        'tim_operasi_detail.tod_pgw_id' => $id_pegawai
      ]);
    }

    $dataProvider = new ActiveDataProvider([
      'query' => $query,
      'pagination' => [
        'pageSize' => 10
      ]
    ]);
    $dataProvider->sort->attributes['tgl_masuk'] = [
      'asc' => ['layanan.tgl_masuk' => SORT_ASC],
      'desc' => ['layanan.tgl_masuk' => SORT_DESC],
    ];

    $this->load($params);

    if (!$this->validate()) {
      // $query->where('0=1');
      return $dataProvider;
    }

    // if (!$this->tgl_operasi) {
    //   $this->tgl_operasi = date('d-m-Y');
    // }

    $query->andFilterWhere([
      'or',
      // ['ilike', Pasien::tableName() . '.kode', $this->pasien],
      ['ilike', 'pasien.nama', $this->pasien],
      // ['ilike', parent::tableName() . '.registrasi_kode', $this->pasien],
    ]);
    if ($this->status) {
      $this->dibuat = Akun::user()->id;
    }
    $query->andFilterWhere([
      'or',
      ['=', 'tim_operasi.to_created_by', $this->dibuat],
      ['=', 'tim_operasi_detail.tod_pgw_id', $this->status],
    ]);

    $query->andFilterWhere(['ilike', 'tim_operasi.to_tindakan_operasi', $this->tindakan_operasi])
      ->andFilterWhere(['ilike', 'pasien.kode', $this->norm,])
      ->andFilterWhere(['=', 'tim_operasi.to_ok_unt_id', $this->unit_tujuan])
      ->andFilterWhere(['=', 'layanan.unit_kode', $this->unit_awal,])
      ->andFilterWhere(['=', new \yii\db\Expression("to_char(tim_operasi.to_tanggal_operasi, 'dd-mm-yyyy')"), $this->tgl_operasi]);
    return $dataProvider;
  }
}
