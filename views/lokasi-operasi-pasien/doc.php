<?php
use yii\helpers\Url;
use app\components\HelperSpesial;
use app\models\bedahsentral\LokasiOperasi;
use yii\helpers\ArrayHelper;
$model=LokasiOperasi::find()->where(['mlo_id'=>$mlo_id])->andWhere('mlo_deleted_at is null')->one();
$style='border: 1px solid;';
if($model->mlo_batal){
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
<style>
    .pain{
        border: 2px solid darkblue;
        height: 450px;
        background-image: url("<?= Yii::$app->homeUrl.'app/images/lokasi.png' ?>"); 
        background-repeat: no-repeat;
        background-size: 400px;
        width: 400px;
        height: 350px;
        position: relative;
        left: 50%;
        margin: 0 -250px;
        margin-top: 20px;
    }
    .utama{
        width: 100%;
    }
    .gambar{
        width: 50%;
        float: left;
    }
    .ket{
        width: 50%;
        float: left;
        margin-top: 20px;
    }
</style>
<div class="utama">
    <div class="gambar">
        <img src="<?= $model->mlo_gambar_marking ?>" alt="gambar" class="pain"/>
    </div>
    <div class="ket" style="<?= $style ?>">
        <h5>Keterangan</h5>
        <p><?= $model->mlo_keterangan_marking ?></p></br>
    </div>
</div>

