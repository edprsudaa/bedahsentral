<?php

$this->title = (($model->isNewRecord) ? "Tambah " . $title : "Ubah " . $title);

if (!\Yii::$app->request->isAjax) {
  echo $this->render('../layouts/card-pasien.php', ['layanan' => $chk_pasien]);
}
?>

<div class="pembatalan-operasi-index">
  <?php
  if (!$model->isNewRecord) {
    echo $this->render('_form_update', [
      'title' => $title,
      'model' => $model,
      'timoperasi' => $timoperasi,
      'layanan' => $chk_pasien,
    ]);
  } else {
    echo $this->render('_form_create', [
      'title' => $title,
      'model' => $model,
      'timoperasi' => $timoperasi,
      'layanan' => $chk_pasien,
    ]);
  }
  ?>
</div>