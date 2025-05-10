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
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Data Aset</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('aset_wujud') ?>">Berwujud</a></li>
                        <li class="breadcrumb-item active">Tambah Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="flash-data-gagal" data-flashdatagagal="<?= $this->session->flashdata('gagal'); ?>"></div>

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
                <form class="form-horizontal" action="<?= base_url('aset_wujud/simpan') ?>" enctype="multipart/form-data" autocomplete="off" method="post">
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
                            <label for="kategori_aset" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-6">
                                <select name="kategori_aset" class="form-control" required>
                                    <option value="">- Pilih --</option>
                                    <option value="<?= ModelAset::KATEGORI_TANAH ?>"><?= ModelAset::KATEGORI_TANAH ?></option>
                                    <option value="<?= ModelAset::KATEGORI_PERALATAN ?>"><?= ModelAset::KATEGORI_PERALATAN ?></option>
                                    <option value="<?= ModelAset::KATEGORI_BANGUNAN ?>"><?= ModelAset::KATEGORI_BANGUNAN ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="luas" class="col-sm-2 col-form-label">Luas (m<sup>2</sup>)</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="luas" data-required>
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="alamat" data-required>
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="kegunaan" class="col-sm-2 col-form-label" data-required>Kegunaan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="kegunaan">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="latitude_longitude" class="col-sm-2 col-form-label">Koordinat</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="latitude" placeholder="Latitude">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" name="longitude" placeholder="Longitude">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="nilai_likuidasi" class="col-sm-2 col-form-label">Nilai likuidasi</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="nilai_likuidasi">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="tersedia" class="col-sm-2 col-form-label">Tersedia untuk disewakan</label>
                            <div class="col-sm-6 d-flex align-items-center">
                              <div class="iradio checked mr-1">
                                <input type="radio" name="tersedia" id="tersedia[1]" value="0" checked>
                              </div>
                              <label for="tersedia[1]" class="mr-1 my-auto">Tidak Tersedia</label>

                              <div class="iradio ml-2 mr-1">
                                <input type="radio" name="tersedia" id="tersedia[2]" value="1">
                              </div>
                              <label for="tersedia[2]" class="mr-1 my-auto">Tersedia</label>
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="harga_satuan" class="col-sm-2 col-form-label">Harga tanah per meter</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="harga_satuan">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="harga_total" class="col-sm-2 col-form-label">Harga tanah</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="harga_total">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="harga_sewa_satuan" class="col-sm-2 col-form-label">Harga sewa per meter</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="harga_sewa_satuan">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="harga_sewa_total" class="col-sm-2 col-form-label">Harga sewa per tahun</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="harga_sewa_total">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="jarak_sumber_air" class="col-sm-2 col-form-label">Jarak dengan sumber air</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="jarak_sumber_air">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="jarak_jalan_utama" class="col-sm-2 col-form-label">Jarak jalan utama</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="jarak_jalan_utama">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="tanah">
                            <label for="foto" class="col-sm-2 col-form-label">Upload Gambar</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" name="foto" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="peralatan">
                            <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="merk" data-required>
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="peralatan">
                            <label for="bahan" class="col-sm-2 col-form-label">Bahan</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="bahan" data-required>
                            </div>
                        </div>
                        <div class="form-group row" data-kategori="peralatan" data-form="perolehan">
                            <label for="perolehan" class="col-sm-2 col-form-label">Perolehan (Rp)</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="perolehan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun_pengadaan" class="col-sm-2 col-form-label">Tahun Pengadaan</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="tahun_pengadaan" placeholder="YYYY" value="<?= date('Y') ?>" min="1900" max="<?= date('Y') ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('aset_wujud') ?>" class="btn btn-danger">Kembali</a>
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
        $('[data-kategori]').hide();
        $('select[name="kategori_aset"]').change(function() {
            var kategori = $(this).val();
            $('[data-kategori]').hide();
            $('[data-required]').prop('required', false);
            switch (kategori) {
                case '<?= ModelAset::KATEGORI_TANAH ?>':
                    $('[data-kategori="tanah"]').show();
                    $('[data-kategori="tanah"] [data-required]').prop('required', true);
                    break;
                case '<?= ModelAset::KATEGORI_PERALATAN ?>':
                    $('[data-kategori="peralatan"]').show();
                    $('[data-kategori="peralatan"] [data-required]').prop('required', true);
                    break;
                case '<?= ModelAset::KATEGORI_BANGUNAN ?>':
                    $('[data-form="perolehan"]').show();
                    break;
            }
        });
    });

    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "classic",
            placeholder: '-- Pilih --',
            ajax: {
                url: "<?= base_url('aset_wujud/cari') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        bar: params.term
                    };
                },
                processResults: function(data) {
                    var results = [];

                    $.each(data, function(index, item) {
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