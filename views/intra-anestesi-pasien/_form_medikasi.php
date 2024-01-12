<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\bedahsentral\IntraAnestesi;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedikasiIntraAnestesi */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs($this->render('_form_update_ready.js'));
$intra = IntraAnestesi::find()->where(['mia_id' => $id])->one();
?>
<?php $form = ActiveForm::begin(['id' => 'medikasi']); ?>
<div class="row">
  <?= $form->field($model, 'mmia_intra_anestesi_mia_id')->hiddenInput(['value' => $id, 'name' => 'intra_id'])->label(false) ?>
  <div class="col-lg-4">
    <?= $form->field($model, 'mmia_nama_obat', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '.......', 'name' => 'nama']) ?>
  </div>
  <div class="col-lg-2">
    <?= $form->field($model, 'mmia_waktu', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '.......', 'name' => 'jam']) ?>
  </div>

  <div class="col-lg-2" style="padding-top:30px;">
    <?php if ($intra->mia_final == 0 || $intra->mia_batal == 0) { ?>
      <?= Html::submitButton('Tambah', ['class' => 'btn btn-success btn-medikasi']) ?>
    <?php } ?>
  </div>
</div>

<?php ActiveForm::end(); ?>