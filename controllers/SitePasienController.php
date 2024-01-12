<?php

namespace app\controllers;

use app\components\HelperGeneral;
use app\components\HelperSpesial;
use app\components\MakeResponse;
use app\models\medis\DocClinicalPasien;
use app\models\bedahsentral\Log;
use app\models\pendaftaran\Layanan;
use app\models\search\DocClinicalPasienSearch;
use Mpdf\Mpdf;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class SitePasienController extends Controller
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'rules' => [
          [
            'actions' => ['error'],
            'allow' => true,
          ],
          [
            'actions' => ['index', 'panggil-perawat', 'panggil-dokter', 'cp', 'rp', 'cetak-doc-clinical', 'preview-doc-clinical'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          // 'logout' => ['post'],
        ],
      ],
    ];
  }
  public function actionIndex($id)
  {
    // echo'<pre>';print_r('aaa');die();
    // echo'<pre>';print_r(Yii::$app->user->identity);die();
    // $id = Yii::$app->request->get('id');
    $chk_pasien = HelperSpesial::getCheckPasien($id);
    if (!$chk_pasien->status) {
      return \Yii::$app->response->redirect(Url::to(['/site/index/']));
    }
    $this->layout = 'main-pasien';
    // $mdcp = DocClinicalPasien::find()->select(['id_doc_clinical_pasien', 'manual', 'reg_kode', 'reg_tgl', 'pl_id', 'pl_tgl', 'unt_id', 'unt_nama', 'doc_clinical_id', 'doc_clinical_nama', 'created_at', 'batal', 'tgl_batal'])->where(['ps_kode' => $chk_pasien->data['registrasi']['pasien_kode']])->orderBy(['reg_tgl' => SORT_DESC, 'created_at' => SORT_DESC])->asArray()->all();

    $dataIndex = array();
    // foreach ($mdcp as $v) {
    //   if (!isset($dataIndex[strval($v['reg_kode'])])) {
    //     $dataIndex[strval($v['reg_kode'])] = array();
    //   }
    //   array_push($dataIndex[strval($v['reg_kode'])], $v);
    // }
    return $this->render('index', ['chk_pasien' => $chk_pasien->data, 'mdcp' => $dataIndex]);
  }

  public function actionPreviewDocClinical($id)
  {
    $mdcp = DocClinicalPasien::find()->where(['id_doc_clinical_pasien' => $id])->asArray()->one();
    if ($mdcp['data_type'] == DocClinicalPasien::data_type_html_base64) {
      $mdcp['data'] = base64_decode($mdcp['data']);
      return MakeResponse::create(true, 'Data Tersedia', $mdcp);
    }
    return MakeResponse::create(false, 'Data Tidak Ditemukan');
  }
  public function actionCetakDocClinical($id)
  {
    $mdcp = DocClinicalPasien::find()->where(['id_doc_clinical_pasien' => $id])->asArray()->one();
    if ($mdcp['data_type'] == DocClinicalPasien::data_type_html_base64) {
      $mdcp['data'] = base64_decode($mdcp['data']);
    }
    // $pdf = new Mpdf(['default_font' => 'Arial', 'default_font_size' => 7]);
    $pdf = new Mpdf(['tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf']);
    $pdf->AddPageByArray([
      'orientation' => 'P',
      'sheet-size' => 'LEGAL',
      'margin-top' => 2,
      'margin-right' => 5,
      'margin-left' => 5,
      'margin-bottom' => 5,
    ]);
    $pdf->simpleTables = true;
    $pdf->packTableData = true;
    $pdf->useSubstitutions = false;
    $pdf->autoPageBreak = true;
    $pdf->showImageErrors = true;
    $pdf->shrink_tables_to_fit = 1;
    $pdf->WriteHTML($mdcp['data']);
    $pdf->Output(date('d-m-Y H:i:s') . '.pdf', \Mpdf\Output\Destination::INLINE);
    exit();
  }
  public function actionPanggilPerawat($id = null)
  {
    $model = Layanan::findOne(HelperGeneral::validateData(Yii::$app->request->get('id')));
    if ($model) {
      $log['sebelum'] = $model->attr();
      $log_action = 'Updated Layanan > Panggil Pasien';
      if ($model->pl_dipanggil_perawat == null || $model->pl_dipanggil_perawat == 0) {
        $model->pl_dipanggil_perawat = 1;
        if ($model->save(false)) {
          $log['sesudah'] = $model->attr();
          Log::saveLog($log_action, $log);
          return MakeResponse::create(true, 'Panggilan Pasien Diproses');
        } else {
          return MakeResponse::create(false, 'Panggilan Pasien Tidak Dapat Diproses');
        }
      } else {
        return MakeResponse::create(false, 'Mohon Menunggu, Monitor Sedang Proses Pemanggilan');
      }
    }
    return MakeResponse::create(false, 'Pasien Tidak Ditemukan');
  }
  public function actionPanggilDokter($id = null)
  {
    $model = Layanan::findOne(HelperGeneral::validateData(Yii::$app->request->get('id')));
    if ($model) {
      $log['sebelum'] = $model->attr();
      $log_action = 'Updated Layanan > Panggil Pasien';
      if ($model->pl_dipanggil_dokter == null || $model->pl_dipanggil_dokter == 0) {
        $model->pl_dipanggil_dokter = 1;
        if ($model->save(false)) {
          $log['sesudah'] = $model->attr();
          Log::saveLog($log_action, $log);
          return MakeResponse::create(true, 'Panggilan Pasien Diproses');
        } else {
          return MakeResponse::create(false, 'Panggilan Pasien Tidak Dapat Diproses');
        }
      } else {
        return MakeResponse::create(false, 'Mohon Menunggu, Monitor Sedang Proses Pemanggilan');
      }
    }
    return MakeResponse::create(false, 'Pasien Tidak Ditemukan');
  }
  public function actionCp($ps_kode)
  {
    $this->layout   = "iframe";
    $searchModel = new DocClinicalPasienSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $ps_kode);
    return $this->render('cp', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }
}
