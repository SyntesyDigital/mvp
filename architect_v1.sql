-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: architect_v1
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `_lft` int(10) unsigned NOT NULL DEFAULT '0',
  `_rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `order` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,1,2,1,NULL,'2018-11-26 11:01:45','2018-11-26 11:01:45');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_fields`
--

DROP TABLE IF EXISTS `categories_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_fields_category_id_foreign` (`category_id`),
  KEY `categories_fields_language_id_foreign` (`language_id`),
  CONSTRAINT `categories_fields_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `categories_fields_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_fields`
--

LOCK TABLES `categories_fields` WRITE;
/*!40000 ALTER TABLE `categories_fields` DISABLE KEYS */;
INSERT INTO `categories_fields` VALUES (1,1,2,'name','Categoria 1','2018-11-26 11:01:45','2018-11-26 11:01:45'),(2,1,4,'name','Categorie 1','2018-11-26 11:01:45','2018-11-26 11:01:45'),(3,1,2,'slug','categoria-1','2018-11-26 11:01:45','2018-11-26 11:01:45'),(4,1,4,'slug','categorie-1','2018-11-26 11:01:46','2018-11-26 11:01:46'),(5,1,2,'description','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lacinia, ipsum in accumsan mattis, sapien turpis ultrices nulla, eu fermentum mauris erat at tellus. Ut tempus laoreet erat. Ut vitae ex nec mi malesuada scelerisque. Nullam congue egestas vulputate. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum feugiat leo et eros sagittis porttitor. Proin sed interdum ante. Sed ipsum risus, posuere sit amet elementum sit amet, semper at libero. Donec feugiat arcu non turpis viverra, at porta arcu efficitur. Maecenas imperdiet varius mollis. Proin semper suscipit suscipit. Quisque pretium magna neque, sit amet feugiat sapien hendrerit blandit. Sed ac metus vel mi porttitor eleifend eu lacinia enim. Aliquam erat volutpat.','2018-11-26 11:01:46','2018-11-26 11:01:46'),(6,1,4,'description','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lacinia, ipsum in accumsan mattis, sapien turpis ultrices nulla, eu fermentum mauris erat at tellus. Ut tempus laoreet erat. Ut vitae ex nec mi malesuada scelerisque. Nullam congue egestas vulputate. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum feugiat leo et eros sagittis porttitor. Proin sed interdum ante. Sed ipsum risus, posuere sit amet elementum sit amet, semper at libero. Donec feugiat arcu non turpis viverra, at porta arcu efficitur. Maecenas imperdiet varius mollis. Proin semper suscipit suscipit. Quisque pretium magna neque, sit amet feugiat sapien hendrerit blandit. Sed ac metus vel mi porttitor eleifend eu lacinia enim. Aliquam erat volutpat.','2018-11-26 11:01:46','2018-11-26 11:01:46');
/*!40000 ALTER TABLE `categories_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typology_id` int(10) unsigned DEFAULT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_page` tinyint(1) DEFAULT NULL,
  `_lft` int(10) unsigned NOT NULL DEFAULT '0',
  `_rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `settings` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `contents_typology_id_foreign` (`typology_id`),
  KEY `contents_author_id_foreign` (`author_id`),
  KEY `contents__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`),
  CONSTRAINT `contents_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  CONSTRAINT `contents_typology_id_foreign` FOREIGN KEY (`typology_id`) REFERENCES `typologies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents`
--

LOCK TABLES `contents` WRITE;
/*!40000 ALTER TABLE `contents` DISABLE KEYS */;
INSERT INTO `contents` VALUES (1,NULL,1,'1','2018-11-26 09:32:52','2018-11-26 09:21:45','2018-11-26 09:32:52',1,1,2,NULL,'{\"htmlClass\":null,\"pageType\":null}'),(2,NULL,1,'1','2018-11-26 09:32:45','2018-11-26 09:24:57','2018-11-26 09:32:45',1,3,4,NULL,'{\"htmlClass\":null,\"pageType\":null}'),(3,1,1,'1','2018-11-26 09:32:33','2018-11-26 09:30:05','2018-11-26 09:32:33',0,5,6,NULL,'{\"htmlClass\":null}'),(4,1,1,'1','2018-11-26 09:32:18','2018-11-26 09:31:14','2018-11-26 09:32:18',0,7,8,NULL,'{\"htmlClass\":null}'),(5,1,1,'1','2018-11-26 09:32:11','2018-11-26 09:32:04','2018-11-26 09:32:11',0,9,10,NULL,'{\"htmlClass\":null}');
/*!40000 ALTER TABLE `contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents_categories`
--

DROP TABLE IF EXISTS `contents_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `content_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_categories_category_id_foreign` (`category_id`),
  KEY `contents_categories_content_id_foreign` (`content_id`),
  CONSTRAINT `contents_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contents_categories_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_categories`
--

LOCK TABLES `contents_categories` WRITE;
/*!40000 ALTER TABLE `contents_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `contents_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents_fields`
--

DROP TABLE IF EXISTS `contents_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `relation` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_fields_content_id_foreign` (`content_id`),
  KEY `contents_fields_language_id_foreign` (`language_id`),
  CONSTRAINT `contents_fields_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contents_fields_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_fields`
--

LOCK TABLES `contents_fields` WRITE;
/*!40000 ALTER TABLE `contents_fields` DISABLE KEYS */;
INSERT INTO `contents_fields` VALUES (15,1,4,'title','Home',NULL,NULL,'2018-11-26 09:23:17','2018-11-26 09:23:17'),(16,1,2,'title','Home',NULL,NULL,'2018-11-26 09:23:17','2018-11-26 09:23:17'),(18,1,4,'slug','home',NULL,NULL,'2018-11-26 09:23:17','2018-11-26 09:23:17'),(19,1,2,'slug','home',NULL,NULL,'2018-11-26 09:23:17','2018-11-26 09:23:17'),(22,2,4,'title','Blog',NULL,NULL,'2018-11-26 09:24:57','2018-11-26 09:24:57'),(23,2,2,'title','Blog',NULL,NULL,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(24,2,4,'slug','blog',NULL,NULL,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(25,2,2,'slug','blog',NULL,NULL,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(120,3,4,'title','Information 1',NULL,NULL,'2018-11-26 10:00:22','2018-11-26 10:00:22'),(121,3,2,'title','Noticia 1',NULL,NULL,'2018-11-26 10:00:22','2018-11-26 10:00:22'),(122,3,4,'slug','information-1',NULL,NULL,'2018-11-26 10:00:22','2018-11-26 10:00:22'),(123,3,2,'slug','noticia-1',NULL,NULL,'2018-11-26 10:00:22','2018-11-26 10:00:22'),(126,3,NULL,'data','1542668400',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(127,3,NULL,'imatge','6','medias',NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(128,3,4,'descripcio','<p><span style=\"color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</span></p>',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(129,3,2,'descripcio','<p><span style=\"color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</span></p>',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(132,3,4,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(133,3,2,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(136,4,4,'title','Information 2',NULL,NULL,'2018-11-26 10:00:45','2018-11-26 10:00:45'),(137,4,2,'title','Noticia 2',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(138,4,4,'slug','information-2',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(139,4,2,'slug','noticia-2',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(142,4,NULL,'data','1542927600',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(143,4,NULL,'imatge','7','medias',NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(144,4,4,'descripcio','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p>',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(145,4,2,'descripcio','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p>',NULL,NULL,'2018-11-26 10:00:47','2018-11-26 10:00:47'),(148,4,4,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:00:47','2018-11-26 10:00:47'),(149,4,2,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:00:47','2018-11-26 10:00:47'),(152,5,4,'title','Information 3',NULL,NULL,'2018-11-26 10:01:34','2018-11-26 10:01:34'),(153,5,2,'title','Noticia 3',NULL,NULL,'2018-11-26 10:01:34','2018-11-26 10:01:34'),(154,5,4,'slug','information-3',NULL,NULL,'2018-11-26 10:01:34','2018-11-26 10:01:34'),(155,5,2,'slug','noticia-3',NULL,NULL,'2018-11-26 10:01:34','2018-11-26 10:01:34'),(158,5,NULL,'data','1543273200',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(159,5,NULL,'imatge','8','medias',NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(160,5,4,'descripcio','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p>',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(161,5,2,'descripcio','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p>',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(164,5,4,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(165,5,2,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35');
/*!40000 ALTER TABLE `contents_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents_languages`
--

DROP TABLE IF EXISTS `contents_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_languages` (
  `content_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  KEY `contents_languages_content_id_foreign` (`content_id`),
  KEY `contents_languages_language_id_foreign` (`language_id`),
  CONSTRAINT `contents_languages_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `contents_languages_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_languages`
--

LOCK TABLES `contents_languages` WRITE;
/*!40000 ALTER TABLE `contents_languages` DISABLE KEYS */;
INSERT INTO `contents_languages` VALUES (1,4),(1,2),(2,4),(2,2),(3,4),(3,2),(4,4),(4,2),(5,4),(5,2);
/*!40000 ALTER TABLE `contents_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contents_tags`
--

DROP TABLE IF EXISTS `contents_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contents_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) unsigned NOT NULL,
  `content_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_tags_tag_id_foreign` (`tag_id`),
  KEY `contents_tags_content_id_foreign` (`content_id`),
  CONSTRAINT `contents_tags_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`),
  CONSTRAINT `contents_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_tags`
--

LOCK TABLES `contents_tags` WRITE;
/*!40000 ALTER TABLE `contents_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `contents_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typology_id` int(10) unsigned NOT NULL,
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rules` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settings` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fields_typology_id_foreign` (`typology_id`),
  CONSTRAINT `fields_typology_id_foreign` FOREIGN KEY (`typology_id`) REFERENCES `typologies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fields`
--

LOCK TABLES `fields` WRITE;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
INSERT INTO `fields` VALUES (14,1,'title','Títol','text','fa-font','{\"required\":true,\"unique\":null,\"maxCharacters\":null,\"minCharacters\":null}','{\"entryTitle\":true,\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(15,1,'slug','Slug','slug','fa-link','{\"required\":true,\"unique\":true}',NULL,'2018-11-26 09:18:27','2018-11-26 09:18:27'),(16,1,'data','Date','date','fa-calendar','{\"required\":null}','{\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(17,1,'imatge','Image','image','fa-picture-o','{\"required\":null}','{\"cropsAllowed\":null,\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(18,1,'descripcio','Description','richtext','fa-align-left','{\"required\":null,\"maxCharacters\":null}','{\"fieldHeight\":null,\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(19,1,'contingut','Contenu','richtext','fa-align-left','{\"required\":null,\"maxCharacters\":null}','{\"fieldHeight\":null,\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(20,1,'pdf','PDF','file','fa-file-pdf-o','{\"required\":null}','{\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(21,1,'enllac-extern','Lien externe','link','fa-link','{\"required\":null}','{\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(22,1,'video','video','video','fa-video-camera','{\"required\":null}','{\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(23,1,'rotatorio','Carrousel','images','fa-picture-o','{\"required\":null,\"maxItems\":null,\"minItems\":null}','{\"cropsAllowed\":null,\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(24,1,'es-entrevista','C\'est une interview ?','boolean','fa-check-square-o','{\"required\":null}','{\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(25,1,'nom','Nom','text','fa-font','{\"required\":null,\"unique\":null,\"maxCharacters\":null,\"minCharacters\":null}','{\"entryTitle\":null,\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27'),(26,1,'carrec','Charge','text','fa-font','{\"required\":null,\"unique\":null,\"maxCharacters\":null,\"minCharacters\":null}','{\"entryTitle\":null,\"htmlId\":null,\"htmlClass\":null}','2018-11-26 09:18:27','2018-11-26 09:18:27');
/*!40000 ALTER TABLE `fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_contact`
--

DROP TABLE IF EXISTS `form_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `privacity` tinyint(1) NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `programs` text COLLATE utf8mb4_unicode_ci,
  `program_values` text COLLATE utf8mb4_unicode_ci,
  `init_program` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `init_program_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('contact','newsletter') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_contact`
--

LOCK TABLES `form_contact` WRITE;
/*!40000 ALTER TABLE `form_contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_contact_selection`
--

DROP TABLE IF EXISTS `form_contact_selection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_contact_selection` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `privacity` tinyint(1) NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `conditions` tinyint(1) NOT NULL,
  `items` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `items_value` text COLLATE utf8mb4_unicode_ci,
  `typology` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_contact_selection`
--

LOCK TABLES `form_contact_selection` WRITE;
/*!40000 ALTER TABLE `form_contact_selection` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_contact_selection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_press`
--

DROP TABLE IF EXISTS `form_press`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_press` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `media_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_distribution` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_comment` text COLLATE utf8mb4_unicode_ci,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `web` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateStart` timestamp NULL DEFAULT NULL,
  `dateEnd` timestamp NULL DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `privacity` tinyint(1) NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `delivery` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_press`
--

LOCK TABLES `form_press` WRITE;
/*!40000 ALTER TABLE `form_press` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_press` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (2,'Español','es','2018-11-23 16:00:48','2018-11-23 16:00:48',NULL,NULL),(4,'Français','fr','2018-11-23 16:08:48','2018-11-26 09:22:20',NULL,1);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medias`
--

DROP TABLE IF EXISTS `medias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stored_filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uploaded_filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metadata` text COLLATE utf8mb4_unicode_ci,
  `author_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medias_author_id_foreign` (`author_id`),
  CONSTRAINT `medias_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medias`
--

LOCK TABLES `medias` WRITE;
/*!40000 ALTER TABLE `medias` DISABLE KEYS */;
INSERT INTO `medias` VALUES (6,'image','image/jpeg','3NerKMZ5jdo0hWGCQnKb5O2kHGxivBAKFdN2d8ZR.jpeg','1.jpg','{\"filesize\":\"7,16\",\"dimension\":\"400x600\"}',1,'2018-11-26 09:59:52','2018-11-26 09:59:52'),(7,'image','image/jpeg','ijON4bcXuoPn0RYmDkasrb7Q4bSEpgzGD7RXiwXS.jpeg','2.jpg','{\"filesize\":\"11,40\",\"dimension\":\"400x600\"}',1,'2018-11-26 09:59:57','2018-11-26 09:59:57'),(8,'image','image/jpeg','TWozYNJ9hDt7RM7I5awh2OONeOlCRDwTri0D61lk.jpeg','3.jpg','{\"filesize\":\"9,73\",\"dimension\":\"400x600\"}',1,'2018-11-26 10:00:00','2018-11-26 10:00:00');
/*!40000 ALTER TABLE `medias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `settings` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus_elements`
--

DROP TABLE IF EXISTS `menus_elements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus_elements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `_lft` int(10) unsigned NOT NULL DEFAULT '0',
  `_rgt` int(10) unsigned NOT NULL DEFAULT '0',
  `parent_id` int(10) unsigned DEFAULT NULL,
  `settings` longtext COLLATE utf8mb4_unicode_ci,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_elements_menu_id_foreign` (`menu_id`),
  KEY `menus_elements__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`),
  CONSTRAINT `menus_elements_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus_elements`
--

LOCK TABLES `menus_elements` WRITE;
/*!40000 ALTER TABLE `menus_elements` DISABLE KEYS */;
/*!40000 ALTER TABLE `menus_elements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus_elements_fields`
--

DROP TABLE IF EXISTS `menus_elements_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus_elements_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_element_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned DEFAULT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `relation` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menus_elements_fields_menu_element_id_foreign` (`menu_element_id`),
  KEY `menus_elements_fields_language_id_foreign` (`language_id`),
  CONSTRAINT `menus_elements_fields_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  CONSTRAINT `menus_elements_fields_menu_element_id_foreign` FOREIGN KEY (`menu_element_id`) REFERENCES `menus_elements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus_elements_fields`
--

LOCK TABLES `menus_elements_fields` WRITE;
/*!40000 ALTER TABLE `menus_elements_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `menus_elements_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (100,'2014_10_12_100000_create_password_resets_table',1),(101,'2018_05_09_171031_create_table_users',1),(102,'2018_05_10_194030_create_table_languages',1),(103,'2018_05_10_194133_create_table_typologies',1),(104,'2018_05_10_194140_create_table_fields',1),(105,'2018_05_10_194146_create_table_contents',1),(106,'2018_05_10_194157_create_table_contents_fields',1),(107,'2018_05_17_164912_entrust_setup_tables',1),(108,'2018_05_23_091527_create_table_medias',1),(109,'2018_05_26_145542_alter_table_medias_add_uploaded_by_field',1),(110,'2018_06_18_225102_create_table_categories',1),(111,'2018_06_18_225224_create_table_categories_fields',1),(112,'2018_06_19_160454_create_table_tags',1),(113,'2018_06_19_160500_create_table_tags_fields',1),(114,'2018_06_20_162837_create_table_tags_contents',1),(115,'2018_06_20_162845_create_table_categories_contents',1),(116,'2018_06_26_112014_alter_table_categories_add_order',1),(117,'2018_06_26_154308_create_table_page',1),(118,'2018_06_26_174222_create_table_contents_languages',1),(119,'2018_06_26_175748_update_table_languages_add_default',1),(120,'2018_06_26_184854_update_table_typology_add_categories_and_tags_bool',1),(121,'2018_06_28_155805_create_table_typology_fields',1),(122,'2018_07_07_111804_alter_table_content_add_is_page_field',1),(123,'2018_07_07_121507_alter_table_content_add_parent_id_field',1),(124,'2018_07_16_155534_create_table_layouts',1),(125,'2018_07_24_154934_add_pages_settings_field',1),(126,'2018_07_26_142908_alter_contents_add_settings_fields',1),(127,'2018_08_17_173649_alter_table_users_add_soft_delete',1),(128,'2018_08_20_142602_create_menu_table',1),(129,'2018_08_23_120703_add_menu_order_settings',1),(130,'2018_08_29_161327_contact_form_tables',1),(131,'2018_08_31_123445_add_translations',1),(132,'2018_09_06_125608_create_table_urls',1),(133,'2018_10_03_131459_alter_selection_contact',1),(134,'2018_10_04_112317_alter_table_selection',1),(135,'2018_10_22_165502_add_delivery_field',1),(136,'2018_10_23_155555_add_language',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(10) unsigned DEFAULT NULL,
  `definition` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_content_id_foreign` (`content_id`),
  CONSTRAINT `pages_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `contents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (3,1,'null','2018-11-26 09:23:17','2018-11-26 09:23:17'),(4,2,'[{\"type\":\"row\",\"settings\":{\"htmlId\":null,\"htmlClass\":null,\"hasContainer\":null},\"children\":[{\"type\":\"col\",\"settings\":{\"htmlId\":null,\"htmlClass\":null},\"colClass\":\"col-xs-12\",\"children\":[{\"type\":\"item\",\"field\":{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Text\",\"rules\":{\"required\":null,\"unique\":null,\"maxCharacters\":null,\"minCharacters\":null},\"label\":\"Texte\",\"name\":\"Texte\",\"type\":\"text\",\"icon\":\"fa-font\",\"settings\":{\"entryTitle\":null,\"htmlId\":null,\"htmlClass\":null},\"fieldname\":\"pagefield_5bfbbbea6b46d\"}},{\"type\":\"item\",\"field\":{\"class\":\"Modules\\\\Architect\\\\Widgets\\\\Types\\\\Blog\",\"rules\":{\"required\":null},\"label\":\"BLOG\",\"name\":\"architect::widgets.BLOG\",\"type\":\"widget\",\"icon\":\"fa-file-o\",\"settings\":{\"htmlId\":null,\"htmlClass\":null,\"itemsPerPage\":null},\"component\":\"CommonWidget\",\"widget\":null,\"hidden\":false,\"defaultSettings\":null,\"identifier\":\"temp_[0,0,1]\",\"fieldname\":\"pagewidget_5bfbbbea761c1\"}}]}]}]','2018-11-26 09:24:58','2018-11-26 09:24:58');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages_layouts`
--

DROP TABLE IF EXISTS `pages_layouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages_layouts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `definition` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `settings` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages_layouts`
--

LOCK TABLES `pages_layouts` WRITE;
/*!40000 ALTER TABLE `pages_layouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages_layouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1),(3,2),(2,3);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','','2018-11-23 16:00:48','2018-11-23 16:00:48'),(2,'editor','Editor','','2018-11-23 16:00:48','2018-11-23 16:00:48'),(3,'author','Author','','2018-11-23 16:00:48','2018-11-23 16:00:48');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'2018-11-26 11:06:25','2018-11-26 11:06:25');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags_fields`
--

DROP TABLE IF EXISTS `tags_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tags_fields_tag_id_foreign` (`tag_id`),
  KEY `tags_fields_language_id_foreign` (`language_id`),
  CONSTRAINT `tags_fields_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  CONSTRAINT `tags_fields_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags_fields`
--

LOCK TABLES `tags_fields` WRITE;
/*!40000 ALTER TABLE `tags_fields` DISABLE KEYS */;
INSERT INTO `tags_fields` VALUES (1,1,2,'name','tag 1','2018-11-26 11:06:26','2018-11-26 11:06:26'),(2,1,4,'name','tag 1','2018-11-26 11:06:26','2018-11-26 11:06:26'),(3,1,2,'slug','tag-1','2018-11-26 11:06:26','2018-11-26 11:06:26'),(4,1,4,'slug','tag-1','2018-11-26 11:06:26','2018-11-26 11:06:26'),(5,1,2,'description','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lacinia, ipsum in accumsan mattis, sapien turpis ultrices nulla, eu fermentum mauris erat at tellus. Ut tempus laoreet erat. Ut vitae ex nec mi malesuada scelerisque. Nullam congue egestas vulputate. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum feugiat leo et eros sagittis porttitor. Proin sed interdum ante. Sed ipsum risus, posuere sit amet elementum sit amet, semper at libero. Donec feugiat arcu non turpis viverra, at porta arcu efficitur. Maecenas imperdiet varius mollis. Proin semper suscipit suscipit. Quisque pretium magna neque, sit amet feugiat sapien hendrerit blandit. Sed ac metus vel mi porttitor eleifend eu lacinia enim. Aliquam erat volutpat.','2018-11-26 11:06:26','2018-11-26 11:06:26'),(6,1,4,'description','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lacinia, ipsum in accumsan mattis, sapien turpis ultrices nulla, eu fermentum mauris erat at tellus. Ut tempus laoreet erat. Ut vitae ex nec mi malesuada scelerisque. Nullam congue egestas vulputate. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum feugiat leo et eros sagittis porttitor. Proin sed interdum ante. Sed ipsum risus, posuere sit amet elementum sit amet, semper at libero. Donec feugiat arcu non turpis viverra, at porta arcu efficitur. Maecenas imperdiet varius mollis. Proin semper suscipit suscipit. Quisque pretium magna neque, sit amet feugiat sapien hendrerit blandit. Sed ac metus vel mi porttitor eleifend eu lacinia enim. Aliquam erat volutpat.','2018-11-26 11:06:26','2018-11-26 11:06:26');
/*!40000 ALTER TABLE `tags_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations_fields`
--

DROP TABLE IF EXISTS `translations_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `translation_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `translations_fields_translation_id_foreign` (`translation_id`),
  KEY `translations_fields_language_id_foreign` (`language_id`),
  CONSTRAINT `translations_fields_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  CONSTRAINT `translations_fields_translation_id_foreign` FOREIGN KEY (`translation_id`) REFERENCES `translations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations_fields`
--

LOCK TABLES `translations_fields` WRITE;
/*!40000 ALTER TABLE `translations_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `translations_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typologies`
--

DROP TABLE IF EXISTS `typologies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typologies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `has_categories` tinyint(1) DEFAULT NULL,
  `has_tags` tinyint(1) DEFAULT NULL,
  `has_slug` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `typologies_identifier_unique` (`identifier`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typologies`
--

LOCK TABLES `typologies` WRITE;
/*!40000 ALTER TABLE `typologies` DISABLE KEYS */;
INSERT INTO `typologies` VALUES (1,'Noticies','news','fa-newspaper-o','2018-11-26 09:15:34','2018-11-26 09:18:26',1,1,1);
/*!40000 ALTER TABLE `typologies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typologies_attributes`
--

DROP TABLE IF EXISTS `typologies_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typologies_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typology_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `typologies_attributes_typology_id_foreign` (`typology_id`),
  KEY `typologies_attributes_language_id_foreign` (`language_id`),
  CONSTRAINT `typologies_attributes_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`),
  CONSTRAINT `typologies_attributes_typology_id_foreign` FOREIGN KEY (`typology_id`) REFERENCES `typologies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typologies_attributes`
--

LOCK TABLES `typologies_attributes` WRITE;
/*!40000 ALTER TABLE `typologies_attributes` DISABLE KEYS */;
INSERT INTO `typologies_attributes` VALUES (5,1,4,'slug','blog','2018-11-26 09:18:28','2018-11-26 09:18:28'),(6,1,2,'slug','blog','2018-11-26 09:18:28','2018-11-26 09:18:28');
/*!40000 ALTER TABLE `typologies_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urls`
--

DROP TABLE IF EXISTS `urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `urls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_id` int(11) NOT NULL,
  `entity_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `urls_language_id_foreign` (`language_id`),
  CONSTRAINT `urls_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urls`
--

LOCK TABLES `urls` WRITE;
/*!40000 ALTER TABLE `urls` DISABLE KEYS */;
INSERT INTO `urls` VALUES (6,'/es/blog',1,'Modules\\Architect\\Entities\\Typology',2,'2018-11-26 09:18:28','2018-11-26 09:18:28'),(8,'/fr/blog',1,'Modules\\Architect\\Entities\\Typology',4,'2018-11-26 09:18:28','2018-11-26 09:18:28'),(15,'/es/home',1,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 09:23:17','2018-11-26 09:23:17'),(16,'/fr/home',1,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 09:23:17','2018-11-26 09:23:17'),(18,'/es/blog',2,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(20,'/fr/blog',2,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(46,'/es/blog/noticia-1',3,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(48,'/fr/blog/information-1',3,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(50,'/es/blog/noticia-2',4,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 10:00:48','2018-11-26 10:00:48'),(52,'/fr/blog/information-2',4,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 10:00:48','2018-11-26 10:00:48'),(54,'/es/blog/noticia-3',5,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(56,'/fr/blog/information-3',5,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(57,'/es/categoria-1',1,'Modules\\Architect\\Entities\\Category',2,'2018-11-26 11:01:46','2018-11-26 11:01:46'),(58,'/fr/categorie-1',1,'Modules\\Architect\\Entities\\Category',4,'2018-11-26 11:01:46','2018-11-26 11:01:46');
/*!40000 ALTER TABLE `urls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John','Admin','admin@bar.com','fr','$2y$10$ImNFawM05GvDL1ZLsLTsf.KdWlaJVs9GzAdxBGsA5GnBT3.9Zz2iC',NULL,NULL,NULL,'2018-11-23 16:00:48','2018-11-23 16:09:18',NULL),(2,'John','Author','author@bar.com','','$2y$10$GQT7t5pJsAzWhVRKKMw8AeBYpF9QFjDE03Zn4cC8LVhs3UOFAGRD2',NULL,NULL,NULL,'2018-11-23 16:00:48','2018-11-23 16:00:48',NULL),(3,'John','Editor','editor@bar.com','','$2y$10$1RtNCIKqD.brE6tMQDmRYOhvrkEhE2dDWuObTAc.k.4lr6blU./RK',NULL,NULL,NULL,'2018-11-23 16:00:49','2018-11-23 16:00:49',NULL);
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

-- Dump completed on 2018-11-26 12:08:39
