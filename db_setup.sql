-- MySQL dump 10.13  Distrib 5.1.41, for debian-linux-gnu (i486)
--
-- Host: localhost    Database: blog
-- ------------------------------------------------------
-- Server version	5.1.41-3ubuntu12.10

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
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articles` (
  `article_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(200) NOT NULL,
  `public` smallint(1) NOT NULL DEFAULT '0',
  `poster_id` bigint(10) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` VALUES (1,'A weekend of Skyrim',1,1),(2,'Test',1,1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `group_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(20) NOT NULL,
  `can_post_article` smallint(1) NOT NULL DEFAULT '0',
  `can_comment` smallint(1) NOT NULL DEFAULT '0',
  `auto_approve_comment` smallint(1) NOT NULL DEFAULT '0',
  `can_approve_comments` smallint(1) NOT NULL DEFAULT '0',
  `can_unapprove_comments` smallint(1) NOT NULL DEFAULT '0',
  `banned` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Admin',1,1,1,1,1,0),(2,'Moderator',1,1,1,1,1,0),(3,'Member',0,1,0,0,0,0),(4,'Trusted Member',0,1,1,0,0,0),(5,'Banned',0,0,0,0,0,1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `post_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `poster_id` bigint(10) NOT NULL,
  `article_id` bigint(10) NOT NULL,
  `approved` smallint(1) NOT NULL DEFAULT '0',
  `post` text NOT NULL,
  `posted_on` datetime NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,1,1,1,'Well, as many of you probably have figured out by this point in time, Skyrim has come out! Sadly, I have spent most of the weekend playing it, and probably clocked 30+ hours playing or watching others play the game. \r\n\r\nIn short, Skyrim is an amazing way to waste away time.\r\n\r\nNow, I do have some theories about how the game works. It appears to level enemies not as you level, but on a tiered system. From what I gather enemies get more difficult every time you reach a multiple of 10. For instance, I didn\'t see any Blood Dragons before I got to level 10, but since I have I haven\'t seen any normal dragons. Perhaps I am just unlucky when it comes to finding baddies, but Blood Dragons also seem to do a considerably higher amount of damage. Just something to keep in mind when you are playing.	','2011-11-14 00:00:00'),(2,1,2,1,'This is a nice little test\r\n\r\n\r\nasd	\r\n\r\n\r\nFroggy and the other things.','2011-11-16 00:00:00');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `session_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(10) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (9,1,'8413efd7bd59ef8114dbb6b6ec6241f7','2011-11-09'),(2,1,'080c04b87eb49a0d67acf02525583815','2011-11-04'),(3,1,'080c04b87eb49a0d67acf02525583815','2011-11-04'),(10,1,'db283c49c7314f0d74117d4768860522','2011-11-14'),(12,1,'b7e408f49240f27b7a7de6894a020bfd','2011-11-16');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `group_id` bigint(10) NOT NULL DEFAULT '0',
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `joined_on` date DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'James','c96dd568316deb9d8c7dec73b4c27cbb','james.blades@colorado.edu',NULL,NULL),(2,1,'Myusername','5f4dcc3b5aa765d61d8327deb882cf99','fake.email@gmail.com',NULL,NULL);
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

-- Dump completed on 2011-12-06  9:56:46
