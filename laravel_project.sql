-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2026 at 05:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_analyses`
--

CREATE TABLE `lar_analyses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `analyst_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `value` decimal(12,2) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_cache`
--

CREATE TABLE `lar_cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_cache`
--

INSERT INTO `lar_cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:20:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:11:\"orders.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:13:\"orders.create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:14:\"orders.payment\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:12:\"reports.view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:12:\"staff.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"orders.status\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:14:\"orders.approve\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"orders.prepare\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:4;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:15:\"payment.process\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:14:\"orders.confirm\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"orders.cancel\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:13:\"orders.delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:12:\"menus.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:17:\"categories.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:15:\"customer.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:18:\"restaurants.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:13:\"tables.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:13:\"stocks.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:14:\"inventory.view\";s:1:\"c\";s:3:\"web\";}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:14:\"coupons.manage\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}}s:5:\"roles\";a:4:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:7:\"Manager\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"Cashier\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"Kitchen Staff\";s:1:\"c\";s:3:\"web\";}}}', 1772030834);

-- --------------------------------------------------------

--
-- Table structure for table `lar_cache_locks`
--

CREATE TABLE `lar_cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_categories`
--

CREATE TABLE `lar_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_categories`
--

INSERT INTO `lar_categories` (`id`, `name`, `description`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Burgers', 'All types of beef and chicken burgers', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(2, 'Pizza', 'Freshly baked pizzas with various toppings', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(3, 'Pasta', 'Italian style pasta dishes', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(4, 'Rice Items', 'Rice-based meals and platters', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(5, 'Chicken', 'Grilled, fried, and spicy chicken items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(6, 'Beef', 'Beef curry, steak, and specialty items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(7, 'Seafood', 'Fish, prawn, and seafood dishes', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(8, 'Vegetarian', 'Healthy vegetarian food items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(9, 'Fast Food', 'Quick snacks and fast food items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(10, 'Snacks', 'Light snacks and finger foods', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(11, 'Desserts', 'Sweet desserts and bakery items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(12, 'Ice Cream', 'Different flavors of ice cream', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(13, 'Cold Drinks', 'Soft drinks and chilled beverages', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(14, 'Hot Drinks', 'Tea, coffee, and hot beverages', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(15, 'Juices', 'Fresh fruit juices and smoothies', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(16, 'Breakfast', 'Morning breakfast meals', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(17, 'Lunch Specials', 'Special lunch combo meals', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(18, 'Dinner Specials', 'Chef’s special dinner items', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(19, 'Combo Meals', 'Value combo meal packages', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49'),
(20, 'Kids Menu', 'Food items specially for kids', 1, 1, '2026-01-05 04:03:49', '2026-01-05 04:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `lar_coupons`
--

CREATE TABLE `lar_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` enum('percent','amount') NOT NULL DEFAULT 'amount',
  `value` decimal(10,2) NOT NULL DEFAULT 0.00,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `max_uses` int(10) UNSIGNED DEFAULT NULL,
  `used` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_coupons`
--

INSERT INTO `lar_coupons` (`id`, `code`, `type`, `value`, `active`, `starts_at`, `expires_at`, `max_uses`, `used`, `created_at`, `updated_at`) VALUES
(5, 'SAVE10', 'percent', 10.00, 1, '2026-02-24 15:30:00', '2026-02-25 15:30:00', 5, 1, '2026-02-24 15:30:36', '2026-02-24 15:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `lar_customers`
--

CREATE TABLE `lar_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_customers`
--

INSERT INTO `lar_customers` (`id`, `name`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'john@example.com', '01710000001', '123 Main Street, Dhaka', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(2, 'Jane Smith', 'jane@example.com', '01710000002', '456 Park Avenue, Dhaka', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(3, 'Robert Brown', 'robert@example.com', '01710000003', '789 Lake Road, Chittagong', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(4, 'Emily Davis', 'emily@example.com', '01710000004', '12 River Street, Khulna', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(5, 'Michael Johnson', 'michael@example.com', '01710000005', '34 Hill Street, Sylhet', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(6, 'Sophia Wilson', 'sophia@example.com', '01710000006', '56 Garden Road, Rajshahi', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(7, 'Daniel Martinez', 'daniel@example.com', '01710000007', '78 Lakeview Avenue, Barisal', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(8, 'Olivia Taylor', 'olivia@example.com', '01710000008', '90 Sunrise Street, Rangpur', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(9, 'William Anderson', 'william@example.com', '01710000009', '101 Sunset Boulevard, Comilla', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(10, 'Ava Thomas', 'ava@example.com', '01710000010', '202 Ocean Drive, Mymensingh', 1, '2026-01-04 14:35:35', '2026-01-04 14:35:35'),
(12, 'MAHEDI HASAN', 'afranabir03@gmail.com', '01632606827', 'Narayanganj,Siddhirganj', 1, '2026-01-04 23:22:23', '2026-01-04 23:40:54'),
(13, 'Pollob', 'pollob@example.com', '01575550883', 'Kawran Bazar,Janata tower', 1, '2026-02-16 18:30:30', '2026-02-19 19:32:35'),
(15, 'MAHEDI HASAN', NULL, '01983581152', 'Narayanganj,Siddhirganj', 1, '2026-02-22 04:46:08', '2026-02-22 04:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `lar_failed_jobs`
--

CREATE TABLE `lar_failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_jobs`
--

CREATE TABLE `lar_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_job_batches`
--

CREATE TABLE `lar_job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_menus`
--

CREATE TABLE `lar_menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_menus`
--

INSERT INTO `lar_menus` (`id`, `category_id`, `name`, `description`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Classic Beef Burger', 'Juicy beef patty with cheese and lettuce', 250.00, 'menus/AkXPl5NJ4PVE0y3nDqGdTg7qZJ0yR3zfMSV470s8.jpg', 1, '2026-01-05 04:05:13', '2026-02-16 14:38:44'),
(2, 1, 'Chicken Burger', 'Crispy chicken burger with mayo', 220.00, 'menus/BgNM3rODCk8IEXEQEAaYGrq50acuuLHzLzkH8c4F.jpg', 1, '2026-01-05 04:05:13', '2026-02-16 14:40:38'),
(3, 2, 'Margherita Pizza', 'Classic cheese pizza with tomato sauce', 550.00, 'menus/RixYRUHC7gi4NcuCTMFd9dfjBqQKhEv5qB8Gj70P.jpg', 1, '2026-01-05 04:05:13', '2026-02-16 14:40:54'),
(4, 2, 'Pepperoni Pizza', 'Pepperoni pizza with mozzarella cheese', 650.00, 'menus/ZwGFxsFQQ4wWTlSxBqxuZEN6BVJERmIqcN090MBS.jpg', 1, '2026-01-05 04:05:13', '2026-02-16 14:42:27'),
(5, 3, 'Creamy Alfredo Pasta', 'Pasta in creamy alfredo sauce', 480.00, 'menus/CZVUC3dWiBIhTOPgNSk3XfIicrM1PeGvUvW8sfXc.jpg', 1, '2026-01-05 04:05:13', '2026-02-16 14:42:45'),
(6, 3, 'Spicy Arrabiata Pasta', 'Pasta with spicy tomato sauce', 460.00, 'menus/IeDCFgqM49s4JDddu9lG1Pcj1t5NLRn6eNNmC6CW.jpg', 0, '2026-01-05 04:05:13', '2026-02-17 04:38:45'),
(7, 4, 'Chicken Fried Rice', 'Fried rice with chicken and vegetables', 380.00, 'menus/om2sYQAPqFHPPtwCCa2WrSB60oiDJdUg1JawGiH1.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:39:09'),
(8, 4, 'Beef Biryani', 'Traditional beef biryani with spices', 420.00, 'menus/Z5VOvhPA8llq3Kc2Vdh1PSJgCa64UoawKBDARDWT.webp', 1, '2026-01-05 04:05:13', '2026-02-17 04:39:32'),
(9, 5, 'Grilled Chicken', 'Grilled chicken served with sauce', 520.00, 'menus/n5DvmYFtxuBTdvxfa5DYd2zonCNVvJRSUFkZdDqg.webp', 1, '2026-01-05 04:05:13', '2026-02-17 04:39:55'),
(10, 6, 'Beef Steak', 'Tender beef steak with gravy', 850.00, 'menus/3NilolO0oVErRAj0kqGG6DPoi7q3BPM8Ylx2iFe3.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:41:01'),
(11, 7, 'Fried Prawns', 'Crispy fried prawns', 600.00, 'menus/sCIUNjOVK0cIZ8IBHtnjzTcVg98M3yTSeMHYMssz.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:41:23'),
(12, 8, 'Vegetable Curry', 'Mixed vegetable curry', 300.00, 'menus/xZxfaNgmZmndYtVW3Bqi35n2WOF7cnhKTAxTThP3.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:41:43'),
(13, 9, 'French Fries', 'Golden crispy french fries', 180.00, 'menus/qX2YkXH8HKrNEWhynPMQ9ZoyAvnKlGGc7SZO6Sv4.webp', 1, '2026-01-05 04:05:13', '2026-02-17 04:42:05'),
(14, 10, 'Chicken Nuggets', 'Crunchy chicken nuggets', 260.00, 'menus/vkzc1edfEu7TDcNjUmL55ZXX4KipPVEXz53khsZ0.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:42:27'),
(15, 11, 'Chocolate Cake', 'Rich chocolate layered cake', 320.00, 'menus/c5oZVBCj0V5JiXmCs4OdcEbr589FgVTQG3r45wbP.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:42:46'),
(16, 12, 'Vanilla Ice Cream', 'Classic vanilla ice cream scoop', 150.00, 'menus/2itjlwEQPzCtdeK5Vx9uKmYatDcwwfxc04ytbmXD.webp', 1, '2026-01-05 04:05:13', '2026-02-17 04:43:06'),
(17, 13, 'Coca Cola', 'Chilled soft drink', 60.00, 'menus/6g3AC0pfvHpx7aGtS3aUq8YbhGeJ3uwlupEGoBUH.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:43:23'),
(18, 14, 'Hot Coffee', 'Freshly brewed hot coffee', 120.00, 'menus/jj0MNjm4YjCiXL9QLi5Dt78trYdUzzFtGX10tvrB.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:43:40'),
(19, 15, 'Orange Juice', 'Freshly squeezed orange juice', 140.00, 'menus/9u0c86G35DRqY44eORKaLY25kGDwELTDOVpfdQXj.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:43:57'),
(20, 20, 'Kids Mini Burger', 'Small burger specially for kids', 160.00, 'menus/Jps8kWeI1NYHmRdQJ3hAtPNp9yRKrXYnRiFO2MQK.jpg', 1, '2026-01-05 04:05:13', '2026-02-17 04:44:17'),
(22, 10, 'sandwich', 'a popular food featuring fillings like meat, cheese, vegetables, or spreads layered between slices of bread', 100.00, 'menus/AVxOyKjE4J9ZJrQTgTXNygBC9M8iYhK4Om5lWYT8.jpg', 1, '2026-01-08 23:52:05', '2026-02-17 04:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `lar_migrations`
--

CREATE TABLE `lar_migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_migrations`
--

INSERT INTO `lar_migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_03_165547_create_categories_table', 1),
(5, '2026_01_04_055650_create_menus_table', 1),
(6, '2026_01_04_121119_create_customers_table', 1),
(7, '2026_01_04_143024_create_restaurants_table', 1),
(9, '2026_01_04_152533_create_restaurants_table', 2),
(10, '2026_01_09_165332_create_orders_table', 3),
(11, '2026_01_11_040306_create_personal_access_tokens_table', 3),
(13, '2026_01_12_033634_create_orders_table', 4),
(14, '2026_01_12_033653_create_orders_items_table', 4),
(15, '2026_01_17_060540_create_payment_methods_table', 5),
(16, '2026_01_17_060540_create_payments_table', 5),
(17, '2026_01_17_060541_create_invoices_table', 5),
(18, '2026_01_17_061458_create_payment_methods_table', 6),
(19, '2026_01_17_061529_create_payments_table', 6),
(20, '2026_01_17_061634_create_invoices_table', 6),
(21, '2026_01_18_042429_create_purchases_table', 7),
(22, '2026_01_18_042547_create_stocks_table', 7),
(23, '2026_01_18_045704_create_purchases_table', 8),
(24, '2026_01_18_054917_create_suppliers_table', 9),
(25, '2026_01_18_055118_create_products_table', 9),
(26, '2026_01_18_055141_create_purchase_orders_table', 9),
(27, '2026_01_18_055242_create_purchase_order_items_table', 9),
(28, '2026_01_18_055307_create_stock_transactions_table', 9),
(29, '2026_01_18_183101_add_is_active_to_categories_table', 10),
(30, '2026_01_19_065146_create_stocks_table', 11),
(31, '2026_01_19_122806_add_payment_fields_to_orders_table', 12),
(32, '2026_01_19_123404_add_payment_columns_to_orders_table', 13),
(33, '2026_01_19_123741_add_payment_columns_to_orders_table', 13),
(34, '2026_01_19_124354_add_payment_columns_to_orders_table', 13),
(35, '2026_01_19_160159_create_analyses_table', 14),
(36, '2026_02_19_000001_create_restaurant_tables', 15),
(37, '2026_02_19_000002_add_table_id_to_orders', 15),
(38, '2026_02_19_000003_update_table_status_enum', 16),
(39, '2026_02_19_120000_create_permission_tables', 17),
(40, '2026_02_19_120100_seed_default_roles_permissions', 18),
(41, '2026_02_19_120200_add_role_column_to_users', 19),
(42, '2026_02_19_120300_add_orders_status_permission', 20),
(43, '2026_02_19_121000_add_orders_approve_permission', 21),
(44, '2026_02_19_121100_add_orders_payment_permission', 22),
(45, '2026_02_20_004350_alter_orders_status_add_approved', 23),
(46, '2026_02_20_005200_sync_user_roles_from_users_table', 24),
(47, '2026_02_20_000100_add_inventory_view_permission', 25),
(48, '2026_02_20_000110_add_payment_process_permission', 25),
(49, '2026_02_20_000120_add_orders_prepare_permission', 25),
(50, '2026_02_24_000500_add_user_id_to_orders_table', 25),
(51, '2026_02_24_001200_create_coupons_table', 26);

-- --------------------------------------------------------

--
-- Table structure for table `lar_model_has_permissions`
--

CREATE TABLE `lar_model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_model_has_roles`
--

CREATE TABLE `lar_model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_model_has_roles`
--

INSERT INTO `lar_model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 9),
(2, 'App\\Models\\User', 10),
(3, 'App\\Models\\User', 11),
(4, 'App\\Models\\User', 12),
(4, 'App\\Models\\User', 13),
(4, 'App\\Models\\User', 14),
(4, 'App\\Models\\User', 15),
(4, 'App\\Models\\User', 16),
(4, 'App\\Models\\User', 17);

-- --------------------------------------------------------

--
-- Table structure for table `lar_orders`
--

CREATE TABLE `lar_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `table_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_type` enum('dine_in','takeaway','delivery') NOT NULL DEFAULT 'dine_in',
  `status` enum('pending','confirmed','preparing','ready','approved','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `invoice_token` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(8,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `note` text DEFAULT NULL,
  `ordered_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_orders`
--

INSERT INTO `lar_orders` (`id`, `order_no`, `customer_id`, `user_id`, `restaurant_id`, `table_id`, `order_type`, `status`, `payment_status`, `payment_method`, `invoice_token`, `subtotal`, `tax`, `discount`, `total`, `note`, `ordered_at`, `created_at`, `updated_at`) VALUES
(72, 'ORD-20260224220617-139', 12, 11, 11, NULL, 'delivery', 'delivered', 'paid', 'cod', 'INV-20260224-RGSWD', 260.00, 13.00, 26.00, 247.00, NULL, '2026-02-24 16:06:17', '2026-02-24 16:06:17', '2026-02-24 16:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `lar_order_items`
--

CREATE TABLE `lar_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(8,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `special_request` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_order_items`
--

INSERT INTO `lar_order_items` (`id`, `order_id`, `menu_id`, `quantity`, `unit_price`, `total_price`, `special_request`, `created_at`, `updated_at`) VALUES
(64, 72, 14, 1, 260.00, 260.00, NULL, '2026-02-24 16:06:17', '2026-02-24 16:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `lar_password_reset_tokens`
--

CREATE TABLE `lar_password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_permissions`
--

CREATE TABLE `lar_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_permissions`
--

INSERT INTO `lar_permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'orders.view', 'web', NULL, NULL),
(2, 'orders.create', 'web', NULL, NULL),
(3, 'orders.payment', 'web', NULL, NULL),
(4, 'reports.view', 'web', NULL, NULL),
(5, 'staff.manage', 'web', NULL, NULL),
(6, 'orders.status', 'web', NULL, NULL),
(7, 'orders.approve', 'web', NULL, NULL),
(8, 'orders.prepare', 'web', '2026-02-20 06:33:29', '2026-02-20 06:33:29'),
(9, 'payment.process', 'web', '2026-02-20 09:42:40', '2026-02-20 09:42:40'),
(10, 'orders.confirm', 'web', '2026-02-20 13:37:49', '2026-02-20 13:37:49'),
(11, 'orders.cancel', 'web', '2026-02-20 13:37:55', '2026-02-20 13:37:55'),
(12, 'orders.delete', 'web', '2026-02-20 13:38:07', '2026-02-20 13:38:07'),
(13, 'menus.manage', 'web', '2026-02-20 13:38:23', '2026-02-20 13:38:23'),
(14, 'categories.manage', 'web', '2026-02-20 13:38:28', '2026-02-20 13:38:28'),
(15, 'customer.manage', 'web', '2026-02-20 13:38:30', '2026-02-20 13:38:30'),
(16, 'restaurants.manage', 'web', '2026-02-20 13:38:31', '2026-02-20 13:38:31'),
(17, 'tables.manage', 'web', '2026-02-20 13:38:33', '2026-02-20 13:38:33'),
(18, 'stocks.manage', 'web', '2026-02-20 13:38:34', '2026-02-20 13:38:34'),
(19, 'inventory.view', 'web', NULL, NULL),
(20, 'coupons.manage', 'web', '2026-02-24 06:37:01', '2026-02-24 06:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `lar_personal_access_tokens`
--

CREATE TABLE `lar_personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_personal_access_tokens`
--

INSERT INTO `lar_personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 11, 'frontend', '493e6c3c513bfe723c9b997974cfb112029c285d2191d96b31e5497eba30316b', '[\"*\"]', '2026-02-16 14:36:23', NULL, '2026-02-16 14:08:01', '2026-02-16 14:36:23'),
(2, 'App\\Models\\User', 11, 'frontend', '6cc64ac36f75a1a52131e7f5164627c29312368e66f20a635acbc50d08c34373', '[\"*\"]', '2026-02-22 00:48:09', NULL, '2026-02-16 14:36:38', '2026-02-22 00:48:09'),
(4, 'App\\Models\\User', 11, 'frontend', '9d738a16c32e096bd945dd95bd087591402d632663aca220c538126e4ec0210b', '[\"*\"]', '2026-02-16 18:21:34', NULL, '2026-02-16 18:03:58', '2026-02-16 18:21:34'),
(5, 'App\\Models\\User', 11, 'frontend', '13cee1c61771d7dd4fc6fdc246312ae26147fe0ac4fa35745a315854475db2f0', '[\"*\"]', '2026-02-16 18:53:18', NULL, '2026-02-16 18:21:42', '2026-02-16 18:53:18'),
(7, 'App\\Models\\User', 11, 'frontend', 'f346c99b0837e3b895e5c5a659516afc5d06d2f6a751e6e578a034f961f26e6c', '[\"*\"]', '2026-02-23 15:06:17', NULL, '2026-02-22 00:10:40', '2026-02-23 15:06:17'),
(10, 'App\\Models\\User', 11, 'frontend', 'c75c87787e3ba49d0a34aa3b453ea3b468c9149deb209d9c2d280076b1c5aeb8', '[\"*\"]', '2026-02-23 15:38:56', NULL, '2026-02-23 15:06:44', '2026-02-23 15:38:56'),
(11, 'App\\Models\\User', 11, 'frontend', '7d5b82465cf07f3c83c85a6bc70c05a4cc2332c2ab4922cd174110e22f3636e9', '[\"*\"]', '2026-02-23 15:51:11', NULL, '2026-02-23 15:38:59', '2026-02-23 15:51:11'),
(12, 'App\\Models\\User', 11, 'frontend', '5b2e9c639cae326b9c9007b28f46ab1fee901fc0b16655d4363cdf6b4d96fe1d', '[\"*\"]', '2026-02-23 16:01:34', NULL, '2026-02-23 15:51:18', '2026-02-23 16:01:34'),
(13, 'App\\Models\\User', 11, 'frontend', '8c2ecde9a5ad8ad49d54d94b78ce09f15c995d074d679eadbcaaff456d3f4336', '[\"*\"]', '2026-02-23 16:03:21', NULL, '2026-02-23 16:01:38', '2026-02-23 16:03:21'),
(14, 'App\\Models\\User', 11, 'frontend', '218b2e4726fa559e12999f785a3b8e0b9290aa4efa3e3ab7eef8faa5078b6693', '[\"*\"]', '2026-02-23 16:03:30', NULL, '2026-02-23 16:03:25', '2026-02-23 16:03:30'),
(15, 'App\\Models\\User', 11, 'frontend', '9a45152b3f1454d0227b41072312cb1ae706cb9dd9c38af26e599376b7bbd53d', '[\"*\"]', '2026-02-23 16:09:25', NULL, '2026-02-23 16:03:34', '2026-02-23 16:09:25'),
(16, 'App\\Models\\User', 11, 'frontend', '0c6d9d4ad8101841e7f2ba2e55fb5436bac9e24fe326568f2c3530c87a51f4da', '[\"*\"]', '2026-02-23 16:11:40', NULL, '2026-02-23 16:10:09', '2026-02-23 16:11:40'),
(17, 'App\\Models\\User', 11, 'frontend', '606903666dbbffed43699e38b8e3465e874738f8f2fb4d2991c4880d3d907c8c', '[\"*\"]', '2026-02-23 16:14:30', NULL, '2026-02-23 16:12:26', '2026-02-23 16:14:30'),
(18, 'App\\Models\\User', 11, 'frontend', 'e03c8cb5ea751ba9d83500d1bb1403c688234b30e700faf43d506f9b40ca4732', '[\"*\"]', '2026-02-23 16:15:00', NULL, '2026-02-23 16:14:41', '2026-02-23 16:15:00'),
(19, 'App\\Models\\User', 11, 'frontend', '9f1af6e6c51db8f44df023f96c04f3d0db40bb8243f9d7259eabf1cc51446061', '[\"*\"]', '2026-02-23 16:17:58', NULL, '2026-02-23 16:15:04', '2026-02-23 16:17:58'),
(20, 'App\\Models\\User', 11, 'frontend', 'c7215c771ec9ae7f0aa5729ae05fa062f6f42f7e9543335043504d1e07ceb13e', '[\"*\"]', '2026-02-23 16:19:14', NULL, '2026-02-23 16:18:01', '2026-02-23 16:19:14'),
(21, 'App\\Models\\User', 11, 'frontend', '16b470270343cf8eff89fbf9ee54f2e15835ce0e27dabbf17e836f89ce7124cf', '[\"*\"]', '2026-02-23 16:21:59', NULL, '2026-02-23 16:19:17', '2026-02-23 16:21:59'),
(22, 'App\\Models\\User', 11, 'frontend', '011afd0df4368052f0451d3b15e0e9c940d54ff171e1fe190d0dc25e7aa1daeb', '[\"*\"]', '2026-02-23 16:22:07', NULL, '2026-02-23 16:22:02', '2026-02-23 16:22:07'),
(23, 'App\\Models\\User', 11, 'frontend', '88bebf5905ae7e96efca5245b69d2f0338e1b2f6a0ef28452c7538a5d75ed7e0', '[\"*\"]', '2026-02-23 16:22:14', NULL, '2026-02-23 16:22:12', '2026-02-23 16:22:14'),
(24, 'App\\Models\\User', 11, 'frontend', 'cc0055ac54b742356338a47d6b4f7cdea10634a2b8eb5cffd7d669d2a237d716', '[\"*\"]', '2026-02-23 16:22:30', NULL, '2026-02-23 16:22:17', '2026-02-23 16:22:30'),
(25, 'App\\Models\\User', 11, 'frontend', 'bfcf1a2bca4bfeec2eb0f630b60f64fb1e449e2a44777b38ac043d2c004f7a85', '[\"*\"]', '2026-02-23 16:47:51', NULL, '2026-02-23 16:22:33', '2026-02-23 16:47:51'),
(31, 'App\\Models\\User', 11, 'frontend', 'ab92b7af1df831fd8d47509ceedc27c513644e13f5039a57c7f3dacd2b29be62', '[\"*\"]', '2026-02-23 18:04:34', NULL, '2026-02-23 17:57:54', '2026-02-23 18:04:34'),
(55, 'App\\Models\\User', 11, 'frontend', '03acfe7c894e014571bcf7937e099865027ecfa196e95c4ba327a2c7d09a8c23', '[\"*\"]', '2026-02-24 16:26:09', NULL, '2026-02-24 16:16:51', '2026-02-24 16:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `lar_products`
--

CREATE TABLE `lar_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit` varchar(255) NOT NULL DEFAULT 'piece',
  `current_stock` decimal(10,2) NOT NULL DEFAULT 0.00,
  `reorder_level` decimal(10,2) NOT NULL DEFAULT 10.00,
  `last_purchase_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_purchase_orders`
--

CREATE TABLE `lar_purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(255) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `order_date` date NOT NULL,
  `expected_delivery_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `status` enum('draft','pending','approved','received','cancelled') NOT NULL DEFAULT 'draft',
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `shipping` decimal(15,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_purchase_order_items`
--

CREATE TABLE `lar_purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `received_quantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_restaurants`
--

CREATE TABLE `lar_restaurants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_restaurants`
--

INSERT INTO `lar_restaurants` (`id`, `name`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(11, 'Kacchi Bhai', 'info@kacchibhai.com', '01711000001', 'Dhanmondi, Dhaka', 1, '2026-01-09 23:26:32', '2026-01-09 23:52:09'),
(12, 'Sultan\'s Dine', 'contact@sultandine.com', '01711000002', 'Gulshan, Dhaka', 1, '2026-01-09 23:52:44', '2026-01-09 23:53:15'),
(13, 'Takeout', 'order@takeout.com', '01711000003', 'Banani, Dhaka', 1, '2026-01-10 00:13:05', '2026-01-10 00:13:13'),
(14, 'Chillox', 'hello@chillox.com', '01711000004', 'Mirpur, Dhaka', 1, '2026-01-10 00:13:58', '2026-01-10 00:14:04'),
(16, 'Burger King', 'support@burgerking.com', 'support@burgerking.com', 'Uttara, Dhaka', 1, '2026-01-10 00:17:02', '2026-01-10 00:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `lar_restaurant_tables`
--

CREATE TABLE `lar_restaurant_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` int(10) UNSIGNED NOT NULL DEFAULT 2,
  `status` enum('available','booked','occupied') NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_restaurant_tables`
--

INSERT INTO `lar_restaurant_tables` (`id`, `restaurant_id`, `name`, `capacity`, `status`, `created_at`, `updated_at`) VALUES
(1, 11, 'Table-1', 2, 'occupied', '2026-02-18 18:33:03', '2026-02-20 06:14:50'),
(2, 11, 'Table-2', 6, 'available', '2026-02-18 18:33:30', '2026-02-22 04:56:16'),
(3, 11, 'Table-3', 4, 'occupied', '2026-02-18 18:33:47', '2026-02-18 18:35:37'),
(4, 12, 'Tab-1', 6, 'occupied', '2026-02-19 20:58:19', '2026-02-20 06:00:18'),
(5, 12, 'Tab-2', 5, 'available', '2026-02-20 10:25:13', '2026-02-22 05:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `lar_roles`
--

CREATE TABLE `lar_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL DEFAULT 'web',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_roles`
--

INSERT INTO `lar_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', NULL, NULL),
(2, 'Manager', 'web', NULL, NULL),
(3, 'Cashier', 'web', NULL, NULL),
(4, 'Kitchen Staff', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lar_role_has_permissions`
--

CREATE TABLE `lar_role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_role_has_permissions`
--

INSERT INTO `lar_role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(6, 4),
(7, 2),
(8, 4),
(9, 3),
(10, 1),
(11, 1),
(11, 2),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(20, 1),
(20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lar_sessions`
--

CREATE TABLE `lar_sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_sessions`
--

INSERT INTO `lar_sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4y45cvJejb44Chdgrf0qYN0Av02KRkRWjTsjjbYM', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiWG1IMFVEeXVzQlIzeXZFU1lJNFdRZVVvZ1lLZ2NXdkpJNThTQ3JFbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvb3JkZXJzLzcyL2ludm9pY2UiO3M6NToicm91dGUiO3M6MTQ6Im9yZGVycy5pbnZvaWNlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzcxOTUwMzUzO319', 1771950365);

-- --------------------------------------------------------

--
-- Table structure for table `lar_stocks`
--

CREATE TABLE `lar_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `current_quantity` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(255) NOT NULL DEFAULT 'pcs',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_stocks`
--

INSERT INTO `lar_stocks` (`id`, `menu_id`, `current_quantity`, `unit`, `created_at`, `updated_at`) VALUES
(7, 1, 7, 'pcs', '2026-02-19 19:26:48', '2026-02-24 05:12:59'),
(8, 2, 8, 'pcs', '2026-02-19 19:27:14', '2026-02-23 18:06:27'),
(9, 3, 6, 'pcs', '2026-02-19 19:27:31', '2026-02-19 19:27:31'),
(10, 4, 8, 'pcs', '2026-02-19 19:27:45', '2026-02-19 19:27:45'),
(11, 5, 5, 'pcs', '2026-02-19 19:28:02', '2026-02-24 15:46:41'),
(12, 6, 5, 'pcs', '2026-02-19 19:28:12', '2026-02-19 19:28:12'),
(13, 7, 4, 'pcs', '2026-02-19 19:28:22', '2026-02-19 20:42:48'),
(14, 8, 8, 'pcs', '2026-02-19 19:28:34', '2026-02-24 05:17:27'),
(15, 9, 10, 'pcs', '2026-02-19 19:29:38', '2026-02-24 15:46:50'),
(16, 10, 4, 'pcs', '2026-02-19 19:30:22', '2026-02-20 13:40:01'),
(17, 11, 12, 'pcs', '2026-02-19 19:30:32', '2026-02-19 19:30:32'),
(18, 12, 5, 'pcs', '2026-02-19 19:31:03', '2026-02-24 15:48:59'),
(19, 13, 5, 'pcs', '2026-02-19 19:31:14', '2026-02-24 15:48:47'),
(20, 14, 4, 'pcs', '2026-02-19 19:31:29', '2026-02-24 16:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `lar_stock_transactions`
--

CREATE TABLE `lar_stock_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `reference_type` varchar(255) NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('in','out') NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `unit_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lar_suppliers`
--

CREATE TABLE `lar_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `supplier_type` varchar(255) NOT NULL DEFAULT 'food',
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `payment_terms` varchar(255) NOT NULL DEFAULT 'cash',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_suppliers`
--

INSERT INTO `lar_suppliers` (`id`, `name`, `company_name`, `phone`, `email`, `address`, `supplier_type`, `balance`, `payment_terms`, `is_active`, `created_at`, `updated_at`) VALUES
(12, 'MAHEDI HASAN', 'Abir\'s FoodCourt', '01632606827', 'afranabir03@gmail.com', 'Narayanganj,Siddhirganj, Mouchak Bus Stand\r\nSiddhirganj, Hajera Market, Narayanganj', 'meat', 0.00, 'cod', 1, '2026-01-18 23:55:21', '2026-01-18 23:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `lar_users`
--

CREATE TABLE `lar_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lar_users`
--

INSERT INTO `lar_users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'MAHEDI HASAN', 'afranabir03@gmail.com', 'Admin', NULL, '$2y$12$oU52P7zP2.AudZOhIjdNaedw0bDP7L0drUzBVW./IJc5kQBcOkC5y', NULL, '2026-02-11 01:27:01', '2026-02-19 17:29:42'),
(10, 'Anamul', 'anamul@gamil.com', 'Manager', NULL, '$2y$12$O04yNYns.PMwKyxqDGWeDu.W8/mxgnYd6pXPR9Fq.ccGrwrR.OP9C', NULL, '2026-02-12 04:35:58', '2026-02-19 17:29:42'),
(11, 'Pollob', 'pollob@example.com', 'Cashier', NULL, '$2y$12$Ga/6ULARX7MRXt3xtN7qDe4fq6Oc6TLLBuN51qvCJM7wjo9.nv/BS', NULL, '2026-02-16 14:08:01', '2026-02-19 17:29:42'),
(17, 'Abdullah', 'abdullah@gmail.com', 'Kitchen Staff', NULL, '$2y$12$BvYrLPKWfycPXaVGYroXye6TmhoFFu.o.JChyEXlQ6jXXEAZfsW1m', NULL, '2026-02-19 18:03:50', '2026-02-19 18:03:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_analyses`
--
ALTER TABLE `lar_analyses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_cache`
--
ALTER TABLE `lar_cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `lar_cache_locks`
--
ALTER TABLE `lar_cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `lar_categories`
--
ALTER TABLE `lar_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_categories_name_unique` (`name`);

--
-- Indexes for table `lar_coupons`
--
ALTER TABLE `lar_coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_coupons_code_unique` (`code`);

--
-- Indexes for table `lar_customers`
--
ALTER TABLE `lar_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_failed_jobs`
--
ALTER TABLE `lar_failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lar_jobs`
--
ALTER TABLE `lar_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_jobs_queue_index` (`queue`);

--
-- Indexes for table `lar_job_batches`
--
ALTER TABLE `lar_job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_menus`
--
ALTER TABLE `lar_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_migrations`
--
ALTER TABLE `lar_migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_model_has_permissions`
--
ALTER TABLE `lar_model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `lar_model_has_roles`
--
ALTER TABLE `lar_model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `lar_orders`
--
ALTER TABLE `lar_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_orders_order_no_unique` (`order_no`),
  ADD KEY `lar_orders_customer_id_status_index` (`customer_id`,`status`),
  ADD KEY `lar_orders_restaurant_id_ordered_at_index` (`restaurant_id`,`ordered_at`),
  ADD KEY `lar_orders_table_id_foreign` (`table_id`),
  ADD KEY `lar_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `lar_order_items`
--
ALTER TABLE `lar_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_order_items_menu_id_foreign` (`menu_id`),
  ADD KEY `lar_order_items_order_id_menu_id_index` (`order_id`,`menu_id`);

--
-- Indexes for table `lar_password_reset_tokens`
--
ALTER TABLE `lar_password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `lar_permissions`
--
ALTER TABLE `lar_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `lar_personal_access_tokens`
--
ALTER TABLE `lar_personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_personal_access_tokens_token_unique` (`token`),
  ADD KEY `lar_personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `lar_personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `lar_products`
--
ALTER TABLE `lar_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_products_code_unique` (`code`),
  ADD KEY `lar_products_category_id_foreign` (`category_id`),
  ADD KEY `lar_products_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `lar_purchase_orders`
--
ALTER TABLE `lar_purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_purchase_orders_po_number_unique` (`po_number`),
  ADD KEY `lar_purchase_orders_supplier_id_foreign` (`supplier_id`),
  ADD KEY `lar_purchase_orders_created_by_foreign` (`created_by`),
  ADD KEY `lar_purchase_orders_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `lar_purchase_order_items`
--
ALTER TABLE `lar_purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `lar_purchase_order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `lar_restaurants`
--
ALTER TABLE `lar_restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_restaurant_tables`
--
ALTER TABLE `lar_restaurant_tables`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_restaurant_tables_restaurant_id_name_unique` (`restaurant_id`,`name`),
  ADD KEY `lar_restaurant_tables_status_index` (`status`);

--
-- Indexes for table `lar_roles`
--
ALTER TABLE `lar_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `lar_role_has_permissions`
--
ALTER TABLE `lar_role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `lar_role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `lar_sessions`
--
ALTER TABLE `lar_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_sessions_user_id_index` (`user_id`),
  ADD KEY `lar_sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `lar_stocks`
--
ALTER TABLE `lar_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_stocks_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `lar_stock_transactions`
--
ALTER TABLE `lar_stock_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lar_stock_transactions_product_id_foreign` (`product_id`),
  ADD KEY `lar_stock_transactions_created_by_foreign` (`created_by`),
  ADD KEY `lar_stock_transactions_reference_type_reference_id_index` (`reference_type`,`reference_id`);

--
-- Indexes for table `lar_suppliers`
--
ALTER TABLE `lar_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lar_users`
--
ALTER TABLE `lar_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lar_users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lar_analyses`
--
ALTER TABLE `lar_analyses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lar_categories`
--
ALTER TABLE `lar_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lar_coupons`
--
ALTER TABLE `lar_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lar_customers`
--
ALTER TABLE `lar_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lar_failed_jobs`
--
ALTER TABLE `lar_failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lar_jobs`
--
ALTER TABLE `lar_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lar_menus`
--
ALTER TABLE `lar_menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lar_migrations`
--
ALTER TABLE `lar_migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `lar_orders`
--
ALTER TABLE `lar_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `lar_order_items`
--
ALTER TABLE `lar_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `lar_permissions`
--
ALTER TABLE `lar_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `lar_personal_access_tokens`
--
ALTER TABLE `lar_personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `lar_products`
--
ALTER TABLE `lar_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lar_purchase_orders`
--
ALTER TABLE `lar_purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lar_purchase_order_items`
--
ALTER TABLE `lar_purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lar_restaurants`
--
ALTER TABLE `lar_restaurants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lar_restaurant_tables`
--
ALTER TABLE `lar_restaurant_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lar_roles`
--
ALTER TABLE `lar_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lar_stocks`
--
ALTER TABLE `lar_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `lar_stock_transactions`
--
ALTER TABLE `lar_stock_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lar_suppliers`
--
ALTER TABLE `lar_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lar_users`
--
ALTER TABLE `lar_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lar_model_has_permissions`
--
ALTER TABLE `lar_model_has_permissions`
  ADD CONSTRAINT `lar_model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `lar_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_model_has_roles`
--
ALTER TABLE `lar_model_has_roles`
  ADD CONSTRAINT `lar_model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `lar_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_orders`
--
ALTER TABLE `lar_orders`
  ADD CONSTRAINT `lar_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `lar_customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lar_orders_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `lar_restaurants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lar_orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `lar_restaurant_tables` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lar_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `lar_users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `lar_order_items`
--
ALTER TABLE `lar_order_items`
  ADD CONSTRAINT `lar_order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `lar_menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lar_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `lar_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_products`
--
ALTER TABLE `lar_products`
  ADD CONSTRAINT `lar_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `lar_categories` (`id`),
  ADD CONSTRAINT `lar_products_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `lar_suppliers` (`id`);

--
-- Constraints for table `lar_purchase_orders`
--
ALTER TABLE `lar_purchase_orders`
  ADD CONSTRAINT `lar_purchase_orders_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `lar_users` (`id`),
  ADD CONSTRAINT `lar_purchase_orders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `lar_users` (`id`),
  ADD CONSTRAINT `lar_purchase_orders_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `lar_suppliers` (`id`);

--
-- Constraints for table `lar_purchase_order_items`
--
ALTER TABLE `lar_purchase_order_items`
  ADD CONSTRAINT `lar_purchase_order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `lar_products` (`id`),
  ADD CONSTRAINT `lar_purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `lar_purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_restaurant_tables`
--
ALTER TABLE `lar_restaurant_tables`
  ADD CONSTRAINT `lar_restaurant_tables_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `lar_restaurants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_role_has_permissions`
--
ALTER TABLE `lar_role_has_permissions`
  ADD CONSTRAINT `lar_role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `lar_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lar_role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `lar_roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_stocks`
--
ALTER TABLE `lar_stocks`
  ADD CONSTRAINT `lar_stocks_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `lar_menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lar_stock_transactions`
--
ALTER TABLE `lar_stock_transactions`
  ADD CONSTRAINT `lar_stock_transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `lar_users` (`id`),
  ADD CONSTRAINT `lar_stock_transactions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `lar_products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
