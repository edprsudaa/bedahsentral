<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
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
/* @var $model app\models\medis\MedisPostOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
  .table-form th,
  .table-form td {
    padding: 0.5px;
    border: 0px;
    /* border: 0.5px solid #3c8dbc; */
  }
</style>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
<div class="medis-post-operasi-perawat-form">
  <?php
  $this->registerJs($this->render('_form_create_ready.js'));
  // echo'</pre>';print_r($model);die();
  ?>
  <?php $form = ActiveForm::begin(['id' => 'psop']); ?>
  <?= $form->field($model, 'psop_to_id')->hiddenInput()->label(false); ?>
  <?= $form->field($model, 'psop_batal')->hiddenInput()->label(false); ?>
  <div class="row">
    <div class="col-lg-11">
      <table class="table table-sm table-form">
        <th colspan="7" class="text-left bg-lightblue">C. POST OPERASI</th>
        <tr>
          <td colspan="2" style="width:20%;"><label><?= $model->getAttributeLabel('psop_ruang_pemulihan') ?> </label></td>
          <td style="width:2%">:</td>
          <td>
            <div style="display: flex;justify-content:space-around;">

              <?php
              $psop_ruang_pemulihan = ['Ya' => 'Ya'];
              echo $form->field($model, 'psop_ruang_pemulihan', ['options' => ['class' => 'form-group custom-margin']])->radioList($psop_ruang_pemulihan, [
                'item' => function ($index, $label, $name, $checked, $value) {
                  return '<div class="custom-control custom-radio">
                    <input onClick = "ya_ruang_pemulihan(this.id)" class="custom-control-input" type="radio" id="customRadio1" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>
                  <label onClick = "ya_ruang_pemulihan(this.id)" for="customRadio1" class="custom-control-label"> ' . $label . '</label>
                  </div>';
                }
              ])->label(false);
              $psop_ruang_pemulihan = HelperGeneral::getValueCustomRadio($psop_ruang_pemulihan, $model->psop_ruang_pemulihan);
              ?>

              <div id="masukrr">
                <div>
                  <label><?= $model->getAttributeLabel('psop_masuk_rr') ?> </label>
                  <?= $form->field($model, 'psop_masuk_rr', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => 'Masuk Jam....'])->label(false); ?>
                </div>
                <div>
                  <label><?= $model->getAttributeLabel('psop_keluar_rr') ?> </label>
                  <?= $form->field($model, 'psop_keluar_rr', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => 'Keluar Jam....'])->label(false); ?>
                </div>
              </div>
            </div>
          </td>

          <td colspan="3">
            <div class="input-group" onclick="tidak_ruang_pemulihan()">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[psop_ruang_pemulihan]" id="psop_ruang_pemulihan" type="radio" value="<?= $psop_ruang_pemulihan['v'] ?>" <?= $psop_ruang_pemulihan['c'] ?>>
                </div>
              </div>
              <input id="psop_ruang_pemulihan_it" placeholder="Jika tidak, sebutkan nama ruangan" type="text" value="<?= $psop_ruang_pemulihan['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_keadaan_umum') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?php
            $psop_keadaan_umum = ['Baik' => 'Baik', 'Buruk' => 'Buruk'];
            echo $form->field($model, 'psop_keadaan_umum', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($psop_keadaan_umum)->label(false);
            $psop_keadaan_umum = HelperGeneral::getValueCustomRadio($psop_keadaan_umum, $model->psop_keadaan_umum);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_tingkat_kesadaran') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?php
            $psop_tingkat_kesadaran = ['CM' => 'CM', 'Apatis' => 'Apatis', 'Somnolen' => 'Somnolen', 'Sopor' => 'Sopor', 'Koma' => 'Koma', 'Dibawah pengaruh obat'];
            echo $form->field($model, 'psop_tingkat_kesadaran', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($psop_tingkat_kesadaran)->label(false);
            $psop_tingkat_kesadaran = HelperGeneral::getValueCustomRadio($psop_tingkat_kesadaran, $model->psop_tingkat_kesadaran);
            ?>
          </td>
        </tr>
        <tr>
          <td rowspan="2"></td>
          <td colspan="2" rowspan="2"></td>
          <td>
            <label><?= $model->getAttributeLabel('psop_e') ?> </label> <?= $form->field($model, 'psop_e', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'id' => 'gcs-e', 'onInput' => 'gcs()'])->label(false); ?>

          </td>
          <td>
            <label><?= $model->getAttributeLabel('psop_m') ?> </label> <?= $form->field($model, 'psop_m', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'id' => 'gcs-m', 'onInput' => 'gcs()'])->label(false); ?>
          </td>
          <td>
            <label><?= $model->getAttributeLabel('psop_v') ?> </label> <?= $form->field($model, 'psop_v', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'id' => 'gcs-v', 'onInput' => 'gcs()'])->label(false); ?>
          </td>
          <td>
            <label><?= $model->getAttributeLabel('psop_total_gcs') ?> </label> <?= $form->field($model, 'psop_total_gcs', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....', 'id' => 'total-gcs', 'readonly' => 'readonly'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>
            <label><?= $model->getAttributeLabel('psop_tekanan_darah') ?> </label> <?= $form->field($model, 'psop_tekanan_darah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '...... mmHg'])->label(false); ?>
          </td>
          <td>
            <label><?= $model->getAttributeLabel('psop_nadi') ?> </label> <?= $form->field($model, 'psop_nadi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '...... Kali/menit'])->label(false); ?>
          </td>
          <td>
            <label><?= $model->getAttributeLabel('psop_suhu') ?> </label> <?= $form->field($model, 'psop_suhu', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '...... °C'])->label(false); ?>
          </td>
        </tr>

        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_pernapasan') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?php
            $psop_pernapasan = ['Spontan' => 'Spontan', 'Penggunaan alat bantu' => 'Penggunaan alat bantu'];
            echo $form->field($model, 'psop_pernapasan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($psop_pernapasan)->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_sirkulasi') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?php
            $psop_sirkulasi = ['Warna kulit merah muda' => 'Warna kulit merah muda', 'Kebiruan' => 'Kebiruan', 'Ekstremitas hangat' => 'Ekstremitas hangat', 'Ekstremitas dingin' => 'Ekstremitas dingin'];
            echo $form->field($model, 'psop_sirkulasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($psop_sirkulasi)->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_turgor_kulit') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?php
            $psop_turgor_kulit = ['Elastis' => 'Elastis', 'Tidak Elastis' => 'Tidak Elastis'];
            echo $form->field($model, 'psop_turgor_kulit', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($psop_turgor_kulit)->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_posisi_klien') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?php
            $psop_posisi_klien = ['Terlentang' => 'Terlentang', 'Lateral Ka/Ki*' => 'Lateral Ka/Ki*', 'Fowler/semifowler*' => 'Fowler/semifowler*'];
            echo $form->field($model, 'psop_posisi_klien', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($psop_posisi_klien)->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_pasang_drain') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $psop_pasang_drain = ['Tidak' => 'Tidak'];
            echo $form->field($model, 'psop_pasang_drain', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($psop_pasang_drain)->label(false);
            $psop_pasang_drain = HelperGeneral::getValueCustomRadio($psop_pasang_drain, $model->psop_pasang_drain);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[psop_pasang_drain]" id="psop_pasang_drain" type="radio" value="<?= $psop_pasang_drain['v'] ?>" <?= $psop_pasang_drain['c'] ?>>
                </div>
              </div>
              <input id="psop_pasang_drain_it" placeholder="Jika ya, sebutkan jumlah dan warna" type="text" value="<?= $psop_pasang_drain['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_jaringan_pa_form') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $psop_jaringan_pa_form = ['Tidak' => 'Tidak'];
            echo $form->field($model, 'psop_jaringan_pa_form', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($psop_jaringan_pa_form)->label(false);
            $psop_jaringan_pa_form = HelperGeneral::getValueCustomRadio($psop_jaringan_pa_form, $model->psop_jaringan_pa_form);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[psop_jaringan_pa_form]" id="psop_jaringan_pa_form" type="radio" value="<?= $psop_jaringan_pa_form['v'] ?>" <?= $psop_jaringan_pa_form['c'] ?>>
                </div>
              </div>
              <input id="psop_jaringan_pa_form_it" placeholder="Jika ya, Diserahkan pada keluarga yang menerima" type="text" value="<?= $psop_jaringan_pa_form['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_resep') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?php
            $psop_resep = ['Tidak' => 'Tidak', 'Ya' => 'Ya'];
            echo $form->field($model, 'psop_resep', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($psop_resep)->label(false);
            $psop_resep = HelperGeneral::getValueCustomRadio($psop_resep, $model->psop_resep);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_jam_panggil_perawat_ruangan') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?= $form->field($model, 'psop_jam_panggil_perawat_ruangan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_jam_perawat_datang') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?= $form->field($model, 'psop_jam_perawat_datang', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>

        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_barang_diserahkan_via_prwt_rgn') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?= $form->field($model, 'psop_barang_diserahkan_via_prwt_rgn', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
              'File Pasien' => 'File Pasien',
              'Photo Rontgen' => 'Photo Rontgen',
              'Resep' => 'Resep',
              'Jaringan' => 'Jaringan',
              'Obat-obatan' => 'Obat-obatan'
            ])->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="12" class="text-left bg-lightblue">Pesan Khusus</td>
        </tr>
        <tr>
          <td colspan="2"><label>a. Mobilisasi</label></td>
          <td><label>:</label></td>
          <td>
            <?= $form->field($model, 'psop_bedrest', ['options' => ['class' => 'form-group custom-margin']])->textInput(['placeholder' => 'Bedrest ....... jam', 'class' => 'form-control form-control-sm'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'psop_head_up', ['options' => ['class' => 'form-group custom-margin']])->textInput(['placeholder' => 'Head Up ....... °', 'class' => 'form-control form-control-sm'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label>b. Diit</label></td>
          <td><label>:</label></td>
          <td>
            <?= $form->field($model, 'psop_puasa', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Puasa ....... jam'])->label(false); ?>
          </td>
          <td>
            <?= $form->field($model, 'psop_diit_lain_lain', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'lain-lain .........'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label>c. <?= $model->getAttributeLabel('psop_resep_obat_post_operasi') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?= $form->field($model, 'psop_resep_obat_post_operasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label>d. <?= $model->getAttributeLabel('psop_lain_lain') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="5">
            <?= $form->field($model, 'psop_lain_lain', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_masalah') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="4">
            <?= $form->field($model, 'psop_masalah', [
              'template' => '<div class="col-sm-12">
                                    {input}
                                    {hint}{error}
                                </div>', 'options' => ['class' => 'form-group custom-margin']
            ])->textArea([
              'rows' => 10,
              'placeholder' => 'Ketik disini / gunakan @ untuk bantuan...'
            ])->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_tindakan') ?></label><span style="font-size: 10px;color: #000000;important;"></span></td>
          <td><label>:</label></td>
          <td colspan="4">
            <?= $form->field($model, 'psop_tindakan', [
              'template' => '<div class="col-sm-12">
                                    {input}
                                    {hint}{error}
                                </div>', 'options' => ['class' => 'form-group custom-margin']
            ])->textArea([
              'rows' => 10,
              'placeholder' => 'Ketik disini / gunakan @ untuk bantuan...'
            ])->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('psop_evaluasi') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="4"><?= $form->field($model, 'psop_evaluasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?></td>
        </tr>

      </table>
    </div>
    <div class="col-lg-1">
      <div class="row icon-sticky">
        <div class="col-lg-12">
          <div class="btn-group-vertical">
            <?php
            echo $form->field($model, 'psop_final')->widget(SwitchInput::classname(), [
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

            <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/post-operasi-perawat-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
  <?php yii\widgets\Pjax::end(); ?>
</div>