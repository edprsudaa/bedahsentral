<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\components\HelperGeneralClass;
use app\components\HelperSpesial;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\JadwalDokterKlinikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'JASA TINDAKAN';
$this->params['breadcrumbs'][] = $this->title;
echo $this->render('../layouts/card-pasien.php', ['layanan' => $chk_pasien]);
?>
<div class="page-form-<?= $model->formName() ?>">
  <?php
  if (\Yii::$app->request->isAjax) {
    echo $this->renderAjax('create', [
      'model' => $model,
      'layanan' => $chk_pasien
    ]);
  } else {
    echo $this->render('create', [
      'model' => $model,
      'layanan' => $chk_pasien
    ]);
  }
  ?>
</div>
<div class="jadwal-dokter-klinik-index">
  <?php yii\widgets\Pjax::begin(['id' => 'pjgrid-' . $model->formName()]) ?>
  <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => "{items}\n{summary}\n{pager}",
    'columns' => [
      [
        'attribute' => 'tarif_tindakan_id',
        'label' => 'Tindakan',
        'format' => 'raw',
        'headerOptions' => ['style' => 'width: 20%;text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => function ($model) {
          return $model->tarifTindakan->tindakan->deskripsi . ' [ KODE:' . $model->tarifTindakan->tindakan->id . ' ]';
        },
        'filter' => false
      ],
      [
        'attribute' => 'tanggal',
        'label' => 'Tanggal',
        'format' => 'html',
        'headerOptions' => ['style' => 'width: 15%;text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => function ($model) {
          return Yii::$app->formatter->asDate($model->tanggal) . ' ' . Yii::$app->formatter->asTime($model->tanggal);
        },
        'filter' => false
      ],
      [
        'attribute' => 'cyto',
        'label' => 'Cyto',
        'format' => 'raw',
        'headerOptions' => ['style' => 'width: 5%;text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => function ($model) {
          return (($model->cyto == 1) ? '<span class="badge badge-danger badge-pill">Ya</span>' : '<span class="badge badge-success badge-pill">Tidak</span>');
        },
        'filter' => false
      ],
      [
        'attribute' => 'tarif_tindakan_id',
        'label' => 'Biaya',
        'format' => 'raw',
        'headerOptions' => ['style' => 'width: 10%;text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => function ($model) {
          // return (($model->cyto==1)?HelperSpesial::getHitungBiayaTindakan($model->tarifTindakan)['cyto']:HelperSpesial::getHitungBiayaTindakan($model->tarifTindakan)['standar']);
          return $model->jumlah . ' @ Rp.' . $model->harga . ' = Rp.' . number_format($model->subtotal);
        },
        'filter' => false
      ],
      [
        'attribute' => 'layanan_id',
        'label' => 'Unit',
        'format' => 'raw',
        'headerOptions' => ['style' => 'width: 8%;text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => function ($model) {
          return $model->layanan->unit->nama;
        },
        'filter' => false
      ],
      [
        'attribute' => 'pelaksana_id',
        'label' => 'Dokter/Perawat',
        'format' => 'raw',
        'headerOptions' => ['style' => 'width: 7%;text-align: center;'],
        'contentOptions' => ['style' => 'text-align: center;'],
        'value' => function ($model) {
          return (($model->pelaksana) ? HelperSpesial::getNamaPegawai($model->pelaksana) : '-');
        },
        'filter' => false
      ],
      [
        'class' => 'yii\grid\ActionColumn',
        'header' => 'AKSI',
        'headerOptions' => ['style' => 'width: 15%;text-align: center;color:#6658dd;'],
        'contentOptions' => ['style' => 'text-align: center'],
        'template' => '{edit}{delete}',
        'buttons' => [
          // 'view' => function ($url, $model) {
          //     return Html::a(Html::tag('span', '', ['class' => "mdi mdi-monitor-screenshot"]), null, [
          //         'class' => "btn btn-info btn-xs btn-view-".$model->formName(),'data-url'=>Url::to(['view','subid'=>$model->id]),"data-toggle"=>"tooltip","data-placement"=>"bottom","title"=>"","data-original-title"=>"Lihat"
          //     ]);
          // },
          'edit' => function ($url, $model) use ($chk_pasien) {
            return Html::a(Html::tag('span', '', ['class' => "fas fa-pen text-white"]), null, [
              'class' => "btn m-1 btn-warning btn-edit-" . $model->formName(), 'data-url' => Url::to(['update', 'id' => $chk_pasien['id'], 'subid' => $model->id]), 'data-key' => $model->tarifTindakan->tindakan->deskripsi . ' [KODE:' . $model->tarifTindakan->tindakan->id . '], Tanggal :' . Yii::$app->formatter->asDate($model->tanggal) . ' ' . Yii::$app->formatter->asTime($model->tanggal), "data-toggle" => "tooltip", "data-placement" => "bottom", "title" => "", "data-original-title" => "Ubah"
            ]);
          },
          'delete' => function ($url, $model) use ($chk_pasien) {
            return Html::a(Html::tag('span', '', ['class' => "fas fa-trash text-white"]), null, [
              'class' => "btn m-1 btn-danger btn-delete-" . $model->formName(), 'data-url' => Url::to(['delete', 'subid' => $model->id]), 'data-key' => $model->tarifTindakan->tindakan->deskripsi . ' [KODE:' . $model->tarifTindakan->tindakan->id . '], Tanggal :' . Yii::$app->formatter->asDate($model->tanggal) . ' ' . Yii::$app->formatter->asTime($model->tanggal), "data-toggle" => "tooltip", "data-placement" => "bottom", "title" => "", "data-original-title" => "Hapus"
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
$(document).ready(function(){ 
    $(\"#pjgrid-" . $model->formName() . "\").on(\"pjax:end\", function() {
        $.pjax.reload({container:\"#pjform-" . $model->formName() . "\"});  //Reload Form
    });
});
// $(document).on('click','.btn-view-" . $model->formName() . "',function(e){
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
