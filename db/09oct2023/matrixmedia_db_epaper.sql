-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2023 at 12:41 PM
-- Server version: 5.7.42
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matrixmedia_db_epaper`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_date` date NOT NULL,
  `slot` enum('M','E') NOT NULL COMMENT 'M=>Morning,E=>Evening\r\n',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>published,0=>unpublished\r\n',
  `created_by` int(11) NOT NULL COMMENT 'Primary key of users table\r\n',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_date`, `slot`, `published`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2023-06-15', 'M', 0, 1, '2023-05-30 23:56:04', '2023-06-06 04:04:08', '2023-06-06 04:04:08'),
(2, '2023-06-20', 'M', 1, 1, '2023-05-31 00:12:50', '2023-06-21 00:26:00', NULL),
(3, '2023-06-14', 'M', 0, 1, '2023-06-01 04:10:44', '2023-06-01 04:10:44', NULL),
(4, '2023-06-08', 'M', 1, 6, '2023-06-05 01:55:38', '2023-06-21 00:34:21', NULL),
(5, '2023-06-09', 'M', 0, 6, '2023-06-05 02:16:03', '2023-06-05 02:16:03', NULL),
(6, '2023-06-06', 'M', 1, 1, '2023-06-06 03:53:41', '2023-06-21 00:30:14', NULL),
(7, '2023-06-15', 'M', 0, 1, '2023-06-06 04:04:36', '2023-06-06 04:04:36', NULL),
(8, '2023-06-16', 'M', 0, 1, '2023-06-06 04:21:29', '2023-06-19 13:41:24', NULL),
(9, '2023-06-22', 'M', 0, 1, '2023-06-06 04:27:49', '2023-06-06 08:41:46', NULL),
(10, '2023-06-02', 'M', 0, 1, '2023-06-09 01:05:27', '2023-06-09 01:05:27', NULL),
(11, '2023-06-21', 'M', 1, 1, '2023-06-21 02:25:00', '2023-06-23 02:41:21', NULL),
(12, '2023-07-01', 'M', 0, 1, '2023-06-21 05:40:16', '2023-06-21 05:40:16', NULL),
(13, '2023-10-04', 'M', 0, 1, '2023-10-04 07:20:25', '2023-10-04 07:20:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news_bkp29may2023`
--

CREATE TABLE `news_bkp29may2023` (
  `id` int(11) NOT NULL,
  `news_date` date NOT NULL,
  `slot` enum('M','E') NOT NULL COMMENT 'M=>Morning,E=>Evening\r\n',
  `published` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=>published,0=>unpublished\r\n',
  `created_by` int(11) NOT NULL COMMENT 'Primary key of users table\r\n',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Actve,0=Inactive\r\n',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Not deleted,1=deleted\r\n',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL COMMENT 'primary key of news table\r\n',
  `page_number` int(11) NOT NULL,
  `page_preview` varchar(255) DEFAULT NULL,
  `page_add_date` date NOT NULL,
  `template` text NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Primary key of users table\r\n',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `news_id`, `page_number`, `page_preview`, `page_add_date`, `template`, `created_by`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, '', '2023-05-31', '<!-- wp:image {\"id\":1685540439044,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1685540438.webp\" alt=\"\" class=\"wp-image-1685540439044\"/></figure><!-- /wp:image -->', 1, 1, '2023-05-31 08:21:20', '2023-06-01 05:52:55', '2023-06-01 05:52:55'),
(2, 2, 4, '', '2023-06-01', '<!-- wp:image {\"id\":1685596442446,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers2_1685596442.webp\" alt=\"\" class=\"wp-image-1685596442446\"/></figure><!-- /wp:image -->', 1, 1, '2023-05-31 23:44:12', '2023-06-01 01:56:56', '2023-06-01 01:56:56'),
(3, 2, 1, '1687326780.png', '2023-06-01', '<!-- wp:image {\"id\":1685599141306,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers4_1685599140.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1685599140.webp\" alt=\"\" class=\"wp-image-1685599141306\"/></a></figure><!-- /wp:image -->', 1, 1, '2023-06-01 00:29:03', '2023-06-21 00:23:17', NULL),
(4, 2, 5, '', '2023-06-01', '<!-- wp:image {\"id\":1685599485796,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers7_1685599483.webp\" alt=\"\" class=\"wp-image-1685599485796\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 00:34:47', '2023-06-01 10:42:54', '2023-06-01 01:56:39'),
(5, 1, 2, '', '2023-06-01', '<!-- wp:image {\"id\":1685604996602,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers6_1685604996.webp\" alt=\"\" class=\"wp-image-1685604996602\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 02:07:10', '2023-06-01 02:07:10', NULL),
(6, 2, 3, '1687326892.png', '2023-06-01', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"30%\"} --><div class=\"wp-block-column\" style=\"flex-basis:30%\"><!-- wp:image {\"id\":1687326864690,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1687326864.webp\" alt=\"\" class=\"wp-image-1687326864690\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1687326880874,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers7_1687326878.webp\" alt=\"\" class=\"wp-image-1687326880874\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-01 02:07:43', '2023-06-21 00:24:52', NULL),
(7, 2, 2, '', '2023-06-01', '<!-- wp:image {\"id\":1685617811369,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization1_1685617811.webp\" alt=\"\" class=\"wp-image-1685617811369\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 05:40:13', '2023-06-01 05:53:03', '2023-06-01 05:53:03'),
(8, 2, 2, '1687326823.jpg', '2023-06-01', '<!-- wp:image {\"id\":1685618402195,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers1_1685618402.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1685618402.webp\" alt=\"\" class=\"wp-image-1685618402195\"/></a></figure><!-- /wp:image -->', 1, 1, '2023-06-01 05:52:51', '2023-06-21 00:23:43', NULL),
(9, 3, 4, '', '2023-06-01', '<!-- wp:image {\"id\":1685618820500,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1685618820.webp\" alt=\"\" class=\"wp-image-1685618820500\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 05:57:02', '2023-06-01 05:57:13', NULL),
(10, 2, 4, '1687326937.jpg', '2023-06-01', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685626136697,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1685626136.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1685626136.webp\" alt=\"\" class=\"wp-image-1685626136697\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685626147297,\"width\":339,\"height\":212,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full is-resized\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers4_1685626146.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1685626146.webp\" alt=\"\" class=\"wp-image-1685626147297\" width=\"339\" height=\"212\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685626189164,\"width\":317,\"height\":210,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full is-resized\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers3_1685626189.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers3_1685626189.webp\" alt=\"\" class=\"wp-image-1685626189164\" width=\"317\" height=\"210\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-01 08:00:13', '2023-06-21 00:25:37', NULL),
(11, 1, 7, '', '2023-06-02', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685698021794,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1685698020.webp\" alt=\"\" class=\"wp-image-1685698021794\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685698037947,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization1_1685698037.webp\" alt=\"\" class=\"wp-image-1685698037947\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685698046843,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1685698046.webp\" alt=\"\" class=\"wp-image-1685698046843\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-02 03:57:28', '2023-06-02 03:57:28', NULL),
(12, 4, 4, '1686288971.jpg', '2023-06-05', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1685949968636,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1685949967.webp\" alt=\"\" class=\"wp-image-1685949968636\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1685949983476,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1685949983.webp\" alt=\"\" class=\"wp-image-1685949983476\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-05 01:56:27', '2023-06-21 00:32:35', NULL),
(13, 3, 2, '', '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686042628605,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686042628.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686042628.webp\" alt=\"\" class=\"wp-image-1686042628605\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686042638608,\"width\":445,\"height\":556,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full is-resized\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers6_1686042638.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers6_1686042638.webp\" alt=\"\" class=\"wp-image-1686042638608\" width=\"445\" height=\"556\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 03:41:20', '2023-06-06 03:41:20', NULL),
(14, 8, 1, '1687167355.jpg', '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686045111571,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers5_1686045110.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers5_1686045110.webp\" alt=\"\" class=\"wp-image-1686045111571\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686045120145,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686045119.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686045119.webp\" alt=\"\" class=\"wp-image-1686045120145\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 04:22:04', '2023-06-19 04:05:55', NULL),
(15, 9, 1, '', '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686045496355,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686045495.webp\" alt=\"\" class=\"wp-image-1686045496355\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686045507707,\"width\":560,\"height\":426,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full is-resized\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization1_1686045507.webp\" alt=\"\" class=\"wp-image-1686045507707\" width=\"560\" height=\"426\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 04:28:48', '2023-06-07 07:07:12', NULL),
(16, 9, 2, '', '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686045605118,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers7_1686045602.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers7_1686045602.webp\" alt=\"\" class=\"wp-image-1686045605118\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686045615342,\"width\":589,\"height\":369,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full is-resized\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers4_1686045614.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1686045614.webp\" alt=\"\" class=\"wp-image-1686045615342\" width=\"589\" height=\"369\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 04:30:29', '2023-06-06 04:30:48', NULL),
(17, 9, 3, NULL, '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686045747568,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers4_1686045746.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1686045746.webp\" alt=\"\" class=\"wp-image-1686045747568\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686045755415,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers3_1686045755.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers3_1686045755.webp\" alt=\"\" class=\"wp-image-1686045755415\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 04:32:36', '2023-06-07 08:09:13', NULL),
(18, 9, 4, '1686141307.jpg', '2023-06-07', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686139232424,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers2_1686139232.webp\" alt=\"\" class=\"wp-image-1686139232424\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686139242097,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1686139241.webp\" alt=\"\" class=\"wp-image-1686139242097\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-07 06:36:45', '2023-06-07 07:57:15', NULL),
(19, 4, 2, '1686289053.jpg', '2023-06-09', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686289003850,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1686289002.webp\" alt=\"\" class=\"wp-image-1686289003850\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686289013222,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers2_1686289013.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers2_1686289013.webp\" alt=\"\" class=\"wp-image-1686289013222\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-09 00:07:33', '2023-06-21 06:28:46', NULL),
(20, 4, 1, '1686289111.png', '2023-06-09', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686289086673,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers3_1686289086.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers3_1686289086.webp\" alt=\"\" class=\"wp-image-1686289086673\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686289096545,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers1_1686289096.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1686289096.webp\" alt=\"\" class=\"wp-image-1686289096545\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-09 00:08:31', '2023-06-21 06:28:58', NULL),
(21, 10, 1, '1686292891.jpg', '2023-06-09', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686292877297,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686292876.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686292876.webp\" alt=\"\" class=\"wp-image-1686292877297\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-09 01:11:31', '2023-06-09 01:11:31', NULL),
(22, 10, 2, '1686292952.jpg', '2023-06-09', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686292935239,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers2_1686292935.webp\" alt=\"\" class=\"wp-image-1686292935239\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686292945024,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1686292944.webp\" alt=\"\" class=\"wp-image-1686292945024\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-09 01:12:32', '2023-06-09 01:12:32', NULL),
(23, 6, 1, '1686308197.jpg', '2023-06-09', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"30%\"} --><div class=\"wp-block-column\" style=\"flex-basis:30%\"><!-- wp:image {\"id\":1686308142883,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers3_1686308142.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers3_1686308142.webp\" alt=\"\" class=\"wp-image-1686308142883\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686308152222,\"width\":627,\"height\":418,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full is-resized\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers1_1686308152.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1686308152.webp\" alt=\"\" class=\"wp-image-1686308152222\" width=\"627\" height=\"418\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-09 05:26:37', '2023-06-09 05:27:21', NULL),
(24, 6, 2, '1686308358.jpg', '2023-06-09', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"35%\"} --><div class=\"wp-block-column\" style=\"flex-basis:35%\"><!-- wp:image {\"id\":1686308336339,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers2_1686308336.webp\" alt=\"\" class=\"wp-image-1686308336339\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686308344578,\"width\":698,\"height\":464,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full is-resized\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1686308344.webp\" alt=\"\" class=\"wp-image-1686308344578\" width=\"698\" height=\"464\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-09 05:29:18', '2023-06-09 05:29:18', NULL),
(25, 11, 1, '1687334522.png', '2023-06-21', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687334251157,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-head_1687166376_1687334251.webp\" alt=\"\" class=\"wp-image-1687334251157\"/></figure><!-- /wp:image --><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"10%\"} --><div class=\"wp-block-column\" style=\"flex-basis:10%\"><!-- wp:image {\"id\":1687334405624,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/news-1_1687166465_1687334405.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-1_1687166465_1687334405.webp\" alt=\"\" class=\"wp-image-1687334405624\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687334423776,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/news-2_1687166516_1687334423.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-2_1687166516_1687334423.webp\" alt=\"\" class=\"wp-image-1687334423776\"/></a></figure><!-- /wp:image --><!-- wp:image {\"id\":1687334515583,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/news-5_1687166738_1687334515.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-5_1687166738_1687334515.webp\" alt=\"\" class=\"wp-image-1687334515583\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687334439195,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/news-3_1687166535_1687334439.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-3_1687166535_1687334439.webp\" alt=\"\" class=\"wp-image-1687334439195\"/></a></figure><!-- /wp:image --><!-- wp:image {\"id\":1687334488149,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/news-4_1687166546_1687334488.webp\" target=\"_blank\" rel=\" noreferrer noopener\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-4_1687166546_1687334488.webp\" alt=\"\" class=\"wp-image-1687334488149\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-21 02:32:02', '2023-06-21 05:51:43', NULL),
(26, 11, 2, '1687349822.png', '2023-06-21', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"15%\"} --><div class=\"wp-block-column\" style=\"flex-basis:15%\"><!-- wp:image {\"id\":1687349764780,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-1_1687166465_1687349764.webp\" alt=\"\" class=\"wp-image-1687349764780\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687349772966,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-2_1687166516_1687349772.webp\" alt=\"\" class=\"wp-image-1687349772966\"/></figure><!-- /wp:image --><!-- wp:image {\"id\":1687349794518,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-4_1687166546_1687349794.webp\" alt=\"\" class=\"wp-image-1687349794518\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687349782356,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-3_1687166535_1687349782.webp\" alt=\"\" class=\"wp-image-1687349782356\"/></figure><!-- /wp:image --><!-- wp:image {\"id\":1687349809942,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-5_1687166738_1687349809.webp\" alt=\"\" class=\"wp-image-1687349809942\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-21 06:47:02', '2023-06-21 06:47:02', NULL),
(27, 12, 1, '1687777077.png', '2023-06-26', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687774064129,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-head_1687166376_1687774064.webp\" alt=\"\" class=\"wp-image-1687774064129\"/></figure><!-- /wp:image --><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687774117588,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-3_1687166535_1687774117.webp\" alt=\"\" class=\"wp-image-1687774117588\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687774236670,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-4_1687166546_1687774236.webp\" alt=\"\" class=\"wp-image-1687774236670\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-26 05:27:57', '2023-06-26 05:27:57', NULL),
(28, 12, 2, '1687784836.png', '2023-06-26', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687784785220,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-head_1687166376_1687784785.webp\" alt=\"\" class=\"wp-image-1687784785220\"/></figure><!-- /wp:image --><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687784824099,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-2_1687166516_1687784823.webp\" alt=\"\" class=\"wp-image-1687784824099\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687784832308,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-3_1687166535_1687784832.webp\" alt=\"\" class=\"wp-image-1687784832308\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-26 07:37:16', '2023-06-26 07:37:16', NULL),
(29, 12, 3, '1687785239.png', '2023-06-26', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"></div><!-- /wp:column --></div><!-- /wp:columns --><!-- wp:image {\"id\":1687785205848,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-head_1687166376_1687785205.webp\" alt=\"\" class=\"wp-image-1687785205848\"/></figure><!-- /wp:image --><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687785225863,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-2_1687166516_1687785225.webp\" alt=\"\" class=\"wp-image-1687785225863\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687785235231,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-3_1687166535_1687785235.webp\" alt=\"\" class=\"wp-image-1687785235231\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-26 07:43:59', '2023-06-26 07:43:59', NULL),
(30, 12, 4, '1687786197.png', '2023-06-26', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687786149804,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-head_1687166376_1687786149.webp\" alt=\"\" class=\"wp-image-1687786149804\"/></figure><!-- /wp:image --><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687786184605,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-2_1687166516_1687786184.webp\" alt=\"\" class=\"wp-image-1687786184605\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687786193786,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-3_1687166535_1687786193.webp\" alt=\"\" class=\"wp-image-1687786193786\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-26 07:59:57', '2023-06-26 07:59:57', NULL),
(31, 12, 5, '1687786756.png', '2023-06-26', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687786719638,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-head_1687166376_1687786719.webp\" alt=\"\" class=\"wp-image-1687786719638\"/></figure><!-- /wp:image --><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687786744641,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-3_1687166535_1687786744.webp\" alt=\"\" class=\"wp-image-1687786744641\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1687786753329,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/news-4_1687166546_1687786753.webp\" alt=\"\" class=\"wp-image-1687786753329\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-26 08:09:16', '2023-06-26 08:09:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages_07jun2023`
--

CREATE TABLE `pages_07jun2023` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL COMMENT 'primary key of news table\r\n',
  `page_number` int(11) NOT NULL,
  `page_add_date` date NOT NULL,
  `template` text NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Primary key of users table\r\n',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages_07jun2023`
--

INSERT INTO `pages_07jun2023` (`id`, `news_id`, `page_number`, `page_add_date`, `template`, `created_by`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, '2023-05-31', '<!-- wp:image {\"id\":1685540439044,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1685540438.webp\" alt=\"\" class=\"wp-image-1685540439044\"/></figure><!-- /wp:image -->', 1, 1, '2023-05-31 08:21:20', '2023-06-01 05:52:55', '2023-06-01 05:52:55'),
(2, 2, 4, '2023-06-01', '<!-- wp:image {\"id\":1685596442446,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers2_1685596442.webp\" alt=\"\" class=\"wp-image-1685596442446\"/></figure><!-- /wp:image -->', 1, 1, '2023-05-31 23:44:12', '2023-06-01 01:56:56', '2023-06-01 01:56:56'),
(3, 2, 6, '2023-06-01', '<!-- wp:image {\"id\":1685599141306,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1685599140.webp\" alt=\"\" class=\"wp-image-1685599141306\"/></figure><!-- /wp:image -->', 1, 0, '2023-06-01 00:29:03', '2023-06-02 02:02:38', NULL),
(4, 2, 5, '2023-06-01', '<!-- wp:image {\"id\":1685599485796,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers7_1685599483.webp\" alt=\"\" class=\"wp-image-1685599485796\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 00:34:47', '2023-06-01 10:42:54', '2023-06-01 01:56:39'),
(5, 1, 2, '2023-06-01', '<!-- wp:image {\"id\":1685604996602,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers6_1685604996.webp\" alt=\"\" class=\"wp-image-1685604996602\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 02:07:10', '2023-06-01 02:07:10', NULL),
(6, 2, 8, '2023-06-01', '<!-- wp:image {\"id\":1685617649739,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1685617649.webp\" alt=\"\" class=\"wp-image-1685617649739\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 02:07:43', '2023-06-01 05:37:36', NULL),
(7, 2, 2, '2023-06-01', '<!-- wp:image {\"id\":1685617811369,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization1_1685617811.webp\" alt=\"\" class=\"wp-image-1685617811369\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 05:40:13', '2023-06-01 05:53:03', '2023-06-01 05:53:03'),
(8, 2, 9, '2023-06-01', '<!-- wp:image {\"id\":1685618402195,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1685618402.webp\" alt=\"\" class=\"wp-image-1685618402195\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 05:52:51', '2023-06-01 06:05:56', NULL),
(9, 3, 4, '2023-06-01', '<!-- wp:image {\"id\":1685618820500,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1685618820.webp\" alt=\"\" class=\"wp-image-1685618820500\"/></figure><!-- /wp:image -->', 1, 1, '2023-06-01 05:57:02', '2023-06-01 05:57:13', NULL),
(10, 2, 7, '2023-06-01', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685626136697,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1685626136.webp\" alt=\"\" class=\"wp-image-1685626136697\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685626147297,\"width\":339,\"height\":212,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full is-resized\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1685626146.webp\" alt=\"\" class=\"wp-image-1685626147297\" width=\"339\" height=\"212\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685626189164,\"width\":317,\"height\":210,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full is-resized\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers3_1685626189.webp\" alt=\"\" class=\"wp-image-1685626189164\" width=\"317\" height=\"210\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-01 08:00:13', '2023-06-01 08:00:13', NULL),
(11, 1, 7, '2023-06-02', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685698021794,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1685698020.webp\" alt=\"\" class=\"wp-image-1685698021794\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685698037947,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization1_1685698037.webp\" alt=\"\" class=\"wp-image-1685698037947\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1685698046843,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1685698046.webp\" alt=\"\" class=\"wp-image-1685698046843\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-02 03:57:28', '2023-06-02 03:57:28', NULL),
(12, 4, 1, '2023-06-05', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1685949968636,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1685949967.webp\" alt=\"\" class=\"wp-image-1685949968636\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1685949983476,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers1_1685949983.webp\" alt=\"\" class=\"wp-image-1685949983476\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 6, 1, '2023-06-05 01:56:27', '2023-06-05 01:56:27', NULL),
(13, 3, 2, '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686042628605,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686042628.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686042628.webp\" alt=\"\" class=\"wp-image-1686042628605\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column --><div class=\"wp-block-column\"><!-- wp:image {\"id\":1686042638608,\"width\":445,\"height\":556,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full is-resized\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers6_1686042638.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers6_1686042638.webp\" alt=\"\" class=\"wp-image-1686042638608\" width=\"445\" height=\"556\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 03:41:20', '2023-06-06 03:41:20', NULL),
(14, 8, 1, '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686045111571,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers5_1686045110.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers5_1686045110.webp\" alt=\"\" class=\"wp-image-1686045111571\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686045120145,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686045119.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686045119.webp\" alt=\"\" class=\"wp-image-1686045120145\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 04:22:04', '2023-06-06 04:22:36', NULL),
(15, 9, 1, '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686045496355,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization_1686045495.webp\" alt=\"\" class=\"wp-image-1686045496355\"/></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686045507707,\"width\":560,\"height\":426,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} --><figure class=\"wp-block-image size-full is-resized\"><img src=\"http://127.0.0.1:8000/front/fromfront/bank_organization1_1686045507.webp\" alt=\"\" class=\"wp-image-1686045507707\" width=\"560\" height=\"426\"/></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 04:28:48', '2023-06-06 04:28:48', NULL),
(16, 9, 2, '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686045605118,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers7_1686045602.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers7_1686045602.webp\" alt=\"\" class=\"wp-image-1686045605118\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686045615342,\"width\":589,\"height\":369,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full is-resized\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers4_1686045614.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1686045614.webp\" alt=\"\" class=\"wp-image-1686045615342\" width=\"589\" height=\"369\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 04:30:29', '2023-06-06 04:30:48', NULL),
(17, 9, 3, '2023-06-06', '<!-- wp:columns --><div class=\"wp-block-columns\"><!-- wp:column {\"width\":\"66.66%\"} --><div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:image {\"id\":1686045747568,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers4_1686045746.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers4_1686045746.webp\" alt=\"\" class=\"wp-image-1686045747568\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --><!-- wp:column {\"width\":\"33.33%\"} --><div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:image {\"id\":1686045755415,\"sizeSlug\":\"full\",\"linkDestination\":\"media\"} --><figure class=\"wp-block-image size-full\"><a href=\"http://127.0.0.1:8000/front/fromfront/flowers3_1686045755.webp\"><img src=\"http://127.0.0.1:8000/front/fromfront/flowers3_1686045755.webp\" alt=\"\" class=\"wp-image-1686045755415\"/></a></figure><!-- /wp:image --></div><!-- /wp:column --></div><!-- /wp:columns -->', 1, 1, '2023-06-06 04:32:36', '2023-06-06 04:32:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages_bkp25may2023`
--

CREATE TABLE `pages_bkp25may2023` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL COMMENT 'primary key of news table\r\n',
  `template_id` int(11) NOT NULL COMMENT 'Primary key of template table\r\n',
  `Page_number` int(11) NOT NULL,
  `Page_add_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Primary key of users table\r\n',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Not deleted,1=deleted\r\n',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('prasun@matrixnmedia.com', 'r0zBDbe6woYdHUvPjqNocm703xyDBCUSrEzGKnTiTOaYMuT707ZDaBt8MMK8rb8FymWR09jUA9zXujNWmsFhsywjwKgrEmpaTwTZFaOp4IjHRlOBljn1OI3S5O0v8h5HZ2237TSPH7RonBu67asqM09buKGlfUIws69n3SQGCNO2jCvOm1NrsXIoIvBcFnS91z1TDNl4bnMxBCxCq7YHKdpzSljuLQLK9K7lUqtkDRuQk9WxIapD5H7xtp', '2023-06-05 11:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `templates_bkp25may2023`
--

CREATE TABLE `templates_bkp25may2023` (
  `id` int(11) NOT NULL,
  `template_name` varchar(255) NOT NULL,
  `number_of_image_fit_template` int(11) NOT NULL,
  `created_by` int(11) NOT NULL COMMENT 'Primary key of users table\r\n',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active,0=Inactive\r\n',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=Not deleted,1=deleted\r\n',
  `deleted_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'A-active, I-Inactive ',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin User', 'admin@gmail.com', NULL, '$2y$10$CZJizJlddmpsdi8v5OIS0uTZ6IHeqZa68/3wqMQlwMnG6XJLuX.Zy', 'A', NULL, '2023-05-25 05:27:22', '2023-05-31 01:23:29', NULL),
(2, 'Test User22', 'testuser@gmail.com', NULL, '$2y$10$RXdPH0Ik3pDlfvpj4H8MMeLhBcETsFzv67Otr/TioOYLoY7raEE/m', 'I', NULL, '2023-05-29 01:05:15', '2023-06-02 05:41:58', NULL),
(3, 'Test user668877', 'testuser22@gmail.com', NULL, '$2y$10$x7gOnfSz6b9GhKoRYsKDx.uC5ryds/8UfptVBsVSXPVGgFZL3I7Ou', 'A', NULL, '2023-05-29 01:09:53', '2023-06-01 04:10:25', NULL),
(4, 'Test User 1234', 'testuser12345@gmail.com', NULL, '$2y$10$DwPGSL8C34Pkv0U.J/n6gesLRoKDujMLMgLU3pipX4hMyN5tpACbq', 'A', NULL, '2023-05-29 01:27:16', '2023-05-29 05:08:22', '2023-05-29 05:08:22'),
(5, 'Test User 2', 'testuser2@gmail.com', NULL, '$2y$10$h63UziJE6JyKP7piMqhT0.9gcyT2q89KaZuFIh0rfVhR1H9Ch4TZy', 'A', NULL, '2023-05-31 01:24:16', '2023-05-31 04:09:16', NULL),
(6, 'Prasun Test', 'prasun@matrixnmedia.com', NULL, '$2y$10$NgnBQvmSsjI.sA5BDyqAGeK0d/U.FrWZLBsDts4fP3KJlHhO/M0xq', 'A', NULL, '2023-06-02 05:52:31', '2023-06-07 01:51:39', NULL),
(7, 'Raju', 'raju@matrixnmedia.com', NULL, '$2y$10$CSgtz88JJ70rQWeafDCexOcLC7d6PALHZQ9Ia95XE/WWaJaL9St3q', 'A', NULL, '2023-09-19 07:11:31', '2023-09-19 07:11:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_bkp25may2023`
--

CREATE TABLE `users_bkp25may2023` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_bkp25may2023`
--

INSERT INTO `users_bkp25may2023` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@admin.com', NULL, '$2y$10$IZPjsS/VG8uWhza8MTIqme3EdUuIdVOeDge6bG6T1hEdxMvqvUGSy', NULL, '2023-05-25 05:27:22', '2023-05-25 05:27:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_bkp29may2023`
--
ALTER TABLE `news_bkp29may2023`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_07jun2023`
--
ALTER TABLE `pages_07jun2023`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages_bkp25may2023`
--
ALTER TABLE `pages_bkp25may2023`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `templates_bkp25may2023`
--
ALTER TABLE `templates_bkp25may2023`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_bkp25may2023`
--
ALTER TABLE `users_bkp25may2023`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `news_bkp29may2023`
--
ALTER TABLE `news_bkp29may2023`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pages_07jun2023`
--
ALTER TABLE `pages_07jun2023`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pages_bkp25may2023`
--
ALTER TABLE `pages_bkp25may2023`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `templates_bkp25may2023`
--
ALTER TABLE `templates_bkp25may2023`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_bkp25may2023`
--
ALTER TABLE `users_bkp25may2023`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
