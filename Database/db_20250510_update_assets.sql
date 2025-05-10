-- Adminer 5.2.1 MariaDB 11.7.2-MariaDB-ubu2404 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `asets`;
CREATE TABLE `asets` (
  `id_aset` varchar(128) NOT NULL,
  `kode_aset` varchar(128) NOT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `nup_aset` varchar(128) NOT NULL,
  `kategori_aset` enum('Tanah','Peralatan & Mesin','Gedung & Bangunan') NOT NULL,
  `tahun_pengadaan` year(4) NOT NULL,
  `qr_code` varchar(128) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_aset`),
  UNIQUE KEY `kode_aset` (`kode_aset`),
  KEY `id_barang` (`nama_aset`),
  KEY `id_lokasi` (`nup_aset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `aset_gedung_bangunan`;
CREATE TABLE `aset_gedung_bangunan` (
  `id_aset` varchar(128) NOT NULL,
  `perolehan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aset`),
  CONSTRAINT `aset_gedung_bangunan_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `aset_peralatan_mesin`;
CREATE TABLE `aset_peralatan_mesin` (
  `id_aset` varchar(128) NOT NULL,
  `merk` varchar(128) DEFAULT NULL,
  `bahan` varchar(128) DEFAULT NULL,
  `perolehan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_aset`),
  CONSTRAINT `aset_peralatan_mesin_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `aset_tanah`;
CREATE TABLE `aset_tanah` (
  `id_aset` varchar(128) NOT NULL,
  `luas` double NOT NULL,
  `alamat` text NOT NULL,
  `kegunaan` varchar(128) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `nilai_likuidasi` int(11) DEFAULT NULL,
  `tersedia` tinyint(1) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `harga_total` int(11) DEFAULT NULL,
  `harga_sewa_satuan` int(11) DEFAULT NULL,
  `harga_sewa_total` int(11) DEFAULT NULL,
  `jarak_sumber_air` int(11) DEFAULT NULL,
  `jarak_jalan_utama` int(11) DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_aset`),
  CONSTRAINT `aset_tanah_ibfk_3` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `merek` varchar(128) NOT NULL,
  `tahun_perolehan` year(4) NOT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_jenis` (`id_kategori`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `data_aset`;
CREATE TABLE `data_aset` (
  `id_aset` int(11) NOT NULL AUTO_INCREMENT,
  `nama_aset` varchar(128) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  PRIMARY KEY (`id_aset`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `kategori_barang`;
CREATE TABLE `kategori_barang` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kategori` varchar(128) DEFAULT NULL,
  `nama_kategori` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `keputusan_pengadaan`;
CREATE TABLE `keputusan_pengadaan` (
  `id_nilai` int(11) NOT NULL AUTO_INCREMENT,
  `id_aset` int(11) DEFAULT NULL,
  `id_spesifikasi` int(11) DEFAULT NULL,
  `id_kualitas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `id_spesifikasi` (`id_spesifikasi`),
  KEY `id_kualitas` (`id_kualitas`),
  KEY `id_aset` (`id_aset`),
  CONSTRAINT `keputusan_pengadaan_ibfk_1` FOREIGN KEY (`id_spesifikasi`) REFERENCES `kriteria_spesifikasi` (`id_spesifikasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `keputusan_pengadaan_ibfk_2` FOREIGN KEY (`id_kualitas`) REFERENCES `kriteria_kualitas` (`id_kualitas`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `kriteria_kualitas`;
CREATE TABLE `kriteria_kualitas` (
  `id_kualitas` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(128) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_kualitas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `kriteria_spesifikasi`;
CREATE TABLE `kriteria_spesifikasi` (
  `id_spesifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(128) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_spesifikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `lokasi_aset`;
CREATE TABLE `lokasi_aset` (
  `id_lokasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lokasi` varchar(128) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `monitoring_aset`;
CREATE TABLE `monitoring_aset` (
  `id_monitoring` int(11) NOT NULL AUTO_INCREMENT,
  `id_aset` varchar(128) DEFAULT NULL,
  `kerusakan` text DEFAULT NULL,
  `akibat` text DEFAULT NULL,
  `faktor` text DEFAULT NULL,
  `monitoring` text DEFAULT NULL,
  `pemeliharaan` text DEFAULT NULL,
  `jml_rusak` varchar(128) DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_monitoring`),
  KEY `id_aset` (`id_aset`),
  CONSTRAINT `monitoring_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `pengadaan`;
CREATE TABLE `pengadaan` (
  `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nama_aset` varchar(128) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` varchar(128) DEFAULT NULL,
  `harga_satuan` double DEFAULT NULL,
  `tahun_pengadaan` varchar(4) DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pengadaan`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `pengadaan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


DROP TABLE IF EXISTS `penghapusan`;
CREATE TABLE `penghapusan` (
  `id_penghapusan` int(11) NOT NULL AUTO_INCREMENT,
  `id_aset` varchar(128) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `faktor` text DEFAULT NULL,
  `tgl_penghapusan` date DEFAULT NULL,
  `status` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_penghapusan`),
  KEY `id_aset` (`id_aset`),
  CONSTRAINT `penghapusan_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `asets` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(6) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(125) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `jabatan` varchar(128) NOT NULL,
  `role` enum('1','2','3') DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `password`, `jabatan`, `role`, `foto`) VALUES
(1,	'Administrator',	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'Administrator',	'1',	'1a8e897e32abe9537b1183c8e27611b8.png'),
(8,	'Natalia Sukmalina',	'staff',	'25d55ad283aa400af464c76d713c07ad',	'Staf General Affair',	'3',	'3a635aedf846db95f937cb65e73a3e3e.jpg'),
(9,	'Binanga Sinaga',	'manager',	'25d55ad283aa400af464c76d713c07ad',	'Manager General Affair',	'2',	NULL);

-- 2025-05-10 12:24:59 UTC
