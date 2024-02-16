<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\components\HelperSpesial;
use app\models\bedahsentral\IntraOperasiPerawat;
use kartik\switchinput\SwitchInput;
use app\models\bedahsentral\TimOperasiDetail;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\widgets\Pjax;

Pjax::begin(['id' => 'pjform']);
$this->registerJs($this->render('script.js'));
?>
<style type="text/css">
  .no-bord th,
  .no-bord td {
    padding: 0.5px;
    border: 0px;
  }

  .bord th,
  .bord td {
    /* padding: 2px; */
    border: 2px black solid;
  }
</style>

<?php $form = ActiveForm::begin(['id' => 'bat']); ?>
<?= $form->field($model, 'bat_to_id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'bat_batal')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'bat_final')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <table class="table table-sm table-form no-bord">
      <tr>
        <td width="20%"><label>A. Asal Ruangan</label></td>
        <td width="1%">:</td>
        <td width="29%">
          <?= $layanan['unitAsal']['nama'] ?>
        </td>

        <td width="20%" style="padding-left:10px"><label>E. DPJP Bedah/Anestesi</label></td>
        <td width="1%">:</td>
        <td width="29%">
          <?= $form->field($model, 'bat_dpjp_bedah')->widget(Select2::classname(), [
            'data' => HelperSpesial::getDokterOperator(1, false, true),
            'options' => ['placeholder' => 'Cari DPJP Bedah/Anestesi'],
            'size' => Select2::SMALL,
            'pluginOptions' => [
              'allowClear' => false,
            ],

          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label>B. Diagnosa</label></td>
        <td>:</td>
        <td>
          <?= $form->field($model, 'bat_diagnosa', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Diagnosa: ...', 'rows' => 2])->label(false); ?>
        </td>

        <td style="padding-left:10px"><label>F. Ka.Ruangan/Perawat PJ Shift</label></td>
        <td>:</td>
        <td>
          <?= $form->field($model, 'bat_karu')->widget(Select2::classname(), [
            'data' => HelperSpesial::getListSelainDokter(1, false, true),
            'options' => ['placeholder' => 'Cari Ka.Ruangan/Perawat PJ Shift'],
            'size' => Select2::SMALL,
            'pluginOptions' => [
              'allowClear' => false,
            ],

          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label>C. Tindakan Operasi</label></td>
        <td>:</td>
        <td>
          <?= $form->field($model, 'bat_tindakan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Tindakan: ...', 'rows' => 2])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label>D. Tanggal Penundaan</label></td>
        <td>:</td>
        <td>
          <?= $form->field($model, 'bat_tanggal_tunda', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'date', 'class' => 'form-control form-control-sm'])->label(false); ?>
        </td>
        </td>
      </tr>
    </table>
    <table width="100%" class="table table-sm bord">
      <thead>
        <tr>
          <th colspan="3" class="text-center bg-lightblue" style="font-size: 13pt;">Alasan Penundaan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td width="20%" style="border-right: none;"><label>a. Pasien</label></td>
          <td width="40%" style="border-right: none;border-left: none;">
            <?= $form->field($model, 'bat_alasan_pasien', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
              'Batuk/Flu' => 'Batuk/Flu',
              'Demam' => 'Demam',
              'Menstruasi' => 'Menstruasi',
              'Tensi Tinggi' => 'Tensi Tinggi',
              'Menolak' => 'Menolak',
              'Kelainan Kardiologi' => 'Kelainan Kardiologi',
              'Tidak Datang' => 'Tidak Datang',
              'Belum Dirawat' => 'Belum Dirawat',
              'Tidak Terdaftar Dalam Jadwal Operasi' => 'Tidak Terdaftar Dalam Jadwal Operasi',
              'Salah Mengajukan Rencana Operasi' => 'Salah Mengajukan Rencana Operasi',
              'Pasien Tidak Kooperatif Untuk Operasi' => 'Pasien Tidak Kooperatif Untuk Operasi',
              'Perubahan Tindakan Anestesi' => 'Perubahan Tindakan Anestesi'
            ])->label(false);
            ?>
          </td>
          <td style="border-left: none; vertical-align: middle">
            <?= $form->field($model, 'bat_alasan_pasien_lain', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Lain -lain: ...', 'rows' => 3])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td style="border-right: none;"><label>b. Operator</label></td>
          <td style="border-right: none;border-left: none;">
            <?= $form->field($model, 'bat_alasan_operator', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
              'Dinas Luar/Berhalangan' => 'Dinas Luar/Berhalangan',
              'Terlambat Datang' => 'Terlambat Datang',
            ])->label(false);
            ?>
          </td>
          <td style="border-left: none; vertical-align: middle">
            <?= $form->field($model, 'bat_alasan_operator_lain', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Lain -lain: ...', 'rows' => 3])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td style="border-right: none;"><label>c. Fasilitas Kamar Operasi</label></td>
          <td style="border-right: none;border-left: none;">
            <?= $form->field($model, 'bat_alasan_faskamop', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
              'Linen/Instrument Tidak Steril' => 'Linen/Instrument Tidak Steril',
              'AC Mati' => 'AC Mati',
              'Listrik Mati' => 'Listrik Mati',
              'O2 Habis' => 'O2 Habis',
              'Kehabisan Pakaian Operasi' => 'Kehabisan Pakaian Operasi',
              'Kehabisan Gas' => 'Kehabisan Gas',
            ])->label(false);
            ?>
          </td>
          <td style="border-left: none; vertical-align: middle">
            <?= $form->field($model, 'bat_alasan_faskamop_lain', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Lain -lain: ...', 'rows' => 3])->label(false); ?>
          </td>
        </tr>
        <tr>
          <td style="border-right: none;"><label>d. Ruang Perawatan</label></td>
          <td style="border-right: none;border-left: none;">
            <?= $form->field($model, 'bat_alasan_ruang_perawatan', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
              'ICU/PICU/CVCU/NICU Tidak Ada' => 'ICU/PICU/CVCU/NICU Tidak Ada',
              'Pemeriksaan Laboratorium' => 'Pemeriksaan Laboratorium',
              'Pemeriksaan Penyakit Dalam' => 'Pemeriksaan Penyakit Dalam',
              'Hasil Rontgen/CT Scan' => 'Hasil Rontgen/CT Scan',
              'Persiapan Darah' => 'Persiapan Darah',
              'Surat Izin Operasi Tidak Ada' => 'Surat Izin Operasi Tidak Ada',
              'Persiapan Operasi Belum Lengkap' => 'Persiapan Operasi Belum Lengkap',
            ])->label(false);
            ?>
          </td>
          <td style="border-left: none; vertical-align: middle">
            <?= $form->field($model, 'bat_alasan_ruang_perawatan_lain', ['options' => ['class' => 'form-group custom-margin']])->textArea(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => 'Lain -lain: ...', 'rows' => 3])->label(false); ?>
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
          // echo $form->field($model, 'bat_final')->widget(SwitchInput::classname(), [
          //   'pluginOptions' => [
          //     'size' => 'mini',
          //     'onText' => 'Final', 'handleWidth' => 50,
          //     'offText' => 'Draf',
          //     'onColor' => 'success',
          //     'offColor' => 'danger',
          //   ]
          // ])->label(false);
          ?>
          <button data-url="<?= Url::to(['/pembatalan-operasi/simpan']); ?>" type="submit" class="btn btn-success btn-simpan">
            <i class="fas fa-save"></i> Simpan
          </button>

          <button type="button" class="btn btn-warning btn-segarkan">
            <i class="fas fa-sync"></i> Segarkan
          </button>

          <!-- <a href="<?= Url::to(['/pembatalan-operasi/index', 'id' => Yii::$app->request->get('id')]); ?>" class="btn btn-danger btn-kembali">
            <i class="fas fa-times"></i> Kembali
          </a> -->
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>