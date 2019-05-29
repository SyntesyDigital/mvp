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
INSERT INTO `contents` VALUES (1,NULL,1,'1','2018-11-26 09:32:52','2018-11-26 09:21:45','2018-11-26 11:26:55',1,1,2,NULL,'{\"htmlClass\":null,\"pageType\":null}'),(2,NULL,1,'1','2018-11-26 09:32:45','2018-11-26 09:24:57','2018-11-26 09:32:45',1,3,4,NULL,'{\"htmlClass\":null,\"pageType\":null}'),(3,1,1,'1','2018-11-26 09:32:33','2018-11-26 09:30:05','2018-11-26 09:32:33',0,5,6,NULL,'{\"htmlClass\":null}'),(4,1,1,'1','2018-11-26 09:32:18','2018-11-26 09:31:14','2018-11-26 09:32:18',0,7,8,NULL,'{\"htmlClass\":null}'),(5,1,1,'1','2018-11-26 09:32:11','2018-11-26 09:32:04','2018-11-26 09:32:11',0,9,10,NULL,'{\"htmlClass\":null}');
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
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contents_fields`
--

LOCK TABLES `contents_fields` WRITE;
/*!40000 ALTER TABLE `contents_fields` DISABLE KEYS */;
INSERT INTO `contents_fields` VALUES (22,2,4,'title','Blog',NULL,NULL,'2018-11-26 09:24:57','2018-11-26 09:24:57'),(23,2,2,'title','Blog',NULL,NULL,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(24,2,4,'slug','blog',NULL,NULL,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(25,2,2,'slug','blog',NULL,NULL,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(120,3,4,'title','Information 1',NULL,NULL,'2018-11-26 10:00:22','2018-11-26 10:00:22'),(121,3,2,'title','Noticia 1',NULL,NULL,'2018-11-26 10:00:22','2018-11-26 10:00:22'),(122,3,4,'slug','information-1',NULL,NULL,'2018-11-26 10:00:22','2018-11-26 10:00:22'),(123,3,2,'slug','noticia-1',NULL,NULL,'2018-11-26 10:00:22','2018-11-26 10:00:22'),(126,3,NULL,'data','1542668400',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(127,3,NULL,'imatge','6','medias',NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(128,3,4,'descripcio','<p><span style=\"color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</span></p>',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(129,3,2,'descripcio','<p><span style=\"color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</span></p>',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(132,3,4,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(133,3,2,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(136,4,4,'title','Information 2',NULL,NULL,'2018-11-26 10:00:45','2018-11-26 10:00:45'),(137,4,2,'title','Noticia 2',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(138,4,4,'slug','information-2',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(139,4,2,'slug','noticia-2',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(142,4,NULL,'data','1542927600',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(143,4,NULL,'imatge','7','medias',NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(144,4,4,'descripcio','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p>',NULL,NULL,'2018-11-26 10:00:46','2018-11-26 10:00:46'),(145,4,2,'descripcio','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p>',NULL,NULL,'2018-11-26 10:00:47','2018-11-26 10:00:47'),(148,4,4,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:00:47','2018-11-26 10:00:47'),(149,4,2,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:00:47','2018-11-26 10:00:47'),(152,5,4,'title','Information 3',NULL,NULL,'2018-11-26 10:01:34','2018-11-26 10:01:34'),(153,5,2,'title','Noticia 3',NULL,NULL,'2018-11-26 10:01:34','2018-11-26 10:01:34'),(154,5,4,'slug','information-3',NULL,NULL,'2018-11-26 10:01:34','2018-11-26 10:01:34'),(155,5,2,'slug','noticia-3',NULL,NULL,'2018-11-26 10:01:34','2018-11-26 10:01:34'),(158,5,NULL,'data','1543273200',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(159,5,NULL,'imatge','8','medias',NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(160,5,4,'descripcio','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p>',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(161,5,2,'descripcio','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p>',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(164,5,4,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(165,5,2,'contingut','<p class=\"ql-align-justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dictum molestie mi nec condimentum. Fusce ut enim dignissim, scelerisque arcu sed, ornare felis. Suspendisse vestibulum turpis ac arcu rhoncus iaculis. Proin ultrices nisi non elit faucibus, quis auctor libero ultricies. Curabitur nec sagittis eros. Sed pellentesque neque elit, a gravida augue vehicula vitae. Vestibulum blandit risus eros, rhoncus rhoncus ex gravida ac. Vestibulum sit amet justo augue. Cras volutpat metus leo, non cursus ligula aliquet condimentum. Sed vitae magna hendrerit, facilisis turpis sed, bibendum enim. Quisque at eros vulputate, volutpat neque quis, accumsan neque. Donec euismod ullamcorper turpis, et maximus augue fermentum in. Mauris nisl dolor, tincidunt nec mattis at, egestas eget tortor.</p><p class=\"ql-align-justify\">Integer mattis efficitur congue. Donec malesuada enim a venenatis auctor. Pellentesque volutpat ex at nunc pharetra euismod. Phasellus vitae suscipit nisl, nec eleifend massa. Vivamus feugiat pharetra urna. Sed vel convallis justo. Suspendisse euismod arcu non placerat ullamcorper. Ut malesuada finibus turpis id placerat.</p><p class=\"ql-align-justify\">Ut finibus metus eget lacus tincidunt, sit amet pulvinar massa dictum. Vivamus aliquet dictum neque ac eleifend. Aliquam erat volutpat. Ut lorem sapien, consequat nec metus vitae, commodo sollicitudin quam. Curabitur sagittis ante sit amet ex bibendum, ut dictum ipsum vestibulum. Praesent ac magna in nibh hendrerit auctor. Sed venenatis sapien augue, ac consequat turpis fermentum at. Cras ac commodo ex, rutrum euismod mauris. In porttitor, odio at gravida hendrerit, magna tellus suscipit tellus, at imperdiet erat massa vitae enim. Sed condimentum faucibus tellus a hendrerit. Sed quis molestie neque. Quisque vitae eros et ex blandit congue. Morbi commodo, risus at ultricies vulputate, orci ante feugiat leo, ac fringilla diam dolor a mi. Maecenas in quam et lectus viverra ultricies.</p><p class=\"ql-align-justify\">In vulputate in nisi sit amet sodales. Morbi ac feugiat lectus. Sed in nunc nisi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras non felis vel sapien egestas cursus quis tempus orci. Duis in dictum turpis. Morbi at rutrum nibh. Ut pellentesque lobortis augue eu blandit. Etiam eget dolor porta sapien cursus rhoncus. Etiam condimentum justo sit amet justo mollis rhoncus porta at dui. Vivamus at turpis molestie nisi rhoncus fermentum iaculis varius tortor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean faucibus libero a faucibus convallis. Nunc ullamcorper erat dapibus, sodales sapien eget, placerat enim. Nulla faucibus ac eros eget tincidunt.</p><p class=\"ql-align-justify\">Maecenas fermentum massa at lectus auctor lobortis. Curabitur venenatis nisi neque, id egestas nisl euismod lobortis. Nam a nulla tellus. Nunc hendrerit diam a ante auctor, quis sagittis ligula tristique. Pellentesque ultricies, ipsum sed accumsan aliquam, magna ipsum lobortis enim, quis scelerisque urna mi non lectus. Vestibulum sed nibh non ante luctus rhoncus nec eu mi. Nam suscipit risus quam, ac eleifend eros tempus vel. Cras interdum dolor eros, at congue odio ornare nec. Nam tincidunt porttitor laoreet. Nullam eu rhoncus orci. Vivamus neque enim, ornare sit amet nibh tincidunt, maximus laoreet lorem. Morbi non libero ut magna porta accumsan. Maecenas porta risus purus, vitae commodo quam sodales id.</p>',NULL,NULL,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(168,1,4,'title','Home',NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(169,1,2,'title','Home',NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(170,1,4,'slug','home',NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(171,1,2,'slug','home',NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(172,1,NULL,'pagewidget_5bfbd880935b9_image','6','medias',NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(173,1,2,'pagewidget_5bfbd880935b9_title',NULL,NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(174,1,2,'pagewidget_5bfbd880935b9_subtitle',NULL,NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(175,1,NULL,'pagewidget_5bfbd880935b9_url','',NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(176,1,NULL,'pagewidget_5bfbd880c9750_image','7','medias',NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(177,1,2,'pagewidget_5bfbd880c9750_title',NULL,NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(178,1,2,'pagewidget_5bfbd880c9750_subtitle',NULL,NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56'),(179,1,NULL,'pagewidget_5bfbd880c9750_url','',NULL,NULL,'2018-11-26 11:26:56','2018-11-26 11:26:56');
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
INSERT INTO `contents_languages` VALUES (2,4),(2,2),(3,4),(3,2),(4,4),(4,2),(5,4),(5,2),(1,4),(1,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (4,2,'[{\"type\":\"row\",\"settings\":{\"htmlId\":null,\"htmlClass\":null,\"hasContainer\":null},\"children\":[{\"type\":\"col\",\"settings\":{\"htmlId\":null,\"htmlClass\":null},\"colClass\":\"col-xs-12\",\"children\":[{\"type\":\"item\",\"field\":{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Text\",\"rules\":{\"required\":null,\"unique\":null,\"maxCharacters\":null,\"minCharacters\":null},\"label\":\"Texte\",\"name\":\"Texte\",\"type\":\"text\",\"icon\":\"fa-font\",\"settings\":{\"entryTitle\":null,\"htmlId\":null,\"htmlClass\":null},\"fieldname\":\"pagefield_5bfbbbea6b46d\"}},{\"type\":\"item\",\"field\":{\"class\":\"Modules\\\\Architect\\\\Widgets\\\\Types\\\\Blog\",\"rules\":{\"required\":null},\"label\":\"BLOG\",\"name\":\"architect::widgets.BLOG\",\"type\":\"widget\",\"icon\":\"fa-file-o\",\"settings\":{\"htmlId\":null,\"htmlClass\":null,\"itemsPerPage\":null},\"component\":\"CommonWidget\",\"widget\":null,\"hidden\":false,\"defaultSettings\":null,\"identifier\":\"temp_[0,0,1]\",\"fieldname\":\"pagewidget_5bfbbbea761c1\"}}]}]}]','2018-11-26 09:24:58','2018-11-26 09:24:58'),(5,1,'[{\"type\":\"row\",\"settings\":{\"htmlId\":null,\"htmlClass\":null,\"hasContainer\":null},\"children\":[{\"type\":\"col\",\"settings\":{\"htmlId\":null,\"htmlClass\":null},\"colClass\":\"col-xs-12\",\"children\":[{\"type\":\"item\",\"field\":{\"class\":\"Modules\\\\Architect\\\\Widgets\\\\Types\\\\BannerCarousel\",\"rules\":{\"required\":null},\"label\":\"BANNER_CAROUSEL\",\"name\":\"Carrousel Banners\",\"type\":\"widget-list\",\"icon\":\"fa-th-list\",\"settings\":{\"htmlId\":null,\"htmlClass\":null,\"cropsAllowed\":null},\"fields\":null,\"component\":null,\"widget\":\"BANNER_SLIDE\",\"hidden\":false,\"defaultSettings\":null,\"value\":[{\"class\":\"Modules\\\\Architect\\\\Widgets\\\\Types\\\\BannerSlide\",\"rules\":[\"required\"],\"label\":\"BANNER_SLIDE\",\"name\":\"Slide Banner\",\"type\":\"widget\",\"icon\":\"fa-picture-o\",\"settings\":[\"htmlId\",\"htmlClass\",\"cropsAllowed\"],\"fields\":[{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Image\",\"identifier\":\"image\",\"type\":\"image\",\"name\":\"Image\"},{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Text\",\"identifier\":\"title\",\"type\":\"text\",\"name\":\"Titre\"},{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Text\",\"identifier\":\"subtitle\",\"type\":\"text\",\"name\":\"Sous-titre\"},{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Url\",\"identifier\":\"url\",\"type\":\"url\",\"name\":\"URL\"}],\"component\":\"CommonWidget\",\"widget\":null,\"hidden\":true,\"defaultSettings\":null,\"index\":0,\"id\":0,\"value\":null,\"fieldname\":\"pagewidget_5bfbd880935b9\"},{\"class\":\"Modules\\\\Architect\\\\Widgets\\\\Types\\\\BannerSlide\",\"rules\":[\"required\"],\"label\":\"BANNER_SLIDE\",\"name\":\"Slide Banner\",\"type\":\"widget\",\"icon\":\"fa-picture-o\",\"settings\":[\"htmlId\",\"htmlClass\",\"cropsAllowed\"],\"fields\":[{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Image\",\"identifier\":\"image\",\"type\":\"image\",\"name\":\"Image\"},{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Text\",\"identifier\":\"title\",\"type\":\"text\",\"name\":\"Titre\"},{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Text\",\"identifier\":\"subtitle\",\"type\":\"text\",\"name\":\"Sous-titre\"},{\"class\":\"Modules\\\\Architect\\\\Fields\\\\Types\\\\Url\",\"identifier\":\"url\",\"type\":\"url\",\"name\":\"URL\"}],\"component\":\"CommonWidget\",\"widget\":null,\"hidden\":true,\"defaultSettings\":null,\"index\":1,\"id\":1,\"value\":null,\"fieldname\":\"pagewidget_5bfbd880c9750\"}],\"identifier\":\"temp_[0,0,0]\"}}]}]}]','2018-11-26 11:26:57','2018-11-26 11:26:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (7,'GENERAL_WIDGET_SELECT_CATEGORY',43,'2018-09-26 15:00:05','2018-09-28 15:38:51'),(8,'GENERAL_WIDGET_TO',46,'2018-09-26 15:11:16','2018-09-28 15:38:51'),(9,'WIDGET_BLOG_TEXT_TO_SEARCH',81,'2018-09-26 15:13:11','2018-09-28 15:38:53'),(10,'GENERAL_BUTTON_SEARCH',8,'2018-09-26 15:20:35','2018-09-28 15:38:49'),(11,'GENERAL_WIDGET_FROM',36,'2018-09-26 15:21:38','2018-09-28 15:38:51'),(12,'FOOTER_TITLE_1',6,'2018-09-27 09:14:40','2018-09-28 15:38:49'),(13,'FOOTER_TITLE_2',7,'2018-09-27 09:15:19','2018-09-28 15:38:49'),(14,'CONTACT_FORM_TITLE',5,'2018-09-27 09:43:07','2018-09-28 15:38:49'),(15,'CONTACT_FORM_THANKS',4,'2018-09-27 09:47:54','2018-09-28 15:38:49'),(16,'GENERAL_READ_MORE',34,'2018-09-27 11:03:53','2018-09-28 15:38:51'),(17,'CONTACT_FORM_SUBTITLE',2,'2018-09-27 13:30:34','2018-09-28 15:38:49'),(18,'CONTACT_FORM_SUBTITLE2',3,'2018-09-27 13:31:45','2018-09-28 15:38:49'),(19,'GENERAL_FORM_NAME',24,'2018-09-27 13:33:14','2018-09-28 15:38:50'),(20,'GENERAL_FORM_SURNAME',32,'2018-09-27 13:34:30','2018-09-28 15:38:50'),(21,'GENERAL_FORM_MAIL',23,'2018-09-27 13:34:49','2018-09-28 15:38:50'),(22,'GENERAL_FORM_NATIONALITY',25,'2018-09-27 13:35:17','2018-09-28 15:38:50'),(23,'GENERAL_FORM_ENTERPRISE',13,'2018-09-27 13:35:33','2018-09-28 15:38:50'),(24,'GENERAL_FORM_ENTERPRISE_TYPE',14,'2018-09-27 13:49:00','2018-09-28 15:38:50'),(25,'GENERAL_FORM_OTHERS',26,'2018-09-27 13:49:25','2018-09-28 15:38:50'),(26,'CONTACT_FORM_SUBTEXT',1,'2018-09-27 13:51:56','2018-09-28 15:39:46'),(27,'GENERAL_FORM_COMMENT_TITLE',12,'2018-09-27 13:52:17','2018-09-28 15:38:50'),(29,'GENERAL_FORM_CHECKBOX_NEWS',9,'2018-09-27 13:53:09','2018-09-28 15:38:49'),(30,'GENERAL_FORM_ERROR',15,'2018-09-27 13:54:07','2018-09-28 15:38:50'),(31,'GENERAL_FORM_SEND',30,'2018-09-27 13:54:49','2018-09-28 15:38:50'),(32,'PRESS_FORM_TITLE',67,'2018-09-27 14:17:13','2018-09-28 15:38:52'),(33,'PRESS_FORM_SUBTITLE',62,'2018-09-27 14:17:37','2018-09-28 15:38:52'),(34,'PRESS_FORM_SUBTITLE2',63,'2018-09-27 14:17:54','2018-09-28 15:38:52'),(35,'PRESS_FORM_SUBTITLE3',64,'2018-09-27 14:18:13','2018-09-28 15:38:52'),(36,'PRESS_FORM_MEDIA_TYPE',57,'2018-09-27 14:18:36','2018-09-28 15:38:52'),(37,'PRESS_FORM_OPTION_PRESS',59,'2018-09-27 14:19:54','2018-09-28 15:38:52'),(38,'PRESS_FORM_OPTION_ONLINE_PRESS',58,'2018-09-27 14:20:12','2018-09-28 15:38:52'),(39,'PRESS_FORM_OPTION_TRAVEL_BLOGGER',60,'2018-09-27 14:20:34','2018-09-28 15:38:52'),(40,'PRESS_FORM_OPTION_TRAVEL_GUIDE',61,'2018-09-27 14:20:57','2018-09-28 15:38:52'),(41,'PRESS_FORM_MEDIA_NAME',56,'2018-09-27 14:21:54','2018-09-28 15:38:52'),(42,'PRESS_FORM_DISTRIBUTION',54,'2018-09-27 14:22:30','2018-09-28 15:38:52'),(43,'GENERAL_FORM_SPAIN',31,'2018-09-27 14:23:21','2018-09-28 15:38:50'),(45,'PRESS_FORM_WEB',68,'2018-09-27 14:25:29','2018-09-28 15:38:52'),(46,'PRESS_FORM_EMAIL',55,'2018-09-27 14:28:00','2018-09-28 15:38:52'),(47,'PRESS_FORM_SUBTITLE4',65,'2018-09-27 14:33:23','2018-09-28 15:38:52'),(48,'PRESS_FORM_SUBTITLE5',66,'2018-09-27 14:33:43','2018-09-28 15:38:52'),(49,'GENERAL_FORM_GENDER',16,'2018-09-27 14:38:54','2018-09-28 15:38:50'),(50,'GENERAL_FORM_GENDER_MASCULINE',19,'2018-09-27 14:39:13','2018-09-28 15:50:57'),(51,'GENERAL_FORM_GENDER_FEMENINE',18,'2018-09-27 14:39:45','2018-09-28 15:51:07'),(52,'GENERAL_FORM_POSITION',27,'2018-09-27 14:40:13','2018-09-28 15:38:50'),(53,'GENERAL_FORM_WEB_TWITTER',33,'2018-09-27 14:41:33','2018-09-28 15:38:50'),(54,'GENERAL_FORM_PREF_LANG',28,'2018-09-27 14:43:27','2018-09-28 15:38:50'),(56,'GENERAL_FORM_CHECKBOX_RGPD',11,'2018-09-27 14:47:52','2018-09-28 15:38:49'),(57,'NEWSLETTER_FORM_TITLE',53,'2018-09-28 09:12:15','2018-09-28 15:38:52'),(58,'GENERAL_FORM_LANG_CAT',17,'2018-09-28 09:20:30','2018-09-28 15:51:07'),(59,'GENERAL_FORM_LANG_SPA',22,'2018-09-28 09:20:50','2018-09-28 15:38:50'),(60,'GENERAL_FORM_LANG_ENG',20,'2018-09-28 09:21:16','2018-09-28 15:38:50'),(61,'GENERAL_FORM_LANG_FRENCH',21,'2018-09-28 09:21:36','2018-09-28 15:38:50'),(62,'GENERAL_FORM_REPEAT_MAIL',29,'2018-09-28 09:23:33','2018-09-28 15:38:50'),(63,'NEWSLETTER_FORM_SUBTITLE',51,'2018-09-28 09:24:39','2018-09-28 15:38:51'),(64,'NEWSLETTER_FORM_SUBTITLE2',52,'2018-09-28 09:25:11','2018-09-28 15:38:52'),(65,'GENERAL_FORM_CHECKBOX_PDF',10,'2018-09-28 10:05:20','2018-09-28 15:38:49'),(66,'SELECTED_LIST_FORM_SUBTITLE',75,'2018-09-28 10:07:26','2018-09-28 15:38:53'),(67,'SELECTED_LIST_FORM_TITLE',79,'2018-09-28 10:14:47','2018-09-28 15:38:53'),(68,'SELECTED_LIST_FORM_SUBTITLE2',76,'2018-09-28 10:16:08','2018-09-28 15:38:53'),(69,'SELECTED_LIST_FORM_SUBTITLE3',77,'2018-09-28 10:19:54','2018-09-28 15:38:53'),(70,'SELECTED_LIST_FORM_SUBTITLE4',78,'2018-09-28 10:20:16','2018-09-28 15:38:53'),(71,'GENERAL_WIDGET_SELECT_INDICADOR',44,'2018-09-28 11:05:32','2018-09-28 15:38:51'),(72,'GENERAL_WIDGET_DOWNLOAD_PDF',35,'2018-09-28 11:05:59','2018-09-28 15:38:51'),(73,'GENERAL_WIDGET_SELECT',42,'2018-09-28 11:06:18','2018-09-28 15:38:51'),(74,'GENERAL_WIDGET_REMOVE',40,'2018-09-28 11:07:12','2018-09-28 15:38:51'),(75,'GENERAL_WIDGET_SEE_INDEX',41,'2018-09-28 11:19:06','2018-09-28 15:38:51'),(76,'GENERAL_WIDGET_LAST_TYPOLOGY_EMPTY',37,'2018-09-28 11:20:14','2018-09-28 15:38:51'),(77,'GENERAL_WIDGET_RELATED_NEWS',39,'2018-09-28 11:25:21','2018-09-28 15:38:51'),(78,'GENERAL_WIDGET_SELECTED_VOID',45,'2018-09-28 11:27:17','2018-09-28 15:38:51'),(79,'GENERAL_WIDGET_OPEN_FORM',38,'2018-09-28 11:28:03','2018-09-28 15:38:51'),(80,'WIDGET_BAR_CONSULTA_SELECT_YEAR',80,'2018-09-28 11:38:47','2018-09-28 15:38:53'),(81,'PUBLICATION_WIDGET_TIPUS',74,'2018-09-28 13:41:28','2018-09-28 15:38:53'),(82,'PUBLICATION_WIDGET_NUM_PAGES',72,'2018-09-28 13:41:58','2018-09-28 15:38:53'),(83,'PUBLICATION_WIDGET_FORMAT',69,'2018-09-28 13:42:13','2018-09-28 15:38:52'),(84,'PUBLICATION_WIDGET_LANGUAGES',70,'2018-09-28 13:42:29','2018-09-28 15:38:53'),(85,'PUBLICATION_WIDGET_LAST_EDITION',71,'2018-09-28 13:43:53','2018-09-28 15:38:53'),(86,'PUBLICATION_WIDGET_PRICE',73,'2018-09-28 13:44:08','2018-09-28 15:38:53'),(87,'HEMEROTECA_WIDGET_FORMAT',48,'2018-09-28 14:02:32','2018-09-28 15:38:51'),(88,'HEMEROTECA_WIDGET_LANGUAGES',49,'2018-09-28 14:02:49','2018-09-28 15:38:51'),(89,'HEMEROTECA_WIDGET_NOM',50,'2018-09-28 14:03:52','2018-09-28 15:38:51'),(90,'HEMEROTECA_WIDGET_AUTOR',47,'2018-09-28 14:04:07','2018-09-28 15:38:51'),(91,'GENERAL_FORM_SIZE',82,'2018-10-04 11:02:08','2018-10-04 11:02:08'),(92,'GENERAL_FORM_RESOLUTION',83,'2018-10-04 11:03:03','2018-10-04 11:03:03'),(93,'EMAIL_SELECTION_SUBJECT',84,'2018-10-04 11:07:24','2018-10-04 11:07:24'),(94,'GENERAL_WIDGET_SELECTED_TITLE',85,'2018-10-05 09:46:26','2018-10-05 09:46:26'),(95,'SEARCH_WIDGET_RESULT_TEXT',86,'2018-10-19 16:20:12','2018-10-19 16:20:12');
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
) ENGINE=InnoDB AUTO_INCREMENT=376 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations_fields`
--

LOCK TABLES `translations_fields` WRITE;
/*!40000 ALTER TABLE `translations_fields` DISABLE KEYS */;
INSERT INTO `translations_fields` VALUES (31,9,1,'WIDGET_BLOG_TEXT_TO_SEARCH','Introdueix text a cercar'),(32,9,2,'WIDGET_BLOG_TEXT_TO_SEARCH','Introduce texto a Buscar'),(33,9,3,'WIDGET_BLOG_TEXT_TO_SEARCH','Type text to search'),(34,10,1,'GENERAL_BUTTON_SEARCH','Cercar'),(35,10,2,'GENERAL_BUTTON_SEARCH','Buscar'),(36,10,3,'GENERAL_BUTTON_SEARCH','Search'),(43,12,1,'FOOTER_TITLE_1','Programes professionals'),(44,12,2,'FOOTER_TITLE_1','Programas profesionales'),(45,12,3,'FOOTER_TITLE_1','Professional Programs'),(46,13,1,'FOOTER_TITLE_2','Enllaços'),(47,13,2,'FOOTER_TITLE_2','Enlaces'),(48,13,3,'FOOTER_TITLE_2','Links'),(49,14,1,'CONTACT_FORM_TITLE','Formulari de Contacte'),(50,14,2,'CONTACT_FORM_TITLE','Formulario de Contacto'),(51,14,3,'CONTACT_FORM_TITLE','Contact Form'),(52,15,1,'CONTACT_FORM_THANKS','Gracies per contactar amb el Programa %s de Front de Barcelona'),(53,15,2,'CONTACT_FORM_THANKS','Gracias por contactar con el Programa %s de Front de Barcelona'),(54,15,3,'CONTACT_FORM_THANKS','Thanks to contact with the %s Program of Front de Barcelona'),(58,16,1,'GENERAL_READ_MORE','CARREGA MÉS'),(59,16,2,'GENERAL_READ_MORE','CARGA MÁS'),(60,16,3,'GENERAL_READ_MORE','LOAD MORE'),(67,18,1,'CONTACT_FORM_SUBTITLE2','Por favor, rellena el siguiente formulario:'),(68,18,2,'CONTACT_FORM_SUBTITLE2','Por favor, rellena el siguiente formulario:'),(69,18,3,'CONTACT_FORM_SUBTITLE2','Por favor, rellena el siguiente formulario:'),(70,19,1,'GENERAL_FORM_NAME','Nom'),(71,19,2,'GENERAL_FORM_NAME','Nombre'),(72,19,3,'GENERAL_FORM_NAME','Name'),(73,20,1,'GENERAL_FORM_SURNAME','Cognom'),(74,20,2,'GENERAL_FORM_SURNAME','Apellido'),(75,20,3,'GENERAL_FORM_SURNAME','Surname'),(76,21,1,'GENERAL_FORM_MAIL','E-mail'),(77,21,2,'GENERAL_FORM_MAIL','E-mail'),(78,21,3,'GENERAL_FORM_MAIL','E-mail'),(82,23,1,'GENERAL_FORM_ENTERPRISE','Empresa'),(83,23,2,'GENERAL_FORM_ENTERPRISE','Empresa'),(84,23,3,'GENERAL_FORM_ENTERPRISE','Enterprise'),(85,22,1,'GENERAL_FORM_NATIONALITY','Nacionalitat'),(86,22,2,'GENERAL_FORM_NATIONALITY','Nacionalidad'),(87,22,3,'GENERAL_FORM_NATIONALITY','Nationality'),(91,24,1,'GENERAL_FORM_ENTERPRISE_TYPE','Tipus d\'empresa'),(92,24,2,'GENERAL_FORM_ENTERPRISE_TYPE','Tipo de empresa'),(93,24,3,'GENERAL_FORM_ENTERPRISE_TYPE','Company Type'),(94,25,1,'GENERAL_FORM_OTHERS','Altres'),(95,25,2,'GENERAL_FORM_OTHERS','Otros'),(96,25,3,'GENERAL_FORM_OTHERS','Others'),(97,26,1,'CONTACT_FORM_SUBTEXT','Selecciona si te interesa otro sector de lo que Front de Barcelona trabaja:'),(98,26,2,'CONTACT_FORM_SUBTEXT','Selecciona si te interesa otro sector de lo que Front de Barcelona trabaja:'),(99,26,3,'CONTACT_FORM_SUBTEXT','Selecciona si te interesa otro sector de lo que Front de Barcelona trabaja:'),(112,31,1,'GENERAL_FORM_SEND','Enviar'),(113,31,2,'GENERAL_FORM_SEND','Enviar'),(114,31,3,'GENERAL_FORM_SEND','Send'),(115,32,1,'PRESS_FORM_TITLE','Formulario Prensa'),(116,32,2,'PRESS_FORM_TITLE','Formulario Prensa'),(117,32,3,'PRESS_FORM_TITLE','Formulario Prensa'),(121,34,1,'PRESS_FORM_SUBTITLE2','Por favor, rellena el siguiente formulario:'),(122,34,2,'PRESS_FORM_SUBTITLE2','Por favor, rellena el siguiente formulario:'),(123,34,3,'PRESS_FORM_SUBTITLE2','Por favor, rellena el siguiente formulario:'),(124,35,1,'PRESS_FORM_SUBTITLE3','DATOS DEL MEDIO'),(125,35,2,'PRESS_FORM_SUBTITLE3','DATOS DEL MEDIO'),(126,35,3,'PRESS_FORM_SUBTITLE3','DATOS DEL MEDIO'),(127,36,1,'PRESS_FORM_MEDIA_TYPE','Tipo de medio'),(128,36,2,'PRESS_FORM_MEDIA_TYPE','Tipo de medio'),(129,36,3,'PRESS_FORM_MEDIA_TYPE','Tipo de medio'),(130,37,1,'PRESS_FORM_OPTION_PRESS','Premsa'),(131,37,2,'PRESS_FORM_OPTION_PRESS','Prensa'),(132,37,3,'PRESS_FORM_OPTION_PRESS','Press'),(133,38,1,'PRESS_FORM_OPTION_ONLINE_PRESS','Prensa online'),(134,38,2,'PRESS_FORM_OPTION_ONLINE_PRESS','Prensa online'),(135,38,3,'PRESS_FORM_OPTION_ONLINE_PRESS','Prensa online'),(136,39,1,'PRESS_FORM_OPTION_TRAVEL_BLOGGER','Travel Blogger'),(137,39,2,'PRESS_FORM_OPTION_TRAVEL_BLOGGER','Travel Blogger'),(138,39,3,'PRESS_FORM_OPTION_TRAVEL_BLOGGER','Travel Blogger'),(139,40,1,'PRESS_FORM_OPTION_TRAVEL_GUIDE','Travel Guide'),(140,40,2,'PRESS_FORM_OPTION_TRAVEL_GUIDE','Travel Guide'),(141,40,3,'PRESS_FORM_OPTION_TRAVEL_GUIDE','Travel Guide'),(142,41,1,'PRESS_FORM_MEDIA_NAME','Nombre del Medio'),(143,41,2,'PRESS_FORM_MEDIA_NAME','Nombre del Medio'),(144,41,3,'PRESS_FORM_MEDIA_NAME','Nombre del Medio'),(145,42,1,'PRESS_FORM_DISTRIBUTION','Distribución'),(146,42,2,'PRESS_FORM_DISTRIBUTION','Distribución'),(147,42,3,'PRESS_FORM_DISTRIBUTION','Distribución'),(148,43,1,'GENERAL_FORM_SPAIN','Espanya'),(149,43,2,'GENERAL_FORM_SPAIN','España'),(150,43,3,'GENERAL_FORM_SPAIN','Spain'),(157,45,1,'PRESS_FORM_WEB','Web / Twitter del Medio'),(158,45,2,'PRESS_FORM_WEB','Web / Twitter del Medio'),(159,45,3,'PRESS_FORM_WEB','Web / Twitter del Medio'),(160,46,1,'PRESS_FORM_EMAIL','Email del medio'),(161,46,2,'PRESS_FORM_EMAIL','Email del medio'),(162,46,3,'PRESS_FORM_EMAIL','Email del medio'),(163,47,1,'PRESS_FORM_SUBTITLE4','Temática o título del artículo:'),(164,47,2,'PRESS_FORM_SUBTITLE4','Temática o título del artículo:'),(165,47,3,'PRESS_FORM_SUBTITLE4','Temática o título del artículo:'),(166,48,1,'PRESS_FORM_SUBTITLE5','JOURNALIST DATA'),(167,48,2,'PRESS_FORM_SUBTITLE5','JOURNALIST DATA'),(168,48,3,'PRESS_FORM_SUBTITLE5','JOURNALIST DATA'),(169,49,1,'GENERAL_FORM_GENDER','Génere'),(170,49,2,'GENERAL_FORM_GENDER','Género'),(171,49,3,'GENERAL_FORM_GENDER','Gender'),(172,50,1,'GENERAL_FORM_GENDER_MASCULINE','Masculí'),(173,50,2,'GENERAL_FORM_GENDER_MASCULINE','Masculino'),(174,50,3,'GENERAL_FORM_GENDER_MASCULINE','Masculine'),(175,51,1,'GENERAL_FORM_GENDER_FEMENINE','Femení'),(176,51,2,'GENERAL_FORM_GENDER_FEMENINE','Femenino'),(177,51,3,'GENERAL_FORM_GENDER_FEMENINE','Female'),(178,52,1,'GENERAL_FORM_POSITION','Cargo / posición'),(179,52,2,'GENERAL_FORM_POSITION','Cargo / posición'),(180,52,3,'GENERAL_FORM_POSITION','Cargo / posición'),(181,53,1,'GENERAL_FORM_WEB_TWITTER','Web / Twitter'),(182,53,2,'GENERAL_FORM_WEB_TWITTER','Web / Twitter'),(183,53,3,'GENERAL_FORM_WEB_TWITTER','Web / Twitter'),(184,54,1,'GENERAL_FORM_PREF_LANG','Preferencia idioma'),(185,54,2,'GENERAL_FORM_PREF_LANG','Preferencia idioma'),(186,54,3,'GENERAL_FORM_PREF_LANG','Preferencia idioma'),(208,30,1,'GENERAL_FORM_ERROR','El envio no ha sido completado. Por favor comprueva los campos en rojo.'),(209,30,2,'GENERAL_FORM_ERROR','El envio no ha sido completado. Por favor comprueva los campos en rojo.'),(210,30,3,'GENERAL_FORM_ERROR','El envio no ha sido completado. Por favor comprueva los campos en rojo.'),(211,57,1,'NEWSLETTER_FORM_TITLE','Suscripción Newsletter'),(212,57,2,'NEWSLETTER_FORM_TITLE','Suscripción Newsletter'),(213,57,3,'NEWSLETTER_FORM_TITLE','Suscripción Newsletter'),(214,58,1,'GENERAL_FORM_LANG_CAT','Català'),(215,58,2,'GENERAL_FORM_LANG_CAT','Catalán'),(216,58,3,'GENERAL_FORM_LANG_CAT','Catalan'),(217,59,1,'GENERAL_FORM_LANG_SPA','Castellà'),(218,59,2,'GENERAL_FORM_LANG_SPA','Castellano'),(219,59,3,'GENERAL_FORM_LANG_SPA','Spanish'),(220,60,1,'GENERAL_FORM_LANG_ENG','Anglès'),(221,60,2,'GENERAL_FORM_LANG_ENG','Inglés'),(222,60,3,'GENERAL_FORM_LANG_ENG','English'),(223,61,1,'GENERAL_FORM_LANG_FRENCH','Francès'),(224,61,2,'GENERAL_FORM_LANG_FRENCH','Francés'),(225,61,3,'GENERAL_FORM_LANG_FRENCH','French'),(226,62,1,'GENERAL_FORM_REPEAT_MAIL','Repetir E-mail'),(227,62,2,'GENERAL_FORM_REPEAT_MAIL','Repetir E-mail'),(228,62,3,'GENERAL_FORM_REPEAT_MAIL','Repeat E-mail'),(229,63,1,'NEWSLETTER_FORM_SUBTITLE','Si deseas recibir el Newsletter Profesional de Front de Barcelona rellena el siguiente formulario:'),(230,63,2,'NEWSLETTER_FORM_SUBTITLE','Si deseas recibir el Newsletter Profesional de Front de Barcelona rellena  el siguiente formulario:'),(231,63,3,'NEWSLETTER_FORM_SUBTITLE','Si deseas recibir el Newsletter Profesional de Front de Barcelona rellena  el siguiente formulario:'),(232,64,1,'NEWSLETTER_FORM_SUBTITLE2','Sector de interés:'),(233,64,2,'NEWSLETTER_FORM_SUBTITLE2','Sector de interés:'),(234,64,3,'NEWSLETTER_FORM_SUBTITLE2','Sector de interés:'),(235,27,1,'GENERAL_FORM_COMMENT_TITLE','Si deseas dejar un comentario:'),(236,27,2,'GENERAL_FORM_COMMENT_TITLE','Si deseas dejar un comentario:'),(237,27,3,'GENERAL_FORM_COMMENT_TITLE','Si deseas dejar un comentario:'),(238,56,1,'GENERAL_FORM_CHECKBOX_RGPD','He leído y acepto la política de privacidad (RGPD).'),(239,56,2,'GENERAL_FORM_CHECKBOX_RGPD','He leído y acepto la política de privacidad (RGPD).'),(240,56,3,'GENERAL_FORM_CHECKBOX_RGPD','He leído y acepto la política de privacidad (RGPD).'),(247,65,1,'GENERAL_FORM_CHECKBOX_PDF','Aceptación de las <a href=\"\">Condiciones de uso (PDF)</a>'),(248,65,2,'GENERAL_FORM_CHECKBOX_PDF','Aceptación de las <a href=\"\">Condiciones de uso (PDF)</a>'),(249,65,3,'GENERAL_FORM_CHECKBOX_PDF','Aceptación de las <a href=\"\">Condiciones de uso (PDF)</a>'),(250,66,1,'SELECTED_LIST_FORM_SUBTITLE','Gracias por contactar con el <b>departamento de Promoción</b> de Front de Barcelona'),(251,66,2,'SELECTED_LIST_FORM_SUBTITLE','Gracias por contactar con el <b>departamento de Promoción</b> de Front de Barcelona'),(252,66,3,'SELECTED_LIST_FORM_SUBTITLE','Gracias por contactar con el <b>departamento de Promoción</b> de Front de Barcelona'),(253,17,1,'CONTACT_FORM_SUBTITLE','Gracies per contactar amb el <b>departament de Promoció</b> de Front de Barcelona'),(254,17,2,'CONTACT_FORM_SUBTITLE','Gracias por contactar con el <b>departamento de Promoción</b>  de Front de Barcelona'),(255,17,3,'CONTACT_FORM_SUBTITLE','Gracias por contactar con el <b>departamento de Promoción</b>  de Front de Barcelona'),(256,33,1,'PRESS_FORM_SUBTITLE','Gracias por contactar con <b>Prensa</b> de Front de Barcelona<b>'),(257,33,2,'PRESS_FORM_SUBTITLE','Gracias por contactar con <b>Prensa</b> de Front de Barcelona'),(258,33,3,'PRESS_FORM_SUBTITLE','Gracias por contactar con <b>Prensa</b> de Front de Barcelona'),(259,67,1,'SELECTED_LIST_FORM_TITLE','Formulario de Contacto'),(260,67,2,'SELECTED_LIST_FORM_TITLE','Formulario de Contacto'),(261,67,3,'SELECTED_LIST_FORM_TITLE','Formulario de Contacto'),(262,68,1,'SELECTED_LIST_FORM_SUBTITLE2','Por favor, rellena el siguiente formulario:'),(263,68,2,'SELECTED_LIST_FORM_SUBTITLE2','Por favor, rellena el siguiente formulario:'),(264,68,3,'SELECTED_LIST_FORM_SUBTITLE2','Por favor, rellena el siguiente formulario:'),(265,69,1,'SELECTED_LIST_FORM_SUBTITLE3','Petición: Resumen de MI SELECCIÓN'),(266,69,2,'SELECTED_LIST_FORM_SUBTITLE3','Petición: Resumen de MI SELECCIÓN'),(267,69,3,'SELECTED_LIST_FORM_SUBTITLE3','Petición: Resumen de MI SELECCIÓN'),(271,70,1,'SELECTED_LIST_FORM_SUBTITLE4','Si deseas dejar un comentario:'),(272,70,2,'SELECTED_LIST_FORM_SUBTITLE4','Si deseas dejar un comentario:'),(273,70,3,'SELECTED_LIST_FORM_SUBTITLE4','Si deseas dejar un comentario:'),(274,7,1,'GENERAL_WIDGET_SELECT_CATEGORY','Selecciona categoria'),(275,7,2,'GENERAL_WIDGET_SELECT_CATEGORY','Selecciona categoria'),(276,7,3,'GENERAL_WIDGET_SELECT_CATEGORY','Select Category'),(277,11,1,'GENERAL_WIDGET_FROM','De'),(278,11,2,'GENERAL_WIDGET_FROM','De'),(279,11,3,'GENERAL_WIDGET_FROM','From'),(283,8,1,'GENERAL_WIDGET_TO','Fins'),(284,8,2,'GENERAL_WIDGET_TO','Hasta'),(285,8,3,'GENERAL_WIDGET_TO','To'),(286,71,1,'GENERAL_WIDGET_SELECT_INDICADOR','Selecciona indicador'),(287,71,2,'GENERAL_WIDGET_SELECT_INDICADOR','Selecciona indicador'),(288,71,3,'GENERAL_WIDGET_SELECT_INDICADOR','Select indicator'),(289,72,1,'GENERAL_WIDGET_DOWNLOAD_PDF','Descarregar PDF'),(290,72,2,'GENERAL_WIDGET_DOWNLOAD_PDF','Descargar PDF'),(291,72,3,'GENERAL_WIDGET_DOWNLOAD_PDF','Download PDF'),(292,73,1,'GENERAL_WIDGET_SELECT','Seleccionar'),(293,73,2,'GENERAL_WIDGET_SELECT','Seleccionar'),(294,73,3,'GENERAL_WIDGET_SELECT','select'),(295,74,1,'GENERAL_WIDGET_REMOVE','Esborrar'),(296,74,2,'GENERAL_WIDGET_REMOVE','Borrar'),(297,74,3,'GENERAL_WIDGET_REMOVE','Remove'),(301,75,1,'GENERAL_WIDGET_SEE_INDEX','Veure index'),(302,75,2,'GENERAL_WIDGET_SEE_INDEX','Ver índice'),(303,75,3,'GENERAL_WIDGET_SEE_INDEX','See index'),(304,76,1,'GENERAL_WIDGET_LAST_TYPOLOGY_EMPTY','No s\'ha triobat cap contingut'),(305,76,2,'GENERAL_WIDGET_LAST_TYPOLOGY_EMPTY','No se ha encontrado ningú contenido'),(306,76,3,'GENERAL_WIDGET_LAST_TYPOLOGY_EMPTY','No content has been found'),(307,77,1,'GENERAL_WIDGET_RELATED_NEWS','Noticies relacionades'),(308,77,2,'GENERAL_WIDGET_RELATED_NEWS','Noticias relacionadas'),(309,77,3,'GENERAL_WIDGET_RELATED_NEWS','Related news'),(310,78,1,'GENERAL_WIDGET_SELECTED_VOID','Buit'),(311,78,2,'GENERAL_WIDGET_SELECTED_VOID','Vacio'),(312,78,3,'GENERAL_WIDGET_SELECTED_VOID','Empty'),(313,79,1,'GENERAL_WIDGET_OPEN_FORM','Obrir form'),(314,79,2,'GENERAL_WIDGET_OPEN_FORM','Abrir form'),(315,79,3,'GENERAL_WIDGET_OPEN_FORM','Open form'),(316,80,1,'WIDGET_BAR_CONSULTA_SELECT_YEAR','Selecciona any de consulta'),(317,80,2,'WIDGET_BAR_CONSULTA_SELECT_YEAR','Selecciona año de consulta :'),(318,80,3,'WIDGET_BAR_CONSULTA_SELECT_YEAR','Select year:'),(319,81,1,'PUBLICATION_WIDGET_TIPUS','Tipus'),(320,81,2,'PUBLICATION_WIDGET_TIPUS','Tipo'),(321,81,3,'PUBLICATION_WIDGET_TIPUS','Type'),(322,82,1,'PUBLICATION_WIDGET_NUM_PAGES','Num pàgines'),(323,82,2,'PUBLICATION_WIDGET_NUM_PAGES','Num páginas'),(324,82,3,'PUBLICATION_WIDGET_NUM_PAGES','num pages'),(325,83,1,'PUBLICATION_WIDGET_FORMAT','Format'),(326,83,2,'PUBLICATION_WIDGET_FORMAT','Format'),(327,83,3,'PUBLICATION_WIDGET_FORMAT','Format'),(328,84,1,'PUBLICATION_WIDGET_LANGUAGES','Idiomes'),(329,84,2,'PUBLICATION_WIDGET_LANGUAGES','idiomas'),(330,84,3,'PUBLICATION_WIDGET_LANGUAGES','Languages'),(331,85,1,'PUBLICATION_WIDGET_LAST_EDITION','Última edició'),(332,85,2,'PUBLICATION_WIDGET_LAST_EDITION','Ultima edición'),(333,85,3,'PUBLICATION_WIDGET_LAST_EDITION','Last edition'),(334,86,1,'PUBLICATION_WIDGET_PRICE','Preu'),(335,86,2,'PUBLICATION_WIDGET_PRICE','Precio'),(336,86,3,'PUBLICATION_WIDGET_PRICE','Price'),(337,87,1,'HEMEROTECA_WIDGET_FORMAT','Format'),(338,87,2,'HEMEROTECA_WIDGET_FORMAT','Format'),(339,87,3,'HEMEROTECA_WIDGET_FORMAT','Format'),(340,88,1,'HEMEROTECA_WIDGET_LANGUAGES','Idiomes'),(341,88,2,'HEMEROTECA_WIDGET_LANGUAGES','idiomas'),(342,88,3,'HEMEROTECA_WIDGET_LANGUAGES','Languages'),(343,89,1,'HEMEROTECA_WIDGET_NOM','Nom publicació'),(344,89,2,'HEMEROTECA_WIDGET_NOM','Nombre publicación'),(345,89,3,'HEMEROTECA_WIDGET_NOM','Publication name'),(346,90,1,'HEMEROTECA_WIDGET_AUTOR','Autor'),(347,90,2,'HEMEROTECA_WIDGET_AUTOR','Autor'),(348,90,3,'HEMEROTECA_WIDGET_AUTOR','Autor'),(349,91,1,'GENERAL_FORM_SIZE','Mides'),(350,91,2,'GENERAL_FORM_SIZE','Medidas'),(351,91,3,'GENERAL_FORM_SIZE','Size'),(352,92,1,'GENERAL_FORM_RESOLUTION','Resolució'),(353,92,2,'GENERAL_FORM_RESOLUTION','Resolución'),(354,92,3,'GENERAL_FORM_RESOLUTION','Resolution'),(364,93,1,'EMAIL_SELECTION_SUBJECT','La meva selecció'),(365,93,2,'EMAIL_SELECTION_SUBJECT','Mi selección'),(366,93,3,'EMAIL_SELECTION_SUBJECT','My selection'),(367,94,1,'GENERAL_WIDGET_SELECTED_TITLE','La meva selecció'),(368,94,2,'GENERAL_WIDGET_SELECTED_TITLE','Mi selección'),(369,94,3,'GENERAL_WIDGET_SELECTED_TITLE','My selection'),(370,29,1,'GENERAL_FORM_CHECKBOX_NEWS','Quiero recibir más información de Front de Barcelona (Newsletter Profesional)'),(371,29,2,'GENERAL_FORM_CHECKBOX_NEWS','Quiero recibir más información de Front de Barcelona (Newsletter Profesional)'),(372,29,3,'GENERAL_FORM_CHECKBOX_NEWS','Quiero recibir más información de Front de Barcelona (Newsletter Profesional)'),(373,95,1,'SEARCH_WIDGET_RESULT_TEXT','S\'han trobat <strong>XX</strong> resultatats coincidents amb el terme de búsqueda'),(374,95,2,'SEARCH_WIDGET_RESULT_TEXT','Se han encontrado <strong>XX</strong> resultados coincidentes con el término de búsqueda'),(375,95,3,'SEARCH_WIDGET_RESULT_TEXT','<strong>XX</strong> results found for');
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urls`
--

LOCK TABLES `urls` WRITE;
/*!40000 ALTER TABLE `urls` DISABLE KEYS */;
INSERT INTO `urls` VALUES (6,'/es/blog',1,'Modules\\Architect\\Entities\\Typology',2,'2018-11-26 09:18:28','2018-11-26 09:18:28'),(8,'/fr/blog',1,'Modules\\Architect\\Entities\\Typology',4,'2018-11-26 09:18:28','2018-11-26 09:18:28'),(18,'/es/blog',2,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(20,'/fr/blog',2,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 09:24:58','2018-11-26 09:24:58'),(46,'/es/blog/noticia-1',3,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(48,'/fr/blog/information-1',3,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 10:00:23','2018-11-26 10:00:23'),(50,'/es/blog/noticia-2',4,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 10:00:48','2018-11-26 10:00:48'),(52,'/fr/blog/information-2',4,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 10:00:48','2018-11-26 10:00:48'),(54,'/es/blog/noticia-3',5,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(56,'/fr/blog/information-3',5,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 10:01:35','2018-11-26 10:01:35'),(57,'/es/categoria-1',1,'Modules\\Architect\\Entities\\Category',2,'2018-11-26 11:01:46','2018-11-26 11:01:46'),(58,'/fr/categorie-1',1,'Modules\\Architect\\Entities\\Category',4,'2018-11-26 11:01:46','2018-11-26 11:01:46'),(59,'/es/home',1,'Modules\\Architect\\Entities\\Content',2,'2018-11-26 11:26:57','2018-11-26 11:26:57'),(60,'/fr/home',1,'Modules\\Architect\\Entities\\Content',4,'2018-11-26 11:26:57','2018-11-26 11:26:57');
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

-- Dump completed on 2018-11-26 16:48:23
