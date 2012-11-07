-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: amex
-- ------------------------------------------------------
-- Server version	5.5.28-0ubuntu0.12.04.2

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
-- Table structure for table `challenge`
--

DROP TABLE IF EXISTS `challenge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `challenge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT NULL,
  `question` longtext COLLATE utf8_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D70989518CDE5729` (`type`),
  CONSTRAINT `FK_D70989518CDE5729` FOREIGN KEY (`type`) REFERENCES `type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `challenge`
--

LOCK TABLES `challenge` WRITE;
/*!40000 ALTER TABLE `challenge` DISABLE KEYS */;
INSERT INTO `challenge` VALUES (1,1,'¿Cual de los siguientes <r>mercados/regiones</r> utiliza la nueva estructura?','{\n    \"opciones\": {\n        \"1\": \"Us, Canada, JAPAN.\",\n        \"2\": \"US, Canada.\",\n        \"3\": \"US, Canada y EMEA.\"\n    },\n    \"respuesta\": \"1\"\n}','2012-11-12 00:00:00'),(2,1,'El \"Merchant Value Brand\" de la <r>nueva estructura de ventas</r> es...','{\r\n    \"opciones\": {\r\n        \"1\": \"American Express ayuda a incrementar las ventas de su negocio.\",\r\n        \"2\": \"American Express ayuda a acelerar el exito de su negocio.\",\r\n        \"3\": \"American Express es el mejor socio de su negocio.\"\r\n    },\r\n    \"respuesta\": \"2\"\r\n}','2012-11-13 00:00:00'),(3,2,'¿Cuales son las tres mejores peliculas para ver <r>un dia de lluvia</r>?','{\r\n    \"consigna\": \"Subi rapido una imagen de cada una de ellas!. Otros usuarios estan participando en este momento!\",\r\n}','2012-11-14 00:00:00'),(4,3,'American Express con su producto \"Business Insigts\", colabora maximizando la EEficiencia Operativa de los merchants.','{\r\n   \"respuesta\": \"1\"\r\n}','2012-11-15 00:00:00'),(5,3,'La marca American Express transmite seguridad y confianza a los clientes actuales y potenciales, y les da tranquilidad para gastar mas en si Establecimiento\". Para reforzar esta idea, sugerimos a los Establecimientos colocar correctamente el material de señalizacion de American Express.','{\r\n    \"respuesta\": \"1\"\r\n}','2012-11-16 00:00:00'),(6,1,'American Express puede maximizar la Eficiencia Operativa de los Establecimientos <r> por medio de 3 vías:</r> ','{\r\n    \"opciones\": {\r\n        \"1\": \"Servicio sobresaliente.\",\r\n        \"2\": \"Protección contra fraude.\",\r\n        \"3\": \"Mejor desempeño.\"\r\n        \"4\": \"Todos los anteriores.\"\r\n    },\r\n    \"respuesta\": \"4\"\r\n}','2012-11-19 00:00:00'),(7,3,'El \"Dígale si a sis clientes\" se refiere a que los merchants ofrezcan la forma de pago preferida por sus clientes.','{\r\n    \"respuesta\": \"1\"\r\n}','2012-11-20 00:00:00'),(8,3,'Para mantener su negocio a la vanguardia, los merchants pueden acceder a conocimientos e informacion exclucsivos y aprovechar las oportunidades de crecimiento digital que ofrece Amercian Express.','{\r\n    \"respuesta\": \"1\"\r\n}','2012-11-21 00:00:00'),(9,3,'El programa \"Bonus Points\" de Membership Rewards ayuda a generar Ingresos Incrementales para el negocio del merchant','{\r\n    \"respuesta\": \"1\"\r\n}','2012-11-22 00:00:00'),(10,2,'Subí una foto de un <r>momento inolvidable de tu vida</r>, como un cumpleaños, casamiento o cualquier otra ocasión <r>especial para vos</r> y prepárate para vivir otro momento así con AMEX.','','2012-11-23 00:00:00');
/*!40000 ALTER TABLE `challenge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'Trivia'),(2,'Desafio'),(3,'Verdadero o Falso');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `logged_time` int(11) NOT NULL,
  `role` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'1','fertandil87@gmail.com','admin','Fernando','Saez',0,'ROLE_ADMIN'),(2,'2','lisandro.w.delfino@aexp.com','6512','Lisandro','Delfino',0,''),(3,'2','angel.v.delatijera@aexp.com','6512','Angel','De la Tijera',0,''),(4,'2','sandra.p.garcia@aexp.com','6512','Sandra','Garcia',0,''),(5,'2','laura.basoscopascual@aexp.com','4673','Laura','Basoco',0,''),(6,'2','oscar.f.rodriguez@aexp.com','6516','Oscar','Rodriguez',0,''),(7,'2','erika.r.granados@aexp.com','3251','Erika','Granados',0,''),(8,'2','dolores.a.martinez@aexp.com','6098','Dolores','Martinez',0,''),(9,'2','andrei.j.alvarado@aexp.com','0195','Andrei','Alvarado',0,''),(10,'2','samantha.b.trejo@aexp.com','3242','Samanta','Trejo',0,''),(11,'2','marcela.turano@aexp.com','9853','Marcela','Turano',0,''),(12,'2','ricardo.calderon@aexp.com','1565','Ricardo','Calderon',0,''),(13,'2','adriana.l.zavala@aexp.com','4162','Adriana','Zavala',0,''),(14,'2','alberto.v.delcastillo@aexp.com','1254','Alberto','Del Castillo',0,''),(15,'2','jose.a.galvez@aexp.com','4232','Jose','Galvez',0,''),(16,'2','jorge.a.pelaez.hamui@aexp.com','7453','Jorge','Pelaez',0,''),(17,'2','manuelenrique.n.vazquez@aexp.com','7620','Manuel','Vazquez',0,''),(18,'2','juan.c.aguirre.ramos@aexp.com','3259','Juan','Aguirre',0,''),(19,'2','nestor.r.cuenca@aexp.com','1165','Nesto','Cuenca',0,''),(20,'2','amparo.c.acuna@aexp.com','7653','Amparo','Acuña',0,''),(21,'2','laura.d.perezhuidobro@aexp.com','3793','Laura','Perez',0,''),(22,'2','carlos.gerardo.olivares@aexp.com','6464','Carlos','Olivares',0,''),(23,'2','gerardo.welter.skala@aexp.com','3384','Gerando','Welter',0,''),(24,'2','joselyne.d.rueda@aexp.com','0926','Joselyne','Rueda',0,''),(25,'1','ignacio.l.rodriguezreimundes@aexp.com','8564','Ignacio','Rodriguez Reimundes',0,''),(26,'1','nicolas.p.ricci@aexp.com','1623','Nicolas','Ricci',0,''),(27,'1','silvina.s.peri@aexp.com','4685','Silvina','Peri',0,''),(28,'1','agustina.bosch@aexp.com','1893','Agustina','Bosch',0,''),(29,'1','maria.v.miretti@aexp.com','8912','Virginia','Miretti',0,''),(30,'1','alejo.e.quiroga@aexp.com','9763','Alejo','Quiroga',0,''),(31,'1','daniela.w.baez@aexp.com','7921','Daniela','Baez',0,''),(32,'1','cecilia.stefanoni@aexp.com','9962','Cecilia','Stefanoni',0,'');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `challenge` int(11) DEFAULT NULL,
  `answer` longtext COLLATE utf8_unicode_ci NOT NULL,
  `response_time` int(11) NOT NULL,
  `right_answer` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BF8F51188D93D649` (`user`),
  KEY `IDX_BF8F5118D7098951` (`challenge`),
  CONSTRAINT `FK_BF8F51188D93D649` FOREIGN KEY (`user`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_BF8F5118D7098951` FOREIGN KEY (`challenge`) REFERENCES `challenge` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_answer`
--

LOCK TABLES `user_answer` WRITE;
/*!40000 ALTER TABLE `user_answer` DISABLE KEYS */;
INSERT INTO `user_answer` VALUES (33,1,2,'2',48,1,'2012-11-06 22:58:11');
/*!40000 ALTER TABLE `user_answer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-06 23:04:30
