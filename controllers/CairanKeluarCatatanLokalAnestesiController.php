<?php

namespace app\controllers;

use Yii;
use app\models\bedahsentral\CairanKeluarCatatanLokalAnestesi;
use app\models\search\CairanKeluarCatatanLokalAnestesiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CairanKeluarCatatanLokalAnestesiController implements the CRUD actions for CairanKeluarCatatanLokalAnestesi model.
 */
class CairanKeluarCatatanLokalAnestesiController extends Controller
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
     * Lists all CairanKeluarCatatanLokalAnestesi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CairanKeluarCatatanLokalAnestesiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CairanKeluarCatatanLokalAnestesi model.
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
     * Creates a new CairanKeluarCatatanLokalAnestesi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CairanKeluarCatatanLokalAnestesi();

        $model->kmcl_cla_id = Yii::$app->request->post('id_intra_keluar');
        $model->kmcl_cairan_nama = Yii::$app->request->post('keluar_nama');
        $model->kmcl_jumlah = Yii::$app->request->post('keluar_jumlah');
        $model->kmcl_waktu = Yii::$app->request->post('keluar_waktu');
        $model->save();
        return json_encode([
            'code' => 1,
            'desc' => "Berhasil"
        ]);
    }

    /**
     * Updates an existing CairanKeluarCatatanLokalAnestesi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->kmcl_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CairanKeluarCatatanLokalAnestesi model.
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
     * Finds the CairanKeluarCatatanLokalAnestesi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CairanKeluarCatatanLokalAnestesi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CairanKeluarCatatanLokalAnestesi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
