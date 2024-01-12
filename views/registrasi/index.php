<?php

use app\models\pendaftaran\Registrasi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\pendaftaran\RegistrasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registrasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registrasi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Registrasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode',
            'pasien_kode',
            'tgl_masuk',
            'tgl_keluar',
            'kiriman_detail_kode',
            //'debitur_detail_kode',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',
            //'deleted_at',
            //'no_sep',
            //'deleted_by',
            //'is_print',
            //'lambar',
            //'old_kiriman_detail_kode',
            //'old_debitur_detail_kode',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Registrasi $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'kode' => $model->kode]);
                 }
            ],
        ],
        'pager' => [
            'class' => 'app\components\GridPager',
        ],
    ]); ?>


</div>
