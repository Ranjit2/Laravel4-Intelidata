CREATE DATABASE  IF NOT EXISTS `laravel` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `laravel`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: laravel
-- ------------------------------------------------------
-- Server version	5.6.16

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Telefonia'),(2,'Television'),(3,'Internet'),(4,'Celular');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emp_categ_mes`
--

DROP TABLE IF EXISTS `emp_categ_mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emp_categ_mes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa_categoria` int(11) NOT NULL,
  `id_mes` int(11) NOT NULL,
  `monto` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_empresa_categoria` (`id_empresa_categoria`),
  KEY `id_mes` (`id_mes`),
  CONSTRAINT `emp_categ_mes_fk2` FOREIGN KEY (`id_empresa_categoria`) REFERENCES `empresa_categoria` (`id`),
  CONSTRAINT `emp_categ_mes_fk1` FOREIGN KEY (`id_mes`) REFERENCES `mes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emp_categ_mes`
--

LOCK TABLES `emp_categ_mes` WRITE;
/*!40000 ALTER TABLE `emp_categ_mes` DISABLE KEYS */;
INSERT INTO `emp_categ_mes` VALUES (1,8,1,15000);
/*!40000 ALTER TABLE `emp_categ_mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa`
--

DROP TABLE IF EXISTS `empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa`
--

LOCK TABLES `empresa` WRITE;
/*!40000 ALTER TABLE `empresa` DISABLE KEYS */;
INSERT INTO `empresa` VALUES (5,'Movistar'),(6,'Claro'),(7,'Entel'),(9,'Vtr');
/*!40000 ALTER TABLE `empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresa_categoria`
--

DROP TABLE IF EXISTS `empresa_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresa_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `empresa_categoria_fk1` (`id_empresa`),
  KEY `id_categoria` (`id_categoria`),
  CONSTRAINT `empresa_categoria_fk2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  CONSTRAINT `empresa_categoria_fk1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresa_categoria`
--

LOCK TABLES `empresa_categoria` WRITE;
/*!40000 ALTER TABLE `empresa_categoria` DISABLE KEYS */;
INSERT INTO `empresa_categoria` VALUES (8,5,4),(10,5,1);
/*!40000 ALTER TABLE `empresa_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mes`
--

DROP TABLE IF EXISTS `mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mes`
--

LOCK TABLES `mes` WRITE;
/*!40000 ALTER TABLE `mes` DISABLE KEYS */;
INSERT INTO `mes` VALUES (1,'Enero'),(2,'Febrero'),(3,'Marzo'),(4,'Abril'),(5,'Mayo'),(6,'Junio'),(7,'Julio'),(8,'Agosto'),(9,'Septiembre'),(10,'Octubre'),(11,'Noviembre'),(12,'Diciembre');
/*!40000 ALTER TABLE `mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabla1`
--

DROP TABLE IF EXISTS `tabla1`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tabla1` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(50) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `mes` varchar(20) DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `categoria` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabla1`
--

LOCK TABLES `tabla1` WRITE;
/*!40000 ALTER TABLE `tabla1` DISABLE KEYS */;
INSERT INTO `tabla1` VALUES (22,'Movistar',2015,'abril',10000,'Numero1'),(23,'Movistar',2014,'abril',20000,'Numero2'),(24,'Movistar',2014,'mayo',30000,'Numero1'),(25,'Movistar',2014,'junio',40000,'Numero1'),(26,'Movistar',2014,'julio',50000,'Numero1'),(27,'Movistar',2014,'agosto',60000,'Numero1'),(28,'Movistar',2014,'septiembre',70000,'Numero1'),(29,'Claro',2014,'marzo',10000,'Numero1'),(30,'Claro',2014,'abril',20000,'Numero3'),(31,'Claro',2014,'mayo',30000,'Numero3'),(32,'Claro',2014,'junio',40000,'Numero4'),(33,'Claro',2014,'julio',50000,'Numero3'),(34,'Claro',2014,'agosto',60000,'Numero2'),(35,'Claro',2014,'septiembre',70000,'Numero3'),(36,'Entel',2014,'marzo',10000,'Numero4'),(37,'Entel',2014,'abril',20000,'Numero4'),(38,'Entel',2014,'mayo',30000,'Numero4'),(39,'Entel',2014,'junio',40000,'Numero4'),(40,'Entel',2014,'julio',50000,'Numero4'),(41,'Entel',2014,'agosto',60000,'Numero4'),(42,'Entel',2014,'septiembre',70000,'Numero4');
/*!40000 ALTER TABLE `tabla1` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-21 18:36:15
