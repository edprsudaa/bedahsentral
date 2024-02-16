<?php

use app\components\Akun;
use app\models\search\LayananOperasiSearch;
use app\modules\rbac\components\Helper;
use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-secondary elevation-4">
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
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <?php

      $menuItems = [
        //pencarian tracer
        ['label' => 'Dashboard', 'iconStyle' => 'fas', 'icon' => 'tachometer-alt', 'url' => ['/site/index']],

        ['label' => 'Antrol Jadwal Operasi', 'icon' => 'fas fa-clock', 'url' => ['/antrol-jadwal-operasi/index']],
        ['label' => 'Layanan', 'header' => true, 'url' => ['/layanan-operasi/']],
        ['label' => 'Registrasi Operasi', 'iconStyle' => 'fas', 'icon' => 'user-plus', 'url' => ['/layanan-operasi/index']],
        [
          'label' => 'Pasien Operasi',
          'icon' => 'syringe',
          'items' => [
            ['label' => 'OK GROUND (Lt. 1)', 'url' => ['/layanan-operasi/pasien-operasi', 'kamar' => LayananOperasiSearch::KAMAR_OK_GROUND], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            ['label' => 'OK IRD (Lt. 2)', 'url' => ['/layanan-operasi/pasien-operasi', 'kamar' => LayananOperasiSearch::KAMAR_OK_IRD], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            ['label' => 'OK IBS (Lt. 3)', 'url' => ['/layanan-operasi/pasien-operasi', 'kamar' => LayananOperasiSearch::KAMAR_OK_IBS], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            ['label' => 'Ruangan Lainnya', 'url' => ['/layanan-operasi/ruangan-lainnya'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
          ]
        ],
        ['label' => 'Pasien Selesai Operasi', 'icon' => 'wheelchair', 'url' => ['/layanan-operasi/pasien-selesai-operasi']],

        ['label' => 'Lainnya', 'header' => true, 'url' => ['/aktifitas-saya/']],
        ['label' => 'Aktivitas Saya', 'iconStyle' => 'fas', 'icon' => 'history', 'url' => ['/aktifitas-saya/index']],

        ['label' => 'Jabatan', 'header' => true, 'url' => ['/jabatan-operasi/']],
        ['label' => 'Jabatan Operasi', 'url' => ['/jabatan-operasi/index'], 'icon' => 'toolbox', 'iconStyle' => 'fas'],

        ['label' => 'Pengaturan', 'header' => true, 'url' => ['/rbac/']],
        ['label' => 'Pengguna', 'url' => ['/rbac/user/index'], 'icon' => 'users', 'iconStyle' => 'fas'],
        ['label' => 'Akses Unit Pengguna', 'url' => ['/akses-unit-pengguna/index'], 'icon' => 'university', 'iconStyle' => 'fas'],
        [
          'label' => 'RBAC',
          'icon' => 'user-cog',
          'items' => [
            ['label' => 'Route', 'url' => ['/rbac/route/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            ['label' => 'Permission', 'url' => ['/rbac/permission/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            ['label' => 'Role', 'url' => ['/rbac/role/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            ['label' => 'Assignment', 'url' => ['/rbac/assignment/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
          ]
        ],
        ['label' => 'Log Aplikasi', 'iconStyle' => 'fas', 'icon' => 'history', 'url' => ['/semua-aktifitas/index']],
      ];
      $menuItems = Helper::filter($menuItems);
      // $menuItems = Helper::filter($menuItems);
      echo \hail812\adminlte\widgets\Menu::widget([
        // 'options' => [
        //   'class' => 'nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-child-indent text-sm',
        //   'data-widget' => 'treeview',
        //   'role' => 'menu',
        //   'data-accordion' => 'false',
        // ],
        'items' => $menuItems,
      ]);
      ?>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>