<?php

namespace app\models\sso;

use Yii;
use app\models\other\BaseQuery;
use app\models\other\TrimBehavior;
use app\models\pegawai\TbPegawai;

class PegawaiUser extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'sso.akn_user';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['id_pegawai', 'username', 'password'], 'required'],
      [['id_pegawai', 'status'], 'default', 'value' => null],
      [['id_pegawai', 'status'], 'integer'],
      [['tanggal_pendaftaran'], 'safe'],
      [['token_aktivasi'], 'string'],
      [['username', 'nama', 'role'], 'string', 'max' => 50],
      [['password'], 'string', 'max' => 100],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'userid' => 'Userid',
      'id_pegawai' => 'Kode Pegawai',
      'username' => 'Username',
      'password' => 'Password',
      'nama' => 'Nama',
      'tanggal_pendaftaran' => 'Tanggal Pendaftaran',
      'role' => 'Role',
      'token_aktivasi' => 'Token Aktivasi',
      'status' => 'Status',
    ];
  }
  // static function find()
  // {
  //   return (new BaseQuery(get_called_class()))->setPrefix(self::prefix);
  // }
  public function getPegawai()
  {
    return $this->hasOne(TbPegawai::className(), ['pegawai_id' => 'id_pegawai']);
  }
}
