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
use yii\helpers\ArrayHelper;
use app\models\sdm\Pegawai;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPostOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */

?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
<div class="medis-post-operasi-perawat-form">
  <?php
  $this->registerJs($this->render('_form_create_ready.js'));
  // echo'</pre>';print_r($model);die();
  ?>
  <?php $form = ActiveForm::begin(['id' => 'incon']); ?>
  <?= $form->field($model, 'incon_to_id')->hiddenInput()->label(false); ?>
  <?= $form->field($model, 'incon_batal')->hiddenInput()->label(false); ?>
  <div class="row">
    <div class="col-lg-11">
      <h2 align="center">INFORM CONSENT TINDAKAN KEDOKTERAN</h2>
      <p align="center">
        <?= $form->field($model, 'incon_tindakan_inform_consent')->textarea(['rows' => 2, 'placeholder' => 'Ketik disini... (gunakan @ untuk bantuan)'])->label(false); ?>

      </p>
      <p>Isilah dengan salah satu jenis tindakan seperti; Pembedahan, Pembiusan, Transfusi Darah, Kuretase, Vacum Ekstraksi, Vena seksi, Pemasangan Implant/Protese, dll.</p>
      <table border="1" cellspacing="0" width="100%" class="table table-sm table-form">
        <tr>
          <th class="text-left bg-lightblue" colspan="6" style="height: 50px;">PEMBERIAN INFORMASI</th>
        </tr>
        <tr>

          <td colspan="2"><label>Dokter Pelaksana Tindakan : </label></td>
          <td colspan="4">
            <?= $form->field($model, 'incon_dokter_pgw_id')->widget(Select2::classname(), [
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
        <tr>
          <td colspan="2"><label>Pemberi Informasi : </label></td>
          <td colspan="4">
            <?= $form->field($model, 'incon_pemberi_informasi_pgw_id')->widget(Select2::classname(), [
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
        <tr>
          <td colspan="2"><label>Penerima Informasi/Pemberi Persetujuan :</label></td>
          <td colspan="4">
            <?= $form->field($model, 'incon_penerima_informasi')->widget(Select2::classname(), [
              'data' => ['Pasien' => 'Pasien', 'Bukan Pasien' => 'Bukan Pasien'],
              'size' => Select2::SMALL,
              'options' => ['placeholder' => 'Pilih', 'id' => 'chois'],
              'pluginOptions' => [
                'allowClear' => false,
              ],

            ])->label(false);
            ?>
            <div id="hit" style="display: none;">
              <?= $form->field($model, 'incon_hubungan_keluarga')->widget(Select2::classname(), [
                'data' => ['Suami' => 'Suami', 'Istri' => 'Istri', 'Adik' => 'Adik', 'Kakak' => 'Kakak'],
                'size' => Select2::SMALL,
                'options' => ['placeholder' => 'Hubungan dengan pasien'],
                'pluginOptions' => [
                  'allowClear' => false,
                ],

              ])->label(false);
              ?>

              <?= $form->field($model, 'incon_keluarga_nama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Nama'])->label(false); ?>
              <?= $form->field($model, 'incon_keluarga_umur', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Umur'])->label(false); ?>
              <?php
              $incon_keluarga_jenis_kelamin = ['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'];
              echo $form->field($model, 'incon_keluarga_jenis_kelamin', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($incon_keluarga_jenis_kelamin)->label(false);
              $incon_keluarga_jenis_kelamin = HelperGeneral::getValueCustomRadio($incon_keluarga_jenis_kelamin, $model->incon_keluarga_jenis_kelamin);
              ?>
              <?= $form->field($model, 'incon_keluarga_alamat', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Alamat'])->label(false); ?>
            </div>
            <?= $form->field($model, 'incon_keluarga_saksi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Saksi Keluarga'])->label(false); ?>

            <?= $form->field($model, 'incon_saksi_pgw_id')->widget(Select2::classname(), [
              'data' => HelperSpesial::getListPegawai(1, false, true),
              'size' => Select2::SMALL,
              'options' => ['placeholder' => 'Pilih saksi'],
              'pluginOptions' => [
                'allowClear' => false
              ],
            ])->label(false);
            ?>
          </td>
        </tr>
        <tr class="text-left bg-lightblue">
          <th style="width:2%;">No</th>
          <th style="width:20%;">JENIS INFORMASI</th>
          <th colspan="3">ISI INFORMASI</th>
        </tr>
        <tr>
          <td>1</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_diagnosis') ?></label></td>
          <td colspan="3">
            <?php echo $form->field($model, 'incon_informasi_diagnosis')->textarea(['rows' => 2])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_dasar_diagnosis') ?></label></td>
          <td colspan="3">
            <?php echo $form->field($model, 'incon_informasi_dasar_diagnosis')->textarea(['rows' => 2])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_tindakan_operasi') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_tindakan_operasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>4</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_tindakan_pembiusan') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_tindakan_pembiusan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>5</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_indikasi_tindakan') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_indikasi_tindakan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>6</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_tata_cara') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_tata_cara', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>7</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_tujuan') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_tujuan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>8</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_resiko') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_resiko', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>9</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_komplikasi') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_komplikasi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>10</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_prognosis') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_prognosis', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>11</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_alternatif_dan_resiko') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_alternatif_dan_resiko', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td>12</td>
          <td><label><?= $model->getAttributeLabel('incon_informasi_pemberian_analgetik_pasca_anestesi') ?></label></td>
          <td colspan="3">
            <?= $form->field($model, 'incon_informasi_pemberian_analgetik_pasca_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '....'])->label(false); ?>
          </td>
        </tr>
        <tr>
          <th colspan="6" class="text-center bg-lightblue">Pernyataan</th>
        </tr>
        <tr>
          <td colspan="6" align="center">
            <?php
            $incon_setuju = ['1' => 'Terima', '0' => 'Tolak'];
            echo $form->field($model, 'incon_setuju', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($incon_setuju)->label(false);
            $incon_setuju = HelperGeneral::getValueCustomRadio($incon_setuju, $model->incon_setuju);
            ?>
          </td>
        </tr>
        <tr>
          <td colspan="3" id="teks">Dengan ini menyatakan bahwa saya telah menerangkan hal-hal diatas secara benar dan jelas dan memberikan kesempatan untuk bertanya dan atau berdiskusi</td>

          <td colspan="3" style="text-align: center;">
            <p>Dokter pemberi informasi</p>
            <p>...........</p>
            <p>Tanda tangan & nama</p>
          </td>
        </tr>
        <tr>
          <td colspan="3" id="teks">Dengan ini menyatakan bahwa saya telah menerima informasi dari dokter sebagaimana diatas yang saya beri tanda dikolom kanannya, dan telah memahaminya</td>
          <td colspan="3" style="text-align: center;">
            <p>Penerima Informasi</p>
            <p>...........</p>
            <p>Tanda tangan & nama</p>
          </td>
        </tr>
        <tr>
          <td colspan="6" id="teks">
            <p>Bila pasien tidak kompeten atau tidak mau menerima informasi maka penerima informasi adalah wali atau keluarga terdekat</p>
          </td>
        </tr>

      </table>
    </div>
    <div class="col-lg-1">
      <div class="row icon-sticky">
        <div class="col-lg-12">
          <div class="btn-group-vertical">
            <?php
            echo $form->field($model, 'incon_final')->widget(SwitchInput::classname(), [
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

            <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/asesmen-awal-perawat-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
  <?php yii\widgets\Pjax::end(); ?>
</div>