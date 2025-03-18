
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>iAsset | <?=$title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>src/backend/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- jQuery -->
  <script src="<?=base_url()?>src/backend/plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

 <!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-gradient-primary shadow-sm">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-white" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white font-weight-bold">SISTEM INFORMASI MANAJEMEN ASET DESA KARANGTENGAH</a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto align-items-center">
    <?php if($this->session->userdata('role')=='2'){ ?>
      <?php  
      $sql = "SELECT * FROM pengadaan WHERE status='0'";
      $jml_pengadaan = $this->db->query($sql)->num_rows();
      ?>
      <li class="nav-item dropdown">
        <a class="nav-link text-white" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php if($jml_pengadaan > 0): ?>
            <span class="badge badge-warning navbar-badge"><?=$jml_pengadaan;?></span>
          <?php endif; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?=$jml_pengadaan;?> Pemberitahuan</span>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url('pengadaan')?>" class="dropdown-item">
            <i class="fas fa-box text-primary"></i> <?=$jml_pengadaan;?> Pengadaan Baru
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?=base_url('pengadaan')?>" class="dropdown-item dropdown-footer">Lihat Semua</a>
        </div>
      </li>
    <?php } ?>

    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle d-flex align-items-center text-white" data-toggle="dropdown">
        <img src="<?= ($this->session->userdata('foto')) 
            ? base_url('src/img/profile/'.$this->session->userdata('foto')) 
            : base_url('src/backend/dist/img/profile.png'); ?>" 
            class="user-image img-circle border border-light" width="35">
        <span class="d-none d-md-inline ml-2">Hi, <?php echo $this->session->userdata('nama_user');?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <li class="user-header bg-primary text-center">
          <img src="<?= ($this->session->userdata('foto')) 
              ? base_url('src/img/profile/'.$this->session->userdata('foto')) 
              : base_url('src/backend/dist/img/profile.png'); ?>" 
              class="img-circle border border-light" width="70">
          <p class="mt-2">
            <strong><?php echo $this->session->userdata('nama_user');?></strong>
            <small><?php echo $this->session->userdata('jabatan');?></small>
          </p>
        </li>
        <li class="user-footer text-center">
          <a href="<?=base_url('pengaturan')?>" class="btn btn-sm btn-outline-light">
            <i class="fas fa-user-cog"></i> Edit Profil
          </a>
          <a href="<?=base_url('logout')?>" class="btn btn-sm btn-outline-danger ml-2">
            <i class="fas fa-sign-out-alt"></i> Keluar
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>
<!-- /.navbar -->


  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url()?>" class="brand-link">
      <img src="<?=base_url()?>src/backend/dist/img/logo.png" class="logo">
      <!-- <span class="brand-text font-weight-light">iAset</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <?php if ($this->session->userdata('role')=='1' || $this->session->userdata('role')=='2'): ?>

        <li class="nav-item has-treeview">
          <a href="<?=base_url('home')?>" class="nav-link <?=isset($active_menu_db)?$active_menu_db:'' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="<?=base_url('statistik')?>" class="nav-link <?=isset($active_menu_statistik)?$active_menu_statistik:'' ?>">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>Statistik</p>
          </a>
        </li>
        <li class="nav-item has-treeview <?=isset($active_menu_open)?$active_menu_open:'' ?>">
          <a href="#" class="nav-link <?=isset($active_menu_aset)?$active_menu_aset:'' ?>">
            <i class="nav-icon fa fa-building"></i>
            <p>Data Aset
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?=base_url('aset_wujud')?>" class="nav-link <?=isset($active_menu_wujud)?$active_menu_wujud:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Berwujud</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('aset_dihapuskan')?>" class="nav-link <?=isset($active_menu_hapuskan)?$active_menu_hapuskan:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Dihapuskan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?=isset($active_menu_kp)?$active_menu_kp:'' ?>">
          <a href="#" class="nav-link <?=isset($active_menu_kpn)?$active_menu_kpn:'' ?>">
            <i class="nav-icon fa fa-balance-scale"></i>
            <p>Keputusan Pengadaan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?=base_url('kriteria')?>" class="nav-link <?=isset($active_menu_dk)?$active_menu_dk:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Kriteria</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('data_aset')?>" class="nav-link <?=isset($active_menu_da)?$active_menu_da:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Aset</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('spk')?>" class="nav-link <?=isset($active_menu_spk)?$active_menu_spk:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Nilai / Proses SPK</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?=isset($active_menu_open_pnd)?$active_menu_open_pnd:'' ?>">
          <a href="#" class="nav-link <?=isset($active_pengadaan)?$active_pengadaan:'' ?>">
            <i class="nav-icon fas fa-luggage-cart"></i>
            <p>Pengadaan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?=base_url('pengajuan')?>" class="nav-link <?=isset($active_menu_pnd)?$active_menu_pnd:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengajuan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('pengadaan')?>" class="nav-link <?=isset($active_menu_pgd)?$active_menu_pgd:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Lihat Data</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="<?=base_url('monitoring')?>" class="nav-link <?=isset($active_menu_mt)?$active_menu_mt:'' ?>">
            <i class="nav-icon fa fa-heartbeat"></i>
            <p>Monitoring</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="<?=base_url('penyusutan')?>" class="nav-link <?=isset($active_menu_pys)?$active_menu_pys:'' ?>">
            <i class="nav-icon fas fa-chart-area"></i>
            <p>Penyusutan</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="<?=base_url('penghapusan')?>" class="nav-link <?=isset($active_menu_penghapusan)?$active_menu_penghapusan:'' ?>">
            <i class="nav-icon fas fa-exclamation-triangle"></i>
            <p>Penghapusan</p>
          </a>
        </li>
        <li class="nav-item has-treeview <?=isset($active_menu_lp)?$active_menu_lp:'' ?>">
          <a href="#" class="nav-link <?=isset($active_menu_lpr)?$active_menu_lpr:'' ?>">
            <i class="nav-icon fa fa-file"></i>
            <p>Laporan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?=base_url('laporan/aset')?>" class="nav-link <?=isset($active_menu_ast)?$active_menu_ast:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Aset</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('laporan/pengadaan')?>" class="nav-link <?=isset($active_menu_lpnd)?$active_menu_lpnd:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengadaan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('laporan/penghapusan')?>" class="nav-link <?=isset($active_menu_php)?$active_menu_php:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Penghapusan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('laporan/qr_code')?>" class="nav-link <?=isset($active_menu_qr)?$active_menu_qr:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>QR Code</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="<?=base_url('pengaturan')?>" class="nav-link <?=isset($active_menu_png)?$active_menu_png:'' ?>">
            <i class="nav-icon fas fa-cog"></i>
            <p>Pengaturan</p>
          </a>
        </li>
           
         <?php else: ?>
          <li class="nav-item has-treeview">
            <a href="<?=base_url('home')?>" class="nav-link <?=isset($active_menu_db)?$active_menu_db:'' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
        <li class="nav-item has-treeview <?=isset($active_menu_open_pnd)?$active_menu_open_pnd:'' ?>">
          <a href="#" class="nav-link <?=isset($active_pengadaan)?$active_pengadaan:'' ?>">
            <i class="nav-icon fas fa-luggage-cart"></i>
            <p>Pengadaan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?=base_url('pengajuan')?>" class="nav-link <?=isset($active_menu_pnd)?$active_menu_pnd:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Pengajuan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?=base_url('pengadaan')?>" class="nav-link <?=isset($active_menu_pgd)?$active_menu_pgd:'' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Lihat Data</p>
              </a>
            </li>
          </ul>
        </li>
          <li class="nav-item has-treeview">
            <a href="<?=base_url('pengaturan')?>" class="nav-link <?=isset($active_menu_png)?$active_menu_png:'' ?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>Pengaturan</p>
            </a>
          </li>
         <?php endif ?>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>


  

