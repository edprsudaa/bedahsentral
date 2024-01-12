<?php

use app\components\HelperGeneral;
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
  th {
    text-align: center;
  }

  .bord th,
  .bord td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
    border: 0px;
  }

  .berr th,
  .berr td {
    border-color: black;
    border-style: solid;
    border-width: 3px;
  }
</style>
<?php
$this->registerJs($this->render('_form_update_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'pas'
]); ?>
<?= $form->field($model, 'pas_to_id')->hiddenInput()->label(false); ?>
<?php
// echo $form->field($model, 'pas_base64')->hiddenInput(['id' => 'post-base64'])->label(false);
?>
<div class="row">
  <div class="col-lg-11">
    <table class="table table-sm table-form bord">
      <tr>
        <td colspan="6" align="center"><label></label></td>
      </tr>
      <tr>
        <td colspan="6"><label>
            <h6><b>C. PASCA ANESTESI</b></h6>
          </label></td>
      </tr>
      <tr>
        <td colspan="6">
          Ruang Pemulihan
        </td>
      </tr>
      <tr>
        <td style="width: 14%;"><label>Jam masuk</label></td>
        <td style="width: 1%;"><label>:</label></td>
        <td style="width: 130px;">
          <?= $form->field($model, 'pas_jam_masuk', ['options' => ['class' => 'form-group custom-margin', 'style' => 'width:100px']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
        <td style="width: 14%;"><label>Jam keluar</label></td>
        <td style="width: 1%;"><label>:</label></td>
        <td>
          <?= $form->field($model, 'pas_jam_keluar', ['options' => ['class' => 'form-group custom-margin', 'style' => 'width:100px']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <label>
            I. Pernafasan
          </label>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <?= $form->field($model, 'pas_pernafasan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Nafas Spontan' => 'Nafas Spontan',
            'Alat bantu nafas' => 'Alat bantu nafas',
            'Retraksi dada' => 'Retraksi dada',
            'Bantu Oksigen' => 'Bantu Oksigen',
            'Canul' => 'Canul',
            'Ya' => 'Ya',
            'Tidak' => 'Tidak',
            'NRM' => 'NRM',
          ])->label(false);
          ?>
          <?php
          // $pas_pernafasan = [
          //   'Nafas Spontan' => 'Nafas Spontan',
          //   'Alat bantu nafas' => 'Alat bantu nafas',
          //   'Retraksi dada' => 'Retraksi dada',
          //   'Bantu Oksigen' => 'Bantu Oksigen',
          //   'Canul' => 'Canul',
          //   'Ya' => 'Ya',
          //   'Tidak' => 'Tidak',
          //   'NRM' => 'NRM',
          // ];
          // echo $form->field($model, 'pas_pernafasan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pas_pernafasan)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td>
          Pernafasan
        </td>
        <td>:</td>
        <td>
          <?= $form->field($model, 'pas_pernafasan1', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '............... x/menit'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <label>
            Pola Nafas
          </label>
        </td>
      </tr>
      <tr>
        <td colspan="6">
          <?= $form->field($model, 'pas_pola_nafas', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Normal' => 'Normal',
            'Retraksi dada' => 'Retraksi dada',
            'Tidak normal' => 'Tidak normal',
            'Ya' => 'Ya',
            'Tidak' => 'Tidak',
          ])->label(false);
          ?>
          <?php
          // $pas_pola_nafas = [
          //   'Normal' => 'Normal',
          //   'Retraksi dada' => 'Retraksi dada',
          //   'Tidak normal' => 'Tidak normal',
          //   'Ya' => 'Ya',
          //   'Tidak' => 'Tidak',
          // ];
          // echo $form->field($model, 'pas_pola_nafas', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($pas_pola_nafas)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td>
          SPO2
        </td>
        <td>:</td>
        <td>
          <?= $form->field($model, 'pas_spo2', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '............... %'])->label(false); ?>
        </td>
      </tr>
    </table>

    <table class="bord">
      <tr>
        <td colspan="6">
          <label>
            II. Sirkulasi
          </label>
        </td>
      </tr>
      <tr>
        <td><label>TD:</label></td>
        <td>
          <?= $form->field($model, 'pas_td', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... Mmhg'])->label(false); ?>
        </td>

        <td><label>Nadi:</label></td>
        <td>
          <?= $form->field($model, 'pas_nadi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... x/mnt'])->label(false); ?>
        </td>

        <td><label>Suhu:</label></td>
        <td>
          <?= $form->field($model, 'pas_suhu', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... C'])->label(false); ?>
        </td>
      </tr>
    </table>

    <table class="table table-sm table-form berr">
      <tr>
        <td colspan="3" class="text-center">
          <label style="font-size: 13pt;">MASALAH KESEHATAN</label>
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <?= $form->field($model, 'pas_masalah_kesehatan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Nyeri' => 'Nyeri',
            'Shok' => 'Shok',
            'PK Disfungsi Kardiovaskuler' => 'PK Disfungsi Kardiovaskuler',
            'PK Disfungsi Respirasi' => 'PK Disfungsi Respirasi',
            'Disfungsi Thermoregulasi' => 'Disfungsi Thermoregulasi',
            'Resiko Jatuh' => 'Resiko Jatuh',
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td class="text-center">
          <label style="font-size: 13pt;">INTERVENSI</label>
        </td>
        <td class="text-center">
          <label style="font-size: 13pt;">IMPLEMENTASI</label>
        </td>
        <td class="text-center">
          <label style="font-size: 13pt;">EVALUASI</label>
        </td>
      </tr>
      <tr>
        <td>
          <?= $form->field($model, 'pas_intervensi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Kaji tingkat nyeri' => 'Kaji tingkat nyeri',
            'Observasi tanda vital' => 'Observasi tanda vital',
            'Atur posisi sesuai kebutuhan pasien' => 'Atur posisi sesuai kebutuhan pasien',
            'Kolaborasi pemberian Analgetik' => 'Kolaborasi pemberian Analgetik',
            'Kolaborasi pemberian Anti Emetik' => 'Kolaborasi pemberian Anti Emetik',
            'Berikan blanket warmer pasien' => 'Berikan blanket warmer pasien',
            'Pasang pagar pengaman bed' => 'Pasang pagar pengaman bed',
            'Observasi tingkat kesadaran' => 'Observasi tingkat kesadaran',
            'Lakukan suction pasien' => 'Lakukan suction pasien',
            'Kaji pergerakan ekstremitas bawah' => 'Kaji pergerakan ekstremitas bawah',
            'Oksigenasi' => 'Oksigenasi'
          ])->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pas_implementasi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Mengkaji skala nyeri' => 'Mengkaji skala nyeri',
            'Mengukur tanda vital (TD,N,SPO2,RR)' => 'Mengukur tanda vital (TD,N,SPO2,RR)',
            'Mengatur Posisi Pasien' => 'Mengatur Posisi Pasien',
            'Memberikan Analgetik' => 'Memberikan Analgetik',
            'Melakukan pemberian obat Anti Emetik' => 'Melakukan pemberian obat Anti Emetik',
            'Memberikan blanket warmer' => 'Memberikan blanket warmer',
            'Memasang pagar pengaman bed pasien' => 'Memasang pagar pengaman bed pasien',
            'Mengobservasi tingkat kesadaran' => 'Mengobservasi tingkat kesadaran',
            'Melakukan suction pasien' => 'Melakukan suction pasien',
            'Mengkaji ekstremitas' => 'Mengkaji ekstremitas',
            'Memberikan Oksigen 3 - 10 lpm' => 'Memberikan Oksigen 3 - 10 lpm',
          ])->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'pas_evaluasi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Nyeri berkurang, Score nyeri VAS' => 'Nyeri berkurang, Score nyeri VAS',
            'TTV pasien dalam batas normal' => 'TTV pasien dalam batas normal',
            'Pasien tampak nyaman' => 'Pasien tampak nyaman',
            'Mual/Muntah berkurang' => 'Mual/Muntah berkurang',
            'PADSS score 10' => 'PADSS score 10',
            'Aldret score > 9' => 'Aldret score > 9',
            'Stewart score > 5' => 'Stewart score > 5',
            'Bromage score 0 - 1' => 'Bromage score 0 - 1',
            'Saturasi 95 - 100%' => 'Saturasi 95 - 100%'
          ])->label(false);
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
          if (!$model->pas_batal) {
            if (!$model->pas_final) {
              echo $form->field($model, 'pas_final')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Final', 'handleWidth' => 50,
                  'offText' => 'Draf',
                  'onColor' => 'success',
                  'offColor' => 'danger',
                ]
              ])->label(false);
            } else {
              echo $form->field($model, 'pas_batal')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Batal',
                  'offText' => 'Non-batal',
                  'onColor' => 'danger',
                  'offColor' => 'success',
                ]
              ])->label(false);
            }
            echo Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->pas_id]);
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            if (!$model->pas_final) {
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-trash-alt"></i> Hapus']), ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/askan-pasca-anestesi/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->pas_id])]);
            }
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/askan-pasca-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          } else {
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/askan-pasca-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          }
          // echo Html::button(Yii::t('app', '{title}', ['title' => (($model->pas_batal) ? 'NB:Doc.Batal' : (($model->pas_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>