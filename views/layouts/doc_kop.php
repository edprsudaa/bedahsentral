<?php

use yii\helpers\Url;
use app\models\pendaftaran\Pasien;
use app\models\pendaftaran\Registrasi;
use app\models\pendaftaran\Layanan;

$kode = null;
if (isset($params['reg_kode'])) {
  $kode = Registrasi::find()->where(['kode' => $params['reg_kode']])->asArray()->one()['pasien_kode'];
} else if (isset($data['pl_id'])) {
  $kode = Layanan::find()->with(['registrasi'])->where(['id' => $params['pl_id']])->asArray()->one()['registrasi']['pasien_kode'];
}
// print_r($data);
$pasien = Pasien::find()->where(['kode' => $kode])->asArray()->one();
?>
<style>
  table {
    margin-left: auto !important;
    margin-right: auto !important;
    margin-bottom: 10px !important;
    width: 100% !important;
  }

  th {
    background-color: #D3D3D3 !important;
    text-align: center !important;
  }

  td {
    padding: 0 0 0 25px !important;
  }

  .td-kop {
    padding: 0 !important;
    margin: 0 !important;
  }
</style>
<table class="tbl-kop" style="width: 100%; border: 1px solid;">
  <tbody>
    <tr>
      <?php
      if (\Yii::$app->params['setting']['kop_doc']['logo1']) {
        $path = \Yii::getAlias('@webroot') . \Yii::$app->params['setting']['kop_doc']['logo1'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      ?>
        <td class="td-kop" rowspan="4">
          <img src="<?= $base64 ?>" alt="" width="8%" style="padding: 0; margin-left: 10px;margin-top: 10px;">
        </td>
      <?php
      }
      ?>
      <td rowspan="4" style="text-align: center; padding:0; margin:0; width: 30%;">
        <p style="padding: 1px; font-size:12px; margin: 0;">
          <?= \Yii::$app->params['setting']['kop_doc']['nama'] ?>
        </p>
        <p style="font-size:16px; margin: 0;">
          <b><?= \Yii::$app->params['setting']['kop_doc']['namasub'] ?></b>
        </p>
        <p style="font-size: 9px; font-weight: 700; margin: 0;">
          <?= \Yii::$app->params['setting']['kop_doc']['alamat'] ?><br>
          <?= \Yii::$app->params['setting']['kop_doc']['telp'] ?><br>
          <?= \Yii::$app->params['setting']['kop_doc']['kota'] ?>
        </p>
      </td>
      <?php
      if (\Yii::$app->params['setting']['kop_doc']['logo2']) {
        $path = \Yii::getAlias('@webroot') . \Yii::$app->params['setting']['kop_doc']['logo2'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      ?>
        <td rowspan="4" class="td-kop" style="text-align: center;">
          <img src="<?= $base64 ?>" alt="" width="9%" style="padding: 0;">
        </td>
      <?php
      }
      ?>
      <?php
      if (\Yii::$app->params['setting']['kop_doc']['logo3']) {
        $path = \Yii::getAlias('@webroot') . \Yii::$app->params['setting']['kop_doc']['logo3'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      ?>
        <td rowspan="4" class="td-kop" style="text-align: center;">
          <img src="<?= $base64 ?>" alt="" width="9%" style="padding: 0;">
        </td>
      <?php
      }
      ?>
      <td style="padding-left: 9px;padding-right:1px; font-size: 11px; width:18%;">Nama Pasien</td>
      <td valign="center" style="font-size: 11px;padding-left: 1px;padding-right: 1px; width: 1%;">: </td>
      <td style="font-size: 11px; padding: 1px; width:24%"><?= $pasien['nama'] ?></td>
    </tr>
    <tr>
      <td style="padding-left: 9px;padding-right:1px; font-size: 11px;">Nomor Rekam Medis</td>
      <td valign="center" style="font-size: 11px;padding-left: 1px;padding-right: 1px;">: </td>
      <td style="font-size: 11px; padding: 1px;"><?= $pasien['kode'] ?></td>
    </tr>
    <tr>
      <td style="padding-left: 9px;padding-right:1px; font-size: 11px;">Tanggal Lahir</td>
      <td valign="center" style="font-size: 11px;padding-left: 1px;padding-right: 1px;">: </td>
      <td style="font-size: 11px; padding: 1px;"><?= date('d-m-Y', strtotime($pasien['tgl_lahir'])) ?></td>
    </tr>
    <tr>
      <td style="padding-left: 9px;padding-right:1px; font-size: 11px;">Jenis Kelamin</td>
      <td valign="center" style="font-size: 11px;padding-left: 1px;padding-right: 1px;">: </td>
      <td style="font-size: 11px; padding: 1px;"><?= ($pasien['jkel'] == 'l' ? 'Laki-laki' : 'Perempuan') ?></td>
    </tr>
    <tr>
      <td colspan="4" style="padding: 1;">
        <hr style="margin: 3px; height: 3px; background: #000; color:#000">
        <hr style="margin: 0 5px 0 5px; background: #000; color:#000">
      </td>
      <td colspan="3" style="padding: 1px;text-align:center;font-size: 11px;">(<i>Mohon diisi atau tempelkan stiker Jika ada</i>)</td>
    </tr>
  </tbody>
</table>