-- Adminer 4.7.7 MySQL dump

 SET NAMES utf8;
 SET time_zone = '+00:00';
 SET foreign_key_checks = 0;
 SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

 DROP DATABASE IF EXISTS `php-config`;
 CREATE DATABASE `php-config` /*!40100 DEFAULT CHARACTER SET utf8 */;
 USE `php-config`;

 DROP TABLE IF EXISTS `brands`;
 CREATE TABLE `brands` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(255) NOT NULL,
   `country` varchar(2) NOT NULL,
   PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 INSERT INTO `brands` (`id`, `name`, `country`) VALUES
 (1,	'MSCOPIA',	'us'),
 (2,	'Nano$oft',	'us'),
 (3,	'Acu',	'us'),
 (5,	'π-Rate',	'us'),
 (6,	'Taeyong',	'kr');

 DROP TABLE IF EXISTS `cpus`;
 CREATE TABLE `cpus` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(255) NOT NULL,
   `price` decimal(10,0) unsigned NOT NULL,
   `brand_id` int(10) unsigned NOT NULL,
   `clock` int(10) unsigned NOT NULL,
   `cores` int(10) unsigned NOT NULL,
   PRIMARY KEY (`id`),
   KEY `brand_id` (`brand_id`),
   CONSTRAINT `cpus_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 INSERT INTO `cpus` (`id`, `name`, `price`, `brand_id`, `clock`, `cores`) VALUES
 (1,	'j3 Dual-Core (9ème génération)',	125,	3,	2100,	2),
 (2,	'j5 Quad-Core (9ème génération)',	250,	3,	2300,	4),
 (3,	'j7 Octo-Core (9ème génération)',	500,	3,	3600,	8);

 DROP TABLE IF EXISTS `gpus`;
 CREATE TABLE `gpus` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(255) NOT NULL,
   `price` decimal(10,0) unsigned NOT NULL,
   `brand_id` int(10) unsigned NOT NULL,
   `ram` int(10) unsigned NOT NULL,
   PRIMARY KEY (`id`),
   KEY `brand_id` (`brand_id`),
   CONSTRAINT `gpus_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 INSERT INTO `gpus` (`id`, `name`, `price`, `brand_id`, `ram`) VALUES
 (1,	'VeStrength 1050 GTX',	300,	1,	2000),
 (2,	'VeStrength 1650 GTX',	600,	1,	4000),
 (3,	'VeStrength 2050 GTX',	900,	1,	6000);

 DROP TABLE IF EXISTS `hdds`;
 CREATE TABLE `hdds` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(255) NOT NULL,
   `price` decimal(10,0) unsigned NOT NULL,
   `brand_id` int(10) unsigned NOT NULL,
   `size` int(10) unsigned NOT NULL,
   `type` int(10) unsigned NOT NULL,
   PRIMARY KEY (`id`),
   KEY `brand_id` (`brand_id`),
   CONSTRAINT `hdds_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 INSERT INTO `hdds` (`id`, `name`, `price`, `brand_id`, `size`, `type`) VALUES
 (1,	'π-Rate 500 Go HDD',	50,	5,	500,	0),
 (2,	'π-Rate 1 To HDD',	100,	5,	1000,	0),
 (3,	'π-Rate 2 To HDD',	200,	5,	2000,	0),
 (4,	'Taeyong EVO 250 Go SSD',	100,	6,	250,	1),
 (5,	'Taeyong EVO 500 Go SSD',	200,	6,	500,	1),
 (6,	'Taeyong EVO 1 To SSD',	400,	6,	1000,	1);

 DROP TABLE IF EXISTS `os`;
 CREATE TABLE `os` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(255) NOT NULL,
   `price` decimal(10,0) NOT NULL,
   `brand_id` int(10) unsigned NOT NULL,
   PRIMARY KEY (`id`),
   KEY `brand_id` (`brand_id`),
   CONSTRAINT `os_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 INSERT INTO `os` (`id`, `name`, `price`, `brand_id`) VALUES
 (1,	'Shutters® 10 - édition familiale',	100,	2),
 (2,	'Shutters® 10 - édition professionnelle',	100,	2);

 DROP TABLE IF EXISTS `rams`;
 CREATE TABLE `rams` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(255) NOT NULL,
   `price` decimal(10,0) unsigned NOT NULL,
   `brand_id` int(10) unsigned NOT NULL,
   `chipset_size` int(10) unsigned NOT NULL,
   `chipset_count` int(10) unsigned NOT NULL,
   PRIMARY KEY (`id`),
   KEY `brand_id` (`brand_id`),
   CONSTRAINT `rams_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 INSERT INTO `rams` (`id`, `name`, `price`, `brand_id`, `chipset_size`, `chipset_count`) VALUES
 (1,	'2 x 4 Go π-Rate DDR4',	40,	5,	4,	2),
 (2,	'1 x 8 Go π-Rate DDR4',	50,	5,	8,	1),
 (3,	'2 x 8 Go π-Rate DDR4',	80,	5,	8,	2),
 (4,	'1 x 16 Go π-Rate DDR4',	100,	5,	16,	1),
 (5,	'1 x 32 Go π-Rate DDR4',	200,	5,	32,	1),
 (6,	'2 x 16 Go π-Rate DDR4',	160,	5,	16,	2);

 DROP TABLE IF EXISTS `config`;
 CREATE TABLE `config` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `name` varchar(255) NOT NULL,
   `cpu_id` int(10) unsigned DEFAULT NULL,
   `gpu_id` int(10) unsigned DEFAULT NULL,
   `hdd_id` int(10) unsigned DEFAULT NULL,
   `ram_id` int(10) unsigned DEFAULT NULL,
   `os_id` int(10) unsigned DEFAULT NULL,
   PRIMARY KEY (`id`),
   KEY `cpu_id` (`cpu_id`),
   KEY `gpu_id` (`gpu_id`),
   KEY `hdd_id` (`hdd_id`),
   KEY `ram_id` (`ram_id`),
   KEY `os_id` (`os_id`),
   CONSTRAINT `config_ibfk_1` FOREIGN KEY (`cpu_id`) REFERENCES `cpus` (`id`) ON DELETE SET NULL,
   CONSTRAINT `config_ibfk_2` FOREIGN KEY (`gpu_id`) REFERENCES `gpus` (`id`) ON DELETE SET NULL,
   CONSTRAINT `config_ibfk_3` FOREIGN KEY (`hdd_id`) REFERENCES `hdds` (`id`) ON DELETE SET NULL,
   CONSTRAINT `config_ibfk_4` FOREIGN KEY (`ram_id`) REFERENCES `rams` (`id`) ON DELETE SET NULL,
   CONSTRAINT `config_ibfk_5` FOREIGN KEY (`os_id`) REFERENCES `os` (`id`) ON DELETE SET NULL
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

 INSERT INTO `config` (`id`, `name`, `cpu_id`, `gpu_id`, `hdd_id`, `ram_id`, `os_id`) VALUES
 (1,	'Le moins cher',	1,	1,	1,	1,	NULL),
 (2,	'Spécial graphiste',	1,	3,	4,	3,	1),
 (8,	'Super configuration de la mort qui tue encore plus',	1,	3,	6,	5,	2),
 (10,	'Config de test pour voir si mon formulaire fonctionne',	2,	3,	3,	3,	1),
 (16,	'Bonjour les cheums',	3,	2,	4,	2,	1);

 -- 2021-07-22 09:42:02