<?php

use app\components\Akun;
use yii\helpers\Html;

?>
<!-- Navbar -->
<nav class="<?= Yii::$app->params['setting']['adminlte']['navbar_class'] ?>">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item  mt-1">
      <span class="text-lg text-success"><i class="fa fa-plus-square" aria-hidden="true"></i> <?= Yii::$app->params['app']['namaAwal'] ?>-<b><?= Yii::$app->params['app']['namaAkhir'] ?></b><b></b></span>
    </li>

  </ul>

  <!-- SEARCH FORM -->

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->


    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="<?= Akun::user()->photo ?>" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?= ((Yii::$app->user->identity) ? Akun::user()->name : '?') ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-info">
          <img src="<?= Akun::user()->photo ?>" class="img-circle elevation-2" alt="User Image">
          <p>
            <?= ((Yii::$app->user->identity) ? Akun::user()->name : '?') ?>
            <small><?= ((Yii::$app->user->identity) ? Akun::user()->username : '?') ?></small>
          </p>
        </li>
        <li class="user-footer">
          <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
          <?= Html::a('Keluar', ['/auth/logout'], ['data-method' => 'post', 'class' => 'btn btn-danger btn-flat float-right', 'style' => 'border-radius:10px']) ?>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <!-- <li class="nav-item"> -->

    <?php //Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) 
    ?>
    <!-- </li> -->


  </ul>
</nav>
<!-- /.navbar -->