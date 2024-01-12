<?php

namespace app\controllers;

use app\components\HelperGeneral;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\models\bedahsentral\AskanPascaAnestesi;
use app\models\bedahsentral\IntraOperasiPerawat;
use app\models\bedahsentral\Log;
use app\models\bedahsentral\TimOperasi;
use app\models\pendaftaran\Layanan;
use app\models\search\AskanPascaAnestesiSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * AskanPascaAnestesiController implements the CRUD actions for AskanPascaAnestesi model.
 */
class AskanPascaAnestesiController extends Controller
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
    $plid = HelperGeneral::convertLayananId($id);

    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $plid])->one();
    $model = $this->initModelUpdateAuto($timoperasi->to_id);

    if ($model) {
      return $this->redirect(Url::to(['/askan-pasca-anestesi/update/', 'id' => $id, 'subid' => $model->pas_id]));
    } else {
      return $this->redirect(Url::to(['/askan-pasca-anestesi/create/', 'id' => $timoperasi->to_ok_pl_id]));
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
    // echo "<pre/>";
    // print_r($model);
    // die;
    $title = AskanPascaAnestesi::ass_n;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
      ]);
    }
  }

  public function actionUpdate($id, $subid)
  {
    $model = $this->initModelUpdate($subid);
    // echo "<pre>";print_r($model);die;
    if (!$model) {
      return $this->redirect(Url::to(['/site/index/']));
    }
    $model->pas_masalah_kesehatan = json_decode($model->pas_masalah_kesehatan);
    $model->pas_intervensi = json_decode($model->pas_intervensi);
    $model->pas_implementasi = json_decode($model->pas_implementasi);
    $model->pas_evaluasi = json_decode($model->pas_evaluasi);

    $model->pas_pernafasan = json_decode($model->pas_pernafasan);
    $model->pas_pola_nafas = json_decode($model->pas_pola_nafas);

    // $model->pas_tanggal_pukul = \Yii::$app->formatter->asDate($model->pas_tanggal_pukul) . ' ' . \Yii::$app->formatter->asTime($model->pas_tanggal_pukul);

    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      return $this->redirect(Url::to(['/site/index/']));
    }

    $title = AskanPascaAnestesi::ass_n;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
      ]);
    }
  }

  protected function initModelCreate($id, $layanan = array())
  {
    $model = new AskanPascaAnestesi();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['id' => $id])->asArray()->one();
    }
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();

    $model->pas_to_id = $timoperasi->to_id;
    $model->pas_final = 0;
    $model->pas_batal = 0;

    return $model;
  }

  protected function initModelUpdate($subid)
  {
    return AskanPascaAnestesi::find()->where(['pas_id' => $subid])->andWhere('pas_deleted_at is null')->orderBy(['pas_created_at' => SORT_DESC])->one();
  }

  protected function initModelUpdateAuto($to_id)
  {
    $query = AskanPascaAnestesi::find()
      ->where(['pas_to_id' => $to_id])
      ->andWhere(['!=', 'pas_batal', 1])
      ->andWhere('pas_deleted_at is null')
      ->orderBy(['pas_created_at' => SORT_DESC]);

    return $query->one();
  }

  private function save($title, $modelLog, $model, $modelDetail, $final = false, $batal = false, $hapus = false)
  {
    $transaction = AskanPascaAnestesi::getDb()->beginTransaction();
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
      //cek finalisasi save
      if ($s_flag) {
        $transaction->commit();
        return MakeResponse::createNotJson(true, $m_flag, ['pas_to_id' => $model->timoperasi->to_ok_pl_id, 'pas_id' => $model->pas_id]);
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
    $title = 'Created ' . AskanPascaAnestesi::ass_n;
    //cek simpan draf/final
    //init model
    $model = new AskanPascaAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pas_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->pas_masalah_kesehatan = json_encode($model->pas_masalah_kesehatan);
      $model->pas_intervensi = json_encode($model->pas_intervensi);
      $model->pas_implementasi = json_encode($model->pas_implementasi);
      $model->pas_evaluasi = json_encode($model->pas_evaluasi);

      $model->pas_pernafasan = json_encode($model->pas_pernafasan);
      $model->pas_pola_nafas = json_encode($model->pas_pola_nafas);

      if ($model->validate()) {
        if ($model->pas_final) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => HelperGeneral::hashData($save->data['pas_to_id']), 'subid' => $save->data['pas_id']]);
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

    $title = 'Finalized ' . AskanPascaAnestesi::ass_n;
    //init model
    $model = new AskanPascaAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pas_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->pas_masalah_kesehatan = json_encode($model->pas_masalah_kesehatan);
      $model->pas_intervensi = json_encode($model->pas_intervensi);
      $model->pas_implementasi = json_encode($model->pas_implementasi);
      $model->pas_evaluasi = json_encode($model->pas_evaluasi);

      $model->pas_pernafasan = json_encode($model->pas_pernafasan);
      $model->pas_pola_nafas = json_encode($model->pas_pola_nafas);

      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['pas_to_id']), 'subid' => $save->data['pas_id']]);
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
    $title = 'Updated ' . AskanPascaAnestesi::ass_n;
    $model = $this->findModel($subid);
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pas_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->pas_masalah_kesehatan = json_encode($model->pas_masalah_kesehatan);
      $model->pas_intervensi = json_encode($model->pas_intervensi);
      $model->pas_implementasi = json_encode($model->pas_implementasi);
      $model->pas_evaluasi = json_encode($model->pas_evaluasi);

      $model->pas_pernafasan = json_encode($model->pas_pernafasan);
      $model->pas_pola_nafas = json_encode($model->pas_pola_nafas);
      // echo'<pre>';print_r($model);die();

      if ($model->validate()) {
        if ($model->pas_final && !$model->pas_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->pas_final && $model->pas_batal) {
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

  public function actionSaveUpdateHapus($id, $subid)
  {
    $title = 'Deleted ' . AskanPascaAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    // if($model->pas_perawat_id!=Akun::user()->id){
    //     return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    // }
    if ($model->pas_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pas_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['pas_to_id'])]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }

  public function actionSaveUpdateFinal($subid)
  {
    $title = 'Finalized ' . AskanPascaAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->pas_final) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pas_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->pas_masalah_kesehatan = json_encode($model->pas_masalah_kesehatan);
      $model->pas_intervensi = json_encode($model->pas_intervensi);
      $model->pas_implementasi = json_encode($model->pas_implementasi);
      $model->pas_evaluasi = json_encode($model->pas_evaluasi);

      $model->pas_pernafasan = json_encode($model->pas_pernafasan);
      $model->pas_pola_nafas = json_encode($model->pas_pola_nafas);

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
    $title = 'Canceled ' . AskanPascaAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if (!$model->pas_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pas_to_id);
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

  protected function findModel($id)
  {
    if (($model = AskanPascaAnestesi::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
