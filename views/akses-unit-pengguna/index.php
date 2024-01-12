<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use app\components\HelperSpesial;
use app\modules\rbac\components\Helper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\JadwalDokterKlinikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Akses Unit Pengguna';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .form-group.row {
    padding-bottom: 0px !important;
  }
</style>
<div class="page-form-<?= $model->formName() ?>">
  <?php
  if (Helper::checkRoute('create')) {
    if (\Yii::$app->request->isAjax) {
      echo $this->renderAjax('create', [
        'model' => $model,
      ]);
    } else {
      echo $this->render('create', [
        'model' => $model,
      ]);
    }
  }
  ?>
</div>
<div class="akses-unit-pengguna-index">
  <?php yii\widgets\Pjax::begin(['id' => 'pjgrid-' . $model->formName(), 'timeout' => false]) ?>
  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'tableOptions' => [
      'class' => 'table table-sm table-bordered table-hover'
    ],
    'rowOptions' => function ($model, $index, $widget, $grid) {
      if ($model->tanggal_nonaktif != null)
        return ['class' => 'table-warning'];
    },
    'layout' => "{items}\n{summary}\n{pager}",
    'columns' => [
      [
        'attribute' => 'pegawai',
        'label' => 'Pegawai',
        'format' => 'raw',
        'headerOptions' => ['style' => 'text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => function ($model) {
          // echo "<pre>";print_r($model->pegawai);die;
          if ($model->pegawai) {
            return HelperSpesial::getNamaPegawai($model->pegawai->pegawai);
          } {
            return "Nama Kosong !!!";
          }
        },
        'filter' => Select2::widget([
          'model' => $searchModel,
          'theme' => Select2::THEME_KRAJEE,
          'attribute' => 'pengguna_id',
          'data' => HelperSpesial::getListUser(1, false, true),
          'options' => ['placeholder' => 'PILIH PEGAWAI'],
          'pluginOptions' => [
            'allowClear' => true,
          ],
        ]),
      ],
      [
        'attribute' => 'unit',
        'label' => 'Unit',
        'format' => 'raw',
        'headerOptions' => ['style' => 'text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => 'unit.nama',
        'filter' => kartik\select2\Select2::widget([
          'model' => $searchModel,
          'theme' => Select2::THEME_KRAJEE,
          'attribute' => 'unit_id',
          'data' => HelperSpesial::getListUnitLayanan(null, false, true),
          'options' => ['placeholder' => 'PILIH UNIT'],
          'pluginOptions' => [
            'allowClear' => true,
          ],
        ]),
      ],
      [
        'attribute' => 'aplikasi',
        'label' => 'Aplikasi',
        'format' => 'raw',
        'headerOptions' => ['style' => 'text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => 'aplikasi.nma',
        'filter' => kartik\select2\Select2::widget([
          'model' => $searchModel,
          'theme' => Select2::THEME_KRAJEE,
          'attribute' => 'id_aplikasi',
          'data' => HelperSpesial::getListAplikasi(false, true),
          'options' => ['placeholder' => 'PILIH APLIKASI'],
          'pluginOptions' => [
            'allowClear' => true,
          ],
        ]),
      ],
      // [
      //   'attribute' => 'status',
      //   'label' => 'Status',
      //   'format' => 'raw',
      //   'headerOptions' => ['style' => 'text-align: center;'],
      //   'contentOptions' => ['style' => 'text-align: center;'],
      //   'value' => function ($model) {
      //     return (($model->aku_aktif == 1) ? '<span class="badge badge-success badge-pill">Aktif</span>' : '<span class="badge badge-warning badge-pill">Non-Aktif</span>');
      //   },
      //   'filter' => Select2::widget([
      //     'model' => $searchModel,
      //     'attribute' => 'status',
      //     'data' => ['0' => 'NON-AKTIF', '1' => 'AKTIF'],
      //     'options' => ['placeholder' => 'STATUS'],
      //     'pluginOptions' => [
      //       'allowClear' => true,
      //     ],
      //   ]),
      // ],
      [
        'class' => 'yii\grid\ActionColumn',
        'header' => 'PILIH',
        'headerOptions' => ['style' => 'text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center'],
        'template' => Helper::filterActionColumn('{view}{edit}{delete}'),
        'buttons' => [
          'view' => function ($url, $model) {
            return Html::a(Html::tag('span', '', ['class' => "fas fa-eye fa-xs text-white"]), null, [
              'class' => "btn btn-info btn-xs btn-view-" . $model->formName(), 'data-url' => Url::to(['view', 'id' => $model->id]), "data-toggle" => "tooltip", "data-placement" => "bottom", "title" => "", "data-original-title" => "Lihat"
            ]);
          },
          'edit' => function ($url, $model) {
            return Html::a(Html::tag('span', '', ['class' => "fas fa-edit fa-xs text-white"]), null, [
              'class' => "btn btn-warning btn-xs btn-edit-" . $model->formName(), 'data-url' => Url::to(['update', 'id' => $model->id]), 'data-key' => $model->unit->nama . 'pada pegawai : ' . ($model->pegawai ? HelperSpesial::getNamaPegawai($model->pegawai->pegawai) : 'Nama Kosong !!!'), "data-toggle" => "tooltip", "data-placement" => "bottom", "title" => "", "data-original-title" => "Ubah"
            ]);
          },
          'delete' => function ($url, $model) {
            return Html::a(Html::tag('span', '', ['class' => "fas fa-trash fa-xs text-white"]), null, [
              'class' => "btn btn-danger btn-xs  btn-delete-" . $model->formName(), 'data-url' => Url::to(['delete', 'id' => $model->id]), 'data-key' => $model->unit->nama . 'pada pegawai : ' . ($model->pegawai ? HelperSpesial::getNamaPegawai($model->pegawai->pegawai) : 'Nama Kosong !!!'), "data-toggle" => "tooltip", "data-placement" => "bottom", "title" => "", "data-original-title" => "Hapus"
            ]);
          },
        ]
      ],
    ],
    'pager' => [
      'class' => 'app\components\GridPager',
    ],
  ]); ?>
  <?php yii\widgets\Pjax::end() ?>
</div>
<?php
$this->registerJs("
// $(document).on('click','.btn-tambah-" . $model->formName() . "',function(e){
//     e.preventDefault;
//     e.stopImmediatePropagation();
//     var obj_url=$(this).data('url');
//     $.ajax({
//         url:obj_url,
//         type:'get',
//         success:function(data){
//             $('.page-form-" . $model->formName() . "').html(data);
//         }
//         ,error:function(){
//             fmsg.e('Maaf, Terjadi Kesalahan Pada Aplikasi');
//         }
//     });
// });
$(document).ready(function(){ 
    $(\"#pjgrid-" . $model->formName() . "\").on(\"pjax:end\", function() {
        $.pjax.reload({container:\"#pjform-" . $model->formName() . "\"});  //Reload Form
    });
});
$(document).on('click','.btn-view-" . $model->formName() . "',function(e){
    e.preventDefault;
    e.stopImmediatePropagation();
    var obj_url=$(this).data('url');
    $.ajax({
        url:obj_url,
        type:'get',
        success:function(data){
            $('.page-form-" . $model->formName() . "').html(data);
        }
        ,error:function(){
            fmsg.e('Maaf, Terjadi Kesalahan Pada Aplikasi');
        }
    });
});
$(document).on('click','.btn-edit-" . $model->formName() . "',function(e){
    e.preventDefault;
    e.stopImmediatePropagation();
    var obj_url=$(this).data('url');
    $.ajax({
        url:obj_url,
        type:'get',
        success:function(data){
            $('.page-form-" . $model->formName() . "').html(data);
        }
        ,error:function(){
            fmsg.e('Maaf, Terjadi Kesalahan Pada Aplikasi');
        }
    });
});
$(document).on('click','.btn-delete-" . $model->formName() . "',function(e){
    e.preventDefault;
    e.stopImmediatePropagation();
    var obj_url=$(this).data('url');
    var key=$(this).data('key');
    Swal.fire({
        title:\"Anda Yakin ?\",
        text:\"Yakin Hapus Data : \"+key,
        type:\"warning\",
        showCancelButton:!0,
        confirmButtonText:\"Ya!\",
        cancelButtonText:\"Tidak!\",
        confirmButtonClass:\"btn btn-success mt-2\",
        cancelButtonClass:\"btn btn-danger ml-2 mt-2\",
        buttonsStyling:!1,
        showLoaderOnConfirm: true,
    }).then(function(t){
        t.value?
            $.ajax({
                url:obj_url,
                type:'GET',
                success:function(data){
                    if(data.status){
                        fmsg.s(data.msg);
                        $.pjax.reload({container:\"#pjgrid-" . $model->formName() . "\"});
                    }else{
                        fmsg.w(data.msg);
                    }
                }
                ,error:function(){
                    fmsg.e('Maaf, Terjadi Kesalahan Pada Aplikasi');
                }
            })
        :t.dismiss===Swal.DismissReason.cancel    
        }
    );
});
");
