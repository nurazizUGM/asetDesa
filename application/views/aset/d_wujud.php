<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Aset Berwujud</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Data Aset</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('aset_berwujud')?>">Berwujud</a></li>
              <li class="breadcrumb-item active">Detail Aset</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail Aset</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <?php if ($aset['qr_code'] != NULL): ?>
            <center>
                <img src="<?=base_url()?>src/img/qrcode/<?=$aset['qr_code']; ?>" style="height:150px;width:150px;">
            </center>
            <br/>
        <?php endif ?>  

        <table class="table table-striped">
            <tbody>
                <tr>
                    <td width="150px">Kode Aset</td>
                    <td width="50px">:</td>
                    <td><?=$aset['kode_aset'] ?></td>
                </tr>
                <tr>
                    <td>Nama Aset</td>
                    <td>:</td>
                    <td><?=$aset['nama_aset'] ?></td>
                </tr>
                <tr>
                    <td>Merek</td>
                    <td>:</td>
                    <td><?=$aset['merek'] ?></td>
                </tr>
                <tr>
                    <td>Kondisi</td>
                    <td>:</td>
                    <td><?=$aset['kondisi'] ?></td>
                </tr>
                <tr>
                    <td>Tahun Perolehan</td>
                    <td>:</td>
                    <td><?=$aset['tahun_perolehan'] ?></td>
                </tr>
                <tr>
                    <td>Lokasi Aset</td>
                    <td>:</td>
                    <td><?=$aset['lokasi'] ?></td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td>:</td>
                    <td><?=$aset['satuan'];?></td>
                </tr>
                <tr>
                    <td>Volume</td>
                    <td>:</td>
                    <td><?=$aset['volume'] ?></td>
                </tr>
                <tr>
                    <td>Nilai Perolehan</td>
                    <td>:</td>
                    <td><?=rupiah($aset['harga']);?></td>
                </tr>
                <tr>
                    <td>Harga Sewa</td>
                    <td>:</td>
                    <td><?=rupiah($aset['sewa']);?></td>
                </tr>
                <tr>
                    <td>Total Nilai Aset</td>
                    <td>:</td>
                    <td><?=rupiah($aset['total_harga']);?></td>
                </tr>
                <tr>
                    <td>Status Aset</td>
                    <td>:</td>
                    <td><?=$aset['status_aset'];?></td>
                </tr>
                <tr>
                    <td>Umur Ekonomis</td>
                    <td>:</td>
                    <td><?=$aset['umur_ekonomis'];?> Tahun</td>
                </tr>
                <tr>
                    <td>Masa Pemakaian</td>
                    <td>:</td>
                    <td>
                        <?php
                            $usia = date('Y') - $aset['tahun_perolehan'];
                            echo ($usia >= 0) ? "$usia Tahun" : "Aset sudah melewati umur ekonomis";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Sumber Bantuan</td>
                    <td>:</td>
                    <td><?=$aset['jenis_bantuan'];?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <a href="<?=base_url('aset_wujud')?>">
            <button type="button" class="btn btn-danger">Kembali</button>
        </a>
    </div>
</div>

      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
