<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;
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
$this->registerJs($this->render('_form_update_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'pcok'
]); ?>
<?= $form->field($model, 'pcok_to_id')->hiddenInput()->label(false); ?>
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
          <p>1. Sudahkah pasien mengkonfirmasi identitas, lokasi, prosedur, dan persetujuannya?
            <?php
            $pcok_si_pertanyaan1 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan1', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan1)->label(false);
            $pcok_si_pertanyaan1 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan1, $model->pcok_si_pertanyaan1);
            ?>
          </p>
          <p>2. Apakah lokasi operasi sudah ditandai?
            <?php
            $pcok_si_pertanyaan2 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan2', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan2)->label(false);
            $pcok_si_pertanyaan2 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan2, $model->pcok_si_pertanyaan2);
            ?>
          </p>
          <p>
            3. Apakah mesin anestesi & pemeriksaan obat lengkap?
            <?php
            $pcok_si_pertanyaan3 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_si_pertanyaan3', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_si_pertanyaan3)->label(false);
            $pcok_si_pertanyaan3 = HelperGeneral::getValueCustomRadio($pcok_si_pertanyaan3, $model->pcok_si_pertanyaan3);
            ?>
          </p>
          <p>
            4. Apakah pulse oxymeter terpasang pada pasien dan berfungsi ?
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
          <b>Dengan Perawat, dr. Anestesi dan dr. Bedah ya/tidak</b>
          <p>
            1. Konfirmasikan semua anggota tim perkenalkan diri dengan nama dan peran.
            <?php
            $pcok_to_pertanyaan1 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan1', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan1)->label(false);
            $pcok_to_pertanyaan1 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan1, $model->pcok_to_pertanyaan1);
            ?>
          </p>
          <p>
            2. Konfirmasikan nama pasien, prosedur, dan lokasi operasi.
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
          <b>Kejadian beresiko yang perlu diantisipasi untuk dr. bedah:</b>
          <p>
            1. Apa langkah-langkah kritis atau non-rutin?
            <?php
            $pcok_to_pertanyaan4 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan4', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan4)->label(false);
            $pcok_to_pertanyaan4 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan4, $model->pcok_to_pertanyaan4);
            ?>
          </p>
          <p>
            2. Berapa lama waktu operasi yang dibutuhkan?
            <?= $form->field($model, 'pcok_to_pertanyaan5', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.......'])->label(false); ?>
          </p>
          <p>
            3. Apakah sudah antisipasi pendarahan ?
            <?php
            $pcok_to_pertanyaan6 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan6', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan6)->label(false);
            $pcok_to_pertanyaan6 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan6, $model->pcok_to_pertanyaan6);
            ?>
          </p>
          <b>Untuk dr . Anestesi</b>
          <p>
            Apakah ada kekhawatiran yang jadi perhatian khusus pada pasien?
            <?php
            $pcok_to_pertanyaan7 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan7', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan7)->label(false);
            $pcok_to_pertanyaan7 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan7, $model->pcok_to_pertanyaan7);
            ?>
          </p>
          <b>Untuk tim perawat</b>
          <p>
            1. Apakah sterilitas sesuai dengan indikator?
            <?php
            $pcok_to_pertanyaan8 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan8', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan8)->label(false);
            $pcok_to_pertanyaan8 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan8, $model->pcok_to_pertanyaan8);
            ?>
          </p>
          <p>
            2. Apakah ada masalah peralatan yang harus diperhatikan?
            <?php
            $pcok_to_pertanyaan9 = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];
            echo $form->field($model, 'pcok_to_pertanyaan9', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pcok_to_pertanyaan9)->label(false);
            $pcok_to_pertanyaan9 = HelperGeneral::getValueCustomRadio($pcok_to_pertanyaan9, $model->pcok_to_pertanyaan9);
            ?>
          </p>
          <p>
            3. Apakah Foto Rontgen/CT-Scan/MRI perlu ditampilkan?
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
          <b>Untuk dr anestesi dan perawat:</b>
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
          if (!$model->pcok_batal) {
            if (!$model->pcok_final) {
              echo $form->field($model, 'pcok_final')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Final','handleWidth' => 50,
                  'offText' => 'Draf',
                  'onColor' => 'success',
                  'offColor' => 'danger',
                ]
              ])->label(false);
            } else {

              echo $form->field($model, 'pcok_batal')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Batal',
                  'offText' => 'Non-batal',
                  'onColor' => 'danger',
                  'offColor' => 'success',
                ]
              ])->label(false);
            }
            echo Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->pcok_id]);
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            if (!$model->pcok_final) {
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-trash-alt"></i> Hapus']), ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/check-list-keselamatan-ok-pasien/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->pcok_id])]);
            }
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/check-list-keselamatan-ok-pasien/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
            if ($model->pcok_final) {
              echo Html::button('<i class="fas fa-print"></i> Print', ['class' => 'btn btn-danger btn-cetak', 'data-id' => Yii::$app->request->get('subid')]);
              // echo Html::a('<i class="fas fa-print"></i> Print', null, [
              //   'class' => 'btn btn-danger btn-cetak',
              //   'data-id' => Yii::$app->request->get('subid'),
              // ]);
            }
          } else {
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/check-list-keselamatan-ok-pasien/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          }
          // echo Html::button(Yii::t('app', '{title}', ['title' => (($model->pcok_batal) ? 'NB:Doc.Batal' : (($model->pcok_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>