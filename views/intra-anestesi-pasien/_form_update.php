<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\bedahsentral\Log;
use app\components\HelperSpesial;
use yii\helpers\Url;
use app\components\HelperGeneral;
use app\models\bedahsentral\IntraAnestesi;
use app\models\bedahsentral\MedikasiIntraAnestesi;
use app\models\bedahsentral\CairanMasukIntraAnestesi;
use app\models\bedahsentral\CairanKeluarIntraAnestesi;
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->
<?php
$this->registerJs($this->render('_form_update_ready.js'));
$url = Yii::$app->homeUrl;
?>

<?php
$form = ActiveForm::begin([
  'id' => 'mia'
]); ?>
<?= $form->field($model, 'mia_to_id')->hiddenInput()->label(false); ?>
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
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          if (!$model->mia_batal) {
            if (!$model->mia_final) {
              echo $form->field($model, 'mia_final')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Final','handleWidth' => 50,
                  'offText' => 'Draf',
                  'onColor' => 'success',
                  'offColor' => 'danger',
                ]
              ])->label(false);
            } else {

              echo $form->field($model, 'mia_batal')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Batal',
                  'offText' => 'Non-batal',
                  'onColor' => 'danger',
                  'offColor' => 'success',
                ]
              ])->label(false);
            }
            echo Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->mia_id]);
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            if (!$model->mia_final) {
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-trash-alt"></i> Hapus']), ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/intra-anestesi-pasien/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->mia_id])]);
            }
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/intra-anestesi-pasien/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          } else {
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/intra-anestesi-pasien/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          }
          // echo Html::button(Yii::t('app', '{title}', ['title' => (($model->mia_batal) ? 'NB:Doc.Batal' : (($model->mia_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>
<?php
$intra = IntraAnestesi::find()->where(['mia_id' => $model->mia_id])->one();
if (!empty($intra)) {
?>

  <div class="col-lg-11">
    <h5 class="text-left bg-lightblue">MEDIKASI</h5>
    <?= $this->render('_form_medikasi', ['model' => $modelmedikasi, 'id' => $intra->mia_id]); ?>
    <table class="table table-sm table-form" id="tbl-medikasi">
      <tr>
        <td style="width: 10%;"><b>Jam</b></td>
        <?php
        $jam = MedikasiIntraAnestesi::find()->where(['mmia_intra_anestesi_mia_id' => $intra->mia_id])->all();
        foreach ($jam as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->mmia_waktu ?></span></td>
        <?php } ?>

      </tr>
      <tr>
        <td><b>Nama Obat</b></td>
        <?php
        foreach ($jam as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->mmia_nama_obat ?></span></td>
        <?php } ?>
      </tr>
    </table>
    <br><br>


    <h5 class="text-left bg-lightblue">CAIRAN MASUK</h5>
    <?= $this->render('_form_cairan_masuk', ['model' => $modelcairanmasuk, 'id' => $intra->mia_id]);  ?>
    <table class="table table-sm table-form" id="tbl-cairan-masuk">
      <tr>
        <td style="width: 10%;"><b>Jam</b></td>
        <?php $masuk = CairanMasukIntraAnestesi::find()->where(['cmasuk_intra_operasi_mia_id' => $intra->mia_id])->all();
        foreach ($masuk as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->cmasuk_waktu ?></span></td>
        <?php } ?>
      </tr>
      <tr>
        <td><b>Nama Obat</b></td>
        <?php
        foreach ($masuk as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->cmasuk_cairan_nama . "<b>(" . $val->cmasuk_jumlah . ")</b>" ?></span></td>
        <?php } ?>

      </tr>
    </table>
    <br><br>


    <h5 class="text-left bg-lightblue">CAIRAN KELUAR</h5>
    <?= $this->render('_form_cairan_keluar', ['model' => $modelcairankeluar, 'id' => $intra->mia_id]);  ?>
    <table class="table table-sm table-form" id="tbl-cairan-keluar">

      <tr>
        <?php $keluar =  CairanKeluarIntraAnestesi::find()->where(['ckeluar_intra_operasi_mia_id' => $intra->mia_id])->all(); ?>
        <td style="width: 10%;"><b>Jam</b></td>
        <?php foreach ($keluar as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->ckeluar_waktu ?></span></td>
        <?php } ?>
      </tr>
      <tr>
        <td><b>Nama Obat</b></td>
        <?php foreach ($keluar as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->ckeluar_cairan_nama . "<b>(" . $val->ckeluar_jumlah . ")</b>" ?></span></td>
        <?php } ?>
      </tr>
    </table>
    <br><br>



    <!-- <h5 class="text-left bg-lightblue">MONITORING ANESTESI</h5>

    <table width="100%" cellspacing="0">
      <tr>
        <td>
          <?php //echo $this->render('_form_ttv', ['model' => $modelttv, 'id' => $intra->mia_id]); ?>
        </td>
      </tr>
    </table>
    <canvas id="myChart" style="width:100%;"></canvas> -->

  </div>
<?php } ?>