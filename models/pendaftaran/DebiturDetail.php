<?php

namespace app\models\pendaftaran;

use Yii;

/**
 * This is the model class for table "pendaftaran.debitur_detail".
 *
 * @property string $kode
 * @property string $debitur_kode
 * @property string $nama
 * @property int|null $created_by
 * @property string|null $created_at
 * @property int|null $updated_by
 * @property string|null $updated_at
 * @property int $aktif
 * @property string|null $deleted_at
 */
class DebiturDetail extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'pendaftaran.debitur_detail';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['kode', 'debitur_kode', 'nama', 'aktif'], 'required'],
      [['created_by', 'updated_by', 'deleted_by', 'aktif'], 'default', 'value' => null],
      [['created_by', 'updated_by', 'deleted_by', 'aktif'], 'integer'],
      [['created_at', 'updated_at', 'deleted_at'], 'safe'],
      [['kode', 'debitur_kode', 'kode_lama_farmasi_tb'], 'string', 'max' => 10],
      [['nama'], 'string', 'max' => 255],
      [['kode_lama'], 'string', 'max' => 0],
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
      'debitur_kode' => 'Debitur Kode',
      'nama' => 'Nama',
      'created_by' => 'Created By',
      'created_at' => 'Created At',
      'updated_by' => 'Updated By',
      'updated_at' => 'Updated At',
      'aktif' => 'Aktif',
      'deleted_at' => 'Deleted At',
      'deleted_by' => 'Deleted By',
      'kode_lama' => 'Kode Lama',
      'kode_lama_farmasi_tb' => 'kode_lama_farmasi_tb',
    ];
  }
  public function getDebitur()
  {
    return $this->hasOne(Debitur::className(), ['kode' => 'debitur_kode']);
  }
  static function all($kode = NULL)
  {
    $query = self::find();
    if ($kode != NULL) {
      if (is_array($kode)) {
        $query->where(['in', 'kode', $kode]);
      } else {
        $query->where(['debitur_kode' => $kode]);
      }
    } else {
      $query->where(['not in', 'kode', ['1012']]);
    }
    return $query->select('kode as kode,nama as nama,debitur_kode as debitur')->asArray()->all();
  }
}
