<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\bedahsentral\JabatanOperasi */

$this->title = 'Update Jabatan Operasi: ' . $model->jo_id;
$this->params['breadcrumbs'][] = ['label' => 'Jabatan Operasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jo_id, 'url' => ['view', 'jo_id' => $model->jo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jabatan-operasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
