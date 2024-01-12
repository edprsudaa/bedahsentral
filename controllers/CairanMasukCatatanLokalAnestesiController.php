<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\CairanMasukCatatanLokalAnestesi;
use app\models\search\CairanMasukCatatanLokalAnestesiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CairanMasukCatatanLokalAnestesiController implements the CRUD actions for CairanMasukCatatanLokalAnestesi model.
 */
class CairanMasukCatatanLokalAnestesiController extends Controller
{
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
     * Lists all CairanMasukCatatanLokalAnestesi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CairanMasukCatatanLokalAnestesiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CairanMasukCatatanLokalAnestesi model.
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
     * Creates a new CairanMasukCatatanLokalAnestesi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CairanMasukCatatanLokalAnestesi();

        $model->mmcl_cla_id = Yii::$app->request->post('id_intra');
        $model->mmcl_cairan_nama = Yii::$app->request->post('nama');
        $model->mmcl_jumlah = Yii::$app->request->post('jumlah');
        $model->mmcl_waktu = Yii::$app->request->post('waktu');
        $model->save();
        return json_encode([
            'code' => 1,
            'desc' => "Berhasil"
        ]);
    }

    /**
     * Updates an existing CairanMasukCatatanLokalAnestesi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->mmcl_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CairanMasukCatatanLokalAnestesi model.
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
     * Finds the CairanMasukCatatanLokalAnestesi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CairanMasukCatatanLokalAnestesi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CairanMasukCatatanLokalAnestesi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
