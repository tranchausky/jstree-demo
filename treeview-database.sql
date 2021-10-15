-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `treeview`;
CREATE DATABASE `treeview` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `treeview`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `listtree`;
CREATE TABLE `listtree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(222) CHARACTER SET utf8 DEFAULT NULL,
  `icon` varchar(222) DEFAULT 'folder',
  `id_parent` int(11) DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `listtree` (`id`, `text`, `icon`, `id_parent`, `content`) VALUES
(1,	'images',	'folder',	NULL,	'22222222'),
(2,	'New node',	'folder',	1,	'New node 2'),
(3,	'New node',	'folder',	1,	'New node 3'),
(4,	'New node',	'folder',	1,	'New node 4'),
(5,	'enf',	'folder',	1,	'New node 5'),
(9,	'New node',	'folder',	0,	'New node 9'),
(10,	'New node',	'folder',	0,	'New node 10'),
(11,	'New node',	'folder',	2,	'node 11'),
(12,	'asdfdsf12312',	'folder',	3,	'node 12'),
(14,	'c123',	'folder',	3,	'node 14'),
(15,	'22',	'folder',	3,	'node 15'),
(16,	'việt nám cỏi',	'folder',	3,	'node 16'),
(17,	'châu 123',	'folder',	3,	'node 17'),
(18,	'testset',	'folder',	3,	'node 18'),
(19,	't1',	'folder',	18,	'node 19'),
(20,	't2',	'folder',	19,	'node 20'),
(21,	'New node',	'folder',	13,	'node 21'),
(22,	'hỏi ngã nặng',	'folder',	19,	'adsf'),
(23,	'12312',	'folder',	11,	NULL);

-- 2021-10-15 16:57:22