<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\SerahTerimaRuangan;
use app\models\search\SerahTerimaRuanganSearch;
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
use app\components\mdcp\MdcpSerahTerimaRuangan;
use app\models\bedahsentral\Log;
// use app\models\sdm\Suku;
// use app\models\sdm\Agama;
use app\models\pendaftaran\Layanan;
use app\components\Akun;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;

/**
 * SerahTerimaRuanganController implements the CRUD actions for SerahTerimaRuangan model.
 */
class SerahTerimaRuanganPasienController extends Controller
{
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
  public function actionIndex($id)
  {
    $plid = HelperGeneral::convertLayananId($id);

    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $plid])->one();
    $model = $this->initModelUpdateAuto($timoperasi->to_id);

    if ($model) {
      return $this->redirect(Url::to(['/serah-terima-ruangan-pasien/update/', 'id' => $id, 'subid' => $model->mstr_id]));
    } else {
      return $this->redirect(Url::to(['/serah-terima-ruangan-pasien/create/', 'id' => $timoperasi->to_ok_pl_id]));
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
    $title = SerahTerimaRuangan::ass_n;
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
    $title = SerahTerimaRuangan::ass_n;
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
    $transaction = SerahTerimaRuangan::getDb()->beginTransaction();
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
      //     $data = \Yii::$app->controller->renderPartial('doc', ['mstr_id' => $model->mstr_id]);
      //     $mdcp_base = MdcpBase::getLayanan($model->timoperasi->to_ok_pl_id);
      //     $mdcp = MdcpSerahTerimaRuangan::_set($model->mstr_id, $mdcp_base, [], $data, $batal);
      //     if (!($s_flag = $mdcp->status)) {
      //       $m_flag = $mdcp->msg;
      //     }
      //   }
      // }
      //cek finalisasi save
      if ($s_flag) {
        $transaction->commit();
        return MakeResponse::createNotJson(true, $m_flag, ['mstr_to_id' => $model->timoperasi->to_ok_pl_id, 'mstr_id' => $model->mstr_id]);
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
    $title = 'Created ' . SerahTerimaRuangan::ass_n;
    //cek simpan draf/final
    //init model
    $model = new SerahTerimaRuangan();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mstr_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      if ($model->validate()) {
        if ($model->mstr_final) {
          return MakeResponse::create(true, '', ['konfirm_final' => true]);
        }
        $save = $this->save($title, $modelLog, $model, []);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['konfirm_final' => false, 'id' => HelperGeneral::hashData($save->data['mstr_to_id']), 'subid' => $save->data['mstr_id']]);
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
    $title = 'Finalized ' . SerahTerimaRuangan::ass_n;
    //init model
    $model = new SerahTerimaRuangan();
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_CREATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mstr_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }

    if ($model->load(Yii::$app->request->post())) {
      $model->setFinal();
      if ($model->validate()) {
        $save = $this->save($title, $modelLog, $model, [], true, false, false);
        if ($save->status) {
          return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['mstr_to_id']), 'subid' => $save->data['mstr_id']]);
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
    $title = 'Updated ' . SerahTerimaRuangan::ass_n;
    //cek simpan draf/final/batalkan
    //init model order penunjang
    $model = $this->findModel($subid);
    if ($model->mstr_perawat_penerima_pgw_id != Akun::user()->id) {
      return MakeResponse::create(false, 'Data Tidak Dapat Kelola');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mstr_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    if ($model->load(Yii::$app->request->post())) {
      if ($model->validate()) {
        if ($model->mstr_final && !$model->mstr_batal) {
          return MakeResponse::create(true, '', ['konfirm_final' => true, 'konfirm_batal' => false]);
        } else if ($model->mstr_final && $model->mstr_batal) {
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
    $title = 'Finalized ' . SerahTerimaRuangan::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->mstr_final) {
      return MakeResponse::create(false, 'Data Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());

    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mstr_to_id);
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
    $title = 'Canceled ' . SerahTerimaRuangan::ass_n;
    //init model
    $model = $this->findModel($subid);
    if (!$model->mstr_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dibatalkan');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mstr_to_id);
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
    $title = 'Deleted ' . SerahTerimaRuangan::ass_n;
    //init model
    $model = $this->findModel($subid);
    if ($model->mstr_perawat_penerima_pgw_id != Akun::user()->id) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Anda Bukan Pembuat');
    }
    if ($model->mstr_final) {
      return MakeResponse::create(false, 'Data Tidak Dapat Dihapus, Karna Sudah Simpan Final');
    }
    //init model log 
    $modelLog = new Log();
    $modelLog->mlog_type = Log::TYPE_UPDATE;
    $modelLog->mlog_deskripsi = $title;
    $modelLog->mlog_data_before = json_encode($model->attr());
    //cek allow crud data
    $chk_allow = HelperSpesial::checkAllowCRUDbyLayanan($model->mstr_to_id);
    if (!$chk_allow->status) {
      return MakeResponse::create(false, $chk_allow->msg);
    }
    $model->setDelete();
    if ($model->validate()) {
      $save = $this->save($title, $modelLog, $model, [], false, false, true);
      if ($save->status) {
        return MakeResponse::create(true, $save->msg, ['id' => HelperGeneral::hashData($save->data['mstr_to_id'])]);
      } else {
        return MakeResponse::create(false, $save->msg);
      }
    } else {
      return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
    }
  }
  protected function initModelCreate($id, $layanan = array())
  {
    $model = new SerahTerimaRuangan();
    if (!$layanan) {
      if (!is_numeric($id)) {
        $id = HelperGeneral::validateData($id);
      }
      $layanan = Layanan::find()->where(['pl_id' => $id])->asArray()->one();
    }
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $layanan['id']])->one();
    $model->mstr_to_id = $timoperasi->to_id;
    $model->mstr_final = 1;
    $model->mstr_batal = 0;

    $model->mstr_ruangan_asal = $timoperasi->layanan->unit->nama;
    $model->mstr_pindah_keruangan = $timoperasi->unit->nama;
    //$model->mstr_tgl_masuk_ruangan = Date("mm/dd/yyyy");

    //HelperGeneral::convertLayananId(5e186da4e7bd37d1a5347da174ea0be678631d78e7ab9bb76e71504d70b445dc93);


    $model->mstr_perawat_penerima_pgw_id = Akun::user()->id;
    $model->mstr_diagnosis_sekarang = $timoperasi->to_diagnosa_medis_pra_bedah;
    $model->mstr_alat_transfer_pasien = 'Kursi Roda';
    $model->mstr_keadaan_umum = 'Baik';
    $model->mstr_tingkat_kesadaran = 'composis mentis';
    $model->mstr_nyeri_kualitas = 'Tumpul';
    $model->mstr_nyeri_kategori = 'Tidak Nyeri';
    $model->mstr_nyeri_metode = 'VAS';
    $model->mstr_nyeri_frekuensi = 'Jarang';
    $model->mstr_resiko_jatuh_kategori = 'Tidak Beresiko';
    $model->mstr_resiko_jatuh_metode = 'HUMPTY DUMPTY';
    $model->mstr_dekubitus = 'Tidak';
    $model->mstr_diet = 'MB';
    $model->mstr_mobilisasi = 'Jalan';
    $model->mstr_ambulasi = 'Mandiri';
    return $model;
  }
  protected function initModelUpdateAuto($to_id)
  {
    $model = SerahTerimaRuangan::find()->where(['mstr_to_id' => $to_id, 'mstr_perawat_penerima_pgw_id' => Akun::user()->id])->orderBy(['mstr_created_at' => SORT_DESC])->one();
    return $model;
  }
  protected function initModelUpdate($subid)
  {
    return SerahTerimaRuangan::find()->where(['mstr_id' => $subid])->notDeleted()->orderBy(['mstr_created_at' => SORT_DESC])->one();
  }
  protected function findModel($id)
  {
    if (($model = SerahTerimaRuangan::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
