<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\TimOperasiDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tim-operasi-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'tod_id') ?>

    <?= $form->field($model, 'tod_to_id') ?>

    <?= $form->field($model, 'tod_jo_id') ?>

    <?= $form->field($model, 'tod_pgw_id') ?>

    <?= $form->field($model, 'tod_created_at') ?>

    <?php // echo $form->field($model, 'tod_created_by') ?>

    <?php // echo $form->field($model, 'tod_updated_at') ?>

    <?php // echo $form->field($model, 'tod_updated_by') ?>

    <?php // echo $form->field($model, 'tod_deleted_at') ?>

    <?php // echo $form->field($model, 'tod_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
