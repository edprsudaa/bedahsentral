<?php

use app\models\bedahsentral\TimOperasiDetail;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TimOperasiDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tim Operasi Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tim-operasi-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tim Operasi Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tod_id',
            'tod_to_id',
            'tod_jo_id',
            'tod_pgw_id',
            'tod_created_at',
            //'tod_created_by',
            //'tod_updated_at',
            //'tod_updated_by',
            //'tod_deleted_at',
            //'tod_deleted_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TimOperasiDetail $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'tod_id' => $model->tod_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
