<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\PenunjangOrder */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tim Operasi';
$this->params['breadcrumbs'][] = $this->title;
if (!\Yii::$app->request->isAjax) {
  echo $this->render('../layouts/card-pasien.php', ['layanan' => $chk_pasien]);
}
?>
<div class="page-form-<?= $model->formName() ?>">
  <?php
  if (!$model->isNewRecord) {
    echo $this->render('_form_update', [
      'model' => $model,
      'modelDetails' => $modelDetails,
      'referensi' => $referensi,
      'layanan' => $chk_pasien
    ]);
  } else {
    echo $this->render('_form_create', [
      'model' => $model,
      'modelDetails' => $modelDetails,
      'referensi' => $referensi,
      'layanan' => $chk_pasien
    ]);
  }
  ?>
</div>