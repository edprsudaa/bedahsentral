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
class CpptController extends Controller
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
    // $chk_pasien = HelperSpesial::getCheckPasien($plid);
    $timoperasi = TimOperasi::find()->where(['to_ok_pl_id' => $plid])->one();
    $idhash = HelperGeneral::hashData($timoperasi->to_ruang_asal_pl_id);
    // echo '<pre>';
    // print_r($idhash);
    // die;
    if ($id) {
      return header('Location: http://medis.simrs.aa/pasien-cppt?id=' . HelperGeneral::hashData($plid) . '');
      // return Url::to(['http://medis.simrs.aa/pasien-cppt?id=' . $id . '']);
    }
  }
}
