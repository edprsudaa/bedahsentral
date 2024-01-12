<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\components\HelperSpesial;

$this->title = 'Semua Aktifitas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="semua-aktifitas-index">
  <?php yii\widgets\Pjax::begin(['id' => 'pjgrid', 'timeout' => false]) ?>
  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => [
      'class' => 'table table-sm table-bordered table-hover'
    ],
    'layout' => "{items}\n{summary}\n{pager}",
    'columns' => [
      [
        'attribute' => 'mlog_created_by',
        'label' => 'Pegawai',
        'format' => 'raw',
        'headerOptions' => ['style' => 'text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => function ($model) {
          $data = HelperSpesial::getDataPegawaiById($model->pegawai->id_pegawai);
          return HelperSpesial::getNamaPegawai($data);
        },
        'filter' => Select2::widget([
          'model' => $searchModel,
          'theme' => Select2::THEME_KRAJEE,
          'attribute' => 'mlog_created_by',
          'data' => HelperSpesial::getListUser(0, false, true),
          'options' => ['placeholder' => 'PILIH PEGAWAI'],
          'pluginOptions' => [
            'allowClear' => true,
          ],
        ]),
      ],
      [
        'attribute' => 'mlog_deskripsi',
        'label' => 'Aksi',
        'headerOptions' => ['style' => 'text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;']
      ],
      [
        'attribute' => 'mlog_ip',
        'label' => 'IP',
        'headerOptions' => ['style' => 'text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;']
      ],

      [
        'attribute' => 'mlog_media',
        'label' => 'Media',
        'headerOptions' => ['style' => 'text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;']
      ],
      [
        'attribute' => 'mlog_created_at',
        'label' => 'Tanggal',
        'format' => 'html',
        'headerOptions' => ['style' => 'text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => function ($model) {
          return Yii::$app->formatter->asDate($model->mlog_created_at) . ' ' . Yii::$app->formatter->asTime($model->mlog_created_at);
        },
        'filter' => DatePicker::widget([
          'model' => $searchModel,
          'attribute' => 'mlog_created_at',
          'type' => DatePicker::TYPE_INPUT,
          'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
          ]
        ]),
      ],
    ],
    'pager' => [
      'class' => 'app\components\GridPager',
    ],
  ]); ?>
  <?php yii\widgets\Pjax::end() ?>
</div>