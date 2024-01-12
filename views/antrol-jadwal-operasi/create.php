<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\bpjskes\AntrolJadwalOperasi $model */

$this->title = 'Create Antrol Jadwal Operasi';
$this->params['breadcrumbs'][] = ['label' => 'Antrol Jadwal Operasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="antrol-jadwal-operasi-create">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= $this->render('_form', [
    'model' => $model,
  ]) ?>

</div>