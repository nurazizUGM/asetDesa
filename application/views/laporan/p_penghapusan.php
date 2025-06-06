<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel="stylesheet" href="<?= base_url() ?>src/css/laporan.css">

  <title>Data Aset</title>
</head>

<body>
  <meta http-equiv="REFRESH" content="5; url=<?= base_url('laporan/penghapusan') ?>">
  <div class="container">
    <div class="row pt-4">
      <div class="col-md-2">
        <img src="<?= base_url() ?>src/img/logo/AdminLTELogo.png" class="kiri" alt="">
      </div>
      <div class="col-md-10 text-center">
        <h2>NAMA YAYASAN</h2>
        <h3>NAMA SEKOLAH</h3>
        <P>Alamat </P>
      </div>
    </div>
    <hr style="border: 1px solid black;">
    <div class="row">
      <div class="col text-center">
        <h5>BERITA ACARA PENGHAPUSAN ASET</h5>
      </div>
    </div>
    <div class="row">
      <div class="col text-left">
        <p>Pada hari ini tanggal <?= tgl_indo(date('Y-m-d')); ?></p>
      </div>
    </div>
    <div class="row pt-3">
      <div class="col text-center">
        <table class="table table-bordered">
          <thead>
            <th>NO.</th>
            <th>NAMA</th>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($aset as $row):
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_aset'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="5"><b>Jumlah</b></td>
              <td><?= laporan(count($aset)); ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col text-left">
        <p>Aset tersebut telah diperiksa dan terdapat rusak/cacat produksi dan tidak memungkinkan untuk digunakan kembali</p>
      </div>
    </div>
    <div class="row">
      <div class="col text-left">
        <p>Demikian Berita Acara ini kami buat berdasarkan keadaan yang sebenarnya. Atas perhatian dan kerjasamanya kami mengucapkan terima kasih.</p>
      </div>
    </div>
    <div class="row pt-4">
      <div class="col-md-6">
        <p>Mengetahui, </p>
        <p class="ex1">Kepala Sekolah</p>
        Nama Kepsek</br>
        NIP.
      </div>
      <div class="col-md-6 text-right">
        <p>Tempat, <?= tgl_indo(date('Y-m-d')) ?></p>
        <p class="ex1">WK. Sapras</p>
        Nama kepala</br>
        NIP. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </div>
    </div>
  </div>

  <script>
    window.print();
  </script>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>