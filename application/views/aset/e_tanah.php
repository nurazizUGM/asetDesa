<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Tanah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Data Tanah</h2>
        <form action="<?= site_url('tanah/update/'.$tanah->id) ?>" method="post">
            <div class="mb-3">
                <label>Jenis Barang</label>
                <input type="text" name="jenis_barang" class="form-control" value="<?= $tanah->jenis_barang ?>" required>
            </div>
            <div class="mb-3">
                <label>Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" value="<?= $tanah->kode_barang ?>" required>
            </div>
            <div class="mb-3">
                <label>NUP</label>
                <input type="text" name="nup" class="form-control" value="<?= $tanah->nup ?>" required>
            </div>
            <div class="mb-3">
                <label>Luas (m²)</label>
                <input type="number" name="luas" class="form-control" step="0.01" value="<?= $tanah->luas ?>" required>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="letak_alamat" class="form-control" required><?= $tanah->letak_alamat ?></textarea>
            </div>
            <div class="mb-3">
                <label>Tahun Pengadaan</label>
                <input type="number" name="tahun_pengadaan" class="form-control" value="<?= $tanah->tahun_pengadaan ?>" required>
            </div>
            <div class="mb-3">
                <label>Harga Tanah</label>
                <input type="number" name="harga_tanah" class="form-control" value="<?= $tanah->harga_tanah ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= site_url('tanah') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
