<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\medis\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPreOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
<style type="text/css">
  #pengkajian {
    text-align: center;
    border-top: 2px solid;
    border-bottom: 2px solid;
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    border: 0px;
    /* border: 0.5px solid #3c8dbc; */
  }
</style>
<?php
$this->registerJs($this->render('_form_create_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'pre'
]); ?>
<?= $form->field($model, 'pop_batal_anestesi')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'pop_pgw_id_anestesi')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'pop_to_id')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <?php $test = TimOperasi::find()->where(['to_id' => $model->pop_to_id])->all(); ?>
    <table class="table table-sm table-form">
      <tr>
        <th class="text-center bg-lightblue" colspan="12">ASUHAN KEPERAWATAN PERIOPERATIF</th>
      </tr>
      <tr>
        <td colspan="2" style="width:15%;"><label>dr. Operator</label></td>
        <td style="width:2%">:</td>
        <td colspan="4" style="width:35%;">
          <?php
          $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->pop_to_id, 'tod_jo_id' => 1])->all();
          if ($detail) {
            foreach ($detail as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai);
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
        <td colspan="2" style="width:15%;"><label>dr. Anestesi</label></td>
        <td style="width:2%">:</td>
        <td colspan="4">
          <?php
          $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->pop_to_id, 'tod_jo_id' => 2])->all();
          if ($detail) {
            foreach ($detail as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai);
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="2"><label>Diagnosa Medis</label></td>
        <td>:</td>
        <td colspan="4">
          <?php
          foreach ($test as $val) {
            echo $val->to_diagnosa_medis_pra_bedah;
          }
          ?>
        </td>
        <td colspan="2"><label>Tindakan Operasi</label></td>
        <td>:</td>
        <td colspan="4">
          <?php
          foreach ($test as $val) {
            echo $val->to_tindakan_operasi;
          }
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="2"><label>Hari/Tanggal</label></td>
        <td>:</td>
        <td colspan="4">
          <?php
          foreach ($test as $val) {
            echo date("d M Y H:i:s", strtotime($val->to_tanggal_operasi));
          }
          ?>
        </td>
      </tr>
      <tr>
        <th colspan="12" id="pengkajian" align="center">PENGKAJIAN</th>
      </tr>
      <tr>
        <th class="text-left bg-lightblue" colspan="12" style="text-align: left;">A. PRE OPERASI</th>
      </tr>
      <tr>
        <td colspan="4" rowspan="2"><label><?= $model->getAttributeLabel('pop_tingkat_kesadaran') ?></label></td>
        <td><label>:</label></td>
        <td colspan="12">
          <?php
          $pop_tingkat_kesadaran = ['CM' => 'CM', 'Apatis' => 'Apatis', 'Somnolen' => 'Somnolen', 'Sopor' => 'Sopor', 'Koma' => 'Koma'];
          echo $form->field($model, 'pop_tingkat_kesadaran', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_tingkat_kesadaran)->label(false);
          $pop_tingkat_kesadaran = HelperGeneral::getValueCustomRadio($pop_tingkat_kesadaran, $model->pop_tingkat_kesadaran);
          ?>
        </td>
      </tr>
      <tr>
        <!-- <td rowspan="2"></td> -->
        <td rowspan="2">:</td>
        <td>
          <label><?= $model->getAttributeLabel('pop_e') ?> </label> <?= $form->field($model, 'pop_e', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => 'GCS E', 'id' => 'gcs-e', 'onInput' => 'gcs()'])->label(false); ?>

        </td>
        <td>
          <label><?= $model->getAttributeLabel('pop_m') ?> </label> <?= $form->field($model, 'pop_m', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => 'GCS M', 'id' => 'gcs-m', 'onInput' => 'gcs()'])->label(false); ?>
        </td>
        <td colspan="2">
          <label><?= $model->getAttributeLabel('pop_v') ?> </label> <?= $form->field($model, 'pop_v', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => 'GCS V', 'id' => 'gcs-v', 'onInput' => 'gcs()'])->label(false); ?>
        </td>
        <td colspan="2">
          <label><?= $model->getAttributeLabel('pop_total_gcs') ?> </label> <?= $form->field($model, 'pop_total_gcs', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => 'Total GCS', 'id' => 'total-gcs', 'readonly' => 'readonly'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td colspan="4"><label><?= $model->getAttributeLabel('pop_pernapasan') ?></label></td> <!-- radiobutton -->
        <td><label>:</label></td>
        <td colspan="8">
          <?php
          $pop_pernapasan = ['Spontan' => 'Spontan', 'Kanula' => 'Kanula'];
          echo $form->field($model, 'pop_pernapasan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_pernapasan)->label(false);
          $pop_pernapasan = HelperGeneral::getValueCustomRadio($pop_pernapasan, $model->pop_pernapasan);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="4"><label><?= $model->getAttributeLabel('pop_riwayat_operasi') ?></label></td><!-- radiobutton -->
        <td><label>:</label></td>
        <td>
          <?php
          $pop_riwayat_operasi = ['Tidak Ada' => 'Tidak Ada'];
          echo $form->field($model, 'pop_riwayat_operasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_riwayat_operasi)->label(false);
          $pop_riwayat_operasi = HelperGeneral::getValueCustomRadio($pop_riwayat_operasi, $model->pop_riwayat_operasi);
          ?>
        </td>
        <td colspan="5">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[pop_riwayat_operasi]" id="pop_riwayat_operasi" type="radio" value="<?= $pop_riwayat_operasi['v'] ?>" <?= $pop_riwayat_operasi['c'] ?>>
              </div>
            </div>
            <input id="pop_riwayat_operasi_it" placeholder="Sebutkan Jika Ada" type="text" value="<?= $pop_riwayat_operasi['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="4"><label><?= $model->getAttributeLabel('pop_status_emosional') ?></label></td>
        <td><label>:</label></td>
        <td colspan="12">
          <?php
          $pop_status_emosional = ['Tenang' => 'Tenang', 'Cemas' => 'Cemas'];
          echo $form->field($model, 'pop_status_emosional', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_status_emosional)->label(false);
          $pop_status_emosional = HelperGeneral::getValueCustomRadio($pop_status_emosional, $model->pop_status_emosional);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="4"><label><?= $model->getAttributeLabel('pop_berat_badan') ?></label></td>
        <td><label>:</label></td>
        <td colspan="12">
          <?= $form->field($model, 'pop_berat_badan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '.... Kg'])->label(false); ?>
        </td>
      </tr>
      <!-- <tr>
        <td colspan="4"><label><?= $model->getAttributeLabel('pop_tinggi_badan') ?></label></td>
        <td><label>:</label></td>
        <td colspan="12">
          <?= $form->field($model, 'pop_tinggi_badan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '.... Cm'])->label(false); ?>
        </td>
      </tr> -->
      <tr>
        <td colspan="4"><label><?= $model->getAttributeLabel('serah_terima') ?></label></td>
      </tr>
    </table>
    <table border="1" cellspacing="0" width="100%">
      <tr class="text-left bg-lightblue">
        <th style="width:2%;">No</th>
        <th style="width: 20%;">Persiapan</th>
        <th>Anestesi</th>
        <th>Keterangan</th>
      </tr>
      <tr>
        <td>1</td>
        <td>Surat Izin Operasi</td>
        <td>
          <?php
          $pop_sio_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_sio_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_sio_anestesi)->label(false);
          $pop_sio_anestesi = HelperGeneral::getValueCustomRadio($pop_sio_anestesi, $model->pop_sio_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_sio_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>Pasien di puasakan</td>
        <td>
          <?php
          $pop_puasa_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_puasa_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_puasa_anestesi)->label(false);
          $pop_puasa_anestesi = HelperGeneral::getValueCustomRadio($pop_puasa_anestesi, $model->pop_puasa_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_puasa_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>3</td>
        <td>Protesa dilepas</td>
        <td>
          <?php
          $pop_protesa_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_protesa_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_protesa_anestesi)->label(false);
          $pop_protesa_anestesi = HelperGeneral::getValueCustomRadio($pop_protesa_anestesi, $model->pop_protesa_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_protesa_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>4</td>
        <td>Perhiasan dilepas</td>
        <td>
          <?php
          $pop_perhiasan_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_perhiasan_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_perhiasan_anestesi)->label(false);
          $pop_perhiasan_anestesi = HelperGeneral::getValueCustomRadio($pop_perhiasan_anestesi, $model->pop_perhiasan_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_perhiasan_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>5</td>
        <td>Pencukuran Daerah Operasi</td>
        <td>
          <?php
          $pop_pdo_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_pdo_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_pdo_anestesi)->label(false);
          $pop_pdo_anestesi = HelperGeneral::getValueCustomRadio($pop_pdo_anestesi, $model->pop_pdo_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_pdo_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>6</td>
        <td>Penandaan Lokasi operasi</td>
        <td>
          <?php
          $pop_plo_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_plo_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_plo_anestesi)->label(false);
          $pop_plo_anestesi = HelperGeneral::getValueCustomRadio($pop_plo_anestesi, $model->pop_plo_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_plo_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>7</td>
        <td>Huknah, Gliserin</td>
        <td>
          <?php
          $pop_huknah_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_huknah_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_huknah_anestesi)->label(false);
          $pop_huknah_anestesi = HelperGeneral::getValueCustomRadio($pop_huknah_anestesi, $model->pop_huknah_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_huknah_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>8</td>
        <td>Folley Kateter</td>
        <td>
          <?php
          $pop_fkateter_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_fkateter_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_fkateter_anestesi)->label(false);
          $pop_fkateter_anestesi = HelperGeneral::getValueCustomRadio($pop_fkateter_anestesi, $model->pop_fkateter_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_fkateter_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>9</td>
        <td>Hasil Laboratorium</td>
        <td>
          <?php
          $pop_h_lab_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_h_lab_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_h_lab_anestesi)->label(false);
          $pop_h_lab_anestesi = HelperGeneral::getValueCustomRadio($pop_h_lab_anestesi, $model->pop_h_lab_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_h_lab_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>10</td>
        <td>Rontgen</td>
        <td>
          <?php
          $pop_rontgen_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_rontgen_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_rontgen_anestesi)->label(false);
          $pop_rontgen_anestesi = HelperGeneral::getValueCustomRadio($pop_rontgen_anestesi, $model->pop_rontgen_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_rontgen_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>11</td>
        <td>USG</td>
        <td>
          <?php
          $pop_usg_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_usg_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_usg_anestesi)->label(false);
          $pop_usg_anestesi = HelperGeneral::getValueCustomRadio($pop_usg_anestesi, $model->pop_usg_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_usg_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>12</td>
        <td>CT- Scan</td>
        <td>
          <?php
          $pop_ctscan_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_ctscan_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_ctscan_anestesi)->label(false);
          $pop_ctscan_anestesi = HelperGeneral::getValueCustomRadio($pop_ctscan_anestesi, $model->pop_ctscan_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_ctscan_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>13</td>
        <td>EKG</td>
        <td>
          <?php
          $pop_ekg_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_ekg_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_ekg_anestesi)->label(false);
          $pop_ekg_anestesi = HelperGeneral::getValueCustomRadio($pop_ekg_anestesi, $model->pop_ekg_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_ekg_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>14</td>
        <td>ECHO</td>
        <td>
          <?php
          $pop_echo_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_echo_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_echo_anestesi)->label(false);
          $pop_echo_anestesi = HelperGeneral::getValueCustomRadio($pop_echo_anestesi, $model->pop_echo_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_echo_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>15</td>
        <td>Persediaan Darah</td>
        <td>
          <?php
          $pop_persediaan_darah_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_persediaan_darah_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_persediaan_darah_anestesi)->label(false);
          $pop_persediaan_darah_anestesi = HelperGeneral::getValueCustomRadio($pop_persediaan_darah_anestesi, $model->pop_persediaan_darah_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_persediaan_darah_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>16</td>
        <td>Terpasang IV Line</td>
        <td>
          <?php
          $pop_ivline_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_ivline_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_ivline_anestesi)->label(false);
          $pop_ivline_anestesi = HelperGeneral::getValueCustomRadio($pop_ivline_anestesi, $model->pop_ivline_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_ivline_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>17</td>
        <td>Propilaksis</td>
        <td>
          <?php
          $pop_propilaksis_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_propilaksis_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_propilaksis_anestesi)->label(false);
          $pop_propilaksis_anestesi = HelperGeneral::getValueCustomRadio($pop_propilaksis_anestesi, $model->pop_propilaksis_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_propilaksis_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>18</td>
        <td>Alergi obat</td>
        <td>
          <?php
          $pop_alergi_obat_anestesi = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_alergi_obat_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_alergi_obat_anestesi)->label(false);
          $pop_alergi_obat_anestesi = HelperGeneral::getValueCustomRadio($pop_alergi_obat_anestesi, $model->pop_alergi_obat_anestesi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_alergi_obat_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>19</td>
        <td>Tekanan Darah</td>
        <td>
          <?= $form->field($model, 'pop_tkn_darah_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '......./.....mmHg', 'type' => 'text'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_tkn_darah_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>20</td>
        <td>Nadi</td>
        <td>
          <?= $form->field($model, 'pop_nadi_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '.........x/mnt', 'type' => 'text'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_nadi_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>21</td>
        <td>Suhu</td>
        <td>
          <?= $form->field($model, 'pop_suhu_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '...°C', 'type' => 'text'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_suhu_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>22</td>
        <td>Pernafasan</td>
        <td>
          <?= $form->field($model, 'pop_pernapasan_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '.........x/mnt', 'type' => 'text'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_pernapasan_anestesi_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
    </table>
    <table class="table table-sm table-form">
      <tr>
        <td style="width:20%"><label><?= $model->getAttributeLabel('pop_pendidikan') ?></label></td> <!-- radiobutton -->
        <td><label>:</label></td>
        <td>
          <?php
          $pop_pendidikan = ['Napas Dalam' => 'Napas Dalam', 'Batuk' => 'Batuk', 'Mobilisasi' => 'Mobilisasi'];
          echo $form->field($model, 'pop_pendidikan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_pendidikan)->label(false);
          $pop_pendidikan = HelperGeneral::getValueCustomRadio($pop_pendidikan, $model->pop_pendidikan);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('pop_obatan') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'pop_obatan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('pop_masalah') ?></label><span style="font-size: 10px;color: #000000;important;"></span></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?= $form->field($model, 'pop_masalah', [
            'template' => '<div class="col-sm-12">
                                    {input}
                                    {hint}{error}
                                </div>', 'options' => ['class' => 'form-group custom-margin']
          ])->textArea([
            'rows' => 10,
            'placeholder' => 'Ketik disini / gunakan @ untuk bantuan...'
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('pop_tindakan') ?></label><span style="font-size: 10px;color: #000000;important;"></span></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?= $form->field($model, 'pop_tindakan', [
            'template' => '<div class="col-sm-12">
                                    {input}
                                    {hint}{error}
                                </div>', 'options' => ['class' => 'form-group custom-margin']
          ])->textArea([
            'rows' => 10,
            'placeholder' => 'Ketik disini / gunakan @ untuk bantuan...'
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('pop_evaluasi') ?></label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?= $form->field($model, 'pop_evaluasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>
      </tr>
    </table>
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'pop_final_anestesi')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini', //mini atau large
              'onText' => 'Final','handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <?= Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/pre-operasi-perawat-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>