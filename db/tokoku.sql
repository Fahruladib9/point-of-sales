-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk tokoku
CREATE DATABASE IF NOT EXISTS `tokoku` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tokoku`;

-- membuang struktur untuk table tokoku.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `kategori` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel tokoku.kategori: ~3 rows (lebih kurang)
INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
	(1, 'makanan'),
	(3, 'alat tulis'),
	(4, 'alat olahraga');

-- membuang struktur untuk table tokoku.product
CREATE TABLE IF NOT EXISTS `product` (
  `id_product` int NOT NULL AUTO_INCREMENT,
  `kode_product` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_product` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `unit` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga_beli` int NOT NULL DEFAULT '0',
  `harga_jual` int NOT NULL DEFAULT '0',
  `jumlah` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_product`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel tokoku.product: ~10 rows (lebih kurang)
INSERT INTO `product` (`id_product`, `kode_product`, `nama_product`, `kategori`, `unit`, `harga_beli`, `harga_jual`, `jumlah`, `created_at`, `updated_at`) VALUES
	(4, 'BRG001', 'Pensil 2b', 'alat tulis', 'Pcs', 2500, 3000, 115, '2024-02-11 10:45:59', '2024-03-26 17:50:17'),
	(5, 'BRG002', 'buku tulis sidu', 'alat tulis', 'Kg', 4300, 5000, 54, '2024-02-11 10:46:25', '2024-02-24 08:15:31'),
	(6, 'BRG003', 'panci', 'masak', 'Pcs', 33000, 42000, 33, '2024-02-11 12:59:38', '2024-02-24 08:14:19'),
	(13, 'BRG009', 'penghapus', 'alat tulis', 'Pcs', 720, 1250, 13, '2024-02-13 10:43:01', '2024-02-24 08:14:55'),
	(14, 'BRG010', 'pensil', 'alat tulis', 'Pcs', 500, 1500, 20, '2024-02-16 20:15:40', '2024-02-27 07:48:47'),
	(15, 'BRG011', 'sukro', 'makanan', 'pcs', 500, 1000, 24, '2024-02-16 20:17:02', '2024-03-26 17:37:27'),
	(16, 'BRG012', 'kacang kulit', 'makanan', 'Pcs', 1000, 1500, 64, '2024-02-17 13:08:15', '2024-02-17 13:08:15'),
	(17, 'BRG013', 'kacang atom', 'makanan', 'Pcs', 1000, 1500, 38, '2024-02-17 13:08:57', '2024-03-26 17:50:17'),
	(18, 'BRG014', 'tipe-x', 'alat tulis', 'Pcs', 1000, 3000, 22, '2024-02-17 13:10:31', '2024-03-26 17:50:17'),
	(19, 'BRG015', 'baigon semprot', 'makanan', 'Pcs', 18500, 22000, 136, '2024-02-17 13:15:14', '2024-03-07 10:32:05');

-- membuang struktur untuk table tokoku.riwayat_transaksi
CREATE TABLE IF NOT EXISTS `riwayat_transaksi` (
  `id_riwayatTransaksi` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL DEFAULT '0',
  `no_faktur` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode_product` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_product` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `total` int NOT NULL DEFAULT '0',
  `harga_beli` int NOT NULL DEFAULT '0',
  `harga_jual` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_riwayatTransaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel tokoku.riwayat_transaksi: ~6 rows (lebih kurang)
INSERT INTO `riwayat_transaksi` (`id_riwayatTransaksi`, `id_product`, `no_faktur`, `kode_product`, `nama_product`, `jumlah`, `total`, `harga_beli`, `harga_jual`, `created_at`, `updated_at`) VALUES
	(18, 4, 'TRX-240326001', 'BRG001', 'Pensil 2b', 5, 15000, 0, 3000, '2024-03-26 17:48:01', '2024-03-26 17:48:01'),
	(19, 17, 'TRX-240326001', 'BRG013', 'kacang atom', 1, 1500, 0, 1500, '2024-03-26 17:48:01', '2024-03-26 17:48:01'),
	(20, 18, 'TRX-240326001', 'BRG014', 'tipe-x', 1, 3000, 0, 3000, '2024-03-26 17:48:01', '2024-03-26 17:48:01'),
	(21, 4, 'TRX-240326002', 'BRG001', 'Pensil 2b', 5, 15000, 0, 3000, '2024-03-26 17:50:17', '2024-03-26 17:50:17'),
	(23, 18, 'TRX-240326002', 'BRG014', 'tipe-x', 1, 3000, 0, 3000, '2024-03-26 17:50:17', '2024-03-26 17:50:17');

-- membuang struktur untuk table tokoku.stok_keluar
CREATE TABLE IF NOT EXISTS `stok_keluar` (
  `id_stokKeluar` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL DEFAULT '0',
  `kode_transaksi` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_product` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `keterangan` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_stokKeluar`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel tokoku.stok_keluar: ~2 rows (lebih kurang)
INSERT INTO `stok_keluar` (`id_stokKeluar`, `id_product`, `kode_transaksi`, `nama_product`, `jumlah`, `keterangan`, `tanggal`) VALUES
	(2, 4, 'TK240219001', 'Pensil 2b', 6, 'patah', '2024-02-19'),
	(3, 14, 'TK240227002', 'pensil', 2, 'patah', '2024-02-27'),
	(4, 19, 'TK240307003', 'baigon semprot', 136, 'habis', '2024-03-07');

-- membuang struktur untuk table tokoku.stok_masuk
CREATE TABLE IF NOT EXISTS `stok_masuk` (
  `id_stokMasuk` int NOT NULL AUTO_INCREMENT,
  `id_product` int NOT NULL DEFAULT '0',
  `kode_transaksi` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_product` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` int NOT NULL DEFAULT '0',
  `suplier` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_stokMasuk`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel tokoku.stok_masuk: ~4 rows (lebih kurang)
INSERT INTO `stok_masuk` (`id_stokMasuk`, `id_product`, `kode_transaksi`, `nama_product`, `jumlah`, `suplier`, `tanggal`) VALUES
	(12, 6, 'TM240218001', 'panci', 3, 'PT. Maju Mundur', '2024-02-18'),
	(13, 13, 'TM240218002', 'penghapus', 3, 'PT. Maju Mundur', '2024-02-17'),
	(14, 4, 'TM240227003', 'Pensil 2b', 10, 'PT. Maju Mundur', '2024-02-27'),
	(15, 14, 'TM240227004', 'pensil', 10, 'PT. Maju Mundur', '2024-02-27');

-- membuang struktur untuk table tokoku.suplier
CREATE TABLE IF NOT EXISTS `suplier` (
  `id_suplier` int NOT NULL AUTO_INCREMENT,
  `suplier` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel tokoku.suplier: ~3 rows (lebih kurang)
INSERT INTO `suplier` (`id_suplier`, `suplier`) VALUES
	(1, 'PT. Maju Mundur'),
	(2, 'PT. Mencari Cinta Sejati'),
	(7, 'PT. Indofood');

-- membuang struktur untuk table tokoku.unit
CREATE TABLE IF NOT EXISTS `unit` (
  `id_unit` int NOT NULL AUTO_INCREMENT,
  `unit` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel tokoku.unit: ~2 rows (lebih kurang)
INSERT INTO `unit` (`id_unit`, `unit`) VALUES
	(1, 'Pcs'),
	(2, 'Kg');

-- membuang struktur untuk table tokoku.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `username` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `akses` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Membuang data untuk tabel tokoku.users: ~2 rows (lebih kurang)
INSERT INTO `users` (`id_users`, `username`, `password`, `nama`, `akses`) VALUES
	(1, 'sudendev', 'admin', 'Fahrul Adib', 'admin'),
	(5, 'ridwan', 'ridwan', 'M. Ridwan Tri Saputra', 'kasir'),
	(6, 'fbys', 'pebs', 'Feby Saputra', 'kasir');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
