<?php

use app\assets\AppAsset;
use app\assets\LoginAsset;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);
\hail812\adminlte3\assets\PluginAsset::register($this)->add(['sweetalert2', 'toastr','datatable']);

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


  
    <?php $this->beginBody() ?>
            
    <?= $content ?>
    <?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>