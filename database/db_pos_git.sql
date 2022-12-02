-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 13, 2021 at 04:01 PM
-- Server version: 10.3.31-MariaDB-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kotoyyvs_post`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_statement`
--

CREATE TABLE `customer_statement` (
  `sell_id` varchar(20) DEFAULT NULL,
  `customer_id` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payable` double(13,2) DEFAULT NULL,
  `paid` double DEFAULT NULL,
  `Drescription` varchar(13) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `net_stock`
--

CREATE TABLE `net_stock` (
  `product_id` varchar(15) DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL,
  `product_group` int(11) DEFAULT NULL,
  `product_name` varchar(250) DEFAULT NULL,
  `stock` decimal(33,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`serial`, `customer_id`, `receiver`, `method`, `amount`, `current_bal`, `date`) VALUES
(1, '1', '1', 'cash', 15705.00, 0.00, '2019-04-26 13:07:59'),
(2, '1', '1', '656', 1000000.00, -1000000.00, '2019-07-04 09:41:17'),
(3, '1', '1', '', 1000000.00, -1000000.00, '2019-11-13 17:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sell_id` varchar(20) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `profit` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profit_report`
--

CREATE TABLE `profit_report` (
  `sell_id` varchar(20) DEFAULT NULL,
  `seller` int(11) DEFAULT NULL,
  `customer_id` varchar(10) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` decimal(32,0) DEFAULT NULL,
  `purchase_price` double(8,2) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `product_id` varchar(15) DEFAULT NULL,
  `pquantity` decimal(32,0) DEFAULT NULL,
  `squantity` decimal(32,0) DEFAULT NULL,
  `stock` decimal(33,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_statement`
--

CREATE TABLE `supplier_statement` (
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `supplier` int(11) DEFAULT NULL,
  `Drescription` varchar(255) DEFAULT NULL,
  `Debit` float(10,2) DEFAULT NULL,
  `Credit` float(10,2) DEFAULT NULL,
  `Balance` double(19,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accesslog`
--

CREATE TABLE `tbl_accesslog` (
  `id` int(5) NOT NULL,
  `ip` varchar(33) DEFAULT NULL,
  `user` varchar(30) DEFAULT NULL,
  `pass` varchar(35) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accesslog`
--

INSERT INTO `tbl_accesslog` (`id`, `ip`, `user`, `pass`, `date`) VALUES
(0, '37.111.232.53', 'admin@admin.com', '123456', '2021-06-21 08:50:10'),
(0, '37.111.232.53', 'Id:admin@admin', '123456', '2021-06-21 08:51:50'),
(0, '37.111.232.53', 'admin@admin.com', '123456', '2021-06-21 08:52:08'),
(0, '37.111.232.53', 'md.golam rabbani', '123456', '2021-06-21 08:52:30'),
(0, '37.111.232.53', 'admin@admin.com', '123456', '2021-06-21 08:52:59'),
(0, '37.111.232.53', 'admin@admin.com', '123456', '2021-06-21 09:09:56'),
(0, '37.111.248.136', 'admin@admin.com', '123456', '2021-06-26 07:19:46'),
(0, '37.111.248.136', 'admin@admin.com', '123456', '2021-06-26 07:20:04'),
(0, '37.111.248.136', 'admin@admin.com', '123456', '2021-06-26 07:21:20'),
(0, '37.111.248.136', 'admin@admin.com', '123456', '2021-06-26 07:21:37'),
(0, '37.111.248.136', 'admin@admin.com', '123456', '2021-06-26 07:24:16');

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
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateby` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`serial`, `customer_id`, `customer_name`, `address`, `contact_no`, `email`, `opening_balance`, `due`, `remark`, `discount`, `date`, `updateby`) VALUES
(1, '1', 'Ariful Islam', 'Fultala, Elenga, Tangail', '01750840217', 'arif@mail.com', 1000, 221466.59, 'None', 0, '2019-01-03 06:59:39', 1),
(2, '125', 'Shamim Al-Deen', 'Dhalapara, Ghatail, Tangail', '01738298666', 'shamimaldeen@gmail.com', 1250, -15774.00, 'Good', 0, '2019-07-18 09:59:21', 1),
(0, '8765', 'Limon', 'Feni', '01838723408', 'limon@gmail.com', 5000, -120.00, '@@@', 0, '2021-03-01 04:25:28', 1);

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
(1, 'Stationary'),
(2, 'Home'),
(3, 'Decoration'),
(4, 'Electronics'),
(5, 'Mobile');

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
  `subtotal` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `updateby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`serial`, `invoice_number`, `supplier_id`, `quantity`, `carton`, `piece`, `purchase`, `subtotal`, `total`, `date`, `status`, `updateby`) VALUES
(1, '20190001', 1, 10, 0, 0, 18200, 182000.00, 182000.00, '2019-01-03', NULL, 0),
(2, '20190002', 1, 35, 0, 0, 18361, 456605.00, 456605.00, '2019-01-17', NULL, 0),
(3, '20190003', 1, 90, 0, 0, 900, 81000.00, 81000.00, '2019-03-06', NULL, 0),
(4, '20190004', 1, 70, 0, 0, 900, 63000.00, 63000.00, '2019-03-06', NULL, 1),
(5, '20190005', 1, 7, 0, 0, 24, 84.00, 84.00, '2019-04-18', NULL, 0),
(6, '20190006', 7545, 100, 0, 0, 870, 87000.00, 87000.00, '2019-04-25', NULL, 1),
(7, '20190007', 1, 0, 0, 0, 0, 0.00, 0.00, '2019-07-03', NULL, 0),
(8, '20190008', 7545, 0, 0, 0, 0, 0.00, 0.00, '2019-07-07', NULL, 0),
(9, '20190009', 7545, 30, 0, 0, 3440, 34400.00, 34400.00, '2019-12-17', NULL, 0),
(10, '20190010', 1, 71, 0, 0, 17420, 221720.00, 221720.00, '2020-01-15', NULL, 0),
(11, '20190011', 7545, 2, 0, 0, 15000, 30000.00, 30000.00, '2020-01-08', NULL, 0),
(12, '20190012', 7545, 0, 0, 0, 0, 0.00, 0.00, '2020-01-28', NULL, 0),
(13, '20190013', 7545, 0, 0, 0, 0, 0.00, 0.00, '2222-02-22', NULL, 0),
(0, '20190014', 7545, 25, 0, 0, 0, 7380.00, 7380.00, '1978-11-06', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_products`
--

CREATE TABLE `tbl_invoice_products` (
  `serial_no` int(11) NOT NULL,
  `invoice_id` varchar(20) NOT NULL,
  `product_id` varchar(15) NOT NULL,
  `quantity` int(11) NOT NULL,
  `carton` int(11) NOT NULL,
  `piece` double NOT NULL,
  `purchase` float(10,2) NOT NULL,
  `subtotal` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_invoice_products`
--

INSERT INTO `tbl_invoice_products` (`serial_no`, `invoice_id`, `product_id`, `quantity`, `carton`, `piece`, `purchase`, `subtotal`) VALUES
(1, '20190001', '10001', 10, 0, 0, 18200.00, 182000.00),
(2, '20190002', '10002', 10, 0, 0, 160.50, 1605.00),
(3, '20190002', '10001', 25, 0, 0, 18200.00, 455000.00),
(4, '20190003', 'test', 90, 0, 0, 900.00, 81000.00),
(5, '20190004', '0099', 70, 0, 0, 900.00, 63000.00),
(6, '20190005', 'w312w', 2, 0, 0, 12.00, 24.00),
(7, '20190005', 'w312w', 5, 0, 0, 12.00, 60.00),
(8, '20190006', 'BL20', 100, 0, 0, 870.00, 87000.00),
(9, '20190009', '1453', 10, 0, 0, 1020.00, 10200.00),
(10, '20190009', '1294940', 10, 0, 0, 1400.00, 14000.00),
(11, '20190009', '1453', 10, 0, 0, 1020.00, 10200.00),
(12, '20190010', '1294940', 25, 0, 0, 1400.00, 35000.00),
(13, '20190010', '1453', 36, 0, 0, 1020.00, 36720.00),
(14, '20190010', '1451', 10, 0, 0, 15000.00, 150000.00),
(15, '20190011', '1451', 2, 0, 0, 15000.00, 30000.00),
(0, '20190014', '1453', 25, 0, 0, 0.00, 7380.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laser`
--

CREATE TABLE `tbl_laser` (
  `serial` int(6) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `debit` float(8,2) DEFAULT 0.00,
  `credit` float(8,2) DEFAULT 0.00,
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updateby` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `serial` int(11) NOT NULL,
  `product_id` varchar(15) NOT NULL,
  `product_type` int(11) NOT NULL,
  `product_group` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `product_brand` int(11) NOT NULL,
  `size_h` int(4) NOT NULL,
  `size_w` int(4) NOT NULL,
  `color` varchar(10) NOT NULL,
  `sale_price` double NOT NULL DEFAULT 0,
  `purchase_price` double NOT NULL DEFAULT 0,
  `piece_in_a_carton` int(11) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`serial`, `product_id`, `product_type`, `product_group`, `product_name`, `product_brand`, `size_h`, `size_w`, `color`, `sale_price`, `purchase_price`, `piece_in_a_carton`, `last_update`, `updateby`) VALUES
(3, 'test', 0, 0, 'test', 0, 0, 0, '', 2, 1, 0, '2019-01-31 02:58:17', 1),
(4, '0099', 0, 4, 'tv', 1, 0, 0, '', 3434, 0, 4, '2019-03-05 19:55:09', 1),
(10, '1', 0, 0, '11', 0, 0, 0, '', 111, 111, 0, '2019-07-08 06:38:29', 1),
(12, '1450', 2, 4, 'Walton Refrigerator', 1, 0, 0, '', 25000, 20000, 1, '2019-07-18 10:00:03', 1),
(13, '1451', 2, 5, 'Samsung Galaxy s2', 7545, 0, 0, '', 15820, 15000, 6, '2019-07-18 10:01:12', 1),
(14, '1453', 2, 1, 'Bosundara Khata', 1, 0, 0, '', 1250, 1020, 12, '2019-07-18 10:01:57', 1),
(16, '1294940', 4, 2, 'Bangla', 1, 0, 0, '', 2000, 1400, 400, '2019-09-23 02:21:00', 1),
(17, 'ghghgh', 4, 3, 'jhjhj', 1, 0, 0, '', 899, 898, 909, '2020-01-30 10:20:38', 1),
(18, '1222', 5, 3, 'Condom', 1, 0, 0, '', 20, 18, 19, '2020-09-27 06:51:27', 1),
(0, '7876878', 1, 4, 'Sony tv', 1, 0, 0, '', 300, 400, 4, '2021-04-01 04:44:23', 1),
(0, '12312', 4, 4, 'Abc', 1, 0, 0, '', 125, 150, 1, '2021-04-18 11:54:51', 1);

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
  `grand_total` float NOT NULL,
  `paid` float NOT NULL,
  `payable` float(10,2) NOT NULL,
  `due` float NOT NULL,
  `previous_balance` float(8,2) NOT NULL,
  `status` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell`
--

INSERT INTO `tbl_sell` (`serial`, `sell_id`, `customer_id`, `seller`, `sub_total`, `dlcharge`, `discount`, `vat`, `grand_total`, `paid`, `payable`, `due`, `previous_balance`, `status`, `date`, `updateby`) VALUES
(1, '1901030001', 1, 1, 22400, 50, 0, 0, 22450, 22000, 22450.00, 450, 1500.00, 0, '2019-01-03 07:01:22', 1),
(2, '1901030002', 1, 1, 41000, 0, 0, 2050, 43050, 40000, 43050.00, 3050, 1950.00, 0, '2019-01-10 18:35:27', 1),
(3, '1901030003', 1, 1, 20880, 0, 0, 0, 20880, 15000, 20880.00, 5880, 5000.00, 0, '2019-01-17 14:54:43', 1),
(4, '1901030004', 1, 1, 41570, 0, 0, 0, 41570, 40000, 41570.00, 1570, 10880.00, 0, '2019-01-20 19:58:01', 1),
(5, '1901030005', 1, 1, 20880, 0, 20, 1044, 21904, 20000, 21904.00, 1904, 12450.00, 0, '2019-01-30 13:31:00', 1),
(6, '1901030006', 1, 1, 0, 4, 5, 0, 0, 44, 0.00, 0, 27208.00, 0, '2019-02-16 06:11:22', 1),
(7, '1901030007', 1, 1, 0, 100, 20, 0, 0, 10000, 0.00, -10000, 27164.00, 0, '2019-02-16 06:55:33', 1),
(8, '1901030008', 1, 1, 5, 0, 2, 0, 3, 2, 3.00, 1, 17164.00, 0, '2019-03-06 14:45:38', 1),
(9, '1901030009', 1, 1, 49, 50, 50, 10, 58.8, 20, 58.80, 38.8, 17165.00, 0, '2019-04-01 11:35:54', 1),
(10, '1901030010', 1, 1, 2, 5, 5, 0, 2, 1, 2.00, 1, 17204.00, 0, '2019-04-07 21:23:27', 1),
(11, '1901030011', 1, 1, 0, 0, 0, 0, 0, 1500, 0.00, -1500, 17205.00, 0, '2019-04-26 12:18:13', 1),
(12, '1901030012', 1, 1, 0, 1, 0, 0, 0, 50, 0.00, -50, -14354.00, 0, '2019-06-09 16:19:33', 1),
(13, '1901030013', 1, 1, 0, 20, 10, 0, 0, 22, 0.00, -22, -1000000.00, 0, '2019-07-04 09:47:20', 1),
(14, '1901030014', 1, 1, 605820, 0, 250, 0, 605570, 595625, 605570.00, 9945, -1000000.00, 0, '2019-07-18 10:03:42', 1),
(15, '1901030015', 1, 1, 0, 100, 10, 0, 0, 100, 0.00, -100, -1000000.00, 0, '2019-07-24 08:44:12', 1),
(16, '1901030016', 1, 1, 181640, 100, 10, 18164, 34894, 100, 34894.00, 34794, -1000000.00, 0, '2019-07-24 08:45:25', 1),
(17, '1901030017', 1, 1, 0, 12, 0, 0, 0, -323, 0.00, 323, -968787.00, 0, '2019-07-24 11:15:56', 1),
(18, '1901030018', 1, 1, 31640, 0, 10, 0, 31630, 30000, 31630.00, 1630, -968464.00, 0, '2019-10-04 10:56:08', 1),
(19, '1901030019', 1, 1, 49960, 0, 0, 0, 49960, 40000, 49960.00, 9960, -966834.00, 0, '2019-11-12 12:37:33', 1),
(20, '1901030020', 1, 1, 0, 2, 0, 0, 0, 2, 0.00, -2, -1000000.00, 0, '2020-01-05 07:12:04', 1),
(21, '1901030021', 1, 1, 51250, 0, 50, 0, 51200, 50000, 51200.00, 1200, -1000000.00, 0, '2020-01-06 20:03:19', 1),
(22, '1901030022', 1, 1, 32890, 0, 0, 0, 32890, 30000, 32890.00, 2890, -1000000.00, 0, '2020-01-20 07:42:57', 1),
(23, '1901030023', 1, 1, 10, 0, 0, 0, 10, 0, 10.00, 10, -1000000.00, 0, '2020-02-20 07:10:36', 1),
(24, '1901030024', 1, 1, 31640, 1, 10, 1582, 33213, 33213, 33213.00, 0, -1000000.00, 0, '2020-04-12 15:30:38', 1),
(25, '1901030025', 1, 1, 0, 1, 0, 0, 0, 1, 0.00, -1, -1000000.00, 0, '2020-05-03 07:23:37', 1),
(26, '1901030026', 1, 1, 136560, 9, 0, 24581, 161150, 6000, 161149.80, 155150, -1000000.00, 0, '2020-05-26 08:17:22', 1),
(27, '1901030027', 1, 1, 2500, 0, 4, 0, 2496, 200, 2496.00, -200, -1000000.00, 0, '2020-07-21 16:06:05', 1),
(28, '1901030028', 1, 1, 32890, 2, 3, 658, 0, 4, 0.00, 0, -1000000.00, 0, '2020-09-27 05:05:52', 1),
(29, '1901030029', 125, 1, 0, 1, 10, 0, 92, 1, 92.00, 91, 1250.00, 0, '2020-09-27 09:12:16', 1),
(0, '1901030030', 125, 1, 15820, 1, 0, 0, 0, 15820, 0.00, -15820, 0.00, 0, '2020-10-10 22:53:47', 1),
(0, '1901030031', 1, 1, 1250, 0, 0, 0, 1250, 33, 1250.00, -33, 0.00, 0, '2020-10-14 03:45:52', 1),
(0, '1901030032', 1, 1, 15000, 12, 12, 1800, 16800, 12222, 16800.00, 4578, 0.00, 0, '2020-11-04 21:33:58', 1),
(0, '1901030033', 125, 1, 910530, 45, 0, 409739, 0, 45, 0.00, -45, 0.00, 0, '2021-03-01 03:53:29', 1),
(0, '1901030034', 8765, 1, 0, 40, 40, 0, 0, 200, 0.00, -200, 0.00, 0, '2021-03-01 04:27:07', 1),
(0, '1901030035', 8765, 1, 1290, 0, 10, 0, 1280, 1200, 1280.00, 80, 0.00, 0, '2021-03-14 02:25:44', 1);

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
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_sell_products`
--

INSERT INTO `tbl_sell_products` (`serial_no`, `sell_id`, `customer_id`, `product_id`, `quantity`, `product_piece`, `unit_price`, `purchase_price`, `discount`, `subtotal`, `status`) VALUES
(1, '1901030001', 1, 10001, 1, NULL, 20500, 18200.00, 'null', 20500, 1),
(2, '1901030001', 1, 10002, 10, NULL, 190, 160.50, 'null', 1900, 1),
(3, '1901030002', 1, 10001, 2, NULL, 20500, 18200.00, 'null', 41000, 1),
(4, '1901030003', 1, 10001, 1, NULL, 20500, 18200.00, 'null', 20500, 1),
(5, '1901030003', 1, 10002, 2, NULL, 190, 160.50, 'null', 380, 1),
(6, '1901030004', 1, 10001, 2, NULL, 20500, 18200.00, 'null', 41000, 1),
(7, '1901030004', 1, 10002, 3, NULL, 190, 160.50, 'null', 570, 1),
(10, '1901030005', 1, 10001, 1, NULL, 20500, 18200.00, 'null', 20500, 1),
(11, '1901030005', 1, 10002, 2, NULL, 190, 160.50, 'null', 380, 1),
(12, '1901030008', 1, 0, 5, NULL, 1, 12.00, 'null', 5, 1),
(13, '1901030009', 1, 0, 1, NULL, 1, 12.00, 'null', 1, 1),
(14, '1901030009', 1, 23421, 2, NULL, 24, 20.00, 'null', 48, 1),
(15, '1901030010', 1, 0, 2, NULL, 1, 12.00, 'null', 2, 1),
(20, '1901030014', 1, 1453, 12, NULL, 1250, 1020.00, 'null', 15000, 1),
(21, '1901030014', 1, 1451, 1, NULL, 15820, 15000.00, 'null', 15820, 1),
(22, '1901030014', 1, 1450, 23, NULL, 25000, 20000.00, 'null', 575000, 1),
(26, '1901030016', 1, 1451, 2, NULL, 15820, 15000.00, 'null', 31640, 1),
(27, '1901030016', 1, 1450, 6, NULL, 25000, 20000.00, 'null', 150000, 1),
(32, '1901030018', 1, 1451, 2, NULL, 15820, 15000.00, 'null', 31640, 1),
(35, '1901030019', 1, 1453, 2, NULL, 1250, 1020.00, 'null', 2500, 1),
(36, '1901030019', 1, 1451, 3, NULL, 15820, 15000.00, 'null', 47460, 1),
(37, '1901030021', 1, 1453, 1, NULL, 1250, 1020.00, 'null', 1250, 1),
(38, '1901030021', 1, 1450, 2, NULL, 25000, 20000.00, 'null', 50000, 1),
(41, '1901030022', 1, 1453, 1, NULL, 1250, 1020.00, 'null', 1250, 1),
(42, '1901030022', 1, 1451, 2, NULL, 15820, 15000.00, 'null', 31640, 1),
(44, '1901030023', 1, 1294940, 1, NULL, 10, 0.00, 'null', 10, 1),
(46, '1901030024', 1, 1451, 2, NULL, 15820, 15000.00, 'null', 31640, 1),
(47, '1901030026', 1, 1453, 8, NULL, 1250, 1020.00, 'null', 10000, 1),
(48, '1901030026', 1, 1451, 8, NULL, 15820, 15000.00, 'null', 126560, 1),
(49, '1901030027', 1, 1453, 2, NULL, 1250, 1020.00, 'null', 2500, 1),
(53, '1901030028', 1, 1453, 1, NULL, 1250, 1020.00, 'null', 1250, 1),
(54, '1901030028', 1, 1451, 2, NULL, 15820, 15000.00, 'null', 31640, 1),
(0, '1901030033', 125, 1453, 45, NULL, 1250, 1020.00, 'null', 56250, 1),
(0, '1901030033', 125, 1451, 54, NULL, 15820, 15000.00, 'null', 854280, 1),
(0, '1901030035', 8765, 1453, 1, NULL, 1250, 1020.00, 'null', 1250, 1),
(0, '1901030035', 8765, 1222, 2, NULL, 20, 18.00, 'null', 40, 1);

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
(1, '1', 'Walton', 'Gazipur', '+12-01255555', 'contact.walton@walton.com.bd', 'Akm Sirajuddowlq', 0, 'Good', 1),
(2, '7545', 'X-Telecom (Samsung)', 'Gulshan Dhaka', '123456789', 'demo@demo.com', 'Atik', 0, 'N/A', 1);

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
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactioncat`
--

CREATE TABLE `tbl_transactioncat` (
  `id` int(5) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_type` varchar(50) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, 'PC'),
(3, 'Feet'),
(4, 'GM'),
(5, 'testtgujh'),
(6, 'asfsdf'),
(7, 'Lb');

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
  `logo` varchar(100) NOT NULL DEFAULT 'uploads/logo_1.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `password`, `name`, `email`, `status`, `company_name`, `address`, `logo`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Hasan Ali', 'admin@gmail.com', 'admin', 'HAPPY PRODUCTS', 'Dighapatia Bazar, Natore, Mobile: 01751001326', 'uploads/logo_.jpg'),
(8, 'Happy', '21232f297a57a5a743894a0e4a801fc3', 'Happy', 'happyproduct123@gmail.com', 'stuff', 'HAPPY PRODUCTS', 'Dighapatia Bazar, Natore, Mobile: 01751001326', 'uploads/logo_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tpurchase`
--

CREATE TABLE `tpurchase` (
  `product_id` varchar(15) DEFAULT NULL,
  `pquantity` decimal(32,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tsold`
--

CREATE TABLE `tsold` (
  `product_id` int(11) DEFAULT NULL,
  `squantity` decimal(32,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
