<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\medis\Log;
use app\components\HelperSpesial;
use app\components\HelperGeneral;
use yii\web\View;
use yii\web\JsExpression;
use kartik\switchinput\SwitchInput;

\yii\widgets\Pjax::begin(['id' => 'pjform']);
$this->registerJs($this->render('_form_create_ready.js'));
$this->registerCss($this->render('style.css'));
$this->registerJs($this->render('script.js'));
?>
<div class="row">
  <div class="col-lg-11">
    <div class="row">
      <div class="col-lg-9">
        <div id="content">
          <div id="tools">
            <div class="tuls" style="width: 50%;display:none">
              <button id="brush">Brash</button>
              <button id="line">Line</button>
              <button id="rectangle">Rectangle</button>
              <button id="circle">Circle</button>
              <button id="ellipse">Ellipse</button>
              <button id="spray">Spray</button>
              <button id="eraser">Eraser</button>
              <button id="fill">Fill</button>
              <br>
              <button id="copy">Copy</button>
              <button id="copyrand">Copy random area</button>
              <button id="paste">Paste</button>
              <button id="text">Text</button>
              <br>
              <div>
                Text size
                <input type="number" id="text-size" min="6" max="100" value="14">
                <br>Font
                <select id="font">
                  <option value="LucidaConsole">Lucida Console</option>
                  <option value="Courier New">Courier New</option>
                  <option value="Arial">Arial</option>
                  <option value="ArialBlack">Arial Black</option>
                </select>
              </div>
              <div id="manage">
                <canvas id="brush_size" width="50" height="50"></canvas>
                Brash size <input type="range" id="width_range" value="10" min="1"><br>
                Opacity <input type="range" id="opacity_range" value="100">
              </div>
              <div id="colors">
                <button class="black" id="#000000"></button>
                <button class="white" id='#FFFFFF'></button>
                <button class="blue" id='#0000FF'></button>
                <button class="red" id='#FF0000'></button>
                <button class="yellow" id='#FFFF00'></button>
                <button class="green" id='#008000'></button>
                <input type="color" id="color" value="#0000FF">
                <input type="hidden" id="color_value_form">
              </div>
              <div id="functions">
                <button id="undo">Undo</button>
                <button id="redo">Redo</button>
                <button id="id_download">Save</button>
                <button id="clear">Clear</button>
              </div>
            </div>
            <div id="areaForPaint">
              <canvas id="paint"></canvas>
            </div>
          </div>

        </div>
      </div>
      <div class="col-lg-3">
        <?php $form = ActiveForm::begin(['id' => 'mlo']); ?>
        <?= $form->field($model, 'mlo_to_id')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'mlo_batal')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'mlo_dokter_yg_melakukan_pgw_id')->hiddenInput()->label(false); ?>

        <table width="100%">
          <tr class="text-center bg-lightblue">
            <th>Keterangan</th>
          </tr>
          <tr>
            <td height="610px" width="230px">
              <?= $form->field($model, 'mlo_gambar_marking', ['options' => ['class' => 'form-group custom-margin']])->hiddenInput(['class' => 'form-control form-control-sm', 'placeholder' => '.....', 'rows' => 25, 'id' => 'gbr'])->label(false); ?>
              <?= $form->field($model, 'mlo_keterangan_marking', ['options' => ['class' => 'form-group custom-margin']])->textArea(['class' => 'form-control form-control-sm', 'placeholder' => '.....', 'rows' => 25, 'id' => 'isinya'])->label(false); ?>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-1">
    <div class="row icon-sticky">
      <div class="col-lg-12">
        <div class="btn-group-vertical">
          <?php
          echo $form->field($model, 'mlo_final')->widget(SwitchInput::classname(), [
            'pluginOptions' => [
              'size' => 'mini',
              'onText' => 'Final', 'handleWidth' => 50,
              'offText' => 'Draf',
              'onColor' => 'success',
              'offColor' => 'danger',
            ]
          ])->label(false);
          ?>
          <?= Html::submitButton('<i class="fas fa-check"></i> Simpan', ['class' => 'btn btn-success btn-submit']) ?>
          <?= Html::button('<i class="fas fa-sync"></i> Segarkan', ['class' => 'btn btn-warning btn-segarkan']) ?>

          <?= Html::a('<i class="fas fa-times"></i> Kembali', ['/lokasi-operasi-pasien/index', 'id' => Yii::$app->request->get('id')], ['class' => 'btn btn-danger']) ?>
        </div>
      </div>
    </div>
  </div>
  <?php ActiveForm::end(); ?>
  <?php yii\widgets\Pjax::end(); ?>
</div>

<div class="modal fade" id="choi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-11">
            <input type="text" name="" id="ket" placeholder="Keterangan..." class="form-control form-control-sm" />
          </div>
          <div class="col-lg-1">
            <button onclick="oke()" data-dismiss="modal" class="btn btn-default btn-sm">Oke</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function oke() {
    var x = $("#ket").val();
    if (x != '') {
      $("#isinya").append(x + "\n");
    }
    $("#ket").val('');
  }
</script>