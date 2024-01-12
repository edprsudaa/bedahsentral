<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\TtvIntraAnestesi;
use app\models\search\TtvIntraAnestesiSearch;
use yii\web\Controller;
use app\components\Akun;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TtvIntraAnestesiController implements the CRUD actions for TtvIntraAnestesi model.
 */
class TtvIntraAnestesiController extends Controller
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
     * Lists all TtvIntraAnestesi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TtvIntraAnestesiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TtvIntraAnestesi model.
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
     * Creates a new TtvIntraAnestesi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TtvIntraAnestesi();
        $model->ttva_intra_operasi_mia_id = Yii::$app->request->post('id_intra');
        $model->ttva_nadi = Yii::$app->request->post('nadi');
        $model->ttva_pernafasan = Yii::$app->request->post('nafas');
        $model->ttva_tek_darah_sistole = Yii::$app->request->post('sistole');
        $model->ttva_tek_darah_diastole = Yii::$app->request->post('diastole');
        $model->ttva_waktu = Yii::$app->request->post('waktu');
        $model->ttva_created_by = Akun::user()->id;
        $valid = $model->validate();
        $model->save();
        return json_encode([
            'code' => 1,
            'desc' => 'Berhasil'
        ]);
        
    }

    public function actionGetdata()
    {
        $model = TtvIntraAnestesi::find()->all();
        foreach($model as $val){
            $temp[] = [
                'waktu' => $val->ttva_waktu,
                'nadi' => $val->ttva_nadi,
                'nafas' => $val->ttva_pernafasan,
                'sistole' => $val->ttva_tek_darah_sistole,
                'diastole' => $val->ttva_tek_darah_diastole
            ];
        }
        return json_encode($temp);
    }

    /**
     * Updates an existing TtvIntraAnestesi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ttva_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TtvIntraAnestesi model.
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
     * Finds the TtvIntraAnestesi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TtvIntraAnestesi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TtvIntraAnestesi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
