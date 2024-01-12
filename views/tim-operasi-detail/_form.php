<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\bedahsentral\TimOperasiDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tim-operasi-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tod_id')->textInput() ?>

    <?= $form->field($model, 'tod_to_id')->textInput() ?>

    <?= $form->field($model, 'tod_jo_id')->textInput() ?>

    <?= $form->field($model, 'tod_pgw_id')->textInput() ?>

    <?= $form->field($model, 'tod_created_at')->textInput() ?>

    <?= $form->field($model, 'tod_created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tod_updated_at')->textInput() ?>

    <?= $form->field($model, 'tod_updated_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tod_deleted_at')->textInput() ?>

    <?= $form->field($model, 'tod_deleted_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
