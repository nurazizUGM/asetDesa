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
                        <li class="breadcrumb-item active">Ubah Data</li>
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
                <h3 class="card-title">Edit Data</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="<?= base_url('aset_wujud/ubah') ?>" enctype="multipart/form-data" autocomplete="off" method="post">
                    <input type="hidden" name="id_aset" value="<?= $aset['id_aset'] ?>">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="kode_aset" class="col-sm-2 col-form-label">Kode Aset*</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="kode_aset" value="<?= $aset['kode_aset'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_aset" class="col-sm-2 col-form-label">Nama Aset</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="nama_aset" value="<?= $aset['nama_aset'] ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategori_aset" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="<?= $aset['kategori_aset'] ?>" readonly>
                            </div>
                        </div>
                        <?php if ($aset['kategori_aset'] == ModelAset::KATEGORI_TANAH) : ?>
                            <div class="form-group row">
                                <label for="luas" class="col-sm-2 col-form-label">Luas (m<sup>2</sup>)</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="luas" value="<?= $aset['detail']['luas'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="alamat" value="<?= $aset['detail']['alamat'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kegunaan" class="col-sm-2 col-form-label">Kegunaan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="kegunaan" value="<?= $aset['detail']['kegunaan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="latitude_longitude" class="col-sm-2 col-form-label">Koordinat</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name="latitude" placeholder="Latitude" value="<?= $aset['detail']['latitude'] ?>">
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" name="longitude" placeholder="Longitude" value="<?= $aset['detail']['longitude'] ?>">
                                </div>
                            </div>
                            <div class="form-group row" data-kategori="tanah">
                                <label for="nilai_likuidasi" class="col-sm-2 col-form-label">Nilai likuidasi</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="nilai_likuidasi" value="<?= $aset['detail']['nilai_likuidasi'] ?>">
                                </div>
                            </div>
                            <div class="form-group row" data-kategori="tanah">
                                <label for="tersedia" class="col-sm-2 col-form-label">Tersedia untuk disewakan</label>
                                <div class="col-sm-6 d-flex align-items-center">
                                  <div class="iradio checked mr-1">
                                    <input type="radio" name="tersedia" id="tersedia[1]" value="0" <?= $aset['detail']['tersedia'] ? '' : 'checked' ?>>
                                  </div>
                                  <label for="tersedia[1]" class="mr-1 my-auto">Tidak Tersedia</label>

                                  <div class="iradio ml-2 mr-1">
                                    <input type="radio" name="tersedia" id="tersedia[2]" value="1" <?= $aset['detail']['tersedia'] ? 'checked' : '' ?>>
                                  </div>
                                  <label for="tersedia[2]" class="mr-1 my-auto">Tersedia</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga_satuan" class="col-sm-2 col-form-label">Harga tanah per meter</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="harga_satuan" value="<?= $aset['detail']['harga_satuan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga_total" class="col-sm-2 col-form-label">Harga tanah</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="harga_total" value="<?= $aset['detail']['harga_total'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga_sewa_satuan" class="col-sm-2 col-form-label">Harga sewa per meter</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="harga_sewa_satuan" value="<?= $aset['detail']['harga_sewa_satuan'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="harga_sewa_total" class="col-sm-2 col-form-label">Harga sewa per tahun</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="harga_sewa_total" value="<?= $aset['detail']['harga_sewa_total'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jarak_sumber_air" class="col-sm-2 col-form-label">Jarak dengan sumber air</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="jarak_sumber_air" value="<?= $aset['detail']['jarak_sumber_air'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jarak_jalan_utama" class="col-sm-2 col-form-label">Jarak jalan utama</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="jarak_jalan_utama" value="<?= $aset['detail']['jarak_jalan_utama'] ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Gambar</label>
                                <div class="col-sm-6">
                                    <?php if (!empty($aset['detail']['foto'])) : ?>
                                        <div class="mb-2">
                                            <img src="<?= base_url($aset['detail']['foto']) ?>" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="foto" class="col-sm-2 col-form-label">Ubah Gambar</label>
                                <div class="col-sm-6">
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                </div>
                            </div>
                        <?php elseif ($aset['kategori_aset'] == ModelAset::KATEGORI_PERALATAN) : ?>
                            <div class="form-group row">
                                <label for="merk" class="col-sm-2 col-form-label">Merk</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="merk" value="<?= $aset['detail']['merk'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bahan" class="col-sm-2 col-form-label">Bahan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="bahan" value="<?= $aset['detail']['bahan'] ?>" required>
                                </div>
                            </div>
                            <div class="form-group row" data-form="perolehan">
                                <label for="perolehan" class="col-sm-2 col-form-label">Perolehan (Rp)</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="perolehan" value="<?= $aset['detail']['perolehan'] ?>">
                                </div>
                            </div>
                        <?php elseif ($aset['kategori_aset'] == ModelAset::KATEGORI_BANGUNAN) : ?>
                            <div class="form-group row" data-form="perolehan">
                                <label for="perolehan" class="col-sm-2 col-form-label">Perolehan (Rp)</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="perolehan" value="<?= $aset['detail']['perolehan'] ?>">
                                </div>
                            </div>
                        <?php endif; ?>
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

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.id_barang').select2({
            theme: "classic",
            placeholder: '-- Pilih --'
        });
    });
</script>