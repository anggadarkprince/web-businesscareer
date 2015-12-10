-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2015 at 11:33 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `businesscareer`
--

-- --------------------------------------------------------

--
-- Table structure for table `bc_account`
--

CREATE TABLE IF NOT EXISTS `bc_account` (
  `acn_id` int(11) NOT NULL,
  `acn_account` varchar(100) NOT NULL,
  `acn_position` enum('DEBITS','CREDITS') NOT NULL,
  `acn_type` enum('BALANCE','INCOME') NOT NULL,
  `acn_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `acn_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`acn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_account`
--

INSERT INTO `bc_account` (`acn_id`, `acn_account`, `acn_position`, `acn_type`, `acn_updated_at`, `acn_created_at`) VALUES
(111, '[Assets] Cash', 'DEBITS', 'BALANCE', '2014-11-14 10:40:57', '2014-11-14 10:40:57'),
(112, '[Assets] Cart, Sign, Equipment', 'DEBITS', 'BALANCE', '2014-11-14 10:40:57', '2014-11-14 10:40:57'),
(113, '[Assets] Inventory', 'DEBITS', 'BALANCE', '2014-11-14 10:40:57', '2014-11-14 10:40:57'),
(211, '[Liabilities and Equity] Loans', 'CREDITS', 'BALANCE', '2014-11-19 05:22:02', '2014-11-14 10:40:57'),
(311, '[Liabilities and Equity] Equity : Paid-in Capital', 'CREDITS', 'BALANCE', '2014-11-14 10:41:53', '2014-11-14 10:40:57'),
(411, '[Revenue] Sales', 'CREDITS', 'INCOME', '2014-11-14 10:40:57', '2014-11-14 10:40:57'),
(412, '[Revenue] Less, Cost of Goods Sold', 'CREDITS', 'INCOME', '2014-11-14 10:42:37', '2014-11-14 10:40:57'),
(511, '[Expense] Licence and Permits', 'DEBITS', 'INCOME', '2014-11-14 10:42:40', '2014-11-14 10:40:57'),
(512, '[Expense] Insurance', 'DEBITS', 'INCOME', '2014-11-14 10:42:43', '2014-11-14 10:40:57'),
(513, '[Expense] Interest on Loans', 'DEBITS', 'INCOME', '2014-11-14 10:42:43', '2014-11-14 10:40:57'),
(514, '[Expense] Payroll', 'DEBITS', 'INCOME', '2014-11-14 10:42:43', '2014-11-14 10:40:57'),
(515, '[Expense] Advertising : TV', 'DEBITS', 'INCOME', '2014-11-14 10:42:43', '2014-11-14 10:40:57'),
(516, '[Expense] Advertising : Radio', 'DEBITS', 'INCOME', '2014-11-14 10:42:43', '2014-11-14 10:40:57'),
(517, '[Expense] Advertising : Newspaper', 'DEBITS', 'INCOME', '2014-11-14 10:42:43', '2014-11-14 10:40:57'),
(518, '[Expense] Advertising : Internet', 'DEBITS', 'INCOME', '2014-11-14 10:42:43', '2014-11-14 10:40:57'),
(519, '[Expense] Advertising : Event', 'DEBITS', 'INCOME', '2014-11-14 10:42:43', '2014-11-14 10:40:57'),
(520, '[Expense] Advertising : Billboard', 'DEBITS', 'INCOME', '2014-11-14 10:45:51', '2014-11-14 10:40:57'),
(521, '[Expense] Repairs and Maintenance', 'DEBITS', 'INCOME', '2014-11-14 10:45:51', '2014-11-14 10:40:57'),
(522, '[Expense] Miscellaneous Expense', 'DEBITS', 'INCOME', '2014-11-14 10:45:51', '2014-11-14 10:40:57'),
(523, '[Expense] Marketing : Product Quality', 'DEBITS', 'INCOME', '2014-11-14 10:45:51', '2014-11-14 10:40:57'),
(524, '[Expense] Marketing : Product Appearance', 'DEBITS', 'INCOME', '2014-11-14 10:45:51', '2014-11-14 10:40:57'),
(525, '[Expense] Cart Transportation', 'DEBITS', 'INCOME', '2014-11-14 10:45:51', '2014-11-14 10:40:57'),
(526, '[Expense] Place Rental', 'DEBITS', 'INCOME', '2014-11-14 10:45:51', '2014-11-14 10:40:57'),
(527, '[Expense] Employee Training', 'DEBITS', 'INCOME', '2015-01-07 08:31:32', '2015-01-07 08:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `bc_achievement`
--

CREATE TABLE IF NOT EXISTS `bc_achievement` (
  `ach_id` int(11) NOT NULL AUTO_INCREMENT,
  `ach_achievement` varchar(45) NOT NULL,
  `ach_description` varchar(200) NOT NULL,
  `ach_reward` int(11) NOT NULL,
  `ach_atlas` varchar(45) NOT NULL,
  `ach_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ach_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ach_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bc_achievement`
--

INSERT INTO `bc_achievement` (`ach_id`, `ach_achievement`, `ach_description`, `ach_reward`, `ach_atlas`, `ach_updated_at`, `ach_created_at`) VALUES
(1, 'Sales', 'Achieved sales revenue of IDR 500 K or more in a day', 1800, 'icon_sales', '2015-01-08 11:21:59', '2014-11-13 15:34:17'),
(2, 'Location', 'Sold product at every location, including again a competitor', 2000, 'icon_location', '2015-01-08 11:22:05', '2014-11-13 15:34:17'),
(3, 'Inventory', 'Make perfect inventory number for 3 days in a row', 2000, 'icon_inventory', '2014-11-13 15:34:17', '2014-11-13 15:34:17'),
(4, 'Customer', 'Customer satisfaction at 90% or more for 7 days in a row', 1500, 'icon_magnify', '2015-01-08 11:22:13', '2014-11-13 15:34:17'),
(5, 'Stress', 'Keep stress level at 15% or less for 5 days in a row', 800, 'icon_clock', '2015-01-08 11:22:19', '2014-11-13 15:34:17'),
(6, 'Transaction', 'Reach 50 transaction for 5 days in row', 1000, 'icon_money', '2015-01-08 11:22:26', '2014-11-13 15:34:17'),
(7, 'Accounting', 'Don''t use hint feature in 7 days in row', 1200, 'icon_list', '2015-01-08 11:22:36', '2014-11-13 15:34:17'),
(8, 'Booster', 'Accomplish all booster feature in 5 level bar', 2000, 'icon_chart', '2014-11-13 15:34:17', '2014-11-13 15:34:17'),
(9, 'Market', 'Lead market share at 70% or more for 7 days in a row', 1800, 'icon_shop', '2015-01-08 11:22:42', '2014-11-13 15:34:17'),
(10, 'Master', 'Complete 20 question without fail in a row', 2000, 'icon_book', '2014-11-13 15:34:17', '2014-11-13 15:34:17');

-- --------------------------------------------------------

--
-- Table structure for table `bc_asset`
--

CREATE TABLE IF NOT EXISTS `bc_asset` (
  `ast_id` int(11) NOT NULL AUTO_INCREMENT,
  `ast_asset` varchar(45) NOT NULL,
  `ast_type` varchar(45) NOT NULL,
  `ast_atlas` varchar(45) NOT NULL,
  `ast_price` int(11) NOT NULL,
  `ast_level` tinyint(4) NOT NULL,
  `ast_economic` int(11) NOT NULL,
  `ast_description` varchar(200) NOT NULL,
  `ast_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ast_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ast_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `bc_asset`
--

INSERT INTO `bc_asset` (`ast_id`, `ast_asset`, `ast_type`, `ast_atlas`, `ast_price`, `ast_level`, `ast_economic`, `ast_description`, `ast_updated_at`, `ast_created_at`) VALUES
(1, 'Bike', 'Vehicle', 'asset_vehicle_bike', 500000, 1, 360, 'Upgrade kendaraan Level 1 memiliki kecepatan belanja 10 Km/Hours dan kapasitas belanja 3 Item / Delivery.', '2015-01-06 03:55:14', '2014-11-14 01:57:03'),
(2, 'Scooter', 'Vehicle', 'asset_vehicle_scooter', 8000000, 2, 720, 'Upgrade kendaraan Level 2 memiliki kecepatan belanja 40 Km/Hours dan kapasitas belanja 5 Item / Delivery.', '2015-01-06 03:55:19', '2014-11-14 01:57:03'),
(3, 'Wagon Motor', 'Vehicle', 'asset_vehicle_truck', 20000000, 3, 1080, 'Upgrade kendaraan Level 3 memiliki kecepatan belanja 60 Km/Hours dan kapasitas belanja 10 Item / Delivery.', '2015-01-06 03:55:27', '2014-11-14 01:57:03'),
(4, 'Mini Cupboard', 'Shelf', 'asset_shelf_mini', 200000, 1, 65, 'Upgrade tempat penyimpanan jenis material +10', '2015-01-06 03:55:51', '2014-11-14 02:04:49'),
(5, 'Medium Cupboard', 'Shelf', 'asset_shelf_medium', 250000, 2, 80, 'Upgrade tempat penyimpanan jenis material +20', '2015-01-06 03:56:03', '2014-11-14 02:04:49'),
(6, 'Medium Cupboard', 'Shelf', 'asset_shelf_large', 300000, 3, 120, 'Upgrade tempat penyimpanan jenis material +40', '2015-01-06 03:56:11', '2014-11-14 02:04:49'),
(7, 'Cute Shop', 'Shop', 'asset_shop_small', 3000000, 1, 230, 'Upgrade type toko, meingkatkan kapasitas +10 customer +5 popularity.', '2015-01-06 03:54:20', '2014-11-14 02:13:36'),
(8, 'Superior Shop', 'Shop', 'asset_shop_duluxe', 5000000, 2, 380, 'Upgrade type toko, meingkatkan kapasitas +15 customer +10 popularity.', '2015-01-06 03:54:51', '2014-11-14 02:13:36'),
(9, 'Deluxe Shop', 'Shop', 'asset_shop_luxury', 8000000, 3, 403, 'Upgrade type toko, meingkatkan kapasitas +15 customer +20 popularity.', '2015-01-06 03:54:45', '2014-11-14 02:13:36'),
(10, 'Stove', 'Productivity', 'asset_productivity_stove', 200000, 1, 160, 'Upgrade kompor Level 1, meingkatkan serve variable +2', '2015-01-06 03:56:50', '2014-11-14 02:17:40'),
(11, 'Electric Stove', 'Productivity', 'asset_productivity_electric_stove', 350000, 2, 120, 'Upgrade kompor Level 2, meingkatkan serve variable +3', '2015-01-06 03:57:04', '2014-11-14 02:17:40'),
(12, 'Gas Stove', 'Productivity', 'asset_productivity_gas_stove', 500000, 3, 230, 'Upgrade kompor Level 3, meingkatkan serve variable +5', '2015-01-06 03:57:00', '2014-11-14 02:17:40'),
(13, 'Box', 'Storage', 'asset_storage_box', 1100000, 1, 300, 'Upgrade tempat penyimpanan Level 1, meningkatkan masa expired +1 Days', '2015-01-06 03:57:24', '2014-11-14 02:23:02'),
(14, 'Refrigerator', 'Storage', 'asset_storage_cooker', 2000000, 2, 230, 'Upgrade tempat penyimpanan Level 2, meningkatkan masa expired +3 Days', '2015-01-06 03:57:31', '2014-11-14 02:23:02'),
(15, 'Freezer', 'Storage', 'asset_storage_refrigerator', 3000000, 3, 300, 'Upgrade tempat penyimpanan Level 2, meningkatkan masa expired +5 Days', '2015-01-06 03:57:45', '2014-11-14 02:23:02'),
(16, 'Monalisa Painting', 'Accessory', 'asset_accessory_frame', 4000000, 1, 50, 'Dekorasi toko Level 1 +5 Customer Interest', '2015-01-06 03:53:13', '2014-11-14 02:28:27'),
(17, 'Spectrum Candle', 'Accessory', 'asset_accessory_spectrum_candle', 2500000, 2, 120, 'Dekorasi toko Level 1 +10 Customer Interest', '2015-01-06 03:53:20', '2014-11-14 02:28:27'),
(18, 'Wall Sticker', 'Accessory', 'asset_accessory_wall', 3000000, 3, 340, 'Dekorasi toko Level 1 +15 Customer Interest', '2015-01-06 03:53:33', '2014-11-14 02:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `bc_employee`
--

CREATE TABLE IF NOT EXISTS `bc_employee` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(45) NOT NULL,
  `emp_profile` varchar(150) NOT NULL,
  `emp_salary_goal` int(11) NOT NULL,
  `emp_education` varchar(150) NOT NULL,
  `emp_experience` varchar(150) NOT NULL,
  `emp_atlas` varchar(45) NOT NULL,
  `emp_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `emp_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bc_employee`
--

INSERT INTO `bc_employee` (`emp_id`, `emp_name`, `emp_profile`, `emp_salary_goal`, `emp_education`, `emp_experience`, `emp_atlas`, `emp_updated_at`, `emp_created_at`) VALUES
(1, 'Dian Sastro', 'Veteran Street 34\r\nGreen City\r\nWanita\r\n28 Tahun', 35000, 'Universitas Green City', 'Smart Cafe Maid\r\nBurger King Cashier', 'employee_dian_sastro', '2014-11-17 07:16:49', '2014-11-13 16:52:05'),
(2, 'Franda Stefanus', 'Avenue Street 10\r\nGreen City\r\nWanita\r\n23 Tahun', 30000, 'SMA Negeri 4 Green City', 'Quick Food Maid', 'employee_franda_stefanus', '2014-11-17 07:17:01', '2014-11-13 16:52:05'),
(3, 'David Kurnia', 'Wall Street 4\r\nBukit Awan\r\nLaki - laki\r\n25 Tahun', 25000, 'SMK Negeri 3 Green City', 'Electric Engineering', 'employee_david_kurnia', '2014-11-17 07:18:06', '2014-11-13 16:52:05'),
(4, 'Dhini Aminarti', 'Veteran 30\r\nSouzi Land\r\nWanita\r\n30 Tahun', 20000, 'SMA Negeri 3 Green City', 'No Experience', 'employee_dhini_aminarti', '2014-11-17 07:17:56', '2014-11-13 16:52:05'),
(5, 'Christian Sugiono', 'Kartini 12\r\nIndah Cermai\r\nLaki - laki\r\n40 Tahun', 50000, 'SMA Negeri 3 Green City', 'McD Cashier\r\nQuick Chicken Chef', 'employee_christian_sugiono', '2014-11-17 07:18:16', '2014-11-13 16:52:05'),
(6, 'Reza Radhian', 'Coral 9\r\nGreen City\r\nLaki - laki\r\n18 Tahun', 25000, 'SMA Negeri 3 Green City', 'Cafe Singer', 'employee_reza_radhian', '2014-11-17 07:17:35', '2014-11-13 16:52:05'),
(7, 'Vino Sebastian', 'Boston 70\r\nIndah Cermai\r\nLaki - laki\r\n15 Tahun', 20000, 'SMP Negeri 1 Green City', 'No Experience', 'employee_vino_sebastian', '2014-11-17 07:17:21', '2014-11-13 16:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `bc_game_data`
--

CREATE TABLE IF NOT EXISTS `bc_game_data` (
  `gme_player` int(11) NOT NULL,
  `gme_playtime` int(11) NOT NULL DEFAULT '1',
  `gme_point` int(11) NOT NULL DEFAULT '0',
  `gme_cash` int(11) NOT NULL DEFAULT '0',
  `gme_customer` int(11) NOT NULL DEFAULT '0',
  `gme_advisor` varchar(45) NOT NULL DEFAULT 'advisor2',
  `gme_personal_objective` text,
  `gme_business_plan` text,
  `gme_financing` enum('DEBT','EQUITY') NOT NULL DEFAULT 'DEBT',
  `gme_instalment` int(11) NOT NULL DEFAULT '0',
  `gme_weather` text,
  `gme_event` text,
  `gme_task` text,
  `gme_booster` varchar(45) NOT NULL DEFAULT '[0,0,0,0]',
  `gme_avatar_name` varchar(45) NOT NULL DEFAULT 'Player',
  `gme_avatar_data` varchar(45) NOT NULL DEFAULT '0,1,1,1,1',
  `gme_motivation` varchar(200) NOT NULL DEFAULT 'No pain, no gain',
  `shp_name` varchar(45) NOT NULL DEFAULT 'Djanggo Cafe',
  `shp_logo` varchar(45) NOT NULL DEFAULT 'logo2',
  `shp_district` varchar(45) NOT NULL DEFAULT 'Town Hall',
  `shp_schedule` varchar(200) NOT NULL DEFAULT '[[8,15],[9,18],[9,19],[8,18],[8,18],[8,18],[9,15]]',
  `shp_decoration` varchar(100) NOT NULL DEFAULT '[1,1,1]',
  `shp_scent` varchar(100) NOT NULL DEFAULT '[1,1,1]',
  `shp_cleanness` varchar(100) NOT NULL DEFAULT '[1,1]',
  `shp_sales_today` int(11) NOT NULL DEFAULT '0',
  `shp_sales_total` int(11) NOT NULL DEFAULT '0',
  `shp_research_data` varchar(45) NOT NULL DEFAULT '[0,0,0,0,0]',
  `shp_program_data` varchar(45) NOT NULL DEFAULT '[0,0,0,0,0,0,0,0,0]',
  `shp_advertising_data` varchar(200) NOT NULL DEFAULT '[[1,"NONE","NONE"],[2,"NONE","NONE"],[3,"NONE","NONE"],[4,"NONE","NONE"],[5,"NONE","NONE"],[6,"NONE","NONE"]]',
  `par_population` int(11) NOT NULL DEFAULT '200',
  `par_weather` int(11) NOT NULL DEFAULT '7',
  `par_event` int(11) NOT NULL DEFAULT '4',
  `par_competitor` int(11) NOT NULL DEFAULT '2',
  `par_social` int(11) NOT NULL DEFAULT '8',
  `par_addicted` int(11) NOT NULL DEFAULT '8',
  `par_buying` int(11) NOT NULL DEFAULT '7',
  `par_emotion` int(11) NOT NULL DEFAULT '6',
  `gme_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `gme_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`gme_player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bc_game_data`
--

INSERT INTO `bc_game_data` (`gme_player`, `gme_playtime`, `gme_point`, `gme_cash`, `gme_customer`, `gme_advisor`, `gme_personal_objective`, `gme_business_plan`, `gme_financing`, `gme_instalment`, `gme_weather`, `gme_event`, `gme_task`, `gme_booster`, `gme_avatar_name`, `gme_avatar_data`, `gme_motivation`, `shp_name`, `shp_logo`, `shp_district`, `shp_schedule`, `shp_decoration`, `shp_scent`, `shp_cleanness`, `shp_sales_today`, `shp_sales_total`, `shp_research_data`, `shp_program_data`, `shp_advertising_data`, `par_population`, `par_weather`, `par_event`, `par_competitor`, `par_social`, `par_addicted`, `par_buying`, `par_emotion`, `gme_updated_at`, `gme_created_at`) VALUES
(1, 1, 22800, 3150000, 0, 'advisor2', 'Personal Profile...\n\nFinancial Target...\n\nStress...\n\nTime...\n\nBusiness...\n\nCareer...', 'Executive summary...\n\nThe Opportunity...\n\nThe Product...\n\nThe Company...\n\nFinancial Projection...\n\nPromotion...', 'DEBT', 8000000, '[[8,44,"Hot","weather_hot","avg","0.6"],[6,37,"Sunny","weather_sunny","good","1"],[4,29,"Cloudy","weather_cloudy","normal","0.8"]]', '[[16,"Product Demo",8,12,"avg",[{"y":17,"x":17},{"y":18,"x":17},{"y":19,"x":17},{"y":20,"x":17}],["XMLList","XMLList","XMLList"]]]', '[["journal",200,"Kamu membeli cart toko. post transaksi 100000. post transaksi","task_journal","XMLList"]]', '[0,0,0,0]', 'Angga Ari Wijaya', '[0,0,0,0,0]', 'Brand new day', 'Angga Shop', 'logo2', 'Green Ville', '[[8,15],[9,18],[9,19],[8,18],[8,18],[8,18],[9,15]]', '[1,1,1]', '[1,1,1]', '[1,1]', 0, 0, '[1,0,0,0,0]', '[0,0,0,0,0,0,0,0,0]', '[[1,2,0],[2,2,0],[3,2,2],[4,2,0],[5,1,1],[6,2,1]]', 200, 7, 4, 2, 8, 8, 7, 6, '2015-01-08 14:25:34', '2015-01-08 12:04:22'),
(2, 1, 2800, 3150000, 0, 'advisor2', 'Personal Profile...\n\nFinancial Target...\n\nStress...\n\nTime...\n\nBusiness...\n\nCareer...', 'Executive summary...\n\nThe Opportunity...\n\nThe Product...\n\nThe Company...\n\nFinancial Projection...\n\nPromotion...', 'DEBT', 8000000, '[[7,40,"Overcast","weather_overcast","normal","0.8"],[8,46,"Hot","weather_hot","avg","0.6"],[9,55,"Heat up","weather_heat_up","bad","0.4"]]', '[]', '[["upgrade",500,"Upgrade asset Vehicle menjadi level 2","task_upgrade","Vehicle",2],["selling",200,"Lakukan penjualan dengan total 150000","task_selling",150000],["order",300,"Siapkan Material ''Rice'' sebanyak 60 buah","task_order",1,60]]', '[0,0,0,0]', 'Desi', '[1,0,0,0,0]', 'Brand new day', 'Desi Shop', 'logo2', 'Green Ville', '[[8,15],[9,18],[9,19],[8,18],[8,18],[8,18],[9,15]]', '[1,1,1]', '[1,1,1]', '[1,1]', 0, 0, '[0,0,0,0,0]', '[0,0,0,0,0,0,0,0,0]', '[[1,0,0],[2,0,0],[3,0,0],[4,0,0],[5,0,0],[6,0,0]]', 200, 7, 4, 2, 8, 8, 7, 6, '2015-01-08 15:01:20', '2015-01-08 15:00:13'),
(3, 1, 3300, 2960000, 0, 'advisor2', 'Personal Profile...\n\nFinancial Target...\n\nStress...\n\nTime...\n\nBusiness...\n\nCareer...', 'Executive summary...\n\nThe Opportunity...\n\nThe Product...\n\nThe Company...\n\nFinancial Projection...\n\nPromotion...', 'DEBT', 8000000, '[[5,34,"Clammy","weather_clammy","good","1"],[6,36,"Sunny","weather_sunny","good","1"],[3,19,"Rain","weather_rain","avg","0.6"]]', '[[13,"Job Fair",9,14,"avg",[{"y":25,"x":14},{"y":26,"x":14},{"y":27,"x":14},{"y":28,"x":14},{"y":27,"x":8},{"y":27,"x":9},{"y":27,"x":10},{"y":27,"x":11},{"y":27,"x":12},{"y":26,"x":12},{"y":23,"x":12},{"y":24,"x":12},{"y":25,"x":12}],["XMLList","XMLList","XMLList"]]]', '[["upgrade",500,"Upgrade asset Vehicle menjadi level 2","task_upgrade","Vehicle",2],["selling",200,"Lakukan penjualan dengan total 150000","task_selling",150000],["order",300,"Siapkan Material ''Rice'' sebanyak 60 buah","task_order",1,60]]', '[0,0,0,0]', 'Rina Riyana', '[0,0,0,0,0]', 'Brand new day', 'Rina Shop', 'logo2', 'Green Ville', '[[8,20],[9,18],[9,19],[8,18],[8,18],[8,18],[9,15]]', '[1,1,1]', '[1,1,1]', '[1,1]', 0, 0, '[0,0,0,0,0]', '[0,0,0,0,0,0,0,0,0]', '[[1,0,0],[2,0,0],[3,0,0],[4,0,0],[5,0,0],[6,0,0]]', 200, 7, 10, 2, 8, 8, 7, 6, '2015-01-09 00:54:38', '2015-01-08 16:04:05'),
(5, 1, 1400, 3150000, 0, 'advisor3', 'Personal Profile...\n\nFinancial Target...\n\nStress...\n\nTime...\n\nBusiness...\n\nCareer...', 'Executive summary...\n\nThe Opportunity...\n\nThe Product...\n\nThe Company...\n\nFinancial Projection...\n\nPromotion...', 'DEBT', 8000000, '[[9,54,"Heat up","weather_heat_up","bad","0.4"],[5,35,"Clammy","weather_clammy","good","1"],[7,40,"Overcast","weather_overcast","normal","0.8"]]', '[]', '[["journal",200,"Kamu menerima pinjaman [value]. Post transaksi","task_journal","Loan"],["upgrade",500,"Upgrade asset Vehicle menjadi level 2","task_upgrade","Vehicle",2],["selling",200,"Lakukan penjualan dengan total 150000","task_selling",150000],["order",300,"Siapkan Material ''Rice'' sebanyak 60 buah","task_order",1,60]]', '[0,0,0,0]', 'Eka Adji', '[0,2,0,2,2]', 'Brand new day', 'Eka Shop', 'logo3', 'Green Ville', '[[8,15],[9,18],[9,19],[8,18],[8,18],[8,18],[9,15]]', '[1,1,1]', '[1,1,1]', '[1,1]', 0, 0, '[0,0,0,0,0]', '[0,0,0,0,0,0,0,0,0]', '[[1,0,0],[2,0,0],[3,0,0],[4,0,0],[5,0,0],[6,0,0]]', 200, 7, 4, 2, 10, 8, 7, 6, '2015-01-09 02:12:30', '2015-01-09 02:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `bc_journal`
--

CREATE TABLE IF NOT EXISTS `bc_journal` (
  `jrl_id` int(11) NOT NULL AUTO_INCREMENT,
  `jrl_player` int(11) NOT NULL,
  `jrl_account` int(11) NOT NULL,
  `jrl_key` varchar(45) NOT NULL,
  `jrl_description` varchar(300) NOT NULL,
  `jrl_debit` double NOT NULL DEFAULT '0',
  `jrl_credit` double NOT NULL DEFAULT '0',
  `jrl_day` int(11) NOT NULL,
  `jrl_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jrl_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`jrl_id`,`jrl_player`,`jrl_account`),
  KEY `fk_bc_journal_bc_account_idx` (`jrl_account`),
  KEY `fk_bc_journal_bc_player1_idx` (`jrl_player`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

--
-- Dumping data for table `bc_journal`
--

INSERT INTO `bc_journal` (`jrl_id`, `jrl_player`, `jrl_account`, `jrl_key`, `jrl_description`, `jrl_debit`, `jrl_credit`, `jrl_day`, `jrl_updated_at`, `jrl_created_at`) VALUES
(15, 1, 111, '54ae725b5a902', 'Melakukan pinjaman usaha', 8000000, 0, 1, '2015-01-08 12:04:43', '2015-01-08 12:04:43'),
(16, 1, 211, '54ae725b5a902', 'Melakukan pinjaman usaha', 0, 8000000, 1, '2015-01-08 12:04:43', '2015-01-08 12:04:43'),
(17, 1, 111, '54ae725fe2931', 'Menyetor tabungan modal usaha', 2000000, 0, 1, '2015-01-08 12:04:47', '2015-01-08 12:04:47'),
(18, 1, 311, '54ae725fe2931', 'Menyetor tabungan modal usaha', 0, 2000000, 1, '2015-01-08 12:04:47', '2015-01-08 12:04:47'),
(19, 1, 112, '54ae7264b0caf', 'Membeli toko', 5000000, 0, 1, '2015-01-08 12:04:52', '2015-01-08 12:04:52'),
(20, 1, 111, '54ae7264b0caf', 'Membeli toko', 0, 5000000, 1, '2015-01-08 12:04:52', '2015-01-08 12:04:52'),
(21, 1, 112, '54ae72694c790', 'Membeli perlengkapan toko', 300000, 0, 1, '2015-01-08 12:04:57', '2015-01-08 12:04:57'),
(22, 1, 111, '54ae72694c790', 'Membeli perlengkapan toko', 0, 300000, 1, '2015-01-08 12:04:57', '2015-01-08 12:04:57'),
(23, 1, 511, '54ae726db0989', 'Membayar perizinan toko', 750000, 0, 1, '2015-01-08 12:05:01', '2015-01-08 12:05:01'),
(24, 1, 111, '54ae726db0989', 'Membayar perizinan toko', 0, 750000, 1, '2015-01-08 12:05:01', '2015-01-08 12:05:01'),
(25, 1, 112, '54ae727291214', 'Membayar pembuatan logo', 500000, 0, 1, '2015-01-08 12:05:06', '2015-01-08 12:05:06'),
(26, 1, 111, '54ae727291214', 'Membayar pembuatan logo', 0, 500000, 1, '2015-01-08 12:05:06', '2015-01-08 12:05:06'),
(27, 1, 512, '54ae727687df5', 'Membayar asuransi bisnis', 300000, 0, 1, '2015-01-08 12:05:10', '2015-01-08 12:05:10'),
(28, 1, 111, '54ae727687df5', 'Membayar asuransi bisnis', 0, 300000, 1, '2015-01-08 12:05:10', '2015-01-08 12:05:10'),
(59, 2, 111, '54ae9b9aacb86', 'Melakukan pinjaman usaha', 8000000, 0, 1, '2015-01-08 15:00:42', '2015-01-08 15:00:42'),
(60, 2, 211, '54ae9b9aacb86', 'Melakukan pinjaman usaha', 0, 8000000, 1, '2015-01-08 15:00:42', '2015-01-08 15:00:42'),
(61, 2, 111, '54ae9b9f398c9', 'Menyetor tabungan modal usaha', 2000000, 0, 1, '2015-01-08 15:00:47', '2015-01-08 15:00:47'),
(62, 2, 311, '54ae9b9f398c9', 'Menyetor tabungan modal usaha', 0, 2000000, 1, '2015-01-08 15:00:47', '2015-01-08 15:00:47'),
(63, 2, 112, '54ae9ba51c559', 'Membeli toko', 5000000, 0, 1, '2015-01-08 15:00:53', '2015-01-08 15:00:53'),
(64, 2, 111, '54ae9ba51c559', 'Membeli toko', 0, 5000000, 1, '2015-01-08 15:00:53', '2015-01-08 15:00:53'),
(65, 2, 112, '54ae9ba96a080', 'Membeli perlengkapan toko', 300000, 0, 1, '2015-01-08 15:00:57', '2015-01-08 15:00:57'),
(66, 2, 111, '54ae9ba96a080', 'Membeli perlengkapan toko', 0, 300000, 1, '2015-01-08 15:00:57', '2015-01-08 15:00:57'),
(67, 2, 511, '54ae9bad85303', 'Membayar perizinan toko', 750000, 0, 1, '2015-01-08 15:01:01', '2015-01-08 15:01:01'),
(68, 2, 111, '54ae9bad85303', 'Membayar perizinan toko', 0, 750000, 1, '2015-01-08 15:01:01', '2015-01-08 15:01:01'),
(69, 2, 112, '54ae9bb1f261a', 'Membayar pembuatan logo', 500000, 0, 1, '2015-01-08 15:01:05', '2015-01-08 15:01:05'),
(70, 2, 111, '54ae9bb1f261a', 'Membayar pembuatan logo', 0, 500000, 1, '2015-01-08 15:01:06', '2015-01-08 15:01:06'),
(71, 2, 512, '54ae9bb77a95d', 'Membayar asuransi bisnis', 300000, 0, 1, '2015-01-08 15:01:11', '2015-01-08 15:01:11'),
(72, 2, 111, '54ae9bb77a95d', 'Membayar asuransi bisnis', 0, 300000, 1, '2015-01-08 15:01:11', '2015-01-08 15:01:11'),
(73, 3, 111, '54aeaa880a4cc', 'Melakukan pinjaman usaha', 8000000, 0, 1, '2015-01-08 16:04:24', '2015-01-08 16:04:24'),
(74, 3, 211, '54aeaa880a4cc', 'Melakukan pinjaman usaha', 0, 8000000, 1, '2015-01-08 16:04:24', '2015-01-08 16:04:24'),
(75, 3, 111, '54aeaa8c64346', 'Menyetor tabungan modal usaha', 2000000, 0, 1, '2015-01-08 16:04:28', '2015-01-08 16:04:28'),
(76, 3, 311, '54aeaa8c64346', 'Menyetor tabungan modal usaha', 0, 2000000, 1, '2015-01-08 16:04:28', '2015-01-08 16:04:28'),
(77, 3, 112, '54aeaa913d743', 'Membeli toko', 5000000, 0, 1, '2015-01-08 16:04:33', '2015-01-08 16:04:33'),
(78, 3, 111, '54aeaa913d743', 'Membeli toko', 0, 5000000, 1, '2015-01-08 16:04:33', '2015-01-08 16:04:33'),
(79, 3, 112, '54aeaa9676e66', 'Membeli perlengkapan toko', 300000, 0, 1, '2015-01-08 16:04:38', '2015-01-08 16:04:38'),
(80, 3, 111, '54aeaa9676e66', 'Membeli perlengkapan toko', 0, 300000, 1, '2015-01-08 16:04:38', '2015-01-08 16:04:38'),
(81, 3, 511, '54aeaa9b36065', 'Membayar perizinan toko', 750000, 0, 1, '2015-01-08 16:04:43', '2015-01-08 16:04:43'),
(82, 3, 111, '54aeaa9b36065', 'Membayar perizinan toko', 0, 750000, 1, '2015-01-08 16:04:43', '2015-01-08 16:04:43'),
(83, 3, 112, '54aeaa9fc527b', 'Membayar pembuatan logo', 500000, 0, 1, '2015-01-08 16:04:47', '2015-01-08 16:04:47'),
(84, 3, 111, '54aeaa9fc527b', 'Membayar pembuatan logo', 0, 500000, 1, '2015-01-08 16:04:47', '2015-01-08 16:04:47'),
(85, 3, 512, '54aeaaa435a6f', 'Membayar asuransi bisnis', 300000, 0, 1, '2015-01-08 16:04:52', '2015-01-08 16:04:52'),
(86, 3, 111, '54aeaaa435a6f', 'Membayar asuransi bisnis', 0, 300000, 1, '2015-01-08 16:04:52', '2015-01-08 16:04:52'),
(87, 3, 113, '54aeac907803f', 'Membeli material', 190000, 0, 1, '2015-01-08 16:13:04', '2015-01-08 16:13:04'),
(88, 3, 111, '54aeac907803f', 'Membeli material', 0, 190000, 1, '2015-01-08 16:13:04', '2015-01-08 16:13:04'),
(89, 3, 522, '54af309964c8b', 'Membayar keperluan marketing', 500000, 0, 1, '2015-01-09 01:36:25', '2015-01-09 01:36:25'),
(90, 3, 111, '54af309964c8b', 'Membayar keperluan marketing', 0, 500000, 1, '2015-01-09 01:36:25', '2015-01-09 01:36:25'),
(91, 3, 113, '54af30b0da3a0', 'Membeli material', 15000, 0, 1, '2015-01-09 01:36:48', '2015-01-09 01:36:48'),
(92, 3, 111, '54af30b0da3a0', 'Membeli material', 0, 15000, 1, '2015-01-09 01:36:48', '2015-01-09 01:36:48'),
(93, 3, 522, '54af32e298253', 'Membayar keperluan marketing', 500000, 0, 1, '2015-01-09 01:46:10', '2015-01-09 01:46:10'),
(94, 3, 111, '54af32e298253', 'Membayar keperluan marketing', 0, 500000, 1, '2015-01-09 01:46:10', '2015-01-09 01:46:10'),
(95, 5, 111, '54af38f27613c', 'Melakukan pinjaman usaha', 8000000, 0, 1, '2015-01-09 02:12:02', '2015-01-09 02:12:02'),
(96, 5, 211, '54af38f27613c', 'Melakukan pinjaman usaha', 0, 8000000, 1, '2015-01-09 02:12:02', '2015-01-09 02:12:02'),
(97, 5, 111, '54af38f73533a', 'Menyetor tabungan modal usaha', 2000000, 0, 1, '2015-01-09 02:12:07', '2015-01-09 02:12:07'),
(98, 5, 311, '54af38f73533a', 'Menyetor tabungan modal usaha', 0, 2000000, 1, '2015-01-09 02:12:07', '2015-01-09 02:12:07'),
(99, 5, 112, '54af38fbc02e7', 'Membeli toko', 5000000, 0, 1, '2015-01-09 02:12:11', '2015-01-09 02:12:11'),
(100, 5, 111, '54af38fbc02e7', 'Membeli toko', 0, 5000000, 1, '2015-01-09 02:12:11', '2015-01-09 02:12:11'),
(101, 5, 112, '54af390030b03', 'Membeli perlengkapan toko', 300000, 0, 1, '2015-01-09 02:12:16', '2015-01-09 02:12:16'),
(102, 5, 111, '54af390030b03', 'Membeli perlengkapan toko', 0, 300000, 1, '2015-01-09 02:12:16', '2015-01-09 02:12:16'),
(103, 5, 511, '54af3904df8ee', 'Membayar perizinan toko', 750000, 0, 1, '2015-01-09 02:12:20', '2015-01-09 02:12:20'),
(104, 5, 111, '54af3904df8ee', 'Membayar perizinan toko', 0, 750000, 1, '2015-01-09 02:12:20', '2015-01-09 02:12:20'),
(105, 5, 112, '54af39098605b', 'Membayar pembuatan logo', 500000, 0, 1, '2015-01-09 02:12:25', '2015-01-09 02:12:25'),
(106, 5, 111, '54af39098605b', 'Membayar pembuatan logo', 0, 500000, 1, '2015-01-09 02:12:25', '2015-01-09 02:12:25'),
(107, 5, 512, '54af390e4cb71', 'Membayar asuransi bisnis', 300000, 0, 1, '2015-01-09 02:12:30', '2015-01-09 02:12:30'),
(108, 5, 111, '54af390e4cb71', 'Membayar asuransi bisnis', 0, 300000, 1, '2015-01-09 02:12:30', '2015-01-09 02:12:30');

-- --------------------------------------------------------

--
-- Table structure for table `bc_log`
--

CREATE TABLE IF NOT EXISTS `bc_log` (
  `lgg_id` int(11) NOT NULL AUTO_INCREMENT,
  `lgg_player` int(11) NOT NULL,
  `lgg_module` varchar(45) NOT NULL,
  `lgg_operation` varchar(45) NOT NULL,
  `lgg_value` text NOT NULL,
  `lgg_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lgg_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lgg_id`,`lgg_player`),
  KEY `fk_bc_logging_bc_player1_idx` (`lgg_player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bc_material`
--

CREATE TABLE IF NOT EXISTS `bc_material` (
  `mtr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mtr_item` varchar(45) NOT NULL,
  `mtr_type` varchar(45) NOT NULL,
  `mtr_expired_at` int(11) NOT NULL,
  `mtr_price` int(11) NOT NULL,
  `mtr_atlas` varchar(45) NOT NULL,
  `mtr_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mtr_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mtr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `bc_material`
--

INSERT INTO `bc_material` (`mtr_id`, `mtr_item`, `mtr_type`, `mtr_expired_at`, `mtr_price`, `mtr_atlas`, `mtr_updated_at`, `mtr_created_at`) VALUES
(1, 'Rice', 'Primary', 1, 3000, 'material_rice', '2014-11-13 18:46:51', '2014-11-13 18:46:51'),
(2, 'Noodle', 'Primary', 1, 2500, 'material_noodle', '2014-11-13 18:46:51', '2014-11-13 18:46:51'),
(3, 'Fried Garnish', 'Secondary', 1, 500, 'material_fried_garnish', '2014-11-13 18:46:51', '2014-11-13 18:46:51'),
(4, 'Boiled Garnish', 'Secondary', 1, 500, 'material_boiled_garnish', '2014-11-13 18:46:51', '2014-11-13 18:46:51'),
(5, 'Egg', 'Primary', 3, 3000, 'material_egg', '2014-11-13 18:46:51', '2014-11-13 18:46:51'),
(6, 'Chicken', 'Primary', 1, 4000, 'material_chicken', '2014-11-13 18:46:51', '2014-11-13 18:46:51'),
(7, 'Meat', 'Primary', 2, 4000, 'material_meat', '2014-11-13 18:55:40', '2014-11-13 18:46:51'),
(8, 'Salad ', 'Secondary', 2, 1500, 'material_salad', '2014-11-13 18:46:51', '2014-11-13 18:46:51'),
(9, 'Cucumber', 'Secondary', 2, 500, 'material_cucumber', '2014-11-13 18:46:51', '2014-11-13 18:46:51'),
(10, 'Sauce', 'Secondary', 2, 200, 'material_sauce', '2014-11-13 18:46:51', '2014-11-13 18:46:51'),
(11, 'Chips', 'Secondary', 10, 500, 'material_chips', '2014-11-13 18:55:21', '2014-11-13 18:55:21'),
(12, 'Straw', 'Primary', 0, 100, 'material_straw', '2014-11-13 18:55:21', '2014-11-13 18:55:21'),
(13, 'Ice Block', 'Primary', 1, 100, 'material_iceblock', '2014-11-13 18:55:21', '2014-11-13 18:55:21'),
(14, 'Orange', 'Primary', 3, 1000, 'material_orange', '2014-11-13 18:55:21', '2014-11-13 18:55:21'),
(15, 'Tea', 'Primary', 3, 1000, 'material_tea', '2014-11-13 18:55:21', '2014-11-13 18:55:21'),
(16, 'Water', 'Primary', 0, 500, 'material_water', '2014-11-13 18:55:21', '2014-11-13 18:55:21'),
(17, 'Plate', 'Primary', 0, 5000, 'material_plate', '2014-11-13 18:55:21', '2014-11-13 18:55:21'),
(18, 'Bowl', 'Primary', 0, 500, 'material_bowl', '2014-11-13 18:55:21', '2014-11-13 18:55:21'),
(19, 'Glass Cup', 'Primary', 0, 500, 'material_glass', '2014-11-14 01:17:41', '2014-11-13 18:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `bc_material_product`
--

CREATE TABLE IF NOT EXISTS `bc_material_product` (
  `mpr_id` int(11) NOT NULL AUTO_INCREMENT,
  `mpr_product` int(11) NOT NULL,
  `mpr_material` int(11) NOT NULL,
  `mpr_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mpr_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`mpr_id`,`mpr_product`,`mpr_material`),
  KEY `fk_bc_material_product_bc_product1_idx` (`mpr_product`),
  KEY `fk_bc_material_product_bc_item1_idx` (`mpr_material`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `bc_material_product`
--

INSERT INTO `bc_material_product` (`mpr_id`, `mpr_product`, `mpr_material`, `mpr_updated_at`, `mpr_created_at`) VALUES
(1, 1, 1, '2014-11-14 01:05:26', '2014-11-14 01:05:26'),
(2, 1, 5, '2014-11-14 01:05:26', '2014-11-14 01:05:26'),
(3, 1, 7, '2014-11-14 01:05:26', '2014-11-14 01:05:26'),
(4, 1, 8, '2014-11-14 01:05:26', '2014-11-14 01:05:26'),
(5, 1, 9, '2014-11-14 01:05:26', '2014-11-14 01:05:26'),
(6, 1, 10, '2014-11-14 01:05:26', '2014-11-14 01:05:26'),
(7, 1, 11, '2014-11-14 01:07:15', '2014-11-14 01:05:26'),
(8, 1, 17, '2014-11-14 01:07:27', '2014-11-14 01:07:27'),
(9, 2, 1, '2014-11-14 01:11:46', '2014-11-14 01:11:46'),
(10, 2, 3, '2014-11-14 01:11:46', '2014-11-14 01:11:46'),
(11, 2, 5, '2014-11-14 01:11:46', '2014-11-14 01:11:46'),
(12, 2, 6, '2014-11-14 01:11:46', '2014-11-14 01:11:46'),
(13, 2, 8, '2014-11-14 01:11:46', '2014-11-14 01:11:46'),
(14, 2, 10, '2014-11-14 01:11:46', '2014-11-14 01:11:46'),
(15, 2, 11, '2014-11-14 01:11:46', '2014-11-14 01:11:46'),
(16, 2, 17, '2014-11-14 01:11:46', '2014-11-14 01:11:46'),
(17, 3, 2, '2014-11-14 01:14:22', '2014-11-14 01:14:22'),
(18, 3, 4, '2014-11-14 01:14:22', '2014-11-14 01:14:22'),
(19, 3, 5, '2014-11-14 01:14:22', '2014-11-14 01:14:22'),
(20, 3, 8, '2014-11-14 01:14:22', '2014-11-14 01:14:22'),
(21, 3, 10, '2014-11-14 01:14:22', '2014-11-14 01:14:22'),
(22, 3, 11, '2014-11-14 01:14:22', '2014-11-14 01:14:22'),
(23, 3, 18, '2014-11-14 01:14:22', '2014-11-14 01:14:22'),
(24, 4, 12, '2014-11-14 01:17:52', '2014-11-14 01:17:52'),
(25, 4, 13, '2014-11-14 01:17:52', '2014-11-14 01:17:52'),
(26, 4, 15, '2014-11-14 01:17:52', '2014-11-14 01:17:52'),
(27, 4, 16, '2014-11-14 01:17:52', '2014-11-14 01:17:52'),
(28, 4, 19, '2014-11-14 01:17:52', '2014-11-14 01:17:52'),
(29, 5, 12, '2014-11-14 01:21:03', '2014-11-14 01:21:03'),
(30, 5, 13, '2014-11-14 01:21:03', '2014-11-14 01:21:03'),
(31, 5, 14, '2014-11-14 01:21:03', '2014-11-14 01:21:03'),
(32, 5, 16, '2014-11-14 01:21:03', '2014-11-14 01:21:03'),
(33, 5, 19, '2014-11-14 01:21:03', '2014-11-14 01:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `bc_player`
--

CREATE TABLE IF NOT EXISTS `bc_player` (
  `ply_id` int(11) NOT NULL AUTO_INCREMENT,
  `ply_key` varchar(45) NOT NULL,
  `ply_email` varchar(45) NOT NULL,
  `ply_name` varchar(45) NOT NULL,
  `ply_password` varchar(45) NOT NULL,
  `ply_avatar` varchar(45) NOT NULL DEFAULT 'noimage.jpg',
  `ply_state` enum('ACTIVE','SUSPEND','PENDING','REJECT','SUPERUSER') NOT NULL DEFAULT 'PENDING',
  `ply_read` tinyint(4) NOT NULL DEFAULT '0',
  `ply_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ply_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ply_id`),
  UNIQUE KEY `ply_email_UNIQUE` (`ply_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `bc_player`
--

INSERT INTO `bc_player` (`ply_id`, `ply_key`, `ply_email`, `ply_name`, `ply_password`, `ply_avatar`, `ply_state`, `ply_read`, `ply_updated_at`, `ply_created_at`) VALUES
(1, '693a45055980af11e2bd34b51bdf7804', 'angga_nitsfil@yahoo.com', 'Angga Ari Wijaya', '8837b5c09374f18c3d0a0238bfe21b01', 'angga.jpg', 'ACTIVE', 1, '2015-01-08 11:44:21', '2014-06-29 11:28:18'),
(2, '8d08570eaffe12e5506b424423323bc6', 'rio87@yahoo.com', 'Desi', '8d08570eaffe12e5506b424423323bc6', 'desi.jpg', 'ACTIVE', 1, '2015-01-08 11:38:53', '2014-06-30 12:49:52'),
(3, '336a13168bd73cdee65efccb1b1b1026', 'rinamuch@gmail.com', 'Rina Riyana', 'a55b7eb02a45d21c81b2e913e88d643c', 'cindy.jpg', 'ACTIVE', 1, '2014-11-15 03:17:35', '2014-07-01 12:50:31'),
(4, '34eeb267676076029bbc6f8a3e979eb4', 'shikaminamo@yahoo.com', 'Adhi Kurnia', 'b45816572ebf92fe2e00ec8d910c2894', 'bekti.jpg', 'ACTIVE', 1, '2014-11-15 03:17:42', '2014-07-02 12:51:50'),
(5, '52063beb821f62ac5091e81cb1319a1d', 'philia@gmail.com', 'Eka Adji', 'c817f40e608708fc76c9c6ffebc6ebdc', 'adji.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-03 12:52:42'),
(6, 'f8c3a6a87585931cef7088989dac9d1e', 'ain1234@gmail.com', 'Ain', 'e70c31f47bbff0fe05c1cd20891724e4', 'ain.jpg', 'SUSPEND', 1, '2014-07-06 11:20:59', '2014-07-04 12:54:02'),
(7, '539a3ae00f391cd4c0c7812de0cfd5d8', 'anggi1234@gmail.com', 'anggi', '1acc72ee70bf4b1edfcdeb884b66f3a0', 'anggi.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-04 12:54:53'),
(8, 'd929b9c4bcdadf802cc2bb78d0b67727', 'awank1234@gmail.com', 'Bangun Awank', '56141db71d5519503642ccd91742dc0a', 'awank.jpg', 'PENDING', 1, '2014-07-06 11:21:43', '2014-07-04 12:55:40'),
(9, '6e0112bd6d64f70dec0cb332a83e840b', 'doci1234@gmail.com', 'Doni', 'b5ac15e7ab5c7338fde9efa17f5c55a3', 'doci.jpg', 'SUSPEND', 1, '2014-11-20 13:06:19', '2014-07-04 12:57:12'),
(10, 'dd4110b4a2f85f46df0599bd8b48a177', 'eta1234@yahoo.com', 'Margareta Ester', '9f44d18b6f06189d15fb9274bb33100f', 'eta.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-04 12:58:08'),
(11, '329d509b26c9681c75c4053be3b006eb', 'fikra1234@gmail.com', 'Fikra', 'b20082c78e3e873d188c3845e6169598', 'fikra.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-04 12:58:43'),
(12, '5e33eb4e8b44409f28a608879b2a64a3', 'pras1234@gmail.com', 'RIsha Prasetyo', '09be3b181512fe0f53f801ddd5f591f2', 'pras.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-05 13:00:02'),
(13, 'eb97f41780b0024b9ad2cd065e846e78', 'hadi1234@gmail.com', 'Rahmat Hidayat', 'b89535721cdb57cb1f98ec2db241e0a0', 'hadi.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-05 13:00:37'),
(14, '661a13a4585c610437505727d5437b1a', 'ratna1234@gmail.com', 'Ratna Agustin', '628714b6cd17e88fcb393f5958b474a0', 'ratna.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-05 13:01:10'),
(15, 'cd2fb251b0d4824ed5055d448c9cebac', 'nurul_hika@yahoo.com', 'Nurul Istiana', '028e5bda30adf7dfd61a0e7c668bb366', 'nurul.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-05 13:01:55'),
(16, '224d8575db9942ba52ce9c72890bf96c', 'vivi1234@gmail.com', 'Vivi Rahmawati', 'efb4018c61cb92663eab10b100fce377', 'vivi.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-05 13:02:58'),
(17, '4b449a51c77c11745ac918fe73cccb65', 'zizi1234@yahoo.com', 'Nur Azizi', '647e1bd32b58cb1721cfd2c5cc502fca', 'zizi.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-06 13:03:38'),
(18, '40c7dd54caa0c00562fd11760cae75cd', 'iyan_murasaki@gmail.com', 'Iyan', '3216d9df777b85520f22489b4912d91d', 'iyan.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-06 13:05:05'),
(19, '36bde387634a78238c9931d209b815e8', 'sursur12@yahoo.com', 'Surya Adi', '16c30d6fabe34600e589c92f41a1e55f', 'surya.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-06 13:05:51'),
(20, '04a16921490b2ebd8cfb22cb52404115', 'rahma_devil@gmail.com', 'Rahma', '04d7fb09e1fcfd6078846492ead1a5de', 'rahma.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-06 13:06:31'),
(21, '0bc8a2050eaa4bc69b7c7bd163747b5a', 'lis_curca@yahoo.com', 'Lisna', '1f4954a42f7e6f52461ce0e77d769063', 'lisna.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-06 13:07:07'),
(22, 'e599c3bbd78e1982b301c4d819e9d218', 'luk21@gmail.com', 'Lukman', 'a17caecc96bce41b249a5efe169936af', 'lukman.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-06 13:08:14'),
(23, '5cb3c9fcdaae292f9a86ad74c9822cac', 'raysa333@gmail.com', 'Rasya', '57a5b21270de0f491ea66fe16394c3a2', 'rasya.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-06 13:08:52'),
(24, 'd954bb0b4dac4186e54f9f4880ca9985', 'syafiq123@yahoo.com', 'Ahmad Syafiq Kamil', 'c9c1ececdab307dda2002d426069e6f4', 'syafiq.jpg', 'ACTIVE', 1, '2014-07-06 11:20:24', '2014-07-06 13:09:31'),
(25, 'fe9f4de7257853fb4311001e250fda55', 'lia@gmail.com', 'Lia Amalia', '84d4e1d90d10b4492d9713a9a9843eef', 'noimage.jpg', 'PENDING', 1, '2014-07-18 17:13:19', '2014-07-18 17:27:37'),
(30, 'fb31132b8717b7afeb6a606ce2b5fda4', 'angga_sgsnitsfil@yahoo.com', 'asgas', '594f803b380a41396ed63dca39503542', 'noimage.jpg', 'ACTIVE', 1, '2015-01-06 14:58:30', '2015-01-06 11:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `bc_player_achievement`
--

CREATE TABLE IF NOT EXISTS `bc_player_achievement` (
  `pac_id` int(11) NOT NULL AUTO_INCREMENT,
  `pac_player` int(11) NOT NULL,
  `pac_achievement` int(11) NOT NULL,
  `pac_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pac_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pac_id`,`pac_player`,`pac_achievement`),
  KEY `fk_bc_player_acheivement_bc_player1_idx` (`pac_player`),
  KEY `fk_bc_player_acheivement_bc_achievement1_idx` (`pac_achievement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bc_player_asset`
--

CREATE TABLE IF NOT EXISTS `bc_player_asset` (
  `pas_id` int(11) NOT NULL AUTO_INCREMENT,
  `pas_player` int(11) NOT NULL,
  `pas_asset` int(11) NOT NULL,
  `pas_depreciation` int(11) NOT NULL DEFAULT '0',
  `pas_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pas_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pas_id`,`pas_player`,`pas_asset`),
  KEY `fk_bc_player_asset_bc_player1_idx` (`pas_player`),
  KEY `fk_bc_player_asset_bc_asset1_idx` (`pas_asset`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `bc_player_asset`
--

INSERT INTO `bc_player_asset` (`pas_id`, `pas_player`, `pas_asset`, `pas_depreciation`, `pas_updated_at`, `pas_created_at`) VALUES
(49, 1, 1, 0, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(50, 1, 4, 0, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(51, 1, 7, 0, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(52, 1, 10, 0, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(53, 1, 13, 0, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(54, 1, 16, 0, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(79, 2, 1, 0, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(80, 2, 4, 0, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(81, 2, 7, 0, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(82, 2, 10, 0, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(83, 2, 13, 0, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(84, 2, 16, 0, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(85, 3, 1, 0, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(86, 3, 4, 0, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(87, 3, 7, 0, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(88, 3, 10, 0, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(89, 3, 13, 0, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(90, 3, 16, 0, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(97, 5, 1, 0, '2015-01-09 02:11:11', '2015-01-09 02:11:11'),
(98, 5, 4, 0, '2015-01-09 02:11:11', '2015-01-09 02:11:11'),
(99, 5, 7, 0, '2015-01-09 02:11:11', '2015-01-09 02:11:11'),
(100, 5, 10, 0, '2015-01-09 02:11:11', '2015-01-09 02:11:11'),
(101, 5, 13, 0, '2015-01-09 02:11:11', '2015-01-09 02:11:11'),
(102, 5, 16, 0, '2015-01-09 02:11:11', '2015-01-09 02:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `bc_player_employee`
--

CREATE TABLE IF NOT EXISTS `bc_player_employee` (
  `pem_id` int(11) NOT NULL AUTO_INCREMENT,
  `pem_player` int(11) NOT NULL,
  `pem_employee` int(11) NOT NULL,
  `pem_salary` int(11) NOT NULL,
  `pem_hired` mediumint(9) NOT NULL DEFAULT '0',
  `pem_morale` float NOT NULL DEFAULT '2',
  `pem_services` float NOT NULL DEFAULT '2',
  `pem_productivity` float NOT NULL DEFAULT '2',
  `pem_late` mediumint(9) NOT NULL DEFAULT '0',
  `pem_sick` mediumint(9) NOT NULL DEFAULT '0',
  `pem_absent` mediumint(9) NOT NULL DEFAULT '0',
  `pem_level` int(11) NOT NULL DEFAULT '1',
  `pem_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pem_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pem_id`,`pem_player`,`pem_employee`),
  KEY `fk_bc_player_employee_bc_player1_idx` (`pem_player`),
  KEY `fk_bc_player_employee_bc_employee1` (`pem_employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bc_player_material`
--

CREATE TABLE IF NOT EXISTS `bc_player_material` (
  `pma_id` int(11) NOT NULL AUTO_INCREMENT,
  `pma_player` int(11) NOT NULL,
  `pma_material` int(11) NOT NULL,
  `pma_stock` int(11) NOT NULL,
  `pma_expired_remaining` int(11) NOT NULL,
  `pma_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pma_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pma_id`,`pma_player`,`pma_material`),
  KEY `fk_bc_player_inventory_bc_inventory1_idx` (`pma_material`),
  KEY `fk_bc_player_inventory_bc_player1_idx` (`pma_player`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `bc_player_material`
--

INSERT INTO `bc_player_material` (`pma_id`, `pma_player`, `pma_material`, `pma_stock`, `pma_expired_remaining`, `pma_updated_at`, `pma_created_at`) VALUES
(17, 2, 6, 20, 1, '2015-01-08 15:03:36', '2015-01-08 15:03:36'),
(18, 3, 6, 20, 1, '2015-01-08 16:12:43', '2015-01-08 16:12:43'),
(19, 3, 7, 20, 2, '2015-01-08 16:12:48', '2015-01-08 16:12:48'),
(20, 3, 8, 30, 2, '2015-01-09 01:36:42', '2015-01-08 16:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `bc_player_product`
--

CREATE TABLE IF NOT EXISTS `bc_player_product` (
  `ppr_id` int(11) NOT NULL AUTO_INCREMENT,
  `ppr_player` int(11) NOT NULL,
  `ppr_product` int(11) NOT NULL,
  `ppr_price` int(11) NOT NULL DEFAULT '0',
  `ppr_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ppr_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ppr_id`,`ppr_player`,`ppr_product`),
  KEY `fk_bc_player_product_bc_product1_idx` (`ppr_product`),
  KEY `fk_bc_player_product_bc_player1_idx` (`ppr_player`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `bc_player_product`
--

INSERT INTO `bc_player_product` (`ppr_id`, `ppr_player`, `ppr_product`, `ppr_price`, `ppr_updated_at`, `ppr_created_at`) VALUES
(56, 1, 1, 18000, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(57, 1, 2, 18000, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(58, 1, 3, 9000, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(59, 1, 4, 3000, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(60, 1, 5, 3000, '2015-01-08 12:04:22', '2015-01-08 12:04:22'),
(81, 2, 1, 18000, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(82, 2, 2, 18000, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(83, 2, 3, 9000, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(84, 2, 4, 3000, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(85, 2, 5, 3000, '2015-01-08 15:00:13', '2015-01-08 15:00:13'),
(86, 3, 1, 18000, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(87, 3, 2, 18000, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(88, 3, 3, 9000, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(89, 3, 4, 3000, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(90, 3, 5, 3000, '2015-01-08 16:04:05', '2015-01-08 16:04:05'),
(96, 5, 1, 18000, '2015-01-09 02:11:11', '2015-01-09 02:11:11'),
(97, 5, 2, 18000, '2015-01-09 02:11:11', '2015-01-09 02:11:11'),
(98, 5, 3, 9000, '2015-01-09 02:11:11', '2015-01-09 02:11:11'),
(99, 5, 4, 3000, '2015-01-09 02:11:11', '2015-01-09 02:11:11'),
(100, 5, 5, 3000, '2015-01-09 02:11:11', '2015-01-09 02:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `bc_product`
--

CREATE TABLE IF NOT EXISTS `bc_product` (
  `prd_id` int(11) NOT NULL AUTO_INCREMENT,
  `prd_product` varchar(45) NOT NULL,
  `prd_type` varchar(45) NOT NULL,
  `prd_atlas` varchar(45) NOT NULL,
  `prd_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prd_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`prd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bc_product`
--

INSERT INTO `bc_product` (`prd_id`, `prd_product`, `prd_type`, `prd_atlas`, `prd_updated_at`, `prd_created_at`) VALUES
(1, 'Nasi Campur', 'Food', 'product_food1', '2014-11-14 01:02:55', '2014-11-14 01:02:55'),
(2, 'Nasi Goreng', 'Food', 'product_food2', '2014-11-14 01:02:55', '2014-11-14 01:02:55'),
(3, 'Mie Ayam', 'Food', 'product_food3', '2014-11-14 01:02:55', '2014-11-14 01:02:55'),
(4, 'Es Teh', 'Drink', 'product_drink1', '2014-11-14 01:02:55', '2014-11-14 01:02:55'),
(5, 'Es Jeruk', 'Drink', 'product_drink2', '2014-11-14 01:02:55', '2014-11-14 01:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `bc_simulation`
--

CREATE TABLE IF NOT EXISTS `bc_simulation` (
  `sim_id` int(11) NOT NULL AUTO_INCREMENT,
  `sim_player` int(11) NOT NULL,
  `sim_day` int(11) NOT NULL,
  `sim_served` varchar(45) NOT NULL,
  `sim_loss` varchar(45) NOT NULL,
  `sim_stress` int(11) NOT NULL,
  `sim_work_hour` int(11) NOT NULL,
  `sim_location` varchar(45) NOT NULL,
  `sim_popularity` int(11) NOT NULL,
  `sim_overview` varchar(45) NOT NULL,
  `sim_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sim_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sim_id`,`sim_player`),
  KEY `fk_bc_simulation_bc_player1_idx` (`sim_player`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bc_supplier`
--

CREATE TABLE IF NOT EXISTS `bc_supplier` (
  `spl_id` int(11) NOT NULL AUTO_INCREMENT,
  `spl_type` varchar(45) NOT NULL,
  `spl_name` varchar(45) NOT NULL,
  `spl_atlas` varchar(45) NOT NULL,
  `spl_marker_atlas` varchar(45) NOT NULL,
  `spl_marker_x` float NOT NULL,
  `spl_marker_y` float NOT NULL,
  `spl_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `spl_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`spl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bc_supplier`
--

INSERT INTO `bc_supplier` (`spl_id`, `spl_type`, `spl_name`, `spl_atlas`, `spl_marker_atlas`, `spl_marker_x`, `spl_marker_y`, `spl_updated_at`, `spl_created_at`) VALUES
(1, 'Market', 'Kapasari', 'supplier_eureka_tawangsari', 'supplier_kapasari', 825.5, 175, '2014-11-14 01:30:38', '2014-11-14 01:30:27'),
(2, 'Market', 'Sidomoro', 'supplier_mia_sidomoro', 'supplier_sidomoro', 675.5, 321, '2014-11-14 01:30:41', '2014-11-14 01:30:27'),
(3, 'Market', 'Sukorejo', 'supplier_yoga_beringharjo', 'supplier_sukorejo', 728.5, 231.5, '2014-11-17 16:51:09', '2014-11-14 01:30:27'),
(4, 'Workshop', 'Widasari', 'supplier_yuki_sukorejo', 'supplier_widasari', 578, 178, '2014-11-14 01:30:27', '2014-11-14 01:30:27'),
(5, 'Workshop', 'Girikrida', 'supplier_azizah_pgs', 'supplier_girikrida', 710, 109, '2014-11-14 01:30:27', '2014-11-14 01:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `bc_supplier_asset`
--

CREATE TABLE IF NOT EXISTS `bc_supplier_asset` (
  `sua_id` int(11) NOT NULL AUTO_INCREMENT,
  `sua_asset` int(11) NOT NULL,
  `sua_supplier` int(11) NOT NULL,
  `sua_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sua_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sua_id`,`sua_asset`,`sua_supplier`),
  KEY `fk_bc_suplier_asset_bc_asset1_idx` (`sua_asset`),
  KEY `fk_bc_suplier_asset_bc_supplier1_idx` (`sua_supplier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `bc_supplier_asset`
--

INSERT INTO `bc_supplier_asset` (`sua_id`, `sua_asset`, `sua_supplier`, `sua_updated_at`, `sua_created_at`) VALUES
(1, 1, 4, '2014-11-14 02:30:30', '2014-11-14 02:30:30'),
(2, 2, 4, '2014-11-14 02:30:30', '2014-11-14 02:30:30'),
(3, 3, 4, '2014-11-14 02:30:30', '2014-11-14 02:30:30'),
(4, 4, 4, '2014-11-14 02:30:30', '2014-11-14 02:30:30'),
(5, 5, 4, '2014-11-14 02:30:30', '2014-11-14 02:30:30'),
(6, 6, 4, '2014-11-14 02:30:30', '2014-11-14 02:30:30'),
(7, 7, 4, '2014-11-14 02:30:30', '2014-11-14 02:30:30'),
(8, 8, 4, '2014-11-14 02:30:30', '2014-11-14 02:30:30'),
(9, 9, 4, '2014-11-14 02:30:30', '2014-11-14 02:30:30'),
(10, 10, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54'),
(11, 11, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54'),
(12, 12, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54'),
(13, 12, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54'),
(14, 13, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54'),
(15, 14, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54'),
(16, 15, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54'),
(17, 16, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54'),
(18, 17, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54'),
(19, 18, 5, '2014-11-14 02:31:54', '2014-11-14 02:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `bc_supplier_material`
--

CREATE TABLE IF NOT EXISTS `bc_supplier_material` (
  `sma_id` int(11) NOT NULL AUTO_INCREMENT,
  `sma_supplier` int(11) NOT NULL,
  `sma_material` int(11) NOT NULL,
  `sma_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sma_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sma_id`,`sma_supplier`,`sma_material`),
  KEY `fk_bc_supplier_material_bc_supplier1_idx` (`sma_supplier`),
  KEY `fk_bc_supplier_material_bc_material1_idx` (`sma_material`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=103 ;

--
-- Dumping data for table `bc_supplier_material`
--

INSERT INTO `bc_supplier_material` (`sma_id`, `sma_supplier`, `sma_material`, `sma_updated_at`, `sma_created_at`) VALUES
(70, 1, 1, '2014-11-13 18:46:54', '2014-11-13 18:41:27'),
(71, 1, 2, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(72, 1, 3, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(73, 1, 4, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(74, 1, 5, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(75, 1, 6, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(76, 1, 7, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(77, 1, 8, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(78, 1, 9, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(79, 1, 10, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(80, 1, 11, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(81, 1, 12, '2014-11-13 18:44:44', '2014-11-13 18:44:44'),
(82, 2, 6, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(83, 2, 7, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(84, 2, 8, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(85, 2, 9, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(86, 2, 10, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(87, 2, 11, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(88, 2, 12, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(89, 2, 13, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(90, 2, 13, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(91, 2, 14, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(92, 2, 15, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(93, 2, 16, '2014-11-13 18:46:24', '2014-11-13 18:46:24'),
(94, 3, 11, '2014-11-13 18:47:55', '2014-11-13 18:47:55'),
(95, 3, 12, '2014-11-13 18:47:55', '2014-11-13 18:47:55'),
(96, 3, 13, '2014-11-13 18:47:55', '2014-11-13 18:47:55'),
(97, 3, 14, '2014-11-13 18:47:55', '2014-11-13 18:47:55'),
(98, 3, 15, '2014-11-13 18:47:55', '2014-11-13 18:47:55'),
(99, 3, 16, '2014-11-13 18:47:55', '2014-11-13 18:47:55'),
(100, 3, 17, '2014-11-13 18:47:55', '2014-11-13 18:47:55'),
(101, 3, 18, '2014-11-13 18:47:55', '2014-11-13 18:47:55'),
(102, 3, 19, '2014-11-13 18:47:55', '2014-11-13 18:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `bc_transaction`
--

CREATE TABLE IF NOT EXISTS `bc_transaction` (
  `trn_id` int(11) NOT NULL AUTO_INCREMENT,
  `trn_player` int(11) NOT NULL,
  `trn_product` int(11) NOT NULL,
  `trn_day` int(11) NOT NULL,
  `trn_satisfaction` varchar(45) NOT NULL,
  `trn_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `trn_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`trn_id`,`trn_player`,`trn_product`),
  KEY `fk_bc_transaction_bc_player1_idx` (`trn_player`),
  KEY `fk_bc_transaction_bc_product1_idx` (`trn_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wb_feedback`
--

CREATE TABLE IF NOT EXISTS `wb_feedback` (
  `fdb_id` int(11) NOT NULL AUTO_INCREMENT,
  `fdb_name` varchar(45) NOT NULL,
  `fdb_subject` varchar(45) NOT NULL,
  `fdb_email` varchar(45) NOT NULL,
  `fdb_message` text NOT NULL,
  `fdb_state` enum('STANDARD','IMPORTANT','DELETED') NOT NULL,
  `fdb_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fdb_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fdb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `wb_setting`
--

CREATE TABLE IF NOT EXISTS `wb_setting` (
  `stg_name` varchar(45) NOT NULL,
  `stg_description` text NOT NULL,
  `stg_keyword` varchar(100) NOT NULL,
  `stg_email` varchar(45) NOT NULL,
  `stg_number` varchar(45) NOT NULL,
  `stg_address` varchar(45) NOT NULL,
  `stg_facebook` varchar(45) DEFAULT NULL,
  `stg_twitter` varchar(45) DEFAULT NULL,
  `stg_favicon` varchar(45) NOT NULL DEFAULT 'favicon.png',
  `stg_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stg_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wb_setting`
--

INSERT INTO `wb_setting` (`stg_name`, `stg_description`, `stg_keyword`, `stg_email`, `stg_number`, `stg_address`, `stg_facebook`, `stg_twitter`, `stg_favicon`, `stg_updated_at`, `stg_created_at`) VALUES
('Business Carrer The Game', 'SeriousGame.Inc provide best practice learning and training game, Business Career The Game is product which give player excellent experience with financial transaction.', 'serious, game, business', 'support@businesscareer.com', '+6285655479868', 'Jawa 6 No.5 Street', 'http://www.facebook.com/businesscareer', 'http://www.twitter.com/businesscareer', 'favicon.png', '2014-07-06 15:54:29', '2014-07-06 13:09:47');

-- --------------------------------------------------------

--
-- Table structure for table `wb_user`
--

CREATE TABLE IF NOT EXISTS `wb_user` (
  `usr_id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_username` varchar(45) NOT NULL,
  `usr_password` varchar(45) NOT NULL,
  `usr_name` varchar(45) NOT NULL,
  `usr_about` text,
  `usr_gender` enum('MALE','FEMALE') NOT NULL DEFAULT 'MALE',
  `usr_avatar` varchar(45) NOT NULL DEFAULT 'noimage.png',
  `usr_state` enum('ACTIVE','SUSPEND','PENDING') NOT NULL DEFAULT 'ACTIVE',
  `usr_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usr_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usr_id`),
  UNIQUE KEY `usr_username_UNIQUE` (`usr_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `wb_user`
--

INSERT INTO `wb_user` (`usr_id`, `usr_username`, `usr_password`, `usr_name`, `usr_about`, `usr_gender`, `usr_avatar`, `usr_state`, `usr_updated_at`, `usr_created_at`) VALUES
(1, 'anggadarkprince@gmail.com', '0b180078d994cb2b5ed89d7ce8e7eea2', 'Angga Ari Wijaya', 'I love the world when you exist', 'MALE', 'angga.jpg', 'ACTIVE', '2014-07-13 17:06:57', '2014-07-06 13:46:46'),
(2, 'support@businesscareer.com', '0b180078d994cb2b5ed89d7ce8e7eea2', 'Support Service', 'Official business career player support', 'MALE', 'group4.jpg', 'ACTIVE', '2014-07-06 08:05:34', '2014-07-06 13:46:46');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bc_game_data`
--
ALTER TABLE `bc_game_data`
  ADD CONSTRAINT `fk_bc_player_data_bc_player1` FOREIGN KEY (`gme_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_journal`
--
ALTER TABLE `bc_journal`
  ADD CONSTRAINT `fk_bc_journal_bc_account` FOREIGN KEY (`jrl_account`) REFERENCES `bc_account` (`acn_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_journal_bc_player1` FOREIGN KEY (`jrl_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_log`
--
ALTER TABLE `bc_log`
  ADD CONSTRAINT `fk_bc_logging_bc_player1` FOREIGN KEY (`lgg_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_material_product`
--
ALTER TABLE `bc_material_product`
  ADD CONSTRAINT `fk_bc_material_product_bc_item1` FOREIGN KEY (`mpr_material`) REFERENCES `bc_material` (`mtr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_material_product_bc_product1` FOREIGN KEY (`mpr_product`) REFERENCES `bc_product` (`prd_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_player_achievement`
--
ALTER TABLE `bc_player_achievement`
  ADD CONSTRAINT `fk_bc_player_acheivement_bc_achievement1` FOREIGN KEY (`pac_achievement`) REFERENCES `bc_achievement` (`ach_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_player_acheivement_bc_player1` FOREIGN KEY (`pac_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_player_asset`
--
ALTER TABLE `bc_player_asset`
  ADD CONSTRAINT `fk_bc_player_asset_bc_asset1` FOREIGN KEY (`pas_asset`) REFERENCES `bc_asset` (`ast_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_player_asset_bc_player1` FOREIGN KEY (`pas_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_player_employee`
--
ALTER TABLE `bc_player_employee`
  ADD CONSTRAINT `fk_bc_player_employee_bc_employee1` FOREIGN KEY (`pem_employee`) REFERENCES `bc_employee` (`emp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_player_employee_bc_player1` FOREIGN KEY (`pem_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_player_material`
--
ALTER TABLE `bc_player_material`
  ADD CONSTRAINT `fk_bc_player_inventory_bc_inventory1` FOREIGN KEY (`pma_material`) REFERENCES `bc_material` (`mtr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_player_inventory_bc_player1` FOREIGN KEY (`pma_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_player_product`
--
ALTER TABLE `bc_player_product`
  ADD CONSTRAINT `fk_bc_player_product_bc_player1` FOREIGN KEY (`ppr_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_player_product_bc_product1` FOREIGN KEY (`ppr_product`) REFERENCES `bc_product` (`prd_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_simulation`
--
ALTER TABLE `bc_simulation`
  ADD CONSTRAINT `fk_bc_simulation_bc_player1` FOREIGN KEY (`sim_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_supplier_asset`
--
ALTER TABLE `bc_supplier_asset`
  ADD CONSTRAINT `fk_bc_suplier_asset_bc_asset1` FOREIGN KEY (`sua_asset`) REFERENCES `bc_asset` (`ast_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_suplier_asset_bc_supplier1` FOREIGN KEY (`sua_supplier`) REFERENCES `bc_supplier` (`spl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_supplier_material`
--
ALTER TABLE `bc_supplier_material`
  ADD CONSTRAINT `fk_bc_supplier_material_bc_material1` FOREIGN KEY (`sma_material`) REFERENCES `bc_material` (`mtr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_supplier_material_bc_supplier1` FOREIGN KEY (`sma_supplier`) REFERENCES `bc_supplier` (`spl_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bc_transaction`
--
ALTER TABLE `bc_transaction`
  ADD CONSTRAINT `fk_bc_transaction_bc_player1` FOREIGN KEY (`trn_player`) REFERENCES `bc_player` (`ply_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bc_transaction_bc_product1` FOREIGN KEY (`trn_product`) REFERENCES `bc_product` (`prd_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
