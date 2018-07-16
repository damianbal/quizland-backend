# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.5.5-10.2.15-MariaDB)
# Database: quizapi
# Generation Time: 2018-07-14 19:10:36 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table quiz
# ------------------------------------------------------------

DROP TABLE IF EXISTS `quiz`;

CREATE TABLE `quiz` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT 'Quiz with no name -.-',
  `data` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `quiz` WRITE;
/*!40000 ALTER TABLE `quiz` DISABLE KEYS */;

INSERT INTO `quiz` (`id`, `title`, `data`)
VALUES
	(1,'Capitals','[{\"question\":\"Capital of Poland?\",\"answers\":[\"Szczecin\",\"Warszawa\",\"Berlin\"],\"correct_answer_index\":1}]'),
	(2,'zeby','[{\"question\":\"jakich zebow nie ma w uzebieniu stalym?\",\"answers\":[\"przedtrzonowych\",\"trzonowych\",\"kly\"],\"correct_answer_index\":0},{\"question\":\"ile czlowiek ma zebow ?\",\"answers\":[\"36\",\"12\",\"8\"],\"correct_answer_index\":0},{\"question\":\"jakie sa uzebienia?\",\"answers\":[\"mieszane pelne \",\"stale mleczne\"],\"correct_answer_index\":1}]');

/*!40000 ALTER TABLE `quiz` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
