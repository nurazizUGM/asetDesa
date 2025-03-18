<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-3">
        <div class="col-md-12">
          <div class="card bg-gradient-primary text-white shadow-lg">
            <div class="card-body">
              <h4 class="mb-0">
                <?php
                  date_default_timezone_set("Asia/Jakarta");
                  $hour = date("G", time());

                  if ($hour >= 0 && $hour <= 11) {
                    echo '<i class="fas fa-cloud-sun"></i> Selamat Pagi, ';
                  } else if ($hour >= 12 && $hour <= 14) {
                    echo '<i class="far fa-sun"></i> Selamat Siang, ';
                  } else if ($hour >= 15 && $hour <= 17) {
                    echo '<i class="far fa-sun"></i> Selamat Sore, ';
                  } else if ($hour >= 17 && $hour <= 18) {
                    echo '<i class="fas fa-cloud"></i> Selamat Petang, ';
                  } else {
                    echo '<i class="fas fa-cloud-moon"></i> Selamat Malam, ';
                  }

                  echo $this->session->userdata('nama_user');
                ?>
              </h4>
              <!-- <p class="mb-0">Selamat datang di <strong>Dashboard Admin</strong>.</p> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <?php if ($this->session->userdata('role')=='1' || $this->session->userdata('role')=='2'): ?>
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-gradient-info shadow-lg">
            <div class="inner">
              <h3><?=$wujud+$hapuskan;?></h3>
              <p>Total Aset</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-home"></i>
            </div>
            <a href="#" class="small-box-footer">Aset Berwujud + Dihapuskan <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-gradient-success shadow-lg">
            <div class="inner">
              <h3><?=$wujud;?></h3>
              <p>Aset Berwujud</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-desktop"></i>
            </div>
            <a href="<?=base_url('aset_wujud')?>" class="small-box-footer">Selengkapnya 
              <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-gradient-danger shadow-lg">
            <div class="inner">
              <h3><?=$hapuskan;?></h3>
              <p>Aset Dihapuskan</p>
            </div>
            <div class="icon">
              <i class="ion ion-trash-a"></i>
            </div>
            <a href="<?=base_url('aset_dihapuskan')?>" class="small-box-footer">Selengkapnya 
              <i class="fas fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <?php endif ?>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
