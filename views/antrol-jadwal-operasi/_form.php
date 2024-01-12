<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\bpjskes\AntrolJadwalOperasi $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="antrol-jadwal-operasi-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'kode_booking')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'tgl_operasi')->textInput() ?>

  <?= $form->field($model, 'jenis_tindakan')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'terlaksana')->textInput() ?>

  <?= $form->field($model, 'debitur_detail_kode')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'no_kartu_bpjs')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'pasien_kode')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'diagnosa')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'dokter_operator_id')->textInput() ?>

  <?= $form->field($model, 'unit_asal_kode')->textInput() ?>

  <?= $form->field($model, 'unit_ok_kode')->textInput() ?>

  <?= $form->field($model, 'no_ruang_ok')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'tipe')->textInput() ?>

  <?= $form->field($model, 'tgl_lapor')->textInput() ?>

  <?= $form->field($model, 'tgl_rawat')->textInput() ?>

  <?= $form->field($model, 'kelas_inap_kode')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

  <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>