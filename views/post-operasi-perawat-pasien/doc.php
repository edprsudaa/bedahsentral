<?php

use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\PostOperasiPerawat;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use yii\helpers\ArrayHelper;

$model = PostOperasiPerawat::find()->where(['psop_id' => $psop_id])->andWhere('psop_deleted_at is null')->one();
$style = 'border: 1px solid;';
if ($model->psop_batal) {
  if (\Yii::$app->params['setting']['doc']['bg_batal']) {
    $path = \Yii::getAlias('@webroot') . \Yii::$app->params['setting']['doc']['bg_batal'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    $style = "border: 1px solid;background-image:url('" . $base64 . "');background-repeat: repeat;background-size: 80px 50px;";
  }
}
// echo'<pre/>';print_r($penunjang_order);die();
// https://www.picturetopeople.org/text_generator/others/transparent/transparent-text-generator.html
echo \Yii::$app->controller->renderPartial('/layouts/doc_kop.php', ['params' => ['reg_kode' => $model->timoperasi->layanan->registrasi_kode, 'pl_id' => '']]);
?>
<style type="text/css">
  .table-form th,
  .table-form td {
    padding: 0.5px;
    padding-top: 7px;
    /* border: 0.5px solid #3c8dbc; */
    /* border: 0px; */
  }

  .bedah {
    width: 50%;
    float: left;
    text-align: center;
  }

  .bedah p {
    padding-bottom: 50px;
  }

  /* table {
    margin-top: 20px;
  } */
</style>
<h3><b>C. POST OPERASI</b></h3>
<table class="table table-sm table-form" style="<?= $style ?>">
  <!-- <tr>
    <td colspan="6" style="text-align: center;" class="text-left bg-lightblue"><b>C. POST OPERASI</b></td>
  </tr> -->
  <tr>
    <!-- <div style="display: flex;justify-content:space-around;"> -->
    <!-- <div> -->
    <td valign="top">
      <label><?= $model->getAttributeLabel('psop_ruang_pemulihan') ?> </label>
    </td>
    <td valign="top"><label>:</label></td>
    <td colspan="4">
      <?php if ($model->psop_ruang_pemulihan == "Ya") { ?>
        <?= $model->psop_ruang_pemulihan ?>, <br>
        <!-- <div> -->
        <label><?= $model->getAttributeLabel('psop_masuk_rr') ?> </label>
        <?= $model->psop_masuk_rr ?> <br>
        <label><?= $model->getAttributeLabel('psop_keluar_rr') ?> </label>
        <?= $model->psop_keluar_rr ?>
        <!-- </div> -->
      <?php } else { ?>
        <?= $model->psop_ruang_pemulihan ?>,
      <?php } ?>
    </td>
    <!-- </div> -->
    <!-- </div> -->
  </tr>
  <tr>
    <td><label>1. <?= $model->getAttributeLabel('psop_keadaan_umum') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4">
      <?= $model->psop_keadaan_umum ?>
    </td>
  </tr>
  <tr>
    <td><label>2. <?= $model->getAttributeLabel('psop_tingkat_kesadaran') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_tingkat_kesadaran ?></td>
  </tr>
  <tr>
    <td rowspan="2"></td>
    <td rowspan="2"></td>
    <td>
      <label><?= $model->getAttributeLabel('psop_e') ?> </label>: <?= $model->psop_e ?>

    </td>
    <td>
      <label><?= $model->getAttributeLabel('psop_m') ?> </label>: <?= $model->psop_m ?>
    </td>
    <td>
      <label><?= $model->getAttributeLabel('psop_v') ?> </label>: <?= $model->psop_v ?>
    </td>
    <td>
      <label><?= $model->getAttributeLabel('psop_total_gcs') ?>: </label> <?= $model->psop_total_gcs ?>
    </td>
  </tr>
  <tr>
    <td>
      <label><?= $model->getAttributeLabel('psop_tekanan_darah') ?> </label>: <?= $model->psop_tekanan_darah ?>
    </td>
    <td>
      <label><?= $model->getAttributeLabel('psop_nadi') ?> </label>: <?= $model->psop_nadi ?>
    </td>
    <td colspan="2">
      <label><?= $model->getAttributeLabel('psop_suhu') ?> </label>: <?= $model->psop_suhu ?>°C
    </td>
  </tr>

  <tr>
    <td><label>3. <?= $model->getAttributeLabel('psop_pernapasan') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_pernapasan ?></td>
  </tr>
  <tr>
    <td><label>4. <?= $model->getAttributeLabel('psop_sirkulasi') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_sirkulasi ?></td>
  </tr>
  <tr>
    <td><label>5. <?= $model->getAttributeLabel('psop_turgor_kulit') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_turgor_kulit ?></td>
  </tr>
  <tr>
    <td><label>6. <?= $model->getAttributeLabel('psop_posisi_klien') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_posisi_klien ?></td>
  </tr>
  <tr>
    <td><label>7. <?= $model->getAttributeLabel('psop_pasang_drain') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_pasang_drain ?></td>
  </tr>
  <tr>
    <td><label>8. <?= $model->getAttributeLabel('psop_jaringan_pa_form') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_jaringan_pa_form ?></td>
  </tr>
  <tr>
    <td><label>9. <?= $model->getAttributeLabel('psop_resep') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_resep ?></td>
  </tr>
  <tr>
    <td><label>&nbsp;&nbsp;&nbsp;&nbsp;<?= $model->getAttributeLabel('psop_jam_panggil_perawat_ruangan') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_jam_panggil_perawat_ruangan ?></td>
  </tr>
  <tr>
    <td><label>&nbsp;&nbsp;&nbsp;&nbsp;<?= $model->getAttributeLabel('psop_jam_perawat_datang') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_jam_perawat_datang ?></td>
  </tr>

  <tr>
    <td><label>10. <?= $model->getAttributeLabel('psop_barang_diserahkan_via_prwt_rgn') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4">
      <?php
      $array_barang = json_decode($model->psop_barang_diserahkan_via_prwt_rgn);
      if ($array_barang != NULL) {
        foreach ($array_barang as $val) {
          echo "(" . $val . ")";
        }
      } else {
        echo "-";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="6"><label>11. Pesan Khusus</label></td>
  </tr>
  <tr>
    <td><label>a. Mobilisasi</label></td>
    <td><label>:</label></td>
    <td><?= $model->psop_bedrest ?> jam</td>
    <td colspan="3">Head Up: <?= $model->psop_head_up ?>°</td>
  </tr>
  <tr>
    <td><label>b. Diit (Jam) </label></td>
    <td><label>:</label></td>
    <td><?= $model->psop_puasa ?> jam</td>
    <td colspan="3">Lain-lain: <?= $model->psop_diit_lain_lain ?></td>
  </tr>
  <tr>
    <td><label>c. <?= $model->getAttributeLabel('psop_resep_obat_post_operasi') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_resep_obat_post_operasi ?></td>
  </tr>
  <tr>
    <td><label>d. Lain-lain </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_lain_lain ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('psop_masalah') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_masalah ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('psop_tindakan') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_tindakan ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('psop_evaluasi') ?> </label></td>
    <td><label>:</label></td>
    <td colspan="4"><?= $model->psop_evaluasi ?></td>
  </tr>

</table>

<div class="ttd" style="width: 100%;">
  <div class="bedah">
    <p>Perawat Ruangan</p>
    <?php
    $timdetail = TimOperasi::find()->where(['to_id' => $model->psop_to_id])->one();
    $perawat_ruangan = $timdetail->createdby->pegawai;
    // echo "<pre>";print_r($timdetail->createdby->pegawai);die;
    // foreach ($timdetail as $val) {
    echo HelperSpesial::getNamaPegawai($perawat_ruangan);
    // }
    ?>
  </div>
  <div class="bedah">
    <p>Perawat Ruang Pemulihan</p>
    <?php
    $timdetail = TimOperasiDetail::find()->where(['tod_to_id' => $model->psop_to_id, 'tod_jo_id' => 7])->all();
    foreach ($timdetail as $val) {
      echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
    }
    ?>
  </div>
</div>