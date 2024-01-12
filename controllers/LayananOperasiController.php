<?php

namespace app\controllers;

use app\models\pendaftaran\Layanan;
use app\models\search\LayananOperasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LayananOperasiController implements the CRUD actions for Layanan model.
 */
class LayananOperasiController extends Controller
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

  /**
   * Lists all Layanan models.
   *
   * @return string
   */
  public function actionIndex()
  {
    $searchModel = new LayananOperasiSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);

    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionRuanganLainnya()
  {
    $searchModel = new LayananOperasiSearch();
    $dataProvider = $searchModel->search2($this->request->queryParams);

    return $this->render('pasien_ruang_lainnya', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }

  public function actionPasienSelesaiOperasi()
  {
    $searchModel = new LayananOperasiSearch();
    $dataProvider = $searchModel->search($this->request->queryParams, 1);

    return $this->render('pasien_pulang', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }
  public function actionPasienOperasi($kamar)
  {
    $searchModel = new LayananOperasiSearch();
    $dataProvider = $searchModel->search($this->request->queryParams, $kamar);

    return $this->render('pasien_operasi', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }
  public function actionView($id)
  {
    return $this->render('view', [
      'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new Layanan model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return string|\yii\web\Response
   */
  public function actionCreate()
  {
    $model = new Layanan();

    if ($this->request->isPost) {
      if ($model->load($this->request->post()) && $model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    } else {
      $model->loadDefaultValues();
    }

    return $this->render('create', [
      'model' => $model,
    ]);
  }

  /**
   * Updates an existing Layanan model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param int $id id
   * @return string|\yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
      'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Layanan model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param int $id id
   * @return \yii\web\Response
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
   * Finds the Layanan model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param int $id id
   * @return Layanan the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Layanan::findOne(['id' => $id])) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
