<?php

use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\PreOperasiPerawatAnestesi;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use yii\helpers\ArrayHelper;

$model = PreOperasiPerawatAnestesi::find()->where(['pop_id' => $pop_id])->andWhere('pop_deleted_at is null')->one();
$style = 'border: 1px solid;';
if ($model->pop_batal_anestesi) {
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
</style>
<?php
$tim = TimOperasi::find()->where(['to_id' => $model->pop_to_id])->one();
?>
<table style="border: 1px solid; width: 100%;" style="<?= $style ?>">
  <tr>
    <th colspan="12">ASUHAN KEPERAWATAN PERIOPERATIF</th>
  </tr>
  <tr>
    <td colspan="2" style="width:15%;">dr. Operator</td>
    <td>:</td>
    <td colspan="10" style="width:85%;">
      <?php
      $timdetail = TimOperasiDetail::find()->where(['tod_to_id' => $model->pop_to_id, 'tod_jo_id' => 1])->all();
      foreach ($timdetail as $val) {
        echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">dr. Anestesi</td>
    <td>:</td>
    <td colspan="10">
      <?php
      $timdetail = TimOperasiDetail::find()->where(['tod_to_id' => $model->pop_to_id, 'tod_jo_id' => 2])->all();
      foreach ($timdetail as $val) {
        echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">Diagnosa Medis</td>
    <td>:</td>
    <td colspan="10">
      <?php
      echo $tim->to_diagnosa_medis_pra_bedah;
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">Tindakan Operasi</td>
    <td>:</td>
    <td colspan="10">
      <?php
      echo $tim->to_tindakan_operasi;
      ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">Hari/Tanggal</td>
    <td>:</td>
    <td colspan="10">
      <?php
      echo Date("d M Y H:i:s", strtotime($tim->to_tanggal_operasi));
      ?>
    </td>
  </tr>
  <tr>
    <th colspan="12" id="pengkajian">PENGKAJIAN</th>
  </tr>
  <tr>
    <th colspan="12" style="text-align:left;">A. PRE OPERASI</th>
  </tr>
  <tr>
    <td colspan="4" rowspan="2"><b><?= $model->getAttributeLabel('pop_tingkat_kesadaran') ?></b></td>
    <td>:</td>
    <td colspan="12"><?= $model->pop_tingkat_kesadaran ?></td>
  </tr>
  <tr>
    <td>:</td>
    <td>GCS </td>
    <td><b><?= $model->getAttributeLabel('pop_e') ?></b><?= $model->pop_e ?></td>
    <td><b><?= $model->getAttributeLabel('pop_m') ?></b><?= $model->pop_m ?></td>
    <td><b><?= $model->getAttributeLabel('pop_v') ?></b><?= $model->pop_v ?></td>
    <td colspan="3"><b><?= $model->getAttributeLabel('pop_total_gcs') ?></b> <?= $model->pop_total_gcs ?></td>
  </tr>
  <tr>
    <td colspan="4"><b><?= $model->getAttributeLabel('pop_pernapasan') ?></b></td> <!-- radiobutton -->
    <td>:</td>
    <td><?= $model->pop_pernapasan ?></td>
  </tr>
  <tr>
    <td colspan="4"><b><?= $model->getAttributeLabel('pop_riwayat_operasi') ?></b></td><!-- radiobutton -->
    <td>:</td>
    <td colspan="2"><?= $model->pop_riwayat_operasi ?></td>
  </tr>
  <tr>
    <td colspan="4"><b><?= $model->getAttributeLabel('pop_status_emosional') ?></b></td> <!-- radiobutton -->
    <td>:</td>
    <td colspan="12"><?= $model->pop_status_emosional ?></td>
  </tr>
  <tr>
    <td colspan="4"><b><?= $model->getAttributeLabel('pop_berat_badan') ?></b></td>
    <td>:</td>
    <td colspan="12"><?= $model->pop_berat_badan ?></td>
  </tr>
  <tr>
    <td colspan="4">7. Serah Terima*</td>
  </tr>
</table>
<table border="1" cellspacing="0" width="100%" style="<?= $style ?>">
  <tr>
    <th>No</th>
    <th style="width: 20%;">Persiapan</th>
    <th>Anestesi</th>
    <th>Keterangan</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Surat Izin Operasi</td> <!-- text -->
    <td>
      <?= $model->pop_sio_anestesi ?>
    </td>
    <td>
      <?= $model->pop_sio_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>2</td>
    <td>Pasien di puasakan</td>
    <td>
      <?= $model->pop_puasa_anestesi ?>
    </td>
    <td>
      <?= $model->pop_puasa_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>3</td>
    <td>Protesa dilepas</td> <!-- text -->
    <td>
      <?= $model->pop_protesa_anestesi ?>
    </td>
    <td>
      <?= $model->pop_protesa_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>4</td>
    <td>Perhiasan dilepas</td> <!-- text -->
    <td>
      <?= $model->pop_perhiasan_anestesi ?>
    </td>
    <td>
      <?= $model->pop_perhiasan_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>5</td>
    <td>Pencukuran Daerah Operasi</td> <!-- text -->
    <td>
      <?= $model->pop_pdo_anestesi ?>
    </td>
    <td>
      <?= $model->pop_pdo_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>6</td>
    <td>Penandaan Lokasi operasi</td> <!-- text -->
    <td>
      <?= $model->pop_plo_anestesi ?>
    </td>
    <td>
      <?= $model->pop_plo_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>7</td>
    <td>Huknah, Gliserin</td> <!-- text -->
    <td>
      <?= $model->pop_huknah_anestesi ?>
    </td>
    <td>
      <?= $model->pop_huknah_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>8</td>
    <td>Folley Kateter</td> <!-- text -->
    <td>
      <?= $model->pop_fkateter_anestesi ?>
    </td>
    <td>
      <?= $model->pop_fkateter_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>9</td>
    <td>Hasil Laboratorium</td> <!-- text -->
    <td>
      <?= $model->pop_h_lab_anestesi ?>
    </td>
    <td>
      <?= $model->pop_h_lab_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>10</td>
    <td>Rontgen</td> <!-- text -->
    <td>
      <?= $model->pop_rontgen_anestesi ?>
    </td>
    <td>
      <?= $model->pop_rontgen_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>11</td>
    <td>USG</td> <!-- text -->
    <td>
      <?= $model->pop_usg_anestesi ?>
    </td>
    <td>
      <?= $model->pop_usg_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>12</td>
    <td>CT- Scan</td> <!-- text -->
    <td>
      <?= $model->pop_ctscan_anestesi ?>
    </td>
    <td>
      <?= $model->pop_ctscan_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>13</td>
    <td>EKG</td> <!-- text -->
    <td>
      <?= $model->pop_ekg_anestesi ?>
    </td>
    <td>
      <?= $model->pop_ekg_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>14</td>
    <td>ECHO</td> <!-- text -->
    <td>
      <?= $model->pop_echo_anestesi ?>
    </td>
    <td>
      <?= $model->pop_echo_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>15</td>
    <td>Persediaan Darah</td> <!-- text -->
    <td>
      <?= $model->pop_persediaan_darah_anestesi ?>
    </td>
    <td>
      <?= $model->pop_persediaan_darah_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>16</td>
    <td>Terpasang IV Line</td> <!-- text -->
    <td>
      <?= $model->pop_ivline_anestesi ?>
    </td>
    <td>
      <?= $model->pop_ivline_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>17</td>
    <td>Propilaksis</td> <!-- text -->
    <td>
      <?= $model->pop_alergi_obat_anestesi ?>
    </td>
    <td>
      <?= $model->pop_alergi_obat_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>18</td>
    <td>Alergi obat</td> <!-- text -->
    <td>
      <?= $model->pop_alergi_obat_anestesi ?>
    </td>
    <td>
      <?= $model->pop_alergi_obat_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>19</td>
    <td>Tekanan Darah</td> <!-- text -->
    <td>
      <?= $model->pop_tkn_darah_anestesi ?>
    </td>
    <td>
      <?= $model->pop_tkn_darah_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>20</td>
    <td>Nadi</td> <!-- text -->
    <td>
      <?= $model->pop_nadi_anestesi ?>
    </td>
    <td>
      <?= $model->pop_nadi_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>21</td>
    <td>Suhu</td> <!-- text -->
    <td>
      <?= $model->pop_suhu_anestesi ?>
    </td>
    <td>
      <?= $model->pop_suhu_anestesi_ket ?>
    </td>
  </tr>
  <tr>
    <td>22</td>
    <td>Pernafasan</td> <!-- text -->
    <td>
      <?= $model->pop_pernapasan_anestesi ?>
    </td>
    <td>
      <?= $model->pop_pernapasan_anestesi_ket ?>
    </td>
  </tr>
</table>
<table>
  <tr>
    <td style="width:2%;"></td>
    <td style="width: 20%;"><b><?= $model->getAttributeLabel('pop_pendidikan') ?></b></td> <!-- radiobutton -->
    <td style="width:2%;">:</td>
    <td style="width: 765;"><?= $model->pop_pendidikan ?></td>
  </tr>
  <tr>
    <td></td>
    <td><b><?= $model->getAttributeLabel('pop_obatan') ?></b></td>
    <td>:</td>
    <td><?= $model->pop_obatan ?></td>
  </tr>
  <tr>
    <td></td>
    <td><b><?= $model->getAttributeLabel('pop_masalah') ?></b></td>
    <td>:</td>
    <td><?= $model->pop_masalah ?></td>
  </tr>
  <tr>
    <td></td>
    <td><b><?= $model->getAttributeLabel('pop_tindakan') ?></b></td>
    <td>:</td>
    <td><?= $model->pop_tindakan ?></td>
  </tr>
  <tr>
    <td></td>
    <td><b><?= $model->getAttributeLabel('pop_evaluasi') ?></b></td>
    <td>:</td>
    <td><?= $model->pop_evaluasi ?></td>
  </tr>
</table>

<div class="ttd" style="width:100%">
  <div class="bedah">
    <p>Ahli Bedah</p>
    <?php
    $timdetail = TimOperasiDetail::find()->where(['tod_to_id' => $model->pop_to_id, 'tod_jo_id' => 1])->all();
    foreach ($timdetail as $val) {
      echo HelperSpesial::getNamaPegawai($val->pegawai);
    }
    ?>
  </div>
  <div class="bedah">
    <p>Asisten</p>
    <?php
    $timdetail = TimOperasiDetail::find()->where(['tod_to_id' => $model->pop_to_id, 'tod_jo_id' => 3])->all();
    $no = 1;
    foreach ($timdetail as $val) {
      echo $no++ . ". " . HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
    }
    ?>
  </div>
  <div class="bedah">
    <p>Perawat Instrumen</p>
    <?php
    $timdetail = TimOperasiDetail::find()->where(['tod_to_id' => $model->pop_to_id, 'tod_jo_id' => 6])->all();
    $no = 1;
    foreach ($timdetail as $val) {
      echo $no++ . ". " . HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
    }
    ?>
  </div>
</div>