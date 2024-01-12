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
  }
</style>
<?php
$this->registerJs($this->render('_form_create_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'pcok'
]); ?>
<?= $form->field($model, 'pcok_to_id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'pcok_batal')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <table class="table table-sm table-form">
      <tr>
        <th colspan="5" class="text-center bg-lightblue">CHECK LIST KESELAMATAN PASIEN DIKAMAR OPERASI</th>
      </tr>
      <tr>
        <th>SEBELUM INDUKSI ANESTESI<br><i>(SIGN IN)</i></th>
        <th>==></th>
        <th>SEBELUM INSISI <br> <i>(TIME OUT)</i></th>
        <th>==></th>
        <th>SEBELUM MENUTUP LUKA & <br>MENINGGALKAN KAMAR OPOERASI <br> <i>(SIGN OUT)</i></th>
      </tr>
      <tr>
        <td>
          <b>Minimal Perawat & Ahli Anestesi</b>
          <p>1. Apakah identitas pasien sudah benar, rencana tindakan sudah jelas, dan ada persetujuan tindakan medis yang akan dilakukan (Inform Concern) ?
            <?php
            $pcok_si_pertanyaan1 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan1', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan1)->label(false);
            $pcok_si_pertanyaan1 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan1, $model->pcok_si_pertanyaan1);
            ?>
          </p>
          <p>2. Apakah area yang akan dioperasi sudah diberi tanda ?
            <?php
            $pcok_si_pertanyaan2 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan2', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan2)->label(false);
            $pcok_si_pertanyaan2 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan2, $model->pcok_si_pertanyaan2);
            ?>
          </p>
          <p>
            3. Apakah mesin anestesi dan obat-obatan sudah lengkap ?
            <?php
            $pcok_si_pertanyaan3 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan3', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan3)->label(false);
            $pcok_si_pertanyaan3 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan3, $model->pcok_si_pertanyaan3);
            ?>
          </p>
          <p>
            4. Apakah pasien sudah memakai <i>pulse</i> oksimetri dan sudah berfungsi baik ?
            <?php
            $pcok_si_pertanyaan4 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan4', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan4)->label(false);
            $pcok_si_pertanyaan4 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan4, $model->pcok_si_pertanyaan4);
            ?>
          </p>
          <p>
            5. Apakah pasien memiliki riwayat alergi ?
            <?php
            $pcok_si_pertanyaan5 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan5', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan5)->label(false);
            $pcok_si_pertanyaan5 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan5, $model->pcok_si_pertanyaan5);
            ?>
          </p>
          <p>
            6. Apakah pasien memiliki gangguan pernafasan ?
            <?php
            $pcok_si_pertanyaan6 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan6', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan6)->label(false);
            $pcok_si_pertanyaan6 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan6, $model->pcok_si_pertanyaan6);
            ?>
          </p>
          <p>
            7. Resiko perdarahan > 500 ml (7ml/kg bagi pasien anak)?
            <?php
            $pcok_si_pertanyaan7 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan7', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan7)->label(false);
            $pcok_si_pertanyaan7 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan7, $model->pcok_si_pertanyaan7);
            ?>
          </p>
          <p>
            8. Apakah implant sudah tersedia ?
            <?php
            $pcok_si_pertanyaan8 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan8', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan8)->label(false);
            $pcok_si_pertanyaan8 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan8, $model->pcok_si_pertanyaan8);
            ?>
          </p>
        </td>
        <td></td>
        <td>
          <b>Dengan Perawat, dr. Anestesi dan dr. Bedah</b>
          <p>
            1. Memastikan bahwa semua anggota tim medis sudah memperkenalkan diri (nama & peran)
            <?php
            $pcok_to_pertanyaan1 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan1', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan1)->label(false);
            $pcok_to_pertanyaan1 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan1, $model->pcok_to_pertanyaan1);
            ?>
          </p>
          <p>
            2. Memastikan dan membaca ulang nama pasien, tindakan medis dan area yang akan diinsisi
            <?php
            $pcok_to_pertanyaan2 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan2', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan2)->label(false);
            $pcok_to_pertanyaan2 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan2, $model->pcok_to_pertanyaan2);
            ?>
          </p>
          <p>
            3. Apakah antibiotik profilaksisi sudah diberikan 1 jam sebelumnya ?
            <?php
            $pcok_to_pertanyaan3 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan3', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan3)->label(false);
            $pcok_to_pertanyaan3 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan3, $model->pcok_to_pertanyaan3);
            ?>
          </p>
          <b>Kejadian beresiko yang perlu diantisipasi untuk dr. Bedah:</b>
          <p>
            1. Apakah tindakan beresiko atau tindakan tidak rutin yang akan dilakukan
            <?php
            $pcok_to_pertanyaan4 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan4', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan4)->label(false);
            $pcok_to_pertanyaan4 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan4, $model->pcok_to_pertanyaan4);
            ?>
          </p>
          <p>
            2. Berapa lama tindakan ini akan dikerjakan ?
            <?= $form->field($model, 'pcok_to_pertanyaan5', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.......'])->label(false); ?>
          </p>
          <p>
            3. Apakah sudah diantisipasi pendarahan ?
            <?php
            $pcok_to_pertanyaan6 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan6', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan6)->label(false);
            $pcok_to_pertanyaan6 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan6, $model->pcok_to_pertanyaan6);
            ?>
          </p>
          <b>Untuk dr . Anestesi</b>
          <p>
            Apakah ada hal khusus untuk pasien?
            <?php
            $pcok_to_pertanyaan7 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan7', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan7)->label(false);
            $pcok_to_pertanyaan7 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan7, $model->pcok_to_pertanyaan7);
            ?>
          </p>
          <b>Untuk tim perawat</b>
          <p>
            1. Apakah ada masalah dengan peralatan atau masalah alat yang dikhawatirkan?
            <?php
            $pcok_to_pertanyaan8 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan8', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan8)->label(false);
            $pcok_to_pertanyaan8 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan8, $model->pcok_to_pertanyaan8);
            ?>
          </p>
          <p>
            2. Apakah sterilitas sudah dikonfirmasi berdasarkan indikator alat sterilisasi?
            <?php
            $pcok_to_pertanyaan9 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan9', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan9)->label(false);
            $pcok_to_pertanyaan9 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan9, $model->pcok_to_pertanyaan9);
            ?>
          </p>
          <p>
            3. Apakah hasil radiologi yang diperlukan sudah ada?
            <?php
            $pcok_to_pertanyaan10 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan10', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan10)->label(false);
            $pcok_to_pertanyaan10 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan10, $model->pcok_to_pertanyaan10);
            ?>
          </p>
        </td>
        <td></td>
        <td>
          <b>Dengan Perawat, dr. Anestesi dan dr. Bedah secara verbal perawat memastikan</b>
          <p>
            1. Nama tindakan?
            <?php
            $pcok_so_pertanyaan1 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_so_pertanyaan1', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_so_pertanyaan1)->label(false);
            $pcok_so_pertanyaan1 = HelperGeneral::getValueCustomRadio($pcok_so_pertanyaan1, $model->pcok_so_pertanyaan1);
            ?>

          </p>
          <p>
            2. Kelengkapan alat, jumlah kasa dan jarum/alat lain?

            <?php
            $pcok_so_pertanyaan2 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_so_pertanyaan2', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_so_pertanyaan2)->label(false);
            $pcok_so_pertanyaan2 = HelperGeneral::getValueCustomRadio($pcok_so_pertanyaan2, $model->pcok_so_pertanyaan2);
            ?>
          </p>
          <p>
            3. Pelabelan spesimen (baca label spesimen dan nama pasien dengan keras)

            <?php
            $pcok_so_pertanyaan3 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_so_pertanyaan3', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_so_pertanyaan3)->label(false);
            $pcok_so_pertanyaan3 = HelperGeneral::getValueCustomRadio($pcok_so_pertanyaan3, $model->pcok_so_pertanyaan3);
            ?>
          </p>
          <p>
            4. Apakah ada masalah dengan peralatan yang perlu disampaikan ?

            <?php
            $pcok_so_pertanyaan4 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_so_pertanyaan4', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_so_pertanyaan4)->label(false);
            $pcok_so_pertanyaan4 = HelperGeneral::getValueCustomRadio($pcok_so_pertanyaan4, $model->pcok_so_pertanyaan4);
            ?>
          </p>
          <b>Untuk dr. Bedah, dr. Anestesi dan Perawat:</b>
          <p>
            Apakah ada catatan khusus untuk proses pemulihan dan penanganan perawatan pasien ?

            <?php
            $pcok_so_pertanyaan5 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_so_pertanyaan5', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_so_pertanyaan5)->label(false);
            $pcok_so_pertanyaan5 = HelperGeneral::getValueCustomRadio($pcok_so_pertanyaan5, $model->pcok_so_pertanyaan5);
            ?>
          </p>
        </td>
      </tr>
    </table>
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'pcok_final')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini',
              'onText' => 'Final','handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <?= Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/check-list-keselamatan-ok-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>