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

 Date: 05/09/2024 11:13:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kasus
-- ----------------------------
INSERT INTO `kasus` VALUES (1, 1, 'asdasdaa', 'Pending', 1, '2024-08-29 10:01:16', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas`  (
  `id_kelas` int NOT NULL AUTO_INCREMENT,
  `kelas` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_pendidikan` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES (1, 'SD 1', 1);
INSERT INTO `kelas` VALUES (2, 'SD 2', 1);
INSERT INTO `kelas` VALUES (3, 'SD 3', 1);
INSERT INTO `kelas` VALUES (4, 'SD 4', 1);
INSERT INTO `kelas` VALUES (5, 'SD 5', 1);
INSERT INTO `kelas` VALUES (6, 'SD 6', 1);
INSERT INTO `kelas` VALUES (7, 'SMP 1', 2);
INSERT INTO `kelas` VALUES (8, 'SMP 2', 2);
INSERT INTO `kelas` VALUES (9, 'SMP 3', 2);
INSERT INTO `kelas` VALUES (10, 'RPL X A', 3);
INSERT INTO `kelas` VALUES (11, 'RPL X B', 3);
INSERT INTO `kelas` VALUES (12, 'RPL X C', 3);
INSERT INTO `kelas` VALUES (13, 'RPL XI A ', 3);
INSERT INTO `kelas` VALUES (14, 'RPL XI B', 3);
INSERT INTO `kelas` VALUES (15, 'RPL XI C', 3);
INSERT INTO `kelas` VALUES (16, 'BDP X A', 3);
INSERT INTO `kelas` VALUES (17, 'BDP X B', 3);
INSERT INTO `kelas` VALUES (18, 'BDP X C', 3);
INSERT INTO `kelas` VALUES (19, 'BDP XI A', 3);
INSERT INTO `kelas` VALUES (20, 'BDP XI B', 3);
INSERT INTO `kelas` VALUES (21, 'BDP XI C', 3);
INSERT INTO `kelas` VALUES (22, 'BDP XII A', 3);
INSERT INTO `kelas` VALUES (23, 'BDP XII B', 3);
INSERT INTO `kelas` VALUES (24, 'BDP XII C', 3);
INSERT INTO `kelas` VALUES (25, 'AKL X A', 3);
INSERT INTO `kelas` VALUES (26, 'AKL X B', 3);
INSERT INTO `kelas` VALUES (27, 'AKL X C', 3);
INSERT INTO `kelas` VALUES (28, 'AKL XI A', 3);
INSERT INTO `kelas` VALUES (29, 'AKL XI B', 3);
INSERT INTO `kelas` VALUES (30, 'AKL XI C', 3);
INSERT INTO `kelas` VALUES (31, 'AKL XII A', 3);
INSERT INTO `kelas` VALUES (32, 'AKL XII B', 3);
INSERT INTO `kelas` VALUES (33, 'AKL XII C', 3);
INSERT INTO `kelas` VALUES (34, 'RPL XII A', 3);
INSERT INTO `kelas` VALUES (35, 'RPL XII B', 3);
INSERT INTO `kelas` VALUES (36, 'RPL XII C', 3);
INSERT INTO `kelas` VALUES (38, 'Kepala Sekolah', NULL);
INSERT INTO `kelas` VALUES (39, 'Guru Bk', NULL);
INSERT INTO `kelas` VALUES (40, 'Wali Kelas', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'Sekolah Permata Harapan', 'img1.jpg', 'img1.jpg', 'img1.jpg', 'img1.jpg');

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
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 1, 39, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'Guru Bk', '1.jpg', NULL);
INSERT INTO `user` VALUES (2, 2, 40, 'walikelas', 'c4ca4238a0b923820dcc509a6f75849b', 'Afdal', '1.jpg', NULL);
INSERT INTO `user` VALUES (3, 3, 38, 'kepalasekolah', 'c4ca4238a0b923820dcc509a6f75849b', 'Srima', '1.jpg', NULL);
INSERT INTO `user` VALUES (4, 4, 35, '22161034', '73ee832194b4a8597db37ac3d9322b61', 'Leonardo Jaylenson', '1.jpg', NULL);

SET FOREIGN_KEY_CHECKS = 1;
