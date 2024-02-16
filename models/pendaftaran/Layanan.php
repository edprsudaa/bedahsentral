<?php

namespace app\models\pendaftaran;

use app\components\Akun;
use Yii;
use app\models\pegawai\DmUnitPenempatan;
use app\models\medis\Pjp;
use app\models\medis\Kamar;
use app\models\pendaftaran\KelasRawat;
use app\models\pegawai\TbPegawai;
use app\components\HelperSpesial;
use app\models\bedahsentral\TimOperasi;
use app\models\medis\Dpjpri;

/**
 * This is the model class for table "pendaftaran.layanan".
 *
 * @property int $kode
 * @property string $registrasi_kode
 * @property int $jenis_layanan
 * @property string $tgl_masuk
 * @property string|null $tgl_keluar
 * @property int $unit_kode
 * @property int|null $nomor_urut
 * @property int|null $panggilPerawat
 * @property int|null $dipanggilPerawat
 * @property string|null $kamar_id
 * @property string|null $kelas_rawat_kode
 * @property string|null $dokter_kode
 * @property string|null $unit_asal_kode
 * @property string|null $unit_tujuan_kode
 * @property string|null $cara_masuk_unit_kode
 * @property string|null $cara_keluar_kode
 * @property string|null $status_keluar_kode
 * @property string|null $keterangan
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property int|null $panggildokter
 * @property int|null $dipanggildokter
 */
class Layanan extends \yii\db\ActiveRecord
{
  const IGD = 1;
  const RJ = 2;
  const RI = 3;
  const PENUNJANG = 4;
  // const RJUTAMA = 5;
  const OK = 5;

  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'pendaftaran.layanan';
  }
  public static function getDb()
  {
    return Yii::$app->get('db_pendaftaran');
  }
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['registrasi_kode', 'jenis_layanan', 'tgl_masuk', 'unit_kode'], 'required'],
      [['jenis_layanan', 'unit_kode', 'nomor_urut', 'panggil_perawat', 'dipanggil_perawat', 'created_by', 'updated_by', 'deleted_by', 'panggil_dokter', 'dipanggil_dokter'], 'default', 'value' => null],
      [['jenis_layanan', 'unit_kode', 'nomor_urut', 'panggil_perawat', 'dipanggil_perawat', 'created_by', 'updated_by', 'deleted_by', 'panggil_dokter', 'dipanggil_dokter', 'kamar_id'], 'integer'],
      [['tgl_masuk', 'tgl_keluar', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
      [['keterangan'], 'string'],
      [['registrasi_kode', 'kelas_rawat_kode', 'cara_masuk_unit_kode', 'cara_keluar_kode', 'status_keluar_kode'], 'string', 'max' => 10],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'id',
      'registrasi_kode' => 'Registrasi Kode',
      'jenis_layanan' => 'Jenis Layanan',
      'tgl_masuk' => 'Tgl Masuk',
      'tgl_keluar' => 'Tgl Keluar',
      'unit_kode' => 'Unit Kode',
      'nomor_urut' => 'Nomor Urut',
      'panggil_perawat' => 'Panggil Perawat',
      'dipanggil_perawat' => 'Dipanggil Perawat',
      'kamar_id' => 'Kamar',
      'kelas_rawat_kode' => 'Kelas',
      'unit_asal_kode' => 'Unit Asal Kode',
      'unit_tujuan_kode' => 'Unit Tujuan Kode',
      'cara_masuk_unit_kode' => 'Cara Masuk Unit Kode',
      'cara_keluar_kode' => 'Cara Keluar Kode',
      'status_keluar_kode' => 'Status Keluar Kode',
      'keterangan' => 'Keterangan',
      'created_by' => 'Created By',
      'created_at' => 'Created At',
      'updated_by' => 'Updated By',
      'updated_at' => 'Updated At',
      'deleted_at' => 'Deleted At',
      'deleted_by' => 'Deleted By',
      'panggil_dokter' => 'Panggil Dokter',
      'dipanggil_dokter' => 'Dipanggil Dokter',
    ];
  }
  function beforeSave($model)
  {
    // $user=HelperSpesial::getUserLogin();
    if ($this->isNewRecord) {
      $this->created_by = Akun::user()->id;
      $this->created_at = date('Y-m-d H:i:s');
    } else {
      $this->updated_by = Akun::user()->id;
      $this->updated_at = date('Y-m-d H:i:s');
    }
    return parent::beforeSave($model);
  }
  function setDelete()
  {
    $this->deleted_at = date('Y-m-d H:i:s');
    $this->deleted_by = Akun::user()->id;
  }
  function getRegistrasi()
  {
    return $this->hasOne(Registrasi::className(), ['kode' => 'registrasi_kode']);
  }
  function getUnit()
  {
    return $this->hasOne(DmUnitPenempatan::className(), ['kode' => 'unit_kode']);
  }
  function getUnitAsal()
  {
    return $this->hasOne(DmUnitPenempatan::className(), ['kode' => 'unit_asal_kode']);
  }
  function getUnitTujuan()
  {
    return $this->hasOne(DmUnitPenempatan::className(), ['kode' => 'unit_tujuan_kode']);
  }
  function getPjp()
  {
    return $this->hasMany(Pjp::className(), ['layanan_id' => 'id']);
  }
  function getDpjpri()
  {
    return $this->hasMany(Dpjpri::className(), ['registrasi_kode' => 'registrasi_kode']);
  }
  function getKelasRawat()
  {
    return $this->hasOne(KelasRawat::className(), ['kode' => 'kelas_rawat_kode']);
  }
  function getKamar()
  {
    return $this->hasOne(Kamar::className(), ['id' => 'kamar_id']);
  }
  public static function generateNoAntrian($unit_kode)
  {
    $find = false;
    $max_now = self::find()->where(['unit_kode' => $unit_kode, "TO_CHAR(tgl_masuk :: DATE,'YYYY-MM-DD')" => date('Y-m-d')])->andWhere('deleted_at is null')->max('nomor_urut');
    $max = !empty($max_now) ? $max_now : 1;
    while (!$find) {
      $count = self::find()->where(['nomor_urut' => $max, 'unit_kode' => $unit_kode, "TO_CHAR(tgl_masuk :: DATE,'YYYY-MM-DD')" => date('Y-m-d')])->andWhere('deleted_at is null')->count();
      if ($count < 1) {
        $find = true;
      } else {
        $max++;
      }
    }
    return $max;
  }
  // public static function find()
  // {
  //   return new LayananQuery(get_called_class());
  // }
  function getTimOperasi()
  {
    return $this->hasMany(TimOperasi::className(), ['to_ok_pl_id' => 'id']);
  }

  public static function getDataSearchIgdRjRi($search = null, $limit = 50)
  {
    $query = self::find()->joinWith(['registrasi.pasien', 'unit']);
    if ($search) {
      $query->andWhere(
        [
          'or',
          ['ilike', 'LOWER(registrasi.pasien_kode)', strtolower($search)], // cari no rm
          ['ilike', 'LOWER(pasien.nama)', strtolower($search)], // cari nama pasien
          ['ilike', 'LOWER(layanan.registrasi_kode)', strtolower($search)] // cari no registrasi
        ]

      );
    }
    return $query->andWhere([
      'or',
      ['layanan.jenis_layanan' => 1],
      ['layanan.jenis_layanan' => 2],
      ['layanan.jenis_layanan' => 3]
    ])
      ->andWhere('registrasi.tgl_keluar is null')
      ->andWhere('layanan.tgl_keluar is null')
      ->andWhere('layanan.deleted_at is null')
      ->orderBy(['layanan.tgl_masuk' => SORT_DESC])
      ->limit($limit)->asArray()->all();
  }
}
