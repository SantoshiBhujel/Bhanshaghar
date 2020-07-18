-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2020 at 05:27 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhanshaghar`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Momo', 'momos_1585552669_1592387355.jpg', '2020-06-17 04:04:15', '2020-06-17 04:04:15', NULL),
(2, 'Chowmein', 'chowmin_1585553071_1592387370.jpg', '2020-06-17 04:04:30', '2020-06-17 04:04:30', NULL),
(3, 'Cake', 'cake_1587043508_1592387381.jpg', '2020-06-17 04:04:41', '2020-06-17 04:04:41', NULL),
(4, 'Cold Drinks', 'cold drinks_1585585485_1592387400.jpg', '2020-06-17 04:05:00', '2020-06-17 04:05:00', NULL),
(5, 'Hot Drinks', 'hotdrinks_1585585502_1592387419.jpg', '2020-06-17 04:05:19', '2020-06-17 04:05:19', NULL),
(6, 'Pizza', 'd2_1585567508_1592387439.jpg', '2020-06-17 04:05:39', '2020-06-17 04:05:39', NULL),
(7, 'Sushi', 'image_1585581702_1592387455.jpeg', '2020-06-17 04:05:55', '2020-06-17 04:05:55', NULL),
(8, 'Lassi', 'lassi_1585794353_1592387472.jpg', '2020-06-17 04:06:12', '2020-06-17 04:06:12', NULL),
(9, 'Burger', 'd3_1585552959_1592387487.png', '2020-06-17 04:06:27', '2020-06-17 04:06:27', NULL),
(10, 'Dessert', 'dessert_1586577942_1592387500.jpg', '2020-06-17 04:06:40', '2020-06-17 04:06:40', NULL),
(11, 'Rolls', 'roll_1585553211_1592387526.jpg', '2020-06-17 04:07:06', '2020-06-17 04:07:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
