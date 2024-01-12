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
  'id' => 'apa'
]); ?>
<?= $form->field($model, 'apa_to_id')->hiddenInput()->label(false); ?>
<?php
// echo $form->field($model, 'apa_base64')->hiddenInput(['id' => 'post-base64'])->label(false);
?>
<div class="row">
  <div class="col-lg-11">
    <table class="table table-sm table-form bord">
      <tr>
        <td colspan="12" align="center">
          <h6 style="font-size: 15pt;"><b>ASUHAN KEPENATAAN ANESTESI</b></h6>
          <h6 style="font-size: 15pt;"><b>PENGKAJIAN</b></h6>
        </td>
      </tr>
      <tr>
        <td colspan="12" align="center"><label></label></td>
      </tr>
      <tr>
        <td colspan="12"><label>
            <h6><b>A. PRA ANESTESI</b></h6>
          </label></td>
      </tr>
      <tr>
        <td><label>Tanggal Pukul</label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'apa_tanggal_pukul', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'datetime-local', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td style="width: 14%;"><label>Diagnosa</label></td>
        <td style="width: 1%;"><label>:</label></td>
        <td style="width: 35%;">
          <?= $form->field($model, 'apa_diagnosa', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>

        <td style="width: 14%;" align="center"><label>Tindakan</label></td>
        <td style="width: 1%;"><label>:</label></td>
        <td style="width: 35%;">
          <?= $form->field($model, 'apa_tindakan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label>Keadaan Umum</label></td>
      </tr>
    </table>

    <table align="center" class="bord">
      <tr>
        <td><label>BB:</label></td>
        <td>
          <?= $form->field($model, 'apa_bb', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... Kg'])->label(false); ?>
        </td>

        <td><label>TB:</label></td>
        <td>
          <?= $form->field($model, 'apa_tb', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... Cm'])->label(false); ?>
        </td>

        <td><label>Gol. Darah:</label></td>
        <td>
          <?= $form->field($model, 'apa_gol_darah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>

        <td><label>TD:</label></td>
        <td>
          <?= $form->field($model, 'apa_td', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... Mmhg'])->label(false); ?>
        </td>

        <td><label>Nadi:</label></td>
        <td>
          <?= $form->field($model, 'apa_nadi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... x/mnt'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label>Frekw Nafas:</label></td>
        <td>
          <?= $form->field($model, 'apa_frekuensi_nafas', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... x/mnt'])->label(false); ?>
        </td>

        <td><label>Suhu:</label></td>
        <td>
          <?= $form->field($model, 'apa_suhu', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '.... Celcius'])->label(false); ?>
        </td>

        <td><label>Hb:</label></td>
        <td>
          <?= $form->field($model, 'apa_hb', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>

        <td><label>Ht:</label></td>
        <td>
          <?= $form->field($model, 'apa_ht', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>

        <td><label>GDS:</label></td>
        <td>
          <?= $form->field($model, 'apa_gds', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
        </td>
      </tr>
    </table>

    <table class="table table-sm table-form bord">
      <tr>
        <td style="width: 20%;">
          <label>Informed Consent Anestesi</label>
        </td>
        <td>
          <?php
          $apa_inform_consent = ['Ada' => 'Ada', 'Tidak' => 'Tidak'];
          echo $form->field($model, 'apa_inform_consent', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_inform_consent)->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <label>I. Sistim Respirasi</label>
        </td>
        <td colspan="2">
          <label>IV. Sistem Renal Endokrin</label>
        </td>
      </tr>
      <tr>
        <td>
          <?php
          $apa_respirasi = ['Normal' => 'Normal'];
          echo $form->field($model, 'apa_respirasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_respirasi)->label(false);
          $apa_respirasi = HelperGeneral::getValueCustomRadio($apa_respirasi, $model->apa_respirasi);
          ?>
        </td>
        <td>
          <div class="input-group" style="width: 90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[apa_respirasi]" id="apa_respirasi" type="radio" value="<?= $apa_respirasi['v'] ?>" <?= $apa_respirasi['c'] ?>>
              </div>
            </div>
            <input id="apa_respirasi_it" placeholder="Tidak, Sebutkan" type="text" value="<?= $apa_respirasi['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

        <td>
          <?php
          $apa_renal_endokrin = ['Normal' => 'Normal'];
          echo $form->field($model, 'apa_renal_endokrin', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_renal_endokrin)->label(false);
          $apa_renal_endokrin = HelperGeneral::getValueCustomRadio($apa_renal_endokrin, $model->apa_renal_endokrin);
          ?>
        </td>
        <td>
          <div class="input-group" style="width: 90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[apa_renal_endokrin]" id="apa_renal_endokrin" type="radio" value="<?= $apa_renal_endokrin['v'] ?>" <?= $apa_renal_endokrin['c'] ?>>
              </div>
            </div>
            <input id="apa_renal_endokrin_it" placeholder="Tidak, Sebutkan" type="text" value="<?= $apa_renal_endokrin['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <label>II. Kardiovaskular</label>
        </td>
        <td colspan="2">
          <label>V. Hepato / Gastrointestinal</label>
        </td>
      </tr>
      <tr>
        <td>
          <?php
          $apa_kardiovaskular = ['Normal' => 'Normal'];
          echo $form->field($model, 'apa_kardiovaskular', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_kardiovaskular)->label(false);
          $apa_kardiovaskular = HelperGeneral::getValueCustomRadio($apa_kardiovaskular, $model->apa_kardiovaskular);
          ?>
        </td>
        <td>
          <div class="input-group" style="width: 90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[apa_kardiovaskular]" id="apa_kardiovaskular" type="radio" value="<?= $apa_kardiovaskular['v'] ?>" <?= $apa_kardiovaskular['c'] ?>>
              </div>
            </div>
            <input id="apa_kardiovaskular_it" placeholder="Tidak, Sebutkan" type="text" value="<?= $apa_kardiovaskular['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>

        <td>
          <?php
          $apa_hepato = ['Normal' => 'Normal'];
          echo $form->field($model, 'apa_hepato', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_hepato)->label(false);
          $apa_hepato = HelperGeneral::getValueCustomRadio($apa_hepato, $model->apa_hepato);
          ?>
        </td>
        <td>
          <div class="input-group" style="width: 90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[apa_hepato]" id="apa_hepato" type="radio" value="<?= $apa_hepato['v'] ?>" <?= $apa_hepato['c'] ?>>
              </div>
            </div>
            <input id="apa_hepato_it" placeholder="Tidak, Sebutkan" type="text" value="<?= $apa_hepato['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td>
          CRT
        </td>
        <td>
          <?php
          $apa_crt = ['< 2 detik' => '< 2 detik', '> 2 detik' => '> 2 detik'];
          echo $form->field($model, 'apa_crt', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_crt)->label(false);
          ?>
        </td>
        <td colspan="2">
          <label>VI. Neuro / Muskuloskeletal</label>
        </td>
      </tr>
      <tr>
        <td>
          Kulit
        </td>
        <td>
          <?= $form->field($model, 'apa_kulit', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Hangat' => 'Hangat',
            'Dingin' => 'Dingin'
          ])->label(false);
          ?>
          <?php
          // $apa_kulit = ['Hangat' => 'Hangat', 'Dingin' => 'Dingin'];
          // echo $form->field($model, 'apa_kulit', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_kulit)->label(false);
          ?>
        </td>

        <td>
          <?php
          $apa_neuro = ['Normal' => 'Normal'];
          echo $form->field($model, 'apa_neuro', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_neuro)->label(false);
          $apa_neuro = HelperGeneral::getValueCustomRadio($apa_neuro, $model->apa_neuro);
          ?>
        </td>
        <td>
          <div class="input-group" style="width: 90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[apa_neuro]" id="apa_neuro" type="radio" value="<?= $apa_neuro['v'] ?>" <?= $apa_neuro['c'] ?>>
              </div>
            </div>
            <input id="apa_neuro_it" placeholder="Tidak, Sebutkan" type="text" value="<?= $apa_neuro['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td>
          Perdarahan
        </td>
        <td>
          <?php
          $apa_pendarahan = ['Normal' => 'Normal'];
          echo $form->field($model, 'apa_pendarahan', ['options' => ['class' => 'form-group custom-margin', 'style' => 'margin-bottom:0px']])->inline(true)->radioList($apa_pendarahan)->label(false);
          $apa_pendarahan = HelperGeneral::getValueCustomRadio($apa_pendarahan, $model->apa_pendarahan);
          ?>
          <div class="input-group" style="width: 90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[apa_pendarahan]" id="apa_pendarahan" type="radio" value="<?= $apa_pendarahan['v'] ?>" <?= $apa_pendarahan['c'] ?>>
              </div>
            </div>
            <input id="apa_pendarahan_it" placeholder="Tidak, Sebutkan" type="text" value="<?= $apa_pendarahan['v'] ?>" class="form-control form-control-sm">
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <label>III. Persyarafan Kesadaran</label>
        </td>
        <td colspan="2">
          <label>VII. Lain-lain</label>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="width:50%">
          <?= $form->field($model, 'apa_syaraf_kesadaran', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Compos Mentis' => 'Compos Mentis',
            'Soporo Coma' => 'Soporo Coma',
            'Nyeri' => 'Nyeri',
            'Samnolen' => 'Samnolen',
            'Coma' => 'Coma',
            'Tidak' => 'Tidak',
            'Dilirium' => 'Dilirium'
          ])->label(false);
          ?>
          <?php
          // $apa_syaraf_kesadaran = ['Compos Mentis' => 'Compos Mentis', 'Soporo Coma' => 'Soporo Coma', 'Nyeri' => 'Nyeri', 'Samnolen' => 'Samnolen', 'Coma' => 'Coma', 'Tidak' => 'Tidak', 'Dilirium' => 'Dilirium'];
          // echo $form->field($model, 'apa_syaraf_kesadaran', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_syaraf_kesadaran)->label(false);
          ?>
        </td>

        <td>
          <?php
          $apa_lain_lain = ['Riwayat Alergi' => 'Riwayat Alergi'];
          echo $form->field($model, 'apa_lain_lain', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($apa_lain_lain)->label(false);
          $apa_lain_lain = HelperGeneral::getValueCustomRadio($apa_lain_lain, $model->apa_lain_lain);
          ?>
        </td>
        <td>
          <div class="input-group" style="width: 90%;">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input name="<?= $model->getModelClasName() ?>[apa_lain_lain]" id="apa_lain_lain" type="radio" value="<?= $apa_lain_lain['v'] ?>" <?= $apa_lain_lain['c'] ?>>
              </div>
            </div>
            <input id="apa_lain_lain_it" placeholder="Tidak, Sebutkan" type="text" value="<?= $apa_lain_lain['v'] ?>" class="form-control form-control-sm">
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
        <td colspan="3" class="text-center">
          <?= $form->field($model, 'apa_masalah_kesehatan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList([
            'Nyeri' => 'Nyeri',
            'Shock' => 'Shock',
            'Resiko Cedera Anestesi' => 'Resiko Cedera Anestesi',
            'Resiko Cedera Pembedahan' => 'Resiko Cedera Pembedahan',
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
          <?= $form->field($model, 'apa_intervensi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Cek kelengkapan administrasi pasien' => 'Cek kelengkapan administrasi pasien',
            'Kaji tingkat nyeri' => 'Kaji tingkat nyeri',
            'Kolaborasi pemberian Analgetik' => 'Kolaborasi pemberian Analgetik',
            'Monitoring tanda vital' => 'Monitoring tanda vital',
            'Siapkan mesin, alat (STATICS) dan obat anestesi sesuai kebutuhan' => 'Siapkan mesin, alat (STATICS) dan obat anestesi sesuai kebutuhan',
            'Kolaborasi pemberian tranfusi/cairan pengganti darah/Antikuagulan' => 'Kolaborasi pemberian tranfusi/cairan pengganti darah/Antikuagulan',
            'Oksigenasi' => 'Oksigenasi'
          ])->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'apa_implementasi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Melakukan pengecekan administrasi pasien' => 'Melakukan pengecekan administrasi pasien',
            'Mengkaji skala nyeri' => 'Mengkaji skala nyeri',
            'Memberikan Analgetik' => 'Memberikan Analgetik',
            'Mengukur tanda vital, TD, RR, HR, SPO2' => 'Mengukur tanda vital, TD, RR, HR, SPO2',
            'Menyiapkan mesin, alat (STATICS) dan obat anestesi' => 'Menyiapkan mesin, alat (STATICS) dan obat anestesi',
            'Memberikan tranfusi/ cairan pengganti darah/ antikuagulan' => 'Memberikan tranfusi/ cairan pengganti darah/ antikuagulan',
            'Memberikan Oksigen 3 - 10 lpm' => 'Memberikan Oksigen 3 - 10 lpm',
          ])->label(false);
          ?>
        </td>
        <td>
          <?= $form->field($model, 'apa_evaluasi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Administrasi pasien tersedia sesuai kebutuhan' => 'Administrasi pasien tersedia sesuai kebutuhan',
            'Nyeri berkurang' => 'Nyeri berkurang',
            'TTV pasien dalam batas normal' => 'TTV pasien dalam batas normal',
            'Cedera anestesi tidak terjadi' => 'Cedera anestesi tidak terjadi',
            'Cedera pembedahan dapat teratasi' => 'Cedera pembedahan dapat teratasi',
            'Kebutuhan cairan dan Elektolit terpenuhi' => 'Kebutuhan cairan dan Elektolit terpenuhi',
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
          if (!$model->apa_batal) {
            if (!$model->apa_final) {
              echo $form->field($model, 'apa_final')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Final', 'handleWidth' => 50,
                  'offText' => 'Draf',
                  'onColor' => 'success',
                  'offColor' => 'danger',
                ]
              ])->label(false);
            } else {
              echo $form->field($model, 'apa_batal')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Batal',
                  'offText' => 'Non-batal',
                  'onColor' => 'danger',
                  'offColor' => 'success',
                ]
              ])->label(false);
            }
            echo Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->apa_id]);
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            if (!$model->apa_final) {
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-trash-alt"></i> Hapus']), ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/askan-pra-anestesi/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->apa_id])]);
            }
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/askan-pra-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          } else {
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/askan-pra-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          }
          // echo Html::button(Yii::t('app', '{title}', ['title' => (($model->apa_batal) ? 'NB:Doc.Batal' : (($model->apa_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>