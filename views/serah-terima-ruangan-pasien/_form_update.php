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
use app\models\pegawai\DmUnitPenempatan;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
use app\models\sdm\Pegawai;
use app\models\sdm\Unit;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPostOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs('
$(document).ready(function(){
    var timerAjaxIcd = 0;
    var currentRequesttAjaxIcd = null;//utk cancel req pedding karna ada req new search icd
    $("#serahterimaruangan-mstr_diagnosis_sekarang").atwho({
        searchKey: "name",
        at: "@",
        limit: 100,
        displayTpl:"<li data-value=\'${key}\'>${name}</li>",
        insertTpl:"${name}",
        callbacks: {
            remoteFilter: function(query, callback) {
                // console.log("Mengetik...");
                clearTimeout(timerAjaxIcd);
                timerAjaxIcd = setTimeout(function () {
                    // console.log("Mencari...");
                    currentRequesttAjaxIcd =$.ajax({
                        url:"' . Url::to(['referensi-medis/icd10']) . '",
                        dataType: "json",
                        data:{search:query},
                        type:"GET",
                        beforeSend : function()    {          
                            if(currentRequesttAjaxIcd != null) {
                                currentRequesttAjaxIcd.abort();
                            }
                        },
                        success:function(data) {
                            var datas = $.map(data.data,function(value,i){
                                return {\'id\':i,\'key\':value+" ",\'name\':value}
                                });
                            callback(datas)
                        }
                    })
                },1000);    
            }
        }
    });
    $(document).on("click",".btn-segarkan",function(e){
        e.preventDefault;
        e.stopImmediatePropagation();
        $.pjax.reload({container:"#pjform-' . $model->formName() . '",timeout: false});//pjax form
    });
});
');
?>
<style type="text/css">
  .ttd {
    width: 50%;
    float: left;
  }

  #borderhead {
    border-bottom: 1px solid;
    border-top: 1px solid;
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    border: 0px;
    /* border: 0.5px solid #3c8dbc; */
  }
</style>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
<?php
$this->registerJs($this->render('_form_update_ready.js'));
// echo'</pre>';print_r($model);die();
?>
<?php $form = ActiveForm::begin(['id' => 'mstr']); ?>
<?= $form->field($model, 'mstr_to_id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'mstr_perawat_penerima_pgw_id')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <table width="100%" style="border:1px solid;" border="1">
      <tbody>
        <tr>
          <td style="width:15%;"><label><?= $model->getAttributeLabel('mstr_dpjp1_pgw_id') ?></label></td>
          <td>:</td>
          <td style="width:40%">
            <?= $form->field($model, 'mstr_dpjp1_pgw_id')->widget(Select2::classname(), [
              'data' => HelperSpesial::getListPegawai(1, false, true),
              'size' => Select2::SMALL,
              'options' => ['placeholder' => 'Pilih ...'],
              'pluginOptions' => [
                'allowClear' => false
              ],
            ])->label(false);
            ?>
          </td>
          <td><label><?= $model->getAttributeLabel('mstr_tgl_masuk_ruangan') ?></label></td>
          <td>:</td>
          <td>
            <?= $form->field($model, 'mstr_tgl_masuk_ruangan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'date', 'class' => 'form-control form-control-sm', 'placeholder' => 'Penggunaan O2 melalui...'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_dpjp2_pgw_id') ?></label></td>
          <td>:</td>
          <td>
            <?= $form->field($model, 'mstr_dpjp2_pgw_id')->widget(Select2::classname(), [
              'data' => HelperSpesial::getListPegawai(1, false, true),
              'size' => Select2::SMALL,
              'options' => ['placeholder' => 'Pilih ...'],
              'pluginOptions' => [
                'allowClear' => false
              ],
            ])->label(false);
            ?>
          </td>
          <td><label><?= $model->getAttributeLabel('mstr_ruangan_asal') ?></label></td>
          <td>:</td>
          <td>
            <?= $form->field($model, 'mstr_ruangan_asal')->widget(Select2::classname(), [
              'data' => ArrayHelper::map(DmUnitPenempatan::find()->all(), 'nama', 'nama'),
              'size' => Select2::SMALL,
              'options' => ['placeholder' => 'Pilih '],
              'pluginOptions' => [
                'allowClear' => true
              ],
            ])->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_dpjp3_pgw_id') ?></label></td>
          <td>:</td>
          <td>
            <?= $form->field($model, 'mstr_dpjp3_pgw_id')->widget(Select2::classname(), [
              'data' => HelperSpesial::getListPegawai(1, false, true),
              'size' => Select2::SMALL,
              'options' => ['placeholder' => 'Pilih ...'],
              'pluginOptions' => [
                'allowClear' => false
              ],
            ])->label(false);
            ?>
          </td>
          <td><label><?= $model->getAttributeLabel('mstr_pindah_keruangan') ?></label></td>
          <td>:</td>
          <td>
            <?= $form->field($model, 'mstr_pindah_keruangan')->widget(Select2::classname(), [
              'data' => ArrayHelper::map(DmUnitPenempatan::find()->all(), 'nama', 'nama'),
              'size' => Select2::SMALL,
              'options' => ['placeholder' => 'Pilih '],
              'pluginOptions' => [
                'allowClear' => true
              ],
            ])->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_dpjp4_pgw_id') ?></label></td>
          <td>:</td>
          <td>
            <?= $form->field($model, 'mstr_dpjp4_pgw_id')->widget(Select2::classname(), [
              'data' => HelperSpesial::getListPegawai(1, false, true),
              'size' => Select2::SMALL,
              'options' => ['placeholder' => 'Pilih ...'],
              'pluginOptions' => [
                'allowClear' => false
              ],
            ])->label(false);
            ?>
          </td>
          <td><label><?= $model->getAttributeLabel('mstr_diagnosis_sekarang') ?> <b><span style="font-size: 10px;color: #000000;important;"><u><i>(Gunakan Tanda "@" Bantuan Pengetikan Diagnosa)</i></u></span></b></label></td>
          <td>:</td>
          <td>
            <?php echo $form->field($model, 'mstr_diagnosis_sekarang')->textarea(['rows' => 3])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_alat_transfer_pasien') ?></label></td>
          <td>:</td>
          <td colspan="4">
            <?php
            $mstr_alat_transfer_pasien = ['Kursi Roda' => 'Kursi Roda', 'Brankar' => 'Brankar'];
            echo $form->field($model, 'mstr_alat_transfer_pasien', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_alat_transfer_pasien)->label(false);
            $mstr_alat_transfer_pasien = HelperGeneral::getValueCustomRadio($mstr_alat_transfer_pasien, $model->mstr_alat_transfer_pasien);
            ?>
          </td>
        </tr>
        <tr>
          <td><label>Perawat yang Menyerahkan</label></td>
          <td>:</td>
          <td colspan="4">
            <?= $form->field($model, 'mstr_perawat_menyerahkan_pgw_id')->widget(Select2::classname(), [
              'data' => HelperSpesial::getListPegawai(1, false, true),
              'size' => Select2::SMALL,
              'options' => ['placeholder' => 'Pilih ...'],
              'pluginOptions' => [
                'allowClear' => false
              ],
            ])->label(false);
            ?>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-sm table-form">
      <tbody>
        <tr>
          <th class="text-left bg-lightblue" align="left" colspan="10" id="borderhead">Kondisi Pasien Saat Serah Terima</th>
        </tr>
        <tr>
          <td style="width:20%;"><label><?= $model->getAttributeLabel('mstr_keadaan_umum') ?></label></td>
          <td style="width:2%;"><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_keadaan_umum = ['Baik' => 'Baik', 'Buruk' => 'Buruk'];
            echo $form->field($model, 'mstr_keadaan_umum', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_keadaan_umum)->label(false);
            $mstr_keadaan_umum = HelperGeneral::getValueCustomRadio($mstr_keadaan_umum, $model->mstr_keadaan_umum);
            ?>
          </td>
        </tr>
        <tr>
          <td><label>Tanda-tanda vital</label></td>
          <td><label>:</label></td>
          <td>
            <label><?= $model->getAttributeLabel('mstr_tekanan_darah_sistole') ?> (mmHg): </label>
            <?= $form->field($model, 'mstr_tekanan_darah_sistole', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td>
            <label><?= $model->getAttributeLabel('mstr_tekanan_darah_diastole') ?> (mmHg):</label>
            <?= $form->field($model, 'mstr_tekanan_darah_diastole', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td colspan="4">
            <label><?= $model->getAttributeLabel('mstr_nadi') ?> (x/menit):</label>
            <?= $form->field($model, 'mstr_nadi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td>
            <label><?= $model->getAttributeLabel('mstr_suhu') ?> (C): </label>
            <?= $form->field($model, 'mstr_suhu', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td colspan="4">
            <label><?= $model->getAttributeLabel('mstr_pernafasan') ?> (x/menit):</label>
            <?= $form->field($model, 'mstr_pernafasan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"></td>


        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_tingkat_kesadaran') ?></label> </td>
          <td><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_tingkat_kesadaran = ['composis mentis' => 'composis mentis', 'apatis' => 'apatis', 'delirium' => 'delirium', 'Somnolen' => 'Somnolen', 'Sopor' => 'Sopor', 'Koma' => 'Koma'];
            echo $form->field($model, 'mstr_tingkat_kesadaran', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_tingkat_kesadaran)->label(false);
            $mstr_tingkat_kesadaran = HelperGeneral::getValueCustomRadio($mstr_tingkat_kesadaran, $model->mstr_tingkat_kesadaran);
            ?>
          </td>
        </tr>
        <tr>
          <td><label>GCS</label></td>
          <td><label>:</label></td>
          <td>
            <label><?= $model->getAttributeLabel('mstr_gcs_e') ?>: </label>
            <?= $form->field($model, 'mstr_gcs_e', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td>
            <label><?= $model->getAttributeLabel('mstr_gcs_m') ?>: </label>
            <?= $form->field($model, 'mstr_gcs_m', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td colspan="6">
            <label><?= $model->getAttributeLabel('mstr_gcs_v') ?>: </label>
            <?= $form->field($model, 'mstr_gcs_v', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_penggunaan_o2') ?></label></td>
          <td><label>:</label></td>
          <td>
            <?= $form->field($model, 'mstr_penggunaan_o2', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => 'lt/menit'])->label(false); ?>
          </td>
          <td colspan="7">
            <?= $form->field($model, 'mstr_penggunaan_o2_via', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Penggunaan O2 melalui...'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td class="text-left bg-lightblue" colspan="10"><b>Nyeri</b></td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_penyebab') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_nyeri_penyebab', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jelaskan'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_hal_memperburuk') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_nyeri_hal_memperburuk', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jelaskan'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_hal_memperingan') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_nyeri_hal_memperingan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jelaskan'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_kualitas') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_nyeri_kualitas = ['Tumpul' => 'Tumpul', 'Tajam' => 'Tajam', 'Panas/terbakar' => 'Panas/terbakar'];
            echo $form->field($model, 'mstr_nyeri_kualitas', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_nyeri_kualitas)->label(false);
            $mstr_nyeri_kualitas = HelperGeneral::getValueCustomRadio($mstr_nyeri_kualitas, $model->mstr_nyeri_kualitas);
            ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_lokasi') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_nyeri_lokasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jelaskan'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_penjalaran') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_nyeri_penjalaran', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jelaskan'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_skor') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_nyeri_skor', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jelaskan'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_kategori') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_nyeri_kategori = ['Tidak Nyeri' => 'Tidak Nyeri', 'Nyeri Ringan' => 'Nyeri Ringan', 'Nyeri Sedang' => 'Nyeri Sedang', 'Nyeri Berat' => 'Nyeri Berat'];
            echo $form->field($model, 'mstr_nyeri_kategori', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_nyeri_kategori)->label(false);
            $mstr_nyeri_kategori = HelperGeneral::getValueCustomRadio($mstr_nyeri_kategori, $model->mstr_nyeri_kategori);
            ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_metode') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_nyeri_metode = ['VAS' => 'VAS', 'NRS' => 'NRS', 'Wong Baker' => 'Wong Baker'];
            echo $form->field($model, 'mstr_nyeri_metode', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_nyeri_metode)->label(false);
            $mstr_nyeri_metode = HelperGeneral::getValueCustomRadio($mstr_nyeri_metode, $model->mstr_nyeri_metode);
            ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_lama') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_nyeri_lama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jelaskan'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_nyeri_frekuensi') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_nyeri_frekuensi = ['Jarang' => 'Jarang', 'Sering' => 'Sering', 'Sedang' => 'Sedang', 'Hilang Timbul' => 'Hilang Timbul', 'Terus Menerus' => 'Terus Menerus'];
            echo $form->field($model, 'mstr_nyeri_frekuensi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_nyeri_frekuensi)->label(false);
            $mstr_nyeri_frekuensi = HelperGeneral::getValueCustomRadio($mstr_nyeri_frekuensi, $model->mstr_nyeri_frekuensi);
            ?>
          </td>
        </tr>

        <tr>
          <td class="text-left bg-lightblue" colspan="10"><b>Resiko jatuh</b></td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_resiko_jatuh_skor') ?></label></td>
          <td>:</td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_resiko_jatuh_skor', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jelaskan'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_resiko_jatuh_kategori') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_resiko_jatuh_kategori = ['Tidak Beresiko' => 'Tidak Beresiko', 'Beresiko Ringan' => 'Beresiko Ringan', 'Beresiko Sedang' => 'Beresiko Sedang', 'Beresiko Tinggi' => 'Beresiko Tinggi'];
            echo $form->field($model, 'mstr_resiko_jatuh_kategori', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_resiko_jatuh_kategori)->label(false);
            $mstr_resiko_jatuh_kategori = HelperGeneral::getValueCustomRadio($mstr_resiko_jatuh_kategori, $model->mstr_resiko_jatuh_kategori);
            ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_resiko_jatuh_metode') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_resiko_jatuh_metode = ['HUMPTY DUMPTY' => 'HUMPTY DUMPTY', 'MORSE' => 'MORSE', 'EDMUNSON' => 'EDMUNSON'];
            echo $form->field($model, 'mstr_resiko_jatuh_metode', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_resiko_jatuh_metode)->label(false);
            $mstr_resiko_jatuh_metode = HelperGeneral::getValueCustomRadio($mstr_resiko_jatuh_metode, $model->mstr_resiko_jatuh_metode);
            ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_resiko_jatuh_langkah_pencegahan') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_resiko_jatuh_langkah_pencegahan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jelaskan'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_dekubitus') ?></label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $mstr_dekubitus = ['Tidak' => 'Tidak'];
            echo $form->field($model, 'mstr_dekubitus', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_dekubitus)->label(false);
            $mstr_dekubitus = HelperGeneral::getValueCustomRadio($mstr_dekubitus, $model->mstr_dekubitus);
            ?>
          </td>
          <td colspan="7">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[mstr_dekubitus]" id="mstr_dekubitus" type="radio" value="<?= $mstr_dekubitus['v'] ?>" <?= $mstr_dekubitus['c'] ?>>
                </div>
              </div>
              <input id="mstr_dekubitus_it" placeholder="Jika ada, lokasi...." type="text" value="<?= $mstr_dekubitus['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_diet') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_diet = ['MB' => 'MB', 'ML' => 'ML', 'NGT' => 'NGT'];
            echo $form->field($model, 'mstr_diet', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_diet)->label(false);
            $mstr_diet = HelperGeneral::getValueCustomRadio($mstr_diet, $model->mstr_diet);
            ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_mobilisasi') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?php
            $mstr_mobilisasi = ['Jalan' => 'Jalan', 'Tempat Tidur' => 'Tempat Tidur', 'Duduk' => 'Duduk'];
            echo $form->field($model, 'mstr_mobilisasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_mobilisasi)->label(false);
            $mstr_mobilisasi = HelperGeneral::getValueCustomRadio($mstr_mobilisasi, $model->mstr_mobilisasi);
            ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_ambulasi') ?></label></td>
          <td><label>:</label></td>
          <td colspan="2">
            <?php
            $mstr_ambulasi = ['Mandiri' => 'Mandiri', 'Dibantu' => 'Dibantu'];
            echo $form->field($model, 'mstr_ambulasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($mstr_ambulasi)->label(false);
            $mstr_ambulasi = HelperGeneral::getValueCustomRadio($mstr_ambulasi, $model->mstr_ambulasi);
            ?>
          </td>
          <td colspan="6">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[mstr_ambulasi]" id="mstr_ambulasi" type="radio" value="<?= $mstr_ambulasi['v'] ?>" <?= $mstr_ambulasi['c'] ?>>
                </div>
              </div>
              <input id="mstr_ambulasi_it" placeholder="Lainnya...." type="text" value="<?= $mstr_ambulasi['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_obat_oral') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_obat_oral', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_ivyd') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_ivyd', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_obat_injeksi') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_obat_injeksi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td class="text-left bg-lightblue" colspan="10"><b>Alat medis yang terpasang</b></td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_amp_iv_catch_no') ?></label></td>
          <td><label>:</label></td>
          <td>
            <?= $form->field($model, 'mstr_amp_iv_catch_no', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td><label><?= $model->getAttributeLabel('mstr_amp_iv_catch_tgl_pasang') ?>:</label></td>
          <td>
            <?= $form->field($model, 'mstr_amp_iv_catch_tgl_pasang', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'date', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_ngt_ogt_no') ?></label></td>
          <td><label>:</label></td>
          <td>
            <?= $form->field($model, 'mstr_ngt_ogt_no', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td><label><?= $model->getAttributeLabel('mstr_ngt_ogt_tgl_pasang') ?>:</label></td>
          <td>
            <?= $form->field($model, 'mstr_ngt_ogt_tgl_pasang', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'date', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_catheter_no') ?></label></td>
          <td><label>:</label></td>
          <td>
            <?= $form->field($model, 'mstr_catheter_no', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td><label><?= $model->getAttributeLabel('mstr_catheter_tgl_pasang') ?>: </label></td>
          <td>
            <?= $form->field($model, 'mstr_catheter_tgl_pasang', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'date', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_tindakan_medis_yg_sudah_dilakukan') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_tindakan_medis_yg_sudah_dilakukan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_tindakan_keperawatan_yg_sudah_dilakukan') ?>: </label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_tindakan_keperawatan_yg_sudah_dilakukan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_pemeriksaan_diagnosis_yg_sudah_dilakukan') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_pemeriksaan_diagnosis_yg_sudah_dilakukan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td><label><?= $model->getAttributeLabel('mstr_hal_yg_diperhatikan_dan_dokumen') ?></label></td>
          <td><label>:</label></td>
          <td colspan="8">
            <?= $form->field($model, 'mstr_hal_yg_diperhatikan_dan_dokumen', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          if (!$model->mstr_batal) {
            if (!$model->mstr_final) {
              echo $form->field($model, 'mstr_final')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Final','handleWidth' => 50,
                  'offText' => 'Draf',
                  'onColor' => 'success',
                  'offColor' => 'danger',
                ]
              ])->label(false);
            } else {

              echo $form->field($model, 'mstr_batal')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Batal',
                  'offText' => 'Non-batal',
                  'onColor' => 'danger',
                  'offColor' => 'success',
                ]
              ])->label(false);
            }
            echo Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->mstr_id]);
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            if (!$model->mstr_final) {
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-trash-alt"></i> Hapus']), ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/serah-terima-ruangan-pasien-medis/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->mstr_id])]);
            }
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/serah-terima-ruangan-pasien-medis/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          } else {
            echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
            echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/serah-terima-ruangan-pasien-medis/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          }
          echo Html::button(Yii::t('app', '{title}', ['title' => (($model->mstr_batal) ? 'NB:Doc.Batal' : (($model->mstr_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>