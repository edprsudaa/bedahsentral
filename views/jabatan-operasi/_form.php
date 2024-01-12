<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\bedahsentral\JabatanOperasi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jabatan-operasi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'jo_id')->textInput() ?>

    <?= $form->field($model, 'jo_jabatan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'jo_utama')->textInput() ?>

    <?= $form->field($model, 'jo_created_at')->textInput() ?>

    <?= $form->field($model, 'jo_created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jo_updated_at')->textInput() ?>

    <?= $form->field($model, 'jo_updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jo_deleted_at')->textInput() ?>

    <?= $form->field($model, 'jo_deleted_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
