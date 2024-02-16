<?php

namespace app\models\sso;

use app\models\pegawai\TbPegawai;
use yii\base\NotSupportedException;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
  const STATUS_ACTIVE = 0;
  const STATUS_INACTIVE = 1;
  public static function tableName()
  {
    return 'sso.akn_user';
  }
  public static function getDb()
  {
    return \Yii::$app->db_sso;
  }
  /**
   * {@inheritdoc}
   */
  public static function findIdentity($id)
  {
    // $m= self::find()->where(['userid'=>$id])->one();
    // return isset($m) ? $m : null;
    return static::findOne(['userid' => $id]);
    // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
  }

  /**
   * {@inheritdoc}
   */
  public static function findIdentityByAccessToken($token, $type = null)
  {
    // foreach (self::$users as $user) {
    //     if ($user['accessToken'] === $token) {
    //         return new static($user);
    //     }
    // }
    // return null;
    throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
  }

  /**
   * Finds user by username
   *
   * @param string $username
   * @return static|null
   */
  public static function findByUsername($username)
  {
    return static::findOne(['username' => $username]);
    // foreach (self::$users as $user) {
    //     if (strcasecmp($user['username'], $username) === 0) {
    //         return new static($user);
    //     }
    // }

    // return null;
  }

  /**
   * {@inheritdoc}
   */
  public function getId()
  {
    // return $this->userid;
    return $this->getPrimaryKey();
  }

  /**
   * {@inheritdoc}
   */
  public function getAuthKey()
  {
    return false;
    // return $this->authKey;
  }

  /**
   * {@inheritdoc}
   */
  public function validateAuthKey($authKey)
  {
    return true;
    // return $this->authKey === $authKey;
  }

  /**
   * Validates password
   *
   * @param string $password password to validate
   * @return bool if password provided is valid for current user
   */
  public function validatePassword($password)
  {
    return $this->password === md5($password);
  }

  // public function getPegawai()
  // {
  //     return $this->hasOne(TbPegawai::className(), ['pegawai_id' => 'id_pegawai']);
  // }
}
