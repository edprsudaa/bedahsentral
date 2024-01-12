<?php
use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\InformConcentTindakanDokter;
use yii\helpers\ArrayHelper;
$model=InformConcentTindakanDokter::find()->with(['dokter', 'perawat'])->where(['incon_id'=>$incon_id])->notDeleted()->one();
$style='border: 1px solid;';

if($model->incon_batal){
    if(\Yii::$app->params['setting']['doc']['bg_batal']){
        $path = \Yii::getAlias('@webroot').\Yii::$app->params['setting']['doc']['bg_batal'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $style="border: 1px solid;background-image:url('".$base64."');background-repeat: repeat;background-size: 80px 50px;";
    }
}
// echo'<pre/>';print_r($penunjang_order);die();
// https://www.picturetopeople.org/text_generator/others/transparent/transparent-text-generator.html
echo \Yii::$app->controller->renderPartial('../layouts/doc_kop.php',['params'=>['reg_kode'=>$model->timoperasi->layanan->pl_reg_kode,'pl_id'=>'']]);
?>
<style>   
#tgl{
    text-align: right;
}
.bedah{
    width:33%; float: left; text-align: center;
}
.bedah p{
    padding-bottom: 50px;
}
#judul{
    height: 50px;
    background: grey;
}
p{
    font-size: 20px;
}
h2 {
    text-align: center !important;
}
table {
    margin-left: auto !important;
    margin-right: auto !important;
    margin-bottom: 10px !important;
    width: 100% !important;
}
th {
    background-color: #D3D3D3 !important;
    text-align: left !important;
}
td {
    padding: 0 0 0 0px !important;
}
</style>

<?php 
    if($model->incon_setuju == 1){ 
        if($model->incon_penerima_informasi == "Pasien"){  ?>
            <table border="1" cellspacing="0" width="100%" style="<?= $style ?>">
                <tr>
                    <th id="judul"><h2>PERSETUJUAN PENGOBATAN/TINDAKAN</h2></th>
                </tr>
                <tr>
                    <td>
                        <p>Yang bertanda tangan dibawah ini <br> nama <?= $model->timoperasi->layanan->registrasi->pasien->ps_nama ?>, Tanggal lahir <?= $model->timoperasi->layanan->registrasi->pasien->ps_tgl_lahir ?>, <?= $model->timoperasi->layanan->registrasi->pasien->ps_jkel == "l" ? "Laki-Laki" : "Perempuan" ?>, alamat <?= $model->timoperasi->layanan->registrasi->pasien->ps_alamat ?>, Dengan ini menyatakan <b>PERSETUJUAN PENGOBATAN/TINDAKAN:</b> <?= $model->incon_tindakan_inform_consent ?> <br>
                        Saya memahami perlunya dan manfaat pengobatan/tindakan sebagaimana telah dijelaskan seperti diatas kepada saya, termasuk resiko dan komplikasi yang mungkin timbul. Saya juga menyadari bahwa dokter melakukan suatu upaya dan oleh karena ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan pengobatan/tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa. </p>
                        <br>
                        <p id="tgl">Bangkinang, tanggal <?= Date("d M Y", strtotime($model->incon_created_at)) ?> jam <?= Date("H:i:s", strtotime($model->incon_created_at)) ?></p>
                        <div class="ttd" style="width:100%">
                            <div class="bedah" style="">
                                <p>Yang menyatakan*</p>
                                (<?= $model->timoperasi->layanan->registrasi->pasien->ps_nama ?>)<br>
                                Tanda tangan & nama
                            </div>
                            <div class="bedah">
                                <p>Saksi I<br>Keluarga Pasien</p>
                                (<?= $model->incon_keluarga_saksi ?>)<br>
                                Tanda tangan & nama
                            </div>
                            <div class="bedah">
                                <p>Saksi II<br>Petugas Rumah Sakit</p>
                                (<?=HelperSpesial::getNamaPegawai($model->perawat)?>)<br>
                                Tanda tangan & nama
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

    <?php }else{ ?>
        <table border="1" cellspacing="0" width="100%" style="<?= $style ?>">
            <tr>
                <th id="judul"><h2>PERSETUJUAN PENGOBATAN/TINDAKAN</h2></th>
            </tr>
            <tr>
                <td>
                    <p>Yang bertanda tangan dibawah ini <br> nama <?= $model->incon_keluarga_nama ?>, umur <?= $model->incon_keluarga_umur ?> tahun, <?= $model->incon_keluarga_jenis_kelamin == "l" ? "Laki-Laki" : "Perempuan" ?>, alamat <?= $model->incon_keluarga_alamat ?>, Dengan ini menyatakan <b>PERSETUJUAN PENGOBATAN/TINDAKAN:</b> <?= $model->incon_tindakan_inform_consent ?> terhadap <?= $model->incon_hubungan_keluarga ?> saya , bernama <?= $model->timoperasi->layanan->registrasi->pasien->ps_nama ?> Tgl lahir <?= $model->timoperasi->layanan->registrasi->pasien->ps_tgl_lahir ?>. <?= $model->timoperasi->layanan->registrasi->pasien->ps_jkel ?>, alamat <?= $model->timoperasi->layanan->registrasi->pasien->ps_alamat ?> <br>
                    Saya memahami perlunya dan manfaat pengobatan/tindakan sebagaimana telah dijelaskan seperti diatas kepada saya, termasuk resiko dan komplikasi yang mungkin timbul. Saya juga menyadari bahwa dokter melakukan suatu upaya dan oleh karena ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan pengobatan/tindakan kedokteran bukanlah keniscayaan, melainkan sangat bergantung kepada izin Tuhan Yang Maha Esa. </p>
                    <br>
                    <p id="tgl">Bangkinang, tanggal <?= Date("d M Y", strtotime($model->incon_created_at)) ?> jam <?= Date("H:i:s", strtotime($model->incon_created_at)) ?></p>
                    <div class="ttd" style="width:100%">
                        <div class="bedah" style="">
                            <p>Yang menyatakan*</p>
                            (<?= $model->incon_keluarga_nama ?>)<br>
                            Tanda tangan & nama
                        </div>
                        <div class="bedah">
                            <p>Saksi I<br>Keluarga Pasien</p>
                            (<?= $model->incon_keluarga_saksi ?>)<br>
                            Tanda tangan & nama
                        </div>
                        <div class="bedah">
                            <p>Saksi II<br>Petugas Rumah Sakit</p>
                            (<?=HelperSpesial::getNamaPegawai($model->perawat)?>)<br>
                            Tanda tangan & nama
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    <?php }
      }else{ 
        if($model->incon_penerima_informasi == "Pasien"){ ?>
            <table border="1" cellspacing="0" width="100%" style="<?= $style ?>">
                <tr>
                    <th id="judul"><h2>PENOLAKAN PENGOBATAN/TINDAKAN</h2></th>
                </tr>
                <tr>
                    <td>
                        <p>Yang bertanda tangan dibawah ini<br>  
                        nama <?= $model->timoperasi->layanan->registrasi->pasien->ps_nama ?>, 
                        Tanggal lahir  <?= $model->timoperasi->layanan->registrasi->pasien->ps_tgl_lahir ?> , 
                        <?= $model->timoperasi->layanan->registrasi->pasien->ps_jkel == "l" ? "Laki-Laki" : "Perempuan" ?>, 
                        alamat <?= $model->timoperasi->layanan->registrasi->pasien->ps_alamat ?>,
                        Dengan ini menyatakan<br> <b>PENOLAKAN PENGOBATAN/TINDAKAN:</b>.<?= $model->incon_tindakan_inform_consent ?> terhadap saya<br>
                        Saya memahami perlunya dan manfaat pengobatan/tindakan sebagaimana telah dijelaskan seperti diatas kepada saya, termasuk resiko dan komplikasi yang mungkin timbul. Saya bertanggung jawab secara penuh atas segala akibat yang mungkin timbul sebagai akibat tidak dilakukannya pengobatan/tindakan tersebut. </p>
                        <br>
                        <p id="tgl">Bangkinang, tanggal  <?= Date("d M Y", strtotime($model->incon_created_at)) ?> jam <?= Date("H:i:s", strtotime($model->incon_created_at)) ?></p>
                        <div class="ttd" style="width:100%">
                            <div class="bedah" style="">
                                <p>Yang menyatakan*</p>
                                (<?= $model->timoperasi->layanan->registrasi->pasien->ps_nama ?>)<br>
                                Tanda tangan & nama
                            </div>
                            <div class="bedah">
                                <p>Saksi I<br>Keluarga Pasien</p>
                                (<?= $model->incon_keluarga_saksi ?>)<br>
                                Tanda tangan & nama
                            </div>
                            <div class="bedah">
                                <p>Saksi II<br>Petugas Rumah Sakit</p>
                                (<?=HelperSpesial::getNamaPegawai($model->perawat)?>)<br>
                                Tanda tangan & nama
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        <?php }else{ ?>
            <table border="1" cellspacing="0" width="100%" style="<?= $style ?>">
                <tr>
                    <th id="judul"><h2>PENOLAKAN PENGOBATAN/TINDAKAN</h2></th>
                </tr>
                <tr>
                    <td>
                        <p>Yang bertanda tangan dibawah ini
                            nama <?= $model->incon_keluarga_nama ?>,
                            umur <?= $model->incon_keluarga_umur ?>tahun, 
                            <?= $model->incon_keluarga_jenis_kelamin ?>, 
                            alamat <?= $model->incon_keluarga_alamat ?>, 
                            Dengan ini menyatakan<br> <b>PENOLAKAN PENGOBATAN/TINDAKAN:</b><?= $model->incon_tindakan_inform_consent ?> 
                            terhadap <?= $model->incon_hubungan_keluarga ?> saya, 
                            bernama <?= $model->timoperasi->layanan->registrasi->pasien->ps_nama ?> 
                            Tgl lahir <?= $model->timoperasi->layanan->registrasi->pasien->ps_tgl_lahir ?> <?= $model->timoperasi->layanan->registrasi->pasien->ps_jkel == "l" ? "Laki-Laki" : "Perempuan" ?>, 
                            alamat <?= $model->timoperasi->layanan->registrasi->pasien->ps_alamat ?><br>
                        Saya memahami perlunya dan manfaat pengobatan/tindakan sebagaimana telah dijelaskan seperti diatas kepada saya, termasuk resiko dan komplikasi yang mungkin timbul. Saya bertanggung jawab secara penuh atas segala akibat yang mungkin timbul sebagai akibat tidak dilakukannya pengobatan/tindakan tersebut. </p>
                        <br>
                        <p id="tgl">Bangkinang, tanggal <?= Date("d M Y", strtotime($model->incon_created_at)) ?> jam <?= Date("H:i:s", strtotime($model->incon_created_at)) ?></p>
                        <div class="ttd" style="width:100%">
                            <div class="bedah" style="">
                                <p>Yang menyatakan*</p>
                                (<?= $model->incon_keluarga_nama ?>)<br>
                                Tanda tangan & nama
                            </div>
                            <div class="bedah">
                                <p>Saksi I<br>Keluarga Pasien</p>
                                (<?= $model->incon_keluarga_saksi ?>)<br>
                                Tanda tangan & nama
                            </div>
                            <div class="bedah">
                                <p>Saksi II<br>Petugas Rumah Sakit</p>
                                (<?=HelperSpesial::getNamaPegawai($model->perawat)?>)<br>
                                Tanda tangan & nama
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        <?php }  }    
    ?>
      