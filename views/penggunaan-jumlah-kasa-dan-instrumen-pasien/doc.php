<?php

use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\IntraOperasiPerawat;
use app\models\bedahsentral\PenggunaanJumlahKasaDanInstrumen;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use yii\helpers\ArrayHelper;

$model = PenggunaanJumlahKasaDanInstrumen::find()->where(['pjki_id' => $pjki_id])->andWhere('pjki_deleted_at is null')->one();
$style = 'border: 1px solid;';
if ($model->pjki_batal) {
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
?>
<style type="text/css">
  .bedah {
    width: 25%;
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

  td {
    padding: 2px;
  }
</style>
<?php
$timoperasi = TimOperasi::find()->where(['to_id' => $model->pjki_to_id])->one();
?>
<table cellspacing="0" width="100%" class="table table-sm table-form" style="<?= $style ?>">
  <tr>
    <th colspan="6" class="text-center bg-lightblue">PENGGUNAAN JUMLAH KASA DAN INSTRUMEN</th>
  </tr>
  <tr>
    <td><label>OPERASI/TINDAKAN</label></td>
    <td>:</td>
    <td colspan="4">
      <?= $timoperasi->to_tindakan_operasi ?>
    </td>
  </tr>
  <tr>
    <td><label>Kamar Operasi</label></td>
    <td>:</td>
    <td>
      <?= str_replace("KAMAR OPERASI", "", $timoperasi->unit->nama); ?>
    </td>
    <td><label>Ahli Bedah</label></td>
    <td>:</td>
    <td>
      <?php
      $ahlibedah = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 1])->all();
      // print_r($timoperasi->to_id);die;
      if ($ahlibedah) {
        foreach ($ahlibedah as $val) {
          echo HelperSpesial::getNamaPegawai($val->pegawai);
        }
      } else {
        echo "Belum diinput";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Tanggal Operasi</label></td>
    <td>:</td>
    <td>
      <?= \Yii::$app->formatter->asDate($timoperasi->to_tanggal_operasi); ?>
    </td>
    <td><label>Ahli Anestesi</label></td>
    <td>:</td>
    <td>
      <?php
      $ahlianestesi = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 2])->all();

      if ($ahlianestesi) {
        foreach ($ahlianestesi as $val) {
          echo HelperSpesial::getNamaPegawai($val->pegawai);
        }
      } else {
        echo "Belum diinput";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Operasi Mulai Jam</label></td>
    <td>:</td>
    <td>
      <?php
      $mulai = IntraOperasiPerawat::find()->orderBy(['iop_id' => SORT_DESC])->where(['iop_to_id' => $timoperasi->to_id])->one();
      echo ($mulai ? $mulai->iop_jam_mulai_bedah : 'belum di isi');
      ?>
    </td>
    <td valign="top"><label>Asisten/Instrumen</label></td>
    <td valign="top">:</td>
    <td>
      <?php
      $asisten = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['or', ['tod_jo_id' => 3], ['tod_jo_id' => 6]])->all();
      $no = 1;

      if ($asisten) {
        foreach ($asisten as $val) {
          echo $no++ . ". " . HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
        }
      } else {
        echo "Belum diinput";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Operasi Selesai Jam</label></td>
    <td>:</td>
    <td>
      <?php
      $selesai = IntraOperasiPerawat::find()->orderBy(['iop_id' => SORT_DESC])->where(['iop_to_id' => $timoperasi->to_id])->one();
      echo ($selesai ? $selesai->iop_jam_selesai_bedah : 'belum di isi');
      ?>
    </td>
    <td><label>Perawat Sirkuler</label></td>
    <td>:</td>
    <td>
      <?php
      $sirkuler = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 4])->all();
      $no = 1;

      if ($sirkuler) {
        foreach ($sirkuler as $val) {
          echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
        }
      } else {
        echo "Belum diinput";
      }
      ?>
    </td>
  </tr>
  <tr>
    <td><label>Pasien Keluar Kamar Operasi</label></td>
    <td>:</td>
    <td>

    </td>
    <td><label>Penata Anestesi</label></td>
    <td>:</td>
    <td>
      <?php
      $perawatanestesi = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 5])->all();
      $no = 1;

      if ($perawatanestesi) {
        foreach ($perawatanestesi as $val) {
          echo HelperSpesial::getNamaPegawai($val->pegawai) . "<br>";
        }
      } else {
        echo "Belum diinput";
      }
      ?>
    </td>
  </tr>
</table>
<br>
<table border="1" cellspacing="0" width="100%">
  <thead>
    <tr align="center" class="text-center bg-lightblue">
      <th rowspan="2">PERHITUNGAN ITEM</th>
      <th rowspan="2">HITUNGAN PERTAMA</th>
      <th rowspan="2">TAMBAHAN SELAMA OPERASI</th>
      <th rowspan="2">JUMLAH</th>
      <th colspan="2">HITUNGAN TERAKHIR</th>
    </tr>
    <tr align="center" class="text-center bg-lightblue">
      <th>Dipakai</th>
      <th>Sisa</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><label>Tangkai Pisau</label></td>
      <td><?= $model->pjki_tangkai_pisau_hitungan_pertama  ?></td>
      <td><?= $model->pjki_tangkai_pisau_tambahan_slma_operasi  ?></td>
      <td><?= $model->pjki_tangkai_pisau_jumlah  ?></td>
      <td><?= $model->pjki_tangkai_pisau_dipakai  ?></td>
      <td><?= $model->pjki_tangkai_pisau_sisa  ?></td>
    </tr>
    <tr>
      <td><label>Pinset Anatomis</label></td>
      <td><?= $model->pjki_pinset_anatomis_hitungan_pertama  ?></td>
      <td><?= $model->pjki_pinset_anatomis_tambahan_slma_operasi  ?></td>
      <td><?= $model->pjki_pinset_anatomis_jumlah  ?></td>
      <td><?= $model->pjki_pinset_anatomis_dipakai  ?></td>
      <td><?= $model->pjki_pinset_anatomis_sisa  ?></td>
    </tr>
    <tr>
      <td><label>Pinset Chrirurgis</label></td>
      <td><?= $model->pjki_pinset_chrirurgis_hitungan_pertama  ?></td>
      <td><?= $model->pjki_pinset_chrirurgis_tambahan_slma_operasi  ?></td>
      <td><?= $model->pjki_pinset_chrirurgis_jumlah  ?></td>
      <td><?= $model->pjki_pinset_chrirurgis_dipakai  ?></td>
      <td><?= $model->pjki_pinset_chrirurgis_sisa  ?></td>
    </tr>
    <tr>
      <td><label>Gunting Benang</label></td>
      <td><?= $model->pjki_gunting_benang_hitungan_pertama  ?></td>
      <td><?= $model->pjki_gunting_benang_tambahan_slma_operasi  ?></td>
      <td><?= $model->pjki_gunting_benang_jumlah  ?></td>
      <td><?= $model->pjki_gunting_benang_dipakai  ?></td>
      <td><?= $model->pjki_gunting_benang_sisa  ?></td>
    </tr>
    <tr>
      <td><label>Gunting Jaringan</label></td>
      <td><?= $model->pjki_gunting_jaringan_hitungan_pertama  ?></td>
      <td><?= $model->pjki_gunting_jaringan_tambahan_slma_operasi  ?></td>
      <td><?= $model->pjki_gunting_jaringan_jumlah  ?></td>
      <td><?= $model->pjki_gunting_jaringan_dipakai  ?></td>
      <td><?= $model->pjki_gunting_jaringan_sisa  ?></td>
    </tr>
    <tr>
      <td><label>Mosquito Pean L/B</label></td>
      <td><?= $model->pjki_mosquito_pean_hitungan_pertama  ?></td>
      <td><?= $model->pjki_mosquito_pean_tambahan_slma_operasi  ?></td>
      <td><?= $model->pjki_mosquito_pean_jumlah  ?></td>
      <td><?= $model->pjki_mosquito_pean_dipakai  ?></td>
      <td><?= $model->pjki_mosquito_pean_sisa  ?></td>
    </tr>
    <tr>
      <td><label>Pean Lurus</label></td>
      <td>
        <?= $model->pjki_pean_lurus_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_pean_lurus_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_pean_lurus_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_pean_lurus_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_pean_lurus_sisa ?>
      </td>
    </tr>
    <tr>
      <td><label>Pean Bengkok</label></td>
      <td>
        <?= $model->pjki_pean_bengkok_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_pean_bengkok_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_pean_bengkok_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_pean_bengkok_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_pean_bengkok_sisa ?>
      </td>
    </tr>
    <tr>
      <td><label>Duk Klem</label></td>
      <td>
        <?= $model->pjki_duk_klem_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_duk_klem_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_duk_klem_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_duk_klem_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_duk_klem_sisa ?>
      </td>
    </tr>
    <tr>
      <td><label>Needle Holder</label></td>
      <td>
        <?= $model->pjki_needle_holder_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_needle_holder_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_needle_holder_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_needle_holder_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_needle_holder_sisa ?>
      </td>
    </tr>
    <tr>
      <td><label>Kocher</label></td>
      <td>
        <?= $model->pjki_kocher_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_kocher_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_kocher_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_kocher_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_kocher_sisa ?>
      </td>
    </tr>
    <tr>
      <td>
        <?= $model->pjki_tambahan_1; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_1_hitungan_pertama; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_1_tambahan_slma_operasi; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_1_jumlah; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_1_dipakai; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_1_sisa; ?>
      </td>
    </tr>
    <tr>
      <td>
        <?= $model->pjki_tambahan_2; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_2_hitungan_pertama; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_2_tambahan_slma_operasi; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_2_jumlah; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_2_dipakai; ?>
      </td>
      <td>
        <?= $model->pjki_tambahan_2_sisa; ?>
      </td>
    </tr>
    <tr>
      <td><label>Needle Atraumatic</label></td>
      <td>
        <?= $model->pjki_needle_atrumatic_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_needle_atrumatic_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_needle_atrumatic_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_needle_atrumatic_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_needle_atrumatic_sisa ?>
      </td>
    </tr>
    <tr>
      <td><label>Kassa</label></td>
      <td>
        <?= $model->pjki_kassa_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_kassa_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_kassa_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_kassa_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_kassa_sisa ?>
      </td>
    </tr>
    <tr>
      <td><label>Roll Kasa</label></td>
      <td>
        <?= $model->pjki_roll_kassa_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_roll_kassa_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_roll_kassa_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_roll_kassa_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_roll_kassa_sisa ?>
      </td>
    </tr>
    <tr>
      <td><label>Depper/Waches</label></td>
      <td>
        <?= $model->pjki_depper_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_depper_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_depper_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_depper_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_depper_sisa ?>
      </td>
    </tr>
    <tr>
      <td><label>Kacang(Peanut)</label></td>
      <td>
        <?= $model->pjki_kacang_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_kacang_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_kacang_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_kacang_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_kacang_sisa ?>
      </td>
    </tr>
    <tr>
      <td><label>Lidi Waten</label></td>
      <td>
        <?= $model->pjki_lidi_waten_hitungan_pertama ?>
      </td>
      <td>
        <?= $model->pjki_lidi_waten_tambahan_slma_operasi ?>
      </td>
      <td>
        <?= $model->pjki_lidi_waten_jumlah ?>
      </td>
      <td>
        <?= $model->pjki_lidi_waten_dipakai ?>
      </td>
      <td>
        <?= $model->pjki_lidi_waten_sisa ?>
      </td>
    </tr>
  </tbody>
</table>

<br>


<div class="ttd" style="width:100%">
  <div class="bedah" style="">
    <p>Ahli Bedah</p>
    <?php
    $ahlibedah = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 1])->all();
    foreach ($ahlibedah as $val) {
      echo "(" . HelperSpesial::getNamaPegawai($val->pegawai) . ")</br>";
    }
    ?>
  </div>
  <div class="bedah">
    <p>Asisten</p>
    <?php
    $asisten = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 3])->all();
    foreach ($asisten as $val) {
      echo "(" . HelperSpesial::getNamaPegawai($val->pegawai) . ")</br>";
    }
    ?>
  </div>
  <div class="bedah">
    <p>Perawat Instrumen</p>
    <?php
    $instrumen = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 6])->all();
    foreach ($instrumen as $val) {
      echo "(" . HelperSpesial::getNamaPegawai($val->pegawai) . ")</br>";
    }
    ?>
  </div>
  <div class="bedah">
    <p>Perawat Sirkuler</p>
    <?php
    $sirkuler = TimOperasiDetail::find()->where(['tod_to_id' => $timoperasi->to_id])->andWhere(['tod_jo_id' => 4])->all();
    foreach ($sirkuler as $val) {
      echo "(" . HelperSpesial::getNamaPegawai($val->pegawai) . ")</br>";
    }
    ?>
  </div>
</div>