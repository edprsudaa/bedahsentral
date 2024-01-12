<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use app\components\HelperSpesial;
use demogorgorn\ajax\AjaxSubmitButton;
use yii\web\JsExpression;
?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform-' . $model->formName(), 'timeout' => 0]); ?>
<div class="akses-unit-pengguna-form">
  <?php $form = ActiveForm::begin([
    'id' => 'af-' . $model->formName(),
    'options' => ['data-pjax' => true],
    // 'action'=>Url::to(['save']),
    'layout' => 'horizontal',
    'fieldConfig' => [
      'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
      'horizontalCssClasses' => [
        'label' => 'col-sm-3',
        'wrapper' => 'col-sm-9',
        'error' => '',
        'hint' => '',
      ],
    ],
  ]); ?>
  <div class="row">
    <div class="col-lg-4">
      <?= $form->field($model, 'pengguna_id')->widget(Select2::classname(), [
        'data' => HelperSpesial::getListUser(1, false, true),
        'options' => ['placeholder' => 'Pilih Pegawai...'],
        'pluginOptions' => [
          'allowClear' => false
        ],
      ]);
      ?>
    </div>
    <div class="col-lg-3">
      <?= $form->field($model, 'unit_id')->widget(Select2::classname(), [
        'data' => HelperSpesial::getListUnitLayanan(null, false, true),
        'options' => ['placeholder' => 'Pilih Unit...'],
        'pluginOptions' => [
          'allowClear' => false
        ],
      ]);
      ?>
    </div>
    <div class="col-lg-3">
      <?php
      echo $form->field($model, 'id_aplikasi')->widget(Select2::classname(), [
        'data' => HelperSpesial::getListAplikasi(false, true),
        'options' => ['placeholder' => 'Pilih Aplikasi...'],
        'pluginOptions' => [
          'allowClear' => false
        ],
      ]);
      ?>
    </div>
    <div class="col-lg-2">
      <?php //echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Tambah') : Yii::t('app', 'Ubah'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) 
      ?>
      <?php
      AjaxSubmitButton::begin([
        'id' => 'btn-simpan-' . $model->formName(),
        'label' => '<i class="fas fa-check-double"></i> ' . (($model->isNewRecord) ? "Tambah" : "Ubah"),
        'useWithActiveForm' => 'af-' . $model->formName(),
        // 'enableClientValidation' => false,
        'encodeLabel' => false,
        'ajaxOptions' => [
          'type' => 'POST',
          'url' => (($model->isNewRecord) ? Url::to(["save"]) : Url::to(["save", 'id' => $model->id])),
          'beforeSend' => new JsExpression('function(e){
                        fbtn.setLoading($("#btn-simpan-' . $model->formName() . '"),"Proses..");
                    }'),
          'success' => new \yii\web\JsExpression("function(data) {
                        if(data.status){
                            fmsg.s(data.msg);
                            $.pjax.reload({container:\"#pjgrid-" . $model->formName() . "\"}); 
                        }else{
                            fmsg.w(data.msg+' : '+JSON.stringify(data.data));
                        }                               
                    }"),
          'complete' => new JsExpression('function(html){
                        fbtn.resetLoading($("#btn-simpan-' . $model->formName() . '"),"<i class=\'fas fa-check-double\'></i> ' . (($model->isNewRecord) ? "Tambah" : "Ubah") . '");
                    }'),
        ],
        'options' => ['class' => 'btn btn-success col-sm-7', 'type' => 'submit'],
      ]);
      AjaxSubmitButton::end();
      echo Html::button(Yii::t('app', '{modelClass}', ['modelClass' => '<i class="fas fa-sync"></i> Batal']), [
        'class' => 'col-sm-5 btn btn-danger ink-reaction btn-batal-' . $model->formName(), 'title' => 'Klik Untuk Batal Simpan Hadir Dokter', 'onclick' => '(function ( $event ) {
                    $.pjax.reload({container:"#pjform-' . $model->formName() . '"});
                })();'
      ]);
      ?>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>
<?php yii\widgets\Pjax::end(); ?>
<hr />