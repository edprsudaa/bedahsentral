<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use app\models\bedahsentral\CairanKeluarCatatanLokalAnestesi;
use app\models\bedahsentral\CairanMasukCatatanLokalAnestesi;
use app\models\bedahsentral\CatatanLokalAnestesi;
use app\models\bedahsentral\MedikasiCatatanLokalAnestesi;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use kartik\switchinput\SwitchInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPreOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
<style type="text/css">
  #obat {
    writing-mode: tb-rl;
    transform: rotate(180deg);
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    vertical-align: middle;
    /* border: 0.5px solid #3c8dbc; */
  }
</style>

<?php
$this->registerJs($this->render('_form_update_ready.js'));
$url = Yii::$app->homeUrl;
?>

<?php
$form = ActiveForm::begin([
  'id' => 'cla'
]); ?>
<?= $form->field($model, 'cla_to_id')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <h3 style="text-align: center;">CATATAN LOKAL ANESTESI SELAMA PEMBEDAHAN</h3>
    <table class="table table-sm table-form">
      <tr>
        <td style="width: 11%;"></td>
        <td></td>
        <td style="width: 12%;"></td>
        <td></td>
        <td style="width: 10%;"></td>
        <td style="width: 12%;"></td>
        <td style="width: 10%;"></td>
      </tr>
      <tr>
        <td><label>Dokter Operator :</label></td>
        <td>
          <?php
          $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->cla_to_id, 'tod_jo_id' => 1])->all();
          if ($detail) {
            foreach ($detail as $val) {
              echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
            }
          } else {
            echo "Belum diinput";
          }

          ?>
        </td>
        <td>
          <label>Diagnosis Pra Bedah :</label>
        </td>
        <td>
          <?= $form->field($model, 'cla_diagnosis_pra_bedah', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => 'Ketik disni .......'])->label(false); ?>
        </td>
        <td><label>Tanggal :</label></td>
        <td>
          <?= $form->field($model, 'cla_tanggal', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'date', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => true])->label(false); ?>
        </td>
        <td rowspan="6">
          <label><?= $model->getAttributeLabel('cla_posisi_operasi') ?> :</label>
          <?= $form->field($model, 'cla_posisi_operasi', ['options' => ['class' => 'form-group custom-margin']])->inline(false)->checkboxList([
            'Terlentang' => 'Terlentang',
            'Tengkurap' => 'Tengkurap',
            'Laterak kanan' => 'Laterak kanan',
            'Laterak kiri' => 'Laterak kiri',
            'Litotomy' => 'Litotomy',
            'Lumbotomy' => 'Lumbotomy',
            'Duduk' => 'Duduk',
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td rowspan="2"><label>Asisten :</label></td>
        <td rowspan="2">
          <?php
          $detail = TimOperasiDetail::find()->where(['tod_to_id' => $model->cla_to_id, 'tod_jo_id' => 3])->all();
          $no = 1;
          if ($detail) {
            foreach ($detail as $val) {
              echo $no++ . ". " . HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
            }
          } else {
            echo "Belum diinput";
          }

          ?>
        </td>
        <td><label>Diagnosis Pasca Bedah :</label></td>
        <td>
          <?= $form->field($model, 'cla_diagnosis_pasca_bedah', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => 'Ketik disni .......'])->label(false); ?>
        </td>
        <td rowspan="2"><label><?= $model->getAttributeLabel('cla_ruangan') ?> :</label></td>
        <td rowspan="2">
          <?= str_replace("KAMAR OPERASI", "", $form->field($model, 'cla_ruangan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => true])->label(false)) ?>
        </td>
      </tr>
      <tr>
        <td><label>Tindakan :</label></td>
        <td>
          <?= $form->field($model, 'cla_tindakan', ['options' => ['class' => 'form-group custom-margin']])->textArea(['placeholder' => 'Ketik disni .......'])->label(false); ?>
        </td>
      </tr>

      <tr>
        <td rowspan="3"><label>Keadaan Pra Bedah :</label></td>
        <td rowspan="3" colspan="3">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
              TB:
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'cla_tb', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '... Cm'])->label(false); ?>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
              BB:
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'cla_bb', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '... Kg'])->label(false); ?>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
              TD:
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'cla_td', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '... mmHg'])->label(false); ?>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
              Nadi:
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'cla_nadi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '... x/menit'])->label(false); ?>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
              Hb:
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'cla_hb', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '... gr/dL'])->label(false); ?>
            </div>
            <div class="col-md-3"></div>
          </div>
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">
              Ht:
            </div>
            <div class="col-md-4">
              <?= $form->field($model, 'cla_ht', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '... %'])->label(false); ?>
            </div>
            <div class="col-md-3"></div>
          </div>
        </td>
        <td><label><?= $model->getAttributeLabel('cla_jam_mulai_operasi') ?> :</label></td>
        <td>
          <?= $form->field($model, 'cla_jam_mulai_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '.......', 'id' => 'jam-mulai'])->label(false); ?>
        </td>
      </tr>

      <tr>
        <td><label><?= $model->getAttributeLabel('cla_jam_akhir_operasi') ?> :</label></td>
        <td>
          <?= $form->field($model, 'cla_jam_akhir_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'time', 'class' => 'form-control form-control-sm', 'placeholder' => '.......', 'id' => 'jam-selesai'])->label(false); ?>
        </td>
      </tr>

      <tr>
        <td><label><?= $model->getAttributeLabel('cla_lama_operasi') ?> :</label></td>
        <td>
          <?= $form->field($model, 'cla_lama_operasi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['type' => 'text', 'class' => 'form-control form-control-sm', 'placeholder' => '...', 'readonly' => true, 'id' => 'selisih'])->label(false); ?>
        </td>
      </tr>
    </table>
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          if (!$model->cla_batal) {
            if (!$model->cla_final) {
              echo $form->field($model, 'cla_final')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Final', 'handleWidth' => 50,
                  'offText' => 'Draf',
                  'onColor' => 'success',
                  'offColor' => 'danger',
                ]
              ])->label(false);
            } else {

              echo $form->field($model, 'cla_batal')->widget(SwitchInput::classname(), [
                'pluginOptions' => [
                  'size' => 'mini',
                  'onText' => 'Batal',
                  'offText' => 'Non-batal',
                  'onColor' => 'danger',
                  'offColor' => 'success',
                ]
              ])->label(false);
            }
            echo Html::submitButton('<i class="fas fa-save"></i> Simpan', ['class' => 'btn btn-success btn-submit', 'data-subid' => $model->cla_id]);
            echo Html::button('<i class="fas fa-sync"></i> Segarkan', ['class' => 'btn btn-warning btn-segarkan']);
            if (!$model->cla_final) {
              echo Html::button('<i class="fas fa-trash-alt"></i> Hapus', ['class' => 'btn btn-danger btn-hapus-draf', 'data-url' => Url::to(['/catatan-lokal-anestesi/save-update-hapus', 'id' => Yii::$app->request->get('id'), 'subid' => $model->cla_id])]);
            }
            echo Html::a('<i class="fas fa-plus-circle"></i> Tambah Baru', ['/catatan-lokal-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          } else {
            echo Html::button('<i class="fas fa-sync"></i> Segarkan', ['class' => 'btn btn-warning btn-segarkan']);
            echo Html::a('<i class="fas fa-plus-circle"></i> Tambah Baru', ['/catatan-lokal-anestesi/create', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-primary']);
          }
          // echo Html::button(Yii::t('app', '{title}', ['title' => (($model->cla_batal) ? 'NB:Doc.Batal' : (($model->cla_final) ? 'NB:Doc.Final' : 'NB:Doc.Draf'))]), ['class' => 'btn btn-default']);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>
<?php
$catatan = CatatanLokalAnestesi::find()->where(['cla_id' => $model->cla_id])->one();
if (!empty($catatan)) {
?>

  <div class="col-lg-11">
    <h5 class="text-left bg-lightblue">MEDIKASI</h5>
    <?= $this->render('_form_medikasi', ['model' => $modelmedikasi, 'id' => $catatan->cla_id]); ?>
    <table class="table table-sm table-form" id="tbl-medikasi">
      <tr>
        <td style="width: 10%;"><b>Jam</b></td>
        <?php
        $jam = MedikasiCatatanLokalAnestesi::find()->where(['mcl_cla_id' => $catatan->cla_id])->all();
        foreach ($jam as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->mcl_waktu ?></span></td>
        <?php } ?>

      </tr>
      <tr>
        <td><b>Nama Obat</b></td>
        <?php
        foreach ($jam as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->mcl_nama_obat ?></span></td>
        <?php } ?>
      </tr>
    </table>
    <br><br>


    <h5 class="text-left bg-lightblue">CAIRAN MASUK</h5>
    <?= $this->render('_form_cairan_masuk', ['model' => $modelcairanmasuk, 'id' => $catatan->cla_id]);  ?>
    <table class="table table-sm table-form" id="tbl-cairan-masuk">
      <tr>
        <td style="width: 10%;"><b>Jam</b></td>
        <?php $masuk = CairanMasukCatatanLokalAnestesi::find()->where(['mmcl_cla_id' => $catatan->cla_id])->all();
        foreach ($masuk as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->mmcl_waktu ?></span></td>
        <?php } ?>
      </tr>
      <tr>
        <td><b>Nama Obat</b></td>
        <?php
        foreach ($masuk as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->mmcl_cairan_nama . "<b>(" . $val->mmcl_jumlah . ")</b>" ?></span></td>
        <?php } ?>

      </tr>
    </table>
    <br><br>


    <h5 class="text-left bg-lightblue">CAIRAN KELUAR</h5>
    <?= $this->render('_form_cairan_keluar', ['model' => $modelcairankeluar, 'id' => $catatan->cla_id]);  ?>
    <table class="table table-sm table-form" id="tbl-cairan-keluar">

      <tr>
        <?php $keluar =  CairanKeluarCatatanLokalAnestesi::find()->where(['kmcl_cla_id' => $catatan->cla_id])->all(); ?>
        <td style="width: 10%;"><b>Jam</b></td>
        <?php foreach ($keluar as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->kmcl_waktu ?></span></td>
        <?php } ?>
      </tr>
      <tr>
        <td><b>Nama Obat</b></td>
        <?php foreach ($keluar as $val) { ?>
          <td style="width:5px;"><span id="obat"><?= $val->kmcl_cairan_nama . "<b>(" . $val->kmcl_jumlah . ")</b>" ?></span></td>
        <?php } ?>
      </tr>
    </table>
    <br><br>
  </div>
<?php } ?>