/*
SQLyog Community
MySQL - 10.4.18-MariaDB : Database - login_cadastro
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `user_photo` varchar(200) NOT NULL DEFAULT 'default_img.png',
  `user_email` varchar(200) NOT NULL,
  `reco_pass_key` char(50) DEFAULT 'temp',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`id`,`username`,`pass`,`user_photo`,`user_email`,`reco_pass_key`) values 
(13,'Marcelosmbr','$2y$10$bILHtK7uLWimhIlTSi4FtuAdfUjqKJ2xDfW66rCyL/j3p/9gJ5.DW','default_img.png','marcelosmbr@gmail.com','a2bd79aec5a5e8381dde58a1621addd34c8add435bef1e99d6'),
(15,'Donald','$2y$10$RRnqWlCbVlldyfq0TDBk2uUVPJ8pyid9MMnL5EZtGw6s8R/ayrTuG','Donald.jpg','donald_trampa@gmail.com','temp');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
