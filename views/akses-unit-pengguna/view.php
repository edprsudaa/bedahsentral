<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\HelperSpesial;
use app\modules\rbac\components\Helper;

// echo'<pre/>';print_r(\Yii::$app->request->get('id'));die();
?>
<div class="jadwal-dokter-klinik-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Unit',
                'value' => $model->unit->nama,
            ],
            [
                'label' => 'Pegawai',
                'value' => function ($model){
                    return HelperSpesial::getNamaPegawaiArray($model->pegawai->pegawai);
                }
            ],
            [
                'label' => 'Status',
                'format' => 'raw',
                'value' => function ($model){
                    return (($model->tanggal_nonaktif==null)?'<span class="badge badge-success badge-pill">Aktif</span>':'<span class="badge badge-warning badge-pill">Non-Aktif</span>');
                }
            ],
            [
                'label' => 'Dibuat Pada',
                'value' => $model->created_at,
            ],
            [
                'label' => 'Dibuat Oleh',
                'value' => function ($model){
                    return HelperSpesial::getNamaPegawai(HelperSpesial::getDataPegawaiByUserid($model->created_by)->pegawai);
                }
            ],
            [
                'label' => 'Diubah Pada',
                'value' => $model->updated_at,
            ],
            [
                'label' => 'Diubah Oleh',
                'value' => function ($model){
                    if($model->updated_by){
                        return HelperSpesial::getNamaPegawai(HelperSpesial::getDataPegawaiById($model->updated_by));
                    }else{
                        return '-';
                    }
                }
            ]
        ],
    ]) ?>
    <p>
        <?php
        if(Helper::checkRoute('create')){
            echo Html::button('Kembali', ['class' => 'btn btn-primary btn-kembali-'.$model->formName(),'data-url'=>Url::to(['create'])]);
        }else{
            echo Html::a('Kembali',['akses-unit-pengguna/index'], ['class' => 'btn btn-primary']);
        }
        ?>
    </p>
</div>
<?php
$this->registerJs("
$(document).on('click','.btn-kembali-".$model->formName()."',function(e){
    e.preventDefault;
    e.stopImmediatePropagation();
    $.pjax.reload({container:\"#pjgrid-" . $model->formName()."\"});
    var obj_url=$(this).data('url');
    $.ajax({
        url:obj_url,
        type:'get',
        success:function(data){
            $('.page-form-".$model->formName()."').html(data);
        }
        ,error:function(){
            fmsg.e('Maaf, Terjadi Kesalahan Pada Aplikasi');
        }
    });
});
");