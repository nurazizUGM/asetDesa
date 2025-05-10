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
                        <li class="breadcrumb-item"><a href="<?= base_url('aset_berwujud') ?>">Berwujud</a></li>
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
                        <img src="<?= base_url() ?>src/img/qrcode/<?= $aset['qr_code']; ?>" style="height:150px;width:150px;">
                    </center>
                    <br />
                <?php endif ?>

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td width="150px">Kode Aset</td>
                            <td width="50px">:</td>
                            <td><?= $aset['kode_aset'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Aset</td>
                            <td>:</td>
                            <td><?= $aset['nama_aset'] ?></td>
                        </tr>
                        <tr>
                            <td>Tahun Perolehan</td>
                            <td>:</td>
                            <td><?= $aset['tahun_pengadaan'] ?></td>
                        </tr>
                        <tr>
                            <td>Kategori Aset</td>
                            <td>:</td>
                            <td><?= $aset['kategori_aset'] ?></td>
                        </tr>

                        <?php if ($aset['kategori_aset'] == ModelAset::KATEGORI_TANAH): ?>
                            <tr>
                                <td>Luas</td>
                                <td>:</td>
                                <td><?= $aset['detail']['luas'] ?> m²</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><?= $aset['detail']['alamat'] ?></td>
                            </tr>
                            <tr>
                                <td>Kegunaan</td>
                                <td>:</td>
                                <td><?= $aset['detail']['kegunaan'] ?></td>
                            </tr>
                            <tr>
                                <td>Latitude</td>
                                <td>:</td>
                                <td><?= $aset['detail']['latitude'] ?></td>
                            </tr>
                            <tr>
                                <td>Longitude</td>
                                <td>:</td>
                                <td><?= $aset['detail']['longitude'] ?></td>
                            </tr>
                            <tr>
                                <td>Nilai Likuidasi</td>
                                <td>:</td>
                                <td><?= rupiah($aset['detail']['nilai_likuidasi']) ?></td>
                            </tr>
                            <tr>
                                <td>Tersedia untuk disewakan</td>
                                <td>:</td>
                                <td><?= $aset['detail']['tersedia'] ? 'Tersedia' : 'Tidak Tersedia' ?></td>
                            </tr>
                            <tr>
                                <td>Harga per m<sup>2</sup></td>
                                <td>:</td>
                                <td><?= rupiah($aset['detail']['harga_satuan']) ?></td>
                            </tr>
                            <tr>
                                <td>Harga Total</td>
                                <td>:</td>
                                <td><?= rupiah($aset['detail']['harga_total']) ?></td>
                            </tr>
                            <tr>
                                <td>Harga Sewa Satuan</td>
                                <td>:</td>
                                <td><?= rupiah($aset['detail']['harga_sewa_satuan']) ?></td>
                            </tr>
                            <tr>
                                <td>Harga Sewa Total</td>
                                <td>:</td>
                                <td><?= rupiah($aset['detail']['harga_sewa_total']) ?></td>
                            </tr>
                            <tr>
                                <td>Jarak ke Sumber Air</td>
                                <td>:</td>
                                <td><?= $aset['detail']['jarak_sumber_air'] ?> meter</td>
                            </tr>
                            <tr>
                                <td>Jarak ke Jalan Utama</td>
                                <td>:</td>
                                <td><?= $aset['detail']['jarak_jalan_utama'] ?> meter</td>
                            </tr>
                            <tr>
                                <td>Foto</td>
                                <td>:</td>
                                <td>
                                    <?php if (!empty($aset['detail']['foto'])): ?>
                                        <img src="<?= $aset['detail']['foto'] ?>" alt="Foto Aset" width="200px">
                                    <?php else: ?>
                                        Tidak ada foto tersedia
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php elseif ($aset['kategori_aset'] == ModelAset::KATEGORI_PERALATAN): ?>
                            <tr>
                                <td>Merek</td>
                                <td>:</td>
                                <td><?= $aset['detail']['merk'] ?></td>
                            </tr>
                            <tr>
                                <td>Bahan</td>
                                <td>:</td>
                                <td><?= $aset['detail']['bahan'] ?></td>
                            </tr>
                            <tr>
                                <td>Perolehan</td>
                                <td>:</td>
                                <td><?= rupiah($aset['detail']['perolehan']); ?></td>
                            </tr>
                        <?php elseif ($aset['kategori_aset'] == ModelAset::KATEGORI_BANGUNAN): ?>
                            <tr>
                                <td>Perolehan</td>
                                <td>:</td>
                                <td><?= rupiah($aset['detail']['perolehan']); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <a href="<?= base_url('aset_wujud') ?>">
                    <button type="button" class="btn btn-danger">Kembali</button>
                </a>
            </div>
        </div>

        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->