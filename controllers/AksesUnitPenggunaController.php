<?php

namespace app\controllers;

use Yii;
use app\models\sso\AksesUnit;
use app\models\search\AksesUnitPenggunaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\MakeResponse;
use app\models\bedahsentral\Log;

/**
 * AksesUnitPenggunaController implements the CRUD actions for AksesUnit model.
 */
class AksesUnitPenggunaController extends Controller
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
   * Lists all AksesUnit models.
   * @return mixed
   */
  public function actionIndex()
  {
    $searchModel = new AksesUnitPenggunaSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $model = new AksesUnit();
    $model->tanggal_aktif = 1;
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'model' => $model
      ]);
    } else {
      return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'model' => $model
      ]);
    }
  }

  /**
   * Displays a single AksesUnit model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('view', [
        'model' => $this->findModel($id),
      ]);
    } else {
      return $this->render('view', [
        'model' => $this->findModel($id),
      ]);
    }
  }

  /**
   * Creates a new AksesUnit model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new AksesUnit();
    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('create', [
        'model' => $model,
      ]);
    } else {
      return $this->render('create', [
        'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing AksesUnit model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if (\Yii::$app->request->isAjax) {
      return $this->renderAjax('update', [
        'model' => $model,
      ]);
    } else {
      return $this->render('update', [
        'model' => $model,
      ]);
    }
  }
  public function actionSave($id = null)
  {
    $model = new AksesUnit();
    $log = array();
    $log['type'] = Log::TYPE_CREATE;
    $log['before'] = $model->attr();
    $log['deskripsi'] = 'Created Akses Unit Pengguna';
    if (!empty($id)) {
      $model = $this->findModel($id);
      $log['before'] = $model->attr();
      $log['type'] = Log::TYPE_UPDATE;
      $log['deskripsi'] = 'Updated Akses Unit Pengguna';
    }
    if ($model->load(Yii::$app->request->post())) {
      if ($model->save(false)) {
        $log['after'] = $model->attr();
        Log::saveLog($log);
        return MakeResponse::create(true, 'Data Berhasil Disimpan');
      } else {
        return MakeResponse::create(false, 'Data Gagal Disimpan', $model->errors);
      }
    }
  }
  public function actionDelete($id)
  {
    $model = $this->findModel($id);
    $log = array();
    $log['type'] = Log::TYPE_DELETE;
    $log['before'] = $model->attr();
    $model->setDelete();
    if ($model->save(false)) {
      $log['after'] = $model->attr();
      $log['deskripsi'] = 'Deleted Akses Unit Pengguna';
      Log::saveLog($log);
      return MakeResponse::create(true, 'Data Berhasil Dihapus');
    } else {
      return MakeResponse::create(false, 'Data Gagal Dihapus');
    }
  }

  /**
   * Finds the AksesUnit model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return AksesUnit the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = AksesUnit::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
