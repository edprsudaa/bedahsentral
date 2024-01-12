<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\pendaftaran\Registrasi */

$this->title = 'Update Registrasi: ' . $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Registrasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kode, 'url' => ['view', 'kode' => $model->kode]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registrasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
