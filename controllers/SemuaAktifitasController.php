<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\Log;
use app\models\search\SemuaAktifitasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SemuaAktifitasMedisController implements the CRUD actions for Log model.
 */
class SemuaAktifitasController extends Controller
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
          // 'delete' => ['POST'],
        ],
      ],
    ];
  }

  /**
   * Lists all Log models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new SemuaAktifitasSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }
  /**
   * Finds the Log model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Log the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Log::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
