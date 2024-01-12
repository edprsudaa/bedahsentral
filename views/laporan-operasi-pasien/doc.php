<?php

use app\components\Akun;
use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\LaporanOperasi;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use app\models\sso\PegawaiUser;
use yii\helpers\ArrayHelper;

$model = LaporanOperasi::find()->where(['lap_op_id' => $lap_op_id])->one();
$style = 'border: 1px solid;';
if ($model->lap_op_batal) {
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
echo \Yii::$app->controller->renderPartial('/layouts/doc_kop.php', ['params' => ['reg_kode' => $model->timoperasi->layanan->registrasi_kode]]);
$timoperasi = TimOperasi::find()->where(['to_id' => $model->lap_op_to_id])->one();
$timoperasidetail = TimOperasiDetail::find()->where(['tod_to_id' => $model->lap_op_to_id])->all();
?>
<style type="text/css">
  .table-form th,
  .table-form td {
    /* padding: 0.5px; */
    /* text-align: center; */
    /* border: 0.5px solid #3c8dbc; */
  }

  td {
    font-size: 11px;
    padding: 5px;
  }
</style>
<h4 style="text-align: center; margin-bottom:1px">LAPORAN OPERASI</h4>
<table border="1" style="border-collapse: collapse;" class="table table-sm table-form">
  <tr style="height:50px;text-align: center;">
    <td style="width:165px;text-align: center;">Tanggal Operasi</td>
    <td style="text-align: center;">Ruang Operasi</td>
    <td style="width:93px;text-align: center;"><?= $model->getAttributeLabel('lap_op_kelas') ?></td>
    <td style="width:68px;text-align: center;"><?= $model->getAttributeLabel('lap_op_jam_mulai') ?></td>
    <td style="width:70px;text-align: center;"><?= $model->getAttributeLabel('lap_op_jam_selesai') ?></td>
    <td style="width:155px;"><?= $model->getAttributeLabel('lap_op_lama_operasi') ?></td>
  </tr>
  <tr style="text-align:center;">
    <td style="text-align: center;"><?= \Yii::$app->formatter->asDate($model->lap_op_tanggal); ?></td>
    <td style="text-align: center;"><?= str_replace("KAMAR OPERASI", "", $timoperasi->unit->nama) ?></td>
    <td style="text-align: center;"><?= $model->lap_op_kelas ? $model->lap_op_kelas : "Tidak Ada"; ?></td>
    <td style="text-align: center;"><?= $model->lap_op_jam_mulai ? $model->lap_op_jam_mulai : "Tidak Ada"; ?></td>
    <td style="text-align: center;"><?= $model->lap_op_jam_selesai ? $model->lap_op_jam_selesai : "Tidak Ada" ?></td>
    <td style="text-align: center;"> <?= $model->lap_op_lama_operasi ? $model->lap_op_lama_operasi : "Tidak Ada" ?></td>
  </tr>
  <tr>
    <td valign="top" rowspan="4" style="padding-top:15px">
      <label>Nama Ahli Bedah :</label><br><br>
      <?php
      $ahlibedah = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 1])->all();
      $no = 1;
      if ($ahlibedah) {
        foreach ($ahlibedah as $val) {
          // if ($val->tod_pgw_id == Akun::user()->id_pegawai) {
          //   echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
          // } elseif (Akun::user()->username == Yii::$app->params['other']['username_root_bedah_sentral']) {
          echo '<span style="font-size:10px">' . $no++ . ') ' . HelperSpesial::getNamaPegawai($val->pegawai) . '</span>' . "<br>";
          // }
        }
      } else {
        echo "Belum diisi";
      }
      ?>
    </td>
    <td valign="top" rowspan="4" style="padding-top:15px">
      <label>Nama Dokter Anestesi :</label><br><br>
      <?php
      $ahlianestesi = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 2])->all();
      $no = 1;
      if ($ahlianestesi) {
        foreach ($ahlianestesi as $val) {
          echo '<span style="font-size:10px">' . HelperSpesial::getNamaPegawai($val->pegawai) . '</span>' . "<br>";
        }
      } else {
        echo "Tidak Ada";
      }
      ?>
    </td>
    <td style="border-right-style: none;"><label>Asisten</label></td>
    <td colspan="3">
      <?php
      $asisten = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 3])->all();
      $no = 1;
      if ($asisten) {
        foreach ($asisten as $val) {
          echo '<span style="font-size:10px">' . $no++ . ') ' . HelperSpesial::getNamaPegawai($val->pegawai) . '</span>' . "<br>";
        }
      } else {
        echo "Tidak Ada";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td style="border-right-style: none;"><label>Instrumentator</label></td>
    <td colspan="3">
      <?php
      $instrumen = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 6])->all();
      $no = 1;
      if ($instrumen) {
        foreach ($instrumen as $val) {
          echo '<span style="font-size:10px">' . $no++ . ') ' . HelperSpesial::getNamaPegawai($val->pegawai) . '</span>' . "<br>";
        }
      } else {
        echo "Tidak Ada";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td style="border-right-style: none;"><label>Sirkuler</label></td>
    <td colspan="3">
      <?php
      $sirkuler = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 4])->all();
      $no = 1;
      if ($sirkuler) {
        foreach ($sirkuler as $val) {
          echo '<span style="font-size:10px">' . $no++ . ') ' . HelperSpesial::getNamaPegawai($val->pegawai) . '</span>' . "<br>";
        }
      } else {
        echo "Tidak Ada";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td style="border-right-style: none;"><label>Penata Anestesi</label></td>
    <td colspan="3">
      <?php
      $perawatanestesi = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 5])->all();
      $no = 1;
      if ($perawatanestesi) {
        foreach ($perawatanestesi as $val) {
          echo '<span style="font-size:10px">' . $no++ . ') ' . HelperSpesial::getNamaPegawai($val->pegawai) . '</span>' . "<br>";
        }
      } else {
        echo "Tidak Ada";
      }
      ?>
    </td>
    </td>
  </tr>
  <tr>
    <td colspan="6">
      <label><b><?= $model->getAttributeLabel('lap_op_diagnosis_pre_operasi') ?> :</b></label>
      <?= ($model->lap_op_diagnosis_pre_operasi ? "<pre>" . $model->lap_op_diagnosis_pre_operasi . "</pre>" : "Tidak Ada") ?>
    </td>
  </tr>
  <tr>
    <td colspan="6">
      <label><b><?= $model->getAttributeLabel('lap_op_diagnosis_pasca_operasi') ?> :</b></label>
      <?= ($model->lap_op_diagnosis_pasca_operasi ? "<pre>" . $model->lap_op_diagnosis_pasca_operasi . "</pre>" : "Tidak Ada") ?>
    </td>
  </tr>
  <tr>
    <td colspan="6">
      <label><b>Tindakan Operasi :</b></label>
      <?= ($model->lap_op_nama_jenis_operasi ? "<pre>" . $model->lap_op_nama_jenis_operasi . "</pre>" : "Tidak Ada") ?>

    </td>
  </tr>
  <tr>
    <td colspan="6">
      <label><b>Jaringan yang dieksisi/insisi :</b></label>
      <?= ($model->lap_op_jenis_jaringan ? $model->lap_op_jenis_jaringan : "Tidak Ada"); ?>
    </td>
  </tr>
  <tr>
    <td colspan="6">
      <label><b>Jenis Operasi :</b></label>
      <?= $model->lap_op_jenis_operasi != null ? ($model->lap_op_jenis_operasi == 1 ? "Cyto" : "Elektif") : "Tidak Ada" ?>
    </td>
  </tr>
  <tr>
    <td colspan="6">
      <label><b><?= $model->getAttributeLabel('lap_op_jaringan_operasi_dikirim') ?> :</b></label>
      <?= $model->lap_op_jaringan_operasi_dikirim ?>
    </td>
  </tr>
  <tr>
    <td valign="top" colspan="6" style="height: 150px; text-align:justify;">
      <?= ($model->lap_op_laporan ? "<pre>" . $model->lap_op_laporan . "</pre>" : "Tidak Ada") ?>
    </td>
  </tr>
  <tr>
    <td valign="top" colspan="6" style="height: 100px; text-align:justify;">
      <label><b><?= $model->getAttributeLabel('lap_op_instruksi_prwt_pasca_operasi') ?>:</b></label><br>
      <?= ($model->lap_op_instruksi_prwt_pasca_operasi ? "<pre>" . $model->lap_op_instruksi_prwt_pasca_operasi . "</pre>" : "Tidak Ada") ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" valign="top" style="height:70px;">
      <label><b><?= $model->getAttributeLabel('lap_op_penyulit') ?>:</b></label><br>
      <?= ($model->lap_op_penyulit ? "<pre>" . $model->lap_op_penyulit . "</pre>" : "Tidak Ada") ?>
    </td>
    <td colspan="3" rowspan="2" style="text-align:center;">
      <label><b>Nama dan Tanda Tangan Dokter Operator</b></label><br><br><br><br><br>
      <?php
      // echo Akun::user()->name;

      $ahlibedah = PegawaiUser::find()->where(['userid' => $model->lap_op_created_by])->one();
      echo HelperSpesial::getNamaPegawai($ahlibedah->pegawai) . "<br>";

      // $ahlibedah = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 1])->all();
      // foreach ($ahlibedah as $val) {
      //   if ($val->tod_pgw_id == Akun::user()->id_pegawai) {
      //     echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
      //   } elseif (Akun::user()->username == Yii::$app->params['other']['username_root_bedah_sentral']) {
      //     echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
      //   }
      // }

      ?>
    </td>
  </tr>
  <tr>
    <td colspan="3">
      <label><b><?= $model->getAttributeLabel('lap_op_jumlah_perdarahan') ?>:</b></label>
      <?php
      if ($model->lap_op_jumlah_perdarahan) {
        // if (preg_match("/cc/i", $model->lap_op_jumlah_perdarahan)) {
        //   echo $model->lap_op_jumlah_perdarahan;
        // } else {
        echo $model->lap_op_jumlah_perdarahan;
        // }
      } else {
        echo 'Tidak Ada';
      }
      ?>
    </td>
  </tr>
</table>