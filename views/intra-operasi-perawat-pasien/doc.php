<?php

use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\IntraOperasiPerawat;
use app\models\medis\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use yii\helpers\ArrayHelper;

$model = IntraOperasiPerawat::find()->with(['pegawaiesu', 'pegawaikateter'])->where(['iop_id' => $iop_id])->andWhere('iop_deleted_at is null')->one();
$style = 'border: 1px solid;';
if ($model->iop_batal) {
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
</style>
<table class="table table-sm table-form">
  <tr>
    <td><label>Jam dimulai</label></td>
  </tr>
  <tr>
    <td><label>Anestesi</label></td>
    <td>:</td>
    <td>
      <?= $model->iop_jam_mulai_anestesi ?> </td>
    <td><label>s/d </label></td>
    <td>
      <?= $model->iop_jam_selesai_anestesi ?>
    </td>
    <td align="right"><label>Pembedahan</label></td>
    <td>
      <?= $model->iop_jam_mulai_bedah ?> </td>
    <td><label>s/d </label></td>
    <td>
      <?= $model->iop_jam_selesai_bedah ?>
    </td>
  </tr>
</table>

<table width="100%" class="table table-sm table-form" style="<?=$style?>">
  <tr>
    <td colspan="7" style="text-align: center;" class="bg-lightblue"><b>B. INTRA OPERASI</b></td>
  </tr>
  <tr>
    <td style="width:35%;"><label>1. <?= $model->getAttributeLabel('iop_jenis_pembiusan') ?> </label></td> <!-- radiobutton -->
    <td style="padding: 1px; width: 2%;">:</td>
    <td colspan="5">
      <?= $model->iop_jenis_pembiusan ?>
    </td>
  </tr>
  <tr>
    <td><label>2. <?= $model->getAttributeLabel('iop_type_operasi') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_type_operasi ?>
    </td>
  </tr>
  <tr>
    <td><label>3. <?= $model->getAttributeLabel('iop_posisi_kanul_intravena') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_posisi_kanul_intravena ?>
    </td>
  </tr>
  <tr>
    <td><label>4. <?= $model->getAttributeLabel('iop_posisi_operasi') ?> </label></td>
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_posisi_operasi ?>
    </td>
  </tr>
  <tr>
    <td><label>5. <?= $model->getAttributeLabel('iop_jenis_operasi') ?> </label></td>
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_jenis_operasi ?>
    </td>
  </tr>
  <tr>
    <td><label>6. <?= $model->getAttributeLabel('iop_posisi_tangan') ?> </label></td>
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_posisi_tangan ?>
    </td>
  </tr>
  <tr>
    <td><label>7. <?= $model->getAttributeLabel('iop_kateter_urin') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td>
      <?= $model->iop_kateter_urin ?>
    </td>
    <td colspan="3">Dipasang oleh : <?= $model->iop_ku_dipasang_oleh != NULL ? HelperSpesial::getNamaPegawai($model->pegawaikateter) : '-' ?> </td>
  </tr>
  <tr>
    <td><label>8. <?= $model->getAttributeLabel('iop_disenfeksi_kulit') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_disenfeksi_kulit ?>
    </td>
  </tr>
  <tr>
    <td><label>9. <?= $model->getAttributeLabel('iop_insisi_kulit') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_insisi_kulit ?>
  </tr>

  <tr>
    <td><label>10. <?= $model->getAttributeLabel('iop_esu') ?> </label></td>
    <td>:</td>
    <td>
      <?= $model->iop_esu ?>
    </td>
    <td colspan="3">Dipasang oleh : <?= $model->iop_esu_dipasang_oleh != NULL ? HelperSpesial::getNamaPegawai($model->pegawaiesu) : '-' ?></td>
  </tr>
  <tr>
    <td><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $model->getAttributeLabel('iop_lok_ntrl_elektroda') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_lok_ntrl_elektroda ?>
    </td>
  </tr>
  <tr>
    <td><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $model->getAttributeLabel('iop_pemeriksaan_kulit_pra_bedah') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_pemeriksaan_kulit_pra_bedah ?>
    </td>
  </tr>
  <tr>
    <td><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $model->getAttributeLabel('iop_pemeriksaan_kulit_pasca_bedah') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td colspan="5">
      <?= $model->iop_pemeriksaan_kulit_pasca_bedah ?>
    </td>
  </tr>
  <tr>
    <td><label>11. <?= $model->getAttributeLabel('iop_unit_penghangat') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td>
      <?= $model->iop_unit_penghangat ?>
    </td>
    <td><?= $model->iop_unit_penghangat_jam_mulai ?></td>
    <td><?= $model->iop_unit_penghangat_temperatur ?></td>
    <td><?= $model->iop_unit_penghangat_jam_selesai ?></td>
  </tr>
  <tr>
    <td><label>12. <?= $model->getAttributeLabel('iop_tourniquet') ?> </label></td> <!-- radiobutton -->
    <td>:</td>
    <td>
      <?= $model->iop_tourniquet ?>
    </td>
  </tr>
  <tr>
    <td><label>13. <?= $model->getAttributeLabel('iop_implant') ?> </label></td>
    <td>:</td>
    <td>
      <?= $model->iop_implant ?>
    </td>
  </tr>
  <tr>
    <td><label>14. <?= $model->getAttributeLabel('iop_drainage') ?> </label></td>
    <td>:</td>
    <td>
      <?= $model->iop_drainage ?>
    </td>
  </tr>
  <tr>
    <td><label>15. <?= $model->getAttributeLabel('iop_irigasi_luka') ?> </label></td>
    <td>:</td>
    <td>
      <?= $model->iop_irigasi_luka ?>
    </td>
  </tr>
  <tr>
    <td><label>16. <?= $model->getAttributeLabel('iop_tamplon') ?> </label></td>
    <td>:</td>
    <td>
      <?= $model->iop_tamplon ?>
    </td>
  </tr>
  <tr>
    <td><label>17. <?= $model->getAttributeLabel('iop_pemeriksaan_jaringan') ?> </label></td>
    <td>:</td>
    <td>
      <?= $model->iop_pemeriksaan_jaringan ?>
    </td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('iop_masalah') ?> </label></td>
    <td>:</td>
    <td colspan="5"><?= $model->iop_masalah ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('iop_tindakan') ?> </label></td>
    <td>:</td>
    <td colspan="5"><?= $model->iop_tindakan ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('iop_evaluasi') ?> </label></td>
    <td>:</td>
    <td colspan="5"><?= $model->iop_evaluasi ?></td>
  </tr>
</table>

<div class="ttd" style="width: 100%;">
  <div class="bedah">
    <p>Perawat Asisten/Instrumen</p>
    <?php
    $timdetail = TimOperasiDetail::find()->where(['tod_to_id' => $model->iop_to_id, 'tod_jo_id' => 6])->all();
    foreach ($timdetail as $val) {
      echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
    }
    ?>
  </div>
  <div class="bedah">
    <p>Perawat sirkuler</p>
    <?php
    $timdetail = TimOperasiDetail::find()->where(['tod_to_id' => $model->iop_to_id, 'tod_jo_id' => 4])->all();
    foreach ($timdetail as $val) {
      echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
    }
    ?>
  </div>
</div>