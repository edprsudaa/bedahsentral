<?php

namespace app\components\mdcp;

use Yii;
use app\components\MakeResponse;
use app\models\pendaftaran\Pasien;
use app\models\pendaftaran\Registrasi;
use app\models\pendaftaran\Layanan;
use app\models\bedahsentral\Log;
use yii\helpers\ArrayHelper;
use app\components\HelperGeneral;

class MdcpBase
{
  public static function getRegistrasi($reg_kode)
  {
    $d = Registrasi::find(['kode', 'tgl_masuk'])->with(['pasien'])->where(['kode' => $reg_kode])->asArray()->one();
    if ($d) {
      $umr = HelperGeneral::getUmur($d['pasien']['tgl_lahir']);
      return [
        'ps_kode' => $d['pasien']['kode'],
        'ps_nama' => $d['pasien']['nama'],
        'ps_tgl_lahir' => $d['pasien']['tgl_lahir'],
        'ps_tempat_lahir' => $d['pasien']['tempat_lahir'],
        'ps_gender' => Pasien::$jenis_kelamin[$d['pasien']['jkel']],
        'ps_umur' => $umr['th'] . 'TH ' . $umr['bl'] . 'BL ' . $umr['hr'] . 'HR',
        'reg_kode' => $d['kode'],
        'reg_tgl' => $d['tgl_masuk']
      ];
    }
  }
  public static function getLayanan($pl_id)
  {
    $d = Layanan::find()->with(['unit', 'registrasi.pasien'])->where(['id' => $pl_id])->asArray()->one();
    if ($d) {
      $umr = HelperGeneral::getUmur($d['registrasi']['pasien']['tgl_lahir']);
      return [
        'ps_kode' => $d['registrasi']['pasien']['kode'],
        'ps_nama' => $d['registrasi']['pasien']['nama'],
        'ps_tgl_lahir' => $d['registrasi']['pasien']['tgl_lahir'],
        'ps_tempat_lahir' => $d['registrasi']['pasien']['tempat_lahir'],
        'ps_gender' => Pasien::$jenis_kelamin[$d['registrasi']['pasien']['jkel']],
        'ps_umur' => $umr['th'] . 'TH ' . $umr['bl'] . 'BL ' . $umr['hr'] . 'HR',
        'reg_kode' => $d['registrasi']['kode'],
        'reg_tgl' => $d['registrasi']['tgl_masuk'],
        'pl_id' => $d['id'],
        'pl_tgl' => $d['tgl_masuk'],
        'unt_id' => $d['unit_kode'],
        'unt_nama' => $d['unit']['nama']
      ];
    }
  }
}
