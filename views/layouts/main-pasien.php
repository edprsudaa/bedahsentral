<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
AppAsset::register($this);
\hail812\adminlte3\assets\PluginAsset::register($this)->add([
  'pace',
  'sweetalert2',
  'toastr',
  'overlayScrollbars'
]);
// $this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700');
$dist_adminlte = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
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
    <?= $this->render('navbar', ['dist_adminlte' => $dist_adminlte]) ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar-left-pasien', ['dist_adminlte' => $dist_adminlte]) ?>
    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', ['content' => $content, 'dist_adminlte' => $dist_adminlte]) ?>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <?= $this->render('sidebar-right') ?>
    <!-- /.control-sidebar -->
    <!-- Main Footer -->
    <?= $this->render('footer') ?>
  </div>
  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>