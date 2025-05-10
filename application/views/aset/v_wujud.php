<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
            <li class="breadcrumb-item active">Berwujud</li>
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
    <!-- Tambahkan button "Import Excel" di card header -->
<div class="card-header">
    <h3 class="card-title">
        <a href="<?=base_url('aset_wujud/tambah')?>" class="btn bg-gradient-primary">
            Tambah Aset
        </a>
        <button type="button" class="btn bg-gradient-success" data-toggle="modal" data-target="#importExcelModal">
          <i class="fas fa-file-excel"></i> Import Excel
        </button>
        <a href="<?=base_url('aset_wujud/export_excel')?>" class="btn bg-gradient-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
    </h3>
    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- Modal untuk Upload File Excel -->
<div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="importExcelLabel"><i class="fas fa-file-excel"></i> Import Data dari Excel</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('aset_wujud/import_excel')?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fileExcel">Pilih File Excel</label>
                        <input type="file" name="fileExcel" class="form-control" required accept=".xls, .xlsx">
                    </div>
                    <a href="<?=base_url('/src/template_aset.xlsx')?>" target="_blank" class="btn btn-info btn-sm">
                        <i class="fas fa-download"></i> Download Template
                    </a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="card-body">
        <form action="" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <select name="kategori" class="form-control" value="<?= $kategori ?>">
                        <option value="">- Pilih Kategori -</option>
                        <option value="<?= ModelAset::KATEGORI_TANAH ?>"><?= ModelAset::KATEGORI_TANAH ?></option>
                        <option value="<?= ModelAset::KATEGORI_PERALATAN ?>"><?= ModelAset::KATEGORI_PERALATAN ?></option>
                        <option value="<?= ModelAset::KATEGORI_BANGUNAN ?>"><?= ModelAset::KATEGORI_BANGUNAN ?></option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="tahun_pengadaan" class="form-control" value="<?= $tahun_pengadaan ?>">
                        <option value="">- Tahun Pengadaan -</option>
                        <?php for ($i = 2010; $i <= date('Y'); $i++): ?>
                            <option value="<?=$i;?>"><?=$i;?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-block btn-outline-primary">Filter</button>
                </div>
                <div class="col-md-1">
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
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Tahun Pengadaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($aset as $row): ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$row['kode_aset'];?></td>
                        <td><?=$row['kategori_aset'];?></td>
                        <td><?=$row['nama_aset'];?></td>
                        <td><?=$row['tahun_pengadaan'];?></td>
                        <td>
                            <a href="<?=base_url('aset_wujud/detail/'.$row['id_aset'])?>" class="btn btn-success btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?=base_url('aset_wujud/edit/'.$row['id_aset'])?>" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?=base_url('aset_wujud/hapus/'.$row['id_aset'])?>" class="btn btn-danger btn-sm tombol-hapus">
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
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Tahun Pengadaan</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="card-footer"></div>
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