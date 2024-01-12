<?php

namespace app\models\pendaftaran;

use Yii;

/**
 * This is the model class for table "pendaftaran.kelas_rawat".
 *
 * @property string $kode
 * @property string $nama
 * @property int $aktif
 * @property int $created_by
 * @property string $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int|null $is_deleted
 */
class KelasRawat extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'pendaftaran.kelas_rawat';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['kode', 'nama', 'aktif'], 'required'],
      [['aktif', 'created_by', 'updated_by', 'deleted_by'], 'default', 'value' => null],
      [['aktif', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
      [['created_at', 'updated_at', 'deleted_at'], 'safe'],
      [['kode', 'kode_lama'], 'string', 'max' => 3],
      [['nama'], 'string', 'max' => 30],
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
      'nama' => 'Nama',
      'aktif' => 'Aktif',
      'created_by' => 'Created By',
      'created_at' => 'Created At',
      'updated_by' => 'Updated By',
      'updated_at' => 'Updated At',
      'deleted_at' => 'Deleted At',
      'deleted_by' => 'Deleted By',
      'kode_lama' => 'Kode Lama',
    ];
  }

  public static function getKelasRawat()
  {
    $query = self::find()->where(['deleted_at' => null])->orderBy(['kode' => SORT_ASC])->asArray()->all();
    return $query;
  }

  // public static function find()
  // {
  //   return new KelasRawatQuery(get_called_class());
  // }
}
