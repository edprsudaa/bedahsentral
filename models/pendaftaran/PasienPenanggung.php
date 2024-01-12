<?php

namespace app\models\pendaftaran;

use Yii;

/**
 * This is the model class for table "pasien_penanggung".
 *
 * @property int $id
 * @property string $pasien_kode
 * @property string $debitur_kode
 * @property string $debitur_detail_kode
 * @property string|null $created_by
 * @property string|null $created_at
 * @property string $debitur_nomor
 */
class PasienPenanggung extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'pasien_penanggung';
  }

  /**
   * @return \yii\db\Connection the database connection used by this AR class.
   */
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
      [['pasien_kode', 'debitur_kode', 'debitur_detail_kode', 'debitur_nomor'], 'required'],
      [['created_by'], 'string'],
      [['created_at'], 'safe'],
      [['pasien_kode', 'debitur_kode', 'debitur_detail_kode'], 'string', 'max' => 10],
      [['debitur_nomor'], 'string', 'max' => 50],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'pasien_kode' => 'Pasien Kode',
      'debitur_kode' => 'Debitur Kode',
      'debitur_detail_kode' => 'Debitur Detail Kode',
      'created_by' => 'Created By',
      'created_at' => 'Created At',
      'debitur_nomor' => 'Debitur Nomor',
    ];
  }
}
