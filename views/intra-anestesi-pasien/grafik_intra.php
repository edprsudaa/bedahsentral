<?php
$script = <<< JS
    function grafik(){
      $.ajax({
          url : '$url'+'intra-anestesi-pasien/getdata?id='+$intra->mia_id,
          type : 'GET',
          dataType : 'JSON',
          success:function(res){
              var waktu = [];
              var nadi = [];
              var nafas = [];
              var sistole = [];
              var diastole = [];
              $.each(res, function(ind, val){
                  waktu.push(val.waktu);
                  nadi.push(val.nadi);
                  nafas.push(val.nafas);
                  sistole.push(val.sistole);
                  diastole.push(val.diastole);
              });
              var xValues = waktu;

            var char = new Chart("myChart", {
              type: "line",
              data: {
                  labels: xValues,
                  datasets: [{ 
                      data: nadi,
                      borderColor: "red",
                      fill: true,
                      label : 'Nadi'
                  }, { 
                      data: nafas,
                      borderColor: "green",
                      fill: true,
                      label : 'Pernafasan'
                  }, { 
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
                  responsive: true,
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
JS;
$this->registerJs($script);
?>