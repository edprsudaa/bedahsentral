<div class="row">
  <div class="col-lg-12">
    <table class="table table-sm">
      <thead>
        <tr style="text-align: center;">
          <th>Nama</th>
          <th>Tanggal</th>
          <th>Ruangan</th>
          <th>Tgl.Batal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($data) {
          foreach ($data as $v) {
        ?>
            <tr style="<?= (($v['batal']) ? 'background-color:#dc3545;color:#ffff;' : '') ?>">
              <td><?= $v['doc_clinical_nama'] ?></td>
              <td style="text-align: center;">
                <?php
                echo \Yii::$app->formatter->asDate($v['created_at']) . ' ' . \Yii::$app->formatter->asTime($v['created_at']);
                ?>
              </td>
              <td><?= $v['unt_nama'] ?></td>
              <td style="text-align: center;">
                <?php
                if ($v['batal'] == 1) {
                  echo \Yii::$app->formatter->asDate($v['tgl_batal']) . ' ' . \Yii::$app->formatter->asTime($v['tgl_batal']);
                } else {
                  echo '';
                }
                ?>
              </td>
              <td style="text-align: center;">
                <div class="btn-group">
                  <button type="button" class="btn btn-success btn-sm btn-lihat" data-id="<?= $v['id_doc_clinical_pasien'] ?>" data-nama="<?= $v['doc_clinical_nama'] ?>"><i class="fas fa-search fa-sm"></i> Lihat</button>
                  <button type="button" class="btn btn-warning btn-sm btn-cetak" data-id="<?= $v['id_doc_clinical_pasien'] ?>" data-nama="<?= $v['doc_clinical_nama'] ?>"><i class="fas fa-print fa-sm"></i> Cetak</button>
                </div>
              </td>
            </tr>
        <?php
          }
        } else {
          echo '<tr><td colspan="5">Data Tidak Tersedia</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
<?php
// $this->registerJs("
// $('.btn-lihat').on('click', function() {
//     var id=$(this).data('id');
//     $.get(baseUrl+'/site-pasien/preview-doc-clinical?id='+id, function(d){
//         if(d.status){
//             $('.mymodal_card_xl_header').html(d.data.doc_clinical_nama);
//             $('.mymodal_card_xl_body').html(d.data.data);
//             $('.mymodal_card_xl').modal('show');
//         }else{
//             fmsg.w(d.msg);
//         }
//     });
// });
// $('.btn-cetak').on('click', function() {
//     // var id=$(this).data('id');
//     // window.open(baseUrl+'/site-pasien/cetak-doc-clinical?id='+id,'_blank');
//     var id=$(this).data('id');
//     var w=window.open(baseUrl+'/site-pasien/cetak-doc-clinical?id='+id,'','height=1000,width=700');
//     if(window.focus){
//         w.focus();
//     }else{
//         fmsg.w('Dokumen Gagal Dicetak');
//     }
// });



// ");
