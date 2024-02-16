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
  }

  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
        // 'layout' => 'error-layout',
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
}
