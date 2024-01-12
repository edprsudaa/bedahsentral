<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SemuaAktifitas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'log_id') ?>

    <?= $form->field($model, 'log_user_id') ?>

    <?= $form->field($model, 'log_user_ip') ?>

    <?= $form->field($model, 'log_action') ?>

    <?= $form->field($model, 'log_data') ?>

    <?php // echo $form->field($model, 'log_media') ?>

    <?php // echo $form->field($model, 'log_created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
