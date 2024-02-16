<?php

namespace app\controllers;

use app\components\HelperSpesial;
use app\models\bedahsentral\Log;
use app\models\bedahsentral\PembatalanOperasi;
use app\models\bedahsentral\TimOperasi;
use app\models\search\PembatalanOperasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * PembatalanOperasiController implements the CRUD actions for PembatalanOperasi model.
 */
class PembatalanOperasiController extends Controller
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
    $title = "Pembatalan Operasi";

    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      return $this->redirect(Url::to(['/site/index/']));
    }
    // Cek data pembatalan operasi apakah ada
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $id])->asArray()->one();
    $cek_apakah_sudah_ada = $this->initModelUpdateAuto($timoperasi['to_id']);
    // Jika ada
    if ($cek_apakah_sudah_ada) {
      $pembatalan = $this->initModelUpdate($cek_apakah_sudah_ada['bat_id']);

      $pembatalan->bat_alasan_pasien = json_decode($pembatalan->bat_alasan_pasien);
      $pembatalan->bat_alasan_operator = json_decode($pembatalan->bat_alasan_operator);
      $pembatalan->bat_alasan_faskamop = json_decode($pembatalan->bat_alasan_faskamop);
      $pembatalan->bat_alasan_ruang_perawatan = json_decode($pembatalan->bat_alasan_ruang_perawatan);
    } else {
      $pembatalan = $this->initModelCreate($id);

      $pembatalan->bat_to_id = $timoperasi['to_id'];
      $pembatalan->bat_tindakan = $timoperasi['to_tindakan_operasi'];
      $pembatalan->bat_diagnosa = $timoperasi['to_diagnosa_medis_pra_bedah'];
    }

    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'title' => $title,
        'model' => $pembatalan,
        'chk_pasien' => $chk_pasien->data,
        'timoperasi' => $timoperasi
      ]);
    } else {
      $this->layout = 'main-pasien';
      return $this->render('index', [
        'title' => $title,
        'model' => $pembatalan,
        'chk_pasien' => $chk_pasien->data,
        'timoperasi' => $timoperasi
      ]);
    }
  }

  protected function initModelUpdate($subid)
  {
    return PembatalanOperasi::find()
      ->where(['bat_id' => $subid])
      ->andWhere('bat_deleted_at is null')
      ->orderBy(['bat_created_at' => SORT_DESC])->one();
  }

  protected function initModelCreate($id)
  {
    $model = new PembatalanOperasi();

    $model->bat_tanggal_tunda = date("Y-m-d");
    $model->bat_final = 0;
    $model->bat_batal = 0;

    return $model;
  }

  protected function initModelUpdateAuto($to_id)
  {
    $query = PembatalanOperasi::find()
      ->where(['bat_to_id' => $to_id])
      ->andWhere(['!=', 'bat_batal', 1])
      ->andWhere('bat_deleted_at is null')
      ->orderBy(['bat_created_at' => SORT_DESC]);

    return $query->asArray()->one();
  }

  public function actionSimpan($id = null)
  {
    $data = $this->request->post();

    $log = array();
    if (!empty($id)) {
      $model = $this->findModel($id);
      $log['deskripsi'] = 'Updated Pembatalan Operasi';
      $log['before'] = $model->attr();
      $log['type'] = Log::TYPE_UPDATE;
    } else {
      $model = new PembatalanOperasi();
      $log['deskripsi'] = 'Created Pembatalan Operasi';
      $log['before'] = $model->attr();
      $log['type'] = Log::TYPE_CREATE;
    }

    if ($model->load($data)) {
      $model->bat_alasan_pasien = json_encode($model->bat_alasan_pasien);
      $model->bat_alasan_operator = json_encode($model->bat_alasan_operator);
      $model->bat_alasan_faskamop = json_encode($model->bat_alasan_faskamop);
      $model->bat_alasan_ruang_perawatan = json_encode($model->bat_alasan_ruang_perawatan);

      if ($model->save(false)) {
        $log['after'] = $model->attr();
        Log::saveLog($log);

        $resp['status'] = true;
        $resp['desc'] = 'Data Berhasil disimpan';
        $resp['id_layanan'] = $model->timoperasi->to_ok_pl_id;
      } else {
        $resp['status'] = false;
        $resp['desc'] = 'Data Gagal disimpan';
        $resp['id_layanan'] = $model->timoperasi->to_ok_pl_id;
      }
      echo json_encode($resp);
    }
  }

  public function actionHapus($id)
  {
    $model = $this->findModel($id);

    if ($model) {
      $model->setDelete();
      $model->save();

      $resp['status'] = true;
      $resp['desc'] = "Berhasil menghapus data";
    } else {
      $resp['status'] = false;
      $resp['desc'] = "Gagal menghapus data";
    }

    echo json_encode($resp);
  }

  protected function findModel($bat_id)
  {
    if (($model = PembatalanOperasi::findOne(['bat_id' => $bat_id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
