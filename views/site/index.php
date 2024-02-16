<?php

/* @var $this yii\web\View */

$this->title = 'Operasi Bedah Sentral';
?>
<div class="site-index" style="text-align: center;">
  <!-- <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-12">
          <marquee style="background:white;border-radius:5px; color:#28a745!important;font-size:1.5em" scrolldelay="1" direction="left">
            EMR <b>BEDAH SENTRAL</b> - (EDP <b>RSUD Arifin Achmad</b>) &copy; 2022</em>
          </marquee>
        </div>
      </div>
    </div>
  </section> -->
  <img style="margin-bottom:20px" src="<?= Yii::$app->homeUrl . "images/logo.png" ?>" height="300px" class="user-image img-circle elevation-2" alt="User Image">
  <!-- <div class="jumbotron text-center bg-transparent"> -->
  <!-- <img style="position: center" src="/images/rsudaa.png" height="300px" alt=""> -->
  <h1 style="background:white;border-radius:5px;"><b>Selamat Datang!</b></em></h1>
  <h1 style="background:white;border-radius:5px; color:#28a745!important;"><?= Yii::$app->params['app']['namaAwal'] ?>-<b><?= Yii::$app->params['app']['namaAkhir'] ?> - RSUD Arifin Achmad</b></em></h1>
  <!-- <marquee direction="down" width="100%" height="300" behavior="alternate">
      <marquee behavior="alternate">
        <span style="padding: 0;font-size:5em"><b><?= Yii::$app->params['app']['fullName'] ?></b></span>
      </marquee>
    </marquee> -->
  <!-- </div> -->
</div>