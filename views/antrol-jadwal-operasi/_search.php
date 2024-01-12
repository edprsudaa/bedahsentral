<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\AntrolJadwalOperasiSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="antrol-jadwal-operasi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kode_booking') ?>

    <?= $form->field($model, 'tgl_operasi') ?>

    <?= $form->field($model, 'jenis_tindakan') ?>

    <?= $form->field($model, 'terlaksana') ?>

    <?php // echo $form->field($model, 'debitur_detail_kode') ?>

    <?php // echo $form->field($model, 'no_kartu_bpjs') ?>

    <?php // echo $form->field($model, 'pasien_kode') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'diagnosa') ?>

    <?php // echo $form->field($model, 'dokter_operator_id') ?>

    <?php // echo $form->field($model, 'unit_asal_kode') ?>

    <?php // echo $form->field($model, 'unit_ok_kode') ?>

    <?php // echo $form->field($model, 'no_ruang_ok') ?>

    <?php // echo $form->field($model, 'tipe') ?>

    <?php // echo $form->field($model, 'tgl_lapor') ?>

    <?php // echo $form->field($model, 'tgl_rawat') ?>

    <?php // echo $form->field($model, 'kelas_inap_kode') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
