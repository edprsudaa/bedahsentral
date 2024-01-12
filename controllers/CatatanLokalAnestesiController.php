<?php

namespace app\controllers;

use app\components\HelperGeneral;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\models\bedahsentral\CairanKeluarCatatanLokalAnestesi;
use app\models\bedahsentral\CairanMasukCatatanLokalAnestesi;
use app\models\bedahsentral\CatatanLokalAnestesi;
use app\models\bedahsentral\IntraOperasiPerawat;
use app\models\bedahsentral\Log;
use app\models\bedahsentral\MedikasiCatatanLokalAnestesi;
use app\models\bedahsentral\TimOperasi;
use app\models\pendaftaran\Layanan;
use app\models\search\CatatanLokalAnestesiSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * CatatanLokalAnestesiController implements the CRUD actions for CatatanLokalAnestesi model.
 */
class CatatanLokalAnestesiController extends Controller
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
      return $this->redirect(Url::to(['/catatan-lokal-anestesi/update/', 'id' => $id, 'subid' => $model->cla_id]));
    } else {
      return $this->redirect(Url::to(['/catatan-lokal-anestesi/create/', 'id' => $timoperasi->to_ok_pl_id]));
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
    $modelmedikasi = new MedikasiCatatanLokalAnestesi();
    $modelcairanmasuk = new CairanMasukCatatanLokalAnestesi();
    $modelcairankeluar = new CairanKeluarCatatanLokalAnestesi();
    // echo "<pre/>";
    // print_r($model);
    // die;
    $title = CatatanLokalAnestesi::ass_n;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
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
        'modelmedikasi' => $modelmedikasi,
        'modelcairanmasuk' => $modelcairanmasuk,
        'modelcairankeluar' => $modelcairankeluar
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

    $model->cla_posisi_operasi = json_decode($model->cla_posisi_operasi);
    // $model->cla_tanggal = date('Y-m-d', strtotime($model->cla_tanggal));

    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      return $this->redirect(Url::to(['/site/index/']));
    }
    $modelmedikasi = new MedikasiCatatanLokalAnestesi();
    $modelcairanmasuk = new CairanMasukCatatanLokalAnestesi();
    $modelcairankeluar = new CairanKeluarCatatanLokalAnestesi();

    $title = CatatanLokalAnestesi::ass_n;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $model,
        'chk_pasien' => $chk_pasien->data,
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
        'modelmedikasi' => $modelmedikasi,
        'modelcairanmasuk' => $modelcairanmasuk,
        'modelcairankeluar' => $modelcairankeluar
      ]);
    }
  }

  protected function initModelCreate($id, $layanan = array())
  {
    $model = new CatatanLokalAnestesi();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['id' => $id])->asArray()->one();
    }
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();
    $intraoperasi = IntraOperasiPerawat::find()->where(['iop_to_id' => $timoperasi->to_id])->andWhere('iop_deleted_at is null')->orderBy(['iop_created_at' => SORT_DESC])->one();

    if (!empty($intraoperasi)) {
      $model->cla_jam_mulai_operasi = $intraoperasi->iop_jam_mulai_bedah;
      $model->cla_jam_akhir_operasi = $intraoperasi->iop_jam_selesai_bedah;

      $awal  = strtotime($intraoperasi->iop_jam_mulai_bedah); //waktu awal

      $akhir = strtotime($intraoperasi->iop_jam_selesai_bedah); //waktu akhir

      $diff  = $akhir - $awal;

      $jam   = floor($diff / (60 * 60));

      $menit = $diff - $jam * (60 * 60);
      if ($jam == 0) {
        $model->cla_lama_operasi   = floor($menit / 60) . ' Menit';
      }
      $model->cla_lama_operasi   = $jam . ' Jam ' . floor($menit / 60) . ' Menit';
    }

    $model->cla_tanggal = $timoperasi->to_tanggal_operasi;

    $model->cla_ruangan = $timoperasi->unit->nama;
    $model->cla_diagnosis_pra_bedah = $timoperasi->to_diagnosa_medis_pra_bedah;
    $model->cla_diagnosis_pasca_bedah = $timoperasi->to_diagnosa_medis_pasca_bedah;
    $model->cla_tindakan = $timoperasi->to_tindakan_operasi;

    $model->cla_to_id = $timoperasi->to_id;
    $model->cla_final = 0;
    $model->cla_batal = 0;

    return $model;
  }

  protected function initModelUpdate($subid)
  {
    return CatatanLokalAnestesi::find()->where(['cla_id' => $subid])->andWhere('cla_deleted_at is null')->orderBy(['cla_created_at' => SORT_DESC])->one();
  }

  protected function initModelUpdateAuto($to_id)
  {
    return CatatanLokalAnestesi::find()->where(['cla_to_id' => $to_id])->andWhere('cla_deleted_at is null')->orderBy(['cla_created_at' => SORT_DESC])->one();
  }

  private function save($title, $modelLog, $model, $modelDetail, $final = false, $batal = false, $hapus = false)
  {
    $transaction = CatatanLokalAnestesi::getDb()->beginTransaction();
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
        return MakeResponse::createNotJson(true, $m_flag, ['cla_to_id' => $model->timoperasi->to_ok_pl_id, 'cla_id' => $model->cla_id]);
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
    $title = 'Created ' . CatatanLokalAnestesi::ass_n;
    //cek simpan draf/final
    //init model
    $model = new CatatanLokalAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->cla_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->cla_posisi_operasi = json_encode($model->cla_posisi_operasi);

      if ($model->validate()) {
        if ($model->cla_final) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => HelperGeneral::hashData($save->data['cla_to_id']), 'subid' => $save->data['cla_id']]);
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

    $title = 'Finalized ' . CatatanLokalAnestesi::ass_n;
    //init model
    $model = new CatatanLokalAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->cla_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->cla_posisi_operasi = json_encode($model->cla_posisi_operasi);

      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['cla_to_id']), 'subid' => $save->data['cla_id']]);
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
    $title = 'Updated ' . CatatanLokalAnestesi::ass_n;
    $model = $this->findModel($subid);
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->cla_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      // echo'<pre>';print_r($model);die();
      $model->cla_posisi_operasi = json_encode($model->cla_posisi_operasi);

      if ($model->validate()) {
        if ($model->cla_final && !$model->cla_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->cla_final && $model->cla_batal) {
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
    $title = 'Deleted ' . CatatanLokalAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    // if($model->cla_perawat_id!=Akun::user()->id){
    //     return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    // }
    if ($model->cla_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->cla_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['cla_to_id'])]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }

  public function actionSaveUpdateFinal($subid)
  {
    $title = 'Finalized ' . CatatanLokalAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->cla_final) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->cla_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->cla_posisi_operasi = json_encode($model->cla_posisi_operasi);

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
    $title = 'Canceled ' . CatatanLokalAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if (!$model->cla_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->cla_to_id);
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
    if (($model = CatatanLokalAnestesi::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
