<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
              <li class="breadcrumb-item"><a href="<?=base_url('aset_wujud')?>">Berwujud</a></li>
              <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="flash-data-gagal" data-flashdatagagal="<?=$this->session->flashdata('gagal');?>"></div>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Tambah Data</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
        <?php if (validation_errors()): ?>
        <div class="alert alert-danger col-md-8 alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= validation_errors(); ?>
        </div>
    <?php endif ?>
    <p>*Keterangan Kode Aset :</p>
    <ul>
        <li>0000 = Kode Aset (0001/0002..dst) </li>
        <li>XXX = Kategori Aset (TIK,GEDUNG,dll)</li>
        <li>20XX = Tahun Perolehan Aset </li>
        <li> Template :
            <input type="text" size="30" value="0000/XXX/20XX" id="myInput">
            <button onclick="myFunction()">Salin Teks</button>
        </li>
    </ul>
    <form class="form-horizontal" action="<?=base_url('aset_wujud/simpan')?>" autocomplete="off" method="post">
        <div class="card-body">
            <div class="form-group row">
                <label for="kode_aset" class="col-sm-2 col-form-label">Kode Aset*</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="kode_aset" placeholder="0000/XXX/20XX" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_aset" class="col-sm-2 col-form-label">Nama Aset</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_aset" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="kategori" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="merek" class="col-sm-2 col-form-label">Merek</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="merek">
                </div>
            </div>
            <div class="form-group row">
                <label for="tahun_perolehan" class="col-sm-2 col-form-label">Tahun Perolehan</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="tahun_perolehan" min="1900" max="2100" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Aset</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lokasi" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="volume" class="col-sm-2 col-form-label">Volume</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="volume" min="1" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="satuan" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="harga" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="sewa" class="col-sm-2 col-form-label">Harga Sewa</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="sewa" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                <div class="col-sm-6">
                    <select name="kondisi" class="form-control" required>
                        <option value="">- Pilih --</option>
                        <option value="Baik">Baik</option>
                        <option value="Renovasi">Renovasi</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="status_aset" class="col-sm-2 col-form-label">Status Aset</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="status_aset" value="Aktif" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="umur_ekonomis" class="col-sm-2 col-form-label">Umur Ekonomis</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="umur_ekonomis" min="1">
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_bantuan" class="col-sm-2 col-form-label">Jenis Bantuan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="jenis_bantuan">
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_aset" class="col-sm-2 col-form-label">Jenis Aset</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="jenis_aset" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="generate" class="col-sm-2 col-form-label">Generate QR Code?</label>
                <div class="col-sm-6">
                    <input type="checkbox" name="generate">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="<?=base_url('aset_wujud')?>" class="btn btn-danger">Kembali</a>
            <button type="submit" class="btn btn-info">Simpan</button>
        </div>
    </form>
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
  <!-- /.content-wrapper -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script>
    function myFunction() {
      var copyText = document.getElementById("myInput");
      copyText.select();
      copyText.setSelectionRange(0, 99999)
      document.execCommand("copy");
      alert("Teks berhasil disalin: " + copyText.value);
    }

    $(document).ready(function() {
      $('.js-example-basic-single').select2({
        theme: "classic",
        placeholder : '-- Pilih --',
        ajax : {
          url : "<?=base_url('aset_wujud/cari')?>" ,
          dataType : 'json',
          delay : 250,
          data : function(params) {
              return{
                bar : params.term
              };
          },
          processResults: function (data) {
            var results = [];

            $.each(data, function(index,item) {
              results.push({
                id: item.id_barang,
                text: item.nama_barang
              });
            });
            return {
              results: results
            };
          }
        }
      });
    });
  </script>
