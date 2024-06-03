/*
Navicat MySQL Data Transfer

Source Server         : localhost_3307
Source Server Version : 50505
Source Host           : localhost:3307
Source Database       : db_run_ads_taxi

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-03-18 22:13:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `name_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `num_phone_admin` varchar(255) NOT NULL,
  `birthday_admin` date NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'Tung Admin', 'soaika1810', '0123456789', '2003-02-18');

-- ----------------------------
-- Table structure for company_photo
-- ----------------------------
DROP TABLE IF EXISTS `company_photo`;
CREATE TABLE `company_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `is_active` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of company_photo
-- ----------------------------
INSERT INTO `company_photo` VALUES ('5', '2', '13', '', '2023-02-21 15:44:30', null, null);
INSERT INTO `company_photo` VALUES ('6', '18', '14', '', '2023-02-21 15:46:34', null, null);
INSERT INTO `company_photo` VALUES ('7', '2', '14', '', '2023-02-21 22:52:50', null, null);
INSERT INTO `company_photo` VALUES ('8', '0', '13', '', '2023-02-22 07:25:27', null, null);
INSERT INTO `company_photo` VALUES ('9', '0', '15', '', '2023-02-22 11:05:44', null, null);
INSERT INTO `company_photo` VALUES ('10', '18', '13', '', '2023-02-22 16:06:58', null, null);
INSERT INTO `company_photo` VALUES ('11', '0', '16', '', '2023-02-22 22:18:33', null, null);
INSERT INTO `company_photo` VALUES ('12', '0', '14', '', '2023-03-01 20:48:21', null, null);
INSERT INTO `company_photo` VALUES ('13', '0', '79', '', '2023-03-01 20:49:42', null, null);

-- ----------------------------
-- Table structure for company_video
-- ----------------------------
DROP TABLE IF EXISTS `company_video`;
CREATE TABLE `company_video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `change_time` int(11) DEFAULT NULL,
  `is_active` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of company_video
-- ----------------------------
INSERT INTO `company_video` VALUES ('7', '2', '39', '1', '', '2023-02-21 15:44:30', null);
INSERT INTO `company_video` VALUES ('8', '18', '40', '3', '', '2023-02-21 15:46:34', null);
INSERT INTO `company_video` VALUES ('9', '2', '41', '1', '', '2023-02-21 22:52:50', null);
INSERT INTO `company_video` VALUES ('10', '0', '42', '1', '', '2023-02-22 07:25:27', null);
INSERT INTO `company_video` VALUES ('11', '0', '43', '1', '', '2023-02-22 11:05:44', null);
INSERT INTO `company_video` VALUES ('12', '18', '41', '1', '', '2023-02-22 16:06:58', null);
INSERT INTO `company_video` VALUES ('13', '0', '40', '1', '', '2023-02-22 22:18:33', null);
INSERT INTO `company_video` VALUES ('14', '0', '42', '1', '', '2023-03-01 20:48:21', null);
INSERT INTO `company_video` VALUES ('15', '0', '42', '1', '', '2023-03-01 20:49:42', null);

-- ----------------------------
-- Table structure for photo
-- ----------------------------
DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_path` varchar(255) DEFAULT NULL,
  `photo_name` varchar(255) DEFAULT NULL,
  `photo_description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of photo
-- ----------------------------
INSERT INTO `photo` VALUES ('79', 'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg', 'Realme C3', null, '2023-03-07 09:14:24', null, null);

-- ----------------------------
-- Table structure for taxi
-- ----------------------------
DROP TABLE IF EXISTS `taxi`;
CREATE TABLE `taxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_num` varchar(15) NOT NULL,
  `company_id` int(11) NOT NULL,
  `tablet_id` int(11) DEFAULT NULL,
  `sim_number` varchar(15) DEFAULT NULL,
  `app_id` varchar(255) NOT NULL DEFAULT 'soaika1810',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of taxi
-- ----------------------------
INSERT INTO `taxi` VALUES ('1', '00506KF', '2', '2147483643', '1', 'patrick8301', null, null, null);
INSERT INTO `taxi` VALUES ('17', '00507KF', '2', '2147483647', '2', 'soaika1810', null, null, null);
INSERT INTO `taxi` VALUES ('18', '00508KF', '2', '2147483647', '3', 'soaika1811', null, null, null);
INSERT INTO `taxi` VALUES ('19', '00509KF', '2', '214748369', '4', 'soaika1812', null, null, null);
INSERT INTO `taxi` VALUES ('28', '43F1543', '18', '1677025399', '5', 'Taxi1677025399', null, null, null);
INSERT INTO `taxi` VALUES ('29', '00506K0', '19', '1677071185', '111', 'Taxi1677071185', null, null, null);
INSERT INTO `taxi` VALUES ('30', '79F4112', '19', '1677556948', '0100110111', 'Taxi1677556948', null, null, null);

-- ----------------------------
-- Table structure for taxi_company
-- ----------------------------
DROP TABLE IF EXISTS `taxi_company`;
CREATE TABLE `taxi_company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `company_group` varchar(255) NOT NULL,
  PRIMARY KEY (`company_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of taxi_company
-- ----------------------------
INSERT INTO `taxi_company` VALUES ('1', '0', 'Monaco');
INSERT INTO `taxi_company` VALUES ('2', '1', 'Group 1');
INSERT INTO `taxi_company` VALUES ('18', '1', 'Group 2');
INSERT INTO `taxi_company` VALUES ('19', '1', 'Group 3');
INSERT INTO `taxi_company` VALUES ('20', '1', 'Group 4');
INSERT INTO `taxi_company` VALUES ('21', '1', 'Group 5');
INSERT INTO `taxi_company` VALUES ('22', '0', 'Paris');
INSERT INTO `taxi_company` VALUES ('23', '22', 'Group 1');
INSERT INTO `taxi_company` VALUES ('24', '22', 'Group 2');
INSERT INTO `taxi_company` VALUES ('25', '22', 'Group 3');
INSERT INTO `taxi_company` VALUES ('26', '22', 'Group 4');
INSERT INTO `taxi_company` VALUES ('27', '22', 'Group 5');
INSERT INTO `taxi_company` VALUES ('28', '0', 'Danang');
INSERT INTO `taxi_company` VALUES ('29', '28', 'Mai Linh 1');
INSERT INTO `taxi_company` VALUES ('30', '28', 'Mai Linh 2');
INSERT INTO `taxi_company` VALUES ('31', '28', 'Mai Linh 3');
INSERT INTO `taxi_company` VALUES ('32', '28', 'Mai Linh 4');
INSERT INTO `taxi_company` VALUES ('33', '28', 'Mai Linh 5');
INSERT INTO `taxi_company` VALUES ('37', '0', 'Tokyo');
INSERT INTO `taxi_company` VALUES ('38', '37', 'Group 1');
INSERT INTO `taxi_company` VALUES ('39', '37', 'Group 2');
INSERT INTO `taxi_company` VALUES ('40', '37', 'Group 3');
INSERT INTO `taxi_company` VALUES ('41', '37', 'Group 4');
INSERT INTO `taxi_company` VALUES ('42', '0', 'Seoul');
INSERT INTO `taxi_company` VALUES ('43', '42', 'Group 1');
INSERT INTO `taxi_company` VALUES ('44', '42', 'Group 2');
INSERT INTO `taxi_company` VALUES ('45', '42', 'Group 3');
INSERT INTO `taxi_company` VALUES ('46', '42', 'Group 4');
INSERT INTO `taxi_company` VALUES ('51', '1', 'Group 6');
INSERT INTO `taxi_company` VALUES ('52', '1', 'Group 7');
INSERT INTO `taxi_company` VALUES ('53', '1', 'Group 8');

-- ----------------------------
-- Table structure for taxi_video_statistics
-- ----------------------------
DROP TABLE IF EXISTS `taxi_video_statistics`;
CREATE TABLE `taxi_video_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxi_id` int(11) NOT NULL,
  `company_video_id` int(11) NOT NULL,
  `human_type` int(11) NOT NULL,
  `human_time` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1564 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of taxi_video_statistics
-- ----------------------------
INSERT INTO `taxi_video_statistics` VALUES ('0', '0', '0', '0', '0000-00-00 00:00:00', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('10', '17', '9', '1', '2023-02-21 23:11:00', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('11', '17', '9', '2', '2023-02-21 23:11:29', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('12', '17', '9', '3', '2023-02-21 23:12:31', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('13', '17', '9', '0', '2023-02-21 23:12:46', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('14', '17', '10', '1', '2023-02-22 07:25:37', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('15', '17', '10', '2', '2023-02-22 07:26:09', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('16', '17', '10', '3', '2023-02-22 08:27:09', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('17', '17', '10', '0', '2023-02-22 08:27:28', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('18', '18', '10', '1', '2023-02-22 07:53:48', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('19', '18', '10', '2', '2023-02-22 07:54:05', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('20', '18', '10', '3', '2023-02-22 07:54:11', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('21', '18', '10', '2', '2023-02-22 07:54:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('22', '18', '10', '3', '2023-02-22 07:54:41', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('23', '18', '10', '0', '2023-02-22 07:54:45', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('24', '18', '10', '1', '2023-02-22 08:02:50', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('25', '18', '10', '2', '2023-02-22 08:03:07', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('26', '18', '10', '3', '2023-02-22 08:03:31', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('27', '18', '10', '0', '2023-02-22 08:03:37', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('28', '18', '10', '1', '2023-02-22 08:15:38', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('29', '18', '10', '2', '2023-02-22 08:15:54', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('30', '18', '10', '3', '2023-02-22 08:16:08', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('31', '18', '10', '0', '2023-02-22 08:16:14', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('37', '18', '10', '1', '2023-01-01 08:15:38', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('38', '18', '10', '2', '2023-01-01 08:15:54', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('39', '18', '10', '3', '2023-01-01 12:16:08', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('40', '18', '10', '0', '2023-01-01 13:16:14', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('41', '19', '10', '1', '2023-02-22 10:23:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('42', '19', '10', '0', '2023-02-22 10:23:49', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('43', '28', '11', '1', '2023-02-22 11:06:10', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('44', '28', '11', '0', '2023-02-22 11:06:33', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('45', '17', '11', '1', '2023-02-22 15:16:26', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('46', '17', '11', '0', '2023-02-22 15:16:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('47', '28', '12', '1', '2023-02-22 17:08:11', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('48', '28', '12', '0', '2023-02-22 17:31:55', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('49', '28', '12', '1', '2023-02-22 17:39:34', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('50', '28', '12', '0', '2023-02-22 17:39:38', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('51', '28', '12', '1', '2023-02-22 17:51:13', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('52', '28', '12', '0', '2023-02-22 17:51:27', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('53', '28', '12', '1', '2023-02-22 18:25:32', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('54', '28', '12', '2', '2023-02-22 18:27:46', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('55', '28', '12', '3', '2023-02-22 18:28:46', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('56', '28', '12', '0', '2023-02-22 18:31:37', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('57', '28', '12', '2', '2023-02-22 18:32:27', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('58', '28', '12', '3', '2023-02-22 18:32:33', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('59', '28', '12', '2', '2023-02-22 18:32:43', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('60', '28', '12', '3', '2023-02-22 18:32:46', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('61', '28', '12', '1', '2023-02-22 18:32:54', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('62', '28', '12', '2', '2023-02-22 18:32:57', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('63', '28', '12', '3', '2023-02-22 18:33:00', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('64', '28', '12', '0', '2023-02-22 18:33:02', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('65', '28', '12', '1', '2023-02-22 18:33:42', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('66', '28', '12', '2', '2023-02-22 18:33:52', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('67', '28', '12', '3', '2023-02-22 18:33:58', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('68', '28', '12', '0', '2023-02-22 18:34:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('73', '17', '11', '1', '2023-02-22 19:30:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('74', '17', '11', '2', '2023-02-22 19:31:55', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('75', '17', '11', '3', '2023-02-22 19:32:33', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('76', '17', '11', '0', '2023-02-22 19:32:36', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('77', '17', '11', '1', '2023-02-22 19:34:02', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('78', '17', '11', '2', '2023-02-22 19:34:23', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('79', '17', '11', '3', '2023-02-22 19:34:28', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('80', '17', '11', '0', '2023-02-22 19:34:31', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('81', '17', '13', '1', '2023-02-22 22:18:55', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('82', '17', '13', '2', '2023-02-22 22:19:23', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('83', '17', '13', '3', '2023-02-22 22:20:01', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('84', '17', '13', '0', '2023-02-22 22:20:05', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('85', '1', '13', '1', '2023-02-23 20:18:16', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('86', '1', '13', '0', '2023-02-23 20:18:25', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('87', '1', '13', '1', '2023-02-23 20:19:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('88', '1', '13', '2', '2023-02-23 20:19:24', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('89', '1', '13', '3', '2023-02-23 20:19:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('90', '1', '13', '0', '2023-02-23 20:19:37', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('155', '17', '13', '1', '2023-02-26 20:25:42', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('156', '17', '13', '2', '2023-02-26 20:26:05', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('157', '17', '13', '3', '2023-02-26 20:26:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('158', '17', '13', '0', '2023-02-26 20:26:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('159', '17', '13', '1', '2023-02-26 20:30:21', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('160', '17', '13', '2', '2023-02-26 20:30:44', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('161', '17', '13', '3', '2023-02-26 20:30:47', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('162', '17', '13', '0', '2023-02-26 20:30:48', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('163', '17', '13', '1', '2023-02-26 20:32:59', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('164', '17', '13', '2', '2023-02-26 20:33:22', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('165', '17', '13', '3', '2023-02-26 20:33:37', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('166', '17', '13', '0', '2023-02-26 20:33:46', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('167', '17', '13', '1', '2023-02-26 20:47:12', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('168', '17', '13', '2', '2023-02-26 20:47:23', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('169', '17', '13', '3', '2023-02-26 20:47:25', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('170', '17', '13', '0', '2023-02-26 20:47:25', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('171', '17', '13', '1', '2023-02-26 20:48:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('172', '17', '13', '2', '2023-02-26 20:48:15', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('173', '17', '13', '3', '2023-02-26 20:48:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('174', '17', '13', '2', '2023-02-26 20:48:41', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('175', '17', '13', '3', '2023-02-26 20:48:48', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('176', '17', '13', '0', '2023-02-26 20:48:48', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('177', '17', '13', '1', '2023-02-27 08:37:23', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('178', '17', '13', '0', '2023-02-27 08:37:26', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('179', '17', '13', '1', '2023-02-27 08:55:08', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('180', '17', '13', '0', '2023-02-27 08:55:14', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('181', '17', '13', '1', '2023-02-27 09:00:31', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('182', '17', '13', '2', '2023-02-27 09:00:40', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('183', '17', '13', '3', '2023-02-27 09:00:55', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('184', '17', '13', '2', '2023-02-27 09:01:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('185', '17', '13', '3', '2023-02-27 09:01:05', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('186', '17', '13', '0', '2023-02-27 09:01:05', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('187', '17', '13', '1', '2023-02-27 09:02:24', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('188', '17', '13', '0', '2023-02-27 09:02:31', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('189', '17', '13', '1', '2023-02-27 09:07:59', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('190', '17', '13', '0', '2023-02-27 09:08:17', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('191', '17', '13', '1', '2023-02-27 09:11:59', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('192', '17', '13', '2', '2023-02-27 09:12:01', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('193', '17', '13', '3', '2023-02-27 09:12:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('194', '17', '13', '0', '2023-02-27 09:12:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('195', '17', '13', '1', '2023-02-27 09:15:21', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('196', '17', '13', '0', '2023-02-27 09:15:36', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('197', '17', '13', '1', '2023-02-27 09:15:39', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('198', '17', '13', '2', '2023-02-27 09:15:42', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('199', '17', '13', '3', '2023-02-27 09:15:44', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('200', '17', '13', '0', '2023-02-27 09:15:44', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('201', '17', '13', '1', '2023-02-27 09:18:08', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('202', '17', '13', '0', '2023-02-27 09:18:17', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('203', '17', '13', '1', '2023-02-27 09:18:20', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('204', '17', '13', '0', '2023-02-27 09:18:21', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('205', '17', '13', '1', '2023-02-27 09:18:24', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('206', '17', '13', '2', '2023-02-27 09:18:24', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('207', '17', '13', '3', '2023-02-27 09:18:42', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('208', '17', '13', '0', '2023-02-27 09:18:43', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('209', '17', '13', '1', '2023-02-27 09:23:13', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('210', '17', '13', '2', '2023-02-27 09:23:22', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('211', '17', '13', '3', '2023-02-27 09:23:25', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('212', '17', '13', '0', '2023-02-27 09:23:25', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('213', '17', '13', '1', '2023-02-27 09:31:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('214', '17', '13', '2', '2023-02-27 09:32:02', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('215', '17', '13', '3', '2023-02-27 09:32:46', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('216', '17', '13', '0', '2023-02-27 09:32:47', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('217', '17', '13', '1', '2023-02-27 09:36:59', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('218', '17', '13', '0', '2023-02-27 09:37:03', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('219', '17', '13', '1', '2023-02-27 09:37:07', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('220', '17', '13', '2', '2023-02-27 09:37:12', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('221', '17', '13', '3', '2023-02-27 09:37:13', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('222', '17', '13', '0', '2023-02-27 09:37:14', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('223', '17', '13', '1', '2023-02-27 09:40:22', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('224', '17', '13', '2', '2023-02-27 09:40:33', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('225', '17', '13', '3', '2023-02-27 09:40:34', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('226', '17', '13', '0', '2023-02-27 09:40:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('227', '17', '13', '1', '2023-02-27 09:58:15', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('228', '17', '13', '0', '2023-02-27 09:58:20', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('229', '17', '13', '1', '2023-02-27 09:58:32', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('230', '17', '13', '0', '2023-02-27 09:58:41', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('231', '17', '13', '1', '2023-02-27 09:58:47', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('232', '17', '13', '2', '2023-02-27 09:58:48', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('233', '17', '13', '3', '2023-02-27 09:58:51', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('234', '17', '13', '0', '2023-02-27 09:58:51', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('235', '17', '13', '1', '2023-02-27 09:59:41', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('236', '17', '13', '2', '2023-02-27 09:59:51', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('237', '17', '13', '3', '2023-02-27 09:59:53', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('238', '17', '13', '0', '2023-02-27 09:59:53', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('239', '17', '13', '1', '2023-02-27 10:04:15', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('240', '17', '13', '2', '2023-02-27 10:04:16', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('241', '17', '13', '3', '2023-02-27 10:05:26', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('242', '17', '13', '0', '2023-02-27 10:05:27', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('243', '17', '13', '1', '2023-02-27 10:05:49', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('244', '17', '13', '2', '2023-02-27 10:05:49', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('245', '17', '13', '3', '2023-02-27 10:06:02', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('246', '17', '13', '0', '2023-02-27 10:06:12', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('247', '17', '13', '1', '2023-02-27 10:15:05', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('248', '17', '13', '2', '2023-02-27 10:15:08', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('249', '17', '13', '3', '2023-02-27 10:15:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('250', '17', '13', '0', '2023-02-27 10:15:36', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('251', '17', '13', '1', '2023-02-27 10:21:29', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('252', '17', '13', '2', '2023-02-27 10:21:39', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('253', '17', '13', '3', '2023-02-27 10:21:41', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('254', '17', '13', '0', '2023-02-27 10:21:42', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('255', '17', '13', '1', '2023-02-27 10:23:21', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('256', '17', '13', '0', '2023-02-27 10:23:29', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('257', '17', '13', '1', '2023-02-27 10:23:33', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('258', '17', '13', '2', '2023-02-27 10:23:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('259', '17', '13', '3', '2023-02-27 10:23:38', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('260', '17', '13', '0', '2023-02-27 10:23:38', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('261', '17', '13', '1', '2023-02-27 10:26:05', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('262', '17', '13', '0', '2023-02-27 10:26:11', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('263', '17', '13', '1', '2023-02-27 10:26:13', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('264', '17', '13', '2', '2023-02-27 10:26:16', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('265', '17', '13', '3', '2023-02-27 10:26:17', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('266', '17', '13', '0', '2023-02-27 10:26:18', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('267', '17', '13', '1', '2023-02-27 10:26:24', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('268', '17', '13', '0', '2023-02-27 10:26:26', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('269', '17', '13', '1', '2023-02-27 10:30:49', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('270', '17', '13', '0', '2023-02-27 10:33:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('271', '17', '13', '1', '2023-02-27 10:46:28', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('272', '17', '13', '0', '2023-02-27 10:46:31', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('273', '17', '13', '1', '2023-02-27 10:47:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('274', '17', '13', '2', '2023-02-27 10:47:15', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('275', '17', '13', '3', '2023-02-27 10:47:23', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('276', '17', '13', '0', '2023-02-27 10:47:23', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('277', '17', '13', '1', '2023-02-27 10:48:45', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('278', '17', '13', '0', '2023-02-27 10:48:49', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('279', '17', '13', '1', '2023-02-27 10:48:52', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('280', '17', '13', '2', '2023-02-27 10:48:55', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('281', '17', '13', '3', '2023-02-27 10:48:57', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('282', '17', '13', '0', '2023-02-27 10:48:57', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('283', '17', '13', '1', '2023-02-27 10:53:27', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('284', '17', '13', '0', '2023-02-27 10:55:42', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('285', '17', '13', '1', '2023-02-27 10:56:03', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('286', '17', '13', '0', '2023-02-27 10:56:07', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('287', '17', '13', '1', '2023-02-27 10:56:08', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('288', '17', '13', '0', '2023-02-27 10:56:11', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('289', '17', '13', '1', '2023-02-27 10:56:12', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('290', '17', '13', '2', '2023-02-27 10:56:18', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('291', '17', '13', '3', '2023-02-27 10:56:20', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('292', '17', '13', '0', '2023-02-27 10:56:20', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('293', '17', '13', '1', '2023-02-27 10:56:28', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('294', '17', '13', '0', '2023-02-27 10:56:32', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('295', '17', '13', '1', '2023-02-27 10:56:34', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('296', '17', '13', '2', '2023-02-27 10:56:41', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('297', '17', '13', '3', '2023-02-27 10:56:43', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('298', '17', '13', '0', '2023-02-27 10:56:44', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('299', '17', '13', '1', '2023-02-27 10:59:24', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('300', '17', '13', '0', '2023-02-27 10:59:28', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('301', '17', '13', '1', '2023-02-27 10:59:30', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('302', '17', '13', '2', '2023-02-27 10:59:37', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('303', '17', '13', '3', '2023-02-27 10:59:39', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('304', '17', '13', '0', '2023-02-27 10:59:40', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('305', '17', '13', '1', '2023-02-27 10:59:42', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('306', '17', '13', '0', '2023-02-27 10:59:49', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('307', '17', '13', '1', '2023-02-27 11:01:07', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('308', '17', '13', '2', '2023-02-27 11:01:17', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('309', '17', '13', '3', '2023-02-27 11:01:33', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('310', '17', '13', '0', '2023-02-27 11:01:38', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('311', '17', '13', '1', '2023-02-27 11:02:01', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('312', '17', '13', '0', '2023-02-27 11:02:02', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('313', '17', '13', '1', '2023-02-27 11:02:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('314', '17', '13', '2', '2023-02-27 11:02:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('315', '17', '13', '3', '2023-02-27 11:02:09', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('316', '17', '13', '0', '2023-02-27 11:02:09', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('317', '17', '13', '1', '2023-02-27 11:02:51', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('318', '17', '13', '0', '2023-02-27 11:02:56', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('319', '17', '13', '1', '2023-02-27 11:03:00', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('320', '17', '13', '2', '2023-02-27 11:03:04', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('321', '17', '13', '3', '2023-02-27 11:03:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('322', '17', '13', '0', '2023-02-27 11:03:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('323', '17', '13', '1', '2023-02-27 11:08:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('324', '17', '13', '0', '2023-02-27 11:08:38', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('325', '17', '13', '1', '2023-02-27 11:08:40', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('326', '17', '13', '0', '2023-02-27 11:09:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('327', '17', '13', '1', '2023-02-27 11:09:11', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('328', '17', '13', '0', '2023-02-27 11:09:22', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('329', '17', '13', '1', '2023-02-27 21:43:19', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('330', '17', '13', '0', '2023-02-27 21:43:37', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('331', '17', '13', '1', '2023-02-27 21:43:48', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('332', '17', '13', '0', '2023-02-27 21:43:53', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('333', '17', '13', '1', '2023-02-27 21:43:55', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('334', '17', '13', '0', '2023-02-27 21:43:57', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('335', '17', '13', '1', '2023-02-27 21:45:54', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('336', '17', '13', '0', '2023-02-27 21:45:55', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('337', '17', '13', '1', '2023-02-27 21:46:25', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('338', '17', '13', '0', '2023-02-27 21:46:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('339', '17', '13', '1', '2023-02-27 22:09:59', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('340', '17', '13', '2', '2023-02-27 22:10:11', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('341', '17', '13', '3', '2023-02-27 22:10:25', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('342', '17', '13', '0', '2023-02-27 22:10:25', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('343', '17', '13', '1', '2023-02-27 22:10:40', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('344', '17', '13', '0', '2023-02-27 22:11:03', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('345', '17', '13', '1', '2023-02-27 22:23:46', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('346', '17', '13', '0', '2023-02-27 22:24:10', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('347', '17', '13', '1', '2023-02-27 22:24:29', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('348', '17', '13', '0', '2023-02-27 22:24:38', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('349', '17', '13', '1', '2023-02-27 22:43:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('350', '17', '13', '0', '2023-02-27 22:43:16', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('351', '17', '13', '1', '2023-02-27 22:53:26', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('352', '17', '13', '0', '2023-02-27 22:53:27', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('353', '17', '13', '1', '2023-02-27 22:55:10', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('354', '17', '13', '0', '2023-02-27 22:55:11', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('355', '17', '13', '1', '2023-02-27 22:55:13', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('356', '17', '13', '0', '2023-02-27 22:55:14', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('357', '17', '13', '1', '2023-02-27 22:56:54', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('358', '17', '13', '0', '2023-02-27 22:56:56', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('359', '17', '13', '1', '2023-02-28 08:38:29', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('360', '17', '13', '0', '2023-02-28 08:38:30', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('450', '17', '15', '1', '2023-03-02 11:23:09', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('451', '17', '15', '2', '2023-03-02 11:23:23', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('452', '17', '15', '3', '2023-03-02 11:23:38', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('453', '17', '15', '2', '2023-03-02 11:23:53', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('454', '17', '15', '3', '2023-03-02 11:24:08', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('455', '17', '15', '2', '2023-03-02 11:24:22', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('456', '17', '15', '3', '2023-03-02 11:24:37', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('457', '17', '15', '2', '2023-03-02 11:24:52', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('458', '17', '15', '3', '2023-03-02 11:25:07', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('459', '17', '15', '2', '2023-03-02 11:25:21', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('460', '17', '15', '3', '2023-03-02 11:25:36', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('461', '17', '15', '2', '2023-03-02 11:25:51', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('462', '17', '15', '3', '2023-03-02 11:26:06', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('463', '17', '15', '2', '2023-03-02 11:26:20', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('464', '17', '15', '3', '2023-03-02 11:26:35', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('465', '17', '15', '2', '2023-03-02 11:26:50', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('466', '17', '15', '3', '2023-03-02 11:27:05', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('467', '17', '15', '2', '2023-03-02 11:27:19', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('468', '17', '15', '3', '2023-03-02 11:27:24', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('469', '17', '15', '0', '2023-03-02 11:27:24', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('499', '17', '15', '-1', '2023-03-02 16:08:16', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('500', '17', '15', '1', '2023-03-02 16:08:32', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('501', '17', '15', '4', '2023-03-02 16:08:47', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('502', '17', '15', '-1', '2023-03-02 16:08:49', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('503', '17', '15', '2', '2023-03-02 16:08:54', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('504', '17', '15', '3', '2023-03-02 16:08:54', null, null);
INSERT INTO `taxi_video_statistics` VALUES ('505', '17', '15', '0', '2023-03-02 16:08:55', null, null);

-- ----------------------------
-- Table structure for video
-- ----------------------------
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video_path` text NOT NULL,
  `video_name` varchar(255) DEFAULT NULL,
  `video_description` varchar(255) DEFAULT NULL,
  `video_length` varchar(255) DEFAULT NULL,
  `video_thumbnail` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of video
-- ----------------------------
INSERT INTO `video` VALUES ('39', 'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/videos/wk0mmBZ6COpkBnn6GltQa0bqze0ro4MY2maaSOne.mp4', 'Ads-Video', null, '30 seconds', 'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg', '2023-03-02 21:08:52', null, null);
INSERT INTO `video` VALUES ('40', 'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/videos/YpzC89maTlj2RFqE5HJrciNn6wZf42Gt2i2IGa4D.mp4', 'Ads_Video_1080p', null, '30 seconds', 'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg', '2023-03-02 22:33:43', null, null);
INSERT INTO `video` VALUES ('41', 'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/videos/gciO0RN81KnpOWeofFf17PvghlOIJXYVF8Z4pATq.mp4', 'Ads Samsung', null, '46 seconds', 'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg', '2023-03-02 22:42:53', null, null);
INSERT INTO `video` VALUES ('42', 'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/videos/CDPqeULPSKEGqR7OjjgMhct0Sk9aY3N0tJwf7GnW.mp4', 'Ip14 ads', null, '46 seconds', 'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg', '2023-03-02 22:45:39', null, '2023-03-02 22:46:18');
