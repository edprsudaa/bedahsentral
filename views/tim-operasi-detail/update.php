<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\bedahsentral\TimOperasiDetail */

$this->title = 'Update Tim Operasi Detail: ' . $model->tod_id;
$this->params['breadcrumbs'][] = ['label' => 'Tim Operasi Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tod_id, 'url' => ['view', 'tod_id' => $model->tod_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tim-operasi-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
