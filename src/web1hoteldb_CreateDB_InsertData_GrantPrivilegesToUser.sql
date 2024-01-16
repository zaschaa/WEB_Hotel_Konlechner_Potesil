-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server-Version:               10.4.28-MariaDB - mariadb.org binary distribution
-- Server-Betriebssystem:        Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Exportiere Datenbank-Struktur für web1hoteldb
CREATE DATABASE IF NOT EXISTS `web1hoteldb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `web1hoteldb`;

-- Exportiere Struktur von Tabelle web1hoteldb.bed_types
CREATE TABLE IF NOT EXISTS `bed_types` (
  `id` int(11) NOT NULL,
  `bed_type_name` varchar(50) NOT NULL,
  `width_cm` int(11) NOT NULL,
  `length_cm` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportiere Daten aus Tabelle web1hoteldb.bed_types: ~3 rows (ungefähr)
INSERT INTO `bed_types` (`id`, `bed_type_name`, `width_cm`, `length_cm`) VALUES
	(1, 'comfort', 140, 200),
	(2, 'queen-size', 160, 200),
	(3, 'king-size', 200, 220);

-- Exportiere Struktur von Tabelle web1hoteldb.charged_options
CREATE TABLE IF NOT EXISTS `charged_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(50) NOT NULL,
  `price_per_unit_eur` float NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportiere Daten aus Tabelle web1hoteldb.charged_options: ~4 rows (ungefähr)
INSERT INTO `charged_options` (`id`, `option_name`, `price_per_unit_eur`) VALUES
	(1, 'beer_from_minibar_0.33l', 8),
	(2, 'pet', 50),
	(3, 'breakfast', 22.4),
	(4, 'parking lot', 75);

-- Exportiere Struktur von Tabelle web1hoteldb.news_articles
CREATE TABLE IF NOT EXISTS `news_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `headline` varchar(80) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_news_user_id` (`user_id`) USING BTREE,
  CONSTRAINT `FK_news_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportiere Daten aus Tabelle web1hoteldb.news_articles: ~2 rows (ungefähr)
INSERT INTO `news_articles` (`id`, `user_id`, `headline`, `description`, `image_path`, `thumbnail_path`, `created_at`) VALUES
	(1, 2, 'Frohe Weihnachten!', 'Wir wünschen schöne Feiertage!', 'uploads/christmas_tree.jpg', 'thumbnails/thumbnail_christmas_tree.jpg', '2023-12-21 23:19:52'),
	(2, 2, 'Die Ballsaison ist eröffnet!', 'Die Wiener Bälle laden zum Tanz ein!', 'uploads/taenzer.jpg', 'thumbnails/thumbnail_taenzer.jpg', '2024-01-09 00:17:01');

-- Exportiere Struktur von Tabelle web1hoteldb.reservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `number_of_persons` int(11) NOT NULL,
  `has_breakfast` tinyint(1) NOT NULL,
  `number_of_parking_lots` int(11) NOT NULL,
  `number_of_pets` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `state` enum('new','confirmed','cancelled') NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_user_id` (`user_id`) USING BTREE,
  KEY `FK_room_id` (`room_id`) USING BTREE,
  CONSTRAINT `FK_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  CONSTRAINT `FK_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chk_end_date` CHECK (`end_date` >= `start_date`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportiere Daten aus Tabelle web1hoteldb.reservations: ~6 rows (ungefähr)
INSERT INTO `reservations` (`id`, `user_id`, `room_id`, `start_date`, `end_date`, `number_of_persons`, `has_breakfast`, `number_of_parking_lots`, `number_of_pets`, `comment`, `state`, `created_at`) VALUES
	(1, 1, 39, '2024-01-20', '2024-01-27', 5, 1, 1, 0, NULL, 'confirmed', '2024-01-13 19:25:23'),
	(2, 1, 43, '2024-01-14', '2024-01-19', 5, 1, 1, 0, 'Sehr geehrte Damen und Herren! Ich bitte täglich um Punkt 19 Uhr eine Flasche Single Malt Scotch Whiskey auf mein Zimmer bringen zu lassen. Herzlichen Dank! Mit besten Grüßen, Prof. Dr. Max Meier', 'cancelled', '2024-01-14 15:47:57'),
	(3, 1, 6, '2024-01-28', '2024-02-03', 3, 1, 0, 0, '', 'new', '2024-01-14 15:55:51'),
	(4, 1, 12, '2024-02-01', '2024-02-10', 2, 1, 1, 0, '', 'new', '2024-01-14 23:02:51'),
	(5, 2, 40, '2024-01-15', '2024-01-21', 1, 0, 1, 0, 'I&#039;m the boss! :-)', 'confirmed', '2024-01-15 02:20:26'),
	(6, 1, 43, '2024-01-23', '2024-01-25', 5, 1, 1, 0, 'Hello World!', 'new', '2024-01-15 17:11:16');

-- Exportiere Struktur von Tabelle web1hoteldb.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_room_type` (`room_type`) USING BTREE,
  CONSTRAINT `FK_room_type` FOREIGN KEY (`room_type`) REFERENCES `room_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportiere Daten aus Tabelle web1hoteldb.rooms: ~43 rows (ungefähr)
INSERT INTO `rooms` (`id`, `room_number`, `room_type`, `capacity`) VALUES
	(1, 101, 1, 1),
	(2, 102, 1, 2),
	(3, 103, 1, 2),
	(4, 104, 1, 2),
	(5, 105, 1, 2),
	(6, 106, 1, 3),
	(7, 107, 1, 3),
	(8, 108, 2, 2),
	(9, 109, 2, 3),
	(10, 110, 2, 3),
	(11, 111, 2, 4),
	(12, 112, 3, 3),
	(13, 113, 3, 4),
	(14, 201, 1, 1),
	(15, 202, 1, 2),
	(16, 203, 1, 2),
	(17, 204, 1, 2),
	(18, 205, 1, 2),
	(19, 206, 1, 3),
	(20, 207, 1, 3),
	(21, 208, 2, 2),
	(22, 209, 2, 3),
	(23, 210, 2, 3),
	(24, 211, 2, 4),
	(25, 212, 3, 2),
	(26, 213, 3, 3),
	(27, 301, 1, 1),
	(28, 302, 1, 2),
	(29, 303, 1, 2),
	(30, 304, 1, 2),
	(31, 305, 1, 2),
	(32, 306, 1, 3),
	(33, 307, 1, 3),
	(34, 308, 2, 2),
	(35, 309, 2, 3),
	(36, 310, 2, 3),
	(37, 311, 2, 4),
	(38, 312, 3, 3),
	(39, 313, 3, 5),
	(40, 401, 4, 3),
	(41, 402, 4, 3),
	(42, 403, 4, 4),
	(43, 404, 4, 6);

-- Exportiere Struktur von Tabelle web1hoteldb.room_types
CREATE TABLE IF NOT EXISTS `room_types` (
  `id` int(11) NOT NULL,
  `room_type_name` varchar(50) NOT NULL,
  `pic_filepath_name` varchar(50) NOT NULL,
  `room_size_range_square_meters` varchar(10) NOT NULL,
  `bed_type` int(11) NOT NULL,
  `has_minibar` tinyint(1) NOT NULL,
  `price_per_person_per_night_eur` float NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_bed_type` (`bed_type`) USING BTREE,
  CONSTRAINT `FK_bed_type` FOREIGN KEY (`bed_type`) REFERENCES `bed_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportiere Daten aus Tabelle web1hoteldb.room_types: ~4 rows (ungefähr)
INSERT INTO `room_types` (`id`, `room_type_name`, `pic_filepath_name`, `room_size_range_square_meters`, `bed_type`, `has_minibar`, `price_per_person_per_night_eur`) VALUES
	(1, 'Deluxe Zimmer', 'deluxe_room', '27-39', 1, 0, 300),
	(2, 'Junior Suite', 'junior_suite', '40-55', 2, 1, 550),
	(3, 'Signature Suite', 'signature_suite', '50-65', 3, 1, 800),
	(4, 'Grand Suite', 'grand_suite', '> 95', 3, 1, 1400);

-- Exportiere Struktur von Tabelle web1hoteldb.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `sex` enum('Keine','Herr','Frau') NOT NULL DEFAULT 'Keine',
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_user_inactive` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `idx_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Exportiere Daten aus Tabelle web1hoteldb.users: ~2 rows (ungefähr)
INSERT INTO `users` (`id`, `username`, `password`, `sex`, `firstname`, `lastname`, `email`, `is_admin`, `is_user_inactive`) VALUES
	(1, 'maxim', '$2y$10$5gbnNwXMXJgVNjgB8M14beW.QfGgiMl7/8MvrNJePhuA.WEdPwozS', 'Herr', 'Max', 'Meier', 'max@meier.at', 0, 0),
	(2, 'admin', '$2y$10$EDDkpyGs3izycQrfP/XFZela9Ua8HMqpNguFNpJt7wy3AgAlhgZj6', 'Herr', 'Admin', 'LeBoss', 'chef.admin@mailmail.com', 1, 0);
	
GRANT USAGE ON *.* TO `web1hotel`@`localhost` IDENTIFIED BY PASSWORD '*18CD2CB5E347AB6868B222D9EC5AD27C57DCE92C';

GRANT ALL PRIVILEGES ON `web1hoteldb`.* TO `web1hotel`@`localhost`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
