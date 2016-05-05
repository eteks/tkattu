-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2016 at 05:53 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thalapakattu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_modules_events_mst`
--

CREATE TABLE IF NOT EXISTS `admin_modules_events_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_modules_mst_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `short_descr` text,
  `filename` varchar(100) NOT NULL DEFAULT '',
  `parameters` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Storing events information of modules' AUTO_INCREMENT=187 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_modules_events_mst_to_admin_mst`
--

CREATE TABLE IF NOT EXISTS `admin_modules_events_mst_to_admin_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_modules_events_mst_id` int(11) NOT NULL DEFAULT '0',
  `admin_mst_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Storing relationships of master tables admin and events' AUTO_INCREMENT=7261 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_modules_mst`
--

CREATE TABLE IF NOT EXISTS `admin_modules_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `short_descr` text,
  `filename` varchar(100) NOT NULL DEFAULT '',
  `parameters` text,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Storing modules information, master table' AUTO_INCREMENT=100 ;

--
-- Dumping data for table `admin_modules_mst`
--

INSERT INTO `admin_modules_mst` (`id`, `parent_id`, `name`, `short_descr`, `filename`, `parameters`, `sort_order`, `active`, `date_added`, `date_modified`) VALUES
(1, 0, 'Manage Privilege', '', 'privilege_users.php', '', 3, 'Y', '2008-08-02 12:14:19', '2015-10-06 21:36:27'),
(2, 1, 'Admin Users', '', 'privilege_users.php', '', 2, 'Y', '2008-08-02 12:14:37', '2015-10-06 21:36:27'),
(3, 1, 'Admin Roles', '', 'privilege_roles.php', '', 3, 'Y', '2008-08-02 12:14:52', '2015-10-06 21:36:27'),
(63, 0, 'Manage Hotel Info', '', 'parameter_info.php', '', 4, 'Y', '2009-01-29 17:41:30', '2015-10-06 21:36:26'),
(64, 0, 'Basic Info', '', 'Facility_Entry.php', '', 4, 'N', '2009-01-30 15:56:03', '2015-10-06 05:09:40'),
(65, 0, 'Manage Infrastructure Info', '', 'table_type.php', '', 4, 'Y', '2009-02-02 14:00:23', '2015-10-04 21:13:31'),
(66, 64, 'Facilities Entry', '', 'Facility_Entry.php', '', 2, 'N', '2009-02-06 17:18:04', '2015-10-06 21:36:29'),
(67, 64, 'Services Entry', '', 'Services_Entry.php', '', 1, 'N', '2009-02-06 17:20:15', '2015-10-06 21:36:29'),
(68, 64, 'Occasion Entry', '', 'occasion_info.php', '', 1, 'N', '2009-02-06 17:34:41', '2015-10-06 21:36:28'),
(69, 0, 'Manage Menu Card', '', 'Menu_Category.php', '', 5, 'Y', '2009-02-06 17:35:49', '2015-10-04 21:13:29'),
(70, 69, 'Menu Category', '', 'Menu_Category.php', '', 1, 'Y', '2009-02-06 17:36:21', '2015-10-06 21:37:25'),
(71, 69, 'Menu Entry', '', 'Menu_Entry.php', '', 2, 'Y', '2009-02-06 17:36:44', '2015-10-06 21:37:27'),
(72, 69, 'Menu Card Creation', '', 'Menu_Card.php', '', 3, 'Y', '2009-02-06 17:37:10', '2015-10-06 21:37:27'),
(73, 65, 'Floor Creation', '', 'Floor_Creation.php', '', 1, 'N', '2009-02-06 18:14:22', NULL),
(74, 65, 'Department Creation', '', 'Department_Creation.php', '', 2, 'N', '2009-02-06 18:14:55', NULL),
(75, 65, 'Room Type Creation', '', 'Room_Type.php', '', 3, 'N', '2009-02-06 18:15:15', NULL),
(76, 65, 'Room Creation', '', 'Room.php', '', 5, 'N', '2009-02-06 18:15:37', '2015-10-04 21:13:29'),
(77, 65, 'Rest. Table Type Creation', '', 'table_type.php', '', 6, 'Y', '2009-02-06 18:16:04', '2015-10-04 21:13:23'),
(78, 65, 'Rest. Table Entry', '', 'table_entry.php', '', 7, 'Y', '2009-02-06 18:16:27', '2015-10-04 21:13:22'),
(79, 0, 'Manage Inventory', '', 'unit_entry.php', '', 6, 'Y', '2009-02-06 18:30:12', '2015-10-04 21:13:26'),
(80, 79, 'Unit Entry', '', 'unit_entry.php', '', 1, 'Y', '2009-02-06 18:32:42', NULL),
(81, 79, 'Item Type Info', '', 'item_type.php', '', 2, 'Y', '2009-02-06 18:33:05', NULL),
(82, 79, 'Item Entry', '', 'item_entry.php', '', 3, 'Y', '2009-02-06 18:33:22', NULL),
(83, 79, 'Vendor Creation', '', 'vendor_creation.php', '', 4, 'Y', '2009-02-06 18:33:58', NULL),
(84, 0, 'Manage Finance', '', 'Payment.php', '', 3, 'N', '2009-02-06 18:45:12', '2015-10-06 21:12:51'),
(85, 84, 'Payment Mode', '', 'Payment.php', '', 1, 'N', '2009-02-06 18:45:37', '2015-10-04 21:12:55'),
(86, 84, 'Tax Info', '', 'tax.php', '', 2, 'N', '2009-02-06 18:45:54', '2015-10-04 21:12:56'),
(87, 84, 'Tax Scheme Entry', '', 'tax_scheme.php', '', 3, 'N', '2009-02-06 18:48:32', '2015-10-04 21:12:56'),
(88, 84, 'Accounting', '', 'account.php', '', 4, 'N', '2009-02-06 18:49:20', '2015-10-04 21:12:57'),
(89, 0, 'Manage CheckOut', '', 'checkout.php', '', 8, 'N', '2009-02-27 14:54:08', '2015-10-06 21:12:50'),
(90, 0, 'Manage Privilege User', '', 'hms_privilege_users.php', '', 9, 'Y', '2009-02-27 19:28:30', '2015-10-06 21:37:09'),
(91, 1, 'Admin Events', '', 'privilege_events.php', '', 4, 'N', '2009-02-27 19:29:37', NULL),
(92, 90, 'User Privilege', '', 'hms_privilege_users.php', '', 1, 'Y', '2009-02-27 19:35:48', NULL),
(93, 90, 'User Privilege Roles', '', 'hms_privilege_roles.php', '', 2, 'Y', '2009-02-27 19:36:21', NULL),
(94, 90, 'User Privilege Events', '', 'hms_privilege_events.php', '', 3, 'N', '2009-02-27 19:36:56', NULL),
(95, 0, 'Manage Reports', '', 'report_rooms.php', '', 10, 'N', '2009-03-12 19:34:40', '2015-10-06 05:10:00'),
(96, 64, 'Hotel Feedback', 'Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback Hotel Feedback ', 'srinath', 'asfadad', 1, 'N', '2011-02-07 05:35:14', NULL),
(97, 65, 'Supplier Creation', NULL, 'suppliercreation.php', NULL, 3, 'Y', '0000-00-00 00:00:00', NULL),
(98, 65, 'Supplier Mapping', NULL, 'suppliermap.php', NULL, 4, 'Y', '0000-00-00 00:00:00', NULL),
(99, 69, 'Menu Stock Entry', NULL, 'menustockentry', NULL, 3, 'Y', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_modules_mst_to_admin_mst`
--

CREATE TABLE IF NOT EXISTS `admin_modules_mst_to_admin_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_modules_mst_id` int(11) NOT NULL DEFAULT '0',
  `admin_mst_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Storing relationships of master tables  modules and admin' AUTO_INCREMENT=182 ;

--
-- Dumping data for table `admin_modules_mst_to_admin_mst`
--

INSERT INTO `admin_modules_mst_to_admin_mst` (`id`, `admin_modules_mst_id`, `admin_mst_id`) VALUES
(1, 63, 22),
(2, 1, 22),
(3, 2, 22),
(4, 3, 22),
(5, 91, 22),
(6, 64, 22),
(7, 68, 22),
(8, 66, 22),
(9, 67, 22),
(10, 65, 22),
(11, 73, 22),
(12, 74, 22),
(13, 75, 22),
(14, 76, 22),
(15, 77, 22),
(16, 78, 22),
(17, 69, 22),
(18, 70, 22),
(19, 71, 22),
(20, 72, 22),
(21, 79, 22),
(22, 80, 22),
(23, 81, 22),
(24, 82, 22),
(25, 83, 22),
(26, 85, 22),
(27, 86, 22),
(28, 87, 22),
(29, 88, 22),
(30, 89, 22),
(31, 90, 22),
(32, 92, 22),
(33, 93, 22),
(34, 94, 22),
(35, 95, 22),
(181, 1, 48),
(95, 97, 22),
(96, 98, 22),
(97, 99, 22);

-- --------------------------------------------------------

--
-- Table structure for table `admin_modules_mst_to_admin_role_mst`
--

CREATE TABLE IF NOT EXISTS `admin_modules_mst_to_admin_role_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_modules_mst_id` int(11) NOT NULL DEFAULT '0',
  `admin_role_mst_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Storing master tables of module and role relationship inform' AUTO_INCREMENT=109 ;

--
-- Dumping data for table `admin_modules_mst_to_admin_role_mst`
--

INSERT INTO `admin_modules_mst_to_admin_role_mst` (`id`, `admin_modules_mst_id`, `admin_role_mst_id`) VALUES
(108, 93, 20),
(107, 92, 20),
(106, 90, 20),
(105, 83, 20),
(104, 82, 20),
(103, 81, 20),
(102, 80, 20),
(101, 79, 20),
(100, 72, 20),
(99, 71, 20),
(98, 70, 20),
(97, 69, 20),
(96, 98, 20),
(95, 97, 20),
(94, 78, 20),
(93, 77, 20),
(92, 65, 20),
(91, 63, 20),
(90, 3, 20),
(89, 2, 20),
(88, 1, 20),
(56, 1, 1),
(57, 2, 1),
(58, 3, 1),
(59, 63, 1),
(60, 65, 1),
(61, 77, 1),
(62, 78, 1),
(63, 97, 1),
(64, 98, 1),
(65, 69, 1),
(66, 70, 1),
(67, 71, 1),
(68, 72, 1),
(69, 79, 1),
(70, 80, 1),
(71, 81, 1),
(72, 82, 1),
(73, 83, 1),
(74, 90, 1),
(75, 92, 1),
(76, 93, 1),
(85, 3, 35),
(84, 2, 35),
(83, 1, 35),
(87, 1, 36);

-- --------------------------------------------------------

--
-- Table structure for table `admin_mst`
--

CREATE TABLE IF NOT EXISTS `admin_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `admin_role_mst_id` int(11) NOT NULL DEFAULT '0',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 COMMENT='Storing admin user information with his role id' AUTO_INCREMENT=49 ;

--
-- Dumping data for table `admin_mst`
--

INSERT INTO `admin_mst` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `admin_role_mst_id`, `active`, `date_added`, `date_modified`) VALUES
(22, 'admin', 'admin', 'Admin', 'Admin', 'vadivel@atomicka.in', 0, 'Y', '2009-03-13 13:19:37', NULL),
(48, 'test', 'test', 'test', 'test', 'test@in.com', 35, 'Y', '2016-02-24 12:56:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_role_mst`
--

CREATE TABLE IF NOT EXISTS `admin_role_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `short_descr` text,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 COMMENT='Storing role master information' AUTO_INCREMENT=37 ;

--
-- Dumping data for table `admin_role_mst`
--

INSERT INTO `admin_role_mst` (`id`, `parent_id`, `name`, `short_descr`, `sort_order`, `active`, `date_added`, `date_modified`) VALUES
(1, 0, 'Super Administrator', 'He is the main administrator of this site', 2, 'Y', '2008-02-18 17:04:52', '2016-02-18 18:20:59'),
(20, 1, 'admin', '', 1, 'Y', '2009-02-26 17:02:19', '2016-02-24 12:45:51'),
(36, 35, 'test', 'test', 1, 'Y', '2016-02-24 12:35:47', '2016-02-24 12:45:36'),
(35, 0, 'supervisor', '', 1, 'Y', '2016-02-24 10:50:48', '2016-02-24 10:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `hms_admin_modules_events_mst`
--

CREATE TABLE IF NOT EXISTS `hms_admin_modules_events_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_modules_mst_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `short_descr` text,
  `filename` varchar(100) NOT NULL DEFAULT '',
  `parameters` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Storing events information of modules' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_admin_modules_events_mst_to_admin_mst`
--

CREATE TABLE IF NOT EXISTS `hms_admin_modules_events_mst_to_admin_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_modules_events_mst_id` int(11) NOT NULL DEFAULT '0',
  `admin_mst_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Storing relationships of master tables admin and events' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_admin_modules_mst`
--

CREATE TABLE IF NOT EXISTS `hms_admin_modules_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `short_descr` text,
  `filename` varchar(100) NOT NULL DEFAULT '',
  `parameters` text,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Storing modules information, master table' AUTO_INCREMENT=31 ;

--
-- Dumping data for table `hms_admin_modules_mst`
--

INSERT INTO `hms_admin_modules_mst` (`id`, `parent_id`, `name`, `short_descr`, `filename`, `parameters`, `sort_order`, `active`, `date_added`, `date_modified`) VALUES
(12, 0, 'Report', '', 'total_sales.php', '', 1, 'Y', '2009-03-06 15:12:15', '2015-01-29 15:21:18'),
(24, 12, 'Total Sales Report', 'Total Sales report Detail', 'total_sales.php', '', 1, 'N', '2015-01-29 13:22:47', '2015-01-30 10:05:29'),
(14, 0, 'Restaurant', '', 'restaurant_menu.php', '', 2, 'Y', '2009-03-06 15:15:00', '2015-01-29 13:21:38'),
(15, 14, 'Restaurant Order', '', 'restaurantOrderEntry', '', 1, 'N', '2009-03-06 15:16:00', '2015-01-29 14:32:42'),
(17, 0, 'Restaurant Billing', '', 'restaurantBill', '', 2, 'Y', '2009-03-06 15:18:37', '2015-01-29 13:21:00'),
(18, 17, 'Restaurant Bill', '', 'restaurantBill.php', '', 1, 'N', '2009-03-06 15:19:15', '2015-01-29 14:43:26'),
(22, 0, 'Administrative', '', 'admin/login.php', '', 2, 'Y', '2009-03-16 15:31:52', '2015-01-29 15:21:17'),
(23, 0, 'Inventory', '', 'inventory_menu.php', '', 3, 'Y', '2009-03-16 17:28:29', '2015-01-29 13:21:00'),
(25, 12, 'Table Sales Report', 'Based on table sales Report', 'table_sales.php', '', 2, 'N', '2015-01-29 13:23:33', '2015-01-30 10:05:30'),
(26, 12, 'Item Sales Report', 'Based on Item Sales Report', 'item_sales.php', '', 3, 'N', '2015-01-29 13:24:29', '2015-01-30 10:05:30'),
(27, 12, 'Tax Report', '', 'tax_report', '', 4, 'N', '2015-01-29 14:31:31', '2015-01-30 10:05:31'),
(28, 12, 'Stock Report', '', 'stock_report', '', 5, 'N', '2015-01-29 14:32:03', '2015-01-30 10:05:31'),
(29, 12, 'Parcel Sales Report', NULL, 'parcel_sales', NULL, 3, 'N', '0000-00-00 00:00:00', NULL),
(30, 0, 'No Cash Amount', 'NCA', '', NULL, 6, 'Y', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hms_admin_modules_mst_to_admin_mst`
--

CREATE TABLE IF NOT EXISTS `hms_admin_modules_mst_to_admin_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_modules_mst_id` int(11) NOT NULL DEFAULT '0',
  `admin_mst_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Storing relationships of master tables  modules and admin' AUTO_INCREMENT=106 ;

--
-- Dumping data for table `hms_admin_modules_mst_to_admin_mst`
--

INSERT INTO `hms_admin_modules_mst_to_admin_mst` (`id`, `admin_modules_mst_id`, `admin_mst_id`) VALUES
(97, 14, 2),
(96, 17, 2),
(99, 14, 3),
(98, 17, 3),
(104, 14, 1),
(103, 17, 1),
(102, 22, 1),
(101, 12, 1),
(100, 30, 1),
(105, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_admin_modules_mst_to_admin_role_mst`
--

CREATE TABLE IF NOT EXISTS `hms_admin_modules_mst_to_admin_role_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_modules_mst_id` int(11) NOT NULL DEFAULT '0',
  `admin_role_mst_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Storing master tables of module and role relationship inform' AUTO_INCREMENT=63 ;

--
-- Dumping data for table `hms_admin_modules_mst_to_admin_role_mst`
--

INSERT INTO `hms_admin_modules_mst_to_admin_role_mst` (`id`, `admin_modules_mst_id`, `admin_role_mst_id`) VALUES
(51, 17, 2),
(50, 14, 2),
(61, 17, 3),
(60, 14, 3),
(58, 23, 1),
(57, 22, 1),
(56, 17, 1),
(55, 14, 1),
(54, 12, 1),
(59, 30, 1),
(62, 30, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hms_admin_mst`
--

CREATE TABLE IF NOT EXISTS `hms_admin_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `admin_role_mst_id` int(11) NOT NULL DEFAULT '0',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 COMMENT='Storing admin user information with his role id' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hms_admin_mst`
--

INSERT INTO `hms_admin_mst` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `admin_role_mst_id`, `active`, `date_added`, `date_modified`) VALUES
(1, 'atomicka-c', 'atomicka', 'Balachandar', 'K', 'bala@atomicka.com', 1, 'Y', '2016-02-09 10:05:09', '2016-03-11 15:55:01'),
(2, 'atomicka-j', 'atomicka', 'Sreeni', 'vasan', 'vasan@atomicka.com', 2, 'Y', '2016-02-09 10:05:47', '2016-02-20 15:55:59'),
(3, 'atomicka-p', 'atomicka', 'Prasanna', 'Prasanna', 'prasanna@atomicka.com', 3, 'Y', '2016-02-09 10:06:27', '2016-02-20 15:56:06');

-- --------------------------------------------------------

--
-- Table structure for table `hms_admin_role_mst`
--

CREATE TABLE IF NOT EXISTS `hms_admin_role_mst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `short_descr` text,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=0 COMMENT='Storing role master information' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hms_admin_role_mst`
--

INSERT INTO `hms_admin_role_mst` (`id`, `parent_id`, `name`, `short_descr`, `sort_order`, `active`, `date_added`, `date_modified`) VALUES
(1, 0, 'Cashier', '', 1, 'Y', '2016-02-09 09:53:08', '2016-03-11 15:53:54'),
(2, 0, 'Juice', '', 2, 'Y', '2016-02-09 09:53:26', '2016-02-20 15:55:26'),
(3, 0, 'Parcel', '', 3, 'Y', '2016-02-09 09:53:42', '2016-03-11 15:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `hms_bar_order_account_details`
--

CREATE TABLE IF NOT EXISTS `hms_bar_order_account_details` (
  `order_act_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_act_cart_id` int(11) NOT NULL,
  `order_act_table` varchar(200) DEFAULT NULL,
  `order_act_subtotal` decimal(10,2) NOT NULL,
  `order_act_discount` decimal(10,2) NOT NULL,
  `order_act_tax` int(11) NOT NULL,
  `order_act_total` decimal(10,2) NOT NULL,
  `order_act_date` datetime NOT NULL,
  `order_act_report_date` date NOT NULL,
  `order_act_order_type` varchar(255) NOT NULL,
  `order_act_payment_type` int(11) NOT NULL,
  `order_act_cust_id` int(11) NOT NULL,
  `order_act_userrole` int(11) NOT NULL,
  `order_act_vat_tax` int(11) NOT NULL,
  `order_act_service_tax` int(11) NOT NULL,
  `order_act_sale_tax` int(11) NOT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  PRIMARY KEY (`order_act_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_bar_order_details`
--

CREATE TABLE IF NOT EXISTS `hms_bar_order_details` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `table_entry_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `order_posted_date` date NOT NULL,
  `order_product` varchar(255) NOT NULL,
  `order_price` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `order_cart_id` int(11) NOT NULL,
  `order_category_id` int(11) NOT NULL,
  `order_subcategory_id` int(11) NOT NULL,
  `order_type_id` varchar(255) NOT NULL,
  `product_name_desc` varchar(255) NOT NULL,
  `status` enum('open','closed') NOT NULL DEFAULT 'open',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_bed_details`
--

CREATE TABLE IF NOT EXISTS `hms_bed_details` (
  `hms_bed_details_id` int(11) NOT NULL AUTO_INCREMENT,
  `hms_bed_details` int(15) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`hms_bed_details_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_bill_id`
--

CREATE TABLE IF NOT EXISTS `hms_bill_id` (
  `bill_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_bill_id`
--

INSERT INTO `hms_bill_id` (`bill_id`) VALUES
(100015);

-- --------------------------------------------------------

--
-- Table structure for table `hms_booking_status`
--

CREATE TABLE IF NOT EXISTS `hms_booking_status` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `booking_no` varchar(10) NOT NULL,
  `checking_no` varchar(10) DEFAULT NULL,
  `no_adults` int(11) NOT NULL,
  `no_child` int(11) NOT NULL,
  `room_type_id` varchar(100) NOT NULL,
  `rooms_id` varchar(100) NOT NULL,
  `no_of_rooms` int(6) NOT NULL,
  `rooms_no` varchar(100) NOT NULL,
  `no_of_days` int(5) NOT NULL,
  `extra_bed` int(6) NOT NULL,
  `extra_bed_charge` decimal(10,2) NOT NULL,
  `nature_of_guest` varchar(50) NOT NULL,
  `payment_type` varchar(50) NOT NULL,
  `room_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `advance_pay` decimal(10,2) NOT NULL,
  `discount` int(5) NOT NULL,
  `second_payment_id` int(11) NOT NULL,
  `balance_amount` decimal(10,2) NOT NULL,
  `amount_status` enum('C','NC') NOT NULL DEFAULT 'NC',
  `room_change_status` enum('Y','N') NOT NULL DEFAULT 'N',
  `old_room` varchar(100) NOT NULL,
  `status` enum('H','F','E','B','BC','C','HP') NOT NULL DEFAULT 'E',
  `checkin_date` date NOT NULL,
  `Fromtime` varchar(50) NOT NULL,
  `checkout_date` date NOT NULL,
  `Totime` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `updated_on` date NOT NULL,
  `amt_refund` decimal(10,2) NOT NULL,
  `refund_reason` varchar(200) NOT NULL,
  `taxes` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_id` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`booking_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_checkout_time`
--

CREATE TABLE IF NOT EXISTS `hms_checkout_time` (
  `hms_checkout_id` int(11) NOT NULL AUTO_INCREMENT,
  `hms_checkout_time` int(10) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`hms_checkout_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_cloth_details_entry`
--

CREATE TABLE IF NOT EXISTS `hms_cloth_details_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cloth_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `cloth_quantity` varchar(100) NOT NULL,
  `received_date` varchar(100) NOT NULL,
  `due_date` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_cloth_entry`
--

CREATE TABLE IF NOT EXISTS `hms_cloth_entry` (
  `cloth_id` int(30) NOT NULL AUTO_INCREMENT,
  `com_id` int(50) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `cloth_name` varchar(250) NOT NULL,
  `tot_cloth` varchar(50) NOT NULL,
  `received_date` varchar(50) NOT NULL,
  `due_date` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `add_status` enum('open','close') NOT NULL DEFAULT 'open',
  PRIMARY KEY (`cloth_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_credit_payment_detail`
--

CREATE TABLE IF NOT EXISTS `hms_credit_payment_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `credit_bill_id` varchar(11) NOT NULL,
  `credit_cart_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` longtext NOT NULL,
  `total_amount` int(100) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `paid_amount` int(100) NOT NULL,
  `pending_amount` int(100) NOT NULL,
  `paid_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_customer_table`
--

CREATE TABLE IF NOT EXISTS `hms_customer_table` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(150) NOT NULL,
  `customer_address` varchar(150) NOT NULL,
  `customer_city` varchar(150) NOT NULL,
  `customer_zip` varchar(10) NOT NULL,
  `customer_state` varchar(150) NOT NULL,
  `customer_country` int(3) NOT NULL,
  `customer_contact_no` varchar(25) NOT NULL,
  `customer_email_id` varchar(150) NOT NULL,
  `customer_id_type` varchar(150) NOT NULL,
  `customer_id_no` varchar(50) NOT NULL,
  `customer_veh_no` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_department_creation`
--

CREATE TABLE IF NOT EXISTS `hms_department_creation` (
  `department_creation_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_creation_name` varchar(150) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`department_creation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_department_mapping`
--

CREATE TABLE IF NOT EXISTS `hms_department_mapping` (
  `depart_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `depart_id` int(11) NOT NULL,
  `depart_cate_id` int(11) NOT NULL,
  `depart_item_id` int(11) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`depart_map_id`),
  UNIQUE KEY `depart_map_id_2` (`depart_map_id`),
  KEY `depart_map_id` (`depart_map_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_designation`
--

CREATE TABLE IF NOT EXISTS `hms_designation` (
  `designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `designation_name` varchar(150) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`designation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_entry_type`
--

CREATE TABLE IF NOT EXISTS `hms_entry_type` (
  `item_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(200) NOT NULL,
  `item_entry_type` varchar(30) NOT NULL,
  `item_entry_name` varchar(30) NOT NULL,
  `item_unit` varchar(20) NOT NULL,
  `opening_stock` int(10) NOT NULL,
  `item_maxqty` int(10) NOT NULL,
  `item_minqty` int(10) NOT NULL,
  `standard_qty` int(10) NOT NULL,
  `standard_rate` int(10) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `status` int(10) NOT NULL DEFAULT '0',
  `date_added` date NOT NULL,
  `date_modified` date NOT NULL,
  PRIMARY KEY (`item_entry_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hms_entry_type`
--

INSERT INTO `hms_entry_type` (`item_entry_id`, `vendor_name`, `item_entry_type`, `item_entry_name`, `item_unit`, `opening_stock`, `item_maxqty`, `item_minqty`, `standard_qty`, `standard_rate`, `active`, `status`, `date_added`, `date_modified`) VALUES
(1, '', '1', 'test', '20', 0, 0, 0, 0, 0, '', 0, '2016-02-22', '2016-02-26'),
(2, '', '3', 'test2', '18', 0, 0, 0, 0, 0, '', 0, '2016-02-22', '2016-02-22');

-- --------------------------------------------------------

--
-- Table structure for table `hms_facility_entry`
--

CREATE TABLE IF NOT EXISTS `hms_facility_entry` (
  `hms_facility_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `hms_facility_entry_name` varchar(250) NOT NULL,
  `hms_facility_charges` varchar(250) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`hms_facility_entry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_floor_creation`
--

CREATE TABLE IF NOT EXISTS `hms_floor_creation` (
  `floor_creation_id` int(11) NOT NULL AUTO_INCREMENT,
  `floor_creation_name` varchar(150) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`floor_creation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_house_keep`
--

CREATE TABLE IF NOT EXISTS `hms_house_keep` (
  `house_keep_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_number_id` varchar(25) NOT NULL,
  `type_work` text NOT NULL,
  `housekeep_name` varchar(250) NOT NULL,
  `assign_user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `esp_com_date` date NOT NULL,
  `exp_com_time` time NOT NULL,
  `status_id` int(11) NOT NULL,
  PRIMARY KEY (`house_keep_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_house_keeping_user_creation`
--

CREATE TABLE IF NOT EXISTS `hms_house_keeping_user_creation` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_info`
--

CREATE TABLE IF NOT EXISTS `hms_info` (
  `hms_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `hms_info_name` varchar(250) NOT NULL COMMENT 'Hotel Info Name',
  `hms_info_address` varchar(250) NOT NULL COMMENT 'Hetel Info Address',
  `hms_info_city` varchar(150) NOT NULL COMMENT 'Hotel Info City',
  `hms_info_state` varchar(150) NOT NULL COMMENT 'Hotel Info State',
  `hms_info_zip` int(8) NOT NULL,
  `hms_info_country` varchar(150) NOT NULL,
  `hms_info_phone` int(25) NOT NULL,
  `hms_info_fax` int(25) NOT NULL,
  `hms_info_email` varchar(250) NOT NULL,
  `hms_info_url` varchar(150) NOT NULL,
  `hms_info_extension` varchar(10) NOT NULL,
  `hms_info_active` enum('Y','N') NOT NULL DEFAULT 'N',
  `hms_info_created_date` datetime NOT NULL,
  `hms_info_modify_date` datetime NOT NULL,
  PRIMARY KEY (`hms_info_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_item_type`
--

CREATE TABLE IF NOT EXISTS `hms_item_type` (
  `item_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type_name` varchar(250) NOT NULL,
  `ingredient` enum('Y','N') NOT NULL DEFAULT 'Y',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`item_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hms_item_type`
--

INSERT INTO `hms_item_type` (`item_type_id`, `item_type_name`, `ingredient`, `active`, `date_added`, `date_modified`) VALUES
(1, 'Dry fruits', 'Y', 'Y', '2016-02-18 17:31:11', '0000-00-00 00:00:00'),
(3, 'Vegtables', 'Y', 'Y', '2016-02-18 17:33:10', '0000-00-00 00:00:00'),
(4, 'Fruits', 'Y', 'Y', '2016-02-18 17:33:19', '0000-00-00 00:00:00'),
(5, 'Refined Oil', 'Y', 'Y', '2016-02-18 17:33:53', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hms_menu_card`
--

CREATE TABLE IF NOT EXISTS `hms_menu_card` (
  `menu_card_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_card_name` varchar(250) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`menu_card_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_menu_card_selection`
--

CREATE TABLE IF NOT EXISTS `hms_menu_card_selection` (
  `menu_card_selection_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_card_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_category_id` int(11) NOT NULL,
  `quty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`menu_card_selection_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_menu_category`
--

CREATE TABLE IF NOT EXISTS `hms_menu_category` (
  `hms_menu_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `hms_menu_category_name` varchar(250) NOT NULL,
  `vat_tax` decimal(10,2) NOT NULL,
  `service_tax` decimal(10,2) NOT NULL,
  `taxable` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `session` varchar(10) NOT NULL,
  `hms_menu_icon` text NOT NULL,
  `hms_menu_icon_active` text NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`hms_menu_category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `hms_menu_category`
--

INSERT INTO `hms_menu_category` (`hms_menu_category_id`, `hms_menu_category_name`, `vat_tax`, `service_tax`, `taxable`, `session`, `hms_menu_icon`, `hms_menu_icon_active`, `active`, `date_added`, `date_modified`) VALUES
(33, 'Break Fast', 2.00, 14.50, 'YES', '', '1179845324dosai_03.jpg', '921975420dosai_02.jpg', 'Y', '2016-03-09 10:45:23', '0000-00-00 00:00:00'),
(34, 'Dosa Spl  (TAWA SPL)', 2.00, 14.50, 'YES', '', '2009351061dosai_01.jpg', '1298278348egg_03.jpg', 'Y', '2016-03-09 10:47:31', '2016-03-09 11:05:32'),
(35, 'Briyani', 2.00, 14.50, 'YES', '', '1180090764chickenfried-rice_01.jpg', '218112396muttonbriyani_02.jpg', 'Y', '2016-03-09 10:50:05', '0000-00-00 00:00:00'),
(36, 'Varity Rice', 2.00, 14.50, 'YES', '', '461761600varaityrice_03.jpg', '187451286varaityrice_04.jpg', 'Y', '2016-03-09 10:51:31', '0000-00-00 00:00:00'),
(37, 'STARTES', 2.00, 14.50, 'YES', '', '2001721792starters_03.jpg', '1531208053starters_02.jpg', 'Y', '2016-03-09 10:52:22', '2016-03-09 10:57:24'),
(38, 'EGG', 2.00, 14.50, 'YES', '', '802603767egg_02.jpg', '2005121122egg_01.jpg', 'Y', '2016-03-09 10:53:18', '0000-00-00 00:00:00'),
(39, 'Chicken spl', 2.00, 14.50, 'YES', '', '698730932thandoori_02.jpg', '1662485552thandoori_01.jpg', 'Y', '2016-03-09 10:53:57', '2016-03-09 10:58:50'),
(40, 'Rice & Noodles Chines', 2.00, 14.50, 'YES', '', '110488906varaityrice_01.jpg', '501276999vegivaraities_02.jpg', 'Y', '2016-03-09 10:55:18', '0000-00-00 00:00:00'),
(41, 'Soups''s', 2.00, 14.50, 'YES', '', '1503829970soup_04.jpg', '839418956soup_05.jpg', 'Y', '2016-03-09 10:55:47', '0000-00-00 00:00:00'),
(42, 'Soups''s NON -VEG', 2.00, 14.50, 'YES', '', '1085947940soup_03.jpg', '1869719404soup_03.jpg', 'Y', '2016-03-09 10:56:13', '0000-00-00 00:00:00'),
(43, 'STARTES NON -VEG', 2.00, 14.50, 'YES', '', '206494308starters_04.jpg', '1024572445starters_04.jpg', 'Y', '2016-03-09 10:56:59', '0000-00-00 00:00:00'),
(44, 'Special items', 2.00, 14.50, 'YES', '', '1153129561chickenfried-rice_01.jpg', '1248258622chickenfried-rice_01.jpg', 'Y', '2016-03-09 10:58:11', '0000-00-00 00:00:00'),
(45, 'MUTTON', 2.00, 14.50, 'YES', '', '517029818mutton_04.jpg', '738630412mutton_02.jpg', 'Y', '2016-03-09 10:59:39', '0000-00-00 00:00:00'),
(46, 'SEA FOOD', 2.00, 14.50, 'YES', '', '46647417fish_01.jpg', '1413594312fish_01.jpg', 'Y', '2016-03-09 11:00:21', '0000-00-00 00:00:00'),
(47, 'Indian Breads', 2.00, 14.50, 'YES', '', '1091701941sandwich_02.jpg', '2067184657sandwich_01.jpg', 'Y', '2016-03-09 11:01:38', '0000-00-00 00:00:00'),
(48, 'Tandoori ', 2.00, 14.50, 'YES', '', '2020094400thandoori_01.jpg', '547871691thandoori_01.jpg', 'Y', '2016-03-09 11:02:20', '0000-00-00 00:00:00'),
(49, 'Vegetarian Varieties', 2.00, 14.50, 'YES', '', '985800011vegivaraities_01.jpg', '1637767131vegivaraities_03.jpg', 'Y', '2016-03-09 11:02:54', '0000-00-00 00:00:00'),
(50, 'Juice', 2.00, 14.50, 'YES', '', '1221885309juice_02.jpg', '1650795187juice_02.jpg', 'Y', '2016-03-09 11:03:52', '0000-00-00 00:00:00'),
(51, 'Milk Shake', 2.00, 14.50, 'YES', '', '690318908milkshakes_02.jpg', '2031892341milkshakes_02.jpg', 'Y', '2016-03-09 11:04:23', '2016-03-11 17:09:56'),
(52, 'Ice Cream', 2.00, 14.50, 'YES', '', '2124865933icecream_01.jpg', '961776110icecream_01.jpg', 'Y', '2016-03-09 11:05:01', '2016-03-14 12:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `hms_menu_entry`
--

CREATE TABLE IF NOT EXISTS `hms_menu_entry` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_category_id` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `hms_menu_sub_category_id` int(50) NOT NULL,
  `menu_name` varchar(250) NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `price` decimal(10,4) NOT NULL,
  `menu_reorder_level` int(11) NOT NULL,
  `menu_qty_status` int(11) NOT NULL,
  `menu_deduct` int(11) NOT NULL,
  `menu_price` int(100) NOT NULL,
  `actual_price` varchar(250) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `Item_available_status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=247 ;

--
-- Dumping data for table `hms_menu_entry`
--

INSERT INTO `hms_menu_entry` (`menu_id`, `menu_category_id`, `depart_id`, `hms_menu_sub_category_id`, `menu_name`, `item_code`, `price`, `menu_reorder_level`, `menu_qty_status`, `menu_deduct`, `menu_price`, `actual_price`, `tax`, `active`, `date_added`, `date_modified`, `Item_available_status`) VALUES
(1, 45, 1, 0, 'Mutton Sukka Varuval', '001', 120.6226, 10, 1, 0, 155, '', 0.00, 'Y', '2016-03-04 11:04:39', '2016-03-09 11:08:46', '1'),
(2, 45, 1, 0, 'Mutton Masala', '002', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:08:13', '2016-03-09 14:54:31', '1'),
(3, 45, 1, 0, 'Mutton Varutha Curry', '003', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:09:09', '2016-03-09 14:54:51', '1'),
(4, 45, 1, 0, 'Mutton Muttai Kari', '004', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:09:33', '2016-03-09 14:54:08', '1'),
(5, 45, 1, 0, 'Mutton Liver / Kidney', '005', 116.7315, 10, 1, 0, 150, '', 0.00, 'Y', '2016-03-04 11:10:17', '2016-03-09 14:53:39', '1'),
(6, 45, 1, 0, 'Brain Roast', '006', 77.8210, 10, 1, 0, 100, '', 0.00, 'Y', '2016-03-04 11:10:50', '2016-03-09 14:53:14', '1'),
(7, 45, 1, 0, 'Mutton Paya Kurma', '007', 112.8405, 10, 1, 0, 145, '', 0.00, 'Y', '2016-03-04 11:11:21', '2016-03-09 14:52:50', '1'),
(8, 45, 1, 0, 'Mutton Kheema Balls', '008', 120.6226, 10, 1, 0, 155, '', 0.00, 'Y', '2016-03-04 11:11:48', '2016-03-09 14:52:29', '1'),
(9, 45, 1, 0, 'Mutton Kheema Masala', '009', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:12:19', '2016-03-09 14:52:07', '1'),
(10, 45, 1, 0, 'Brain Egg Fry', '010', 97.2763, 10, 1, 0, 125, '', 0.00, 'Y', '2016-03-04 11:12:50', '2016-03-09 14:51:46', '1'),
(11, 46, 1, 0, 'Vanjaram Fish Fry', '011', 116.7315, 10, 1, 0, 150, '', 0.00, 'Y', '2016-03-04 11:19:49', '2016-03-09 14:50:54', '1'),
(12, 46, 1, 0, 'Fish Curry - Vanjaram', '012', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:20:18', '2016-03-09 14:50:27', '1'),
(13, 46, 1, 0, 'Fish Poriyal', '013', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:20:47', '2016-03-09 14:50:03', '1'),
(14, 46, 1, 0, 'Viral Meen Fry', '014', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:21:10', '2016-03-09 14:49:42', '1'),
(15, 46, 1, 0, 'Viral Meen Curry', '015', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:21:50', '2016-03-09 14:49:14', '1'),
(16, 46, 1, 0, 'Nethily Fish Fry', '016', 97.2763, 10, 1, 0, 125, '', 0.00, 'Y', '2016-03-04 11:22:27', '2016-03-09 14:48:52', '1'),
(17, 46, 1, 0, 'Ayirai Fish Curry', '017', 124.5136, 10, 1, 0, 160, '', 0.00, 'Y', '2016-03-04 11:23:05', '2016-03-09 14:48:25', '1'),
(18, 47, 1, 0, 'Naan', '018', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 11:24:17', '2016-03-09 14:47:50', '1'),
(19, 47, 1, 0, 'Butter Naan', '019', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 11:24:49', '2016-03-09 14:47:26', '1'),
(20, 47, 1, 0, 'Garlic Naan', '020', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 11:25:18', '2016-03-09 14:47:01', '1'),
(21, 47, 1, 0, 'Stuffed Naan', '021', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 11:25:44', '2016-03-09 14:46:25', '1'),
(22, 47, 1, 0, 'Stuffed Naan Chicken', '022', 50.5837, 10, 1, 0, 65, '', 0.00, 'Y', '2016-03-04 11:26:25', '2016-03-09 14:45:56', '1'),
(23, 48, 1, 0, 'Tandoori Chicken Full', '023', 233.4630, 10, 1, 0, 300, '', 0.00, 'Y', '2016-03-04 11:27:48', '2016-03-09 14:45:30', '1'),
(24, 48, 1, 0, 'Tandoori Chicken Half', '024', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:28:25', '2016-03-09 14:45:01', '1'),
(25, 48, 1, 0, 'Chicken Kabab', '025', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:28:57', '2016-03-09 14:44:35', '1'),
(26, 48, 1, 0, 'Chicken Tikka', '026', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:29:29', '2016-03-09 14:44:10', '1'),
(27, 48, 1, 0, 'Chicken Garlic Kabab', '027', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 11:30:09', '2016-03-09 14:43:44', '1'),
(28, 49, 1, 0, 'Poondu Kuzhambu', '028', 62.2568, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 11:30:51', '2016-03-09 14:42:40', '1'),
(29, 49, 1, 0, 'Kara Kuzhambu', '029', 70.0389, 10, 1, 0, 90, '', 0.00, 'Y', '2016-03-04 12:14:11', '2016-03-09 14:42:16', '1'),
(30, 49, 1, 0, 'Bindi Masala', '030', 70.0389, 10, 1, 0, 90, '', 0.00, 'Y', '2016-03-04 12:14:47', '2016-03-09 14:41:21', '1'),
(31, 49, 1, 0, 'Dall Butter Fry', '031', 54.4747, 10, 1, 0, 70, '', 0.00, 'Y', '2016-03-04 12:15:31', '2016-03-09 14:40:55', '1'),
(32, 49, 1, 0, 'Mixed Veg Fry', '032', 70.0389, 10, 1, 0, 90, '', 0.00, 'Y', '2016-03-04 12:15:58', '2016-03-09 14:40:32', '1'),
(33, 49, 1, 0, 'Panner Tikka Masala', '033', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 12:16:51', '2016-03-09 14:40:08', '1'),
(34, 50, 1, 0, 'Apple', '034', 62.2568, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 12:17:55', '2016-03-09 14:39:34', '1'),
(35, 50, 1, 0, 'Mango', '035', 46.6926, 10, 1, 0, 60, '', 0.00, 'Y', '2016-03-04 12:18:32', '2016-03-09 14:38:32', '1'),
(36, 50, 1, 0, 'Orange', '036', 46.6926, 10, 1, 0, 60, '', 0.00, 'Y', '2016-03-04 12:19:09', '2016-03-09 14:38:04', '1'),
(37, 50, 1, 0, 'Grape', '037', 46.6926, 10, 1, 0, 60, '', 0.00, 'Y', '2016-03-04 12:19:38', '2016-03-09 14:37:13', '1'),
(38, 50, 1, 0, 'Fresh Lime', '038', 19.4553, 10, 1, 0, 25, '', 0.00, 'Y', '2016-03-04 12:20:41', '2016-03-09 14:35:04', '1'),
(39, 50, 1, 0, 'Lassi - Sweet / Salt', '039', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 12:21:19', '2016-03-09 14:34:42', '1'),
(40, 51, 1, 0, 'Chikku', '040', 68.6695, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 12:35:59', '2016-03-11 17:09:56', '1'),
(41, 51, 1, 0, 'Pinapple', '041', 68.6695, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 12:36:25', '2016-03-11 17:09:56', '1'),
(42, 51, 1, 0, 'Vanilla', '042', 68.6695, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 12:36:49', '2016-03-11 17:09:56', '1'),
(43, 51, 1, 0, 'Strawberry', '043', 68.6695, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 12:37:16', '2016-03-11 17:09:56', '1'),
(44, 51, 1, 0, 'Chocolate', '044', 68.6695, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 12:37:46', '2016-03-11 17:09:56', '1'),
(45, 52, 1, 0, 'Butter Scotch', '045', 38.6266, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 12:39:01', '2016-03-14 12:43:40', '1'),
(46, 52, 1, 0, 'Fresh Fruit Salad', '046', 47.2103, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 12:39:28', '2016-03-14 12:43:40', '1'),
(47, 52, 1, 0, 'Falooda', '047', 77.2532, 10, 1, 0, 90, '', 0.00, 'Y', '2016-03-04 12:39:55', '2016-03-14 12:43:40', '1'),
(48, 52, 1, 0, 'Casatta', '048', 47.2103, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 12:40:26', '2016-03-14 12:43:40', '1'),
(49, 52, 1, 0, 'Kulfi ( Pot )', '049', 51.5021, 10, 1, 0, 60, '', 0.00, 'Y', '2016-03-04 12:41:08', '2016-03-14 12:43:40', '1'),
(50, 49, 1, 0, 'Kadaai Vegetable', '050', 70.0389, 10, 1, 0, 90, '', 0.00, 'Y', '2016-03-04 12:43:05', '2016-03-09 14:29:31', '1'),
(51, 49, 1, 0, 'Green Peas Masala', '051', 62.2568, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 12:43:41', '2016-03-09 14:29:00', '1'),
(52, 49, 1, 0, 'Mushroom Masala', '052', 62.2568, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 12:44:06', '2016-03-09 14:28:35', '1'),
(53, 49, 1, 0, 'Aloo Gobi / Mutter Masala', '053', 70.0389, 10, 1, 0, 90, '', 0.00, 'Y', '2016-03-04 12:44:38', '2016-03-09 14:28:07', '1'),
(54, 49, 1, 0, 'Mutter Panner Masala', '054', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 12:45:05', '2016-03-09 14:27:41', '1'),
(55, 49, 1, 0, 'Paneer Butter Masala', '055', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 12:45:39', '2016-03-09 14:27:14', '1'),
(56, 49, 1, 0, 'Gobi Manchurian', '056', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 12:46:07', '2016-03-09 14:26:35', '1'),
(57, 49, 1, 0, 'Chilly Mushroom', '057', 93.3852, 10, 1, 0, 120, '', 0.00, 'Y', '2016-03-04 12:46:49', '2016-03-09 14:26:07', '1'),
(58, 49, 1, 0, 'Paneer Manchurian - Dry / Gravy', '058', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 12:47:14', '2016-03-09 14:25:26', '1'),
(59, 49, 1, 0, 'Veg Manchurian - Dry / Gravy', '059', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 12:47:41', '2016-03-09 13:15:27', '1'),
(240, 45, 1, 0, 'Mutton Varutha Curry', '060', 128.4047, 0, 0, 0, 165, '', 0.00, 'Y', '2016-03-10 15:25:25', '0000-00-00 00:00:00', '1'),
(62, 33, 1, 0, 'Idly  (2 No''s)', '061', 15.5642, 10, 1, 0, 20, '', 0.00, 'Y', '2016-03-04 15:16:45', '2016-03-09 13:13:05', '1'),
(63, 33, 1, 0, 'Idly  (Masala Idly)', '062', 23.3463, 10, 1, 0, 30, '', 0.00, 'Y', '2016-03-04 15:18:12', '2016-03-09 13:12:44', '1'),
(64, 33, 1, 0, 'Fried Idly', '063', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:18:51', '2016-03-09 13:12:18', '1'),
(65, 33, 1, 0, 'Poodi Idly ', '064', 23.3463, 10, 1, 0, 30, '', 0.00, 'Y', '2016-03-04 15:19:14', '2016-03-09 13:12:01', '1'),
(66, 34, 1, 0, 'Sambar Idly(2no''s)', '065', 23.3463, 10, 1, 0, 30, '', 0.00, 'Y', '2016-03-04 15:21:51', '2016-03-09 13:11:37', '1'),
(67, 34, 1, 0, 'Plain Dosai', '066', 27.2374, 10, 1, 0, 35, '', 0.00, 'Y', '2016-03-04 15:23:37', '2016-03-09 13:11:19', '1'),
(68, 34, 1, 0, 'Podi Dosai', '067', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 15:24:06', '2016-03-09 13:10:54', '1'),
(69, 34, 1, 0, 'Kal Dosai  (2no''s)', '068', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 15:24:46', '2016-03-09 13:10:32', '1'),
(70, 34, 1, 0, 'Egg Dosai', '069', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 15:25:17', '2016-03-09 13:10:13', '1'),
(71, 34, 1, 0, 'Ghee Roast Veg', '070', 46.6926, 10, 1, 0, 60, '', 0.00, 'Y', '2016-03-04 15:25:49', '2016-03-09 15:34:13', '1'),
(72, 35, 1, 0, 'Plain Briyani', '071', 77.0428, 10, 1, 0, 99, '', 0.00, 'Y', '2016-03-04 15:26:45', '2016-03-09 13:09:21', '1'),
(73, 35, 1, 0, 'Chicken Briyani', '072', 101.1673, 10, 1, 0, 130, '', 0.00, 'Y', '2016-03-04 15:27:13', '2016-03-09 13:09:06', '1'),
(74, 35, 1, 0, 'Mutton Briyani', '073', 112.8405, 10, 1, 0, 145, '', 0.00, 'Y', '2016-03-04 15:28:05', '2016-03-09 13:08:48', '1'),
(75, 35, 1, 0, 'Nattu Kozhi Briyani', '074', 120.6226, 10, 1, 0, 155, '', 0.00, 'Y', '2016-03-04 15:28:54', '2016-03-09 13:08:32', '1'),
(76, 35, 1, 0, 'Kaadai Biriyani', '075', 120.6226, 10, 1, 0, 155, '', 0.00, 'Y', '2016-03-04 15:29:24', '2016-03-09 13:08:16', '1'),
(77, 36, 1, 0, 'Sambar Rice', '076', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:30:04', '2016-03-09 13:07:53', '1'),
(78, 36, 1, 0, 'Curd rice', '077', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:30:40', '2016-03-09 13:07:34', '1'),
(79, 36, 1, 0, 'Lemon Rice', '078', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:31:46', '2016-03-09 13:07:11', '1'),
(80, 36, 1, 0, 'Termnend Rice', '079', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:32:25', '2016-03-09 13:06:54', '1'),
(81, 36, 1, 0, 'Curry Leaf Rice', '080', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:33:03', '2016-03-09 13:06:30', '1'),
(82, 37, 1, 0, 'onion pakoda', '081', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:33:43', '2016-03-09 12:59:00', '1'),
(83, 37, 1, 0, 'gobi 65', '082', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:36:33', '2016-03-09 12:58:33', '1'),
(84, 37, 1, 0, 'panneer 65', '083', 50.5837, 10, 1, 0, 65, '', 0.00, 'Y', '2016-03-04 15:37:30', '2016-03-09 12:58:14', '1'),
(85, 37, 1, 0, 'mushroom 65', '084', 50.5837, 10, 1, 0, 65, '', 0.00, 'Y', '2016-03-04 15:38:22', '2016-03-09 12:57:55', '1'),
(86, 37, 1, 0, 'veg spring roll', '085', 50.5837, 10, 1, 0, 65, '', 0.00, 'Y', '2016-03-04 15:38:49', '2016-03-09 12:57:30', '1'),
(87, 38, 1, 0, 'omlette', '086', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 15:41:14', '2016-03-09 12:55:50', '1'),
(88, 38, 1, 0, 'podimas', '087', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 15:41:42', '2016-03-09 12:55:31', '1'),
(89, 38, 1, 0, 'egg masala', '088', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 15:42:15', '2016-03-09 12:55:11', '1'),
(90, 38, 1, 0, 'boiled egg', '089', 23.3463, 10, 1, 0, 30, '', 0.00, 'Y', '2016-03-04 15:42:57', '2016-03-09 12:54:52', '1'),
(91, 38, 1, 0, 'chicken omlette', '090', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 15:43:23', '2016-03-09 12:54:33', '1'),
(92, 40, 1, 0, ' Fried Rice Chicken / Noodles', '091', 108.9494, 10, 1, 0, 140, '', 0.00, 'Y', '2016-03-04 15:45:15', '2016-03-09 12:53:34', '1'),
(93, 40, 1, 0, 'Mutton Rice / Noodles', '092', 120.6226, 10, 1, 0, 155, '', 0.00, 'Y', '2016-03-04 15:45:50', '2016-03-09 12:53:13', '1'),
(94, 40, 1, 0, 'Egg Rice / Noodles', '093', 93.3852, 10, 1, 0, 120, '', 0.00, 'Y', '2016-03-04 15:46:22', '2016-03-09 12:52:44', '1'),
(95, 40, 1, 0, 'Veg Pulao', '094', 93.3852, 10, 1, 0, 120, '', 0.00, 'Y', '2016-03-04 15:47:06', '2016-03-09 12:52:23', '1'),
(96, 40, 1, 0, 'Cashewnut Pulao', '095', 108.9494, 10, 1, 0, 140, '', 0.00, 'Y', '2016-03-04 15:47:35', '2016-03-09 12:51:58', '1'),
(97, 41, 1, 0, 'Sweet Corn Soups', '096', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:48:08', '2016-03-09 12:51:17', '1'),
(98, 41, 1, 0, 'Hot & Sour Soup', '097', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 15:49:34', '2016-03-09 12:50:50', '1'),
(99, 41, 1, 0, 'Milagutuwany soup', '098', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 16:19:58', '2016-03-09 12:49:02', '1'),
(100, 41, 1, 0, 'Cream Of Mushroom soup', '099', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 16:21:04', '2016-03-09 12:40:30', '1'),
(101, 42, 1, 0, 'Chettinad mutton  soup', '100', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 16:21:47', '2016-03-09 12:40:07', '1'),
(102, 42, 1, 0, 'nattu kozhi rasam', '101', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 16:22:15', '2016-03-09 12:39:46', '1'),
(103, 42, 1, 0, 'nandu rasam', '102', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 16:22:40', '2016-03-09 12:39:26', '1'),
(104, 42, 1, 0, 'sweet corn chic soup', '103', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 17:01:59', '2016-03-09 15:43:29', '1'),
(105, 42, 1, 0, 'hot & sour chic soup', '104', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 17:02:34', '2016-03-09 15:38:55', '1'),
(106, 43, 1, 0, 'fried chicken full', '105', 194.5525, 10, 1, 0, 250, '', 0.00, 'Y', '2016-03-04 17:03:08', '2016-03-09 12:37:10', '1'),
(107, 43, 1, 0, 'fried chicken half', '106', 97.2763, 10, 1, 0, 125, '', 0.00, 'Y', '2016-03-04 17:03:31', '2016-03-09 12:36:37', '1'),
(108, 43, 1, 0, 'chicken lollypop', '107', 97.2763, 10, 1, 0, 125, '', 0.00, 'Y', '2016-03-04 17:03:56', '2016-03-09 12:36:05', '1'),
(109, 43, 1, 0, 'chicken pakoda', '108', 77.0428, 10, 1, 0, 99, '', 0.00, 'Y', '2016-03-04 17:04:22', '2016-03-09 12:35:29', '1'),
(110, 43, 1, 0, 'chicken spring roll', '109', 77.0428, 10, 1, 0, 99, '', 0.00, 'Y', '2016-03-04 17:04:48', '2016-03-09 12:35:08', '1'),
(111, 39, 1, 0, 'chettinadu chic masala', '110', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 17:05:19', '2016-03-09 12:34:15', '1'),
(112, 39, 1, 0, 'chettinadu chic varuval', '111', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 17:05:44', '2016-03-09 12:33:41', '1'),
(113, 39, 1, 0, 'kadaai chicken', '112', 93.3852, 10, 1, 0, 120, '', 0.00, 'Y', '2016-03-04 17:06:06', '2016-03-09 12:33:17', '1'),
(114, 39, 1, 0, 'nattu kozhi varuval', '113', 101.1673, 10, 1, 0, 130, '', 0.00, 'Y', '2016-03-04 17:07:00', '2016-03-09 12:32:46', '1'),
(115, 39, 1, 0, 'nattu kozhi masala', '114', 108.9494, 10, 1, 0, 140, '', 0.00, 'Y', '2016-03-04 17:07:25', '2016-03-09 12:32:32', '1'),
(116, 33, 1, 0, 'Idiyappam  (3no''s)', '115', 23.3463, 10, 1, 0, 30, '', 0.00, 'Y', '2016-03-04 17:19:04', '2016-03-09 12:31:28', '1'),
(117, 33, 1, 0, 'Appam  (2no''s)', '116', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 17:30:34', '2016-03-09 12:31:07', '1'),
(118, 33, 1, 0, 'Egg Appam  (2no''s)', '117', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 17:31:03', '2016-03-09 12:30:51', '1'),
(119, 33, 1, 0, 'Chicken Appam  (1no''s)', '118', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 17:31:30', '2016-03-09 12:30:34', '1'),
(120, 33, 1, 0, 'Mutton Appam  (1no''s)', '119', 46.6926, 10, 1, 0, 60, '', 0.00, 'Y', '2016-03-04 17:32:08', '2016-03-09 12:30:20', '1'),
(121, 34, 1, 0, 'Chicken Keema Dosai', '120', 54.4747, 10, 1, 0, 70, '', 0.00, 'Y', '2016-03-04 17:36:37', '2016-03-09 12:27:50', '1'),
(122, 34, 1, 0, 'Mutton Keema Dosai', '121', 62.2568, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 17:37:10', '2016-03-09 12:27:37', '1'),
(123, 34, 1, 0, 'Uthappam Plain', '122', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 17:37:41', '2016-03-09 12:27:19', '1'),
(124, 34, 1, 0, 'Uthappam Veg', '123', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 17:38:11', '2016-03-09 12:27:03', '1'),
(125, 34, 1, 0, 'Uthappam Onion', '124', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 17:39:00', '2016-03-09 12:26:49', '1'),
(126, 34, 1, 0, 'Uthappam Egg', '125', 46.6926, 10, 1, 0, 60, '', 0.00, 'Y', '2016-03-04 17:39:56', '2016-03-09 12:26:28', '1'),
(127, 34, 1, 0, 'Egg Curry Uthapam', '126', 58.3658, 10, 1, 0, 75, '', 0.00, 'Y', '2016-03-04 17:40:21', '2016-03-09 12:26:10', '1'),
(128, 34, 1, 0, 'Buttur Dosai  Veg', '127', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 17:40:54', '2016-03-09 12:25:50', '1'),
(129, 34, 1, 0, 'Parotta  (2no''s)', '128', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 17:42:01', '2016-03-09 12:25:20', '1'),
(130, 34, 1, 0, 'Chapathi  (2no''s)', '129', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 17:42:31', '2016-03-09 12:25:02', '1'),
(131, 34, 1, 0, 'Ceylon parotta', '130', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 17:43:04', '2016-03-09 12:24:31', '1'),
(132, 34, 1, 0, 'Ceylon egg parotta', '131', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 17:43:43', '2016-03-09 12:24:09', '1'),
(133, 34, 1, 0, 'Ceylon chicken parotta', '132', 46.6926, 10, 1, 0, 60, '', 0.00, 'Y', '2016-03-04 17:44:12', '2016-03-09 12:23:50', '1'),
(134, 34, 1, 0, 'Ceylon mutton parotta', '133', 54.4747, 10, 1, 0, 70, '', 0.00, 'Y', '2016-03-04 17:45:14', '2016-03-09 12:23:32', '1'),
(135, 34, 1, 0, 'Veg kothu parotta', '134', 38.9105, 10, 1, 0, 50, '', 0.00, 'Y', '2016-03-04 17:45:55', '2016-03-09 12:23:08', '1'),
(136, 34, 1, 0, 'Chicken Kothu parotta', '135', 54.4747, 10, 1, 0, 70, '', 0.00, 'Y', '2016-03-04 17:51:04', '2016-03-09 12:22:43', '1'),
(137, 34, 1, 0, 'Mutton Kothu parotta', '136', 62.2568, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 17:51:38', '2016-03-09 12:22:26', '1'),
(138, 34, 1, 0, 'Keema Parotta', '137', 62.2568, 10, 1, 0, 80, '', 0.00, 'Y', '2016-03-04 17:54:11', '2016-03-09 12:22:06', '1'),
(139, 34, 1, 0, 'Wheat Parotta  (2 No''s)', '138', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 17:55:12', '2016-03-09 12:21:48', '1'),
(140, 34, 1, 0, 'Roti  (2 No''s)', '139', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 17:55:31', '2016-03-09 12:21:26', '1'),
(141, 34, 1, 0, 'Pulka  (2 No''s)', '140', 31.1284, 10, 1, 0, 40, '', 0.00, 'Y', '2016-03-04 17:58:28', '2016-03-09 12:21:11', '1'),
(142, 35, 1, 0, 'Fish Biriyani', '141', 120.6226, 10, 1, 0, 155, '', 0.00, 'Y', '2016-03-04 17:59:41', '2016-03-09 12:20:46', '1'),
(143, 35, 1, 0, ' Turkey Biriyani', '142', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 18:00:10', '2016-03-09 12:20:31', '1'),
(144, 35, 1, 0, ' Rabbit Biriyani', '143', 128.4047, 10, 1, 0, 165, '', 0.00, 'Y', '2016-03-04 18:01:04', '2016-03-09 12:20:16', '1'),
(145, 35, 1, 0, ' Egg Briyani', '144', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 18:01:28', '2016-03-09 12:20:02', '1'),
(146, 35, 1, 0, ' Veg Biriyani', '145', 77.0428, 10, 1, 0, 99, '', 0.00, 'Y', '2016-03-04 18:01:51', '2016-03-09 12:19:44', '1'),
(147, 35, 1, 0, ' Tandoori Chicken biriyani', '146', 101.1673, 10, 1, 0, 130, '', 0.00, 'Y', '2016-03-04 18:02:16', '2016-03-09 12:19:24', '1'),
(148, 40, 1, 0, 'Jeera Rice', '147', 93.3852, 10, 1, 0, 120, '', 0.00, 'Y', '2016-03-04 18:03:11', '2016-03-09 12:18:39', '1'),
(149, 40, 1, 0, 'Ghee Rice', '148', 101.1673, 10, 1, 0, 130, '', 0.00, 'Y', '2016-03-04 18:03:46', '2016-03-09 12:18:18', '1'),
(150, 40, 1, 0, ' Steamed Basmati Rice', '149', 54.4747, 10, 1, 0, 70, '', 0.00, 'Y', '2016-03-04 18:04:57', '2016-03-09 12:18:03', '1'),
(151, 40, 1, 0, ' Mixed Fried Rice', '150', 108.9494, 10, 1, 0, 140, '', 0.00, 'Y', '2016-03-04 18:05:33', '2016-03-09 12:17:36', '1'),
(152, 36, 1, 0, 'Mint Rice', '151', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 18:06:28', '2016-03-09 12:16:52', '1'),
(153, 36, 1, 0, 'Keerai Rice', '152', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 18:06:51', '2016-03-09 12:16:37', '1'),
(154, 36, 1, 0, 'Coconut Rice', '153', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 18:07:15', '2016-03-09 12:16:22', '1'),
(155, 36, 1, 0, 'Mango Rice', '154', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 18:07:36', '2016-03-09 12:16:09', '1'),
(156, 36, 1, 0, 'Business Meals', '155', 77.8210, 10, 1, 0, 100, '', 0.00, 'Y', '2016-03-04 18:08:02', '2016-03-09 12:15:54', '1'),
(157, 36, 1, 0, 'Combo 1 ( Two Varity )', '156', 46.6926, 10, 1, 0, 60, '', 0.00, 'Y', '2016-03-04 18:08:55', '2016-03-09 12:15:31', '1'),
(158, 41, 1, 0, 'Cream Of Tomato soup', '157', 35.0195, 10, 1, 0, 45, '', 0.00, 'Y', '2016-03-04 18:09:34', '2016-03-09 12:15:12', '1'),
(159, 42, 1, 0, 'milaguthani chic soup', '158', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 18:10:39', '2016-03-09 12:14:56', '1'),
(160, 42, 1, 0, 'chettinadu chic soup', '159', 42.8016, 10, 1, 0, 55, '', 0.00, 'Y', '2016-03-04 18:11:03', '2016-03-09 12:14:37', '1'),
(161, 37, 1, 0, 'paneer tikka', '160', 50.5837, 10, 1, 0, 65, '', 0.00, 'Y', '2016-03-04 18:11:37', '2016-03-09 12:14:07', '1'),
(162, 43, 1, 0, 'finger fish', '161', 85.6031, 10, 1, 0, 110, '', 0.00, 'Y', '2016-03-04 18:12:05', '2016-03-09 12:13:30', '1'),
(163, 43, 1, 0, 'golden fried prawn', '162', 97.2763, 10, 1, 0, 125, '', 0.00, 'Y', '2016-03-04 18:12:25', '2016-03-09 12:13:15', '1'),
(164, 43, 1, 0, 'chicken 65', '163', 97.2763, 10, 1, 0, 125, '', 0.00, 'Y', '2016-03-04 18:12:52', '2016-03-09 12:10:36', '1'),
(165, 43, 1, 0, 'fish 65', '164', 101.1673, 10, 1, 0, 130, '', 0.00, 'Y', '2016-03-04 18:13:19', '2016-03-09 12:10:19', '1'),
(166, 43, 1, 0, 'prawn 65', '165', 108.9494, 10, 1, 0, 140, '', 0.00, 'Y', '2016-03-04 18:13:44', '2016-03-09 12:10:01', '1'),
(167, 43, 1, 0, 'rabbit 65', '166', 124.5136, 10, 1, 0, 160, '', 0.00, 'Y', '2016-03-04 18:14:10', '2016-03-09 12:09:42', '1'),
(168, 38, 1, 0, 'mutton omlette', '167', 50.5837, 10, 1, 0, 65, '', 0.00, 'Y', '2016-03-04 18:22:35', '2016-03-09 12:09:10', '1'),
(169, 38, 1, 0, 'fish omlette', '168', 50.5837, 0, 0, 0, 65, '', 0.00, 'Y', '2016-03-04 18:22:56', '2016-03-09 12:08:57', '1'),
(170, 38, 1, 0, 'karandi omlette', '169', 23.3463, 0, 0, 0, 30, '', 0.00, 'Y', '2016-03-04 18:24:25', '2016-03-09 12:08:43', '1'),
(171, 38, 1, 0, 'half boiled', '170', 11.6732, 0, 0, 0, 15, '', 0.00, 'Y', '2016-03-04 18:24:50', '2016-03-09 12:08:24', '1'),
(172, 39, 1, 0, 'pepper chicken dry', '171', 108.9494, 0, 0, 0, 140, '', 0.00, 'Y', '2016-03-04 18:25:23', '2016-03-09 12:07:49', '1'),
(173, 39, 1, 0, 'pepper chicken masala', '172', 108.9494, 0, 0, 0, 140, '', 0.00, 'Y', '2016-03-04 18:26:07', '2016-03-09 12:07:33', '1'),
(174, 39, 1, 0, 'butter chicken', '173', 93.3852, 0, 0, 0, 120, '', 0.00, 'Y', '2016-03-04 18:26:27', '2016-03-09 12:07:20', '1'),
(175, 39, 1, 0, 'chicken tikka masala', '174', 101.1673, 0, 0, 0, 130, '', 0.00, 'Y', '2016-03-04 18:26:56', '2016-03-09 12:07:04', '1'),
(176, 39, 1, 0, 'chilly/garlic/ginger chic dry', '175', 93.3852, 0, 0, 0, 120, '', 0.00, 'Y', '2016-03-04 18:27:25', '2016-03-09 12:06:20', '1'),
(177, 39, 1, 0, 'chilly/garlic/ginger chic gravy', '176', 93.3852, 0, 0, 0, 120, '', 0.00, 'Y', '2016-03-04 18:27:44', '2016-03-09 12:06:06', '1'),
(178, 39, 1, 0, 'chicken manjurian dry', '177', 93.3852, 0, 0, 0, 120, '', 0.00, 'Y', '2016-03-04 18:28:09', '2016-03-09 12:05:47', '1'),
(179, 39, 1, 0, 'chicken manjurian gravy', '178', 93.3852, 0, 0, 0, 120, '', 0.00, 'Y', '2016-03-04 18:28:34', '2016-03-09 12:05:30', '1'),
(180, 48, 1, 0, 'Reshmi Kabab', '179', 128.4047, 0, 0, 0, 165, '', 0.00, 'Y', '2016-03-04 18:29:11', '2016-03-09 11:28:37', '1'),
(181, 48, 1, 0, 'Hariyali Kabab', '180', 128.4047, 0, 0, 0, 165, '', 0.00, 'Y', '2016-03-04 18:29:37', '2016-03-09 11:28:18', '1'),
(182, 48, 1, 0, 'Fish Tikka', '181', 136.1868, 0, 0, 0, 175, '', 0.00, 'Y', '2016-03-04 18:29:57', '2016-03-09 11:28:08', '1'),
(183, 48, 1, 0, 'Fish Panjabi', '182', 136.1868, 0, 0, 0, 175, '', 0.00, 'Y', '2016-03-04 18:30:17', '2016-03-09 11:27:55', '1'),
(184, 48, 1, 0, 'Fish Hariyali Kabab', '183', 136.1868, 0, 0, 0, 175, '', 0.00, 'Y', '2016-03-04 18:30:43', '2016-03-09 11:27:44', '1'),
(185, 48, 1, 0, 'Veg Sheek Kabab', '184', 136.1868, 0, 0, 0, 175, '', 0.00, 'Y', '2016-03-04 18:31:09', '2016-03-09 11:27:19', '1'),
(186, 46, 1, 0, 'Chettinadu Fish Dry ', '185', 120.6226, 0, 0, 0, 155, '', 0.00, 'Y', '2016-03-04 18:31:50', '2016-03-09 11:26:02', '1'),
(187, 46, 1, 0, 'Sura Puttu', '186', 120.6226, 0, 0, 0, 155, '', 0.00, 'Y', '2016-03-04 18:32:09', '2016-03-09 11:25:46', '1'),
(188, 46, 1, 0, 'Chilly Fish - Dry / Gravy ', '187', 128.4047, 0, 0, 0, 165, '', 0.00, 'Y', '2016-03-04 18:32:28', '2016-03-09 11:25:31', '1'),
(189, 46, 1, 0, 'Ginger Fish - Dry / Gravy', '188', 128.4047, 0, 0, 0, 165, '', 0.00, 'Y', '2016-03-04 18:32:43', '2016-03-09 11:25:21', '1'),
(190, 46, 1, 0, 'Garlic Fish - Dry / Gravy', '189', 128.4047, 0, 0, 0, 165, '', 0.00, 'Y', '2016-03-04 18:32:59', '2016-03-09 11:25:09', '1'),
(191, 46, 1, 0, 'Dragon Fish', '190', 120.6226, 0, 0, 0, 155, '', 0.00, 'Y', '2016-03-04 18:33:18', '2016-03-09 11:24:30', '1'),
(192, 46, 1, 0, 'Fish Machurian - Dry / Gravy', '191', 136.1868, 0, 0, 0, 175, '', 0.00, 'Y', '2016-03-04 18:33:37', '2016-03-09 11:24:21', '1'),
(193, 46, 1, 0, 'Crab Roast', '192', 140.0778, 0, 0, 0, 180, '', 0.00, 'Y', '2016-03-04 18:34:11', '2016-03-09 11:24:11', '1'),
(194, 46, 1, 0, 'Crab Masala', '193', 140.0778, 0, 0, 0, 180, '', 0.00, 'Y', '2016-03-04 18:34:30', '2016-03-09 11:24:02', '1'),
(195, 46, 1, 0, 'Crab Shelless', '194', 147.8599, 0, 0, 0, 190, '', 0.00, 'Y', '2016-03-04 18:34:43', '2016-03-09 11:23:53', '1'),
(196, 47, 1, 0, 'Stuffed Naan Mutton', '195', 58.3658, 0, 0, 0, 75, '', 0.00, 'Y', '2016-03-04 18:35:25', '2016-03-09 11:21:54', '1'),
(197, 47, 1, 0, 'Kashimi Naan', '196', 42.8016, 0, 0, 0, 55, '', 0.00, 'Y', '2016-03-04 18:35:39', '2016-03-09 11:21:43', '1'),
(198, 47, 1, 0, 'Cheese Naan', '197', 50.5837, 0, 0, 0, 65, '', 0.00, 'Y', '2016-03-04 18:35:55', '2016-03-09 11:21:32', '1'),
(199, 47, 1, 0, 'Roti', '198', 31.1284, 0, 0, 0, 40, '', 0.00, 'Y', '2016-03-04 18:36:15', '2016-03-09 11:21:19', '1'),
(200, 47, 1, 0, 'Butter Roti', '199', 38.9105, 0, 0, 0, 50, '', 0.00, 'Y', '2016-03-04 18:36:31', '2016-03-09 11:21:08', '1'),
(201, 47, 1, 0, 'Masala Kulcha', '200', 38.9105, 0, 0, 0, 50, '', 0.00, 'Y', '2016-03-04 18:36:46', '2016-03-09 11:20:56', '1'),
(202, 47, 1, 0, 'Panner Kulcha', '201', 42.8016, 0, 0, 0, 55, '', 0.00, 'Y', '2016-03-04 18:37:05', '2016-03-09 11:20:45', '1'),
(203, 47, 1, 0, 'Pulka ( 2 No''s )', '202', 35.0195, 0, 0, 0, 45, '', 0.00, 'Y', '2016-03-04 18:37:24', '2016-03-09 11:20:34', '1'),
(204, 47, 1, 0, 'Aloo Kulcha', '203', 35.0195, 0, 0, 0, 45, '', 0.00, 'Y', '2016-03-04 18:37:41', '2016-03-09 11:20:16', '1'),
(205, 50, 1, 0, 'Butter Milk', '204', 19.4553, 0, 0, 0, 25, '', 0.00, 'Y', '2016-03-04 18:38:32', '2016-03-09 11:19:53', '1'),
(206, 50, 1, 0, 'Mango Lassi', '205', 46.6926, 0, 0, 0, 60, '', 0.00, 'Y', '2016-03-04 18:38:56', '2016-03-09 11:19:12', '1'),
(207, 50, 1, 0, 'Pineapple', '206', 38.9105, 0, 0, 0, 50, '', 0.00, 'Y', '2016-03-04 18:42:35', '2016-03-09 11:19:01', '1'),
(208, 50, 1, 0, 'Musk Melon', '207', 38.9105, 0, 0, 0, 50, '', 0.00, 'Y', '2016-03-04 18:42:53', '2016-03-09 11:18:49', '1'),
(209, 50, 1, 0, 'Water Melon', '208', 38.9105, 0, 0, 0, 50, '', 0.00, 'Y', '2016-03-04 18:43:26', '2016-03-09 11:18:36', '1'),
(210, 50, 1, 0, 'Carrot', '209', 38.9105, 0, 0, 0, 50, '', 0.00, 'Y', '2016-03-04 18:43:45', '2016-03-09 11:18:26', '1'),
(211, 51, 1, 0, 'Pista', '210', 68.6695, 0, 0, 0, 80, '', 0.00, 'Y', '2016-03-04 18:45:17', '2016-03-11 17:09:56', '1'),
(212, 52, 1, 0, 'Fruit Salad with Ice Cream', '211', 64.3777, 0, 0, 0, 75, '', 0.00, 'Y', '2016-03-04 18:46:18', '2016-03-14 12:43:40', '1'),
(213, 52, 1, 0, 'Two in One', '212', 64.3777, 0, 0, 0, 75, '', 0.00, 'Y', '2016-03-04 18:46:44', '2016-03-14 12:43:40', '1'),
(214, 52, 1, 0, 'Three in One', '213', 81.5451, 0, 0, 0, 95, '', 0.00, 'Y', '2016-03-04 18:47:16', '2016-03-14 12:43:40', '1'),
(215, 52, 1, 0, 'Tutty Fruity Special', '214', 72.9614, 0, 0, 0, 85, '', 0.00, 'Y', '2016-03-04 18:47:34', '2016-03-14 12:43:40', '1'),
(216, 52, 1, 0, 'Fruit Lover', '215', 55.7940, 0, 0, 0, 65, '', 0.00, 'Y', '2016-03-04 18:47:56', '2016-03-14 12:43:40', '1'),
(217, 52, 1, 0, 'Jelly Lover', '216', 55.7940, 0, 0, 0, 65, '', 0.00, 'Y', '2016-03-04 18:48:12', '2016-03-14 12:43:40', '1'),
(218, 52, 1, 0, 'Angel Delight', '217', 72.9614, 0, 0, 0, 85, '', 0.00, 'Y', '2016-03-04 18:48:31', '2016-03-14 12:43:40', '1'),
(219, 52, 1, 0, 'Kulfi ( Stick )', '218', 34.3348, 0, 0, 0, 40, '', 0.00, 'Y', '2016-03-04 18:49:06', '2016-03-14 12:43:40', '1'),
(220, 44, 1, 0, 'turkey', '219', 128.4047, 0, 0, 0, 165, '', 0.00, 'Y', '2016-03-04 18:54:39', '2016-03-09 11:12:43', '1'),
(221, 44, 1, 0, 'kaadai', '220', 120.6226, 0, 0, 0, 155, '', 0.00, 'Y', '2016-03-04 18:55:02', '2016-03-09 11:12:29', '1'),
(222, 44, 1, 0, 'rabbit', '221', 128.4047, 0, 0, 0, 165, '', 0.00, 'Y', '2016-03-04 18:55:26', '2016-03-09 11:12:15', '1'),
(223, 44, 1, 0, 'ayirai', '222', 124.5136, 0, 0, 0, 160, '', 0.00, 'Y', '2016-03-04 18:56:14', '2016-03-09 11:12:02', '1'),
(224, 44, 1, 0, 'suraputtu', '223', 120.6226, 0, 0, 0, 155, '', 0.00, 'Y', '2016-03-04 18:57:01', '2016-03-10 14:29:41', '1'),
(225, 50, 1, 0, 'Chikku', '224', 46.6926, 0, 0, 0, 60, '', 0.00, 'Y', '2016-03-04 19:06:39', '2016-03-09 11:11:39', '1'),
(226, 51, 1, 0, 'Apple', '225', 85.8369, 0, 0, 0, 100, '', 0.00, 'Y', '2016-03-04 19:07:01', '2016-03-11 17:09:56', '1'),
(227, 51, 1, 0, 'Mango', '226', 68.6695, 0, 0, 0, 80, '', 0.00, 'Y', '2016-03-04 19:07:27', '2016-03-11 17:09:56', '1'),
(228, 51, 1, 0, 'Butter Scotch', '227', 68.6695, 0, 0, 0, 80, '', 0.00, 'Y', '2016-03-04 19:07:53', '2016-03-11 17:09:56', '1'),
(229, 44, 1, 0, 'crab shelless', '228', 132.2957, 0, 0, 0, 170, '', 0.00, 'Y', '2016-03-04 19:08:42', '2016-03-09 11:09:47', '1'),
(230, 50, 1, 0, 'Fresh Lime Soda', '229', 23.3463, 0, 0, 0, 30, '', 0.00, 'Y', '2016-03-04 19:15:51', '2016-03-10 15:04:17', '1'),
(231, 49, 1, 0, 'Baby Corn Pepper Onion', '230', 93.3852, 0, 0, 0, 120, '', 0.00, 'Y', '2016-03-09 15:48:19', '2016-03-10 15:09:25', '1'),
(232, 52, 1, 0, 'Vanilla', '231', 38.6266, 0, 0, 0, 45, '', 0.00, 'Y', '2016-03-09 15:52:39', '2016-03-14 12:43:40', '1'),
(233, 52, 1, 0, 'Stawberry', '232', 38.6266, 0, 0, 0, 45, '', 0.00, 'Y', '2016-03-09 15:52:59', '2016-03-14 12:43:40', '1'),
(234, 52, 1, 0, 'Mango', '233', 38.6266, 0, 0, 0, 45, '', 0.00, 'Y', '2016-03-09 15:53:14', '2016-03-14 18:29:33', '1');

-- --------------------------------------------------------

--
-- Stand-in structure for view `hms_menu_stock`
--
CREATE TABLE IF NOT EXISTS `hms_menu_stock` (
`mse_menu_id` int(11)
,`mse_qty` decimal(32,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `hms_menu_stock_entry`
--

CREATE TABLE IF NOT EXISTS `hms_menu_stock_entry` (
  `mse_Id` int(11) NOT NULL AUTO_INCREMENT,
  `mse_menu_id` int(11) NOT NULL,
  `mse_qty` int(11) NOT NULL,
  `mse_createdon` datetime NOT NULL,
  `mse_createdby` int(11) NOT NULL,
  PRIMARY KEY (`mse_Id`),
  UNIQUE KEY `mse_Id` (`mse_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `hms_menu_stock_entry`
--

INSERT INTO `hms_menu_stock_entry` (`mse_Id`, `mse_menu_id`, `mse_qty`, `mse_createdon`, `mse_createdby`) VALUES
(3, 15, 3, '2016-02-19 08:02:09', 0),
(4, 6, 56, '2016-02-19 08:02:10', 0),
(9, 13, 10, '2016-02-20 08:02:22', 0),
(10, 12, 67, '2016-02-23 10:02:10', 0),
(11, 16, 50, '2016-02-26 06:02:28', 0),
(12, 17, 25, '2016-02-29 06:02:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_menu_sub_category`
--

CREATE TABLE IF NOT EXISTS `hms_menu_sub_category` (
  `hms_menu_sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `hms_menu_category_id` int(50) NOT NULL,
  `hms_menu_sub_category_name` varchar(250) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`hms_menu_sub_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_occasion_entry`
--

CREATE TABLE IF NOT EXISTS `hms_occasion_entry` (
  `hms_occasion_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `hms_occasion_entry_name` varchar(30) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`hms_occasion_entry_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_order_qty_flow`
--

CREATE TABLE IF NOT EXISTS `hms_order_qty_flow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `order_product` varchar(50) NOT NULL,
  `order_cart_id` int(11) NOT NULL,
  `menuid` int(11) NOT NULL,
  `bill_id` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `last_cancel_quantity` int(11) NOT NULL,
  `itemcancel` int(11) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `depart_status` int(11) NOT NULL,
  `cancel_status` int(11) NOT NULL,
  `parcel_status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=226 ;

--
-- Dumping data for table `hms_order_qty_flow`
--

INSERT INTO `hms_order_qty_flow` (`id`, `order_id`, `order_product`, `order_cart_id`, `menuid`, `bill_id`, `order_quantity`, `last_cancel_quantity`, `itemcancel`, `depart_id`, `depart_status`, `cancel_status`, `parcel_status`) VALUES
(155, 421, '', 1, 48, 0, 1, 0, 0, 1, 1, 0, 0),
(156, 420, '', 1, 45, 0, 1, 0, 0, 1, 1, 0, 0),
(157, 424, '', 2, 1, 0, 1, 0, 0, 1, 1, 0, 0),
(158, 423, '', 2, 49, 0, 1, 0, 0, 1, 1, 0, 0),
(159, 422, '', 2, 48, 0, 1, 0, 0, 1, 1, 0, 0),
(162, 436, '', 3, 105, 0, 1, 0, 0, 1, 1, 0, 0),
(163, 435, '', 3, 2, 0, 1, 0, 0, 1, 1, 0, 0),
(164, 437, '', 3, 107, 0, 1, 0, 0, 1, 1, 0, 0),
(165, 438, '', 4, 3, 0, 1, 0, 0, 1, 1, 0, 0),
(166, 439, '', 4, 103, 0, 1, 0, 0, 1, 1, 0, 0),
(167, 440, '', 4, 104, 0, 1, 0, 0, 1, 1, 0, 0),
(168, 441, '', 4, 105, 0, 1, 0, 0, 1, 1, 0, 0),
(169, 442, '', 5, 3, 0, 1, 0, 0, 1, 1, 0, 0),
(170, 443, '', 5, 103, 0, 1, 0, 0, 1, 1, 0, 0),
(171, 444, '', 5, 106, 0, 1, 0, 0, 1, 1, 0, 0),
(172, 445, '', 5, 107, 0, 1, 0, 0, 1, 1, 0, 0),
(210, 488, '', 6, 106, 0, 1, 0, 0, 1, 1, 0, 0),
(211, 489, '', 7, 106, 0, 1, 0, 0, 1, 1, 0, 0),
(218, 546, '', 5, 111, 0, -1, 0, 0, 1, 1, 1, 0),
(219, 543, '', 5, 108, 0, -1, 0, 0, 1, 1, 1, 0),
(220, 544, '', 5, 109, 0, 1, 0, 0, 1, 1, 0, 0),
(221, 545, '', 5, 110, 0, 1, 0, 0, 1, 1, 0, 0),
(222, 546, '', 5, 111, 0, 2, 0, 0, 1, 1, 0, 0),
(223, 543, '', 5, 108, 0, 2, 0, 0, 1, 1, 0, 0),
(225, 555, '', 9, 110, 0, -1, 0, 0, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_parameter_entry`
--

CREATE TABLE IF NOT EXISTS `hms_parameter_entry` (
  `hms_parameter_id` int(11) NOT NULL AUTO_INCREMENT,
  `hms_hotel_name` varchar(30) NOT NULL,
  `hms_address1` varchar(30) NOT NULL,
  `hms_address2` varchar(30) NOT NULL,
  `hms_city` varchar(30) NOT NULL,
  `hms_state` varchar(30) NOT NULL,
  `hms_country` varchar(30) NOT NULL,
  `hms_pincode` varchar(15) NOT NULL,
  `hms_phone_no` varchar(15) NOT NULL,
  `hms_cell_no` varchar(100) NOT NULL,
  `hms_tin_no` varchar(100) NOT NULL,
  `hms_stc` varchar(100) NOT NULL,
  `hms_url` varchar(30) NOT NULL,
  `hms_email` varchar(20) NOT NULL,
  `hms_footertxt` varchar(30) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `hms_active` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`hms_parameter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `hms_parameter_entry`
--

INSERT INTO `hms_parameter_entry` (`hms_parameter_id`, `hms_hotel_name`, `hms_address1`, `hms_address2`, `hms_city`, `hms_state`, `hms_country`, `hms_pincode`, `hms_phone_no`, `hms_cell_no`, `hms_tin_no`, `hms_stc`, `hms_url`, `hms_email`, `hms_footertxt`, `date_added`, `date_modified`, `hms_active`) VALUES
(21, 'Junior Thalappakattu Briyani', 'No.118, SAP Bus Stop', 'Avinasi Road', 'Tirupur', 'Tamilnadu', 'India', '641603', '9994190003', '9884375576', '', '', 'www.thalapakattu.in', 'thalapakatu@gmail.in', 'Both Veg and Non Veg', '2011-02-07 06:12:47', '2016-03-11 17:01:22', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `hms_payment_detail`
--

CREATE TABLE IF NOT EXISTS `hms_payment_detail` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `credit_bill_id` int(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `cash_amount` varchar(100) NOT NULL,
  `card_no` varchar(250) NOT NULL,
  `card_name` varchar(250) NOT NULL,
  `expire_date` int(100) NOT NULL,
  `card_amount` varchar(250) NOT NULL,
  `cheque_number` varchar(250) NOT NULL,
  `cheque_name` varchar(250) NOT NULL,
  `cheque_date` date NOT NULL,
  `cheque_amount` varchar(250) NOT NULL,
  `on_card_no` varchar(250) NOT NULL,
  `on_exp_date` varchar(250) NOT NULL,
  `on_card_name` varchar(250) NOT NULL,
  `on_amount` varchar(250) NOT NULL,
  `transactions_id` varchar(250) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=212 ;

--
-- Dumping data for table `hms_payment_detail`
--

INSERT INTO `hms_payment_detail` (`id`, `bill_no`, `table_id`, `cart_id`, `credit_bill_id`, `payment_type`, `payment_method`, `cash_amount`, `card_no`, `card_name`, `expire_date`, `card_amount`, `cheque_number`, `cheque_name`, `cheque_date`, `cheque_amount`, `on_card_no`, `on_exp_date`, `on_card_name`, `on_amount`, `transactions_id`, `created_date`) VALUES
(126, 'B100070', 1, 1, 0, 'full', 'cash', '45.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-28'),
(5, 'B100088', 1, 2, 0, 'full', 'cash', '236.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-01'),
(6, 'B100089', 1, 3, 0, 'full', 'cash', '299.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-01'),
(7, 'L100090', 1, 4, 0, 'full', 'cash', '41.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-04'),
(8, 'S100091', 1, 5, 0, 'full', 'cash', '598.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-04'),
(9, 'B100013', 1, 6, 0, 'full', 'cash', '574.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-04'),
(11, 'B100014', 1, 7, 0, 'full', 'cash', '54.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-08'),
(12, 'L100064', 1, 8, 0, 'full', 'cash', '27.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-16'),
(202, 'B100001', 1, 9, 0, 'full', 'cash', '113.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05'),
(14, 'B100003', 1, 10, 0, 'full', 'cash', '41.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-16'),
(15, 'B100005', 1, 11, 0, 'full', 'cash', '41.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-18'),
(159, 'B100006', 2, 12, 0, 'full', 'cash', '170.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(17, 'B100007', 1, 13, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-18'),
(19, 'B100008', 1, 14, 0, 'full', 'cash', '141.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-19'),
(208, 'B100009', 2, 15, 0, 'full', 'cash', '227.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05'),
(21, '', 0, 16, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-20'),
(27, 'B100001', 2, 18, 0, 'full', 'cash', '141.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-20'),
(156, '', 0, 0, 0, 'full', 'cash', '0.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(30, 'L100003', 1, 17, 0, 'full', 'cash', '73.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-20'),
(44, '', 6, 0, 0, 'full', 'cash', '0.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(33, 'B100010', 4, 19, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(36, 'B100012', 4, 20, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(51, 'B100005', 5, 21, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(42, 'B100001', 6, 22, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(47, 'B100003', 5, 23, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(46, 'B100002', 6, 24, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(50, 'B100004', 6, 25, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(52, 'B100006', 6, 26, 0, 'full', 'cash', '290.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(56, 'B100007', 3, 27, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(62, 'B100009', 2, 28, 0, 'full', 'cash', '23.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(63, 'B100010', 3, 29, 0, 'full', 'cash', '145.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(64, 'B100011', 3, 30, 0, 'full', 'cash', '431.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(58, 'B100008', 2, 31, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(65, 'B100012', 2, 32, 0, 'full', 'cash', '82.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(66, 'B100013', 4, 33, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(67, 'B100014', 3, 34, 0, 'full', 'cash', '32.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-21'),
(74, 'B100015', 2, 35, 0, 'full', 'cash', '141.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-22'),
(70, 'B100016', 3, 36, 0, 'full', 'cash', '280.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-22'),
(105, '', 1, 0, 0, 'full', 'cash', '0.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-28'),
(73, '', 5, 0, 0, 'full', 'cash', '0.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-22'),
(77, 'B100016', 2, 36, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-22'),
(78, 'B100017', 1, 38, 0, 'full', 'cash', '190.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-22'),
(79, 'B100018', 3, 39, 0, 'full', 'cash', '63.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-23'),
(80, 'B100019', 0, 40, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-23'),
(81, 'B100024', 5, 41, 0, 'full', 'cash', '547.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-23'),
(82, 'B100025', 8, 42, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-23'),
(85, 'B100026', 1, 43, 0, 'full', 'cash', '847.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-23'),
(86, 'B100027', 2, 44, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(87, 'B100033', 7, 45, 0, 'full', 'cash', '199.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(88, 'B100042', 3, 46, 0, 'full', 'cash', '45.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(89, 'B100035', 6, 47, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(90, 'B100044', 0, 48, 0, 'full', 'cash', '299.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(91, 'B100044', 4, 48, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(93, 'B100046', 7, 49, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(96, 'B100049', 5, 50, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(97, 'B100061', 5, 51, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(98, 'B100062', 2, 52, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(99, '', 3, 53, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-25'),
(100, '', 1, 54, 0, 'full', 'cash', '100', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-28'),
(106, '', 3, 54, 0, 'full', 'cash', '45.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-27'),
(133, '', 3, 0, 0, 'full', 'cash', '100.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-28'),
(136, 'B100070', 2, 1, 0, 'full', 'cash', '340.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(197, 'B100088', 2, 2, 0, 'full', 'cash', '256.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-01'),
(130, 'B100089', 5, 3, 0, 'full', 'cash', '155.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-28'),
(163, 'B100070', 3, 1, 0, 'full', 'cash', '100.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-01'),
(140, '', 2, 0, 0, 'full', 'cash', '422.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(143, 'B100088', 4, 2, 0, 'full', 'cash', '880.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(144, 'B100089', 3, 3, 0, 'full', 'cash', '150.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(146, 'L100090', 2, 4, 0, 'full', 'cash', '45.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(147, 'S100091', 4, 5, 0, 'full', 'cash', '45.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(148, 'B100013', 2, 6, 0, 'full', 'cash', '45.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(203, 'B100014', 2, 7, 0, 'full', 'cash', '113.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05'),
(151, 'L100064', 0, 8, 0, 'full', 'cash', '155.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(153, 'B100001', 2, 9, 0, 'full', 'cash', '115.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(157, 'B100003', 5, 10, 0, 'full', 'cash', '45.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-04-29'),
(198, 'B100089', 2, 3, 0, 'full', 'cash', '313.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-02'),
(199, 'L100090', 3, 4, 0, 'full', 'cash', '299.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-02'),
(200, 'S100091', 5, 5, 0, 'full', 'cash', '539.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-02'),
(201, 'B100013', 5, 6, 0, 'full', 'cash', '3717.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-02'),
(204, 'B100005', 4, 11, 0, 'full', 'cash', '227.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05'),
(205, 'B100006', 3, 12, 0, 'full', 'cash', '227.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05'),
(206, 'B100007', 2, 13, 0, 'full', 'cash', '50.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05'),
(207, 'B100008', 3, 14, 0, 'full', 'cash', '50.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05'),
(209, 'B100010', 5, 19, 0, 'full', 'cash', '227.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05'),
(210, 'B100012', 3, 20, 0, 'full', 'cash', '227.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05'),
(211, 'B100012', 0, 20, 0, 'full', 'cash', '113.00', '', '', 0, '', '', '', '0000-00-00', '', '', '', '', '', '', '2016-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `hms_payment_mode`
--

CREATE TABLE IF NOT EXISTS `hms_payment_mode` (
  `payment_mode_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_mode` varchar(250) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`payment_mode_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_purchase_order_detail`
--

CREATE TABLE IF NOT EXISTS `hms_purchase_order_detail` (
  `pur_id` int(11) NOT NULL AUTO_INCREMENT,
  `pur_fck_id` varchar(30) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `vendor_name` varchar(50) NOT NULL,
  `vendor_detail` varchar(50) NOT NULL,
  `item_name_id` varchar(50) NOT NULL,
  `item_type_id` varchar(50) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `reorder_level` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `tax_amount` int(100) NOT NULL,
  `purchase_tax` decimal(10,2) NOT NULL,
  `purchase_tax_amount` int(100) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `discount_amount` int(100) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `total_amount` int(200) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`pur_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `hms_purchase_order_detail`
--

INSERT INTO `hms_purchase_order_detail` (`pur_id`, `pur_fck_id`, `cart_id`, `vendor_name`, `vendor_detail`, `item_name_id`, `item_type_id`, `unit`, `quantity`, `reorder_level`, `price`, `tax`, `tax_amount`, `purchase_tax`, `purchase_tax_amount`, `discount`, `discount_amount`, `amount`, `total_amount`, `date`, `status`) VALUES
(1, '14', 1, '21', 'Pondy,\nPondy,\nIndia,\n605501,\n6445545454.', '1', '1', '20', '10', '1', '1', 0.00, 0, 0.00, 0, 0.00, 0, '10', 10, '2016-02-25', '1'),
(2, '15', 2, '24', 'pondy,\npondy,\nindia,\n6543212,\n9087654322.', '2', '3', '18', '11', '1', '1', 0.00, 0, 0.00, 0, 0.00, 0, '11', 11, '2016-02-25', '1'),
(3, '16', 3, '21', 'Pondy,\nPondy,\nIndia,\n605501,\n6445545454.', '2', '3', '18', '10', '1', '1', 0.00, 0, 0.00, 0, 0.00, 0, '10', 10, '2016-02-25', '1'),
(4, '16', 3, '21', 'Pondy,\nPondy,\nIndia,\n605501,\n6445545454.', '1', '1', '20', '11', '1', '1', 0.00, 0, 0.00, 0, 0.00, 0, '11', 11, '2016-02-25', '1'),
(6, '17', 4, '21', 'Pondy,\nPondy,\nIndia,\n605501,\n6445545454.', '1', '1', '20', '12', '1', '1', 0.00, 0, 0.00, 0, 0.00, 0, '12', 12, '2016-03-02', '1'),
(7, '17', 4, '21', 'Pondy,\nPondy,\nIndia,\n605501,\n6445545454.', '2', '3', '18', '34', '1', '1', 0.00, 0, 0.00, 0, 0.00, 0, '314', 314, '2016-03-02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hms_purchase_order_id`
--

CREATE TABLE IF NOT EXISTS `hms_purchase_order_id` (
  `Po_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_purchase_order_id`
--

INSERT INTO `hms_purchase_order_id` (`Po_id`) VALUES
(18);

-- --------------------------------------------------------

--
-- Table structure for table `hms_restaurant_account_details`
--

CREATE TABLE IF NOT EXISTS `hms_restaurant_account_details` (
  `account_id` int(255) NOT NULL AUTO_INCREMENT,
  `account_card_id` int(255) NOT NULL,
  `order_type` varchar(100) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `bill_id` varchar(11) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `service` decimal(10,2) NOT NULL,
  `vat_amt` decimal(10,2) NOT NULL,
  `service_amt` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `disc_amt` varchar(100) NOT NULL,
  `tabel_id` text NOT NULL,
  `sup_name` varchar(250) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `orde_close_date` date NOT NULL,
  `status` enum('open','close','cancel') NOT NULL DEFAULT 'open',
  `bill_status` enum('pending','paid','cancel','nocash') NOT NULL DEFAULT 'pending',
  `created_by` int(11) NOT NULL,
  `created_role_id` int(11) NOT NULL,
  `nocashcomments` text NOT NULL,
  `cancelcomments` text NOT NULL,
  `account_session` enum('B','L','S','D') NOT NULL,
  `no_of_person` int(11) NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=231 ;

--
-- Dumping data for table `hms_restaurant_account_details`
--

INSERT INTO `hms_restaurant_account_details` (`account_id`, `account_card_id`, `order_type`, `depart_id`, `bill_id`, `vat`, `service`, `vat_amt`, `service_amt`, `discount`, `disc_amt`, `tabel_id`, `sup_name`, `subtotal`, `total_amount`, `orde_close_date`, `status`, `bill_status`, `created_by`, `created_role_id`, `nocashcomments`, `cancelcomments`, `account_session`, `no_of_person`) VALUES
(207, 2, 'dine', 0, 'B100088', 0.00, 0.00, 4.38, 31.81, 0.00, '0', '2a,2b,2c', '6', 256.00, 256.00, '2016-05-01', 'close', 'paid', 1, 1, '', '', 'B', 3),
(173, 1, 'dine', 0, 'B100070', 0.00, 0.00, 1.71, 12.45, 0.00, '0', '3a,3b,3c', '2', 100.00, 100.00, '2016-05-01', 'close', 'paid', 1, 1, '', '', 'B', 3),
(208, 3, 'dine', 0, 'B100089', 0.00, 0.00, 5.38, 38.94, 0.00, '0', '2a,2b,2c', '2', 313.00, 313.00, '2016-05-02', 'close', 'paid', 1, 1, '', '', 'B', 3),
(209, 4, 'dine', 0, 'L100090', 0.00, 0.00, 5.15, 37.25, 0.00, '0', '3a,3b,3c,3d', '6', 300.00, 300.00, '2016-05-02', 'close', 'paid', 1, 1, '', '', 'L', 5),
(210, 5, 'dine', 0, 'S100091', 0.00, 0.00, 9.27, 67.15, 0.00, '0', '5a,5b', '11', 540.00, 540.00, '2016-05-02', 'close', 'paid', 1, 1, '', '', 'S', 2),
(230, 7, 'dine', 0, 'B100014', 0.00, 0.00, 0.00, 0.00, 0.00, '', '5a,5b,5c,5d', '', 0.00, 0.00, '2016-05-05', 'close', 'nocash', 1, 1, 'y', '', 'B', 0),
(229, 6, 'dine', 0, 'B100013', 0.00, 0.00, 0.00, 0.00, 0.00, '', '3a,3b,3c', '', 0.00, 0.00, '2016-05-05', 'close', 'nocash', 1, 1, 'y', '', 'B', 0);

-- --------------------------------------------------------

--
-- Table structure for table `hms_restaurant_order_details`
--

CREATE TABLE IF NOT EXISTS `hms_restaurant_order_details` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_cart_id` int(50) NOT NULL,
  `bill_id` varchar(11) NOT NULL,
  `order_type` varchar(100) NOT NULL,
  `table_entry_id` text NOT NULL,
  `order_posted_date` date NOT NULL,
  `menuid` int(100) NOT NULL,
  `category_id` varchar(10) NOT NULL,
  `depart_id` int(11) NOT NULL,
  `vat_tax` decimal(10,2) NOT NULL,
  `vat_amount` decimal(10,2) NOT NULL,
  `service_tax` decimal(10,2) NOT NULL,
  `service_amount` decimal(10,2) NOT NULL,
  `order_product` varchar(255) NOT NULL,
  `order_price` decimal(10,2) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `cancel_quantity` int(11) NOT NULL,
  `last_cancel_quantity` int(11) NOT NULL,
  `last_cancel_quantity_disp` int(11) NOT NULL,
  `order_amount` varchar(20) NOT NULL,
  `order_total_price` decimal(10,2) NOT NULL,
  `order_open_date` date NOT NULL,
  `order_close_date` datetime NOT NULL,
  `status` enum('open','save','close','cancel') NOT NULL DEFAULT 'open',
  `bill` enum('paid','pending') NOT NULL DEFAULT 'pending',
  `depart_status` int(11) NOT NULL,
  `itemcancel` int(11) NOT NULL,
  `parcel_status` int(11) NOT NULL,
  `order_session` enum('B','L','S','D') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_role_id` int(11) NOT NULL,
  `no_of_person` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=556 ;

--
-- Dumping data for table `hms_restaurant_order_details`
--

INSERT INTO `hms_restaurant_order_details` (`order_id`, `order_cart_id`, `bill_id`, `order_type`, `table_entry_id`, `order_posted_date`, `menuid`, `category_id`, `depart_id`, `vat_tax`, `vat_amount`, `service_tax`, `service_amount`, `order_product`, `order_price`, `order_quantity`, `cancel_quantity`, `last_cancel_quantity`, `last_cancel_quantity_disp`, `order_amount`, `order_total_price`, `order_open_date`, `order_close_date`, `status`, `bill`, `depart_status`, `itemcancel`, `parcel_status`, `order_session`, `created_by`, `created_role_id`, `no_of_person`) VALUES
(553, 8, '', 'dine', '6a,6b,6c', '2016-05-05', 107, '43', 1, 2.00, 1.95, 14.50, 14.11, 'fried chicken half', 97.28, 1, 0, 0, 0, '97.2763', 113.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 3),
(554, 9, '', 'dine', '2a,2b,2c,2d,3a,3b,3c,3d,4a,4b,5a,5b,5c,5d,6a,6b,6c,7a,7b,7c', '2016-05-05', 109, '43', 1, 2.00, 1.54, 14.50, 11.17, 'chicken pakoda', 77.04, 1, 0, 0, 0, '77.0428', 90.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 3),
(555, 9, '', 'dine', '2a,2b,2c,2d,3a,3b,3c,3d,4a,4b,5a,5b,5c,5d,6a,6b,6c,7a,7b,7c', '2016-05-05', 110, '43', 1, 2.00, 1.54, 14.50, 11.17, 'chicken spring roll', 77.04, 1, 0, 0, 0, '77.0428', 90.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 1, 0, 'B', 1, 1, 3),
(544, 5, '', 'dine', '2a,2b,2c,2d,3a,3b,3c,3d,5a,5b,5c,6a,6b,6c,7a,7b,7c', '2016-05-05', 109, '43', 1, 2.00, 1.54, 14.50, 11.17, 'chicken pakoda', 77.04, 1, 0, 0, 0, '77.0428', 90.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 3),
(545, 5, '', 'dine', '2a,2b,2c,2d,3a,3b,3c,3d,5a,5b,5c,6a,6b,6c,7a,7b,7c', '2016-05-05', 110, '43', 1, 2.00, 1.54, 14.50, 11.17, 'chicken spring roll', 77.04, 1, 0, 0, 0, '77.0428', 90.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 3),
(546, 5, '', 'dine', '2a,2b,2c,2d,3a,3b,3c,3d,5a,5b,5c,6a,6b,6c,7a,7b,7c', '2016-05-05', 111, '39', 1, 2.00, 1.71, 14.50, 12.41, 'chettinadu chic masala', 85.60, 1, 0, 0, 0, '85.6', 100.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 1, 0, 'B', 1, 1, 3),
(547, 6, '', 'dine', '4a,4b', '2016-05-05', 105, '42', 1, 2.00, 0.86, 14.50, 6.21, 'hot & sour chic soup', 42.80, 1, 0, 0, 0, '42.8016', 50.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 3),
(548, 7, '', 'dine', '2a,2b,2c,2d,3a,3b,3c,3d,4a,4b,5a,5b,5c,6a,6b,6c,7a,7b,7c', '2016-05-05', 106, '43', 1, 2.00, 3.89, 14.50, 28.21, 'fried chicken full', 194.55, 1, 0, 0, 0, '194.5525', 227.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 2),
(543, 5, '', 'dine', '2a,2b,2c,2d,3a,3b,3c,3d,5a,5b,5c,6a,6b,6c,7a,7b,7c', '2016-05-05', 108, '43', 1, 2.00, 1.95, 14.50, 14.11, 'chicken lollypop', 97.28, 1, 0, 0, 0, '97.28', 113.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 1, 0, 'B', 1, 1, 3),
(541, 3, '', 'dine', '2a,2b,2c,2d,3a,3b,3c,5a,5b,5c,6a,6b,6c', '2016-05-05', 106, '43', 1, 2.00, 3.89, 14.50, 28.21, 'fried chicken full', 194.55, 1, 0, 0, 0, '194.5525', 227.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 3),
(542, 4, '', 'dine', '2a,2b,2c,2d,3a,3b,3c,5a,5b,5c,6a,6b,6c,7a,7b,7c', '2016-05-05', 107, '43', 1, 2.00, 1.95, 14.50, 14.11, 'fried chicken half', 97.28, 1, 0, 0, 0, '97.2763', 113.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 3),
(540, 2, '', 'dine', '3a,3b,3c', '2016-05-05', 105, '42', 1, 2.00, 0.86, 14.50, 6.21, 'hot & sour chic soup', 42.80, 1, 0, 0, 0, '42.8016', 50.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 3),
(539, 1, '', 'dine', '5a,5b,5c', '2016-05-05', 105, '42', 1, 2.00, 0.86, 14.50, 6.21, 'hot & sour chic soup', 42.80, 1, 0, 0, 0, '42.8', 50.00, '2016-05-05', '0000-00-00 00:00:00', 'open', 'pending', 0, 0, 0, 'B', 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hms_restaurant_order_session`
--

CREATE TABLE IF NOT EXISTS `hms_restaurant_order_session` (
  `hros_id` int(11) NOT NULL AUTO_INCREMENT,
  `hros_session` tinytext NOT NULL,
  `hros_start_date` date NOT NULL,
  KEY `hros_id` (`hros_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `hms_restaurant_order_session`
--

INSERT INTO `hms_restaurant_order_session` (`hros_id`, `hros_session`, `hros_start_date`) VALUES
(8, 'B', '2016-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `hms_room_cloth_category`
--

CREATE TABLE IF NOT EXISTS `hms_room_cloth_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cloth_name` varchar(50) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_room_cloth_company`
--

CREATE TABLE IF NOT EXISTS `hms_room_cloth_company` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(250) NOT NULL,
  `phone_no` varchar(250) NOT NULL,
  `address1` varchar(250) NOT NULL,
  `address2` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `pincode` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_room_cloth_creation`
--

CREATE TABLE IF NOT EXISTS `hms_room_cloth_creation` (
  `cloth_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_category_id` int(11) NOT NULL,
  `Total_cloth` varchar(50) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`cloth_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_room_creation`
--

CREATE TABLE IF NOT EXISTS `hms_room_creation` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` varchar(100) NOT NULL,
  `floor` int(11) NOT NULL,
  `room_type` int(11) NOT NULL,
  `adults` varchar(100) NOT NULL,
  `child` varchar(100) NOT NULL,
  `smoking` enum('SY','SN') NOT NULL DEFAULT 'SN',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hms_room_service`
--

CREATE TABLE IF NOT EXISTS `hms_room_service` (
  `room_services_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` time NOT NULL,
  `department` varchar(100) NOT NULL,
  `services` varchar(100) NOT NULL,
  `ser_description` text NOT NULL,
  `other_description` text NOT NULL,
  `charges` decimal(5,2) NOT NULL,
  `esp_com_date` datetime NOT NULL,
  `exp_com_time` time NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`room_services_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `hms_room_service`
--

INSERT INTO `hms_room_service` (`room_services_id`, `customer_name`, `room_number`, `date`, `time`, `department`, `services`, `ser_description`, `other_description`, `charges`, `esp_com_date`, `exp_com_time`, `status`) VALUES
(14, 'bbb', '505', '2014-10-28', '06:01:00', 'Service', 'aaa', 'aaa', 'aaa', 15.00, '2014-10-28 00:00:00', '17:01:00', '2'),
(13, 'aaa', '131,133,13', '2014-10-28', '03:01:00', 'Payment Department', 'aaa', 'aaa', 'aa', 12.00, '2014-10-28 00:00:00', '03:01:00', '1'),
(16, 'mani', '505', '2014-10-21', '04:01:00', 'Service', 'sefw', 'wef', 'e', 100.00, '2014-10-25 00:00:00', '16:01:00', '2');

-- --------------------------------------------------------

--
-- Table structure for table `hms_room_type`
--

CREATE TABLE IF NOT EXISTS `hms_room_type` (
  `room_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_name` varchar(150) NOT NULL,
  `facility_id` varchar(250) NOT NULL,
  `bed_size` varchar(150) NOT NULL,
  `charge` varchar(150) NOT NULL,
  `note` varchar(250) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`room_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `hms_room_type`
--

INSERT INTO `hms_room_type` (`room_type_id`, `room_type_name`, `facility_id`, `bed_size`, `charge`, `note`, `active`, `date_added`, `date_modified`) VALUES
(36, 'Deluxe A1', '33,32,31,28', '10-25Sq.m', '2000.00', '', 'Y', '2009-02-12 14:55:18', '0000-00-00 00:00:00'),
(31, 'Small room (80-90 Sq.m)', '33', '10-25Sq.m', '35.00', '', 'Y', '2009-02-12 14:52:06', '2009-02-28 10:34:31'),
(33, 'Large Room (233-277 Sq.m)', '32', '10-25Sq.m', '500.00', '', 'Y', '2009-02-12 14:53:36', '0000-00-00 00:00:00'),
(32, 'Medium Room (125-140 Sq.m)', '31', '10-25Sq.m', '254.00', '', 'Y', '2009-02-12 14:52:57', '2009-02-28 10:34:32'),
(35, 'Triple B & B', '28', '10-25Sq.m', '1500.00', '', 'Y', '2009-02-12 14:54:46', '0000-00-00 00:00:00'),
(34, 'Double B & B', '31,28', '10-25Sq.m', '1000.00', '', 'Y', '2009-02-12 14:54:13', '0000-00-00 00:00:00'),
(37, 'Executive', '32,28', '10-25Sq.m', '1500.00', '', 'Y', '2009-02-12 14:55:59', '0000-00-00 00:00:00'),
(39, 'Family Room', '33,36,32,31', 'Double cot', '1000', 'All the facilites', 'Y', '2011-02-07 06:15:37', '0000-00-00 00:00:00'),
(40, 'Deluxe', '33', '900', '1000', '', 'Y', '2014-10-01 17:08:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hms_services_entry`
--

CREATE TABLE IF NOT EXISTS `hms_services_entry` (
  `hms_services_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `hms_services_entry_department` varchar(250) NOT NULL,
  `hms_services_entry_name` varchar(250) NOT NULL,
  `hms_services_entry_charges` varchar(250) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`hms_services_entry_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `hms_services_entry`
--

INSERT INTO `hms_services_entry` (`hms_services_entry_id`, `hms_services_entry_department`, `hms_services_entry_name`, `hms_services_entry_charges`, `active`, `date_added`, `date_modified`) VALUES
(28, 'Cooking', 'Purchasing', '21', 'Y', '2009-01-31 18:22:15', '2009-03-11 12:31:46'),
(34, 'Billing', 'Sweeping', '200', 'Y', '2009-03-10 15:04:18', '2009-03-11 12:31:20'),
(32, 'Security', 'Watching', '123', 'Y', '2009-02-06 18:32:31', '2009-03-11 12:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `hms_stock_balance_detail`
--

CREATE TABLE IF NOT EXISTS `hms_stock_balance_detail` (
  `stock_id` int(50) NOT NULL AUTO_INCREMENT,
  `item_type` varchar(50) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `processed_quantity` varchar(50) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hms_stock_balance_detail`
--

INSERT INTO `hms_stock_balance_detail` (`stock_id`, `item_type`, `item_name`, `processed_quantity`, `date`) VALUES
(1, '3', 'test2', '1', '2016-02-25'),
(2, '1', '1', '1', '2016-02-25'),
(3, '3', '2', '1', '2016-02-25'),
(4, '1', '1', '1', '2016-02-25'),
(5, '1', '1', '2', '2016-02-25');

-- --------------------------------------------------------

--
-- Stand-in structure for view `hms_stock_mt`
--
CREATE TABLE IF NOT EXISTS `hms_stock_mt` (
`mse_menu_id` int(11)
,`mse_qty` decimal(32,0)
,`sum(order_quantity)` decimal(32,0)
,`in_stock` decimal(33,0)
);
-- --------------------------------------------------------

--
-- Table structure for table `hms_supplier_creation`
--

CREATE TABLE IF NOT EXISTS `hms_supplier_creation` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(250) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`supplier_id`),
  UNIQUE KEY `supplier_id_2` (`supplier_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `hms_supplier_creation`
--

INSERT INTO `hms_supplier_creation` (`supplier_id`, `supplier_name`, `active`, `date_added`, `date_modified`) VALUES
(1, 'ABC 1', 'Y', '2016-02-08 10:34:07', '2016-03-04 10:47:22'),
(2, 'DEF 2', 'Y', '2016-02-08 10:34:11', '0000-00-00 00:00:00'),
(3, 'GHI 3', 'Y', '2016-02-08 10:34:18', '2016-03-04 10:47:11'),
(4, 'JKL 4', 'Y', '2016-02-15 17:54:50', '0000-00-00 00:00:00'),
(5, 'MNO 5', 'Y', '2016-02-15 17:54:57', '0000-00-00 00:00:00'),
(6, 'PQR 6', 'Y', '2016-02-15 17:55:07', '0000-00-00 00:00:00'),
(8, 'STU 7', 'Y', '2016-03-04 10:47:01', '0000-00-00 00:00:00'),
(9, 'WXY 8', 'Y', '2016-03-04 10:47:38', '0000-00-00 00:00:00'),
(10, 'ZAB 9', 'Y', '2016-03-04 10:47:49', '0000-00-00 00:00:00'),
(11, 'CDE 10', 'Y', '2016-03-04 10:48:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hms_supplier_mapping`
--

CREATE TABLE IF NOT EXISTS `hms_supplier_mapping` (
  `suppliermap_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_type_id` int(11) NOT NULL,
  `table_no_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`suppliermap_id`),
  UNIQUE KEY `suppliermap_id_2` (`suppliermap_id`),
  KEY `suppliermap_id` (`suppliermap_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `hms_supplier_mapping`
--

INSERT INTO `hms_supplier_mapping` (`suppliermap_id`, `table_type_id`, `table_no_id`, `supplier_id`, `active`, `date_added`, `date_modified`) VALUES
(1, 1, 1, 1, 'Y', '2016-02-23 11:57:49', '0000-00-00 00:00:00'),
(2, 1, 2, 2, 'Y', '2016-02-23 11:58:12', '0000-00-00 00:00:00'),
(3, 2, 5, 4, 'Y', '2016-02-23 11:58:39', '2016-02-23 12:10:23'),
(4, 1, 3, 1, 'Y', '2016-02-24 09:44:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hms_table_details`
--

CREATE TABLE IF NOT EXISTS `hms_table_details` (
  `htd_id` int(11) NOT NULL AUTO_INCREMENT,
  `htd_cart_id` int(11) NOT NULL,
  `htd_order_id` int(11) NOT NULL,
  `htd_bill_id` text NOT NULL,
  `htd_table_id` varchar(11) NOT NULL,
  `htd_chairs` varchar(5) NOT NULL,
  `htd_supplier_id` int(11) NOT NULL,
  `htd_noofpersons` int(11) NOT NULL,
  `htd_creaton` datetime NOT NULL,
  `htd_createdby` int(11) NOT NULL,
  `htd_createdroleid` int(11) NOT NULL,
  PRIMARY KEY (`htd_id`),
  UNIQUE KEY `htd_id_2` (`htd_id`),
  KEY `htd_id` (`htd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=898 ;

--
-- Dumping data for table `hms_table_details`
--

INSERT INTO `hms_table_details` (`htd_id`, `htd_cart_id`, `htd_order_id`, `htd_bill_id`, `htd_table_id`, `htd_chairs`, `htd_supplier_id`, `htd_noofpersons`, `htd_creaton`, `htd_createdby`, `htd_createdroleid`) VALUES
(555, 1, 539, 'B100070', '3', '3a', 5, 3, '2016-05-01 14:11:39', 1, 1),
(556, 1, 539, 'B100070', '3', '3b', 5, 3, '2016-05-01 14:11:39', 1, 1),
(557, 1, 539, 'B100070', '3', '3c', 5, 3, '2016-05-01 14:11:39', 1, 1),
(558, 2, 540, 'B100088', '2', '2a', 5, 3, '2016-05-01 14:14:15', 1, 1),
(559, 2, 540, 'B100088', '2', '2b', 5, 3, '2016-05-01 14:14:15', 1, 1),
(560, 2, 540, 'B100088', '2', '2c', 5, 3, '2016-05-01 14:14:15', 1, 1),
(563, 3, 541, 'B100089', '2', '2a', 5, 3, '2016-05-02 20:07:34', 1, 1),
(564, 3, 541, 'B100089', '2', '2b', 5, 3, '2016-05-02 20:07:34', 1, 1),
(565, 3, 541, 'B100089', '2', '2c', 5, 3, '2016-05-02 20:07:34', 1, 1),
(566, 4, 542, 'L100090', '3', '3a', 5, 3, '2016-05-02 20:10:24', 1, 1),
(567, 4, 542, 'L100090', '3', '3b', 5, 3, '2016-05-02 20:10:24', 1, 1),
(568, 4, 542, 'L100090', '3', '3c', 5, 3, '2016-05-02 20:10:24', 1, 1),
(569, 4, 542, 'L100090', '3', '3d', 5, 3, '2016-05-02 20:10:24', 1, 1),
(570, 5, 546, 'S100091', '5', '5a', 5, 3, '2016-05-02 20:11:25', 1, 1),
(571, 5, 546, 'S100091', '5', '5b', 5, 3, '2016-05-02 20:11:25', 1, 1),
(675, 6, 520, 'B100013', '3', '3a', 11, 2, '2016-05-05 13:29:33', 1, 1),
(676, 6, 520, 'B100013', '3', '3b', 11, 2, '2016-05-05 13:29:33', 1, 1),
(677, 6, 520, 'B100013', '3', '3c', 11, 2, '2016-05-05 13:29:33', 1, 1),
(678, 7, 548, 'B100014', '5', '5a', 11, 2, '2016-05-05 13:42:10', 1, 1),
(679, 7, 548, 'B100014', '5', '5b', 11, 2, '2016-05-05 13:42:10', 1, 1),
(680, 7, 548, 'B100014', '5', '5c', 11, 2, '2016-05-05 13:42:10', 1, 1),
(681, 7, 548, 'B100014', '5', '5d', 11, 2, '2016-05-05 13:42:10', 1, 1),
(717, 1, 539, '', '2', '2a', 5, 3, '2016-05-05 15:46:00', 1, 1),
(718, 1, 539, '', '2', '2b', 5, 3, '2016-05-05 15:46:00', 1, 1),
(719, 1, 539, '', '2', '2c', 5, 3, '2016-05-05 15:46:00', 1, 1),
(720, 1, 539, '', '2', '2d', 5, 3, '2016-05-05 15:46:00', 1, 1),
(721, 2, 540, '', '2', '2d', 5, 3, '2016-05-05 15:46:05', 1, 1),
(722, 2, 540, '', '3', '3a', 5, 3, '2016-05-05 15:46:05', 1, 1),
(723, 2, 540, '', '3', '3b', 5, 3, '2016-05-05 15:46:05', 1, 1),
(724, 2, 540, '', '3', '3c', 5, 3, '2016-05-05 15:46:05', 1, 1),
(725, 3, 541, '', '7', '7a', 5, 3, '2016-05-05 15:46:29', 1, 1),
(726, 3, 541, '', '7', '7b', 5, 3, '2016-05-05 15:46:29', 1, 1),
(727, 3, 541, '', '7', '7c', 5, 3, '2016-05-05 15:46:29', 1, 1),
(728, 4, 542, '', '2', '2a', 5, 3, '2016-05-05 15:46:33', 1, 1),
(729, 4, 542, '', '2', '2b', 5, 3, '2016-05-05 15:46:33', 1, 1),
(730, 4, 542, '', '2', '2c', 5, 3, '2016-05-05 15:46:33', 1, 1),
(731, 4, 542, '', '2', '2d', 5, 3, '2016-05-05 15:46:33', 1, 1),
(732, 4, 542, '', '7', '7a', 5, 3, '2016-05-05 15:46:33', 1, 1),
(733, 4, 542, '', '7', '7b', 5, 3, '2016-05-05 15:46:33', 1, 1),
(734, 4, 542, '', '7', '7c', 5, 3, '2016-05-05 15:46:33', 1, 1),
(735, 5, 546, '', '3', '3a', 5, 3, '2016-05-05 15:46:49', 1, 1),
(736, 5, 546, '', '3', '3b', 5, 3, '2016-05-05 15:46:49', 1, 1),
(737, 5, 546, '', '3', '3c', 5, 3, '2016-05-05 15:46:49', 1, 1),
(738, 6, 520, '', '2', '2a', 11, 2, '2016-05-05 15:46:53', 1, 1),
(739, 6, 520, '', '2', '2b', 11, 2, '2016-05-05 15:46:53', 1, 1),
(740, 6, 520, '', '2', '2c', 11, 2, '2016-05-05 15:46:53', 1, 1),
(741, 6, 520, '', '2', '2d', 11, 2, '2016-05-05 15:46:53', 1, 1),
(742, 6, 520, '', '3', '3d', 11, 2, '2016-05-05 15:46:53', 1, 1),
(743, 6, 520, '', '5', '5a', 11, 2, '2016-05-05 15:46:53', 1, 1),
(744, 6, 520, '', '5', '5b', 11, 2, '2016-05-05 15:46:53', 1, 1),
(745, 6, 520, '', '7', '7a', 11, 2, '2016-05-05 15:46:53', 1, 1),
(746, 6, 520, '', '7', '7b', 11, 2, '2016-05-05 15:46:53', 1, 1),
(747, 6, 520, '', '7', '7c', 11, 2, '2016-05-05 15:46:53', 1, 1),
(815, 1, 539, '', '5', '5a', 5, 3, '2016-05-05 15:49:59', 1, 1),
(816, 1, 539, '', '5', '5b', 5, 3, '2016-05-05 15:49:59', 1, 1),
(817, 1, 539, '', '5', '5c', 5, 3, '2016-05-05 15:49:59', 1, 1),
(818, 2, 540, '', '5', '5a', 5, 3, '2016-05-05 15:50:02', 1, 1),
(819, 2, 540, '', '5', '5b', 5, 3, '2016-05-05 15:50:02', 1, 1),
(820, 2, 540, '', '5', '5c', 5, 3, '2016-05-05 15:50:02', 1, 1),
(821, 1, 539, '', '6', '6a', 5, 3, '2016-05-05 15:50:43', 1, 1),
(822, 1, 539, '', '6', '6b', 5, 3, '2016-05-05 15:50:43', 1, 1),
(823, 1, 539, '', '6', '6c', 5, 3, '2016-05-05 15:50:43', 1, 1),
(824, 3, 541, '', '2', '2d', 5, 3, '2016-05-05 15:51:40', 1, 1),
(825, 3, 541, '', '3', '3a', 5, 3, '2016-05-05 15:51:40', 1, 1),
(826, 3, 541, '', '3', '3b', 5, 3, '2016-05-05 15:51:40', 1, 1),
(827, 3, 541, '', '3', '3c', 5, 3, '2016-05-05 15:51:40', 1, 1),
(828, 3, 541, '', '5', '5a', 5, 3, '2016-05-05 15:51:40', 1, 1),
(829, 3, 541, '', '5', '5b', 5, 3, '2016-05-05 15:51:40', 1, 1),
(830, 3, 541, '', '5', '5c', 5, 3, '2016-05-05 15:51:40', 1, 1),
(831, 3, 541, '', '6', '6a', 5, 3, '2016-05-05 15:51:40', 1, 1),
(832, 3, 541, '', '6', '6b', 5, 3, '2016-05-05 15:51:40', 1, 1),
(833, 3, 541, '', '6', '6c', 5, 3, '2016-05-05 15:51:40', 1, 1),
(834, 4, 542, '', '5', '5a', 5, 3, '2016-05-05 15:51:43', 1, 1),
(835, 4, 542, '', '5', '5b', 5, 3, '2016-05-05 15:51:43', 1, 1),
(836, 4, 542, '', '5', '5c', 5, 3, '2016-05-05 15:51:43', 1, 1),
(837, 4, 542, '', '6', '6a', 5, 3, '2016-05-05 15:51:43', 1, 1),
(838, 4, 542, '', '6', '6b', 5, 3, '2016-05-05 15:51:43', 1, 1),
(839, 4, 542, '', '6', '6c', 5, 3, '2016-05-05 15:51:43', 1, 1),
(840, 5, 546, '', '2', '2a', 5, 3, '2016-05-05 15:51:45', 1, 1),
(841, 5, 546, '', '2', '2b', 5, 3, '2016-05-05 15:51:45', 1, 1),
(842, 5, 546, '', '2', '2c', 5, 3, '2016-05-05 15:51:45', 1, 1),
(843, 5, 546, '', '2', '2d', 5, 3, '2016-05-05 15:51:45', 1, 1),
(844, 5, 546, '', '3', '3d', 5, 3, '2016-05-05 15:51:45', 1, 1),
(845, 5, 546, '', '5', '5c', 5, 3, '2016-05-05 15:51:45', 1, 1),
(846, 5, 546, '', '6', '6a', 5, 3, '2016-05-05 15:51:45', 1, 1),
(847, 5, 546, '', '6', '6b', 5, 3, '2016-05-05 15:51:45', 1, 1),
(848, 5, 546, '', '6', '6c', 5, 3, '2016-05-05 15:51:45', 1, 1),
(849, 5, 546, '', '7', '7a', 5, 3, '2016-05-05 15:51:46', 1, 1),
(850, 5, 546, '', '7', '7b', 5, 3, '2016-05-05 15:51:46', 1, 1),
(851, 5, 546, '', '7', '7c', 5, 3, '2016-05-05 15:51:46', 1, 1),
(852, 6, 547, '', '4', '4a', 4, 3, '2016-05-05 16:03:33', 1, 1),
(853, 6, 547, '', '4', '4b', 4, 3, '2016-05-05 16:03:33', 1, 1),
(854, 7, 548, '', '2', '2a', 11, 2, '2016-05-05 16:03:36', 1, 1),
(855, 7, 548, '', '2', '2b', 11, 2, '2016-05-05 16:03:37', 1, 1),
(856, 7, 548, '', '2', '2c', 11, 2, '2016-05-05 16:03:37', 1, 1),
(857, 7, 548, '', '2', '2d', 11, 2, '2016-05-05 16:03:37', 1, 1),
(858, 7, 548, '', '3', '3a', 11, 2, '2016-05-05 16:03:37', 1, 1),
(859, 7, 548, '', '3', '3b', 11, 2, '2016-05-05 16:03:37', 1, 1),
(860, 7, 548, '', '3', '3c', 11, 2, '2016-05-05 16:03:37', 1, 1),
(861, 7, 548, '', '3', '3d', 11, 2, '2016-05-05 16:03:37', 1, 1),
(862, 7, 548, '', '4', '4a', 11, 2, '2016-05-05 16:03:37', 1, 1),
(863, 7, 548, '', '4', '4b', 11, 2, '2016-05-05 16:03:37', 1, 1),
(864, 7, 548, '', '6', '6a', 11, 2, '2016-05-05 16:03:37', 1, 1),
(865, 7, 548, '', '6', '6b', 11, 2, '2016-05-05 16:03:37', 1, 1),
(866, 7, 548, '', '6', '6c', 11, 2, '2016-05-05 16:03:37', 1, 1),
(867, 7, 548, '', '7', '7a', 11, 2, '2016-05-05 16:03:37', 1, 1),
(868, 7, 548, '', '7', '7b', 11, 2, '2016-05-05 16:03:37', 1, 1),
(869, 7, 548, '', '7', '7c', 11, 2, '2016-05-05 16:03:37', 1, 1),
(875, 8, 553, '', '6', '6a', 2, 3, '2016-05-05 16:10:42', 1, 1),
(876, 8, 553, '', '6', '6b', 2, 3, '2016-05-05 16:10:42', 1, 1),
(877, 8, 553, '', '6', '6c', 2, 3, '2016-05-05 16:10:42', 1, 1),
(878, 9, 555, '', '2', '2a', 2, 3, '2016-05-05 16:10:45', 1, 1),
(879, 9, 555, '', '2', '2b', 2, 3, '2016-05-05 16:10:45', 1, 1),
(880, 9, 555, '', '2', '2c', 2, 3, '2016-05-05 16:10:45', 1, 1),
(881, 9, 555, '', '2', '2d', 2, 3, '2016-05-05 16:10:45', 1, 1),
(882, 9, 555, '', '3', '3a', 2, 3, '2016-05-05 16:10:45', 1, 1),
(883, 9, 555, '', '3', '3b', 2, 3, '2016-05-05 16:10:45', 1, 1),
(884, 9, 555, '', '3', '3c', 2, 3, '2016-05-05 16:10:45', 1, 1),
(885, 9, 555, '', '3', '3d', 2, 3, '2016-05-05 16:10:45', 1, 1),
(886, 9, 555, '', '4', '4a', 2, 3, '2016-05-05 16:10:45', 1, 1),
(887, 9, 555, '', '4', '4b', 2, 3, '2016-05-05 16:10:45', 1, 1),
(888, 9, 555, '', '5', '5a', 2, 3, '2016-05-05 16:10:45', 1, 1),
(889, 9, 555, '', '5', '5b', 2, 3, '2016-05-05 16:10:45', 1, 1),
(890, 9, 555, '', '5', '5c', 2, 3, '2016-05-05 16:10:45', 1, 1),
(891, 9, 555, '', '5', '5d', 2, 3, '2016-05-05 16:10:45', 1, 1),
(892, 9, 555, '', '6', '6a', 2, 3, '2016-05-05 16:10:46', 1, 1),
(893, 9, 555, '', '6', '6b', 2, 3, '2016-05-05 16:10:46', 1, 1),
(894, 9, 555, '', '6', '6c', 2, 3, '2016-05-05 16:10:46', 1, 1),
(895, 9, 555, '', '7', '7a', 2, 3, '2016-05-05 16:10:46', 1, 1),
(896, 9, 555, '', '7', '7b', 2, 3, '2016-05-05 16:10:46', 1, 1),
(897, 9, 555, '', '7', '7c', 2, 3, '2016-05-05 16:10:46', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hms_table_entry`
--

CREATE TABLE IF NOT EXISTS `hms_table_entry` (
  `table_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_type_id` int(11) NOT NULL,
  `table_no` varchar(11) NOT NULL,
  `numbers_of_chairs` int(11) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`table_entry_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `hms_table_entry`
--

INSERT INTO `hms_table_entry` (`table_entry_id`, `table_type_id`, `table_no`, `numbers_of_chairs`, `active`, `date_added`, `date_modified`) VALUES
(1, 2, '1', 4, 'Y', '2016-02-08 10:32:07', '2016-03-04 10:43:46'),
(2, 2, '2', 4, 'Y', '2016-02-08 10:32:17', '2016-03-04 10:43:57'),
(3, 2, '3', 4, 'Y', '2016-02-08 10:32:29', '2016-03-04 10:44:06'),
(4, 1, '4', 4, 'Y', '2016-02-08 10:32:46', '2016-03-04 10:44:22'),
(5, 1, '5', 4, 'Y', '2016-02-08 10:33:43', '2016-03-04 10:44:52'),
(6, 1, '6', 4, 'Y', '2016-02-08 10:33:52', '2016-03-04 10:45:02'),
(7, 2, '7', 4, 'Y', '2016-02-19 15:58:34', '2016-03-04 10:45:17'),
(8, 2, '8', 4, 'Y', '2016-03-04 10:43:04', '2016-03-04 10:45:27');

-- --------------------------------------------------------

--
-- Table structure for table `hms_table_type_creation`
--

CREATE TABLE IF NOT EXISTS `hms_table_type_creation` (
  `table_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_type_name` varchar(250) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`table_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hms_table_type_creation`
--

INSERT INTO `hms_table_type_creation` (`table_type_id`, `table_type_name`, `active`, `date_added`, `date_modified`) VALUES
(1, 'A2', 'Y', '2016-02-08 10:31:31', '2016-03-04 10:38:36'),
(2, 'A1', 'Y', '2016-02-08 10:31:43', '2016-03-04 10:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `hms_tax_info`
--

CREATE TABLE IF NOT EXISTS `hms_tax_info` (
  `tax_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_info_name` varchar(250) NOT NULL,
  `charge` varchar(250) NOT NULL,
  `live` enum('Y','N') NOT NULL DEFAULT 'N',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`tax_info_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `hms_tax_info`
--

INSERT INTO `hms_tax_info` (`tax_info_id`, `tax_info_name`, `charge`, `live`, `active`, `date_added`, `date_modified`) VALUES
(32, 'service', '4', 'Y', 'Y', '2014-12-18 14:41:56', '2015-02-02 16:15:13'),
(29, 'Vat', '3', 'Y', 'Y', '2014-12-01 17:11:46', '2015-02-03 18:12:11'),
(30, 'sales', '2', 'Y', 'Y', '2014-12-01 17:11:52', '2015-02-02 16:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `hms_tax_scheme`
--

CREATE TABLE IF NOT EXISTS `hms_tax_scheme` (
  `tax_scheme_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_scheme_name` varchar(250) NOT NULL,
  `from_date` datetime NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`tax_scheme_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `hms_tax_scheme`
--

INSERT INTO `hms_tax_scheme` (`tax_scheme_id`, `tax_scheme_name`, `from_date`, `active`, `date_added`, `date_modified`) VALUES
(8, 'General tax', '2014-12-01 00:00:00', 'Y', '2014-12-01 14:54:34', '2014-12-01 15:58:58'),
(7, 'Official tax', '2014-12-01 00:00:00', 'Y', '2014-12-01 14:54:21', '2014-12-31 16:24:24'),
(9, 're', '0000-00-00 00:00:00', 'Y', '2014-12-05 12:43:25', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hms_unit_entry`
--

CREATE TABLE IF NOT EXISTS `hms_unit_entry` (
  `unit_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(150) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`unit_entry_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `hms_unit_entry`
--

INSERT INTO `hms_unit_entry` (`unit_entry_id`, `unit_name`, `active`, `date_added`, `date_modified`) VALUES
(11, 'Pcs', 'Y', '2009-03-11 12:29:40', '2015-01-29 17:09:09'),
(12, 'Ltr', 'Y', '2009-03-12 18:27:09', '2014-10-04 02:32:19'),
(17, 'KG', 'Y', '2014-10-04 01:03:34', '2014-10-04 02:32:37'),
(18, 'meter   ', 'Y', '2015-01-12 12:58:48', '2015-01-12 12:58:55'),
(20, 'Dozzen', 'Y', '2015-01-29 17:12:49', '0000-00-00 00:00:00'),
(21, 'test', 'Y', '2016-02-19 15:53:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hms_vendor_creation`
--

CREATE TABLE IF NOT EXISTS `hms_vendor_creation` (
  `vendor_id` int(20) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(250) NOT NULL,
  `vendor_address` varchar(250) NOT NULL,
  `vendor_city` varchar(150) NOT NULL,
  `vendor_state` varchar(150) NOT NULL,
  `vendor_country` varchar(150) NOT NULL,
  `vendor_zip` int(8) NOT NULL,
  `vendor_phone` varchar(20) NOT NULL,
  `vendor_mobile` varchar(20) NOT NULL,
  `vendor_contact` varchar(150) NOT NULL,
  `item_id` int(11) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `hms_vendor_creation`
--

INSERT INTO `hms_vendor_creation` (`vendor_id`, `vendor_name`, `vendor_address`, `vendor_city`, `vendor_state`, `vendor_country`, `vendor_zip`, `vendor_phone`, `vendor_mobile`, `vendor_contact`, `item_id`, `active`, `date_added`, `date_modified`) VALUES
(21, 'Muru', 'Pondy', 'Pondy', 'Pondy', 'India', 605501, '654444', '6445545454', 'mani', 5, 'Y', '2009-03-10 15:42:57', '2014-10-03 21:25:20'),
(22, 'Buyer', 'Chennai', 'chennai', 'Tamil nadu', 'India', 6052225, '413-5456626', '9787845645', 'hari', 10, 'Y', '2011-02-07 06:25:11', '2014-10-03 21:43:27'),
(23, 'Maniraj', 'address', 'cdm', 'tamilnadu', 'india', 608001, '9876543211', '9876543211', 'mani', 0, 'Y', '2014-09-30 08:20:05', '2014-10-16 10:50:11'),
(24, 'Patrick', 'pondy', 'pondy', 'pondy', 'india', 6543212, '987653211', '9087654322', 'patrick', 0, 'Y', '2014-10-01 09:04:04', '2016-03-02 11:09:17'),
(26, 'GK Departmental Store', 'No5 Stella Mary Nagar', 'Pondy', 'Pondy', 'India', 605020, '965431654', '9876543211', 'Murugan', 0, 'Y', '2014-10-04 01:02:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ict_image`
--

CREATE TABLE IF NOT EXISTS `ict_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `user_profile` int(1) NOT NULL DEFAULT '0',
  `checkinno` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ict_proof`
--

CREATE TABLE IF NOT EXISTS `ict_proof` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` longtext NOT NULL,
  `user_profile` int(1) NOT NULL DEFAULT '0',
  `checkinno` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `up`
--

CREATE TABLE IF NOT EXISTS `up` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `checkinno` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `up`
--

INSERT INTO `up` (`id`, `name`, `checkinno`) VALUES
(1, '195_images (1).jpg', 'CI 107'),
(2, '496_Hydrangeas.jpg', 'CI 107'),
(3, '289_Lighthouse.jpg', 'CI 107'),
(4, '679_Lighthouse.jpg', 'CI 107'),
(5, '326_Tulips.jpg', 'CI 108');

-- --------------------------------------------------------

--
-- Structure for view `hms_menu_stock`
--
DROP TABLE IF EXISTS `hms_menu_stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hms_menu_stock` AS select `hms_menu_stock_entry`.`mse_menu_id` AS `mse_menu_id`,sum(`hms_menu_stock_entry`.`mse_qty`) AS `mse_qty` from `hms_menu_stock_entry` group by `hms_menu_stock_entry`.`mse_menu_id`;

-- --------------------------------------------------------

--
-- Structure for view `hms_stock_mt`
--
DROP TABLE IF EXISTS `hms_stock_mt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hms_stock_mt` AS select `b`.`mse_menu_id` AS `mse_menu_id`,`b`.`mse_qty` AS `mse_qty`,sum(`a`.`order_quantity`) AS `sum(order_quantity)`,(`b`.`mse_qty` - sum(`a`.`order_quantity`)) AS `in_stock` from (`hms_menu_stock` `b` left join `hms_restaurant_order_details` `a` on((`b`.`mse_menu_id` = `a`.`menuid`))) where (`a`.`itemcancel` = 0) group by `a`.`menuid`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
