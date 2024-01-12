<?php

use app\models\bedahsentral\CatatanLokalAnestesi;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedikasiIntraAnestesi */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs($this->render('_form_update_ready.js'));
$catatan = CatatanLokalAnestesi::find()->where(['cla_id' => $id])->one();
?>
<?php $form = ActiveForm::begin(['id' => 'medikasi']); ?>
<div class="row">
  <?= $form->field($model, 'mcl_cla_id')->hiddenInput(['value' => $id, 'name' => 'intra_id'])->label(false) ?>
  <div class="col-lg-4">
    <?= $form->field($model, 'mcl_nama_obat', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '.......', 'name' => 'nama']) ?>
  </div>
  <div class="col-lg-2">
    <?= $form->field($model, 'mcl_waktu', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '.......', 'name' => 'jam']) ?>
  </div>

  <div class="col-lg-2" style="padding-top:30px;">
    <?php if ($catatan->cla_final == 0 || $catatan->cla_batal == 0) { ?>
      <?= Html::submitButton('Tambah', ['class' => 'btn btn-success btn-medikasi']) ?>
    <?php } ?>
  </div>
</div>

<?php ActiveForm::end(); ?>