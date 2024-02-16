<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\bedahsentral\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
use app\models\bedahsentral\TimOperasiDetail;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPreOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
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
    border: 0px;
  }
</style>
<?php
$this->registerJs($this->render('_form_create_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'ppa'
]); ?>
<?= $form->field($model, 'ppa_to_id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'ppa_batal')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <table class="table table-sm table-form">
      <tr>
        <td style="width: 15%;"><label>Tanggal Pukul</label></td>
        <td><label>:</label></td>
        <td colspan="3" style="width: 35%;">
          <?= $form->field($model, 'ppa_tanggal_pukul', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'datetime-local', 'class' => 'form-control form-control-sm', 'style' => 'width:50%'])->label(false); ?>
        </td>
        <td colspan="3" style="width: 15%;"><label>Diagnosis</label></td>
        <td><label>:</label></td>
        <td style="width: 35%;">
          <?= $form->field($model, 'ppa_diagnosis', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'readonly' => 'readonly'])->label(false); ?>
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
          <?= $form->field($model, 'ppa_kesadaran', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'id' => 'selesai-anestesi'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'ppa_tekanan_darah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'id' => 'selesai-anestesi'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'ppa_frekuensi_nadi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'id' => 'selesai-anestesi'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'ppa_frekuensi_nafas', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'id' => 'selesai-anestesi'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'ppa_bb', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'id' => 'selesai-anestesi'])->label(false); ?>
        </td>
      </tr>
    </table>
    <table class="table table-sm">

      <tr style="width:100%">
        <td style="width: 15%;"><label>Riwayat Operasi/Anestesi</label></td>
        <td><label>:</label></td>
        <td colspan="3" style="width: 35%;">
          <?php
          $ppa_riwayat_operasi = ['Ada' => 'Ada', 'Tidak Ada' => 'Tidak Ada'];
          echo $form->field($model, 'ppa_riwayat_operasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($ppa_riwayat_operasi)->label(false);
          $ppa_riwayat_operasi = HelperGeneral::getValueCustomRadio($ppa_riwayat_operasi, $model->ppa_riwayat_operasi);
          ?>
        </td>

        <td style="width: 15%;"><label>Rencana Tindakan</label></td>
        <td><label>:</label></td>
        <td colspan="3" style="width: 35%;">
          <?= $form->field($model, 'ppa_rencana_tindakan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'readonly' => 'readonly'])->label(false); ?>
        </td>
      </tr>
      <tr style="width:100%">
        <td style="width: 15%;"><label>Riwayat komplikasi Anestesi pada Pasien/Keluarga</label></td>
        <td><label>:</label></td>
        <td style="width: 15%;">
          <?php
          $ppa_riwayat_komplikasi = ['Tidak Ada' => 'Tidak Ada'];
          echo $form->field($model, 'ppa_riwayat_komplikasi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->radioList($ppa_riwayat_komplikasi)->label(false);
          $ppa_riwayat_komplikasi = HelperGeneral::getValueCustomRadio($ppa_riwayat_komplikasi, $model->ppa_riwayat_komplikasi);
          // echo "<pre>";print_r($ppa_riwayat_komplikasi);die;
          ?>
        </td>
        <td colspan="2" style="width: 20%;">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_riwayat_komplikasi]" id="ppa_riwayat_komplikasi" type="radio" value="<?= $ppa_riwayat_komplikasi['v'] ?>" <?= $ppa_riwayat_komplikasi['c'] ?>>
              </div>
            </div>
            <input id="ppa_riwayat_komplikasi_it" placeholder="Sebutkan Jika Ada" type="text" value="<?= $ppa_riwayat_komplikasi['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

        <td style="width: 15%;"><label>Obat yang sedang dikonsumsi</label></td>
        <td><label>:</label></td>
        <td style="width: 15%;">
          <?php
          $ppa_obat_yang_sedang_konsumsi = ['Tidak Ada' => 'Tidak Ada'];
          echo $form->field($model, 'ppa_obat_yang_sedang_konsumsi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->radioList($ppa_obat_yang_sedang_konsumsi)->label(false);
          $ppa_obat_yang_sedang_konsumsi = HelperGeneral::getValueCustomRadio($ppa_obat_yang_sedang_konsumsi, $model->ppa_obat_yang_sedang_konsumsi);
          ?>
        </td>

        <td colspan="2" style="width: 20%;">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_obat_yang_sedang_konsumsi]" id="ppa_obat_yang_sedang_konsumsi" type="radio" value="<?= $ppa_obat_yang_sedang_konsumsi['v'] ?>" <?= $ppa_obat_yang_sedang_konsumsi['c'] ?>>
              </div>
            </div>
            <input id="ppa_obat_yang_sedang_konsumsi_it" placeholder="Sebutkan Jika Ada" type="text" value="<?= $ppa_obat_yang_sedang_konsumsi['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td><label>Gigi</label></td>
        <td><label>:</label></td>
        <td colspan="3">
          <?php
          $ppa_gigi_normal = ['Tampak Normal' => 'Tampak Normal', 'Goyang' => 'Goyang', 'Gigi Palsu' => 'Gigi Palsu'];

          echo $form->field($model, 'ppa_gigi_normal', ['options' => ['class' => 'form-group custom-margin', 'style' => 'margin-bottom:0']])->radioList($ppa_gigi_normal, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
                  <input onClick = "giginormal(this.id)" class="custom-control-input" type="radio" id="r' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>
                <label onClick = "giginormal()" for="r' . $index . '" class="custom-control-label"> ' . $label . '</label>
                </div>';
            }
          ])->label(false);
          $ppa_gigi_normal = HelperGeneral::getValueCustomRadio($ppa_gigi_normal, $model->ppa_gigi_normal);
          // echo "<pre>";
          // print_r($ppa_gigi_normal);
          // die;
          ?>
          <div id="atas" style="margin-bottom:0;<?= (($ppa_gigi_normal['v']) ? 'visibility:visible' : 'display:none') ?>">
            <div class="custom-control custom-radio custom-control-inline">
              <input onClick="atas(this.id)" class="custom-control-input" type="radio" id="atas0" name="<?= $model->getModelClasName() ?>[ppa_gigi_normal]" value="Atas" <?= ($ppa_gigi_normal['v'] == 'Atas' ? "checked" : "") ?>>
              <label onClick="atas()" for="atas0" class="custom-control-label">Atas :</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline palsuatas">
              <input class="custom-control-input" type="radio" id="atas1" name="<?= $model->getModelClasName() ?>[ppa_gigi_normal]" value="Atas Semua" <?= ($ppa_gigi_normal['v'] == 'Atas Semua' ? "checked" : "") ?>>
              <label for="atas1" class="custom-control-label">Semua</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline palsuatas">
              <input class="custom-control-input" type="radio" id="atas2" name="<?= $model->getModelClasName() ?>[ppa_gigi_normal]" value="Atas Sebagian" <?= ($ppa_gigi_normal['v'] == 'Atas Sebagian' ? "checked" : "") ?>>
              <label for="atas2" class="custom-control-label">Sebagian</label>
            </div>

          </div>
          <div id="bawah" style="margin-bottom:1rem;<?= (($ppa_gigi_normal['v']) ? 'visibility:visible' : 'display:none') ?>">
            <div class="custom-control custom-radio custom-control-inline">
              <input onClick="bawah(this.id)" class="custom-control-input" type="radio" id="bawah0" name="<?= $model->getModelClasName() ?>[ppa_gigi_normal]" value="Bawah">
              <label onClick="bawah()" for="bawah0" class="custom-control-label">Bawah :</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline palsubawah">
              <input class="custom-control-input" type="radio" id="bawah1" name="<?= $model->getModelClasName() ?>[ppa_gigi_normal]" value="Bawah Semua" <?= ($ppa_gigi_normal['v'] == 'Bawah Semua' ? "checked" : "") ?>>
              <label for="bawah1" class="custom-control-label">Semua</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline palsubawah">
              <input class="custom-control-input" type="radio" id="bawah2" name="<?= $model->getModelClasName() ?>[ppa_gigi_normal]" value="Bawah Sebagian" <?= ($ppa_gigi_normal['v'] == 'Bawah Sebagian' ? "checked" : "") ?>>
              <label for="bawah2" class="custom-control-label">Sebagian</label>
            </div>
          </div>
        </td>

        <td><label>Pemeriksaan laboratorium yang bermakna</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_pemeriksaan_laboratorium = ['Dalam batas normal' => 'Dalam batas normal'];
          echo $form->field($model, 'ppa_pemeriksaan_laboratorium', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->radioList($ppa_pemeriksaan_laboratorium)->label(false);
          $ppa_pemeriksaan_laboratorium = HelperGeneral::getValueCustomRadio($ppa_pemeriksaan_laboratorium, $model->ppa_pemeriksaan_laboratorium);
          ?>
        </td>

        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_pemeriksaan_laboratorium]" id="ppa_pemeriksaan_laboratorium" type="radio" value="<?= $ppa_pemeriksaan_laboratorium['v'] ?>" <?= $ppa_pemeriksaan_laboratorium['c'] ?>>
              </div>
            </div>
            <input id="ppa_pemeriksaan_laboratorium_it" placeholder="Ada, Sebutkan" type="text" value="<?= $ppa_pemeriksaan_laboratorium['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td><label>Jalan Nafas</label></td>
        <td><label>:</label></td>
        <td colspan="3">
          <?php
          $ppa_jalan_nafas = ['Tidak ada masalah yang terlihat' => 'Tidak ada masalah yang terlihat', 'Ada masalah, Sebutkan' => 'Ada masalah, Sebutkan'];
          echo $form->field($model, 'ppa_jalan_nafas', ['options' => ['class' => 'form-group custom-margin', 'style' => 'margin-bottom:0']])->radioList($ppa_jalan_nafas, [
            'item' => function ($index, $label, $name, $checked, $value) {
              return '<div class="custom-control custom-radio custom-control-inline">
                  <input onClick = "jalannafas(this.id)" class="custom-control-input" type="radio" id="jlnnfs' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>
                <label onClick = "jalannafas()" for="jlnnfs' . $index . '" class="custom-control-label"> ' . $label . '</label>
                </div>';
            }
          ])->label(false);
          $ppa_jalan_nafas = HelperGeneral::getValueCustomRadio($ppa_jalan_nafas, $model->ppa_jalan_nafas);
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
                <?= $form->field($model, 'ppa_jalan_nafas_class1', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'id' => 'class1'])->label(false); ?>
              </td>
              <td>
                <?= $form->field($model, 'ppa_jalan_nafas_class2', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'id' => 'class2'])->label(false); ?>
              </td>
              <td>
                <?= $form->field($model, 'ppa_jalan_nafas_class3', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'id' => 'class3'])->label(false); ?>
              </td>
              <td>
                <?= $form->field($model, 'ppa_jalan_nafas_class4', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'id' => 'class4'])->label(false); ?>
              </td>
            </tr>
          </table>
        </td>
        <!-- <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_jalan_nafas]" id="ppa_jalan_nafas" type="radio" value="<?= $ppa_jalan_nafas['v'] ?>" <?= $ppa_jalan_nafas['c'] ?>>
              </div>
            </div>
            <input id="ppa_jalan_nafas_it" placeholder="Jika ada, Sebutkan" type="text" value="<?= $ppa_jalan_nafas['v'] ?>" class="form-control form-control-sm">
          </div>
        </td> -->

        <td><label>Pemeriksaan radiologi yang bermakna</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_pemeriksaan_radiologi = ['Tidak ada Pemeriksaan' => 'Tidak ada Pemeriksaan', 'Dalam batas normal' => 'Dalam batas normal'];
          echo $form->field($model, 'ppa_pemeriksaan_radiologi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->radioList($ppa_pemeriksaan_radiologi)->label(false);
          $ppa_pemeriksaan_radiologi = HelperGeneral::getValueCustomRadio($ppa_pemeriksaan_radiologi, $model->ppa_pemeriksaan_radiologi);
          ?>
        </td>

        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_pemeriksaan_radiologi]" id="ppa_pemeriksaan_radiologi" type="radio" value="<?= $ppa_pemeriksaan_radiologi['v'] ?>" <?= $ppa_pemeriksaan_radiologi['c'] ?>>
              </div>
            </div>
            <input id="ppa_pemeriksaan_radiologi_it" placeholder="Ada, Sebutkan" type="text" value="<?= $ppa_pemeriksaan_radiologi['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td><label>Respirasi</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_respirasi = ['Dalam batas normal' => 'Dalam batas normal', 'Asma' => 'Asma', 'ISPA' => 'ISPA', 'Steep Apneu' => 'Steep Apneu'];
          echo $form->field($model, 'ppa_respirasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($ppa_respirasi)->label(false);
          $ppa_respirasi = HelperGeneral::getValueCustomRadio($ppa_respirasi, $model->ppa_respirasi);
          ?>
        </td>
        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_respirasi]" id="ppa_respirasi" type="radio" value="<?= $ppa_respirasi['v'] ?>" <?= $ppa_respirasi['c'] ?>>
              </div>
            </div>
            <input id="ppa_respirasi_it" placeholder="Lain-lain, Sebutkan" type="text" value="<?= $ppa_respirasi['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

        <td><label>Pemeriksaan Penunjang lain yang bermakna</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_pemeriksaan_penunjang = ['Tidak ada' => 'Tidak ada'];
          echo $form->field($model, 'ppa_pemeriksaan_penunjang', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->radioList($ppa_pemeriksaan_penunjang)->label(false);
          $ppa_pemeriksaan_penunjang = HelperGeneral::getValueCustomRadio($ppa_pemeriksaan_penunjang, $model->ppa_pemeriksaan_penunjang);
          ?>
        </td>

        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_pemeriksaan_penunjang]" id="ppa_pemeriksaan_penunjang" type="radio" value="<?= $ppa_pemeriksaan_penunjang['v'] ?>" <?= $ppa_pemeriksaan_penunjang['c'] ?>>
              </div>
            </div>
            <input id="ppa_pemeriksaan_penunjang_it" placeholder="Ada, Sebutkan" type="text" value="<?= $ppa_pemeriksaan_penunjang['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td><label>Cardiovaskuler</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_cardiovaskuler = ['Dalam batas normal' => 'Dalam batas normal', 'Hipertensi' => 'Hipertensi'];
          echo $form->field($model, 'ppa_cardiovaskuler', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($ppa_cardiovaskuler)->label(false);
          $ppa_cardiovaskuler = HelperGeneral::getValueCustomRadio($ppa_cardiovaskuler, $model->ppa_cardiovaskuler);
          ?>
        </td>
        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_cardiovaskuler]" id="ppa_cardiovaskuler" type="radio" value="<?= $ppa_cardiovaskuler['v'] ?>" <?= $ppa_cardiovaskuler['c'] ?>>
              </div>
            </div>
            <input id="ppa_cardiovaskuler_it" placeholder="Lain-lain, Sebutkan" type="text" value="<?= $ppa_cardiovaskuler['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

        <td><label>Puasa</label></td>
        <td><label>:</label></td>
        <td>
          <label>Makan terakhir pukul :</label>
          <label style="margin-top: 20px;">Minum terakhir pukul :</label>
        </td>
        <td>
          <?= $form->field($model, 'ppa_puasa_makan_terakhir_pukul', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm'])->label(false); ?>
          <?= $form->field($model, 'ppa_puasa_minum_terakhir_pukul', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label>Sistem Pencernaan</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_sistem_pencernaan = ['Dalam batas normal' => 'Dalam batas normal', 'Penyakit Liver' => 'Penyakit Liver', 'Drug/Alcohol Abuse' => 'Drug/Alcohol Abuse'];
          echo $form->field($model, 'ppa_sistem_pencernaan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($ppa_sistem_pencernaan)->label(false);
          $ppa_sistem_pencernaan = HelperGeneral::getValueCustomRadio($ppa_sistem_pencernaan, $model->ppa_sistem_pencernaan);
          ?>
        </td>
        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_sistem_pencernaan]" id="ppa_sistem_pencernaan" type="radio" value="<?= $ppa_sistem_pencernaan['v'] ?>" <?= $ppa_sistem_pencernaan['c'] ?>>
              </div>
            </div>
            <input id="ppa_sistem_pencernaan_it" placeholder="Lain-lain, Sebutkan" type="text" value="<?= $ppa_sistem_pencernaan['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

        <td><label>Risiko Anestesi ASA</label></td>
        <td><label>:</label></td>
        <td colspan="2">
          <?php
          $ppa_risiko_anestesi = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', 'E' => 'E'];
          echo $form->field($model, 'ppa_risiko_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($ppa_risiko_anestesi)->label(false);
          $ppa_risiko_anestesi = HelperGeneral::getValueCustomRadio($ppa_risiko_anestesi, $model->ppa_risiko_anestesi);
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Neuromusculoskeletal</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_neuromusculoscletal = ['Dalam batas normal' => 'Dalam batas normal', 'Riwayat Stroke' => 'Riwayat Stroke', 'Kelumpuhan' => 'Kelumpuhan'];
          echo $form->field($model, 'ppa_neuromusculoscletal', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($ppa_neuromusculoscletal)->label(false);
          $ppa_neuromusculoscletal = HelperGeneral::getValueCustomRadio($ppa_neuromusculoscletal, $model->ppa_neuromusculoscletal);
          ?>
        </td>
        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_neuromusculoscletal]" id="ppa_neuromusculoscletal" type="radio" value="<?= $ppa_neuromusculoscletal['v'] ?>" <?= $ppa_neuromusculoscletal['c'] ?>>
              </div>
            </div>
            <input id="ppa_neuromusculoscletal_it" placeholder="Lain-lain, Sebutkan" type="text" value="<?= $ppa_neuromusculoscletal['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

        <td><label>Rencana Anestesi</label></td>
        <td><label>:</label></td>
        <td colspan="2">
          <?php
          $ppa_rencana_anestesi = ['Umum' => 'Umum', 'Regional' => 'Regional', 'TIVA' => 'TIVA', 'MAC' => 'MAC'];
          echo $form->field($model, 'ppa_rencana_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($ppa_rencana_anestesi)->label(false);
          $ppa_rencana_anestesi = HelperGeneral::getValueCustomRadio($ppa_rencana_anestesi, $model->ppa_rencana_anestesi);
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Ginjal/endokrin</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_ginjal = ['Dalam batas normal' => 'Dalam batas normal', 'DM' => 'DM', 'Gagal Ginjal/dialisis' => 'Gagal Ginjal/dialisis'];
          echo $form->field($model, 'ppa_ginjal', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($ppa_ginjal)->label(false);
          $ppa_ginjal = HelperGeneral::getValueCustomRadio($ppa_ginjal, $model->ppa_ginjal);
          ?>
        </td>
        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_ginjal]" id="ppa_ginjal" type="radio" value="<?= $ppa_ginjal['v'] ?>" <?= $ppa_ginjal['c'] ?>>
              </div>
            </div>
            <input id="ppa_ginjal_it" placeholder="Lain-lain, Sebutkan" type="text" value="<?= $ppa_ginjal['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

        <td><label>Premedikasi</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_premedikasi = ['Tidak Ada' => 'Tidak Ada'];
          echo $form->field($model, 'ppa_premedikasi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->radioList($ppa_premedikasi)->label(false);
          $ppa_premedikasi = HelperGeneral::getValueCustomRadio($ppa_premedikasi, $model->ppa_premedikasi);
          ?>
        </td>

        <td colspan="2">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_premedikasi]" id="ppa_premedikasi" type="radio" value="<?= $ppa_premedikasi['v'] ?>" <?= $ppa_premedikasi['c'] ?>>
              </div>
            </div>
            <input id="ppa_premedikasi_it" placeholder="Ada, Sebutkan" type="text" value="<?= $ppa_premedikasi['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td><label>Alergi Obat/Makanan</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_alergi_obat = ['Tidak Ada' => 'Tidak Ada'];
          echo $form->field($model, 'ppa_alergi_obat', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->radioList($ppa_alergi_obat)->label(false);
          $ppa_alergi_obat = HelperGeneral::getValueCustomRadio($ppa_alergi_obat, $model->ppa_alergi_obat);
          ?>
        </td>
        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_alergi_obat]" id="ppa_alergi_obat" type="radio" value="<?= $ppa_alergi_obat['v'] ?>" <?= $ppa_alergi_obat['c'] ?>>
              </div>
            </div>
            <input id="ppa_alergi_obat_it" placeholder="Ada, Sebutkan" type="text" value="<?= $ppa_alergi_obat['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

        <td><label>Instruksi lain Pre-Anestesi</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_intruksi_lain = ['Tidak Ada' => 'Tidak Ada'];
          echo $form->field($model, 'ppa_intruksi_lain', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->radioList($ppa_intruksi_lain)->label(false);
          $ppa_intruksi_lain = HelperGeneral::getValueCustomRadio($ppa_intruksi_lain, $model->ppa_intruksi_lain);
          ?>
        </td>

        <td colspan="2">
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_intruksi_lain]" id="ppa_intruksi_lain" type="radio" value="<?= $ppa_intruksi_lain['v'] ?>" <?= $ppa_intruksi_lain['c'] ?>>
              </div>
            </div>
            <input id="ppa_intruksi_lain_it" placeholder="Ada, Sebutkan" type="text" value="<?= $ppa_intruksi_lain['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td><label>Lain-lain</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $ppa_lain_lain = ['Tidak Ada' => 'Tidak Ada'];
          echo $form->field($model, 'ppa_lain_lain', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->radioList($ppa_lain_lain)->label(false);
          $ppa_lain_lain = HelperGeneral::getValueCustomRadio($ppa_lain_lain, $model->ppa_lain_lain);
          ?>
        </td>
        <td colspan="2">
          <div class="input-group" style="width:90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[ppa_lain_lain]" id="ppa_lain_lain" type="radio" value="<?= $ppa_lain_lain['v'] ?>" <?= $ppa_lain_lain['c'] ?>>
              </div>
            </div>
            <input id="ppa_lain_lain_it" placeholder="Ada, Sebutkan" type="text" value="<?= $ppa_lain_lain['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

      </tr>
    </table>
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'ppa_final')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini',
              'onText' => 'Final', 'handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <?= Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/pra-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>