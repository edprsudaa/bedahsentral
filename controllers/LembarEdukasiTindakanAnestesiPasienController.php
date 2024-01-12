<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\LembarEdukasiTindakanAnestesi;
use app\models\search\LembarEdukasiTindakanAnestesiSearch;
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
use app\components\mdcp\MdcpLembarEdukasiTindakanAnestesi;
use app\models\bedahsentral\Log;
use app\models\pendaftaran\Layanan;
use app\components\Akun;
use app\models\bedahsentral\TimOperasi;

/**
 * LembarEdukasiTindakanAnestesiController implements the CRUD actions for LembarEdukasiTindakanAnestesi model.
 */
class LembarEdukasiTindakanAnestesiPasienController extends Controller
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
   * Lists all LembarEdukasiTindakanAnestesi models.
   * @return mixed
   */
  public function actionIndex($id)
  {
    $plid = HelperGeneral::convertLayananId($id);

    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $plid])->one();
    $model = $this->initModelUpdateAuto($timoperasi->to_id);

    if ($model) {
      return $this->redirect(Url::to(['/lembar-edukasi-tindakan-anestesi-pasien/update/', 'id' => $id, 'subid' => $model->leta_id]));
    } else {
      return $this->redirect(Url::to(['/lembar-edukasi-tindakan-anestesi-pasien/create/', 'id' => $timoperasi->to_ok_pl_id]));
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
    $title = LembarEdukasiTindakanAnestesi::ass_n;
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
    // Tampilkan dalam format tanggal
    $tanggal = date('Y-m-d', strtotime($model->leta_tanggal_persetujuan));
    $jam = date('H:i', strtotime($model->leta_tanggal_persetujuan));
    $model->leta_tanggal_persetujuan = $tanggal . 'T' . $jam;

    $model->leta_kelebihan_anestesi_umum = json_decode($model->leta_kelebihan_anestesi_umum);
    $model->leta_kekurangan_anestesi_umum = json_decode($model->leta_kekurangan_anestesi_umum);
    $model->leta_komplikasi_anestesi_umum = json_decode($model->leta_komplikasi_anestesi_umum);
    $model->leta_kelebihan_anestesi_regional = json_decode($model->leta_kelebihan_anestesi_regional);
    $model->leta_kekurangan_anestesi_regional = json_decode($model->leta_kekurangan_anestesi_regional);
    $model->leta_komplikasi_anestesi_regional = json_decode($model->leta_komplikasi_anestesi_regional);
    $model->leta_kelebihan_anestesi_lokal = json_decode($model->leta_kelebihan_anestesi_lokal);
    $model->leta_kekurangan_anestesi_lokal = json_decode($model->leta_kekurangan_anestesi_lokal);
    $model->leta_komplikasi_anestesi_lokal = json_decode($model->leta_komplikasi_anestesi_lokal);
    $model->leta_kelebihan_sedasi = json_decode($model->leta_kelebihan_sedasi);
    $model->leta_kekurangan_sedasi = json_decode($model->leta_kekurangan_sedasi);
    $model->leta_komplikasi_sedasi = json_decode($model->leta_komplikasi_sedasi);
    // $chk_pasien=HelperSpesial::getCheckPasien($model->po_pl_id);
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      // \Yii::$app->session->setFlash('warning', $chk_pasien->msg);
      return $this->redirect(Url::to(['/site/index/']));
    }
    $title = LembarEdukasiTindakanAnestesi::ass_n;
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
    $transaction = LembarEdukasiTindakanAnestesi::getDb()->beginTransaction();
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
      //     $data = \Yii::$app->controller->renderPartial('doc', ['leta_id' => $model->leta_id]);
      //     $mdcp_base = MdcpBase::getLayanan($model->timoperasi->to_ok_pl_id);
      //     $mdcp = MdcpLembarEdukasiTindakanAnestesi::_set($model->leta_id, $mdcp_base, [], $data, $batal);
      //     if (!($s_flag = $mdcp->status)) {
      //       $m_flag = $mdcp->msg;
      //     }
      //   }
      // }
      //cek finalisasi save
      if ($s_flag) {
        $transaction->commit();
        return MakeResponse::createNotJson(true, $m_flag, ['leta_to_id' => $model->timoperasi->to_ok_pl_id, 'leta_id' => $model->leta_id]);
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
    $title = 'Created ' . LembarEdukasiTindakanAnestesi::ass_n;
    //cek simpan draf/final
    //init model
    $model = new LembarEdukasiTindakanAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->leta_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      // $model->leta_final = 0;
      $model->leta_kelebihan_anestesi_umum = json_encode($model->leta_kelebihan_anestesi_umum);
      $model->leta_kekurangan_anestesi_umum = json_encode($model->leta_kekurangan_anestesi_umum);
      $model->leta_komplikasi_anestesi_umum = json_encode($model->leta_komplikasi_anestesi_umum);
      $model->leta_kelebihan_anestesi_regional = json_encode($model->leta_kelebihan_anestesi_regional);
      $model->leta_kekurangan_anestesi_regional = json_encode($model->leta_kekurangan_anestesi_regional);
      $model->leta_komplikasi_anestesi_regional = json_encode($model->leta_komplikasi_anestesi_regional);
      $model->leta_kelebihan_anestesi_lokal = json_encode($model->leta_kelebihan_anestesi_lokal);
      $model->leta_kekurangan_anestesi_lokal = json_encode($model->leta_kekurangan_anestesi_lokal);
      $model->leta_komplikasi_anestesi_lokal = json_encode($model->leta_komplikasi_anestesi_lokal);
      $model->leta_kelebihan_sedasi = json_encode($model->leta_kelebihan_sedasi);
      $model->leta_kekurangan_sedasi = json_encode($model->leta_kekurangan_sedasi);
      $model->leta_komplikasi_sedasi = json_encode($model->leta_komplikasi_sedasi);
      // echo "<pre/>"; print_r($model);die;
      if ($model->validate()) {
        if ($model->leta_final) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => HelperGeneral::hashData($save->data['leta_to_id']), 'subid' => $save->data['leta_id']]);
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
    $title = 'Finalized ' . LembarEdukasiTindakanAnestesi::ass_n;
    //init model
    $model = new LembarEdukasiTindakanAnestesi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->leta_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->leta_kelebihan_anestesi_umum = json_encode($model->leta_kelebihan_anestesi_umum);
      $model->leta_kekurangan_anestesi_umum = json_encode($model->leta_kekurangan_anestesi_umum);
      $model->leta_komplikasi_anestesi_umum = json_encode($model->leta_komplikasi_anestesi_umum);
      $model->leta_kelebihan_anestesi_regional = json_encode($model->leta_kelebihan_anestesi_regional);
      $model->leta_kekurangan_anestesi_regional = json_encode($model->leta_kekurangan_anestesi_regional);
      $model->leta_komplikasi_anestesi_regional = json_encode($model->leta_komplikasi_anestesi_regional);
      $model->leta_kelebihan_anestesi_lokal = json_encode($model->leta_kelebihan_anestesi_lokal);
      $model->leta_kekurangan_anestesi_lokal = json_encode($model->leta_kekurangan_anestesi_lokal);
      $model->leta_komplikasi_anestesi_lokal = json_encode($model->leta_komplikasi_anestesi_lokal);
      $model->leta_kelebihan_sedasi = json_encode($model->leta_kelebihan_sedasi);
      $model->leta_kekurangan_sedasi = json_encode($model->leta_kekurangan_sedasi);
      $model->leta_komplikasi_sedasi = json_encode($model->leta_komplikasi_sedasi);
      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['leta_to_id']), 'subid' => $save->data['leta_id']]);
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
    $title = 'Updated ' . LembarEdukasiTindakanAnestesi::ass_n;
    //cek simpan draf/final/batalkan
    //init model order penunjang
    $model = $this->findModel($subid);
    if ($model->leta_dokter_yg_mejelaskan != Akun::user()->id) {
      return MakeResponse::create(false, 'Data Tidak Dapat Kelola');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    // echo'<pre/>';print_r($modelLog->mlog_data_before);die();
    // echo'<pre/>';print_r($id_item_pemeriksaan_order_before);die();

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->leta_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      // $model->leta_final = 0;
      $model->leta_kelebihan_anestesi_umum = json_encode($model->leta_kelebihan_anestesi_umum);
      $model->leta_kekurangan_anestesi_umum = json_encode($model->leta_kekurangan_anestesi_umum);
      $model->leta_komplikasi_anestesi_umum = json_encode($model->leta_komplikasi_anestesi_umum);
      $model->leta_kelebihan_anestesi_regional = json_encode($model->leta_kelebihan_anestesi_regional);
      $model->leta_kekurangan_anestesi_regional = json_encode($model->leta_kekurangan_anestesi_regional);
      $model->leta_komplikasi_anestesi_regional = json_encode($model->leta_komplikasi_anestesi_regional);
      $model->leta_kelebihan_anestesi_lokal = json_encode($model->leta_kelebihan_anestesi_lokal);
      $model->leta_kekurangan_anestesi_lokal = json_encode($model->leta_kekurangan_anestesi_lokal);
      $model->leta_komplikasi_anestesi_lokal = json_encode($model->leta_komplikasi_anestesi_lokal);
      $model->leta_kelebihan_sedasi = json_encode($model->leta_kelebihan_sedasi);
      $model->leta_kekurangan_sedasi = json_encode($model->leta_kekurangan_sedasi);
      $model->leta_komplikasi_sedasi = json_encode($model->leta_komplikasi_sedasi);
      // echo "<pre/>"; print_r($model);die;
      if ($model->validate()) {
        if ($model->leta_final && !$model->leta_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->leta_final && $model->leta_batal) {
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
    $title = 'Finalized ' . LembarEdukasiTindakanAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->leta_final) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->leta_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->leta_kelebihan_anestesi_umum = json_encode($model->leta_kelebihan_anestesi_umum);
      $model->leta_kekurangan_anestesi_umum = json_encode($model->leta_kekurangan_anestesi_umum);
      $model->leta_komplikasi_anestesi_umum = json_encode($model->leta_komplikasi_anestesi_umum);
      $model->leta_kelebihan_anestesi_regional = json_encode($model->leta_kelebihan_anestesi_regional);
      $model->leta_kekurangan_anestesi_regional = json_encode($model->leta_kekurangan_anestesi_regional);
      $model->leta_komplikasi_anestesi_regional = json_encode($model->leta_komplikasi_anestesi_regional);
      $model->leta_kelebihan_anestesi_lokal = json_encode($model->leta_kelebihan_anestesi_lokal);
      $model->leta_kekurangan_anestesi_lokal = json_encode($model->leta_kekurangan_anestesi_lokal);
      $model->leta_komplikasi_anestesi_lokal = json_encode($model->leta_komplikasi_anestesi_lokal);
      $model->leta_kelebihan_sedasi = json_encode($model->leta_kelebihan_sedasi);
      $model->leta_kekurangan_sedasi = json_encode($model->leta_kekurangan_sedasi);
      $model->leta_komplikasi_sedasi = json_encode($model->leta_komplikasi_sedasi);
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
    $title = 'Canceled ' . LembarEdukasiTindakanAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if (!$model->leta_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->leta_to_id);
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
    $title = 'Deleted ' . LembarEdukasiTindakanAnestesi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->leta_dokter_yg_mejelaskan != Akun::user()->id) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    }
    if ($model->leta_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->leta_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['leta_to_id'])]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }
  protected function initModelCreate($id, $layanan = array())
  {
    $model = new LembarEdukasiTindakanAnestesi();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['id' => $id])->asArray()->one();
    }
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();
    if (!empty($timoperasi)) {
      $model->leta_pasien_diagnosa = $timoperasi->to_diagnosa_medis_pra_bedah;
      $model->leta_to_id = $timoperasi->to_id;
      $model->leta_pasien_rencana_tindakan = $timoperasi->to_tindakan_operasi;

      $tanggal = date('Y-m-d', strtotime($timoperasi->to_tanggal_operasi));
      $jam = date('H:i', strtotime($timoperasi->to_tanggal_operasi));
      $model->leta_tanggal_persetujuan = $tanggal . 'T' . $jam;
    }

    $model->leta_dokter_yg_mejelaskan = Akun::user()->id;
    $model->leta_final = 0;
    $model->leta_batal = 0;
    $model->leta_keluarga_jenis_kelamin = 'Laki-Laki';
    $model->leta_setuju = '1';
    $model->leta_pasien_jenis_anestesi = 'GA';
    $model->leta_pasien_nama = $layanan['registrasi']['pasien']['nama'];
    $model->leta_pasien_tgl_lahir = $layanan['registrasi']['pasien']['tgl_lahir'];
    $model->leta_pasien_no_rekam_medis = $layanan['registrasi']['pasien']['kode'];
    $model->leta_setuju = 1;
    // $model->leta_psikiatri=0;
    // //set anemnesa
    return $model;
  }
  protected function initModelUpdateAuto($to_id)
  {
    return LembarEdukasiTindakanAnestesi::find()->where(['leta_to_id' => $to_id])->andWhere('leta_deleted_at is null')->andWhere(['leta_dokter_yg_mejelaskan' => Akun::user()->id])->orderBy(['leta_created_at' => SORT_DESC])->one();
  }
  protected function initModelUpdate($subid)
  {
    return LembarEdukasiTindakanAnestesi::find()->where(['leta_id' => $subid])->andWhere('leta_deleted_at is null')->orderBy(['leta_created_at' => SORT_DESC])->one();
  }

  /**
   * Finds the LembarEdukasiTindakanAnestesi model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return LembarEdukasiTindakanAnestesi the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = LembarEdukasiTindakanAnestesi::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
