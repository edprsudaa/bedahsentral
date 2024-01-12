<?php

namespace app\models\sso;

use app\components\Akun;
use app\models\other\BaseQuery;
use app\models\pegawai\DmUnitPenempatan;
use app\models\pegawai\TbPegawai;
use Yii;

/**
 * This is the model class for table "akses_unit".
 *
 * @property int $id
 * @property int $unit_id
 * @property int $pengguna_id
 * @property string|null $id_aplikasi
 * @property string $tanggal_aktif
 * @property string|null $tanggal_nonaktif
 * @property string $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 */
class AksesUnit extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'akses_unit';
  }

  /**
   * @return \yii\db\Connection the database connection used by this AR class.
   */
  public static function getDb()
  {
    return Yii::$app->get('db_sso');
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['unit_id', 'id_aplikasi', 'pengguna_id', 'tanggal_aktif', 'created_by'], 'required'],
      [['unit_id', 'id_aplikasi', 'pengguna_id', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
      [['unit_id', 'id_aplikasi', 'pengguna_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
      [['tanggal_aktif', 'tanggal_nonaktif', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'unit_id' => 'Unit',
      'pengguna_id' => 'Pegawai',
      'id_aplikasi' => 'Aplikasi',
      'tanggal_aktif' => 'Tanggal Aktif',
      'tanggal_nonaktif' => 'Tanggal Nonaktif',
      'created_at' => 'Created At',
      'created_by' => 'Created By',
      'updated_at' => 'Updated At',
      'updated_by' => 'Updated By',
      'deleted_at' => 'Deleted At',
      'deleted_by' => 'Deleted By',
    ];
  }
  function attr()
  {
    $data = [];
    foreach ($this->attributeLabels() as $key => $val) {
      $data[$val] = $this->{$key};
    }
    return $data;
  }
  function beforeSave($model)
  {
    if ($this->isNewRecord) {
      // $this->id_aplikasi = \Yii::$app->params['app']['id'];
      $this->created_by = Akun::user()->id;
      $this->created_at = date('Y-m-d H:i:s');
      $this->tanggal_aktif = date('Y-m-d H:i:s');
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
  // public static function find()
  // {
  //   return (new BaseQuery(get_called_class()))->setPrefix(self::prefix);
  // }
  public function getUnit()
  {
    return $this->hasOne(DmUnitPenempatan::className(), ['kode' => 'unit_id']);
  }
  public function getPegawai()
  {
    return $this->hasOne(PegawaiUser::className(), ['userid' => 'pengguna_id']);
  }
  public function getAplikasi()
  {
    return $this->hasOne(AknApp::className(), ['id' => 'id_aplikasi']);
  }
}
