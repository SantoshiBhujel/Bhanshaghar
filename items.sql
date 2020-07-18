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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `menus_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `menus_id`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Apple Pie', 400, 10, 'apple pie_1586577978_1592387670.jpg', '2020-06-17 04:09:30', '2020-06-17 04:09:30', NULL),
(2, 'Avocado Lassi', 190, 8, 'avocadolassi_1585794430_1592387708.jpg', '2020-06-17 04:10:08', '2020-06-17 04:10:08', NULL),
(3, 'Banana Lassi', 90, 8, 'bananalassi_1585794468_1592387725.jpg', '2020-06-17 04:10:25', '2020-06-17 04:10:25', NULL),
(4, 'Chicken Burger', 220, 9, 'burger_1585584266_1592387749.jpg', '2020-06-17 04:10:49', '2020-06-17 04:10:49', NULL),
(5, 'Cappuccino', 150, 5, 'Cappuccino_1585585590_1592387782.jpg', '2020-06-17 04:11:22', '2020-06-17 04:11:22', NULL),
(6, 'Cheese Pizza', 450, 6, 'cheesepizza_1585585658_1592387800.jpg', '2020-06-17 04:11:40', '2020-06-17 04:11:40', NULL),
(8, 'Chicken Chowmein', 190, 2, 'chickenchowmein_1585585021_1592387869.jpg', '2020-06-17 04:12:49', '2020-06-17 04:12:49', NULL),
(9, 'Chicken Momo', 200, 1, 'chickencmomo_1585619594_1592387898.jpg', '2020-06-17 04:13:18', '2020-06-17 04:13:18', NULL),
(10, 'Chicken Fry Momo', 220, 1, 'chickenfrymomo_1585619574_1592387925.jpg', '2020-06-17 04:13:45', '2020-06-17 04:13:45', NULL),
(11, 'Chicken Jhol Momo', 250, 1, 'chickenJholMomo_1585619554_1592387947.jpg', '2020-06-17 04:14:07', '2020-06-17 04:14:07', NULL),
(12, 'Chicken Katti Roll', 150, 11, 'chickenkattiroll_1585585052_1592387966.png', '2020-06-17 04:14:26', '2020-06-17 04:14:26', NULL),
(14, 'Chicken Pizza', 550, 6, 'chickenpizza_1585586089_1592388017.jpg', '2020-06-17 04:15:17', '2020-06-17 04:15:17', NULL),
(15, 'Chocolate Surprise', 850, 3, 'chocolate surprise_1587045960_1592388095.jpg', '2020-06-17 04:16:35', '2020-06-17 04:16:35', NULL),
(16, 'Coke', 45, 4, 'coke_1585633425_1592388133.png', '2020-06-17 04:17:13', '2020-06-17 04:17:13', NULL),
(17, 'Crepe-Suzette', 450, 10, 'crepe-suzette_1586580529_1592388169.jpg', '2020-06-17 04:17:49', '2020-06-17 04:17:49', NULL),
(18, 'Diet Coke', 200, 4, 'dietcoke_1585585525_1592396364.png', '2020-06-17 06:34:24', '2020-06-17 06:34:24', NULL),
(19, 'Egg Katti Roll', 120, 11, 'eggkattiroll_1585585115_1592396407.jpg', '2020-06-17 06:35:07', '2020-06-17 06:35:07', NULL),
(20, 'Fanta', 70, 4, 'fanta_1585619984_1592396445.jpg', '2020-06-17 06:35:45', '2020-06-17 06:35:45', NULL),
(21, 'Fruit Garnish', 800, 3, 'fruit garnished_1587046337_1592396499.jpg', '2020-06-17 06:36:39', '2020-06-17 06:36:39', NULL),
(22, 'Hamachi Sushi', 550, 7, 'hamachisushi_1585585082_1592396533.jpg', '2020-06-17 06:37:13', '2020-06-17 06:37:13', NULL),
(23, 'Kesar Lassi', 200, 8, 'kesarlassi_1585794403_1592396557.jpg', '2020-06-17 06:37:37', '2020-06-17 06:37:37', NULL),
(24, 'Lemon Mering', 440, 10, 'lemon meringue_1586774289_1592396579.jpg', '2020-06-17 06:37:59', '2020-06-17 06:37:59', NULL),
(25, 'Mango Lassi', 70, 8, 'mangolassi_1585794485_1592396599.jpg', '2020-06-17 06:38:19', '2020-06-17 06:38:19', NULL),
(26, 'Mint Lassi', 120, 8, 'mintlassi_1585794504_1592396619.jpg', '2020-06-17 06:38:39', '2020-06-17 06:38:39', NULL),
(27, 'Mixed Chowmein', 130, 2, 'mixedchowmein_1585584914_1592396637.jpg', '2020-06-17 06:38:57', '2020-06-17 06:38:57', NULL),
(28, 'Molten Chocolate Pudding', 220, 10, 'molten chocolate pudding_1587043448_1592396671.jpg', '2020-06-17 06:39:31', '2020-06-17 06:39:31', NULL),
(29, 'Mushroom Pizza', 450, 6, 'mushroompizza_1585619630_1592396689.jpg', '2020-06-17 06:39:49', '2020-06-17 06:39:49', NULL),
(30, 'Orange Pound', 400, 10, 'oragne pound_1587046260_1592396711.jpg', '2020-06-17 06:40:11', '2020-06-17 06:40:11', NULL),
(31, 'Papaya Lassi', 100, 8, 'papayalassi_1585794533_1592396741.jpg', '2020-06-17 06:40:41', '2020-06-17 06:40:41', NULL),
(32, 'Peperoni Pizza', 650, 6, 'pepperonipizza_1585633588_1592396766.jpg', '2020-06-17 06:41:06', '2020-06-17 06:41:06', NULL),
(33, 'Piñata Surprise Cake', 750, 3, 'piñata surprise cake_1587043542_1592396800.jpg', '2020-06-17 06:41:40', '2020-06-17 06:41:40', NULL),
(34, 'Red Velvet Cake', 1000, 3, 'red velvet_1587046417_1592396821.jpg', '2020-06-17 06:42:01', '2020-06-17 06:42:01', NULL),
(35, 'Shrimp Sushi', 500, 7, 'shrimpsushi_1585585877_1592396852.jpg', '2020-06-17 06:42:32', '2020-06-17 06:42:32', NULL),
(36, 'Sprite', 70, 4, 'sprite_1585586041_1592396873.jpg', '2020-06-17 06:42:53', '2020-06-17 06:42:53', NULL),
(37, 'Strawberry Tuxedo', 650, 3, 'strawberry tuxedo_1587046479_1592396913.jpg', '2020-06-17 06:43:33', '2020-06-17 06:43:33', NULL),
(38, 'Strawberry Lassi', 120, 8, 'strawberrylassi_1585794595_1592396939.jpg', '2020-06-17 06:43:59', '2020-06-17 06:43:59', NULL),
(39, 'Tempura Sushi', 450, 7, 'tempurashrimpsushi_1585585150_1592396960.jpg', '2020-06-17 06:44:20', '2020-06-17 06:44:20', NULL),
(40, 'Triple Cheese Burger', 390, 9, 'triplecheeseburger_1585619880_1592396985.jpg', '2020-06-17 06:44:45', '2020-06-17 06:44:45', NULL),
(41, 'Tuna Sushi', 500, 7, 'tunasushi_1585584866_1592397004.jpg', '2020-06-17 06:45:04', '2020-06-17 06:45:04', NULL),
(42, 'Vanella Icecream', 200, 10, 'vanella icecream_1586774562_1592397030.jpg', '2020-06-17 06:45:30', '2020-06-17 06:45:30', NULL),
(43, 'Veg Chowmein', 90, 2, 'vegchowmein_1585584358_1592397065.jpg', '2020-06-17 06:46:05', '2020-06-17 06:46:05', NULL),
(44, 'Veg Jhol Momo', 120, 1, 'vegjholmomo_1585619656_1592397091.jpg', '2020-06-17 06:46:31', '2020-06-17 06:46:31', NULL),
(45, 'Veg Momo', 80, 1, 'vegmomo_1585580561_1592397113.jpg', '2020-06-17 06:46:53', '2020-06-17 06:46:53', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_name_unique` (`name`),
  ADD KEY `items_menus_id_index` (`menus_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
