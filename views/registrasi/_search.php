<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\pendaftaran\RegistrasiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registrasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'kode') ?>

    <?= $form->field($model, 'pasien_kode') ?>

    <?= $form->field($model, 'tgl_masuk') ?>

    <?= $form->field($model, 'tgl_keluar') ?>

    <?= $form->field($model, 'kiriman_detail_kode') ?>

    <?php // echo $form->field($model, 'debitur_detail_kode') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'no_sep') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'is_print') ?>

    <?php // echo $form->field($model, 'lambar') ?>

    <?php // echo $form->field($model, 'old_kiriman_detail_kode') ?>

    <?php // echo $form->field($model, 'old_debitur_detail_kode') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
