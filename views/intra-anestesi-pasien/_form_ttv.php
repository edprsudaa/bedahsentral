<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\models\bedahsentral\IntraAnestesi;
/* @var $this yii\web\View */
/* @var $model app\models\medis\TtvIntraAnestesi */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$this->registerJs($this->render('_form_update_ready.js'));
$intra = IntraAnestesi::find()->where(['mia_id' => $id])->one(); 
?>
    <?php $form = ActiveForm::begin(['id' => 'ttvintra']); ?>
    <div class="row">
        <?= $form->field($model, 'ttva_intra_operasi_mia_id')->hiddenInput(['value' => $id, 'name' => 'id_intra'])->label(false) ?>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttva_nadi',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'number','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'nadi']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttva_pernafasan',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'number','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'nafas']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttva_tek_darah_sistole',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'number','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'sistole']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttva_tek_darah_diastole',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'number','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'diastole']) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'ttva_waktu',['options'=>['class'=>'form-group custom-margin']])->textInput(['type'=>'time','class' => 'form-control form-control-sm','placeholder'=>'.......', 'name' => 'waktu']) ?>
        </div>
        <div class="col-lg-2" style="padding-top:30px;">
            <?php if($intra->mia_final == 0 || $intra->mia_batal == 0){ ?>
                <?= Html::submitButton('Tambah', ['class' => 'btn btn-success ice']) ?>
            <?php } ?>
        </div>
    </div>

    

    <?php ActiveForm::end(); ?>

   