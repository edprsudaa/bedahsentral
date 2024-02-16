<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\IntraOperasiPerawat;
use app\models\search\IntraOperasiPerawatSearch;
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
use app\components\mdcp\MdcpIntraOperasiPerawat;
use app\models\bedahsentral\Log;
use app\models\pendaftaran\Layanan;
use app\components\Akun;
use app\models\bedahsentral\AskanIntraAnestesi;
use app\models\bedahsentral\CatatanLokalAnestesi;
use app\models\bedahsentral\IntraAnestesi;
use app\models\bedahsentral\LaporanOperasi;
use app\models\bedahsentral\PreOperasiPerawatRuangan;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;

/**
 * IntraOperasiPerawatController implements the CRUD actions for IntraOperasiPerawat model.
 */
class IntraOperasiPerawatPasienController extends Controller
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
   * Lists all IntraOperasiPerawat models.
   * @return mixed
   */
  public function actionIndex($id)
  {
    $plid = HelperGeneral::convertLayananId($id);

    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $plid])->one();
    $model = $this->initModelUpdateAuto($timoperasi->to_id);

    if ($model) {
      return $this->redirect(Url::to(['/intra-operasi-perawat-pasien/update/', 'id' => $id, 'subid' => $model->iop_id]));
    } else {
      return $this->redirect(Url::to(['/intra-operasi-perawat-pasien/create/', 'id' => $timoperasi->to_ok_pl_id]));
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
    $title = IntraOperasiPerawat::ass_n;
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
    $model->iop_disenfeksi_kulit = json_decode($model->iop_disenfeksi_kulit);
    // $chk_pasien=HelperSpesial::getCheckPasien($model->po_id);
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      // \Yii::$app->session->setFlash('warning', $chk_pasien->msg);
      return $this->redirect(Url::to(['/site/index/']));
    }
    $title = IntraOperasiPerawat::ass_n;
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
  private function save($title, $modelLog, $model, $modelDetail, $final = false, $batal = false, $hapus = false)
  {
    $transaction = IntraOperasiPerawat::getDb()->beginTransaction();
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
      //     $data = \Yii::$app->controller->renderPartial('doc', ['iop_id' => $model->iop_id]);
      //     $mdcp_base = MdcpBase::getLayanan($model->timoperasi->to_ok_pl_id);
      //     $mdcp = MdcpIntraOperasiPerawat::_set($model->iop_id, $mdcp_base, [], $data, $batal);
      //     if (!($s_flag = $mdcp->status)) {
      //       $m_flag = $mdcp->msg;
      //     }
      //   }
      // }
      //cek finalisasi save
      if ($s_flag) {
        $transaction->commit();
        return MakeResponse::createNotJson(true, $m_flag, ['iop_to_id' => $model->timoperasi->to_ok_pl_id, 'iop_id' => $model->iop_id]);
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
    $title = 'Created ' . IntraOperasiPerawat::ass_n;
    //cek simpan draf/final
    //init model
    $model = new IntraOperasiPerawat();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->iop_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      // $model->iop_final = 0;
      $model->iop_disenfeksi_kulit = json_encode($model->iop_disenfeksi_kulit);
      if ($model->validate()) {
        if ($model->iop_final) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => $save->data['iop_to_id'], 'subid' => $save->data['iop_id']]);
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
    $title = 'Finalized ' . IntraOperasiPerawat::ass_n;
    //init model
    $model = new IntraOperasiPerawat();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->iop_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->iop_disenfeksi_kulit = json_encode($model->iop_disenfeksi_kulit);

      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => $save->data['iop_to_id'], 'subid' => $save->data['iop_id']]);
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
    $title = 'Updated ' . IntraOperasiPerawat::ass_n;
    //cek simpan draf/final/batalkan
    //init model order penunjang
    $model = $this->findModel($subid);
    // if($model->iop_to_id!=Akun::user()->id){
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
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->iop_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      // $model->iop_final = 0;
      $model->iop_disenfeksi_kulit = json_encode($model->iop_disenfeksi_kulit);
      if ($model->validate()) {
        if ($model->iop_final && !$model->iop_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->iop_final && $model->iop_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => false, 'konfirm_batal' => true]);
        } else {
          $save = $this->save($title, $modelLog, $model, []);
          // $this->laporanJamMulai($model);
          // $this->catatanJamMulai($model);
          // $this->askanIntraJamMulai($model);
          // $this->intraAnestesiJamMulai($model);
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
  //simpan jam mulai dan selesai ke tabel laporan
  public function laporanJamMulai($model)
  {
    $modelLaporan = $this->findModelLaporan($model->iop_to_id);
    foreach ($modelLaporan as $v) {
      $v->lap_op_jam_mulai = $model->iop_jam_mulai_bedah;
      $v->lap_op_jam_selesai = $model->iop_jam_selesai_bedah;

      $awal  = strtotime($model->iop_jam_mulai_bedah); //waktu awal

      $akhir = strtotime($model->iop_jam_selesai_bedah); //waktu akhir

      $diff  = $akhir - $awal;

      $jam   = floor($diff / (60 * 60));

      $menit = $diff - $jam * (60 * 60);
      if ($jam == '0') {
        $v->lap_op_lama_operasi = floor($menit / 60) . ' Menit';
      } else {
        $v->lap_op_lama_operasi = $jam . ' Jam ' . floor($menit / 60) . ' Menit';
      }

      $v->save();
    }
  }
  //simpan jam mulai dan selesai ke tabel catatan lokal anestesi
  public function catatanJamMulai($model)
  {
    $modelCatatan = $this->findModelCatatan($model->iop_to_id);
    foreach ($modelCatatan as $v) {
      $v->cla_jam_mulai_operasi = $model->iop_jam_mulai_bedah;
      $v->cla_jam_akhir_operasi = $model->iop_jam_selesai_bedah;

      $awal  = strtotime($v->cla_jam_mulai_operasi); //waktu awal

      $akhir = strtotime($v->cla_jam_akhir_operasi); //waktu akhir

      $diff  = $akhir - $awal;

      $jam   = floor($diff / (60 * 60));

      $menit = $diff - $jam * (60 * 60);
      if ($jam == '0') {
        $v->cla_lama_operasi   = floor($menit / 60) . ' Menit';
      } else {
        $v->cla_lama_operasi   = $jam . ' Jam ' . floor($menit / 60) . ' Menit';
      }

      $v->save();
    }
  }
  //simpan jam mulai dan selesai ke tabel askan intra
  public function askanIntraJamMulai($model)
  {
    $modelAskanIntra = $this->findModelAskanIntra($model->iop_to_id);
    foreach ($modelAskanIntra as $v) {
      $v->aia_mulai_pembedahan = $model->iop_jam_mulai_bedah;
      $v->aia_selesai_pembedahan = $model->iop_jam_selesai_bedah;
      $v->aia_mulai_anestesi = $model->iop_jam_mulai_anestesi;
      $v->aia_selesai_anestesi = $model->iop_jam_selesai_anestesi;

      $v->save();
    }
  }
  //simpan jam mulai dan selesai ke tabel intra anestesi
  public function intraAnestesiJamMulai($model)
  {
    $modelIntra = $this->findModelIntraAnestesi($model->iop_to_id);
    foreach ($modelIntra as $v) {
      $v->mia_jam_mulai_operasi = $model->iop_jam_mulai_bedah;
      $v->mia_jam_berakhir_operasi = $model->iop_jam_selesai_bedah;
      $v->mia_jam_mulai_anestesi = $model->iop_jam_mulai_anestesi;
      $v->mia_jam_berakhir_anestesi = $model->iop_jam_selesai_anestesi;

      $v->save();
    }
  }
  public function actionSaveUpdateFinal($subid)
  {
    $title = 'Finalized ' . IntraOperasiPerawat::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->iop_final) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->iop_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      $model->iop_disenfeksi_kulit = json_encode($model->iop_disenfeksi_kulit);

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
    $title = 'Canceled ' . IntraOperasiPerawat::ass_n;
    //init model
    $model = $this->findModel($subid);
    if (!$model->iop_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->iop_to_id);
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
    $title = 'Deleted ' . IntraOperasiPerawat::ass_n;
    //init model
    $model = $this->findModel($subid);
    // if($model->iop_to_id!=Akun::user()->id){
    //     return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    // }
    if ($model->iop_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->iop_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => $save->data['iop_to_id']]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }
  protected function initModelCreate($id, $layanan = array())
  {
    $model = new IntraOperasiPerawat();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['id' => $id])->asArray()->one();
    }

    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();
    $pre = PreOperasiPerawatRuangan::find()->where(['pop_to_id' => $timoperasi->to_id])->one();
    if ($pre) {
      $model->iop_masalah = $pre->pop_masalah;
      $model->iop_tindakan = $pre->pop_tindakan;
      $model->iop_status_emosi = $pre->pop_status_emosional;
      $model->iop_implementasi = $pre->pop_implementasi;
      $model->iop_evaluasi = $pre->pop_evaluasi;
    }
    $model->iop_to_id = $timoperasi->to_id;
    $model->iop_final = 0;
    $model->iop_batal = 0;
    // echo "<pre>";print_r($model);die;
    // $model->iop_jenis_pembiusan = 'UMUM';
    // $model->iop_type_operasi = 'Elektif';
    // $model->iop_posisi_kanul_intravena = 'Ta. Ka/Ki';
    // $model->iop_posisi_operasi = 'Telentang';
    // $model->iop_jenis_operasi = 'Bersih';
    // $model->iop_posisi_tangan = 'Terlipat';
    // $model->iop_kateter_urin = 'Tidak';
    // $model->iop_disenfeksi_kulit = 'Betadin';
    // $model->iop_insisi_kulit = 'Mediana';
    // $model->iop_esu = 'Ya';
    // $model->iop_lok_ntrl_elektroda = 'Bokong';
    // $model->iop_pemeriksaan_kulit_pra_bedah = 'Utuh';
    // $model->iop_pemeriksaan_kulit_pasca_bedah = 'Utuh';
    // $model->iop_unit_penghangat = 'Tidak';
    // $model->iop_tourniquet = 'Tidak';
    // $model->iop_implant = 'Tidak';
    // $model->iop_drainage = 'Tidak';
    // $model->iop_irigasi_luka = 'Tidak';
    // $model->iop_tamplon = 'Tidak';
    // $model->iop_pemeriksaan_jaringan = 'Tidak';
    // $model->iop_pernapasan = 'Spontan';
    // $model->iop_kesadaran = 'Delirium';
    // $model->iop_status_emosi = 'Tenang';
    // $model->iop_integritas_kulit = 'Utuh';
    // $model->iop_tulang = 'Utuh';
    return $model;
  }
  protected function initModelUpdateAuto($to_id)
  {
    $model =  IntraOperasiPerawat::find()->where(['iop_to_id' => $to_id])->andWhere('iop_deleted_at is null')->orderBy(['iop_created_at' => SORT_DESC])->one();
    return $model;
  }
  protected function initModelUpdate($subid)
  {
    return IntraOperasiPerawat::find()->where(['iop_id' => $subid])->andWhere('iop_deleted_at is null')->orderBy(['iop_created_at' => SORT_DESC])->one();
  }
  protected function findModel($id)
  {
    if (($model = IntraOperasiPerawat::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
  protected function findModelLaporan($id)
  {
    if (($model = LaporanOperasi::find()->where(['lap_op_to_id' => $id])->all()) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

  protected function findModelCatatan($id)
  {
    if (($model = CatatanLokalAnestesi::find()->where(['cla_to_id' => $id])->all()) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

  protected function findModelAskanIntra($id)
  {
    if (($model = AskanIntraAnestesi::find()->where(['aia_to_id' => $id])->all()) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
  protected function findModelIntraAnestesi($id)
  {
    if (($model = IntraAnestesi::find()->where(['mia_to_id' => $id])->all()) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
