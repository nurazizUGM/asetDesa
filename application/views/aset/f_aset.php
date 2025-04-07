<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url() ?>src/backend/dist/img/favicon.ico">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>iAsset - Sistem Manajemen Aset</title>
</head>

<body>

  <section>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="<?= base_url() ?>src/backend/dist/img/iaset.png" class="logo" width="50%">
        </a>
      </div>
    </nav>
  </section>

  <section class="detail-aset mt-5">
    <div class="container">
      <div class="row pt-4">
        <div class="col">
          <h4 align="center">Detail Aset</h4>
          <br />
          <table class="table table-striped" id="users">
            <tbody>
              <tr>
                <td width="100px">Kode Aset</td>
                <td width="50px">:</td>
                <td><?= $aset['kode_aset'] ?></td>
              </tr>
              <tr>
                <td width="100px">Nama Aset</td>
                <td width="50px">:</td>
                <td><?= $aset['nama_aset'] ?></td>
              </tr>
              <tr>
                <td width="200px">Kategori Aset</td>
                <td width="50px">:</td>
                <td><?= $aset['kategori_aset'] ?></td>
              </tr>
              <tr>
                <td width="100px">Tahun Perolehan</td>
                <td width="50px">:</td>
                <td><?= $aset['tahun_pengadaan'] ?></td>
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
                  <td>Harga Satuan</td>
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
      </div>
    </div>
  </section>


  <footer class="bg-dark text-white text-center pt-4">
    <strong>Copyright &copy; <script>
        document.write(new Date().getFullYear());
      </script> <a href="https://djardev.net" target="_blank">djardev</a></strong>
    <br />
  </footer>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>