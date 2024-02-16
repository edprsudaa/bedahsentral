<?php

use app\modules\rbac\components\Helper;
// use mdm\admin\components\Helper;
use yii\helpers\Url;
use app\components\Akun;
use app\components\HelperGeneral;
use app\models\bedahsentral\TimOperasi;
use app\models\bedahsentral\TimOperasiDetail;

$this->registerJs($this->render('script.js'));
?>

<aside class="<?= Yii::$app->params['setting']['adminlte']['aside_sidebar_class'] ?>">
  <!-- Brand Logo -->
  <a href="<?= Url::home() ?>" class="brand-link">
    <img src="<?= Url::base() . "/icon/favicon.ico" ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-bold" style="color: <?= Yii::$app->params['setting']['adminlte']['color_style'] ?>;"><?= Yii::$app->params['app']['shortName'] ?></span>
    <span class="brand-text font-weight-light" style="color: <?= Yii::$app->params['setting']['adminlte']['color_style'] ?>;"><?= Yii::$app->params['app']['version'] ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= Akun::user()->photo ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= Akun::user()->name ?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <?php

      $userid = Akun::user()->id;
      $id_pegawai = Akun::user()->id_pegawai;
      $id_layanan = Yii::$app->request->get('id');

      $tim = TimOperasi::find()
        ->where(['to_ok_pl_id' => $id_layanan, 'to_deleted_at' => null])
        ->orderBy(['to_created_at' => SORT_DESC])
        ->one();

      $cek = TimOperasiDetail::find()
        ->where(['tod_pgw_id' => $id_pegawai, 'tod_to_id' => $tim->to_id])
        ->one();

      if ($cek || ($tim->to_created_by == $userid) || (Akun::user()->username == Yii::$app->params['other']['username_root_bedah_sentral'])) {
        $menuItems = [
          ['label' => 'Histori Pasien', 'iconStyle' => 'fas', 'icon' => 'fas fa-wheelchair', 'url' => ['/site-pasien/index', 'id' => Yii::$app->request->get('id')]],

          [
            'label' => 'Cari Pasien Lain',
            'icon' => 'fas fa-search',
            'url' => null,
            'options' => [
              'id' => 'kembali',
              'data-id' => "$tim->to_ok_unt_id",
              // 'onclick' => "kembali($tim->to_ok_unt_id)"
            ],
            // 'linkOptions' => [
            // 'onclick' => "kembali($tim->to_ok_unt_id)",
            // ]
          ],

          ['label' => 'Tim Operasi', 'iconStyle' => 'fas', 'icon' => 'fas fa-users', 'url' => ['/tim-operasi/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Pembatalan Operasi', 'iconStyle' => 'fas', 'icon' => 'fas fa-ban', 'url' => ['/pembatalan-operasi/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'TINDAKAN', 'header' => true, 'url' => ['/pasien-jasa-tindakan/']],

          ['label' => 'Tindakan Rumah Sakit', 'iconStyle' => 'fa', 'icon' => 'clipboard-list', 'url' => ['/pasien-jasa-tindakan/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'CPPT', 'header' => true, 'url' => ['/cppt/']],

          ['label' => 'Cppt', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/cppt/index', 'id' => Yii::$app->request->get('id')], 'target' => '_blank'],

          ['label' => 'General', 'header' => true],
          ['label' => 'OK', 'header' => true, 'url' => ['/ok/']],

          // ['label' => 'Serah Terima Ruangan', 'iconStyle' => 'far', 'icon' => 'fas fa-edit', 'url' => ['/serah-terima-ruangan-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Checklist keselamatan', 'iconStyle' => 'fas', 'icon' => 'fas fa-spell-check', 'url' => ['/check-list-keselamatan-ok-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Askep Pre Ruangan', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/pre-operasi-perawat-ruangan-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Askep Pre OK', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/pre-operasi-perawat-ok-pasien/index', 'id' => Yii::$app->request->get('id')]],

          // ['label' => 'Askep Pre Anestesi', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/pre-operasi-perawat-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Askep Intra Operasi', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/intra-operasi-perawat-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Catatan Lokal Anestesi', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/catatan-lokal-anestesi/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Pasca Lokal Anestesi', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/pasca-lokal-anestesi/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Jumlah Instrumen & Kasa', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/penggunaan-jumlah-kasa-dan-instrumen-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Marking', 'iconStyle' => 'fas', 'icon' => 'pen', 'url' => ['/lokasi-operasi-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Askep Post Operasi', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/post-operasi-perawat-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Laporan Operasi', 'iconStyle' => 'fas', 'icon' => 'fas fa-copy', 'url' => ['/laporan-operasi-pasien/index', 'id' => Yii::$app->request->get('id')]],

          // ['label' => 'Inform Concent Tindakan Dokter', 'iconStyle' => 'far', 'icon' => 'fas fa-edit', 'url' => ['/inform-concent-tindakan-dokter-pasien/index', 'id' => Yii::$app->request->get('id')]],

          //////////////////////////////////////// ANESTESI ///////////////////////////////////////////

          ['label' => 'ANESTESI', 'header' => true, 'url' => ['/anestesi/']],

          ['label' => 'Askan Pra Anestesi', 'iconStyle' => 'fas', 'icon' => 'fas fa-edit', 'url' => ['/askan-pra-anestesi/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Askan Intra Anestesi', 'iconStyle' => 'fas', 'icon' => 'fas fa-edit', 'url' => ['/askan-intra-anestesi/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Askan Pasca Anestesi', 'iconStyle' => 'fas', 'icon' => 'fas fa-edit', 'url' => ['/askan-pasca-anestesi/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Lembar Edukasi Anestesi', 'iconStyle' => 'fas', 'icon' => 'fas fa-edit', 'url' => ['/lembar-edukasi-tindakan-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Pengkajian Pra Anestesi', 'iconStyle' => 'fas', 'icon' => 'fas fa-edit', 'url' => ['/pra-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Asesmen Pra Induksi', 'icon' => 'fas fa-copy', 'url' => ['/asesmen-pra-induksi-pasien/index', 'id' => Yii::$app->request->get('id')]],

          // ['label' => 'Catatan Perioperaktif Anestesi', 'iconStyle' => 'fab', 'icon' => 'fab fa-wpforms', 'url' => ['/intra-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Intra Anestesi', 'iconStyle' => 'fas', 'icon' => 'fas fa-edit', 'url' => ['/intra-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Post Anestesi', 'iconStyle' => 'fas', 'icon' => 'fas fa-edit', 'url' => ['/post-anestesi-pasien/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'HASIL PEMERIKSAAN', 'header' => true, 'url' => ['/hasil-pemeriksaan/']],

          ['label' => 'Lab Patologi Anatomi', 'iconStyle' => 'fa', 'icon' => 'flask', 'url' => ['/hasil-pemeriksaan/lab-patologi-anatomi', 'id' => Yii::$app->request->get('id')], 'target' => '_blank'],

          ['label' => 'Lab Patologi Klinik', 'iconStyle' => 'fa', 'icon' => 'flask', 'url' => ['/hasil-pemeriksaan/lab-patologi-klinik', 'id' => Yii::$app->request->get('id')], 'target' => '_blank'],

          ['label' => 'Radiologi', 'iconStyle' => 'fa', 'icon' => 'radiation', 'url' => ['/hasil-pemeriksaan/radiologi', 'id' => Yii::$app->request->get('id')], 'target' => '_blank'],

          ['label' => 'Ekokardiografi', 'iconStyle' => 'fa', 'icon' => 'flask', 'url' => ['/hasil-pemeriksaan/ekokardiografi', 'id' => Yii::$app->request->get('id')], 'target' => '_blank'],
        ];
      } else {
        $menuItems = [
          ['label' => 'Riwayat Pasien', 'icon' => 'fas fa-wheelchair', 'url' => ['/site-pasien/index', 'id' => Yii::$app->request->get('id')]],

          [
            'label' => 'Cari Pasien Lain',
            'icon' => 'fas fa-search',
            'url' => null,
            'options' => [
              'id' => 'kembali',
              'data-id' => "$tim->to_ok_unt_id",
              // 'onclick' => "kembali($tim->to_ok_unt_id)"
            ],
          ],

          ['label' => 'Tim Operasi', 'icon' => 'fas fa-users', 'url' => ['/tim-operasi/index', 'id' => Yii::$app->request->get('id')]],

          ['label' => 'Pembatalan Operasi', 'iconStyle' => 'fas', 'icon' => 'fas fa-ban', 'url' => ['/pembatalan-operasi/index', 'id' => Yii::$app->request->get('id')]],
        ];
      }
      $menuItems = Helper::filter($menuItems); ///matikan rbac
      echo \hail812\adminlte\widgets\Menu::widget([
        // 'options' => [
        //   'class' => 'nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-child-indent text-sm',
        //   'data-widget' => 'treeview',
        //   'role' => 'menu',
        //   'data-accordion' => 'false'
        // ],
        'items' => $menuItems,
      ]);
      ?>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>