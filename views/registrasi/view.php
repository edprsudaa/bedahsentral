<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\pendaftaran\Registrasi */

$this->title = $model->kode;
$this->params['breadcrumbs'][] = ['label' => 'Registrasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registrasi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'kode' => $model->kode], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'kode' => $model->kode], [
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
            'kode',
            'pasien_kode',
            'tgl_masuk',
            'tgl_keluar',
            'kiriman_detail_kode',
            'debitur_detail_kode',
            'created_by',
            'created_at',
            'updated_by',
            'updated_at',
            'deleted_at',
            'no_sep',
            'deleted_by',
            'is_print',
            'lambar',
            'old_kiriman_detail_kode',
            'old_debitur_detail_kode',
        ],
    ]) ?>

</div>
