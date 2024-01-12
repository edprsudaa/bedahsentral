<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\IntraAnestesi */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = (($model->isNewRecord)?"Tambah ".$title:"Ubah ".$title);
$this->params['breadcrumbs'][] = ['label' => 'Intra Anestesi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if(!\Yii::$app->request->isAjax){
    echo $this->render('../layouts/card-pasien.php',['layanan'=>$chk_pasien]);
}
?>
<div class="page-form-<?=$model->formName()?>">
    <?php
    if(!$model->isNewRecord){
        echo $this->render('_form_update', [
            'title'=>$title,
            'model' => $model,
            'modelttv' => $modelttv,
            'modelmedikasi' => $modelmedikasi,
            'modelcairanmasuk' => $modelcairanmasuk,
            'modelcairankeluar' => $modelcairankeluar 
        ]);
    }else{
        echo $this->render('_form_create', [
            'title'=>$title,
            'model' => $model,
            'modelttv' => $modelttv,
            'modelmedikasi' => $modelmedikasi,
            'modelcairanmasuk' => $modelcairanmasuk,
            'modelcairankeluar' => $modelcairankeluar 
        ]);
    }  
    ?>
</div>