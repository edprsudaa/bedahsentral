<?php

use yii\helpers\Html;
?>
<div class="akses-unit-create">
  <?php
  if (\Yii::$app->request->isAjax) {
    echo $this->renderAjax('_form', [
      'model' => $model,
    ]);
  } else {
    echo $this->render('_form', [
      'model' => $model,
    ]);
  }
  ?>
</div>