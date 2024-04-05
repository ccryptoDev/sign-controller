-- MariaDB dump 10.19  Distrib 10.6.17-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sign_project
-- ------------------------------------------------------
-- Server version	10.6.17-MariaDB-1:10.6.17+maria~ubu2004

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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `business_name` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jing','jing@inex.net',NULL,'$2y$10$8y6oVgm8MGj0wF.1.2g1ZeYDlkVcVUvXJJaCzLhgOf.wrrjDV6eBC','Tai','Fu',2,0,'INEX','8VdNp9NqGwHT8VBgzDjk7Ka5xzBAVgO4TrXHz0zuDiU1VRtEGqaBePZpYpnu',NULL,NULL,'2023-11-08 19:41:51','2023-11-09 22:14:18'),(5,'Tiago Souza','tiago@inex.net',NULL,'$2y$10$L1KiqTgIY6EOR2Z3gOl1GuSjB6hv76kfXaom5QrUOREhEM6.7Jfqm','Tiago','Souza 123123123',1,0,NULL,NULL,NULL,NULL,'2023-11-09 22:13:29','2023-11-09 22:17:04'),(11,'user','user@inex.net',NULL,'$2y$10$79KkMsuH9F1IQHA4715bM.gfb2jW.4MNTu47pYO.m.oaCADGRZJ7m',NULL,NULL,0,0,NULL,NULL,NULL,NULL,'2024-03-17 17:53:10','2024-03-17 17:53:10'),(12,'admin','admin@inex.net',NULL,'$2y$10$iZy0GwJ4/2vVVhvEpwQcQuAper6r.eBkiPcFcmTe5VRZ7gWxZ0eza',NULL,NULL,1,0,NULL,NULL,NULL,NULL,'2024-03-17 17:54:40','2024-03-17 17:54:40'),(13,'superadmin','superadmin@inex.net',NULL,'$2y$10$vw8c493K54kq26sezsEzquMRn4mZnnQkdlGgTdPSny6Gs.3AhoWXe',NULL,NULL,2,0,NULL,NULL,NULL,NULL,'2024-03-17 17:55:50','2024-03-17 17:55:50'),(14,'Araki Haru','inteliokayluck@gmail.com',NULL,'$2y$10$5jRKU5RAaJdR0kVhrckhM.8Bg7PbVpBC.gUn0gso7uZ3/s2aW7RUK',NULL,NULL,2,0,NULL,NULL,NULL,NULL,'2024-03-21 16:40:18','2024-03-21 16:40:18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-04 13:32:02
