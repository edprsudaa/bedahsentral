<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\PertanyaanCheckListKeselamatanOk;
use app\models\search\PertanyaanCheckListKeselamatanOkSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\HelperGeneral;
use app\components\Model;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\components\mdcp\MdcpBase;
use app\components\mdcp\MdcpPertanyaanCheckListKeselamatanOk;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\Log;
use app\models\sdm\Suku;
use app\models\sdm\Agama;
use app\models\pendaftaran\Layanan;

/**
 * PertanyaanCheckListKeselamatanOkController implements the CRUD actions for PertanyaanCheckListKeselamatanOk model.
 */
class CheckListKeselamatanOkPasienController extends Controller
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
    ];
  }

  /**
   * Lists all PertanyaanCheckListKeselamatanOk models.
   * @return mixed
   */
  public function actionIndex($id)
  {
    $plid = HelperGeneral::convertLayananId($id);

    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $plid])->one();
    $model = $this->initModelUpdateAuto($timoperasi->to_id);

    if ($model) {
      return $this->redirect(Url::to(['/check-list-keselamatan-ok-pasien/update/', 'id' => $id, 'subid' => $model->pcok_id]));
    } else {
      return $this->redirect(Url::to(['/check-list-keselamatan-ok-pasien/create/', 'id' => $timoperasi->to_ok_pl_id]));
    }
  }
  public function actionCreate($id)
  {
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      // \Yii::$app->session->setFlash('warning', $chk_pasien->msg);
      return $this->redirect(Url::to(['/site/index/']));
    }
    $model = $this->initModelCreate($id, $chk_pasien->data);
    $title = PertanyaanCheckListKeselamatanOk::ass_n;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data
      ]);
    }
  }
  //update & batalkan
  public function actionUpdate($id, $subid)
  {
    $model = $this->initModelUpdate($subid);
    if (!$model) {
      return $this->redirect(Url::to(['/site/index/']));
    }
    // $chk_pasien=HelperSpesial::getCheckPasien($model->po_pl_id);
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      // \Yii::$app->session->setFlash('warning', $chk_pasien->msg);
      return $this->redirect(Url::to(['/site/index/']));
    }
    $title = PertanyaanCheckListKeselamatanOk::ass_n;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data
      ]);
    }
  }
  private function save($title, $modelLog, $model, $modelDetail, $final = false, $batal = false, $hapus = false)
  {
    $transaction = PertanyaanCheckListKeselamatanOk::getDb()->beginTransaction();
    // echo "<pre/>";
    // print_r($model);
    // die;
    try {
      $s_flag = true;
      $m_flag = $title . ' Berhasil Disimpan';
      //save order
      if (!($s_flag = $model->save(false))) {
        $m_flag = $title . ' Gagal Disimpan..';
      }
      //save log
      if ($s_flag) {
        $modelLog->mlog_data_after = json_encode($model->attr());
        if (!($s_flag = $modelLog->save(false))) {
          $m_flag = 'Log ' . $title . ' Gagal Disimpan..';
        }
      }
      //save doc medis => karna save final
      // if ($final || $batal) {
      //   if ($s_flag) {
      //     $data = \Yii::$app->controller->renderPartial('doc', ['pcok_id' => $model->pcok_id]);
      //     $mdcp_base = MdcpBase::getLayanan($model->timoperasi->to_ok_pl_id);
      //     $mdcp = MdcpPertanyaanCheckListKeselamatanOk::_set($model->pcok_id, $mdcp_base, [], $data, $batal);
      //     if (!($s_flag = $mdcp->status)) {
      //       $m_flag = $mdcp->msg;
      //     }
      //   }
      // }
      //cek finalisasi save
      if ($s_flag) {
        $transaction->commit();
        return MakeResponse::createNotJson(true, $m_flag, ['pcok_to_id' => $model->timoperasi->to_ok_pl_id, 'pcok_id' => $model->pcok_id,]);
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
  public function actionSaveInsert()
  {
    $title = 'Created ' . PertanyaanCheckListKeselamatanOk::ass_n;
    //cek simpan draf/final
    //init model
    $model = new PertanyaanCheckListKeselamatanOk();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pcok_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      // echo "<pre/>";
      // print_r($model->pcok_final);
      // die;
      // $model->pcok_final = 0;
      if ($model->validate()) {
        if ($model->pcok_final) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => HelperGeneral::hashData($save->data['pcok_to_id']), 'subid' => $save->data['pcok_id']]);
        } else {
          return MakeResponse::create(false, $save->msg);
        }
      } else {
        return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
      }
    }
  }
  public function actionSaveInsertFinal()
  {
    $title = 'Finalized ' . PertanyaanCheckListKeselamatanOk::ass_n;
    //init model
    $model = new PertanyaanCheckListKeselamatanOk();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pcok_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['pcok_to_id']), 'subid' => $save->data['pcok_id']]);
        } else {
          return MakeResponse::create(false, $save->msg);
        }
      } else {
        return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
      }
    }
  }
  public function actionSaveUpdate($subid)
  {
    $title = 'Updated ' . PertanyaanCheckListKeselamatanOk::ass_n;
    //cek simpan draf/final/batalkan
    //init model order penunjang
    $model = $this->findModel($subid);
    // if($model->pcok_perawat_id!=Akun::user()->id){
    //     return MakeResponse::create(false, 'Data Tidak Dapat Kelola');
    // }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    // echo'<pre/>';print_r($modelLog->mlog_data_before);die();
    // echo'<pre/>';print_r($id_item_pemeriksaan_order_before);die();

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pcok_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      // $model->pcok_final = 0;
      if ($model->validate()) {
        if ($model->pcok_final && !$model->pcok_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->pcok_final && $model->pcok_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => false, 'konfirm_batal' => true]);
        } else {
          $save = $this->save($title, $modelLog, $model, []);
          if ($save->status) {
            return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'konfirm_batal' => false]);
          } else {
            return MakeResponse::create(false, $save->msg);
          }
        }
      } else {
        return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
      }
    }
  }
  public function actionSaveUpdateFinal($subid)
  {
    $title = 'Finalized ' . PertanyaanCheckListKeselamatanOk::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->pcok_final) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pcok_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg);
        } else {
          return MakeResponse::create(false, $save->msg);
        }
      } else {
        return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
      }
    }
  }
  public function actionSaveUpdateBatal($subid)
  {
    $title = 'Canceled ' . PertanyaanCheckListKeselamatanOk::ass_n;
    //init model
    $model = $this->findModel($subid);
    if (!$model->pcok_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pcok_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setBatal();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, true, false);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }
  public function actionSaveUpdateHapus($id, $subid)
  {
    $title = 'Deleted ' . PertanyaanCheckListKeselamatanOk::ass_n;
    //init model
    $model = $this->findModel($subid);
    // if($model->pcok_perawat_id!=Akun::user()->id){
    //     return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    // }
    if ($model->pcok_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pcok_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['pcok_to_id'])]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }
  protected function initModelCreate($id, $layanan = array())
  {
    $model = new PertanyaanCheckListKeselamatanOk();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['pl_id' => $id])->asArray()->one();
    }
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();
    $model->pcok_to_id = $timoperasi->to_id;
    $model->pcok_final = 0;
    $model->pcok_batal = 0;
    // $model->pcok_si_pertanyaan1 = 'Ya';
    // $model->pcok_si_pertanyaan2 = 'Ya';
    // $model->pcok_si_pertanyaan3 = 'Ya';
    // $model->pcok_si_pertanyaan4 = 'Ya';
    // $model->pcok_si_pertanyaan5 = 'Ya';
    // $model->pcok_si_pertanyaan6 = 'Ya';
    // $model->pcok_si_pertanyaan7 = 'Ya';
    // $model->pcok_to_pertanyaan1 = 'Ya';
    // $model->pcok_to_pertanyaan2 = 'Ya';
    // $model->pcok_to_pertanyaan3 = 'Ya';
    // $model->pcok_to_pertanyaan4 = 'Ya';
    // $model->pcok_to_pertanyaan6 = 'Ya';
    // $model->pcok_to_pertanyaan7 = 'Ya';
    // $model->pcok_to_pertanyaan8 = 'Ya';
    // $model->pcok_to_pertanyaan9 = 'Ya';
    // $model->pcok_to_pertanyaan10 = 'Ya';
    // $model->pcok_so_pertanyaan1 = 'Ya';
    // $model->pcok_so_pertanyaan2 = 'Ya';
    // $model->pcok_so_pertanyaan3 = 'Ya';
    // $model->pcok_so_pertanyaan4 = 'Ya';
    // $model->pcok_so_pertanyaan5 = 'Ya';

    return $model;
  }
  protected function initModelUpdateAuto($to_id)
  {
    $query = PertanyaanCheckListKeselamatanOk::find()
      ->where(['pcok_to_id' => $to_id])
      ->andWhere([
        'or',
        ['pcok_batal' => null],
        ['pcok_batal' => 0],
      ])
      ->andWhere('pcok_deleted_at is null')
      ->orderBy(['pcok_created_at' => SORT_DESC]);

    return $query->one();
  }
  protected function initModelUpdate($subid)
  {
    return PertanyaanCheckListKeselamatanOk::find()->where(['pcok_id' => $subid])->andWhere('pcok_deleted_at is null')->orderBy(['pcok_created_at' => SORT_DESC])->one();
  }
  protected function findModel($id)
  {
    if (($model = PertanyaanCheckListKeselamatanOk::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
