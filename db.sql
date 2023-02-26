-- Adminer 4.8.1 MySQL 5.7.21 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `news_db`;
CREATE DATABASE `news_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `news_db`;

DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`author_id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `author` (`author_id`, `name`, `created_at`) VALUES
(1,	'Jacek',	'2023-02-24 16:28:51'),
(2,	'Agatka',	'2023-02-24 16:28:54'),
(3,	'Jaś',	'2023-02-24 16:28:56'),
(4,	'Małgosia',	'2023-02-24 16:29:01')
ON DUPLICATE KEY UPDATE `author_id` = VALUES(`author_id`), `name` = VALUES(`name`), `created_at` = VALUES(`created_at`);

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `text` text COLLATE utf8_polish_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `news` (`news_id`, `title`, `text`, `created_at`, `edited_at`) VALUES
(1,	'Pierwszy',	'To jest pierwszy artykuł',	'2023-02-24 16:29:29',	'2023-02-24 16:29:29'),
(2,	'Drugi',	'To jest drugi artykuł',	'2023-02-24 16:29:38',	'2023-02-24 16:29:38'),
(3,	'Trzeci',	'To jest trzeci artykuł',	'2023-02-24 16:29:58',	'2023-02-24 16:29:58'),
(4,	'Czwarty',	'To jest czwarty artykuł',	'2023-02-24 16:30:16',	'2023-02-24 16:31:16'),
(5,	'Piąty',	'To jest piąty artykuł',	'2023-02-24 16:30:29',	'2023-02-24 16:30:29'),
(6,	'Szósty',	'To jest szósty artykuł',	'2023-02-24 16:30:45',	'2023-02-24 16:30:45')
ON DUPLICATE KEY UPDATE `news_id` = VALUES(`news_id`), `title` = VALUES(`title`), `text` = VALUES(`text`), `created_at` = VALUES(`created_at`), `edited_at` = VALUES(`edited_at`);

DROP TABLE IF EXISTS `news_author`;
CREATE TABLE `news_author` (
  `author_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`author_id`,`news_id`),
  KEY `fk_author_has_news` (`news_id`),
  KEY `fk_author_has_news2` (`author_id`),
  CONSTRAINT `fk_author_has_news` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_author_has_news2` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

INSERT INTO `news_author` (`author_id`, `news_id`) VALUES
(1,	1),
(1,	2),
(2,	2),
(2,	3),
(3,	3),
(3,	4),
(1,	5),
(1,	6)
ON DUPLICATE KEY UPDATE `author_id` = VALUES(`author_id`), `news_id` = VALUES(`news_id`);

-- 2023-02-25 14:04:58