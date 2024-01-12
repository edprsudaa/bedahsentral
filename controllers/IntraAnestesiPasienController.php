<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\IntraAnestesi;
use app\models\search\IntraAnestesiSearch;
use yii\web\Controller;
use app\models\bedahsentral\TtvIntraAnestesi;
use app\models\bedahsentral\MedikasiIntraAnestesi;
use app\models\bedahsentral\CairanKeluarIntraAnestesi;
use app\models\bedahsentral\CairanMasukIntraAnestesi;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\HelperGeneral;
use app\components\Model;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\components\mdcp\MdcpBase;
use app\components\mdcp\MdcpIntraAnestesi;
use app\models\bedahsentral\Log;
use app\models\sdm\Suku;
use app\models\sdm\Agama;
use app\models\pendaftaran\Layanan;
use app\components\Akun;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\AsesmenPraInduksi;
use app\models\bedahsentral\IntraOperasiPerawat;

/**
 * IntraAnestesiController implements the CRUD actions for IntraAnestesi model.
 */
class IntraAnestesiPasienController extends Controller
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
   * Lists all IntraAnestesi models.
   * @return mixed
   */
  public function actionIndex($id)
  {
    $plid = HelperGeneral::convertLayananId($id);

    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $plid])->one();
    $model = $this->initModelUpdateAuto($timoperasi->to_id);

    if ($model) {
      return $this->redirect(Url::to(['/intra-anestesi-pasien/update/', 'id' => $id, 'subid' => $model->mia_id]));
    } else {
      return $this->redirect(Url::to(['/intra-anestesi-pasien/create/', 'id' => HelperGeneral::hashData($timoperasi->to_ok_pl_id)]));
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
    // echo "<pre/>";print_r($model);die;
    $title = IntraAnestesi::ass_n;
    $modelttv = new TtvIntraAnestesi();
    $modelmedikasi = new MedikasiIntraAnestesi();
    $modelcairanmasuk = new CairanMasukIntraAnestesi();
    $modelcairankeluar = new CairanKeluarIntraAnestesi();
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
        'modelttv' => $modelttv,
        'modelmedikasi' => $modelmedikasi,
        'modelcairanmasuk' => $modelcairanmasuk,
        'modelcairankeluar' => $modelcairankeluar
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
        'modelttv' => $modelttv,
        'modelmedikasi' => $modelmedikasi,
        'modelcairanmasuk' => $modelcairanmasuk,
        'modelcairankeluar' => $modelcairankeluar
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
    $model->mia_posisi_operasi = json_decode($model->mia_posisi_operasi);
    $model->mia_teknik_anestesi = json_decode($model->mia_teknik_anestesi);
    // echo "<pre>";print_r($model);die;

    // $chk_pasien=HelperSpesial::getCheckPasien($model->po_pl_id);
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      // \Yii::$app->session->setFlash('warning', $chk_pasien->msg);
      return $this->redirect(Url::to(['/site/index/']));
    }
    $modelttv = new TtvIntraAnestesi();
    $modelmedikasi = new MedikasiIntraAnestesi();
    $modelcairanmasuk = new CairanMasukIntraAnestesi();
    $modelcairankeluar = new CairanKeluarIntraAnestesi();
    $title = IntraAnestesi::ass_n;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
        'modelttv' => $modelttv,
        'modelmedikasi' => $modelmedikasi,
        'modelcairanmasuk' => $modelcairanmasuk,
        'modelcairankeluar' => $modelcairankeluar
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
        'modelttv' => $modelttv,
        'modelmedikasi' => $modelmedikasi,
        'modelcairanmasuk' => $modelcairanmasuk,
        'modelcairankeluar' => $modelcairankeluar
      ]);
    }
  }
  private function save($title, $modelLog, $model, $modelDetail, $final = false, $batal = false, $hapus = false)
  {
    $transaction = IntraAnestesi::getDb()->beginTransaction();
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
      //     $data = \Yii::$app->controller->renderPartial('doc', ['mia_id' => $model->mia_id]);

      //     $mdcp_base = MdcpBase::getLayanan($model->timoperasi->to_ok_pl_id);
      //     $mdcp = MdcpIntraAnestesi::_set($model->mia_id, $mdcp_base, [], $data, $batal);
      //     if (!($s_flag = $mdcp->status)) {
      //       $m_flag = $mdcp->msg;
      //     }
      //   }
      // }

      //cek finalisasi save

      if ($s_flag) {
        $transaction->commit();
        return MakeResponse::createNotJson(true, $m_flag, ['mia_to_id' => $model->timoperasi->to_ok_pl_id, 'mia_id' => $model->mia_id]);
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
    $title = 'Created ' . IntraAnestesi::ass_n;
    //cek simpan draf/final
    //init model
    $model = new IntraAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mia_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      // $model->mia_final = 0;
      $model->mia_posisi_operasi = json_encode($model->mia_posisi_operasi);
      $model->mia_teknik_anestesi = json_encode($model->mia_teknik_anestesi);

      if ($model->validate()) {
        if ($model->mia_final) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => HelperGeneral::hashData($save->data['mia_to_id']), 'subid' => $save->data['mia_id']]);
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

    $title = 'Finalized ' . IntraAnestesi::ass_n;
    //init model
    $model = new IntraAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mia_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->mia_posisi_operasi = json_encode($model->mia_posisi_operasi);
      $model->mia_teknik_anestesi = json_encode($model->mia_teknik_anestesi);

      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['mia_to_id']), 'subid' => $save->data['mia_id']]);
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
    $title = 'Updated ' . IntraAnestesi::ass_n;
    //cek simpan draf/final/batalkan
    //init model order penunjang
    $model = $this->findModel($subid);
    // if($model->mia_perawat_id!=Akun::user()->id){
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
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mia_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      // $model->mia_final = 0;
      $model->mia_posisi_operasi = json_encode($model->mia_posisi_operasi);
      $model->mia_teknik_anestesi = json_encode($model->mia_teknik_anestesi);

      if ($model->validate()) {
        if ($model->mia_final && !$model->mia_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->mia_final && $model->mia_batal) {
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
    $title = 'Finalized ' . IntraAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->mia_final) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mia_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->mia_posisi_operasi = json_encode($model->mia_posisi_operasi);
      $model->mia_teknik_anestesi = json_encode($model->mia_teknik_anestesi);

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
    $title = 'Canceled ' . IntraAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if (!$model->mia_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mia_to_id);
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
    $title = 'Deleted ' . IntraAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    // if($model->mia_perawat_id!=Akun::user()->id){
    //     return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    // }
    if ($model->mia_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mia_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['mia_to_id'])]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }
  protected function initModelCreate($id, $layanan = array())
  {
    $model = new IntraAnestesi();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['id' => $id])->asArray()->one();
    }
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();
    $intraoperasi = IntraOperasiPerawat::find()->where(['iop_to_id' => $timoperasi->to_id])->andWhere('iop_deleted_at is null')->orderBy(['iop_created_at' => SORT_DESC])->one();
    if (!empty($intraoperasi)) {
      $model->mia_jam_mulai_operasi = $intraoperasi->iop_jam_mulai_bedah;
      $model->mia_jam_berakhir_operasi = $intraoperasi->iop_jam_selesai_bedah;
      $model->mia_jam_mulai_anestesi = $intraoperasi->iop_jam_mulai_anestesi;
      $model->mia_jam_berakhir_anestesi = $intraoperasi->iop_jam_selesai_anestesi;
    }
    $model->mia_to_id = $timoperasi->to_id;
    $model->mia_final = 0;
    $model->mia_batal = 0;

    // $model->mia_induksi = 'Sempurna';
    // $model->mia_jalan_nafas = 'ETT';
    // $model->mia_pengaturan_nafas = 'Spontan';
    // $model->mia_teknik_khusus = 'Hipotermi';
    // print_r($model->mia_induksi);
    // die();
    return $model;
  }
  protected function initModelUpdateAuto($to_id)
  {
    return IntraAnestesi::find()->where(['mia_to_id' => $to_id])->andWhere('mia_deleted_at is null')->orderBy(['mia_created_at' => SORT_DESC])->one();
  }
  protected function initModelUpdate($subid)
  {
    return IntraAnestesi::find()->where(['mia_id' => $subid])->andWhere('mia_deleted_at is null')->orderBy(['mia_created_at' => SORT_DESC])->one();
  }

  /**
   * Finds the IntraAnestesi model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return IntraAnestesi the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = IntraAnestesi::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

  public function actionGetdata($id)
  {

    $model = TtvIntraAnestesi::find()->where(['ttva_intra_operasi_mia_id' => $id])->all();
    $temp = [];
    foreach ($model as $val) {
      $temp[] = [
        'waktu' => $val->ttva_waktu,
        'nadi' => $val->ttva_nadi,
        'nafas' => $val->ttva_pernafasan,
        'sistole' => $val->ttva_tek_darah_sistole,
        'diastole' => $val->ttva_tek_darah_diastole
      ];
    }
    return json_encode($temp);
  }
}
