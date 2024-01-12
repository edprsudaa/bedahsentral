<?php

namespace app\controllers;

use app\components\HelperGeneral;
use app\components\HelperSpesial;
use app\models\bedahsentral\TimOperasi;
use app\models\pendaftaran\Layanan;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * AskanIntraAnestesiController implements the CRUD actions for AskanIntraAnestesi model.
 */
class HasilPemeriksaanController extends Controller
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

  public function actionLabPatologiAnatomi($id)
  {
    $plid = HelperGeneral::convertLayananId($id);
    $chk_pasien = HelperSpesial::getCheckPasien($plid);
    $norm = $chk_pasien->data['registrasi']['pasien']['kode'];

    if ($id) {
      return header('Location: http://emr-penunjang.simrs.aa/hasil/expertise-lab-pa?jenis=a&rm=' . $norm);
    }
  }

  public function actionLabPatologiKlinik($id)
  {
    $plid = HelperGeneral::convertLayananId($id);
    $chk_pasien = HelperSpesial::getCheckPasien($plid);
    $norm = $chk_pasien->data['registrasi']['pasien']['kode'];

    if ($id) {
      return header('Location: http://emr-penunjang.simrs.aa/hasil/expertise-lab-pk?jenis=a&rm=' . $norm);
    }
  }

  public function actionRadiologi($id)
  {
    $plid = HelperGeneral::convertLayananId($id);
    $chk_pasien = HelperSpesial::getCheckPasien($plid);
    $norm = $chk_pasien->data['registrasi']['pasien']['kode'];

    if ($id) {
      return header('Location: http://emr-penunjang.simrs.aa/hasil/expertise-radiologi?jenis=a&rm=' . $norm);
    }
  }

  public function actionBiomolekuler($id)
  {
    $plid = HelperGeneral::convertLayananId($id);
    $chk_pasien = HelperSpesial::getCheckPasien($plid);
    $norm = $chk_pasien->data['registrasi']['pasien']['kode'];

    if ($id) {
      return header('Location: http://emr-penunjang.simrs.aa/hasil/expertise-lab-biomolekuler?jenis=a&rm=' . $norm);
    }
  }

  public function actionLabPcr($id)
  {
    $plid = HelperGeneral::convertLayananId($id);
    $chk_pasien = HelperSpesial::getCheckPasien($plid);
    $norm = $chk_pasien->data['registrasi']['pasien']['kode'];

    if ($id) {
      return header('Location: http://emr-penunjang.simrs.aa/hasil/expertise-pcr?jenis=a&rm=' . $norm);
    }
  }

  public function actionEkokardiografi($id)
  {
    $plid = HelperGeneral::convertLayananId($id);
    $chk_pasien = HelperSpesial::getCheckPasien($plid);
    $norm = $chk_pasien->data['registrasi']['pasien']['kode'];

    if ($id) {
      return header('Location: http://emr-penunjang.simrs.aa/hasil/expertise-echo?jenis=a&rm=' . $norm);
    }
  }
}
