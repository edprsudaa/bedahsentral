<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\bedahsentral\TimOperasiDetail */

$this->title = $model->tod_id;
$this->params['breadcrumbs'][] = ['label' => 'Tim Operasi Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tim-operasi-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'tod_id' => $model->tod_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'tod_id' => $model->tod_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'tod_id',
            'tod_to_id',
            'tod_jo_id',
            'tod_pgw_id',
            'tod_created_at',
            'tod_created_by',
            'tod_updated_at',
            'tod_updated_by',
            'tod_deleted_at',
            'tod_deleted_by',
        ],
    ]) ?>

</div>
