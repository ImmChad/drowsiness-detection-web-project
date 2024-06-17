-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: falling_asleep_driver
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `name_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `num_phone_admin` varchar(255) NOT NULL,
  `birthday_admin` date NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'Tung Admin','soaika1810','0123456789','2003-02-18');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `company_group` varchar(255) NOT NULL,
  PRIMARY KEY (`company_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,0,'Monaco'),(2,1,'Group 1'),(18,1,'Group 2'),(19,1,'Group 4'),(20,1,'Group 4'),(21,1,'Group 5'),(22,0,'Paris'),(23,22,'Group 1'),(24,22,'Group 2'),(25,22,'Group 3'),(26,22,'Group 4'),(27,22,'Group 5'),(28,0,'Danang'),(29,28,'Mai Linh 1'),(30,28,'Mai Linh 2'),(31,28,'Mai Linh 3'),(32,28,'Mai Linh 4'),(33,28,'Mai Linh 5'),(37,0,'Tokyo'),(38,37,'Group 1'),(39,37,'Group 2'),(40,37,'Group 3'),(41,37,'Group 4'),(42,0,'Seoul'),(43,42,'Group 1'),(44,42,'Group 2'),(45,42,'Group 3'),(46,42,'Group 4'),(51,1,'Group 6'),(52,1,'Group 7'),(53,1,'Group 8'),(60,0,'Nhatrang'),(61,60,'123213123'),(62,0,'Dalat'),(63,62,'hello');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_photo`
--

DROP TABLE IF EXISTS `company_photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_photo`
--

LOCK TABLES `company_photo` WRITE;
/*!40000 ALTER TABLE `company_photo` DISABLE KEYS */;
INSERT INTO `company_photo` VALUES (5,2,13,'','2023-02-21 15:44:30',NULL,NULL),(6,18,14,'','2023-02-21 15:46:34',NULL,NULL),(7,2,14,'','2023-02-21 22:52:50',NULL,NULL),(8,0,13,'','2023-02-22 07:25:27',NULL,NULL),(9,0,15,'','2023-02-22 11:05:44',NULL,NULL),(10,18,13,'','2023-02-22 16:06:58',NULL,NULL),(11,0,16,'','2023-02-22 22:18:33',NULL,NULL),(12,0,14,'','2023-03-01 20:48:21',NULL,NULL),(13,0,79,'','2023-03-01 20:49:42',NULL,NULL);
/*!40000 ALTER TABLE `company_photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_video`
--

DROP TABLE IF EXISTS `company_video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_video`
--

LOCK TABLES `company_video` WRITE;
/*!40000 ALTER TABLE `company_video` DISABLE KEYS */;
INSERT INTO `company_video` VALUES (7,2,39,1,'','2023-02-21 15:44:30',NULL),(8,18,40,3,'','2023-02-21 15:46:34',NULL),(9,2,41,1,'','2023-02-21 22:52:50',NULL),(10,0,42,1,'','2023-02-22 07:25:27',NULL),(11,0,43,1,'','2023-02-22 11:05:44',NULL),(12,18,41,1,'','2023-02-22 16:06:58',NULL),(13,0,40,1,'','2023-02-22 22:18:33',NULL),(14,0,42,1,'','2023-03-01 20:48:21',NULL),(15,0,42,1,'','2023-03-01 20:49:42',NULL);
/*!40000 ALTER TABLE `company_video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detect_statistics`
--

DROP TABLE IF EXISTS `detect_statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detect_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1572 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detect_statistics`
--

LOCK TABLES `detect_statistics` WRITE;
/*!40000 ALTER TABLE `detect_statistics` DISABLE KEYS */;
INSERT INTO `detect_statistics` VALUES (1566,17,'2024-06-16 04:39:46'),(1567,17,'2024-06-16 04:39:51'),(1568,17,'2024-06-16 04:46:22'),(1569,17,'2024-06-16 05:14:36'),(1570,18,'2024-06-16 05:16:06'),(1571,18,'2024-06-16 05:16:08');
/*!40000 ALTER TABLE `detect_statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (79,'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg','Realme C3',NULL,'2023-03-07 09:14:24',NULL,NULL);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle` (
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle`
--

LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` VALUES (1,'00506KF',2,2147483643,'1','patrick8301',NULL,NULL,NULL),(17,'00507KF',2,2147483647,'2','soaika1810',NULL,NULL,NULL),(18,'00508KF',2,2147483647,'3','soaika1811',NULL,NULL,NULL),(19,'00509KF',2,214748369,'4','soaika1812',NULL,NULL,NULL),(28,'43F1543',18,1677025392,'5','Taxi1677025399',NULL,'2024-06-03 04:47:00',NULL),(32,'1231',18,1717389376,'1233','Vehicle1717389376','2024-06-03 04:36:16','2024-06-03 04:36:16',NULL);
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (39,'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/videos/wk0mmBZ6COpkBnn6GltQa0bqze0ro4MY2maaSOne.mp4','Ads-Video',NULL,'30 seconds','https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg','2023-03-02 21:08:52',NULL,NULL),(40,'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/videos/YpzC89maTlj2RFqE5HJrciNn6wZf42Gt2i2IGa4D.mp4','Ads_Video_1080p',NULL,'30 seconds','https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg','2023-03-02 22:33:43',NULL,NULL),(41,'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/videos/gciO0RN81KnpOWeofFf17PvghlOIJXYVF8Z4pATq.mp4','Ads Samsung',NULL,'46 seconds','https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg','2023-03-02 22:42:53',NULL,NULL),(42,'https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/videos/CDPqeULPSKEGqR7OjjgMhct0Sk9aY3N0tJwf7GnW.mp4','Ip14 ads',NULL,'46 seconds','https://taxi-monaco-dev-bucket.s3.eu-west-3.amazonaws.com/public/images/PZ1zlCUuHiCV7jU5n5PrXQZvJLJ2zulsFCSMre9T.jpg','2023-03-02 22:45:39',NULL,'2023-03-02 22:46:18');
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-16  5:29:20
