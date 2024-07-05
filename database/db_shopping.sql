-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 09, 2024 at 03:29 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Dessert', 'Description1', '2024-05-20 07:36:53', '2024-05-24 08:30:06'),
(2, 'Foods', 'Description2', '2024-05-20 07:37:01', '2024-05-24 08:29:52'),
(3, 'Drinks', 'Description3', '2024-05-20 07:37:11', '2024-05-24 08:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_18_082448_create_categories_table', 2),
(6, '2024_05_20_085647_create_products_table', 3),
(7, '2024_05_23_040946_create_user_verifies_table', 4),
(8, '2024_05_25_072456_create_orders_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` bigint NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_userid_foreign` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `orderId` bigint NOT NULL,
  `proId` bigint NOT NULL,
  `quantity` tinyint NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_orderid_foreign` (`orderId`),
  KEY `order_items_proid_foreign` (`proId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `catId` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_catid_foreign` (`catId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `catId`, `created_at`, `updated_at`) VALUES
(5, 'Sting', 'Sting Energy (or Sting) is a carbonated energy drink produced by Rockstar Inc. (acquired by PepsiCo in 2020). Sting is available in flavors such as the original Gold Rush, Gold (with Ginseng), Power Pacq (Gold Rush with Malunggay), Power Lime (Kiwifruit/Lime), Berry Blast (Strawberry) and blue thunder (blue raspberry)', 1.20, '20240521-060748-sting1.jpg', 3, '2024-05-20 23:07:48', '2024-05-20 23:07:48'),
(2, 'Green Tea', 'Green tea is a type of tea that is made from Camellia sinensis leaves and buds that have not undergone the same withering and oxidation process which is used to make oolong teas and black teas.', 2.30, '20240521-011121-green Tea.jpg', 3, '2024-05-20 18:11:21', '2024-05-20 18:11:21'),
(4, 'Fanta', 'Fanta is an American-owned brand of fruit-flavored carbonated soft drink created by Coca-Cola Deutschland under the leadership of German businessman Max Keith. There are more than 200 flavors worldwide. Fanta originated in Germany as a Coca-Cola alternative in 1941 due to the American trade embargo of Nazi Germany, which affected the availability of Coca-Cola ingredients.', 1.40, '20240524-153758-Fanta.jpg', 3, '2024-05-20 23:05:33', '2024-05-24 08:37:58'),
(6, 'Milk Tea', 'Milk tea refers to several forms of beverage found in many cultures, consisting of some combination of tea and milk. The term milk tea is used for both hot and cold drinks that can be combined with various kinds of milks and a variety of spices. This is a popular way to serve tea in many countries, and is the default type of tea in many South Asian countries', 2.60, '20240524-153819-Milk Tea.jpg', 3, '2024-05-20 23:08:34', '2024-05-24 08:38:19'),
(7, 'coca-cola', 'Coca is any of the four cultivated plants in the family Erythroxylaceae, native to western South America. Coca is known worldwide for its psychoactive alkaloid', 1.34, '20240524-153740-coca1.jpg', 3, '2024-05-23 18:16:47', '2024-05-24 08:37:40'),
(8, 'Orange Juice', 'Orange juice is a liquid extract of the orange tree fruit, produced by squeezing or reaming oranges. It comes in several different varieties, including blood orange, navel oranges, valencia orange, clementine, and tangerine. As well as variations in oranges used, some varieties include differing amounts of juice vesicles, known as \"pulp\" in American English,', 2.45, '20240524-153719-orange-juice.jpg', 3, '2024-05-23 18:18:12', '2024-05-24 08:37:19'),
(9, 'Stickalicious Foods', 'Im cursed. In july 2009 numerous of flies of different sizes appeared in the bed room next to mine for 3 days. regularly i kill your complete flies to solely have more return mintues later. On the third i bought fly spay and sprayed the room, the didnt come back after that. nonetheless, now massive brown roaches are bitting me on my head, my arms, all over whereas im asleep', 12.50, '20240524-153540-th.jpg', 2, '2024-05-24 08:35:40', '2024-05-24 08:35:40'),
(10, 'Biscuit Strawberry Shortcake', 'This biscuit strawberry shortcake is the perfect ending to any meal. Homemade biscuits and fresh berries shine in this classic dessert. —Stephanie Moon, Boise, Idaho', 5.78, '20240524-154327-th (2).jpg', 1, '2024-05-24 08:43:27', '2024-05-24 08:43:27'),
(11, 'Chocolate Peanut Butter', 'Who doesn\'t like this dessert duo? Add your favorite combination of candies to garnish the tops of these chocolate peanut butter dream bars. —Cindi DeClue, Anchorage, Alaska', 6.29, '20240524-154416-th (1).jpg', 1, '2024-05-24 08:44:16', '2024-05-24 08:44:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `comfirmed` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `admin`, `comfirmed`, `active`, `remember_token`, `created_at`, `updated_at`, `is_email_verified`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$yUPxZxx3BFCQ.7otm592Au8VtZ9O9t4EyH2cpU9vtMyHWlynNLuau', 0, 0, 0, NULL, '2024-05-23 07:28:42', '2024-05-23 07:34:13', 1),
(2, 'Dara', 'dara123@gmail.com', NULL, '$2y$10$eoDJAjokO/6gT6dsP.uQpuk1hE1uIAkCuXbjS/9WrgZRM64y90dC6', 0, 0, 0, 'fJxGK3Ax9BYjwvilLxaJyXtlHPleRplkpTTwtcnAzapND8eoBrmElm4tk1Xr', '2024-05-23 07:32:49', '2024-05-23 18:12:50', 1),
(3, 'Koko', 'Koko@gmail.com', NULL, '$2y$10$vw7pnLFap59uapNw8ou3DuzzbRBSxk/8eIXLe5weo.IupMRjoD1b6', 0, 0, 0, NULL, '2024-06-07 03:09:02', '2024-06-07 03:09:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_verifies`
--

DROP TABLE IF EXISTS `user_verifies`;
CREATE TABLE IF NOT EXISTS `user_verifies` (
  `user_id` int NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_verifies`
--

INSERT INTO `user_verifies` (`user_id`, `token`, `created_at`, `updated_at`) VALUES
(1, 'jdVWRUogalF8WqVdZeiu9r7vFZbeogTIvj7KG1vhsOsOJGZAiKcGTUTyoSOGc7Lh', '2024-05-23 07:28:42', '2024-05-23 07:28:42'),
(2, 'Z8ag4aBOLauUa7n6LZvVztAjESLjqY6ZyDJvxgBvzmjEPsdTUHM4cSRvGEQDjMzs', '2024-05-23 07:32:49', '2024-05-23 07:32:49'),
(3, 'Qoxu9dWS7W1M0KGdFbl1huI3jKoAHb6jWKbPTzFSwYASsttQnHLl9wSxPkSBlm9q', '2024-06-07 03:09:02', '2024-06-07 03:09:02');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
