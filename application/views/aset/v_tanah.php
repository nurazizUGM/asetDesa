<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Tanah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Data Tanah</h2>
        <a href="<?= site_url('tanah/add') ?>" class="btn btn-primary mb-3">Tambah Data</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Barang</th>
                    <th>Kode Barang</th>
                    <th>NUP</th>
                    <th>Luas (m²)</th>
                    <th>Alamat</th>
                    <th>Tahun</th>
                    <th>Harga Tanah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($tanah as $t): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $t->jenis_barang ?></td>
                    <td><?= $t->kode_barang ?></td>
                    <td><?= $t->nup ?></td>
                    <td><?= $t->luas ?></td>
                    <td><?= $t->letak_alamat ?></td>
                    <td><?= $t->tahun_pengadaan ?></td>
                    <td>Rp <?= number_format($t->harga_tanah, 2, ',', '.') ?></td>
                    <td>
                        <a href="<?= site_url('tanah/edit/'.$t->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= site_url('tanah/delete/'.$t->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
