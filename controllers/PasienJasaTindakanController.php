<?php

namespace app\controllers;

use Yii;
use app\models\medis\TarifTindakan;
use app\models\medis\TarifTindakanPasien;
use app\models\search\TarifTindakanPasienSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\MakeResponse;
use app\models\pendaftaran\Layanan;
use app\models\medis\TarifTindakanUnit;
use yii\helpers\Url;
use app\components\HelperSpesial;
use app\components\HelperGeneralClass;
use yii\helpers\ArrayHelper;
use app\models\medis\Pjp;
use app\models\medis\PjpRi;

/**
 * PasienJasaTindakanController implements the CRUD actions for TarifTindakanPasien model.
 */
class PasienJasaTindakanController extends Controller
{
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          // 'delete' => ['POST'],
        ],
      ],
    ];
  }
  public function actionIndex($id)
  {
    $userLogin = HelperSpesial::getUserLogin();
    if (!$userLogin['akses']) {
      Yii::$app->session->setFlash('warning', $userLogin['pesannoakses']);
      return Yii::$app->response->redirect(Url::to(['/site/index/'], false));
    }
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    // echo "<pre>";print_r($chk_pasien);die;
    if (!$chk_pasien->status) {
      \Yii::$app->session->setFlash('warning', $chk_pasien->msg);
      return Yii::$app->response->redirect(Url::to(['/site/index/'], false));
    }

    $searchModel = new TarifTindakanPasienSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $chk_pasien->data, $userLogin);
    $this->layout = 'main-pasien';
    $model = $this->initModelCreate($id, $chk_pasien);
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data
      ]);
    } else {
      return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data
      ]);
    }
  }
  public function actionCreate($id)
  {
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    $model = $this->initModelCreate($id, $chk_pasien);
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('create', [
        'model' => $model,
        'layanan' => $chk_pasien->data
      ]);
    } else {
      return $this->render('create', [
        'model' => $model,
        'layanan' => $chk_pasien->data
      ]);
    }
  }
  public function actionUpdate($id, $subid)
  {
    $model = $this->findModel($subid);
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('update', [
        'model' => $model,
        'layanan' => $chk_pasien->data
      ]);
    } else {
      return $this->render('update', [
        'model' => $model,
        'layanan' => $chk_pasien->data
      ]);
    }
  }
  public function actionSave($id, $subid = null)
  {
    $model = new TarifTindakanPasien();
    if (!empty($subid)) {
      $model = $this->findModel($subid);
      $user = HelperSpesial::getUserLogin();
      if ($model->pelaksana_id != $user['pegawai_id'] && HelperSpesial::isDokter($user)) {
        return MakeResponse::create(true, 'Tindakan : ' . $model->tarifTindakan->tindakan->deskripsi . ' Tidak Dapat Anda Ubah!');
      }
      if ($model->pembayaran_id) {
        return MakeResponse::create(true, 'Tindakan : ' . $model->tarifTindakan->tindakan->deskripsi . ' Tidak Dapat Anda Hapus, karna sudah dibayar');
      }
    }

    if ($model->load(Yii::$app->request->post())) {
      $biaya = HelperSpesial::getHitungBiayaTindakan(TarifTindakan::find()->where(['id' => $model->tarif_tindakan_id])->asArray()->one(), false);

      $model->harga = intval($biaya['standar']); //harga standar
      
      if ($model->cyto == 1 && $biaya['cyto'] > $biaya['standar']) {
        $model->harga = intval($biaya['cyto']); //harga cyto
      }
      $model->subtotal = intval($model->jumlah) * intval($model->harga);
      if ($model->validate() && $model->save()) {
        return MakeResponse::create(true, 'Data Berhasil Disimpan');
      } else {
        return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
      }
    }
  }
  public function actionDelete($subid)
  {
    $model = $this->findModel($subid);
    // echo'<pre/>';print_r($model);die();
    $user = HelperSpesial::getUserLogin();
    if ($model->pelaksana_id != $user['pegawai_id'] && HelperSpesial::isDokter($user)) {
      return MakeResponse::create(true, 'Tindakan : ' . $model->tarifTindakan->tindakan->deskripsi . ' Tidak Dapat Anda Hapus!');
    }
    if ($model->pembayaran_id) {
      return MakeResponse::create(true, 'Tindakan : ' . $model->tarifTindakan->tindakan->deskripsi . ' Tidak Dapat Anda Hapus, karna sudah dibayar');
    }
    $model->setDelete($user['pegawai_id']);
    if ($model->save()) {
      return MakeResponse::create(true, 'Tindakan : ' . $model->tarifTindakan->tindakan->deskripsi . ' Berhasil Dihapus !');
    } else {
      return MakeResponse::create(false, 'Tindakan : ' . $model->tarifTindakan->tindakan->deskripsi . ' Gagal Dihapus !');
    }
  }
  protected function findModel($id)
  {
    if (($model = TarifTindakanPasien::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
  protected function initModelCreate($id = null, $chk_pasien = [], $user = [])
  {
    if (!$chk_pasien) {
      $chk_pasien = HelperSpesial::getCheckPasien($id);
      if (!$chk_pasien->status) {
        \Yii::$app->session->setFlash('warning', $chk_pasien->msg);
        return Yii::$app->response->redirect(Url::to(['/site/index/'], false));
      }
    }

    if (!$user) {
      $user = HelperSpesial::getUserLogin();
    }

    $model = new TarifTindakanPasien();
    if ($chk_pasien->data['jenis_layanan'] === Layanan::OK) {
      foreach ($chk_pasien->data['registrasi']['pjpRi'] as $val) {
        if ($val['pegawai_id'] == $user['pegawai_id'] && HelperSpesial::isDokter($user)) {
          $model->pelaksana_id = $val['pegawai_id'];
          break;
        } else if ($val['status'] == PjpRi::DPJP) {
          $model->pelaksana_id = $val['pegawai_id'];
          break;
        }
      }
    } else {
      // echo'<pre/>';print_r($chk_pasien->data['pjp']);die();
      foreach ($chk_pasien->data['pjp'] as $val) {
        if ($val['pegawai_id'] == $user['pegawai_id'] && HelperSpesial::isDokter($user)) {
          $model->pelaksana_id = $val['pegawai_id'];
          break;
        } else if ($val['status'] == Pjp::DPJP) {
          $model->pelaksana_id = $val['pegawai_id'];
          break;
        }
      }
    }
    $model->layanan_id = $chk_pasien->data['id'];
    $model->cyto = 0;
    $model->jumlah = 1;
    $model->jenis_tindakan = 3;
    return $model;
  }
}
