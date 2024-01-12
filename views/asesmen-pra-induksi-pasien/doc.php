<?php

use app\components\HelperGeneral;
use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\AsesmenPraInduksi;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\PemberianObatPremedikasiAnestesi;
use app\models\bedahsentral\TimOperasiDetail;
use yii\helpers\ArrayHelper;

$model = AsesmenPraInduksi::find()->where(['api_id' => $api_id])->andWhere('api_deleted_at is null')->one();
$style = 'border: 1px solid;';
if ($model->api_batal) {
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

$timoperasi = TimOperasi::find()->where(['to_id' => $model->api_to_id])->all();
?>
<style type="text/css">
  .ttd {
    float: right;
  }

  h2 {
    font-size: 20px;
  }

  .table-form th,
  .table-form td {
    /* padding: 0.5px; */
    /* text-align: center; */
    /* border: 0.5px solid #3c8dbc; */
  }

  td {
    padding: 5px;
  }
</style>

<h2 style="text-align: center;">CATATAN PERIOPERATIF SEDASI/ANESTESI</h2>
<table class="table table-sm table-form">
  <tr>
    <td style="width: 15%;"><label>Nama Dokter Anestesi</label></td>
    <td style="width: 1%;"><label>:</label></td>
    <td style="width: 34%;">
      <?php
      $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->api_to_id, 'tod_jo_id' => 2])->all();

      foreach ($detail as $val) {
        echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
      }
      ?>
    </td>
    <td style="width: 15%;"><label>Rencana Tindakan</label></td>
    <td style="width: 1%;"><label>:</label></td>
    <td style="width: 34%;">
      <?php
      foreach ($timoperasi as $val) {
        echo $val->to_tindakan_operasi . "</br>";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Diagnosa Medis</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      foreach ($timoperasi as $val) {
        echo $val->to_diagnosa_medis_pra_bedah . "<br>";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Tanggal</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      foreach ($timoperasi as $val) {
        echo \Yii::$app->formatter->asDate($val->to_tanggal_operasi);
      }
      ?>
    </td>
    <td><label>Lokasi</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      foreach ($timoperasi as $val) {
        echo $val->unit->nama;
      }
      ?>
    </td>
  </tr>
</table>

<table class="table table-sm table-form" style="border:1px solid">
  <tr>
    <th class="text-left bg-lightblue" colspan="3">ASESMEN PRA INDUKSI</th>
  </tr>
  <tr>
    <td colspan="3"><b>Riwayat Penyakit</b></td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td style="width: 30%;">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_kesadaran') ?> </label>
    </td>
    <td style="width: 1%;"><label>:</label></td>
    <td>
      <?php
      echo $model->api_kesadaran;
      ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_td') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->api_td;
      ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_hr') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->api_hr;
      ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_rr') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->api_rr;
      ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_temp') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->api_temp;
      ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_gol_darah') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->api_gol_darah;
      ?>
    </td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('api_puasa') ?> </label></td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_puasa; ?> <b>WIB</b>
    </td>
  </tr>
  <tr>
    <td style="color: #fff;">-</td>
  </tr>
  <tr>
    <td><b>Akses Infus</b></td>
    <td><label>:</label></td>
    <td><label>No. IV LINE</label></td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_infus_tangan_kanan') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_infus_tangan_kanan; ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_infus_tangan_kiri') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_infus_tangan_kiri; ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_infus_kaki_kanan') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_infus_kaki_kanan; ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_infus_kaki_kiri') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_infus_kaki_kiri; ?>
    </td>
  </tr>
  <tr>
    <td style="color: #fff;">-</td>
  </tr>
  <tr>
    <td><b>Akses Lain</b></td>
    <td><label>:</label></td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_ngt') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_ngt; ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_kateter') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_kateter; ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_drain') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_drain; ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_cvp') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_cvp; ?>
    </td>
  </tr>
  <tr>
    <!-- <td class="samping"></td> -->
    <td>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><?= $model->getAttributeLabel('api_lain_lain') ?> </label>
    </td>
    <td><label>:</label></td>
    <td>
      <?= $model->api_lain_lain; ?>
    </td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('api_status_asa') ?></label> </td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->api_status_asa;
      ?>
    </td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('api_rencana_tindakan_anestesi') ?></label> </td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->api_rencana_tindakan_anestesi;
      ?>
    </td>
  </tr>
</table>

<br>
<br>
<br>

<table>
  <tr>
    <td style="width:25%"></td>
    <td style="width:25%"></td>
    <td style="width:20%"></td>
    <td style="width:30%;text-align:center">
      <p>Dokter Anestesi</p>
      <br><br><br>
      <p>
        <?php
        $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->api_to_id, 'tod_jo_id' => 2])->all();
        foreach ($detail as $val) {
          echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
        }
        ?>
      </p>
    </td>
  </tr>
</table>