<?php

namespace app\controllers;

use app\components\Akun;
use Yii;
use app\models\bedahsentral\LaporanOperasi;
use app\models\search\LaporanOperasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\HelperGeneral;
use app\components\Model;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\models\bedahsentral\IntraOperasiPerawat;
use app\components\mdcp\MdcpBase;
use app\components\mdcp\MdcpLaporanOperasi;
use app\models\bedahsentral\Log;
use app\models\pendaftaran\Layanan;
use app\models\bedahsentral\TimOperasi;
use yii\web\UploadedFile;

/**
 * LaporanOperasiController implements the CRUD actions for LaporanOperasi model.
 */
class LaporanOperasiPasienController extends Controller
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
   * Lists all LaporanOperasi models.
   * @return mixed
   */
  public function actionIndex($id)
  {
    $timoperasi = TimOperasi::find()
      ->where(['to_ok_pl_id' => $id, 'to_deleted_at' => null])
      ->orderBy(['to_created_at' => SORT_DESC])
      ->one();

    $model = $this->initModelUpdateAuto($timoperasi->to_id);

    if ($model) {
      return $this->redirect(Url::to(['/laporan-operasi-pasien/update/', 'id' => $id, 'subid' => $model->lap_op_id]));
    } else {
      return $this->redirect(Url::to(['/laporan-operasi-pasien/create/', 'id' => $timoperasi->to_ok_pl_id]));
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
    //   print_r($model);
    //   die;
    $title = LaporanOperasi::ass_n;
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
    // echo "<pre>";print_r($model);die;
    if (!$model) {
      return $this->redirect(Url::to(['/site/index/']));
    }

    //$model->lap_op_label_implant = base64_decode($model->lap_op_label_implant);
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      return $this->redirect(Url::to(['/site/index/']));
    }
    $title = LaporanOperasi::ass_n;
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
    $transaction = LaporanOperasi::getDb()->beginTransaction();
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
        return MakeResponse::createNotJson(true, $m_flag, ['lap_op_to_id' => $model->timoperasi->to_ok_pl_id, 'lap_op_id' => $model->lap_op_id]);
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

    $title = 'Created ' . LaporanOperasi::ass_n;
    //cek simpan draf/final
    //init model
    $model = new LaporanOperasi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->lap_op_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->lap_op_laporan = str_replace(["<<", ">>"], ["<", ">"], $model->lap_op_laporan);
      $model->lap_op_instruksi_prwt_pasca_operasi = str_replace(["<<", ">>"], ["<", ">"], $model->lap_op_instruksi_prwt_pasca_operasi);

      if ($model->validate()) {
        if ($model->lap_op_final) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => $save->data['lap_op_to_id'], 'subid' => $save->data['lap_op_id']]);
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
    $title = 'Finalized ' . LaporanOperasi::ass_n;
    //init model
    $model = new LaporanOperasi();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->lap_op_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->lap_op_laporan = str_replace(["<<", ">>"], ["<", ">"], $model->lap_op_laporan);
      $model->lap_op_instruksi_prwt_pasca_operasi = str_replace(["<<", ">>"], ["<", ">"], $model->lap_op_instruksi_prwt_pasca_operasi);

      $model->setFinal();

      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => $save->data['lap_op_to_id'], 'subid' => $save->data['lap_op_id']]);
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
    $title = 'Updated ' . LaporanOperasi::ass_n;
    $model = $this->findModel($subid);
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->lap_op_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->lap_op_laporan = str_replace(["<<", ">>"], ["<", ">"], $model->lap_op_laporan);
      $model->lap_op_instruksi_prwt_pasca_operasi = str_replace(["<<", ">>"], ["<", ">"], $model->lap_op_instruksi_prwt_pasca_operasi);

      if ($model->validate()) {
        if ($model->lap_op_final && !$model->lap_op_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->lap_op_final && $model->lap_op_batal) {
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
    $title = 'Finalized ' . LaporanOperasi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->lap_op_final) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->lap_op_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      $model->lap_op_laporan = str_replace(["<<", ">>"], ["<", ">"], $model->lap_op_laporan);
      $model->lap_op_instruksi_prwt_pasca_operasi = str_replace(["<<", ">>"], ["<", ">"], $model->lap_op_instruksi_prwt_pasca_operasi);

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
    $title = 'Canceled ' . LaporanOperasi::ass_n;
    //init model
    $model = $this->findModel($subid);
    if (!$model->lap_op_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->lap_op_to_id);
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
    $title = 'Deleted ' . LaporanOperasi::ass_n;
    //init model
    $model = $this->findModel($subid);
    // if($model->lap_op_perawat_id!=Akun::user()->id){
    //     return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    // }
    if ($model->lap_op_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->lap_op_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => $save->data['lap_op_to_id']]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }
  protected function initModelCreate($id, $layanan = array())
  {
    $model = new LaporanOperasi();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['id' => $id])->asArray()->one();
    }

    $timoperasi = TimOperasi::find()
      ->where(['to_ok_pl_id' => $layanan['id'], 'to_deleted_at' => null])
      ->one();

    $intraoperasi = IntraOperasiPerawat::find()
      ->where(['iop_to_id' => $timoperasi->to_id])
      ->andWhere('iop_deleted_at is null')
      ->orderBy(['iop_created_at' => SORT_DESC])
      ->one();

    $kelas_rawat = Layanan::find()->joinWith([
      'kelasRawat'
    ])->where(['id' => $timoperasi->to_ruang_asal_pl_id])->asArray()->one();

    if (!empty($intraoperasi)) {
      $model->lap_op_jam_mulai = $intraoperasi->iop_jam_mulai_bedah;
      $model->lap_op_jam_selesai = $intraoperasi->iop_jam_selesai_bedah;

      $awal  = strtotime($intraoperasi->iop_jam_mulai_bedah); //waktu awal

      $akhir = strtotime($intraoperasi->iop_jam_selesai_bedah); //waktu akhir

      $diff  = $akhir - $awal;

      $jam   = floor($diff / (60 * 60));

      $menit = $diff - $jam * (60 * 60);
      if ($awal && $akhir) {
        if ($jam == '0') {
          $model->lap_op_lama_operasi   = floor($menit / 60) . ' Menit';
        } else {
          $model->lap_op_lama_operasi   = $jam . ' Jam ' . floor($menit / 60) . ' Menit';
        }
      } else {
        $model->lap_op_lama_operasi   = 'Silahkan lengkapi jam operasi!';
      }
    }

    $model->lap_op_kelas = $kelas_rawat['kelasRawat'] ? $kelas_rawat['kelasRawat']['nama'] : "";
    $model->lap_op_jenis_operasi = $timoperasi->to_jenis_operasi_cito; // == 0 ? "Elektif" : "Cyto";

    $model->lap_op_tanggal = $timoperasi->to_tanggal_operasi;

    $model->lap_op_ruangan = $timoperasi->unit->nama;
    $model->lap_op_diagnosis_pre_operasi = $timoperasi->to_diagnosa_medis_pra_bedah;
    $model->lap_op_diagnosis_pasca_operasi = $timoperasi->to_diagnosa_medis_pasca_bedah;
    $model->lap_op_nama_jenis_operasi = $timoperasi->to_tindakan_operasi;

    $model->lap_op_to_id = $timoperasi->to_id;
    $model->lap_op_jaringan_operasi_dikirim = 'Ya';
    $model->lap_op_final = 0;
    $model->lap_op_batal = 0;

    return $model;
  }
  protected function initModelUpdateAuto($to_id)
  {
    $query = LaporanOperasi::find()
      ->where(['lap_op_to_id' => $to_id])
      // ->andWhere(['!=', 'lap_op_batal', 1])
      ->andWhere([
        'or',
        ['lap_op_batal' => null],
        ['lap_op_batal' => 0],
      ])
      ->andWhere('lap_op_deleted_at is null')
      ->orderBy(['lap_op_created_at' => SORT_DESC]);

    if ((Akun::user()->username != Yii::$app->params['other']['username_root_bedah_sentral'])) {
      $query->andWhere(['lap_op_created_by' => Akun::user()->id]);
    }
    return $query->one();
  }
  protected function initModelUpdate($subid)
  {
    return LaporanOperasi::find()->where(['lap_op_id' => $subid])->andWhere('lap_op_deleted_at is null')->orderBy(['lap_op_created_at' => SORT_DESC])->one();
  }

  protected function findModel($id)
  {
    if (($model = LaporanOperasi::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
