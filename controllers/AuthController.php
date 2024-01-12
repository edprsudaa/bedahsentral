<?php

namespace app\controllers;

use app\components\Akun;
use Yii;
use app\models\sso\LoginForm;
use app\models\sso\User;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\components\Helper;
use app\components\MakeResponse;
use app\models\bedahsentral\Log;
use yii\helpers\ArrayHelper;

class AuthController extends Controller
{
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'rules' => [
          [
            'actions' => ['login', 'login-do'],
            'allow' => true,
            'roles' => ['?', '@'],
          ],
          [
            'actions' => ['logout', 'akun-form', 'akun-update'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'login' => ['get', 'post'],
          'login-do' => ['post'],
          'logout' => ['post'],
        ],
      ],
    ];
  }
  public function beforeAction($action)
  {
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
  }
  public function actionLogin()
  {
    $this->layout = "login";
    if (!Yii::$app->user->isGuest) {
      return $this->goHome();
    }
    $model = new LoginForm();
    return $this->render('login', [
      'model' => $model,
    ]);
  }
  function actionLoginDo()
  {
    $req = Yii::$app->request;
    if ($req->isAjax) {
      $model = new LoginForm();
      if ($model->load(Yii::$app->request->post()) && $model->login()) {
        // $akses_unit_list = Akun::akses_unit_login();
        // \Yii::$app->session->set('sso.akses_unit', $akses_unit_list);
        $log = array();
        $log['type'] = Log::TYPE_READ;
        $log['before'] = [];
        $log['after'] = [];
        $log['deskripsi'] = 'Login';
        Log::saveLog($log);
        return MakeResponse::create(true);
      } else {
        return MakeResponse::create(false, $model->errors);
      }
    }
  }
  public function actionLogout()
  {
    //LOG LOGOUT
    Yii::$app->user->logout();
    // return $this->redirect(['auth/login']);
    return $this->goHome();
  }
  function actionAkunForm()
  {
    $model = User::findOne(Akun::user()->id);
    $model->scenario = "akun_update";
    $model->pgw_password_hash = NULL;
    return $this->render('akun_form', [
      'model' => $model,
    ]);
  }
  // function actionAkunUpdate()
  // {
  //     $req=Yii::$app->request;
  //     if($req->isAjax){
  //         $model=User::findOne(Akun::user()->id);
  //         $log=array();
  //         $log['type']=Log::TYPE_UPDATE;
  //         $log['before']=$model->attr();
  //         $log['deskripsi']='Updated Akun';
  //         $oldpass=$model->pgw_password_hash;
  //         $model->scenario="akun_update";
  //         $model->load($req->post());
  //         if($model->pgw_password_hash!=NULL){
  //             $model->pgw_password_hash=Yii::$app->getSecurity()->generatePasswordHash($model->pgw_password_hash);
  //         }else{
  //             $model->pgw_password_hash=$oldpass;
  //         }
  //         if($model->validate()){
  //             if($model->save(false)){
  //                 $log['after']=$model->attr();
  //                 Log::saveLog($log);
  //                 return MakeResponse::create(true,'Update akun berhasil diupdate');
  //             }else{
  //                 return MakeResponse::create(false,'Update akun gagal, silahkan periksa kembali form isian');
  //             }
  //         }else{
  //             return MakeResponse::create(false,$model->errors);
  //         }
  //     }
  // }
}
