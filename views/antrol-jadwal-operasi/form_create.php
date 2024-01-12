<?php

use app\components\HelperSpesial;
use app\models\pendaftaran\KelasRawat;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
// use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Registrasi Antrol Jadwal Operasi';
Pjax::begin(['id' => 'pjform', 'timeout' => false]);
$this->registerJs($this->render('form_create.js'));
?>

<div class="antrol-jadwal-operasi-form">

  <?php $form = ActiveForm::begin([
    'id' => 'form_antrol',
    'action' => '#', // Menentukan action ke '#'
  ]); ?>

  <div class="row">
    <div class="col-lg-11">
      <div class="row">
        <div class="col-lg-6">
          <?php
          // echo $form->field($model, 'pasien_kode')->widget(Select2::classname(), [
          //   'data' => $referensi['pasien'],
          //   'theme' => Select2::THEME_KRAJEE,
          //   'options' => ['placeholder' => 'Pilih Pasien - Ketik No. RM'],
          //   'pluginOptions' => [
          //     'allowClear' => true,
          //   ],
          // ])->label('Pasien : <b><span style="font-size: 13px;color: #000000;important;"><u><i>(Ketik No.RM)</i></u></span></b>');
          ?>
          <?php
          $url = Url::to(['referensi/search-pasien']);
          echo $form->field($model, "pasien_kode")->widget(Select2::classname(), [
            'options' => [
              'id' => 'rm_pasien',
              'class' => 'dynamic-select2',
              'placeholder' => 'Klik disini, Ketik Nama Pasien atau NO.RM Pasien ...',
            ],
            'theme' => Select2::THEME_KRAJEE,
            'pluginOptions' => [
              'allowClear' => true,
              'minimumInputLength' => 3,
              'language' => [
                'errorLoading' => new JsExpression('function () { 
                                return "Menunggu hasil..."; 
                            }'),
                'inputTooShort' => new JsExpression('function () {
                                return "Ketik minimal 3 karakter...";
                            }'),
                'searching' => new JsExpression('function() {
                                return "Mencari...";
                            }'),
              ],
              'ajax' => [
                'url' => $url,
                'dataType' => 'json',
                'data' => new JsExpression('function(params) {
                                return {
                                    search:params.term
                                };
                            }')
              ],
              'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
              'templateResult' => new JsExpression('function(data) {
                            // console.log(data);
                            if(data.loading){
                                return data.text;
                            }else{
                                // console.log(data);
                                if(data.status){
                                    return `${data.text}`;
                                }else{
                                    fmsg.e(data.text);
                                }
                            }
                        }'),
              'templateSelection' => new JsExpression('function (data) { return data.text; }'),
            ],
            'pluginEvents' => [
              "select2:select" => new JsExpression('function(e) {
                        }'),
            ]
          ])->label('Pasien : <b><span style="font-size: 13px;color: red;important;"><u><i>(Ketik No.RM atau Nama Pasien)</i></u></span></b>');
          ?>
        </div>
        <div class="col-lg-6">
          <?= $form->field($model, 'dokter_operator_id')->widget(Select2::classname(), [
            'data' => $referensi['dokter'],
            'theme' => Select2::THEME_KRAJEE,
            'options' => ['placeholder' => 'Pilih Dokter'],
            // 'size' => Select2::SMALL,
            'pluginOptions' => [
              'allowClear' => true,
              // 'minimumInputLength' => 3, // Minimal 2 karakter harus dimasukkan sebelum mencari data
            ],
          ])->label('Dokter Operator :');
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <?= $form->field($model, 'kode_booking')->textInput(['readonly' => true])->label('Kode Booking :') ?>
        </div>
        <div class="col-lg-4">
          <?php echo $form->field($model, 'tgl_operasi')->textInput(['type' => 'date'])->label('Tanggal Operasi :'); ?>
        </div>
        <div class="col-lg-4">
          <?= $form->field($model, 'terlaksana')->dropDownList(
            ['0' => 'Belum', '1' => 'Ya', '2' => 'Batal'],
            // ['prompt' => 'Pilih tipe ...']
          )->label('Terlaksana :') ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <?= $form->field($model, 'debitur_detail_kode')->widget(Select2::classname(), [
            'data' => HelperSpesial::getDebiturDetail(),
            'theme' => Select2::THEME_KRAJEE,
            'options' => ['placeholder' => 'Pilih Debitur ...'],
            // 'size' => Select2::SMALL,
            'pluginOptions' => [
              'allowClear' => true,
            ],
          ])->label('Debitur :') ?>
        </div>
        <div class="col-lg-4">
          <?= $form->field($model, 'no_kartu_bpjs')->textInput(['maxlength' => true, 'id' => 'no_kartu_bpjs'])->label('No Kartu BPJS : <b><span style="font-size: 13px;color: red;important;"><u><i>(Periksa kembali No. BPJS)</i></u></span></b>') ?>
        </div>
        <div class="col-lg-4">
          <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true])->label('No. HP :') ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <?php //echo $form->field($model, 'unit_asal_kode')->textInput()->label('Unit Asal :') 
          ?>
          <?php
          echo $form->field($model, "unit_asal_kode")->widget(Select2::classname(), [
            'data' => str_replace(["RUANG", "POLI"], [""], HelperSpesial::getListUnitLayanan(null, false, true)),
            'theme' => Select2::THEME_KRAJEE,
            'options' => ['placeholder' => 'Pilih Unit Asal ...'],
            // 'size' => Select2::SMALL,
            'pluginOptions' => [
              'allowClear' => true,
            ],
          ])->label('Unit Asal :')
          ?>
        </div>
        <div class="col-lg-4">
          <?php //echo $form->field($model, 'unit_ok_kode')->textInput()->label('Unit OK :') 
          ?>
          <?php
          echo $form->field($model, "unit_ok_kode")->widget(Select2::classname(), [
            'data' => HelperSpesial::getListUnitOK(false, true),
            'theme' => Select2::THEME_KRAJEE,
            'options' => ['placeholder' => 'Pilih Kamar Operasi ...'],
            // 'size' => Select2::SMALL,
            'pluginOptions' => [
              'allowClear' => true,
            ],
          ])->label('Unit OK :')
          ?>
        </div>
        <div class="col-lg-4">
          <?= $form->field($model, 'no_ruang_ok')->textInput(['maxlength' => true])->label('No Ruang OK :') ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <?= $form->field($model, 'tipe')->dropDownList(
            ['1' => 'Cyto', '2' => 'Elektif'],
            // ['prompt' => 'Pilih tipe ...']
          )->label('Tipe :') ?>
        </div>
        <div class="col-lg-3">
          <?php echo $form->field($model, 'tgl_lapor')->textInput(['type' => 'date'])->label('Tanggal Lapor :'); ?>
        </div>
        <div class="col-lg-3">
          <?php echo $form->field($model, 'tgl_rawat')->textInput(['type' => 'date'])->label('Tanggal Rawat :'); ?>
        </div>
        <div class="col-lg-3">
          <?= $form->field($model, 'kelas_inap_kode')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(KelasRawat::getKelasRawat(), 'kode', 'nama'),
            'theme' => Select2::THEME_KRAJEE,
            'options' => ['placeholder' => 'Pilih Kelas Inap ...'],
            // 'size' => Select2::SMALL,
            'pluginOptions' => [
              'allowClear' => true,
            ],
          ])->label('Kelas Inap :') ?>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <?php echo $form->field($model, 'jenis_tindakan')->textarea(['rows' => 3])->label('Jenis Tindakan :'); ?>
        </div>
        <div class="col-lg-4">
          <?php echo $form->field($model, 'diagnosa')->textarea(['rows' => 3])->label('Diagnosa :'); ?>
        </div>
        <div class="col-lg-4">
          <?= $form->field($model, 'keterangan')->textarea(['rows' => 3])->label('Keterangan :'); ?>
        </div>
      </div>
    </div>
    <div class="col-lg-1">
      <div class="row icon-sticky">
        <div class="col-lg-12">
          <div class="btn-group-vertical">
            <button data-url="<?= Url::to(['/antrol-jadwal-operasi/simpan']) ?>" type="submit" id="simpan" class="btn btn-success">
              <i class="fas fa-save"></i> Simpan
            </button>
            <!-- <button type="button" id="segarkan" class="btn btn-warning">
              <i class="fas fa-sync"></i> Segarkan
            </button> -->
            <a href="<?= Url::to(['/antrol-jadwal-operasi/index']) ?>" id="kembali" class="btn btn-danger">
              <i class="fas fa-times"></i> Kembali
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php ActiveForm::end(); ?>
</div>
<?php Pjax::end(); ?>