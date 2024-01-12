<?php

use app\models\bedahsentral\PostAnestesi;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\medis\TtvPostAnestesi */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $post = PostAnestesi::find()->where(['mpa_id' => $id])->one(); ?>
<div class="ttv-post-anestesi-form">

    <?php $form = ActiveForm::begin(['id' => 'form-ttv-post']); ?>
    <div class="row">
        <?= $form->field($model, 'ttvp_post_anestesi_mpa_id')->hiddenInput(['value'=>$id, 'name' => 'id_post'])->label(false)?>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttvp_tek_darah_sistole',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'number','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'sistole']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttvp_tek_darah_diastole',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'number','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'diastole']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttvp_nadi',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'number','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'nadi']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttvp_waktu',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'time','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'waktu']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttvp_nyeri_metode',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'text','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'metode']) ?>
        </div>
        <div class="col-lg-1">
            <?= $form->field($model, 'ttvp_nyeri_skor',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'number','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'skor']) ?>
        </div>
        <div class="col-lg-1" style="padding-top:30px;">
            <?php if($post->mpa_final == 0 || $post->mpa_batal == 1){ ?>
                <?= Html::submitButton('Tambah', ['class' => 'btn btn-success btn-post']) ?>
            <?php } ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
