<?php

namespace app\controllers;

use app\models\bedahsentral\JabatanOperasi;
use app\models\search\JabatanOperasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JabatanOperasiController implements the CRUD actions for JabatanOperasi model.
 */
class JabatanOperasiController extends Controller
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
     * Lists all JabatanOperasi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new JabatanOperasiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JabatanOperasi model.
     * @param int $jo_id Jo ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($jo_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($jo_id),
        ]);
    }

    /**
     * Creates a new JabatanOperasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new JabatanOperasi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'jo_id' => $model->jo_id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing JabatanOperasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $jo_id Jo ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($jo_id)
    {
        $model = $this->findModel($jo_id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'jo_id' => $model->jo_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing JabatanOperasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $jo_id Jo ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($jo_id)
    {
        $this->findModel($jo_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JabatanOperasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $jo_id Jo ID
     * @return JabatanOperasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($jo_id)
    {
        if (($model = JabatanOperasi::findOne(['jo_id' => $jo_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
