<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\JabatanOperasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jabatan-operasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'jo_id') ?>

    <?= $form->field($model, 'jo_jabatan') ?>

    <?= $form->field($model, 'jo_utama') ?>

    <?= $form->field($model, 'jo_created_at') ?>

    <?= $form->field($model, 'jo_created_by') ?>

    <?php // echo $form->field($model, 'jo_updated_at') ?>

    <?php // echo $form->field($model, 'jo_updated_by') ?>

    <?php // echo $form->field($model, 'jo_deleted_at') ?>

    <?php // echo $form->field($model, 'jo_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
