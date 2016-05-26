-- MySQL dump 10.13  Distrib 5.6.26, for Win32 (x86)
--
-- Host: localhost    Database: vidlib
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS genre;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE genre (
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES genre WRITE;
/*!40000 ALTER TABLE genre DISABLE KEYS */;
INSERT INTO genre VALUES ('comedy'),('drama'),('horror'),('romance');
/*!40000 ALTER TABLE genre ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tg`
--

DROP TABLE IF EXISTS tg;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE tg (
  videoID bigint(20) unsigned NOT NULL,
  genre char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tg`
--

LOCK TABLES tg WRITE;
/*!40000 ALTER TABLE tg DISABLE KEYS */;
INSERT INTO tg VALUES (22,'Comedy'),(21,'drama'),(15,'horror'),(15,'romance'),(21,'romance');
/*!40000 ALTER TABLE tg ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tu`
--

DROP TABLE IF EXISTS tu;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE tu (
  id bigint(20) unsigned NOT NULL DEFAULT '0',
  username varchar(30) NOT NULL,
  firstName varchar(20) NOT NULL,
  lastName varchar(40) NOT NULL,
  email varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  sex enum('undisclosed','other','female','male') NOT NULL DEFAULT 'undisclosed',
  age tinyint(3) unsigned NOT NULL,
  inactivityEmails tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tu`
--

LOCK TABLES tu WRITE;
/*!40000 ALTER TABLE tu DISABLE KEYS */;
INSERT INTO tu VALUES (2,'samwise','sam','wise','sam@boop.com','*1A11AE440F0BFE14CF065EA776CEFA20B3BCF946','undisclosed',18,1),(13,'samfool','sam','wise','sammie@boop.me','*363DEFBA9260F526CC56DEE2DF67578A9B8387A5','female',17,0),(15,'bil','bil','me','om@be.com','*37C13770147290475841673451E04663DFE9B6A4','other',16,0),(16,'bill','tom','jerry','bbt@hobbit.net','*363DEFBA9260F526CC56DEE2DF67578A9B8387A5','other',21,0);
/*!40000 ALTER TABLE tu ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tv`
--

DROP TABLE IF EXISTS tv;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE tv (
  id bigint(20) unsigned NOT NULL DEFAULT '0',
  title varchar(50) NOT NULL,
  rating enum('G','PG','14A','18A','A','E') NOT NULL,
  yearOfRelease smallint(5) unsigned DEFAULT NULL,
  runtime tinyint(3) unsigned DEFAULT NULL,
  theatreReleaseDate smallint(5) unsigned DEFAULT NULL,
  DVDReleaseDate smallint(5) unsigned DEFAULT NULL,
  actors varchar(300) DEFAULT NULL,
  studio varchar(50) DEFAULT NULL,
  plotSummary varchar(500) NOT NULL,
  hasDVD tinyint(1) NOT NULL DEFAULT '0',
  hasBluRay tinyint(1) NOT NULL DEFAULT '0',
  hasSD tinyint(1) NOT NULL DEFAULT '0',
  hasHD tinyint(1) NOT NULL DEFAULT '0',
  userid bigint(20) unsigned NOT NULL,
  coverArtFileExt char(5) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tv`
--

LOCK TABLES tv WRITE;
/*!40000 ALTER TABLE tv DISABLE KEYS */;
INSERT INTO tv VALUES (117,'82PGxPG','PG',12,4,2323,2323,'4',',o','c',1,0,0,0,16,'jpg'),(120,'85PGharry pottertest15PG','PG',2001,255,2000,2000,'Ben Ratcliff, Emma watson','somewhere in London','nothing special happens in this movie',1,0,1,0,2,''),(126,'91PGHarry Potter and the philosopher\'s stonetest21','PG',2000,170,2000,2004,'Ben Ratcliff, Emma Wattson','','It\'s a cute little story about some wizards and their wands.',1,0,0,1,2,''),(127,'9214AOceans 11test2214A','14A',2004,120,2005,2008,'Jonny depth, Tim Allen','','',1,0,0,0,2,''),(130,'95PGttest25PG','PG',4002,120,2004,2004,'Tim Allen','x','',0,0,0,0,2,''),(132,'97PGetest27PG','PG',12,120,2004,2004,'Tim Allen',' u','',1,0,0,0,2,''),(134,'99Gutest29G','G',0,90,0,0,'U','ux','',0,0,0,0,2,''),(135,'100GShrekG','G',2002,100,2003,2005,'Mike Myers','some animation place','basically makes fun of all fairy tales ever',1,0,1,0,16,'png'),(136,'101GShrek 2G','G',2005,110,1008,1008,'mike Myers, a donkey','same studio as the last one','New plot, old story',1,0,1,0,16,''),(137,'102G3G','G',2005,115,2005,2008,'same as before','where it\'s always been','This time, the Ogar marries the princess',1,0,1,0,16,''),(139,'104EHarry Potter the 0thtest34E','E',2007,90,1212,1212,'Everybody! <3','England somewhere','Harry Potter and his friends start attending some school out in the middle of nowhere. stuff happens. Nobody quite dies, although there\'s times when you\'re lead to think someone might die. A bunch of stuff revolves around a really old stone. that\'s hidden inside a mirror. At the end of the movie, everybody goes back to where they came from.\r\n',1,1,0,0,2,'');
/*!40000 ALTER TABLE tv ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS user;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  username varchar(30) NOT NULL,
  firstName varchar(20) NOT NULL,
  lastName varchar(40) NOT NULL,
  email varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  sex enum('undisclosed','other','female','male') NOT NULL DEFAULT 'undisclosed',
  age tinyint(3) unsigned NOT NULL,
  inactivityEmails tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY id (id),
  UNIQUE KEY username (username),
  UNIQUE KEY username_2 (username)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES user WRITE;
/*!40000 ALTER TABLE user DISABLE KEYS */;
INSERT INTO user VALUES (2,'samwise','Testify','McTestington\"','sam@boop.com','*1A11AE440F0BFE14CF065EA776CEFA20B3BCF946','undisclosed',25,0),(13,'samfool','sam','wise','sammie@boop.me','*363DEFBA9260F526CC56DEE2DF67578A9B8387A5','female',17,0),(15,'bil','bil','me','om@be.com','*37C13770147290475841673451E04663DFE9B6A4','other',16,0),(16,'bill','tom','jerry','bbt@hobbit.net','*363DEFBA9260F526CC56DEE2DF67578A9B8387A5','other',21,0);
/*!40000 ALTER TABLE user ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS video;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE video (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(50) NOT NULL,
  rating enum('G','PG','14A','18A','A','E') NOT NULL,
  yearOfRelease smallint(5) unsigned DEFAULT NULL,
  runtime tinyint(3) unsigned DEFAULT NULL,
  theatreReleaseDate char(10) NOT NULL,
  DVDReleaseDate char(10) NOT NULL,
  actors varchar(300) DEFAULT NULL,
  studio varchar(50) DEFAULT NULL,
  plotSummary varchar(500) NOT NULL,
  hasDVD tinyint(1) NOT NULL DEFAULT '0',
  hasBluRay tinyint(1) NOT NULL DEFAULT '0',
  hasSD tinyint(1) NOT NULL DEFAULT '0',
  hasHD tinyint(1) NOT NULL DEFAULT '0',
  userid bigint(20) unsigned NOT NULL,
  coverArtFileExt char(5) NOT NULL DEFAULT '',
  PRIMARY KEY (id),
  UNIQUE KEY id (id),
  UNIQUE KEY userid_2 (userid,title),
  KEY userid (userid),
  CONSTRAINT video_ibfk_1 FOREIGN KEY (userid) REFERENCES `user` (id) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES video WRITE;
/*!40000 ALTER TABLE video DISABLE KEYS */;
INSERT INTO video VALUES (12,'shrek 0th','PG',12,4,'1999-12-12','2001-01-01','4',',o','',0,0,0,0,16,'jpg'),(15,'harry pottertest15','PG',2001,255,'0000-00-00','0000-00-00','Ben Ratcliff, Emma watson','somewhere in London','nothing special happens in this movie',1,0,1,0,2,''),(21,'Harry Potter and the philosopher\'s stonetest21','PG',2000,170,'0000-00-00','0000-00-00','Ben Ratcliff, Emma Wattson','','It\'s a cute little story about some wizards and their wands.',1,0,0,1,2,''),(22,'Oceans 11test22','14A',2004,120,'0000-00-00','0000-00-00','Jonny depth, Tim Allen','','',1,0,0,0,2,''),(25,'Nightmare of a COIS Marker!','18A',2015,255,'18-11-2015','31-12-2099','You, and you alone','if only you had one','Just when you think you\'re done, your rambuncious children crash into your computer, ruining it all, and destroying your work.',1,1,1,1,2,''),(27,'Lord of the Files','PG',12,120,'0000-00-00','0000-00-00','Tim Allen',' u','',0,0,0,0,2,''),(29,'Harry Potter and the Prisoner of Azkaban','PG',2003,140,'23-04-2004','17-05-2005','Ben Ratcliff, Emma Wattson, a very confused you.','the whole of Great Britain. By commission of the g','Um... something to do with eating souls, and a dude with a crazy eye? or the dude with the crazy eye was maybe the 4th book.... yeah, that was it.',1,1,0,1,2,'png'),(30,'Shrek','G',2002,100,'0000-00-00','0000-00-00','Mike Myers','some animation place','basically makes fun of all fairy tales ever',1,0,1,0,16,'png'),(31,'Shrek 2','G',2005,110,'0000-00-00','0000-00-00','mike Myers, a donkey','same studio as the last one','New plot, old story',1,0,1,0,16,''),(32,'3','G',2005,115,'0000-00-00','0000-00-00','same as before','where it\'s always been','This time, the Ogar marries the princess',1,0,1,0,16,''),(34,'Harry Potter the 0thtest34','E',2007,90,'0000-00-00','0000-00-00','Everybody! <3','England somewhere','Harry Potter and his friends start attending some school out in the middle of nowhere. stuff happens. Nobody quite dies, although there\'s times when you\'re lead to think someone might die. A bunch of stuff revolves around a really old stone. that\'s hidden inside a mirror. At the end of the movie, everybody goes back to where they came from.\r\n',1,1,0,0,2,''),(47,'xPG','PG',12,4,'0000-00-00','0000-00-00','4',',o','c',1,0,0,0,16,'jpg'),(50,'harry pottertest15PG','PG',2001,255,'0000-00-00','0000-00-00','Ben Ratcliff, Emma watson','somewhere in London','nothing special happens in this movie',1,0,1,0,2,''),(56,'Harry Potter and the philosopher\'s stonetest21PG','PG',2000,170,'0000-00-00','0000-00-00','Ben Ratcliff, Emma Wattson','','It\'s a cute little story about some wizards and their wands.',1,0,0,1,2,''),(57,'Oceans 11test2214A','14A',2004,120,'0000-00-00','0000-00-00','Jonny depth, Tim Allen','','',1,0,0,0,2,''),(62,'Ester, the princess jew of the apocrypha','18A',12,120,'0000-00-00','0000-00-00','Tim Allen',' u','',0,0,0,0,2,''),(65,'ShrekG','G',2002,100,'0000-00-00','0000-00-00','Mike Myers','some animation place','basically makes fun of all fairy tales ever',1,0,1,0,16,'png'),(66,'Shrek 2G','G',2005,110,'0000-00-00','0000-00-00','mike Myers, a donkey','same studio as the last one','New plot, old story',1,0,1,0,16,''),(67,'3G','G',2005,115,'0000-00-00','0000-00-00','same as before','where it\'s always been','This time, the Ogar marries the princess',1,0,1,0,16,''),(69,'Harry Potter the 0thtest34E','E',2007,90,'0000-00-00','0000-00-00','Everybody! <3','England somewhere','Harry Potter and his friends start attending some school out in the middle of nowhere. stuff happens. Nobody quite dies, although there\'s times when you\'re lead to think someone might die. A bunch of stuff revolves around a really old stone. that\'s hidden inside a mirror. At the end of the movie, everybody goes back to where they came from.\r\n',1,1,0,0,2,''),(82,'PGxPG','PG',12,4,'0000-00-00','0000-00-00','4',',o','c',1,0,0,0,16,'jpg'),(85,'PGharry pottertest15PG','PG',2001,255,'0000-00-00','0000-00-00','Ben Ratcliff, Emma watson','somewhere in London','nothing special happens in this movie',1,0,1,0,2,''),(91,'PGHarry Potter and the philosopher\'s stonetest21PG','PG',2000,170,'0000-00-00','0000-00-00','Ben Ratcliff, Emma Wattson','','It\'s a cute little story about some wizards and their wands.',1,0,0,1,2,''),(92,'Oceans 11 II','14A',2004,120,'0000-00-00','0000-00-00','Jonny depth, Tim Allen','','',0,0,0,0,2,''),(95,'PGttest25PG','PG',4002,120,'0000-00-00','0000-00-00','Tim Allen','x','',0,0,0,0,2,''),(97,'PGetest27PG','PG',12,120,'0000-00-00','0000-00-00','Tim Allen',' u','',1,0,0,0,2,''),(99,'Worst.makeout.Movie.EVER! (part II)','G',0,90,'0000-00-00','0000-00-00','U','ux','',0,0,0,0,2,''),(100,'GShrekG','G',2002,100,'0000-00-00','0000-00-00','Mike Myers','some animation place','basically makes fun of all fairy tales ever',1,0,1,0,16,'png'),(101,'GShrek 2G','G',2005,110,'0000-00-00','0000-00-00','mike Myers, a donkey','same studio as the last one','New plot, old story',1,0,1,0,16,''),(102,'G3G','G',2005,115,'0000-00-00','0000-00-00','same as before','where it\'s always been','This time, the Ogar marries the princess',1,0,1,0,16,''),(104,'EHarry Potter the 0thtest34E','E',2007,90,'0000-00-00','0000-00-00','Everybody! <3','England somewhere','Harry Potter and his friends start attending some school out in the middle of nowhere. stuff happens. Nobody quite dies, although there\'s times when you\'re lead to think someone might die. A bunch of stuff revolves around a really old stone. that\'s hidden inside a mirror. At the end of the movie, everybody goes back to where they came from.\r\n',1,1,0,0,2,''),(117,'82PGxPG','PG',12,4,'0000-00-00','0000-00-00','4',',o','c',1,0,0,0,16,'jpg'),(120,'harry potter III','PG',2001,255,'0000-00-00','0000-00-00','Ben Ratcliff, Emma watson','somewhere in London','',0,0,0,0,2,''),(126,'Harry Potter and the philosopher\'s stonetest2','PG',2000,170,'0000-00-00','0000-00-00','Ben Ratcliff, Emma Wattson','','',0,0,0,0,2,''),(127,'Oceans 12','14A',2004,120,'0000-00-00','0000-00-00','Jonny depth, Tim Allen','','',0,0,0,0,2,''),(130,'Lord of the Things','PG',4002,120,'0000-00-00','0000-00-00','Tim Allen','x','',0,0,0,0,2,''),(132,'everybody wants to be a cat','PG',12,120,'0000-00-00','0000-00-00','Tim Allen',' u','',0,0,0,0,2,''),(134,'99Gutest29G','G',0,90,'0000-00-00','0000-00-00','U','ux','',0,0,0,0,2,''),(135,'100GShrekG','G',2002,100,'0000-00-00','0000-00-00','Mike Myers','some animation place','basically makes fun of all fairy tales ever',1,0,1,0,16,'png'),(136,'101GShrek 2G','G',2005,110,'0000-00-00','0000-00-00','mike Myers, a donkey','same studio as the last one','New plot, old story',1,0,1,0,16,''),(137,'102G3G','G',2005,115,'0000-00-00','0000-00-00','same as before','where it\'s always been','This time, the Ogar marries the princess',1,0,1,0,16,''),(139,'Harry Potter II','E',2007,90,'0000-00-00','0000-00-00','Everybody! <3','England somewhere','',0,0,0,0,2,''),(140,'Wam bamb, thank you jam!','G',2015,8,'20-11-2015','25-12-2015','Me, you, and this dear-sweet jar of honey','','',0,0,0,0,2,'');
/*!40000 ALTER TABLE video ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_genre`
--

DROP TABLE IF EXISTS video_genre;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE video_genre (
  videoID bigint(20) unsigned NOT NULL,
  genre char(15) NOT NULL,
  UNIQUE KEY videoID (videoID,genre),
  KEY genre (genre),
  CONSTRAINT video_genre_ibfk_1 FOREIGN KEY (videoID) REFERENCES video (id) ON DELETE CASCADE,
  CONSTRAINT video_genre_ibfk_2 FOREIGN KEY (genre) REFERENCES genre (`name`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_genre`
--

LOCK TABLES video_genre WRITE;
/*!40000 ALTER TABLE video_genre DISABLE KEYS */;
INSERT INTO video_genre VALUES (22,'Comedy'),(30,'Comedy'),(31,'Comedy'),(140,'comedy'),(21,'drama'),(25,'drama'),(29,'drama'),(15,'horror'),(25,'horror'),(15,'romance'),(21,'romance'),(29,'romance'),(34,'Romance');
/*!40000 ALTER TABLE video_genre ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'vidlib'
--

--
-- Dumping routines for database 'vidlib'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-18 23:55:33

