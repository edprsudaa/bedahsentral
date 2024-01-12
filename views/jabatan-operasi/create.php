<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\bedahsentral\JabatanOperasi */

$this->title = 'Create Jabatan Operasi';
$this->params['breadcrumbs'][] = ['label' => 'Jabatan Operasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatan-operasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
