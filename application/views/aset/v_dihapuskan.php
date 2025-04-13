<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Aset Dihapuskan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Data Aset</a></li>
            <li class="breadcrumb-item active">Dihapuskan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="flash-data" data-flashdata="<?=$this->session->flashdata('sukses');?>"></div>
  <div class="flash-data-gagal" data-flashdatagagal="<?=$this->session->flashdata('gagal');?>"></div>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
            </div>
        </div>
          <div class="card-body">
             <form action="" method="GET">
              <div class="row">
                  <div class="col-4">
                    <select name="kategori" class="form-control" value="<?= $kategori ?>">
                      <option value="">- Pilih Kategori Aset --</option>
                        <option value="<?= ModelAset::KATEGORI_TANAH ?>"><?= ModelAset::KATEGORI_TANAH ?></option>
                        <option value="<?= ModelAset::KATEGORI_PERALATAN ?>"><?= ModelAset::KATEGORI_PERALATAN ?></option>
                        <option value="<?= ModelAset::KATEGORI_BANGUNAN ?>"><?= ModelAset::KATEGORI_BANGUNAN ?></option>
                    </select>
                  </div>
                  <div class="col-4">
                    <select name="tgl_penghapusan" class="form-control" value="<?= $tgl_penghapusan ?>">
                        <option value="">- Pilih Tahun Penghapusan --</option>
                        <?php 
                        for($i = 2015 ; $i <= date('Y'); $i++){
                          echo "<option value='$i'>$i</option>";
                        }
                        ?>                          
                    </select>
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-block btn-outline-primary">Filter</button>
                  </div>
                  <div class="col">
                    <button type="reset" class="btn btn-block btn-outline-danger">Reset</button>
                  </div>              
              </div>
              </form> 
            <br/>
             <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Aset</th>
                    <th>Nama</th>
                    <th>Tahun Pengadaan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($aset as $row): ?>               
                <tr>
                    <td><?=$no++;?></td>
                    <td><?=$row['kode_aset'];?></td>
                    <td><?=$row['nama_aset'];?></td>
                    <td><?=$row['tahun_pengadaan'];?></td>
                    <td>
                        <a href="<?=base_url('aset_dihapuskan/detail/'.$row['id_aset'])?>" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="<?=base_url('aset_dihapuskan/restore/'.$row['id_aset'])?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-undo"></i>
                        </a>
                        <a href="<?=base_url('aset_dihapuskan/prune/'.$row['id_aset'])?>" class="btn btn-danger btn-sm tombol-hapus">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                <th>No.</th>
                    <th>Kode Aset</th>
                    <th>Nama</th>
                    <th>Tahun Pengadaan</th>
                    <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
             </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
          <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<script src="<?=base_url()?>src/backend/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>src/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "language": {
        "sSearch": "Cari"
      }
    });
  });
</script>