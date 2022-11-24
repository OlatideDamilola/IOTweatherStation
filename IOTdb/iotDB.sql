/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.4.14-MariaDB : Database - iotweatherstationdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `defstore_tbl` */

CREATE TABLE `defstore_tbl` (
  `defID` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `defstore_tbl` */

insert  into `defstore_tbl`(`defID`) values ('5ffe9a430a558');

/*Table structure for table `pword_tbl` */

CREATE TABLE `pword_tbl` (
  `pWord` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pword_tbl` */

insert  into `pword_tbl`(`pWord`) values ('q');

/*Table structure for table `stores_tbl` */

CREATE TABLE `stores_tbl` (
  `datTitle` tinytext DEFAULT NULL,
  `datID` tinytext DEFAULT NULL,
  `datDate` tinytext DEFAULT NULL,
  `datDescrip` tinytext DEFAULT NULL,
  `datIntval` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `stores_tbl` */

insert  into `stores_tbl`(`datTitle`,`datID`,`datDate`,`datDescrip`,`datIntval`) values ('hy','5ffe9a430a558','2021-01-12','','10'),('d','5ffe9a55ad176','2021-01-12','',NULL),('d','5ffe9b62e05a4','2022-03-14','ffhh',NULL),('d','5ffe9cdd8809a','2022-03-14','ffhh','10'),('d','5ffe9ceddb54a','2022-03-14','ffhh',NULL),('d','5ffe9d0aae502','2022-03-14','ffhh',NULL),('ww','5ffe9d1788b63','2021-01-12','',NULL),('uuuu','5ffe9f724fdf3','2021-01-12','uuyy',NULL),('re','5ffea0213a5e1','2021-01-12','kk',NULL),('good','6003bf46dd61c2.19126598','2022-01-19','',NULL),('dfww','6005d75d4c5323.09818691','2021-01-18','',NULL),('ttt','60061ab1435476.29334641','2021-01-18','',NULL),('qqq','60061b34e52710.28725468','2021-01-18','',NULL),('qqq','60061f43ba4cd1.81187409','2021-01-18','',NULL),('nnn','60061f5951f085.43973521','2021-01-20','',NULL),('iii','60061f78da2804.70062510','2021-01-18','',NULL),('iii','60062006b12a82.47618517','2021-01-18','',NULL),('www','6006208c8c1b56.61853358','2021-03-18','sdsds',NULL),('www','600620b038cc44.60171936','2021-03-18','sdsds',NULL),('xqa','600620dcd83226.49673831','2023-01-18','',NULL),('eeecxvx','6006220295d605.71411909','2021-01-18','cvcv',NULL),('pppp','6009b2b8586c21.58831149','2021-04-21','uytfgjkjuigu','7'),('qwre','6009b33b827645.66780520','2021-01-23','iuyguy','2'),('FSDFDS','6009b3fc239f42.99333328','2021-01-21','','0'),('PPPY','6009b4498be326.78589302','2021-01-21','','0'),('UIUO','6009b45e46ee29.02772380','2021-01-21','','0'),('UIUO','6009b4af803e24.48889881','2021-01-21','','0'),('cq','60189902ed2941.31509413','2021-02-01','','2'),('ttt','601944448700e4.90627916','2021-02-02','','2');

/*Table structure for table `wdata_tbl` */

CREATE TABLE `wdata_tbl` (
  `wDataID` mediumint(9) NOT NULL,
  `pressCol` float NOT NULL,
  `tempCol` float NOT NULL,
  `humidCol` mediumint(9) NOT NULL,
  `lightCol` float NOT NULL,
  `rdsCol` mediumint(9) NOT NULL,
  `rfCol` mediumint(9) NOT NULL,
  `rguageCol` mediumint(9) NOT NULL,
  `storeID` tinytext NOT NULL,
  `datNumbCol` mediumint(9) NOT NULL,
  KEY `wDataID` (`wDataID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `wdata_tbl` */

insert  into `wdata_tbl`(`wDataID`,`pressCol`,`tempCol`,`humidCol`,`lightCol`,`rdsCol`,`rfCol`,`rguageCol`,`storeID`,`datNumbCol`) values (0,0,0,0,0,0,0,0,'storeID',0),(0,54,25,99,35,45,54,5,'5ffe9a430a558',1),(0,54,0,23,35,45,54,45,'5ffe9a430a558',2),(0,32,94,37,22,127,67,127,'5ffe9a430a558',3),(0,127,28,79,127,0,0,0,'5ffe9a430a558',4),(0,127,28,79,127,0,0,0,'5ffe9a430a558',5),(0,127,28,79,49,0,0,0,'',0),(0,0,0,0,0.2,0,0,0,'',15),(0,820.47,0,0,0.4,0,0,0,'5ffe9a430a558',15);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
