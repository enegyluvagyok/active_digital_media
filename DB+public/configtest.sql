-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2023. Máj 03. 22:43
-- Kiszolgáló verziója: 5.7.36
-- PHP verzió: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `configtest`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `publish_start` datetime DEFAULT NULL,
  `publish_end` datetime DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `view` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `parameters` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `intro`, `content`, `publish_start`, `publish_end`, `hits`, `view`, `active`, `parameters`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Beetle', 'beetle-1', 'Beetle', '<p>Beetle</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:02:47', '2023-05-03 13:02:47', '/storage/images/RsTDovyg9cGqv16W0XZooj8to0SUCBlEbB6rQKjH.png'),
(3, 'Puma', 'puma-3', 'Puma', '<p>Puma</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:05:39', '2023-05-03 13:05:39', '/storage/images/0FAK8ZOkw1sMTvJcaIGFzqj7IVPXUGi1475M1W5i.png'),
(4, 'Pony', 'pony-4', 'Pony', '<p>Pony</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:06:20', '2023-05-03 13:06:20', '/storage/images/HlaLeVUxQpjUixJesCTorX27AQrtrQMr3zCxvPdS.png'),
(5, 'Horse', 'horse-5', 'Horse', '<p>Horse</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:06:58', '2023-05-03 13:06:58', '/storage/images/9FeantQHYM2jGUOzolWrRoInpUv1YJfctLxnJwru.png'),
(6, 'Ostrich', 'ostrich-6', 'Ostrich', '<p>Ostrich</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:07:31', '2023-05-03 13:07:31', '/storage/images/xPHrTwI9BkFtm6jeWQk69m2t5AcKtPnOdXrQgmpm.png'),
(7, 'Centipede', 'centipede-7', 'Centipede', '<p>Centipede</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:08:16', '2023-05-03 13:08:16', '/storage/images/9hqsbeYBpDhNHW9WxxIrvNczAkwERQGpMXi4wDWK.png'),
(8, 'Locust', 'locust-8', 'Locust', '<p>Locust</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:09:00', '2023-05-03 13:09:00', '/storage/images/uxhgQyyUU2zZqJWz0yWiHcSTpnTv8tXAaWmx3rs3.png'),
(9, 'Chick', 'chick-9', 'Chick', '<p>Chick</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:09:29', '2023-05-03 13:09:29', '/storage/images/Dpvw8XLAUFJKfYgyYcKxzxgrSCAg9RLOFz18AwnT.png'),
(10, 'Cattle', 'cattle-10', 'Cattle', '<p>Cattle</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:09:54', '2023-05-03 13:09:54', '/storage/images/TAzntSWXSQlLRXxGJmXgbugrXTovHuDC9PWF0PeG.png'),
(11, 'Cat', 'cat-11', 'Cat', '<p>Cat</p>', NULL, NULL, 0, NULL, 1, NULL, '2023-05-03 13:43:43', '2023-05-03 13:43:43', '/storage/images/4yfBuUhXGl1i7Us34xToFKRvlXnjPrKUQH9aTD8O.png'),
(15, 'Json1', 'json1-15', 'Json1', '<p>Json1</p>', NULL, NULL, 0, NULL, 1, '{\"category\":[\"3\"],\"sort_by\":\"publish_start\",\"show_image\":\"false\",\"show_category\":\"true\",\"limit\":\"5\",\"date\":{\"start\":\"2023-05-03\",\"end\":\"2023-05-19\"}}', '2023-05-03 19:14:08', '2023-05-03 19:14:08', NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `article_to_categories`
--

DROP TABLE IF EXISTS `article_to_categories`;
CREATE TABLE IF NOT EXISTS `article_to_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `_lft` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `_rgt` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_to_categories_article_id_category_id_unique` (`article_id`,`category_id`),
  KEY `article_to_categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`),
  KEY `article_to_categories_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `article_to_categories`
--

INSERT INTO `article_to_categories` (`id`, `article_id`, `category_id`, `_lft`, `_rgt`, `parent_id`) VALUES
(1, 0, 1, 1, 28, NULL),
(2, 0, 2, 29, 38, NULL),
(3, 0, 3, 2, 15, 1),
(4, 0, 4, 16, 21, 1),
(5, 0, 5, 30, 37, 2),
(6, 1, 3, 3, 4, 3),
(8, 3, 3, 7, 8, 3),
(9, 4, 3, 9, 10, 3),
(10, 5, 3, 11, 12, 3),
(11, 6, 4, 17, 18, 4),
(12, 7, 4, 19, 20, 4),
(13, 8, 5, 31, 32, 5),
(14, 9, 5, 33, 34, 5),
(15, 10, 5, 35, 36, 5),
(16, 11, 3, 13, 14, 3),
(19, 15, 1, 26, 27, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `description`, `active`, `parameters`) VALUES
(1, 'Main1', 'main1-1', '<p>Main1</p>', 1, NULL),
(2, 'Main2', 'main2-2', '<p>Main2</p>', 1, NULL),
(3, 'Sub1', 'sub1-3', '<p>Sub1</p>', 1, NULL),
(4, 'Sub2', 'sub2-4', '<p>Sub2</p>', 1, NULL),
(5, 'Sub3', 'sub3-5', '<p>Sub3</p>', 1, NULL);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
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
-- Tábla szerkezet ehhez a táblához `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(23, '2014_10_12_000000_create_users_table', 1),
(24, '2014_10_12_100000_create_password_resets_table', 1),
(25, '2018_06_19_152056_create_articles_table', 1),
(26, '2018_06_19_152112_create_categories_table', 1),
(27, '2018_06_19_154952_create_article_to_categories_table', 1),
(28, '2019_08_19_000000_create_failed_jobs_table', 1),
(29, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(30, '2023_05_01_124113_add_role_column_to_users_table', 1),
(31, '2023_05_01_200934_add_image_column_to_articles_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2a$12$VhGgbIZIoX54a61Vwbpavu.AVrJ/NU3EHM.7nTiS6nHHqx8yycDcK', NULL, NULL, NULL, 1),
(2, 'Editor', 'editor@editor.com', NULL, '$2a$12$.2yl2R53kpjbL.8VaD7DeeN6DYkG44NnKm/CXjX5PWyS4.1JaPh8O', NULL, NULL, NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
