<?php

use app\components\DynamicFormWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use app\components\HelperSpesial;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
// use kartik\typeahead\Typeahead;

$this->title = 'Registrasi Tim Operasi';
Pjax::begin(['id' => 'pjform', 'timeout' => false]);
$this->registerJs($this->render('_form_create_ready.js'));
?>

<style>
  .dynamicform_wrapper .form-options-item .form-control {
    font-size: 0.7rem !important;
  }
</style>
<hr />
<?php $form = ActiveForm::begin([
  'id' => 'af',
]); ?>

<?= $form->field($model, "to_ruang_asal_pl_id")->hiddenInput()->label(false);
?>
<div class="row">
  <div class="col-lg-11">
    <div class="row">
      <div class="col-lg-12">
        <div style="margin-bottom:0px;text-align:center" class="alert alert-warning alert-dismissible">
          <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
          <h5 style="margin-bottom: 0;"><i class="icon fas fa-syringe"></i> Tindakan Operasi di <b>COT / OK (GROUND, IRD dan IBS)</b></h5>
        </div>
      </div>
    </div>
    <div class='row'>
      <div class="col-lg-3"></div>
      <div class="col-lg-6" style="font-size: 12pt;">
        <table class="table table-sm">
          <tr>
            <td style="width:29%;">No.RM</td>
            <td style="width:1%;">:</td>
            <td><b><?= $chk_pasien['registrasi']['pasien_kode'] ?></b></td>
          </tr>
          <tr>
            <td>No.Registrasi</td>
            <td>:</td>
            <td><b><?= $chk_pasien['registrasi']['kode'] ?></b></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td><b><?= $chk_pasien['registrasi']['pasien']['nama'] ?></b></td>
          </tr>
          <tr>
            <td>Ruangan</td>
            <td>:</td>
            <td><b><?= ($chk_pasien['unit'] ? $chk_pasien['unit']['nama'] : "kosong") ?></b></td>
          </tr>
          <tr>
            <td>Tgl.Masuk</td>
            <td>:</td>
            <td><b><?= date('d-m-Y H:i', strtotime($chk_pasien['tgl_masuk'])) ?></b></td>
          </tr>
        </table>
      </div>
      <div class="col-lg-3"></div>
    </div>
    <div class='row'>
      <div class="col-lg-3">
        <?php echo $form->field($model, 'to_diagnosa_medis_pra_bedah')->textarea(['rows' => 2])->label('Diagnosa : <b><span style="font-size: 10px;color: #000000;important;"><u><i>(Gunakan Tanda "@" Untuk Bantuan)</i></u></span></b>'); ?>
      </div>

      <!-- <div class="col-lg-4">
        <?php //echo $form->field($model, 'to_diagnosa_medis_pasca_bedah')->textarea(['rows' => 2, 'disabled' => 'disabled'])->label('Diagnosis Pasca Bedah: <b><span style="font-size: 10px;color: #000000;important;"><u><i>(Gunakan Tanda "@" Bantuan Pengetikan Diagnosis)</i></u></span></b>'); 
        ?>
      </div> -->

      <div class="col-lg-3">
        <?php echo $form->field($model, 'to_tindakan_operasi')->textarea(['rows' => 2])->label('Tindakan : <b><span style="font-size: 10px;color: #000000;important;"><u><i>(Gunakan Tanda "@" Untuk Bantuan)</i></u></span></b>'); ?>
      </div>

      <div class="col-lg-3">
        <?php echo $form->field($model, 'to_tanggal_operasi')->textInput(['type' => 'date'])->label('Tanggal Operasi :');
        ?>
      </div>

      <div class="col-lg-3">
        <?php
        echo $form->field($model, "to_ok_unt_id")->widget(Select2::classname(), [
          'data' => str_replace("KAMAR OPERASI", "", HelperSpesial::getListUnitOK(false, true)),
          'theme' => Select2::THEME_KRAJEE,
          'options' => ['placeholder' => 'Pilih Kamar Operasi ...'],
          // 'size' => Select2::SMALL,
          'pluginOptions' => [
            'allowClear' => true,
          ],
        ])->label('Kamar Operasi :')
        ?>
      </div>
    </div>
    <!-- <div class='row'> -->
    <!-- <div class="col-lg-4">
        <?php //echo $form->field($model, 'to_jenis_operasi_cito')->inline()->radioList(['1' => 'Cyto', '0' => 'Elektif'])->label('Jenis Operasi :') 
        ?>
      </div> -->
    <!-- </div> -->
    <div class="row">
      <div class="col-lg-12">
        <?php DynamicFormWidget::begin([
          'widgetContainer' => 'dynamicform_wrapper',
          'widgetBody' => '.form-options-body',
          'widgetItem' => '.form-options-item',
          'min' => 1,
          'insertButton' => '.add-item',
          'deleteButton' => '.delete-item',
          'model' => $modelDetails[0],
          'formId' => 'af',
          'formFields' => [
            'tod_jo_id',
            'tod_pgw_id'
          ],
        ]); ?>
        <table class="table-list-item table table-bordered table-hover" style="width: 100%;">
          <thead class="bg-gradient-success" style="text-align: center;">
            <th style="width: 1%">Aksi</th>
            <th style="width: 1%">NO</th>
            <th style="width: 98%">
              <div class="row" style="padding-left: 8px; padding-right: 8px;">
                <div style="width: 30%; padding-left: 1px; padding-right: 1px;">
                  Jabatan
                </div>
                <div style="width: 70%; padding-left: 1px; padding-right: 1px;">
                  Dokter Operator/Dokter Anestesi/Perawat/Penata Anestesi
                </div>
              </div>
            </th>
          </thead>
          <tbody class="form-options-body">
            <?php foreach ($modelDetails as $i => $modelDetail) : ?>
              <tr class="form-options-item">
                <td style="text-align: center;">
                  <button type="button" class="delete-item btn btn-danger btn-xs" title="Hapus Item">
                    <i class="fas fa-trash-alt"></i>
                  </button>
                </td>
                <td style="text-align: center;">
                  <span class="nomor">
                    <?= ($i + 1) ?>
                  </span>
                </td>
                <td>
                  <div class="row" style="padding-left: 8px; padding-right: 8px;">
                    <div style="width: 30%; padding-left: 1px; padding-right: 1px;">
                      <?= $form->field($modelDetail, "[{$i}]tod_jo_id")->widget(Select2::classname(), [
                        'data' => $referensi['jabatan'],
                        'theme' => Select2::THEME_KRAJEE,
                        'options' => ['placeholder' => 'Pilih Jabatan'],
                        // 'size' => Select2::SMALL,
                        'pluginOptions' => [
                          'allowClear' => true,
                        ],
                      ])->label(false) ?>
                    </div>
                    <div style="width: 70%; padding-left: 1px; padding-right: 1px;">
                      <?= $form->field($modelDetail, "[{$i}]tod_pgw_id")->widget(Select2::classname(), [
                        'data' => $referensi['pegawai'],
                        'theme' => Select2::THEME_KRAJEE,
                        'options' => ['placeholder' => 'Pilih Pegawai'],
                        // 'size' => Select2::SMALL,
                        'pluginOptions' => [
                          'allowClear' => true,
                        ],
                      ])->label(false) ?>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <td class="text-center">
                <button type="button" class="add-item btn btn-primary btn-xs" title="Tambah Item">
                  <i class="fas fa-plus"></i>
                </button>
              </td>
              <td style="text-align: center;" colspan="2"></td>
            </tr>
          </tfoot>
        </table>
        <?php DynamicFormWidget::end(); ?>
      </div>
    </div>
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">

          <?= Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/layanan-operasi/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<hr />
<?php Pjax::end(); ?>