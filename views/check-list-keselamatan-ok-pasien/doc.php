<?php

use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\PertanyaanCheckListKeselamatanOk;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use yii\helpers\ArrayHelper;

$model = PertanyaanCheckListKeselamatanOk::find()->where(['pcok_id' => $pcok_id])->andWhere('pcok_deleted_at is null')->one();
$style = 'border: 1px solid;';
if ($model->pcok_batal) {
  if (\Yii::$app->params['setting']['doc']['bg_batal']) {
    $path = \Yii::getAlias('@webroot') . \Yii::$app->params['setting']['doc']['bg_batal'];
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    $style = "border: 1px solid;background-image:url('" . $base64 . "');background-repeat: repeat;background-size: 80px 50px;";
  }
}
// echo'<pre/>';print_r($penunjang_order);die();
// https://www.picturetopeople.org/text_generator/others/transparent/transparent-text-generator.html
echo \Yii::$app->controller->renderPartial('/layouts/doc_kop.php', ['params' => ['reg_kode' => $model->timoperasi->layanan->registrasi_kode, 'pl_id' => '']]);

$timoperasi = TimOperasi::find()->where(['to_id' => $model->pcok_to_id])->one();
$timoperasidetail = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->all();
?>
<style type="text/css">
  .ttd {
    width: 100%;
  }

  .bedah {
    width: 25%;
    float: left;
    text-align: center;
  }

  th {
    text-align: center;
  }

  .table-form th,
  .table-form td {
    padding: 0.5px;
    /* border: 0.5px solid #3c8dbc; */
  }
</style>
<h3 style="text-align: center;">CHECK LIST KESELAMATAN PASIEN DIKAMAR OPERASI</h3>
<table class="table table-sm table-form" style="<?= $style ?>">
  <tr>
    <td style="text-align: center;"><b>SEBELUM INDUKSI ANESTESI<br><i>(SIGN IN)</i></b></td>
    <td style="text-align: center;"><b>==></b></td>
    <td style="text-align: center;"><b>SEBELUM INSISI <br> <i>(TIME OUT)</i></b></td>
    <td style="text-align: center;"><b>==></b></td>
    <td style="text-align: center;"><b>SEBELUM MENUTUP LUKA & <br>MENINGGALKAN KAMAR OPOERASI <br> <i>(SIGN OUT)</i></b></td>
  </tr>
  <tr>
    <td valign="top"><b>Minimal Perawat & Ahli Anestesi</b></td>
    <td></td>
    <td valign="top"><b>Dengan Perawat, dr. Anestesi dan dr. Bedah</b></td>
    <td></td>
    <td valign="top"><b>Dengan Perawat, dr. Anestesi dan dr. Bedah secara verbal perawat memastikan</b></td>
  </tr>
  <tr>
    <td valign="top">
      <p>1. Sudahkah pasien mengkonfirmasi identitas, lokasi, prosedur, dan persetujuannya?
        <?= $model->pcok_si_pertanyaan1 ?>
      </p><br>
      <p>2. Apakah lokasi operasi sudah ditandai?
        <?= $model->pcok_si_pertanyaan2 ?>
      </p><br>
      <p>
        3. Apakah mesin anestesi & pemeriksaan obat lengkap?
        <?= $model->pcok_si_pertanyaan3 ?>
      </p><br>
      <p>
        4. Apakah pulse oxymeter terpasang pada pasien dan berfungsi ?
        <?= $model->pcok_si_pertanyaan4 ?>
      </p><br>
      <p>
        5. Apakah pasien memiliki riwayat alergi ?
        <?= $model->pcok_si_pertanyaan5 ?>
      </p><br>
      <p>
        6. Apakah pasien memiliki gangguan pernafasan ?
        <?= $model->pcok_si_pertanyaan6 ?>
      </p><br>
      <p>
        7. Resiko perdarahan > 500 ml (7ml/kg bagi pasien anak)?
        <?= $model->pcok_si_pertanyaan7 ?>
      </p><br>
    </td>
    <td></td>
    <td valign="top">
      <p>
        1. Konfirmasikan semua anggota tim perkenalkan diri dengan nama dan peran.
        <?= $model->pcok_to_pertanyaan1 ?>
      </p><br>
      <p>
        2. Konfirmasikan nama pasien, prosedur, dan lokasi operasi.
        <?= $model->pcok_to_pertanyaan2 ?>
      </p><br>
      <p>
        3. Apakah antibiotik profilaksisi sudah diberikan 1 jam sebelumnya ?
        <?= $model->pcok_to_pertanyaan3 ?>
      </p><br>
      <b>Kejadian beresiko yang perlu diantisipasi untuk dr. Bedah:</b><br>
      <p>
        1. Apa langkah-langkah kritis atau non-rutin?
        <?= $model->pcok_to_pertanyaan4 ?>
      </p><br>
      <p>
        2. Berapa lama waktu operasi yang dibutuhkan?
        <?= $model->pcok_to_pertanyaan5 ?>
      </p><br>
      <p>
        3. Apakah sudah antisipasi pendarahan ?
        <?= $model->pcok_to_pertanyaan6 ?>
      </p><br>
      <b>Untuk dr . Anestesi</b><br>
      <p>
        Apakah ada kekhawatiran yang jadi perhatian khusus pada pasien?
        <?= $model->pcok_to_pertanyaan7 ?>
      </p><br>
      <b>Untuk tim perawat</b><br>
      <p>
        1. Apakah sterilitas sesuai dengan indikator?
        <?= $model->pcok_to_pertanyaan8 ?>
      </p><br>
      <p>
        2. Apakah ada masalah peralatan yang harus diperhatikan?
        <?= $model->pcok_to_pertanyaan9 ?>
      </p><br>
      <p>
        3. Apakah Foto Rontgen/CT-Scan/MRI perlu ditampilkan?
        <?= $model->pcok_to_pertanyaan10 ?>
      </p><br>
    </td>
    <td></td>
    <td valign="top">
      <p>
        1. Nama tindakan?
        <?= $model->pcok_so_pertanyaan1 ?>

      </p><br>
      <p>
        2. Kelengkapan alat, jumlah kasa dan jarum/alat lain?

        <?= $model->pcok_so_pertanyaan2 ?>
      </p><br>
      <p>
        3. Pelabelan spesimen (baca label spesimen dan nama pasien dengan keras)

        <?= $model->pcok_so_pertanyaan3 ?>
      </p><br>
      <p>
        4. Apakah ada masalah dengan peralatan yang perlu disampaikan ?

        <?= $model->pcok_so_pertanyaan4 ?>
      </p><br>
      <b>Untuk dr anestesi dan perawat:</b><br>
      <p>
        Apakah ada catatan khusus untuk proses pemulihan dan penanganan perawatan pasien ?

        <?= $model->pcok_so_pertanyaan5 ?>
      </p><br>
    </td>
  </tr>
</table>

<div class="ttd">
  <div class="bedah">
    <p>Dokter Anestesi</p><br>
    <p>
      <?php
      $dokteranestesi = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id, 'tod_jo_id' => 2])->all();
      foreach ($dokteranestesi as $val) {
        echo HelperSpesial::getNamaPegawai($val->pegawai);
      }
      ?>
    </p>
  </div>
  <div class="bedah">
    <p>Perawat Sirkuler</p><br>
    <p>
      <?php
      $sirkuler = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id, 'tod_jo_id' => 4])->all();
      $no = 1;
      foreach ($sirkuler as $val) {
        echo $no++ . ". " . HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
      }
      ?>
    </p>
  </div>
  <div class="bedah">
    <p>Perawat Instrumen</p><br>
    <p>
      <?php
      $instrument = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id, 'tod_jo_id' => 6])->all();
      $no = 1;
      foreach ($instrument as $val) {
        echo $no++ . ". " . HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
      }
      ?>
    </p>
  </div>
  <div class="bedah">
    <p>Dokter Operator</p><br>
    <p>
      <?php
      $bedah = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id, 'tod_jo_id' => 1])->all();
      foreach ($bedah as $val) {
        echo HelperSpesial::getNamaPegawai($val->pegawai) . "</br>";
      }
      ?>
    </p>
  </div>
</div>