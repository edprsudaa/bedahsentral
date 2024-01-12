<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use app\models\bedahsentral\IntraAnestesi;

/* @var $this yii\web\View */
/* @var $model app\models\medis\CairanMasukIntraAnestesi */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $intra = IntraAnestesi::find()->where(['mia_id' => $id])->one(); ?>

<div class="cairan-masuk-intra-anestesi-form">

  <?php $form = ActiveForm::begin(['id' => 'form-cairan-masuk']); ?>
  <div class="row">
    <?= $form->field($model, 'cmasuk_intra_operasi_mia_id')->hiddenInput(['value' => $id, 'name' => 'id_intra'])->label(false); ?>
    <div class="col-lg-3">
      <label>Cairan</label>
      <?= $form->field($model, 'cmasuk_cairan_nama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '.......', 'name' => 'nama'])->label(false) ?>
      <?php
      // echo $form->field($model, 'cmasuk_cairan_nama')->widget(Select2::classname(), [
      //   'data' => ['Darah' => 'Darah', 'Urine' => 'Urine', 'Infus' => 'Infus'],
      //   'options' => ['placeholder' => 'Pilih...', 'name' => 'nama'],
      //   'size' => Select2::SMALL,
      //   'pluginOptions' => [
      //     'allowClear' => false,
      //   ],
      // ])->label(false);
      ?>
    </div>
    <div class="col-lg-3">
      <?= $form->field($model, 'cmasuk_jumlah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jumlah Cairan...', 'name' => 'jumlah']); ?>
    </div>
    <div class="col-lg-3">
      <?= $form->field($model, 'cmasuk_waktu', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'name' => 'waktu']); ?>
    </div>
    <div class="col-lg-3" style="padding-top:30px;">
      <?php if ($intra->mia_final == 0 || $intra->mia_batal == 0) { ?>
        <?= Html::submitButton('Tambah', ['class' => 'btn btn-success btn-cairan-masuk']) ?>
      <?php } ?>
    </div>
  </div>
  <?php ActiveForm::end(); ?>

</div>