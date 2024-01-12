<?php

use app\models\bedahsentral\JabatanOperasi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\JabatanOperasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jabatan Operasi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jabatan-operasi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Jabatan Operasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'jo_id',
            'jo_jabatan:ntext',
            'jo_utama',
            // 'jo_created_at',
            // 'jo_created_by',
            //'jo_updated_at',
            //'jo_updated_by',
            //'jo_deleted_at',
            //'jo_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, JabatanOperasi $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'jo_id' => $model->jo_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
