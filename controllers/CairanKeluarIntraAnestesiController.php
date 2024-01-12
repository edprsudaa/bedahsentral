<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\CairanKeluarIntraAnestesi;
use app\models\search\CairanKeluarIntraAnestesiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CairanKeluarIntraAnestesiController implements the CRUD actions for CairanKeluarIntraAnestesi model.
 */
class CairanKeluarIntraAnestesiController extends Controller
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
     * Lists all CairanKeluarIntraAnestesi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CairanKeluarIntraAnestesiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CairanKeluarIntraAnestesi model.
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
     * Creates a new CairanKeluarIntraAnestesi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CairanKeluarIntraAnestesi();

        $model->ckeluar_intra_operasi_mia_id = Yii::$app->request->post('id_intra_keluar');
        $model->ckeluar_cairan_nama = Yii::$app->request->post('keluar_nama');
        $model->ckeluar_jumlah = Yii::$app->request->post('keluar_jumlah');
        $model->ckeluar_waktu = Yii::$app->request->post('keluar_waktu');
        $model->save();
        return json_encode([
            'code' => 1,
            'desc' => "Berhasil"
        ]);
    }

    /**
     * Updates an existing CairanKeluarIntraAnestesi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ckeluar_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CairanKeluarIntraAnestesi model.
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
     * Finds the CairanKeluarIntraAnestesi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CairanKeluarIntraAnestesi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CairanKeluarIntraAnestesi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
