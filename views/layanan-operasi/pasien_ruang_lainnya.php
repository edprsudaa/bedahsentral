<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\components\HelperGeneral;
use app\components\Akun;
use app\components\HelperSpesial;
use app\models\bedahsentral\LaporanOperasi;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use app\models\pendaftaran\Layanan;
use yii\widgets\Pjax;

$this->title = 'Daftar Pasien Operasi';
$this->params['breadcrumbs'][] = $this->title;
Pjax::begin(['id' => 'pjform', 'timeout' => false]);
$this->registerJs($this->render('script.js'));
?>

<div class="row">
  <div class="col-lg-12">
    <?php if (Yii::$app->session->hasFlash('error')) : ?>
      <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h3><i class="icon fa fa-times"></i>GAGAL!</h3>
        <h5><?= Yii::$app->session->getFlash('error') ?></h5>
      </div>
    <?php endif; ?>
    <div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5 style="margin-bottom: 0;"><i class="icon fas fa-syringe"></i> Ruangan lainnya <b>(Tindakan diruangan)</b>, Khusus ruangan <b>ICU, PICU, RICU (Icu Infeksi)</b></h5>
    </div>
    <p style="text-align: right;">
      <!-- Button refresh  -->
      <button class="btn btn-success" id="refresh">
        <i class="fas fa-sync"></i> Refresh Data
      </button>
    </p>
    <div class="layanan-index">

      <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
          'class' => 'table table-sm table-bordered table-hover'
        ],
        // 'rowOptions' => function ($model, $index, $key) {
        //   $url = Url::to(['/site-pasien/index', 'id' => HelperGeneral::hashData($model->id)]);
        //   return ['id' => $model->id, 'onclick' => 'location.href="' . $url . '"', 'data-toggle' => "tooltip", 'data-placement' => "right", 'data-original-title' => "Klik Untuk Pilih Pasien", 'style' => "cursor:pointer;"];
        // },
        'layout' => "{items}\n{summary}\n{pager}",
        'columns' => [
          [
            'class' => 'yii\grid\SerialColumn',
            'header' => 'NO',
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center'],
          ],

          [
            'attribute' => 'pasien',
            'label' => 'PASIEN',
            'format' => 'html',
            'headerOptions' => ['style' => 'text-align: center;'],
            'value' => function ($model) {
              return ($model->layanan->registrasi ? ($model->layanan->registrasi->pasien ? $model->layanan->registrasi->pasien->nama : 'KOSONG') : 'registrasi kosong');
            },
            'filterInputOptions' => [
              'class' => 'form-control',
              'autofocus' => true,
              'onFocus' => 'this.select()',
              'placeholder' => 'Ketik Nama ...'
            ],
          ],

          [
            'attribute' => 'norm',
            'label' => 'RM',
            'format' => 'html',
            'headerOptions' => ['style' => 'text-align: center;width:100px'],
            'contentOptions' => ['style' => 'text-align: center;width:100px'],
            'value' => function ($model) {
              return ($model->layanan->registrasi ? ($model->layanan->registrasi->pasien ? $model->layanan->registrasi->pasien->kode : 'KOSONG') : 'registrasi kosong');
            },
            'filterInputOptions' => [
              'class' => 'form-control',
              // 'autofocus' => true,
              // 'onFocus' => 'this.select()',
              'placeholder' => 'Ketik RM ...'
            ],
          ],

          [
            'attribute' => 'tgl_operasi',
            'label' => 'TANGGAL OPERASI',
            'format' => 'html',
            'headerOptions' => ['style' => 'text-align: center;width:115px'],
            'contentOptions' => ['style' => 'text-align: center;width:115px'],
            'value' => function ($model) {
              // $tim = TimOperasi::find()->where(['to_ok_pl_id' => $model->id])->all();
              // foreach ($tim as $key => $value) {
              return $model->to_tanggal_operasi ? Yii::$app->formatter->asDate($model->to_tanggal_operasi) : "KOSONG";
              // }
              // return Yii::$app->formatter->asDate($model->pl_tgl_masuk) . '<br>' . Yii::$app->formatter->asTime($model->pl_tgl_masuk);
            },
            // 'filter' => true,
            'filter' => DatePicker::widget([
              'model' => $searchModel,
              'attribute' => 'tgl_operasi',
              'type' => DatePicker::TYPE_INPUT,
              'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-mm-yyyy'
              ],
              'options' => ['placeholder' => 'Tanggal']
            ]),
          ],

          [
            'attribute' => 'unit',
            'label' => 'RUANGAN',
            'filter' => false,
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;'],
            'format' => 'html',
            'value' => function ($model) {
              return $model->layanan->unit ? str_replace(["RUANG", "POLI"], [""], $model->layanan->unit->nama) : "KOSONG";
            },
            // 'filter' => false
            'filter' => Select2::widget([
              'model' => $searchModel,
              'attribute' => 'unit_awal',
              'data' => str_replace(["RUANG", "POLI"], [""], HelperSpesial::getListUnitRuanglainnya()),
              'theme' => Select2::THEME_KRAJEE,
              'options' => ['placeholder' => 'Pilih ...'],
              'pluginOptions' => [
                'allowClear' => true,
                'dropdownAutoWidth' => true,
                // 'width' => '190px',
              ],
            ]),
          ],

          [
            'attribute' => 'tindakan_operasi',
            'label' => 'TINDAKAN',
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;'],
            'value' => function ($model) {
              // $tim = TimOperasi::find()->where(['to_ok_pl_id' => $model->id])->all();
              // foreach ($tim as $key => $value) {
              return $model->to_tindakan_operasi ? $model->to_tindakan_operasi : "KOSONG";
              // }
            },
            'filterInputOptions' => [
              'class' => 'form-control',
              'placeholder' => 'Ketik Tindakan ...'
            ],
          ],

          [
            'attribute' => 'dibuat_oleh',
            'label' => 'Dibuat Oleh',
            'visible' => HelperSpesial::getUserLogin()['akses_level'] == "ROOT" ? true : false,
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;'],
            'value' => function ($model) {
              // $tim = TimOperasi::find()->where(['to_ok_pl_id' => $model->id])->all();
              // foreach ($tim as $key => $value) {
              // return HelperSpesial::getNamaPegawai($value->createdby->pegawai);
              return $model->createdby ? $model->createdby->username : "KOSONG";
              // }
            },
            // 'filterInputOptions' => [
            //   'class' => 'form-control',
            //   'placeholder' => 'Ketik Tindakan ...'
            // ],
          ],

          [
            'attribute' => 'status',
            'label' => 'STATUS',
            'format' => 'html',
            'visible' => HelperSpesial::getUserLogin()['akses_level'] == "DOKTER" ? false : true,
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;font-size:19px'],
            'value' => function ($model) {
              $id_pegawai = Akun::user()->id_pegawai;
              // foreach ($model as $key => $value) {
              $cek = TimOperasiDetail::find()->where(['tod_pgw_id' => $id_pegawai, 'tod_to_id' => $model->to_id])->one();
              return ($model->to_created_by == Akun::user()->id) || ($cek) ? '<span class="badge badge-success">Pasien Anda</span>' : '<span class="badge badge-danger">Kamu Belum Terdaftar</span>';
              // }
            },
            'filter' => Html::activeDropDownList($searchModel, 'status', [Akun::user()->id_pegawai => 'Pasien Anda'], ['class' => 'form-control', 'prompt' => 'Lihat Semua']),
          ],

          [
            'attribute' => 'laporan_operasi',
            'label' => 'LAPORAN OPERASI',
            'format' => 'html',
            'visible' => HelperSpesial::getUserLogin()['akses_level'] == "DOKTER" ? true : false,
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;font-size:19px'],
            'value' => function ($model) {
              // foreach ($model->timOperasi as $key => $value) {
              $cek = LaporanOperasi::find()->where(['lap_op_to_id' => $model->to_id, 'lap_op_final' => 1, 'lap_op_batal' => 0, 'lap_op_created_by' => Akun::user()->id])->one();
              return ($cek) ? '<span class="badge badge-success">SUDAH FINAL</span>' : '<span class="badge badge-danger">BELUM FINAL</span>';
              // }
            },
            // 'filter' => Html::activeDropDownList($searchModel, 'status', [Akun::user()->id_pegawai => 'Pasien Anda'], ['class' => 'form-control', 'prompt' => 'Lihat Semua']),
          ],

          [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'AKSI',
            'headerOptions' => ['style' => 'width:8%;text-align: center;color:#000;'],
            'contentOptions' => ['style' => 'text-align: center'],
            'template' => '{pilih}{delete}',
            'buttons' => [
              'delete' => function ($url, $model) {
                // foreach ($model as $key => $value) {
                if (($model->to_created_by == Akun::user()->id) || (Akun::user()->username == Yii::$app->params['other']['username_root_bedah_sentral'])) {
                  $url = Url::to(['/tim-operasi/hapus', 'subid' => $model->to_id]);

                  return '<a href="#" class="btn btn-danger btn-xs btn-delete m-1" data-url="' . $url . '" data-key="tes" data-layanan="pasien_ruang_lainnya" data-id="0" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hapus">
                    <span class="fas fa-trash fa-xs text-white"></span>
                  </a>';
                }
                // }
              },
              'pilih' => function ($url, $model) {
                $url = Url::to(['/site-pasien/index', 'id' => $model->layanan->id, 'tim_operasi_id' => $model->to_id]);

                return '<a id="pilih" href="#" data-url="' . $url . '" class="btn btn-primary btn-xs m-1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik Untuk Pilih Pasien" onclick="localStorage.setItem(\'layanan\', \'pasien_ruang_lainnya\')">
                  <span class="text-white">PILIH</span>
                </a>';
              }
            ]
          ],
        ],
        // 'summaryOptions' => ['class' => 'summary mt-2 mb-2'],
        'pager' => [
          'class' => 'app\components\GridPager',
        ],
      ]); ?>

    </div>
  </div> <!-- end col -->
</div>
<?php Pjax::end(); ?>