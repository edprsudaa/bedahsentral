<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\bedahsentral\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use yii\web\View;
use app\models\bedahsentral\PostAnestesi;
use app\models\bedahsentral\TimOperasi;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPreOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
<style type="text/css">
  .table-form th,
  .table-form td {
    padding: 0.5px;
    border: 0px;
  }
</style>
<?php
$this->registerJs($this->render('_form_create_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'pla'
]); ?>
<?= $form->field($model, 'pla_batal')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'pla_to_id')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <table class="table table-sm table-form">
      <tr>
        <th class="text-center bg-lightblue" colspan="5">PASCA LOKAL ANESTESI</th>
      </tr>
      <tr>
        <td style="width: 25%;"></td>
        <td style="width: 19%;"><label>Tiba di ruang pemulihan</label></td>
        <td style="width: 1%;"><label>:</label></td>
        <td>
          <?= $form->field($model, 'pla_jam_tiba_diruang_pemulihan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'type' => 'time'])->label(false); ?>
        </td>
        <td style="width: 25%;"></td>
      </tr>
      <tr>
        <td style="width: 25%;"></td>
        <td><label>Keluar/selesai</label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'pla_keluar_jam', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'type' => 'time'])->label(false); ?>
        </td>
        <td style="width: 25%;"></td>
      </tr>
      <tr>
        <td style="width: 25%;"></td>
        <td><label>Jenis tools digunakan</label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'pla_jenis_tools_digunakan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '....', 'type' => 'text'])->label(false); ?>
        </td>
        <td style="width: 25%;"></td>
      </tr>
      <tr>
        <td style="width: 25%;"></td>
        <td><label>Skor tools</label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'pla_skor_tools', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '....', 'type' => 'number'])->label(false); ?>
        </td>
        <td style="width: 25%;"></td>
      </tr>
      <tr>
        <td style="width: 25%;"></td>
        <td><label>Catatan khusus pasien</label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'pla_catatan', ['options' => ['class' => 'form-group custom-margin']])->textarea(['class' => 'form-control form-control-sm', 'placeholder' => '....', 'type' => 'text','rows' => 5])->label(false); ?>
        </td>
        <td style="width: 25%;"></td>
      </tr>
    </table>

  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'pla_final')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini', //mini atau large
              'onText' => 'Final', 'handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <?= Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/pasca-lokal-anestesi/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>