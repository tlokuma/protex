-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: protexbanco
-- ------------------------------------------------------
-- Server version	5.7.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contaspagar`
--

DROP TABLE IF EXISTS `contaspagar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contaspagar` (
  `lancamento` int(11) NOT NULL,
  `grupo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subgrupo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vencimento` int(11) NOT NULL,
  `historico` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `historicolongo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` float NOT NULL,
  `idpagar` int(11) NOT NULL AUTO_INCREMENT,
  `credor` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`idpagar`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contaspagar`
--

LOCK TABLES `contaspagar` WRITE;
/*!40000 ALTER TABLE `contaspagar` DISABLE KEYS */;
INSERT INTO `contaspagar` VALUES (1650855600,'Despesas Fixas','Diarista',1649214000,'Diarista Sala 1','Despesa com diarista da sala 1',130,1,'Diarista',1),(1650855600,'Diversos','Despesas',1649214000,'Gasto com papelaria','Compra de canetas',30.08,3,'Papelaria',0),(1650855600,'Diversos','Despesas',1650596400,'Material de Limpeza','',197.56,4,'Fornecedor de Material de Limpeza',1);
/*!40000 ALTER TABLE `contaspagar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contasreceber`
--

DROP TABLE IF EXISTS `contasreceber`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contasreceber` (
  `lancamento` int(11) NOT NULL,
  `grupo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subgrupo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vencimento` int(11) NOT NULL,
  `historico` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `historicolongo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` float NOT NULL,
  `valorparcela` float NOT NULL,
  `idreceber` int(11) NOT NULL AUTO_INCREMENT,
  `numparcelas` int(11) NOT NULL,
  `cliente` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`idreceber`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contasreceber`
--

LOCK TABLES `contasreceber` WRITE;
/*!40000 ALTER TABLE `contasreceber` DISABLE KEYS */;
INSERT INTO `contasreceber` VALUES (1650855600,'Cliente','Cliente Recorrente',1650078000,'Compra de PrÃ³teses','Compra de 4 prÃ³teses dentÃ¡rias',10000,3333.33,2,3,'Clinica Odonto Excellence Centro',0),(1650855600,'Cliente','Cliente Novo',1651114800,'Compra de PrÃ³teses','',5000,5000,3,1,'Clinica Josi e Silmara',1),(1650855600,'Diversos','Luz',1649289600,'teste','teste',123,123,6,1,'teste2',0);
/*!40000 ALTER TABLE `contasreceber` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contasreceberparcelas`
--

DROP TABLE IF EXISTS `contasreceberparcelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contasreceberparcelas` (
  `idcontasreceberparcelas` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(45) NOT NULL,
  `valorparcela` float NOT NULL,
  `vencimentoparcela` int(11) NOT NULL,
  `historico` varchar(45) NOT NULL,
  `numeroparcela` int(11) NOT NULL,
  `idreceber` int(11) NOT NULL,
  `statusparcela` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idcontasreceberparcelas`)
) ENGINE=MyISAM AUTO_INCREMENT=379 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contasreceberparcelas`
--

LOCK TABLES `contasreceberparcelas` WRITE;
/*!40000 ALTER TABLE `contasreceberparcelas` DISABLE KEYS */;
INSERT INTO `contasreceberparcelas` VALUES (1,'Clinica Odonto Excellence Centro',3333.34,1650078000,'Compra de PrÃ³teses',1,1,0),(2,'Clinica Odonto Excellence Centro',3333.33,1651374000,'Compra de PrÃ³teses',2,1,0),(3,'Clinica Odonto Excellence Centro',3333.33,1654052400,'Compra de PrÃ³teses',3,1,0),(4,'Clinica Odonto Excellence Centro',3333.34,1650078000,'Compra de PrÃ³teses',1,2,1),(5,'Clinica Odonto Excellence Centro',3333.33,1651374000,'Compra de PrÃ³teses',2,2,1),(6,'Clinica Odonto Excellence Centro',3333.33,1654052400,'Compra de PrÃ³teses',3,2,0),(7,'Clinica Josi e Silmara',5000,1651114800,'Compra de PrÃ³teses',1,3,1),(8,'Error et tempor adipisicing dolorem impedit ',-78.9,142657200,'Dolore dolorem porro',1,4,0),(9,'Error et tempor adipisicing dolorem impedit ',5.6,144558000,'Dolore dolorem porro',2,4,0),(10,'Error et tempor adipisicing dolorem impedit ',5.6,147236400,'Dolore dolorem porro',3,4,0),(11,'Error et tempor adipisicing dolorem impedit ',5.6,149828400,'Dolore dolorem porro',4,4,0),(12,'Error et tempor adipisicing dolorem impedit ',5.6,152506800,'Dolore dolorem porro',5,4,0),(13,'Qui ullam voluptatem Qui sit explicab',14.2,429332400,'Et eos nihil commodi',1,4,0),(14,'Qui ullam voluptatem Qui sit explicab',14.2,431233200,'Et eos nihil commodi',2,4,0),(15,'Qui ullam voluptatem Qui sit explicab',14.2,433825200,'Et eos nihil commodi',3,4,0),(16,'Qui ullam voluptatem Qui sit explicab',14.2,436503600,'Et eos nihil commodi',4,4,0),(17,'Qui ullam voluptatem Qui sit explicab',14.2,439095600,'Et eos nihil commodi',5,4,0),(18,'Reiciendis perspiciatis ea',0.95,648010800,'Ipsum alias omnis e',1,4,0),(19,'Reiciendis perspiciatis ea',0.95,649479600,'Ipsum alias omnis e',2,4,0),(20,'Reiciendis perspiciatis ea',0.95,652158000,'Ipsum alias omnis e',3,4,0),(21,'Reiciendis perspiciatis ea',0.95,654750000,'Ipsum alias omnis e',4,4,0),(22,'Reiciendis perspiciatis ea',0.95,657424800,'Ipsum alias omnis e',5,4,0),(23,'Reiciendis perspiciatis ea',0.95,660016800,'Ipsum alias omnis e',6,4,0),(24,'Reiciendis perspiciatis ea',0.95,662695200,'Ipsum alias omnis e',7,4,0),(25,'Reiciendis perspiciatis ea',0.95,665373600,'Ipsum alias omnis e',8,4,0),(26,'Reiciendis perspiciatis ea',0.95,667796400,'Ipsum alias omnis e',9,4,0),(27,'Reiciendis perspiciatis ea',0.95,670474800,'Ipsum alias omnis e',10,4,0),(28,'Reiciendis perspiciatis ea',0.95,673066800,'Ipsum alias omnis e',11,4,0),(29,'Reiciendis perspiciatis ea',0.95,675745200,'Ipsum alias omnis e',12,4,0),(30,'Reiciendis perspiciatis ea',0.95,678337200,'Ipsum alias omnis e',13,4,0),(31,'Reiciendis perspiciatis ea',0.95,681015600,'Ipsum alias omnis e',14,4,0),(32,'Reiciendis perspiciatis ea',0.95,683694000,'Ipsum alias omnis e',15,4,0),(33,'Reiciendis perspiciatis ea',0.95,686286000,'Ipsum alias omnis e',16,4,0),(34,'Reiciendis perspiciatis ea',0.95,688960800,'Ipsum alias omnis e',17,4,0),(35,'Reiciendis perspiciatis ea',0.95,691552800,'Ipsum alias omnis e',18,4,0),(36,'Reiciendis perspiciatis ea',0.95,694231200,'Ipsum alias omnis e',19,4,0),(37,'Reiciendis perspiciatis ea',0.95,696909600,'Ipsum alias omnis e',20,4,0),(38,'Reiciendis perspiciatis ea',0.95,699418800,'Ipsum alias omnis e',21,4,0),(39,'Reiciendis perspiciatis ea',0.95,702097200,'Ipsum alias omnis e',22,4,0),(40,'Reiciendis perspiciatis ea',0.95,704689200,'Ipsum alias omnis e',23,4,0),(41,'Reiciendis perspiciatis ea',0.95,707367600,'Ipsum alias omnis e',24,4,0),(42,'Reiciendis perspiciatis ea',0.95,709959600,'Ipsum alias omnis e',25,4,0),(43,'Reiciendis perspiciatis ea',0.95,712638000,'Ipsum alias omnis e',26,4,0),(44,'Reiciendis perspiciatis ea',0.95,715316400,'Ipsum alias omnis e',27,4,0),(45,'Reiciendis perspiciatis ea',0.95,717908400,'Ipsum alias omnis e',28,4,0),(46,'Reiciendis perspiciatis ea',0.95,720583200,'Ipsum alias omnis e',29,4,0),(47,'Reiciendis perspiciatis ea',0.95,723175200,'Ipsum alias omnis e',30,4,0),(48,'Reiciendis perspiciatis ea',0.95,725853600,'Ipsum alias omnis e',31,4,0),(49,'Reiciendis perspiciatis ea',0.95,728535600,'Ipsum alias omnis e',32,4,0),(50,'Reiciendis perspiciatis ea',0.95,730954800,'Ipsum alias omnis e',33,4,0),(51,'Reiciendis perspiciatis ea',0.95,733633200,'Ipsum alias omnis e',34,4,0),(52,'Reiciendis perspiciatis ea',0.95,736225200,'Ipsum alias omnis e',35,4,0),(53,'Reiciendis perspiciatis ea',0.95,738903600,'Ipsum alias omnis e',36,4,0),(54,'Reiciendis perspiciatis ea',0.95,741495600,'Ipsum alias omnis e',37,4,0),(55,'Reiciendis perspiciatis ea',0.95,744174000,'Ipsum alias omnis e',38,4,0),(56,'Reiciendis perspiciatis ea',0.95,746852400,'Ipsum alias omnis e',39,4,0),(57,'Reiciendis perspiciatis ea',0.95,749444400,'Ipsum alias omnis e',40,4,0),(58,'Reiciendis perspiciatis ea',0.95,752119200,'Ipsum alias omnis e',41,4,0),(59,'Reiciendis perspiciatis ea',0.95,754711200,'Ipsum alias omnis e',42,4,0),(60,'Reiciendis perspiciatis ea',0.95,757389600,'Ipsum alias omnis e',43,4,0),(61,'Reiciendis perspiciatis ea',0.95,760068000,'Ipsum alias omnis e',44,4,0),(62,'Reiciendis perspiciatis ea',0.95,762490800,'Ipsum alias omnis e',45,4,0),(63,'Reiciendis perspiciatis ea',0.95,765169200,'Ipsum alias omnis e',46,4,0),(64,'Reiciendis perspiciatis ea',0.95,767761200,'Ipsum alias omnis e',47,4,0),(65,'Reiciendis perspiciatis ea',0.95,770439600,'Ipsum alias omnis e',48,4,0),(66,'Reiciendis perspiciatis ea',0.95,773031600,'Ipsum alias omnis e',49,4,0),(67,'Reiciendis perspiciatis ea',0.95,775710000,'Ipsum alias omnis e',50,4,0),(68,'Reiciendis perspiciatis ea',0.95,778388400,'Ipsum alias omnis e',51,4,0),(69,'Reiciendis perspiciatis ea',0.95,780980400,'Ipsum alias omnis e',52,4,0),(70,'Reiciendis perspiciatis ea',0.95,783655200,'Ipsum alias omnis e',53,4,0),(71,'Reiciendis perspiciatis ea',0.95,786247200,'Ipsum alias omnis e',54,4,0),(72,'Reiciendis perspiciatis ea',0.95,788925600,'Ipsum alias omnis e',55,4,0),(73,'Quia numquam',0.58,631332000,'Quaerat sed',1,5,0),(74,'Quia numquam',0.47,633837600,'Quaerat sed',2,5,0),(75,'Quia numquam',0.47,636260400,'Quaerat sed',3,5,0),(76,'Quia numquam',0.47,638938800,'Quaerat sed',4,5,0),(77,'Quia numquam',0.47,641530800,'Quaerat sed',5,5,0),(78,'Quia numquam',0.47,644209200,'Quaerat sed',6,5,0),(79,'Quia numquam',0.47,646801200,'Quaerat sed',7,5,0),(80,'Quia numquam',0.47,649479600,'Quaerat sed',8,5,0),(81,'Quia numquam',0.47,652158000,'Quaerat sed',9,5,0),(82,'Quia numquam',0.47,654750000,'Quaerat sed',10,5,0),(83,'Quia numquam',0.47,657424800,'Quaerat sed',11,5,0),(84,'Quia numquam',0.47,660016800,'Quaerat sed',12,5,0),(85,'Quia numquam',0.47,662695200,'Quaerat sed',13,5,0),(86,'Quia numquam',0.47,665373600,'Quaerat sed',14,5,0),(87,'Quia numquam',0.47,667796400,'Quaerat sed',15,5,0),(88,'Quia numquam',0.47,670474800,'Quaerat sed',16,5,0),(89,'Quia numquam',0.47,673066800,'Quaerat sed',17,5,0),(90,'Quia numquam',0.47,675745200,'Quaerat sed',18,5,0),(91,'Quia numquam',0.47,678337200,'Quaerat sed',19,5,0),(92,'Quia numquam',0.47,681015600,'Quaerat sed',20,5,0),(93,'Quia numquam',0.47,683694000,'Quaerat sed',21,5,0),(94,'Quia numquam',0.47,686286000,'Quaerat sed',22,5,0),(95,'Quia numquam',0.47,688960800,'Quaerat sed',23,5,0),(96,'Quia numquam',0.47,691552800,'Quaerat sed',24,5,0),(97,'Quia numquam',0.47,694231200,'Quaerat sed',25,5,0),(98,'Quia numquam',0.47,696909600,'Quaerat sed',26,5,0),(99,'Quia numquam',0.47,699418800,'Quaerat sed',27,5,0),(100,'Quia numquam',0.47,702097200,'Quaerat sed',28,5,0),(101,'Quia numquam',0.47,704689200,'Quaerat sed',29,5,0),(102,'Quia numquam',0.47,707367600,'Quaerat sed',30,5,0),(103,'Quia numquam',0.47,709959600,'Quaerat sed',31,5,0),(104,'Quia numquam',0.47,712638000,'Quaerat sed',32,5,0),(105,'Quia numquam',0.47,715316400,'Quaerat sed',33,5,0),(106,'Quia numquam',0.47,717908400,'Quaerat sed',34,5,0),(107,'Quia numquam',0.47,720583200,'Quaerat sed',35,5,0),(108,'Quia numquam',0.47,723175200,'Quaerat sed',36,5,0),(109,'Quia numquam',0.47,725853600,'Quaerat sed',37,5,0),(110,'Quia numquam',0.47,728535600,'Quaerat sed',38,5,0),(111,'Quia numquam',0.47,730954800,'Quaerat sed',39,5,0),(112,'Quia numquam',0.47,733633200,'Quaerat sed',40,5,0),(113,'Quia numquam',0.47,736225200,'Quaerat sed',41,5,0),(114,'Quia numquam',0.47,738903600,'Quaerat sed',42,5,0),(115,'Quia numquam',0.47,741495600,'Quaerat sed',43,5,0),(116,'Quia numquam',0.47,744174000,'Quaerat sed',44,5,0),(117,'Quia numquam',0.47,746852400,'Quaerat sed',45,5,0),(118,'Quia numquam',0.47,749444400,'Quaerat sed',46,5,0),(119,'Quia numquam',0.47,752119200,'Quaerat sed',47,5,0),(120,'Quia numquam',0.47,754711200,'Quaerat sed',48,5,0),(121,'Quia numquam',0.47,757389600,'Quaerat sed',49,5,0),(122,'Quia numquam',0.47,760068000,'Quaerat sed',50,5,0),(123,'Quia numquam',0.47,762490800,'Quaerat sed',51,5,0),(124,'Quia numquam',0.47,765169200,'Quaerat sed',52,5,0),(125,'Quia numquam',0.47,767761200,'Quaerat sed',53,5,0),(126,'Quia numquam',0.47,770439600,'Quaerat sed',54,5,0),(127,'Quia numquam',0.47,773031600,'Quaerat sed',55,5,0),(128,'Quia numquam',0.47,775710000,'Quaerat sed',56,5,0),(129,'Quia numquam',0.47,778388400,'Quaerat sed',57,5,0),(130,'Quia numquam',0.47,780980400,'Quaerat sed',58,5,0),(131,'Quia numquam',0.47,783655200,'Quaerat sed',59,5,0),(132,'Quia numquam',0.47,786247200,'Quaerat sed',60,5,0),(133,'Quia numquam',0.47,788925600,'Quaerat sed',61,5,0),(134,'Quia numquam',0.47,791604000,'Quaerat sed',62,5,0),(135,'Quia numquam',0.47,794026800,'Quaerat sed',63,5,0),(136,'Quia numquam',0.47,796705200,'Quaerat sed',64,5,0),(137,'Quia numquam',0.47,799297200,'Quaerat sed',65,5,0),(138,'Quia numquam',0.47,801975600,'Quaerat sed',66,5,0),(139,'Quia numquam',0.47,804567600,'Quaerat sed',67,5,0),(140,'Quia numquam',0.47,807246000,'Quaerat sed',68,5,0),(141,'Quia numquam',0.47,809924400,'Quaerat sed',69,5,0),(142,'Quia numquam',0.47,812516400,'Quaerat sed',70,5,0),(143,'Quia numquam',0.47,815191200,'Quaerat sed',71,5,0),(144,'Quia numquam',0.47,817783200,'Quaerat sed',72,5,0),(145,'Quia numquam',0.47,820461600,'Quaerat sed',73,5,0),(146,'Quia numquam',0.47,823140000,'Quaerat sed',74,5,0),(147,'Quia numquam',0.47,825649200,'Quaerat sed',75,5,0),(148,'Quia numquam',0.47,828327600,'Quaerat sed',76,5,0),(149,'Quia numquam',0.47,830919600,'Quaerat sed',77,5,0),(150,'Quia numquam',0.47,833598000,'Quaerat sed',78,5,0),(151,'Quia numquam',0.47,836190000,'Quaerat sed',79,5,0),(152,'Quia numquam',0.47,838868400,'Quaerat sed',80,5,0),(153,'Quia numquam',0.47,841546800,'Quaerat sed',81,5,0),(154,'Quia numquam',0.47,844138800,'Quaerat sed',82,5,0),(155,'Quia numquam',0.47,846813600,'Quaerat sed',83,5,0),(156,'Quia numquam',0.47,849405600,'Quaerat sed',84,5,0),(157,'Quia numquam',0.47,852084000,'Quaerat sed',85,5,0),(158,'Quia numquam',0.47,854762400,'Quaerat sed',86,5,0),(159,'Quia numquam',0.47,857185200,'Quaerat sed',87,5,0),(378,'teste2',123,1649289600,'teste',1,6,0),(230,'Consequat Consequatur cupiditate et ul',0.64,216529200,'Veniam incididunt q',1,7,0),(231,'Consequat Consequatur cupiditate et ul',0.22,218257200,'Veniam incididunt q',2,7,0),(232,'Consequat Consequatur cupiditate et ul',0.22,220935600,'Veniam incididunt q',3,7,0),(233,'Consequat Consequatur cupiditate et ul',0.22,223614000,'Veniam incididunt q',4,7,0),(234,'Consequat Consequatur cupiditate et ul',0.22,226033200,'Veniam incididunt q',5,7,0),(235,'Consequat Consequatur cupiditate et ul',0.22,228711600,'Veniam incididunt q',6,7,0),(236,'Consequat Consequatur cupiditate et ul',0.22,231303600,'Veniam incididunt q',7,7,0),(237,'Consequat Consequatur cupiditate et ul',0.22,233982000,'Veniam incididunt q',8,7,0),(238,'Consequat Consequatur cupiditate et ul',0.22,236574000,'Veniam incididunt q',9,7,0),(239,'Consequat Consequatur cupiditate et ul',0.22,239252400,'Veniam incididunt q',10,7,0),(240,'Consequat Consequatur cupiditate et ul',0.22,241930800,'Veniam incididunt q',11,7,0),(241,'Consequat Consequatur cupiditate et ul',0.22,244522800,'Veniam incididunt q',12,7,0),(242,'Consequat Consequatur cupiditate et ul',0.22,247201200,'Veniam incididunt q',13,7,0),(243,'Consequat Consequatur cupiditate et ul',0.22,249793200,'Veniam incididunt q',14,7,0),(244,'Consequat Consequatur cupiditate et ul',0.22,252471600,'Veniam incididunt q',15,7,0),(245,'Consequat Consequatur cupiditate et ul',0.22,255150000,'Veniam incididunt q',16,7,0),(246,'Consequat Consequatur cupiditate et ul',0.22,257569200,'Veniam incididunt q',17,7,0),(247,'Consequat Consequatur cupiditate et ul',0.22,260247600,'Veniam incididunt q',18,7,0),(248,'Consequat Consequatur cupiditate et ul',0.22,262839600,'Veniam incididunt q',19,7,0),(249,'Consequat Consequatur cupiditate et ul',0.22,265518000,'Veniam incididunt q',20,7,0),(250,'Consequat Consequatur cupiditate et ul',0.22,268110000,'Veniam incididunt q',21,7,0),(251,'Consequat Consequatur cupiditate et ul',0.22,270788400,'Veniam incididunt q',22,7,0),(252,'Consequat Consequatur cupiditate et ul',0.22,273466800,'Veniam incididunt q',23,7,0),(253,'Consequat Consequatur cupiditate et ul',0.22,276058800,'Veniam incididunt q',24,7,0),(254,'Consequat Consequatur cupiditate et ul',0.22,278737200,'Veniam incididunt q',25,7,0),(255,'Consequat Consequatur cupiditate et ul',0.22,281329200,'Veniam incididunt q',26,7,0),(256,'Consequat Consequatur cupiditate et ul',0.22,284007600,'Veniam incididunt q',27,7,0),(257,'Consequat Consequatur cupiditate et ul',0.22,286686000,'Veniam incididunt q',28,7,0),(258,'Consequat Consequatur cupiditate et ul',0.22,289105200,'Veniam incididunt q',29,7,0),(259,'Consequat Consequatur cupiditate et ul',0.22,291783600,'Veniam incididunt q',30,7,0),(260,'Consequat Consequatur cupiditate et ul',0.22,294375600,'Veniam incididunt q',31,7,0),(261,'Consequat Consequatur cupiditate et ul',0.22,297054000,'Veniam incididunt q',32,7,0),(262,'Consequat Consequatur cupiditate et ul',0.22,299646000,'Veniam incididunt q',33,7,0),(263,'Consequat Consequatur cupiditate et ul',0.22,302324400,'Veniam incididunt q',34,7,0),(264,'Consequat Consequatur cupiditate et ul',0.22,305002800,'Veniam incididunt q',35,7,0),(265,'Consequat Consequatur cupiditate et ul',0.22,307594800,'Veniam incididunt q',36,7,0),(266,'Consequat Consequatur cupiditate et ul',0.22,310273200,'Veniam incididunt q',37,7,0),(267,'Consequat Consequatur cupiditate et ul',0.22,312865200,'Veniam incididunt q',38,7,0),(268,'Consequat Consequatur cupiditate et ul',0.22,315543600,'Veniam incididunt q',39,7,0),(269,'Consequat Consequatur cupiditate et ul',0.22,318222000,'Veniam incididunt q',40,7,0),(270,'Consequat Consequatur cupiditate et ul',0.22,320727600,'Veniam incididunt q',41,7,0),(271,'Consequat Consequatur cupiditate et ul',0.22,323406000,'Veniam incididunt q',42,7,0),(272,'Consequat Consequatur cupiditate et ul',0.22,325998000,'Veniam incididunt q',43,7,0),(273,'Consequat Consequatur cupiditate et ul',0.22,328676400,'Veniam incididunt q',44,7,0),(274,'Consequat Consequatur cupiditate et ul',0.22,331268400,'Veniam incididunt q',45,7,0),(275,'Consequat Consequatur cupiditate et ul',0.22,333946800,'Veniam incididunt q',46,7,0),(276,'Consequat Consequatur cupiditate et ul',0.22,336625200,'Veniam incididunt q',47,7,0),(277,'Consequat Consequatur cupiditate et ul',0.22,339217200,'Veniam incididunt q',48,7,0),(278,'Consequat Consequatur cupiditate et ul',0.22,341895600,'Veniam incididunt q',49,7,0),(279,'Consequat Consequatur cupiditate et ul',0.22,344487600,'Veniam incididunt q',50,7,0),(280,'Consequat Consequatur cupiditate et ul',0.22,347166000,'Veniam incididunt q',51,7,0),(281,'Consequat Consequatur cupiditate et ul',0.22,349844400,'Veniam incididunt q',52,7,0),(282,'Consequat Consequatur cupiditate et ul',0.22,352263600,'Veniam incididunt q',53,7,0),(283,'Consequat Consequatur cupiditate et ul',0.22,354942000,'Veniam incididunt q',54,7,0),(284,'Consequat Consequatur cupiditate et ul',0.22,357534000,'Veniam incididunt q',55,7,0),(285,'Consequat Consequatur cupiditate et ul',0.22,360212400,'Veniam incididunt q',56,7,0),(286,'Consequat Consequatur cupiditate et ul',0.22,362804400,'Veniam incididunt q',57,7,0),(287,'Consequat Consequatur cupiditate et ul',0.22,365482800,'Veniam incididunt q',58,7,0),(288,'Consequat Consequatur cupiditate et ul',0.22,368161200,'Veniam incididunt q',59,7,0),(289,'Consequat Consequatur cupiditate et ul',0.22,370753200,'Veniam incididunt q',60,7,0),(290,'Consequat Consequatur cupiditate et ul',0.22,373431600,'Veniam incididunt q',61,7,0),(291,'Consequat Consequatur cupiditate et ul',0.22,376023600,'Veniam incididunt q',62,7,0),(292,'Consequat Consequatur cupiditate et ul',0.22,378702000,'Veniam incididunt q',63,7,0),(293,'Consequat Consequatur cupiditate et ul',0.22,381380400,'Veniam incididunt q',64,7,0),(294,'Consequat Consequatur cupiditate et ul',0.22,383799600,'Veniam incididunt q',65,7,0),(295,'Consequat Consequatur cupiditate et ul',0.22,386478000,'Veniam incididunt q',66,7,0),(296,'Consequat Consequatur cupiditate et ul',0.22,389070000,'Veniam incididunt q',67,7,0),(297,'Consequat Consequatur cupiditate et ul',0.22,391748400,'Veniam incididunt q',68,7,0),(298,'Consequat Consequatur cupiditate et ul',0.22,394340400,'Veniam incididunt q',69,7,0),(299,'Consequat Consequatur cupiditate et ul',0.22,397018800,'Veniam incididunt q',70,7,0),(300,'Consequat Consequatur cupiditate et ul',0.22,399697200,'Veniam incididunt q',71,7,0),(301,'Consequat Consequatur cupiditate et ul',0.22,402289200,'Veniam incididunt q',72,7,0),(302,'Consequat Consequatur cupiditate et ul',0.22,404967600,'Veniam incididunt q',73,7,0),(303,'Consequat Consequatur cupiditate et ul',0.22,407559600,'Veniam incididunt q',74,7,0),(304,'Consequat Consequatur cupiditate et ul',0.22,410238000,'Veniam incididunt q',75,7,0),(305,'Consequat Consequatur cupiditate et ul',0.22,412916400,'Veniam incididunt q',76,7,0),(306,'Consequat Consequatur cupiditate et ul',0.22,415335600,'Veniam incididunt q',77,7,0),(307,'Consequat Consequatur cupiditate et ul',0.22,418014000,'Veniam incididunt q',78,7,0),(308,'Consequat Consequatur cupiditate et ul',0.22,420606000,'Veniam incididunt q',79,7,0),(309,'Consequat Consequatur cupiditate et ul',0.22,423284400,'Veniam incididunt q',80,7,0),(310,'Consequat Consequatur cupiditate et ul',0.22,425876400,'Veniam incididunt q',81,7,0),(311,'Consequat Consequatur cupiditate et ul',0.22,428554800,'Veniam incididunt q',82,7,0),(312,'Consequat Consequatur cupiditate et ul',0.22,431233200,'Veniam incididunt q',83,7,0),(313,'Consequat Consequatur cupiditate et ul',0.22,433825200,'Veniam incididunt q',84,7,0),(314,'Consequat Consequatur cupiditate et ul',0.22,436503600,'Veniam incididunt q',85,7,0),(315,'Consequat Consequatur cupiditate et ul',0.22,439095600,'Veniam incididunt q',86,7,0),(316,'Consequat Consequatur cupiditate et ul',0.22,441774000,'Veniam incididunt q',87,7,0),(317,'Consequat Consequatur cupiditate et ul',0.22,444452400,'Veniam incididunt q',88,7,0),(318,'Consequat Consequatur cupiditate et ul',0.22,446958000,'Veniam incididunt q',89,7,0),(319,'Mollitia porro velit nihil incidunt esse la',1.92,813034800,'Quaerat voluptas id ',1,8,0),(320,'Mollitia porro velit nihil incidunt esse la',1.86,815191200,'Quaerat voluptas id ',2,8,0),(321,'Mollitia porro velit nihil incidunt esse la',1.86,817783200,'Quaerat voluptas id ',3,8,0),(322,'Mollitia porro velit nihil incidunt esse la',1.86,820461600,'Quaerat voluptas id ',4,8,0),(323,'Mollitia porro velit nihil incidunt esse la',1.86,823140000,'Quaerat voluptas id ',5,8,0),(324,'Mollitia porro velit nihil incidunt esse la',1.86,825649200,'Quaerat voluptas id ',6,8,0),(325,'Mollitia porro velit nihil incidunt esse la',1.86,828327600,'Quaerat voluptas id ',7,8,0),(326,'Mollitia porro velit nihil incidunt esse la',1.86,830919600,'Quaerat voluptas id ',8,8,0),(327,'Mollitia porro velit nihil incidunt esse la',1.86,833598000,'Quaerat voluptas id ',9,8,0),(328,'Mollitia porro velit nihil incidunt esse la',1.86,836190000,'Quaerat voluptas id ',10,8,0),(329,'Mollitia porro velit nihil incidunt esse la',1.86,838868400,'Quaerat voluptas id ',11,8,0),(330,'Mollitia porro velit nihil incidunt esse la',1.86,841546800,'Quaerat voluptas id ',12,8,0),(331,'Mollitia porro velit nihil incidunt esse la',1.86,844138800,'Quaerat voluptas id ',13,8,0),(332,'Mollitia porro velit nihil incidunt esse la',1.86,846813600,'Quaerat voluptas id ',14,8,0),(333,'Mollitia porro velit nihil incidunt esse la',1.86,849405600,'Quaerat voluptas id ',15,8,0),(334,'Mollitia porro velit nihil incidunt esse la',1.86,852084000,'Quaerat voluptas id ',16,8,0),(335,'Mollitia porro velit nihil incidunt esse la',1.86,854762400,'Quaerat voluptas id ',17,8,0),(336,'Mollitia porro velit nihil incidunt esse la',1.86,857185200,'Quaerat voluptas id ',18,8,0),(337,'Mollitia porro velit nihil incidunt esse la',1.86,859863600,'Quaerat voluptas id ',19,8,0),(338,'Mollitia porro velit nihil incidunt esse la',1.86,862455600,'Quaerat voluptas id ',20,8,0),(339,'Mollitia porro velit nihil incidunt esse la',1.86,865134000,'Quaerat voluptas id ',21,8,0),(340,'Mollitia porro velit nihil incidunt esse la',1.86,867726000,'Quaerat voluptas id ',22,8,0),(341,'Mollitia porro velit nihil incidunt esse la',1.86,870404400,'Quaerat voluptas id ',23,8,0),(342,'Mollitia porro velit nihil incidunt esse la',1.86,873082800,'Quaerat voluptas id ',24,8,0),(343,'Mollitia porro velit nihil incidunt esse la',1.86,875674800,'Quaerat voluptas id ',25,8,0),(344,'Mollitia porro velit nihil incidunt esse la',1.86,878349600,'Quaerat voluptas id ',26,8,0),(345,'Mollitia porro velit nihil incidunt esse la',1.86,880941600,'Quaerat voluptas id ',27,8,0),(346,'Mollitia porro velit nihil incidunt esse la',1.86,883620000,'Quaerat voluptas id ',28,8,0),(347,'Mollitia porro velit nihil incidunt esse la',1.86,886298400,'Quaerat voluptas id ',29,8,0),(348,'thiago',1.4,1650769200,'Sunt officiis corpor',1,9,0),(349,'thiago',1.4,1651374000,'Sunt officiis corpor',2,9,0),(350,'thiago',1.4,1654052400,'Sunt officiis corpor',3,9,0),(351,'thiago',1.4,1656644400,'Sunt officiis corpor',4,9,0),(352,'thiago',1.4,1659322800,'Sunt officiis corpor',5,9,0),(353,'thiago',1.4,1662001200,'Sunt officiis corpor',6,9,0),(354,'thiago',1.4,1664593200,'Sunt officiis corpor',7,9,0),(355,'thiago',1.4,1667271600,'Sunt officiis corpor',8,9,0),(356,'thiago',1.4,1669863600,'Sunt officiis corpor',9,9,0),(357,'thiago',1.4,1672542000,'Sunt officiis corpor',10,9,0),(358,'thiago',1.4,1675220400,'Sunt officiis corpor',11,9,0),(359,'thiago',1.4,1677639600,'Sunt officiis corpor',12,9,0),(360,'thiago',1.4,1680318000,'Sunt officiis corpor',13,9,0),(361,'thiago',1.4,1682910000,'Sunt officiis corpor',14,9,0),(362,'thiago',1.4,1685588400,'Sunt officiis corpor',15,9,0),(363,'thiago',1.4,1688180400,'Sunt officiis corpor',16,9,0),(364,'thiago',1.4,1690858800,'Sunt officiis corpor',17,9,0),(365,'thiago',1.4,1693537200,'Sunt officiis corpor',18,9,0),(366,'thiago',1.4,1696129200,'Sunt officiis corpor',19,9,0),(367,'thiago',1.4,1698807600,'Sunt officiis corpor',20,9,0),(368,'thiago',1.4,1701399600,'Sunt officiis corpor',21,9,0),(369,'thiago',1.4,1704078000,'Sunt officiis corpor',22,9,0),(370,'thiago',1.4,1706756400,'Sunt officiis corpor',23,9,0),(371,'thiago',1.4,1709262000,'Sunt officiis corpor',24,9,0),(372,'thiago',1.4,1711940400,'Sunt officiis corpor',25,9,0),(373,'thiago',1.4,1714532400,'Sunt officiis corpor',26,9,0),(374,'thiago',1.4,1717210800,'Sunt officiis corpor',27,9,0),(375,'thiago',1.4,1719802800,'Sunt officiis corpor',28,9,0),(376,'thiago',1.4,1722481200,'Sunt officiis corpor',29,9,0),(377,'thiago',1.4,1725159600,'Sunt officiis corpor',30,9,0);
/*!40000 ALTER TABLE `contasreceberparcelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grupo` (
  `nome` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `fk_Usuario_login` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_grupo`),
  KEY `FK_Grupo_2` (`fk_Usuario_login`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES ('Despesas Fixas',29,NULL,1),('Diversos',30,NULL,1),('Impostos e taxas',31,NULL,0),('ManutenÃ§Ã£o de equipamentos',32,NULL,1),('Material odontolÃ³gico',33,NULL,1),('Publicidade e Marketing',34,NULL,0),('Cliente',35,NULL,1),('Clientes Premium',36,NULL,0);
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subgrupo`
--

DROP TABLE IF EXISTS `subgrupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subgrupo` (
  `nome` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_subgrupo` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_subgrupo`),
  KEY `FK_Subgrupo_2` (`id_grupo`),
  CONSTRAINT `fk_Grupo_id_grupo` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subgrupo`
--

LOCK TABLES `subgrupo` WRITE;
/*!40000 ALTER TABLE `subgrupo` DISABLE KEYS */;
INSERT INTO `subgrupo` VALUES ('Aluguel',23,29,1),('Condominio',24,29,1),('Luz',25,29,1),('Diarista',26,29,1),('Tecpan Lixo Hospital',27,29,1),('Radiologia',28,29,0),('Sanepar',29,29,1),('Genial Inova',30,29,1),('Invicta',31,29,1),('Despesas',32,30,1),('DepÃ³sitos',33,30,1),('Despesas de Viagem',35,30,1),('FGTS',36,31,0),('Cadeiras',37,32,1),('Compressor',38,32,1),('LÃ¢mpadas',39,32,1),('Computadores',40,29,0),('Dental Noronha',41,33,1),('Ideal Dental',42,33,1),('Sulmedik',43,29,0),('Dental MAX',44,33,1),('DIGI Arte',45,34,0),('Planus',46,34,0),('Cliente Recorrente',47,35,1),('Cliente Novo',48,35,1),('Novo cliente Premium',49,36,0);
/*!40000 ALTER TABLE `subgrupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('admin','admin');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-25 23:50:29
