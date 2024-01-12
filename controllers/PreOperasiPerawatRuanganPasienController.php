<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\PreOperasiPerawatRuangan;
use app\models\search\PreOperasiPerawatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use app\components\HelperGeneral;
use app\components\Model;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\components\mdcp\MdcpBase;
use app\components\mdcp\MdcpPreOperasiPerawatRuangan;
use app\models\bedahsentral\Log;
use app\models\pendaftaran\Layanan;
use app\components\Akun;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;

/**
 * PreOperasiPerawatRuanganController implements the CRUD actions for PreOperasiPerawatRuangan model.
 */
class PreOperasiPerawatRuanganPasienController extends Controller
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
   * Lists all PreOperasiPerawatRuangan models.
   * @return mixed
   */
  public function actionIndex($id)
  {

    $plid = HelperGeneral::convertLayananId($id);

    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $plid])->one();
    // echo "<pre>";print_r($plid);die;
    $model = $this->initModelUpdateAuto($timoperasi->to_id);

    if ($model) {
      return $this->redirect(Url::to(['/pre-operasi-perawat-ruangan-pasien/update/', 'id' => $id, 'subid' => $model->pop_id]));
    } else {
      return $this->redirect(Url::to(['/pre-operasi-perawat-ruangan-pasien/create/', 'id' => $timoperasi->to_ok_pl_id]));
    }
  }
  public function actionCreate($id)
  {
    // $timoperasi = TimOperasi::find()->where(['to_id' => $id])->one();
    // $layanan=Layanan::find()->where(['id'=>$timoperasi->to_ok_pl_id])->asArray()->one();

    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      // \Yii::$app->session->setFlash('warning', $chk_pasien->msg);
      return $this->redirect(Url::to(['/site/index/']));
    }
    $model = $this->initModelCreate($id, $chk_pasien->data);
    $title = PreOperasiPerawatRuangan::ass_pop;
    //$timoperasi = TimOperasi::find
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
    // $timoperasi = TimOperasi::find()->where(['to_id' => $id])->one();
    // $layanan=Layanan::find()->where(['id'=>$timoperasi->to_ok_pl_id])->asArray()->one();

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
    $title = PreOperasiPerawatRuangan::ass_pop;
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
    $transaction = PreOperasiPerawatRuangan::getDb()->beginTransaction();
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
      //     $data = \Yii::$app->controller->renderPartial('doc', ['pop_id' => $model->pop_id]);
      //     $mdcp_base = MdcpBase::getLayanan($model->timoperasi->to_ok_pl_id);
      //     $mdcp = MdcpPreOperasiPerawatRuangan::_set($model->pop_id, $mdcp_base, [], $data, $batal);
      //     if (!($s_flag = $mdcp->status)) {
      //       $m_flag = $mdcp->msg;
      //     }
      //   }
      // }
      //cek finalisasi save
      if ($s_flag) {
        $transaction->commit();
        return MakeResponse::createNotJson(true, $m_flag, ['pop_to_id' => $model->timoperasi->to_ok_pl_id, 'pop_id' => $model->pop_id]);
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
    $title = 'Created ' . PreOperasiPerawatRuangan::ass_pop;
    //cek simpan draf/final
    //init model
    $model = new PreOperasiPerawatRuangan();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pop_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      // $model->pop_final_ruangan = 0;
      if ($model->validate()) {
        if ($model->pop_final_ruangan) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => HelperGeneral::hashData($save->data['pop_to_id']), 'subid' => $save->data['pop_id']]);
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
    $title = 'Finalized ' . PreOperasiPerawatRuangan::ass_pop;
    //init model
    $model = new PreOperasiPerawatRuangan();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pop_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['pop_to_id']), 'subid' => $save->data['pop_id']]);
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
    $title = 'Updated ' . PreOperasiPerawatRuangan::ass_pop;
    //cek simpan draf/final/batalkan
    //init model order penunjang
    $model = $this->findModel($subid);
    // if ($model->pop_pgw_id_ruangan != Akun::user()->id) {
    //   return MakeResponse::create(false, 'Data Tidak Dapat Kelola');
    // }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    // echo'<pre/>';print_r($modelLog->mlog_data_before);die();
    // echo'<pre/>';print_r($id_item_pemeriksaan_order_before);die();

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pop_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->pop_pgw_id_ruangan = Akun::user()->id;
      // $model->pop_final_ruangan = 0;
      if ($model->validate()) {
        if ($model->pop_final_ruangan && !$model->pop_batal_ruangan) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->pop_final_ruangan && $model->pop_batal_ruangan) {
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
    $title = 'Finalized ' . PreOperasiPerawatRuangan::ass_pop;
    //init model
    $model = $this->findModel($subid);
    if ($model->pop_final_ruangan) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pop_to_id);
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
    $title = 'Canceled ' . PreOperasiPerawatRuangan::ass_pop;
    //init model
    $model = $this->findModel($subid);
    if (!$model->pop_final_ruangan) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pop_to_id);
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
    $title = 'Deleted ' . PreOperasiPerawatRuangan::ass_pop;
    //init model
    $model = $this->findModel($subid);
    // if ($model->pop_pgw_id_ruangan != Akun::user()->id) {
    //   return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    // }
    if ($model->pop_final_ruangan) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->pop_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['pop_to_id'])]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }
  protected function initModelCreate($id, $layanan = array())
  {
    $model = new PreOperasiPerawatRuangan();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['id' => $id])->asArray()->one();
    }
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();
    $model->pop_pgw_id_ruangan = Akun::user()->id;
    $model->pop_to_id = $timoperasi->to_id;
    $model->pop_final_ruangan = 0;
    $model->pop_batal_ruangan = 0;

    // $model->pop_riwayat_operasi = 'Tidak Ada';
    // $model->pop_tingkat_kesadaran = 'CM';
    // $model->pop_pernapasan = 'Spontan';
    // $model->pop_riwayat_operasi = 'Tidak Ada';
    // $model->pop_status_emosional = 'Tenang';
    // $model->pop_integritas_kulit = 'Utuh';
    // $model->pop_tulang = 'Tidak';
    // $model->pop_pendidikan = 'Napas';
    // $model->pop_sio_ruangan = 'Ada';
    // $model->pop_puasa_ruangan = 'Ada';
    // $model->pop_protesa_ruangan = 'Ada';
    // $model->pop_perhiasan_ruangan = 'Ada';
    // $model->pop_pdo_ruangan = 'Ada';
    // $model->pop_plo_ruangan = 'Ada';
    // $model->pop_huknah_ruangan = 'Ada';
    // $model->pop_fkateter_ruangan = 'Ada';
    // $model->pop_h_lab_ruangan = 'Ada';
    // $model->pop_rontgen_ruangan = 'Ada';
    // $model->pop_usg_ruangan = 'Ada';
    // $model->pop_ctscan_ruangan = 'Ada';
    // $model->pop_ekg_ruangan = 'Ada';
    // $model->pop_echo_ruangan = 'Ada';
    // $model->pop_persediaan_darah_ruangan = 'Ada';
    // $model->pop_ivline_ruangan = 'Ada';
    // $model->pop_propilaksis_ruangan = 'Ada';
    // $model->pop_alergi_obat_ruangan = 'Ada';
    return $model;
  }
  protected function initModelUpdateAuto($to_id)
  {
    $model = PreOperasiPerawatRuangan::find()
      ->where(['pop_to_id' => $to_id, 'pop_deleted_at' => null])
      ->andWhere([
        'or',
        ['pop_batal_ok' => null],
        ['pop_batal_ok' => 0],
      ])
      ->orderBy(['pop_created_at' => SORT_DESC])->one();
    return $model;
  }
  protected function initModelUpdate($subid)
  {
    return PreOperasiPerawatRuangan::find()
      ->where(['pop_id' => $subid, 'pop_deleted_at' => null])
      ->orderBy(['pop_created_at' => SORT_DESC])->one();
  }

  /**
   * Finds the PreOperasiPerawatRuangan model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return PreOperasiPerawatRuangan the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = PreOperasiPerawatRuangan::findOne($id)) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
