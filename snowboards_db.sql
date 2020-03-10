-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2012 at 03:16 PM
-- Server version: 5.5.19
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `snowboards_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `sb_ability_levels`
--

CREATE TABLE IF NOT EXISTS `sb_ability_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sb_ability_levels`
--

INSERT INTO `sb_ability_levels` (`id`, `name`) VALUES
(1, 'כל הרמות'),
(4, 'מקצוענים'),
(2, 'מתחילים'),
(3, 'מתקדמים');

-- --------------------------------------------------------

--
-- Table structure for table `sb_carts_items`
--

CREATE TABLE IF NOT EXISTS `sb_carts_items` (
  `session` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`session`,`product`),
  KEY `session_cart_FOREIGN` (`session`),
  KEY `product_cart_FOREIGN` (`product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sb_cities`
--

CREATE TABLE IF NOT EXISTS `sb_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `city_name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=76 ;

--
-- Dumping data for table `sb_cities`
--

INSERT INTO `sb_cities` (`id`, `name`) VALUES
(30, 'אום אל-פחם'),
(59, 'אופקים'),
(49, 'אור יהודה'),
(75, 'אור עקיבא'),
(32, 'אילת'),
(41, 'אלעד'),
(73, 'אריאל'),
(5, 'אשדוד'),
(14, 'אשקלון'),
(58, 'באקה אל-גרבייה'),
(7, 'באר שבע'),
(74, 'בית שאן'),
(17, 'בית שמש'),
(42, 'ביתר עילית'),
(10, 'בני ברק'),
(12, 'בת ים'),
(64, 'גבעת שמואל'),
(25, 'גבעתיים'),
(52, 'דימונה'),
(29, 'הוד השרון'),
(15, 'הרצליה'),
(18, 'חדרה'),
(9, 'חולון'),
(3, 'חיפה'),
(36, 'טבריה'),
(45, 'טייבה'),
(63, 'טירה'),
(72, 'טירת כרמל'),
(54, 'טמרה'),
(51, 'יבנה'),
(56, 'יהוד-מונוסון'),
(71, 'יקנעם עילית'),
(1, 'ירושלים'),
(16, 'כפר סבא'),
(69, 'כפר קאסם'),
(34, 'כרמיאל'),
(21, 'לוד'),
(60, 'מגדל העמק'),
(27, 'מודיעין עילית'),
(19, 'מודיעין-מכבים-רעות'),
(48, 'מעלה אדומים'),
(67, 'מעלות תרשיחא'),
(26, 'נהריה'),
(38, 'נס ציונה'),
(20, 'נצרת'),
(39, 'נצרת עילית'),
(61, 'נשר'),
(55, 'נתיבות'),
(8, 'נתניה'),
(57, 'סח''נין'),
(33, 'עכו'),
(37, 'עפולה'),
(62, 'ערד'),
(6, 'פתח תקווה'),
(53, 'צפת'),
(70, 'קלנסווה'),
(50, 'קריית אונו'),
(28, 'קריית אתא'),
(47, 'קריית ביאליק'),
(31, 'קריית גת'),
(44, 'קריית ים'),
(43, 'קריית מוצקין'),
(68, 'קריית מלאכי'),
(65, 'קריית שמונה'),
(40, 'ראש העין'),
(4, 'ראשון לציון'),
(24, 'רהט'),
(13, 'רחובות'),
(23, 'רמלה'),
(11, 'רמת גן'),
(35, 'רמת השרון'),
(22, 'רעננה'),
(66, 'שדרות'),
(46, 'שפרעם'),
(2, 'תל אביב-יפו');

-- --------------------------------------------------------

--
-- Table structure for table `sb_gender`
--

CREATE TABLE IF NOT EXISTS `sb_gender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sb_gender`
--

INSERT INTO `sb_gender` (`id`, `name`) VALUES
(1, 'גברים'),
(3, 'ילדים'),
(2, 'נשים');

-- --------------------------------------------------------

--
-- Table structure for table `sb_manufacturers`
--

CREATE TABLE IF NOT EXISTS `sb_manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sb_manufacturers`
--

INSERT INTO `sb_manufacturers` (`id`, `name`) VALUES
(1, 'Burton'),
(2, 'Capita'),
(3, 'DC'),
(4, 'Forum Star'),
(5, 'GNU'),
(6, 'K2'),
(7, 'Lamar'),
(8, 'Lib Technologies'),
(9, 'Nitro'),
(10, 'Rome'),
(11, 'Salomon');

-- --------------------------------------------------------

--
-- Table structure for table `sb_orders`
--

CREATE TABLE IF NOT EXISTS `sb_orders` (
  `id` int(11) NOT NULL,
  `client` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_order_FOREIGN` (`client`),
  KEY `city_order_FOREIGN` (`city`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sb_order_items`
--

CREATE TABLE IF NOT EXISTS `sb_order_items` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `item_price` decimal(5,2) NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `order_id_FOREIGN` (`order_id`),
  KEY `product_id_FOREIGN` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `sb_product`
--
CREATE TABLE IF NOT EXISTS `sb_product` (
`id` int(11)
,`name` varchar(100)
,`manufacture` varchar(45)
,`profile_type` varchar(45)
,`size` int(11)
,`width_type` varchar(45)
,`min_width` int(3)
,`max_width` int(3)
,`ability_level` varchar(45)
,`gender` varchar(45)
,`price` decimal(5,2)
,`available` enum('false','true')
,`pic` enum('false','true')
);
-- --------------------------------------------------------

--
-- Table structure for table `sb_products`
--

CREATE TABLE IF NOT EXISTS `sb_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `manufacture` int(11) NOT NULL,
  `profile_type` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `ability_level` int(11) NOT NULL,
  `gender` int(11) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `available` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'true',
  `pic` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `prod_manufacture_FOREIGN` (`manufacture`),
  KEY `prod_profile_type_FOREIGN` (`profile_type`),
  KEY `prod_width_FOREIGN` (`width`),
  KEY `prod_ability_level_FOREIGN` (`ability_level`),
  KEY `prod_gender_FOREIGN` (`gender`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `sb_products`
--

INSERT INTO `sb_products` (`id`, `name`, `manufacture`, `profile_type`, `size`, `width`, `ability_level`, `gender`, `price`, `available`, `pic`) VALUES
(1, 'Burton 2012 Hero Burton Mission Bindings', 1, 4, 152, 2, 3, 1, '749.00', 'true', 'true'),
(2, 'Nitro Eero Snowboard - 2013', 8, 1, 157, 2, 4, 1, '780.00', 'true', 'true'),
(3, 'Lib Tech Lib Ripper BTX Snowboard - Kids 2012', 7, 4, 140, 2, 2, 3, '500.00', 'true', 'true'),
(4, 'Forum Star - Women''s 2011', 4, 4, 146, 2, 1, 2, '449.00', 'true', 'true'),
(5, 'Burton Flying', 1, 1, 155, 2, 3, 2, '669.00', 'true', 'true'),
(6, 'Burton Custom-X 2012', 1, 4, 158, 3, 1, 1, '979.00', 'true', 'true'),
(7, 'Capita Indoor Survival', 2, 4, 160, 4, 4, 1, '449.00', 'true', 'true'),
(8, 'Burton Custom Restricted 2012', 1, 3, 154, 2, 1, 1, '939.00', 'true', 'true'),
(9, 'Gnu Dirty Pillow-Btx 2013', 5, 2, 148, 2, 1, 3, '389.00', 'true', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `sb_profile_types`
--

CREATE TABLE IF NOT EXISTS `sb_profile_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sb_profile_types`
--

INSERT INTO `sb_profile_types` (`id`, `name`) VALUES
(4, 'גמיש'),
(3, 'היברידי'),
(1, 'קמור'),
(2, 'שטוח');

-- --------------------------------------------------------

--
-- Table structure for table `sb_reviews`
--

CREATE TABLE IF NOT EXISTS `sb_reviews` (
  `product` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `reviewed_by` int(11) NOT NULL,
  `reviewed_date` datetime NOT NULL,
  `text` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `grade` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`product`,`id`),
  KEY `prod_reviewed_FOREIGN` (`product`),
  KEY `client_reviewed_FOREIGN` (`reviewed_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sb_reviews`
--

INSERT INTO `sb_reviews` (`product`, `id`, `reviewed_by`, `reviewed_date`, `text`, `grade`) VALUES
(1, 1, 1, '2012-07-21 18:56:30', 'מוצר טוב<br />עיצוב מסוגנן ושווה את המחיר', 4),
(1, 2, 3, '2012-07-21 19:29:56', 'הייתי קונה עוד אחד רק בשביל הכיף', 4),
(1, 3, 1, '2012-07-23 21:24:23', 'מוצר מגעיל', NULL),
(1, 4, 1, '2012-07-23 23:06:59', 'הייתי שמח לקנות מוצר כזה<br />אולי עם עיצוב קצת שונה<br /><br />האם יש למישהו אחד כזה בבהיר?', 3),
(1, 5, 1, '2012-11-05 15:09:15', 'למתקמים בלבד!!<br />אחלה בורד', NULL),
(2, 1, 1, '2012-07-21 18:57:30', 'אחלה מגלש<br />עיצוב לא משהו', 3),
(2, 2, 1, '2012-11-05 15:27:11', 'בורד קטלני, לא מתאים למתחילים.', NULL),
(2, 3, 1, '2012-11-05 15:27:57', 'משלב בין פרירייד ופריסטייל', NULL),
(2, 4, 1, '2012-11-06 13:30:04', 'מהיר מאוד', 2),
(6, 1, 1, '2012-11-05 17:50:13', 'פריסטייל בורד<br />אחלה קפיצות', 5),
(7, 1, 1, '2012-11-05 22:07:33', 'עיצוב מרשים.<br />תוכלת חיים קצרה..', 3);

-- --------------------------------------------------------

--
-- Table structure for table `sb_sessions`
--

CREATE TABLE IF NOT EXISTS `sb_sessions` (
  `id` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `session_user_FOREIGN` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sb_size_range`
--

CREATE TABLE IF NOT EXISTS `sb_size_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sb_size_range`
--

INSERT INTO `sb_size_range` (`id`, `min`, `max`) VALUES
(1, 110, 119),
(2, 120, 129),
(3, 130, 139),
(4, 140, 144),
(5, 145, 149),
(6, 150, 154),
(7, 155, 159),
(8, 160, 165);

-- --------------------------------------------------------

--
-- Table structure for table `sb_users`
--

CREATE TABLE IF NOT EXISTS `sb_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sur_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `registered_date` datetime NOT NULL,
  `last_logged` datetime DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `blocked` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `is_admin` enum('false','true') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name_UNIQUE` (`user_name`),
  KEY `client_city_FOREIGN` (`city`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `sb_users`
--

INSERT INTO `sb_users` (`id`, `user_name`, `password`, `first_name`, `sur_name`, `registered_date`, `last_logged`, `city`, `address`, `phone`, `activated`, `blocked`, `is_admin`) VALUES
(1, 'angelmaster@slimail.com', 'c84b9408277c1f96763223660885d3b900bb70dea1c178fe58821f229e858819', 'מנהל', 'האתר', '2012-07-10 00:00:00', '2012-11-06 13:29:28', NULL, NULL, NULL, 'true', 'false', 'true'),
(3, 'angel1@isdn.net.il', '3dc1ed4351011308f330bbe73d415647032341dfbf64014126458e83e6c91f36', 'נדב', 'גרינברג', '2012-07-18 15:10:57', '2012-10-29 17:28:00', 3, 'הבעל שם טוב 43/13', '0522303455', 'false', 'false', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `sb_width`
--

CREATE TABLE IF NOT EXISTS `sb_width` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `min` int(3) DEFAULT NULL,
  `max` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sb_width`
--

INSERT INTO `sb_width` (`id`, `name`, `min`, `max`) VALUES
(1, 'צר', NULL, 7),
(2, 'רגיל', 7, 10),
(3, 'בינוני', 10, 12),
(4, 'רחב', 12, NULL);

-- --------------------------------------------------------

--
-- Structure for view `sb_product`
--
DROP TABLE IF EXISTS `sb_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sb_product` AS select `prod`.`id` AS `id`,`prod`.`name` AS `name`,`man`.`name` AS `manufacture`,`prof`.`name` AS `profile_type`,`prod`.`size` AS `size`,`wid`.`name` AS `width_type`,`wid`.`min` AS `min_width`,`wid`.`max` AS `max_width`,`level`.`name` AS `ability_level`,`gen`.`name` AS `gender`,`prod`.`price` AS `price`,`prod`.`available` AS `available`,`prod`.`pic` AS `pic` from (((((`sb_products` `prod` join `sb_manufacturers` `man` on((`prod`.`manufacture` = `man`.`id`))) join `sb_profile_types` `prof` on((`prod`.`profile_type` = `prof`.`id`))) join `sb_width` `wid` on((`prod`.`width` = `wid`.`id`))) join `sb_ability_levels` `level` on((`prod`.`ability_level` = `level`.`id`))) join `sb_gender` `gen` on((`prod`.`gender` = `gen`.`id`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sb_carts_items`
--
ALTER TABLE `sb_carts_items`
  ADD CONSTRAINT `product_cart` FOREIGN KEY (`product`) REFERENCES `sb_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `session_cart` FOREIGN KEY (`session`) REFERENCES `sb_sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sb_orders`
--
ALTER TABLE `sb_orders`
  ADD CONSTRAINT `city_order` FOREIGN KEY (`city`) REFERENCES `sb_cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `client_order` FOREIGN KEY (`client`) REFERENCES `sb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sb_order_items`
--
ALTER TABLE `sb_order_items`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `sb_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `sb_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sb_products`
--
ALTER TABLE `sb_products`
  ADD CONSTRAINT `prod_ability_level` FOREIGN KEY (`ability_level`) REFERENCES `sb_ability_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_gender` FOREIGN KEY (`gender`) REFERENCES `sb_gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_manufacture` FOREIGN KEY (`manufacture`) REFERENCES `sb_manufacturers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_profile_type` FOREIGN KEY (`profile_type`) REFERENCES `sb_profile_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_width` FOREIGN KEY (`width`) REFERENCES `sb_width` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sb_reviews`
--
ALTER TABLE `sb_reviews`
  ADD CONSTRAINT `client_reviewed` FOREIGN KEY (`reviewed_by`) REFERENCES `sb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prod_reviewed` FOREIGN KEY (`product`) REFERENCES `sb_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sb_sessions`
--
ALTER TABLE `sb_sessions`
  ADD CONSTRAINT `session_user` FOREIGN KEY (`user`) REFERENCES `sb_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sb_users`
--
ALTER TABLE `sb_users`
  ADD CONSTRAINT `client_city` FOREIGN KEY (`city`) REFERENCES `sb_cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
