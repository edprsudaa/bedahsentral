<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\bedahsentral\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use app\models\bedahsentral\IntraAnestesi;
use app\models\bedahsentral\MedikasiIntraAnestesi;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
use dosamigos\chartjs\ChartJs;
use dosamigos\highcharts\HighCharts;
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

  #obat {
    writing-mode: tb-rl;
    transform: rotate(180deg);
  }

  #pengkajian {
    border-top: 2px solid;
    border-bottom: 2px solid;
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
  }
</style>
<?php
$this->registerJs($this->render('_form_create_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'mia'
]); ?>
<?= $form->field($model, 'mia_to_id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'mia_batal')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <?php $timoperasi = TimOperasi::find()->where(['to_id' => $model->mia_to_id])->all(); ?>
    <table class="table table-sm table-form">
      <tr style="border:0px;">
        <td style="width: 15%;"></td>
        <td></td>
        <td style="width: 10%;"></td>
        <td></td>
        <td></td>
        <td style="width: 15%;"></td>
        <td></td>
      </tr>
      <tr>
        <th class="text-left bg-lightblue" colspan="7">INTRA ANESTESI</th>
      </tr>
      <tr>
        <td><label>Dokter anestesi:</label></td>
        <td>
          <?php
          $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->mia_to_id, 'tod_jo_id' => 2])->all();
          if ($detail) {
            foreach ($detail as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
            }
          } else {
            echo "Belum diinput";
          }

          ?>
        </td>
        <td><label>Dokter Operator:</label></td>
        <td colspan="2">
          <?php
          $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->mia_to_id, 'tod_jo_id' => 1])->all();
          if ($detail) {
            foreach ($detail as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
        <td colspan="2"><b>OK:</b></td>
      </tr>

      <tr>
        <td rowspan="2"><label>Penata Anestesi:</label></td>
        <td rowspan="2">
          <?php
          $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->mia_to_id, 'tod_jo_id' => 5])->all();
          $no = 1;
          if ($detail) {
            foreach ($detail as $val) {
              echo $no++ . '. ' . HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
        <td rowspan="2"><label>Asisten:</label></td>
        <td colspan="2" rowspan="2">
          <?php
          $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->mia_to_id, 'tod_jo_id' => 3])->all();
          $no = 1;
          if ($detail) {
            foreach ($detail as $val) {
              echo $no++ . '. ' . HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
            }
          } else {
            echo "Belum diinput";
          }
          ?>
        </td>
        <td><label><?= $model->getAttributeLabel('mia_jam_mulai_anestesi') ?> :</label></td>
        <td>
          <?= $form->field($model, 'mia_jam_mulai_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '.......'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mia_jam_mulai_operasi') ?> :</label></td>
        <td>
          <?= $form->field($model, 'mia_jam_mulai_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '.......'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mia_premedikasi') ?> :</label></td>
        <td colspan="4">
          <?= $form->field($model, 'mia_premedikasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.......'])->label(false); ?>
        </td>
        <td><label><?= $model->getAttributeLabel('mia_jam_berakhir_operasi') ?> :</label></td>
        <td>
          <?= $form->field($model, 'mia_jam_berakhir_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '.......'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mia_jam') ?> :</label></td>
        <td colspan="4">
          <?= $form->field($model, 'mia_jam', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '.......'])->label(false); ?>
        </td>
        <td><label><?= $model->getAttributeLabel('mia_jam_berakhir_anestesi') ?> :</label></td>
        <td>
          <?= $form->field($model, 'mia_jam_berakhir_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '.......'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mia_posisi_operasi') ?> :</label></td>
        <td colspan="6">
          <?= $form->field($model, 'mia_posisi_operasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Terlentang' => 'Terlentang',
            'Tengkurap' => 'Tengkurap',
            'Laterak kanan' => 'Laterak kanan',
            'Laterak kiri' => 'Laterak kiri',
            'Litotomy' => 'Litotomy',
            'Lumbotomy' => 'Lumbotomy',
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mia_teknik_anestesi') ?> :</label></td>
        <td colspan="6">
          <?= $form->field($model, 'mia_teknik_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            // 'Anestesi umum' => 'Anestesi umum',
            'Ventilator' => 'Ventilator',
            'TIVA:LMA/MASKER' => 'TIVA:LMA/MASKER',
            'Spinal' => 'Spinal',
            'Epidural' => ' Epidural',
            // 'kaudal' => 'kaudal',
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mia_jalan_nafas') ?> :</label></td>
        <td colspan="6">
          <?php
          $mia_jalan_nafas = ['ETT' => 'ETT', 'NT' => 'NT', 'Masker muka' => 'Masker muka', 'LMA' => 'LMA'];
          echo $form->field($model, 'mia_jalan_nafas', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mia_jalan_nafas)->label(false);
          $mia_jalan_nafas = HelperGeneral::getValueCustomRadio($mia_jalan_nafas, $model->mia_jalan_nafas);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('mia_pengaturan_nafas') ?> :</label></td>
        <td colspan="6">
          <?php
          $mia_pengaturan_nafas = ['Spontan' => 'Spontan', 'Asistet' => 'Asistet', 'Kontrol' => 'Kontrol'];
          echo $form->field($model, 'mia_pengaturan_nafas', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mia_pengaturan_nafas)->label(false);
          $mia_pengaturan_nafas = HelperGeneral::getValueCustomRadio($mia_pengaturan_nafas, $model->mia_pengaturan_nafas);
          ?>
        </td>
      </tr>
    </table>

    <div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-info"></i> Info!</h5>
      Simpan draf(Non final) terlebih dahulu untuk mengisi obat intra anestesi.
    </div>
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'mia_final')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini', //mini atau large
              'onText' => 'Final','handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <?= Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/intra-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>