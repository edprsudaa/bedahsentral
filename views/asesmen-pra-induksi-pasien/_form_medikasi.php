<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use app\models\medis\Log;
use app\components\HelperSpesial;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\medis\PemberianObatPremedikasiAnestesi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemberian-obat-premedikasi-anestesi-form">

    <?php $form = ActiveForm::begin(['id' => 'form-medikasi']); ?>

    <div class="row">
        <?= $form->field($model, 'popa_api_id')->hiddenInput(['value' => $id, 'name' => 'id_api'])->label(false) ?>
        
        
        <div class="col-lg-2" style="padding-top: 30px;">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-medikasi']) ?>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
