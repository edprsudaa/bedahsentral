<?php

use app\components\Akun;
use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\LaporanOperasi;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use app\models\sso\PegawaiUser;
use yii\helpers\ArrayHelper;

$style = 'border: 1px solid;';
echo \Yii::$app->controller->renderPartial('/layouts/doc_kop.php', ['params' => ['reg_kode' => $model->timoperasi->layanan->registrasi_kode]]);
?>
<style type="text/css">
  td {
    font-size: 12px;
    padding: 5px;
  }
</style>
<table class="table table-sm table-form">
  <tr>
    <td width="20%"><label>A. Asal Ruangan</label></td>
    <td width="1%">:</td>
    <td>
      <?= $data_pasien['unitAsal']['nama'] ?>
    </td>
  </tr>
  <tr>
    <td><label>B. Diagnosa</label></td>
    <td>:</td>
    <td>
      <?= $model->bat_diagnosa; ?>
    </td>
  </tr>
  <tr>
    <td><label>C. Tindakan Operasi</label></td>
    <td>:</td>
    <td>
      <?= $model->bat_tindakan; ?>
    </td>
  </tr>
  <tr>
    <td><label>D. Tanggal Penundaan</label></td>
    <td>:</td>
    <td>
      <?= date('d F Y', strtotime($model->bat_tanggal_tunda)) ?>
    </td>
    </td>
  </tr>
</table>

<h4 style="text-align: center;font-size:12pt;margin-bottom:2px">Alasan Penundaan</h4>
<table border="1" style="border-collapse: collapse;" width="100%" class="table table-sm table-form">
  <tr>
    <td width="30%" valign="top" style="height:150px"><label><b>a. Pasien</b></label></td>
    <td width="40%">
      <?php
      $no = 1;
      if ($model->bat_alasan_pasien) {
        foreach ($model->bat_alasan_pasien as $key) { ?>
          <p><?= $no++ ?>). <?= $key ?></p>
        <?php }
      } else { ?>
        <span style="color: red;">Tidak Ada</span>
      <?php } ?>
    </td>
    <td valign="top">
      Lain-lain:<br><br>
      <?= $model->bat_alasan_pasien_lain ? $model->bat_alasan_pasien_lain : "<span style='color: red;'>Tidak Ada</span>"; ?>
    </td>
  </tr>
  <tr>
    <td valign="top" style="height:150px"><label><b>b. Operator</b></label></td>
    <td>
      <?php
      $no = 1;
      if ($model->bat_alasan_operator) {
        foreach ($model->bat_alasan_operator as $key) { ?>
          <p><?= $no++ ?>). <?= $key ?></p>
        <?php }
      } else { ?>
        <span style="color: red;">Tidak Ada</span>
      <?php } ?>
    </td>
    <td valign="top">
      Lain-lain:<br><br>
      <?= $model->bat_alasan_operator_lain ? $model->bat_alasan_operator_lain : "<span style='color: red;'>Tidak Ada</span>"; ?>
    </td>
  </tr>
  <tr>
    <td valign="top" style="height:150px"><label><b>c. Fasilitas Kamar Operasi</b></label></td>
    <td>
      <?php
      $no = 1;
      if ($model->bat_alasan_faskamop) {
        foreach ($model->bat_alasan_faskamop as $key) { ?>
          <p><?= $no++ ?>). <?= $key ?></p>
        <?php }
      } else { ?>
        <span style="color: red;">Tidak Ada</span>
      <?php } ?>
    </td>
    <td valign="top">
      Lain-lain:<br><br>
      <?= $model->bat_alasan_faskamop_lain ? $model->bat_alasan_faskamop_lain : "<span style='color: red;'>Tidak Ada</span>"; ?>
    </td>
  </tr>
  <tr>
    <td valign="top" style="height:150px"><label><b>d. Ruang Perawatan</b></label></td>
    <td>
      <?php
      $no = 1;
      if ($model->bat_alasan_ruang_perawatan) {
        foreach ($model->bat_alasan_ruang_perawatan as $key) { ?>
          <p><?= $no++ ?>). <?= $key ?></p>
        <?php }
      } else { ?>
        <span style="color: red;">Tidak Ada</span>
      <?php } ?>
    </td>
    <td valign="top">
      Lain-lain:<br><br>
      <?= $model->bat_alasan_ruang_perawatan_lain ? $model->bat_alasan_ruang_perawatan_lain : "<span style='color: red;'>Tidak Ada</span>"; ?>
    </td>
  </tr>
</table>

<table class="table table-sm table-form">
  <tr>
    <td width="50%"></td>
    <td width="50%">Pekanbaru, <?= date('d F Y', strtotime($model->bat_tanggal_tunda)) ?></td>
  </tr>
  <tr>
    <td style="text-align: center;">
      <b>DPJP Bedah/Anestesi</b>
      <br><br><br><br>
      <?= HelperSpesial::getNamaPegawai($model->dpjpBedah); ?>
    </td>
    <td style="text-align: center;">
      <b>Kepala Ruangan/Perawat PJ Shift</b>
      <br><br><br><br>
      <?= HelperSpesial::getNamaPegawai($model->karu); ?>
    </td>
  </tr>
</table>