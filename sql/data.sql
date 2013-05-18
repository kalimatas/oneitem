# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.10)
# Database: one
# Generation Time: 2013-05-18 11:43:34 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table shop_category
# ------------------------------------------------------------

LOCK TABLES `shop_category` WRITE;
/*!40000 ALTER TABLE `shop_category` DISABLE KEYS */;

INSERT INTO `shop_category` (`id`, `name`)
VALUES
	(1,'Ноутбуки'),
	(2,'Вертолеты');

/*!40000 ALTER TABLE `shop_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shop_order
# ------------------------------------------------------------



# Dump of table shop_product
# ------------------------------------------------------------

LOCK TABLES `shop_product` WRITE;
/*!40000 ALTER TABLE `shop_product` DISABLE KEYS */;

INSERT INTO `shop_product` (`id`, `status`, `category_id`, `name`, `description`, `price`)
VALUES
	(1,'active',1,'MacBook Pro 13','Это ноутбук типа, на котором мы все это написали.',42000.00),
	(2,'active',1,'IBM ThinkPad x200','А на этом мы делали раньше.',25000.00),
	(3,'active',2,'К-52','Ударный вертолет, который может противостоять целой армии.',88000000.00),
	(4,'active',2,'Ми-8','Является самым массовым двухдвигательным вертолётом в мире.',12000000.00),
	(5,'active',1,'Acer Aspire M5','Крутой ноутбук для всего.',30000.00);

/*!40000 ALTER TABLE `shop_product` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
