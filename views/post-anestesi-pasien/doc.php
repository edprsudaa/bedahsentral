<?php
use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\PostAnestesi;
use yii\helpers\ArrayHelper;
$model=PostAnestesi::find()->where(['mpa_id'=>$mpa_id])->andWhere('mpa_deleted_at is null')->one();
$style='border: 1px solid;';
if($model->mpa_batal){
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
echo \Yii::$app->controller->renderPartial('../layouts/doc_kop.php',['params'=>['reg_kode'=>$model->timoperasi->layanan->registrasi_kode,'pl_id'=>'']]);
?>
<style type="text/css">
    .bedah{
        width:33%; float: left; text-align: center;
    }
    .bedah p{
        padding-bottom: 50px;
    }
    #pengkajian{
        border-top: 2px solid; border-bottom: 2px solid;
    }
    .table-form th,
    .table-form td {
        padding: 0.5px;
        /* border: 0.5px solid #3c8dbc; */
        border: 0px;
    }
</style>

<table  class="table table-sm table-form">
    <tr>
        <th class="text-left bg-lightblue" colspan="3">POST ANESTESI</th>
    </tr>
    <tr>
        <td style="width: 20%;"><label><?= $model->getAttributeLabel('mpa_jam_tiba_diruang_pemulihan') ?></label></td>
        <td style="width:2%;"><label>:</label></td>
        <td style="width:75%;"><?= $model->mpa_jam_tiba_diruang_pemulihan ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_keluar_jam') ?></label></td>
        <td><label>:</label></td>
        <td><?= $model->mpa_keluar_jam ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_jenis_tools_digunakan') ?></label></td>
        <td><label>:</label></td>
        <td><?= $model->mpa_jenis_tools_digunakan ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_skor_tools') ?></label></td>
        <td><label>:</label></td>
        <td><?= $model->mpa_skor_tools ?></td>
    </tr>
    <tr>
        <th class="text-left bg-lightblue" colspan="3">Instruksi Post Operasi</th>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_awasi') ?></label></td>
        <td><label>:</label></td>
        <td> <?= $model->mpa_instruksi_awasi ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_posisi') ?></label></td>
        <td><label>:</label></td>
        <td><?= $model->mpa_instruksi_posisi ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_makan_minum') ?></label></td>
        <td><label>:</label></td>
        <td><?= $model->mpa_instruksi_makan_minum ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_infus') ?></label></td>
        <td><label>:</label></td>
        <td><?= $model->mpa_instruksi_infus ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_transfusi') ?></label></td>
        <td><label>:</label></td>
        <td><?= $model->mpa_instruksi_transfusi ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_program_analgetik') ?></label> </td>
        <td><label>:</label></td>
        <td><?= $model->mpa_instruksi_program_analgetik ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_program_mual_muntah') ?></label> </td>
        <td><label>:</label></td>
        <td><?= $model->mpa_instruksi_program_mual_muntah ?></td>
    </tr>
    <tr>
        <td><label><?= $model->getAttributeLabel('mpa_instruksi_lain_lain') ?></label></td>
        <td><label>:</label></td>
        <td><?= $model->mpa_instruksi_lain_lain ?></td>
    </tr>
</table>
