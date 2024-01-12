<?php

use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\IntraAnestesi;
use app\models\bedahsentral\MedikasiIntraAnestesi;
use app\models\bedahsentral\CairanMasukIntraAnestesi;
use app\models\bedahsentral\TimOperasiDetail;
use app\models\bedahsentral\CairanKeluarIntraAnestesi;
use app\models\medis\TtvIntraAnestesi;
use yii\helpers\ArrayHelper;

$model = IntraAnestesi::find()->where(['mia_id' => $mia_id])->andWhere('mia_deleted_at is null')->one();
$style = 'border: 1px solid;';
if ($model->mia_batal) {
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
echo \Yii::$app->controller->renderPartial('../layouts/doc_kop.php', ['params' => ['reg_kode' => $model->timoperasi->layanan->registrasi_kode, 'pl_id' => '']]);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<style type="text/css">
  .bedah {
    width: 33%;
    float: left;
    text-align: center;
  }

  .bedah p {
    padding-bottom: 50px;
  }

  #obat {
    writing-mode: tb-rl;
    transform: rotate(180deg);
  }

  #pengkajian {
    border-top: 2px solid;
    border-bottom: 2px solid;
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
    border: 0px;
  }
</style>

<table class="table table-sm table-form">
  <tr style="border:0px;">
    <td style="width: 15%;"></td>
    <td></td>
    <td style="width: 10%;"></td>
    <td></td>
    <td></td>
    <td style="width: 15%;"></td>
    <td></td>
  </tr>
  <tr>
    <th class="text-left bg-lightblue" colspan="7">INTRA ANESTESI</th>
  </tr>
  <tr>
    <td><label>Dokter anestesi:</label></td>
    <td>
      <?php
      $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->mia_to_id, 'tod_jo_id' => 2])->all();
      foreach ($detail as $val) {
        echo HelperSpesial::getNamaPegawai($val->pegawai);
      }
      ?>
    </td>
    <td><label>Dokter Operator:</label></td>
    <td colspan="2">
      <?php
      $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->mia_to_id, 'tod_jo_id' => 1])->all();
      foreach ($detail as $val) {
        echo HelperSpesial::getNamaPegawai($val->pegawai);
      }
      ?>
    </td>
    <td colspan="2"><b>OK:</b></td>
  </tr>

  <tr>
    <td rowspan="2"><label>Penata Anestesi:</label></td>
    <td rowspan="2">
      <?php
      $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->mia_to_id, 'tod_jo_id' => 5])->all();
      $no = 1;
      foreach ($detail as $val) {
        echo $no++ . '. ' . HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
      }
      ?>
    </td>
    <td rowspan="2"><label>Asisten :</label></td>
    <td colspan="2" rowspan="2">
      <?php
      $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->mia_to_id, 'tod_jo_id' => 3])->all();
      $no = 1;
      foreach ($detail as $val) {
        echo $no++ . '. ' . HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
      }
      ?>
    </td>
    <td><label><?= $model->getAttributeLabel('mia_jam_mulai_anestesi') ?> :</label></td>
    <td><?= $model->mia_jam_mulai_anestesi ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('mia_jam_mulai_operasi') ?> :</label></td>
    <td><?= $model->mia_jam_mulai_operasi ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('mia_premedikasi') ?> :</label></td>
    <td colspan="4"><?= $model->mia_premedikasi ?></td>
    <td><label><?= $model->getAttributeLabel('mia_jam_berakhir_operasi') ?> :</label></td>
    <td><?= $model->mia_jam_berakhir_operasi ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('mia_jam') ?> :</label></td>
    <td colspan="4"><?= $model->mia_jam ?></td>
    <td><label><?= $model->getAttributeLabel('mia_jam_berakhir_anestesi') ?> :</label></td>
    <td><?= $model->mia_jam_berakhir_anestesi ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('mia_posisi_operasi') ?> :</label></td>
    <td colspan="6">
      <?php
      $mia_posisi_operasi = json_decode($model->mia_posisi_operasi);
      if ($mia_posisi_operasi != NULL) {
        foreach ($mia_posisi_operasi as $val) {
          echo $val . "</br>";
        }
      } else {
        echo "-";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('mia_teknik_anestesi') ?> :</label></td>
    <td colspan="6">
      <?php
      $mia_teknik_anestesi = json_decode($model->mia_teknik_anestesi);
      if ($mia_teknik_anestesi != NULL) {
        foreach ($mia_teknik_anestesi as $val) {
          echo $val . "</br>";
        }
      } else {
        echo "-";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('mia_jalan_nafas') ?> :</label></td>
    <td colspan="6"><?= $model->mia_jalan_nafas ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('mia_pengaturan_nafas') ?> :</label></td>
    <td colspan="6"><?= $model->mia_pengaturan_nafas ?></td>
  </tr>
</table>


<h5 class="text-left bg-lightblue">MEDIKASI</h5>
<table width="100%" border="1" cellspacing="0" id="tbl-medikasi">
  <tr>
    <td style="width: 10%;"><b>Jam</b></td>
    <?php
    $jam = MedikasiIntraAnestesi::find()->where(['mmia_intra_anestesi_mia_id' => $model->mia_id])->all();
    foreach ($jam as $val) { ?>
      <td style="width:5px;"><span id="obat"><?= $val->mmia_waktu ?></span></td>
    <?php } ?>

  </tr>
  <tr>
    <td><b>Nama Obat</b></td>
    <?php
    foreach ($jam as $val) { ?>
      <td style="width:5px;"><span id="obat"><?= $val->mmia_nama_obat ?></span></td>
    <?php } ?>
  </tr>
</table>
<br><br>


<h5 class="text-left bg-lightblue">CAIRAN MASUK</h5>
<table width="100%" border="1" cellspacing="0" id="tbl-cairan-masuk">
  <tr>
    <td style="width: 10%;"><b>Jam</b></td>
    <?php $masuk = CairanMasukIntraAnestesi::find()->where(['cmasuk_intra_operasi_mia_id' => $model->mia_id])->all();
    foreach ($masuk as $val) { ?>
      <td style="width:5px;"><span id="obat"><?= $val->cmasuk_waktu ?></span></td>
    <?php } ?>
  </tr>
  <tr>
    <td><b>Nama Obat</b></td>
    <?php
    foreach ($masuk as $val) { ?>
      <td style="width:5px;"><span id="obat"><?= $val->cmasuk_cairan_nama . "<b>(" . $val->cmasuk_jumlah . ")</b>" ?></span></td>
    <?php } ?>

  </tr>
</table>
<br><br>


<h5 class="text-left bg-lightblue">CAIRAN KELUAR</h5>
<table width="100%" border="1" cellspacing="0" id="tbl-cairan-keluar">

  <tr>
    <?php $keluar =  CairanKeluarIntraAnestesi::find()->where(['ckeluar_intra_operasi_mia_id' => $model->mia_id])->all(); ?>
    <td style="width: 10%;"><b>Jam</b></td>
    <?php foreach ($keluar as $val) { ?>
      <td style="width:5px;"><span id="obat"><?= $val->ckeluar_waktu ?></span></td>
    <?php } ?>
  </tr>
  <tr>
    <td><b>Nama Obat</b></td>
    <?php foreach ($keluar as $val) { ?>
      <td style="width:5px;"><span id="obat"><?= $val->ckeluar_cairan_nama . "<b>(" . $val->ckeluar_jumlah . ")</b>" ?></span></td>
    <?php } ?>
  </tr>
</table>
<br><br>