-- MySQL dump 10.19  Distrib 10.3.36-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sae202
-- ------------------------------------------------------
-- Server version	10.3.36-MariaDB-0+deb10u2

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
-- Table structure for table `Parking`
--

DROP TABLE IF EXISTS `Parking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Parking` (
  `parking_id` int(2) NOT NULL,
  `parking_nom` varchar(50) NOT NULL,
  `parking_map` varchar(255) NOT NULL,
  `parking_comm` varchar(250) NOT NULL,
  PRIMARY KEY (`parking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Parking`
--

LOCK TABLES `Parking` WRITE;
/*!40000 ALTER TABLE `Parking` DISABLE KEYS */;
INSERT INTO `Parking` VALUES (1,'Parking_IUT','!1m18!1m12!1m3!1d2655.794215562071!2d4.071322276523591!3d48.26833457125821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ee990b6a30bd77%3A0x3e88f274a6080faf!2sParking!5e0!3m2!1sfr!2sfr!4v1685984593589!5m2!1sfr!2sfr','Parking proche du Crous et de l\'IUT gratuit');
/*!40000 ALTER TABLE `Parking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reservations`
--

DROP TABLE IF EXISTS `Reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reservations` (
  `reservations_id` int(2) NOT NULL,
  `echange` varchar(150) NOT NULL,
  `bagages` varchar(150) NOT NULL,
  `user_id` int(2) NOT NULL,
  `trajet_id` int(2) NOT NULL,
  PRIMARY KEY (`reservations_id`),
  KEY `fk_user_id2` (`user_id`),
  KEY `fk_trajet_id` (`trajet_id`),
  CONSTRAINT `Reservations_ibfk_1` FOREIGN KEY (`reservations_id`) REFERENCES `Usagers` (`user_id`),
  CONSTRAINT `fk_trajet_id` FOREIGN KEY (`trajet_id`) REFERENCES `Trajets` (`trajet_id`),
  CONSTRAINT `fk_user_id2` FOREIGN KEY (`user_id`) REFERENCES `Usagers` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reservations`
--

LOCK TABLES `Reservations` WRITE;
/*!40000 ALTER TABLE `Reservations` DISABLE KEYS */;
INSERT INTO `Reservations` VALUES (1,'','',8,4),(2,'','',9,1);
/*!40000 ALTER TABLE `Reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Trajets`
--

DROP TABLE IF EXISTS `Trajets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Trajets` (
  `trajet_id` int(2) NOT NULL,
  `depart` varchar(40) NOT NULL,
  `lieu_exact` varchar(60) NOT NULL,
  `arrivee` varchar(60) NOT NULL,
  `date` date NOT NULL,
  `heure` time(4) NOT NULL,
  `nombre_places` int(20) NOT NULL,
  `lieu_depot` varchar(60) NOT NULL,
  `user_id` int(2) NOT NULL,
  PRIMARY KEY (`trajet_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `Usagers` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Trajets`
--

LOCK TABLES `Trajets` WRITE;
/*!40000 ALTER TABLE `Trajets` DISABLE KEYS */;
INSERT INTO `Trajets` VALUES (1,'Troyes','','Romilly','2023-06-05','17:00:00.0000',4,'',1),(2,'Troyes','','Bar sur Aube','2023-06-06','18:00:00.0000',3,'',2),(3,'Troyes','','Bar sur Aube','2023-06-12','19:00:00.0000',3,'',2),(4,'Troyes','','Romilly','2023-06-06','16:00:00.0000',2,'',1),(5,'Troyes','','Bar sur Aube','2023-06-07','07:30:01.0000',3,'',2),(6,'Troyes','','La Chapelle Saint Luc','2023-06-05','17:00:00.0000',4,'',5),(7,'Bar sur Aube','','Troyes','2023-06-14','20:00:00.0000',3,'',2),(8,'Romilly','','Troyes','2023-06-13','15:00:00.0000',2,'',1),(9,'La Chapelle Saint Luc','','Troyes','2023-06-14','11:00:00.0000',4,'',5),(10,'Troyes','','Romilly','2023-06-21','20:00:00.0000',3,'',1);
/*!40000 ALTER TABLE `Trajets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usagers`
--

DROP TABLE IF EXISTS `Usagers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usagers` (
  `user_id` int(2) NOT NULL AUTO_INCREMENT,
  `nom_utili` varchar(40) DEFAULT NULL,
  `usagers_mdp` varchar(40) NOT NULL,
  `usagers_email` varchar(100) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `num` int(50) DEFAULT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `profil_pic` varchar(150) DEFAULT NULL,
  `autre` varchar(250) DEFAULT NULL,
  `vehicule` varchar(150) DEFAULT NULL,
  `fumeur` varchar(10) DEFAULT NULL,
  `animaux` varchar(10) DEFAULT NULL,
  `musique` varchar(50) DEFAULT NULL,
  `linguistique` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usagers`
--

LOCK TABLES `Usagers` WRITE;
/*!40000 ALTER TABLE `Usagers` DISABLE KEYS */;
INSERT INTO `Usagers` VALUES (1,'','123','bob.dylan@gmail.com','Bob','Dylan',0,'','','','','','','',''),(2,'','','','René','Lataupe',0,'','','','','','','',''),(3,'','','','Paul','Ochon',0,'','','','','','','',''),(4,'','','','Sam','Suffy',0,'','','','','','','',''),(5,'','','','Théo','Point',0,'','','','','','','',''),(6,'','','','Bill','Tag',0,'','','','','','','',''),(7,'','','','Zack','Bulga',0,'','','','','','','',''),(8,'','','','Zoe','Bulga',0,'','','','','','','',''),(9,'','','','Sandy','Patos',0,'','','','','','','',''),(10,'','','','Polux','Dupond',0,'','','','','','','','');
/*!40000 ALTER TABLE `Usagers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-06  7:31:11
