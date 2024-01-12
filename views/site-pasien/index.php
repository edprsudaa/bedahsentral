<?php

use yii\helpers\Url;
use kartik\tabs\TabsX;
use yii\helpers\Html;

$this->title = 'Beranda';
$this->params['breadcrumbs'][] = $this->title;
// $this->registerJs($this->render('script.js'),View::POS_END);
// $this->registerCss($this->render('style.css'));
echo $this->render('../layouts/card-pasien.php', ['layanan' => $chk_pasien]);
// $items = array();
// foreach ($mdcp as $i => $v) {
//   $content = $this->render('../site-pasien/content-item-tabs.php', ['data' => $v]);
//   $item = [
//     'label' => '<i class="fas fa-history"></i> ' . date('d-m-Y', strtotime($v[0]['reg_tgl'])),
//     'content' => $content,
//     'active' => (($items) ? false : true),
//     'height' => TabsX::SIZE_SMALL,
//     'bordered' => true,
//     'encodeLabels' => false,
//     'headerOptions' => ['style' => 'font-weight:bold']
//   ];
//   array_push($items, $item);
// }
?>
<div class="row" style="margin: -10px -20px 0px -20px;">
  <div class="col-lg-12">
    <div class="<?= Yii::$app->params['setting']['adminlte']['card'] ?>">
      <div class="card-header">
        <h3 class="card-title">Riwayat Pasien</h3>
      </div>
      <div class="card-body" style="min-height:131px !important;padding:0.5rem !important;">
        <div class="row">
          <div class="col-lg-12">
            <p style="text-align: center;font-family: Nunito,sans-serif;">
              <?= Html::a("<span class='text-white'>HISTORI BERDASARKAN DOKUMEN</span>", "http://emr-pengolahan-data.simrs.aa/history-pasien/list-kunjungan-object?id=" . $chk_pasien['registrasi']['pasien_kode'] . "&versi=1", ['class' => 'btn btn-primary col-md-4', 'target' => '_blank']) ?>
            </p>
            <p style="text-align: center;font-family: Nunito,sans-serif;">
              <?= Html::a("<span class='text-white'>HISTORI BERDASARKAN KUNJUNGAN</span>", "http://emr-pengolahan-data.simrs.aa/history-pasien/list-kunjungan?id=" . $chk_pasien['registrasi']['pasien_kode'] . "&versi=1", ['class' => 'btn btn-primary col-md-4', 'target' => '_blank']) ?>
            </p>
            <?php
            // echo TabsX::widget([
            //   'items' => $items,
            //   'position' => TabsX::POS_ABOVE,
            //   'encodeLabels' => false,
            //   'headerOptions' => ['style' => 'font-weight:bold'],
            //   'options' => ['id' => 'riwayat']
            // ]);
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end row -->