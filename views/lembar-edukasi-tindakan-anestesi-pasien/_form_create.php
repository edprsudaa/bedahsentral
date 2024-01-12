<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\medis\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $model app\models\medis\MedisPreOperasiPerawat */
/* @var $form yii\widgets\ActiveForm */
?>
<?php \yii\widgets\Pjax::begin(['id' => 'pjform']); ?>
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
<?php
$this->registerJs($this->render('_form_create_ready.js')); ?>
<?php
$form = ActiveForm::begin([
  'id' => 'leta'
]); ?>
<?= $form->field($model, 'leta_to_id')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'leta_batal')->hiddenInput()->label(false); ?>
<?= $form->field($model, 'leta_dokter_yg_mejelaskan')->hiddenInput()->label(false); ?>
<div class="row">
  <div class="col-lg-11">
    <h4 align="center">LEMBAR EDUKASI TINDAKAN ANESTESI DAN SEDASI</h4>
    <p>Untuk semua tindakan anestesi dan sedasi harus dilakukan persiapan sebagai berikut :</p>
    <p>
      1. Untuk tindakan berencana pasien harus puasa. Puasa penting karena lambung harus kosong untuk menghindari keluarnya isi lambung ke rongga mulut pada waktu dibius dan isi lambung ini bisa masuk ke jalan napas dan menyebabkan sumbatan jalan nafas yang berkaibat fatal. Berikut adalah rekomendasi lamanya puasa sebelum anetesi dilakukan:
    </p>
    <table border="1" cellspacing="0">
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
        <td>6 - 36 Bulan</td>
        <td>6 Jam (ASI = 4 Jam)</td>
        <td>3 Jam</td>
      </tr>
      <tr>
        <td>> 36 Bulan</td>
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
      3. Semua make up, cat kuku harus dibersihkan agar warna kulit dapat dimonitor selama pembiusan, serta melepas perhiasan dan gigi palsu.
    </p>

    <h6 class="text-left bg-lightblue">1. ANESTESI UMUM (AU)</h6>
    <p>
      Tindakan AU adalah pembiusan dimana pasien dibuat tidak sadar sehingga tidak merasa nyeri. Obat bius diberikan melalui
      penyuntikan ke dalam pembuluh darah atau melalui gas/uap yang dihirup. Lama kerja obat disesuaikan dengan lama
      tindakan/operasi. Setelah pasien menjadi tidak sadar bila perlu dipasang alat bantu jalan napas ke dalam rongga mulut (pipa
      laryngeal) atau tenggorokan (pipa endotrakeal) agar jalan napas tetap terbuka. Oksigen dan gas lain akan dialirkan melalui
      selang pernapasan.
    </p>
    <p>
      <b><i>Kelebihan teknik AU : </i></b><br>
      <?= $form->field($model, 'leta_kelebihan_anestesi_umum', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Sejak awal operasi pasien sudah tidak sadar, tidak merasakan nyeri, lama pembiusan dapat disesuaikan dengan lama operasi' => 'Sejak awal operasi pasien sudah tidak sadar, tidak merasakan nyeri, lama pembiusan dapat disesuaikan dengan lama operasi',
      ])->label(false);
      ?>

      <b><i>Kekurangan teknik AU : </i></b><br>
      <?= $form->field($model, 'leta_kekurangan_anestesi_umum', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Obat yang diberikan berefek ke seluruh tubuh pasien, termasuk ke aliran darah janin dalam kandungan' => 'Obat yang diberikan berefek ke seluruh tubuh pasien, termasuk ke aliran darah janin dalam kandungan',
        'Pasca bedah pasien harus sadar penuh sebelum bisa diberi minum dan pemulihan relatif lebih lama' => 'Pasca bedah pasien harus sadar penuh sebelum bisa diberi minum dan pemulihan relatif lebih lama'
      ])->label(false);
      ?>
      <b><i>Komplikasi / Efek Samping : </i></b><br>
      <?= $form->field($model, 'leta_komplikasi_anestesi_umum', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Mual, muntah, menggigit, pusing, mengantuk, sakit tenggorokan, sakit menelan, bisa diatasi dengan obat-obatan' => 'Mual, muntah, menggigit, pusing, mengantuk, sakit tenggorokan, sakit menelan, bisa diatasi dengan obat-obatan',
        'Aspirasi (masuknya isi lambung ke dalam jalan nafas) dapat terjadi pada pasien tidak puasa' => 'Aspirasi (masuknya isi lambung ke dalam jalan nafas) dapat terjadi pada pasien tidak puasa',
        'Kesulitan pemasangan alat/pipa pernapasan yang tidak diduga sebelumnya' => 'Kesulitan pemasangan alat/pipa pernapasan yang tidak diduga sebelumnya',
        'Kejang pita suara (spasme laring), kejang jalan nafas bawah (spasma bronkus) dari ringan hingga berat yang dapat menyebabkan henti jantung' => 'Kejang pita suara (spasme laring), kejang jalan nafas bawah (spasma bronkus) dari ringan hingga berat yang dapat menyebabkan henti jantung',
        'Alergi/hipersensitif terhadap obat (jarang), mulai derajat ringan hingga berat/fatal.' => 'Alergi/hipersensitif terhadap obat (jarang), mulai derajat ringan hingga berat/fatal.'
      ])->label(false);
      ?>
    </p>

    <h6 class="text-left bg-lightblue">2. ANESTESI REGIONAL (SPINAL/EPIDURAL)</h6>
    <p>
      Blok Spinal dan epidural adalah pembiusan dengan menghilangkan sensasi bagian bawah tubuh, mulai dari perut sampai
      ke ujung kaki dengan kesadaran tidak terganggu. Dokter spesialis anestesi dapat memberikan obat tidur (apabila diperlukan).
      Pada anestesia blok spinal, obat disuntikkan di daerah punggung dengan jarum yang halus. Sedangkan blok epidural
      menggunakan jarum yang sedikit lebih besar dengan atau tanpa pemasangan selang (kateter). Posisi penyuntikan blok spinal
      dan epidural adalah duduk atau tidur miring. Setelah penyuntikan obat maka akan terjadi perubahan sesnsai dibagian bawah
      tubuh mulai dari rasa hangat, kesemutan, sampai akhirnya kehilangan seluruh sensasi dan rasa seperti tidak memiliki tungkai
      bawah. Efek ini berlangsung anatara 2 sampai 4 jam tergantung jenis dan konsentrasi obat yang digunakan. Bila digunakan
      kateter (epidural) efek anestesia regional dapat diulang.
    </p>
    <p>
      <b><i>Kelebihan Anestesia Blok Spinal dan Epidural : </i></b><br>
      <?= $form->field($model, 'leta_kelebihan_anestesi_regional', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Jumlah obat yang diberikan relatif lebih sedikit' => 'Jumlah obat yang diberikan relatif lebih sedikit',
        'Efek obat bersifat lokal sehingga tidak mempengaruhi fungsi organ dan tidak beredar ke seluruh tubuh sehingga janin dalam rahim tidak kena efek bius' => 'Efek obat bersifat lokal sehingga tidak mempengaruhi fungsi organ dan tidak beredar ke seluruh tubuh sehingga janin dalam rahim tidak kena efek bius',
        'Dapat ditambahkan obat penghilang rasa sakit ke dalam epidural yang bisa bertahan hingga >24 jam pasca bedah atau bisa ditambahkan sesuai kebutuhan' => 'Dapat ditambahkan obat penghilang rasa sakit ke dalam epidural yang bisa bertahan hingga >24 jam pasca bedah atau bisa ditambahkan sesuai kebutuhan',
        'Dapat langsung minum dan makan segera setelah tindakan/operasi selesai.' => 'Dapat langsung minum dan makan segera setelah tindakan/operasi selesai.',
        'Relatif lebih aman untuk pasien yang tidak puasa atau lama puasanya kurang (operasi emergency)' => 'Relatif lebih aman untuk pasien yang tidak puasa atau lama puasanya kurang (operasi emergency)'
      ])->label(false);
      ?>

      <b><i>Kekurangan Anestesia Blok Spinal dan Epidural : </i></b><br>
      <?= $form->field($model, 'leta_kekurangan_anestesi_regional', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Tidak boleh duduk atau angkat kepala kurang lebih 12 jam pasca operasi dan kadang merasakan mual.' => 'Tidak boleh duduk atau angkat kepala kurang lebih 12 jam pasca operasi dan kadang merasakan mual.',
      ])->label(false);
      ?>

      <b><i>Komplikasi/Efek Samping Blok Spinal dan Epidural : </i></b><br>
      <?= $form->field($model, 'leta_komplikasi_anestesi_regional', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Mual, Muntah, gatal-gatal, terutama didaerah wajah, menggigil semua bisa diatasi dengan obat' => 'Mual, Muntah, gatal-gatal, terutama didaerah wajah, menggigil semua bisa diatasi dengan obat',
        'Sakit kepala dibagian depan atau belakang pada hari ke 2 atau 3, terutama sewaktu mengangkat kepala dan menghilangkan setelah 5 sampai 7 hari.Bila tidak menghilang akan dilakukan intervensi sesuai kebutuhan' => 'Sakit kepala dibagian depan atau belakang pada hari ke 2 atau 3, terutama sewaktu mengangkat kepala dan menghilangkan setelah 5 sampai 7 hari.Bila tidak menghilang akan dilakukan intervensi sesuai kebutuhan',
        'Alergi/hipersensitif terhadap obat sangat jarang mulai ringan sampai berat.' => 'Alergi/hipersensitif terhadap obat sangat jarang mulai ringan sampai berat.',
        'Gangguan pernafasan dari mulai ringan sampai berat (henti nafas).' => 'Gangguan pernafasan dari mulai ringan sampai berat (henti nafas).',
        'Kelumpuhan atau kesemutan/rasa baal yang memanjang serta sakit pinggang' => 'Kelumpuhan atau kesemutan/rasa baal yang memanjang serta sakit pinggang',
        'Kejang, dapat ditangani sesuai prosedur tanpa gejala sisa' => 'Kejang, dapat ditangani sesuai prosedur tanpa gejala sisa',
        'Hematom pada lokasi penyuntikan' => 'Hematom pada lokasi penyuntikan'
      ])->label(false);
      ?>
    </p>

    <h6 class="text-left bg-lightblue">3. BLOK PERIFER</h6>
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
      <b><i>Kelebihan Anestesia Blok Perifier : </i></b><br>
      <?= $form->field($model, 'leta_kelebihan_anestesi_lokal', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Tidak mempengaruhi organ tubuh lain.' => 'Tidak mempengaruhi organ tubuh lain.',
        'Efek hilangnya sensasi cukup kuat dan bertahan lama(2-6 jam)' => 'Efek hilangnya sensasi cukup kuat dan bertahan lama(2-6 jam)',
        'Tidak perlu perawatan pasca pembiusan' => 'Tidak perlu perawatan pasca pembiusan'
      ])->label(false);
      ?>

      <b><i>Kekurangan Anestesia Blok Perifier : </i></b><br>
      <?= $form->field($model, 'leta_kekurangan_anestesi_lokal', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Nyeri pada tempat penyuntikan' => 'Nyeri pada tempat penyuntikan',
        'Dapat terjadi blok parsial (tidak seluruh bagian yang akan dioperasi bebas nyeri) yang memerlukan tambahan obat anestesi (intravena)' => 'Dapat terjadi blok parsial (tidak seluruh bagian yang akan dioperasi bebas nyeri) yang memerlukan tambahan obat anestesi (intravena)'
      ])->label(false);
      ?>

      <b><i>Komplikasi/Efek Samping Anestesia Blok Perifier : </i></b><br>
      <?= $form->field($model, 'leta_komplikasi_anestesi_lokal', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Pendarahan pada tempat suntikan, terutama bila terkena pembuluh darah' => 'Pendarahan pada tempat suntikan, terutama bila terkena pembuluh darah',
        'Blok yang memanjang lebih dari perkiraan sebelumnya' => 'Blok yang memanjang lebih dari perkiraan sebelumnya',
        'Komplikasi diatas dapat timbul tanpa diduga sebelumnya dan akan ditangani sesuai prosedur medis' => 'Komplikasi diatas dapat timbul tanpa diduga sebelumnya dan akan ditangani sesuai prosedur medis'
      ])->label(false);
      ?>
    </p>

    <h6 class="text-left bg-lightblue">4. SEDASI</h6>
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
      <b><i>Kelebihan Teknik Sedasi : </i></b><br>
      <?= $form->field($model, 'leta_kelebihan_sedasi', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Obat diberikan secara bertahap' => 'Obat diberikan secara bertahap',
        'Selama tindakan pasien dalam keadaan mengantuk dan tidur' => 'Selama tindakan pasien dalam keadaan mengantuk dan tidur'
      ])->label(false);
      ?>

      <b><i>Kelemahan Teknik Sedasi : </i></b><br>
      <?= $form->field($model, 'leta_kekurangan_sedasi', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Pasca sedasi pasien harus sadar penuh sebelum bisa diberi minum' => 'Pasca sedasi pasien harus sadar penuh sebelum bisa diberi minum',
        'Sampai 24 jam pasca sedasi pasien tidak diperbolehkan mengendarai mobil, mengoperasikan mesin dan menandatangani dokumen penting yang bersifat legal' => 'Sampai 24 jam pasca sedasi pasien tidak diperbolehkan mengendarai mobil, mengoperasikan mesin dan menandatangani dokumen penting yang bersifat legal'
      ])->label(false);
      ?>

      <b><i>Komplikasi/Efek Samping Sedasi : </i></b><br>
      <?= $form->field($model, 'leta_komplikasi_sedasi', ['options' => ['class' => 'form-group custom-margin']])->checkboxList([
        'Oleh karena tindakan sedasi merupakan rangkaian proses dinamik dan dapat berubah, maka sedasi ringan ataupun moderat bisa bergeser menjadi bersifat legal' => 'Oleh karena tindakan sedasi merupakan rangkaian proses dinamik dan dapat berubah, maka sedasi ringan ataupun moderat bisa bergeser menjadi bersifat legal',
        'Efek samping pasca sedasi dapat berupa : nausea/vomitus, mengigil, pusing, mengantuk, yang bisa diatasi dengan obatobatan' => 'Efek samping pasca sedasi dapat berupa : nausea/vomitus, mengigil, pusing, mengantuk, yang bisa diatasi dengan obatobatan',
        'Alergi/hipersensitif terhadap obat(sangat jarang), mulai derajat ringan hingga berat/fatal' => 'Alergi/hipersensitif terhadap obat(sangat jarang), mulai derajat ringan hingga berat/fatal',
        'Beresiko pada pasien yang tidak puasa, bisa terjadi aspirasi yaitu masuknya isi lambung ke jalan nafas/paru' => 'Beresiko pada pasien yang tidak puasa, bisa terjadi aspirasi yaitu masuknya isi lambung ke jalan nafas/paru',
        'Pada sedasi dalam terdapat kemungkinan memerlukan intubasi' => 'Pada sedasi dalam terdapat kemungkinan memerlukan intubasi'
      ])->label(false);
      ?>
    </p>

    <p>Setelah membaca dan diterangkan mengenai tindakan anestesi/sedasi diatas, maka saya bertanda tangan dibawah ini</p>

    <table width="100%">
      <tr>
        <td style="width:20%;"><label><?= $model->getAttributeLabel('leta_keluarga_nama') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_keluarga_nama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_keluarga_umur') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_keluarga_umur', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...'])->label(false); ?>
        </td>

      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_keluarga_jenis_kelamin') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $leta_keluarga_jenis_kelamin = ['Laki-Laki' => 'Laki-Laki', 'Perempuan' => 'Perempuan'];
          echo $form->field($model, 'leta_keluarga_jenis_kelamin', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($leta_keluarga_jenis_kelamin)->label(false);
          $leta_keluarga_jenis_kelamin = HelperGeneral::getValueCustomRadio($leta_keluarga_jenis_kelamin, $model->leta_keluarga_jenis_kelamin);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_keluarga_alamat') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_keluarga_alamat', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_keluarga_no_identitas') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_keluarga_no_identitas', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_keluarga_hubunga_dgn_pasien') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_keluarga_hubunga_dgn_pasien', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...'])->label(false); ?>
        </td>
      </tr>
    </table>

    <p>Menyatakan memberi <?php
                          $leta_setuju = ['1' => 'PERSETUJUAN', '0' => 'PENOLAKAN'];
                          echo $form->field($model, 'leta_setuju', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($leta_setuju)->label(false);
                          $leta_setuju = HelperGeneral::getValueCustomRadio($leta_setuju, $model->leta_setuju);
                          ?> tindakan anestesi/sedasi terhadap pasien:</p>
    <table width="100%">
      <tr>
        <td style="width:20%;"><label><?= $model->getAttributeLabel('leta_pasien_nama') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_pasien_nama', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_pasien_tgl_lahir') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_pasien_tgl_lahir', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'type' => 'date'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_pasien_no_rekam_medis') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_pasien_no_rekam_medis', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...'])->label(false); ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_pasien_diagnosa') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_pasien_diagnosa', [
            'template' => '<div class="col-sm-12">
                                    {input}
                                    {hint}{error}
                                </div>', 'options' => ['class' => 'form-group custom-margin']
          ])->textArea([
            'rows' => 10
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_pasien_rencana_tindakan') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_pasien_rencana_tindakan', [
            'template' => '<div class="col-sm-12">
                                    {input}
                                    {hint}{error}
                                </div>', 'options' => ['class' => 'form-group custom-margin']
          ])->textArea([
            'rows' => 10
          ])->label(false);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_pasien_jenis_anestesi') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?php
          $leta_pasien_jenis_anestesi = ['GA' => 'GA', 'LA' => 'LA', 'RA' => 'RA'];
          echo $form->field($model, 'leta_pasien_jenis_anestesi', ['options' => ['class' => 'form-group custom-margin']])->inline(true)->radioList($leta_pasien_jenis_anestesi)->label(false);
          $leta_pasien_jenis_anestesi = HelperGeneral::getValueCustomRadio($leta_pasien_jenis_anestesi, $model->leta_pasien_jenis_anestesi);
          ?>
        </td>
      </tr>
      <tr>
        <td><label><?= $model->getAttributeLabel('leta_pasien_analgesi_pasca_anestesi') ?> </label></td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_pasien_analgesi_pasca_anestesi', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...'])->label(false); ?>
        </td>
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
        <td><label>Tanggal</td>
        <td><label>:</label></td>
        <td>
          <?= $form->field($model, 'leta_tanggal_persetujuan', ['options' => ['class' => 'form-group custom-margin']])->textInput(['class' => 'form-control form-control-sm', 'placeholder' => 'Ketik disini...', 'type' => 'datetime-local'])->label(false); ?>
        </td>
      </tr>
    </table>


  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'leta_final')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini', //mini atau large
              'onText' => 'Final','handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <?= Html::submitButton(Yii::t('app', '{title}', ['title' => '<i class="fas fa-save"></i> Simpan']), ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button(Yii::t('app', '{title}', ['title' => '<i class="fas fa-sync"></i> Segarkan']), ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a(Yii::t('app', '{title}', ['title' => '<i class="fas fa-times"></i> Kembali']), ['/lembar-edukasi-tindakan-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end(); ?>