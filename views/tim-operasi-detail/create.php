<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\bedahsentral\TimOperasiDetail */

$this->title = 'Create Tim Operasi Detail';
$this->params['breadcrumbs'][] = ['label' => 'Tim Operasi Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tim-operasi-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
