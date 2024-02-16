<?php

namespace app\components;
// use app\models\sdm\AksesUnit;
use app\models\pegawai\TbPegawai;
use app\models\sso\AksesUnit;
use yii\helpers\ArrayHelper;
use Yii;

class Akun
{
  public static function isGuest()
  {
    $user = Yii::$app->user;
    if (!$user->isGuest) {
      return false;
    }
    return true;
  }
  public static function user()
  {
    $user = Yii::$app->user;
    $pegawai = TbPegawai::find()->where(['pegawai_id' => $user->identity->idProfil])->one();

    $obj = new \stdClass();
    $obj->id = !$user->isGuest ? $user->identity->id : NULL;
    $obj->id_pegawai = !$user->isGuest ? $user->identity->idProfil : NULL;
    $obj->username = !$user->isGuest ? $user->identity->kodeAkun : NULL;
    $obj->namatanpagelar = !$user->isGuest ? $user->identity->nama : NULL;
    $obj->name = !$user->isGuest ? HelperSpesial::getNamaPegawai($pegawai) : NULL;
    // link untuk menampilkan foto profile
    if ($pegawai->profile_path) {
      $obj->photo = "http://123.231.247.213/rsud-app/web/file/profil/" . $pegawai->profile_path;
    } else {
      $obj->photo = Yii::$app->homeUrl . "images/avatar.jpg";
    }
    return $obj;
  }

  private static function getAksesUnitDb($user_id = null)
  {
    return AksesUnit::find()->joinWith(['unit' => function ($q) {
      // $q->active();
    }])->where(['id_aplikasi' => Yii::$app->params['app']['id']])->andWhere(['pengguna_id' => $user_id])->andWhere('tanggal_nonaktif is null')->andWhere('deleted_at is null')->asArray()->all();
  }

  private static function getAksesUnit()
  {
    $akses = \Yii::$app->session->get('sso.akses_unit');
    if (!$akses) {
      $user_id = self::user()->id;
      $akses = self::getAksesUnitDb($user_id);
      $list_akses = array();
      foreach ($akses as $v) {
        array_push($list_akses, ['id' => $v['unit_id'], 'nama' => $v['unit']['nama']]);
      }
      return $list_akses;
    } else {
      return $akses;
    }
  }

  public static function user_akses_unit()
  {
    $list_akses = self::getAksesUnit();
    return $list_akses;
  }

  public static function user_akses_unit_id()
  {
    $list_akses = self::getAksesUnit();
    return ArrayHelper::getColumn($list_akses, 'id');
  }

  public static function user_akses_unit_map()
  {
    $list_akses = self::getAksesUnit();
    return ArrayHelper::map($list_akses, 'id', 'nama');
  }

  public static function akses_unit_login($pgw_id = null, $original = true, $list = false)
  {
    $pgw_id = self::user()->id;
    $akses = self::getAksesUnitDb($pgw_id);
    $list_akses = array();
    foreach ($akses as $v) {
      array_push($list_akses, ['id' => $v['unit_id'], 'nama' => $v['unit']['nama']]);
    }
    return $list_akses;
  }
}
