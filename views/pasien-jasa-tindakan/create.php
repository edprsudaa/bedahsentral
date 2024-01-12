<?php
use yii\helpers\Html;
if(\Yii::$app->request->isAjax){
    echo $this->renderAjax('_form', [
        'model' => $model,
        'layanan'=>$layanan
    ]);
}else{
    echo $this->render('_form', [
        'model' => $model,
        'layanan'=>$layanan
    ]);
}