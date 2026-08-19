/*
 Navicat Premium Data Transfer

 Source Server         : MysqlLocal
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_salsamotor

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 19/08/2026 20:42:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `kode` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barng` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idkategori` int UNSIGNED NOT NULL,
  `idsatuan` int UNSIGNED NOT NULL,
  `harga` double NOT NULL DEFAULT 0,
  `gambar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stok` int NOT NULL DEFAULT 0,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`kode`) USING BTREE,
  INDEX `barang_idkategori_foreign`(`idkategori` ASC) USING BTREE,
  INDEX `barang_idsatuan_foreign`(`idsatuan` ASC) USING BTREE,
  CONSTRAINT `barang_idkategori_foreign` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `barang_idsatuan_foreign` FOREIGN KEY (`idsatuan`) REFERENCES `satuan` (`idsatuan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES ('BRG0000001', 'Oli MPX 2 Matik 0.8L', 1, 3, 55000, '1786594902_136d47973ce83c7425aa.jpg', 48, '2026-08-13 04:13:52', '2026-08-13 08:49:49');
INSERT INTO `barang` VALUES ('BRG0000002', 'Oli Shell Advance AX7 10W-40', 1, 3, 65000, NULL, 23, '2026-08-13 04:13:52', '2026-08-13 08:18:05');
INSERT INTO `barang` VALUES ('BRG0000003', 'Kampas Rem Depan Vario 150', 5, 4, 45000, NULL, 12, '2026-08-13 04:13:52', '2026-08-18 08:52:56');
INSERT INTO `barang` VALUES ('BRG0000004', 'Busi Honda Genuine CPR9EA-9', 2, 1, 25000, NULL, 48, '2026-08-13 04:13:52', '2026-08-13 08:07:50');
INSERT INTO `barang` VALUES ('BRG0000005', 'Ban Luar FDR Sport XR Evo 90/80-14', 3, 1, 240000, NULL, 8, '2026-08-13 04:13:52', '2026-08-13 08:13:23');

-- ----------------------------
-- Table structure for barangmasuk
-- ----------------------------
DROP TABLE IF EXISTS `barangmasuk`;
CREATE TABLE `barangmasuk`  (
  `faktur` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggalfaktur` date NOT NULL,
  `totalharga` double NOT NULL DEFAULT 0,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`faktur`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of barangmasuk
-- ----------------------------
INSERT INTO `barangmasuk` VALUES ('BM-20260813-001', '2026-08-13', 1220000, 'Pembelian stok awal sparepart supplier resmi', '2026-08-13 06:57:55', '2026-08-13 06:57:55');
INSERT INTO `barangmasuk` VALUES ('BM-20260813-002', '2026-08-13', 920000, 'TES', '2026-08-13 07:33:56', '2026-08-13 07:34:26');

-- ----------------------------
-- Table structure for booking
-- ----------------------------
DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `merk_kendaraan` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nopol` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_servis` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_booking` date NOT NULL,
  `jam_booking` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keluhan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status` enum('menunggu','dikonfirmasi','ditolak','selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'menunggu',
  `catatan_admin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booking
-- ----------------------------

-- ----------------------------
-- Table structure for booking_servis
-- ----------------------------
DROP TABLE IF EXISTS `booking_servis`;
CREATE TABLE `booking_servis`  (
  `id_booking` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `kode_booking` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_pelanggan` int UNSIGNED NULL DEFAULT NULL,
  `nama_pelanggan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `merkkendaraan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nopol` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kodeservis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jenis_servis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `biaya` decimal(12, 2) NOT NULL DEFAULT 0.00,
  `tgl_booking` date NOT NULL,
  `jam_booking` time NOT NULL,
  `keluhan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `metode_pembayaran` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Transfer Bank BCA',
  `bukti_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_pembayaran` enum('menunggu_pembayaran','menunggu_konfirmasi','lunas','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'menunggu_konfirmasi',
  `status_booking` enum('menunggu_konfirmasi','diterima','diproses','selesai','dibatalkan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'menunggu_konfirmasi',
  `catatan_admin` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_booking`) USING BTREE,
  UNIQUE INDEX `kode_booking`(`kode_booking` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of booking_servis
-- ----------------------------
INSERT INTO `booking_servis` VALUES (3, 'BKG-20260814-0001', 6, 'Hendra Putra', '0823456789', 'Scoopy Stylish', 'BA 9999 BB', 'SRV0000003, SRV0000001, SRV0000004, SRV0000002', 'Ganti Oli & Cek Pengereman + Servis Rutin / Ringan + Tune Up Injeksi & Reset ECU + Servis Lengkap + Clean CVT', 210000.00, '2026-08-14', '09:00:00', 'ok', 'Transfer Bank BCA', NULL, 'ditolak', 'dibatalkan', 'Tolak', '2026-08-14 07:36:52', '2026-08-18 08:47:58');
INSERT INTO `booking_servis` VALUES (4, 'BKG-20260818-0001', 6, 'Hendra Putra', '0823456789', 'Scoopy Stylish', 'BA 9999 BB', 'SRV0000003, SRV0000001', 'Ganti Oli & Cek Pengereman + Servis Rutin / Ringan', 65000.00, '2026-08-18', '10:00:00', 'Motor Brebet', 'Transfer Bank BRI', '1787016984_affdbc8c69a982c447de.jpg', 'lunas', 'selesai', 'Work Order servis diselesaikan via Faktur #SV-20260818-001', '2026-08-18 08:35:43', '2026-08-18 08:52:56');
INSERT INTO `booking_servis` VALUES (6, 'BKG-20260819-0001', 6, 'Hendra Putra', '0823456789', 'Scoopy Stylish', 'BA 9999 BB', 'BKG-50K', 'Booking Servis & Pengecekan', 50000.00, '2026-08-19', '11:00:00', 'Tessssss', 'Transfer Bank BCA', '1787111843_728f4777086f72a4c886.jpg', 'lunas', 'diterima', 'Pembayaran telah diverifikasi dan disetujui oleh admin.', '2026-08-19 10:57:06', '2026-08-19 10:57:31');
INSERT INTO `booking_servis` VALUES (7, 'BKG-20260819-0002', 6, 'Hendra Putra', '0823456789', 'Scoopy Stylish', 'BA 9999 BB', 'BKG-50K', 'Booking Servis & Pengecekan', 50000.00, '2026-08-19', '11:00:00', 'TESSSSSSSSSSSSSSS', 'Transfer Bank BCA', '1787111875_14a0c66e0fec12587e4f.jpg', 'ditolak', 'dibatalkan', 'palsu', '2026-08-19 10:57:50', '2026-08-19 10:58:21');
INSERT INTO `booking_servis` VALUES (8, 'BKG-20260819-0003', 6, 'Hendra Putra', '0823456789', 'Scoopy Stylish', 'BA 9999 BB', 'BKG-50K', 'Booking Servis & Pengecekan', 50000.00, '2026-08-19', '13:00:00', 'Tes', 'Transfer Bank BCA', '1787112224_d3719feb99e28f78f202.jpg', 'lunas', 'diterima', 'Pembayaran telah diverifikasi dan disetujui oleh admin.', '2026-08-19 11:03:38', '2026-08-19 11:03:57');
INSERT INTO `booking_servis` VALUES (9, 'BKG-20260819-0004', 6, 'Hendra Putra', '0823456789', 'Scoopy Stylish', 'BA 9999 BB', 'BKG-50K', 'Booking Servis & Pengecekan', 50000.00, '2026-08-19', '13:00:00', 'Tes', 'Transfer Bank BCA', '1787112252_803ce961bb6c7fb64dc8.jpg', 'ditolak', 'dibatalkan', 'palsu', '2026-08-19 11:04:08', '2026-08-19 11:04:25');

-- ----------------------------
-- Table structure for detail_transaksi_servis
-- ----------------------------
DROP TABLE IF EXISTS `detail_transaksi_servis`;
CREATE TABLE `detail_transaksi_servis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `detfaktur` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detserviskode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detbiaya` double NOT NULL DEFAULT 0,
  `detailbrgkode` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detailhargajual` double NOT NULL DEFAULT 0,
  `detjml` double NOT NULL DEFAULT 1,
  `dettotaljual` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detail_transaksi_servis_detfaktur_foreign`(`detfaktur` ASC) USING BTREE,
  CONSTRAINT `detail_transaksi_servis_detfaktur_foreign` FOREIGN KEY (`detfaktur`) REFERENCES `transaksi_servis` (`faktur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_transaksi_servis
-- ----------------------------
INSERT INTO `detail_transaksi_servis` VALUES (1, 'SV-20260813-001', 'SRV001', 50000, NULL, 0, 1, 50000);
INSERT INTO `detail_transaksi_servis` VALUES (2, 'SV-20260813-001', NULL, 0, 'BRG001', 55000, 1, 55000);
INSERT INTO `detail_transaksi_servis` VALUES (3, 'SV-20260813-002', 'SRV002', 75000, NULL, 0, 1, 75000);
INSERT INTO `detail_transaksi_servis` VALUES (4, 'SV-20260813-002', NULL, 0, 'BRG002', 70000, 1, 70000);
INSERT INTO `detail_transaksi_servis` VALUES (5, 'SV-20260813-003', 'SRV0000003', 20000, NULL, 0, 1, 20000);
INSERT INTO `detail_transaksi_servis` VALUES (6, 'SV-20260813-003', NULL, 0, 'BRG0000001', 55000, 1, 55000);
INSERT INTO `detail_transaksi_servis` VALUES (7, 'SV-20260813-003', NULL, 0, 'BRG0000003', 45000, 1, 45000);
INSERT INTO `detail_transaksi_servis` VALUES (8, 'SV-20260818-001', 'SRV0000003', 20000, NULL, 0, 1, 20000);
INSERT INTO `detail_transaksi_servis` VALUES (9, 'SV-20260818-001', 'SRV0000001', 45000, NULL, 0, 1, 45000);
INSERT INTO `detail_transaksi_servis` VALUES (10, 'SV-20260818-001', NULL, 0, 'BRG0000003', 45000, 1, 45000);

-- ----------------------------
-- Table structure for detailbarangmasuk
-- ----------------------------
DROP TABLE IF EXISTS `detailbarangmasuk`;
CREATE TABLE `detailbarangmasuk`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `detfaktur` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detailbrgkode` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detailhargajual` double NOT NULL DEFAULT 0,
  `detailhargabeli` double NOT NULL DEFAULT 0,
  `jumlah` int NOT NULL DEFAULT 1,
  `subtotal` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detailbarangmasuk_detfaktur_foreign`(`detfaktur` ASC) USING BTREE,
  INDEX `detailbarangmasuk_detailbrgkode_foreign`(`detailbrgkode` ASC) USING BTREE,
  CONSTRAINT `detailbarangmasuk_detailbrgkode_foreign` FOREIGN KEY (`detailbrgkode`) REFERENCES `barang` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detailbarangmasuk_detfaktur_foreign` FOREIGN KEY (`detfaktur`) REFERENCES `barangmasuk` (`faktur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detailbarangmasuk
-- ----------------------------
INSERT INTO `detailbarangmasuk` VALUES (1, 'BM-20260813-001', 'BRG0000001', 55000, 44000, 10, 440000);
INSERT INTO `detailbarangmasuk` VALUES (2, 'BM-20260813-001', 'BRG0000002', 65000, 52000, 15, 780000);
INSERT INTO `detailbarangmasuk` VALUES (8, 'BM-20260813-002', 'BRG0000001', 55000, 44000, 15, 660000);
INSERT INTO `detailbarangmasuk` VALUES (9, 'BM-20260813-002', 'BRG0000002', 65000, 52000, 5, 260000);

-- ----------------------------
-- Table structure for detailpenjualan
-- ----------------------------
DROP TABLE IF EXISTS `detailpenjualan`;
CREATE TABLE `detailpenjualan`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `detfaktur` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detailbrgkode` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detailhargajual` double NOT NULL DEFAULT 0,
  `jumlah` int NOT NULL DEFAULT 1,
  `subtotal` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `detailpenjualan_detfaktur_foreign`(`detfaktur` ASC) USING BTREE,
  INDEX `detailpenjualan_detailbrgkode_foreign`(`detailbrgkode` ASC) USING BTREE,
  CONSTRAINT `detailpenjualan_detailbrgkode_foreign` FOREIGN KEY (`detailbrgkode`) REFERENCES `barang` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `detailpenjualan_detfaktur_foreign` FOREIGN KEY (`detfaktur`) REFERENCES `penjualan` (`faktur`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detailpenjualan
-- ----------------------------
INSERT INTO `detailpenjualan` VALUES (1, 'PJ-20260813-001', 'BRG0000001', 55000, 2, 110000);
INSERT INTO `detailpenjualan` VALUES (2, 'PJ-20260813-001', 'BRG0000002', 65000, 1, 65000);
INSERT INTO `detailpenjualan` VALUES (3, 'PJ-20260813-002', 'BRG0000001', 55000, 1, 55000);
INSERT INTO `detailpenjualan` VALUES (4, 'PJ-20260813-002', 'BRG0000003', 45000, 1, 45000);
INSERT INTO `detailpenjualan` VALUES (5, 'PJ-20260813-002', 'BRG0000005', 240000, 1, 240000);
INSERT INTO `detailpenjualan` VALUES (6, 'PJ-20260813-003', 'BRG0000002', 65000, 1, 65000);
INSERT INTO `detailpenjualan` VALUES (7, 'PJ-20260813-003', 'BRG0000004', 25000, 1, 25000);
INSERT INTO `detailpenjualan` VALUES (9, 'PJ-20260813-004', 'BRG0000004', 25000, 1, 25000);
INSERT INTO `detailpenjualan` VALUES (10, 'PJ-20260813-004', 'BRG0000002', 65000, 1, 65000);
INSERT INTO `detailpenjualan` VALUES (11, 'PJ-20260813-005', 'BRG0000005', 240000, 1, 240000);

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `idkategori` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `namakategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`idkategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Oli & Pelumas', '2026-08-13 03:25:13', '2026-08-13 03:25:13');
INSERT INTO `kategori` VALUES (2, 'Sparepart Mesin', '2026-08-13 03:25:13', '2026-08-13 03:25:13');
INSERT INTO `kategori` VALUES (3, 'Ban & Velg', '2026-08-13 03:25:13', '2026-08-13 03:25:13');
INSERT INTO `kategori` VALUES (4, 'Aksesoris & Variasi', '2026-08-13 03:25:13', '2026-08-13 03:25:13');
INSERT INTO `kategori` VALUES (5, 'Sistem Pengereman', '2026-08-13 03:25:13', '2026-08-13 03:25:13');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2026-08-12-000001', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1786521992, 1);
INSERT INTO `migrations` VALUES (2, '2026-08-13-000002', 'App\\Database\\Migrations\\CreateKategoriTable', 'default', 'App', 1786591454, 2);
INSERT INTO `migrations` VALUES (3, '2026-08-13-000003', 'App\\Database\\Migrations\\CreateSatuanTable', 'default', 'App', 1786592108, 3);
INSERT INTO `migrations` VALUES (4, '2026-08-13-000004', 'App\\Database\\Migrations\\CreateBarangTable', 'default', 'App', 1786594405, 4);
INSERT INTO `migrations` VALUES (5, '2026-08-13-000005', 'App\\Database\\Migrations\\CreateServisTable', 'default', 'App', 1786596836, 5);
INSERT INTO `migrations` VALUES (6, '2026-08-13-000006', 'App\\Database\\Migrations\\CreateBarangMasukTables', 'default', 'App', 1786604266, 6);
INSERT INTO `migrations` VALUES (7, '2026-08-13-000007', 'App\\Database\\Migrations\\CreatePenjualanTables', 'default', 'App', 1786607204, 7);
INSERT INTO `migrations` VALUES (8, '2026-08-13-000008', 'App\\Database\\Migrations\\AddStatusToPenjualan', 'default', 'App', 1786607912, 8);
INSERT INTO `migrations` VALUES (9, '2026-08-13-000009', 'App\\Database\\Migrations\\CreateTransaksiServisTables', 'default', 'App', 1786609327, 9);
INSERT INTO `migrations` VALUES (10, '2026-08-13-000010', 'App\\Database\\Migrations\\CreateBookingTable', 'default', 'App', 1786613422, 10);
INSERT INTO `migrations` VALUES (11, '2026-08-14-141100', 'App\\Database\\Migrations\\CreateBookingServisTable', 'default', 'App', 1786691714, 11);

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan`  (
  `faktur` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglfaktur` date NOT NULL,
  `nama_pelanggan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pelanggan Umum',
  `totalharga` double NOT NULL DEFAULT 0,
  `bayar` double NOT NULL DEFAULT 0,
  `kembali` double NOT NULL DEFAULT 0,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'pending',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`faktur`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
INSERT INTO `penjualan` VALUES ('PJ-20260813-001', '2026-08-13', 'Pelanggan Umum', 175000, 200000, 25000, 'Penjualan suku cadang tunai kasir', 'selesai', '2026-08-13 07:46:56', '2026-08-13 07:46:56');
INSERT INTO `penjualan` VALUES ('PJ-20260813-002', '2026-08-13', 'Pelanggan Umum', 340000, 400000, 60000, '', 'selesai', '2026-08-13 07:48:17', '2026-08-13 07:48:17');
INSERT INTO `penjualan` VALUES ('PJ-20260813-003', '2026-08-13', 'Budi Santoso (Pelanggan)', 90000, 100000, 10000, 'Tes Penjualan', 'selesai', '2026-08-13 07:59:47', '2026-08-13 08:00:10');
INSERT INTO `penjualan` VALUES ('PJ-20260813-004', '2026-08-13', 'Pelanggan Umum', 90000, 90000, 0, 'ok', 'selesai', '2026-08-13 08:07:50', '2026-08-13 08:08:27');
INSERT INTO `penjualan` VALUES ('PJ-20260813-005', '2026-08-13', 'Pelanggan Umum', 240000, 240000, 0, 'ok', 'selesai', '2026-08-13 08:13:23', '2026-08-13 08:13:37');

-- ----------------------------
-- Table structure for satuan
-- ----------------------------
DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan`  (
  `idsatuan` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`idsatuan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of satuan
-- ----------------------------
INSERT INTO `satuan` VALUES (1, 'Pcs', 'Satuan per buah/biji barang', '2026-08-13 03:35:46', '2026-08-13 03:35:46');
INSERT INTO `satuan` VALUES (2, 'Liter', 'Satuan volume cairan (oli/pelumas/bensin)', '2026-08-13 03:35:46', '2026-08-13 03:35:46');
INSERT INTO `satuan` VALUES (3, 'Botol', 'Satuan kemasan botol', '2026-08-13 03:35:46', '2026-08-13 03:35:46');
INSERT INTO `satuan` VALUES (4, 'Set', 'Satuan paket/set komponen lengkap', '2026-08-13 03:35:46', '2026-08-13 03:35:46');
INSERT INTO `satuan` VALUES (5, 'Box', 'Satuan kemasan kotak/kardus', '2026-08-13 03:35:46', '2026-08-13 03:35:46');
INSERT INTO `satuan` VALUES (6, 'Roll', 'Satuan gulungan (kabel/selang/isolasi)', '2026-08-13 03:35:46', '2026-08-13 03:35:46');
INSERT INTO `satuan` VALUES (7, 'Unit', 'Satuan unit kendaraan/mesin', '2026-08-13 03:35:46', '2026-08-13 03:35:46');

-- ----------------------------
-- Table structure for servis
-- ----------------------------
DROP TABLE IF EXISTS `servis`;
CREATE TABLE `servis`  (
  `kodeservis` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_servis` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `biaya` double NOT NULL DEFAULT 0,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `estimasi_waktu` int NULL DEFAULT 30,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`kodeservis`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of servis
-- ----------------------------
INSERT INTO `servis` VALUES ('SRV0000001', 'Servis Rutin / Ringan', 45000, 'Pembersihan karburator/throttle body, cek busi, oli, dan tekanan angin ban', 30, '2026-08-13 04:59:16', '2026-08-13 04:59:16');
INSERT INTO `servis` VALUES ('SRV0000002', 'Servis Lengkap + Clean CVT', 85000, 'Pembersihan mangkok CVT, v-belt, roller, ganti grease, dan tune up injeksi', 60, '2026-08-13 04:59:16', '2026-08-13 04:59:16');
INSERT INTO `servis` VALUES ('SRV0000003', 'Ganti Oli & Cek Pengereman', 20000, 'Jasa penggantian oli mesin/gardan + penyetelan rem depan belakang', 15, '2026-08-13 04:59:16', '2026-08-13 04:59:16');
INSERT INTO `servis` VALUES ('SRV0000004', 'Tune Up Injeksi & Reset ECU', 60000, 'Diagnosa injeksi via scanner, pembersihan injector, dan reset ECU/TP', 45, '2026-08-13 04:59:16', '2026-08-13 04:59:16');
INSERT INTO `servis` VALUES ('SRV0000005', 'Overhaul / Turun Mesin', 250000, 'Servis berat pembongkaran mesin, skir klep, ganti ring piston/piston kit', 240, '2026-08-13 04:59:16', '2026-08-13 04:59:16');

-- ----------------------------
-- Table structure for setting_booking
-- ----------------------------
DROP TABLE IF EXISTS `setting_booking`;
CREATE TABLE `setting_booking`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `durasi_pembayaran_menit` int NOT NULL DEFAULT 5,
  `biaya_booking` decimal(12, 2) NOT NULL DEFAULT 50000.00,
  `kuota_per_jam_default` int NOT NULL DEFAULT 2,
  `kuota_slot_json` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setting_booking
-- ----------------------------
INSERT INTO `setting_booking` VALUES (1, 1, 50000.00, 2, '{\"08:00\":1,\"09:00\":2,\"10:00\":2,\"11:00\":2,\"13:00\":2,\"14:00\":2,\"15:00\":2,\"16:00\":2}', '2026-08-19 10:54:59', '2026-08-19 10:51:09');

-- ----------------------------
-- Table structure for temp_barangmasuk
-- ----------------------------
DROP TABLE IF EXISTS `temp_barangmasuk`;
CREATE TABLE `temp_barangmasuk`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detfaktur` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detailbrgkode` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detailhargajual` double NOT NULL DEFAULT 0,
  `detailhargabeli` double NOT NULL DEFAULT 0,
  `jumlah` int NOT NULL DEFAULT 1,
  `subtotal` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of temp_barangmasuk
-- ----------------------------
INSERT INTO `temp_barangmasuk` VALUES (1, '317d5d29be586b712d1360bac40120a4', NULL, 'BRG0000001', 55000, 44000, 1, 44000);

-- ----------------------------
-- Table structure for temp_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `temp_penjualan`;
CREATE TABLE `temp_penjualan`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detfaktur` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detailbrgkode` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detailhargajual` double NOT NULL DEFAULT 0,
  `jumlah` int NOT NULL DEFAULT 1,
  `subtotal` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of temp_penjualan
-- ----------------------------
INSERT INTO `temp_penjualan` VALUES (9, '68af426cf71175b03837f8561487993b', 'PJ-20260813-004', 'BRG0000004', 25000, 1, 25000);
INSERT INTO `temp_penjualan` VALUES (10, '68af426cf71175b03837f8561487993b', 'PJ-20260813-004', 'BRG0000002', 65000, 1, 65000);
INSERT INTO `temp_penjualan` VALUES (14, 'ad9c6d94e2ec2d3207ed149c796a25d9', NULL, 'BRG0000001', 55000, 1, 55000);

-- ----------------------------
-- Table structure for temp_transaksi_servis
-- ----------------------------
DROP TABLE IF EXISTS `temp_transaksi_servis`;
CREATE TABLE `temp_transaksi_servis`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detfaktur` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detserviskode` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detbiaya` double NOT NULL DEFAULT 0,
  `detailbrgkode` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `detailhargajual` double NOT NULL DEFAULT 0,
  `detjml` double NOT NULL DEFAULT 1,
  `dettotaljual` double NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of temp_transaksi_servis
-- ----------------------------
INSERT INTO `temp_transaksi_servis` VALUES (9, '62a7016f6892d9032520491dd6b35857', 'SV-20260813-003', 'SRV0000003', 20000, NULL, 0, 1, 20000);
INSERT INTO `temp_transaksi_servis` VALUES (10, '62a7016f6892d9032520491dd6b35857', 'SV-20260813-003', NULL, 0, 'BRG0000001', 55000, 1, 55000);
INSERT INTO `temp_transaksi_servis` VALUES (11, '62a7016f6892d9032520491dd6b35857', 'SV-20260813-003', NULL, 0, 'BRG0000003', 45000, 1, 45000);

-- ----------------------------
-- Table structure for transaksi_servis
-- ----------------------------
DROP TABLE IF EXISTS `transaksi_servis`;
CREATE TABLE `transaksi_servis`  (
  `faktur` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tglfaktur` date NOT NULL,
  `idpel` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_pelanggan` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pelanggan Umum',
  `merkkendaraan` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nopol` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `totalharga` double NOT NULL DEFAULT 0,
  `dp_booking` decimal(12, 2) NULL DEFAULT 0.00,
  `bayar` double NOT NULL DEFAULT 0,
  `kembali` double NOT NULL DEFAULT 0,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`faktur`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transaksi_servis
-- ----------------------------
INSERT INTO `transaksi_servis` VALUES ('SV-20260813-001', '2026-08-13', NULL, 'Pelanggan Umum', 'Honda Vario 125', 'B 3829 TGH', 'Servis Ringan & Ganti Oli Mesin', 105000, 0.00, 120000, 15000, 'selesai', '2026-08-13 08:22:14', '2026-08-13 08:22:14');
INSERT INTO `transaksi_servis` VALUES ('SV-20260813-002', '2026-08-13', NULL, 'Budi Santoso', 'Yamaha NMAX 155', 'B 6192 UJK', 'Servis Injeksi & Rem Depan Bunyi', 145000, 0.00, 0, 0, 'pending', '2026-08-13 08:22:14', '2026-08-13 08:22:14');
INSERT INTO `transaksi_servis` VALUES ('SV-20260813-003', '2026-08-13', NULL, 'Pelanggan Umum', 'Scoopy Stylish', 'BA 9999 BB', 'Ganti Oli dan kampas rem', 120000, 0.00, 120000, 0, 'selesai', '2026-08-13 08:49:49', '2026-08-13 09:09:43');
INSERT INTO `transaksi_servis` VALUES ('SV-20260818-001', '2026-08-18', NULL, 'Hendra Putra', 'Scoopy Stylish', 'BA 9999 BB', 'Booking Online #BKG-20260818-0001 - Paket: Ganti Oli & Cek Pengereman + Servis Rutin / Ringan (DP Terbayar: Rp 65.000)', 110000, 65000.00, 50000, 5000, 'selesai', '2026-08-18 08:52:56', '2026-08-18 08:57:43');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('pimpinan','admin','pelanggan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pelanggan',
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Pimpinan Bengkel', 'pimpinan@salsamotor.com', '$2y$12$YXlLEXvcZdjWQOwcI8VLJuqQEs5a/KyFyXEel65YTp74DZKf3Nd0C', 'pimpinan', '081234567890', 'Jl. Pimpinan No. 1', NULL, '2026-08-12 08:07:03', '2026-08-12 08:07:03');
INSERT INTO `users` VALUES (2, 'Admin Bengkel', 'admin@salsamotor.com', '$2y$12$fnxY0i/P2vH71kT1wY7i3.BHm7wH1xS83O9rUxOjpzDCiouELj5ui', 'admin', '081234567891', 'Jl. Admin Bengkel No. 2', NULL, '2026-08-12 08:07:03', '2026-08-12 08:07:03');
INSERT INTO `users` VALUES (3, 'Budi Santoso (Pelanggan)', 'pelanggan@salsamotor.com', '$2y$12$sBQoYgNb6W3XaqoYj6WT7egPcyCd5CJFpy.ypgxamCpE9CR1odfx.', 'pelanggan', '081234567892', 'Jl. Pelanggan No. 3', NULL, '2026-08-12 08:07:03', '2026-08-12 08:07:03');
INSERT INTO `users` VALUES (4, 'Admin Bengkel', 'admin@bengkelsalsamotor.com', '$2y$12$6RG9WszcTcpuf9ERXOjoyekyh8E18Q/bVMc/E.osunURMPk9mI4lS', 'pelanggan', '08123456789', 'Jl. Bengkel', NULL, '2026-08-13 01:30:02', '2026-08-13 01:30:02');
INSERT INTO `users` VALUES (6, 'Hendra Putra', 'hendrasetyawan1945@gmail.com', '$2y$12$5ySkhK5tBexPqQXeAJ1vK.d8CaOf8aNnMmqHcmf3G94IEHs0ZMEWO', 'pelanggan', '0823456789', 'Padang', '1786682903_1c1c8b292a4b78c90c4e.jpg', '2026-08-14 04:03:36', '2026-08-14 04:48:23');

SET FOREIGN_KEY_CHECKS = 1;
