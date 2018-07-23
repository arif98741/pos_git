-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2018 at 09:54 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newpos`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_balance`
-- (See below for the actual view)
--
CREATE TABLE `customer_balance` (
`customer_id` varchar(100)
,`balance` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_balancesheet`
-- (See below for the actual view)
--
CREATE TABLE `customer_balancesheet` (
`date` timestamp
,`Ref` varchar(20)
,`Customer` varchar(100)
,`Drescription` varchar(13)
,`Debit` double(13,2)
,`Credit` float
,`Balance` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `customer_statement`
-- (See below for the actual view)
--
CREATE TABLE `customer_statement` (
`sell_id` varchar(20)
,`customer_id` varchar(100)
,`date` timestamp
,`payable` double(13,2)
,`paid` float
,`Drescription` varchar(13)
);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `serial` int(6) NOT NULL,
  `customer_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `receiver` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `method` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amount` float(8,2) DEFAULT NULL,
  `current_bal` float(8,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`serial`, `customer_id`, `receiver`, `method`, `amount`, `current_bal`, `date`) VALUES
(49, '5000', '1', 'Bkash', 40.00, 5.00, '2018-05-31 20:37:15'),
(50, '5000', '1', 'Bkash', 500.00, -355.00, '2018-05-31 20:42:34'),
(51, '5000', '1', 'Bkash', 5000.00, -30527.00, '2018-06-03 19:30:44'),
(52, '5000', '1', 'Rocket', 10000.00, -15355.00, '2018-05-31 20:53:01'),
(53, '5000', '1', 'Rocket', 10000.00, -25355.00, '2018-05-31 20:56:14'),
(54, '5000', '1', 'Rocket', 5000.00, -30355.00, '2018-05-31 21:16:19'),
(55, '5000', '1', 'Bank Account', 50.00, -30577.00, '2018-06-03 19:36:00'),
(56, '150', '1', 'Islamic Bank', 12000.00, 3792.00, '2018-06-04 20:20:51'),
(57, '150', '1', 'Rocket', 1000.00, 2792.00, '2018-06-04 20:28:54'),
(58, '150', '1', 'One Bank', 1000.00, 1792.00, '2018-06-04 20:29:36'),
(59, '150', '1', 'Islamic Bank', 1500.00, 292.00, '2018-06-04 20:35:31'),
(60, '150', '1', 'cash', 500.00, 24872.00, '2018-06-07 09:01:16'),
(61, '150', '1', 'fds', 500.00, 24372.00, '2018-06-08 15:00:29'),
(62, '150', '1', 'Bkash', 10000.00, 44831.00, '2018-06-12 15:57:53'),
(63, '150', '1', '343', 343.00, 44488.00, '2018-06-30 10:21:59'),
(64, '150', '1', '343', 343.00, 44488.00, '2018-06-30 10:25:41'),
(65, '150', '1', 'Bkash', 540.00, 43605.00, '2018-06-30 12:26:18'),
(66, '150', '1', 'Cash', 1250.00, 42355.00, '2018-06-30 12:27:54'),
(67, '1059', '1', 'Cahs', 500.00, -500.00, '2018-07-11 11:45:08'),
(68, '1058', '1', 'Cash', 230.00, 0.00, '2018-07-11 11:46:58'),
(69, '1056', '1', 'Cash', 1000.00, 54.00, '2018-07-11 11:45:34'),
(70, '1049', '1', 'Bkash', 3000.00, 480.00, '2018-07-11 11:45:48');

-- --------------------------------------------------------

--
-- Stand-in structure for view `profit`
-- (See below for the actual view)
--
CREATE TABLE `profit` (
`date` timestamp
,`sell_id` varchar(20)
,`customer_name` varchar(100)
,`product_id` int(11)
,`name` varchar(255)
,`profit` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `profit_report`
-- (See below for the actual view)
--
CREATE TABLE `profit_report` (
`sell_id` varchar(20)
,`seller` int(11)
,`customer_id` varchar(10)
,`customer_name` varchar(100)
,`product_id` int(11)
,`quantity` decimal(32,0)
,`purchase_price` double(8,2)
,`unit_price` double
,`date` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `stock`
-- (See below for the actual view)
--
CREATE TABLE `stock` (
`product_id` varchar(5)
,`pquantity` decimal(32,0)
,`squantity` decimal(32,0)
,`stock` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accesslog`
--

CREATE TABLE `tbl_accesslog` (
  `id` int(5) NOT NULL,
  `ip` varchar(33) DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `pass` varchar(35) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accesslog`
--

INSERT INTO `tbl_accesslog` (`id`, `ip`, `user`, `pass`, `date`) VALUES
(2, '127.0.0.1', 'admin', 'adin', '2018-06-30 21:13:59'),
(3, '::1', 'admin', 'admin]', '2018-07-09 21:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brandid` int(11) NOT NULL,
  `brandname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `colorid` int(11) NOT NULL,
  `colorname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `serial` int(11) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `opening_balance` int(11) NOT NULL,
  `due` float(8,2) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `discount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`serial`, `customer_id`, `customer_name`, `address`, `contact_no`, `email`, `opening_balance`, `due`, `remark`, `discount`, `date`, `updateby`) VALUES
(1, '1000', 'Modu Store', 'Comola Super market,Alaipur, Natore', '01750840217', 'happyproduct123@gmail.com', 96875, 195847.38, 'Happy', 0, '2018-06-18 13:26:19', 1),
(2, '1001', 'Motin Store', 'Comola Super market,Alaipur, Natore', '01750840217', 'happyproduct123@gmail.com', 1776, 27420.00, 'Happy', 0, '2018-06-18 21:24:45', 1),
(3, '1003', 'Bikrompur Store', 'Comola Super market,Alaipur, Natore', '01750840217', 'happyproduct123@gmail.com', 33674, 23174.00, 'Happy', 0, '2018-06-18 21:25:52', 1),
(4, '1004', 'Jahangir Store', 'Comola Super market,Alaipur, Natore', '01750840217', 'happyproduct123@gmail.com', 0, 21792.00, 'Happy', 0, '2018-06-18 21:27:12', 1),
(5, '1005', 'Muktodhara Library', 'Alaipur ,Boi potti,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 0.00, 'Happy', 0, '2018-06-18 21:29:54', 1),
(6, '1006', 'Nipa Store', 'Rozi Market, Station Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 50117, 51935.00, 'Happy', 0, '2018-06-18 21:32:02', 1),
(7, '1007', 'Suma Store', 'Station Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 40964.00, 'Happy', 0, '2018-06-18 21:33:11', 1),
(8, '1008', 'Brathers Cosmetics', 'Station Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 3584.00, 'Happy', 0, '2018-06-18 21:34:32', 1),
(9, '1009', 'Niamul Store', 'Station Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 636, 0.00, 'Happy', 0, '2018-06-18 21:36:20', 1),
(10, '1010', 'Manik Store', 'Bonpara Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 19900, 0.00, 'Happy', 0, '2018-06-18 21:38:15', 1),
(11, '1011', 'Hasan', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 194, 3170.00, 'Happy', 0, '2018-06-18 21:43:27', 1),
(12, '1012', 'Noldangga Paper house', 'Noldangga Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 43431, 0.00, 'Happy', 0, '2018-06-18 23:24:24', 1),
(13, '1013', 'Azad Library', 'Alaipur ,Boi potti,Natore', '01750840217', 'happyproduct123@gmail.com', 380, 0.00, 'Happy', 0, '2018-06-18 23:26:04', 1),
(14, '1014', 'Dilip Store', 'Natore', '01750840217', 'happyproduct123@gmail.com', 3950, 0.00, 'Happy', 0, '2018-06-18 23:28:04', 1),
(15, '1015', 'Mim Paper', 'Somobai Market, Rajshahi', '01750840217', 'happyproduct123@gmail.com', 2052, 0.00, 'Happy', 0, '2018-06-18 23:30:14', 1),
(16, '1016', 'Al Amil Paper', 'Somobai Market, Rajshahi', '01750840217', 'happyproduct123@gmail.com', 5303, 0.00, 'Happy', 0, '2018-06-18 23:31:39', 1),
(17, '1017', 'Ashim Da', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 69852, 29858.37, 'Happy', 0, '2018-06-18 23:33:18', 1),
(18, '1018', 'Shati Telicom', 'Putia Bazar, Rajshahi', '01750840217', 'happyproduct123@gmail.com', 3570, 16727.98, 'Happy', 0, '2018-06-18 23:35:08', 1),
(19, '1019', 'Noumi Computer', 'Nimtola Batar goli,Natore', '01750840217', 'happyproduct123@gmail.com', 5225, 8200.00, 'Happy', 0, '2018-06-18 23:37:48', 1),
(20, '1020', 'Panto', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 13193, 48996.85, 'Happy', 0, '2018-06-18 23:39:00', 1),
(21, '1021', 'Nurul Store', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 990, 0.00, 'Happy', 0, '2018-06-18 23:41:30', 1),
(22, '1022', 'Mr.Mogibor', 'Bakshore Madrasha,Bakshore,Natore', '01750840217', 'happyproduct123@gmail.com', 426, 0.00, 'Happy', 0, '2018-06-18 23:52:22', 1),
(23, '1023', 'Rumi Cosmetics', 'Kaligong Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 5000, 0.00, 'Happy', 0, '2018-06-18 23:54:49', 1),
(24, '1024', 'Shaheb Store', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 1000, 0.00, 'Happy', 0, '2018-06-18 23:56:11', 1),
(25, '1025', 'Arafat Trading', 'Nazirpur Bazar, Gurudaspur,Natore', '01750840217', 'happyproduct123@gmail.com', 98357, 95127.66, 'Happy', 0, '2018-06-18 23:59:04', 1),
(26, '1026', 'Hafiz Vai', 'Bonpara Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 2800, 49108.00, 'Happy', 0, '2018-06-19 00:21:41', 1),
(27, '1027', 'Incorrect 2', 'Tamaltola, Natore', '01750840217', 'happyproduct123@gmail.com', 0, 0.00, 'Happy', 0, '2018-06-19 00:23:40', 1),
(28, '1028', 'Hanif  Enterprise', 'Akdala ,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 6434.40, 'Happy', 0, '2018-06-21 15:37:11', 1),
(29, '1029', 'Momin', 'Taghachi,Dighapatia,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 160.00, 'Happy', 0, '2018-06-21 15:52:12', 1),
(30, '1030', 'Puja Enterprise', 'Natore', '01750840217', 'happyproduct123@gmail.com', 0, 52551.68, 'Happy', 0, '2018-06-21 23:33:27', 1),
(31, '1032', 'Fatema Store', 'Tamaltola, Natore', '01750840217', 'happyproduct123@gmail.com', 40974, 104509.00, 'Happy', 0, '2018-06-22 17:54:54', 1),
(32, '1033', 'Incorrect', 'Putia Bazar, Rajshahi', '01750840217', 'happyproduct123@gmail.com', 0, 0.00, 'Happy', 0, '2018-06-24 01:36:14', 1),
(33, '1034', 'Rafhi Enterprise', 'Gunarigram,Natore', '01750840217', 'happyproduct123@gmail.com', 7911, 11075.00, 'Happy', 0, '2018-06-24 16:02:04', 1),
(34, '1035', 'Idle Library', 'Somospara , Atrai', '01750840217', 'happyproduct123@gmail.com', -28532, 7356.00, 'Happy', 0, '2018-06-24 16:18:36', 1),
(35, '1036', 'M.H Enterprise', 'Dhorail Bazar, Natore', '01750840217', 'happyproduct123@gmail.com', -340, 75395.86, 'Happy', 0, '2018-06-25 15:41:25', 1),
(36, '1037', 'Durga Store', 'Natore', '01750840217', 'happyproduct123@gmail.com', 0, 34623.90, 'happy', 0, '2018-06-26 01:12:47', 1),
(37, '1038', 'Suchitra', 'Ahmedpur ,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 0.00, 'Happy', 0, '2018-06-26 21:39:17', 1),
(38, '1040', 'Vai Vai Enterprise', 'Singra ,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 42132.88, 'Happy', 0, '2018-06-27 01:59:28', 1),
(39, '1041', 'M.R Computer', 'Hokars Market,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 4100.00, 'Happy', 0, '2018-06-27 18:52:30', 1),
(40, '1043', 'Nasima Apa', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 375.00, 'Happy', 0, '2018-06-27 23:00:17', 1),
(41, '1044', 'Moon Traders', 'Hatiandaho bazar,Singra,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 5907.72, 'Happy', 0, '2018-06-28 23:04:28', 1),
(42, '1045', 'Ontim Sopno Paper', 'Alaipur ,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 6450.00, 'Happy', 0, '2018-06-29 01:46:22', 1),
(43, '1046', 'Bismilla Store', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 4550.00, 'Happy', 0, '2018-06-29 01:51:33', 1),
(44, '1048', 'Asraful Traders', 'Belchushi,Sirajgong', '01750840217', 'happyproduct123@gmail.com', -2629, 28709.33, 'Happy', 0, '2018-06-30 20:36:49', 1),
(46, '1049', 'Bagdat Store', 'Comola Super market,Alaipur, Natore', '01750840217', 'happyproduct123@gmail.com', 0, 43615.99, 'Happy', 0, '2018-07-05 04:08:30', 1),
(47, '1050', 'Fozlul Ulum Madrasha', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 3039.00, 'Happy', 0, '2018-07-05 04:22:38', 1),
(48, '1051', 'Vai Vai Enterprise', 'Bonpara Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 20970.00, 'Happy', 0, '2018-07-05 15:13:14', 1),
(49, '1053', 'Nazmul', 'Chokrampur,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 2250.00, 'Happy', 0, '2018-07-07 15:02:26', 1),
(50, '1056', 'Boi Ghor', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 1534.00, 'Happy', 0, '2018-07-08 15:03:25', 1),
(51, '1055', 'Helal Enterprise', 'Goyeshpur bazar, Pabna', '01750840217', 'happyproduct123@gmail.com', 0, 53436.00, 'Happy', 0, '2018-07-08 16:20:13', 1),
(52, '1057', 'Hoque Paper house', 'Taherpur,Bagmara,Rajshahi', '01750840217', 'happyproduct123@gmail.com', 0, 5149.99, 'Happy', 0, '2018-07-08 21:39:05', 1),
(53, '1058', 'Arif Store', 'Singra ,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 26314.00, 'Happy', 0, '2018-07-09 15:18:22', 1),
(54, '1059', 'Mojammal Hujur', 'Dighapatia Bazar,Natore', '01750840217', 'happyproduct123@gmail.com', 0, 320.00, 'Happy', 0, '2018-07-11 02:51:10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

CREATE TABLE `tbl_group` (
  `groupid` int(11) NOT NULL,
  `groupname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`groupid`, `groupname`) VALUES
(1, 'Khata'),
(2, 'Book'),
(3, 'Pencil');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `serial` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `carton` int(11) NOT NULL,
  `piece` int(11) NOT NULL,
  `purchase` int(6) NOT NULL,
  `subtotal` float NOT NULL,
  `total` float NOT NULL,
  `vehicle_no` varchar(20) NOT NULL,
  `driver_mobile` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `updateby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`serial`, `invoice_number`, `supplier_id`, `quantity`, `carton`, `piece`, `purchase`, `subtotal`, `total`, `vehicle_no`, `driver_mobile`, `date`, `status`, `updateby`) VALUES
(22, '676', 125, 0, 180, 180, 1359, 7110, 7110, '7676', '767', '2018-07-02', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_products`
--

CREATE TABLE `tbl_invoice_products` (
  `serial_no` int(11) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `product_id` varchar(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `carton` int(11) NOT NULL,
  `piece` double NOT NULL,
  `purchase` float(10,2) NOT NULL,
  `subtotal` float(10,2) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice_products`
--

INSERT INTO `tbl_invoice_products` (`serial_no`, `invoice_id`, `product_id`, `quantity`, `carton`, `piece`, `purchase`, `subtotal`, `status`) VALUES
(56, '676', '1000', 4, 0, 180, 9.00, 360.00, 0),
(57, '676', '1400', 2, 0, 180, 1350.00, 6750.00, 0),
(58, '677', '1000', 0, 1, 40, 9.00, 360.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laser`
--

CREATE TABLE `tbl_laser` (
  `serial` int(6) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `donor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `receiver` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `debit` float(8,2) DEFAULT '0.00',
  `credit` float(8,2) DEFAULT '0.00',
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updateby` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_laser`
--

INSERT INTO `tbl_laser` (`serial`, `category`, `donor`, `receiver`, `debit`, `credit`, `description`, `updateby`, `date`) VALUES
(12, '4', NULL, NULL, 0.00, 3444.00, 'dsfd', '1', '2018-07-15 18:00:00'),
(11, '5', NULL, NULL, 400.00, 0.00, 'dsfsdfsdafs', '1', '2018-07-15 18:00:00'),
(10, '4', NULL, NULL, 0.00, 344.00, 'dsfdsf', '1', '2018-07-09 18:00:00'),
(9, '1', NULL, NULL, 500.00, 0.00, 'Good', '1', '2018-07-04 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `serial` int(11) NOT NULL,
  `product_id` varchar(8) NOT NULL,
  `product_type` int(11) NOT NULL,
  `product_group` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_brand` int(11) NOT NULL,
  `size_h` int(4) NOT NULL,
  `size_w` int(4) NOT NULL,
  `color` varchar(10) NOT NULL,
  `sale_price` double NOT NULL DEFAULT '0',
  `purchase_price` double NOT NULL DEFAULT '0',
  `piece_in_a_carton` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`serial`, `product_id`, `product_type`, `product_group`, `product_name`, `product_brand`, `size_h`, `size_w`, `color`, `sale_price`, `purchase_price`, `piece_in_a_carton`, `last_update`, `updateby`) VALUES
(1, '1000', 3, 2, 'Stylish REB Pencils', 1400, 0, 0, '', 14, 9, 40, '2018-07-21 21:20:19', 1),
(10, '1400', 3, 2, 'ABC Product', 1400, 0, 0, '', 1400, 1350, 5, '2018-07-21 21:13:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sell`
--

CREATE TABLE `tbl_sell` (
  `serial` int(11) NOT NULL,
  `sell_id` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `sub_total` float NOT NULL,
  `dlcharge` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `grand_total` float(10,2) NOT NULL,
  `paid` float NOT NULL,
  `payable` float(10,2) NOT NULL,
  `due` float NOT NULL,
  `previous_balance` float(8,2) NOT NULL,
  `status` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updateby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell`
--

INSERT INTO `tbl_sell` (`serial`, `sell_id`, `customer_id`, `seller`, `sub_total`, `dlcharge`, `discount`, `vat`, `grand_total`, `paid`, `payable`, `due`, `previous_balance`, `status`, `date`, `updateby`) VALUES
(1, '1807040001', 150, 1, 530, 0, 0, 0, 530.00, 400, 530.00, 130, -27526.00, 0, '2018-07-04 13:46:42', 1),
(2, '1807040002', 150, 1, 6500220, 0, 0, 0, 6500220.00, 0, 6500220.00, 6500220, -302810.00, 0, '2018-07-10 03:17:49', 1),
(3, '1807040003', 150, 1, 600, 0, 1, 0, 599.00, 500, 599.00, 99, 1000000.00, 0, '2018-07-10 05:14:22', 1),
(4, '1807040004', 1254, 1, 2600430, 0, 0, 0, 2600428.00, 2500000, 2600428.00, 100428, 12500.00, 0, '2018-07-11 10:26:42', 1),
(5, '1807040005', 1058, 1, 4610, 0, 0, 0, 4610.00, 4500, 4610.00, 110, 0.00, 0, '2018-07-11 11:00:41', 1),
(6, '1807040006', 1056, 1, 4014, 0, 0, 0, 4014.00, 3500, 4014.00, 514, 0.00, 0, '2018-07-11 11:09:43', 1),
(7, '1807040007', 1026, 1, 34756, 0, 0, 0, 34756.00, 0, 34756.00, 34756, 2800.00, 0, '2018-07-11 11:10:24', 1),
(8, '1807040008', 1049, 1, 13505, 0, 25, 0, 13480.00, 10000, 13480.00, 3480, 0.00, 0, '2018-07-11 11:11:33', 1),
(9, '1807040009', 1011, 1, 7780, 0, 0, 0, 7780.00, 5000, 7780.00, 2780, 194.00, 0, '2018-07-11 11:12:36', 1),
(10, '1807040010', 1058, 1, 1120, 0, 0, 0, 1120.00, 1000, 1120.00, 120, 110.00, 0, '2018-07-11 11:13:33', 1),
(11, '1807040011', 1056, 1, 6040, 0, 0, 0, 6040.00, 5500, 6040.00, 540, 514.00, 0, '2018-07-11 11:13:58', 1),
(12, '1807040012', 1058, 1, 4140, 0, 0, 0, 4140.00, 4000, 4140.00, 140, 0.00, 0, '2018-07-18 22:16:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sell_products`
--

CREATE TABLE `tbl_sell_products` (
  `serial_no` int(11) NOT NULL,
  `sell_id` varchar(20) NOT NULL,
  `customer_id` int(5) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `product_piece` int(5) DEFAULT NULL,
  `unit_price` double NOT NULL,
  `purchase_price` double(8,2) NOT NULL,
  `discount` varchar(5) NOT NULL DEFAULT 'null',
  `subtotal` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell_products`
--

INSERT INTO `tbl_sell_products` (`serial_no`, `sell_id`, `customer_id`, `product_id`, `quantity`, `product_piece`, `unit_price`, `purchase_price`, `discount`, `subtotal`, `status`) VALUES
(5, '1807040001', 150, 154, 3, NULL, 120, 100.00, 'null', 360, 1),
(6, '1807040001', 150, 156, 5, NULL, 34, 30.00, 'null', 170, 1),
(27, '1807040002', 150, 155, 5, NULL, 14, 0.00, 'null', 70, 1),
(28, '1807040002', 150, 157, 5, NULL, 30, 27.60, 'null', 150, 1),
(29, '1807040002', 150, 14588888, 5, NULL, 1300000, 999999.99, 'null', 6500000, 1),
(30, '1807040003', 150, 154, 5, NULL, 120, 100.00, 'null', 600, 1),
(34, '1807040004', 1254, 156, 2, NULL, 34, 30.00, 'null', 68, 1),
(35, '1807040004', 1254, 14588888, 2, NULL, 1300000, 999999.99, 'null', 2600000, 1),
(36, '1807040004', 1254, 154, 3, NULL, 120, 100.00, 'null', 360, 1),
(37, '1807040005', 1028, 156, 4, NULL, 34, 30.00, 'null', 136, 0),
(38, '1807040005', 1028, 178, 3, NULL, 250, 145.00, 'null', 750, 0),
(39, '1807040005', 1058, 154, 25, NULL, 120, 100.00, 'null', 3000, 1),
(40, '1807040005', 1058, 157, 25, NULL, 30, 27.60, 'null', 750, 1),
(41, '1807040005', 1058, 156, 15, NULL, 34, 30.00, 'null', 510, 1),
(43, '1807040005', 1058, 1000, 25, NULL, 14, 9.00, 'null', 350, 1),
(46, '1807040006', 1025, 156, 7, NULL, 34, 30.00, 'null', 238, 0),
(47, '1807040006', 1056, 156, 34, NULL, 34, 30.00, 'null', 1156, 1),
(49, '1807040006', 1056, 148, 2, NULL, 129, 100.00, 'null', 258, 1),
(50, '1807040006', 1056, 158, 2, NULL, 1300, 1120.60, 'null', 2600, 1),
(51, '1807040007', 1026, 157, 15, NULL, 30, 27.60, 'null', 450, 1),
(52, '1807040007', 1026, 158, 25, NULL, 1300, 1120.60, 'null', 32500, 1),
(53, '1807040007', 1026, 148, 14, NULL, 129, 100.00, 'null', 1806, 1),
(54, '1807040008', 1049, 154, 14, NULL, 120, 100.00, 'null', 1680, 1),
(55, '1807040008', 1049, 155, 25, NULL, 80, 76.00, 'null', 2000, 1),
(56, '1807040008', 1049, 178, 25, NULL, 250, 145.00, 'null', 6250, 1),
(57, '1807040008', 1049, 1000, 25, NULL, 14, 9.00, 'null', 350, 1),
(58, '1807040008', 1049, 148, 25, NULL, 129, 100.00, 'null', 3225, 1),
(59, '1807040009', 1011, 156, 45, NULL, 34, 30.00, 'null', 1530, 1),
(60, '1807040009', 1011, 178, 25, NULL, 250, 145.00, 'null', 6250, 1),
(61, '1807040010', 1058, 157, 4, NULL, 30, 27.60, 'null', 120, 1),
(62, '1807040010', 1058, 154, 5, NULL, 120, 100.00, 'null', 600, 1),
(63, '1807040010', 1058, 155, 5, NULL, 80, 76.00, 'null', 400, 1),
(64, '1807040011', 1056, 178, 3, NULL, 250, 145.00, 'null', 750, 1),
(65, '1807040011', 1056, 157, 3, NULL, 30, 27.60, 'null', 90, 1),
(66, '1807040011', 1056, 158, 4, NULL, 1300, 1120.60, 'null', 5200, 1),
(67, '1807040012', 1058, 154, 2, NULL, 120, 100.00, 'null', 240, 1),
(68, '1807040012', 1058, 158, 3, NULL, 1300, 1120.60, 'null', 3900, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `serial` int(11) NOT NULL,
  `supplier_id` varchar(10) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `opening_balance` float NOT NULL,
  `remark` varchar(80) NOT NULL,
  `updateby` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`serial`, `supplier_id`, `supplier_name`, `address`, `contact_no`, `email`, `contact_person`, `opening_balance`, `remark`, `updateby`) VALUES
(1, '1400', 'Happy Products', 'Dhaka,1203-Kawran Bazar', '01728659255', 'happy.admin@gmail.com', 'Ariful Islam', 0, 'Good', 1),
(2, '125', 'Something Company', 'Dhaaka 1233', '0125-55855', 'abc@gmail.com', 'dlsfj', 12500, 'Good', 1),
(4, '1487', 'AB', 'Asulia, Savar, Dhaka', '01759525822', 'ar@gmail.co', 'Good', 0, 'Good', 1),
(5, '14894', 'CDS', 'Elenga, Tangail', '0125698255sd', 'a@lo.fodf', 'Arifuls', 0, 'Good', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier_transaction`
--

CREATE TABLE `tbl_supplier_transaction` (
  `id` int(11) NOT NULL,
  `supplier` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `purchase` float(10,2) DEFAULT NULL,
  `payment` float(10,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier_transaction`
--

INSERT INTO `tbl_supplier_transaction` (`id`, `supplier`, `description`, `purchase`, `payment`, `date`) VALUES
(11, 125, 'Something', 1400.00, 1200.00, '2018-07-01 21:53:39'),
(12, 1400, 'Elese', 140.00, 100.00, '2018-07-01 21:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactioncat`
--

CREATE TABLE `tbl_transactioncat` (
  `id` int(5) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_type` varchar(50) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transactioncat`
--

INSERT INTO `tbl_transactioncat` (`id`, `category_name`, `category_type`, `last_update`) VALUES
(1, 'Electric Bill', 'Debit', '2018-06-30 10:07:21'),
(4, 'Gas Bills', 'Credit', '2018-06-30 20:53:50'),
(5, 'Tea Bill', 'Debit', '2018-06-29 22:45:00'),
(6, 'Month Bonus Comission', 'Credit', '2018-06-29 22:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `typeid` int(11) NOT NULL,
  `typename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`typeid`, `typename`) VALUES
(1, 'KG'),
(2, 'PIECE'),
(3, 'INCH');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'stuff',
  `company_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `password`, `name`, `email`, `status`, `company_name`, `address`, `logo`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Hasan A', 'admin@gmail.com', 'admin', 'HAPPY PRODUCTS', 'Dighapatiq Bazar, Natore, Mobile: 01751001326', 'uploads/logo_.png'),
(8, 'simple123', '202cb962ac59075b964b07152d234b70', 'Simple Man', 'simple@g.com', 'stuff', 'HAPPY PRODUCTS', 'Dighapatiq Bazar, Natore, Mobile: 01751001326', 'uploads/logo_.png');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tpurchase`
-- (See below for the actual view)
--
CREATE TABLE `tpurchase` (
`product_id` varchar(5)
,`pquantity` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tsold`
-- (See below for the actual view)
--
CREATE TABLE `tsold` (
`product_id` int(11)
,`squantity` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Structure for view `customer_balance`
--
DROP TABLE IF EXISTS `customer_balance`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_balance`  AS  select `customer_statement`.`customer_id` AS `customer_id`,sum((`customer_statement`.`payable` - `customer_statement`.`paid`)) AS `balance` from `customer_statement` group by `customer_statement`.`customer_id` ;

-- --------------------------------------------------------

--
-- Structure for view `customer_balancesheet`
--
DROP TABLE IF EXISTS `customer_balancesheet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_balancesheet`  AS  select `t1`.`date` AS `date`,`t1`.`sell_id` AS `Ref`,`t1`.`customer_id` AS `Customer`,`t1`.`Drescription` AS `Drescription`,`t1`.`payable` AS `Debit`,`t1`.`paid` AS `Credit`,(select sum((`customer_statement`.`payable` - `customer_statement`.`paid`)) AS `Balance` from `customer_statement` where ((`customer_statement`.`customer_id` = `t1`.`customer_id`) and (`customer_statement`.`date` <= `t1`.`date`))) AS `Balance` from `customer_statement` `t1` order by `t1`.`date` ;

-- --------------------------------------------------------

--
-- Structure for view `customer_statement`
--
DROP TABLE IF EXISTS `customer_statement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `customer_statement`  AS  select `tbl_sell`.`sell_id` AS `sell_id`,`tbl_sell`.`customer_id` AS `customer_id`,`tbl_sell`.`date` AS `date`,`tbl_sell`.`payable` AS `payable`,`tbl_sell`.`paid` AS `paid`,'Sales Invoice' AS `Drescription` from `tbl_sell` union select `tbl_customer`.`serial` AS `serial`,`tbl_customer`.`customer_id` AS `customer_id`,`tbl_customer`.`date` AS `date`,`tbl_customer`.`opening_balance` AS `opening_balance`,0 AS `0`,'Opening' AS `Opening` from `tbl_customer` union select `payment`.`serial` AS `serial`,`payment`.`customer_id` AS `customer_id`,`payment`.`date` AS `date`,0 AS `0`,`payment`.`amount` AS `amount`,'Payment' AS `Payment` from `payment` ;

-- --------------------------------------------------------

--
-- Structure for view `profit`
--
DROP TABLE IF EXISTS `profit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profit`  AS  select `pr`.`date` AS `date`,`pr`.`sell_id` AS `sell_id`,`pr`.`customer_name` AS `customer_name`,`pr`.`product_id` AS `product_id`,`tu`.`name` AS `name`,((`pr`.`unit_price` * `pr`.`quantity`) - (`pr`.`purchase_price` * `pr`.`quantity`)) AS `profit` from (`profit_report` `pr` join `tbl_user` `tu` on((`pr`.`seller` = `tu`.`userid`))) group by `pr`.`sell_id` ;

-- --------------------------------------------------------

--
-- Structure for view `profit_report`
--
DROP TABLE IF EXISTS `profit_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `profit_report`  AS  select `tsp`.`sell_id` AS `sell_id`,`ts`.`seller` AS `seller`,`tc`.`customer_id` AS `customer_id`,`tc`.`customer_name` AS `customer_name`,`tsp`.`product_id` AS `product_id`,sum(`tsp`.`quantity`) AS `quantity`,`tsp`.`purchase_price` AS `purchase_price`,`tsp`.`unit_price` AS `unit_price`,`ts`.`date` AS `date` from ((`tbl_sell_products` `tsp` join `tbl_customer` `tc` on((`tc`.`customer_id` = `tsp`.`customer_id`))) join `tbl_sell` `ts` on((`tsp`.`sell_id` = `ts`.`sell_id`))) where (`tsp`.`status` = '1') group by `tsp`.`sell_id`,`tsp`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `stock`
--
DROP TABLE IF EXISTS `stock`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stock`  AS  select `tpurchase`.`product_id` AS `product_id`,`tpurchase`.`pquantity` AS `pquantity`,`tsold`.`squantity` AS `squantity`,(`tpurchase`.`pquantity` - ifnull(`tsold`.`squantity`,0)) AS `stock` from (`tpurchase` left join `tsold` on((`tpurchase`.`product_id` = `tsold`.`product_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tpurchase`
--
DROP TABLE IF EXISTS `tpurchase`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tpurchase`  AS  select `tbl_invoice_products`.`product_id` AS `product_id`,sum(`tbl_invoice_products`.`quantity`) AS `pquantity` from `tbl_invoice_products` group by `tbl_invoice_products`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `tsold`
--
DROP TABLE IF EXISTS `tsold`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tsold`  AS  select `tbl_sell_products`.`product_id` AS `product_id`,sum(`tbl_sell_products`.`quantity`) AS `squantity` from `tbl_sell_products` group by `tbl_sell_products`.`product_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_accesslog`
--
ALTER TABLE `tbl_accesslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`colorid`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD PRIMARY KEY (`groupid`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_invoice_products`
--
ALTER TABLE `tbl_invoice_products`
  ADD PRIMARY KEY (`serial_no`);

--
-- Indexes for table `tbl_laser`
--
ALTER TABLE `tbl_laser`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_sell`
--
ALTER TABLE `tbl_sell`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_sell_products`
--
ALTER TABLE `tbl_sell_products`
  ADD PRIMARY KEY (`serial_no`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `tbl_supplier_transaction`
--
ALTER TABLE `tbl_supplier_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transactioncat`
--
ALTER TABLE `tbl_transactioncat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`typeid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `serial` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_accesslog`
--
ALTER TABLE `tbl_accesslog`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brandid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `colorid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_group`
--
ALTER TABLE `tbl_group`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_invoice_products`
--
ALTER TABLE `tbl_invoice_products`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_laser`
--
ALTER TABLE `tbl_laser`
  MODIFY `serial` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_sell`
--
ALTER TABLE `tbl_sell`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_sell_products`
--
ALTER TABLE `tbl_sell_products`
  MODIFY `serial_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_supplier_transaction`
--
ALTER TABLE `tbl_supplier_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_transactioncat`
--
ALTER TABLE `tbl_transactioncat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `typeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
