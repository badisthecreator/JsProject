-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for book_shop
DROP DATABASE IF EXISTS `book_shop`;
CREATE DATABASE IF NOT EXISTS `book_shop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `book_shop`;

-- Dumping structure for table book_shop.cart
DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `quantity` int NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table book_shop.cart: ~0 rows (approximately)

-- Dumping structure for table book_shop.message
DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `message` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table book_shop.message: ~0 rows (approximately)
INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
	(1, 2, 'youssef', 'youssef@gmail.com', '00000000', 'i wonder when my books will arrive!');

-- Dumping structure for table book_shop.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(500) NOT NULL,
  `total_price` int NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table book_shop.orders: ~0 rows (approximately)
INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
	(1, 2, 'youssef', '00000000', 'youssef@gmail.com', 'cash on delivery', 'flat no. 01, 01, tunis, Tunisia - 123456', ', Psycho (1) , Jaws (2) , The Grapes of Wrath (2) ', 148, '18-May-2026', 'completed'),
	(2, 3, 'insaf', '00000000', 'insaf@gmail.com', 'cash on delivery', 'flat no. 01, 01, elkef, tunis - 202020', ',  Pride and Prejudice (1) , I Know Why the Caged Bird Sings (1) ,  A Clockwork Orange (1) ', 70, '18-May-2026', 'pending');

-- Dumping structure for table book_shop.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table book_shop.products: ~11 rows (approximately)
INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
	(5, ' Pride and Prejudice', 20, '1_Pride_and_Prejudice.jpg'),
	(6, 'Psycho', 60, '2_Psycho.jpg'),
	(8, 'The Godfather', 69, '4_The_Godfather.jpg'),
	(9, 'I Know Why the Caged Bird Sings', 19, '3_I_Know_Why_the_Caged_Bird_Sings.jpg'),
	(10, ' A Clockwork Orange', 31, '5_ A_Clockwork_Orange.jpg'),
	(11, 'Jaws', 24, '6_Jaws.png'),
	(12, ' Song of Solomon', 20, '7_Song_of_Solomon.jpg'),
	(13, 'The Grapes of Wrath', 20, '8_The_Grapes_of_Wrath.jpg'),
	(14, 'To the Lighthouse', 89, '9_To_the_Lighthouse.jpg'),
	(15, 'The Unbearable Lightness of Being', 80, '10_The_Unbearable_Lightness_of_Being.jpg'),
	(16, ' The Color Purple', 40, '11_The_Color_Purple.jpg');

-- Dumping structure for table book_shop.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table book_shop.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
	(1, 'badis', 'badis@gmail.com', 'd0af6d82c1d5de564a85f11edc039528', 'admin'),
	(2, 'youssef', 'youssef@gmail.com', '1c718d0021c07927241294be36b6d54b', 'user'),
	(3, 'insaf', 'insaf@gmail.com', '41d361c079a85d44a6329af19e533d37', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
