<?php

namespace app\controllers;

use app\components\HelperGeneral;
use app\models\bedahsentral\LaporanOperasi;
use app\models\bedahsentral\TimOperasi;
use app\models\pendaftaran\Layanan;
use Mpdf\Mpdf;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\helpers\Url;

class CetakController extends Controller
{
  // public function behaviors()
  // {
  //   return [
  //     'access' => [
  //       'class' => AccessControl::className(),
  //       'rules' => [
  //         [
  //           'actions' => ['error'],
  //           'allow' => true,
  //         ],
  //         [
  //           'actions' => ['cetak-laporan-operasi'],
  //           'allow' => true,
  //           'roles' => ['@'],
  //         ],
  //       ],
  //     ],
  //     'verbs' => [
  //       'class' => VerbFilter::className(),
  //       'actions' => [
  //       ],
  //     ],
  //   ];
  // }
  public function actionCetakLaporanOperasi($laporan_id)
  {
    if (!is_numeric($laporan_id)) {
      $laporan_id = HelperGeneral::validateData($laporan_id);
    }

    $data_cetak =  $this->renderPartial('/laporan-operasi-pasien/doc', ['lap_op_id' => $laporan_id]);
    $pdf = new Mpdf(['tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf']);
    $pdf->AddPageByArray([
      'orientation' => 'P',
      'sheet-size' => 'LEGAL',
      'margin-top' => 10,
      'margin-right' => 15,
      'margin-left' => 15,
      'margin-bottom' => 10,
    ]);
    $pdf->simpleTables = true;
    $pdf->packTableData = true;
    $pdf->useSubstitutions = false;
    $pdf->autoPageBreak = true;
    $pdf->showImageErrors = true;
    $pdf->shrink_tables_to_fit = 1;
    $pdf->WriteHTML($data_cetak);
    $pdf->Output(date('d-m-Y H:i:s') . '.pdf', \Mpdf\Output\Destination::INLINE);
    exit();
  }

  public function actionCetakLaporanAnestesi($laporan_id)
  {
    if (!is_numeric($laporan_id)) {
      $laporan_id = HelperGeneral::validateData($laporan_id);
    }

    $data_cetak =  $this->renderPartial('/asesmen-pra-induksi-pasien/doc', ['api_id' => $laporan_id]);
    $pdf = new Mpdf(['tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf']);
    $pdf->AddPageByArray([
      'orientation' => 'P',
      'sheet-size' => 'LEGAL',
      'margin-top' => 10,
      'margin-right' => 10,
      'margin-left' => 10,
      'margin-bottom' => 10,
    ]);
    $pdf->simpleTables = true;
    $pdf->packTableData = true;
    $pdf->useSubstitutions = false;
    $pdf->autoPageBreak = true;
    $pdf->showImageErrors = true;
    $pdf->shrink_tables_to_fit = 1;
    $pdf->WriteHTML($data_cetak);
    $pdf->Output(date('d-m-Y H:i:s') . '.pdf', \Mpdf\Output\Destination::INLINE);
    exit();
  }

  public function actionCetakChecklistKeselamatan($checklist_id)
  {
    if (!is_numeric($checklist_id)) {
      $checklist_id = HelperGeneral::validateData($checklist_id);
    }

    $data_cetak =  $this->renderPartial('/check-list-keselamatan-ok-pasien/doc', ['pcok_id' => $checklist_id]);
    $pdf = new Mpdf(['tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf']);
    $pdf->AddPageByArray([
      'orientation' => 'P',
      'sheet-size' => 'LEGAL',
      'margin-top' => 10,
      'margin-right' => 10,
      'margin-left' => 10,
      'margin-bottom' => 10,
    ]);
    $pdf->simpleTables = true;
    $pdf->packTableData = true;
    $pdf->useSubstitutions = false;
    $pdf->autoPageBreak = true;
    $pdf->showImageErrors = true;
    $pdf->shrink_tables_to_fit = 1;
    $pdf->WriteHTML($data_cetak);
    $pdf->Output(date('d-m-Y H:i:s') . '.pdf', \Mpdf\Output\Destination::INLINE);
    exit();
  }

  public function actionCetakIntraOperasi($intra_id)
  {
    if (!is_numeric($intra_id)) {
      $intra_id = HelperGeneral::validateData($intra_id);
    }

    $data_cetak =  $this->renderPartial('/intra-operasi-perawat-pasien/doc', ['iop_id' => $intra_id]);
    $pdf = new Mpdf(['tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf']);
    $pdf->AddPageByArray([
      'orientation' => 'P',
      'sheet-size' => 'LEGAL',
      'margin-top' => 10,
      'margin-right' => 10,
      'margin-left' => 10,
      'margin-bottom' => 10,
    ]);
    $pdf->simpleTables = true;
    $pdf->packTableData = true;
    $pdf->useSubstitutions = false;
    $pdf->autoPageBreak = true;
    $pdf->showImageErrors = true;
    $pdf->shrink_tables_to_fit = 1;
    $pdf->WriteHTML($data_cetak);
    $pdf->Output(date('d-m-Y H:i:s') . '.pdf', \Mpdf\Output\Destination::INLINE);
    exit();
  }

  public function actionCetakPostOperasi($psop_id)
  {
    if (!is_numeric($psop_id)) {
      $psop_id = HelperGeneral::validateData($psop_id);
    }

    $data_cetak =  $this->renderPartial('/post-operasi-perawat-pasien/doc', ['psop_id' => $psop_id]);
    // print_r($data_cetak);die;
    $pdf = new Mpdf(['tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf']);
    $pdf->AddPageByArray([
      'orientation' => 'P',
      'sheet-size' => 'LEGAL',
      'margin-top' => 10,
      'margin-right' => 10,
      'margin-left' => 10,
      'margin-bottom' => 10,
    ]);
    $pdf->simpleTables = true;
    $pdf->packTableData = true;
    $pdf->useSubstitutions = false;
    $pdf->autoPageBreak = true;
    $pdf->showImageErrors = true;
    $pdf->shrink_tables_to_fit = 1;
    $pdf->WriteHTML($data_cetak);
    $pdf->Output(date('d-m-Y H:i:s') . '.pdf', \Mpdf\Output\Destination::INLINE);
    exit();
  }

  public function actionCetakJumlahKasa($pjki_id)
  {
    if (!is_numeric($pjki_id)) {
      $pjki_id = HelperGeneral::validateData($pjki_id);
    }

    $data_cetak =  $this->renderPartial('/penggunaan-jumlah-kasa-dan-instrumen-pasien/doc', ['pjki_id' => $pjki_id]);
    // print_r($data_cetak);die;
    $pdf = new Mpdf(['tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'mpdf']);
    $pdf->AddPageByArray([
      'orientation' => 'P',
      'sheet-size' => 'LEGAL',
      'margin-top' => 10,
      'margin-right' => 10,
      'margin-left' => 10,
      'margin-bottom' => 10,
    ]);
    $pdf->simpleTables = true;
    $pdf->packTableData = true;
    $pdf->useSubstitutions = false;
    $pdf->autoPageBreak = true;
    $pdf->showImageErrors = true;
    $pdf->shrink_tables_to_fit = 1;
    $pdf->WriteHTML($data_cetak);
    $pdf->Output(date('d-m-Y H:i:s') . '.pdf', \Mpdf\Output\Destination::INLINE);
    exit();
  }
}
