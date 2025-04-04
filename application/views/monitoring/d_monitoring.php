<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Monitoring</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('monitoring') ?>">Monitoring</a></li>
            <li class="breadcrumb-item active">Detail Monitoring</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- general form elements disabled -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail Aset</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-striped" id="users">
                <tbody>
                  <?php foreach ($aset as $d) { ?>
                    <tr>
                      <td width="100px">Kode Aset</td>
                      <td width="50px">:</td>
                      <td><?= $d['kode_aset'] ?></td>
                    </tr>
                    <tr>
                      <td width="100px">Nama Aset</td>
                      <td width="50px">:</td>
                      <td><?= $d['nama_aset'] ?></td>
                    </tr>
                    <tr>
                      <td width="200px">Kategori Aset</td>
                      <td width="50px">:</td>
                      <td><?= $d['kategori_aset'] ?></td>
                    </tr>
                    <tr>
                      <td width="100px">Tahun Pengadaan</td>
                      <td width="50px">:</td>
                      <td><?= $d['tahun_pengadaan'] ?></td>
                    </tr>
                    <tr>
                      <td width="100px">Masa Pemakaian</td>
                      <td width="50px">:</td>
                      <td>
                        <?php
                        $usia = date('Y') - $d['tahun_pengadaan'];
                        if ($usia < 0) {
                          echo " Aset sudah melewati umur ekonomis";
                        } else {
                          echo $usia, " Tahun";
                        }
                        ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (right) -->

        <div class="col-md-12">
          <!-- general form elements disabled -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail Monitoring Aset</h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">

              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>FOTO ASET</th>
                    <th>KERUSAKAN</th>
                    <th>FAKTOR YANG MEMPENGARUHI</th>
                    <th>MONITORING</th>
                    <th>PEMELIHARAAN YANG HARUS DILAKUKAN</th>
                    <th>AKIBAT YANG TERJADI</th>
                    <th>JUMLAH KERUSAKAN</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td rowspan="5">
                      <img src="<?= base_url() ?>src/img/aset/<?= $mt['foto'] ?>" alt="" style="width:100px;height:100px;">
                    </td>
                    <td><?= $mt['kerusakan'] ?></td>
                    <td rowspan="4"><?= $mt['faktor'] ?></td>
                    <td rowspan="4"><?= $mt['monitoring'] ?></td>
                    <td rowspan="4"><?= $mt['pemeliharaan'] ?></td>
                    <td><?= $mt['akibat'] ?></td>
                    <td><?= $mt['jml_rusak'] ?></td>
                  </tr>
                </tbody>
              </table>
              <br />
              <a href="<?= base_url('monitoring') ?>">
                <button type="button" class="btn btn-danger">Kembali</button>
              </a>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (right) -->


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->