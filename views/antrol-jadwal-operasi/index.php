<?php

use app\components\Akun;
use app\models\bpjskes\AntrolJadwalOperasi;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\search\AntrolJadwalOperasiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Antrol Jadwal Operasi';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs($this->render('script.js'));
?>
<?php Pjax::begin(['id' => 'ref']); ?>
<style>
  .tombol {
    display: flex;
    justify-content: space-between;
  }

  .regis {
    margin: 0 auto;
  }
</style>
<div class="row">
  <div class="col-lg-12">
    <?php if (Yii::$app->session->hasFlash('error')) : ?>
      <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h3><i class="icon fa fa-times"></i>GAGAL!</h3>
        <h5><?= Yii::$app->session->getFlash('error') ?></h5>
      </div>
    <?php endif; ?>
    <p class="tombol">
      <!-- Button regis antrol -->
      <a href="<?= Url::to(['antrol-jadwal-operasi/create']) ?>" class="btn btn-info regis">
        <i class="fas fa-users text-white"></i><span> Registrasi Antrol Jadwal Operasi</span>
      </a>
      <!-- Button refresh  -->
      <button class="btn btn-success" id="refresh">
        <i class="fas fa-sync"></i> Refresh Data
      </button>
    </p>
    <div class="antrol-jadwal-operasi-index">

      <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
          'class' => 'table table-sm table-bordered table-hover'
        ],
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [
          [
            'class' => 'yii\grid\SerialColumn',
            'header' => 'No',
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center'],
          ],

          [
            'attribute' => 'kdbooking',
            'label' => 'KODE BOOKING',
            'format' => 'html',
            'contentOptions' => ['style' => 'text-align: center;width:160px'],
            'headerOptions' => ['style' => 'text-align: center;width:160px'],
            'value' => function ($model) {
              return $model->kode_booking ? $model->kode_booking : "KOSONG";
            },
            'filter' => Select2::widget([
              'model' => $searchModel,
              'theme' => Select2::THEME_KRAJEE,
              'attribute' => 'kdbooking',
              'data' => ArrayHelper::map(AntrolJadwalOperasi::getAntrolAll(), 'kode_booking', 'kode_booking'),
              'options' => ['placeholder' => 'Pilih ...'],
              'pluginOptions' => [
                'allowClear' => true,
              ],
            ]),
          ],

          [
            'attribute' => 'pasien',
            'label' => 'PASIEN',
            'format' => 'html',
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;'],
            'value' => function ($model) {
              return ($model->pasien ? $model->pasien->nama : 'Nama Pasien Kosong!');
            },
            'filterInputOptions' => [
              'class' => 'form-control',
              'autofocus' => true,
              'onFocus' => 'this.select()',
              'placeholder' => 'Ketik Nama ...'
            ],
          ],

          [
            'attribute' => 'kartubpjs',
            'label' => 'No. BPJS',
            'format' => 'html',
            'headerOptions' => ['style' => 'text-align: center;width:160px'],
            'contentOptions' => ['style' => 'text-align: center;width:160px'],
            'value' => function ($model) {
              return ($model->no_kartu_bpjs ? $model->no_kartu_bpjs : 'Tidak Ada!');
            },
            'filter' => Select2::widget([
              'model' => $searchModel,
              'theme' => Select2::THEME_KRAJEE,
              'attribute' => 'kartubpjs',
              'data' => ArrayHelper::map(AntrolJadwalOperasi::getAntrolAll(), 'no_kartu_bpjs', 'no_kartu_bpjs'),
              'options' => ['placeholder' => 'Pilih ...'],
              'pluginOptions' => [
                'allowClear' => true,
              ],
            ]),
          ],

          [
            'attribute' => 'norm',
            'label' => 'RM',
            'format' => 'html',
            'headerOptions' => ['style' => 'text-align: center;width:130px'],
            'contentOptions' => ['style' => 'text-align: center;width:130px'],
            'value' => function ($model) {
              return ($model->pasien ? $model->pasien->kode : 'No RM Kosong!');
            },
            'filter' => Select2::widget([
              'model' => $searchModel,
              'theme' => Select2::THEME_KRAJEE,
              'attribute' => 'norm',
              'data' => ArrayHelper::map(AntrolJadwalOperasi::getAntrolAll(), 'pasien_kode', 'pasien_kode'),
              'options' => ['placeholder' => 'Pilih ...'],
              'pluginOptions' => [
                'allowClear' => true,
              ],
            ]),
          ],

          [
            'attribute' => 'tgloperasi',
            'label' => 'TANGGAL OPERASI',
            'format' => 'html',
            'headerOptions' => ['style' => 'text-align: center;width:130px'],
            'contentOptions' => ['style' => 'text-align: center;width:130px'],
            'value' => function ($model) {
              return $model->tgl_operasi ? Yii::$app->formatter->asDate($model->tgl_operasi) : "KOSONG";
            },
            // 'filter' => true,
            'filter' => DatePicker::widget([
              'model' => $searchModel,
              'attribute' => 'tgloperasi',
              'type' => DatePicker::TYPE_INPUT,
              'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy'
              ],
              'options' => ['placeholder' => 'Tanggal']
            ]),
          ],

          [
            'attribute' => 'laksana',
            'label' => 'TERLAKSANA',
            'format' => 'html',
            'headerOptions' => ['style' => 'text-align: center;width:150px'],
            'contentOptions' => ['style' => 'text-align: center;width:150px;font-size:19px'],
            'value' => function ($model) {
              if ($model->terlaksana == 0) {
                return "<span class='badge badge-warning'>Belum</span>";
              } elseif ($model->terlaksana == 1) {
                return "<span class='badge badge-success'>Ya</span>";
              } else {
                return "<span class='badge badge-danger'>Batal</span>";
              }
            },
            'filter' => Html::activeDropDownList($searchModel, 'laksana', [
              'Belum',
              'Ya',
              'Batal'
            ], ['class' => 'form-control', 'prompt' => 'Lihat Semua']),
          ],

          [
            'attribute' => 'jenistindakan',
            'label' => 'JENIS TINDAKAN',
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;'],
            'value' => function ($model) {
              return $model->jenis_tindakan ? $model->jenis_tindakan : "KOSONG";
            },
            'filterInputOptions' => [
              'class' => 'form-control',
              'placeholder' => 'Jenis Tindakan ...'
            ],
          ],

          [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Aksi',
            'headerOptions' => ['style' => 'text-align:center'],
            'contentOptions' => ['style' => 'text-align:center'],
            'template' => '{edit}{delete}',
            'buttons' => [
              'edit' => function ($url, $model) {
                $url = Url::to(['/antrol-jadwal-operasi/update', 'id' => $model->id]);

                return '<a href="' . $url . '" data-url="' . $url . '" id="update" class="btn btn-warning btn-xs btn-edit m-1">
                <span class="fas fa-pencil-alt fa-xs text-white"></span>
                </a>';
              },
              'delete' => function ($url, $model) {
                if (($model->created_by == Akun::user()->id) || (Akun::user()->username == Yii::$app->params['other']['username_root_bedah_sentral'])) {
                  $url = Url::to(['/antrol-jadwal-operasi/hapus', 'id' => $model->id]);

                  return '<a href="#" class="btn btn-danger btn-xs m-1 delete" data-url="' . $url . '">
                <span class="fas fa-trash-alt fa-xs text-white"></span>
                </a>';
                }
              },
            ],
          ],
        ],
        'pager' => [
          'class' => 'app\components\GridPager',
        ],
      ]); ?>
    </div>
  </div>
</div>
<?php Pjax::end(); ?>