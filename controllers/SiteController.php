<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

//TESTING LZString
use LZCompressor\LZString as LZString;

class SiteController extends Controller
{

  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'rules' => [
          [
            'allow' => true,
            'roles' => ['@'],
          ]
        ],
        'denyCallback' => function ($rule, $action) {
          $url = Yii::$app->urlManager->createUrl('auth/login');
          return $this->redirect($url);
        }
      ],
      'verbs' => [
        'class' => VerbFilter::className(),
        'actions' => [
          'index' => ['get', 'post'],
          'logout' => ['post'],
        ],
      ],
    ];
    // return [
    //   'access' => [
    //     'class' => AccessControl::className(),
    //     'rules' => [
    //       [
    //         'actions' => ['logout', 'index'],
    //         'allow' => true,
    //         'roles' => ['@'],
    //       ]
    //     ],
    //   ],
    // ];
  }

  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }

  public function actionIndex()
  {

    return $this->render('index');
  }

  // public function actionKembali()
  // {
  //   $layanan = Yii::$app->request->post('layanan');
  //   $unit_id = Yii::$app->request->post('unit_id');

  //   if ($layanan === "pasien_pulang") {
  //     return $this->redirect(Url::to(['/layanan-operasi/pasien-selesai-operasi']));
  //   } elseif ($layanan === "pasien_ruang_lainnya") {
  //     return $this->redirect(Url::to(['/layanan-operasi/ruangan-lainnya']));
  //   } elseif ($layanan === "pasien_operasi") {
  //     if ($unit_id == LayananOperasiSearch::KAMAR_OK_IBS) {
  //       return $this->redirect(Url::to(['/layanan-operasi/pasien-operasi', 'kamar' => $unit_id]));
  //     } elseif ($unit_id == LayananOperasiSearch::KAMAR_OK_IRD) {
  //       return $this->redirect(Url::to(['/layanan-operasi/pasien-operasi', 'kamar' => $unit_id]));
  //     } else {
  //       return $this->redirect(Url::to(['/layanan-operasi/pasien-operasi', 'kamar' => $unit_id]));
  //     }
  //   } else {
  //     return $this->redirect(Url::to(['/layanan-operasi/index']));
  //   }
  // }
}
