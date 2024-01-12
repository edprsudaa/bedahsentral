<?php

use app\components\HelperGeneral;
use app\components\HelperSpesial;
use app\models\bedahsentral\TimOperasi;
use app\models\pendaftaran\Pasien;
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJs($this->render('script.js'));
$tim = TimOperasi::findOne(['to_ok_pl_id' => $layanan['id']]);
?>
<div class="row" style="margin: -10px -20px 0px -20px;">
  <div class="col-lg-12">
    <div class="card bg-info text-white">
      <div class="card-body" style="min-height:180px !important;padding:0.5rem !important;margin-bottom: -24px;">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-lg-4">
                <h6 class="text-sm">No.RM:</h6>
                <h6 class="text-sm text-white"><?php echo $layanan['registrasi']['pasien']['kode']; ?></h6>
              </div>
              <div class="col-lg-4">
                <h6 class="text-sm">No.Reg:</h6>
                <h6 class="text-sm text-white"><?php echo $layanan['registrasi']['kode']; ?></h6>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <h6 class="text-sm">Nama:</h6>
                <h6 class="text-sm text-white"><?php echo $layanan['registrasi']['pasien']['nama']; ?></h6>
              </div>
              <div class="col-lg-4">
                <h6 class="text-sm">Tgl. Lahir:</h6>
                <h6 class="text-sm text-white"><?php echo HelperGeneral::getDateFormatToIndo($layanan['registrasi']['pasien']['tgl_lahir'], false); ?></h6>
              </div>
              <div class="col-lg-4">
                <h6 class="text-sm">Tgl.Masuk:</h6>
                <h6 class="text-sm text-white"><?php echo  HelperGeneral::getDateFormatToIndo($layanan['tgl_masuk'], false) . ' ' . date('H:i', strtotime($layanan['tgl_masuk'])); ?></h6>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <h6 class="text-sm">Gender:</h6>
                <h6 class="text-sm text-white">
                  <?= ($layanan['registrasi']['pasien']['jkel'] ? Pasien::$jenis_kelamin[$layanan['registrasi']['pasien']['jkel']] : "-"); ?>
                </h6>
              </div>
              <div class="col-lg-4">
                <h6 class="text-sm">Umur By Tgl.Masuk:</h6>
                <h6 class="text-sm text-white">
                  <?php
                  $umur = HelperGeneral::getUmur($layanan['registrasi']['pasien']['tgl_lahir'], $layanan['tgl_masuk']);
                  echo $umur['th'] . ' TH ' . $umur['bl'] . ' BL ' . $umur['hr'] . ' HR'; ?>
                </h6>
              </div>
              <div class="col-lg-4">
                <h6 class="text-sm">Ruangan:</h6>
                <h6 class="text-sm text-white"><?php echo $layanan['unit']['nama']; ?></h6>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="row">
              <div class="col-lg-12">
                <h6 class="text-sm">Penjamin:</h6>
                <h6 class="text-sm text-white"><?= ($layanan['registrasi']['debiturDetail']) ? $layanan['registrasi']['debiturDetail']['nama'] : 'Tidak Ada'; ?></h6>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-lg-12">
                <h6 class="text-sm">Dpjp Utama:</h6>
                <?php
                // $detail = null;
                // $no = 1;

                // if ($layanan['registrasi']['pjpRi']) {
                //   foreach ($layanan['registrasi']['pjpRi'] as $dpjp) {

                //     if ($dpjp['status'] == 1) {
                //       $namaDpjp = $namaDpjp = HelperSpesial::getNamaPegawaiArray($dpjp['pegawai']);
                //       if ($detail) {
                //         $detail .= '</br>' . $no++ . '. ' . $namaDpjp;
                //       } else {
                //         $detail .= $no++ . '. ' . $namaDpjp;
                //       }
                //     }
                //   }
                // } else {
                //   $pjprj = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();
                //   $chk_pasien = HelperSpesial::getCheckPasien($pjprj->to_ruang_asal_pl_id);

                //   foreach ($chk_pasien->data['pjp'] as $pjpjalan) {
                //     if ($pjpjalan['status'] == 1) {
                //       $namaDpjp = HelperSpesial::getNamaPegawaiArray($pjpjalan['pegawai']);
                //       if ($detail) {
                //         $detail .= '</br>' . $no++ . '. ' . $namaDpjp;
                //       } else {
                //         $detail .= $no++ . '. ' . $namaDpjp;
                //       }
                //     }
                //   }
                // }
                // if ($detail) {
                //   echo '<h6 class="text-sm text-white">' . $detail . '</h6>';
                // } else {
                //   echo '<h6 class="text-sm text-white">Belum Ditentukan</h6>';
                // }
                ?>
              </div>
            </div> -->
            <div class="row">
              <div class="col-lg-12">
                <a href="#" class="btn btn-warning btn-sm col-lg-12" data-id="<?= $tim->to_ok_unt_id ?>" id="kembali">
                  <i class="nav-icon fas fa-fas fa-search"></i> Cari Pasien Lain
                </a>

              </div>
            </div>
          </div>
        </div>
      </div> <!-- end card-body -->
    </div> <!-- end card-->
  </div> <!-- end col-->
</div>
<?php
$this->registerJs("
");
