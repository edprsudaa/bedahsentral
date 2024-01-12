<?php
$cek = PostAnestesi::find()->where(['mpa_id' => $model->mpa_id])->one();
if (!empty($cek)) {
?>
  <div class="col-lg-11">
    <h5 class="text-left bg-lightblue">MONITORING</h5>
    <?= $this->render('_form_ttv', ['model' => $modelttvp, 'id' => $model->mpa_id]); ?>
    <canvas id="myChart" style="width:100%;"></canvas>
    <?php
    $url = Yii::$app->homeUrl;
    $script = <<< JAVASCRIPT
  function grafikpost(){
    $.ajax({
        url : '$url'+'post-anestesi-pasien/getdata?id='+$model->mpa_id,
        type : 'GET',
        dataType : 'JSON',
        success:function(res){
            // console.log(res);
            var waktu = [];
            var nadi = [];
            var nafas = [];
            var sistole = [];
            var diastole = [];
            var metode = [];
            var skor = [];
            $.each(res, function(ind, val){
                waktu.push(val.waktu)
                nadi.push(val.nadi);
                nafas.push(val.nafas);
                sistole.push(val.sistole);
                diastole.push(val.diastole);
                metode.push(val.metode);
                skor.push(val.skor);
            })
            // console.log("waktu = "+waktu);
            var xValues = waktu;

            new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{ 
                    data: nadi,
                    borderColor: "red",
                    fill: true,
                    label : 'Nadi'
                },{ 
                    data: sistole,
                    borderColor: "blue",
                    fill: true,
                    label : 'Sistole'
                },{ 
                    data: diastole,
                    borderColor: "yellow",
                    fill: true,
                    label : 'Diastole'
                }]
            },
            options: {
                legend: {display: true},
                //responsive: false,
                legend: {
                    position: 'top' // place legend on the right side of chart
                },
                scales: {
                    xAxes: [{
                        display : true,
                        stacked: true, // this should be set to make the bars stacked
                        scaleLabel: {
                            display: true,
                            labelString: 'Waktu'
                        },
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: false,
                            labelString: 'value'
                        },
                        stacked: false // this also..
                    }]
                },
            }
            });
        }
    });
  }
JAVASCRIPT;
    $this->registerJs($script);
    ?>

  </div>
<?php } ?>