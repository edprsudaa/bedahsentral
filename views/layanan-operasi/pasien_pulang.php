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
              return ($model->registrasi ? ($model->registrasi->pasien ? $model->registrasi->pasien->nama : 'belum diisi') : 'registrasi kosong');
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
              return ($model->registrasi ? ($model->registrasi->pasien ? $model->registrasi->pasien->kode : 'KOSONG') : 'registrasi kosong');
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
              return $model->timOperasi ?  Yii::$app->formatter->asDate($model->timOperasi[0]->to_tanggal_operasi) : "Belum Diisi !!";

              // foreach ($model->timOperasi as $key => $value) {
              //   return $value->to_tanggal_operasi ? Yii::$app->formatter->asDate($value->to_tanggal_operasi) : "KOSONG";
              // }
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
            'attribute' => 'unit_awal',
            'label' => 'RUANGAN',
            'filter' => false,
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;'],
            'format' => 'html',
            'value' => function ($model) {
              return ($model->unitAsal ? str_replace(["RUANG", "POLI"], [""], $model->unitAsal->nama) : "Unit Kosong");
            },
            'filter' => Select2::widget([
              'model' => $searchModel,
              'attribute' => 'unit_awal',
              'data' => str_replace(["RUANG", "POLI"], [""], HelperSpesial::getListUnitLayanan(null, false, true)),
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
            'attribute' => 'unit_tujuan',
            'label' => 'KAMAR OPERASI',
            'headerOptions' => ['style' => 'text-align: center;width:150px'],
            'contentOptions' => ['style' => 'text-align: center;width:150px'],
            'format' => 'html',
            'value' => function ($model) {
              return $model->unit ? str_replace("KAMAR OPERASI", "", $model->unit->nama) : "Unit Kosong !!";

              // foreach ($model->timOperasi as $key => $timoperasi) {
              //   return ($timoperasi->unit ? str_replace("KAMAR OPERASI", "", $timoperasi->unit->nama) : "KOSONG");
              // }
            },
            'filter' => Select2::widget([
              'model' => $searchModel,
              'attribute' => 'unit_tujuan',
              'data' => str_replace("KAMAR OPERASI", "", HelperSpesial::getListUnitOK(false, true)),
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
              return $model->timOperasi ? $model->timOperasi[0]->to_tindakan_operasi : "Belum Diisi !!";

              // foreach ($model->timOperasi as $key => $value) {
              //   return $value->to_tindakan_operasi ? $value->to_tindakan_operasi : "KOSONG";
              // }
            },
            'filterInputOptions' => [
              'class' => 'form-control',
              'placeholder' => 'Ketik Tindakan ...'
            ],
          ],

          [
            'attribute' => 'to_created_by',
            'label' => 'Dibuat Oleh',
            'visible' => HelperSpesial::getUserLogin()['akses_level'] == "ROOT" ? true : false,
            'headerOptions' => ['style' => 'text-align: center;'],
            'contentOptions' => ['style' => 'text-align: center;'],
            'value' => function ($model) {
              return $model->timOperasi ? $model->timOperasi[0]->createdby->username : "Tidak Ditemukan !!";

              // foreach ($model->timOperasi as $key => $value) {
              //   return $value->createdby ? $value->createdby->username : "KOSONG";
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
              $to_created = $model->timOperasi ? $model->timOperasi[0]->to_created_by : '';
              $to_id = $model->timOperasi ? $model->timOperasi[0]->to_id : '';

              $id_pegawai = Akun::user()->id_pegawai;
              // foreach ($model->timOperasi as $key => $value) {
              $cek = TimOperasiDetail::find()->where(['tod_pgw_id' => $id_pegawai, 'tod_to_id' => $to_id])->one();
              return ($to_created == Akun::user()->id) || ($cek) ? '<span class="badge badge-success">Pasien Anda</span>' : '<span class="badge badge-danger">Kamu Belum Terdaftar</span>';
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
              $to_id = $model->timOperasi ? $model->timOperasi[0]->to_id : '';

              // foreach ($model->timOperasi as $key => $value) {
              $cek = LaporanOperasi::find()->where(['lap_op_to_id' => $to_id, 'lap_op_final' => 1, 'lap_op_created_by' => Akun::user()->id])->one();
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
                $to_created = $model->timOperasi ? $model->timOperasi[0]->to_created_by : '';
                $to_id = $model->timOperasi ? $model->timOperasi[0]->to_id : '';
                // foreach ($model->timOperasi as $key => $value) {
                if (($to_created == Akun::user()->id) || (Akun::user()->username == Yii::$app->params['other']['username_root_bedah_sentral'])) {
                  $url = Url::to(['/tim-operasi/hapus', 'subid' => $to_id]);

                  return '<a href="#" class="btn btn-danger btn-xs btn-delete m-1" data-url="' . $url . '" data-key="tes" data-layanan="pasien_pulang" data-id="0" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Hapus">
                      <span class="fas fa-trash fa-xs text-white"></span>
                    </a>';
                }
                // }
              },
              'pilih' => function ($url, $model) {
                $to_id = $model->timOperasi ? $model->timOperasi[0]->to_id : '';
                // foreach ($model->timOperasi as $key => $value) {
                $url = Url::to(['/site-pasien/index', 'id' => $model->id, 'tim_operasi_id' => $to_id]);

                return '<a href="#" id="pilih" data-url="' . $url . '" class="btn btn-primary btn-xs m-1" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik Untuk Pilih Pasien" onclick="localStorage.setItem(\'layanan\', \'pasien_pulang\')">
                    <span class="text-white">PILIH</span>
                  </a>';
                // }
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