<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\TtvPostAnestesi;
use app\models\search\TtvPostAnestesiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TtvPostAnestesiController implements the CRUD actions for TtvPostAnestesi model.
 */
class TtvPostAnestesiController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TtvPostAnestesi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TtvPostAnestesiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TtvPostAnestesi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TtvPostAnestesi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TtvPostAnestesi();

        $model->ttvp_post_anestesi_mpa_id = Yii::$app->request->post("id_post");
        $model->ttvp_tek_darah_sistole = Yii::$app->request->post("sistole");
        $model->ttvp_tek_darah_diastole = Yii::$app->request->post("diastole");
        $model->ttvp_nadi = Yii::$app->request->post("nadi");
        $model->ttvp_nyeri_metode = Yii::$app->request->post("metode");
        $model->ttvp_nyeri_skor = Yii::$app->request->post("skor");
        $model->ttvp_waktu = Yii::$app->request->post("waktu");
        if($model->save()){
            return json_encode([
                'code' => 1,
                'desc' => 'Berhasil'
            ]);
        }else{
            return json_encode([
                'code' => 0,
                'desc' => $model->getErrors()
            ]);
        }
        
    }

    /**
     * Updates an existing TtvPostAnestesi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ttvp_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TtvPostAnestesi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TtvPostAnestesi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TtvPostAnestesi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TtvPostAnestesi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
