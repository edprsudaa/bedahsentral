<?php

use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\LembarEdukasiTindakanAnestesi;
use yii\helpers\ArrayHelper;

$model = LembarEdukasiTindakanAnestesi::find()->with(['dokter'])->where(['leta_id' => $leta_id])->andWhere('leta_deleted_at is null')->one();
$style = 'border: 1px solid;';
if ($model->leta_batal) {
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
echo \Yii::$app->controller->renderPartial('../layouts/doc_kop.php', ['params' => ['reg_kode' => $model->timoperasi->layanan->registrasi_kode, 'pl_id' => '']]);
?>

<style type="text/css">
  .bedah {
    width: 33%;
    float: left;
    text-align: center;
  }

  .bedah p {
    padding-bottom: 50px;
  }

  #pengkajian {
    border-top: 2px solid;
    border-bottom: 2px solid;
  }

  th {
    text-align: center;
  }

  p {
    text-align: justify;
  }

  .ttd {
    width: 100%;
  }

  .tanda {
    width: 50%;
    float: left;
  }

  #nama {
    padding-bottom: 50px;
  }
</style>

<h1 align="center">LEMBAR EDUKASI TINDAKAN ANESTESI DAN SEDASI</h1>
<p>Untuk semua tindakan anestesi dans sedasi harus dilakukan persiapan sebagai berikut :</p>
<p>
  1. Untuk tindakan berencana pasien harus puasa. Puasa penting karena lambung harus kosong untuk menghindari keluarnya isi lambung ke rongga mulut pada waktu dibius dan isi lambung ini bisa masuk kejalan nafas dan menyebabkan sumbatan jalan nafas yang berkaibat fatal. Berikut adalah rekomendasi lamanya puasa sebelum anetesi dilakukan:
</p>
<table border="1" cellspacing="0" style="<?= $style ?>">
  <tr>
    <th>Umur</th>
    <th>Puasa Makan / Susu</th>
    <th>Puasa Minum Air Putih</th>
  </tr>
  <tr>
    <td>
      < 6 Bulan</td>
    <td>4 Jam</td>
    <td>2 Jam</td>
  </tr>
  <tr>
    <td>6-36 Bulan</td>
    <td>6 Jam (ASI=4 Jam)</td>
    <td>3 Jam</td>
  </tr>
  <tr>
    <td> 36 Bulan</td>
    <td>6 Jam</td>
    <td>3 Jam</td>
  </tr>
  <tr>
    <td>Dewasa</td>
    <td>6 Jam</td>
    <td>4 Jam</td>
  </tr>
</table>

<p>
  2. Pemeriksaan laboratorium dan radiologi sesuai indikasi.<br>
  3. Semua make up, cat kuku harus dibersihkan agar warna kulit dapat dimonitor selama pembiusan, serta melepas perhiasan.
  dan gigi palsu
</p>

<h2>1. ANESTESI UMUM</h2>
<p style="<?= $style ?>">
  Tindakan AU adalah pembiusan dima apasien dibuat tidak sadar sehingga tidak merasa nyesi. Obat bius diberikan melalui
  penyuntikan ke dalam pembuluh darah atau melalui gas/uap yang dihirup. Lama kerja obat disesuaikan dengan lama
  tindakan/operasi. Setelah pasien menjadi tidak sadar bila perlu dipasang alat bantu jalan napas ke dalam rongga mulut (pipa
  laryngeal) atau tenggorokan (pipa endotrakeal) agar jalan napas tetap terbuka. Oksigen dan gas lain akan dialirkan melalui
  selang pernapasan.
</p>
<p style="<?= $style ?>">
  <b>Kelebihan teknik AU</b><br>
  <?php
  $leta_kelebihan_anestesi_umum = json_decode($model->leta_kelebihan_anestesi_umum);
  if ($leta_kelebihan_anestesi_umum != NULL) {
    foreach ($leta_kelebihan_anestesi_umum as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>

  <b>Kekurangan teknik AU : </b><br>
  <?php
  $leta_kekurangan_anestesi_umum = json_decode($model->leta_kekurangan_anestesi_umum);
  if ($leta_kekurangan_anestesi_umum != NULL) {
    foreach ($leta_kekurangan_anestesi_umum as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>
  <b>Komplikasi / Efek Samping</b><br>
  <?php
  $leta_komplikasi_anestesi_umum = json_decode($model->leta_komplikasi_anestesi_umum);
  if ($leta_komplikasi_anestesi_umum != NULL) {
    foreach ($leta_komplikasi_anestesi_umum as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>
</p>

<h2>2. ANESTESI REGIONAL (SPINAL/EPIDURAL)</h2>
<p>
  Blok Spinal dan epidural adalh pembiusan dengan menghilangkan sensasi bagian bawah tubuh,mulai dari perut sampai
  keujung kaki dengan kesadaran tidak terganggu. Dokter spesialis anestesi dapat memberikan obat tidur (apabila diperlukan).
  Pada anestesi blok spinal, obat disuntikkan di daerah punggung dengan jarum yang halus. Sedangkan blok epidural
  menggunakan jarum yang sedikit lebih besar dengan atau tanpa pemasangan selang (kateter). Posisi penyuntikan blok spinal
  dan epidural adalah duduk atau tidur miring. Setelah penyuntikan obat maka akan terjadi perubahan sesnsai dibagian bawah
  tubuh mulai dari rasa hangat, kesemutan, sampai akhirnya kehilangan seluruh sensasi dan rasa seperti tidak memiliki tungkai
  bawah. Efek ini berlangsung anatara 2 sampai 4 jam tergantung jenis dan konsentrasi obat yang digunakan. Bila digunakan
  kateter (epidural) efek anestesia regional dapat diulang.
</p>
<p>
  <b>Kelebihan Anestesia Blok Spinal dan Epidural</b><br>
  <?php
  $leta_kelebihan_anestesi_regional = json_decode($model->leta_kelebihan_anestesi_regional);
  if ($leta_kelebihan_anestesi_regional != NULL) {
    foreach ($leta_kelebihan_anestesi_regional as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>

  <b>Kekurangan Anestesia Blok Spinal dan Epidural</b><br>
  <?php
  $leta_kekurangan_anestesi_regional = json_decode($model->leta_kekurangan_anestesi_regional);
  if ($leta_kekurangan_anestesi_regional != NULL) {
    foreach ($leta_kekurangan_anestesi_regional as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>

  <b>Komplikasi/Efek Samping Blok Spinal dan Epidural:</b><br>
  <?php
  $leta_komplikasi_anestesi_regional = json_decode($model->leta_komplikasi_anestesi_regional);
  if ($leta_komplikasi_anestesi_regional != NULL) {
    foreach ($leta_komplikasi_anestesi_regional as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>
</p>

<h2>3. BLOK PERIFER</h2>
<p>
  Blok perifer adalah penyuntikan obat anestesi lokal pada daerah tertentu untuk menghilangkan sensasi setempat. Umumnya
  blok perifer dilakukan untuk tindakan/operasi pada anggota gerak (lengan atau tungkal). Teknik ini dilakukan dengan
  menyuntikan obat bius lokal didaerah sekitar saraf yang mensyarafi bagian tubuh yang akan dioperasi. Pada saat mencari
  lokasi syarat yang akan disuntik mungkin akan merasakan sedikit nyeri. Kadang bila syaraf sudah terkena maka akan terasa
  seperti kesetrum dibagian tubuh yang akan dioperasi. Demikian juga pada saat penyuntikan obat bius lokal akan terasa nyeri,
  tapi lama kelamaan bagian tubuh yang dioperasi akan terasa kesemutan dan akhirnya terasa berat sampai tidak bisa
  digerakkan.
</p>
<p>
  <b>Kelebihan Anestesia Blok Perifier:</b><br>
  <?php
  $leta_kelebihan_anestesi_lokal = json_decode($model->leta_kelebihan_anestesi_lokal);
  if ($leta_kelebihan_anestesi_lokal != NULL) {
    foreach ($leta_kelebihan_anestesi_lokal as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>

  <b>Kekurangan Anestesia Blok Perifier:</b><br>
  <?php
  $leta_kekurangan_anestesi_lokal = json_decode($model->leta_kekurangan_anestesi_lokal);
  if ($leta_kekurangan_anestesi_lokal != NULL) {
    foreach ($leta_kekurangan_anestesi_lokal as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>

  <b>Komplikasi/Efek Samping Anestesia Blok Perifier</b><br>
  <?php
  $leta_komplikasi_anestesi_lokal = json_decode($model->leta_komplikasi_anestesi_lokal);
  if ($leta_komplikasi_anestesi_lokal != NULL) {
    foreach ($leta_komplikasi_anestesi_lokal as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>
</p>

<h2>4. SEDASI</h2>
<ol>
  <li>Sedasi Ringan</li>
  Sedasi Ringan adalah teknik pembiusan dengan penyuntikan obat yang dapat menyebabkan pasien mengantuk,tetapi masih
  memeiliki respon normal terhadap rangsangan verbal dan tetap dapat mempertahankan patensi dari jalan nafasnya, sedang
  fungsi pernafasan dan kerja jantung serta pembuluh darah tidak dipengaruhi.

  <li>Sedasi Sedang</li>
  Sedasi Sedang adalah teknik pembiusan dengan penyuntikan obat yang dapat menyebabkan pasien mengantuk,tetapi masih
  memeiliki respon terhadap rangsangan verbal, dapat diikuti atau tidak diikuti oleh rangsangan tekan yang ringan dan pasien masih dapat menjaga patensi jalan nafasnya sendiri. Pada sedasi moderat terjadi perubahan ringan dari respon pernafasan namun fungsi kerja jantung serta pembuluh darah masih tetap dipertahakan dalam keadaan normal. Pada sedasi moderat dapat diikuti gangguan orientasi lingkungan serta gangguan fungsi motorik ringan sampai sedang.

  <li>Sedasi Dalam</li>
  Sedasi Dalam adalah teknik pembiusan dengan penyuntikan obat yang dapat menyebabkan pasien mengantuk, tidur ,serta
  tidak mudah dibangunkan tetapi masih memberikan respon terhadap rangsangan berulang atau rangsangan nyeri. Respon
  pernafasan sudah mulai terganggu dimana nafas spontan sudah mulai tidak kuat dan pasien tidak dapat mempertahankan
  patensi dari jalan nafasnya (mengakibatkan hilangnya sebagian atau seluruh refleks proteksi jalan nafas). Sedasi dalam dapat berpengaruh terhadap fungsi kerja jantung dan pembuluh darah terutama pada pasien sakit berat, sehingga tindakan sedasi dalam membutuhkan alat monitoring yang lebih lengkap dari sedasi ringan maupun sedasi moderat.
</ol>
<p>
  <b>Kelebihan Teknik Sedasi</b><br>
  <?php
  $leta_kelebihan_sedasi = json_decode($model->leta_kelebihan_sedasi);
  if ($leta_kelebihan_sedasi != NULL) {
    foreach ($leta_kelebihan_sedasi as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>

  <b>Kelemahan Teknik Sedasi</b><br>
  <?php
  $leta_kekurangan_sedasi = json_decode($model->leta_kekurangan_sedasi);
  if ($leta_kekurangan_sedasi != NULL) {
    foreach ($leta_kekurangan_sedasi as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>

  <b>Komplikasi/Efek Samping Sedasi</b><br>
  <?php
  $leta_komplikasi_sedasi = json_decode($model->leta_komplikasi_sedasi);
  if ($leta_komplikasi_sedasi != NULL) {
    foreach ($leta_komplikasi_sedasi as $val) {
      echo $val . "</br>";
    }
  } else {
    echo "-";
  }
  ?>
</p>

<p>Setelah membaca dan diterangkan mengenai tindakan anestesi/sedasi diatas, maka saya bertanda tangan dibawah ini</p>

<table width="100%" style="<?= $style ?>">
  <tr>
    <td style="width: 20%;"><label><?= $model->getAttributeLabel('leta_keluarga_nama') ?> </label></td>
    <td style="width:1%;"><label>:</label></td>
    <td style="width:75%;"><?= $model->leta_keluarga_nama  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_keluarga_umur') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_keluarga_umur  ?></td>

  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_keluarga_jenis_kelamin') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_keluarga_jenis_kelamin  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_keluarga_alamat') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_keluarga_alamat  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_keluarga_no_identitas') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_keluarga_no_identitas  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_keluarga_hubunga_dgn_pasien') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_keluarga_hubunga_dgn_pasien  ?></td>
  </tr>
</table>

<p>Menyatakan memberi <b><?= $model->leta_setuju == 1 ? "Persetujuan" : "Penolakan" ?></b></p>
<table width="100%" style="<?= $style ?>">
  <tr>
    <td style="width: 20%;"><label><?= $model->getAttributeLabel('leta_pasien_nama') ?> </label></td>
    <td style="width: 1%;"><label>:</label></td>
    <td style="width: 75%;"><?= $model->leta_pasien_nama  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_pasien_tgl_lahir') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_pasien_tgl_lahir  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_pasien_no_rekam_medis') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_pasien_no_rekam_medis  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_pasien_diagnosa') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_pasien_diagnosa  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_pasien_rencana_tindakan') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_pasien_rencana_tindakan  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_pasien_jenis_anestesi') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_pasien_jenis_anestesi  ?></td>
  </tr>
  <tr>
    <td><label><?= $model->getAttributeLabel('leta_pasien_analgesi_pasca_anestesi') ?> </label></td>
    <td><label>:</label></td>
    <td><?= $model->leta_pasien_analgesi_pasca_anestesi  ?></td>
  </tr>
</table>

<p>Saya menyatakan dengan sesungguhnya dan tanpa paksaan bahwa <label>:</label></p>
<ol>
  <li>Saya telah menerima informasi jenis anestesi/sedasi yang akan dilakukan.</li>
  <li>Saya mengerti bahwa tindakan anestesi/sedasi mengandung beberapa resiko, termasuk perubahan tekanan darah,
    reaksi obat (alergi), henti jantung, kerusakan otak, kelumpuhan, kerusakan saraf serta komplikasi lain yang juga
    mungkin terjadi bahkan kematian.</li>
  <li>Saya telah membaca penjelasan secara teliti tentang tindakan anestesi/sedasi yang diberikan, mengerti dan menyutujui
    penjelasan tentang tindakan yang akan dilakukan termasuk kemungkinan komplikasi</li>
  <li>Saya mempunyai kewajiban untuk memberikan informasi kepada dokter mengenai semua obat yang saya minum dalam satu minggu terakhir seperti aspirin, pengencer darah, kontrasepsi, obat-obat flu, narkotik, marijuana, kokain dan lainlain</li>
  <li>Saya telah diberikan penjelasan mengenai analgesi pasca anaestesi/sedasi, dan mengerti apabila masih mengalami nyeri
    agar melaporkan ke perawat yang lagi berdinas</li>
  <li>Berdasarkan hal-hal tersebut diatas, saya menjamin sepenuhnya bahwa tindakan saya untuk menyutujui tindakan
    anestesi/sedasi diatas adalah untuk mewakili kepentingan pasien dan keluarga pasien, dan saya bertanggung jawab
    sepenuhnya apabila terdapat pihak lain yang mengajukan keberatan atas persetujuan ini.
  </li>
</ol>

<p>Demikian surat ini dibuat dengan penuh kesadaran dan tanpa paksaaan dari pihak manapun</p>
<table>
  <tr>
    <td style="width: 20%;"><label>Tanggal</td>
    <td style="width: 1%;"><label>:</label></td>
    <td style="width: 75%;"><?= Date("d M Y H:i:s", strtotime($model->leta_tanggal_persetujuan));  ?></td>
  </tr>
</table>
<div class="ttd">
  <div class="tanda">
    <p id="nama">Dokter Yang menjelaskan</p>
    <p><?= HelperSpesial::getNamaPegawai($model->dokter->pegawai) ?></p>
  </div>
  <div class="tanda">
    <p id="nama">Pihak yang dijelaskan</p>
    <p><?= $model->leta_keluarga_nama ?></p>
  </div>
</div>