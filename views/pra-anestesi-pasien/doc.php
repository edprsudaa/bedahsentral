<?php

use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\PraAnestesi;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use yii\helpers\ArrayHelper;

$model = PraAnestesi::find()->where(['ppa_id' => $ppa_id])->andWhere('ppa_deleted_at is null')->one();
$style = 'border: 1px solid;';
if ($model->ppa_batal) {
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

$timoperasi = TimOperasi::find()->where(['to_id' => $model->ppa_to_id])->one();
$timoperasidetail = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id, 'tod_jo_id' => 3])->all();
?>
<style type="text/css">
  .bedah {
    width: 33%;
    float: left;
    text-align: center;
  }

  .bedah p {
    padding-bottom: 50px;
  }

  #pengkajian {
    border-top: 2px solid;
    border-bottom: 2px solid;
  }

  th {
    text-align: center;
  }

  #head {
    text-align: center;
  }

  #ket {
    text-align: center;
  }

  #dbn {
    text-align: center;
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
  }
</style>


<table class="table table-sm table-form">
  <tr>
    <td style="width: 15%;"><label>Tanggal Pukul</label></td>
    <td><label>:</label></td>
    <td colspan="3" style="width: 35%;">
      <?= $model->ppa_tanggal_pukul; ?>
    </td>
    <td colspan="3" style="width: 15%;"><label>Diagnosis</label></td>
    <td><label>:</label></td>
    <td style="width: 35%;">
      <?= $model->ppa_diagnosis; ?>
    </td>
  </tr>
</table>
<table border="1" style="margin-bottom: 30px;" align="center">
  <tr>
    <th>Kesadaran</th>
    <th>Tekanan darah</th>
    <th>Frekuensi Nadi</th>
    <th>Frekuensi Nafas</th>
    <th>BB</th>
  </tr>
  <tr>
    <td>
      <?= $model->ppa_kesadaran; ?>
    </td>
    <td>
      <?= $model->ppa_tekanan_darah; ?>
    </td>
    <td>
      <?= $model->ppa_frekuensi_nadi; ?>
    </td>
    <td>
      <?= $model->ppa_frekuensi_nafas; ?>
    </td>
    <td>
      <?= $model->ppa_bb; ?>
    </td>
  </tr>
</table>
<table class="table table-sm">

  <tr style="width:100%">
    <td style="width: 15%;"><label>Riwayat Operasi/Anestesi</label></td>
    <td><label>:</label></td>
    <td colspan="3" style="width: 35%;">
      <?php
      echo $model->ppa_riwayat_operasi;
      ?>
    </td>

    <td style="width: 15%;"><label>Rencana Tindakan</label></td>
    <td><label>:</label></td>
    <td colspan="3" style="width: 35%;">
      <?= $model->ppa_rencana_tindakan; ?>
    </td>
  </tr>
  <tr style="width:100%">
    <td style="width: 15%;"><label>Riwayat komplikasi Anestesi pada Pasien/Keluarga</label></td>
    <td><label>:</label></td>
    <td style="width: 15%;">
      <?php
      echo $model->ppa_riwayat_komplikasi;
      // echo "<pre>";print_r($ppa_riwayat_komplikasi);die;
      ?>
    </td>

    <td style="width: 15%;"><label>Obat yang sedang dikonsumsi</label></td>
    <td><label>:</label></td>
    <td style="width: 15%;">
      <?php
      echo $model->ppa_obat_yang_sedang_konsumsi;
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Gigi</label></td>
    <td><label>:</label></td>
    <td colspan="3">
      <?php
      echo $model->ppa_gigi_normal;
      // echo "<pre>";
      // print_r($ppa_gigi_normal);
      // die;
      ?>
    </td>

    <td><label>Pemeriksaan laboratorium yang bermakna</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_pemeriksaan_laboratorium;
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Jalan Nafas</label></td>
    <td><label>:</label></td>
    <td colspan="3">
      <?php
      echo $model->ppa_jalan_nafas;
      // echo "<pre>";
      // print_r($ppa_jalan_nafas);
      // die;
      ?>
      <table align="center" id="tabelclass">
        <tr>
          <th>class 1</th>
          <th>class 2</th>
          <th>class 3</th>
          <th>class 4</th>
        </tr>
        <tr>
          <td>
            <?= $model->ppa_jalan_nafas_class1; ?>
          </td>
          <td>
            <?= $model->ppa_jalan_nafas_class2; ?>
          </td>
          <td>
            <?= $model->ppa_jalan_nafas_class3; ?>
          </td>
          <td>
            <?= $model->ppa_jalan_nafas_class4; ?>
          </td>
        </tr>
      </table>
    </td>
    <td><label>Pemeriksaan radiologi yang bermakna</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_pemeriksaan_radiologi;
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Respirasi</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_respirasi;
      ?>
    </td>

    <td><label>Pemeriksaan Penunjang lain yang bermakna</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_pemeriksaan_penunjang;
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Cardiovaskuler</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_cardiovaskuler;
      ?>
    </td>

    <td><label>Puasa</label></td>
    <td><label>:</label></td>
    <td>
      <label>Makan terakhir pukul :</label>
      <label style="margin-top: 20px;">Minum terakhir pukul :</label>
    </td>
    <td>
      <?= $model->ppa_puasa_makan_terakhir_pukul; ?>
      <?= $model->ppa_puasa_minum_terakhir_pukul; ?>
    </td>
  </tr>
  <tr>
    <td><label>Sistem Pencernaan</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_sistem_pencernaan;
      ?>
    </td>

    <td><label>Risiko Anestesi ASA</label></td>
    <td><label>:</label></td>
    <td colspan="2">
      <?php
      echo $model->ppa_risiko_anestesi;
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Neuromusculoskeletal</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_neuromusculoscletal;
      ?>
    </td>

    <td><label>Rencana Anestesi</label></td>
    <td><label>:</label></td>
    <td colspan="2">
      <?php
      echo $model->ppa_rencana_anestesi;
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Ginjal/endokrin</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_ginjal;
      ?>
    </td>

    <td><label>Premedikasi</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_premedikasi;
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Alergi Obat/Makanan</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_alergi_obat;
      ?>
    </td>

    <td><label>Instruksi lain Pre-Anestesi</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_intruksi_lain;
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Lain-lain</label></td>
    <td><label>:</label></td>
    <td>
      <?php
      echo $model->ppa_lain_lain;
      ?>
    </td>

  </tr>
</table>