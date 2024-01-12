<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\medis\LembarEdukasiTindakanAnestesi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lembar-edukasi-tindakan-anestesi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'leta_id')->textInput() ?>

    <?= $form->field($model, 'leta_pl_id')->textInput() ?>

    <?= $form->field($model, 'leta_kelebihan_anestesi_umum')->textInput() ?>

    <?= $form->field($model, 'leta_kekurangan_anestesi_umum')->textInput() ?>

    <?= $form->field($model, 'leta_komplikasi_anestesi_umum')->textInput() ?>

    <?= $form->field($model, 'leta_kelebihan_anestesi_regional')->textInput() ?>

    <?= $form->field($model, 'leta_kekurangan_anestesi_regional')->textInput() ?>

    <?= $form->field($model, 'leta_komplikasi_anestesi_regional')->textInput() ?>

    <?= $form->field($model, 'leta_kelebihan_anestesi_lokal')->textInput() ?>

    <?= $form->field($model, 'leta_kekurangan_anestesi_lokal')->textInput() ?>

    <?= $form->field($model, 'leta_komplikasi_anestesi_lokal')->textInput() ?>

    <?= $form->field($model, 'leta_kelebihan_sedasi')->textInput() ?>

    <?= $form->field($model, 'leta_kekurangan_sedasi')->textInput() ?>

    <?= $form->field($model, 'leta_komplikasi_sedasi')->textInput() ?>

    <?= $form->field($model, 'leta_keluarga_nama')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_keluarga_umur')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_keluarga_alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_keluarga_no_identitas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_keluarga_hubunga_dgn_pasien')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_pasien_nama')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_pasien_tgl_lahir')->textInput() ?>

    <?= $form->field($model, 'leta_pasien_no_rekam_medis')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_pasien_diagnosa')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_pasien_rencana_tindakan')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_pasien_jenis_anestesi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_pasien_analgesi_pasca_anestesi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'leta_tanggal_persetujuan')->textInput() ?>

    <?= $form->field($model, 'leta_setuju')->textInput() ?>

    <?= $form->field($model, 'leta_final')->textInput() ?>

    <?= $form->field($model, 'leta_tgl_final')->textInput() ?>

    <?= $form->field($model, 'leta_batal')->textInput() ?>

    <?= $form->field($model, 'leta_tgl_batal')->textInput() ?>

    <?= $form->field($model, 'leta_created_at')->textInput() ?>

    <?= $form->field($model, 'leta_created_by')->textInput() ?>

    <?= $form->field($model, 'leta_updated_at')->textInput() ?>

    <?= $form->field($model, 'leta_updated_by')->textInput() ?>

    <?= $form->field($model, 'leta_deleted_at')->textInput() ?>

    <?= $form->field($model, 'leta_deleted_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
