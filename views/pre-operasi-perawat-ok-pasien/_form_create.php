<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\bedahsentral\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use app\models\penunjang\HasilPemeriksaanEcho;
use app\models\penunjang\ResultPacs;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
use yii\helpers\Url;

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
<?php $this->registerJs($this->render('_form_create_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'pre'
]); ?>
<?= $form->field($model, 'pop_batal_ok')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'pop_pgw_id_ok')->hiddenInput()->label(false); ?>
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
            echo date("d-m-Y", strtotime($val->to_tanggal_operasi));
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
        <td colspan="4" rowspan="2"><label>1. <?= $model->getAttributeLabel('pop_tingkat_kesadaran') ?></label></td>
        <td><label>:</label></td>
        <td colspan="12">
          <?php
          $pop_tingkat_kesadaran = ['CM' => 'CM', 'Apatis' => 'Apatis', 'Somnolen' => 'Somnolen', 'Sopor' => 'Sopor', 'Koma' => 'Koma'];
          echo $form->field($model, 'pop_tingkat_kesadaran', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_tingkat_kesadaran)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <!-- <td rowspan="2"></td> -->
        <td>:</td>
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
        <td colspan="4"><label>2. <?= $model->getAttributeLabel('pop_pernapasan') ?></label></td>
        <td><label>:</label></td>
        <td colspan="12">
          <?php
          $pop_pernapasan = ['Spontan' => 'Spontan', 'Kanula' => 'Kanula'];
          echo $form->field($model, 'pop_pernapasan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_pernapasan)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="4"><label>3. <?= $model->getAttributeLabel('pop_riwayat_operasi') ?></label></td><!-- radiobutton -->
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
        <td colspan="4"><label>4. <?= $model->getAttributeLabel('pop_status_emosional') ?></label></td>
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
        <td colspan="4"><label>5. <?= $model->getAttributeLabel('pop_berat_badan') ?></label></td>
        <td><label>:</label></td>
        <td colspan="12">
          <?= $form->field($model, 'pop_berat_badan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... Kg'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td colspan="4"><label>6. <?= $model->getAttributeLabel('serah_terima') ?></label></td>
      </tr>
    </table>
    <table border="1" cellspacing="0" width="100%">
      <tr class="text-left bg-lightblue">
        <th style="width:2%;text-align:center">No</th>
        <th style="width: 20%;text-align:center">Persiapan</th>
        <th style="text-align: center;">Ruangan</th>
        <th style="text-align: center;">Kamar Operasi</th>
        <th style="text-align: center;">Keterangan</th>
      </tr>
      <tr>
        <td>1</td>
        <td>Surat Izin Operasi</td>
        <td>
          <?php
          $pop_sio_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_sio_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_sio_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_sio_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_sio_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_sio_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_sio_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>Pasien di puasakan</td>
        <td>
          <?php
          $pop_puasa_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_puasa_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_puasa_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_puasa_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_puasa_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_puasa_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_puasa_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>3</td>
        <td>Protesa dilepas</td>
        <td>
          <?php
          $pop_protesa_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_protesa_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_protesa_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_protesa_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_protesa_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_protesa_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_protesa_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>4</td>
        <td>Perhiasan dilepas</td>
        <td>
          <?php
          $pop_perhiasan_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_perhiasan_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_perhiasan_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_perhiasan_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_perhiasan_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_perhiasan_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_perhiasan_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>5</td>
        <td>Pencukuran Daerah Operasi</td>
        <td>
          <?php
          $pop_pdo_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_pdo_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_pdo_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_pdo_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_pdo_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_pdo_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_pdo_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>6</td>
        <td>Penandaan Lokasi operasi</td>
        <td>
          <?php
          $pop_plo_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_plo_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_plo_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_plo_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_plo_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_plo_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_plo_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>7</td>
        <td>Huknah, Gliserin</td>
        <td>
          <?php
          $pop_huknah_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_huknah_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_huknah_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_huknah_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_huknah_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_huknah_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_huknah_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>8</td>
        <td>Folley Kateter</td>
        <td>
          <?php
          $pop_fkateter_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_fkateter_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_fkateter_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_fkateter_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_fkateter_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_fkateter_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_fkateter_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>9</td>
        <td>Hasil Laboratorium</td>
        <td>
          <?php
          $pop_h_lab_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_h_lab_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_h_lab_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_h_lab_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_h_lab_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_h_lab_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_h_lab_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>10</td>
        <td>Rontgen</td>
        <td>
          <?php
          $pop_rontgen_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_rontgen_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_rontgen_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_rontgen_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_rontgen_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_rontgen_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_rontgen_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>11</td>
        <td>USG</td>
        <td>
          <?php
          $pop_usg_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_usg_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_usg_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_usg_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_usg_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_usg_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_usg_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>12</td>
        <td>CT- Scan</td>
        <td>
          <?php
          $pop_ctscan_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_ctscan_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_ctscan_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_ctscan_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_ctscan_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_ctscan_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_ctscan_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>13</td>
        <td>EKG</td>
        <td>
          <?php
          $pop_ekg_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_ekg_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_ekg_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_ekg_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_ekg_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_ekg_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_ekg_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>14</td>
        <td>ECHO</td>
        <td>
          <?php
          $pop_echo_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_echo_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_echo_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_echo_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_echo_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_echo_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_echo_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>15</td>
        <td>Persediaan Darah</td>
        <td>
          <?php
          $pop_persediaan_darah_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_persediaan_darah_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_persediaan_darah_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_persediaan_darah_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_persediaan_darah_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_persediaan_darah_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_persediaan_darah_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>16</td>
        <td>Terpasang IV Line</td>
        <td>
          <?php
          $pop_ivline_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_ivline_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_ivline_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_ivline_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_ivline_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_ivline_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_ivline_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>17</td>
        <td>Propilaksis</td>
        <td>
          <?php
          $pop_propilaksis_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_propilaksis_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_propilaksis_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_propilaksis_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_propilaksis_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_propilaksis_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_propilaksis_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>18</td>
        <td>Alergi obat</td>
        <td>
          <?php
          $pop_alergi_obat_ruangan = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];

          echo $form->field($model, 'pop_alergi_obat_ruangan', ['options' => ['class' => 'form-group custom-margin']])->radioList($pop_alergi_obat_ruangan, [
            'item' => function ($index, $label, $name, $checked, $value) {
              // return '<label><input type="radio" class="flat" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled> ' . $label . '</label>';
              return '<div class="custom-control custom-radio custom-control-inline">
              <input id="rd' . $index . '" type="radio" class="custom-control-input" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . ' disabled><label class="custom-control-label" for="rd' . $index . '">' . $label . '</label></div>';
            }
          ])->label(false);
          ?>
        </td>
        <td>
          <?php
          $pop_alergi_obat_ok = ['Ada' => 'Ada', 'Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'pop_alergi_obat_ok', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pop_alergi_obat_ok)->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_alergi_obat_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>19</td>
        <td>Tekanan Darah</td>
        <td>
          <?= $form->field($model, 'pop_tkn_darah_ruangan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '......./.....mmHg', 'type' => 'text', 'disabled' => true])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_tkn_darah_ok', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '......./.....mmHg', 'type' => 'text'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_tkn_darah_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>20</td>
        <td>Nadi</td>
        <td>
          <?= $form->field($model, 'pop_nadi_ruangan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '.........x/mnt', 'type' => 'text', 'disabled' => true])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_nadi_ok', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '.........x/mnt', 'type' => 'text'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_nadi_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>21</td>
        <td>Suhu</td>
        <td>
          <?= $form->field($model, 'pop_suhu_ruangan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '...°C', 'type' => 'text', 'disabled' => true])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_suhu_ok', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '...°C', 'type' => 'text'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_suhu_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>22</td>
        <td>Pernafasan</td>
        <td>
          <?= $form->field($model, 'pop_pernapasan_ruangan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '.........x/mnt', 'type' => 'text', 'disabled' => true])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_pernapasan_ok', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '.........x/mnt', 'type' => 'text'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'pop_pernapasan_ok_ket', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'rows' => 1])->label(false); ?>
        </td>
      </tr>
    </table>
    <table class="table table-sm table-form">
      <tr>
        <td style="width:20%"><label>8. <?= $model->getAttributeLabel('pop_pendidikan') ?></label></td> <!-- radiobutton -->
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
        <td><label>9. <?= $model->getAttributeLabel('pop_obatan') ?></label></td>
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
          echo $form->field($model, 'pop_final_ok')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini', //mini atau large
              'onText' => 'Final', 'handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <button type="submit" class="btn btn-success btn-submit">
            <i class="fas fa-check"></i> Simpan
          </button>

          <button type="button" class="btn btn-warning btn-segarkan">
            <i class="fas fa-sync"></i> Segarkan
          </button>

          <a href="<?= Url::to(['/pre-operasi-perawat-ok-pasien/index', 'id' => Yii::$app->request->get('id')]) ?>" class="btn btn-danger">
            <i class="fas fa-times"></i> Kembali
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>