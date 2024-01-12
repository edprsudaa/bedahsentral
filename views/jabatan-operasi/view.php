<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\bedahsentral\JabatanOperasi */

$this->title = $model->jo_id;
$this->params['breadcrumbs'][] = ['label' => 'Jabatan Operasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="jabatan-operasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'jo_id' => $model->jo_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'jo_id' => $model->jo_id], [
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
            'jo_id',
            'jo_jabatan:ntext',
            'jo_utama',
            'jo_created_at',
            'jo_created_by',
            'jo_updated_at',
            'jo_updated_by',
            'jo_deleted_at',
            'jo_deleted_by',
        ],
    ]) ?>

</div>
