SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `asets` (
  `id_aset` varchar(128) NOT NULL,
  `kode_aset` varchar(128) NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `nup_aset` varchar(128) NOT NULL,
  `kategori_aset` enum('Tanah','Peralatan & Mesin','Gedung & Bangunan') NOT NULL,
  `tahun_pengadaan` year(4) NOT NULL,
  `qr_code` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `aset_gedung_bangunan` (
  `id_aset` varchar(128) NOT NULL,
  `perolehan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `aset_peralatan_mesin` (
  `id_aset` varchar(128) NOT NULL,
  `merk` varchar(128) DEFAULT NULL,
  `bahan` varchar(128) DEFAULT NULL,
  `perolehan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `aset_tanah` (
  `id_aset` varchar(128) NOT NULL,
  `luas` double NOT NULL,
  `alamat` text NOT NULL,
  `kegunaan` varchar(128) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `harga_total` int(11) DEFAULT NULL,
  `harga_sewa_satuan` int(11) DEFAULT NULL,
  `harga_sewa_total` int(11) DEFAULT NULL,
  `jarak_sumber_air` int(11) DEFAULT NULL,
  `jarak_jalan_utama` int(11) DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merek` varchar(128) NOT NULL,
  `tahun_perolehan` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `data_aset` (
  `id_aset` int(11) NOT NULL,
  `nama_aset` varchar(128) DEFAULT NULL,
  `harga` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `kategori_barang` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(128) DEFAULT NULL,
  `nama_kategori` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `keputusan_pengadaan` (
  `id_nilai` int(11) NOT NULL,
  `id_aset` int(11) DEFAULT NULL,
  `id_spesifikasi` int(11) DEFAULT NULL,
  `id_kualitas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `kriteria_kualitas` (
  `id_kualitas` int(11) NOT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `kriteria_spesifikasi` (
  `id_spesifikasi` int(11) NOT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `lokasi_aset` (
  `id_lokasi` int(11) NOT NULL,
  `nama_lokasi` varchar(128) NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `monitoring_aset` (
  `id_monitoring` int(11) NOT NULL,
  `id_aset` varchar(128) DEFAULT NULL,
  `kerusakan` text DEFAULT NULL,
  `akibat` text DEFAULT NULL,
  `faktor` text DEFAULT NULL,
  `monitoring` text DEFAULT NULL,
  `pemeliharaan` text DEFAULT NULL,
  `jml_rusak` varchar(128) DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `pengadaan` (
  `id_pengadaan` int(11) NOT NULL,
  `id_lokasi` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_aset` varchar(128) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` varchar(128) DEFAULT NULL,
  `harga_satuan` double DEFAULT NULL,
  `tahun_pengadaan` varchar(4) DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `penghapusan` (
  `id_penghapusan` int(11) NOT NULL,
  `id_aset` varchar(128) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `faktor` text DEFAULT NULL,
  `tgl_penghapusan` date DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

CREATE TABLE `users` (
  `id_user` int(6) NOT NULL,
  `nama_user` varchar(125) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `role` enum('1','2','3') DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `password`, `jabatan`, `role`, `foto`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', '1', '1a8e897e32abe9537b1183c8e27611b8.png'),
(8, 'Natalia Sukmalina', 'staff', '25d55ad283aa400af464c76d713c07ad', 'Staf General Affair', '3', '3a635aedf846db95f937cb65e73a3e3e.jpg'),
(9, 'Binanga Sinaga', 'manager', '25d55ad283aa400af464c76d713c07ad', 'Manager General Affair', '2', NULL);


ALTER TABLE `asets`
  ADD PRIMARY KEY (`id_aset`),
  ADD UNIQUE KEY `kode_aset` (`kode_aset`),
  ADD KEY `id_barang` (`nama_aset`),
  ADD KEY `id_lokasi` (`nup_aset`);

ALTER TABLE `aset_gedung_bangunan`
  ADD PRIMARY KEY (`id_aset`);

ALTER TABLE `aset_peralatan_mesin`
  ADD PRIMARY KEY (`id_aset`);

ALTER TABLE `aset_tanah`
  ADD PRIMARY KEY (`id_aset`);

ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_jenis` (`id_kategori`);

ALTER TABLE `data_aset`
  ADD PRIMARY KEY (`id_aset`);

ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

ALTER TABLE `keputusan_pengadaan`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_spesifikasi` (`id_spesifikasi`),
  ADD KEY `id_kualitas` (`id_kualitas`),
  ADD KEY `id_aset` (`id_aset`);

ALTER TABLE `kriteria_kualitas`
  ADD PRIMARY KEY (`id_kualitas`);

ALTER TABLE `kriteria_spesifikasi`
  ADD PRIMARY KEY (`id_spesifikasi`);

ALTER TABLE `lokasi_aset`
  ADD PRIMARY KEY (`id_lokasi`);

ALTER TABLE `monitoring_aset`
  ADD PRIMARY KEY (`id_monitoring`),
  ADD KEY `id_aset` (`id_aset`);

ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`),
  ADD KEY `id_lokasi` (`id_lokasi`),
  ADD KEY `id_user` (`id_user`);

ALTER TABLE `penghapusan`
  ADD PRIMARY KEY (`id_penghapusan`),
  ADD KEY `id_aset` (`id_aset`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);


ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `data_aset`
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `keputusan_pengadaan`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `kriteria_kualitas`
  MODIFY `id_kualitas` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `kriteria_spesifikasi`
  MODIFY `id_spesifikasi` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lokasi_aset`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `monitoring_aset`
  MODIFY `id_monitoring` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `pengadaan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `penghapusan`
  MODIFY `id_penghapusan` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id_user` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `aset_gedung_bangunan`
  ADD CONSTRAINT `aset_gedung_bangunan_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE;

ALTER TABLE `aset_peralatan_mesin`
  ADD CONSTRAINT `aset_peralatan_mesin_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE;

ALTER TABLE `aset_tanah`
  ADD CONSTRAINT `aset_tanah_ibfk_3` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE;

ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `keputusan_pengadaan`
  ADD CONSTRAINT `keputusan_pengadaan_ibfk_1` FOREIGN KEY (`id_spesifikasi`) REFERENCES `kriteria_spesifikasi` (`id_spesifikasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keputusan_pengadaan_ibfk_2` FOREIGN KEY (`id_kualitas`) REFERENCES `kriteria_kualitas` (`id_kualitas`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `monitoring_aset`
  ADD CONSTRAINT `monitoring_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `pengadaan`
  ADD CONSTRAINT `pengadaan_ibfk_1` FOREIGN KEY (`id_lokasi`) REFERENCES `lokasi_aset` (`id_lokasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengadaan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `penghapusan`
  ADD CONSTRAINT `penghapusan_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
