<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\TimOperasiDetail;
use app\models\search\TimOperasiDetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimOperasiDetailController implements the CRUD actions for TimOperasiDetail model.
 */
class TimOperasiDetailController extends Controller
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
     * Lists all TimOperasiDetail models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TimOperasiDetailSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TimOperasiDetail model.
     * @param int $tod_id Tod ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tod_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($tod_id),
        ]);
    }

    /**
     * Creates a new TimOperasiDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TimOperasiDetail();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'tod_id' => $model->tod_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TimOperasiDetail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $tod_id Tod ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tod_id)
    {
        $model = $this->findModel($tod_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'tod_id' => $model->tod_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TimOperasiDetail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $tod_id Tod ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tod_id)
    {
        $this->findModel($tod_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TimOperasiDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $tod_id Tod ID
     * @return TimOperasiDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tod_id)
    {
        if (($model = TimOperasiDetail::findOne(['tod_id' => $tod_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
