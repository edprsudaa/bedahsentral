<?php
/* @var $content string */

use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <!-- <div class="row mb-2">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6"> -->
      <?php
      // echo Breadcrumbs::widget([
      //   'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
      //   'options' => [
      //     'class' => 'breadcrumb float-sm-right'
      //   ]
      // ]);
      ?>
      <!-- </div>
      </div> -->
    </div>
  </div>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <?php //echo Alert::widget() 
      ?>
    </div>
    <div class="card">
      <div class="card-body" style="padding-bottom:80px">
        <?= $content ?>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>