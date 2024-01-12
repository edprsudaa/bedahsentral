<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\MedikasiIntraAnestesi;
use app\models\search\MedikasiIntraAnestesiSearch;
use yii\web\Controller;
use app\components\Akun;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\bedahsentral\IntraAnestesi;
/**
 * MedikasiIntraAnestesiController implements the CRUD actions for MedikasiIntraAnestesi model.
 */
class MedikasiIntraAnestesiController extends Controller
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
     * Lists all MedikasiIntraAnestesi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MedikasiIntraAnestesiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MedikasiIntraAnestesi model.
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
     * Creates a new MedikasiIntraAnestesi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new MedikasiIntraAnestesi();
        $model->mmia_intra_anestesi_mia_id = Yii::$app->request->post('intra_id');
        $model->mmia_nama_obat = Yii::$app->request->post('nama');
        $model->mmia_waktu = Yii::$app->request->post('jam');
        $model->mmia_created_by = Akun::user()->id;
        $simpan = $model->save();
        if($simpan){
            return json_encode([
                'code' => 200,
                'desc' => 'Berhasil'
            ]);
        }else{
            return json_encode([
                'code' => 400,
                'desc' => $model->getErrors()
            ]);
        }
        
    }

    /**
     * Updates an existing MedikasiIntraAnestesi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->mmia_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing MedikasiIntraAnestesi model.
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
     * Finds the MedikasiIntraAnestesi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MedikasiIntraAnestesi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MedikasiIntraAnestesi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
