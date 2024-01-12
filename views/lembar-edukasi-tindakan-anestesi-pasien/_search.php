<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\LembarEdukasiTindakanAnestesi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lembar-edukasi-tindakan-anestesi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'leta_id') ?>

    <?= $form->field($model, 'leta_pl_id') ?>

    <?= $form->field($model, 'leta_kelebihan_anestesi_umum') ?>

    <?= $form->field($model, 'leta_kekurangan_anestesi_umum') ?>

    <?= $form->field($model, 'leta_komplikasi_anestesi_umum') ?>

    <?php // echo $form->field($model, 'leta_kelebihan_anestesi_regional') ?>

    <?php // echo $form->field($model, 'leta_kekurangan_anestesi_regional') ?>

    <?php // echo $form->field($model, 'leta_komplikasi_anestesi_regional') ?>

    <?php // echo $form->field($model, 'leta_kelebihan_anestesi_lokal') ?>

    <?php // echo $form->field($model, 'leta_kekurangan_anestesi_lokal') ?>

    <?php // echo $form->field($model, 'leta_komplikasi_anestesi_lokal') ?>

    <?php // echo $form->field($model, 'leta_kelebihan_sedasi') ?>

    <?php // echo $form->field($model, 'leta_kekurangan_sedasi') ?>

    <?php // echo $form->field($model, 'leta_komplikasi_sedasi') ?>

    <?php // echo $form->field($model, 'leta_keluarga_nama') ?>

    <?php // echo $form->field($model, 'leta_keluarga_umur') ?>

    <?php // echo $form->field($model, 'leta_keluarga_alamat') ?>

    <?php // echo $form->field($model, 'leta_keluarga_no_identitas') ?>

    <?php // echo $form->field($model, 'leta_keluarga_hubunga_dgn_pasien') ?>

    <?php // echo $form->field($model, 'leta_pasien_nama') ?>

    <?php // echo $form->field($model, 'leta_pasien_tgl_lahir') ?>

    <?php // echo $form->field($model, 'leta_pasien_no_rekam_medis') ?>

    <?php // echo $form->field($model, 'leta_pasien_diagnosa') ?>

    <?php // echo $form->field($model, 'leta_pasien_rencana_tindakan') ?>

    <?php // echo $form->field($model, 'leta_pasien_jenis_anestesi') ?>

    <?php // echo $form->field($model, 'leta_pasien_analgesi_pasca_anestesi') ?>

    <?php // echo $form->field($model, 'leta_tanggal_persetujuan') ?>

    <?php // echo $form->field($model, 'leta_setuju') ?>

    <?php // echo $form->field($model, 'leta_final') ?>

    <?php // echo $form->field($model, 'leta_tgl_final') ?>

    <?php // echo $form->field($model, 'leta_batal') ?>

    <?php // echo $form->field($model, 'leta_tgl_batal') ?>

    <?php // echo $form->field($model, 'leta_created_at') ?>

    <?php // echo $form->field($model, 'leta_created_by') ?>

    <?php // echo $form->field($model, 'leta_updated_at') ?>

    <?php // echo $form->field($model, 'leta_updated_by') ?>

    <?php // echo $form->field($model, 'leta_deleted_at') ?>

    <?php // echo $form->field($model, 'leta_deleted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
