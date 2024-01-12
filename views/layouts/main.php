<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
AppAsset::register($this);
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['sweetalert2', 'toastr', 'datatable', 'pace', 'icheck-bootstrap']);


// $this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <script>
    const baseUrl = '<?= Yii::$app->request->baseUrl ?>';
    let controller = '<?= Yii::$app->controller->id ?>';
    const moduleName = '<?= Yii::$app->controller->module->id ?>';
  </script>
  <?php $this->head() ?>
</head>

<body class="<?= Yii::$app->params['setting']['adminlte']['body_class_collapse'] ?>" style="height:auto">
  <?php $this->beginBody() ?>

  <div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('navbar', ['assetDir' => $assetDir]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'assetDir' => $assetDir]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>

  </div>
  <!-- <div class="modal fade" id="mymodal" tabindex="false" role="dialog" aria-labelledby="myModalLabel"></div>
    <script>
        var base_url = '<?php echo Url::base(); ?>';
    </script> -->
  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>