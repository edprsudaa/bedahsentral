<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\bedahsentral\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use app\models\bedahsentral\PostAnestesi;
use app\models\bedahsentral\TimOperasi;
use yii\web\View;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPreOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
<style type="text/css">
  .bedah {
    width: 33%;
    float: left;
    text-align: center;
  }

  .bedah p {
    padding-bottom: 50px;
  }

  #pengkajian {
    border-top: 2px solid;
    border-bottom: 2px solid;
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
    border: 0px;
  }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<?php
$this->registerJs($this->render('_form_update_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'mpa'
]); ?>
<?= $form->field($model, 'mpa_to_id')->hiddenInput()->label(false); ?>
<?php
// echo $form->field($model, 'mpa_base64')->hiddenInput(['id' => 'post-base64'])->label(false);
?>
<div class="row">
  <div class="col-lg-11">
    <table class="table table-sm table-form">
      <tr>
        <th class="text-left bg-lightblue" colspan="3">POST ANESTESI</th>
      </tr>
      <tr>
        <td style="width: 20%;"><label><?= $model->getAttributeLabel('mpa_jam_tiba_diruang_pemulihan') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_jam_tiba_diruang_pemulihan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'type' => 'time'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_keluar_jam') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_keluar_jam', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'type' => 'time'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_jenis_tools_digunakan') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_jenis_tools_digunakan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '....', 'type' => 'text'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_skor_tools') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_skor_tools', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '....', 'type' => 'number'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <th class="text-left bg-lightblue" colspan="3">Instruksi Post Operasi</th>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_awasi') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $mpa_instruksi_awasi = ['Ku' => 'Ku', 'TD' => 'TD', 'HR' => 'HR', 'RR' => 'RR', 'S dan Pendarahan' => 'S dan Pendarahan'];
          echo $form->field($model, 'mpa_instruksi_awasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mpa_instruksi_awasi)->label(false);
          $mpa_instruksi_awasi = HelperGeneral::getValueCustomRadio($mpa_instruksi_awasi, $model->mpa_instruksi_awasi);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_posisi') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $mpa_instruksi_posisi = ['Telentang' => 'Telentang', 'Tengkurap' => 'Tengkurap', 'Lithotomi' => 'Lithotomi'];
          echo $form->field($model, 'mpa_instruksi_posisi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mpa_instruksi_posisi)->label(false);
          $mpa_instruksi_posisi = HelperGeneral::getValueCustomRadio($mpa_instruksi_posisi, $model->mpa_instruksi_posisi);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_makan_minum') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_instruksi_makan_minum', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_infus') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_instruksi_infus', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_transfusi') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_instruksi_transfusi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_program_analgetik') ?></label> </td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_instruksi_program_analgetik', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_program_mual_muntah') ?></label> </td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_instruksi_program_mual_muntah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_lain_lain') ?></label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'mpa_instruksi_lain_lain', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....', 'rows' => 4])->label(false); ?>
        </td>
      </tr>
    </table>

  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          if (!$model->mpa_batal) {
            if (!$model->mpa_final) {
              echo $form->field($model, 'mpa_final')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Final','handleWidth' => 50,
                  'offText' => 'Draf',
                  'onColor' => 'success',
                  'offColor' => 'danger',
                ]
              ])->label(false);
            } else {
              echo $form->field($model, 'mpa_batal')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Batal',
                  'offText' => 'Non-batal',
                  'onColor' => 'danger',
                  'offColor' => 'success',
                ]
              ])->label(false);
            }
            echo Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->mpa_id]);
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            if (!$model->mpa_final) {
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-trash-alt"></i> Hapus']), ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/post-anestesi-pasien/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->mpa_id])]);
            }
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/post-anestesi-pasien/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          } else {
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/post-anestesi-pasien/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          }
          // echo Html::button(Yii::t('app', '{title}', ['title' => (($model->mpa_batal) ? 'NB:Doc.Batal' : (($model->mpa_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>