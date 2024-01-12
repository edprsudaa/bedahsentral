<?php

use app\components\HelperSpesial;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use app\models\medis\TarifTindakanUnit;
use demogorgorn\ajax\AjaxSubmitButton;
use yii\web\JsExpression;

$kelas_rawat = '000';
if ($layanan['kelas_rawat_kode']) {
  $kelas_rawat = $layanan['kelas_rawat_kode'];
}
// echo'<pre/>';print_r($kelas_rawat);die();
?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform-' . $model->formName()]); ?>
<style>
  div.required label:after {
    content: '';
  }
</style>
<hr />
<div class="pasien-dpjpp-form">
  <?php $form = ActiveForm::begin([
    'id' => 'af-' . $model->formName(),
    // 'options' => ['data-pjax' => true ],
    // 'action'=>Url::to(['save']),
    // 'layout' => 'horizontal',
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
  <?= $form->field($model, 'layanan_id')->hiddenInput()->label(false); ?>
  <div class="row">
    <div class="col-lg-3">
      <?= $form->field($model, 'pelaksana_id')->widget(Select2::classname(), [
        // 'data' => HelperSpesial::getListPegawaiPjp($layanan,false,true),
        'data' => HelperSpesial::getListDokter(false, true),
        'theme' => Select2::THEME_KRAJEE,
        'options' => ['placeholder' => 'Pilih...'],
        'pluginOptions' => [
          'allowClear' => false
        ],
      ]);
      ?>
    </div>
    <div class="col-lg-1">
      <?= $form->field($model, 'cyto', ['inputOptions' =>  ['class' => 'form-control']])->radioList(['0' => 'Tidak', '1' => 'Ya']) ?>
    </div>
    <div class="col-lg-7">
      <?= $form->field($model, "tarif_tindakan_id")->widget(Select2::classname(), [
        'data' => TarifTindakanUnit::find()->getListTarifTindakanUnit(false, null, $layanan['unit_kode'], $kelas_rawat),
        'theme' => Select2::THEME_KRAJEE,
        'options' => ['class' => 'form-control input-sm dynamic-select2', 'placeholder' => 'Pilih Tindakan ...'],
        'pluginOptions' => [
          'allowClear' => true,
        ],
      ]);
      ?>
    </div>
    <div class="col-lg-1">
      <?= $form->field($model, "jumlah")->textInput([
        'type' => 'number'
      ]) ?>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-8">
      <?php
      AjaxSubmitButton::begin([
        'id' => 'btn-simpan-' . $model->formName(),
        'label' => '<i class="fas fa-check-double"></i> ' . (($model->isNewRecord) ? "Tambah" : "Ubah"),
        'useWithActiveForm' => 'af-' . $model->formName(),
        // 'enableClientValidation' => false,
        'encodeLabel' => false,
        'ajaxOptions' => [
          'type' => 'POST',
          'url' => (($model->isNewRecord) ? Url::to(["save", 'id' => $layanan['id'], 'subid' => $model->id]) : Url::to(["save", 'id' => $layanan['id'], 'subid' => $model->id])),
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
        'options' => ['class' => 'btn btn-success col-sm-8', 'type' => 'submit'],
      ]);
      AjaxSubmitButton::end();
      echo Html::button(Yii::t('app', '{modelClass}', ['modelClass' => '<i class="mdi mdi-refresh"></i> Segarkan']), [
        'class' => 'col-sm-4 btn btn-warning ink-reaction', 'title' => 'Klik Untuk Segarkan', 'onclick' => '(function ( $event ) {
                    $.pjax.reload({container:"#pjform-' . $model->formName() . '",timeout: false}); 
                })();'
      ]) ?>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
</div>
<?php yii\widgets\Pjax::end(); ?>
<hr />