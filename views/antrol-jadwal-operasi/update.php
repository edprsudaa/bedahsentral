<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\bpjskes\AntrolJadwalOperasi $model */

$this->title = 'Update Antrol Jadwal Operasi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Antrol Jadwal Operasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="antrol-jadwal-operasi-update">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('_form', [
    'model' => $model,
  ]) ?>

</div>