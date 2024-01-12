<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\bedahsentral\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPostOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<?php Pjax::begin(['id' => 'pjform']); ?>
<style type="text/css">
  .table-form th,
  .table-form td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
    border: 0px;
  }
</style>
<div class="medis-intra-operasi-perawat-form">
  <?php
  $this->registerJs($this->render('_form_update_ready.js'));
  // echo'</pre>';print_r($model);die();
  ?>
  <?php $form = ActiveForm::begin(['id' => 'iop']); ?>
  <?= $form->field($model, 'iop_to_id')->hiddenInput()->label(false); ?>
  <div class="row">
    <div class="col-lg-11">
      <table class="table table-sm table-form">
        <!-- <tr>
						<td><label>Jam masuk OK</label> </td>
						<td> <label>:</label> </td>
						<td>
							<?= $form->field($model, 'iop_jam_masuk_ok', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
						</td>
					</tr>
					<tr>
						<td><label>Jam Keluar OK</label></td>
						<td><label>:</label></td>
						<td>
							<?= $form->field($model, 'iop_jam_keluar_ok', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
						</td>
					</tr> -->
        <tr>
          <td><label>Jam dimulai</label></td>
        </tr>
        <tr>
          <td><label>Anestesi</label></td>
          <td><label>:</label></td>
          <td>
            <?= $form->field($model, 'iop_jam_mulai_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?> </td>
          <td><label>s/d </label></td>
          <td>
            <?= $form->field($model, 'iop_jam_selesai_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
          <td align="right"><label>Pembedahan</label></td>
          <td>
            <?= $form->field($model, 'iop_jam_mulai_bedah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?> </td>
          <td><label>s/d </label></td>
          <td>
            <?= $form->field($model, 'iop_jam_selesai_bedah', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
      </table>

      <table width="100%" border="1" class="table table-sm table-form">
        <tr>
          <th colspan="7" class="text-left bg-lightblue">B. INTRA OPERASI</th>
        </tr>
        <tr>
          <td colspan="2" style="width:20%;"><label><?= $model->getAttributeLabel('iop_jenis_pembiusan') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_jenis_pembiusan = ['Umum' => 'Umum', 'Spinal' => 'Spinal', 'Lokal' => 'Lokal'];
            echo $form->field($model, 'iop_jenis_pembiusan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_jenis_pembiusan)->label(false);

            $iop_jenis_pembiusan = HelperGeneral::getValueCustomRadio($iop_jenis_pembiusan, $model->iop_jenis_pembiusan);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_jenis_pembiusan]" id="iop_jenis_pembiusan" type="radio" value="<?= $iop_jenis_pembiusan['v'] ?>" <?= $iop_jenis_pembiusan['c'] ?>>
                </div>
              </div>
              <input id="iop_jenis_pembiusan_it" placeholder="Lain-lain ......." type="text" value="<?= $iop_jenis_pembiusan['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_type_operasi') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="4">
            <?php
            $iop_type_operasi = ['Elektif' => 'Elektif', 'Cyto' => 'Cyto', 'ODS' => 'ODS'];
            echo $form->field($model, 'iop_type_operasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_type_operasi)->label(false);
            $iop_type_operasi = HelperGeneral::getValueCustomRadio($iop_type_operasi, $model->iop_type_operasi);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_posisi_kanul_intravena') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_posisi_kanul_intravena = ['Ta. Ka/Ki' => 'Ta. Ka/Ki', 'Ka. Ka/Ki' => 'Ka. Ka/Ki', 'Arteri Line' => 'Arteri Line', 'CVP' => 'CVP'];
            echo $form->field($model, 'iop_posisi_kanul_intravena', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_posisi_kanul_intravena)->label(false);
            $iop_posisi_kanul_intravena = HelperGeneral::getValueCustomRadio($iop_posisi_kanul_intravena, $model->iop_posisi_kanul_intravena);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_posisi_kanul_intravena]" id="iop_posisi_kanul_intravena" type="radio" value="<?= $iop_posisi_kanul_intravena['v'] ?>" <?= $iop_posisi_kanul_intravena['c'] ?>>
                </div>
              </div>
              <input id="iop_posisi_kanul_intravena_it" placeholder="Lain-lain ......." type="text" value="<?= $iop_posisi_kanul_intravena['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_posisi_operasi') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="4">
            <?php
            $iop_posisi_operasi = ['Terlentang' => 'Terlentang', 'Tengkurap' => 'Tengkurap', 'Lithotomi' => 'Lithotomi', 'Lateral' => 'Lateral'];
            echo $form->field($model, 'iop_posisi_operasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_posisi_operasi)->label(false);
            $iop_posisi_operasi = HelperGeneral::getValueCustomRadio($iop_posisi_operasi, $model->iop_posisi_operasi);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_jenis_operasi') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="4">
            <?php
            $iop_jenis_operasi = ['Bersih' => 'Bersih', 'kotor' => 'kotor', 'Bersih terkontaminasi' => 'Bersih terkontaminasi'];
            echo $form->field($model, 'iop_jenis_operasi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_jenis_operasi)->label(false);
            $iop_jenis_operasi = HelperGeneral::getValueCustomRadio($iop_jenis_operasi, $model->iop_jenis_operasi);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_posisi_tangan') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="4">
            <?php
            $iop_posisi_tangan = ['Terlipat' => 'Terlipat', 'Terlentang' => 'Terlentang'];
            echo $form->field($model, 'iop_posisi_tangan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_posisi_tangan)->label(false);
            $iop_posisi_tangan = HelperGeneral::getValueCustomRadio($iop_posisi_tangan, $model->iop_posisi_tangan);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_kateter_urin') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_kateter_urin = ['Tidak' => 'Tidak', 'Ya' => 'Ya'];

            echo $form->field($model, 'iop_kateter_urin', ['options' => ['class' => 'form-group custom-margin', 'style' => 'margin-bottom:0']])->radioList($iop_kateter_urin, [
              'item' => function ($index, $label, $name, $checked, $value) {
                return '<div class="custom-control custom-radio custom-control-inline">
                  <input onClick = "kateterurin(this.id)" class="custom-control-input" type="radio" id="r' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>
                <label onClick = "kateterurin()" for="r' . $index . '" class="custom-control-label"> ' . $label . '</label>
                </div>';
              }
            ])->label(false);
            $iop_kateter_urin = HelperGeneral::getValueCustomRadio($iop_kateter_urin, $model->iop_kateter_urin);
            // echo "<pre>";
            // print_r($iop_kateter_urin);
            // die;
            ?>
            <div id="jikaya" style="margin-bottom:1rem;<?= (($iop_kateter_urin['v']) ? 'visibility:visible' : 'display:none') ?>">
              <div class="custom-control custom-radio custom-control-inline">
                <input onClick="dalamok(this.id)" class="custom-control-input" type="radio" id="customRadio0" name="<?= $model->getModelClasName() ?>[iop_kateter_urin]" value="Dalam OK" <?= ($iop_kateter_urin['v'] == 'Dalam OK' ? "checked" : "") ?>>
                <label onClick="dalamok()" for="customRadio0" class="custom-control-label">Dalam OK</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input onClick="dalamok(this.id)" class="custom-control-input" type="radio" id="customRadio1" name="<?= $model->getModelClasName() ?>[iop_kateter_urin]" value="Ruangan" <?= ($iop_kateter_urin['v'] == 'Ruangan' ? "checked" : "") ?>>
                <label onClick="dalamok()" for="customRadio1" class="custom-control-label">Ruangan</label>
              </div>
            </div>
          </td>
          <td colspan="3" id="ku_dipasang_oleh" style="<?= (($iop_kateter_urin['v'] == 'Dalam OK') ? 'visibility:visible' : 'display:none') ?>">
            <?= $form->field($model, 'iop_ku_dipasang_oleh')->widget(Select2::classname(), [
              'data' => HelperSpesial::getListPegawai(1, false, true),
              'options' => ['placeholder' => 'Dipasang oleh '],
              'size' => Select2::SMALL,
              'pluginOptions' => [
                'allowClear' => false,
              ],

            ])->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label>Disenfeksi Kulit</label></td>
          <td><label>:</label></td>
          <td colspan="4">
            <?php
            $iop_disenfeksi_kulit = [
              'Betadin' => 'Betadin',
              'Alkohol 70%' => 'Alkohol 70%',
              'Microsil/chlorhexidine 4%' => 'Microsil/chlorhexidine 4%'
            ];

            echo  $form->field($model, 'iop_disenfeksi_kulit', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->checkboxList($iop_disenfeksi_kulit)->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_insisi_kulit') ?> </label></td> <!-- radiobutton -->
          <td><label>:</label></td>
          <td>
            <?php
            $iop_insisi_kulit = ['Mediana' => 'Mediana', 'Pfanenstil' => 'Pfanenstil', 'Mc. Burney' => 'Mc. Burney'];
            echo $form->field($model, 'iop_insisi_kulit', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_insisi_kulit)->label(false);
            $iop_insisi_kulit = HelperGeneral::getValueCustomRadio($iop_insisi_kulit, $model->iop_insisi_kulit);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_insisi_kulit]" id="iop_insisi_kulit" type="radio" value="<?= $iop_insisi_kulit['v'] ?>" <?= $iop_insisi_kulit['c'] ?>>
                </div>
              </div>
              <input id="iop_insisi_kulit_it" placeholder="Lain-lain ........" type="text" value="<?= $iop_insisi_kulit['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_esu') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_esu = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];

            echo $form->field($model, 'iop_esu', ['options' => ['class' => 'form-group custom-margin']])->radioList($iop_esu, [
              'item' => function ($index, $label, $name, $checked, $value) {
                return '<div class="custom-control custom-radio custom-control-inline">
                  <input onClick = "esu(this.id)" class="custom-control-input" type="radio" id="esu' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>
                <label onClick = "esu()" for="esu' . $index . '" class="custom-control-label"> ' . $label . '</label>
                </div>';
              }
            ])->label(false);
            $iop_esu = HelperGeneral::getValueCustomRadio($iop_esu, $model->iop_esu);
            ?>
          </td>
          <td colspan="3" id="esudipasang" style="<?= (($model->iop_esu == 'Ya') ? "visibility:visible" : "display:none") ?>">
            <?= $form->field($model, 'iop_esu_dipasang_oleh')->widget(Select2::classname(), [
              'data' => HelperSpesial::getListPegawai(1, false, true),
              'options' => ['placeholder' => 'Dipasang oleh '],
              'size' => Select2::SMALL,
              'pluginOptions' => [
                'allowClear' => false,
              ],

            ])->label(false);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_lok_ntrl_elektroda') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_lok_ntrl_elektroda = ['Bokong' => 'Bokong', 'Tungkai Ka/Ki' => 'Tungkai Ka/Ki', 'Bahu' => 'Bahu', 'Paha Ka/ki' => 'Paha Ka/ki'];
            echo $form->field($model, 'iop_lok_ntrl_elektroda', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_lok_ntrl_elektroda)->label(false);
            $iop_lok_ntrl_elektroda = HelperGeneral::getValueCustomRadio($iop_lok_ntrl_elektroda, $model->iop_lok_ntrl_elektroda);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_lok_ntrl_elektroda]" id="iop_lok_ntrl_elektroda" type="radio" value="<?= $iop_lok_ntrl_elektroda['v'] ?>" <?= $iop_lok_ntrl_elektroda['c'] ?>>
                </div>
              </div>
              <input id="iop_lok_ntrl_elektroda_it" placeholder="Lain-lain ........" type="text" value="<?= $iop_lok_ntrl_elektroda['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_pemeriksaan_kulit_pra_bedah') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_pemeriksaan_kulit_pra_bedah = ['Utuh' => 'Utuh', 'Menggelembung' => 'Menggelembung'];
            echo $form->field($model, 'iop_pemeriksaan_kulit_pra_bedah', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_pemeriksaan_kulit_pra_bedah)->label(false);
            $iop_pemeriksaan_kulit_pra_bedah = HelperGeneral::getValueCustomRadio($iop_pemeriksaan_kulit_pra_bedah, $model->iop_pemeriksaan_kulit_pra_bedah);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_pemeriksaan_kulit_pra_bedah]" id="iop_pemeriksaan_kulit_pra_bedah" type="radio" value="<?= $iop_pemeriksaan_kulit_pra_bedah['v'] ?>" <?= $iop_pemeriksaan_kulit_pra_bedah['c'] ?>>
                </div>
              </div>
              <input id="iop_pemeriksaan_kulit_pra_bedah_it" placeholder="Lain-lain ........" type="text" value="<?= $iop_pemeriksaan_kulit_pra_bedah['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_pemeriksaan_kulit_pasca_bedah') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_pemeriksaan_kulit_pasca_bedah = ['Utuh' => 'Utuh', 'Menggelembung' => 'Menggelembung'];
            echo $form->field($model, 'iop_pemeriksaan_kulit_pasca_bedah', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_pemeriksaan_kulit_pasca_bedah)->label(false);
            $iop_pemeriksaan_kulit_pasca_bedah = HelperGeneral::getValueCustomRadio($iop_pemeriksaan_kulit_pasca_bedah, $model->iop_pemeriksaan_kulit_pasca_bedah);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_pemeriksaan_kulit_pasca_bedah]" id="iop_pemeriksaan_kulit_pasca_bedah" type="radio" value="<?= $iop_pemeriksaan_kulit_pasca_bedah['v'] ?>" <?= $iop_pemeriksaan_kulit_pasca_bedah['c'] ?>>
                </div>
              </div>
              <input id="iop_pemeriksaan_kulit_pasca_bedah_it" placeholder="Lain-lain ........" type="text" value="<?= $iop_pemeriksaan_kulit_pasca_bedah['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_unit_penghangat') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_unit_penghangat = ['Ya' => 'Ya', 'Tidak' => 'Tidak'];

            echo $form->field($model, 'iop_unit_penghangat', ['options' => ['class' => 'form-group custom-margin']])->radioList($iop_unit_penghangat, [
              'item' => function ($index, $label, $name, $checked, $value) {
                return '<div class="custom-control custom-radio custom-control-inline">
                  <input onClick = "up(this.id)" class="custom-control-input" type="radio" id="up' . $index . '" name="' . $name . '" value="' . $value . '" ' . ($checked ? "checked" : "") . '>
                <label onClick = "up()" for="up' . $index . '" class="custom-control-label"> ' . $label . '</label>
                </div>';
              }
            ])->label(false);
            $iop_unit_penghangat = HelperGeneral::getValueCustomRadio($iop_unit_penghangat, $model->iop_unit_penghangat);
            ?>
          </td>
          <td colspan="3" style="width: 40%;">
            <div style="<?= ($model->iop_unit_penghangat == 'Ya' ? "visibility:visible" : "display:none") ?>" id="up">
              <div style="display: flex;">
                <!-- <div id="up"> -->
                <?= $form->field($model, 'iop_unit_penghangat_jam_mulai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jam Mulai'])->label(false); ?>

                <?= $form->field($model, 'iop_unit_penghangat_temperatur', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'number', 'class' => 'form-control form-control-sm', 'placeholder' => 'Temperatur'])->label(false); ?>

                <?= $form->field($model, 'iop_unit_penghangat_jam_selesai', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => 'Jam Selesai'])->label(false); ?>
                <!-- </div> -->
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_tourniquet') ?> </label></td> <!-- radiobutton -->
          <td>:</td>
          <td>
            <?php
            $iop_tourniquet = ['Tidak' => 'Tidak', 'Lengan Ka/Ki' => 'Lengan Ka/Ki', 'Paha Ka/Ki' => 'Paha Ka/Ki'];
            echo $form->field($model, 'iop_tourniquet', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_tourniquet)->label(false);
            $iop_tourniquet = HelperGeneral::getValueCustomRadio($iop_tourniquet, $model->iop_tourniquet);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_tourniquet]" id="iop_tourniquet" type="radio" value="<?= $iop_tourniquet['v'] ?>" <?= $iop_tourniquet['c'] ?>>
                </div>
              </div>
              <input id="iop_tourniquet_it" placeholder="Jika ya, jelaskan..." type="text" value="<?= $iop_tourniquet['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_implant') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_implant = ['Tidak' => 'Tidak'];
            echo $form->field($model, 'iop_implant', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_implant)->label(false);
            $iop_implant = HelperGeneral::getValueCustomRadio($iop_implant, $model->iop_implant);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_implant]" id="iop_implant" type="radio" value="<?= $iop_implant['v'] ?>" <?= $iop_implant['c'] ?>>
                </div>
              </div>
              <input id="iop_implant_it" placeholder="Sebutkan Jika Ada, jenis dan lokasi" type="text" value="<?= $iop_implant['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_drainage') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_drainage = ['Tidak' => 'Tidak'];
            echo $form->field($model, 'iop_drainage', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_drainage)->label(false);
            $iop_drainage = HelperGeneral::getValueCustomRadio($iop_drainage, $model->iop_drainage);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_drainage]" id="iop_drainage" type="radio" value="<?= $iop_drainage['v'] ?>" <?= $iop_drainage['c'] ?>>
                </div>
              </div>
              <input id="iop_drainage_it" placeholder="Sebutkan Jika Ada, jenis dan lokasi" type="text" value="<?= $iop_drainage['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_irigasi_luka') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_irigasi_luka = ['Tidak' => 'Tidak'];
            echo $form->field($model, 'iop_irigasi_luka', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_irigasi_luka)->label(false);
            $iop_irigasi_luka = HelperGeneral::getValueCustomRadio($iop_irigasi_luka, $model->iop_irigasi_luka);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_irigasi_luka]" id="iop_irigasi_luka" type="radio" value="<?= $iop_irigasi_luka['v'] ?>" <?= $iop_irigasi_luka['c'] ?>>
                </div>
              </div>
              <input id="iop_irigasi_luka_it" placeholder="Sebutkan Jika Ada" type="text" value="<?= $iop_irigasi_luka['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_tamplon') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_tamplon = ['Tidak' => 'Tidak'];
            echo $form->field($model, 'iop_tamplon', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_tamplon)->label(false);
            $iop_tamplon = HelperGeneral::getValueCustomRadio($iop_tamplon, $model->iop_tamplon);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_tamplon]" id="iop_tamplon" type="radio" value="<?= $iop_tamplon['v'] ?>" <?= $iop_tamplon['c'] ?>>
                </div>
              </div>
              <input id="iop_tamplon_it" placeholder="Sebutkan Jika Ada, jumlah dan panjang" type="text" value="<?= $iop_tamplon['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_pemeriksaan_jaringan') ?> </label></td>
          <td><label>:</label></td>
          <td>
            <?php
            $iop_pemeriksaan_jaringan = ['Tidak' => 'Tidak'];
            echo $form->field($model, 'iop_pemeriksaan_jaringan', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($iop_pemeriksaan_jaringan)->label(false);
            $iop_pemeriksaan_jaringan = HelperGeneral::getValueCustomRadio($iop_pemeriksaan_jaringan, $model->iop_pemeriksaan_jaringan);
            ?>
          </td>
          <td colspan="3">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input name="<?= $model->getModelClasName() ?>[iop_pemeriksaan_jaringan]" id="iop_pemeriksaan_jaringan" type="radio" value="<?= $iop_pemeriksaan_jaringan['v'] ?>" <?= $iop_pemeriksaan_jaringan['c'] ?>>
                </div>
              </div>
              <input id="iop_pemeriksaan_jaringan_it" placeholder="Sebutkan jenis jaringan Jika ya" type="text" value="<?= $iop_pemeriksaan_jaringan['v'] ?>" class="form-control form-control-sm">
            </div>
          </td>
        </tr>

        <tr>
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_masalah') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="4">
            <?= $form->field($model, 'iop_masalah', [
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
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_tindakan') ?></label><span style="font-size: 10px;color: #000000;important;"></span></td>
          <td><label>:</label></td>
          <td colspan="4">
            <?= $form->field($model, 'iop_tindakan', [
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
          <td colspan="2"><label><?= $model->getAttributeLabel('iop_evaluasi') ?> </label></td>
          <td><label>:</label></td>
          <td colspan="4"><?= $form->field($model, 'iop_evaluasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?></td>
        </tr>
      </table>

    </div>
    <div class="col-lg-1">
      <div class="row icon-sticky">
        <div class="col-lg-12">
          <div class="btn-group-vertical">
            <?php
            if (!$model->iop_batal) {
              if (!$model->iop_final) {
                echo $form->field($model, 'iop_final')->widget(SwitchInput::classname(), [
                  'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Final', 'handleWidth' => 50,
                    'offText' => 'Draf',
                    'onColor' => 'success',
                    'offColor' => 'danger',
                  ]
                ])->label(false);
              } else {

                echo $form->field($model, 'iop_batal')->widget(SwitchInput::classname(), [
                  'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Batal',
                    'offText' => 'Non-batal',
                    'onColor' => 'danger',
                    'offColor' => 'success',
                  ]
                ])->label(false);
              }
              echo Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->iop_id]);
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
              if (!$model->iop_final) {
                echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-trash-alt"></i> Hapus']), ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/intra-operasi-perawat-pasien/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->iop_id])]);
              }
              echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/intra-operasi-perawat-pasien/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
              if ($model->iop_final) {
                echo Html::a('<i class="fas fa-print"></i> Print', null, [
                  'class' => 'btn btn-danger btn-cetak',
                  'data-id' => Yii::$app->request->get('subid')
                ]);
              }
            } else {
              echo Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']);
              echo Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-plus-circle"></i> Tambah Baru']), ['/intra-operasi-perawat-pasien/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
            }
            // echo Html::button(Yii::t('app', '{title}', ['title' => (($model->iop_batal) ? 'NB:Doc.Batal' : (($model->iop_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>