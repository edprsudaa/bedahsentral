<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\PostAnestesi;
use app\models\search\PostAnestesi as PostAnestesiSearch;
use yii\web\Controller;
use app\models\bedahsentral\TtvPostAnestesi;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\HelperGeneral;
use app\components\Model;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\components\mdcp\MdcpBase;
use app\components\mdcp\MdcpPostAnestesi;
use app\models\bedahsentral\Log;
use app\models\sdm\Suku;
use app\models\sdm\Agama;
use app\models\pendaftaran\Layanan;
use app\components\Akun;
use app\models\bedahsentral\TimOperasi;
use app\models\TimOperasiDetail;

/**
 * PostAnestesiController implements the CRUD actions for PostAnestesi model.
 */
class PostAnestesiPasienController extends Controller
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
   * Lists all PostAnestesi models.
   * @return mixed
   */
  public function actionIndex($id)
  {
    $plid = HelperGeneral::convertLayananId($id);

    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $plid])->one();
    $model = $this->initModelUpdateAuto($timoperasi->to_id);

    if ($model) {
      return $this->redirect(Url::to(['/post-anestesi-pasien/update/', 'id' => $id, 'subid' => $model->mpa_id]));
    } else {
      return $this->redirect(Url::to(['/post-anestesi-pasien/create/', 'id' => $timoperasi->to_ok_pl_id]));
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
    $title = PostAnestesi::ass_n;
    $modelttvp = new TtvPostAnestesi();
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
        'modelttvp' => $modelttvp
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
        'modelttvp' => $modelttvp
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
    $modelttvp = new TtvPostAnestesi();
    $title = PostAnestesi::ass_n;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
        'modelttvp' => $modelttvp
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
        'modelttvp' => $modelttvp
      ]);
    }
  }
  private function save($title, $modelLog, $model, $modelDetail, $final = false, $batal = false, $hapus = false)
  {
    $transaction = PostAnestesi::getDb()->beginTransaction();
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
      //     $data = \Yii::$app->controller->renderPartial('doc', ['mpa_id' => $model->mpa_id]);
      //     $mdcp_base = MdcpBase::getLayanan($model->timoperasi->to_ok_pl_id);
      //     $mdcp = MdcpPostAnestesi::_set($model->mpa_id, $mdcp_base, [], $data, $batal);
      //     if (!($s_flag = $mdcp->status)) {
      //       $m_flag = $mdcp->msg;
      //     }
      //   }
      // }
      //cek finalisasi save
      if ($s_flag) {
        $transaction->commit();
        return MakeResponse::createNotJson(true, $m_flag, ['mpa_to_id' => $model->timoperasi->to_ok_pl_id, 'mpa_id' => $model->mpa_id]);
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
    $title = 'Created ' . PostAnestesi::ass_n;
    //cek simpan draf/final
    //init model
    $model = new PostAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mpa_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      // $model->mpa_final = 0;
      if ($model->validate()) {
        if ($model->mpa_final) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => HelperGeneral::hashData($save->data['mpa_to_id']), 'subid' => $save->data['mpa_id']]);
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
    $title = 'Finalized ' . PostAnestesi::ass_n;
    //init model
    $model = new PostAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mpa_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['mpa_to_id']), 'subid' => $save->data['mpa_id']]);
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
    $title = 'Updated ' . PostAnestesi::ass_n;
    //cek simpan draf/final/batalkan
    //init model order penunjang
    $model = $this->findModel($subid);
    // if($model->mpa_perawat_id!=Akun::user()->id){
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
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mpa_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      // echo'<pre/>';print_r($model);die();
      // $model->mpa_final = 0;
      if ($model->validate()) {
        if ($model->mpa_final && !$model->mpa_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->mpa_final && $model->mpa_batal) {
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
    $title = 'Finalized ' . PostAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->mpa_final) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mpa_to_id);
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
    $title = 'Canceled ' . PostAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if (!$model->mpa_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mpa_to_id);
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
    $title = 'Deleted ' . PostAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    // if($model->mpa_perawat_id!=Akun::user()->id){
    //     return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    // }
    if ($model->mpa_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mpa_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['mpa_to_id'])]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }
  protected function initModelCreate($id, $layanan = array())
  {
    $model = new PostAnestesi();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['id' => $id])->asArray()->one();
    }
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();
    $model->mpa_to_id = $timoperasi->to_id;
    $model->mpa_final = 0;
    $model->mpa_batal = 0;

    // $model->mpa_instruksi_awasi = 'Ku';
    // $model->mpa_instruksi_posisi = 'Telentang';
    // //set anemnesa
    return $model;
  }
  protected function initModelUpdateAuto($to_id)
  {
    return PostAnestesi::find()->where(['mpa_to_id' => $to_id])->andWhere('mpa_deleted_at is null')->orderBy(['mpa_created_at' => SORT_DESC])->one();
  }
  protected function initModelUpdate($subid)
  {
    return PostAnestesi::find()->where(['mpa_id' => $subid])->andWhere('mpa_deleted_at is null')->orderBy(['mpa_created_at' => SORT_DESC])->one();
  }

  /**
   * Finds the PostAnestesi model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return PostAnestesi the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = PostAnestesi::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

  public function actionGetdata($id)
  {

    $model = TtvPostAnestesi::find()->where(['ttvp_post_anestesi_mpa_id' => $id])->all();
    $temp = [];
    foreach ($model as $val) {
      $temp[] = [
        'waktu' => $val->ttvp_waktu,
        'nadi' => $val->ttvp_nadi,
        'sistole' => $val->ttvp_tek_darah_sistole,
        'diastole' => $val->ttvp_tek_darah_diastole,
        'metode' => $val->ttvp_nyeri_metode,
        'skor' => $val->ttvp_nyeri_skor
      ];
    }
    return json_encode($temp);
  }
}
