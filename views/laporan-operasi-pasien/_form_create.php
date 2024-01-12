<?php

use app\components\Akun;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\bedahsentral\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
use kartik\file\FileInput;
use app\models\bedahsentral\LaporanOperasi;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPostOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Pjax::begin(['id' => 'pjform']); ?>
<style type="text/css">
  .table-form th,
  .table-form td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
  }
</style>
<?php
$this->registerJs($this->render('_form_create_ready.js'));

// $timoperasi = TimOperasi::find()->where(['to_id' => $model->lap_op_to_id])->one();
?>
<?php $form = ActiveForm::begin(['id' => 'lap', 'options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'lap_op_to_id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'lap_op_batal')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <table border="0" class="table table-sm table-form">
      <tr style="height:50px; text-align: center;">
        <th style="border-bottom-style: none;">Tanggal Operasi</th>
        <th style="border-bottom-style: none;">Ruang Operasi</th>
        <th style="border-bottom-style: none;"><?= $model->getAttributeLabel('lap_op_kelas') ?></th>
        <th style="border-bottom-style: none;"><?= $model->getAttributeLabel('lap_op_jam_mulai') ?></th>
        <th style="border-bottom-style: none;"><?= $model->getAttributeLabel('lap_op_jam_selesai') ?></th>
        <th style="border-bottom-style: none;"><?= $model->getAttributeLabel('lap_op_lama_operasi') ?></th>
      </tr>
      <tr style="text-align:center;">
        <td>
          <?= $form->field($model, 'lap_op_tanggal', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'date', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => true])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'lap_op_ruangan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => true])->label(false); ?>
        </td>
        <td>
          <?php
          echo $form->field($model, 'lap_op_kelas', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini ....'])->label(false);
          // $lap_op_jenis_operasi = ['Cyto' => 'Cyto', 'Elektif' => 'Elektif'];
          // echo $form->field($model, 'lap_op_jenis_operasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($lap_op_jenis_operasi)->label(false);
          // $lap_op_jenis_operasi = HelperGeneral::getValueCustomRadio($lap_op_jenis_operasi, $model->lap_op_jenis_operasi);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'lap_op_jam_mulai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jam Mulai', 'id' => 'jam-mulai'])->label(false); ?>
        </td>
        <td>
          <?= $form->field($model, 'lap_op_jam_selesai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jam Selesai', 'id' => 'jam-selesai'])->label(false); ?>
        </td>
        <td> <?= $form->field($model, 'lap_op_lama_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... jam ....menit', 'id' => 'selisih', 'required' => true, 'readonly' => true])->label(false); ?></td>
      </tr>
      <tr>
        <td style="text-align: center;"><label>Nama Ahli Bedah</label></td>
        <td style="text-align: center;"><label>Nama Dokter Anestesi</label></td>
        <td style="border-right-style: none;"><label>Asisten</label></td>
        <td colspan="3">
          <?php
          $asisten = TimOperasiDetail::find()->where(['tod_to_id' => $model->lap_op_to_id])->andWhere(['tod_jo_id' => 3])->all();
          $no = 1;
          if ($asisten) {
            foreach ($asisten as $val) {
              echo $no++ . '. ' . HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
            }
          } else {
            echo "-";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td rowspan="3" style="padding-left:10px">
          <?php
          $ahlibedah = TimOperasiDetail::find()->where(['tod_to_id' => $model->lap_op_to_id])->andWhere(['tod_jo_id' => 1])->all();
          $no = 1;
          if ($ahlibedah) {
            foreach ($ahlibedah as $val) {
              // if ($val->tod_pgw_id == Akun::user()->id_pegawai) {
              //   echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
              // } elseif (Akun::user()->username == Yii::$app->params['other']['username_root_bedah_sentral']) {
              echo $no++ . ') ' . HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
              // }
            }
          } else {
            echo "Belum diisi";
          }
          ?>
        </td>
        <td rowspan="3" style="padding-left:10px">
          <?php
          $ahlianestesi = TimOperasiDetail::find()->where(['tod_to_id' => $model->lap_op_to_id])->andWhere(['tod_jo_id' => 2])->all();
          $no = 1;
          if ($ahlianestesi) {
            foreach ($ahlianestesi as $val) {
              echo $no++ . ') ' . HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
            }
          } else {
            echo "-";
          }
          ?>
        </td>
        <td style="border-right-style: none;"><label>Instrumentator</label></td>
        <td colspan="3">
          <?php
          $instrumen = TimOperasiDetail::find()->where(['tod_to_id' => $model->lap_op_to_id])->andWhere(['tod_jo_id' => 6])->all();
          $no = 1;
          if ($instrumen) {
            foreach ($instrumen as $val) {
              echo $no++ . '. ' . HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
            }
          } else {
            echo "-";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td style="border-right-style: none;"><label>Sirkuler</label></td>
        <td colspan="3">
          <?php
          $sirkuler = TimOperasiDetail::find()->where(['tod_to_id' => $model->lap_op_to_id])->andWhere(['tod_jo_id' => 4])->all();
          $no = 1;
          if ($sirkuler) {
            foreach ($sirkuler as $sir) {
              echo $no++ . '. ' . HelperSpesial::getNamaPegawai($sir->pegawai) . "<br>";
            }
          } else {
            echo "-";
          }
          ?>
        </td>
        </td>
      </tr>
      <tr>
        <td style="border-right-style: none;"><label>Penata Anestesi</label></td>
        <td colspan="3">
          <?php
          $perawatanestesi = TimOperasiDetail::find()->where(['tod_to_id' => $model->lap_op_to_id])->andWhere(['tod_jo_id' => 5])->all();
          $no = 1;
          if ($perawatanestesi) {
            foreach ($perawatanestesi as $val) {
              echo $no++ . '. ' . HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
            }
          } else {
            echo "-";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td>
          <label><?= $model->getAttributeLabel('lap_op_diagnosis_pre_operasi') ?> : </label>
        </td>
        <td colspan="5">
          <?= $form->field($model, 'lap_op_diagnosis_pre_operasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => 'Ketik disni .......'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>
          <label><?= $model->getAttributeLabel('lap_op_diagnosis_pasca_operasi') ?> : </label>
        </td>
        <td colspan="5">
          <?= $form->field($model, 'lap_op_diagnosis_pasca_operasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => 'Ketik disni .......'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>
          <label>Tindakan Operasi : </label>
        </td>
        <td colspan="5">
          <?= $form->field($model, 'lap_op_nama_jenis_operasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => 'Ketik disni .......', 'rows' => 3])->label(false); ?>

        </td>
      </tr>
      <tr>
        <td colspan="6">
          <label>Jaringan yang dieksisi/insisi: </label>
          <?php
          echo $form->field($model, 'lap_op_jenis_jaringan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['placeholder' => 'Ketik disni .......'])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <label>Jenis Operasi : <b><span style="font-size: 12px;color:red"><u><i>(Pilih Salah Satu)</i></u></span></b></label>
          <?php
          echo $form->field($model, 'lap_op_jenis_operasi', [
            'options' => ['class' => 'form-group custom-margin'],
          ])->inline(true)->radioList(['1' => 'Cyto', '0' => 'Elektif'])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <label><?= $model->getAttributeLabel('lap_op_jaringan_operasi_dikirim') ?> : <b><span style="font-size: 12px;color:red"><u><i>(Pilih Salah Satu)</i></u></span></b></label>
          <?php
          $lap_op_jaringan_operasi_dikirim = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
          echo $form->field($model, 'lap_op_jaringan_operasi_dikirim', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($lap_op_jaringan_operasi_dikirim)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <label>Laporan Operasi : <b><span style="font-size: 12px;color:red"><u><i>(Silahkan Isi Laporan Operasi)</i></u></span></b></label>
          <?php
          echo $form->field($model, 'lap_op_laporan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => 'Ketik disni .......', 'rows' => 10])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <label><?= $model->getAttributeLabel('lap_op_instruksi_prwt_pasca_operasi') ?> :</label>
          <?= $form->field($model, 'lap_op_instruksi_prwt_pasca_operasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => 'Ketik disni .......', 'rows' => 10])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <label><?= $model->getAttributeLabel('lap_op_penyulit') ?> :</label>
          <?= $form->field($model, 'lap_op_penyulit', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => 'Ketik disni .......'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td>
          <!-- <label> Prosedur : </label> -->
          <label><?= $model->getAttributeLabel('lap_op_jumlah_perdarahan') ?> :</label>
          <?php
          echo $form->field($model, 'lap_op_jumlah_perdarahan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '..........cc'])->label(false);
          ?>
        </td>
      </tr>
      <!-- <tr> -->
      <!-- <td> -->
      <!-- <label> Prosedur : </label> -->
      <!-- <label> -->
      <?php
      // echo $model->getAttributeLabel('lap_op_jumlah_tranfusi')
      ?>
      <!-- :</label> -->
      <?php
      // echo $form->field($model, 'lap_op_jumlah_tranfusi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disni .......Ketik disni ..........cc'])->label(false);
      ?>
      <!-- </td> -->
      <!-- </tr> -->
    </table>

  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'lap_op_final')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini',
              'onText' => 'Final', 'handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <?= Html::submitButton('<i class="fas fa-check"></i> Simpan', ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button('<i class="fas fa-sync"></i> Segarkan', ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a('<i class="fas fa-times"></i> Kembali', ['/laporan-operasi-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>