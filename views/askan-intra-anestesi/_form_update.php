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
  'id' => 'aia'
]); ?>
<?= $form->field($model, 'aia_to_id')->hiddenInput()->label(false); ?>
<?php
// echo $form->field($model, 'aia_base64')->hiddenInput(['id' => 'post-base64'])->label(false);
?>
<div class="row">
  <div class="col-lg-11">
    <table class="table table-sm table-form bord">
      <tr>
        <td colspan="12" align="center"><label></label></td>
      </tr>
      <tr>
        <td colspan="12"><label>
            <h6><b>B. INTRA ANESTESI</b></h6>
          </label></td>
      </tr>
      <tr>
        <td colspan="12" class="text-center">
          <label>
            <h6><b>PENGKAJIAN</b></h6>
          </label>
        </td>
      </tr>
      <tr>
        <td style="width: 24%;"><label>Jam mulai anestesi</label></td>
        <td style="width: 1%;"><label>:</label></td>
        <td style="width: 25%;">
          <?= $form->field($model, 'aia_mulai_anestesi', ['options' => ['class' => 'form-group custom-margin', 'style' => 'width:50%']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
        <td style="width: 24%;"><label>Jam selesai anestesi</label></td>
        <td style="width: 1%;"><label>:</label></td>
        <td style="width: 25%;">
          <?= $form->field($model, 'aia_selesai_anestesi', ['options' => ['class' => 'form-group custom-margin', 'style' => 'width:50%']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label>Jam mulai pembedahan</label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'aia_mulai_pembedahan', ['options' => ['class' => 'form-group custom-margin', 'style' => 'width:50%']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
        <td><label>Jam selesai pembedahan</label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'aia_selesai_pembedahan', ['options' => ['class' => 'form-group custom-margin', 'style' => 'width:50%']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label>Tehnik Anestesi</label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?= $form->field($model, 'aia_tehnik_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'GA' => 'GA',
            'ETT' => 'ETT',
            'NTT' => 'NTT',
            'FM' => 'FM',
            'LMA' => 'LMA',
            'Tiva' => 'Tiva',
            'Regional' => 'Regional',
            'Spinal' => 'Spinal',
            'Epidural' => 'Epidural',
            'Caudal' => 'Caudal',
            'Blok' => 'Blok',
            'Combain Regional dan GA' => 'Combain Regional dan GA',
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Obat Induksi</label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?= $form->field($model, 'aia_obat_induksi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Sedasi' => 'Sedasi',
            'Analgesi' => 'Analgesi',
            'Relaksasi' => 'Relaksasi'
          ])->label(false);
          ?>
          <?php
          // $aia_obat_induksi = ['Sedasi' => 'Sedasi', 'Analgesi' => 'Analgesi', 'Relaksasi' => 'Relaksasi'];
          // echo $form->field($model, 'aia_obat_induksi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($aia_obat_induksi)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Obat Inhalasi</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $aia_obat_inhalasi = ['Sevorane' => 'Sevorane', 'Isoflurane' => 'Isoflurane'];
          echo $form->field($model, 'aia_obat_inhalasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($aia_obat_inhalasi)->label(false);
          $aia_obat_inhalasi = HelperGeneral::getValueCustomRadio($aia_obat_inhalasi, $model->aia_obat_inhalasi);
          ?>
        </td>
        <td colspan="3">
          <div class="input-group" style="width: 90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[aia_obat_inhalasi]" id="aia_obat_inhalasi" type="radio" value="<?= $aia_obat_inhalasi['v'] ?>" <?= $aia_obat_inhalasi['c'] ?>>
              </div>
            </div>
            <input id="aia_obat_inhalasi_it" placeholder="Lain-lain:.........." type="text" value="<?= $aia_obat_inhalasi['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td><label>Obat Regional</label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?= $form->field($model, 'aia_obat_regional', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Bupivacaine' => 'Bupivacaine',
            'Adjuvant' => 'Adjuvant'
          ])->label(false);
          ?>
          <?php
          // $aia_obat_regional = ['Bupivacaine' => 'Bupivacaine', 'Adjuvant' => 'Adjuvant'];
          // echo $form->field($model, 'aia_obat_regional', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($aia_obat_regional)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Obat Lainnya</label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?= $form->field($model, 'aia_obat_lainnya', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '...............'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label>Cairan dan darah</label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?= $form->field($model, 'aia_cairan_darah', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Kristaloid' => 'Kristaloid',
            'Koloid' => 'Koloid'
          ])->label(false);
          ?>
          <?php
          // $aia_cairan_darah = ['Kristaloid' => 'Kristaloid', 'Koloid' => 'Koloid'];
          // echo $form->field($model, 'aia_cairan_darah', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($aia_cairan_darah)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Darah</label></td>
        <td><label>:</label></td>
        <td colspan="4">
          <?= $form->field($model, 'aia_darah', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'PRC' => 'PRC',
            'WB' => 'WB',
            'FFP' => 'FFP'
          ])->label(false);
          ?>
          <?php
          // $aia_darah = ['PRC' => 'PRC', 'WB' => 'WB', 'FFP' => 'FFP'];
          // echo $form->field($model, 'aia_darah', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($aia_darah)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label>Posisi Operasi</label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $aia_posisi_operasi = [
            'Supain' => 'Supain',
            'Trendelenburg' => 'Trendelenburg',
            'Lateral' => 'Lateral',
            'Litotomi' => 'Litotomi',
            'Jakknife' => 'Jakknife',
            'Prone' => 'Prone',
          ];
          echo $form->field($model, 'aia_posisi_operasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($aia_posisi_operasi)->label(false);
          $aia_posisi_operasi = HelperGeneral::getValueCustomRadio($aia_posisi_operasi, $model->aia_posisi_operasi);
          ?>
        </td>
        <td colspan="3">
          <div class="input-group" style="width: 90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[aia_posisi_operasi]" id="aia_posisi_operasi" type="radio" value="<?= $aia_posisi_operasi['v'] ?>" <?= $aia_posisi_operasi['c'] ?>>
              </div>
            </div>
            <input id="aia_posisi_operasi_it" placeholder="Lain-lain:.........." type="text" value="<?= $aia_posisi_operasi['v'] ?>" class="form-control form-control-sm">
          </div>
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
          <?= $form->field($model, 'aia_masalah_kesehatan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Resiko Trauma Pembedahan' => 'Resiko Trauma Pembedahan',
            'PK Disfungsi Respirasi(hipoksia, brongkospasme, edema laring)' => 'PK Disfungsi Respirasi(hipoksia, brongkospasme, edema laring)',
            'PK Disfungsi Kardiovaskuler(hipotensi, hipertensi, bradikardi, aritmia, arest)' => 'PK Disfungsi Kardiovaskuler(hipotensi, hipertensi, bradikardi, aritmia, arest)',
            'Resiko hipersensitifitas agen anestesi' => 'Resiko hipersensitifitas agen anestesi',
            'Hipotermi' => 'Hipotermi',
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
          <?= $form->field($model, 'aia_intervensi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Kolaborasi pemberian obat anestesi' => 'Kolaborasi pemberian obat anestesi',
            'Atur posisi pasien' => 'Atur posisi pasien',
            'Monitoring tanda vital' => 'Monitoring tanda vital',
            'Asistensi tindakan anestesi umum' => 'Asistensi tindakan anestesi umum',
            'Asistensi tindakan regional' => 'Asistensi tindakan regional',
            'Kolaborasi pemberian obat vasopresor' => 'Kolaborasi pemberian obat vasopresor',
            'Kolaborasi pemberian Cairan dan elektrolit' => 'Kolaborasi pemberian Cairan dan elektrolit',
            'Berikan blanket warmer pasien' => 'Berikan blanket warmer pasien',
            'Kolaborasi pemberian obat emergensi' => 'Kolaborasi pemberian obat emergensi',
            'Oksigenasi' => 'Oksigenasi'
          ])->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'aia_implementasi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Memberikan obat anestesi' => 'Memberikan obat anestesi',
            'Mengatur posisi pasien' => 'Mengatur posisi pasien',
            'Melakukan monitoring tanda vital' => 'Melakukan monitoring tanda vital',
            'Melakukan asistensi tindakan anestesi dan sedasi' => 'Melakukan asistensi tindakan anestesi dan sedasi',
            'Melakukan asistensi tindakan regional' => 'Melakukan asistensi tindakan regional',
            'Memberikan obat vasopresor' => 'Memberikan obat vasopresor',
            'Memberikan tranfusi/ cairan elektrolit selama operasi' => 'Memberikan tranfusi/ cairan elektrolit selama operasi',
            'Memberikan blanket warmer' => 'Memberikan blanket warmer',
            'Memberikan obat emergensi' => 'Memberikan obat emergensi',
            'Memberikan Oksigen 3 - 10 lpm' => 'Memberikan Oksigen 3 - 10 lpm',
          ])->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'aia_evaluasi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Stadium anestesi terpenuhi' => 'Stadium anestesi terpenuhi',
            'Posisi pasien sesuai rencana operasi' => 'Posisi pasien sesuai rencana operasi',
            'TTV pasien dalam batas normal' => 'TTV pasien dalam batas normal',
            'Kebutuhan cairan dan elektrolit terpenuhi' => 'Kebutuhan cairan dan elektrolit terpenuhi',
            'Suhu dalam batas normal' => 'Suhu dalam batas normal',
            'Kegawat daruratan pasien teratasi' => 'Kegawat daruratan pasien teratasi',
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
          if (!$model->aia_batal) {
            if (!$model->aia_final) {
              echo $form->field($model, 'aia_final')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Final', 'handleWidth' => 50,
                  'offText' => 'Draf',
                  'onColor' => 'success',
                  'offColor' => 'danger',
                ]
              ])->label(false);
            } else {
              echo $form->field($model, 'aia_batal')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Batal',
                  'offText' => 'Non-batal',
                  'onColor' => 'danger',
                  'offColor' => 'success',
                ]
              ])->label(false);
            }
            echo Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->aia_id]);
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            if (!$model->aia_final) {
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-trash-alt"></i> Hapus']), ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/askan-intra-anestesi/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->aia_id])]);
            }
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/askan-intra-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          } else {
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/askan-intra-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          }
          // echo Html::button(Yii::t('app', '{title}', ['title' => (($model->aia_batal) ? 'NB:Doc.Batal' : (($model->aia_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>