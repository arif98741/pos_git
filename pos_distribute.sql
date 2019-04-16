-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2019 at 07:20 PM
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
-- Database: `pos_distribute`
--

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
(1, 'Book'),
(2, 'Garments'),
(3, 'T-shirt');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laser`
--

CREATE TABLE `tbl_laser` (
  `serial` int(6) NOT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `debit` float(8,2) DEFAULT '0.00',
  `credit` float(8,2) DEFAULT '0.00',
  `description` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updateby` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(1, '125', 2, 1, 'Kazim IT', 125, 0, 0, '', 250, 200, 25, '2019-04-01 19:58:22', 1),
(2, '112', 0, 2, 'Akbor Steel', 125, 0, 0, '', 360, 300, 12, '2019-04-01 19:58:44', 1);

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
(1, '125', 'Azizul Hakim', 'Dhaka, bangladesh', '01750840217', 'azizul@gmail.com', 'Aziz', 0, 'Good', 1),
(2, '112', 'Shamim Al-Deen', 'Elenga, Tangail', '01754051776', 'shamimaldeen@gmail.com', 'Shamim', 0, 'bad', 1);

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
(2, 'Feet'),
(3, 'Liter');

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Hasan Ali', 'admin@gmail.com', 'admin', 'HAPPY PRODUCTS', 'Dighapatia Bazar, Natore, Mobile: 01751001326', 'uploads/logo_1.png'),
(8, 'Happy', '6b6ab521cb9bcced96aad441f3adea5f', 'Happy', 'happyproduct123@gmail.com', 'stuff', 'HAPPY PRODUCTS', 'Dighapatia Bazar, Natore, Mobile: 01751001326', 'uploads/logo_1.png');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`serial`);

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
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_group`
--
ALTER TABLE `tbl_group`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_laser`
--
ALTER TABLE `tbl_laser`
  MODIFY `serial` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
