<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\bedahsentral\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use app\models\bedahsentral\IntraOperasiPerawat;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPostOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
  .bedah {
    width: 25%;
    float: left;
    text-align: center;
  }

  .bedah p {
    padding-bottom: 50px;
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
    border: 0px;
  }
</style>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
<?php
$this->registerJs($this->render('_form_create_ready.js'));
// echo'</pre>';print_r($model);die();
$timoperasi = TimOperasi::find()->where(['to_id' => $model->pjki_to_id])->one();

?>
<?php $form = ActiveForm::begin(['id' => 'pjki']); ?>
<?= $form->field($model, 'pjki_to_id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'pjki_batal')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <table border="1" cellspacing="0" width="100%" class="table table-sm table-form">
      <tr>
        <th colspan="6" class="text-center bg-lightblue">PENGGUNAAN JUMLAH KASA DAN INSTRUMEN</th>
      </tr>
      <tr>
        <td><label>OPERASI/TINDAKAN</label></td>
        <td>:</td>
        <td colspan="4">
          <?= $timoperasi->to_tindakan_operasi ?>
        </td>
      </tr>
      <tr>
        <td><label>Kamar Operasi</label></td>
        <td>:</td>
        <td>
          <?= $timoperasi->unit->nama; ?>
        </td>
        <td><label>Ahli Bedah</label></td>
        <td>:</td>
        <td>
          <?php
          $ahlibedah = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 1])->all();
          // print_r($timoperasi->to_id);die;
          if ($ahlibedah) {
            foreach ($ahlibedah as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai);
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Tanggal Operasi</label></td>
        <td>:</td>
        <td>
          <?= \Yii::$app->formatter->asDate($timoperasi->to_tanggal_operasi); ?>
        </td>
        <td><label>Ahli Anestesi</label></td>
        <td>:</td>
        <td>
          <?php
          $ahlianestesi = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 2])->all();

          if ($ahlianestesi) {
            foreach ($ahlianestesi as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai);
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Operasi Mulai Jam</label></td>
        <td>:</td>
        <td>
          <?php
          $mulai = IntraOperasiPerawat::find()->orderBy(['iop_id' => SORT_DESC])->where(['iop_to_id' => $timoperasi->to_id])->one();
          echo ($mulai ? $mulai->iop_jam_mulai_bedah : 'belum di isi');
          ?>
        </td>
        <td><label>Asisten/Instrumen</label></td>
        <td>:</td>
        <td>
          <?php
          $asisten = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['or', ['tod_jo_id' => 3], ['tod_jo_id' => 6]])->all();
          $no = 1;

          if ($asisten) {
            foreach ($asisten as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Operasi Selesai Jam</label></td>
        <td>:</td>
        <td>
          <?php
          $selesai = IntraOperasiPerawat::find()->orderBy(['iop_id' => SORT_DESC])->where(['iop_to_id' => $timoperasi->to_id])->one();
          echo ($selesai ? $selesai->iop_jam_selesai_bedah : 'belum di isi');
          ?>
        </td>
        <td><label>Perawat Sirkuler</label></td>
        <td>:</td>
        <td>
          <?php
          $sirkuler = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 4])->all();
          $no = 1;

          if ($sirkuler) {
            foreach ($sirkuler as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Pasien Keluar Kamar Operasi</label></td>
        <td>:</td>
        <td>
          <?= $form->field($model, 'pjki_pasien_keluar_kamar_operasi', ['options' => ['class' => 'form-group custom-margin', 'style' => 'width:50%']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
        <td><label>Penata Anestesi</label></td>
        <td>:</td>
        <td>
          <?php
          $perawatanestesi = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 5])->all();
          $no = 1;

          if ($perawatanestesi) {
            foreach ($perawatanestesi as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
      </tr>
    </table>
    <br>
    <table border="1" cellspacing="0" width="100%">
      <thead>
        <tr align="center" class="text-center bg-lightblue">
          <th rowspan="2">PERHITUNGAN ITEM</th>
          <th rowspan="2">HITUNGAN PERTAMA</th>
          <th rowspan="2">TAMBAHAN SELAMA OPERASI</th>
          <th rowspan="2">JUMLAH</th>
          <th colspan="2">HITUNGAN TERAKHIR</th>
        </tr>
        <tr align="center" class="text-center bg-lightblue">
          <th>Dipakai</th>
          <th>Sisa</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><label>Tangkai Pisau</label></td>
          <td>
            <?= $form->field($model, 'pjki_tangkai_pisau_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tangkai_pisau_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tangkai_pisau_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tangkai_pisau_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tangkai_pisau_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Pinset Anatomis</label></td>
          <td>
            <?= $form->field($model, 'pjki_pinset_anatomis_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pinset_anatomis_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pinset_anatomis_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pinset_anatomis_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pinset_anatomis_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Pinset Chrirurgis</label></td>
          <td>
            <?= $form->field($model, 'pjki_pinset_chrirurgis_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pinset_chrirurgis_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pinset_chrirurgis_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pinset_chrirurgis_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pinset_chrirurgis_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Gunting Benang</label></td>
          <td>
            <?= $form->field($model, 'pjki_gunting_benang_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_gunting_benang_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_gunting_benang_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_gunting_benang_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_gunting_benang_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Gunting Jaringan</label></td>
          <td>
            <?= $form->field($model, 'pjki_gunting_jaringan_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_gunting_jaringan_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_gunting_jaringan_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_gunting_jaringan_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_gunting_jaringan_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Mosquito Pean L/B</label></td>
          <td>
            <?= $form->field($model, 'pjki_mosquito_pean_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_mosquito_pean_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_mosquito_pean_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_mosquito_pean_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_mosquito_pean_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Pean Lurus</label></td>
          <td>
            <?= $form->field($model, 'pjki_pean_lurus_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pean_lurus_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pean_lurus_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pean_lurus_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pean_lurus_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Pean Bengkok</label></td>
          <td>
            <?= $form->field($model, 'pjki_pean_bengkok_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pean_bengkok_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pean_bengkok_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pean_bengkok_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_pean_bengkok_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Duk Klem</label></td>
          <td>
            <?= $form->field($model, 'pjki_duk_klem_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_duk_klem_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_duk_klem_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_duk_klem_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_duk_klem_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Needle Holder</label></td>
          <td>
            <?= $form->field($model, 'pjki_needle_holder_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_needle_holder_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_needle_holder_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_needle_holder_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_needle_holder_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Kocher</label></td>
          <td>
            <?= $form->field($model, 'pjki_kocher_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kocher_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kocher_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kocher_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kocher_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>
            <?= $form->field($model, 'pjki_tambahan_1', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Ketik Disini ...'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_1_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_1_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_1_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_1_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_1_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>
            <?= $form->field($model, 'pjki_tambahan_2', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Ketik Disini ...'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_2_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_2_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_2_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_2_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_tambahan_2_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Needle Atraumatic</label></td>
          <td>
            <?= $form->field($model, 'pjki_needle_atrumatic_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_needle_atrumatic_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_needle_atrumatic_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_needle_atrumatic_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_needle_atrumatic_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Kassa</label></td>
          <td>
            <?= $form->field($model, 'pjki_kassa_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kassa_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kassa_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kassa_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kassa_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Roll Kasa</label></td>
          <td>
            <?= $form->field($model, 'pjki_roll_kassa_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_roll_kassa_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_roll_kassa_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_roll_kassa_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_roll_kassa_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Depper/Waches</label></td>
          <td>
            <?= $form->field($model, 'pjki_depper_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_depper_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_depper_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_depper_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_depper_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Kacang(Peanut)</label></td>
          <td>
            <?= $form->field($model, 'pjki_kacang_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kacang_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kacang_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kacang_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_kacang_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label>Lidi Waten</label></td>
          <td>
            <?= $form->field($model, 'pjki_lidi_waten_hitungan_pertama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_lidi_waten_tambahan_slma_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_lidi_waten_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_lidi_waten_dipakai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'onInput' => 'cek_jumlah()'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'pjki_lidi_waten_sisa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
      </tbody>
    </table>
    <br><br>
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'pjki_final')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini', //mini atau large
              'onText' => 'Final', 'handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <?= Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/penggunaan-jumlah-kasa-dan-instrumen-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>