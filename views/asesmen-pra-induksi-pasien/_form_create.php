<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\medis\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
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

  th {
    text-align: center;
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
    border: 0px;
  }

  .samping {
    width: 5%;
  }
</style>
<?php
$this->registerJs($this->render('_form_create_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'api'
]); ?>
<?= $form->field($model, 'api_to_id')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <?php $timoperasi = TimOperasi::find()->where(['to_id' => $model->api_to_id])->all(); ?>
    <table class="table table-sm table-form">
      <tr>
        <td colspan="2" style="width: 15%;"><label>Nama Dokter Anestesi</label></td>
        <td><label>:</label></td>
        <td colspan="4" style="width: 35%;">
          <?php
          $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->api_to_id, 'tod_jo_id' => 2])->all();

          foreach ($detail as $val) {
            echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
          }
          ?>
        </td>
        <td colspan="2" style="width: 15%;"><label>Rencana Tindakan</label></td>
        <td><label>:</label></td>
        <td colspan="4" style="width: 35%;">
          <?php
          foreach ($timoperasi as $val) {
            echo $val->to_tindakan_operasi . "</br>";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="2"><label>Diagnosa Medis</label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?php
          foreach ($timoperasi as $val) {
            echo $val->to_diagnosa_medis_pra_bedah . "<br>";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="2"><label>Tanggal</label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?php
          foreach ($timoperasi as $val) {
            echo \Yii::$app->formatter->asDate($val->to_tanggal_operasi);
          }
          ?>
        </td>
        <td colspan="2"><label>Lokasi</label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?php
          foreach ($timoperasi as $val) {
            echo $val->unit->nama;
          }
          ?>
        </td>
      </tr>
    </table>

    <table class="table table-sm table-form">
      <tr>
        <th class="text-left bg-lightblue" colspan="13">ASESMEN PRA INDUKSI</th>
      </tr>
      <tr>
        <th class="text-left" colspan="13">Riwayat Penyakit</th>
      </tr>
      <tr>
        <td class="samping"></td>
        <td style="width: 20%;"><label><?= $model->getAttributeLabel('api_kesadaran') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?php
          echo $form->field($model, 'api_kesadaran', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '...................'])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_td') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?php
          echo $form->field($model, 'api_td', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......./......... mmHg'])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_hr') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?php
          echo $form->field($model, 'api_hr', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '................ x/mnt'])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_rr') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?php
          echo $form->field($model, 'api_rr', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '................ x/mnt'])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_temp') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?php
          echo $form->field($model, 'api_temp', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '................ C'])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_gol_darah') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?php
          echo $form->field($model, 'api_gol_darah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '.......... Hb :..... g/dl'])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="2"><label><?= $model->getAttributeLabel('api_puasa') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_puasa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'style' => 'width:10%', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" class="text-left">Akses Infus</th>
        <td><label>:</label></td>
        <td><label>No. IV LINE</label></td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_infus_tangan_kanan') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_infus_tangan_kanan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......................................'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_infus_tangan_kiri') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_infus_tangan_kiri', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......................................'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_infus_kaki_kanan') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_infus_kaki_kanan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......................................'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_infus_kaki_kiri') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_infus_kaki_kiri', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......................................'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <th colspan="2" class="text-left">Akses Lain</th>
        <td><label>:</label></td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_ngt') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_ngt', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......................................'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_kateter') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_kateter', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......................................'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_drain') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_drain', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......................................'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_cvp') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_cvp', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......................................'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td class="samping"></td>
        <td><label><?= $model->getAttributeLabel('api_lain_lain') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'api_lain_lain', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'style' => 'width:50%', 'placeholder' => '......................................'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td colspan="2"><label><?= $model->getAttributeLabel('api_status_asa') ?></label> </td>
        <td><label>:</label></td>
        <td>
          <?php
          $api_status_asa = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', 'E' => 'E'];
          echo $form->field($model, 'api_status_asa', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($api_status_asa)->label(false);
          $api_status_asa = HelperGeneral::getValueCustomRadio($api_status_asa, $model->api_status_asa);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="2"><label><?= $model->getAttributeLabel('api_rencana_tindakan_anestesi') ?></label> </td>
        <td><label>:</label></td>
        <td>
          <?php
          $api_rencana_tindakan_anestesi = [
            'General: Intubasi' => 'General: Intubasi',
            'General: Tiva' => 'General: Tiva',
            'General: LMA' => 'General: LMA',
            'General: Face Mask' => 'General: Face Mask',
            'Regional: Spinal' => 'Regional: Spinal',
            'Regional: Epidural' => 'Regional: Epidural',
            'Regional: Blok' => 'Regional: Blok'
          ];

          echo $form->field($model, 'api_rencana_tindakan_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList($api_rencana_tindakan_anestesi)->label(false);
          ?>
        </td>
      </tr>

    </table>
    <!-- <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-info"></i> Info!</h5>
      Simpan draf(Non final) terlebih dahulu untuk mengisi pemberian obat premedikasi.
    </div> -->
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'api_final')->widget(SwitchInput::classname(), [
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

          <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/asesmen-pra-induksi-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>