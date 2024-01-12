<?php

namespace app\controllers;

use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\models\bpjskes\AntrolJadwalOperasi;
use app\models\pendaftaran\PasienPenanggung;
use app\models\search\AntrolJadwalOperasiSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class AntrolJadwalOperasiController extends Controller
{
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

  public function actionIndex()
  {
    $searchModel = new AntrolJadwalOperasiSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionCariNobpjs()
  {
    $debitur_detail_kode = 1210;
    $rm = $this->request->post('rm');

    $query = PasienPenanggung::find()->where(['pasien_kode' => $rm, 'debitur_detail_kode' => $debitur_detail_kode])->orderBy(['created_at' => SORT_DESC])->one();

    if ($query) {
      $resp['status'] = true;
      $resp['data'] = $query->debitur_nomor;
    } else {
      $resp['status'] = false;
      $resp['data'] = 'Tidak ditemukan';
    }
    echo json_encode($resp);
  }

  public function actionCreate()
  {
    $model = $this->initModelCreate();

    $referensi = [
      'dokter' => HelperSpesial::getDokterOperator(1, false, true),
    ];
    // echo'<pre/>';print_r($referensi);die();
    if ($this->request->isAjax) {
      return $this->renderAjax('form_create', [
        'model' => $model,
        'referensi' => $referensi
      ]);
    } else {
      return $this->render('form_create', [
        'model' => $model,
        'referensi' => $referensi
      ]);
    }
  }

  protected function initModelCreate()
  {
    $model = new AntrolJadwalOperasi();

    $model->kode_booking =  uniqid();

    return $model;
  }

  public function actionUpdate($id)
  {
    $model = $this->initModelUpdate($id);

    if (!$model) {
      return $this->redirect(Url::to(['/antrol-jadwal-operasi/index/']));
    }

    $referensi = [
      'dokter' => HelperSpesial::getDokterOperator(1, false, true),
      // 'pasien' => HelperSpesial::getPasien(false, true)
    ];

    if ($this->request->isAjax) {
      return $this->renderAjax('form_update', [
        'model' => $model,
        'referensi' => $referensi
      ]);
    } else {
      return $this->render('form_update', [
        'model' => $model,
        'referensi' => $referensi
      ]);
    }
  }

  protected function initModelUpdate($id)
  {
    return AntrolJadwalOperasi::find()->where(['id' => $id, 'deleted_at' => null])->one();
  }

  public function actionView($id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  public function actionSimpan()
  {
    $data = $this->request->post();
    // echo '<pre>';
    // print_r($data);
    // die;
    if (isset($data['AntrolJadwalOperasi']['id'])) {
      $model = $this->findModel($data['AntrolJadwalOperasi']['id']);
    } else {
      $cek_sudah_ada = AntrolJadwalOperasi::findOne(['pasien_kode' => $data['AntrolJadwalOperasi']['pasien_kode'], 'tgl_operasi' => $data['AntrolJadwalOperasi']['tgl_operasi'], 'deleted_at' => null]);
      if ($cek_sudah_ada) {
        Yii::$app->session->setFlash('error', "Pasien sudah pernah didaftarkan ditanggal yang sama, tidak bisa mendaftarkan pasien 2 kali.");
        return $this->redirect(Url::to(['/antrol-jadwal-operasi/index/']));
      }
      $model = new AntrolJadwalOperasi();
    }

    if ($model->load($data) && $model->save(false)) {
      $resp['status'] = true;
      $resp['desc'] = 'Data Berhasil disimpan';
    } else {
      $resp['status'] = false;
      $resp['desc'] = 'Data Gagal disimpan';
    }
    echo json_encode($resp);
  }

  public function actionHapus($id)
  {
    $model = $this->findModel($id);

    if ($model) {
      $model->setDelete();
      $model->save();

      $resp['status'] = true;
      $resp['desc'] = "Berhasil menghapus data";
    } else {
      $resp['status'] = false;
      $resp['desc'] = "Gagal menghapus data";
    }

    echo json_encode($resp);
  }

  protected function findModel($id)
  {
    if (($model = AntrolJadwalOperasi::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
