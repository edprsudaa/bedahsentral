<?php

namespace app\models\bpjskes;

use app\components\Akun;
use app\models\pendaftaran\Pasien;
use Yii;

class AntrolJadwalOperasi extends \yii\db\ActiveRecord
{
  public static function tableName()
  {
    return 'antrol_jadwal_operasi';
  }

  public static function getDb()
  {
    return Yii::$app->get('db_bpjskes');
  }

  public function rules()
  {
    return [
      [['terlaksana', 'kode_booking', 'tgl_operasi', 'jenis_tindakan', 'debitur_detail_kode', 'no_kartu_bpjs', 'pasien_kode', 'no_hp', 'diagnosa', 'dokter_operator_id', 'unit_asal_kode', 'tipe', 'created_at', 'created_by'], 'required'],
      [['tgl_operasi', 'tgl_lapor', 'tgl_rawat', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
      [['terlaksana', 'dokter_operator_id', 'unit_asal_kode', 'unit_ok_kode', 'tipe', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
      [['terlaksana', 'dokter_operator_id', 'unit_asal_kode', 'unit_ok_kode', 'tipe', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
      [['keterangan'], 'string'],
      [['kode_booking', 'jenis_tindakan', 'no_ruang_ok'], 'string', 'max' => 255],
      [['debitur_detail_kode', 'pasien_kode', 'kelas_inap_kode'], 'string', 'max' => 10],
      [['no_kartu_bpjs'], 'string', 'max' => 20],
      [['no_hp'], 'string', 'max' => 100],
      [['diagnosa'], 'string', 'max' => 500],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'kode_booking' => 'Kode Booking',
      'tgl_operasi' => 'Tgl Operasi',
      'jenis_tindakan' => 'Jenis Tindakan',
      'terlaksana' => 'Terlaksana',
      'debitur_detail_kode' => 'Debitur Detail Kode',
      'no_kartu_bpjs' => 'No Kartu Bpjs',
      'pasien_kode' => 'Pasien Kode',
      'no_hp' => 'No Hp',
      'diagnosa' => 'Diagnosa',
      'dokter_operator_id' => 'Dokter Operator ID',
      'unit_asal_kode' => 'Unit Asal Kode',
      'unit_ok_kode' => 'Unit Ok Kode',
      'no_ruang_ok' => 'No Ruang Ok',
      'tipe' => 'Tipe',
      'tgl_lapor' => 'Tgl Lapor',
      'tgl_rawat' => 'Tgl Rawat',
      'kelas_inap_kode' => 'Kelas Inap Kode',
      'keterangan' => 'Keterangan',
      'created_at' => 'Created At',
      'created_by' => 'Created By',
      'updated_at' => 'Updated At',
      'updated_by' => 'Updated By',
      'deleted_at' => 'Deleted At',
      'deleted_by' => 'Deleted By',
    ];
  }

  // public function getModelClasName()
  // {
  //   $class = explode("\\", get_called_class());
  //   return $class[(count($class) - 1)];
  // }
  // public function behaviors()
  // {
  //   return [
  //     [
  //       'class' => TrimBehavior::className(),
  //     ],
  //   ];
  // }
  // function attr()
  // {
  //   $data = [];
  //   foreach ($this->attributeLabels() as $key => $val) {
  //     $data[$val] = $this->{$key};
  //   }
  //   return $data;
  // }

  function beforeSave($model)
  {
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

  public function getPasien()
  {
    return $this->hasOne(Pasien::className(), ['kode' => 'pasien_kode']);
  }

  public static function getAntrolAll()
  {
    $query = self::find()->where(['deleted_at' => null])->orderBy(['pasien_kode' => SORT_DESC])->asArray()->all();
    return $query;
  }
}
