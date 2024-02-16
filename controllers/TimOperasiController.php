<?php

namespace app\controllers;

use app\components\Akun;
use app\components\HelperGeneral;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\components\Model;
use app\models\bedahsentral\JabatanOperasi;
use app\models\bedahsentral\Log;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;
use app\models\pendaftaran\Layanan;
use app\models\search\LayananOperasiSearch;
use app\models\search\TimOperasiSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * TimOperasiController implements the CRUD actions for TimOperasi model.
 */
class TimOperasiController extends Controller
{
  /**
   * @inheritDoc
   */
  public function behaviors()
  {
    return array_merge(
      parent::behaviors(),
      [
        'verbs' => [
          'class' => VerbFilter::className(),
          'actions' => [
            'delete' => ['POST'],
          ],
        ],
      ]
    );
  }

  public function actionIndex($id)
  {
    $model = $this->initModelUpdateAuto(HelperGeneral::convertLayananId($id));

    if ($model) {
      return $this->redirect(Url::to(['/tim-operasi/update/', 'id' => $id, 'subid' => $model->to_id]));
    } else {
      return $this->redirect(Url::to(['/tim-operasi/create/', 'id' => $id]));
    }
    // $searchModel = new TimOperasiSearch();
    // $dataProvider = $searchModel->search($this->request->queryParams);

    // return $this->render('index', [
    //   'searchModel' => $searchModel,
    //   'dataProvider' => $dataProvider,
    // ]);
  }

  public function actionCreateOperasiRuangan($id)
  {
    $plid = HelperGeneral::convertLayananId($id);

    // CEK PASIEN SUDAH DI DAFTARKAN APA BELUM
    $chk_tim_operasi = TimOperasi::findOne(['to_ok_pl_id' => $plid, 'to_deleted_at' => null]);
    if ($chk_tim_operasi) {
      Yii::$app->session->setFlash('error', "Pasien sudah pernah didaftarkan, tidak bisa mendaftarkan pasien 2 kali.");
      return $this->redirect(Url::to(['/layanan-operasi/ruangan-lainnya/']));
    }

    $chk_pasien = HelperSpesial::getCheckPasien($plid);
    if (!$chk_pasien->status) {
      return $this->redirect(Url::to(['/site/index/']));
    }


    $icu = $chk_pasien->data['unit_kode'] != LayananOperasiSearch::RUANG_ICU;
    $picu = $chk_pasien->data['unit_kode'] != LayananOperasiSearch::RUANG_PICU;
    $ricu = $chk_pasien->data['unit_kode'] != LayananOperasiSearch::RUANG_RICU;
    // jika pasien bukan dari ruang icu, picu, ricu redirect ke create KAMAR OK
    if ($icu && $picu && $ricu) {
      return $this->redirect(Url::to(['/tim-operasi/create-ok/', 'id' => $plid]));
    }

    $data = $this->getRiwayatOperasi($chk_pasien->data['registrasi_kode']);

    $model = $this->initModelCreate2($plid);
    $modelDetails = [new TimOperasiDetail()];

    $model->to_ok_unt_id = $chk_pasien->data['unit_kode'];

    $referensi = [
      'jabatan' => ArrayHelper::map(JabatanOperasi::getData(), 'jo_id', 'jo_jabatan'),
      'pegawai' => HelperSpesial::getListPegawai(1, false, true)
    ];

    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('_form_create_ruang_lainnya', [
        'model' => $model,
        'modelDetails' => $modelDetails,
        'chk_pasien' => $chk_pasien->data,
        'referensi' => $referensi,
        'data_riwayat' => $data
      ]);
    } else {
      return $this->render('_form_create_ruang_lainnya', [
        'model' => $model,
        'modelDetails' => $modelDetails,
        'chk_pasien' => $chk_pasien->data,
        'referensi' => $referensi,
        'data_riwayat' => $data
      ]);
    }
  }

  public function actionCreateOk($id)
  {
    $plid = HelperGeneral::convertLayananId($id);

    $chk_pasien = HelperSpesial::getCheckPasien($plid);
    if (!$chk_pasien->status) {
      return $this->redirect(Url::to(['/site/index/']));
    }

    $data = $this->getRiwayatOperasi($chk_pasien->data['registrasi_kode']);

    $model = $this->initModelCreateOk($plid);
    $modelDetails = [new TimOperasiDetail()];

    $referensi = [
      'jabatan' => ArrayHelper::map(JabatanOperasi::getData(), 'jo_id', 'jo_jabatan'),
      'pegawai' => HelperSpesial::getListPegawai(1, false, true)
    ];
    // echo'<pre/>';print_r($referensi);die();
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('_form_create_ok', [
        'model' => $model,
        'modelDetails' => $modelDetails,
        'chk_pasien' => $chk_pasien->data,
        'referensi' => $referensi,
        'data_riwayat' => $data
      ]);
    } else {
      return $this->render('_form_create_ok', [
        'model' => $model,
        'modelDetails' => $modelDetails,
        'chk_pasien' => $chk_pasien->data,
        'referensi' => $referensi,
        'data_riwayat' => $data
      ]);
    }
  }

  public function getRiwayatOperasi($id)
  {
    $query_data = "SELECT tp.to_tanggal_operasi AS tanggal, tp.to_tindakan_operasi AS tindakan, l.jenis_layanan, l.registrasi_kode AS reg_kode, u.nama AS unit
    FROM bedah_sentral.tim_operasi AS tp
    LEFT JOIN pendaftaran.layanan AS l ON tp.to_ruang_asal_pl_id = l.id
    LEFT JOIN pegawai.dm_unit_penempatan AS u ON l.unit_kode = u.kode
    WHERE l.registrasi_kode = :reg_kode AND l.deleted_at IS NULL AND tp.to_deleted_at IS NULL
    ORDER BY tp.to_created_at DESC;
    ";
    $data = Yii::$app->db->createCommand($query_data, [
      ':reg_kode' => $id,
    ])->queryAll();

    return $data;
  }

  public function actionCreate()
  {
    $model = $this->initModelCreate();
    $modelDetails = [new TimOperasiDetail()];

    $referensi = [
      'jabatan' => ArrayHelper::map(JabatanOperasi::getData(), 'jo_id', 'jo_jabatan'),
      'pegawai' => HelperSpesial::getListPegawai(1, false, true)
    ];
    // echo'<pre/>';print_r($referensi);die();
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('_form_create', [
        'model' => $model,
        'modelDetails' => $modelDetails,
        'referensi' => $referensi
      ]);
    } else {
      return $this->render('_form_create', [
        'model' => $model,
        'modelDetails' => $modelDetails,
        'referensi' => $referensi
      ]);
    }
  }

  protected function initModelCreate()
  {
    $model = new TimOperasi();

    $model->to_jenis_operasi_cito = 0;

    return $model;
  }
  // init model create untuk operasi ruang lainnya
  protected function initModelCreate2($id)
  {
    $model = new TimOperasi();

    $model->to_jenis_operasi_cito = 0;
    $model->to_ruang_asal_pl_id = $id;
    $model->to_ok_pl_id = $id;

    return $model;
  }
  // init model create untuk operasi OK
  protected function initModelCreateOk($id)
  {
    $model = new TimOperasi();

    $model->to_jenis_operasi_cito = 0;
    $model->to_ruang_asal_pl_id = $id;

    return $model;
  }

  protected function initModelUpdateAuto($layanan_id)
  {
    return TimOperasi::find()->with(['timOperasiDetail'])
      ->where(['to_ok_pl_id' => $layanan_id, 'to_deleted_at' => null])
      ->orderBy(['to_created_at' => SORT_DESC])->one();
  }

  protected function initModelUpdate($subid)
  {
    return TimOperasi::find()->with(['timOperasiDetail'])
      ->where(['to_id' => $subid, 'to_deleted_at' => null])
      ->orderBy(['to_created_at' => SORT_DESC])->one();
  }

  public function actionSaveInsert()
  {
    $title = 'Created Tim Operasi';
    //init model
    $model = new TimOperasi();
    // $model->scenario = "ok_create";
    //init model log
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode(['order' => $model->attr(), 'order_detail' => array()]);
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->to_ruang_asal_pl_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {

      $layananRuangan = Layanan::find()->where(['id' => $model->to_ruang_asal_pl_id])->asArray()->one();
      //save layanan ok
      $layananOk = new Layanan();
      $layananOk->registrasi_kode = $layananRuangan['registrasi_kode'];
      $layananOk->jenis_layanan = Layanan::OK;
      $layananOk->tgl_masuk = date('Y-m-d H:i:s');
      $layananOk->unit_kode = $model->to_ok_unt_id;
      $layananOk->unit_asal_kode = $layananRuangan['unit_kode'];
      $layananOk->save();
      $model->to_ok_pl_id = $layananOk->id;

      $modelDetail = [new TimOperasiDetail()];
      $modelDetail    = Model::createMultiple(TimOperasiDetail::className());
      Model::loadMultiple($modelDetail, Yii::$app->request->post());

      if ($model->validate() && Model::validateMultiple($modelDetail)) {
        $save = $this->save($title, $modelLog, $model, $modelDetail);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => $save->data['to_ok_pl_id'], 'subid' => $save->data['to_id']]);
        } else {
          return MakeResponse::create(false, $save->msg);
        }
      } else {
        return MakeResponse::create(false, 'Data Gagal Disimpan (Save Insert)', $model->errors);
      }
    }
  }

  public function actionSaveInsert2()
  {
    $title = 'Created Tim Operasi';
    //init model
    $model = new TimOperasi();
    // $model->scenario = "ok_create_lainnya";
    //init model log
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode(['order' => $model->attr(), 'order_detail' => array()]);
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->to_ruang_asal_pl_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {

      $modelDetail = [new TimOperasiDetail()];
      $modelDetail    = Model::createMultiple(TimOperasiDetail::className());
      Model::loadMultiple($modelDetail, Yii::$app->request->post());

      if ($model->validate() && Model::validateMultiple($modelDetail)) {
        $save = $this->save($title, $modelLog, $model, $modelDetail);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => $save->data['to_ok_pl_id'], 'subid' => $save->data['to_id']]);
        } else {
          return MakeResponse::create(false, $save->msg);
        }
      } else {
        return MakeResponse::create(false, 'Data Gagal Disimpan (Save Insert)', $model->errors);
      }
    }
  }

  public function actionSaveUpdate($subid)
  {
    $title = 'Updated Tim Operasi';
    //cek simpan draf/final/batalkan
    //init model order penunjang
    $model = $this->findModel($subid);
    // $model->scenario = "ok_create_lainnya";
    $attrDetailBefore = array();
    // $id_order_detail_before=array();
    foreach ($model->timOperasiDetail as $v) {
      array_push($attrDetailBefore, $v->attr());
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode(['order' => $model->attr(), 'order_detail' => $attrDetailBefore]);
    // echo'<pre/>';print_r($modelLog->mlog_data_before);die();
    // echo'<pre/>';print_r($id_item_pemeriksaan_order_before);die();

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->to_ruang_asal_pl_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load($this->request->post())) {
      // edit juga unit kode di layanan
      $layananRuangan = Layanan::find()->where(['id' => $model->to_ok_pl_id])->one();
      $layananRuangan->unit_kode = $model->to_ok_unt_id;
      $layananRuangan->save();

      $modelDetail = $model->timOperasiDetail;
      $modelDetail = Model::createMultiple(TimOperasiDetail::className());
      Model::loadMultiple($modelDetail, Yii::$app->request->post());
      if ($model->validate() && Model::validateMultiple($modelDetail)) {
        $save = $this->save($title, $modelLog, $model, $modelDetail);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'konfirm_batal' => false, 'id' => $save->data['to_ok_pl_id']]);
        } else {
          return MakeResponse::create(false, $save->msg);
        }
      } else {
        return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
      }
    }
  }

  private function save($title, $modelLog, $model, $modelDetail, $final = false, $batal = false, $hapus = false)
  {
    // foreach($modelDetail as $modelDetail){
    //     echo'<pre/>';print_r($modelDetail);die();
    // }
    $transaction = TimOperasi::getDb()->beginTransaction();
    try {
      $s_flag = true;
      $m_flag = $title . ' Berhasil Disimpan';

      //save order
      if (!($s_flag = $model->save(false))) {
        $m_flag = $title . ' Gagal Disimpan..';
      }
      if (!$batal && !$hapus) {
        TimOperasiDetail::deleteAll(['tod_to_id' => $model->to_id]);
      }
      //save detail order
      $attrDetailAfter = array();
      if (!$batal && !$hapus) {
        if ($s_flag) {
          foreach ($modelDetail as $modelDetail) {
            $modelDetail->tod_to_id = $model->to_id;
            if (!($s_flag = $modelDetail->save(false))) {
              $m_flag = 'Detail ' . $title . ' Gagal Disimpan..';
              break;
            }
            array_push($attrDetailAfter, $modelDetail->attr());
          }
        }
      } else {
        $attrDetailAfter = $modelLog->mlog_data_before;
      }
      //save log
      if ($s_flag) {
        $modelLog->mlog_data_after = json_encode(['order' => $model->attr(), 'order_detail' => $attrDetailAfter]);
        if (!($s_flag = $modelLog->save(false))) {
          $m_flag = 'Log ' . $title . ' Gagal Disimpan..';
        }
      }
      //cek finalisasi save
      if ($s_flag) {
        $transaction->commit();
        return MakeResponse::createNotJson(true, $m_flag, ['to_ok_pl_id' => $model->to_ok_pl_id, 'to_id' => $model->to_id]);
      } else {
        $transaction->rollBack();
        return MakeResponse::createNotJson(false, $m_flag);
      }
    } catch (\Exception $e) {
      $transaction->rollBack();
      return MakeResponse::createNotJson(false, 'Data Gagal Disimpan Karna : ' . $e);
      throw $e;
    } catch (\Throwable $e) {
      $transaction->rollBack();
      return MakeResponse::createNotJson(false, 'Data Gagal Disimpan Karna : ' . $e);
      throw $e;
    }
  }

  public function actionHapus($subid)
  {
    $title = 'Deleted Layanan Operasi';
    //init model
    $model = TimOperasi::findOne(['to_id' => $subid]);
    $modelLayanan = Layanan::findOne(['id' => $model->to_ok_pl_id]);

    if (($model->to_created_by != Akun::user()->id) && (Akun::user()->username != Yii::$app->params['other']['username_root_bedah_sentral'])) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    // hapus layanan yang hanya jenis layanan 5
    if ($modelLayanan->jenis_layanan == 5) {
      $modelLayanan->setDelete();
      $modelLayanan->save(false);
    }

    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => $save->data['to_id']]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }

  public function actionUpdate($id, $subid)
  {
    $model = $this->initModelUpdate($subid);
    // echo '<pre>';
    // print_r($model->layanan);
    // die;
    if (!$model) {
      return $this->redirect(Url::to(['/site/index/']));
    }

    // Tampilkan dalam format tanggal
    $model->to_tanggal_operasi = date('Y-m-d', strtotime($model->to_tanggal_operasi));
    // $jam = date('H:i', strtotime($model->to_tanggal_operasi));
    // $model->to_tanggal_operasi = $tanggal . 'T' . $jam;

    $modelDetails = $model->timOperasiDetail;
    if (!$modelDetails) {
      $modelDetails = [new TimOperasiDetail()];
    }

    // $chk_pasien=HelperSpesial::getCheckPasien($model->po_pl_id);
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      // \Yii::$app->session->setFlash('warning', $chk_pasien->msg);
      return $this->redirect(Url::to(['/site/index/']));
    }

    $referensi = [
      'jabatan' => ArrayHelper::map(JabatanOperasi::getData(), 'jo_id', 'jo_jabatan'),
      'pegawai' => HelperSpesial::getListPegawai(1, false, true)
    ];
    // echo '<pre>';
    // print_r($referensi['pegawai']);
    // die;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'model' => $model,
        'modelDetails' => $modelDetails,
        'chk_pasien' => $chk_pasien->data,
        'referensi' => $referensi
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'model' => $model,
        'modelDetails' => $modelDetails,
        'chk_pasien' => $chk_pasien->data,
        'referensi' => $referensi
      ]);
    }
  }

  protected function findModel($to_id)
  {
    if (($model = TimOperasi::findOne(['to_id' => $to_id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

  public function actionView($to_id)
  {
    return $this->render('view', [
      'model' => $this->findModel($to_id),
    ]);
  }

  public function actionCariDataOperasi()
  {
    $id_layanan = $this->request->post('id_layanan');

    if (!empty($id_layanan)) {

      $query = "SELECT l.registrasi_kode
              FROM pendaftaran.layanan AS l
              WHERE l.id = :id_layanan";
      $get_regis_kode = Yii::$app->db->createCommand($query, [
        ':id_layanan' => $id_layanan
      ])->queryOne();

      $query_data = "SELECT tp.to_tanggal_operasi AS tanggal, tp.to_tindakan_operasi AS tindakan, l.jenis_layanan, l.registrasi_kode AS reg_kode, u.nama AS unit
                FROM bedah_sentral.tim_operasi AS tp
                LEFT JOIN pendaftaran.layanan AS l ON tp.to_ruang_asal_pl_id = l.id
                LEFT JOIN pegawai.dm_unit_penempatan AS u ON l.unit_kode = u.kode
                WHERE l.registrasi_kode = :reg_kode AND l.deleted_at IS NULL AND tp.to_deleted_at IS NULL
                ORDER BY tp.to_created_at DESC;
                ";
      $data = Yii::$app->db->createCommand($query_data, [
        ':reg_kode' => $get_regis_kode['registrasi_kode'],
      ])->queryAll();
    } else {
      $data = null;
    }

    if ($data) {
      $resp['status'] = true;
      $resp['data'] = $data;
    } else {
      $resp['status'] = false;
      $resp['data'] = 'Data tidak ditemukan!!';
    }
    echo json_encode($resp);
  }
}
