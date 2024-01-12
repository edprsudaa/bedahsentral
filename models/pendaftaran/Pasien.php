<?php

namespace app\models\pendaftaran;

use Yii;
use app\models\pegawai\DmAgama;
use app\models\pegawai\DmPendidikan;
use app\models\pegawai\DmPekerjaan;
use app\models\pegawai\DmNegara;
use app\models\pegawai\DmSuku;
use app\models\pegawai\DmKelurahanDesa;

class Pasien extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  static
    $jenis_identitas = [1 => 'KTP', 2 => 'SIM', 3 => 'PASPOR', 4 => 'NIP'],
    $status_kawin = ['t' => 'Belum Kawin', 'k' => 'Kawin', 'd' => 'Duda', 'j' => 'Janda'],
    $kddk = ['k' => 'Kepala Keluarga', 'i' => 'Istri', 'a' => 'Anak'],
    $jenis_kelamin = ['l' => 'Laki-laki', 'p' => 'Perempuan', 'a' => 'Ambigu'];
  // public $umur,$kebiasaan,$riwayat_penyakit;
  // public $anak_nama,$anak_tgl,$anak_status,$anak_mr;
  // public $pen_nama,$pen_nomor;
  // public $error_msg,$data;
  // public $kunjungan,$umur_th,$umur_bln,$umur_hari;
  public static function tableName()
  {
    return 'pendaftaran.pasien';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['kode', 'status_kawin_kode', 'agama_kode', 'pendidikan_kode', 'pekerjaan_kode', 'kewarganegaraan_kode', 'jenis_identitas_kode', 'suku_kode', 'no_identitas', 'tempat_lahir', 'tgl_lahir', 'alamat', 'jkel', 'created_by', 'created_at'], 'required'],
      [['tgl_lahir', 'created_at', 'updated_at'], 'safe'],
      [['alamat', 'alergi'], 'string'],
      [['penghasilan', 'created_by', 'updated_by', 'is_deleted', 'anak_ke', 'istri_ke', 'jml_anak'], 'default', 'value' => null],
      [['penghasilan', 'created_by', 'updated_by', 'is_deleted', 'anak_ke', 'istri_ke', 'jml_anak'], 'integer'],
      [['is_print'], 'boolean'],
      [['kode', 'status_kawin_kode', 'agama_kode', 'pendidikan_kode', 'pekerjaan_kode', 'kewarganegaraan_kode', 'jenis_identitas_kode', 'suku_kode', 'kelurahan_kode', 'ayah_no_rekam_medis', 'ibu_no_rekam_medis'], 'string', 'max' => 10],
      [['no_identitas', 'no_telp'], 'string', 'max' => 50],
      [['nama', 'ayah_nama', 'ibu_nama', 'nama_pasangan'], 'string', 'max' => 150],
      [['tempat_lahir', 'tempat_kerja', 'alamat_tempat_kerja'], 'string', 'max' => 255],
      [['jkel', 'kedudukan_keluarga'], 'string', 'max' => 1],
      [['goldar'], 'string', 'max' => 2],
      [['kode'], 'unique'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'kode' => 'Kode',
      'status_kawin_kode' => 'Status Kawin Kode',
      'agama_kode' => 'Agama Kode',
      'pendidikan_kode' => 'Pendidikan Kode',
      'pekerjaan_kode' => 'Pekerjaan Kode',
      'kewarganegaraan_kode' => 'Kewarganegaraan Kode',
      'jenis_identitas_kode' => 'Jenis Identitas Kode',
      'suku_kode' => 'Suku Kode',
      'no_identitas' => 'No Identitas',
      'nama' => 'Nama',
      'ayah_nama' => 'Ayah Nama',
      'ibu_nama' => 'Ibu Nama',
      'nama_pasangan' => 'Nama Pasangan',
      'tempat_lahir' => 'Tempat Lahir',
      'tgl_lahir' => 'Tgl Lahir',
      'alamat' => 'Alamat',
      'jkel' => 'Jkel',
      'penghasilan' => 'Penghasilan',
      'no_telp' => 'No Telp',
      'alergi' => 'Alergi',
      'created_by' => 'Created By',
      'created_at' => 'Created At',
      'updated_by' => 'Updated By',
      'updated_at' => 'Updated At',
      'is_deleted' => 'Is Deleted',
      'tempat_kerja' => 'Tempat Kerja',
      'kelurahan_kode' => 'Kelurahan Kode',
      'kedudukan_keluarga' => 'Kedudukan Keluarga',
      'alamat_tempat_kerja' => 'Alamat Tempat Kerja',
      'anak_ke' => 'Anak Ke',
      'istri_ke' => 'Istri Ke',
      'jml_anak' => 'Jml Anak',
      'ayah_no_rekam_medis' => 'Ayah No Rekam Medis',
      'ibu_no_rekam_medis' => 'Ibu No Rekam Medis',
      'goldar' => 'Goldar',
      'is_print' => 'Is Print',
    ];
  }
  function getStatusKawin()
  {
    return $this->hasOne(StatusKawin::className(), ['kode' => 'status_kawin_kode'])->select(['kode', 'nama']);
  }
  function getAgama()
  {
    return $this->hasOne(DmAgama::className(), ['id' => 'agama_kode'])->select(['id as kode', 'agama as nama']);
  }
  function getPendidikan()
  {
    return $this->hasOne(DmPendidikan::className(), ['id' => 'pendidikan_kode'])->select(['id as kode', 'pendidikan_terakhir as nama']);
  }
  function getPekerjaan()
  {
    return $this->hasOne(DmPekerjaan::className(), ['id' => 'pekerjaan_kode'])->select(['id as kode', 'nama']);
  }
  function getNegara()
  {
    return $this->hasOne(DmNegara::className(), ['id' => 'kewarganegaraan_kode'])->select(['id as kode', 'nama']);
  }
  function getSuku()
  {
    return $this->hasOne(DmSuku::className(), ['id' => 'suku_kode'])->select(['kode', 'nama']);
  }
  function getKelurahan()
  {
    return $this->hasOne(DmKelurahanDesa::className(), ['kode_prov_kab_kec_kelurahan' => 'kelurahan_kode']);
  }
  // function getJenisIdentitas()
  // {
  //     return $this->hasOne(JenisIdentitas::className(),['kode'=>'jenis_identitas_kode'])->select(['kode','nama']);
  // }
  function getAnak()
  {
    return $this->hasMany(PasienAnak::className(), ['pasien_kode' => 'kode']);
  }
  function getRiwayatPenyakit()
  {
    return $this->hasMany(PasienRiwayatPenyakit::className(), ['pasien_kode' => 'kode']);
  }
  function getKebiasaan()
  {
    return $this->hasMany(PasienKebiasaan::className(), ['pasien_kode' => 'kode']);
  }
  public static function getDataPasien($search = null, $limit = 50)
  {
    $query = self::find();
    if ($search) {
      $query->andWhere(
        [
          'or',
          ['ilike', 'LOWER(pasien.kode)', strtolower($search)], // cari no rm
          ['ilike', 'LOWER(pasien.nama)', strtolower($search)], // cari nama pasien
        ]

      );
    }
    return $query->andWhere('pasien.deleted_at is null')
      ->orderBy(['pasien.kode' => SORT_DESC])
      ->limit($limit)->asArray()->all();
  }
}
