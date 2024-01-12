<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
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
    /* border: 0.5px solid #3c8dbc; */
    border: 0px;
  }
</style>
<?php
$this->registerJs($this->render('_form_update_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'pla'
]); ?>
<?= $form->field($model, 'pla_to_id')->hiddenInput()->label(false); ?>
<?php
// echo $form->field($model, 'pla_base64')->hiddenInput(['id' => 'post-base64'])->label(false);
?>
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
          <?= $form->field($model, 'pla_catatan', ['options' => ['class' => 'form-group custom-margin']])->textarea(['class' => 'form-control form-control-sm', 'placeholder' => '....', 'type' => 'text', 'rows' => 5])->label(false); ?>
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
          if (!$model->pla_batal) {
            if (!$model->pla_final) {
              echo $form->field($model, 'pla_final')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Final', 'handleWidth' => 50,
                  'offText' => 'Draf',
                  'onColor' => 'success',
                  'offColor' => 'danger',
                ]
              ])->label(false);
            } else {
              echo $form->field($model, 'pla_batal')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Batal',
                  'offText' => 'Non-batal',
                  'onColor' => 'danger',
                  'offColor' => 'success',
                ]
              ])->label(false);
            }
            echo Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->pla_id]);
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            if (!$model->pla_final) {
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-trash-alt"></i> Hapus']), ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/pasca-lokal-anestesi/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->pla_id])]);
            }
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/pasca-lokal-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          } else {
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/pasca-lokal-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          }
          // echo Html::button(Yii::t('app', '{title}', ['title' => (($model->pla_batal) ? 'NB:Doc.Batal' : (($model->pla_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>