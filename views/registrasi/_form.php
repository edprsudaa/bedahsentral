<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\pendaftaran\Registrasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registrasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pasien_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_masuk')->textInput() ?>

    <?= $form->field($model, 'tgl_keluar')->textInput() ?>

    <?= $form->field($model, 'kiriman_detail_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'debitur_detail_kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'no_sep')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
