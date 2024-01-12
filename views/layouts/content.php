<?php
/* @var $content string */

use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">

        </div><!-- /.col -->
        <div class="col-sm-6">
          <?php
          echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => [
              'class' => 'breadcrumb float-sm-right'
            ]
          ]);
          ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <?php //echo Alert::widget() 
      ?>
    </div>
    <div class="<?= Yii::$app->params['setting']['adminlte']['card'] ?>">
      <div class="card-body" style="padding-bottom:80px">
        <?= $content ?>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>