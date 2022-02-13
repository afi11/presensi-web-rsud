/*
 Navicat Premium Data Transfer

 Source Server         : localdb
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : db_presensi

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 13/02/2022 10:28:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pegawai_code` int NULL DEFAULT NULL,
  `user_id` int NULL DEFAULT NULL,
  `relasi_id` int NULL DEFAULT NULL,
  `content` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `device_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activities
-- ----------------------------

-- ----------------------------
-- Table structure for activity_presensi
-- ----------------------------
DROP TABLE IF EXISTS `activity_presensi`;
CREATE TABLE `activity_presensi`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `activityCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pegawaiCode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggalActivity` date NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activity_presensi
-- ----------------------------

-- ----------------------------
-- Table structure for detail_waktu_kerja_shift
-- ----------------------------
DROP TABLE IF EXISTS `detail_waktu_kerja_shift`;
CREATE TABLE `detail_waktu_kerja_shift`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kodeJamKerja` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `shift` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai_masuk` time NULL DEFAULT NULL,
  `jam_akhir_masuk` time NULL DEFAULT NULL,
  `jam_awal_pulang` time NULL DEFAULT NULL,
  `jam_akhir_pulang` time NULL DEFAULT NULL,
  `is_active` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_waktu_kerja_shift
-- ----------------------------
INSERT INTO `detail_waktu_kerja_shift` VALUES (7, 'c5L5oJ5ZLiWXprPm', 'PAGI', '06:30:00', '07:00:00', '14:00:00', '15:00:00', 1, '2022-02-12 21:53:10', '2022-02-12 22:11:37');
INSERT INTO `detail_waktu_kerja_shift` VALUES (8, 'c5L5oJ5ZLiWXprPm', 'SIANG', '13:30:00', '14:00:00', '21:00:00', '22:00:00', 1, '2022-02-12 21:53:10', '2022-02-12 22:11:52');
INSERT INTO `detail_waktu_kerja_shift` VALUES (9, 'c5L5oJ5ZLiWXprPm', 'MALAM', '20:30:00', '21:00:00', '07:00:00', '08:00:00', 1, '2022-02-12 21:53:10', '2022-02-12 22:10:32');

-- ----------------------------
-- Table structure for divisi
-- ----------------------------
DROP TABLE IF EXISTS `divisi`;
CREATE TABLE `divisi`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `namaDivisi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keteranganDivisi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of divisi
-- ----------------------------
INSERT INTO `divisi` VALUES (1, 'IT', NULL, '2022-02-09 21:28:27', '2022-02-09 21:28:27');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for hari_libur
-- ----------------------------
DROP TABLE IF EXISTS `hari_libur`;
CREATE TABLE `hari_libur`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tanggalLibur` date NOT NULL,
  `idDivisi` int NULL DEFAULT NULL,
  `keterangan` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hari_libur
-- ----------------------------
INSERT INTO `hari_libur` VALUES (1, '2000-10-09', 1, NULL, '2022-02-09 21:57:57', '2022-02-09 21:57:57');

-- ----------------------------
-- Table structure for jadwal
-- ----------------------------
DROP TABLE IF EXISTS `jadwal`;
CREATE TABLE `jadwal`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pegawaiCode` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `bulan` int NULL DEFAULT NULL,
  `tahun` int NULL DEFAULT NULL,
  `tgl_1` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_2` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_3` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_4` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_5` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_6` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_7` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_8` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_9` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_10` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_11` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_12` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_13` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_14` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_15` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_16` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_17` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_18` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_19` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_20` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_21` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_22` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_23` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_24` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_25` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_26` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_27` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_28` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_29` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_30` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_31` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jadwal
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2022_02_05_144547_create_ruangans_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_02_05_144801_create_tipe_shifts_table', 1);
INSERT INTO `migrations` VALUES (7, '2022_02_05_144939_create_jadwals_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_02_05_145030_create_pegawais_table', 1);
INSERT INTO `migrations` VALUES (9, '2022_02_05_145141_create_presensis_table', 1);
INSERT INTO `migrations` VALUES (10, '2022_02_05_145234_create_cuti_tidak_hadirs_table', 1);
INSERT INTO `migrations` VALUES (11, '2022_02_05_145713_create_activities_table', 1);
INSERT INTO `migrations` VALUES (12, '2022_02_05_153602_create_izin_tidak_presensis_table', 1);
INSERT INTO `migrations` VALUES (13, '2022_02_05_155413_create_hari_liburs_table', 1);
INSERT INTO `migrations` VALUES (14, '2022_02_09_202455_create_rule_izins_table', 1);
INSERT INTO `migrations` VALUES (15, '2022_02_09_203741_create_waktu_regulers_table', 1);
INSERT INTO `migrations` VALUES (16, '2022_02_10_080029_tambah_status_kolom_pulang', 2);
INSERT INTO `migrations` VALUES (17, '2022_02_10_124747_create_activity_presensis_table', 3);
INSERT INTO `migrations` VALUES (18, '2022_02_10_132217_add_new_column_activity_code_to_presensi', 4);
INSERT INTO `migrations` VALUES (19, '2022_02_11_080122_create_rule_telats_table', 5);
INSERT INTO `migrations` VALUES (20, '2022_02_11_142221_create_detail_jam_kerjas_table', 6);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS `pegawai`;
CREATE TABLE `pegawai`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idDivisi` int NOT NULL,
  `idJamKerjaShift` int NULL DEFAULT NULL,
  `statusShift` int NOT NULL DEFAULT 0 COMMENT '0 untuk reguler, 1 untuk shift',
  `nik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tglLahir` date NULL DEFAULT NULL,
  `alamat` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `foto_pegawai` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pegawai
-- ----------------------------
INSERT INTO `pegawai` VALUES (1, 'q0OG1zYO', 1, NULL, 0, '223212344', 'Tes', 'MALE', 'kontrak', '0833737', '1990-04-12', 'solo', '1644418065WhatsApp Image 2022-02-09 at 17.26.48.jpeg', '2022-02-09 21:47:45', '2022-02-09 21:50:10');
INSERT INTO `pegawai` VALUES (2, 'U8QhJDys', 1, 9, 1, '27837333', 'Tes123', 'MALE', 'kontrak', '0833737', '1998-05-12', 'Solo', 'male.png', '2022-02-13 10:15:21', '2022-02-13 10:15:21');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for presensi
-- ----------------------------
DROP TABLE IF EXISTS `presensi`;
CREATE TABLE `presensi`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `activityCode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'sbg penanda bila ada shift berganti hari untuk membedakan presensi masuk & pulang',
  `pegawaiCode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `idRuleIzin` int NULL DEFAULT NULL,
  `idRuleTelat` int NULL DEFAULT NULL,
  `idWaktuReguler` int NULL DEFAULT NULL,
  `idWaktuShift` int NULL DEFAULT NULL,
  `tanggalPresensi` date NULL DEFAULT NULL,
  `tipePresensi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '\'jam-masuk\', \'jam-telat\'',
  `jamPresensi` time NULL DEFAULT NULL,
  `telatMasuk` time NULL DEFAULT NULL,
  `jarakWaktuPulang` time NULL DEFAULT NULL,
  `jarakPresensi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `latitudePresensi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `longitudePresensi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `keteranganIzin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tanggalMulaiIzin` date NULL DEFAULT NULL,
  `tanggalAkhirIzin` date NULL DEFAULT NULL,
  `dokumenPendukung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `statusIzin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `statusPresensiPulang` int NULL DEFAULT NULL COMMENT 'null belum presensi masuk, 1 untuk sudah presensi pulang, 0 untuk prensi masuk tapi belum pulang',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of presensi
-- ----------------------------
INSERT INTO `presensi` VALUES (3, 'clMfhRntP0O8spse', 'q0OG1zYO', NULL, NULL, NULL, 1, '2022-02-09', 'jam-masuk', '13:55:00', '00:00:00', NULL, '15', '-7.28383838', '110.1828282', NULL, NULL, NULL, NULL, NULL, 1, '2022-02-09 14:07:45', '2022-02-09 14:07:45');
INSERT INTO `presensi` VALUES (4, 'clMfhRntP0O8spse', 'q0OG1zYO', NULL, NULL, NULL, 1, '2022-02-10', 'jam-pulang', '14:34:00', NULL, '10:34:00', '15', '-7.28383838', '110.1828282', NULL, NULL, NULL, NULL, NULL, 1, '2022-02-10 14:35:01', '2022-02-10 14:35:01');
INSERT INTO `presensi` VALUES (8, 'Z8ZUjusK0YfCjYiH', 'q0OG1zYO', NULL, 5, 3, NULL, '2022-02-11', 'jam-masuk', '09:05:00', '02:05:00', NULL, '15', '-7.28383838', '110.1828282', NULL, NULL, NULL, NULL, NULL, 0, '2022-02-11 09:17:34', '2022-02-11 09:17:34');

-- ----------------------------
-- Table structure for rule-izin
-- ----------------------------
DROP TABLE IF EXISTS `rule-izin`;
CREATE TABLE `rule-izin`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `namaIzin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rule-izin
-- ----------------------------

-- ----------------------------
-- Table structure for rule_telat
-- ----------------------------
DROP TABLE IF EXISTS `rule_telat`;
CREATE TABLE `rule_telat`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `namaRuleTelat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `maxTelatMasuk` bigint NOT NULL,
  `maxTelatPulang` bigint NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rule_telat
-- ----------------------------
INSERT INTO `rule_telat` VALUES (1, 'TL1', 30, NULL, '2022-02-11 08:29:38', '2022-02-11 08:29:38');
INSERT INTO `rule_telat` VALUES (2, 'TL2', 60, NULL, '2022-02-11 08:29:56', '2022-02-11 08:29:56');
INSERT INTO `rule_telat` VALUES (3, 'TL3', 90, NULL, '2022-02-11 08:31:37', '2022-02-11 08:31:37');
INSERT INTO `rule_telat` VALUES (4, 'TL4', 120, NULL, '2022-02-11 08:31:58', '2022-02-11 08:31:58');
INSERT INTO `rule_telat` VALUES (5, 'TL5', 999999999999, NULL, '2022-02-11 09:15:17', '2022-02-11 09:17:03');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `pegawai_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hint` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable_presensi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'q0OG1zYO', 'tes', 'polianak@email.com', NULL, '$2y$10$FhrSclrquSLE/8vhDGEonuVbLhbADCpRdFicXgG5vkVqa0Zpz05km', '12345678', 'Y', 'pegawai', NULL, NULL, '2022-02-09 21:47:46', '2022-02-09 21:47:46');
INSERT INTO `users` VALUES (2, 'U8QhJDys', 'tes123', 'tes123@gmail.com', NULL, '$2y$10$A3RFcIjVzh1udnHfatDDveUFjC9USdh7eEbItd6wgjSjIA2xGBl16', '12345678', 'Y', 'pegawai', NULL, NULL, '2022-02-13 10:15:22', '2022-02-13 10:15:22');

-- ----------------------------
-- Table structure for waktu_kerja_shift
-- ----------------------------
DROP TABLE IF EXISTS `waktu_kerja_shift`;
CREATE TABLE `waktu_kerja_shift`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `kodeJamKerja` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `namaProfile` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of waktu_kerja_shift
-- ----------------------------
INSERT INTO `waktu_kerja_shift` VALUES (9, 'c5L5oJ5ZLiWXprPm', 'SHIFT 1', '2022-02-12 21:53:10', '2022-02-12 21:53:10');

-- ----------------------------
-- Table structure for waktu_reguler
-- ----------------------------
DROP TABLE IF EXISTS `waktu_reguler`;
CREATE TABLE `waktu_reguler`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `hariKerja` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jam_mulai_masuk` time NULL DEFAULT NULL,
  `jam_akhir_masuk` time NULL DEFAULT NULL,
  `jam_awal_pulang` time NULL DEFAULT NULL,
  `jam_akhir_pulang` time NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of waktu_reguler
-- ----------------------------
INSERT INTO `waktu_reguler` VALUES (1, 'Monday', '07:00:00', '07:30:00', '15:30:00', '16:30:00', '2022-02-12 23:06:02', '2022-02-12 23:06:02');
INSERT INTO `waktu_reguler` VALUES (2, 'Tuesday', '07:00:00', '07:30:00', '15:30:00', '16:30:00', '2022-02-12 23:06:02', '2022-02-12 23:14:06');
INSERT INTO `waktu_reguler` VALUES (3, 'Wednesday', '07:00:00', '07:30:00', '15:30:00', '16:30:00', '2022-02-12 23:06:02', '2022-02-12 23:06:02');
INSERT INTO `waktu_reguler` VALUES (4, 'Thursday', '07:00:00', '07:30:00', '15:30:00', '16:30:00', '2022-02-12 23:06:02', '2022-02-12 23:06:02');
INSERT INTO `waktu_reguler` VALUES (5, 'Friday', '06:30:00', '07:00:00', '14:30:00', '15:30:00', '2022-02-12 23:14:55', '2022-02-12 23:14:55');

SET FOREIGN_KEY_CHECKS = 1;
