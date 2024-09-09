/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : aplikasileo

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 09/09/2024 09:26:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity`  (
  `id_activity` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_activity`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1540 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of activity
-- ----------------------------
INSERT INTO `activity` VALUES (1474, 1, 'User Melakukan Login', '2024-09-06 22:54:50', NULL);
INSERT INTO `activity` VALUES (1475, 1, 'User membuka Dashboard', '2024-09-06 22:54:50', NULL);
INSERT INTO `activity` VALUES (1476, 1, 'User membuka Dashboard', '2024-09-06 23:33:15', NULL);
INSERT INTO `activity` VALUES (1477, 1, 'User membuka view userlog', '2024-09-06 23:33:19', NULL);
INSERT INTO `activity` VALUES (1478, 1, 'User membuka view userlog', '2024-09-06 23:33:41', NULL);
INSERT INTO `activity` VALUES (1479, 1, 'User membuka view userlog', '2024-09-06 23:35:18', NULL);
INSERT INTO `activity` VALUES (1481, 1, 'User Menghapus data activity', '2024-09-06 23:45:25', NULL);
INSERT INTO `activity` VALUES (1483, 1, 'User Menghapus data activity', '2024-09-06 23:45:29', NULL);
INSERT INTO `activity` VALUES (1484, 1, 'User membuka view userlog', '2024-09-06 23:45:29', NULL);
INSERT INTO `activity` VALUES (1485, 1, 'User membuka view userlog', '2024-09-06 23:46:05', NULL);
INSERT INTO `activity` VALUES (1486, 4, 'User Melakukan Login', '2024-09-07 12:14:07', NULL);
INSERT INTO `activity` VALUES (1487, 4, 'User membuka Dashboard', '2024-09-07 12:14:08', NULL);
INSERT INTO `activity` VALUES (1488, 4, 'User Membuka Form Kasus', '2024-09-07 12:14:16', NULL);
INSERT INTO `activity` VALUES (1489, 4, 'User Membuka Form Kasus', '2024-09-07 12:14:45', NULL);
INSERT INTO `activity` VALUES (1490, 4, 'User Membuka Form Kasus', '2024-09-07 12:14:49', NULL);
INSERT INTO `activity` VALUES (1491, 4, 'User Membuka View Kasus', '2024-09-07 12:14:50', NULL);
INSERT INTO `activity` VALUES (1492, 4, 'User Membuka Form Kasus', '2024-09-07 12:14:52', NULL);
INSERT INTO `activity` VALUES (1493, 4, 'User Melakukan Login', '2024-09-07 12:15:44', NULL);
INSERT INTO `activity` VALUES (1494, 4, 'User membuka Dashboard', '2024-09-07 12:15:45', NULL);
INSERT INTO `activity` VALUES (1495, 4, 'User Membuka Form Kasus', '2024-09-07 12:15:50', NULL);
INSERT INTO `activity` VALUES (1496, 4, 'User Melakukan Menambahkan Kasus', '2024-09-07 12:16:11', NULL);
INSERT INTO `activity` VALUES (1497, 4, 'User Membuka Form Kasus', '2024-09-07 12:16:11', NULL);
INSERT INTO `activity` VALUES (1498, 4, 'User Membuka View Kasus', '2024-09-07 12:16:14', NULL);
INSERT INTO `activity` VALUES (1499, 4, 'User Membuka Detail Kasus', '2024-09-07 12:16:24', NULL);
INSERT INTO `activity` VALUES (1500, 4, 'User Membuka View Kasus', '2024-09-07 12:16:30', NULL);
INSERT INTO `activity` VALUES (1501, 1, 'User Melakukan Login', '2024-09-07 12:16:52', NULL);
INSERT INTO `activity` VALUES (1502, 1, 'User membuka Dashboard', '2024-09-07 12:16:53', NULL);
INSERT INTO `activity` VALUES (1503, 1, 'User Membuka View Kasus', '2024-09-07 12:16:58', NULL);
INSERT INTO `activity` VALUES (1504, 1, 'User Membuka Detail Kasus', '2024-09-07 12:17:05', NULL);
INSERT INTO `activity` VALUES (1505, 1, 'User Mengubah status menjadi di Proses', '2024-09-07 12:17:13', NULL);
INSERT INTO `activity` VALUES (1506, 1, 'User Membuka View Kasus', '2024-09-07 12:17:13', NULL);
INSERT INTO `activity` VALUES (1507, 1, 'User Membuka Detail Kasus', '2024-09-07 12:17:20', NULL);
INSERT INTO `activity` VALUES (1508, 1, 'User Mengubah status menjadi Proses ke Kepala Sekolah', '2024-09-07 12:17:33', NULL);
INSERT INTO `activity` VALUES (1509, 1, 'User Membuka View Kasus', '2024-09-07 12:17:34', NULL);
INSERT INTO `activity` VALUES (1510, 1, 'User Mengubah status menjadi Selesai', '2024-09-07 12:17:46', NULL);
INSERT INTO `activity` VALUES (1511, 1, 'User Membuka View Kasus', '2024-09-07 12:17:46', NULL);
INSERT INTO `activity` VALUES (1512, 1, 'User Soft Delete Kasus', '2024-09-07 12:17:56', NULL);
INSERT INTO `activity` VALUES (1513, 1, 'User Membuka View Kasus', '2024-09-07 12:17:56', NULL);
INSERT INTO `activity` VALUES (1514, 1, 'User Membuka Data Kasus', '2024-09-07 12:18:02', NULL);
INSERT INTO `activity` VALUES (1515, 1, 'User Membuka View Skasus', '2024-09-07 12:18:08', NULL);
INSERT INTO `activity` VALUES (1516, 1, 'User Restore Kasus', '2024-09-07 12:18:16', NULL);
INSERT INTO `activity` VALUES (1517, 1, 'User Membuka View Skasus', '2024-09-07 12:18:17', NULL);
INSERT INTO `activity` VALUES (1518, 1, 'User Membuka View Suser', '2024-09-07 12:18:24', NULL);
INSERT INTO `activity` VALUES (1519, 1, 'User Membuka View User', '2024-09-07 12:18:29', NULL);
INSERT INTO `activity` VALUES (1520, 1, 'User Membuka Detail User', '2024-09-07 12:18:40', NULL);
INSERT INTO `activity` VALUES (1521, 1, 'User Mengedit User', '2024-09-07 12:18:48', NULL);
INSERT INTO `activity` VALUES (1522, 1, 'User Membuka Detail User', '2024-09-07 12:18:48', NULL);
INSERT INTO `activity` VALUES (1523, 1, 'User Membuka View User', '2024-09-07 12:18:54', NULL);
INSERT INTO `activity` VALUES (1524, 1, 'User Restore Edit User', '2024-09-07 12:19:02', NULL);
INSERT INTO `activity` VALUES (1525, 1, 'User Membuka View User', '2024-09-07 12:19:03', NULL);
INSERT INTO `activity` VALUES (1526, 1, 'User Membuka Setting', '2024-09-07 12:19:24', NULL);
INSERT INTO `activity` VALUES (1527, 1, 'User Mengedit Setting', '2024-09-07 12:19:33', NULL);
INSERT INTO `activity` VALUES (1528, 1, 'User Membuka Setting', '2024-09-07 12:19:33', NULL);
INSERT INTO `activity` VALUES (1529, 1, 'User Membuka Manage Menu', '2024-09-07 12:19:42', NULL);
INSERT INTO `activity` VALUES (1530, 1, 'User Mengedit Menu', '2024-09-07 12:19:54', NULL);
INSERT INTO `activity` VALUES (1531, 1, 'User Membuka Manage Menu', '2024-09-07 12:19:55', NULL);
INSERT INTO `activity` VALUES (1532, 1, 'User membuka view userlog', '2024-09-07 12:20:02', NULL);
INSERT INTO `activity` VALUES (1533, 1, 'User Membuka Manage Menu', '2024-09-07 12:20:26', NULL);
INSERT INTO `activity` VALUES (1534, 4, 'User Melakukan Login', '2024-09-07 12:20:50', NULL);
INSERT INTO `activity` VALUES (1535, 4, 'User membuka Dashboard', '2024-09-07 12:20:51', NULL);
INSERT INTO `activity` VALUES (1536, 4, 'User Membuka Profile', '2024-09-07 12:21:01', NULL);
INSERT INTO `activity` VALUES (1537, 4, 'User membuka Dashboard', '2024-09-07 12:21:11', NULL);
INSERT INTO `activity` VALUES (1538, 1, 'User Melakukan Login', '2024-09-09 09:04:14', NULL);
INSERT INTO `activity` VALUES (1539, 1, 'User membuka Dashboard', '2024-09-09 09:04:14', NULL);

-- ----------------------------
-- Table structure for kasus
-- ----------------------------
DROP TABLE IF EXISTS `kasus`;
CREATE TABLE `kasus`  (
  `id_kasus` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `kasus` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status` enum('Pending','Proses','Proses ke Kepala Sekolah','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_kasus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kasus
-- ----------------------------
INSERT INTO `kasus` VALUES (3, 4, 'saya adalah korban pembullyan di kelas RPL 11b', 'Selesai', 4, '2024-09-07 12:16:11', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for kasus_backup
-- ----------------------------
DROP TABLE IF EXISTS `kasus_backup`;
CREATE TABLE `kasus_backup`  (
  `id_kasus` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `kasus` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status` enum('Pending','Proses','Proses ke Kepala Sekolah','Selesai') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_kasus`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kasus_backup
-- ----------------------------
INSERT INTO `kasus_backup` VALUES (1, 1, 'asdasdaa', 'Pending', 1, '2024-08-29 10:01:16', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas`  (
  `id_kelas` int NOT NULL AUTO_INCREMENT,
  `kelas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_pendidikan` int NULL DEFAULT NULL,
  `view` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES (1, 'SD 1', 1, '1');
INSERT INTO `kelas` VALUES (2, 'SD 2', 1, '1');
INSERT INTO `kelas` VALUES (3, 'SD 3', 1, '1');
INSERT INTO `kelas` VALUES (4, 'SD 4', 1, '1');
INSERT INTO `kelas` VALUES (5, 'SD 5', 1, '1');
INSERT INTO `kelas` VALUES (6, 'SD 6', 1, '1');
INSERT INTO `kelas` VALUES (7, 'SMP 1', 2, '1');
INSERT INTO `kelas` VALUES (8, 'SMP 2', 2, '1');
INSERT INTO `kelas` VALUES (9, 'SMP 3', 2, '1');
INSERT INTO `kelas` VALUES (10, 'RPL X A', 3, '1');
INSERT INTO `kelas` VALUES (11, 'RPL X B', 3, '1');
INSERT INTO `kelas` VALUES (12, 'RPL X C', 3, NULL);
INSERT INTO `kelas` VALUES (13, 'RPL XI A ', 3, '1');
INSERT INTO `kelas` VALUES (14, 'RPL XI B', 3, '1');
INSERT INTO `kelas` VALUES (15, 'RPL XI C', 3, NULL);
INSERT INTO `kelas` VALUES (16, 'BDP X A', 3, '1');
INSERT INTO `kelas` VALUES (17, 'BDP X B', 3, NULL);
INSERT INTO `kelas` VALUES (18, 'BDP X C', 3, NULL);
INSERT INTO `kelas` VALUES (19, 'BDP XI A', 3, '1');
INSERT INTO `kelas` VALUES (20, 'BDP XI B', 3, NULL);
INSERT INTO `kelas` VALUES (21, 'BDP XI C', 3, NULL);
INSERT INTO `kelas` VALUES (22, 'BDP XII A', 3, NULL);
INSERT INTO `kelas` VALUES (23, 'BDP XII B', 3, NULL);
INSERT INTO `kelas` VALUES (24, 'BDP XII C', 3, NULL);
INSERT INTO `kelas` VALUES (25, 'AKL X A', 3, '1');
INSERT INTO `kelas` VALUES (26, 'AKL X B', 3, NULL);
INSERT INTO `kelas` VALUES (27, 'AKL X C', 3, NULL);
INSERT INTO `kelas` VALUES (28, 'AKL XI A', 3, '1');
INSERT INTO `kelas` VALUES (29, 'AKL XI B', 3, NULL);
INSERT INTO `kelas` VALUES (30, 'AKL XI C', 3, NULL);
INSERT INTO `kelas` VALUES (31, 'AKL XII A', 3, '1');
INSERT INTO `kelas` VALUES (32, 'AKL XII B', 3, NULL);
INSERT INTO `kelas` VALUES (33, 'AKL XII C', 3, NULL);
INSERT INTO `kelas` VALUES (34, 'RPL XII A', 3, '1');
INSERT INTO `kelas` VALUES (35, 'RPL XII B', 3, '1');
INSERT INTO `kelas` VALUES (36, 'RPL XII C', 3, NULL);
INSERT INTO `kelas` VALUES (38, 'Kepala Sekolah', NULL, '2');
INSERT INTO `kelas` VALUES (39, 'Guru Bk', NULL, '2');
INSERT INTO `kelas` VALUES (40, 'Wali Kelas', NULL, '2');

-- ----------------------------
-- Table structure for level
-- ----------------------------
DROP TABLE IF EXISTS `level`;
CREATE TABLE `level`  (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of level
-- ----------------------------
INSERT INTO `level` VALUES (1, 'Guru Bk');
INSERT INTO `level` VALUES (2, 'Wali Kelas');
INSERT INTO `level` VALUES (3, 'Kepala Sekolah');
INSERT INTO `level` VALUES (4, 'Wakil Kepala Sekolah');
INSERT INTO `level` VALUES (5, 'Murid');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `kasus` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `dashboard` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `data` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `level` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, '1', '1', '1', '1', '1');
INSERT INTO `menu` VALUES (2, '1', '1', '1', '2', '1');
INSERT INTO `menu` VALUES (3, '1', '1', '1', '3', '1');
INSERT INTO `menu` VALUES (4, '1', '1', '1', '4', '1');

-- ----------------------------
-- Table structure for pendidikan
-- ----------------------------
DROP TABLE IF EXISTS `pendidikan`;
CREATE TABLE `pendidikan`  (
  `id_pendidikan` int NOT NULL AUTO_INCREMENT,
  `pendidikan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pendidikan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pendidikan
-- ----------------------------
INSERT INTO `pendidikan` VALUES (1, 'SD');
INSERT INTO `pendidikan` VALUES (2, 'SMP');
INSERT INTO `pendidikan` VALUES (3, 'SMK');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `icon_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'Sekolah', 'permataharapan.png', 'permataharapan.png', 'bully.jpg', 'rasis.png');

-- ----------------------------
-- Table structure for updatelog
-- ----------------------------
DROP TABLE IF EXISTS `updatelog`;
CREATE TABLE `updatelog`  (
  `id_updatelog` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `updated` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `table` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_updatelog`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 87 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of updatelog
-- ----------------------------
INSERT INTO `updatelog` VALUES (84, 1, 'User Merestore nama dari Afda ke Afdal', '2024-09-05 18:14:42', NULL, 'barang');
INSERT INTO `updatelog` VALUES (85, 1, 'User Merestore id_kelas dari 38 ke 35', '2024-09-07 12:19:02', NULL, 'barang');
INSERT INTO `updatelog` VALUES (86, 1, 'User Merestore nama dari Leonardo Jaylenso ke Leonardo Jaylenson', '2024-09-07 12:19:02', NULL, 'barang');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `id_level` int NULL DEFAULT NULL,
  `id_kelas` int NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 1, 39, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'Guru Bk', '1.jpg', NULL, NULL, NULL);
INSERT INTO `user` VALUES (2, 2, 40, 'walikelas', 'c4ca4238a0b923820dcc509a6f75849b', 'Afdal', '1.jpg', NULL, NULL, NULL);
INSERT INTO `user` VALUES (3, 3, 38, 'kepalasekolah', 'c4ca4238a0b923820dcc509a6f75849b', 'Srima', '1.jpg', NULL, NULL, NULL);
INSERT INTO `user` VALUES (4, 4, 35, '22161034', '73ee832194b4a8597db37ac3d9322b61', 'Leonardo Jaylenson', '1.jpg', NULL, NULL, NULL);
INSERT INTO `user` VALUES (6, 4, 1, '221600', '5b7579069280fe8db6f7823769b1094c', '221600', 'permataharapan.png', NULL, NULL, NULL);
INSERT INTO `user` VALUES (7, 4, 28, '221700', '5b7579069280fe8db6f7823769b1094c', '221700', '1.jpg', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for user_backup
-- ----------------------------
DROP TABLE IF EXISTS `user_backup`;
CREATE TABLE `user_backup`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `id_level` int NULL DEFAULT NULL,
  `id_kelas` int NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `delete` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_backup
-- ----------------------------
INSERT INTO `user_backup` VALUES (1, 1, 39, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'Guru Bk', '1.jpg', NULL, NULL, NULL);
INSERT INTO `user_backup` VALUES (2, 2, 40, 'walikelas', 'c4ca4238a0b923820dcc509a6f75849b', 'Afdal', '1.jpg', NULL, NULL, NULL);
INSERT INTO `user_backup` VALUES (3, 3, 38, 'kepalasekolah', 'c4ca4238a0b923820dcc509a6f75849b', 'Srima', '1.jpg', NULL, NULL, NULL);
INSERT INTO `user_backup` VALUES (4, 4, 35, '22161034', '73ee832194b4a8597db37ac3d9322b61', 'Leonardo Jaylenson', '1.jpg', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
